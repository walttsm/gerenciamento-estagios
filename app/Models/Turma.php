<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Aluno;

class Turma extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fields = [
        'ano',
        'codigo',
    ];

    public function alunos() {
        return $this->hasMany(Aluno::class);
    }
}
