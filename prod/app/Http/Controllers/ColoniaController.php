<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Municipio;
use App\Colonia;

class ColoniaController extends Controller
{
	public function listadoColonias(){
		return view('colonia.listado-colonias');
	}

	public function tbody(){
		return Datatables::of(Colonia::query()->with([
			'municipio' => function($query){
				$query->select(['id', 'nombre']);
			}
		])->select([
			'id',
			'municipio_id',
			'nombre',
			'cp'
		]))
		->addColumn('editar', 'colonia/boton-editar')
		->rawColumns(['editar'])
		->make(true);
	}

	public function create(Request $request){
		// Valida los campos para evitar problemas y poder agregarlos a la base de datos
		$validate = $request->validate([
			'nombre' => 'required|string|max:75',
            'cp' => 'required|string|max:5'
	    ]);

		$municipio = Municipio::where('nombre', 'BENITO JUÁREZ')->where('estado_id', 23)->first();

	    // Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'municipio_id' => $municipio->id,
			'nombre' => $request->input('nombre'),
            'cp' => $request->input('cp')
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
	    return Colonia::create($datos);
	}

	public function editarColonia($id){
    	$colonia = Colonia::find($id);
    	return $colonia;
    }

    public function update(Request $request){
		// Se reciben la id del registro que se esta modificando
		$id = $request->input('id');

		// Se selecciona el registro para ser modificado
		$colonia = Colonia::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:75',
            'cp' => 'required|string|max:5'
		]);

		// Se reciben los datos del formulario y se crean variables
		$nombre = $request->input('nombre');
		$cp = $request->input('cp');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$colonia->nombre = $nombre;
		$colonia->cp = $cp;
		$colonia->update();

        // Indica que fue correcta la modificación
    	return $colonia;

	}
}
