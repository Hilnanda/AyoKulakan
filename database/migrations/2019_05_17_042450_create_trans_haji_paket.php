<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransHajiPaket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_haji_paket', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type_paket')->required();
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_haji_paket', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();

            $table->string('type_paket')->required();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('log_trans_haji_paket');
        Schema::dropIfExists('trans_haji_paket');
    }
}
