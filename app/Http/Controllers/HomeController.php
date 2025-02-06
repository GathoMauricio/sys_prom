<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserIntraprom;
use App\Models\EmpleadoSysProm;
use App\Models\EmpleadoSiccos;
use App\Models\ProcesoSysProm;
use App\Models\MovimientoSysProm;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios_sysprom = User::count();
        $usuarios_intraprom = UserIntraprom::count();
        $empleados_sysprom = EmpleadoSysProm::count();
        $empleados_sicoss = EmpleadoSiccos::count();
        $procesos = ProcesoSysProm::where('sys_prom_procesos.estatus', '!=', 'Contrato')->where('sys_prom_procesos.estatus', '!=', 'Rechazado')->count();
        $movimientos = MovimientoSysProm::where('estatus', 'Por procesar')->count();
        return view('home', compact('usuarios_sysprom', 'usuarios_intraprom', 'empleados_sicoss', 'empleados_sysprom', 'procesos', 'movimientos'));
    }
}
