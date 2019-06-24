<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductores', function (Blueprint $table) {
            //id propio de esta tabla
            $table->bigIncrements('id');
            //el id correspondiente a la tabla general de usuarios
            $table->unsignedBigInteger('user_id');
            //id con el que se referencia la empresa
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->string('nombre');
            $table->string('cedula')->unique();
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
        Schema::dropIfExists('conductores');
    }
}
