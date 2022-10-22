<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aviso extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'aviso';
    
    public $fillable = [
        'aviso_titulo',
        'aviso_conteudo',
        'alunos'
    ];
    protected $hidden = [
        'alunos' => 'array',
        'orientador_id'
    ];
    public function orientador() {
        return $this->belongsTo(Orientador::class, 'orientador_id');
    }
}
