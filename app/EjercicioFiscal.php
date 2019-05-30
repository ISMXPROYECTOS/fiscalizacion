<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EjercicioFiscal extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'ejerciciofiscal';

	/* Relación uno a mucho */
	public function diaInhabil(){
		return $this->hasMany('App\DiaInhabil');
	}

	/* Relación uno a mucho */
	public function folioPorTipoDeInspeccion(){
		return $this->hasMany('App\FolioPorTipoDeInspeccion');
	}

	/* Relación uno a mucho */
	public function gafete(){
		return $this->hasMany('App\Gafete');
	}
	
}
