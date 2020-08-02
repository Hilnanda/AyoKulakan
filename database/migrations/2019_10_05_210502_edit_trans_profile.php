<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTransProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('sys_users', function (Blueprint $table) {
            $table->dropColumn(['hp']);
        });

        Schema::table('sys_users', function (Blueprint $table) {
            $table->string('hp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_users', function (Blueprint $table) {
            $table->dropColumn(['hp']);
        });

        Schema::table('sys_users', function (Blueprint $table) {
            $table->string('hp')->nullable();
        });
    }
}
