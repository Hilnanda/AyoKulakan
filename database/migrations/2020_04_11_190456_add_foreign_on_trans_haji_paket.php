<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignOnTransHajiPaket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->integer('paket_id')->nullable();
        });
        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->integer('paket_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['paket_id']);
        });
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['paket_id']);
        });
    }
}
