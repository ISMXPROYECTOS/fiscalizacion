<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpresionDeFormato extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'impresiondeformatos';

	/* Relación uno a uno */
	public function tipoDeInspeccion(){
		return $this->hasOne('App\TipoDeInspeccion');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id');
	}
	
}
