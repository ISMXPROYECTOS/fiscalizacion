<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use App\Inspeccion;
use App\Multa;
use App\EstatusInspeccion;
use App\BitacoraDeEstatus;
use SoapClient;

class MultaController extends Controller
{
	public function listadoMultas(){
		return view('multas.listado-multas');
	}

	public function tbody(){
		$collection = new Collection();
		
		$multas = Multa::with([
			'inspeccion' => function($query){
				$query->select(['id', 'folio']);
			}
		])->with([
			'usuario' => function($query){
				$query->select(['id', 'usuario']);
			}
		])->orderBy('id', 'DESC')->get([
			'id',
			'inspeccion_id',
			'usuario_id',
			'montoMulta',
			'valorUma',
			'total',
			'estatus',
			'folio',
			'fechavence',
			'created_at'
		]);

		if($multas){
			foreach($multas as $multa){
				if(!empty($multa->fechavence)){
					$date = strtotime($multa->fechavence);
					$fechavence = date("d/m/Y", $date);
				} else {
					$fechavence = '';
				}

				$hoy = new \DateTime();
				$dia_anterior = date("d/m/Y", strtotime($multa->fechavence."-1 days"));

				$tmp = [
					'id' 				=> $multa->id,
					'idInspeccion' 		=> $multa->inspeccion->id,
					'folioMulta' 		=> $multa->folio,
					'folioInspeccion' 	=> $multa->inspeccion->folio,
					'montoMulta' 		=> $multa->montoMulta,
					'valorUma'	 		=> $multa->valorUma,
					'total' 			=> $multa->total,
					'estatus' 			=> $multa->estatus,
					'fechacreada' 		=> $multa->created_at->format('d/m/Y'),
					'fechavence' 		=> $fechavence,
					'dia_anterior'		=> $dia_anterior,
					'hoy' 				=> $hoy->format('d/m/Y')
				];
				
				$collection->push($tmp);
				unset($tmp);
			}
		}
		
		return DataTables::of($collection)
		->addColumn('cambiarestatus', 'multas/boton-estatus')
		->rawColumns(['cambiarestatus'])
		->make(true);
	}

	public function editarEstatus($id){
		$multa = Multa::find($id);
		
    	return $multa;
	}
	
	public function updateEstatus(Request $request){
		$validate = $this->validate($request,[
			'estatus' => 'required|string|max:3'
		]);

		$id = $request->input('id');
		$estatus = $request->input('estatus');
		
		$usuario = Auth::user();
		$multa = Multa::find($id);

		$multa->estatus = $estatus;
		$multa->update();

    	return $multa;
	}

	public function confirmarMulta(Request $request){
		$validate = $this->validate($request, [
			'cantidad-multa' => 'required|string'
		]);

		$id_inspeccion = $request->input('id');
		$multa = $request->input('cantidad-multa');
		$obtenerValorUma = $this->obtenerValorUma();
		$obtenerValorUma = json_encode($obtenerValorUma);
		$obtenerValorUma = json_decode($obtenerValorUma);

		$data = [
			'code' => 400,
			'message' => 'Ups!!, ocurrio algo inesperado'
		];

		if (!empty($obtenerValorUma) && is_object($obtenerValorUma)) {
			if ($obtenerValorUma->code == 200) {
				$valorUma = $obtenerValorUma->valorUma;
			} else {
				$data = [
					'code' => 400,
					'message' => 'El metodo del soap retorno un error',
					'error' => $obtenerValorUma->message
				];

				return $data;
			}
		}

		$inspeccion = Inspeccion::find($id_inspeccion);
		$estatus_multa = EstatusInspeccion::where('clave', 'M')->first();
		$estatus_V = EstatusInspeccion::where('clave', 'V')->first();
		$estatus_Cap = EstatusInspeccion::where('clave', 'Cap')->first();
		$usuario = Auth::user();
		$total = $multa * $valorUma;
		$hoy = date('Y-m-d');
		$fechavence = date('Y-m-d', strtotime($hoy . "+ 30 days"));

		$nueva_multa = new Multa();
		$nueva_multa->inspeccion_id = $inspeccion->id;
		$nueva_multa->usuario_id 	= $usuario->id;
		$nueva_multa->montoMulta 	= $multa;
		$nueva_multa->valorUma 		= $valorUma;
		$nueva_multa->total 		= $total;
		$nueva_multa->estatus 		= 'PP';
		$nueva_multa->fechacreada 	= $hoy;
		$nueva_multa->fechavence	= $fechavence;

		if ($inspeccion->estatusinspeccion_id == $estatus_V->id || $inspeccion->estatusinspeccion_id == $estatus_Cap->id) {
			if ($nueva_multa->save()) {
				$inspeccion->usuario_id = $usuario->id;
				$inspeccion->estatusinspeccion_id = $estatus_multa->id;
				$inspeccion->update();

				$nueva_multa->folio = $inspeccion->folio . '-Multa-' . $nueva_multa->id;
				$nueva_multa->update();

				$datos_bitacora = [
					'inspeccion_id' => $inspeccion->id,
					'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
					'usuario_id' => $usuario->id,
					'observacion' => $estatus_multa->nombre
				];

				BitacoraDeEstatus::create($datos_bitacora);

				$data = [
					'code' => 200,
					'message' => 'Multa creada correctamente'
				];
			} else {
				$data = [
					'code' => 400,
					'message' => 'No se pudo crear la multa'
				];
			}
		} else {
			$data = [
				'code' => 400,
				'message' => 'No se pudo crear la multa, las multas solo se crean si la inspeccion esta vencida o le faltan documentos'
			];
		}

		return $data;
	}

	public function obtenerValorUma(){
		$url = "http://201.144.238.68:8010/dsaws/IServiceObtieneValorUMA.svc?wsdl";

		$data = [
			'code' => 400,
			'message' => 'Ups!!, ocurrio algo inesperado'
		];

		try{
			$cliente = new SoapClient($url);
			//dd($cliente->__getFunctions());
			$data = $cliente->dtsValorUMA();
			//dd($data);

			if (empty($data)) {
				$data = [
					'code' => 400,
					'message' => 'El soap no trajo valores'
				];

				return $data;
			} else {
				$soap = json_encode($data);
				$soap_array = json_decode($soap);
				$valorUma = $soap_array->dtsValorUMAResult->proDouValorUMA;

				$data = [
					'code' => 200,
					'message' => 'Se obtuvo el valor UMA correctamente',
					'valorUma' => $valorUma
				];
				
				return $data;
			}
		} catch(\Exception $error) {
			$data = [
				'code' => 400,
				'message' => 'Ocurrio algo inesperado en el soap',
				'error' => $error->getMessage()
			];

			return $data;
		}
	}

}
