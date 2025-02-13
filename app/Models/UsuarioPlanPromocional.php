<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPlanPromocional extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_intraprom';
    protected $table = 'TUsuarioCtaModulo';
    //protected $primaryKey = '';
    public $timestamps = false;

    protected $fillable = [
        'IdUsuario',
        'IdCuenta',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'idusuario', 'IdUsuario');
    }

    public function plan()
    {
        return $this->hasOne(PlanPromocionalIntraprom::class, 'IDCUENTA', 'IdCuenta');
    }
}
