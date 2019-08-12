<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'configuracion';

	/* Relación uno a mucho */
	public function formaValorada(){
		return $this->hasMany('App\FormaValorada');
	}

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellidopaterno', 'apellidomaterno', 'puesto', 'activo'
    ];
}
