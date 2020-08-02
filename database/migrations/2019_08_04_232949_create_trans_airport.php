<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransAirport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_airport', function (Blueprint $table) {
            $table->increments('id');
            $table->string('airport_name')->nullable();
            $table->string('airport_code')->nullable();
            $table->string('location_name')->nullable();
            $table->string('country_id')->nullable();
            $table->string('country_name')->nullable();
        
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
        Schema::dropIfExists('ref_airport');
        //
    }
}
