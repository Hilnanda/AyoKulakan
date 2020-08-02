<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeOnTransKurir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('log_trans_ampas_transaksi_kurir');
        Schema::dropIfExists('trans_ampas_transaksi_kurir');

        Schema::create('trans_ampas_transaksi_kurir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->nullable();
            
            $table->bigInteger('lapak_id')->unsigned()->nullable();

            $table->string('form_type')->nullable();
            $table->string('form_id')->nullable();
            $table->string('kurir_child_tipe')->nullable();
            $table->string('kurir_child_harga')->nullable();
            $table->string('kurir_child_hari')->nullable();
            $table->string('status')->nullable()->default(1)->comment('1 : active, 2 : non active, 3: tolak');
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

        });

        Schema::create('log_trans_ampas_transaksi_kurir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->nullable();
            
            $table->bigInteger('lapak_id')->unsigned()->nullable();

            $table->integer('log_trans_id')->unsigned();
            $table->string('form_type')->nullable();
            $table->string('form_id')->nullable();
            $table->string('kurir_child_tipe')->nullable();
            $table->string('kurir_child_harga')->nullable();
            $table->string('kurir_child_hari')->nullable();
            $table->string('status')->nullable()->comment('1 : active, 2 : non active, 3: tolak');

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
        Schema::dropIfExists('log_trans_ampas_transaksi_kurir');
        Schema::dropIfExists('trans_ampas_transaksi_kurir');
    }
}
