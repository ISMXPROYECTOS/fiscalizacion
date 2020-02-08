<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    /* Se indica la tabla que este modelo modificará */
	protected $table = 'comercios';

    /* Relación uno a mucho */
    public function inspeccion(){
        return $this->hasMany('App\Inspeccion');
    }

    /* Relación muchos a uno */
    public function giroComercial(){
        return $this->belongsTo('App\GiroComercial', 'giro_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rfc', 'licenciafuncionamientoid', 'licenciafuncionamiento', 'propietarioid', 'propietarionombre', 
        'clavecatastral', 'denominacion', 'nombreestablecimiento', 'domiciliofiscal', 'calle', 'nointerior',
        'noexterior', 'cp', 'colonia', 'localidad', 'municipio', 'estado', 'folio', 'estatus'
    ];
}
