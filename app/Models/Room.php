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
        $rooms = static::withCount(['units', 'units as busy_count' => function ($q) {
            $q->whereIn('status', ['reserved', 'occupied']);
        }])->get();
        foreach ($rooms as $room) {
            if ($room->units_count === 0) {
                continue;
            }
            $room->update([
                'availability_total' => $room->units_count,
                'availability_used'  => $room->busy_count,
                'status'             => $room->busy_count >= $room->units_count ? 'occupied' : 'available',
            ]);
        }
    }
}
