<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_chat', function (Blueprint $table) {
            $table->increments('id');

            // $table->string('title')->nullable();
            // $table->longText('chat')->nullable();
            
            // $table->integer('id_barang')->nullable();
            $table->integer('id_lapak')->nullable();
            $table->integer('id_user_chat_to')->nullable();

            // $table->string('status')->nullable();
            $table->string('form_type')->nullable();
            $table->string('form_id')->nullable();
            
            $table->string('status')->default(1)->comment('1: Not Read, 2: Read')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('trans_chat_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trans_id')->unsigned();

            $table->longText('chat')->nullable();

            $table->string('status')->nullable();
            
            $table->longText('boot_chat')->nullable();

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
        Schema::dropIfExists('trans_chat');
        Schema::dropIfExists('trans_chat_detail');
        
    }
}
