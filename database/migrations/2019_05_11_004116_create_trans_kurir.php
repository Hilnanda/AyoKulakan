<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransKurir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_kurir', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            
            $table->string('nik')->nullable();
            $table->string('kendaraan')->comment('1: Motor, 2: Mobil, 3: Mobil & Motor')->nullable();
            $table->string('sim')->comment('1: A, 2: B, 3: C, 4: A & B & C, 5: A & B, 6: A & C, 7: B & C')->nullable();
            $table->string('km')->nullable();
            $table->string('kg')->nullable();
            $table->string('rating')->nullable();
            
            $table->string('status')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

        });

        Schema::create('log_trans_kurir', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();

            $table->integer('user_id')->unsigned();
            
            $table->string('nik')->nullable();
            $table->string('kendaraan')->comment('1: Motor, 2: Mobil, 3: Mobil & Motor')->nullable();
            $table->string('sim')->comment('1: A, 2: B, 3: C, 4: A & B & C, 5: A & B, 6: A & C, 7: B & C')->nullable();
            $table->string('km')->nullable();
            $table->string('kg')->nullable();
            $table->string('rating')->nullable();
            
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
        Schema::dropIfExists('log_trans_kurir');
        Schema::dropIfExists('trans_kurir');
        //
    }
}
