<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Aluno;

class Orientador extends Model
{
    use HasFactory;

    protected $table = 'orientadores';
    public $timestamps = false;

    protected $fillable = [
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
