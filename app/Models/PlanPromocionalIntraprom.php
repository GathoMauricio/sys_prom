<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPromocionalIntraprom extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_intraprom';
    protected $table = 'Cuentas';
    protected $primaryKey = 'IDCUENTA';
    public $timestamps = false;

    protected $fillable = [
        'IDCUENTA',
        'NCUENTA',
        'IDCC',
    ];
}
