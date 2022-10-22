<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Rpod extends Model
{
    use HasFactory, Sortable;
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

    
}
