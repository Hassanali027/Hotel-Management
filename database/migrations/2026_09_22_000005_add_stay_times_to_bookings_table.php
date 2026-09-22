<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * check_in and check_out hold the booked dates. These hold what actually happened:
 * the moment the guest was checked in and out at the desk, and the number of nights
 * the booking is billed for once the stay is closed.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->timestamp('checked_in_at')->nullable()->after('check_out');
            $table->timestamp('checked_out_at')->nullable()->after('checked_in_at');
            $table->unsignedSmallInteger('billed_nights')->nullable()->after('checked_out_at');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['checked_in_at', 'checked_out_at', 'billed_nights']);
        });
    }
};
