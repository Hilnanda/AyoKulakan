<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransKakiLimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_kaki_lima', function (Blueprint $table) {
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('ktp');
            $table->string('swafoto');
            $table->string('skck');
            $table->string('alamat_toko');
            $table->string('negara');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('distrik');
            $table->string('kode_pos');
        });

        Schema::table('log_trans_kaki_lima', function (Blueprint $table) {
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('ktp');
            $table->string('swafoto');
            $table->string('skck');
            $table->string('alamat_toko');
            $table->string('negara');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('distrik');
            $table->string('kode_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_kaki_lima', function (Blueprint $table) {
            $table->dropColumn('nomor_telepon');
            $table->dropColumn('email');
            $table->dropColumn('ktp');
            $table->dropColumn('swafoto');
            $table->dropColumn('skck');
            $table->dropColumn('alamat_toko');
            $table->dropColumn('negara');
            $table->dropColumn('provinsi');
            $table->dropColumn('kota');
            $table->dropColumn('distrik');
            $table->dropColumn('kode_pos');
        });

        Schema::table('log_trans_kaki_lima', function (Blueprint $table) {
            $table->dropColumn('nomor_telepon');
            $table->dropColumn('email');
            $table->dropColumn('ktp');
            $table->dropColumn('swafoto');
            $table->dropColumn('skck');
            $table->dropColumn('alamat_toko');
            $table->dropColumn('negara');
            $table->dropColumn('provinsi');
            $table->dropColumn('kota');
            $table->dropColumn('distrik');
            $table->dropColumn('kode_pos');
        });
    }
}
