<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'data_orientacao',
        'assunto',
        'prox_assunto',
        'observacao',
        'presenca'
    ];

    protected $hidden = [
        'aluno_id',
        'orientador_id'
    ];

    public function aluno() {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function orientador() {
        return $this->belongsTo(Orientador::class, 'orientador_id');
    }
}
