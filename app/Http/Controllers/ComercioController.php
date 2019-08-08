<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comercio;

class ComercioController extends Controller
{
    public function buscarComercios($calle){
		$comercios = Comercio::where('calle', 'like', '%'. $calle .'%')->get();
    	return $comercios; 	
    }
}
