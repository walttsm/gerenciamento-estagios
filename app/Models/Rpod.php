<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rpod extends Model
{
    use HasFactory, Sortable;
    use SoftDeletes;
    protected $table = 'rpod';
    public $timestamps = false;

    public $fields = [
        'mes',
        'local_arquivo',
        'horas_mes',
    ];

    protected $fillable = [
        'mes',
        'local_arquivo',
        'horas_mes',
    ];


    public $sortable = [
        'mes'
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }
    public function orientador(){
        return $this->belongsTo(Orientafor::class, 'orientador_id');
    }
}
