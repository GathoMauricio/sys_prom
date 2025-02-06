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
}
