<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGalleryToRooms extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $t) {
            $t->json('gallery')->nullable()->after('image');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $t) {
            $t->dropColumn('gallery');
        });
    }
}
