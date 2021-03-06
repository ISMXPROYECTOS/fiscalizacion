<?php

namespace App;

use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /* Se indica la tabla que este modelo modificará */
    protected $table = 'usuario';

    /* Relación uno a mucho */
    public function impresionDeFormato(){
        return $this->hasMany('App\ImpresionDeFormato');
    }

    /* Relación uno a mucho */
    public function formaValorada(){
        return $this->hasMany('App\FormaValorada');
    }

    /* Relación uno a mucho */
    public function inspector(){
        return $this->hasMany('App\Inspector');
    }

    /* Relación uno a mucho */
    public function gestor(){
        return $this->hasMany('App\Gestor');
    }

    /* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }

    /* Relación uno a mucho */
    public function bitacoraDeEstatus(){
        return $this->hasMany('App\BitacoraDeEstatus');
    }

    /* Relación uno a mucho */
    public function bitacoraDeProroga(){
        return $this->hasMany('App\BitacoraDeProroga');
    }

    /* Relación uno a mucho */
    public function bitacoraDeInforme(){
        return $this->hasMany('App\BitacoraDeInforme');
    }

    /* Relación uno a mucho */
    public function multa(){
        return $this->hasMany('App\Multa');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario', 'role', 'password', 'activo', 'vigencia', 'ultimasesion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $dates = [
        'sesionactual', 'ultimasesion',
    ];


    public function getUltimaSesionAttribute($date)
    {
        return new Date($date);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
