<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Comercio;
use App\Colonia;
use App\Municipio;
use App\Estado;
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
			->make(true);
	}

	public function create(Request $request){
		// Valida los campos para evitar problemas y poder agregarlos a la base de datos
		$validate = $request->validate([
			'rfc' 						=> 'required|string|max:20',
			'licenciafuncionamiento' 	=> 'nullable|string|max:10',
			'propietario' 				=> 'required|string|max:255',
			'clavecatastral' 			=> 'nullable|string|max:255',
			'denominacion' 				=> 'required|string|max:255',
			'nombreestablecimiento' 	=> 'required|string|max:255',
			'domiciliofiscal' 			=> 'required|string|max:255',
			'nointerior' 				=> 'required|string|max:10',
			'noexterior' 				=> 'required|string|max:10'
		]);

		// Se reciben los datos del formulario y se crean variables
		$rfc = $request->input('rfc');
		$licenciafuncionamiento = $request->input('licenciafuncionamiento');
		$propietario = $request->input('propietario');
		$clavecatastral = $request->input('clavecatastral');
		$denominacion = $request->input('denominacion');
		$nombreestablecimiento = $request->input('nombreestablecimiento');
		$domiciliofiscal = $request->input('domiciliofiscal');
		$nointerior = $request->input('nointerior');
		$noexterior = $request->input('noexterior');

		$colonia = Colonia::where('nombre', 'Cancun')->first();
		$estado = Estado::where('nombre', 'Quintana Roo')->where('clave', 'QROO')->first();
		$municipio = Municipio::Where('estado_id', $estado->id)->where('nombre', 'BENITO JUÁREZ')->first();

		$comercio = new Comercio();
		$comercio->rfc = $rfc;

		if ($licenciafuncionamiento != null) {
			$comercio->licenciafuncionamientoid = $licenciafuncionamiento;
			$comercio->licenciafuncionamiento = $licenciafuncionamiento;
		}
		
		$comercio->propietarionombre = $propietario;

		if ($clavecatastral != null) {
			$comercio->clavecatastral = $clavecatastral;
		}
		
		$comercio->denominacion = $denominacion;
		$comercio->nombreestablecimiento = $nombreestablecimiento;
		$comercio->domiciliofiscal = $domiciliofiscal;
		$comercio->calle = $domiciliofiscal;
		$comercio->nointerior = $nointerior;
		$comercio->noexterior = $noexterior;
		$comercio->cp = $colonia->cp;
		$comercio->colonia = $colonia->nombre;
		$comercio->localidad = $municipio->nombre;
		$comercio->municipio = $municipio->nombre;
		$comercio->estado = $estado->nombre;
		$comercio->estatus = 'A';
		$comercio->save();

		// Se retorna el nuevo registro
		return $comercio;
	}

	public function editarComercio($id){
		$comercio = Comercio::find($id);
		return $comercio;
	}

	public function update(Request $request){
		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'rfc' 						=> 'required|string|max:20',
			'licenciafuncionamiento' 	=> 'nullable|string|max:10',
			'propietario' 				=> 'required|string|max:255',
			'clavecatastral' 			=> 'nullable|string|max:255',
			'denominacion' 				=> 'required|string|max:255',
			'nombreestablecimiento' 	=> 'required|string|max:255',
			'domiciliofiscal' 			=> 'required|string|max:255',
			'nointerior' 				=> 'required|string|max:10',
			'noexterior' 				=> 'required|string|max:10'
		]);

		// Se reciben la id del registro que se esta modificando
		$id = $request->input('id');

		// Se reciben los datos del formulario y se crean variables
		$rfc = $request->input('rfc');
		$licenciafuncionamiento = $request->input('licenciafuncionamiento');
		$propietario = $request->input('propietario');
		$clavecatastral = $request->input('clavecatastral');
		$denominacion = $request->input('denominacion');
		$nombreestablecimiento = $request->input('nombreestablecimiento');
		$domiciliofiscal = $request->input('domiciliofiscal');
		$nointerior = $request->input('nointerior');
		$noexterior = $request->input('noexterior');

		// Se selecciona el registro para ser modificado
		$comercio = Comercio::find($id);

		// Una ves verificados los datos y creados las variables se actualiza en la BD
		$comercio->rfc = $rfc;

		if ($licenciafuncionamiento != null) {
			$comercio->licenciafuncionamientoid = $licenciafuncionamiento;
			$comercio->licenciafuncionamiento = $licenciafuncionamiento;
		}else{
			$comercio->licenciafuncionamientoid = null;
			$comercio->licenciafuncionamiento = null;
		}
		
		$comercio->propietarionombre = $propietario;

		if ($clavecatastral != null) {
			$comercio->clavecatastral = $clavecatastral;
		}else{
			$comercio->clavecatastral = null;
		}
		
		$comercio->denominacion = $denominacion;
		$comercio->nombreestablecimiento = $nombreestablecimiento;
		$comercio->domiciliofiscal = $domiciliofiscal;
		$comercio->calle = $domiciliofiscal;
		$comercio->nointerior = $nointerior;
		$comercio->noexterior = $noexterior;
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

	public function buscarComercios($domiciliofiscal){
		if ($domiciliofiscal == 'null') {
			return response()->json([
				'error' => true,
				'mensaje' => 'Ingresa un valor correcto.'
			], 422);
		} else {
			$comercios = Comercio::where('domiciliofiscal', 'like', '%'. $domiciliofiscal .'%')->get();
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
		$comercios_sincronizados = 0;
		$url = "http://201.144.238.68:8030/dsaws/IServiceObtieneLicencias.svc?wsdl";

		try{
			$cliente = new SoapClient($url);
			$data = $cliente->obtieneComerciosLicenciasId();
			//dd($data);

			if (empty($data)) {
				return redirect('/comercios')->with('status', 'No hay comercios para sincronizar.');
			} else {
				$comercios = json_encode($data);
				$comercios_array = json_decode($comercios);
				$total_comercios = count($comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio);

				for ($i = 0; $i < $total_comercios; $i++) {
					$comercio_bd = Comercio::where('licenciafuncionamientoid', $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->LicenciasFuncionamientoId)->first();
					if (empty($comercio_bd)) {
						$datos = [
							'rfc' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->RFCPersona,
							'licenciafuncionamientoid' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->LicenciasFuncionamientoId,
							'licenciafuncionamiento' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->LicenciasFuncionamientoFolio,
							'propietarioid' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->propietario_id,
							'propietarionombre' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->propietario,
							'clavecatastral' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->PredioCveCatastral,
							'denominacion' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->RazonSocialPersona,
							'nombreestablecimiento' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->nombrecomercial,
							'domiciliofiscal' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->Domicilio_Fiscal,
							'calle' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->calle,
							'nointerior' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->NumInt,
							'noexterior' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->NumExt,
							'cp' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->CodigoPostalColonia,
							'colonia' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->NombreColonia,
							'localidad' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->NombreOficialLocalidad,
							'municipio' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->NombreOficialMunicipio,
							'estado' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->NombreEntidadFederativa,
							'folio' => $comercios_array->obtieneComerciosLicenciasIdResult->claEntComercio[$i]->Folio,
							'estatus' => 'A'
						];

						Comercio::create($datos);
						$comercios_sincronizados = $comercios_sincronizados + 1;
					}
				}
				
				return redirect('/comercios')->with('status', $comercios_sincronizados . ' comercios se han sincronizado.');
			}
			
		}catch(\Exception $error){
			return $error->getMessage();
		}

	}

}
