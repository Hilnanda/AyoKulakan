<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransRefound extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_refound', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->unsigned()->nullable();
            $table->integer('form_id')->unsigned()->nullable();
            $table->string('form_type')->nullable();
            $table->string('lapak_id')->nullable();
            
            $table->string('status')->nullable();
           
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_refound', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_trans_id')->unsigned();
            $table->integer('trans_id')->unsigned()->nullable();
            $table->integer('form_id')->unsigned()->nullable();
            $table->string('form_type')->nullable();
            $table->string('lapak_id')->nullable();
            
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
        Schema::dropIfExists('log_trans_refound');
        Schema::dropIfExists('trans_refound');
    }
}
