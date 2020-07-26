<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicherosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficheros', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->longText('code');
            $table->string('name');
            $table->string('ruta',500)->nullable();//NOT SURE
            $table->bigInteger('idLenguaje')->unsigned();
            $table->foreign('idLenguaje')->references('id')->on('lenguajes');
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
        Schema::dropIfExists('ficheros');
    }
}
