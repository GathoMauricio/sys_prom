<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeguimientoSysProm;
use Illuminate\Support\Facades\Auth;

class SeguimientoController extends Controller
{

    public function index($proceso_id)
    {
        $seguimientos = SeguimientoSysProm::where('proceso_id', $proceso_id)->with('autor')->get();
        return response()->json($seguimientos);
    }

    public function store(Request $request)
    {
        $seguimiento = SeguimientoSysProm::create([
            'autor_id' => Auth::user()->idusuario,
            'proceso_id' => $request->proceso_id,
            'contenido' => $request->contenido,
        ]);
        $rfc = base64_encode($seguimiento->proceso->empleado->rfc);
        return redirect()->back()->with('message', 'El seguimiento ha sido enviado.');
    }
}
