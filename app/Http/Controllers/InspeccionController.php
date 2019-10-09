<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
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
use App\Encargado;
use App\Comercio;
use App\DocumentacionRequerida;
use App\DocumentacionPorTipoDeInspeccion;
use App\DocumentacionPorInspeccion;
use App\Configuracion;
use App\BitacoraDeEstatus;

class InspeccionController extends Controller
{
	public function vistaAgregarInspeccion(){
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		$encargadosGob = Encargado::all();
		return view('inspeccion.agregar-inspeccion', [
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales,
			'encargadosGob' => $encargadosGob
		]);
	}

	public function vistaAgregarInspeccionPorZona(){
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		$encargadosGob = Encargado::all();
		$colonias = Colonia::all();
		return view('inspeccion.agregar-inspeccion-por-zona', [
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales,
			'colonias' => $colonias,
			'encargadosGob' => $encargadosGob
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
		$inspecciones = Inspeccion::all()->load('tipoInspeccion')->load('estatusInspeccion')->load('inspector')->load('comercio');
        return Datatables::of($inspecciones)
            ->addColumn('cambiarestatus', 'inspeccion/boton-estatus')
			->rawColumns(['cambiarestatus'])
			->make(true);
	}

	public function create(Request $request){
		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
			'cantidad' => 'required|string',
			'ejerciciofiscal' => 'required|string',
			'tipoinspeccion' => 'required|string',
			'encargadoGob' => 'required'
		]);

		$cantidad = $request->input('cantidad');
		$ejercicio_fiscal_id = $request->input('ejerciciofiscal');
		$tipo_inspeccion_id = $request->input('tipoinspeccion');
		$encargado_gob_id = $request->input('encargadoGob');
		$usuario = Auth::user();
		
		$estatus_inspeccion = EstatusInspeccion::where('clave', 'NA')->first();
		$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();
		$documentacion_por_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();

		$ejercicio_fiscal = EjercicioFiscal::find($ejercicio_fiscal_id);
		$ejercicio_fiscal_anio = $ejercicio_fiscal->anio;

		$tipo_inspeccion = TipoDeInspeccion::find($tipo_inspeccion_id);
		$tipo_inspeccion_clave = $tipo_inspeccion->clave;

		if ($forma_valorada->count() == 0) {

			$nueva_forma_valorada = new FormaValorada();
			$nueva_forma_valorada->usuario_id 			= $usuario->id;
			$nueva_forma_valorada->tipoinspeccion_id 	= $tipo_inspeccion_id;
			$nueva_forma_valorada->ejerciciofiscal_id 	= $ejercicio_fiscal_id;
			$nueva_forma_valorada->encargado_id 		= $encargado_gob_id;
			$nueva_forma_valorada->folioinicio 			= 1;
			$nueva_forma_valorada->foliofin 			= $cantidad;
			$nueva_forma_valorada->save();
			
		} else {

			$folio_fin = $forma_valorada->last()->foliofin;
			$nuevo_folio_inicio = $folio_fin + 1;
			$nuevo_folio_fin = $folio_fin + $cantidad;

			$nueva_forma_valorada = new FormaValorada();
			$nueva_forma_valorada->usuario_id 			= $usuario->id;
			$nueva_forma_valorada->tipoinspeccion_id 	= $tipo_inspeccion_id;
			$nueva_forma_valorada->ejerciciofiscal_id 	= $ejercicio_fiscal_id;
			$nueva_forma_valorada->encargado_id 		= $encargado_gob_id;
			$nueva_forma_valorada->folioinicio 			= $nuevo_folio_inicio;
			$nueva_forma_valorada->foliofin 			= $nuevo_folio_fin;
			$nueva_forma_valorada->save();

		}

		for ($a = 0; $a < $cantidad; $a++) {

			$id_forma_valorada = $nueva_forma_valorada->id;
			$folio_inicio = $nueva_forma_valorada->folioinicio;
			$folio = $folio_inicio + $a;

			$inspeccion = new Inspeccion();
			$inspeccion->formavalorada_id 		= $id_forma_valorada;
			$inspeccion->tipoinspeccion_id 		= $tipo_inspeccion_id;
			$inspeccion->usuario_id 			= $usuario->id;
			$inspeccion->ejerciciofiscal_id 	= $ejercicio_fiscal_id;
			$inspeccion->estatusinspeccion_id 	= $estatus_inspeccion->id;
			$inspeccion->folio 					= $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio;
			$inspeccion->save();

			$estatusinspeccion_id = $inspeccion->estatusInspeccion->id;
			$datos_bitacora = [
				'inspeccion_id' => $inspeccion->id,
				'estatusinspeccion_id' => $estatusinspeccion_id,
				'usuario_id' => $usuario->id,
				'observacion' => 'Creada'
			];

			BitacoraDeEstatus::create($datos_bitacora);

			for ($b = 0; $b < count($documentacion_por_inspeccion); $b++) {

				$datos = [
					'tipoinspeccion_id' => $tipo_inspeccion_id,
					'documentacionrequerida_id' => $documentacion_por_inspeccion[$b]->documentacionrequerida_id,
					'inspeccion_id' => $inspeccion->id,
					'solicitado' => 0,
					'exhibido' => 0
				];

				DocumentacionPorInspeccion::create($datos);
			}

		}

		return redirect('inspecciones/agregar')->with('status', 'Las inspecciones se han creado correctamente.');
	}

	public function crearInspeccionesPorSM(Request $request){
		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
			'comercio.*' => 'required|string',
			'ejerciciofiscal' => 'required|string',
			'tipoinspeccion' => 'required|string',
			'encargadoGob' => 'required'
		]);

		$data = $request->all();
		$comercios = array_get($data, 'comercio');
		$cantidad = count($comercios);
		$ejercicio_fiscal_id = $request->input('ejerciciofiscal');
		$tipo_inspeccion_id = $request->input('tipoinspeccion');
		$encargado_gob_id = $request->input('encargadoGob');
		$usuario = Auth::user();
		
		$estatus_inspeccion = EstatusInspeccion::where('clave', 'NA')->first();
		$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();
		$documentacion_por_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();

		$ejercicio_fiscal = EjercicioFiscal::find($ejercicio_fiscal_id);
		$ejercicio_fiscal_anio = $ejercicio_fiscal->anio;

		$tipo_inspeccion = TipoDeInspeccion::find($tipo_inspeccion_id);
		$tipo_inspeccion_clave = $tipo_inspeccion->clave;
		
		if ($forma_valorada->count() == 0) {

			$nueva_forma_valorada = new FormaValorada();
			$nueva_forma_valorada->usuario_id 			= $usuario->id;
			$nueva_forma_valorada->tipoinspeccion_id 	= $tipo_inspeccion_id;
			$nueva_forma_valorada->ejerciciofiscal_id 	= $ejercicio_fiscal_id;
			$nueva_forma_valorada->encargado_id 		= $encargado_gob_id;
			$nueva_forma_valorada->folioinicio 			= 1;
			$nueva_forma_valorada->foliofin 			= $cantidad;
			$nueva_forma_valorada->save();

		} else {

			$folio_fin = $forma_valorada->last()->foliofin;
			$nuevo_folio_inicio = $folio_fin + 1;
			$nuevo_folio_fin = $folio_fin + $cantidad;

			$nueva_forma_valorada = new FormaValorada();
			$nueva_forma_valorada->usuario_id 			= $usuario->id;
			$nueva_forma_valorada->tipoinspeccion_id 	= $tipo_inspeccion_id;
			$nueva_forma_valorada->ejerciciofiscal_id 	= $ejercicio_fiscal_id;
			$nueva_forma_valorada->encargado_id 		= $encargado_gob_id;
			$nueva_forma_valorada->folioinicio 			= $nuevo_folio_inicio;
			$nueva_forma_valorada->foliofin 			= $nuevo_folio_fin;
			$nueva_forma_valorada->save();

		}

		for ($a = 0; $a < $cantidad; $a++) {

			$datos_comercio = Comercio::find($comercios[$a]);
			$id_forma_valorada = $nueva_forma_valorada->id;

			$folio_inicio = $nueva_forma_valorada->folioinicio;
			$folio = $folio_inicio + $a;

			$inspeccion = new Inspeccion();
			$inspeccion->formavalorada_id 		= $id_forma_valorada;
			$inspeccion->comercio_id 			= $datos_comercio->id;
			$inspeccion->tipoinspeccion_id 		= $tipo_inspeccion_id;
			$inspeccion->usuario_id 			= $usuario->id;
			$inspeccion->ejerciciofiscal_id 	= $ejercicio_fiscal_id;
			$inspeccion->estatusinspeccion_id 	= $estatus_inspeccion->id;
			$inspeccion->folio 					= $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio;
			$inspeccion->save();
			
			$estatusinspeccion_id = $inspeccion->estatusInspeccion->id;
			$datos_bitacora = [
				'inspeccion_id' => $inspeccion->id,
				'estatusinspeccion_id' => $estatusinspeccion_id,
				'usuario_id' => $usuario->id,
				'observacion' => 'Creada'
			];

			BitacoraDeEstatus::create($datos_bitacora);

			for ($b = 0; $b < count($documentacion_por_inspeccion) ; $b++) {

				$datos = [
					'tipoinspeccion_id' => $tipo_inspeccion_id,
					'documentacionrequerida_id' => $documentacion_por_inspeccion[$b]->documentacionrequerida_id,
					'inspeccion_id' => $inspeccion->id,
					'solicitado' => 0,
					'exhibido' => 0
				];

				DocumentacionPorInspeccion::create($datos);
			}
		}

		return redirect('inspecciones/agregar-por-zonas')->with('status', 'Las inspecciones se han creado correctamente.');
	}

	public function editarInspeccion($id){
		$inspeccion = Inspeccion::find($id);
		/*
		$ultimo_estatus = BitacoraDeEstatus::where('inspeccion_id', $id)->get();
		$ultimo_estatus = $ultimo_estatus->last()->observacion;

		if (!empty($inspeccion) && !empty($ultimo_estatus)) {
			$data = [
				'status' => 200,
				'inspeccion' => $inspeccion,
				'ultimoEstatus' => $ultimo_estatus
			];
		} else {
			$data = [
				'status' => 500,
				'error' => 'No se pudieron cargar los datos'
			];
		}
		*/
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
		$inspeccion_id = $inspeccion->id;

		$validate = $this->validate($request,[
			'estatusinspeccion' => 'required|string|max:1',
			'comentario' => 'string|max:255'
		]);

		$idUser = \Auth::user()->id;
		$estatus = $request->input('estatusinspeccion');
		$comentario = $request->input('comentario');

		$inspeccion->usuario_id = $idUser;
		$inspeccion->estatusinspeccion_id = $estatus;
		$inspeccion->comentario = $comentario;
		$inspeccion->update();

		$datos_bitacora = [
			'inspeccion_id' => $inspeccion_id,
			'estatusinspeccion_id' => $estatus,
			'usuario_id' => $idUser,
			'observacion' => $comentario
		];
		
		BitacoraDeEstatus::create($datos_bitacora);

		return $inspeccion;
	}

	public function updateInspector(Request $request){

		$id = $request->input('id');
		$inspeccion = Inspeccion::find($id);

		$validate = $this->validate($request,[
			'inspector' => 'required|string'
		]);

		$idUser = \Auth::user()->id;
		$inspector_id = $request->input('inspector');

		$inspector = Inspector::find($inspector_id);

		$inspeccion->usuario_id = $idUser;
		$inspeccion->inspector_id = $inspector_id;
		$inspeccion->update();

		return [$inspector, $inspeccion];
	}

	public function verMasInformacion($id){

		$inspeccion = Inspeccion::find($id);
		$gestores = Gestor::all();
		$documentos = DocumentacionPorInspeccion::where('inspeccion_id', $id)->get();
		$comercios = Comercio::all();
		$inspectores = Inspector::all();
		$is_edit = false;

		if ($inspeccion->estatusInspeccion->clave == 'NA') {
			return 'Debes asiganar la inspección antes de capturar los datos';
		}else{
			if ($inspeccion->fecharealizada == null && $inspeccion->horarealizada == null) {
				return view('inspeccion.informacion-completa', [
					'inspeccion' => $inspeccion,
					'gestores' => $gestores,
					'documentos' => $documentos,
					'comercios' => $comercios,
					'inspectores' => $inspectores,
					'is_edit' => $is_edit
				]);
			}else{
				$is_edit = true;
				return view('inspeccion.informacion-completa', [
					'inspeccion' => $inspeccion,
					'gestores' => $gestores,
					'documentos' => $documentos,
					'comercios' => $comercios,
					'inspectores' => $inspectores,
					'is_edit' => $is_edit
				]);
			}
		}
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

		$idUser = \Auth::user()->id;
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

							$datos_bitacora = [
								'inspeccion_id' => $inspecciones[$b]->id,
								'estatusinspeccion_id' => $inspecciones[$b]->estatusInspeccion->id,
								'usuario_id' => $idUser,
								'observacion' => 'Asignada'
							];

							BitacoraDeEstatus::create($datos_bitacora);
							break;
						}
					}
				}
			}
			return redirect('inspecciones/asignar')->with('status', 'Las inspecciones se han asignado correctamente.');
		} else {
			return redirect('inspecciones/asignar')->with('error', 'No se cuenta con la cantidad de inspecciones necesarias.');
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

		if ($cantidad  == 0) {
			return response()->json([
				'error' => true,
				'mensaje' => 'Selecciona al menos una empresa.'
			], 422);
		} else {
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

	public function actualizarInformacionInspeccion(Request $request){

		$inspeccion_id = $request->input('inspeccion-id');
		$inspeccion = Inspeccion::find($inspeccion_id);
		$configuracion = Configuracion::where('id', 1)->first();
		$configuracion_dias_vence = $configuracion->valornumero;

		$texto_presento = Configuracion::where('id', 2)->first();
		$texto_no_presento = Configuracion::where('id', 3)->first();

		$estatus_nuevo = EstatusInspeccion::where('clave', 'Cap')->first();
		$id_estatus_nuevo = $estatus_nuevo->id;
		$idUser = \Auth::user()->id;

		$validate = $this->validate($request, [
			'inspeccion-id' => 'required|string',
			'establecimiento' => 'required|string',
			'encargado' => 'string',
			'cargo' => 'nullable',
			'identificacion' => 'nullable',
			'folioidentificacion' => 'nullable',
			'fecha' => 'required|date_format:Y-m-d',
			'hora' => 'required|date_format:H:i',
			'solicitado.*' => 'nullable',
			'exhibido.*' => 'nullable',
			'observaciones.*' => 'string|nullable',
			'observacion' => 'string|nullable',
			'gestor' => 'string|nullable',
			'prorroga' => 'string|nullable',
			'observacion-prorroga' => 'string|nullable'
		]);

		$hoy = new \DateTime();
		$hoy->format('d-m-Y H:i:s');

		$data = $request->all();
		$encargado = $request->input('encargado');
		$establecimiento = $request->input('establecimiento');
		$cargo = $request->input('cargo');
		$identificacion = $request->input('identificacion');
		$folioidentificacion = $request->input('folioidentificacion');
		$fecha = $request->input('fecha');
		$hora = $request->input('hora');
		$solicitado = array_get($data, 'solicitado');
		$exhibido = array_get($data, 'exhibido');
		$observaciones = array_get($data, 'observaciones');
		$observacion = $request->input('observacion');
		$gestor = $request->input('gestor');
		$dias_prorroga = $request->input('prorroga');
		$observacion_prorroga = $request->input('observacion-prorroga');
		$fecha_vence = date("Y-m-d",strtotime($fecha . "+" . $configuracion_dias_vence . "days"));

		$inspeccion->fechacapturada = $hoy;
		$inspeccion->nombreencargado = $encargado;
		$inspeccion->comercio_id = $establecimiento;
		$inspeccion->cargoencargado = $cargo;
		$inspeccion->identificacion = $identificacion;
		$inspeccion->folioidentificacion = $folioidentificacion;
		$inspeccion->fecharealizada = $fecha;
		$inspeccion->horarealizada = $hora;
		$inspeccion->comentario = $observacion;
		$inspeccion->gestores_id = $gestor;
		$inspeccion->diasvence = $configuracion_dias_vence;
		$inspeccion->fechavence = $fecha_vence;

		if ($dias_prorroga != 0) {
			$fecha_prorroga = date("Y-m-d",strtotime($fecha_vence . "+" . $dias_prorroga . "days"));
			$inspeccion->fechaprorroga = $fecha_prorroga;
		}
		$inspeccion->observacionprorroga = $observacion_prorroga;
		$inspeccion->estatusinspeccion_id = $id_estatus_nuevo;
		$inspeccion->update();

		$datos_bitacora = [
			'inspeccion_id' => $inspeccion->id,
			'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
			'usuario_id' => $idUser,
			'observacion' => 'Capturada'
		];

		BitacoraDeEstatus::create($datos_bitacora);


		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $inspeccion->tipoInspeccion->id)->get();

		if ($solicitado == null) {
			return back()->withErrors('Selecciona al menos un documento solicitado.');
		} else {
			for ($i = 0; $i < count($solicitado); $i++) {
				for ($a = 0; $a < count($documentos_requeridos) ; $a++) {

					if (($i+1) == count($solicitado)) {
						if ($solicitado[$i] == $documentos_requeridos[$a]->documentacionrequerida_id) {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $solicitado[$i])
																				->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->solicitado = 1;
							$documentacion_requerida->update();
						} else {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $documentos_requeridos[$a]->documentacionrequerida_id)->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->solicitado = 0;
							$documentacion_requerida->update();
						}
					} else {
						if ($solicitado[$i] == $documentos_requeridos[$a]->documentacionrequerida_id) {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $solicitado[$i])
																				->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->solicitado = 1;				
							$documentacion_requerida->update();
							$i++;
						} else {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $documentos_requeridos[$a]->documentacionrequerida_id)->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->solicitado = 0;
							$documentacion_requerida->update();
						}
						
					}	
				}
			}
		}

		if ($exhibido == null) {
			return back()->withErrors('Selecciona al menos un documento exhibido');
		} else {
			for ($b = 0; $b < count($exhibido); $b++) {
				for ($c = 0; $c < count($documentos_requeridos); $c++) {

					if (($b+1) == count($exhibido)) { // if del ultimo
						if ($exhibido[$b] == $documentos_requeridos[$c]->documentacionrequerida_id) {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $exhibido[$b])
																				->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->exhibido = 1;
							$documentacion_requerida->update();
						} else {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $documentos_requeridos[$c]->documentacionrequerida_id)->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->exhibido = 0;
							$documentacion_requerida->update();
						}
					} else { 
						if ($exhibido[$b] == $documentos_requeridos[$c]->documentacionrequerida_id) {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $exhibido[$b])
																				->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->exhibido = 1;
							$documentacion_requerida->update();
							$b++;
						} else {
							$documentacion_requerida = DocumentacionPorInspeccion::where('documentacionrequerida_id', $documentos_requeridos[$c]->documentacionrequerida_id)->where('inspeccion_id', $inspeccion_id)->first();
							$documentacion_requerida->exhibido = 0;
							$documentacion_requerida->update();
						}
						
					}	
				}
			}
		}

		$documentacion_requerida = DocumentacionPorInspeccion::where('inspeccion_id', $inspeccion_id)->get();
		
		for ($e = 0; $e < count($observaciones); $e++) { 
			if ($observaciones[$e] == null) {
				if ($documentacion_requerida[$e]->exhibido == 0) {
					$documentacion_requerida[$e]->observaciones = $texto_no_presento->valortexto;
					$documentacion_requerida[$e]->update();
				} else {
					$documentacion_requerida[$e]->observaciones = $texto_presento->valortexto;
					$documentacion_requerida[$e]->update();
				}
			} else {
				if ($documentacion_requerida[$e]->exhibido == 0 && $observaciones[$e] == $texto_presento->valortexto) {
					$documentacion_requerida[$e]->observaciones = $texto_no_presento->valortexto;
					$documentacion_requerida[$e]->update();
				} elseif ($documentacion_requerida[$e]->exhibido == 1 && $observaciones[$e] == $texto_no_presento->valortexto) {
					$documentacion_requerida[$e]->observaciones = $texto_presento->valortexto;
					$documentacion_requerida[$e]->update();
				} else {
					$documentacion_requerida[$e]->observaciones = $observaciones[$e];
					$documentacion_requerida[$e]->update();
				}
			}
		}

		return redirect('/inspecciones/informacion/'.$inspeccion_id)->with('status', 'Se ha capturado la informacion correctamente.');
	}

	public function limpiarInspeccion($id){
		
		$inspeccion = Inspeccion::find($id);
		$documentacion_por_inspeccion = DocumentacionPorInspeccion::where('inspeccion_id', $id)->get();

		$estatus_inspeccion = EstatusInspeccion::where('clave', 'A')->first();

		//$inspeccion->formavalorada_id = null;
		$inspeccion->comercio_id = null;
		//$inspeccion->tipoinspeccion_id = null;
		//$inspeccion->usuario_id = null;
		$inspeccion->gestores_id = null; 
		//$inspeccion->ejerciciofiscal_id = null;
		//$inspeccion->inspector_id = null;
		$inspeccion->estatusinspeccion_id = $estatus_inspeccion->id;
		//$inspeccion->fechaasignada = null;
		$inspeccion->fechacapturada	 = null;
		$inspeccion->fechaprorroga = null;
		$inspeccion->observacionprorroga = null;
		$inspeccion->fecharealizada = null;
		$inspeccion->horarealizada = null;
		$inspeccion->comentario = null;
		$inspeccion->nombreencargado = null;
		$inspeccion->cargoencargado = null;
		$inspeccion->identificacion = null;
		$inspeccion->folioidentificacion = null;
		$inspeccion->diasvence = null;
		$inspeccion->fechavence = null;
		$inspeccion->update();

		for ($i = 0; $i < count($documentacion_por_inspeccion); $i++) {

			$documento_por_inspeccion = DocumentacionPorInspeccion::where('inspeccion_id', $id)
																			->where('solicitado', 1)
																			->where('exhibido', 1)
																			->first();

			if ($documento_por_inspeccion == null) {
				break;
			}

			$documento_por_inspeccion->solicitado = 0;
			$documento_por_inspeccion->exhibido = 0;
			$documento_por_inspeccion->update();

			
		}

		return redirect('/inspecciones/informacion/'.$id)->with('status', 'La inspeccción se ha limpiado correctamente.');
	}


	public function validarFolioAsignado($id){

		$inspeccion = Inspeccion::find($id);
		$estatus_inspeccion = $inspeccion->estatusinspeccion->clave;

		$asignado_t = 'true';
		$asignado_f = 'false';
		
		if ($estatus_inspeccion != 'NA') {
			return $asignado_t;
		} else {
			return $asignado_f;
		}
	}

	

}
