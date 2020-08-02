<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeOnTransRental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_rental', function (Blueprint $table) {
            $table->string('unit_tersewa')->nullable();
        });

        Schema::table('trans_rental', function (Blueprint $table) {
            $table->string('unit_tersewa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_rental', function (Blueprint $table) {
            $table->dropColumn(['unit_tersewa']);
        });

        Schema::table('trans_rental', function (Blueprint $table) {
            $table->dropColumn(['unit_tersewa']);
        });
    }
}
