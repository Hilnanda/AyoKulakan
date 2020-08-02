<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefAplikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_aplikasi_tentang', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_aplikasi_panduan', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('kategori')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_aplikasi_sosial', function (Blueprint $table) {
            $table->increments('id');

            $table->string('link')->nullable();
            $table->string('sosial_media')->nullable();

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
        Schema::dropIfExists('ref_aplikasi_sosial');
        Schema::dropIfExists('ref_aplikasi_panduan');
        Schema::dropIfExists('ref_aplikasi_tentang');
        //
    }
}
