<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcesoSysProm;
use App\Models\EmpleadoSysprom;
use App\Models\CentroCostoIntraprom;
use App\Models\PlanPromocionalIntraprom;
use App\Models\MovimientoSysprom;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProcesoController extends Controller
{
    public function index(Request $request)
    {
        $procesos = ProcesoSysProm::where('estatus', 'Precontrato');
        if ($request->rfc) {
            $procesos = $procesos->leftJoin('sys_prom_empleados', 'sys_prom_procesos.empleado_id', 'sys_prom_empleados.id')->where('sys_prom_empleados.rfc', $request->rfc);
        }
        $procesos = $procesos->get();
        return view('proceso.index', compact('procesos'));
    }

    public function indexDescargas(Request $request)
    {
        $procesos = ProcesoSysProm::where('sys_prom_procesos.estatus', 'Contrato');
        if ($request->rfc) {
            $procesos = $procesos->leftJoin('sys_prom_empleados', 'sys_prom_procesos.empleado_id', 'sys_prom_empleados.id')->where('sys_prom_empleados.rfc', $request->rfc);
        }
        $procesos = $procesos->get();
        return view('proceso.index_descargas', compact('procesos'));
    }

    public function aprobarDocumentacion(Request $request)
    {
        $proceso = ProcesoSysProm::find($request->proceso_id);
        $proceso->estatus_documentacion = "Aprobado";
        $proceso->json_empleado = $proceso->empleado->toJson();
        if ($proceso->save()) {
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'LA documentación ha sido aprobada,'
            ]);
        }
        return $proceso;
    }

    public function aprobarDocumento(Request $request)
    {
        $proceso = ProcesoSysProm::find($request->proceso_id);
        $proceso['estatus_' . $request->documento] = "Aprobado";
        $proceso->json_empleado = $proceso->empleado->toJson();
        if ($proceso->save()) {
            //comprobar si todos los documentos han sido aprobados para actualizar el estatus de la documentación en general
            if (
                $proceso->estatus_doc_solicitud_empleo == 'Aprobado' &&
                $proceso->estatus_doc_fotografia == 'Aprobado' &&
                $proceso->estatus_doc_ine == 'Aprobado' &&
                $proceso->estatus_doc_acta_nacimiento == 'Aprobado' &&
                $proceso->estatus_doc_nss == 'Aprobado' &&
                $proceso->estatus_doc_comprobante_domicilio == 'Aprobado' &&
                $proceso->estatus_doc_comprobante_estudios == 'Aprobado' &&
                $proceso->estatus_doc_curp == 'Aprobado' &&
                $proceso->estatus_doc_csf == 'Aprobado' &&
                $proceso->estatus_doc_soporte_bancario == 'Aprobado' &&
                $proceso->estatus_doc_contrato == 'Aprobado'
            ) {
                $proceso->estatus_documentacion = "Aprobado";
                $proceso->save();
            }
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'El documento ha sido aprobado,'
            ]);
        }
        return $proceso;
    }

    public function rechazarDocumento(Request $request)
    {
        $proceso = ProcesoSysProm::find($request->proceso_id);
        $proceso['estatus_' . $request->documento] = "Rechazado";
        $proceso->json_empleado = $proceso->empleado->toJson();
        if ($proceso->save()) {
            //TODO:Email al reclutador q creo el proceso
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'El documento ha sido rechazado,'
            ]);
        }
        return $proceso;
    }

    public function capturaEmpleado($proceso_iud)
    {
        $proceso_iud = base64_decode($proceso_iud);
        $proceso = ProcesoSysProm::find($proceso_iud);
        $empleado = new EmpleadoSysprom();
        $empleado->fill(json_decode($proceso->json_empleado, true));
        $empleado->id = $proceso->empleado->id;
        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        $plan = PlanPromocionalIntraprom::find($empleado->pp);
        return view('proceso.captura_empleado', compact('proceso', 'empleado', 'centros', 'plan'));
    }

    public function descargaTxt($proceso_id)
    {
        $proceso = ProcesoSysprom::find($proceso_id);
        Storage::disk('public')->put('documentos/' . $proceso->empleado->id . '/' . $proceso->empleado->rfc . '_' . explode(' ', $proceso->updated_at)[0] . '.txt', $proceso->json_empleado);
        return response()->download(storage_path('app/public/documentos/' . $proceso->empleado->id . '/' . $proceso->empleado->rfc . '_' . explode(' ', $proceso->updated_at)[0] . '.txt'));
    }

    public function aprobarProceso(Request $request)
    {
        $proceso = ProcesoSysProm::find($request->proceso_id);
        $proceso->estatus = "Contrato";
        $proceso->empleado->estatus = "Contrato";
        $proceso->empleado->save();
        $proceso->json_empleado = $proceso->empleado->toJson();

        $ultimo_movimiento = MovimientoSysprom::where('empleado_id', $proceso->empleado->id)->orderBy('created_at', 'DESC')->first();
        if (!$ultimo_movimiento)
            $consecutivo = 0;
        else
            $consecutivo = (int) $ultimo_movimiento->consecutivo + 1;

        MovimientoSysprom::create([
            'autor_id' => Auth::user()->idusuario,
            'proceso_id' => $proceso->id,
            'empleado_id' => $proceso->empleado->id,
            'consecutivo' => $consecutivo,
            'tipo' => $proceso->tipo,
        ]);

        if ($proceso->save()) {
            //TODO:Email al que creo el proceso y a los de rh para validar documentacion
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'El estatus del proceso ha sido actualizado,'
            ]);
        }
        return $proceso;
    }

    public function rechazarProceso(Request $request)
    {
        $proceso = ProcesoSysProm::find($request->proceso_id);
        $proceso->estatus = "Rechazado";
        $proceso->empleado->estatus = "StandBy";
        $proceso->empleado->save();
        $proceso->json_empleado = $proceso->empleado->toJson();

        if ($proceso->save()) {
            //TODO:Email al que creo el proceso
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'El estatus del proceso ha sido actualizado,'
            ]);
        }
    }
}
