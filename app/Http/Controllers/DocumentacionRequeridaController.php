<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\DocumentacionRequerida;

class DocumentacionRequeridaController extends Controller
{
    public function listadoDocumentacionRequerida(){
		return view('documentacion-requerida.listado-documentacion-requerida');
	}

	public function tbody(){
		return Datatables::of(DocumentacionRequerida::query()->select([
			'id',
			'clave',
			'nombre',
			'activo'
		]))
		->addColumn('cambiarestatus', 'documentacion-requerida/boton-estatus')
		->addColumn('editar', 'documentacion-requerida/boton-editar')
		->rawColumns(['cambiarestatus', 'editar'])
		->make(true);
	}

	public function create(Request $request){

		// Valida los campos para evitar problemas y poder agregarlos a la base de datos
		$validate = $request->validate([
			'nombre' => 'required|string|max:255',
            'clave' => 'required|string|max:10',
            //'tipoInspeccion' => 'required|string'
	    ]);

	    // Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'nombre' => $request->input('nombre'),
			'clave' => $request->input('clave'),
            'activo' => 1
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
	    return DocumentacionRequerida::create($datos);
	}

	public function editarDocumento($id){
    	$documento = DocumentacionRequerida::find($id);
    	return $documento;
    }

    public function update(Request $request){
		// Se reciben la id del registro que se esta modificando
		$id = $request->input('id');

		// Se selecciona el registro para ser modificado
		$documento = DocumentacionRequerida::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:255',
            'clave' => 'required|string|max:10'
		]);

		// Se reciben los datos del formulario y se crean variables
		$nombre = $request->input('nombre');
		$clave = $request->input('clave');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$documento->nombre = $nombre;
		$documento->clave = $clave;
		$documento->update();

        // Indica que fue correcta la modificación
    	return $documento;

	}

	public function updateEstatus(Request $request){

		// Se reciben la id del usuario que se esta modificando
		$id = $request->input('id');

		// Se selecciona el usuario para ser modificado
		$documento = DocumentacionRequerida::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
       		'activo' => 'required|string',
		]);

		// Se reciben los datos del formulario y se crean variables
		$activo = $request->input('activo');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$documento->activo = $activo;
		$documento->update();

        // Una vez actualizado el usuario redirige e indica que fue correcta la modificación del usuario
    	return $documento;

	}

}
