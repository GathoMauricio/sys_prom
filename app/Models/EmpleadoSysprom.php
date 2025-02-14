<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoSysprom extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'sqlsrv';
    protected $table = 'sys_prom_empleados';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'origen',
        'tipo',
        'estatus',
        'sicoss_id',
        'sepomex_id',
        'nombre',
        'apaterno',
        'amaterno',
        'fecha_nacimiento',
        'nss',
        'rfc',
        'estado_nacimiento',
        'cp',
        'estado',
        'delegacion',
        'colonia',
        'calle_numero',
        'banco',
        'numero_cuenta',
        'telefono_casa',
        'telefono_celular',
        'email',
        'cc',
        'pp',
        'fecha_ingreso',
        'fecha_imss',
        'puesto',
        'id_puesto',
        'tipo_sueldo_diario',
        'sueldo_diario',
        'premio_puntualidad',
        'premio_puntualidad_cant',
        'premio_asistencia',
        'premio_asistencia_cant',
        'despensa',
        'despensa_cant',
        'reembolso_gasolina',
        'reembolso_gasolina_cant',
        'doc_solicitud_empleo',
        'doc_fotografia',
        'doc_ine',
        'doc_acta_nacimiento',
        'doc_nss',
        'doc_comprobante_domicilio',
        'doc_comprobante_estudios',
        'doc_curp',
        'doc_csf',
        'doc_soporte_bancario',
        'doc_contrato',
    ];

    public function procesos()
    {
        return $this->hasMany('App\Models\ProcesoSysProm', 'empleado_id')->orderBy('id', 'DESC');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Models\MovimientoSysProm', 'empleado_id')->orderBy('id', 'DESC');
    }

    public function lista_negra()
    {
        return $this->hasMany('App\Models\ListaNegraSysProm', 'empleado_id')->orderBy('id', 'DESC');
    }
}
