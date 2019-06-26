<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'inspeccion';

	/* Relación muchos a uno */
	public function formaValorada(){
		return $this->belongsTo('App\FormaValorada', 'IDFORMAVALORADA');
	}

	/* Relación muchos a uno */
	public function giroComercial(){
		return $this->belongsTo('App\GiroComercial', 'IDGIRO');
	}

	/* Relación muchos a uno */
	public function subgiroComercial(){
		return $this->belongsTo('App\SubgiroComercial', 'IDSUBGIROCOMERCIAL');
	}

	/* Relación muchos a uno */
	public function tipoDeInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'IDTIPOINSPECCION');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'IDUSUARIO');
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
        'cantidad', 'inspector',
    ];

}
