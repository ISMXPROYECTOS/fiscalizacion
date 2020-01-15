<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'estado';

	/* Relación muchos a uno */
	public function pais(){
		return $this->belongsTo('App\Pais', 'pais_id');
	}

	/* Relación uno a mucho */
	public function municipio(){
		return $this->hasMany('App\Municipio');
	}
}
