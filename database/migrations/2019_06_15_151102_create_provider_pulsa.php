<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderPulsa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_ppob_pulsa_provider', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('ref_ppob_pulsa_provider');
        //
    }
}
