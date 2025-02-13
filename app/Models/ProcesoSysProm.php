<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcesoSysProm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sys_prom_procesos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'autor_id',
        'empleado_id',
        'tipo',
        'estatus',
        'estatus_documentacion',
        'estatus_doc_solicitud_empleo',
        'estatus_doc_fotografia',
        'estatus_doc_ine',
        'estatus_doc_acta_nacimiento',
        'estatus_doc_nss',
        'estatus_doc_comprobante_domicilio',
        'estatus_doc_comprobante_estudios',
        'estatus_doc_curp',
        'estatus_doc_csf',
        'estatus_doc_soporte_bancario',
        'estatus_doc_contrato',
        'json_empleado',
    ];

    public function autor()
    {
        return $this->hasOne(User::class, 'idusuario', 'autor_id');
    }

    public function empleado()
    {
        return $this->hasOne(EmpleadoSysprom::class, 'id', 'empleado_id');
    }

    public function seguimientos()
    {
        return $this->hasMany('App\Models\SeguimientoSysProm', 'proceso_id')->orderBy('id', 'DESC');
    }
}
