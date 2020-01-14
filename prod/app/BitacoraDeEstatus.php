<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraDeEstatus extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'bitacoradeestatus';

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\User', 'usuario_id');
	}

	/* Relación muchos a uno */
	public function inspeccion(){
		return $this->belongsTo('App\Inspeccion', 'inspeccion_id');
	}

	/* Relación muchos a uno */
	public function estatusInspeccion(){
		return $this->belongsTo('App\EstatusInspeccion', 'estatusinspeccion_id');
	}

	protected $fillable = [
    	'inspeccion_id',
    	'estatusinspeccion_id',
    	'usuario_id',
    	'observacion'
    ];

}
