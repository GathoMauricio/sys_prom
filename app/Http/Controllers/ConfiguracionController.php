<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;

class ConfiguracionController extends Controller
{
    public function ajaxConfiguraciones()
    {
        $configuracion = Configuracion::first();
        return response()->json($configuracion);
    }

    public function inputs()
    {
        $configuracion = Configuracion::first();
        return view('configuracion.inputs', compact('configuracion'));
    }
    public function update(Request $request)
    {
        $configuracion = Configuracion::first();
        if ($configuracion->update($request->all())) {
            return redirect()->back()->with('message', 'Configuración actualizada.');
        }
    }
}
