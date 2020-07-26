<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicherosProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficherosProyecto', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('idFichero')->unsigned();
            $table->bigInteger('idProject')->unsigned();
            $table->foreign('idFichero')->references('id')->on('ficheros');
            $table->foreign('idProject')->references('id')->on('projects');
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
        Schema::dropIfExists('ficherosProyecto');
    }
}
