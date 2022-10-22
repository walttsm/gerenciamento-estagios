<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Horario_orientacao extends Model
{
    use HasFactory, Sortable;

    protected $table = "horario_orientacoes";

    public $fillable = [
        'dia',
        'hora',
        'aluno_id',
        'orientador_id'
    ];

    protected $hidden = [
        'aluno_id',
        'orientador_id'
    ];

    public $sortable = [
        'dia',
        'hora',
        'aluno_id',
    ];

    public function orientador() {
        return $this->belongsTo(Orientador::class, 'orientador_id', 'id');
    }

    public function aluno() {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }
}
