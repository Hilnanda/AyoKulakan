<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefKategoriRental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_kategori_rental', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nama')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        // Schema::create('log_ref_kategori_rental', function (Blueprint $table) {
        //     $table->increments('id');

        //     $table->integer('trans_id')->unsigned();

        //     $table->string('nama')->nullable();
            
        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();

        //     $table->nullableTimestamps();
        // });

        Schema::create('ref_sub_kategori_rental', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_kategori_id')->unsigned();
            $table->string('nama')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

           $table->foreign('trans_kategori_id')->references('id')->on('ref_kategori_rental')->onUpdate('cascade')->onDelete('cascade');

        });

        // Schema::create('log_ref_sub_kategori_rental', function (Blueprint $table) {
        //     $table->increments('id');

        //     $table->integer('trans_id')->unsigned();

        //     $table->integer('trans_kategori_id')->unsigned();
        //     $table->string('nama')->nullable();
            
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
        Schema::dropIfExists('log_ref_kategori_rental');
        Schema::dropIfExists('ref_kategori_rental');

        Schema::dropIfExists('log_ref_sub_kategori_rental');
        Schema::dropIfExists('ref_sub_kategori_rental');
    }
}
