<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            //el id propio de esta tabla
            $table->bigIncrements('id');
            //con el  que se referencia en la tabla usuarios
            $table->unsignedBigInteger('user_id');
            $table->string('nombre')->unique();
            $table->string('nit')->unique();
            $table->string('representante-legal'); //nombre de representante legal.
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
        Schema::dropIfExists('empresas');
    }
}
