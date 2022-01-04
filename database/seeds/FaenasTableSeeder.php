<?php

use Illuminate\Database\Seeder;

class FaenasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faenas')->insert([
            'faena' => 'MEL'
        ]);
        \DB::table('faenas')->insert([
            'faena' => 'Centinela'
        ]);
        \DB::table('faenas')->insert([
            'faena' => 'SQM'
        ]);
        \DB::table('faenas')->insert([
            'faena' => 'R.T.'
        ]);
    }
}
