<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Gestor;
use App\Inspeccion;

class GestorController extends Controller
{
	public function listadoGestores(){
		return view('gestor.listado-gestores');
	}

	public function tbody(){
		$collection = new Collection();
		
		$gestores = Gestor::get([
			'id',
			'nombre',
			'apellidopaterno',
			'apellidomaterno',
			'telefono',
			'celular',
			'correoelectronico',
			'ine',
			'estatus'
		]);

		if($gestores){
			foreach($gestores as $gestor){
				$tmp = [
					'id' 				=> $gestor->id,
					'nombre' 			=> $gestor->nombre.' '.$gestor->apellidopaterno.' '.$gestor->apellidomaterno,
					'telefono' 			=> $gestor->telefono,
					'celular' 			=> $gestor->celular,
					'correoelectronico' => $gestor->correoelectronico,
					'ine' 				=> $gestor->ine,
					'estatus' 			=> $gestor->estatus
				];
				
				$collection->push($tmp);
				unset($tmp);
			}
		}
		
		return DataTables::of($collection)
		->addColumn('editar', 'gestor/boton-editar')
		->addColumn('cambiarestatus', 'gestor/boton-estatus')
		->addColumn('inspecciones', 'gestor/boton-inspecciones')
		->rawColumns(['editar', 'cambiarestatus', 'inspecciones'])
		->make(true);
	}

	public function create(Request $request){
		// Validara los campos para evitar problemas 
		$validate = $request->validate([
			'nombre' => 'required|string|max:50',
			'apellidopaterno' => 'required|string|max:30',
			'apellidomaterno' => 'required|string|max:30',
			'telefono' => 'required|string|min:10|max:50',
			'celular' => 'required|string|min:10|max:50',
			'correoelectronico' => 'required|string|max:75|unique:gestores',
			'ine' => 'required|string|max:30|unique:gestores',
			'estatus' => 'required|string|max:1'
		]);

		// Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'usuario_id' => \Auth::user()->id,
			'nombre' => $request->input('nombre'),
			'apellidopaterno' => $request->input('apellidopaterno'),
			'apellidomaterno' => $request->input('apellidomaterno'),
			'telefono' => $request->input('telefono'),
			'celular' => $request->input('celular'),
			'correoelectronico' => $request->input('correoelectronico'),
			'ine' => $request->input('ine'),
			'estatus' => $request->input('estatus')
		];

		// Retornamos los datos a la peticion Ajax al mismo tiempo en que se almacena en la BD
		return Gestor::create($datos);
	}


	public function editarGestor($id){
		$gestor = Gestor::find($id);
		return $gestor;
	}

	public function update(Request $request){
		/* Se selecciona el gestor para ser modificado */
		$id = $request->input('id');
		$gestor = Gestor::find($id);

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:50',
			'apellidopaterno' => 'required|string|max:30',
			'apellidomaterno' => 'required|string|max:30',
			'telefono' => 'required|string|max:50',
			'celular' => 'required|string|max:50',
			'correoelectronico' => 'required|string|max:75|unique:gestores,correoelectronico,' . $id,
			'ine' => 'required|string|max:30|unique:gestores,ine,' . $id
		]);

		/* Se reciben los datos del formulario y se crean variables */
		/* Optiene la id del usuario administrador que modifica los gestores */

		$idusuario = \Auth::user()->id;
		$nombre = $request->input('nombre');
		$apellidopaterno = $request->input('apellidopaterno');
		$apellidomaterno = $request->input('apellidomaterno');
		$telefono = $request->input('telefono');
		$celular = $request->input('celular');
		$correoelectronico = $request->input('correoelectronico');
		$ine = $request->input('ine');

		/* Una ves verificados los datos y creados las variables se actualiza en la BD */
		$gestor->usuario_id = $idusuario;
		$gestor->nombre = $nombre;
		$gestor->apellidopaterno = $apellidopaterno;
		$gestor->apellidomaterno = $apellidomaterno;
		$gestor->telefono = $telefono;
		$gestor->celular = $celular;
		$gestor->correoelectronico = $correoelectronico;
		$gestor->ine = $ine;
		$gestor->update();

		return $gestor;
	}

	public function updateEstatus(Request $request){
		/* Se selecciona el gestor para ser modificado */
		$id = $request->input('id');
		$gestor = Gestor::find($id);

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
			'estatus' => 'required|string|max:1'
		]);

		$idusuario = \Auth::user()->id;
		$estatus = $request->input('estatus');

		// Una ves verificados los datos y creados las variables se actualiza en la BD
		$gestor->usuario_id = $idusuario;
		$gestor->estatus = $estatus;
		$gestor->update();

		return $gestor;
	}

	public function inspeccionesPorGestor($id){
		return Datatables::of(Inspeccion::where('gestores_id', $id)->with([
			'tipoInspeccion' => function($query){
				$query->select(['id', 'clave']);
			}
		])->with([
			'estatusInspeccion' => function($query){
				$query->select(['id', 'nombre']);
			}
		])->select([
			'id',
			'tipoinspeccion_id',
			'estatusinspeccion_id',
			'folio'
		]))
		->make(true);
	}

}
