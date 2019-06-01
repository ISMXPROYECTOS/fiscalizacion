<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolioPorTipoDeInspeccion extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'folioxtipoinspeccion';

	/* Relación uno a uno */
	public function tipoDeInspeccion(){
		return $this->hasOne('App\TipoDeInspeccion');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'id');
	}
}
