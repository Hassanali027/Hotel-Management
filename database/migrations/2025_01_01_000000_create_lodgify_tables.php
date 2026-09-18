<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLodgifyTables extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('status')->default('available'); // occupied / available
            $t->string('size')->nullable();
            $t->string('bed')->nullable();
            $t->string('guests')->nullable();
            $t->text('description')->nullable();
            $t->unsignedInteger('availability_used')->default(0);
            $t->unsignedInteger('availability_total')->default(0);
            $t->unsignedInteger('price')->default(0);
            $t->string('image')->nullable();
            $t->boolean('is_featured')->default(false);
            $t->json('features')->nullable();
            $t->json('facilities')->nullable();
            $t->json('amenities')->nullable();
            $t->timestamps();
        });

        Schema::create('guests', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('code')->nullable();
            $t->string('phone')->nullable();
            $t->string('email')->nullable();
            $t->string('dob')->nullable();
            $t->string('gender')->nullable();
            $t->string('nationality')->nullable();
            $t->string('passport_no')->nullable();
            $t->string('membership_status')->nullable();
            $t->string('points_balance')->nullable();
            $t->string('tier_level')->nullable();
            $t->string('avatar')->nullable();
            $t->timestamps();
        });

        Schema::create('bookings', function (Blueprint $t) {
            $t->id();
            $t->string('code');
            $t->foreignId('guest_id')->nullable();
            $t->string('guest_name');
            $t->string('room_type')->nullable();
            $t->string('room_number')->nullable();
            $t->string('room_label')->nullable();
            $t->string('request')->nullable();
            $t->string('duration')->nullable();
            $t->date('check_in')->nullable();
            $t->date('check_out')->nullable();
            $t->unsignedInteger('price_per_night')->default(0);
            $t->unsignedInteger('amount')->default(0);
            $t->string('status')->default('pending');       // confirmed / pending
            $t->string('invoice_status')->default('unpaid'); // paid / unpaid
            $t->timestamps();
        });

        Schema::create('housekeeping_tasks', function (Blueprint $t) {
            $t->id();
            $t->string('room_number');
            $t->string('room_type')->nullable();
            $t->string('status')->default('needs');    // progress/ready/needs/inspect
            $t->string('priority')->default('medium'); // high/medium/low
            $t->string('floor')->nullable();
            $t->string('reservation_status')->nullable();
            $t->text('notes')->nullable();
            $t->boolean('is_checked')->default(false);
            $t->timestamps();
        });

        Schema::create('inventory_items', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('emoji')->nullable();
            $t->string('category')->nullable();
            $t->string('availability')->default('available'); // available/low/out
            $t->unsignedInteger('quantity_stock')->default(0);
            $t->unsignedInteger('quantity_reorder')->default(0);
            $t->boolean('is_checked')->default(false);
            $t->timestamps();
        });

        Schema::create('schedules', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('category')->default('event'); // training/meeting/guest/maintenance/event
            $t->date('date');
            $t->string('start_time')->nullable();
            $t->string('end_time')->nullable();
            $t->timestamps();
        });

        Schema::create('expenses', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('category')->nullable();
            $t->unsignedInteger('quantity')->default(1);
            $t->unsignedInteger('amount')->default(0);
            $t->date('date')->nullable();
            $t->string('status')->default('completed');
            $t->timestamps();
        });

        Schema::create('concierges', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('code')->nullable();
            $t->string('position')->nullable();
            $t->string('schedule_days')->nullable();
            $t->string('schedule_time')->nullable();
            $t->string('contact')->nullable();
            $t->string('email')->nullable();
            $t->string('status')->default('active');
            $t->timestamps();
        });

        Schema::create('reviews', function (Blueprint $t) {
            $t->id();
            $t->string('customer_name');
            $t->string('avatar')->nullable();
            $t->unsignedTinyInteger('rating')->default(5);
            $t->string('date')->nullable();
            $t->text('text')->nullable();
            $t->timestamps();
        });

        Schema::create('tasks', function (Blueprint $t) {
            $t->id();
            $t->string('date')->nullable();
            $t->string('title');
            $t->boolean('highlighted')->default(false);
            $t->boolean('done')->default(false);
            $t->timestamps();
        });

        Schema::create('activities', function (Blueprint $t) {
            $t->id();
            $t->string('time')->nullable();
            $t->string('title');
            $t->text('description')->nullable();
            $t->string('icon')->default('lime');
            $t->timestamps();
        });
    }

    public function down()
    {
        foreach (['rooms','guests','bookings','housekeeping_tasks','inventory_items','schedules','expenses','concierges','reviews','tasks','activities'] as $table) {
            Schema::dropIfExists($table);
        }
    }
}
