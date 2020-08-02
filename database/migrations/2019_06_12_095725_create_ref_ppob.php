<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefPpob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_ppob_pulsa', function (Blueprint $table) {
            $table->increments('id');

            $table->string('pulsa_code')->nullable();
            $table->string('pulsa_op')->nullable();
            $table->string('pulsa_nominal')->nullable();
            $table->string('pulsa_price')->nullable();
            $table->string('pulsa_type')->nullable();
            $table->string('status')->nullable();
            $table->string('masaaktif')->nullable();
            
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
        Schema::dropIfExists('ref_ppob_pulsa');
        //
    }
}
