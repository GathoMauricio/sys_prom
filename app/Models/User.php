<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $connection = 'sqlsrv_intraprom';
    protected $table = 'tUsuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps = false;

    protected $fillable = [
        'idusuario',
        'Usuario',
        'PWD',
        'Nombre',
        'nivel',
        'id_dc',
        'mail',
        'ext',
        'N800',
        'celprom',
        'status',
        'plaza',
        'idsicoss',
    ];

    public function findForPassport($usuario)
    {
        return $this->where('usuario', $usuario)->first();
    }

    // public function validateCredentials(Authenticatable $user, array $credentials)
    // {
    //     // Comparar directamente sin bcrypt
    //     return $credentials['PWD'] === $user->getAuthPassword();
    // }

    //protected $connection = 'mysql';
    //public $timestamps = true;
    //protected $dateFormat = 'Y-m-d H:i:s';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'id',
    //     'intraprom_id',
    //     'name',
    //     'apaterno',
    //     'amaterno',
    //     'email',
    //     'usuario',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];

    // public function findForPassport($usuario)
    // {
    //     return $this->where('usuario', $usuario)->first();
    // }

    // public function centro()
    // {
    //     return $this->hasOne(CentroCostoIntraprom::class, 'IDCC', 'centro_costos_id')->withDefault();
    // }
}
