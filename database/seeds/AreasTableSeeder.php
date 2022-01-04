<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('gerencias')->insert([
            'gerencia' => 'NPI'
        ]);
        \DB::table('gerencias')->insert([
            'gerencia' => 'CHO'
        ]);


        \DB::table('areas')->insert([
            'id_gerencia' => 1,
        	'area' => 'EWS',
            'descripcion' => '1D DCS Insp Estado SistCtrl 800xA Desal EWS',
            'ubicacion' => 'Planta Coloso-Antofagasta'
        ]);

        \DB::table('areas')->insert([
            'id_gerencia' => 1,
            'area' => 'Planta Cero/Desaladora & Acueducto',
            'descripcion' => '1D DCS Insp Estado SistCtrl 800xA Desal PLanta 0',
            'ubicacion' => 'Planta Coloso-Antofagasta'
        ]);

        \DB::table('areas')->insert([
            'id_gerencia' => 1,
            'area' => 'Agua y Tranque',
            'descripcion' => 'Agua y Tranque',
            'ubicacion' => 'Feana-Mina'
        ]);

        \DB::table('areas')->insert([
            'id_gerencia' => 2,
            'area' => 'Filtro-Puerto',
            'descripcion' => '1D DCS Insp Estado SistCtrl 800xA Planta Filtro-Puerto',
            'ubicacion' => 'Planta Coloso-Antofagasta'
        ]);

        \DB::table('areas')->insert([
            'id_gerencia' => 2,
            'area' => 'ECT',
            'descripcion' => '1D DCS Insp Estado SistCtrl 800xA Planta ECT',
            'ubicacion' => 'Planta Coloso-Antofagasta'
        ]);

        \DB::table('areas')->insert([
            'id_gerencia' => 2,
            'area' => 'Los Colorados',
            'descripcion' => 'DCS Insp Estado SistCtrl Bailey  Planta Los Colorados',
            'ubicacion' => 'Feana-Mina'
        ]);
    }
}
