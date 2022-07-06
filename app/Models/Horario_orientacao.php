<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_orientacao extends Model
{
    use HasFactory;

    protected $table = "horario_orientacoes";

    public $fillable = [
        'dia',
        'hora',
        'aluno_id',
        'orientador_id'
    ];

    public function Orientador() {
        return $this->belongsTo(Orientador::class, 'orientador_id', 'id');
    }
}
