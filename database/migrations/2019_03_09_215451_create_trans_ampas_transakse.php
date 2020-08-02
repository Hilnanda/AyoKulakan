<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransAmpasTransakse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_ampas_transaksi', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->string('payment_type')->nullable();
            $table->string('order_id')->unique();
            $table->string('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

            $table->foreign('user_id')->references('id')->on('sys_users')->onDelete('no action')->onUpdate('no action');

        });

        Schema::create('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('payment_type')->nullable();
            $table->string('order_id')->nullable();
            $table->string('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

           
        });

        Schema::create('trans_ampas_transaksi_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('transaksi_id')->unsigned();
            $table->string('total_pembayaran')->nullable();
            $table->string('va_number')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('bank')->nullable();
            $table->string('kode_bank')->nullable();
            $table->string('nama_pengirim')->nullable();
            $table->string('nama_penerima')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('transaksi_id')->references('id')->on('trans_ampas_transaksi')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('log_trans_ampas_transaksi_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->nullable();
            $table->integer('transaksi_id')->unsigned();
            $table->string('total_pembayaran')->nullable();
            $table->string('va_number')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('bank')->nullable();
            $table->string('kode_bank')->nullable();
            $table->string('nama_pengirim')->nullable();
            $table->string('nama_penerima')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('transaksi_detail_id')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('transaksi_detail_id')->references('id')->on('trans_ampas_transaksi_detail')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_barang')->references('id')->on('trans_lapak_barang')->onDelete('no action')->onUpdate('no action');
        });

        Schema::create('log_trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->nullable();

            $table->integer('transaksi_detail_id')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();

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
        Schema::dropIfExists('log_trans_ampas_transaksi_barang_detail');
        Schema::dropIfExists('trans_ampas_transaksi_barang_detail');

        Schema::dropIfExists('log_trans_ampas_transaksi_detail');
        Schema::dropIfExists('trans_ampas_transaksi_detail');

         Schema::dropIfExists('log_trans_ampas_transaksi');
        Schema::dropIfExists('trans_ampas_transaksi');
    }
}
