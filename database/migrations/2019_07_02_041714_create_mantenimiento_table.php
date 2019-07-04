<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //mantenimiento posee un codigo, una clave foranea de placa  bus, fecha de entrada y fecha de salida
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign("empresa_id")->references("id")->on("empresas");
            $table->string("bus_id",32)->index();
            $table->foreign("bus_id")->references("placa")->on("buses");
            $table->date("fecha_entrada");
            $table->date("fecha_salida");
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
        Schema::dropIfExists('mantenimiento');
    }
}
