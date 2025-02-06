<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIntraprom extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_intraprom';
    protected $table = 'tUsuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps = false;

    protected $fillable = [
        'idusuario',
        'Usuario',
        'PWD',
        'Nombre',
        'nivel',
        'id_dc',
        'mail',
        'ext',
        'N800',
        'celprom',
        'status',
        'plaza',
        'idsicoss',
    ];
}
