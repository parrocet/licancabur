<?php

use Illuminate\Database\Seeder;

class AvisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('avisos')->insert([
        	'motivo' => 'Vencimiento de Licencia',
        	'mensaje' => 'Buenos días, Tardes o Noches. Le informamos que la fecha de vencimiento de su licencia esta llegando a la fecha, por lo que necesitamos que realice los procedimientos pertinentes para renovar su licencia, para poder continuar laborando dentro de nuestras instalaciones. Gracias por su atención, esperamos una respuesta lo más pronto posible.',
        	'dias_previos' => 5,
        	'dias_post' => 5,
        	'modalidad' => 'Automático'
        ]);

        \DB::table('avisos')->insert([
        	'motivo' => 'Vencimiento de Exámenes',
        	'mensaje' => 'Buenos días, Tardes o Noches. Le informamos que existen ciertos exámenes que debe realizarse como cumplimiento a las normativas de salubridad de nuestra empresa, por lo que necesitamos que realice los procedimientos pertinentes para entregar los resultados en la oficina pertinente, para poder continuar laborando dentro de nuestras instalaciones. Gracias por su atención, esperamos una respuesta lo más pronto posible.',
        	'dias_previos' => 5,
        	'dias_post' => 5,
        	'modalidad' => 'Ambos'
        ]);

        \DB::table('avisos')->insert([
            'motivo' => 'Vencimiento de Cursos',
            'mensaje' => 'Buenos días, Tardes o Noches. Le informamos que existen ciertos cursos que debe realizarse como cumplimiento a las normativas de nuestra empresa, por lo que necesitamos que realice los procedimientos pertinentes para entregar los resultados en la oficina pertinente, para poder continuar laborando dentro de nuestras instalaciones. Gracias por su atención, esperamos una respuesta lo más pronto posible.',
            'dias_previos' => 30,
            'dias_post' => 10,
            'modalidad' => 'Ambos'
        ]);
    }
}
