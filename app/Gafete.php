<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gafete extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'gafetes';

	/* Relación muchos a uno */
	public function inspector(){
		return $this->belongsTo('App\Inspector', 'IDINSPECTOR');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'IDEJERCICIOFISCAL');
	}
}
