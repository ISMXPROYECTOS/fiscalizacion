<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaValorada extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'formavalorada';

	/* Relación muchos a uno */
	public function tipoDeInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'IDTIPOINSPECCION');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\Usuario', 'IDUSUARIO');
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
        'idusuario', 'idtipoinspeccion', 'idejerciciofiscal', 'idconfiguracion', 'folioinicio', 'foliofin'
    ];
}
