<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraDeProroga extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'bitacoradeproroga';

	/* Relación uno a uno */
	public function inspeccion(){
		return $this->hasOne('App\Inspeccion');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id');
	}
}
