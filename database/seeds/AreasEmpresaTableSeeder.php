<?php

use Illuminate\Database\Seeder;

class AreasEmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('areas_empresa')->insert([
            'area_e' => 'Administración'
        ]);
        \DB::table('areas_empresa')->insert([
            'area_e' => 'Proyectos'
        ]);
        \DB::table('areas_empresa')->insert([
            'area_e' => 'Equipo MEL'
        ]);
        \DB::table('areas_empresa')->insert([
            'area_e' => 'Equipo BHP'
        ]);


    }
}
