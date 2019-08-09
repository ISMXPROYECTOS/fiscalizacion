<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comercio;

class ComercioController extends Controller
{
    public function buscarComercios($calle){
    	if ($calle == 'null') {
    		return response()->json([
				'error' => true,
				'mensaje' => 'Ingresa un valor correcto.'
			], 422);
    	} else {
    		$comercios = Comercio::where('calle', 'like', '%'. $calle .'%')->get();
    		if (count($comercios) == 0) {
    			return response()->json([
			        'mensaje' => 'No se encontro ningun resultado.'
			    ], 404);
    		} else {
    			return $comercios; 	
    		}
    		
    	}
		
    }
}
