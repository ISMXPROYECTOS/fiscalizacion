<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
	/* Se indica la tabla que esta clase modificará */
	protected $table = 'gestores';

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'IDUSUARIO');
	}

	/* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }

    /* Relación uno a mucho */
    public function bitacoraDeInforme(){
        return $this->hasMany('App\BitacoraDeInforme');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idusuario', 'nombre', 'apellidopaterno', 'apellidomaterno', 'telefono', 'celular', 'correoelectronico', 'ine', 'estatus',
    ];

}
