<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $table = 'configuraciones';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'salario_minimo_resto_pais',
        'salario_minimo_frontera',
        'reembolso_gasolina',
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
}
