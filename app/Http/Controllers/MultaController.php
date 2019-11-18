<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Inspeccion;
use App\Multa;
use App\EstatusInspeccion;

class MultaController extends Controller
{
	/* El método se encarga de crear multas para las inspecciones que estan vencidas o deben documentos los comercios */
	public function confirmarMulta(Request $request){
		$validate = $this->validate($request, [
			'cantidad-multa' => 'required|string'
		]);

		$id_inspeccion = $request->input('id');
		$multa = $request->input('cantidad-multa');
		$valorUma = 75.50;
		$inspeccion = Inspeccion::find($id_inspeccion);
		$estatus_multa = EstatusInspeccion::where('clave', 'M')->first();
		$usuario = Auth::user();
		$total = $multa * $valorUma;
		$hoy = date('Y-m-d');
		$fechavence = date('Y-m-d', strtotime($hoy . "+ 30 days"));

		$data = [
			'code' => 400,
			'message' => 'Ups!!, ocurrio algo inesperado'
		];

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

}
