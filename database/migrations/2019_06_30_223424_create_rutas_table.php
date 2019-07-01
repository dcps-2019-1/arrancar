<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->bigInteger('codigo');
            $table->string('municipio-origen');
            $table->string('departamento-origen');
            $table->string('municipio_destino');
            $table->string('departamento-destino');
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
        Schema::dropIfExists('rutas');
    }
}
