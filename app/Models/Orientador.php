<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
