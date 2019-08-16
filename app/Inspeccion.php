<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'inspeccion';

	/* Relación muchos a uno */
	public function formaValorada(){
		return $this->belongsTo('App\FormaValorada', 'formavalorada_id');
	}

	/* Relación muchos a uno */
	public function giroComercial(){
		return $this->belongsTo('App\GiroComercial', 'giro_id');
	}

	/* Relación muchos a uno */
	public function subgiroComercial(){
		return $this->belongsTo('App\SubgiroComercial', 'subgirocomercial_id');
	}

	/* Relación muchos a uno */
	public function tipoInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'tipoinspeccion_id');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'usuario_id');
	}

	/* Relación muchos a uno */
	public function gestor(){
		return $this->belongsTo('App\Gestor', 'gestores_id');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'ejerciciofiscal_id');
	}

	/* Relación muchos a uno */
	public function inspector(){
		return $this->belongsTo('App\Inspector', 'inspector_id');
	}

	/* Relación muchos a uno */
	public function estatusInspeccion(){
		return $this->belongsTo('App\EstatusInspeccion', 'estatusinspeccion_id');
	}

	/* Relación muchos a uno */
	public function colonia(){
		return $this->belongsTo('App\Colonia', 'colonia_id');
	}

	/* Relación uno a mucho */
    public function bitacoraDeEstatus(){
        return $this->hasMany('App\BitacoraDeEstatus');
    }

	/* Relación uno a mucho */
    public function bitacoraDeProroga(){
        return $this->hasMany('App\BitacoraDeProroga');
    }

	/* Relación uno a mucho */
    public function bitacoraDeInforme(){
        return $this->hasMany('App\BitacoraDeInforme');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'usuario_id', 'comercio_id', 'inspector_id', 'gestores_id', 'tipoinspeccion_id', 'formavalorada_id', 'giro_id', 'subgirocomercial_id', 'ejerciciofiscal_id', 'estatusinspeccion_id', 'colonia_id', 'nombrelocal', 'domicilio', 'nombreencargado', 'cargoencargado', 'diasvence', 'fechavence', 'folio',
    ];
    
}
