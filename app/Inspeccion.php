<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'inspeccion';

	/* Relación uno a uno */
	public function formaValorada(){
		return $this->hasOne('App\FormaValorada');
	}

	/* Relación muchos a uno */
	public function giroComercial(){
		return $this->belongsTo('App\GiroComercial', 'id');
	}

	/* Relación uno a uno */
	public function subgiroComercial(){
		return $this->hasOne('App\SubgiroComercial');
	}

	/* Relación uno a uno */
	public function tipoDeInspeccion(){
		return $this->hasOne('App\TipoDeInspeccion');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id');
	}

	/* Relación muchos a uno */
	public function gestor(){
		return $this->belongsTo('App\Gestor', 'IDGESTOR');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'IDEJERCICIOFISCAL');
	}

	/* Relación muchos a uno */
	public function inspector(){
		return $this->belongsTo('App\Inspector', 'IDINSPECTOR');
	}

	/* Relación muchos a uno */
	public function estatusInspeccion(){
		return $this->belongsTo('App\EstatusInspeccion', 'IDESTATUSINSPECCION');
	}

	/* Relación muchos a uno */
	public function colonia(){
		return $this->belongsTo('App\Colonia', 'IDCOLONIA');
	}

	/* Relación uno a mucho */
    public function bitacoraDeEstatus(){
        return $this->hasMany('App\BitacoraDeEstatus');
    }

    /* Relación uno a uno */
	public function bitacoraDeProroga(){
		return $this->hasOne('App\BitacoraDeProroga');
	}

	/* Relación uno a mucho */
    public function bitacoraDeInforme(){
        return $this->hasMany('App\BitacoraDeInforme');
    }

}
