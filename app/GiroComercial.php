<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiroComercial extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'girocomerciales';

	/* Relación uno a mucho */
    public function subgiroComercial(){
        return $this->hasMany('App\SubgiroComercial');
    }

    /* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }
}
