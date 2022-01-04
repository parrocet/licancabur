<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_elaborado');
            $table->string('elaborado');
            $table->unsignedBigInteger('id_aprobado');
            $table->string('aprobado');
            $table->string('num_contrato');
            $table->string('fechas');
            $table->integer('semana');
            $table->integer('anio');
            $table->enum('revision',['A','B','C','D'])->default('A');

            $table->unsignedBigInteger('id_gerencia');
            
            $table->foreign('id_elaborado')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('id_aprobado')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('id_gerencia')->references('id')->on('gerencias')->onDelete('cascade');
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
        Schema::dropIfExists('planificacion');
    }
}
