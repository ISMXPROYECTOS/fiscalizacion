<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeInspeccion extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'tipodeinspeccion';

	/* Relación uno a uno */
	public function impresionDeFormato(){
		return $this->hasOne('App\ImpresionDeFormato');
	}

	/* Relación uno a uno */
	public function documentacionPorTipoDeInspeccion(){
		return $this->hasOne('App\DocumentacionPorTipoDeInspeccion');
	}

	/* Relación uno a uno */
	public function folioPorTipoDeInspeccion(){
		return $this->hasOne('App\FolioPorTipoDeInspeccion');
	}

	/* Relación uno a uno */
	public function formaValorada(){
		return $this->hasOne('App\FormaValorada');
	}
}
