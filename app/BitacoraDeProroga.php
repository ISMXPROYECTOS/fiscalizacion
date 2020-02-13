<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraDeProroga extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'bitacoradeproroga';

	/* Relación muchos a uno */
	public function inspeccion(){
		return $this->belongsTo('App\Inspeccion', 'inspeccion_id');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\User', 'usuario_id');
	}

	/* Relación muchos a uno */
	public function multa(){
		return $this->belongsTo('App\Multa', 'multa_id');
	}

	protected $fillable = [
		'usuario_id',
		'inspeccion_id',
		'multa_id',
    	'folioMulta',
    	'fechavence',
    	'diasdeprorroga',
    	'observaciones'
    ];
}
