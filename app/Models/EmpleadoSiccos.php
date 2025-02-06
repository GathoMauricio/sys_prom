<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoSiccos extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_sicoss';
    protected $table = 'Empleado';
    protected $primaryKey = 'Trab_ID';
    public $timestamps = false;

    protected $fillable = [
        'Trab_ID',
        'CURP',
        'Banco_ID',
        'Paterno',
        'Materno',
        'Nombre',
        'IMSS',
        'RFC',
        'FechaIngreso',
        'Depto_ID',
        'Puesto_ID',
        'Ocupacion',
        'Actualizado',
        'Observacion',
        'FechaNacimiento',
        'NacimientoLugar',
        'Sexo_IDa',
        'EstadoCivil_IDa',
        'FechaCasado',
        'CasadoLugar',
        'Calle',
        'Colonia',
        'CP',
        'Estado',
        'Ciudad',
        'Cartilla',
        'Pasaporte',
        'Permiso',
        'Nacion_ID',
        'Estudio_IDa',
        'Valuacion_ID',
        'InfonavitTipo_IDa',
        'FechaInfonavitInicio',
        'FechaInfonavitFinal',
        'Infonavit',
        'InfonavitMantenimiento',
        'InfonavitAbono',
        'Fonacot',
        'Vacaciones',
        'InterfazFaltas',
        'CotizaIMSS',
        'CotizaRetiro',
        'CotizaInfonavit',
        'HorasJornada',
        'MesIMSS',
        'MesNomina',
        'TipoISPT_IDa',
        'ISPTNoAnual',
        'TipoPago_IDa',
        'UltimoDiaPagado',
        'CuentaDeposito',
        'Sucursal',
        'UnidadMedica',
        'UbicacionPago_ID',
        'Sindicato_ID',
        'Reporta_ID',
        'PagaHorasExtras',
        'Lector_ID',
        'AntiguedadAnterior',
        'Articulo33',
        'Padre',
        'Madre',
        'Pension_ID',
        'BancoDeposito',
        'BancoPlaza',
        'NIP',
        'Telefono',
        'CuentaContable',
        'Descripcion_tipopago',
        'Cuenta_pago_existe',
        'Clabe',
        'Numero',
        'Tarjeta_ID',
        'StatusBloqueo',
        'FechaVacaciones',
        'Importa',
        'User_ID',
        'FechaImportacion',
        'FechaCaptura',
    ];

    public function lista_negra()
    {
        return $this->hasMany('App\Models\ListaNegraIntraprom', 'SICOSS', 'Trab_ID');
    }

    public function activo()
    {
        $movimiento = MovimientoSicoss::where('Trab_ID', $this->Trab_ID)->orderBy('FechaMov', 'DESC')->first();
        if ($movimiento->Mov_ID == 'B') {
            return "NO";
        } else {
            return "SI";
        }
    }
}
