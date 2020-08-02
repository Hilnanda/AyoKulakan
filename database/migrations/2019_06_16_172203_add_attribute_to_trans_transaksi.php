<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeToTransTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->dropForeign(['id_barang']);
            $table->string('ppob_pelanggan')->nullable();
            $table->string('ppob_server')->nullable();
            $table->string('ppob_type')->nullable();
           
        });

        Schema::table('log_trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->string('ppob_pelanggan')->nullable();
            $table->string('ppob_server')->nullable();
            $table->string('ppob_type')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->foreign('id_barang')->references('id')->on('trans_lapak_barang')->onDelete('no action')->onUpdate('no action');
            $table->dropColumn('ppob_pelanggan');
            $table->dropColumn('ppob_server');
            $table->dropColumn('ppob_type');
        });

        Schema::table('log_trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->dropColumn('ppob_pelanggan');
            $table->dropColumn('ppob_server');
            $table->dropColumn('ppob_type');
        });

    }
}
