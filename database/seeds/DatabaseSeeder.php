<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AreasTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(ExamenesTableSeeder::class);
        $this->call(CursosTableSeeder::class);
        $this->call(AreasEmpresaTableSeeder::class);
        $this->call(AfpTableSeeder::class);
        $this->call(FaenasTableSeeder::class);
        $this->call(LicenciasTableSeeder::class);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlanificacionTableSeeder::class);
        // $this->call(ActividadesTableSeeder::class);
        $this->call(PrivilegiosTableSeeder::class);
        $this->call(UsuariosPrivilegiosTableSeeder::class);
        $this->call(AvisosTableSeeder::class);
        $this->call(IsapreTableSeeder::class);
        // $this->call(NovedadesTableSeeder::class);
    }
}
