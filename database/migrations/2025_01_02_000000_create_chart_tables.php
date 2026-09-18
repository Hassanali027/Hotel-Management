<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartTables extends Migration
{
    public function up()
    {
        Schema::create('revenues', function (Blueprint $t) {
            $t->id();
            $t->string('label');
            $t->unsignedInteger('amount')->default(0);
            $t->timestamps();
        });
        Schema::create('reservation_stats', function (Blueprint $t) {
            $t->id();
            $t->string('label');
            $t->unsignedInteger('booked')->default(0);
            $t->unsignedInteger('canceled')->default(0);
            $t->timestamps();
        });
        Schema::create('platforms', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->unsignedInteger('percent')->default(0);
            $t->string('color')->default('#d2f3e4');
            $t->timestamps();
        });
        Schema::create('rating_categories', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->decimal('score', 3, 1)->default(0);
            $t->timestamps();
        });
    }

    public function down()
    {
        foreach (['revenues','reservation_stats','platforms','rating_categories'] as $t) {
            Schema::dropIfExists($t);
        }
    }
}
