<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rpod extends Model
{
    use HasFactory;
    protected $table = 'rpod';
    public $timestamps = false;

    public $fields = [
        'mes',
        'local_arquivo',
        'horas_mes',
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }
    public function orientador(){
        return $this->belongsTo(Orientafor::class, 'orientador_id');
    }
}
