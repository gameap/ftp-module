<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtpAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftp_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ds_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('host');
            $table->integer('port')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('dir');
            $table->timestamps();

            $table->foreign('ds_id')->references('id')->on('dedicated_servers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ftp_accounts');
    }
}
