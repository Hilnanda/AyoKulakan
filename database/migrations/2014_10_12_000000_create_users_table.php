<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('password', 60);
            $table->string('login_token')->nullable();
            $table->dateTime('last_activity');
            $table->string('nama');
            $table->integer('status');
            $table->longText('alamat')->nullable();
            $table->integer('hp')->nullable();
            $table->string('gender')->nullable();
            $table->rememberToken();
            $table->ipAddress('ipAddress')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sys_users');
    }
}
