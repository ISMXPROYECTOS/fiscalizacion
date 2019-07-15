<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraDeInforme extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'bitacoradeinformes';

	/* Relación muchos a uno */
	public function gestor(){
		return $this->belongsTo('App\Gestor', 'gestores_id');
	}

	/* Relación muchos a uno */
	public function inspeccion(){
		return $this->belongsTo('App\Inspeccion', 'inspeccion_id');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'usuario_id');
	}

}
