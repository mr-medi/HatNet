<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('usuariosReto', function (Blueprint $table)
      {
          $table->bigIncrements('id');
          $table->bigInteger('idUsuario')->unsigned();
          $table->foreign('idUsuario')->references('id')->on('users');
          $table->bigInteger('idReto')->unsigned();
          $table->foreign('idReto')->references('id')->on('retos');
          $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
          //$table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuariosReto');
    }
}
