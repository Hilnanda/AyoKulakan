<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLapakAndBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_lapak', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nama_lapak')->nullable();
            $table->string('deskripsi_lapak')->nullable();
            $table->string('alamat_lapak')->nullable();
            $table->string('phone')->nullable();
            $table->string('last_active')->nullable();
            $table->integer('id_negara')->unsigned();
            $table->integer('id_provinsi')->unsigned();
            $table->integer('id_kota')->unsigned();
            $table->integer('id_kecamatan')->unsigned();
            $table->string('kode_pos')->nullable();
            $table->longText('deskripsi')->nullable();
            
            $table->foreign('id_negara')->references('id')->on('ref_wilayah_negara')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_provinsi')->references('id')->on('ref_wilayah_provinsi')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_kota')->references('id')->on('ref_wilayah_kota')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_kecamatan')->references('id')->on('ref_wilayah_kecamatan')->onUpdate('no action')->onDelete('no action');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_lapak', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_trans')->unsigned()->nullable();
            $table->string('nama_lapak')->nullable();
            $table->string('deskripsi_lapak')->nullable();
            $table->string('alamat_lapak')->nullable();
            $table->string('phone')->nullable();
            $table->string('last_active')->nullable();
            $table->integer('id_negara')->unsigned();
            $table->integer('id_provinsi')->unsigned();
            $table->integer('id_kota')->unsigned();
            $table->integer('id_kecamatan')->unsigned();
            $table->string('kode_pos')->nullable();
            $table->longText('deskripsi')->nullable();
            

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('trans_lapak_barang', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_trans_lapak')->unsigned();
            $table->string('nama_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('satuan_barang')->nullable();
            $table->string('berat_barang')->nullable();
            $table->string('harga_barang')->nullable();
            $table->integer('stock_barang')->nullable();
            $table->integer('barang_terjual')->nullable();
            $table->integer('minimum_pembelian')->nullable();
            $table->string('kondisi_barang')->nullable();
            $table->string('merek')->nullable();
            $table->string('expired')->nullable();
            $table->string('status_barang')->nullable();
            $table->string('attribut_barang')->nullable();

            $table->integer('id_kategori')->unsigned()->nullable();
            $table->integer('id_sub_kategori')->unsigned()->nullable();
            $table->integer('id_child_kategori')->unsigned()->nullable();

            $table->foreign('id_kategori')->references('id')->on('ref_kategori_barang')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_sub_kategori')->references('id')->on('ref_kategori_barang_sub')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_child_kategori')->references('id')->on('ref_kategori_barang_child')->onUpdate('no action')->onDelete('no action');

            $table->foreign('id_trans_lapak')->references('id')->on('trans_lapak')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_lapak_barang', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_trans')->unsigned();
            $table->integer('id_trans_lapak')->unsigned();
            $table->string('nama_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('satuan_barang')->nullable();
            $table->string('berat_barang')->nullable();
            $table->string('harga_barang')->nullable();
            $table->integer('stock_barang')->nullable();
            $table->integer('barang_terjual')->nullable();
            $table->integer('minimum_pembelian')->nullable();
            $table->string('kondisi_barang')->nullable();
            $table->string('merek')->nullable();
            $table->string('expired')->nullable();
            $table->string('status_barang')->nullable();
            $table->string('attribut_barang')->nullable();

            $table->integer('id_kategori')->unsigned()->nullable();
            $table->integer('id_sub_kategori')->unsigned()->nullable();
            $table->integer('id_child_kategori')->unsigned()->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        // Schema::create('trans_lapak_kategori_barang', function (Blueprint $table) {
        //     $table->increments('id');

        //     $table->integer('id_trans_barang')->unsigned();
        //     $table->integer('id_kategori')->unsigned()->nullable();
        //     $table->integer('id_sub_kategori')->unsigned()->nullable();
        //     $table->integer('id_child_kategori')->unsigned()->nullable();

        //     $table->foreign('id_trans_barang')->references('id')->on('trans_lapak_barang')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('id_kategori')->references('id')->on('ref_kategori_barang')->onUpdate('no action')->onDelete('no action');
        //     $table->foreign('id_sub_kategori')->references('id')->on('ref_kategori_barang_sub')->onUpdate('no action')->onDelete('no action');
        //     $table->foreign('id_child_kategori')->references('id')->on('ref_kategori_barang_child')->onUpdate('no action')->onDelete('no action');
            
        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();

        //     $table->nullableTimestamps();
        // });

        // Schema::create('log_trans_kategori_barang', function (Blueprint $table) {
        //     $table->increments('id');

        //     $table->integer('id_trans')->unsigned();
        //     $table->integer('id_trans_barang')->unsigned();
        //     $table->integer('id_kategori')->unsigned()->nullable();
        //     $table->integer('id_sub_kategori')->unsigned()->nullable();
        //     $table->integer('id_child_kategori')->unsigned()->nullable();
            

        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();

        //     $table->nullableTimestamps();
        // });

        // Schema::create('ref_label_barang', function (Blueprint $table) {
        //     $table->increments('id');

        //     $table->string('label')->nullable();

        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();

        //     $table->nullableTimestamps();
        // });

        // Schema::create('trans_lapak_label_barang', function (Blueprint $table) {
        //     $table->increments('id');

        //     $table->integer('id_trans_barang')->unsigned();
        //     $table->integer('id_label')->unsigned();

        //     $table->foreign('id_trans_barang')->references('id')->on('trans_lapak_barang')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('id_label')->references('id')->on('ref_label_barang')->onUpdate('no action')->onDelete('no action');
            
        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();

        //     $table->nullableTimestamps();
        // });

        // Schema::create('log_trans_label_barang', function (Blueprint $table) {
        //     $table->increments('id');

        //    $table->integer('id_trans_barang')->unsigned();
        //     $table->integer('id_label')->unsigned();
            

        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();

        //     $table->nullableTimestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('log_trans_label_barang');
        // Schema::dropIfExists('trans_lapak_label_barang');
        // Schema::dropIfExists('ref_label_barang');
        Schema::dropIfExists('log_trans_kategori_barang');
        Schema::dropIfExists('trans_lapak_kategori_barang');
        Schema::dropIfExists('log_trans_lapak_barang');
        Schema::dropIfExists('trans_lapak_barang');
        Schema::dropIfExists('log_trans_lapak');
        Schema::dropIfExists('trans_lapak');
    }
}
