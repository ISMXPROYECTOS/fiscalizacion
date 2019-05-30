<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'gestores';

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'IDUSUARIO');
	}
}
