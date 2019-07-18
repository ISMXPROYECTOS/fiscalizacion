<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolioPorTipoDeInspeccion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'folioportipoinspeccion';

	/* Relación muchos a uno */
	public function tipoInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'tipoinspeccion_id');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'ejerciciofiscal_id');
	}
}
