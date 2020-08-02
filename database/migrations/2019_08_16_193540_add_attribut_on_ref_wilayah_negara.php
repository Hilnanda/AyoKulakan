<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributOnRefWilayahNegara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_wilayah_negara', function (Blueprint $table) {
            $table->string('area_id')->nullable();
            $table->string('area_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_wilayah_negara', function (Blueprint $table) {
            $table->dropColumn(['area_id']);
            $table->dropColumn(['area_code']);
        });
    }
}
