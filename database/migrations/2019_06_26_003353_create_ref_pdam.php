<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefPdam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_ppob_pdam_provider', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('fee')->nullable();
            $table->string('komisi')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('province')->nullable();
            
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
        Schema::dropIfExists('ref_ppob_pulsa_provider');
    }
}
