<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionPorTipoDeInspeccion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'documentacionxtipodeinspeccion';

	/* Relación muchos a uno */
	public function tipoDeInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'IDTIPOINSPECCION');
	}

    /* Relación muchos a uno */
	public function documentacionRequerida(){
		return $this->belongsTo('App\DocumentacionRequerida', 'IDDOCUMENTACIONREQUERIDA');
	}

}
