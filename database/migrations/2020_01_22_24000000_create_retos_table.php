<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retos', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('idProject')->unsigned();
            $table->foreign('idProject')->references('id')->on('projects');
            $table->string('rutaReto');
            $table->integer('puntos');
            $table->string('flag');
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
        Schema::dropIfExists('retos');
    }
}
