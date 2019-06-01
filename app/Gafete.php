<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gafete extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'gafetes';

	/* Relación uno a uno */
	public function inspector(){
		return $this->hasOne('App\Inspector');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'id');
	}
}
