<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraDeInforme extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'bitacoradeinformes';

	/* Relación muchos a uno */
	public function gestor(){
		return $this->belongsTo('App\Gestor', 'id');
	}

	/* Relación muchos a uno */
	public function inspeccion(){
		return $this->belongsTo('App\Inspeccion', 'id');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id');
	}

}
