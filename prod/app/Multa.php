<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'multas';

	/* Relación muchos a uno */
	public function inspeccion(){
		return $this->belongsTo('App\Inspeccion', 'inspeccion_id');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'usuario_id');
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'inspeccion_id',
		'usuario_id',
		'montoMulta',
		'valorUma',
		'total',
		'estatus',
		'oficio',
		'expediente',
		'fechacreada',
		'fechavence'
	];
}
