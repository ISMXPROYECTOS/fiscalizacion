<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Carbon\Carbon;
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
use App\DiaInhabil;
use App\DocumentacionRequerida;
use App\DocumentacionPorTipoDeInspeccion;
use App\DocumentacionPorInspeccion;
use App\Configuracion;
use App\BitacoraDeEstatus;
use App\BitacoraDeProroga;
use App\Multa;

class InspeccionController extends Controller
{
	/* Muetra la vista para crear nuevas inspecciones blancas, es decir, que no tienen comercio asignado */
	public function vistaAgregarInspeccion(){
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		$encargadosGob = Encargado::get(['id', 'nombre', 'apellidopaterno', 'apellidomaterno', 'activo']);
		return view('inspeccion.agregar-inspeccion', [
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales,
			'encargadosGob' => $encargadosGob
		]);
	}

	/* Muetra la vista para crear nuevas inspecciones por supermanzana, es decir, que ya tienen asignado un comercio */
	public function vistaAgregarInspeccionPorZona(){
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		$encargadosGob = Encargado::get(['id', 'nombre', 'apellidopaterno', 'apellidomaterno', 'activo']);
		$giros = GiroComercial::where('activo', 1)->orderBy('nombre', 'ASC')->get(['id', 'nombre']);

		return view('inspeccion.agregar-inspeccion-por-zona', [
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales,
			'encargadosGob' => $encargadosGob,
			'giros' => $giros
		]);
	}

	/* Muestra la vista donde se realiza la asignación del inspector a las inspecciones */
	public function vistaAsignarInspeccion(){
		$inspectores = Inspector::get(['id', 'nombre', 'apellidopaterno', 'apellidomaterno', 'estatus']);
		$tiposInspecciones = TipoDeInspeccion::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		return view('inspeccion.asignar-inspeccion', [
			'inspectores' => $inspectores,
			'tiposInspecciones' => $tiposInspecciones,
			'ejerciciosFiscales' => $ejerciciosFiscales
		]);
	}

	/* Muetra la vista del listado de las inspecciones */
	public function listadoInspecciones(){
		//$inspecciones = Inspeccion::all();
		//$inspectores = Inspector::all();
		//$gestores = Gestor::all();
		//$tiposInspecciones = TipoDeInspeccion::all();
		//$ejerciciosFiscales = EjercicioFiscal::all();
		$estatusInspecciones = EstatusInspeccion::get(['id', 'clave', 'nombre']);
		//$colonias = Colonia::all();
		$inspectores = Inspector::where('estatus', 'A')->orWhere('estatus', 'V')->get(['id', 'nombre', 'apellidopaterno', 'apellidomaterno']);
		return view('inspeccion.listado-inspecciones', [
			//'inspecciones' => $inspecciones,
			//'inspectores' => $inspectores,
			//'gestores' => $gestores,
			//'tiposInspecciones' => $tiposInspecciones,
			//'ejerciciosFiscales' => $ejerciciosFiscales,
			'estatusInspecciones' => $estatusInspecciones,
			//'colonias' => $colonias,
			'inspectores' => $inspectores
		]);
	}

	/* Método encargado de ir a la base de datos seleccionar la información solicitada y devolverla a la petición para ser mostrada */
	public function tbody(){
		//$inspecciones = Inspeccion::all()->load('tipoInspeccion')->load('estatusInspeccion')->load('inspector')->load('comercio');
		$collection = new Collection();
		
		$inspecciones = Inspeccion::with([
			'tipoInspeccion' => function($query){
				$query->select(['id', 'clave']);
			}
		])->with([
			'estatusInspeccion' => function($query){
				$query->select(['id', 'clave', 'nombre']);
			}
		])->with([
			'inspector' => function($query){
				$query->select(['id', 'nombre', 'apellidopaterno', 'apellidomaterno']);
			}
		])->with([
			'comercio' => function($query){
				$query->select(['id', 'denominacion', 'nombreestablecimiento']);
			}
		])->orderBy('id', 'desc')->get([
			'id',
			'comercio_id',
			'tipoinspeccion_id',
			'inspector_id',
			'estatusinspeccion_id',
			'folio',
			'created_at',
			'fechavence',
			'fechaprorroga'
		]);
		
		if($inspecciones){
			foreach($inspecciones as $inspeccion){
				if(!empty($inspeccion->fechavence)){
					$date = strtotime($inspeccion->fechavence);
					$fechavence = date("Y-m-d", $date);
				} else {
					$fechavence = '';
				}

				if(!empty($inspeccion->fechaprorroga)){
					$date_2 = strtotime($inspeccion->fechaprorroga);
					$fechaprorroga = date("Y-m-d", $date_2);
				} else {
					$fechaprorroga = '';
				}

				$hoy = new \DateTime();
				//$dia_anterior = date("Y-m-d", strtotime($inspeccion->fechavence."-1 days"));

				$tmp = [
					'id' => $inspeccion->id,
					'comercio_denominacion' => is_object($inspeccion->comercio) ? $inspeccion->comercio->denominacion : '',
					'comercio_nombre' => is_object($inspeccion->comercio) ? $inspeccion->comercio->nombreestablecimiento : '',
					'tipoinspeccion' => $inspeccion->tipoInspeccion->clave,
					'inspector' => is_object($inspeccion->inspector) ? $inspeccion->inspector->nombre.' '.$inspeccion->inspector->apellidopaterno.' '.$inspeccion->inspector->apellidomaterno : '',
					'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
					'estatusinspeccion_clave' => $inspeccion->estatusInspeccion->clave,
					'estatusinspeccion_nombre' => $inspeccion->estatusInspeccion->nombre,
					'folio' => $inspeccion->folio,
					'created_at' => $inspeccion->created_at->format('d/m/Y'),
					'fechavence' => $fechavence,
					//'dia_anterior' => $dia_anterior,
					'fechaprorroga' => $fechaprorroga,
					'hoy' => $hoy->format('Y-m-d')
				];
				
				$collection->push($tmp);
				unset($tmp);
			}
		}
		
		return DataTables::of($collection)
		->addColumn('cambiarestatus', 'inspeccion/boton-estatus')
		->addColumn('imprimir', 'inspeccion/boton-imprimir')
		->rawColumns(['cambiarestatus', 'imprimir'])
		->make(true);
	}

	/* Método que realiza la creación de las inspecciones, crea la inspección pero estas inspecciones son blancas, es decir, que no se sabe a que comercio se va a inspeccionar */
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
		$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->where('ejerciciofiscal_id', $ejercicio_fiscal_id)->get();
		$documentacion_por_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $tipo_inspeccion_id)->get(['id', 'documentacionrequerida_id']);

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
				'observacion' => 'Creada - ' . $estatus_inspeccion->nombre
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

	/* Método que realiza la creación de las inspecciones por supermanzanas, crea la inspección y al mismo tiempo asigna el local que será inspeccionado */
	public function crearInspeccionesPorSM(Request $request){
		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
			'comercio.*' => 'required|string',
			'ejerciciofiscal' => 'required|string',
			'tipoinspeccion' => 'required|string',
			'encargadoGob' => 'required',
			'calle' => 'required'
		]);

		$data = $request->all();
		$comercios = array_get($data, 'comercio');
		$cantidad = count($comercios);
		$ejercicio_fiscal_id = $request->input('ejerciciofiscal');
		$tipo_inspeccion_id = $request->input('tipoinspeccion');
		$encargado_gob_id = $request->input('encargadoGob');
		$usuario = Auth::user();
		
		$estatus_inspeccion = EstatusInspeccion::where('clave', 'NA')->first();
		$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->where('ejerciciofiscal_id', $ejercicio_fiscal_id)->get(['id', 'foliofin']);
		$documentacion_por_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $tipo_inspeccion_id)->get(['id', 'documentacionrequerida_id']);

		$ejercicio_fiscal = EjercicioFiscal::find($ejercicio_fiscal_id, ['id', 'anio']);
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
			$datos_comercio = Comercio::find($comercios[$a], ['id']);
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

			$datos_bitacora = [
				'inspeccion_id' => $inspeccion->id,
				'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
				'usuario_id' => $usuario->id,
				'observacion' => 'Creada - ' . $estatus_inspeccion->nombre
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

		return redirect('inspecciones/agregar-por-zonas')->with('status', 'Las inspecciones se han creado correctamente.');
	}

	/* Selecciona la inspección que se desea editar y regresa la inspección a la petición */
	public function editarInspeccion($id){
		$inspeccion = Inspeccion::find($id);
		return $inspeccion;
	}

	/* El método se encarga de modificar los estatus a las inspecciones, solo se pueden modificar inspecciones hacia adelante (una inspeccion capturada no puede pasar a no asignada porque seria incoherente). */
	public function updateEstatus(Request $request){
		$validate = $this->validate($request,[
			'estatusinspeccion' => 'required|string',
			'comentario' => 'string|max:255'
		]);

		$id = $request->input('id');
		$inspeccion = Inspeccion::find($id);
		$usuario = Auth::user();

		$estatus = $request->input('estatusinspeccion');
		$comentario = $request->input('comentario');

		$estatus_Nuevo = EstatusInspeccion::find($estatus);
		$estatus_S = EstatusInspeccion::where('clave', 'S')->first();
		$estatus_C = EstatusInspeccion::where('clave', 'C')->first();
		$estatus_Cap = EstatusInspeccion::where('clave', 'Cap')->first();
		$estatus_P = EstatusInspeccion::where('clave', 'P')->first();
		$estatus_Epc = EstatusInspeccion::where('clave', 'Epc')->first();
		$estatus_Claus = EstatusInspeccion::where('clave', 'Claus')->first();

		$data = [
			'code' => 400,
			'message' => 'Ups!!, algo inesperado ocurrio'
		];

		switch ($estatus_Nuevo->id) {
			case $estatus_S->id:
				if ($inspeccion->estatusinspeccion_id == $estatus_Cap->id || $inspeccion->estatusinspeccion_id == $estatus_P->id) {
					$inspeccion->usuario_id = $usuario->id;
					$inspeccion->estatusinspeccion_id = $estatus_Nuevo->id;
					$inspeccion->update();

					$data = [
						'code' 			=> 200,
						'message' 		=> 'Se actualizo correctamente el estatus',
						'inspeccion' 	=> $inspeccion
					];

					$datos_bitacora = [
						'inspeccion_id' => $inspeccion->id,
						'estatusinspeccion_id' => $estatus_Nuevo->id,
						'usuario_id' => $usuario->id,
						'observacion' => $estatus_Nuevo->nombre . ' - ' . $comentario
					];

					BitacoraDeEstatus::create($datos_bitacora);
				} else {
					$data = [
						'code' => 400,
						'message' => 'No se pudo modificar el estatus.'
					];
				}
			break;

			case $estatus_C->id:
				if ($inspeccion->estatusinspeccion_id == $estatus_Epc->id) {
					$inspeccion->usuario_id = $usuario->id;
					$inspeccion->estatusinspeccion_id = $estatus_Nuevo->id;
					$inspeccion->update();

					$data = [
						'code' 			=> 200,
						'message' 		=> 'Se actualizo correctamente el estatus',
						'inspeccion' 	=> $inspeccion
					];

					$datos_bitacora = [
						'inspeccion_id' => $inspeccion->id,
						'estatusinspeccion_id' => $estatus_Nuevo->id,
						'usuario_id' => $usuario->id,
						'observacion' => $estatus_Nuevo->nombre . ' - ' . $comentario
					];

					BitacoraDeEstatus::create($datos_bitacora);
				} else {
					$data = [
						'code' => 400,
						'message' => 'No se pudo modificar el estatus.'
					];
				}
			break;

			case $estatus_Claus->id:
				if ($inspeccion->estatusinspeccion_id == $estatus_Epc->id) {
					$inspeccion->usuario_id = $usuario->id;
					$inspeccion->estatusinspeccion_id = $estatus_Nuevo->id;
					$inspeccion->update();

					$data = [
						'code' 			=> 200,
						'message' 		=> 'Se actualizo correctamente el estatus',
						'inspeccion' 	=> $inspeccion
					];

					$datos_bitacora = [
						'inspeccion_id' => $inspeccion->id,
						'estatusinspeccion_id' => $estatus_Nuevo->id,
						'usuario_id' => $usuario->id,
						'observacion' => $estatus_Nuevo->nombre . ' - ' . $comentario
					];

					BitacoraDeEstatus::create($datos_bitacora);
				} else {
					$data = [
						'code' => 400,
						'message' => 'No se pudo modificar el estatus.'
					];
				}
			break;
		}

		return $data;
	}

	/* Método encargado de cambiar al inspector en una inspección */
	public function updateInspector(Request $request){
		$id = $request->input('id');
		$inspector_id = $request->input('inspector');
		$inspeccion = Inspeccion::find($id);
		$usuario = Auth::user();

		if ($inspector_id == null) {
			$estatus_NA = EstatusInspeccion::where('clave', 'NA')->first();
			$inspeccion->inspector_id = null;
			$inspeccion->estatusinspeccion_id = $estatus_NA->id;
			$inspeccion->fechaasignada = null;
			$inspeccion->update();
			$inspeccion->load('inspector');

			$datos_bitacora = [
				'inspeccion_id' => $inspeccion->id,
				'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
				'usuario_id' => $usuario->id,
				'observacion' => 'No Asignada'
			];

			BitacoraDeEstatus::create($datos_bitacora);
		}else{
			$validate = $this->validate($request,[
				'inspector' => 'required|string'
			]);

			$estatus_A = EstatusInspeccion::where('clave', 'A')->first();

			$hoy = new \DateTime();
			$hoy->format('d-m-Y H:i:s');
			
			$inspeccion->usuario_id = $usuario->id;
			$inspeccion->inspector_id = $inspector_id;
			if ($inspeccion->fechaasignada == null) {
				$inspeccion->fechaasignada = $hoy;
			}
			if ($inspeccion->inspector_id != null) {
				$inspeccion->estatusinspeccion_id = $estatus_A->id;
			}
			$inspeccion->update();
			$inspeccion->load('inspector');
		}

		return $inspeccion;
	}

	/* El método envia las variables necesarias a la vista de inspección individual, donde se guarda toda la información de cada una */
	public function verMasInformacion($id){
		$inspeccion = Inspeccion::find($id, [
			'id',
			'comercio_id',
			'gestores_id',
			'inspector_id',
			'estatusinspeccion_id',
			'fechaprorroga',
			'fecharealizada',
			'horarealizada',
			'comentario',
			'folio',
			'nombreencargado',
			'cargoencargado',
			'identificacion',
			'folioidentificacion',
			'fechavence'
		]);

		/*
		$inspeccion = Inspeccion::find($id, [
			'id',
			'comercio_id',
			'gestores_id',
			'inspector_id',
			'estatusinspeccion_id',
			'fechaprorroga',
			'fecharealizada',
			'horarealizada',
			'comentario',
			'folio',
			'nombreencargado',
			'cargoencargado',
			'identificacion',
			'folioidentificacion',
			'fechavence'
		])->load('documentacionPorInspeccion');
		*/
		
		//$inspeccion = Inspeccion::find($id)->load('documentacionPorInspeccion');
		$multas = Multa::where('inspeccion_id', $inspeccion->id)->get(['id', 'fechavence']);

		$historial_prorroga = BitacoraDeProroga::where('inspeccion_id', $id)->with([
			'usuario' => function($query){
				$query->select(['id', 'usuario']);
			}
		])->with([
			'multa' => function($query){
				$query->select(['id', 'montoMulta']);
			}
		])->get(['id', 'usuario_id', 'multa_id', 'folioMulta', 'observaciones', 'diasdeprorroga']);

		$ultima_multa = '';

		if (!empty($multas)) {
			$ultima_multa = $multas->last();
		}

		$gestores = Gestor::get(['id', 'nombre', 'apellidopaterno', 'apellidomaterno']);
		//$gestores = Gestor::all();
		$documentos = DocumentacionPorInspeccion::where('inspeccion_id', $id)->get();
		//$comercios = Comercio::all();
		$inspectores = Inspector::get(['id', 'nombre', 'apellidopaterno', 'apellidomaterno']);
		//$inspectores = Inspector::all();
		$is_edit = false;
		$total_exhibidos = 0;
		$multa = 'false';

		if (is_object($inspeccion->documentacionPorInspeccion)) {
			for ($i = 0; $i < count($inspeccion->documentacionPorInspeccion); $i++) {
				if ($inspeccion->documentacionPorInspeccion[$i]->exhibido == 1) {
					$total_exhibidos = $total_exhibidos + 1;
				}
			}

			if ($total_exhibidos != 0 && count($inspeccion->documentacionPorInspeccion) != $total_exhibidos) {
				$multa = 'true';
			}
		}

		if ($inspeccion->estatusInspeccion->clave == 'NA') {
			return 'Debes asiganar la inspección antes de capturar los datos';
		}else{
			if ($inspeccion->fecharealizada == null && $inspeccion->horarealizada == null) {
				return view('inspeccion.informacion-completa', [
					'inspeccion' => $inspeccion,
					'gestores' => $gestores,
					'documentos' => $documentos,
					//'comercios' => $comercios,
					'inspectores' => $inspectores,
					'multa' => $multa,
					'historial_prorroga' => $historial_prorroga,
					'ultima_multa' => $ultima_multa,
					'is_edit' => $is_edit
				]);
			}else{
				$is_edit = true;
				return view('inspeccion.informacion-completa', [
					'inspeccion' => $inspeccion,
					'gestores' => $gestores,
					'documentos' => $documentos,
					//'comercios' => $comercios,
					'inspectores' => $inspectores,
					'multa' => $multa,
					'historial_prorroga' => $historial_prorroga,
					'ultima_multa' => $ultima_multa,
					'is_edit' => $is_edit
				]);
			}
		}
	}

	/* Método que se encarga de realizar la asignacion de inspectores a las inspecciones masivamente, es decir, por ejemplo para 10 inspecciones asigna a un solo inspector */
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

		$inspecciones = Inspeccion::where('estatusinspeccion_id', $id_estatus_anterior)->where('tipoinspeccion_id', $tipoinspeccion)->get(['id', 'tipoinspeccion_id', 'estatusinspeccion_id', 'inspector_id', 'estatusinspeccion_id', 'fechaasignada']);
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
								'observacion' => $estatus_nuevo->nombre
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

	/* Selecciona todas las inspecciones disponibles para un tipo de inspeccion y para un año fiscal en específico */
	public function obtenerTotalInspecciones($id, $anio){
		$estatus_inspeccion = EstatusInspeccion::where('clave', 'NA')->first();
		$total_inspecciones = Inspeccion::where('tipoinspeccion_id', $id)->where('ejerciciofiscal_id', $anio)
										->where('estatusinspeccion_id', $estatus_inspeccion->id)->get();

		return count($total_inspecciones);
	}

	/* Método que realiza la el armado visual de los folios a las inspecciones */
	public function obtenerFolios(Request $request){
		$validate = $this->validate($request, [
			'tipoinspeccion' => 'required|string',
			'cantidad' => 'required|string',
			'ejerciciofiscal' => 'required|string'
		]);

		$tipo_inspeccion_id = $request->input('tipoinspeccion');
		$cantidad = $request->input('cantidad');
		$ejercicio_fiscal_id = $request->input('ejerciciofiscal');
		$forma_valorada = FormaValorada::where('tipoinspeccion_id', $tipo_inspeccion_id)->where('ejerciciofiscal_id', $ejercicio_fiscal_id)->get(['id', 'folioinicio', 'foliofin']);

		if ($cantidad == 0) {
			return response()->json([
				'error' => true,
				'mensaje' => 'Selecciona al menos una cantidad.'
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

	/* Método que realiza el armado y la asignación de los folios en las inspecciones (este método ahora si guarda en la base de datos el folio, el anterior solamente es visual) */
	public function obtenerFoliosInspecciones(Request $request){
		$validate = $this->validate($request, [
			'tipoinspeccion-asignar' => 'required|string',
			'cantidad-asignar' => 'required|string',
			'ejerciciofiscal-asignar' => 'required|string',
			'inspectores-asignar.*' => 'required|string'
		]);

		$estatus_inspeccion = EstatusInspeccion::where('clave', 'NA')->first();

		$data = $request->all();
		$tipo_inspeccion_id = $request->input('tipoinspeccion-asignar');
		$cantidad = $request->input('cantidad-asignar');
		$ejercicio_fiscal_id = $request->input('ejerciciofiscal-asignar');
		$inspectores = array_get($data, 'inspectores-asignar');

		$inspecciones = Inspeccion::where('estatusinspeccion_id', $estatus_inspeccion->id)
							->where('ejerciciofiscal_id', $ejercicio_fiscal_id)
							->where('tipoinspeccion_id', $tipo_inspeccion_id)
							->get(['id', 'folio']);
		
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

	/* El método recibe los datos del formulario de la inspección que se va a modificar y realiza los cambios en dicha inspección */
	public function actualizarInformacionInspeccion(Request $request){
		$inspeccion_id = $request->input('inspeccion-id');
		$inspeccion = Inspeccion::find($inspeccion_id);
		$configuracion = TipoDeInspeccion::find($inspeccion->tipoInspeccion->id);
		$configuracion_dias_vence = $configuracion->diasvencimiento;
		$dias_vence = $configuracion_dias_vence;

		$texto_presento = Configuracion::where('id', 2)->first();
		$texto_no_presento = Configuracion::where('id', 3)->first();

		$estatus_nuevo = EstatusInspeccion::where('clave', 'Cap')->first();
		$id_estatus_nuevo = $estatus_nuevo->id;

		$estatus_A = EstatusInspeccion::where('clave', 'A')->first();

		$estatus_V = EstatusInspeccion::where('clave', 'V')->first();
		$id_estatus_vencido = $estatus_V->id;

		$dias_inhabiles = DiaInhabil::get(['id', 'ejerciciofiscal_id', 'fecha']);
		$usuario = Auth::user();

		$validate = $this->validate($request, [
			'inspeccion-id' => 'required|string',
			'establecimiento' => 'required|string',
			'encargado' => 'nullable',
			'cargo' => 'nullable',
			'identificacion' => 'nullable',
			'folioidentificacion' => 'nullable',
			'fecha' => 'required|date_format:Y-m-d',
			'hora' => 'required|date_format:H:i',
			'solicitado.*' => 'nullable',
			'exhibido.*' => 'nullable',
			'observaciones.*' => 'string|nullable',
			'observacion' => 'string|nullable',
			'gestor' => 'string|nullable'
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

		/* Hoy pero en otro formato y sin hora */
		$fecha_realizada = new \DateTime($fecha);
		$fecha_realizada->format('Y-m-d');

		/* Días inhábiles */
		$holiday = array();

		/* Los días inhábiles de la bd se agregan al array holiday */
		for ($i = 0; $i < count($dias_inhabiles); $i++) {
			$holiday[] = date('d-m', strtotime($dias_inhabiles[$i]->fecha));
		}

		/* Fecha Inicio */
		$startDate = $fecha_realizada;

		/* Fecha Fin */
		$endDate = new \DateTime('2100-12-31');

		/* Intervalo de un día */
		$interval = new \DateInterval('P1D');

		/* Rango de fechas */
		$date_range = new \DatePeriod($startDate, $interval, $endDate);

		/* Días hábiles */
		$working_days = array();

		/* Se omiten los fin de semana y días inhábiles */
		foreach($date_range as $date){
			if ($configuracion_dias_vence != 0) {
				if($date->format("N") < 6 AND !in_array($date->format('d-m'), $holiday)){
					$working_days[] = $date->format('Y-m-d');
				}else{
					$configuracion_dias_vence = $configuracion_dias_vence + 1;
				}
				$configuracion_dias_vence = $configuracion_dias_vence - 1;
			}
		}


		$hoy = new \DateTime();
		$fecha_vence = end($working_days);

	
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
		$inspeccion->diasvence = $dias_vence;
		$inspeccion->fechavence = $fecha_vence;
		$inspeccion->usuario_id = $usuario->id;


		if ($inspeccion->estatusinspeccion_id == $estatus_A->id) {
			$inspeccion->estatusinspeccion_id = $id_estatus_nuevo;
			$inspeccion->update();

			$datos_bitacora = [
				'inspeccion_id' => $inspeccion->id,
				'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
				'usuario_id' => $usuario->id,
				'observacion' => $estatus_nuevo->nombre
			];

			BitacoraDeEstatus::create($datos_bitacora);

		} 

		$inspeccion->update();

		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $inspeccion->tipoInspeccion->id)->get(['id', 'documentacionrequerida_id']);

		if ($solicitado != null) {
			for ($i = 0; $i < count($solicitado); $i++) {
				for ($a = 0; $a < count($documentos_requeridos); $a++) {
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


		if ($exhibido != null) {
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


		$documentacion_requerida = DocumentacionPorInspeccion::where('inspeccion_id', $inspeccion_id)->get(['id', 'exhibido', 'observaciones']);
		
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

		return redirect('/inspecciones/informacion/'.$inspeccion_id)->with('status', 'La información se ha guardado correctamente.');
	}

	/* Método encargado de limpiar inspecciones, borrar toda la información que tenga y la deja en blanco lista para reutilizar. */
	public function limpiarInspeccion($id){
		$inspeccion = Inspeccion::find($id);
		$documentacion_por_inspeccion = DocumentacionPorInspeccion::where('inspeccion_id', $id)->get(['id', 'solicitado', 'exhibido', 'observaciones']);
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

		foreach ($documentacion_por_inspeccion as $documento) {
			$documento->solicitado = 0;
			$documento->exhibido = 0;
			$documento->observaciones = '';
			$documento->update();
		}

		return redirect('/inspecciones/informacion/'.$id)->with('status', 'La inspeccción se ha limpiado correctamente.');
	}

	/* Verifica si una inspeccion esta o no asignada */
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

	/* Método encargado de cambiar las inspecciones de estatus */
	public function cambiarEstatusAutomaticamente(){
		$hoy = date('Y-m-d');
		$estatus_capturada = EstatusInspeccion::where('clave', 'Cap')->first();
		$estatus_vencida = EstatusInspeccion::where('clave', 'V')->first();
		//$estatus_multa = EstatusInspeccion::where('clave', 'M')->first();
		$inspecciones = Inspeccion::where('estatusinspeccion_id', $estatus_capturada->id)->where('fechavence', '<', $hoy)->get(['id', 'estatusinspeccion_id']);
		$usuario = Auth::user();

		//$total_exhibidos = 0;

		if (!empty($inspecciones)) {
			for ($i = 0; $i < count($inspecciones); $i++) {
				$inspecciones[$i]->estatusinspeccion_id = $estatus_vencida->id;
				
				if ($inspecciones[$i]->update()) {
					$datos_bitacora = [
						'inspeccion_id' => $inspecciones[$i]->id,
						'estatusinspeccion_id' => $estatus_vencida->id,
						'usuario_id' => $usuario->id,
						'observacion' => $estatus_vencida->nombre
					];

					BitacoraDeEstatus::create($datos_bitacora);
				}
				/*
				if (is_object($inspecciones[$i]->documentacionPorInspeccion)) {
					for ($a = 0; $a < count($inspecciones[$i]->documentacionPorInspeccion); $a++) {
						if ($inspecciones[$i]->documentacionPorInspeccion[$a]->exhibido == 1) {
							$total_exhibidos = $total_exhibidos + 1;
						}
					}

					if (count($inspecciones[$i]->documentacionPorInspeccion) != $total_exhibidos) {
						$inspecciones[$i]->estatusinspeccion_id = $estatus_multa->id;
						$inspecciones[$i]->update();
					} else {
						$inspecciones[$i]->estatusinspeccion_id = $estatus_vencida->id;
						$inspecciones[$i]->update();
					}
				}
				*/
			}
		}

		return $inspecciones;
	}

	/* Método encargado de generar las prorrogas a las inspecciones, primero se debe multar la inspección porque se necesita el folio de la multa para generar una prorroga. */
	public function confirmarAgregarProrroga(Request $request){
		$validate = $this->validate($request, [
			'folio-multa' => 'required|string',
			'prorroga' => 'required|string',
			'observacion-prorroga' => 'required|string'
		]);

		$id_inspeccion = $request->input('id');
		$folio = $request->input('folio-multa');
		$dias_prorroga = $request->input('prorroga');
		$observacion_prorroga = $request->input('observacion-prorroga');
		$estatus_prorroga = EstatusInspeccion::where('clave', 'P')->first();
		$estatus_multa = EstatusInspeccion::where('clave', 'M')->first();
		$dias_inhabiles = DiaInhabil::where('activo', 1)->get(['id', 'fecha']);
		$usuario = Auth::user();

		$data = [
			'code' => 400,
			'message' => 'Ups!, ocurrio algo inesperado'
		];

		$inspeccion = Inspeccion::find($id_inspeccion);
		$multa = Multa::where('inspeccion_id', $inspeccion->id)->where('folio', $folio)->first(['id', 'montoMulta', 'estatus', 'folio']);

		if(!empty($multa)) {
			if ($inspeccion->estatusInspeccion->clave == $estatus_multa->clave) {
				if ($multa->estatus == 'P') {
					if ($dias_prorroga != 0) {
						$prorogas_asignadas = BitacoraDeProroga::where('inspeccion_id', $inspeccion->id)->get();
						$dias_para_asignar_prorroga = 0;
						$total_dias_de_proroga = 0;
		
						if (!empty($prorogas_asignadas)) {
							if (count($prorogas_asignadas) > 0) {
								for ($i = 0; $i < count($prorogas_asignadas); $i++) { 
									$total_dias_de_proroga = $total_dias_de_proroga + $prorogas_asignadas[$i]->diasdeprorroga;
								}
							}
						}
		
						$dias_para_asignar_prorroga = $dias_prorroga + $total_dias_de_proroga;
		
						/* Hoy pero en otro formato y sin hora */
						$hoy = new \DateTime();
						$hoy->format('Y-m-d');
		
						/* Días inhábiles */
						$holiday = array();
		
						/* Los días inhábiles de la bd se agregan al array holiday */
						for ($i = 0; $i < count($dias_inhabiles); $i++) {
							$holiday[] = date('d-m', strtotime($dias_inhabiles[$i]->fecha));
						}
		
						/* Fecha Inicio */
						$startDate_prorroga = $hoy;
		
						/* Fecha Fin */
						$endDate = new \DateTime('2100-12-31');
		
						/* Intervalo de un día */
						$interval = new \DateInterval('P1D');
		
						/* Rango de fechas */
						$date_range_prorroga = new \DatePeriod($startDate_prorroga, $interval, $endDate);
		
						/* Días hábiles */
						$working_days_prorroga = array();
		
						/* Se omiten los fin de semana y días inhábiles */
						foreach($date_range_prorroga as $date){
							if ($dias_para_asignar_prorroga != 0) {
								if($date->format("N") < 6 AND !in_array($date->format('d-m'), $holiday)){
									$working_days_prorroga[] = $date->format('Y-m-d');
								}else{
									$dias_para_asignar_prorroga = $dias_para_asignar_prorroga + 1;
								}
								$dias_para_asignar_prorroga = $dias_para_asignar_prorroga - 1;
							}
						}
						
						$fecha_prorroga = end($working_days_prorroga);
						$inspeccion->fechaprorroga = $fecha_prorroga;
					}
		
					$inspeccion->observacionprorroga = $observacion_prorroga;
					$inspeccion->estatusinspeccion_id = $estatus_prorroga->id;
		
					if ($inspeccion->update()) {
						$datos_bitacora_prorroga = [
							'usuario_id' => $usuario->id,
							'inspeccion_id' => $inspeccion->id,
							'multa_id' => $multa->id,
							'folioMulta' => $folio,
							'fechavence' => $fecha_prorroga,
							'diasdeprorroga' => $dias_prorroga,
							'observaciones' => $observacion_prorroga
						];
		
						BitacoraDeProroga::create($datos_bitacora_prorroga);
		
						$datos_bitacora = [
							'inspeccion_id' => $inspeccion->id,
							'estatusinspeccion_id' => $estatus_prorroga->id,
							'usuario_id' => $usuario->id,
							'observacion' => $estatus_prorroga->nombre
						];
		
						BitacoraDeEstatus::create($datos_bitacora);
		
						$data = [
							'code' => 200,
							'message' => 'Se agrego prorroga correctamente',
							'inspeccion' => $inspeccion
						];
					} else {
						$data = [
							'code' => 400,
							'message' => 'No se pudo agregar la prorroga'
						];
					}
				} else {
					$data = [
						'code' => 400,
						'message' => 'La multa debe pagarse antes de asignar prorroga'
					];
				}
			} else {
				$data = [
					'code' => 400,
					'message' => 'La inspección debe estar en estatus multa para poder agregar prorroga'
				];
			}
		} else {
			$data = [
				'code' => 400,
				'message' => 'No se encontró la multa con ese folio'
			];
		}

		return $data;
	}

}
