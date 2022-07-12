<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Registro;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        $orientadores = Orientador::all();

        foreach ($orientadores as $orientador) {
            $alunos = $orientador->alunos;
            if (count($alunos) > 0) {
                for ($i = 0; $i < 3; $i++) {
                    $aluno = $alunos->random();
                    $prob_falta = rand(0,1) < 0.4;
                    Registro::create([
                        'data_orientacao' => $faker->dateTimeThisYear(),
                        'assunto' => $faker->paragraph(4),
                        'prox_assunto' => $faker->paragraph(3),
                        'observacao' => $prob_falta < 0.4 ? 'Aluno Doente' : '',
                        'presenca' => $prob_falta < 0.4 ? true : false,
                        'orientador_id' => $orientador->id,
                        'aluno_id' => $aluno->id,
                    ]);
                }
            }
        }
    }
}
