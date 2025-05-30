<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIsRoleFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_role');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_role')->nullable();
        });
    }
}
