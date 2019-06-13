<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubgiroComercial extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'subgirocomercial';

	/* Relación muchos a uno */
	public function giroComercial(){
		return $this->belongsTo('App\GiroComercial', 'IDGIRO');
	}

	/* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }
}
