<?php

namespace Database\Seeders;

use App\Models\Orientador;
use App\Models\Aluno;
use App\Models\Horario_orientacao;
use DateTime;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class OrientacoesSeeder extends Seeder
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
            foreach($orientador->alunos as $aluno) {
                Horario_orientacao::create([
                    'dia' => rand(2, 7),
                    'hora' => $faker->time('H:i'),
                    'aluno_id' => $aluno->id,
                    'orientador_id' => $orientador->id,
                ]);
            }
        }
    }
}
