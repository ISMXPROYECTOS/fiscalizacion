<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionPorTipoDeInspeccion extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'documentacionxtipodeinspeccion';

	/* Relación uno a uno */
	public function tipoDeInspeccion(){
		return $this->hasOne('App\TipoDeInspeccion');
	}

	/* Relación uno a mucho */
    public function documentacionRequerida(){
        return $this->hasMany('App\DocumentacionRequerida');
    }

}
