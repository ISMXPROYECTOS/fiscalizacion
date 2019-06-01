<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraDeEstatus extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'bitacoradeestatus';

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id');
	}

	/* Relación muchos a uno */
	public function inspeccion(){
		return $this->belongsTo('App\Inspeccion', 'id');
	}

	/* Relación muchos a uno */
	public function estatusInspeccion(){
		return $this->belongsTo('App\EstatusInspeccion', 'id');
	}

}
