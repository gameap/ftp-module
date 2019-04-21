<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtpCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftp_commands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ds_id')->unique()->unsigned();
            $table->string('default_host')->nullable();
            $table->string('create_command')->nullable();
            $table->string('update_command')->nullable();
            $table->string('delete_command')->nullable();
            $table->timestamps();

            $table->foreign('ds_id')->references('id')->on('dedicated_servers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ftp_commands');
    }
}
