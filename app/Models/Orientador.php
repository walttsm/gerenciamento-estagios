<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Aluno;
use Kyslik\ColumnSortable\Sortable;

class Orientador extends Model
{
    use HasFactory, Sortable;

    protected $table = 'orientadores';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'curso',
        'email',
    ];

    public $sortable = [
        'nome',
        'curso',
        'email',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function alunos() {
        return $this->hasMany(Aluno::class);
    }

    public function bancas() {
        return $this->hasMany(Aluno::class);
    }
}
