<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $connection = 'sqlsrv'; // Cambia esto por el nombre de la conexión correcta
}
