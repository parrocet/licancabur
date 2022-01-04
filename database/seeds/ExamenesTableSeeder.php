<?php

use Illuminate\Database\Seeder;

class ExamenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('examenes')->insert([
            'examen'=> 'Altura Geográfica'
        ]);
        \DB::table('examenes')->insert([
            'examen'=> 'Altura Física'
        ]);
        \DB::table('examenes')->insert([
            'examen'=> 'Adversión al riesgo'
        ]);
        \DB::table('examenes')->insert([
            'examen'=> 'Alcohol'
        ]);
        \DB::table('examenes')->insert([
            'examen'=> 'Drogas'
        ]);
        \DB::table('examenes')->insert([
            'examen'=> 'Psicosensométrico'
        ]);
    }
}
