<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesProcesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_proceso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_actividad');
            $table->unsignedBigInteger('id_empleado');
            $table->string('hora_inicio');
            $table->string('hora_finalizada')->nullable();
            $table->enum('status',['Iniciada','Finalizada'])->default('Iniciada');
            

            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('id_actividad')->references('id')->on('actividades')->onDelete('cascade');
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
        Schema::dropIfExists('actividades_proceso');
    }
}
