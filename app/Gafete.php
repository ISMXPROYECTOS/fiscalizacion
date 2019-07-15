<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gafete extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'gafetes';

	/* Relación muchos a uno */
	public function inspector(){
		return $this->belongsTo('App\Inspector', 'inspector_id');
	}

	/* Relación muchos a uno */
	public function ejercicioFiscal(){
		return $this->belongsTo('App\EjercicioFiscal', 'ejerciciofiscal_id');
	}

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ejerciciofiscal_id', 'inspector_id', 'folio', 'vigencia', 'codigoqr', 'pdf', 'imageninspector', 'estatus',
    ];
}
