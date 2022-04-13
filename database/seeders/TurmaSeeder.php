<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Turma;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $year = date('Y');
        for ($i = $year - 2; $i <= $year; $i++) {
            Turma::create([
                'ano' => $i,
                'codigo' => 'COMP'.str($i),
            ]);
        } 
    }
}
