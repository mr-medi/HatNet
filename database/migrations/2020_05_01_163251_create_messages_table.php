<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('mensaje');
            $table->bigInteger('idEmisor')->unsigned();
            $table->foreign('idEmisor')->references('id')->on('users');
            $table->bigInteger('idReceptor')->unsigned();
            $table->foreign('idReceptor')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
