<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    public $fields = [
        'id',
        'nome_aluno',
        'curso',
        'matricula',
        'nome_trabalho',
    ];

    public function user() {
        return this->belongsTo('User');
    }
}
