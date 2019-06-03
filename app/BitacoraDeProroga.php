<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraDeProroga extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'bitacoradeproroga';

	/* Relación muchos a uno */
	public function inspeccion(){
		return $this->belongsTo('App\Inspeccion', 'IDINSPECCION');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'IDUSUARIO');
	}
}
