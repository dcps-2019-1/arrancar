<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //HAY QUE IMPLEMENTAR REGISTRAR USUARIOS (CLIENTES) DESDE EL MODULO DE AUTH, PARECE SER MUY BREVE
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('avatar')->default('http://localhost:8000/uploads/avatars/default.jfif');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono');
            //roles: 0 cliente, 1 admin, 2 empresa, 3 conductor.
            $table->integer('rol')->default(0);
            $table->rememberToken();
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
        Schema::defaultStringLength(191);
        Schema::dropIfExists('users');
    }
}
