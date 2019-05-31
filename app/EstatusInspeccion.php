<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstatusInspeccion extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'estatusinspeccion';

	/* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }

    /* Relación uno a mucho */
    public function bitacoraDeEstatus(){
        return $this->hasMany('App\BitacoraDeEstatus');
    }

    
}
