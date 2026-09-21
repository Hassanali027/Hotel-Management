<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('final_payment_amount')->default(0)->after('advance_amount');
            $table->timestamp('final_payment_paid_at')->nullable()->after('final_payment_amount');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['final_payment_amount', 'final_payment_paid_at']);
        });
    }
};
