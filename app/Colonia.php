<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'colonias';

	/* Relación muchos a uno */
	public function municipio(){
		return $this->belongsTo('App\Municipio', 'id');
	}

	/* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }
}
