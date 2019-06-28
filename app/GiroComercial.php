<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiroComercial extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'girocomercial';

	/* Relación uno a mucho */
    public function subgiroComercial(){
        return $this->hasMany('App\SubgiroComercial');
    }

    /* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }
}
