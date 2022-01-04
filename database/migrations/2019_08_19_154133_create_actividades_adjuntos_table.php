<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_adjuntos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_actv_proceso');
            $table->unsignedBigInteger('id_usuario');
            $table->string('nombre');
            $table->string('url');
            $table->enum('tipo',['img','file']);

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_actv_proceso')->references('id')->on('actividades_proceso')->onDelete('cascade');
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
        Schema::dropIfExists('actividades_adjuntos');
    }
}
