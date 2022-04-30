<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Orientador;

class Aluno extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fields = [
        'id',
        'nome_aluno',
        'curso',
        'matricula',
        'email',
        'nome_trabalho',
    ];

    public function turma() {
        return $this->belongsTo('Turma');
    }

    public function user() {
        return $this->belongsTo('User');
    }

    public function orientador(){
        return $this->belongsTo(Orientador::class, 'orientador_id');
    }
}
