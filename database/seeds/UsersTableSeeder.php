<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //USUARIO 1 -- EMPLEADO 1 --//
        \DB::table('users')->insert([
            'name' => 'R Portilla',
            'email' => 'r.portilla@licancabur.cl',
            'password' => bcrypt('123456'),
            'tipo_user' => 'Admin',
        ]);

        \DB::table('empleados')->insert([
            'id_usuario'=> 1,
            'nombres' => 'R',
            'apellidos' => 'Portilla',
            'email' => 'r.portilla@licancabur.cl',
            'rut' => '123456781',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);

        \DB::table('datos_varios')->insert([
            'id_empleado'=> 1,
            'segundo_nombre' => 'José',
            'segundo_apellido' => 'Pérez',
            'fecha_nac' => '1996-11-30'
        ]);
        
        \DB::table('informacion_contacto')->insert([
            'id_empleado'=> 1,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);
        //areas_empresa
        for ($i=1; $i <= 4; $i++) { 
            \DB::table('empleados_has_areas_empresa')->insert([
                'id_empleado'=> 1,
                'id_area_e' => $i
            ]);            
        }
        //fin areas_empresa
        //afp
        for ($i=1; $i <= 6; $i++) { 
            \DB::table('empleados_has_afp')->insert([
                'id_empleado'=> 1,
                'id_afp' => $i
            ]);            
        }
        //fin afp
        //faenas
        for ($i=1; $i <= 4; $i++) { 
            \DB::table('empleados_has_faenas')->insert([
                'id_empleado'=> 1,
                'id_faena' => $i
            ]);            
        }
        //fin faenas
        //examenes
        for ($i=1; $i <= 5; $i++) { 
            \DB::table('empleados_has_examenes')->insert([
                'id_empleado'=> 1,
                'id_examen' => $i,
                'fecha' => '2019-01-15',
                'fecha_vence' => '2019-08-15'
            ]);            
        }
        //cursos
        for ($i=1; $i <= 5; $i++) { 
            \DB::table('empleados_has_cursos')->insert([
                'id_empleado'=> 1,
                'id_curso' => $i,
                'fecha' => '2019-01-15',
                'fecha_vence' => '2019-08-15'
            ]);
            
        }
        //fin cursos
        //licencia
            \DB::table('empleados_has_licencias')->insert([
            'id_empleado'=> 1,
            'id_licencia' => 1,
            'fecha' => '2018-04-01',
            'fecha_vence' => '2023-04-01' 
            ]);
        //fin licencia
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=> 1,
            'id_area' => 1
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=> 1,
            'id_area' => 2
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=> 1,
            'id_area' => 3
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=> 1,
            'id_area' => 4
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=> 1,
            'id_area' => 5
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=> 1,
            'id_area' => 6
        ]);
        
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=> 1,
            'id_departamento' => 2
        ]);
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=> 1,
            'id_departamento' => 3
        ]);
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=> 1,
            'id_departamento' => 4
        ]);
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=> 1,
            'id_departamento' => 5
        ]);
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=> 1,
            'id_departamento' => 6
        ]);
        //--------------------------------------------------//

        //-- USUAIRO 2 -- EMPLEADO 2 --//
        \DB::table('users')->insert([
            'name' => 'Gabriel Olmos',
            'email' => 'g.olmos@licancabur.cl',
            'password' => bcrypt('123456'),
            'tipo_user' => 'Supervisor'
        ]);

        \DB::table('empleados')->insert([
            'id_usuario'=>2,
            'nombres' => 'Gabriel',
            'apellidos' => 'Olmos',
            'email' => 'g.olmos@licancabur.cl',
            'rut' => '123456782',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);
        \DB::table('datos_varios')->insert([
            'id_empleado'=>2,
            'segundo_nombre' => '',
            'segundo_apellido' => '',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>2,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);
        //areas_empresa
        \DB::table('empleados_has_areas_empresa')->insert([
            'id_empleado'=> 2,
            'id_area_e' => 3
        ]);
        //fin areas_empresa
        //afp
        for ($i=1; $i <= 6; $i++) { 
            \DB::table('empleados_has_afp')->insert([
                'id_empleado'=> 2,
                'id_afp' => $i
            ]);            
        }
        //fin afp
        //faenas        
        \DB::table('empleados_has_faenas')->insert([
            'id_empleado'=> 2,
            'id_faena' => 4
        ]);
        //fin faenas
        //examenes
        for ($i=1; $i <= 5; $i++) { 
            \DB::table('empleados_has_examenes')->insert([
                'id_empleado'=> 2,
                'id_examen' => $i,
                'fecha' => '2019-05-15'
            ]);            
        }
        //fin examenes        
        //licencia
            \DB::table('empleados_has_licencias')->insert([
            'id_empleado'=> 2,
            'id_licencia' => 1,
            'fecha' => '2018-04-01',
            'fecha_vence' => '2023-04-01' 
            ]);
        //fin licencia
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=>2,
            'id_area' => 1
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=>2,
            'id_area' => 2
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=>2,
            'id_area' => 4
        ]);
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=>2,
            'id_departamento' => 2
        ]);
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=>2,
            'id_departamento' => 4
        ]);
        //----------------------------------------------------//
        
        //-- USUAIRO 3 -- EMPLEADO 3 --//
        \DB::table('users')->insert([
        	'name' => 'María José Varas',
        	'email' => 'm.varas@licancabur.cl',
        	'password' => bcrypt('123456'),
        	'tipo_user' => 'Planificacion',
        ]);
        \DB::table('empleados')->insert([
            'id_usuario'=>3,
            'nombres' => 'Maria José',
            'apellidos' => 'Varas',
            'email' => 'm.varas@licancabur.cl',
            'rut' => '123456783',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);
        \DB::table('datos_varios')->insert([
            'id_empleado'=>3,
            'segundo_nombre' => '',
            'segundo_apellido' => '',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>3,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);

        //-- USUAIRO 4 -- EMPLEADO 4 --//
        \DB::table('users')->insert([
            'name' => 'A Portilla',
            'email' => 'a.portilla@licancabur.cl',
            'password' => bcrypt('123456'),
            'tipo_user' => 'Recursos humanos',
        ]);
        \DB::table('empleados')->insert([
            'id_usuario'=>4,
            'nombres' => 'A',
            'apellidos' => 'Portilla',
            'email' => 'a.portilla@licancabur.cl',
            'rut' => '123456784',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);
        \DB::table('datos_varios')->insert([
            'id_empleado'=>4,
            'segundo_nombre' => '',
            'segundo_apellido' => '',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>4,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);

        //-- USUAIRO 5 -- EMPLEADO 5 --//
        \DB::table('users')->insert([
            'name' => 'Terreno',
            'email' => 'terreno@licancabur.cl',
            'password' => bcrypt('123456'),
            'tipo_user' => 'Empleado'
        ]);
        \DB::table('empleados')->insert([
            'id_usuario'=>5,
            'nombres' => 'Terreno',
            'apellidos' => 'Terreno',
            'email' => 'terreno@licancabur.cl',
            'rut' => '123456785',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);

        \DB::table('datos_varios')->insert([
            'id_empleado'=>5,
            'segundo_nombre' => 'Terreno',
            'segundo_apellido' => 'Terreno',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>5,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);        
        //areas_empresa
        
            \DB::table('empleados_has_areas_empresa')->insert([
                'id_empleado'=> 5,
                'id_area_e' => 2
            ]);
            
        
        //fin areas_empresa
        //afp
        for ($i=1; $i <= 6; $i++) { 
            \DB::table('empleados_has_afp')->insert([
                'id_empleado'=> 5,
                'id_afp' => $i
            ]);
            
        }
        //fin afp
        //faenas
        for ($i=1; $i <= 2; $i++) { 
            \DB::table('empleados_has_faenas')->insert([
                'id_empleado'=> 5,
                'id_faena' => $i
            ]);
            
        }
        //fin faenas
        //examenes

        for ($i=1; $i <= 5; $i++) { 
            \DB::table('empleados_has_examenes')->insert([
                'id_empleado'=> 5,
                'id_examen' => $i,
                'fecha' => '2019-06-15',
                'fecha_vence' => '2019-01-15'
            ]);
            
        }
        //cursos
        for ($i=1; $i <= 5; $i++) { 
            \DB::table('empleados_has_cursos')->insert([
                'id_empleado'=> 5,
                'id_curso' => $i,
                'fecha' => '2019-06-15',
                'fecha_vence' => '2019-01-15'
            ]);
            
        }
        //fin examens
        
        //datos laborales
            \DB::table('datos_laborales')->insert([
            'id_empleado'=> 5,
            'fechai_vac' => '2019-12-17',
            'fechaf_vac' => '2019-12-20',
            'status_vac' => 'Solicitadas'
            ]);
        //fin datos laborales
        //licencia
            \DB::table('empleados_has_licencias')->insert([
            'id_empleado'=> 5,
            'id_licencia' => 1,
            'fecha' => '2018-04-01',
            'fecha_vence' => '2023-04-01' 
            ]);
        //fin licencia
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=>5,
            'id_area' => 1
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=>5,
            'id_area' => 2
        ]);
        \DB::table('empleados_has_areas')->insert([
            'id_empleado'=>5,
            'id_area' => 4
        ]);

        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=>5,
            'id_departamento' => 2
        ]);
        \DB::table('empleados_has_departamentos')->insert([
            'id_empleado'=>5,
            'id_departamento' => 4
        ]);
        //---------------------------------------------------//



// //----------------------------------SUPER USER EICHE-------------------------
        //-- USUAIRO 6 -- EMPLEADO 6 --//
        \DB::table('users')->insert([
            'name' => 'Administrador EICHE',
            'email' => 'Admin@eiche.cl',
            'password' => bcrypt('123456'),
            'tipo_user' => 'Admin',
            'superUser' => 'Eiche'
        ]);
        \DB::table('empleados')->insert([
            'id_usuario'=>6,
            'nombres' => 'Administrador',
            'apellidos' => 'EICHE',
            'email' => 'Admin@eiche.cl',
            'rut' => '123456786',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);
        \DB::table('datos_varios')->insert([
            'id_empleado'=>6,
            'segundo_nombre' => '',
            'segundo_apellido' => '',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>6,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);

        //-- USUAIRO 7 -- EMPLEADO 7 --//
        \DB::table('users')->insert([
            'name' => 'Licancabur ViewMel',
            'email' => 'ViewMel@licancabur.cl',
            'password' => bcrypt('MEL1234'),
            'tipo_user' => 'Admin'
            // 'superUser' => 'Eiche'
        ]);
        \DB::table('empleados')->insert([
            'id_usuario'=>7,
            'nombres' => 'Licancabur',
            'apellidos' => 'ViewMel',
            'email' => 'ViewMel@licancabur.cl',
            'rut' => '123456787',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);
        \DB::table('datos_varios')->insert([
            'id_empleado'=>7,
            'segundo_nombre' => '',
            'segundo_apellido' => '',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>7,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);

// //----------------------------------USER NPI - CHO-------------------------
        //-- USUAIRO 8 -- EMPLEADO 8 --//
        \DB::table('users')->insert([
            'name' => 'MELNPI',
            'email' => 'melnpi@licancabur.cl',
            'password' => bcrypt('NPI.1q2w3e'),
            'tipo_user' => 'G-NPI'
            // 'superUser' => 'Eiche'
        ]);
        \DB::table('empleados')->insert([
            'id_usuario'=>8,
            'nombres' => 'MELNPI',
            'apellidos' => '',
            'email' => 'melnpi@licancabur.cl',
            'rut' => '123456788',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);
        \DB::table('datos_varios')->insert([
            'id_empleado'=>8,
            'segundo_nombre' => '',
            'segundo_apellido' => '',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>8,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);

        //-- USUAIRO 9 -- EMPLEADO 9 --//
        \DB::table('users')->insert([
            'name' => 'MELCHO',
            'email' => 'melcho@licancabur.cl',
            'password' => bcrypt('CHO.1q2we'),
            'tipo_user' => 'G-CHO'
            // 'superUser' => 'Eiche'
        ]);
        \DB::table('empleados')->insert([
            'id_usuario'=>9,
            'nombres' => 'MELCHO',
            'apellidos' => '',
            'email' => 'melcho@licancabur.cl',
            'rut' => '123456789',
            'edad' => 30,
            'genero' => 'Masculino',
            'status' => 'Activo'
        ]);
        \DB::table('datos_varios')->insert([
            'id_empleado'=>9,
            'segundo_nombre' => '',
            'segundo_apellido' => '',
            'fecha_nac' => '1996-11-30'
        ]);

        \DB::table('informacion_contacto')->insert([
            'id_empleado'=>9,
            'nombre' => 'admin',
            'apellido' => 'admin',
            'telefono' => '04121234567',
            'email' => 'admin@eiche.cl',
            'direccion' => 'no posee'
        ]);
    }
}
