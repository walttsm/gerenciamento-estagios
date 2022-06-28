<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Turma;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $user = User::factory()->createOne([
                'permission' => 2,
            ]);

            $cursos = ['CC', 'ES'];
            $orientadores = Orientador::all()->pluck('id');
            $turmas = Turma::all()->pluck('id');

            Aluno::create([
                'nome_aluno' => $user->name,
                'curso' => $cursos[array_rand($cursos)],
                'matricula' => rand(190000000, 220000000),
                'email' => $user->email,
                'nome_trabalho' => $faker->sentence(),
                'user_id' => $user->id,
                'orientador_id' => $faker->randomElement($orientadores),
                'turma_id' => $faker->randomElement($turmas),
                'banca1_id' => $faker->randomElement($orientadores),
                'banca2_id' => $faker->randomElement($orientadores)
            ]);
        }
    }
}
