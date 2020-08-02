<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTransJadwalHaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['keterangan']);
        });


        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['keterangan']);
        });

        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->longText('keterangan')->nullable();
        });
       

        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->longText('keterangan')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['keterangan']);
        });


        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['keterangan']);
        });

        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->longText('keterangan')->nullable();
        });
       

        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->longText('keterangan')->nullable();
        });
    }
}
