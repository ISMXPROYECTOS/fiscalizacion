<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\EstatusInspeccion;

class EstatusInspeccionController extends Controller
{
	public function listadoEstatusInspecciones(){
		return view('estatusInspeccion.listado-estatus-inspecciones');
	}

	public function tbody(){
		return Datatables::of(EstatusInspeccion::query()->select([
			'id',
			'clave',
			'nombre',
			'created_at'
		]))
		->addColumn('btn', 'estatusInspeccion/actions-estatus-inspecciones')
		->rawColumns(['btn'])
		->make(true);
	}

	public function create(Request $request){
		$validate = $request->validate([
			'nombre' => 'required|string|max:75',
            'clave' => 'required|string|max:10|unique:estatusinspeccion'
	    ]);

		$datos = [
			'nombre' => $request->input('nombre'),
            'clave' => $request->input('clave')
		];

	    return EstatusInspeccion::create($datos);
	}

	public function editarEstatusInspeccion($id){
    	$estatusInspeccion = EstatusInspeccion::find($id);
    	return $estatusInspeccion;
    }

    public function update(Request $request){
		// Se selecciona el estatus inspección para ser modificado
		$id = $request->input('id');
		$tipoInspeccion = EstatusInspeccion::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:75'
		]);

		// Se reciben los datos del formulario y se crean variables
		$nombre = $request->input('nombre');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$tipoInspeccion->nombre = $nombre;
		$tipoInspeccion->update();

        // Indica que fue correcta la modificación del tipo de inspección
    	return $tipoInspeccion;
	}

}
