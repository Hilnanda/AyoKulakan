<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransAmpaseTransaksiPpob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_ampas_transaksi_prepaid', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_transaksi_id')->unsigned();
            $table->integer('target_id')->nullable();
            $table->string('target_type')->nullable();

            $table->integer('form_id')->nullable();
            $table->string('form_type')->nullable();

            $table->string('jml_brg')->nullable();
            $table->string('ttl_harga')->nullable();
            $table->string('pelanggan')->nullable();
            $table->string('sn')->nullable();
            $table->string('pin')->nullable();
            $table->string('rc')->nullable();
            $table->string('biaya_admin')->nullable();
            $table->string('type')->nullable();
            $table->string('server')->nullable();
            $table->string('tr_id')->nullable();

            $table->string('ref_id')->nullable();
            
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('trans_transaksi_id')->references('id')->on('trans_ampas_transaksi')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('log_trans_ampas_transaksi_prepaid', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->unsigned();
            
            $table->integer('trans_transaksi_id')->unsigned();
            $table->integer('target_id')->nullable();
            $table->string('target_type')->nullable();

            $table->integer('form_id')->nullable();
            $table->string('form_type')->nullable();

            $table->string('jml_brg')->nullable();
            $table->string('ttl_harga')->nullable();
            $table->string('pelanggan')->nullable();
            $table->string('sn')->nullable();
            $table->string('pin')->nullable();
            $table->string('rc')->nullable();
            $table->string('biaya_admin')->nullable();
            $table->string('type')->nullable();
            $table->string('server')->nullable();
            $table->string('tr_id')->nullable();

            $table->string('ref_id')->nullable();
            
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

         Schema::create('trans_ampas_transaksi_postpaid', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_transaksi_id')->unsigned();
            $table->integer('target_id')->nullable();
            $table->string('target_type')->nullable();

            $table->integer('form_id')->nullable();
            $table->string('form_type')->nullable();

            $table->string('pelanggan')->nullable();
            $table->string('tr_name')->nullable();
            $table->string('period')->nullable();
            $table->string('noref')->nullable();
            
            $table->string('jml_brg')->nullable();
            $table->string('ttl_harga')->nullable();
            $table->string('sn')->nullable();
            $table->string('pin')->nullable();
            $table->string('rc')->nullable();
            $table->string('biaya_admin')->nullable();
            $table->string('type')->nullable();
            $table->string('server')->nullable();
            $table->string('tr_id')->nullable();

            $table->string('ref_id')->nullable();
            
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('trans_transaksi_id')->references('id')->on('trans_ampas_transaksi')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('log_trans_ampas_transaksi_postpaid', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->unsigned();
            
            $table->integer('trans_transaksi_id')->unsigned();
            $table->integer('target_id')->nullable();
            $table->string('target_type')->nullable();

            $table->integer('form_id')->nullable();
            $table->string('form_type')->nullable();
            
            $table->string('pelanggan')->nullable();
            $table->string('tr_name')->nullable();
            $table->string('period')->nullable();
            $table->string('noref')->nullable();
            
            $table->string('jml_brg')->nullable();
            $table->string('ttl_harga')->nullable();
            $table->string('sn')->nullable();
            $table->string('pin')->nullable();
            $table->string('rc')->nullable();
            $table->string('biaya_admin')->nullable();
            $table->string('type')->nullable();
            $table->string('server')->nullable();
            $table->string('tr_id')->nullable();

            $table->string('ref_id')->nullable();
            
            
            
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
        Schema::dropIfExists('log_trans_ampas_transaksi_prepaid');
        Schema::dropIfExists('trans_ampas_transaksi_prepaid');

        // Schema::dropIfExists('log_trans_ampas_transaksi_postpaid');
        // Schema::dropIfExists('trans_ampas_transaksi_postpaid');
    }
}
