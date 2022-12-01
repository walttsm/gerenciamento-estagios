<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunosAviso extends Model
{
    use HasFactory;

    protected $table = 'alunos_aviso';

    protected $fillable = [
        'aviso_id',
        'aluno_id'
    ];
}
