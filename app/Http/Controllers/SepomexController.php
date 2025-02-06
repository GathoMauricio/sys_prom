<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepomex;

class SepomexController extends Controller
{
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
}
