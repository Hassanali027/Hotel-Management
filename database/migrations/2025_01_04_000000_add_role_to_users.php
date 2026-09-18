<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $t) {
            $t->string('role')->default('staff')->after('email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $t) {
            $t->dropColumn('role');
        });
    }
}
