<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comercio;

class ComercioController extends Controller
{
    public function buscarComercios($calle){
		return datatables()
			->eloquent(Comercio::where('calle', 'like', '%'. $calle .'%'))
			->addColumn('checkbox', 'inspeccion/boton-checkbox')
			->rawColumns(['checkbox'])
			->toJson();    	
    }
}
