<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDeInspeccion;
use App\DocumentacionRequerida;
use App\DocumentacionPorTipoDeInspeccion;

class TipoInspeccionController extends Controller
{
	public function listadoTipoInspecciones(){
		$documentacion_requerida = DocumentacionRequerida::where('activo', 1)->get();

		return view('tipoInspeccion.listado-tipo-inspecciones', array(
			'documentos' => $documentacion_requerida
		));
	}

	public function tbody(){
		return datatables()
			->eloquent(TipoDeInspeccion::query())
			->addColumn('btn', 'tipoInspeccion/actions-tipo-inspecciones')
			->rawColumns(['btn'])->toJson();
	}

	public function create(Request $request){
		$validate = $this->validate($request, [
			'nombre' => 'required|string|max:75',
			'clave' => 'required|string|max:10|unique:tipodeinspeccion',
			'diasvencimiento' => 'required|string|max:3',
			'documentos-requeridos.*' => 'required|string',
		]);

		$data = $request->all();
		$nombre = $request->input('nombre');
		$clave = $request->input('clave');
		$diasvencimiento = $request->input('diasvencimiento');
		$documentos_requeridos = array_get($data, 'documentos-requeridos');

		$nuevo_tipo_inspeccion = new TipoDeInspeccion();
		$nuevo_tipo_inspeccion->clave = $clave;
		$nuevo_tipo_inspeccion->nombre = $nombre;
		$nuevo_tipo_inspeccion->diasvencimiento = $diasvencimiento;
		$nuevo_tipo_inspeccion->save();

		if (!empty($documentos_requeridos)) {
			for ($i = 0; $i < count($documentos_requeridos); $i++) {
				$datos_documentacion = [
					'tipoinspeccion_id' => $nuevo_tipo_inspeccion->id,
					'documentacionrequerida_id' => $documentos_requeridos[$i]
				];

				DocumentacionPorTipoDeInspeccion::create($datos_documentacion);
			}
		}

		return $nuevo_tipo_inspeccion;
	}

	public function editarTipoInspeccion($id){
		$tipoInspeccion = TipoDeInspeccion::find($id);
		$documentacion_requerida = DocumentacionRequerida::where('activo', 1)->get();
		$documentacion_por_tipo_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $id)->get();

		if (!empty($tipoInspeccion) && !empty($documentacion_por_tipo_inspeccion) && !empty($documentacion_requerida)) {
			$data = [
				'status' => 200,
				'tipoInspeccion' => $tipoInspeccion,
				'documentacionPorTipoDeInspeccion' => $documentacion_por_tipo_inspeccion,
				'documentacionRequerida' => $documentacion_requerida
			];
		} else {
			$data = [
				'status' => 500,
				'error' => 'No se pudieron cargar los datos'
			];
		}
		
		return $data;
	}

	public function update(Request $request){
		// Se selecciona el tipo de inspección para ser modificado
		$id = $request->input('id-edit');
		$tipoInspeccion = TipoDeInspeccion::find($id);
		$documentacion_requerida = DocumentacionRequerida::where('activo', 1)->get();
		$documentacion_por_tipo_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $id)->get();

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:75',
			'clave' => 'required|string|max:10|',
			'diasvencimiento' => 'required|string|max:3'
		]);

		// Se reciben los datos del formulario y se crean variables
		$data = $request->all();
		$nombre = $request->input('nombre');
		$clave = $request->input('clave');
		$diasvencimiento = $request->input('diasvencimiento');
		$nueva_documentacion = array_get($data, 'documentos-requeridos');

		// Una ves verificados los datos y creados las variables se actualiza en la BD
		$tipoInspeccion->nombre = $nombre;
		$tipoInspeccion->clave = $clave;
		$tipoInspeccion->diasvencimiento = $diasvencimiento;
		$tipoInspeccion->update();

		if (count($documentacion_por_tipo_inspeccion) > 0) {
			for ($i = 0; $i < count($documentacion_por_tipo_inspeccion); $i++) {
				$documentacion_por_tipo_inspeccion[$i]->delete();
			}
		}

		if (!empty($nueva_documentacion)) {
			if (count($nueva_documentacion) > 0) {
				for ($a = 0; $a < count($nueva_documentacion); $a++) {
					$datos_documentacion = [
						'tipoinspeccion_id' => $id,
						'documentacionrequerida_id' => $nueva_documentacion[$a]
					];

					DocumentacionPorTipoDeInspeccion::create($datos_documentacion);
				}
			}
		}

		// Indica que fue correcta la modificación del tipo de inspección
		return $tipoInspeccion;

	}

}
