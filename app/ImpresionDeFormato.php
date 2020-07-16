<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpresionDeFormato extends Model
{
	/* Se indica la tabla que este modelo modificará */
	protected $table = 'impresiondeformatos';

	/* Relación muchos a uno */
	public function tipoInspeccion(){
		return $this->belongsTo('App\TipoDeInspeccion', 'tipoinspeccion_id');
	}

	/* Relación muchos a uno */
	public function usuario(){
		return $this->belongsTo('App\User', 'usuario_id');
	}

	protected $fillable = [
		'tipoinspeccion_id',
		'usuario_id',
		'folioinicio',
		'foliofin'
    ];
	
}
