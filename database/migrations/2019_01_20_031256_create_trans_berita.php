<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransBerita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_berita', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul')->nullable();
            $table->string('deskripsi')->nullable();

            $table->string('status')->nullable();
            $table->string('kategori')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_berita', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul')->nullable();
            $table->string('deskripsi')->nullable();

            $table->string('status')->nullable();
            $table->string('kategori')->nullable();

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
         Schema::dropIfExists('log_trans_berita');
        Schema::dropIfExists('trans_berita');
    }
}
