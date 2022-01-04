<?php

use Illuminate\Database\Seeder;

class LicenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('licencias')->insert([
        	'licencia' => 'De Conducir'
        ]);

        
    }
}
