<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransRental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_rental', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul')->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('status')->nullable();
            $table->integer('kategori_id')->unsigned();
            $table->integer('sub_kategori_id')->unsigned()->nullable();
            $table->integer('unit')->nullable();
            $table->string('harga_sewa')->nullable();
            $table->string('waktu_sewa')->nullable();
            $table->string('rating')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

            $table->foreign('kategori_id')->references('id')->on('ref_kategori_rental');
            $table->foreign('sub_kategori_id')->references('id')->on('ref_sub_kategori_rental')->onDelete('no action')->onUpdate('no action');
        });

        Schema::create('log_trans_rental', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();

            $table->string('judul')->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('status')->nullable();
            $table->integer('kategori_id')->nullable();
            $table->integer('sub_kategori_id')->nullable();
            $table->integer('unit')->nullable();
            $table->string('harga_sewa')->nullable();
            $table->string('waktu_sewa')->nullable();
            $table->string('rating')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::table('trans_favorit_barang', function (Blueprint $table) {
            $table->dropForeign(['id_barang']);
            $table->string('form_type')->nullable();
            $table->integer('form_id')->nullable();
        });

        Schema::table('log_trans_favorit_barang', function (Blueprint $table) {
            $table->string('form_type')->nullable();
            $table->integer('form_id')->nullable();
        });

        Schema::table('trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->string('form_type')->nullable();
            $table->integer('form_id')->nullable();
        });

        Schema::table('log_trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->string('form_type')->nullable();
            $table->integer('form_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_rental');
        Schema::dropIfExists('log_trans_rental');
    }
}
