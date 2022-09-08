<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Orientador;

class CoordenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cursos = ['CC', 'ES'];

        $user = User::create([
            'name' => "Walter Coordenador",
            'email' => "waltmarinho@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('coord'),
            'remember_token' => Str::random(10),
            'permissao' => 3, // permissão de coordenador
        ]);
        Orientador::create([
            'nome' => $user['name'],
            'curso' => $cursos[array_rand($cursos)],
            'email' => $user['email'],
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'name' => "Coordenador",
            'email' => "coordenacao@teste.com",
            'email_verified_at' => now(),
            'password' => Hash::make('coord'),
            'remember_token' => Str::random(10),
            'permissao' => 3, // permissão de coordenador
        ]);

        Orientador::create([
            'nome' => $user['name'],
            'curso' => $cursos[array_rand($cursos)],
            'email' => $user['email'],
            'user_id' => $user->id,
        ]);
    }
}
