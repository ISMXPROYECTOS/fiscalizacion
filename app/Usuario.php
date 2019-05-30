<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Usuario as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    /* Se indica la tabla que esta clase modificará */
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
