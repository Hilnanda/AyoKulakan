<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefMasterKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_kategori_barang', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nama')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_kategori_barang_sub', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id')->on('ref_kategori_barang')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nama')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_kategori_barang_child', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_sub_kategori')->unsigned();
            $table->foreign('id_sub_kategori')->references('id')->on('ref_kategori_barang_sub')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nama')->nullable();

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
        Schema::dropIfExists('ref_kategori_barang_child');
        Schema::dropIfExists('ref_kategori_barang_sub');
        Schema::dropIfExists('ref_kategori_barang');
        //
    }
}
