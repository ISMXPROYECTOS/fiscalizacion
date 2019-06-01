<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaValorada extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'formavalorada';

	/* Relación uno a uno */
	public function tipoDeInspeccion(){
		return $this->hasOne('App\TipoDeInspeccion');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id');
	}

	/* Relación uno a uno */
	public function inspeccion(){
		return $this->hasOne('App\Inspeccion');
	}
}
