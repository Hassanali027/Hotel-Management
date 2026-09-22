<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Per-category scores so the rating bars are calculated from real reviews.
        Schema::table('reviews', function (Blueprint $t) {
            foreach (['facilities', 'cleanliness', 'services', 'comfort', 'location'] as $c) {
                $t->unsignedTinyInteger($c)->nullable()->after('rating');
            }
        });
        // Where the booking came from, for the "Booking by Platform" chart.
        Schema::table('bookings', function (Blueprint $t) {
            $t->string('source')->default('Direct Booking')->after('guests');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $t) {
            $t->dropColumn(['facilities', 'cleanliness', 'services', 'comfort', 'location']);
        });
        Schema::table('bookings', function (Blueprint $t) {
            $t->dropColumn('source');
        });
    }
};
