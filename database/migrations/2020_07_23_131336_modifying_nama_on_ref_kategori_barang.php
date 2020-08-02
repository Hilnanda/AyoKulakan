<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyingNamaOnRefKategoriBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_kategori_barang', function (Blueprint $table) {
            $table->renameColumn('nama','kat_nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_kategori_barang', function (Blueprint $table) {
            $table->renameColumn('kat_nama','nama');
        });
    }
}
