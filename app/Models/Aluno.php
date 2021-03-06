<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Orientador;
use App\Models\Turma;

class Aluno extends Model
{
    use HasFactory;
    use Sortable;

    public $timestamps = false;

    public $fillable = [
        'id',
        'nome_aluno',
        'curso',
        'matricula',
        'email',
        'nome_trabalho',
        'turma_id',
        'orientador_id',
        'user_id',
    ];

    public $sortable = [
        'id',
        'nome_aluno',
        'turma_id',
        'curso',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orientador()
    {
        return $this->belongsTo(Orientador::class, 'orientador_id');
    }
}
