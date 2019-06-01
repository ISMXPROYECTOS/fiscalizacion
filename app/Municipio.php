<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'municipio';

	/* Relación muchos a uno */
	public function estado(){
		return $this->belongsTo('App\Estado', 'id');
	}

	/* Relación uno a mucho */
	public function colonia(){
		return $this->hasMany('App\Colonia');
	}
}
