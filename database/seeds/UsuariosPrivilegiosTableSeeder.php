<?php

use Illuminate\Database\Seeder;

class UsuariosPrivilegiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //--- Privilegio del usuario con ID 1 - Admin --//
        for ($i=1; $i <=14; $i++) { 
        	\DB::table('usuarios_has_privilegios')->insert([
        	'id_usuario' => 1,
        	'id_privilegio' => $i
            ]);
        }
        for ($i=15; $i <= 17; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 1,
            'id_privilegio' => $i,
            'status' => 'No'
            ]);
        }
        for ($i=18; $i <= 46; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 1,
            'id_privilegio' => $i
            ]);
        }

        //--- Privilegio del usuario con ID 2 - Supervisor --//
        for ($i=1; $i <=10; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 2,
            'id_privilegio' => $i
            ]);
        }
        for ($i=11; $i <= 16; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 2,
            'id_privilegio' => $i,
            'status' => 'No'
            ]);
        }

        for ($i=17; $i <= 35; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 2,
            'id_privilegio' => $i,
            ]);
        }

        for ($i=36; $i <= 46; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 2,
            'id_privilegio' => $i,
            'status' => 'No'
            ]);
        }
        

        //--- Privilegio del usuario con ID 3 - Planificacion --//

        for ($i=1; $i <=14; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 3,
            'id_privilegio' => $i
            ]);
        }
        for ($i=15; $i <= 17; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 3,
            'id_privilegio' => $i,
            'status' => 'No'
            ]);
        }
        for ($i=18; $i <= 35; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 3,
            'id_privilegio' => $i
            ]);
        }
        for ($i=36; $i <= 46; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 3,
            'id_privilegio' => $i,
            'status' => 'No'
            ]);
        }

        //--- Privilegio del usuario con ID 4 - Recursos humanos --//

        for($i=1; $i<=10; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 4,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }

        for($i=11; $i<=14; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 4,
                'id_privilegio' => $i,
                'status' => 'Si'
            ]);
        }

        for($i=15; $i<=46; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 4,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
        


        //--- Privilegio del usuario con ID 5 - Tipo Empleado --//
        for($i=1; $i<=4; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 5,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
        for($i=5; $i<=7; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 5,
                'id_privilegio' => $i,
                'status' => 'Si'
            ]);
        }
        for($i=8; $i<=19; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 5,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }

        \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 5,
                'id_privilegio' => 20,
                'status' => 'Si'
            ]);

        for($i=21; $i<=46; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 5,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }

        
//---------------------------------------------SUPER USER EICHE--------------
        for ($i=1; $i <=46; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 6,
            'id_privilegio' => $i
            ]);
        }

        for ($i=1; $i <=46; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 7,
            'id_privilegio' => $i
            ]);
        }
        ///----------USER MELNPI ---------------------------------------
        for($i=1; $i<=17; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 8,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
        for ($i=18; $i <=20; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 8,
            'id_privilegio' => $i
            ]);
        }
        for($i=21; $i<=35; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 8,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
        for ($i=36; $i <=37; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 8,
            'id_privilegio' => $i
            ]);
        }
        for($i=38; $i<=46; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 8,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
        ///----------USER MELCHO ---------------------------------------
        for($i=1; $i<=17; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 9,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
        for ($i=18; $i <=20; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 9,
            'id_privilegio' => $i
            ]);
        }
        for($i=21; $i<=35; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 9,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
        for ($i=36; $i <=37; $i++) { 
            \DB::table('usuarios_has_privilegios')->insert([
            'id_usuario' => 9,
            'id_privilegio' => $i
            ]);
        }
        for($i=38; $i<=46; $i++){
            \DB::table('usuarios_has_privilegios')->insert([
                'id_usuario' => 9,
                'id_privilegio' => $i,
                'status' => 'No'
            ]);
        }
    }
}
