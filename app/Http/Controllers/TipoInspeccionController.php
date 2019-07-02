<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDeInspeccion;

class TipoInspeccionController extends Controller
{
	public function listadoTipoInspecciones(){
		return view('tipoInspeccion.listado-tipo-inspecciones');
	}

	public function tbody(){
		return datatables()
			->eloquent(TipoDeInspeccion::query())
			->addColumn('btn', 'tipoInspeccion/actions-tipo-inspecciones')
			->rawColumns(['btn'])->toJson();
	}

	public function create(Request $request){
		$validate = $request->validate([
			'nombre' => 'required|string|max:75',
            'clave' => 'required|string|max:10|unique:tipodeinspeccion',
            'formato' => 'required|string|max:30'
	    ]);

		$datos = [
			'nombre' => $request->input('nombre'),
            'clave' => $request->input('clave'),
            'formato' => $request->input('formato')
		];

	    return TipoDeInspeccion::create($datos);
	}

	public function editarTipoInspeccion($id){
    	$tipoInspeccion = TipoDeInspeccion::find($id);
    	return $tipoInspeccion;
    }

    public function update(Request $request){
		// Se selecciona el tipo de inspección para ser modificado
		$id = $request->input('id');
		$tipoInspeccion = TipoDeInspeccion::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:75',
			'clave' => 'required|string|max:10|unique:tipodeinspeccion,clave,' . $id,
            'formato' => 'required|string|max:30'
		]);

		// Se reciben los datos del formulario y se crean variables
		$nombre = $request->input('nombre');
		$clave = $request->input('clave');
		$formato = $request->input('formato');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$tipoInspeccion->nombre = $nombre;
		$tipoInspeccion->clave = $clave;
		$tipoInspeccion->formato = $formato;
		$tipoInspeccion->update();

        // Indica que fue correcta la modificación del tipo de inspección
    	return $tipoInspeccion;

	}

}
