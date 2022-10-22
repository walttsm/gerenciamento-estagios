<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documentos_estagio';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'local_arquivo',
        'arquivo_title',
        'doc_nome',
    ];
}
