<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo')->nullable();
            $table->text('novedad')->nullable();
            $table->enum('tipo',['actividad','nuevo_user','notificacion','muro','EICHE']);
            $table->time('fecha');
            $table->dateTime('hora');

            $table->unsignedBigInteger('id_usuario_n')->nullable();
            $table->foreign('id_usuario_n')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade');

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
        Schema::dropIfExists('novedades');
    }
}
