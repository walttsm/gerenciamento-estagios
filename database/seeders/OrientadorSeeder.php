<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Orientador;
use App\Models\User;

class OrientadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cursos = ['CC', 'ES'];

        $user = User::create([
            'name' => 'Walter Orientador',
            'email' => 'walter.marinho@colegiolondrinense.com.br',
            'password' => Hash::make('password'),
            'permissao' => 2,
        ]);

        Orientador::create([
            'nome' => $user['name'],
            'curso' => $cursos[array_rand($cursos)],
            'email' => $user['email'],
            'user_id' => $user->id,
        ]);

        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->createOne(['permissao' => 2]);


            Orientador::create([
                'nome' => $user['name'],
                'curso' => $cursos[array_rand($cursos)],
                'email' => $user['email'],
                'user_id' => $user->id,
            ]);
        }
    }
}
