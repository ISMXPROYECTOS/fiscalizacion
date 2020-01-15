<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use App\Inspector;
use App\Gafete;

class InspectorController extends Controller
{
	// Muetra la vista del listado de los inspectores
	public function listadoInspectores(){
		return view('inspector.listado-inspectores');
	}

	// Solicita a la base de datos todos los inspectores que exiten
	// esa peticion la regresa a la vista en formato Json
	// addColumn y rawColumns se refieren al campo de la tabla 'acción', 
	// ese campo no lo va convertir a formato Json, ese campo sera
	// gobernado por el archivo actions-inspectores en ese archivo se
	// encuentran los botones de editar y eliminar para cada registro
	public function tbody(){
		return Datatables::of(Inspector::query()->select([
			'id',
			'nombre',
			'apellidopaterno',
			'apellidomaterno',
			'clave',
			'estatus'
		]))
		->addColumn('editar', 'inspector/boton-editar')
		->addColumn('cambiarestatus', 'inspector/boton-estatus')
		->addColumn('gafete', 'inspector/boton-gafete')
		->rawColumns(['editar', 'cambiarestatus', 'gafete'])
		->make(true);
	}

	public function create(Request $request){
		// Convierte la vigenciainicio de un string a un date
		$vigenciainicio = $request->input('vigenciainicio');
		$date = strtotime($vigenciainicio);
		$fecha_format = date("Y-m-d", $date);

		// Convierte la vigenciafin de un string a un date
		$vigenciafin = $request->input('vigenciafin');
		$date2 = strtotime($vigenciafin);
		$fecha_formato = date("Y-m-d", $date2);

		// Valida los campos para evitar problemas y poder agregarlos a la base de datos
		$validate = $request->validate([
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'clave' => 'required|string|max:10',
            'estatus' => 'required|string|max:1',
            'vigenciainicio' => 'required|date_format:Y-m-d',
            'vigenciafin' => 'required|date_format:Y-m-d'
	    ]);

	    // Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'usuario_id' => \Auth::user()->id,
			'nombre' => $request->input('nombre'),
            'apellidopaterno' => $request->input('apellidopaterno'),
            'apellidomaterno' => $request->input('apellidomaterno'),
            'clave' => $request->input('clave'),
            'hash' => sha1($request->input('nombre').$request->input('clave').rand()),
            'estatus' => $request->input('estatus'),
            'vigenciainicio' => $fecha_format,
            'vigenciafin' => $fecha_formato
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
	    return Inspector::create($datos);
	}

	// Recibe el id del registro que se quiere modificar y con base en el id
	// solicita a la base de datos toda la información de ese registro
	public function editarInspector($id){
    	$inspector = Inspector::find($id);
    	return $inspector;
    }

	public function update(Request $request){
		// Se reciben la id del inspector que se esta modificando
		$id = $request->input('id');

		// Convierte la vigenciainicio de un string a un date
		$vigenciainicio = $request->input('vigenciainicio');
		$date = strtotime($vigenciainicio);
		$fecha_format = date("Y-m-d", $date);

		// Convierte la vigenciafin de un string a un date
		$vigenciafin = $request->input('vigenciafin');
		$date2 = strtotime($vigenciafin);
		$fecha_formato = date("Y-m-d", $date2);

		// Se selecciona el inspector para ser modificado
		$inspector = Inspector::where('id', $id)->first();

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'clave' => 'required|string|max:10|unique:inspector,clave,' . $id,
            'vigenciainicio' => 'required|date_format:Y-m-d',
            'vigenciafin' => 'required|date_format:Y-m-d'
		]);

		// Obtiene la id del usuario administrador que modifica los inspectores
		$idUser = \Auth::user()->id;
		// Se reciben los datos del formulario y se crean variables
		$nombre = $request->input('nombre');
		$apellidopaterno = $request->input('apellidopaterno');
		$apellidomaterno = $request->input('apellidomaterno');
		$clave = $request->input('clave');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$inspector->usuario_id = $idUser;
		$inspector->nombre = $nombre;
		$inspector->apellidopaterno = $apellidopaterno;
		$inspector->apellidomaterno = $apellidomaterno;
		$inspector->clave = $clave;
		$inspector->vigenciainicio = $fecha_format;
		$inspector->vigenciafin = $fecha_formato;
		$inspector->update();

        // Indica que fue correcta la modificación del inspector
    	return $inspector;

	}

	public function updateEstatus(Request $request){
		// Se reciben la id del inspector que se esta modificando
		$id = $request->input('id');

		// Se selecciona el inspector para ser modificado
		$inspector = Inspector::where('id', $id)->first();

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'estatus' => 'required|string|max:1'
		]);

		// Obtiene la id del usuario administrador que modifica los inspectores
		$idUser = \Auth::user()->id;

		// Se reciben los datos del formulario y se crean variables
		$estatus = $request->input('estatus');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
        $inspector->usuario_id = $idUser;
		$inspector->estatus = $estatus;
		$inspector->update();

        // Una vez actualizado el inspector redirige e indica que fue correcta la modificación del inspector
    	return $inspector;

	}

	public function perfil($hash){

		$inspector = Inspector::where('hash', $hash)->first();
		$gafetes = Gafete::where('inspector_id', $inspector->id)->get();
		$gafete = $gafetes->last();

		return view('inspector.perfil',[
			'inspector' => $inspector,
			'gafete' => $gafete
		]);

	}

	

}
