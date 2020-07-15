<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaValorada extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'formavalorada';

	/* Relación muchos a uno */
	public function tipoInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'tipoinspeccion_id');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\User', 'usuario_id');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'ejerciciofiscal_id');
	}

	/* Relación muchos a uno */
	public function encargado(){
		return $this->belongsTo('App\Encargado', 'encargado_id');
	}

	/* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion', 'formavalorada_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'tipoinspeccion_id', 'ejerciciofiscal_id', 'encargado_id', 'idejerciciofiscal', 'idconfiguracion', 'folioinicio', 'foliofin'
    ];
}
