<?php

use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cursos')->insert([
            'curso'=> 'Cero Daño MEL'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Inducción de Area MEL'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Hombre Nuevo Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Altura'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Inducción de Area Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'HCR30 Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Primeros Auxilios Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Extintores Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Orientación en Prev. De Riesgos Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Reg. De Emergencia Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Servicio Salud Centinela'
        ]);
        \DB::table('cursos')->insert([
            'curso'=> 'Aislación y Bloqueo Centinela'
        ]);
    }
}
