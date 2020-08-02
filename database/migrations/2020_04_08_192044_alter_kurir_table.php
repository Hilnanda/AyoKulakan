<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKurirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_kurir', function (Blueprint $table) {
            $table->string('namadepan')->nullable();
            $table->string('namabelakang')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('kota')->nullable();
            $table->string('tanggalLahir')->nullable();
            $table->string('fotoSim')->nullable();
            $table->string('fotoKtp')->nullable();
            $table->string('swafoto')->nullable();
            $table->string('fotocopyKK')->nullable();
            $table->string('modelKendaraan')->nullable();
            $table->integer('tahunKendaraan')->nullable();
            $table->string('NomorPolisiKendaraan')->nullable();
            $table->string('merekHandphone')->nullable();
            $table->string('smartphoneMinRAM')->nullable();
            $table->string('pekerjaanTetap')->nullable();
            $table->string('kerjaPerusahaan')->nullable();
            $table->string('kerjaMinimal')->nullable();

            $table->integer('id_negara')->unsigned()->nullable();
            $table->integer('id_provinsi')->unsigned()->nullable();
            $table->integer('id_kota')->unsigned()->nullable();
            $table->integer('id_kecamatan')->unsigned()->nullable();

            $table->foreign('id_negara')->references('id')->on('ref_wilayah_negara')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_provinsi')->references('id')->on('ref_wilayah_provinsi')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_kota')->references('id')->on('ref_wilayah_kota')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_kecamatan')->references('id')->on('ref_wilayah_kecamatan')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('log_trans_kurir', function (Blueprint $table) {
            $table->string('namadepan')->nullable();
            $table->string('namabelakang')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('kota')->nullable();
            $table->string('tanggalLahir')->nullable();
            $table->string('fotoSim')->nullable();
            $table->string('fotoKtp')->nullable();
            $table->string('swafoto')->nullable();
            $table->string('fotocopyKK')->nullable();
            $table->string('modelKendaraan')->nullable();
            $table->integer('tahunKendaraan')->nullable();
            $table->string('NomorPolisiKendaraan')->nullable();
            $table->string('merekHandphone')->nullable();
            $table->string('smartphoneMinRAM')->nullable();
            $table->string('pekerjaanTetap')->nullable();
            $table->string('kerjaPerusahaan')->nullable();
            $table->string('kerjaMinimal')->nullable();

            $table->integer('id_negara')->unsigned()->nullable();
            $table->integer('id_provinsi')->unsigned()->nullable();
            $table->integer('id_kota')->unsigned()->nullable();
            $table->integer('id_kecamatan')->unsigned()->nullable();

            $table->foreign('id_negara')->references('id')->on('ref_wilayah_negara')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_provinsi')->references('id')->on('ref_wilayah_provinsi')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_kota')->references('id')->on('ref_wilayah_kota')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_kecamatan')->references('id')->on('ref_wilayah_kecamatan')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_kurir', function (Blueprint $table) {
            $table->dropForeign(['id_kecamatan']);
            $table->dropForeign(['id_kota']);
            $table->dropForeign(['id_provinsi']);
            $table->dropForeign(['id_negara']);

            $table->dropColumn(['id_negara', 'id_provinsi', 'id_kota', 'id_kecamatan']);

            $table->dropColumn('namadepan')->nullable();
            $table->dropColumn('namabelakang')->nullable();
            $table->dropColumn('email')->nullable();
            $table->dropColumn('phoneNumber')->nullable();
            $table->dropColumn('kota')->nullable();
            $table->dropColumn('tanggalLahir')->nullable();
            $table->dropColumn('fotoSim')->nullable();
            $table->dropColumn('fotoKtp')->nullable();
            $table->dropColumn('swafoto')->nullable();
            $table->dropColumn('fotocopyKK')->nullable();
            $table->dropColumn('modelKendaraan')->nullable();
            $table->dropColumn('tahunKendaraan')->nullable();
            $table->dropColumn('NomorPolisiKendaraan')->nullable();
            $table->dropColumn('merekHandphone')->nullable();
            $table->dropColumn('smartphoneMinRAM')->nullable();
            $table->dropColumn('pekerjaanTetap')->nullable();
            $table->dropColumn('kerjaPerusahaan')->nullable();
            $table->dropColumn('kerjaMinimal')->nullable();
        });

        Schema::table('log_trans_kurir', function (Blueprint $table) {
            $table->dropForeign(['id_kecamatan']);
            $table->dropForeign(['id_kota']);
            $table->dropForeign(['id_provinsi']);
            $table->dropForeign(['id_negara']);

            $table->dropColumn(['id_negara', 'id_provinsi', 'id_kota', 'id_kecamatan']);

            $table->dropColumn('namadepan')->nullable();
            $table->dropColumn('namabelakang')->nullable();
            $table->dropColumn('email')->nullable();
            $table->dropColumn('phoneNumber')->nullable();
            $table->dropColumn('kota')->nullable();
            $table->dropColumn('tanggalLahir')->nullable();
            $table->dropColumn('fotoSim')->nullable();
            $table->dropColumn('fotoKtp')->nullable();
            $table->dropColumn('swafoto')->nullable();
            $table->dropColumn('fotocopyKK')->nullable();
            $table->dropColumn('modelKendaraan')->nullable();
            $table->dropColumn('tahunKendaraan')->nullable();
            $table->dropColumn('NomorPolisiKendaraan')->nullable();
            $table->dropColumn('merekHandphone')->nullable();
            $table->dropColumn('smartphoneMinRAM')->nullable();
            $table->dropColumn('pekerjaanTetap')->nullable();
            $table->dropColumn('kerjaPerusahaan')->nullable();
            $table->dropColumn('kerjaMinimal')->nullable();
        });
    }
}
