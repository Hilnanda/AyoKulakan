<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefDarmaHotel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_darma_hotel_negara', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('status')->nullable()->default(1)->comment('1 : active, 2 : non active, 3: tolak');
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_darma_hotel_kota', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_negara')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('status')->nullable()->default(1)->comment('1 : active, 2 : non active, 3: tolak');
            
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
        Schema::dropIfExists('ref_darma_hotel_kota');
        Schema::dropIfExists('ref_darma_hotel_negara');
    }
}
