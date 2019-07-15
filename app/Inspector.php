<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'inspector';

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'usuario_id');
	}

	/* Relación uno a mucho */
    public function gafete(){
        return $this->hasMany('App\Gafete');
    }

	/* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'nombre', 'apellidopaterno', 'apellidomaterno', 'clave', 'hash', 'estatus',
    ];
}
