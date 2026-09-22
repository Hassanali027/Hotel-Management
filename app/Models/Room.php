<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Room extends Model
{
    protected $guarded = [];
    protected $casts = ['features'=>'array','facilities'=>'array','amenities'=>'array','gallery'=>'array'];

    public function units()
    {
        return $this->hasMany(RoomUnit::class)->orderBy('number');
    }

    /** Recompute occupied / total / status from the room-number list (types without numbers keep their manual values). */
    public static function syncCounts()
    {
        $rooms = static::withCount([
            'units',
            'units as occupied_count' => fn ($q) => $q->where('status', 'occupied'),
            'units as reserved_count' => fn ($q) => $q->where('status', 'reserved'),
            'units as free_count' => fn ($q) => $q->where('status', 'available'),
        ])->get();

        foreach ($rooms as $room) {
            if ($room->units_count === 0) {
                continue;
            }

            // A room type is only "occupied" once a guest has actually checked in. While every unit is
            // held by a confirmed booking but nobody has arrived yet it is "reserved", which is what the
            // dashboard room-status card counts too.
            if ($room->free_count > 0) {
                $status = 'available';
            } elseif ($room->occupied_count > 0) {
                $status = 'occupied';
            } elseif ($room->reserved_count > 0) {
                $status = 'reserved';
            } else {
                $status = 'not_ready';
            }

            $room->update([
                'availability_total' => $room->units_count,
                'availability_used'  => $room->occupied_count + $room->reserved_count,
                'status'             => $status,
            ]);
        }
    }
}
