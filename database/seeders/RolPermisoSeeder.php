<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Roles
        $administracion = Role::create(['name' => 'Administracion']);
        $reclutamiento = Role::create(['name' => 'Reclutamiento']);
        $capital_humano = Role::create(['name' => 'Capital Humano']);
        $operaciones = Role::create(['name' => 'Operaciones']);
        $ejecutivo = Role::create(['name' => 'Ejecutivo']);
        $nominas = Role::create(['name' => 'Nominas']);
        $imss = Role::create(['name' => 'IMSS']);

        //Permisos
        Permission::create(['name' => 'Roles y permisos']);
        Permission::create(['name' => 'Reclutar empleado']);
        Permission::create(['name' => 'Ver procesos']);
        Permission::create(['name' => 'Ver movimientos']);
        Permission::create(['name' => 'Ver empleados sysprom']);
        Permission::create(['name' => 'Ver empleados sicoss']);
        Permission::create(['name' => 'Ver usuarios']);
        Permission::create(['name' => 'Ver configuracion']);
        Permission::create(['name' => 'Ver seguimiento empleado']);
        Permission::create(['name' => 'Cargar documento']);
        Permission::create(['name' => 'Aprobar documento']);
        Permission::create(['name' => 'Rechazar documento']);
        Permission::create(['name' => 'Agregar seguimiento']);
        Permission::create(['name' => 'Ver captura empleado']);
        Permission::create(['name' => 'Aprobar proceso']);
        Permission::create(['name' => 'Rechazar proceso']);
        Permission::create(['name' => 'Cambiar estatus movimiento']);
        Permission::create(['name' => 'Descargar txt']);
        Permission::create(['name' => 'Generar proceso de baja']);
        Permission::create(['name' => 'Enviar empleado a lista negra']);
        Permission::create(['name' => 'Quitar empleado de lista negra']);
        //Permission::create(['name' => 'Crear usuarios']);
        Permission::create(['name' => 'Editar usuarios']);
        //Permission::create(['name' => 'Eliminar usuarios']);
        //Permission::create(['name' => 'Importar empleado']);
        //Asignación
        $administracion->givePermissionTo('Roles y permisos');
        $administracion->givePermissionTo('Reclutar empleado');
        $administracion->givePermissionTo('Ver procesos');
        $administracion->givePermissionTo('Ver movimientos');
        $administracion->givePermissionTo('Ver empleados sysprom');
        $administracion->givePermissionTo('Ver empleados sicoss');
        $administracion->givePermissionTo('Ver usuarios');
        $administracion->givePermissionTo('Ver configuracion');
        $administracion->givePermissionTo('Ver seguimiento empleado');
        $administracion->givePermissionTo('Cargar documento');
        $administracion->givePermissionTo('Aprobar documento');
        $administracion->givePermissionTo('Rechazar documento');
        $administracion->givePermissionTo('Agregar seguimiento');
        $administracion->givePermissionTo('Ver captura empleado');
        $administracion->givePermissionTo('Aprobar proceso');
        $administracion->givePermissionTo('Rechazar proceso');
        $administracion->givePermissionTo('Cambiar estatus movimiento');
        $administracion->givePermissionTo('Descargar txt');
        $administracion->givePermissionTo('Generar proceso de baja');
        $administracion->givePermissionTo('Enviar empleado a lista negra');
        $administracion->givePermissionTo('Quitar empleado de lista negra');
        //$administracion->givePermissionTo('Crear usuarios');
        $administracion->givePermissionTo('Editar usuarios');
        //$administracion->givePermissionTo('Eliminar usuarios');
        //$administracion->givePermissionTo('Importar empleado');

        $reclutamiento->givePermissionTo('Reclutar empleado');
        $reclutamiento->givePermissionTo('Ver seguimiento empleado');
        $reclutamiento->givePermissionTo('Cargar documento');
        $reclutamiento->givePermissionTo('Agregar seguimiento');
        $reclutamiento->givePermissionTo('Ver captura empleado');

        $capital_humano->givePermissionTo('Ver procesos');
        $capital_humano->givePermissionTo('Ver seguimiento empleado');
        $capital_humano->givePermissionTo('Aprobar documento');
        $capital_humano->givePermissionTo('Rechazar documento');
        $capital_humano->givePermissionTo('Ver captura empleado');

        $operaciones->givePermissionTo('Ver procesos');
        $operaciones->givePermissionTo('Ver seguimiento empleado');
        $operaciones->givePermissionTo('Aprobar documento');
        $operaciones->givePermissionTo('Rechazar documento');
        $operaciones->givePermissionTo('Ver captura empleado');

        $ejecutivo->givePermissionTo('Ver procesos');
        $ejecutivo->givePermissionTo('Ver movimientos');
        $ejecutivo->givePermissionTo('Ver seguimiento empleado');
        $ejecutivo->givePermissionTo('Aprobar proceso');
        $ejecutivo->givePermissionTo('Rechazar proceso');

        $nominas->givePermissionTo('Ver movimientos');
        $nominas->givePermissionTo('Descargar txt');
        $nominas->givePermissionTo('Cambiar estatus movimiento');

        $imss->givePermissionTo('Ver movimientos');
        $imss->givePermissionTo('Descargar txt');
        $imss->givePermissionTo('Cambiar estatus movimiento');

        //$permisos al usuario de pruebas
        //$user = User::find(1);
        //$user->assignRole(['Administracion']);
    }
}
