<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task');
            $table->string('descripcion')->nullable();
            $table->date('fecha_vencimiento');
            $table->integer('duracion_pro')->nullable();
            $table->integer('cant_personas');
            $table->integer('duracion_real')->nullable();
            $table->enum('dia',['Mié','Jue','Vie','Sáb','Dom','Lun','Mar']);
            $table->enum('tipo',['PM01','PM02','PM03','PM04'])->default('PM01');
            $table->enum('realizada',['Si','No'])->default('No');
            $table->text('observacion1')->nullable();
            $table->text('observacion2')->nullable();
            $table->unsignedBigInteger('id_planificacion');
            $table->unsignedBigInteger('id_area');
            $table->unsignedBigInteger('id_departamento');

            $table->foreign('id_planificacion')->references('id')->on('planificacion')->onDelete('cascade');
            $table->foreign('id_area')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('id_departamento')->references('id')->on('departamentos')->onDelete('cascade');
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
        Schema::dropIfExists('actividades');
    }
}
