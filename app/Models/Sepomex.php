<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepomex extends Model
{
    use HasFactory;

    //protected $connection = 'mysql';
    protected $table = 'sepomex';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'idEstado',
        'estado',
        'idMunicipio',
        'municipio',
        'ciudad',
        'zona',
        'cp',
        'asentamiento',
        'tipo',
    ];
}
