<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoSysprom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sys_prom_movimientos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'autor_id',
        'proceso_id',
        'empleado_id',
        'consecutivo',
        'tipo',
        'estatus',
    ];

    public function autor()
    {
        return $this->hasOne(User::class, 'id', 'autor_id');
    }

    public function empleado()
    {
        return $this->hasOne(EmpleadoSysprom::class, 'id', 'empleado_id');
    }

    public function proceso()
    {
        return $this->hasOne(ProcesoSysprom::class, 'id', 'proceso_id');
    }
}
