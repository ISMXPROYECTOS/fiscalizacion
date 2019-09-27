<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDeInspeccion;
use App\DocumentacionRequerida;
use App\DocumentacionPorTipoDeInspeccion;

class TipoInspeccionController extends Controller
{
	public function listadoTipoInspecciones(){
		$documentacion_requerida = DocumentacionRequerida::all();
		$documentacion_por_tipo_inspeccion = DocumentacionPorTipoDeInspeccion::all();
		return view('tipoInspeccion.listado-tipo-inspecciones', array(
			'documentos' => $documentacion_requerida,
			'documentosPorTipoInspeccion' => $documentacion_por_tipo_inspeccion
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
            'formato' => 'required|string|max:30',
            'documentos-requeridos.*' => 'required|string',
	    ]);

		$data = $request->all();
	    $nombre = $request->input('nombre');
	    $clave = $request->input('clave');
	    $formato = $request->input('formato');
	    $documentos_requeridos = array_get($data, 'documentos-requeridos');

	 	

		$datos = [
			'nombre' => $nombre,
            'clave' => $clave,
            'formato' => $formato 
		];

	    TipoDeInspeccion::create($datos);

	   	$tipo_de_inspeccion = TipoDeInspeccion::where('nombre', $nombre)->first();

	    for ($i = 0; $i < count($documentos_requeridos); $i++) { 

	    	$datos_documentacion = [
	    		'tipoinspeccion_id' => $tipo_de_inspeccion->id,
	    		'documentacionrequerida_id' => $documentos_requeridos[$i]
	    	];

	    	DocumentacionPorTipoDeInspeccion::create($datos_documentacion);
	    }

	    return $datos;

	}

	public function editarTipoInspeccion($id){
    	$tipoInspeccion = TipoDeInspeccion::find($id);
    	$documentacion_por_tipo_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $id)->get();
    	return array($tipoInspeccion, $documentacion_por_tipo_inspeccion);
    }

    public function update(Request $request){
		// Se selecciona el tipo de inspección para ser modificado
		$id = $request->input('id');
		$tipoInspeccion = TipoDeInspeccion::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:75',
			'clave' => 'required|string|max:10|unique:tipodeinspeccion,clave,' . $id,
            'formato' => 'required|string|max:30'
		]);

		// Se reciben los datos del formulario y se crean variables
		$nombre = $request->input('nombre');
		$clave = $request->input('clave');
		$formato = $request->input('formato');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$tipoInspeccion->nombre = $nombre;
		$tipoInspeccion->clave = $clave;
		$tipoInspeccion->formato = $formato;
		$tipoInspeccion->update();

        // Indica que fue correcta la modificación del tipo de inspección
    	return $tipoInspeccion;

	}

}
