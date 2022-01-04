<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesVistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_vistas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_actividad');
            $table->enum('status',['Si','No']);

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
        Schema::dropIfExists('actividades_vistas');
    }
}
