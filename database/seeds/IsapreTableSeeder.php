<?php

use Illuminate\Database\Seeder;

class IsapreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('isapre')->insert([
        	'isapre' => 'Banmédica S.A.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Chuquicamata Ltda.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Colmena Golden Cross S.A.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Consalud S.A.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Cruz Blanca S.A.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Cruz del Norte Ltda.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Nueva Masvida S.A.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Fundación Ltda.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Fusat Ltda.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Río Blanco Ltda.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'San Lorenzo Ltda.'
        ]);
        \DB::table('isapre')->insert([
        	'isapre' => 'Vida Tres S.A.'
        ]);
    }
}
