<?php

use Illuminate\Database\Seeder;

class EstilosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estilos')->insert(['descripcion' => 'Rock']);
        DB::table('estilos')->insert(['descripcion' => 'Regae']);
        DB::table('estilos')->insert(['descripcion' => 'Alternativo']);
        DB::table('estilos')->insert(['descripcion' => 'Punk']);
        DB::table('estilos')->insert(['descripcion' => 'Country']);
        DB::table('estilos')->insert(['descripcion' => 'Metal']);
        DB::table('estilos')->insert(['descripcion' => 'Cumbia']);
    }
}
