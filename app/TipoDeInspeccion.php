<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeInspeccion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'tipodeinspeccion';

	/* Relación uno a mucho */
	public function impresionDeFormato(){
		return $this->hasMany('App\ImpresionDeFormato');
	}

	/* Relación uno a mucho */
	public function documentacionPorTipoDeInspeccion(){
		return $this->hasMany('App\DocumentacionPorTipoDeInspeccion');
	}

	/* Relación uno a mucho */
	public function folioPorTipoDeInspeccion(){
		return $this->hasMany('App\folioPorTipoDeInspeccion');
	}

	/* Relación uno a mucho */
	public function formaValorada(){
		return $this->hasMany('App\FormaValorada');
	}

	/* Relación uno a mucho */
	public function inspeccion(){
		return $this->hasMany('App\Inspeccion');
	}
	
}
