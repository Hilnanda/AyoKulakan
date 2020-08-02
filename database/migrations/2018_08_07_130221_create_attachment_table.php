<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_attachments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('filename', 100);
            $table->string('url', 255);

            $table->integer('target_id')->unsigned();
            $table->string('target_type', 100);
            $table->string('type', 100)->nullable();

            $table->dateTime('taken_at')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('sys_files', function (Blueprint $table) {
            $table->increments('id');

            $table->string('filename', 100);
            $table->string('url', 255);

            $table->integer('target_id')->unsigned();
            $table->string('target_type', 100);
            $table->string('type', 100)->nullable();

            $table->dateTime('taken_at')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('sys_pictures', function (Blueprint $table) {
            $table->increments('id');

            $table->string('filename', 100);
            $table->string('url', 255);

            $table->integer('target_id')->unsigned();
            $table->string('target_type', 100);
            $table->string('type', 100)->nullable();

            $table->dateTime('taken_at')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('sys_pictures_users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('filename', 100);
            $table->string('url', 255);

            $table->integer('target_id')->unsigned();
            $table->string('target_type', 100);
            $table->string('type', 100)->nullable();

            $table->dateTime('taken_at')->nullable();

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
        Schema::dropIfExists('sys_attachments');
        Schema::dropIfExists('sys_files');
        Schema::dropIfExists('sys_pictures');
        Schema::dropIfExists('sys_pictures_users');
    }
}
