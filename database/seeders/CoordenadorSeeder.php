<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $coordenador = new Orientador;
        $coordenador->nome = "Coordenador";
        $coordenador->curso = "CC";
        $coordenador->email = "coordenacao@teste.com";
        Orientador::create([
            'nome' => $coordenador['nome'],
            'curso' => $coordenador['curso'],
            'email' => $coordenador['email']
        ]);
        
        User::create([
            'name' => $coordenador['nome'],
            'curso' => $coordenador['curso'],
            'email' => $coordenador['email'],
            'permission' => 0,
            'password' => Hash::make('coord'), // senha de admin
        ]);
    }
}
