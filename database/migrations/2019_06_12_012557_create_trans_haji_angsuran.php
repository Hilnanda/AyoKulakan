<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransHajiAngsuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_haji_angsuran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id')->nullable();

            $table->integer('user_id')->required();
            $table->string('nama')->required();
            $table->integer('umur')->nullable();
            $table->integer('id_paket')->required();
            $table->integer('id_jadwal')->required();
            $table->string('status')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_haji_angsuran', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();
            $table->string('order_id')->nullable();

            $table->integer('user_id')->required();
            $table->string('nama')->required();
            $table->integer('umur')->nullable();
            $table->integer('id_paket')->required();
            $table->integer('id_jadwal')->required();
            $table->string('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

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
        Schema::dropIfExists('log_trans_haji_angsuran');
        Schema::dropIfExists('trans_haji_angsuran');
    }
}
