<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAtrributeOnTransTransaksiAmpas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('trans_ampas_transaksi_attach', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->unsigned()->nullable();
            $table->string('filename')->nullable();
            $table->string('fileurl')->nullable();
            $table->string('form_id')->nullable();
            $table->string('form_type')->nullable();
            $table->string('review')->nullable();
           
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('trans_id')->references('id')->on('trans_ampas_transaksi')->onDelete('no action')->onUpdate('no action');
        });

        Schema::create('log_trans_ampas_transaksi_attach', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_trans_id')->unsigned();
            $table->integer('trans_id')->nullable();
            $table->string('filename')->nullable();
            $table->string('fileurl')->nullable();
            $table->string('form_id')->nullable();
            $table->string('form_type')->nullable();
            $table->string('review')->nullable();
           
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

         Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('transaction_status')->default('-')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('store')->nullable();
            $table->string('payment_code')->nullable();
        });

        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('transaction_status')->default('-')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('store')->nullable();
            $table->string('payment_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['transaction_status']);
            $table->dropColumn(['fraud_status']);
            $table->dropColumn(['store']);
            $table->dropColumn(['payment_code']);
        });

        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['transaction_status']);
            $table->dropColumn(['fraud_status']);
            $table->dropColumn(['store']);
            $table->dropColumn(['payment_code']);
        });

        Schema::dropIfExists('log_trans_ampas_transaksi_attach');
       Schema::dropIfExists('trans_ampas_transaksi_attach');
    }
}
