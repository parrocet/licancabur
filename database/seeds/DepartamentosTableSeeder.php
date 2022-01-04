<?php

use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('departamentos')->insert([
        	'departamento' => 'Ninguno'
        ]);
        \DB::table('departamentos')->insert([
        	'departamento' => 'Comunicaciones'
        ]);
        \DB::table('departamentos')->insert([
        	'departamento' => 'Mantención'
        ]);
        \DB::table('departamentos')->insert([
        	'departamento' => 'Operación'
        ]);
        \DB::table('departamentos')->insert([
        	'departamento' => 'Control de Procesos'
        ]);
        \DB::table('departamentos')->insert([
        	'departamento' => 'DCS'
        ]);
    }
}
