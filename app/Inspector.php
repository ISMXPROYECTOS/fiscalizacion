<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'inspector';

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'IDUSUARIO');
	}

	/* Relación uno a uno */
	public function gafete(){
		return $this->hasOne('App\Gafete');
	}
}
