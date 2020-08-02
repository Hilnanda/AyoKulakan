<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeOnHajiDaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_haji_daftar', function (Blueprint $table) {
            $table->string('passport')->nullable();
        });

        Schema::table('log_trans_haji_daftar', function (Blueprint $table) {
            $table->string('passport')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_haji_daftar', function (Blueprint $table) {
            $table->dropColumn(['passport']);
        });

        Schema::table('log_trans_haji_daftar', function (Blueprint $table) {
            $table->dropColumn(['passport']);
        });
    }
}
