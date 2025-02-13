<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroCostoIntraprom;
use App\Models\PlanPromocionalIntraprom;
use App\Models\EmpleadoSiccos;
use App\Models\EmpleadoSysprom;
use App\Models\ProcesoSysprom;
use App\Models\MovimientoSysprom;
use App\Models\PuestoSicoss;
use App\Models\ListaNegraSysprom;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{

    public function show($empleado_id)
    {
        $empleado_id = base64_decode($empleado_id);
        $empleado = EmpleadoSysprom::find($empleado_id);
        return view('empleado.show', compact('empleado'));
    }

    public function indexSysprom(Request $request)
    {
        $empleados = new EmpleadoSysprom();
        if ($request->rfc) {
            $empleados = $empleados->where('rfc', $request->rfc);
        }
        $empleados = $empleados->orderBy('rfc')->paginate(15);
        return view('empleado.index_sysprom', compact('empleados'));
    }

    public function indexSicoss(Request $request)
    {
        $empleados = new EmpleadoSiccos();
        if ($request->rfc) {
            $empleados = $empleados->where('RFC', $request->rfc);
        }
        $empleados = $empleados->orderBy('rfc')->paginate(15);
        return view('empleado.index_sicoss', compact('empleados'));
    }

    public function create($rfc)
    {
        $rfc = base64_decode($rfc);
        $parts = explode('-', $rfc);
        $anio = (int) substr($parts[1], 0, 2);
        if ($anio > 50 && $anio <= 99) {
            $fecha_nacimiento = '19' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        } else {
            $fecha_nacimiento = '200' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        }
        $estados = DB::table('sepomex')
            ->select('estado')
            ->distinct()
            ->get();
        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        $configuracion = Configuracion::first();
        return view('empleado.alta_empleado', compact('rfc', 'estados', 'fecha_nacimiento', 'centros', 'configuracion'));
    }

    public function storeIngreso(Request $request)
    {
        $empleado = EmpleadoSysprom::create($request->all());
        $empleado->origen = "SysProm";
        $empleado->tipo = "Alta";
        $empleado->estatus = "Precontrato";

        $proceso = ProcesoSysprom::create([
            'autor_id' => Auth::user()->idusuario,
            'empleado_id' => $empleado->id,
            'tipo' => 'Alta',
            'estatus' => 'Precontrato',
            'json_empleado' => $empleado->toJson(),
        ]);
        //TODO: email al ejecutivo

        if ($request->file('doc_solicitud_empleo'))
            $empleado->doc_solicitud_empleo = $this->guardarDocumento($request->file('doc_solicitud_empleo'), $empleado->id);
        if ($request->file('doc_fotografia'))
            $empleado->doc_fotografia = $this->guardarDocumento($request->file('doc_fotografia'), $empleado->id);
        if ($request->file('doc_ine'))
            $empleado->doc_ine = $this->guardarDocumento($request->file('doc_ine'), $empleado->id);
        if ($request->file('doc_acta_nacimiento'))
            $empleado->doc_acta_nacimiento = $this->guardarDocumento($request->file('doc_acta_nacimiento'), $empleado->id);
        if ($request->file('doc_nss'))
            $empleado->doc_nss = $this->guardarDocumento($request->file('doc_nss'), $empleado->id);
        if ($request->file('doc_comprobante_domicilio'))
            $empleado->doc_comprobante_domicilio = $this->guardarDocumento($request->file('doc_comprobante_domicilio'), $empleado->id);
        if ($request->file('doc_comprobante_estudios'))
            $empleado->doc_comprobante_estudios = $this->guardarDocumento($request->file('doc_comprobante_estudios'), $empleado->id);
        if ($request->file('doc_curp'))
            $empleado->doc_curp = $this->guardarDocumento($request->file('doc_curp'), $empleado->id);
        if ($request->file('doc_csf'))
            $empleado->doc_csf = $this->guardarDocumento($request->file('doc_csf'), $empleado->id);
        if ($request->file('doc_soporte_bancario'))
            $empleado->doc_soporte_bancario = $this->guardarDocumento($request->file('doc_soporte_bancario'), $empleado->id);
        if ($request->file('doc_contrato'))
            $empleado->doc_contrato = $this->guardarDocumento($request->file('doc_contrato'), $empleado->id);
        $empleado->save();
        $proceso->json_empleado = $empleado->toJson();
        $proceso->save();
        $rfc = base64_encode($empleado->rfc);
        return redirect()->route('seguimiento_empleado', urlencode($rfc))->with('message', 'La información ha sido enviada.');
    }

    public function edit($rfc)
    {
        $rfc = base64_decode($rfc);
        $empleado = EmpleadoSysprom::where('rfc', $rfc)->first();
        if (!$empleado) return abort(404);
        $parts = explode('-', $rfc);
        $anio = (int) substr($parts[1], 0, 2);
        if ($anio > 50 && $anio <= 99) {
            $fecha_nacimiento = '19' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        } else {
            $fecha_nacimiento = '200' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        }
        $estados = DB::table('sepomex')
            ->select('estado')
            ->distinct()
            ->get();
        $estado_nacimiento = ucfirst(strtolower($empleado->NacimientoLugar));
        $plan = PlanPromocionalIntraprom::find($empleado->pp);
        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        $puestos = PuestoSicoss::orderBy('Descripcion')->get();
        return view('empleado.seguimiento_empleado', compact('rfc', 'estados', 'fecha_nacimiento', 'centros', 'plan', 'empleado', 'estado_nacimiento', 'puestos'));
    }

    public function update(Request $request, $id)
    {
        $puesto = explode('-', $request->puesto)[1];
        $request->merge(['puesto' => $puesto]);
        $empleado = EmpleadoSysprom::find($id);

        if ($empleado->update($request->all())) {
            $proceso = $empleado->procesos[0];
            $proceso->json_empleado = $empleado->toJson();
            $proceso->save();
            $rfc = base64_encode($empleado->rfc);
            return redirect()->route('seguimiento_empleado', urlencode($rfc))->with('message', 'La información ha sido actualizada.');
        }
    }

    public function reingresoSicoss($rfc)
    {
        $rfc = base64_decode($rfc);
        $empleado = EmpleadoSiccos::where('RFC', $rfc)->first();
        $parts = explode('-', $rfc);
        $anio = (int) substr($parts[1], 0, 2);
        if ($anio > 50 && $anio <= 99) {
            $fecha_nacimiento = '19' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        } else {
            $fecha_nacimiento = '200' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        }
        $estados = DB::table('sepomex')
            ->select('estado')
            ->distinct()
            ->get();
        $estado_nacimiento = ucfirst(strtolower($empleado->NacimientoLugar));

        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        $configuracion = Configuracion::first();
        return view('empleado.reingreso_empleado_sicoss', compact('rfc', 'estados', 'fecha_nacimiento', 'centros', 'empleado', 'estado_nacimiento', 'configuracion'));
    }

    public function storeReingresoSicoss(Request $request)
    {
        $empleado = EmpleadoSysprom::create($request->all());
        $empleado->origen = "Sicoss";
        $empleado->tipo = "Reingreso";
        $empleado->estatus = "Precontrato";
        $empleado->save();

        $proceso = ProcesoSysprom::create([
            'autor_id' => Auth::user()->idusuario,
            'empleado_id' => $empleado->id,
            'tipo' => 'Reingreso',
            'estatus' => 'Precontrato',
            'json_empleado' => $empleado->toJson(),
        ]);

        //TODO: email al ejecutivo

        if ($request->file('doc_solicitud_empleo'))
            $empleado->doc_solicitud_empleo = $this->guardarDocumento($request->file('doc_solicitud_empleo'), $empleado->id);
        if ($request->file('doc_fotografia'))
            $empleado->doc_fotografia = $this->guardarDocumento($request->file('doc_fotografia'), $empleado->id);
        if ($request->file('doc_ine'))
            $empleado->doc_ine = $this->guardarDocumento($request->file('doc_ine'), $empleado->id);
        if ($request->file('doc_acta_nacimiento'))
            $empleado->doc_acta_nacimiento = $this->guardarDocumento($request->file('doc_acta_nacimiento'), $empleado->id);
        if ($request->file('doc_nss'))
            $empleado->doc_nss = $this->guardarDocumento($request->file('doc_nss'), $empleado->id);
        if ($request->file('doc_comprobante_domicilio'))
            $empleado->doc_comprobante_domicilio = $this->guardarDocumento($request->file('doc_comprobante_domicilio'), $empleado->id);
        if ($request->file('doc_comprobante_estudios'))
            $empleado->doc_comprobante_estudios = $this->guardarDocumento($request->file('doc_comprobante_estudios'), $empleado->id);
        if ($request->file('doc_curp'))
            $empleado->doc_curp = $this->guardarDocumento($request->file('doc_curp'), $empleado->id);
        if ($request->file('doc_csf'))
            $empleado->doc_csf = $this->guardarDocumento($request->file('doc_csf'), $empleado->id);
        if ($request->file('doc_soporte_bancario'))
            $empleado->doc_soporte_bancario = $this->guardarDocumento($request->file('doc_soporte_bancario'), $empleado->id);
        if ($request->file('doc_contrato'))
            $empleado->doc_contrato = $this->guardarDocumento($request->file('doc_contrato'), $empleado->id);
        $empleado->save();
        $proceso->json_empleado = $empleado->toJson();
        $proceso->save();
        $rfc = base64_encode($empleado->rfc);
        return redirect()->route('seguimiento_empleado', urlencode($rfc))->with('message', 'La información ha sido enviada.');
    }

    public function reingresoSysprom($rfc)
    {
        $rfc = base64_decode($rfc);
        $empleado = EmpleadoSysprom::where('rfc', $rfc)->first();
        $parts = explode('-', $rfc);
        $anio = (int) substr($parts[1], 0, 2);
        if ($anio > 50 && $anio <= 99) {
            $fecha_nacimiento = '19' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        } else {
            $fecha_nacimiento = '200' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        }
        $estados = DB::table('sepomex')
            ->select('estado')
            ->distinct()
            ->get();
        $estado_nacimiento = ucfirst(strtolower($empleado->NacimientoLugar));

        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        return view('empleado.reingreso_empleado_sysprom', compact('rfc', 'estados', 'fecha_nacimiento', 'centros', 'empleado', 'estado_nacimiento'));
    }

    public function storeReingresoSysprom(Request $request)
    {
        $empleado = EmpleadoSysprom::where('rfc', $request->rfc)->first();
        $empleado->update($request->all());
        $empleado->origen = "Sysprom";
        $empleado->tipo = "Reingreso";
        $empleado->estatus = "Precontrato";
        $empleado->save();

        $proceso = ProcesoSysprom::create([
            'autor_id' => Auth::user()->idusuario,
            'empleado_id' => $empleado->id,
            'tipo' => 'Reingreso',
            'estatus' => 'Precontrato',
            'json_empleado' => $empleado->toJson(),
        ]);

        //TODO: email al ejecutivo

        $proceso->json_empleado = $empleado->toJson();
        $proceso->save();
        $rfc = base64_encode($empleado->rfc);
        return redirect()->route('seguimiento_empleado', urlencode($rfc))->with('message', 'La información ha sido enviada.');
    }

    public function actualizarDocumento(Request $request)
    {
        $empleado = EmpleadoSysprom::find($request->empleado_id);

        if ($request->file('doc_solicitud_empleo')) {
            $empleado->doc_solicitud_empleo = $this->guardarDocumento($request->file('doc_solicitud_empleo'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_solicitud_empleo'} = 'Pendiente';
        }


        if ($request->file('doc_fotografia')) {
            $empleado->doc_fotografia = $this->guardarDocumento($request->file('doc_fotografia'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_fotografia'} = 'Pendiente';
        }

        if ($request->file('doc_ine')) {
            $empleado->doc_ine = $this->guardarDocumento($request->file('doc_ine'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_ine'} = 'Pendiente';
        }

        if ($request->file('doc_acta_nacimiento')) {
            $empleado->doc_acta_nacimiento = $this->guardarDocumento($request->file('doc_acta_nacimiento'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_acta_nacimiento'} = 'Pendiente';
        }

        if ($request->file('doc_nss')) {
            $empleado->doc_nss = $this->guardarDocumento($request->file('doc_nss'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_nss'} = 'Pendiente';
        }

        if ($request->file('doc_comprobante_domicilio')) {
            $empleado->doc_comprobante_domicilio = $this->guardarDocumento($request->file('doc_comprobante_domicilio'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_comprobante_domicilio'} = 'Pendiente';
        }

        if ($request->file('doc_comprobante_estudios')) {
            $empleado->doc_comprobante_estudios = $this->guardarDocumento($request->file('doc_comprobante_estudios'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_comprobante_estudios'} = 'Pendiente';
        }

        if ($request->file('doc_curp')) {
            $empleado->doc_curp = $this->guardarDocumento($request->file('doc_curp'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_curp'} = 'Pendiente';
        }

        if ($request->file('doc_csf')) {
            $empleado->doc_csf = $this->guardarDocumento($request->file('doc_csf'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_csf'} = 'Pendiente';
        }

        if ($request->file('doc_soporte_bancario')) {
            $empleado->doc_soporte_bancario = $this->guardarDocumento($request->file('doc_soporte_bancario'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_soporte_bancario'} = 'Pendiente';
        }

        if ($request->file('doc_contrato')) {
            $empleado->doc_contrato = $this->guardarDocumento($request->file('doc_contrato'), $empleado->id);
            if (str_contains(request()->header('referer'), 'seguimiento_empleado'))
                $empleado->procesos[0]->{'estatus_' . 'doc_contrato'} = 'Pendiente';
        }
        $empleado->procesos[0]->save();
        if ($empleado->save())

            return redirect()->back()->with('message', 'El documento se actualizó correctamente.');
        else
            abort(500);
    }

    private function guardarDocumento($documento, $empleado_id)
    {
        $max_size = (int)ini_get('upload_max_filesize') * 10240;
        $ruta_completa = $documento->store('public/documentos/' . $empleado_id);
        $partes = explode('/', $ruta_completa);
        $nombre_archivo = $partes[3];
        return $nombre_archivo;
    }

    public function quitarListaNegra(Request $request)
    {
        $lista_negra = ListaNegraSysprom::where('empleado_id', $request->empleado_id);
        if ($lista_negra->delete()) {
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'Se ha quitado al empleado de la lista negra'
            ]);
        }
    }

    public function enviarListaNegra(Request $request)
    {
        $lista_negra = ListaNegraSysprom::create(
            [
                'autor_id' => Auth::user()->idusuario,
                'empleado_id' => $request->empleado_id,
                'motivo' => $request->motivo,
            ]
        );
        if ($lista_negra) {
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'Se ha enviado al empleado a la lista negra'
            ]);
        }
    }

    public function importarEmpleado($rfc)
    {
        $rfc = base64_decode($rfc);
        $empleado = EmpleadoSiccos::where('RFC', $rfc)->first();
        $parts = explode('-', $rfc);
        $anio = (int) substr($parts[1], 0, 2);
        if ($anio > 50 && $anio <= 99) {
            $fecha_nacimiento = '19' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        } else {
            $fecha_nacimiento = '200' . $anio . '-' . substr($parts[1], 2, 2) . '-' . substr($parts[1], 4);
        }
        $estados = DB::table('sepomex')
            ->select('estado')
            ->distinct()
            ->get();
        $estado_nacimiento = ucfirst(strtolower($empleado->NacimientoLugar));

        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        $configuracion = Configuracion::first();
        return view('empleado.importacion', compact('rfc', 'estados', 'fecha_nacimiento', 'centros', 'empleado', 'estado_nacimiento', 'configuracion'));
    }

    public function storeImportacion(Request $request)
    {
        $empleado = EmpleadoSysprom::create($request->all());
        $empleado->origen = "Sicoss";
        $empleado->tipo = "Importado";
        $empleado->estatus = "StandBy";
        $empleado->save();

        if ($request->file('doc_solicitud_empleo'))
            $empleado->doc_solicitud_empleo = $this->guardarDocumento($request->file('doc_solicitud_empleo'), $empleado->id);
        if ($request->file('doc_fotografia'))
            $empleado->doc_fotografia = $this->guardarDocumento($request->file('doc_fotografia'), $empleado->id);
        if ($request->file('doc_ine'))
            $empleado->doc_ine = $this->guardarDocumento($request->file('doc_ine'), $empleado->id);
        if ($request->file('doc_acta_nacimiento'))
            $empleado->doc_acta_nacimiento = $this->guardarDocumento($request->file('doc_acta_nacimiento'), $empleado->id);
        if ($request->file('doc_nss'))
            $empleado->doc_nss = $this->guardarDocumento($request->file('doc_nss'), $empleado->id);
        if ($request->file('doc_comprobante_domicilio'))
            $empleado->doc_comprobante_domicilio = $this->guardarDocumento($request->file('doc_comprobante_domicilio'), $empleado->id);
        if ($request->file('doc_comprobante_estudios'))
            $empleado->doc_comprobante_estudios = $this->guardarDocumento($request->file('doc_comprobante_estudios'), $empleado->id);
        if ($request->file('doc_curp'))
            $empleado->doc_curp = $this->guardarDocumento($request->file('doc_curp'), $empleado->id);
        if ($request->file('doc_csf'))
            $empleado->doc_csf = $this->guardarDocumento($request->file('doc_csf'), $empleado->id);
        if ($request->file('doc_soporte_bancario'))
            $empleado->doc_soporte_bancario = $this->guardarDocumento($request->file('doc_soporte_bancario'), $empleado->id);
        if ($request->file('doc_contrato'))
            $empleado->doc_contrato = $this->guardarDocumento($request->file('doc_contrato'), $empleado->id);
        $empleado->save();

        return redirect()->route('empleado', base64_encode($empleado->id))->with('message', 'El empleado ha sido importado.');
    }

    public function destroy(Request $request)
    {
        $empleado = EmpleadoSysprom::find($request->empleado_id);
        ProcesoSysprom::where('empleado_id', $empleado->id)->delete();
        MovimientoSysprom::where('empleado_id', $empleado->id)->delete();
        ListaNegraSysprom::where('empleado_id', $empleado->id)->delete();
        if ($empleado->delete()) {
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'El empleado se eliminó correctamente del sistema'
            ]);
        }
    }
}
