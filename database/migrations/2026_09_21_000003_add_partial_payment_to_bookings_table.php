<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('partial_payment')->default(false)->after('invoice_status');
            $table->unsignedInteger('advance_amount')->default(0)->after('partial_payment');
            $table->string('advance_receipt_path')->nullable()->after('advance_amount');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['partial_payment', 'advance_amount', 'advance_receipt_path']);
        });
    }
};
