<?php

use Illuminate\Database\Seeder;

class NovedadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//---------------------EICHE-----------------

        \DB::table('novedades')->insert([
        	'titulo' => 'Nuevas funcionalidades!',
			'novedad' => 'Los desarrolladores de EICHE están encantandos de informarles sobre las nuevas actualizaciones sobre el calendario interactivo y la eliminación múltiple de actividades',
			'tipo' => 'EICHE',
			'fecha' => date('Y-m-d'),
			'hora' => time('H:i:s'),
			'id_usuario_n' => 1,
			'id_empleado' => 1

        ]);


        //----------------------NUEVO USUARIO----------

        \DB::table('novedades')->insert([
        	'titulo' => '',
			'novedad' => '',
			'tipo' => 'nuevo_user',
			'fecha' => date('Y-m-d'),
			'hora' => time('H:m:s'),
			'id_usuario_n' => 4,
			'id_empleado' => 2

        ]);

        //----------------------MURO----------

        \DB::table('novedades')->insert([
        	'titulo' => '',
			'novedad' => '',
			'tipo' => 'muro',
			'fecha' => date('Y-m-d'),
			'hora' => time('H:m:s'),
			'id_usuario_n' => 3,
			'id_empleado' => 2

        ]);

        //----------------------ACTIVIDAD----------

        \DB::table('novedades')->insert([
        	'titulo' => 'Actividad Completada!',
			'novedad' => 'El usuario <a href="#">Luis Torres</a> ha terminado la actividad Lavar Carros de forma exitosa!',
			'tipo' => 'actividad',
			'fecha' => date('Y-m-d'),
			'hora' => time('H:m:s'),
			'id_usuario_n' => 4,
			'id_empleado' => 2

        ]);
    }
}
