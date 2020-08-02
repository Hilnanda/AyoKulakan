<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->datetime('transaction_time')->nullable();
            $table->datetime('transaction_time_expiry')->nullable();
            $table->string('status_code')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('merchant_id')->nullable();
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
            $table->dropColumn(['transaction_time']);
            $table->dropColumn(['transaction_time_expiry']);
            $table->dropColumn(['status_code']);
            $table->dropColumn(['redirect_url']);
            $table->dropColumn(['merchant_id']);
        });
    }
}
