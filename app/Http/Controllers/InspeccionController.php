<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Inspeccion;
use App\Inspector;
use App\Gestor;
use App\TipoDeInspeccion;
use App\FormaValorada;
use App\GiroComercial;
use App\SubgiroComercial;
use App\EjercicioFiscal;
use App\EstatusInspeccion;
use App\Colonia;

class InspeccionController extends Controller
{
	public function vistaAgregarInspeccion(){
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		return view('inspeccion.agregar-inspeccion', [
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales
		]);
	}

	public function vistaAgregarInspeccionPorZona(){
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		$colonias = Colonia::all();
		return view('inspeccion.agregar-inspeccion-por-zona', [
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales,
			'colonias' => $colonias
		]);
	}

	public function vistaAgregarInspeccionManual(){
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		return view('inspeccion.agregar-inspeccion-manual', [
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales
		]);
	}

	public function vistaAsignarInspeccion(){
		$inspectores = Inspector::all();
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		return view('inspeccion.asignar-inspeccion', [
			'inspectores' => $inspectores,
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales
		]);
	}

	// Muetra la vista del listado de las inspecciones
	public function listadoInspecciones(){
		$inspecciones = Inspeccion::all();
		$inspectores = Inspector::all();
		$gestores = Gestor::all();
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		$estatusInspecciones = EstatusInspeccion::all();
		$colonias = Colonia::all();
		return view('inspeccion.listado-inspecciones', [
			'inspecciones' => $inspecciones,
			'inspectores' => $inspectores,
			'gestores' => $gestores,
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales,
			'estatusInspecciones' => $estatusInspecciones,
			'colonias' => $colonias
		]);
	}

	public function tbody(){
		return datatables()
			->eloquent(Inspeccion::query())
			->addColumn('tipoInspeccion', function(Inspeccion $inspeccion){
				return $inspeccion->tipoInspeccion->clave;
			})
			->addColumn('estatusInspeccion', function(Inspeccion $inspeccion){
				return $inspeccion->estatusInspeccion->nombre;
			})
			->addColumn('inspector', function(Inspeccion $inspeccion){
				if(is_object($inspeccion->inspector)) {
					return $inspeccion->inspector->nombre;
				}
			})
			->addColumn('cambiarestatus', 'inspeccion/boton-estatus')
			->addColumn('informacion', 'inspeccion/boton-informacion')
			->rawColumns(['cambiarestatus', 'informacion'])
			->toJson();
	}

	public function create(Request $request){

		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
            'cantidad' => 'required|string',
            'ejerciciofiscal' => 'required|string',
            'tipoinspeccion' => 'required|string'
        ]);

    	$cantidad = $request->input('cantidad');
    	$ejercicio_fiscal_id = $request->input('ejerciciofiscal');
    	$tipo_inspeccion_id = $request->input('tipoinspeccion');
    	$usuario = Auth::user();
    	
    	$estatus_inspeccion = EstatusInspeccion::where('clave', 'NA')->first();
		$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();
		
		if ($forma_valorada->count() == 0) {

			$datos = [
				'usuario_id' => $usuario->id,
				'tipoinspeccion_id' => $tipo_inspeccion_id,
				'ejerciciofiscal_id' => $ejercicio_fiscal_id,
				'configuracion_id' => 1,
				'folioinicio' => 1,
				'foliofin' => $cantidad
			];

			FormaValorada::create($datos);

		} else {

			$folio_fin = $forma_valorada->last()->foliofin;
			$nuevo_folio_inicio = $folio_fin + 1;
			$nuevo_folio_fin = $folio_fin + $cantidad;

			$datos = [
				'usuario_id' => $usuario->id,
				'tipoinspeccion_id' => $tipo_inspeccion_id,
				'ejerciciofiscal_id' => $ejercicio_fiscal_id,
				'configuracion_id' => 1,
				'folioinicio' => $nuevo_folio_inicio,
				'foliofin' => $nuevo_folio_fin
			];

			FormaValorada::create($datos);
		}

		for ($a = 0; $a < $cantidad; $a++) {

			$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();
			$id_forma_valorada = $forma_valorada->last()->id;

			$folio_inicio = $forma_valorada->last()->folioinicio;
			$folio = $folio_inicio + $a;

			$ejercicio_fiscal = EjercicioFiscal::find($ejercicio_fiscal_id);
			$ejercicio_fiscal_anio = $ejercicio_fiscal->anio;

			$tipo_inspeccion = TipoDeInspeccion::find($tipo_inspeccion_id);
			$tipo_inspeccion_clave = $tipo_inspeccion->clave;

			$datos = [
				'formavalorada_id' => $id_forma_valorada,
				'tipoinspeccion_id' => $tipo_inspeccion_id,
				'usuario_id' => $usuario->id,
				'ejerciciofiscal_id' => $ejercicio_fiscal_id,
				'estatusinspeccion_id' => $estatus_inspeccion->id,
				'folio' => $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio
			];

			Inspeccion::create($datos);		
		}

		$id_forma_valorada = $forma_valorada->last()->id;
		
    	return redirect('inspecciones/agregar')->with(['status' => 'Se ha creado correctamente', 'idfv' => $id_forma_valorada ]);
	}

	public function editarInspeccion($id){
    	$inspeccion = Inspeccion::find($id);
    	return $inspeccion;
    }

    public function update(Request $request){
		// Se reciben la id de la inspección y se selecciona para modificarla
		$id = $request->input('id');
		$inspeccion = Inspeccion::find($id);

		// Se le da formato a la fecha de vencimiento
		/*
		$fechavence = $request->input('fechavence');
		$date = strtotime($fechavence);
		$fecha_format = date("Y-m-d", $date);
		*/

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'inspector' => 'required|string',
			'gestor' => 'required|string',
			'tipoinspeccion' => 'required|string',
			'ejerciciofiscal' => 'required|string',
			'colonia' => 'required|string',
			'local' => 'required|string',
			'domicilio' => 'required|string|max:75',
			'encargado' => 'required|string|max:50',
            'puestoencargado' => 'required|string|max:30',
            'diasvence' => 'required|string'
		]);
		// 'fechavence' => 'required|date_format:Y-m-d'

		// Se reciben los datos del formulario y se crean variables
		$inspector = $request->input('inspector');
		$gestor = $request->input('gestor');
		$tipoinspeccion = $request->input('tipoinspeccion');
		$ejerciciofiscal = $request->input('ejerciciofiscal');
		$colonia = $request->input('colonia');
		$local = $request->input('local');
		$domicilio = $request->input('domicilio');
		$encargado = $request->input('encargado');
		$puestoencargado = $request->input('puestoencargado');
		$diasvence = $request->input('diasvence');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$inspeccion->inspector_id = $inspector;
		$inspeccion->gestores_id = $gestor;
		$inspeccion->tipoinspeccion_id = $tipoinspeccion;
		$inspeccion->ejerciciofiscal_id = $ejerciciofiscal;
		$inspeccion->colonia_id = $colonia;
		$inspeccion->nombrelocal = $local;
		$inspeccion->domicilio = $domicilio;
		$inspeccion->nombreencargado = $encargado;
		$inspeccion->cargoencargado = $puestoencargado;
		$inspeccion->diasvence = $diasvence;
		$inspeccion->update();

        // Indica que fue correcta la modificación de la inspección
    	return $inspeccion;

	}

	public function updateEstatus(Request $request){

		$id = $request->input('id');
		$inspeccion = Inspeccion::find($id);

		$validate = $this->validate($request,[
			'estatusinspeccion' => 'required|string|max:1'
		]);

		$idUser = \Auth::user()->id;
		$estatus = $request->input('estatusinspeccion');

		$inspeccion->estatusinspeccion_id = $estatus;
		$inspeccion->usuario_id = $idUser;
		$inspeccion->update();

    	return $inspeccion;
	}

	public function verMasInformacion($id){
		$inspeccion = Inspeccion::find($id);
		$gestores = Gestor::all();
		return view('inspeccion.informacion-completa', [
			'inspeccion' => $inspeccion,
			'gestores' => $gestores
		]);
	}

	public function asignarInspecciones(Request $request){
		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
			'ejerciciofiscal-asignar' => 'required|string',
			'tipoinspeccion-asignar' => 'required|string',
            'cantidad-asignar' => 'required|string',
            'inspectores-asignar.*' => 'required|string',
        ]);

		$data = $request->all();
    	$ejerciciofiscal = $request->input('ejerciciofiscal-asignar');
    	$tipoinspeccion = $request->input('tipoinspeccion-asignar');
    	$cantidad = $request->input('cantidad-asignar');
		$inspectores = array_get($data, 'inspectores-asignar');

		$hoy = new \DateTime();
		$hoy->format('d-m-Y H:i:s');
		$estatus_anterior = EstatusInspeccion::where('clave', 'NA')->first();
    	$id_estatus_anterior = $estatus_anterior->id;
		$estatus_nuevo = EstatusInspeccion::where('clave', 'A')->first();
    	$id_estatus_nuevo = $estatus_nuevo->id;

		$inspecciones = Inspeccion::where('estatusinspeccion_id', $id_estatus_anterior)
									->where('tipoinspeccion_id', $tipoinspeccion)->get();
		$tipos_inspecciones = TipoDeInspeccion::find($tipoinspeccion);

		if ($inspectores == null) {
			return back()->withErrors('Es necesario seleccionar al menos a un Inspector.');
		} 
		$total_inspectores = count($inspectores);
		$total_inspecciones = $cantidad * $total_inspectores;
		$numero_inspecciones = count($inspecciones);

		if ($numero_inspecciones >= $total_inspecciones) {
			for ($i = 0; $i < $total_inspectores; $i++) {
	    		for ($a = 0; $a < $cantidad; $a++) {
	    			for ($b = 0; $b < $numero_inspecciones; $b++) {
						if ($inspecciones[$b]->tipoinspeccion_id == $tipos_inspecciones->id && $inspecciones[$b]->estatusinspeccion_id == $id_estatus_anterior) {
							$inspecciones[$b]->inspector_id = $inspectores[$i];
							$inspecciones[$b]->estatusinspeccion_id = $id_estatus_nuevo;
							$inspecciones[$b]->fechaasignada = $hoy;
							$inspecciones[$b]->update();
							break;
						}
	    			}
	    		}
			}
			return redirect('inspecciones/asignar')->with('status', 'Se ha asignado correctamente');
		} else {
			return redirect('inspecciones/asignar')->with('error', 'Asigna Más Inspecciones');
		}
	}

	public function obtenerTotalInspecciones($id, $anio){
		$total_inspecciones = Inspeccion::where('tipoinspeccion_id', $id)
										->where('ejerciciofiscal_id', $anio)
										->where('estatusinspeccion_id', 1)
										->get();
		return count($total_inspecciones);
	}

	public function obtenerFolios(Request $request){
		$validate = $this->validate($request, [
			'tipoinspeccion' => 'required|string',
			'cantidad' => 'required|string',
			'ejerciciofiscal' => 'required|string'
        ]);

        $tipo_inspeccion_id = $request->input('tipoinspeccion');
    	$cantidad = $request->input('cantidad');
    	$ejercicio_fiscal_id = $request->input('ejerciciofiscal');
		$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();

		if ($forma_valorada->count() == 0) {
			$folio_inicio = 1;
			$folio_fin = $folio_inicio + $cantidad -1;

			$ejercicio_fiscal = EjercicioFiscal::find($ejercicio_fiscal_id);
			$ejercicio_fiscal_anio = $ejercicio_fiscal->anio;

			$tipo_inspeccion = TipoDeInspeccion::find($tipo_inspeccion_id);
			$tipo_inspeccion_clave = $tipo_inspeccion->clave;

			$inicio_folio = $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio_inicio;
			$fin_folio = $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio_fin;

			return [
				'folioinicio' => $inicio_folio,
				'foliofin' => $fin_folio
			];

		} else {
			$folio_inicio = $forma_valorada->last()->foliofin + 1;
			$folio_fin = $folio_inicio + $cantidad - 1;

			$ejercicio_fiscal = EjercicioFiscal::find($ejercicio_fiscal_id);
			$ejercicio_fiscal_anio = $ejercicio_fiscal->anio;

			$tipo_inspeccion = TipoDeInspeccion::find($tipo_inspeccion_id);
			$tipo_inspeccion_clave = $tipo_inspeccion->clave;

			$inicio_folio = $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio_inicio;
			$fin_folio = $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio_fin;

			return [
				'folioinicio' => $inicio_folio,
				'foliofin' => $fin_folio
			];
		}
	}

	public function obtenerFoliosInspecciones(Request $request){

		$validate = $this->validate($request, [
			'tipoinspeccion-asignar' => 'required|string',
			'cantidad-asignar' => 'required|string',
			'ejerciciofiscal-asignar' => 'required|string',
			'inspectores-asignar.*' => 'required|string'
        ]);



        $data = $request->all();
        $tipo_inspeccion_id = $request->input('tipoinspeccion-asignar');
    	$cantidad = $request->input('cantidad-asignar');
    	$ejercicio_fiscal_id = $request->input('ejerciciofiscal-asignar');
    	$inspectores = array_get($data, 'inspectores-asignar');

    	$inspecciones = Inspeccion::where('estatusinspeccion_id', 1)
    						->where('ejerciciofiscal_id', $ejercicio_fiscal_id)
							->where('tipoinspeccion_id', $tipo_inspeccion_id)
							->get();
		
		$datos = [];
		$inspectores_array = [];

		if ($inspectores == null) {
			return response()->json([
				'error' => true,
				'mensaje' => 'Es necesario seleccionar a un Inspector'
			], 422);
		} 

		$total_inspectores = count($inspectores);
		$total_inspecciones = count($inspecciones);

		if ($cantidad > $total_inspecciones) {
			return response()->json([
				'error' => true,
				'mensaje' => 'No cuentas con la cantidas suficiente de Inspecciones para asignar. Favor de agregar mas inspecciones.'
			], 422);
		} else {
			if ($total_inspectores == 1) {
				$datos = [
					$total_inspectores => [
						'folioinicio' => $inspecciones[0]->folio,
						'foliofin' => $inspecciones[$cantidad-1]->folio,
						'inspector' => $inspectores
					]
				];

				return $datos;
			} else {
				if ($cantidad*$total_inspectores > $total_inspecciones) {
					return response()->json([
						'error' => true,
						'mensaje' => 'No cuentas con la cantidas suficiente de Inspecciones para asignar. Favor de agregar mas inspecciones.'
					], 422);
				} else {
					for ($i = 0; $i < $total_inspectores; $i++) {
						$cantidad_final = $cantidad * ($i + 1);
						if ($i == 0) {
							$inspectores_array['folioinicio'] = $inspecciones[0]->folio;
							$inspectores_array['foliofin'] =  $inspecciones[$cantidad-1]->folio;
							$inspectores_array['inspector'] = $inspectores[$i];
							$datos[$inspectores[$i]] = $inspectores_array;
						} else {
							$inspectores_array['folioinicio'] = $inspecciones[$cantidad_final-$cantidad]->folio;
							$inspectores_array['foliofin'] =  $inspecciones[$cantidad_final-1]->folio;
							$inspectores_array['inspector'] = $inspectores[$i];
							$datos[$inspectores[$i]] = $inspectores_array;
						}
					}
				}
			}
		}
		return $datos;
	}

}
