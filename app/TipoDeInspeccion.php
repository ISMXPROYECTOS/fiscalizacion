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
		return $this->hasMany('App\DocumentacionPorTipoDeInspeccion', 'tipoinspeccion_id');
	}

	/* Relación uno a mucho */
	public function documentacionPorInspeccion(){
		return $this->hasMany('App\DocumentacionPorInspeccion');
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

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'clave', 'diasvencimiento',
    ];
	
}
