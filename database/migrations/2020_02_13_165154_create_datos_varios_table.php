<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosVariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_varios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_empleado');
            $table->string('segundo_nombre')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->date('fecha_nac');

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
        Schema::dropIfExists('datos_varios');
    }
}
