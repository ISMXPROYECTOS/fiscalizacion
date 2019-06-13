<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpresionDeFormato extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'impresiondeformatos';

	/* Relación muchos a uno */
	public function tipoDeInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'IDTIPOINSPECCION');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'IDUSUARIO');
	}
	
}
