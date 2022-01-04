<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('rut');
            $table->integer('edad');
            $table->enum('cargo',['Gerente','Jefe de Operaciones','Ingeniero de Servicios','Jefe de Administración','Técnico de Servicios','Ingeniero en Entrenamiento','Maestro Mayor','Jefe de Terreno','Supervisor de Terreno','Técnico de Montaje','Jefe de Coordinación y Gestión','Planificador','Prevención de Riesgos','Asistente Administrativo','Chofer']);
            $table->enum('genero',['Masculino','Femenino'])->default('Masculino');
            $table->enum('status',['Activo','Reposo','Retirado'])->default('Activo');

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('empleados');
    }
}
