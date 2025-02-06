<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpleadoSiccos;
use App\Models\EmpleadoSysprom;
use App\Models\MovimientoSysprom;
use App\Models\MovimientoSicoss;
use App\Models\ListaNegraIntraprom;
use App\Models\ListaNegraSysprom;

class ValidacionController extends Controller
{
    public function validarRFCSat(Request $request)
    {
        if (env('APP_DEBUG')) {
            return json_decode('
            {
                "codigo": "string",
                "mensaje": "string",
                "rfc": [
                    {
                    "rfc": "string",
                    "esValido": true,
                    "estatus": "string",
                    "usosCFDIPermitidos": "string"
                    }
                ]
                }
            ');
        } else {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://testapi.facturoporti.com.mx/validar/rfc', [
                'body' => '[{"rfc":"' . $request->rfc . '"}]',
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Bearer ' . env('SAT_KEY', 'unknow'),
                    'content-type' => 'application/*+json',
                ],
            ]);

            return $response->getBody();
        }
    }

    public function validarRFCSistema(Request $request)
    {
        //Se busca al empleado primero en sys_prom (si existe aqui por consiguiente existe en siccos)
        $empleado = EmpleadoSysprom::where('RFC', $request->rfc)->first();
        //EL EMPLEADO SE ENCUENTRA EN SYS_PROM
        if ($empleado) { // si el empleado existe en sys_prom
            if ($empleado->estatus == 'Precontrato') {
                return json_encode([
                    'existe' => null,
                    'sys_prom' => null,
                    'sicoss' => null,
                    'inactivo' => null,
                    'lista_negra' => null,
                    'mensaje' => 'El RFC se encuentra en proceso de precontrato [SysProm]',
                    'data' => $empleado
                ]);
            }
            //buscar su ultimo movimiento
            //(En sys_prom la columna que hace referencia al empleado es sicoss_id)
            $movimiento = MovimientoSysprom::where('empleado_id', $empleado->id)->orderBy('created_at', 'DESC')->first();
            if (!$movimiento) {
                //Si no existe ningun movimiento aún significa que inicio un proceso pero fue rechazado
                return json_encode([
                    'existe' => true,
                    'sys_prom' => true,
                    'sicoss' => true,
                    'inactivo' => true,
                    'lista_negra' => false,
                    'mensaje' => 'El RFC ' . $request->rfc . ' es apto para reingreso [SysProm]',
                    'data' => $empleado
                ]);
            }
            if ($movimiento->tipo == 'Baja') { //Si el último movimiento fue Baja se busca en lista negra
                $listaNegra = ListaNegraSysprom::where('empleado_id', $empleado->id)->first();
                if ($listaNegra) { //Si exxiste en lista negra se retorna la informacion
                    return json_encode([
                        'existe' => true,
                        'sys_prom' => true,
                        'sicoss' => true,
                        'inactivo' => true,
                        'lista_negra' => true,
                        'mensaje' => 'El RFC se encuentra en lista negra [SysProm]',
                        'data' => $empleado
                    ]);
                } else { //En esta parte el rfc es apto para reingreso desde SysProm
                    return json_encode([
                        'existe' => true,
                        'sys_prom' => true,
                        'sicoss' => true,
                        'inactivo' => true,
                        'lista_negra' => false,
                        'mensaje' => 'El RFC ' . $request->rfc . ' es apto para reingreso [SysProm]',
                        'data' => $empleado
                    ]);
                }
            } else {
                //Si es Alta, Modificacion, o Reingreso entonces es que esta activo por lo tanto no está en lista negra
                return json_encode([
                    'existe' => true,
                    'sys_prom' => true,
                    'sicoss' => true,
                    'inactivo' => false,
                    'lista_negra' => false,
                    'mensaje' => 'El RFC se encuentra en estado Activo [SysProm]',
                    'data' => $empleado
                ]);
            }
        }
        //EL EMPLEADO NO SE ENCUENTRA EN SYS_PROM AÚN
        else {
            //si aun no existe en sys_prom se busca al empleado en sicoss
            $empleado = EmpleadoSiccos::where('RFC', $request->rfc)->first();
            if ($empleado) { // si el empleado existe en siccos
                //buscar su último movimiento
                //(En sicoss la columna que hace referencia al empleado es Trab_ID)
                $movimiento = MovimientoSicoss::where('Trab_ID', $empleado->Trab_ID)->orderBy('FechaMov', 'DESC')->first();
                //Si el ultimo movimiento fue Baja
                if ($movimiento->Mov_ID == 'B') { //Se busca en lista negra
                    $listaNegra = ListaNegraIntraprom::where('SICOSS', $empleado->Trab_ID)->first();
                    if ($listaNegra) { //Si exxiste en lista negra se retorna la informacion
                        return json_encode([
                            'existe' => true,
                            'sys_prom' => false,
                            'sicoss' => true,
                            'inactivo' => true,
                            'lista_negra' => true,
                            'mensaje' => 'El RFC se encuentra en lista negra en [Sicoss]',
                            'data' => $empleado
                        ]);
                    } else { //En esta parte el rfc es apto para reingreso
                        return json_encode([
                            'existe' => true,
                            'sys_prom' => false,
                            'sicoss' => true,
                            'inactivo' => true,
                            'lista_negra' => false,
                            'mensaje' => 'El RFC ' . $request->rfc . ' es apto para reingreso [Sicoss]',
                            'data' => $empleado
                        ]);
                    }
                } else { //El empleado existe es sicoss pero se encuentra activo en algun programa
                    return json_encode([
                        'existe' => true,
                        'sys_prom' => false,
                        'sicoss' => true,
                        'inactivo' => false,
                        'lista_negra' => false,
                        'mensaje' => 'El RFC no se puede registrar ya que se encuentra en estado Activo [Sicoss]',
                        'data' => $empleado,
                    ]);
                }
            } else { //El empleado sera nuevo en el sistema
                return json_encode([
                    'existe' => false,
                    'sys_prom' => false,
                    'sicoss' => false,
                    'inactivo' => null,
                    'lista_negra' => null,
                    'mensaje' => 'El RFC es apto para alta de empleado',
                    'data' => null
                ]);
            }
        }
    }

    public function validarNssAlta(Request $request)
    {
        $empleadoSiccos = EmpleadoSiccos::where('IMSS', $request->nss)->first();
        $empleadoSysprom = EmpleadoSysprom::where('nss', $request->nss)->first();
        if ($empleadoSiccos || $empleadoSysprom) {
            return json_encode([
                'existe' => true,
                'mensaje' => 'El NSS ya se encuentra registrado en el sistema'
            ]);
        } else {
            return json_encode([
                'existe' => false,
                'mensaje' => 'El NSS es válido'
            ]);
        }
    }

    public function validarImportacion(Request $request)
    {
        $empleado = EmpleadoSiccos::where('RFC', $request->rfc)->first();
        if ($empleado) {
            $sysprom = EmpleadoSysprom::where('rfc', $empleado->RFC)->first();
            if ($sysprom) {
                return response()->json([
                    'estatus' => 'ERROR',
                    'mensaje' => 'El RFC ya se encuentra en Sysprom',
                    'data' => $sysprom,
                ]);
            } else {
                $listaNegra = ListaNegraIntraprom::where('SICOSS', $empleado->Trab_ID)->first();
                if ($listaNegra) {
                    return response()->json([
                        'estatus' => 'ERROR',
                        'mensaje' => 'El RFC se encuentra en lista negra',
                        'data' => $empleado
                    ]);
                } else {
                    return response()->json([
                        'estatus' => 'OK',
                        'mensaje' => 'El RFC es apto para importación',
                        'data' => $empleado
                    ]);
                }
            }
        } else {
            return response()->json([
                'estatus' => 'ERROR',
                'mensaje' => 'El RFC no exixte en siccoss'
            ]);
        }
    }
}
