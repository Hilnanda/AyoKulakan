<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysMail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_email_deadline', function (Blueprint $table) {
            $table->increments('id');

            $table->string('target_id')->nullable();
            $table->string('target_type')->nullable();

            $table->date('tanggal')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('sys_email_jobs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('queue')->nullable();
            $table->longText('payload')->nullable();

            $table->integer('attempts')->nullable();
            $table->string('reserved_at')->nullable();
            $table->string('available_at')->nullable();
            
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
        Schema::dropIfExists('sys_email_jobs');
        Schema::dropIfExists('sys_email_deadline');
    }
}
