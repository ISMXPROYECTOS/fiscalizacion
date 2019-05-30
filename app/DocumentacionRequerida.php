<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionRequerida extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'documentacionrequerida';

	/* Relación muchos a uno */
	public function documentacionPorTipoDeInspeccion(){
		return $this->belongsTo('App\DocumentacionPorTipoDeInspeccion', 'IDDOCUMENTACIONREQUERIDA');
	}

}
