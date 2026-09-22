<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One physical room (a room number) that belongs to a room type.
 * Status: available / reserved (pending or confirmed booking) / occupied (checked in) / not_ready (needs housekeeping).
 */
class RoomUnit extends Model
{
    protected $guarded = [];

    public const STATUSES = ['available', 'reserved', 'occupied', 'not_ready'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /** Find a unit by its number, accepting "101" or "Room 101". */
    public static function findByNumber($number)
    {
        $n = trim(preg_replace('/^room\s*/i', '', (string) $number));
        return $n === '' ? null : static::where('number', $n)->first();
    }

    /** Create numbered units for a room type until it has $count, skipping numbers already used by any type. */
    public static function generateFor(Room $room, int $count, int $floorPrefix)
    {
        $existing = static::where('room_id', $room->id)->count();
        $n = $floorPrefix * 100;
        while ($existing < $count) {
            $n++;
            if (static::where('number', (string) $n)->exists()) {
                continue;
            }
            static::create(['room_id' => $room->id, 'number' => (string) $n, 'status' => 'available']);
            $existing++;
        }
    }

    /**
     * Build the room-number list from existing data: rooms referenced by bookings and housekeeping
     * come first, each type is then filled up to its total, and current bookings / cleaning states are applied.
     */
    public static function backfill()
    {
        $rooms = Room::orderBy('id')->get();
        $byName = $rooms->keyBy('name');

        foreach (Booking::all() as $b) {
            $room = $byName->get($b->room_type);
            $n = trim((string) $b->room_number);
            if ($room && $n !== '' && !static::where('number', $n)->exists()) {
                static::create(['room_id' => $room->id, 'number' => $n]);
            }
        }
        foreach (HousekeepingTask::all() as $h) {
            $room = $byName->get($h->room_type);
            $n = trim(preg_replace('/^room\s*/i', '', (string) $h->room_number));
            if ($room && $n !== '' && !static::where('number', $n)->exists()) {
                static::create(['room_id' => $room->id, 'number' => $n]);
            }
        }
        foreach ($rooms->values() as $i => $room) {
            static::generateFor($room, (int) $room->availability_total, $i + 1);
        }

        foreach (Booking::whereIn('status', ['pending', 'confirmed', 'checked_in'])->orderBy('id')->get() as $b) {
            if ($u = static::findByNumber($b->room_number)) {
                $u->update(['status' => $b->status === 'checked_in' ? 'occupied' : 'reserved']);
            }
        }
        foreach (HousekeepingTask::where('status', '!=', 'ready')->get() as $h) {
            if (($u = static::findByNumber($h->room_number)) && $u->status === 'available') {
                $u->update(['status' => 'not_ready']);
            }
        }
        Room::syncCounts();
    }
}
