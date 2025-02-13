<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeguimientoSysProm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sys_prom_seguimientos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'autor_id',
        'proceso_id',
        'contenido',
    ];

    public function autor()
    {
        return $this->hasOne(User::class, 'idusuario', 'autor_id');
    }

    public function proceso()
    {
        return $this->hasOne(ProcesoSysProm::class, 'id', 'proceso_id');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->setTimezone('America/Mexico_City')->format('Y-m-d H:i');
    }
}
