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
		return $this->belongsTo('App\Usuario', 'usuario_id');
	}

	protected $fillable = [
		'usuario_id',
    	'inspeccion_id',
    	'folioMulta'
    	'fechavence',
    	'diasdeprorroga',
    	'observaciones'
    ];
}
