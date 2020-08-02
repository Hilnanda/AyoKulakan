<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributSysUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_users', function (Blueprint $table) {
            $table->integer('id_negara')->unsigned()->nullable();
            $table->integer('id_provinsi')->unsigned()->nullable();
            $table->integer('id_kota')->unsigned()->nullable();
            $table->integer('id_kecamatan')->unsigned()->nullable();
            $table->string('kode_pos')->nullable();

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
        Schema::table('sys_users', function (Blueprint $table) {
            $table->dropForeign(['id_kecamatan']);
            $table->dropForeign(['id_kota']);
            $table->dropForeign(['id_provinsi']);
            $table->dropForeign(['id_negara']);

            $table->dropColumn(['id_negara','id_provinsi','id_kota','id_kecamatan','kode_pos']);
            
        });
    }
}
