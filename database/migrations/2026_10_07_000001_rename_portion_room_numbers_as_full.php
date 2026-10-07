<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $roomNumbers = [
        'LA-1' => 'LA-FULL',
        'SU-1' => 'SU-FULL',
    ];

    public function up(): void
    {
        DB::transaction(function () {
            foreach ($this->roomNumbers as $old => $new) {
                $this->renameRoomNumber($old, $new);
            }
        });
    }

    public function down(): void
    {
        DB::transaction(function () {
            foreach ($this->roomNumbers as $old => $new) {
                $this->renameRoomNumber($new, $old);
            }
        });
    }

    private function renameRoomNumber(string $old, string $new): void
    {
        $oldUnit = DB::table('room_units')->where('number', $old)->first();
        $newUnit = DB::table('room_units')->where('number', $new)->first();

        if ($oldUnit && $newUnit) {
            throw new RuntimeException("Both room numbers {$old} and {$new} exist; refusing to change room inventory automatically.");
        }

        if ($oldUnit) {
            DB::table('room_units')->where('id', $oldUnit->id)->update(['number' => $new]);
        }

        DB::table('bookings')->where('room_number', $old)->update(['room_number' => $new]);
        foreach (DB::table('bookings')->where('room_label', 'like', '%'.$old)->get(['id', 'room_label']) as $booking) {
            DB::table('bookings')->where('id', $booking->id)->update([
                'room_label' => substr($booking->room_label, 0, -strlen($old)).$new,
            ]);
        }

        DB::table('housekeeping_tasks')->whereIn('room_number', [$old, 'Room '.$old])->update([
            'room_number' => DB::raw("CASE WHEN room_number = 'Room {$old}' THEN 'Room {$new}' ELSE '{$new}' END"),
        ]);

        if (\Illuminate\Support\Facades\Schema::hasTable('kitchen_orders')) {
            DB::table('kitchen_orders')->where('room_number', $old)->update(['room_number' => $new]);
        }
    }
};
