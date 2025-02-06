<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaNegraIntraprom extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_intraprom';
    protected $table = 'LN_TEContratacion';
    protected $primaryKey = 'Folio';
    public $timestamps = false;

    protected $fillable = [
        'Folio',
        'SICOSS',
        'Descripcion',
        'Fecha',
    ];
}
