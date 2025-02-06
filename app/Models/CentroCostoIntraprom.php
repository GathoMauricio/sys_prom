<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroCostoIntraprom extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_intraprom';
    protected $table = 'Centrocostos';
    protected $primaryKey = 'IDCC';
    public $timestamps = false;

    protected $fillable = [
        'IDCC',
        'CC',
    ];
}
