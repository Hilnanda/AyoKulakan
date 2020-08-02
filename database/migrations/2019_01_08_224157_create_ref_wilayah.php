<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefWilayah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_wilayah_negara', function (Blueprint $table) {
            $table->increments('id');

            $table->string('negara')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_wilayah_provinsi', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_negara')->unsigned();
            $table->foreign('id_negara')->references('id')->on('ref_wilayah_negara')->onDelete('cascade')->onUpdate('cascade');
            $table->string('provinsi')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_wilayah_kota', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_negara')->unsigned();
            $table->integer('id_provinsi')->unsigned();
            $table->foreign('id_provinsi')->references('id')->on('ref_wilayah_provinsi')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kota')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_wilayah_kecamatan', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_negara')->unsigned();
            $table->integer('id_provinsi')->unsigned();
            $table->integer('id_kota')->unsigned();
            $table->foreign('id_kota')->references('id')->on('ref_wilayah_kota')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kecamatan')->nullable();

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
        Schema::dropIfExists('ref_wilayah_kecamatan');
        Schema::dropIfExists('ref_wilayah_kota');
        Schema::dropIfExists('ref_wilayah_provinsi');
        Schema::dropIfExists('ref_wilayah_negara');
    }
}
