<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyingNamaOnrefKategoriBarangSub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_kategori_barang_sub', function (Blueprint $table) {
            $table->renameColumn('nama','sub_nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_kategori_barang_sub', function (Blueprint $table) {
            $table->renameColumn('sub_nama','nama');
        });
    }
}
