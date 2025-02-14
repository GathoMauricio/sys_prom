<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepomex;

class SepomexController extends Controller
{
    public function index()
    {
        $estado_id = 0;
        if (request()->idEstado)
            $estado_id = request()->idEstado;
        $municipios = Sepomex::select('municipio', 'frontera')->distinct('municipio')->where('idEstado', $estado_id)->get();
        $estados = Sepomex::select('idEstado', 'estado')->distinct()->orderBy('estado')->get();
        return view('configuracion.sepomex', compact('municipios', 'estados'));
    }

    public function cargarSueldo(Request $request, $municipio)
    {
        $sepomex = Sepomex::where('municipio', $municipio)->first();
        return response()->json($sepomex);
    }

    public function getSepomex($cp)
    {
        $items = Sepomex::where('cp', $cp)->get();
        if (count($items) > 0) {
            $estado = "";
            $municipio = "";
            $colonias = [];
            foreach ($items as $colonia) {
                $estado = $colonia->estado;
                $municipio = $colonia->municipio;
                $colonias[] = $colonia->asentamiento;
            }
            return response()->json([
                'error' => false,
                'estado' => $estado,
                'municipio' => $municipio,
                'colonias' => $colonias,
            ]);
        } else {
            return json_encode([
                'error' => true,
                'mensaje' => 'El código postal no existe.',
            ]);
        }
    }

    public function cambiarFrontera(Request $request)
    {
        $sepomex = Sepomex::where('municipio', $request->municipio)->get();
        foreach ($sepomex as $item) {
            $item->frontera = $request->frontera;
            $item->save();
        }
        return json_encode([
            'estatus' => 'OK',
            'mensaje' => 'Propiedad actualizada.',
        ]);
    }
}
