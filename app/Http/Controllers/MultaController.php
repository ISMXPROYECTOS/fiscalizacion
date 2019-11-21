<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Inspeccion;
use App\Multa;
use App\EstatusInspeccion;
use SoapClient;

class MultaController extends Controller
{
	/* El método se encarga de crear multas para las inspecciones que estan vencidas o deben documentos los comercios */
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

		if ($nueva_multa->save()) {
			$inspeccion->estatusinspeccion_id = $estatus_multa->id;
			$inspeccion->update();
			
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
