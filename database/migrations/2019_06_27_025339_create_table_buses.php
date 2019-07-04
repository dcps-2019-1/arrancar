<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            //codigo hace referencia al código que le genera internamente la compañia
            $table->unsignedInteger('codigo');

            $table->string('placa',32)->index();
            $table->unsignedBigInteger("empresa_id");
            $table->foreign("empresa_id")->references("id")->on("empresas");
            $table->unsignedInteger('numero_sillas');
            //cambia sí el bus está en mantenimiento
            $table->string('estado')->default("disponible");
            //basico, premium son las posibles categorias
            $table->string('categoria')->default("basico");
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
        Schema::dropIfExists('table_buses');
    }
}
