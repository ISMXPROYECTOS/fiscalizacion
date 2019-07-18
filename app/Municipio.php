<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'municipio';

	/* Relación muchos a uno */
	public function estado(){
		return $this->belongsTo('App\Estado', 'estado_id');
	}

	/* Relación uno a mucho */
	public function colonia(){
		return $this->hasMany('App\Colonia');
	}
}
