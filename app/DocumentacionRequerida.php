<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionRequerida extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'documentacionrequerida';

	/* Relación uno a mucho */
    public function documentacionPorTipoDeInspeccion(){
        return $this->hasMany('App\DocumentacionPorTipoDeInspeccion');
    }

}
