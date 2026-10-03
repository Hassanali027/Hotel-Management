<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Optional proof of payment for a restaurant order: a transfer screenshot, card slip or PDF. */
return new class extends Migration
{
    public function up()
    {
        Schema::table('kitchen_orders', function (Blueprint $table) {
            $table->string('payment_proof_path')->nullable()->after('payment_status');
        });
    }

    public function down()
    {
        Schema::table('kitchen_orders', function (Blueprint $table) {
            $table->dropColumn('payment_proof_path');
        });
    }
};
