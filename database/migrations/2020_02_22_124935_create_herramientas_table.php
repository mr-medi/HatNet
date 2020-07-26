<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHerramientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herramientas', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('rutaImagen',500)->default('def.png');
            $table->bigInteger('idProject')->unsigned();
            $table->foreign('idProject')->references('id')->on('projects');
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
        Schema::dropIfExists('herramientas');
    }
}
