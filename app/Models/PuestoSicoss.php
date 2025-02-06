<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestoSicoss extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_sicoss';
    protected $table = 'TBPuesto';
    //protected $primaryKey = 'Puesto_ID';
    public $timestamps = false;

    protected $fillable = [
        'Puesto_ID',
        'Descripcion',
    ];
}
