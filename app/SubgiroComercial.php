<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubgiroComercial extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'subgirocomercial';

	/* Relación muchos a uno */
	public function giroComercial(){
		return $this->belongsTo('App\GiroComercial', 'IDGIRO');
	}

	/* Relación uno a uno */
	public function inspeccion(){
		return $this->hasOne('App\Inspeccion');
	}
}
