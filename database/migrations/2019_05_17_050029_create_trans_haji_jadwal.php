<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransHajiJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_haji_jadwal', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul')->required();
            $table->string('tgl_berangkat')->required();
            $table->string('tgl_pulang')->required();
            $table->integer('total_hari')->required();
            $table->string('keterangan')->nullable();
            $table->double('harga')->nullable();
            $table->string('status')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();

            $table->string('judul')->required();
            $table->string('tgl_berangkat')->required();
            $table->string('tgl_pulang')->required();
            $table->integer('total_hari')->required();
            $table->string('keterangan')->nullable();
            $table->double('harga')->nullable();
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
        Schema::dropIfExists('log_trans_haji_jadwal');
        Schema::dropIfExists('trans_haji_jadwal');
    }
}
