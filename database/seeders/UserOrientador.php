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

class UserOrientador extends Seeder
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
            'name' =>"Keqing",
            'email' => "kang.keqing@domain.com",
            'email_verified_at' => now(),
            'password' => Hash::make('senha12345'),
            'remember_token' => Str::random(10),
            'permissao' => 2
        ]);
        $cursos = ['CC', 'ES'];
        Orientador::create([
            'nome' => $user['name'],
            'curso' => $cursos[array_rand($cursos)],
            'email' => $user->email,
            'user_id' => $user->id,
        ]);
    }
}
