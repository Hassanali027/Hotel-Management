<?php

use App\Models\InventoryItem;
use App\Models\RoomUnit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Physical room numbers under each room type; bookings and housekeeping drive their status.
        Schema::create('room_units', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('room_id')->index();
            $t->string('number')->unique();
            $t->string('status')->default('available'); // available / reserved / occupied / not_ready
            $t->timestamps();
        });

        // Every stock change, so staff can see where inventory went.
        Schema::create('inventory_movements', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('item_id')->index();
            $t->integer('change');
            $t->string('reason');
            $t->string('reference')->nullable();
            $t->timestamps();
        });

        // Quantity of an item handed out automatically at every check-in (0 = not automatic).
        Schema::table('inventory_items', function (Blueprint $t) {
            $t->unsignedInteger('per_checkin')->default(0)->after('quantity_reorder');
        });

        RoomUnit::backfill();

        foreach (['Bath Towels' => 2, 'Shampoo Bottles' => 1, 'Slippers' => 1, 'Water Bottles' => 2, 'Room Key Cards' => 1, 'Bed Linens' => 1] as $name => $qty) {
            InventoryItem::where('name', $name)->update(['per_checkin' => $qty]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('room_units');
        Schema::dropIfExists('inventory_movements');
        Schema::table('inventory_items', function (Blueprint $t) {
            $t->dropColumn('per_checkin');
        });
    }
};
