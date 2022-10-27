<?php

namespace Database\Seeders;

use Faker\Factory as Faker;

use App\Models\Aluno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Orientador;
use App\Models\Rpod;

class RPODSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        //
        for ($i = 0; $i < 20; $i++) {
            $orientadores = Orientador::all()->pluck('id');
            $alunos = Aluno::all()->pluck('id');

            RPOD::create([
                'mes' => rand(1, 12),
                'local_arquivo' => $faker->sentence(),
                'horas_mes' => rand(0, 162),
                'rpod_title' => 'teste',
                'aluno_id' => $faker->randomElement($alunos),
                'orientador_id' => $faker->randomElement($orientadores),
            ]);
        }
    }
}
