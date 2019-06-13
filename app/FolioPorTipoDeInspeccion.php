<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolioPorTipoDeInspeccion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'folioxtipoinspeccion';

	/* Relación muchos a uno */
	public function tipoDeInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'IDTIPOINSPECCION');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'IDEJERCICIOFISCAL');
	}
}
