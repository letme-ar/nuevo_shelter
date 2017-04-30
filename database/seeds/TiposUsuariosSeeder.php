<?php

use App\Shelter\Entities\TipoUsuario;
use Illuminate\Database\Seeder;

class TiposUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoUsuario::create([
            'descripcion' => 'Administrador'
        ]);

        TipoUsuario::create([
            'descripcion' => 'Administrador de negocio'
        ]);

        TipoUsuario::create([
            'descripcion' => 'Gestor de negocio'
        ]);

        TipoUsuario::create([
            'descripcion' => 'Grupo musical'
        ]);
    }
}
