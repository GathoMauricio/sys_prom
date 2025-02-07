<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
    return 'Unauthorized';
})->name('/');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('ajax_configuraciones', [App\Http\Controllers\ConfiguracionController::class, 'ajaxConfiguraciones'])->name('ajax_configuraciones');
Route::get('/roles_permisos', [App\Http\Controllers\RolesPermisoController::class, 'index'])->name('roles_permisos');
Route::post('/actualizar_roles_permisos', [App\Http\Controllers\RolesPermisoController::class, 'updatePermisos'])->name('actualizar_roles_permisos');
Route::get('/validar_rfc_sat', [App\Http\Controllers\ValidacionController::class, 'validarRFCSat'])->name('validar_rfc_sat');
Route::get('/validar_rfc_sistema', [App\Http\Controllers\ValidacionController::class, 'validarRFCSistema'])->name('validar_rfc_sistema');
Route::get('/alta_empleado/{rfc?}', [App\Http\Controllers\EmpleadoController::class, 'create'])->name('alta_empleado');
Route::get('/reingreso_sicoss_empleado/{rfc?}', [App\Http\Controllers\EmpleadoController::class, 'reingresoSicoss'])->name('reingreso_sicoss_empleado');
Route::get('/reingreso_sysprom_empleado/{rfc?}', [App\Http\Controllers\EmpleadoController::class, 'reingresoSysprom'])->name('reingreso_sysprom_empleado');
Route::post('/store_ingreso_empleado', [App\Http\Controllers\EmpleadoController::class, 'storeIngreso'])->name('store_ingreso_empleado');
Route::post('/store_reingreso_sicoss_empleado', [App\Http\Controllers\EmpleadoController::class, 'storeReingresoSicoss'])->name('store_reingreso_sicoss_empleado');
Route::post('/store_reingreso_sysprom_empleado', [App\Http\Controllers\EmpleadoController::class, 'storeReingresoSysprom'])->name('store_reingreso_sysprom_empleado');
Route::get('/seguimiento_empleado/{rfc?}', [App\Http\Controllers\EmpleadoController::class, 'edit'])->name('seguimiento_empleado');
Route::put('/update_empleado/{id}', [App\Http\Controllers\EmpleadoController::class, 'update'])->name('update_empleado');
Route::get('/get_sepomex/{cp?}', [App\Http\Controllers\SepomexController::class, 'getSepomex'])->name('get_sepomex');
Route::get('/get_planes/{IDCC?}', [App\Http\Controllers\CatalogoController::class, 'getPlanes'])->name('get_planes');
Route::get('/validar_nss_alta/{nss?}', [App\Http\Controllers\ValidacionController::class, 'validarNssAlta'])->name('validar_nss_alta');
Route::post('/actualizar_documento', [App\Http\Controllers\EmpleadoController::class, 'actualizarDocumento'])->name('actualizar_documento');
Route::get('/get_seguimientos/{proceso_id?}', [App\Http\Controllers\SeguimientoController::class, 'index'])->name('get_seguimientos');
Route::post('/store_seguimiento', [App\Http\Controllers\SeguimientoController::class, 'store'])->name('store_seguimiento');
Route::get('/procesos', [App\Http\Controllers\ProcesoController::class, 'index'])->name('procesos');
Route::post('/aprobar_documentacion', [App\Http\Controllers\ProcesoController::class, 'aprobarDocumentacion'])->name('aprobar_documentacion');
Route::post('/aprobar_documento', [App\Http\Controllers\ProcesoController::class, 'aprobarDocumento'])->name('aprobar_documento');
Route::post('/rechazar_documento', [App\Http\Controllers\ProcesoController::class, 'rechazarDocumento'])->name('rechazar_documento');
Route::post('/aprobar_proceso', [App\Http\Controllers\ProcesoController::class, 'aprobarProceso'])->name('aprobar_proceso');
Route::post('/rechazar_proceso', [App\Http\Controllers\ProcesoController::class, 'rechazarProceso'])->name('rechazar_proceso');
Route::get('/movimientos', [App\Http\Controllers\MovimientoController::class, 'index'])->name('movimientos');
Route::get('/descarga_txt/{proceso_id}', [App\Http\Controllers\ProcesoController::class, 'descargaTxt'])->name('descarga_txt');
Route::get('/captura_empleado_proceso/{proceso_id}', [App\Http\Controllers\ProcesoController::class, 'capturaEmpleado'])->name('captura_empleado_proceso');
Route::post('/actualizar_movimiento', [App\Http\Controllers\MovimientoController::class, 'actualizarEstatussMovimiento'])->name('actualizar_movimiento');
Route::post('/generar_baja', [App\Http\Controllers\MovimientoController::class, 'generarBaja'])->name('generar_baja');
Route::get('/empleado/{id}', [App\Http\Controllers\EmpleadoController::class, 'show'])->name('empleado');
Route::get('/empleados_sysprom', [App\Http\Controllers\EmpleadoController::class, 'indexSysprom'])->name('empleados_sysprom');
Route::get('/empleados_sicoss', [App\Http\Controllers\EmpleadoController::class, 'indexSicoss'])->name('empleados_sicoss');
Route::post('/enviar_lista_negra', [App\Http\Controllers\EmpleadoController::class, 'enviarListaNegra'])->name('enviar_lista_negra');
Route::post('/quitar_lista_negra', [App\Http\Controllers\EmpleadoController::class, 'quitarListaNegra'])->name('quitar_lista_negra');
Route::delete('/eliminar_empleado', [App\Http\Controllers\EmpleadoController::class, 'destroy'])->name('eliminar_empleado');
Route::get('/validar_importacion', [App\Http\Controllers\ValidacionController::class, 'validarImportacion'])->name('validar_importacion');
Route::get('/importar_empleado/{rfc?}', [App\Http\Controllers\EmpleadoController::class, 'importarEmpleado'])->name('importar_empleado');
Route::post('/store_importar_empleado', [App\Http\Controllers\EmpleadoController::class, 'storeImportacion'])->name('store_importar_empleado');
Route::view('configuracion', 'configuracion.index')->name('configuracion');
Route::get('inputs', [App\Http\Controllers\ConfiguracionController::class, 'inputs'])->name('inputs');
Route::put('update_configs', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update_configs');
Route::resource('user', App\Http\Controllers\UserController::class);
