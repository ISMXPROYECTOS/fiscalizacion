<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionPorTipoDeInspeccion extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'documentacionportipoinspeccion';

	/* Relación muchos a uno */
	public function tipoInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'tipoinspeccion_id');
	}

    /* Relación muchos a uno */
	public function documentacionRequerida(){
		return $this->belongsTo('App\DocumentacionRequerida', 'documentacionrequerida_id');
	}

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipoinspeccion_id', 'documentacionrequerida_id'
    ];

}
