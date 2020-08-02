<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransLikeFav extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('trans_like_favorit_barang', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->integer('status')->default(10)->nullable();

            $table->string('form_type')->nullable();
            $table->integer('form_id')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

            $table->foreign('user_id')->references('id')->on('sys_users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_barang')->references('id')->on('trans_lapak_barang')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::create('log_trans_like_favorit_barang', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->integer('status')->default(10)->nullable();

            $table->string('form_type')->nullable();
            $table->string('form_id')->nullable();

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
        Schema::dropIfExists('trans_like_favorit_barang');
        Schema::dropIfExists('log_trans_like_favorit_barang');
    }
}
