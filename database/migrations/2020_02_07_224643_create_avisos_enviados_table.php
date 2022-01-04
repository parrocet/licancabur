<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisosEnviadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avisos_enviados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_aviso');
            $table->unsignedBigInteger('id_empleado');
            $table->enum('status',['Enviado','Respondido','Respondido-Cumplido'])->default('Enviado');

            $table->foreign('id_aviso')->references('id')->on('avisos')->onDelete('cascade');
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
        Schema::dropIfExists('avisos_enviados');
    }
}
