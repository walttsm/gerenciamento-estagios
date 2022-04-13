<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //
        $user = User::create([
            'name' =>"Coordenador",
            'email' => "coordenacao@teste.com",
            'email_verified_at' => now(),
            'password' => Hash::make('coord'),
            'remember_token' => Str::random(10),
            'permission' => 0, // permissão de coordenador
        ]);
        $cursos = ['CC', 'ES'];
        Orientador::create([
            'nome' => $user['name'],
            'curso' => $cursos[array_rand($cursos)],
            'email' => $user['email'],
            'user_id' => $user->id,
        ]);
    }
}
