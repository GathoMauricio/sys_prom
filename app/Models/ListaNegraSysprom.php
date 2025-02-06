<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListaNegraSysprom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sys_prom_lista_negra';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'empleado_id',
        'autor_id',
        'motivo',
    ];
}
