<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_orientacao extends Model
{
    use HasFactory;

    public $fields = [
        'dia',
        'hora'
    ];
}
