<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransKakiLima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_kaki_lima', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            
            $table->string('name')->nullable();
            $table->string('type_usaha')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            
            $table->string('last_active')->nullable();

            $table->string('status')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_kaki_lima', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();
            
            $table->integer('user_id')->unsigned();
            
            $table->string('name')->nullable();
            $table->string('type_usaha')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            
            $table->string('last_active')->nullable();

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
        Schema::dropIfExists('log_trans_kaki_lima');
        Schema::dropIfExists('trans_kaki_lima');
    }
}
