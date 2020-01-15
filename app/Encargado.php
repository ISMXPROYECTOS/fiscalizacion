<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'encargados';

	/* Relación uno a mucho */
	public function formaValorada(){
		return $this->hasMany('App\FormaValorada');
	}
	
    protected $fillable = [
        'nombre', 'apellidopaterno', 'apellidomaterno', 'puesto', 'activo'
    ];
}
