<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAtributeOnTransKereta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_ampas_transaksi_kereta', function (Blueprint $table) {
            $table->string('status_tujuan')->nullable();
            $table->string('trainName')->nullable();

            $table->string('bookingCode')->nullable();
            $table->string('bookTime')->nullable();
            $table->string('timeLimit')->nullable();
            $table->string('bookingDate')->nullable();
            $table->string('class')->nullable();
            
            $table->string('className')->nullable();
            $table->string('departDate')->nullable();
            $table->string('departTime')->nullable();
            $table->string('arriveDate')->nullable();
            $table->string('arriveTime')->nullable();
            $table->string('ticketPrice')->nullable();
            $table->string('discount')->nullable();
            $table->string('admin')->nullable();
            $table->string('tr_id')->nullable();

        });

        Schema::table('trans_ampas_transaksi_kereta', function (Blueprint $table) {
            $table->string('status_tujuan')->nullable();
            $table->string('trainName')->nullable();

             $table->string('bookingCode')->nullable();
            $table->string('bookTime')->nullable();
            $table->string('timeLimit')->nullable();
            $table->string('bookingDate')->nullable();
            $table->string('class')->nullable();
            
            $table->string('className')->nullable();
            $table->string('departDate')->nullable();
            $table->string('departTime')->nullable();
            $table->string('arriveDate')->nullable();
            $table->string('arriveTime')->nullable();
            $table->string('ticketPrice')->nullable();
            $table->string('discount')->nullable();
            $table->string('admin')->nullable();
            $table->string('tr_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_ampas_transaksi_kereta', function (Blueprint $table) {
            $table->dropColumn(['status_tujuan']);
            $table->dropColumn(['trainName']);
             $table->dropColumn(['bookingCode']);
            $table->dropColumn(['bookTime']);
            $table->dropColumn(['timeLimit']);
            $table->dropColumn(['bookingDate']);
            $table->dropColumn(['class']);
            
            $table->dropColumn(['className']);
            $table->dropColumn(['departDate']);
            $table->dropColumn(['departTime']);
            $table->dropColumn(['arriveDate']);
            $table->dropColumn(['arriveTime']);
            $table->dropColumn(['ticketPrice']);
            $table->dropColumn(['discount']);
            $table->dropColumn(['admin']);
            $table->dropColumn(['tr_id']);
            
        });

        Schema::table('trans_ampas_transaksi_kereta', function (Blueprint $table) {
            $table->dropColumn(['status_tujuan']);

            $table->dropColumn(['trainName']);
             $table->dropColumn(['bookingCode']);
            $table->dropColumn(['bookTime']);
            $table->dropColumn(['timeLimit']);
            $table->dropColumn(['bookingDate']);
            $table->dropColumn(['class']);
            
            $table->dropColumn(['className']);
            $table->dropColumn(['departDate']);
            $table->dropColumn(['departTime']);
            $table->dropColumn(['arriveDate']);
            $table->dropColumn(['arriveTime']);
            $table->dropColumn(['ticketPrice']);
            $table->dropColumn(['discount']);
            $table->dropColumn(['admin']);
            $table->dropColumn(['tr_id']);
            
        });
    }
}
