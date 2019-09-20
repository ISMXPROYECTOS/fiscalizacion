<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Comercio;
use SoapClient;

class ComercioController extends Controller
{
	public function listadoComercios(){
		return view('comercio.listado-comercios');
	}

	public function tbody(){
		$comercios = Comercio::all();
		return Datatables::of($comercios)
			->addColumn('cambiarestatus', 'comercio/boton-estatus')
			->addColumn('editar', 'comercio/boton-editar')
			->rawColumns(['editar', 'cambiarestatus'])
			->toJson();
	}

	public function create(Request $request){
		// Valida los campos para evitar problemas y poder agregarlos a la base de datos
		$validate = $request->validate([
			'rfc' => 'required|string|max:20',
			'propietario' => 'required|string|max:255',
			'denominacion' => 'required|string|max:255',
			'nombreestablecimiento' => 'required|string|max:255',
			'domiciliofiscal' => 'required|string|max:255',
			'nointerior' => 'required|string|max:10',
			'noexterior' => 'required|string|max:10',
			'cp' => 'required|string|max:5'
		]);

		// Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'rfc' => $request->input('rfc'),
			'propietarionombre' => $request->input('propietario'),
			'denominacion' => $request->input('denominacion'),
			'nombreestablecimiento' => $request->input('nombreestablecimiento'),
			'domiciliofiscal' => $request->input('domiciliofiscal'),
			'nointerior' => $request->input('nointerior'),
			'noexterior' => $request->input('noexterior'),
			'cp' => $request->input('cp'),
			'estatus' => 'A'
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
		return Comercio::create($datos);
	}

	public function editarComercio($id){
		$comercio = Comercio::find($id);
		return $comercio;
	}

	public function update(Request $request){
		// Se reciben la id del registro que se esta modificando
		$id = $request->input('id');

		// Se selecciona el registro para ser modificado
		$comercio = Comercio::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'rfc' => 'required|string|max:20',
			'propietario' => 'required|string|max:255',
			'denominacion' => 'required|string|max:255',
			'nombreestablecimiento' => 'required|string|max:255',
			'domiciliofiscal' => 'required|string|max:255',
			'nointerior' => 'required|string|max:10',
			'noexterior' => 'required|string|max:10',
			'cp' => 'required|string|max:5'
		]);

		// Se reciben los datos del formulario y se crean variables
		$rfc = $request->input('rfc');
		$propietario = $request->input('propietario');
		$denominacion = $request->input('denominacion');
		$nombreestablecimiento = $request->input('nombreestablecimiento');
		$domiciliofiscal = $request->input('domiciliofiscal');
		$nointerior = $request->input('nointerior');
		$noexterior = $request->input('noexterior');
		$cp = $request->input('cp');

		// Una ves verificados los datos y creados las variables se actualiza en la BD
		$comercio->rfc = $rfc;
		$comercio->propietarionombre = $propietario;
		$comercio->denominacion = $denominacion;
		$comercio->nombreestablecimiento = $nombreestablecimiento;
		$comercio->domiciliofiscal = $domiciliofiscal;
		$comercio->nointerior = $nointerior;
		$comercio->noexterior = $noexterior;
		$comercio->cp = $cp;
		$comercio->update();

		// Indica que fue correcta la modificación
		return $comercio;
	}

	public function updateEstatus(Request $request){
		// Se reciben la id del registro que se esta modificando
		$id = $request->input('id');

		// Se selecciona el registro para ser modificado
		$comercio = Comercio::where('id', $id)->first();

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'estatus' => 'required|string|max:1'
		]);
		
		// Se reciben los datos del formulario y se crean variables
		$estatus = $request->input('estatus');

		// Una ves verificados los datos y creados las variables se actualiza en la BD
		$comercio->estatus = $estatus;
		$comercio->update();

		// Una vez actualizado el registro redirige e indica que fue correcta la modificación del registro
		return $comercio;
	}

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

	public function buscarComerciosPorNombre($nombre){
		if ($nombre == 'null') {
			return response()->json([
				'error' => true,
				'mensaje' => 'Ingresa un valor correcto.'
			], 422);
		} else {
			$comercios = Comercio::where('nombreestablecimiento', 'like', '%'. $nombre .'%')->get();
			if (count($comercios) == 0) {
				return response()->json([
					'mensaje' => 'No se encontro ningun resultado.'
				], 404);
			} else {
				return $comercios;  
			}
			
		}
		
	}

	public function comerciosDesdeSoap(){
		$url = "http://201.144.238.68:8030/dsaws/IServiceObtieneLicencias.svc?wsdl";

		try{
			$cliente = new SoapClient($url);
			//dd($cliente->__getTypes());
			//dd($cliente->obtieneComerciosLicenciasId());
			//dd($comercios);
			
			$comercios = $cliente->obtieneComerciosLicenciasId();

			foreach ($comercios as $comercio) {
				echo $comercio->claEntComercio[0]->CodigoPostalColonia;
			}
			die();
			

			if (empty($comercios)) {
				echo "No hay comercios";
			} else {
				return view('comercio.pruebas', [
					'comercios' => $comercios
				]);
			}
			
		}catch(\Exception $error){
			return $error->getMessage();
		}

	}

}
