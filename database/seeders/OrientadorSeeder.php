<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->createOne([
                'permission' => 1,
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
}
