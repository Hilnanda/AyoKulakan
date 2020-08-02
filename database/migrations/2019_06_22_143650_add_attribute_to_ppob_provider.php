<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeToPpobProvider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_ppob_pulsa_provider', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->longText('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_ppob_pulsa_provider', function (Blueprint $table) {
            $table->dropColumn(['type']);
            $table->dropColumn(['deskripsi']);
        });
    }
}
