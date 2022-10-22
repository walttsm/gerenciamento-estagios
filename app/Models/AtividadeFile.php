<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeFile extends Model
{
    use HasFactory;
    protected $table = 'atividade_files';

    protected $fillable = [
        'local_arquivo',
        'arquivo_title'
    ];
}
