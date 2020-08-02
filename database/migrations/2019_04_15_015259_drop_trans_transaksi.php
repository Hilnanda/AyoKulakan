<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTransTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('log_trans_ampas_transaksi_barang_detail');
        Schema::dropIfExists('trans_ampas_transaksi_barang_detail');

        Schema::dropIfExists('log_trans_ampas_transaksi_detail');
        Schema::dropIfExists('trans_ampas_transaksi_detail');

        Schema::dropIfExists('log_trans_ampas_transaksi');
        Schema::dropIfExists('trans_ampas_transaksi');

         Schema::create('trans_ampas_transaksi', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->string('payment_type')->nullable();
            $table->string('order_id')->unique();
            $table->string('snap_token')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('signature_key')->nullable();

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
            $table->string('snap_token')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('signature_key')->nullable();

            $table->string('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

           
        });

        Schema::create('trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_transaksi_id')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->string('total_harga')->nullable();
            // $table->integer('trans_fav_id')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('trans_transaksi_id')->references('id')->on('trans_ampas_transaksi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_barang')->references('id')->on('trans_lapak_barang')->onDelete('no action')->onUpdate('no action');
        });

        Schema::create('log_trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_transaksi_id')->nullable();

            $table->integer('trans_id')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->string('total_harga')->nullable();
            // $table->integer('trans_fav_id')->nullable();
            
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

        Schema::dropIfExists('log_trans_ampas_transaksi');
        Schema::dropIfExists('trans_ampas_transaksi');
    }
}
