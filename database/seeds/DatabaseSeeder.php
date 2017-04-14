<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstilosSeeder::class);
        $this->call(GruposSeeder::class);
        $this->call(TiposUsuariosSeeder::class);
    }
}
