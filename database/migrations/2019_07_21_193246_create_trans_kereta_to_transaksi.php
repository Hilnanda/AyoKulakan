<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransKeretaToTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('total_harga')->nullable();
        });
        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('total_harga')->nullable();
        });

        Schema::create('trans_ampas_transaksi_kereta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_transaksi_id')->unsigned();
            $table->integer('target_id')->nullable();
            $table->string('target_type')->nullable();

            $table->integer('form_id')->nullable();
            $table->string('form_type')->nullable();

            $table->string('org')->nullable();
            $table->string('dest')->nullable();
            $table->string('date')->nullable();
            $table->string('trainNo')->nullable();
            $table->string('kodeWagon')->nullable();
            $table->string('kelasWagon')->nullable();
            $table->string('subClass')->nullable();
            $table->string('seats')->nullable();
            $table->string('seatSelect')->nullable();
            $table->string('adult')->nullable();
            $table->string('adult_id')->nullable();
            $table->string('adult_name')->nullable();
            $table->string('adult_dob')->nullable();
            $table->string('adult_phone')->nullable();
            $table->string('infant')->nullable();
            $table->string('infant_id')->nullable();
            $table->string('infant_name')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('trans_transaksi_id')->references('id')->on('trans_ampas_transaksi')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('log_trans_ampas_transaksi_kereta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_transaksi_id')->unsigned();
            $table->integer('target_id')->nullable();
            $table->string('target_type')->nullable();

            $table->integer('form_id')->nullable();
            $table->string('form_type')->nullable();

            $table->integer('trans_id')->unsigned();
            $table->string('org')->nullable();
            $table->string('dest')->nullable();
            $table->string('date')->nullable();
            $table->string('trainNo')->nullable();
            $table->string('kodeWagon')->nullable();
            $table->string('kelasWagon')->nullable();
            $table->string('subClass')->nullable();
            $table->string('seats')->nullable();
            $table->string('seatSelect')->nullable();
            $table->string('adult')->nullable();
            $table->string('adult_id')->nullable();
            $table->string('adult_name')->nullable();
            $table->string('adult_dob')->nullable();
            $table->string('adult_phone')->nullable();
            $table->string('infant')->nullable();
            $table->string('infant_id')->nullable();
            $table->string('infant_name')->nullable();
            
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
        Schema::dropIfExists('log_trans_ampas_transaksi_kereta');
        Schema::dropIfExists('trans_ampas_transaksi_kereta');
        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['total_harga']);
        });
        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['total_harga']);
        });

    }
}
