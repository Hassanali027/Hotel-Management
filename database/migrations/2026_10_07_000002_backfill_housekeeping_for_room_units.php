<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            $units = DB::table('room_units')
                ->join('rooms', 'rooms.id', '=', 'room_units.room_id')
                ->select('room_units.number', 'room_units.status', 'rooms.name as room_type')
                ->get();

            foreach ($units as $unit) {
                $label = 'Room '.$unit->number;
                if (DB::table('housekeeping_tasks')->whereIn('room_number', [$label, $unit->number])->exists()) {
                    continue;
                }

                $groundFloor = str_contains(strtolower($unit->room_type), 'lawn')
                    || str_contains(strtolower($unit->room_type), 'executive');
                DB::table('housekeeping_tasks')->insert([
                    'room_number' => $label,
                    'room_type' => $unit->room_type,
                    'status' => $unit->status === 'not_ready' ? 'needs' : 'ready',
                    'priority' => 'low',
                    'floor' => $groundFloor ? 'Ground' : 'First',
                    'reservation_status' => [
                        'available' => 'Available',
                        'reserved' => 'Reserved',
                        'occupied' => 'Occupied',
                        'not_ready' => 'Needs Cleaning',
                    ][$unit->status] ?? 'Available',
                    'notes' => 'Ready for the next guest.',
                    'is_checked' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }

    public function down(): void
    {
        // Keep housekeeping rows on rollback; staff may have updated them since creation.
    }
};
