<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransBeritaTerbaru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('trans_berita_terbaru', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul')->nullable();
            $table->longText('deskripsi')->nullable();

            $table->string('status')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_berita_terbaru', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();

            $table->string('judul')->nullable();
            $table->longText('deskripsi')->nullable();

            $table->string('status')->nullable();

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
        Schema::dropIfExists('log_trans_berita_terbaru');
        Schema::dropIfExists('trans_berita_terbaru');
    }
}
