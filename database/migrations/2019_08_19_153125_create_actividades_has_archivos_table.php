<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesHasArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_has_archivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_actividad');
            $table->string('nombre');
            $table->string('url');
            $table->enum('tipo',['img','file']);

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
        Schema::dropIfExists('actividades_has_archivos');
    }
}
