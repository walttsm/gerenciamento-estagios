<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Turma;
use Faker\Factory as Faker;

class UserAna extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user = User::create ([
            'name' =>"Ana Kataoka",
            'email' => "ana@domain.com",
            'email_verified_at' => now(),
            'password' => Hash::make('senha12345'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('Aluno');
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
        ]);
    }
}
