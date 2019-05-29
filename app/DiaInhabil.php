<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaInhabil extends Model
{
    /* Se indica la tabla que esta clase modificará */
	protected $table = 'diainhabil';

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'ANIO');
	}

}
