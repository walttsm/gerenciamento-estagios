<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $cursos = ['CC', 'ES'];
        $orientadores = Orientador::all()->pluck('id');
        $turmas = Turma::all()->pluck('id');
        $faker = Faker::create();

        $user = User::create([
            'name' => 'Walter Aluno',
            'email' => 'waltersmarinho@edu.unifil.br',
            'password' => Hash::make('password'),
            'permissao' => 1,
        ]);

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
            'banca2_id' => $faker->randomElement($orientadores),
        ]);


        for ($i = 0; $i < 20; $i++) {
            $user = User::factory()->createOne(['permissao' => 1]);

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
                'banca2_id' => $faker->randomElement($orientadores),
            ]);
        }
    }
}
