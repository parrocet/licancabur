<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosVistosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_vistos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_comentario');
            $table->enum('status',['Si','No']);
            $table->integer('id_actividad');
            $table->integer('id_empleado');

            $table->foreign('id_comentario')->references('id')->on('actividades_comentarios')->onDelete('cascade');
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
        Schema::dropIfExists('comentarios_vistos');
    }
}
