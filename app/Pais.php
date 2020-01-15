<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'pais';

	/* Relación uno a mucho */
	public function estado(){
		return $this->hasMany('App\Estado');
	}
}
