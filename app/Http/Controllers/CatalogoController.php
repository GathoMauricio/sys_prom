<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanPromocionalIntraprom;

class CatalogoController extends Controller
{
    public function getPlanes($IDCC)
    {
        $planes = PlanPromocionalIntraprom::where('IDCC', $IDCC)->orderBy('NCUENTA')->get();
        return response()->json($planes);
    }
}
