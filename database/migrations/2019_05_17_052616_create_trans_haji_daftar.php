<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransHajiDaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_haji_daftar', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->required();
            $table->string('name')->required();
            $table->integer('id_paket')->required();
            $table->integer('id_jadwal')->required();
            $table->string('nik')->nullable();
            $table->string('kk')->nullable();
            $table->string('keterangan_penyakit')->nullable();
            $table->string('status')->default(1)->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_haji_daftar', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();

            $table->integer('user_id')->required();
            $table->string('name')->required();
            $table->integer('id_paket')->required();
            $table->integer('id_jadwal')->required();
            $table->string('nik')->nullable();
            $table->string('kk')->nullable();
            $table->string('keterangan_penyakit')->nullable();
            $table->string('status')->default(1)->nullable();

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
        Schema::dropIfExists('log_trans_haji_daftar');
        Schema::dropIfExists('trans_haji_daftar');
    }
}
