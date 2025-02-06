<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoSicoss extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_sicoss';
    protected $table = 'Movimiento';
    //protected $primaryKey = 'Trab_ID';
    public $timestamps = false;

    protected $fillable = [
        'Trab_ID',
        'MovID',
        'FechaMov',
    ];

    public function empleado()
    {
        return $this->hasOne(EmpleadoSiccos::class, 'Trab_ID', 'Trab_ID');
    }
}
