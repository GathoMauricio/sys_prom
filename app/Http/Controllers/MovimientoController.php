<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoSysprom;
use App\Models\ProcesoSysProm;
use Illuminate\Support\Facades\Auth;

class MovimientoController extends Controller
{
    public function index()
    {

        $movimientos = new MovimientoSysprom();
        if (request()->estatus) {
            $movimientos = $movimientos->where('estatus', request()->estatus);
        }
        if (request()->tipo) {
            $movimientos = $movimientos->where('tipo', request()->tipo);
        }
        if (request()->fecha) {
            $movimientos = $movimientos->whereDate('created_at', request()->fecha);
        }
        $movimientos = $movimientos->orderBy('id', 'DESC')->paginate(15);
        return view('movimiento.index', compact('movimientos'));
    }

    public function actualizarEstatussMovimiento(Request $request)
    {
        $movimiento = MovimientoSysprom::find($request->movimiento_id);
        $movimiento->estatus = "Procesado";
        if ($movimiento->save()) {
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'El movimiento ha sido procesado'
            ]);
        }
    }

    public function generarBaja(Request $request)
    {
        $proceso = ProcesoSysProm::find($request->proceso_id);
        $ultimo_movimiento = MovimientoSysprom::where('empleado_id', $proceso->empleado->id)->orderBy('created_at', 'DESC')->first();

        if (!$ultimo_movimiento)
            $consecutivo = 0;
        else
            $consecutivo = (int) $ultimo_movimiento->consecutivo + 1;

        $movimiento = MovimientoSysprom::create([
            'autor_id' => Auth::user()->id,
            'proceso_id' => $proceso->id,
            'empleado_id' => $proceso->empleado->id,
            'consecutivo' => $consecutivo,
            'tipo' => 'Baja',
        ]);

        if ($movimiento) {
            $proceso->empleado->estatus = 'StandBy';
            $proceso->empleado->save();
            //TODO:Email a involucrados
            return response()->json([
                'estatus' => 'OK',
                'mensaje' => 'Se ha generado la baja dwel empleado'
            ]);
        }
    }
}
