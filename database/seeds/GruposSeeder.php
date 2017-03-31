<?php

use App\Shelter\Entities\Grupo;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class GruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRecords(5000);
    }

    public function createRecords($total)
    {
        $faker = Faker::create();

        for($i = 1;$i <= $total;$i++)
        {
            Grupo::create([
                'nombre' => $faker->lastName,
                'estilo_id' => $faker->numberBetween($min = 1, $max = 7),
                'integrantes' => $faker->firstName,
                'user_creador_id' => 2
            ]);
        }

    }
}
