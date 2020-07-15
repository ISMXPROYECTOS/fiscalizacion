<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionRequerida extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'documentacionrequerida';

	/* Relación uno a mucho */
    public function documentacionPorTipoDeInspeccion(){
        return $this->hasMany('App\DocumentacionPorTipoDeInspeccion', 'documentacionrequerida_id');
    }

    /* Relación uno a mucho */
    public function documentacionPorInspeccion(){
        return $this->hasMany('App\DocumentacionPorInspeccion');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'clave', 'activo'
    ];

}
