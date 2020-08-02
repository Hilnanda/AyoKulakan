<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('notification_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->unsigned();
            $table->string('judul')->nullable();
            $table->longText('message')->nullable();
            $table->string('user_id')->nullable();
            $table->string('status')->nullable();
            $table->string('review')->nullable();
           
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('trans_id')->references('id')->on('trans_ampas_transaksi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('notification_feedback');
    }
}
