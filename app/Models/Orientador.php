<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Orientador extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = 'orientadores';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'curso',
        'email',
        'user_id',
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
