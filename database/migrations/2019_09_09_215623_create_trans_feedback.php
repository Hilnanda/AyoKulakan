<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_id')->nullable();
            $table->string('form_type')->nullable();
            $table->longText('message')->nullable();
            $table->string('user_id')->nullable();
            $table->string('rate')->nullable();
            $table->string('status')->nullable();
            $table->string('review')->nullable();
           
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->unsigned();
            $table->string('form_id')->nullable();
            $table->string('form_type')->nullable();
            $table->longText('message')->nullable();
            $table->string('user_id')->nullable();
            $table->string('rate')->nullable();
            $table->string('status')->nullable();
            $table->string('review')->nullable();
           
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
       Schema::dropIfExists('log_trans_feedback');
       Schema::dropIfExists('trans_feedback');
    }
}
