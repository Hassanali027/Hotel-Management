<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Restaurant sales. One order is one bill; its lines are free-typed (name, quantity,
 * unit price) because the kitchen has no fixed menu. Each line keeps the price it was
 * sold at, so the bill never changes after the fact.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('kitchen_orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('customer_name')->nullable();
            // walk_in: outside customer. room_guest: staying guest, room noted for reference.
            // complimentary: staff meal or on the house; recorded but never counted as sales.
            $table->string('type')->default('walk_in');
            $table->string('room_number')->nullable();
            $table->unsignedInteger('total')->default(0);
            $table->string('payment_status')->default('paid');
            $table->string('note')->nullable();
            $table->date('order_date');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('kitchen_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kitchen_order_id');
            $table->string('name');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('line_total')->default(0);
            $table->timestamps();
            $table->foreign('kitchen_order_id')->references('id')->on('kitchen_orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitchen_order_items');
        Schema::dropIfExists('kitchen_orders');
    }
};
