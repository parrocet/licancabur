<?php

use Illuminate\Database\Seeder;

class AfpTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('afp')->insert([
            'afp' => 'AFP Capital'
        ]);
        \DB::table('afp')->insert([
            'afp' => 'AFP Cuprum'
        ]);
        \DB::table('afp')->insert([
            'afp' => 'AFP Habitat'
        ]);
        \DB::table('afp')->insert([
            'afp' => 'AFP Modelo'
        ]);
        \DB::table('afp')->insert([
            'afp' => 'AFP Planvital'
        ]);
        \DB::table('afp')->insert([
            'afp' => 'AFP Provida'
        ]);
    }
}
