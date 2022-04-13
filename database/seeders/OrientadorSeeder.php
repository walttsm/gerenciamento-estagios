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
        for ($i = 0; $i < 15; $i++) {
            $orientador = Orientador::factory()->createOne();

            User::create([
                'name' => $orientador['nome'],
                'curso' => $orientador['curso'],
                'email' => $orientador['email'],
                'permission' => 1, // permissão orientador
                'password' => Hash::make('orientador'), // senha de admin
            ]);
        }
        Orientador::factory()->count(15)->create();
    }
}
