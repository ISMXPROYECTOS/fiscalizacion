<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
		$inspectores = Inspector::all();
		$gestores = Gestor::all();
		$tiposInspecciones = TipoDeInspeccion::all();
		$formasValoradas = FormaValorada::all();
		$giros = GiroComercial::all();
		$subgiros = SubgiroComercial::all();
		$ejerciciosFiscales = EjercicioFiscal::all();
		$estatusInspecciones = EstatusInspeccion::all();
		$colonias = Colonia::all();
		return view('inspeccion.listado-inspecciones', [
			'inspectores' => $inspectores,
			'gestores' => $gestores,
			'tiposInspecciones' => $tiposInspecciones,
			'formasValoradas' => $formasValoradas,
			'giros' => $giros,
			'subgiros' => $subgiros,
			'ejerciciosFiscales' => $ejerciciosFiscales,
			'estatusInspecciones' => $estatusInspecciones,
			'colonias' => $colonias
		]);
	}

	public function tbody(){
		return datatables()
			->eloquent(Inspeccion::query())
			->addColumn('btn', 'inspeccion/actions-inspecciones')
			->rawColumns(['btn'])->toJson();
	}

	public function create(Request $request){

		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
            'cantidad' => 'required|string',
            'ejerciciofiscal' => 'required|string',
            'tipoinspeccion' => 'required|string'
        ]);

		$data = $request->all();
    	$cantidad = $request->input('cantidad');
    	$ejercicio_fiscal_id = $request->input('ejerciciofiscal');
    	$tipo_inspeccion_id = $request->input('tipoinspeccion');
    	$usuario = Auth::user();
    	
    	$estatus_inspeccion = EstatusInspeccion::where('clave', 'NA')->get();

    	foreach ($estatus_inspeccion as $estatus) {
    		$id_estatus_inspeccion = $estatus->id;
    	}

		$forma_valorada = FormaValorada::where('idtipoinspeccion', $tipo_inspeccion_id)->get();
		
		if ($forma_valorada->count() == 0) {
			$datos = [
				'idusuario' => $usuario->id,
				'idtipoinspeccion' => $tipo_inspeccion_id,
				'idejerciciofiscal' => $ejercicio_fiscal_id,
				'idconfiguracion' => 1,
				'folioinicio' => 1,
				'foliofin' => $cantidad
			];

			FormaValorada::create($datos);

		} else {

			$folio_fin = $forma_valorada->last()->foliofin;
			$nuevo_folio_inicio = $folio_fin + 1;
			$nuevo_folio_fin = $folio_fin + $cantidad;

			$datos = [
				'idusuario' => $usuario->id,
				'idtipoinspeccion' => $tipo_inspeccion_id,
				'idejerciciofiscal' => $ejercicio_fiscal_id,
				'idconfiguracion' => 1,
				'folioinicio' => $nuevo_folio_inicio,
				'foliofin' => $nuevo_folio_fin
			];

			FormaValorada::create($datos);
		}

		for ($a = 0; $a < $cantidad; $a++) {

			$forma_valorada = FormaValorada::where('idtipoinspeccion', $tipo_inspeccion_id)->get();
			$id_forma_valorada = $forma_valorada->last()->id;

			$folio_inicio = $forma_valorada->last()->folioinicio;
			$folio = $folio_inicio + $a;

			$ejercicio_fiscal = EjercicioFiscal::find($ejercicio_fiscal_id);
			$ejercicio_fiscal_anio = $ejercicio_fiscal->anio;

			$tipo_inspeccion = TipoDeInspeccion::find($tipo_inspeccion_id);
			$tipo_inspeccion_clave = $tipo_inspeccion->clave;

			$inspecciones = Inspeccion::all();

			$datos = [
				'idformavalorada' => $id_forma_valorada,
				'idtipoinspeccion' => $tipo_inspeccion_id,
				'idusuario' => $usuario->id,
				'idejerciciofiscal' => $ejercicio_fiscal_id,
				'idestatusinspeccion' => $id_estatus_inspeccion,
				'folio' => $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio
			];

			Inspeccion::create($datos);
		}
    	
    	 return redirect('inspecciones/agregar')->with('status', 'Se ha creado correctamente');
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
		$fechavence = $request->input('fechavence');
		$date = strtotime($fechavence);
		$fecha_format = date("Y-m-d", $date);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'inspector' => 'required|string',
			'gestor' => 'required|string',
			'tipoinspeccion' => 'required|string',
			'formavalorada' => 'required|string',
			'giro' => 'required|string',
			'subgiro' => 'required|string',
			'ejerciciofiscal' => 'required|string',
			'estatus' => 'required|string',
			'colonia' => 'required|string',
			'local' => 'required|string',
			'domicilio' => 'required|string|max:75',
			'encargado' => 'required|string|max:50',
            'puestoencargado' => 'required|string|max:30',
            'diasvence' => 'required|string',
            'fechavence' => 'required|date_format:Y-m-d'
		]);

		// Se reciben los datos del formulario y se crean variables
		$inspector = $request->input('inspector');
		$gestor = $request->input('gestor');
		$tipoinspeccion = $request->input('tipoinspeccion');
		$formavalorada = $request->input('formavalorada');
		$giro = $request->input('giro');
		$subgiro = $request->input('subgiro');
		$ejerciciofiscal = $request->input('ejerciciofiscal');
		$estatus = $request->input('estatus');
		$colonia = $request->input('colonia');
		$local = $request->input('local');
		$domicilio = $request->input('domicilio');
		$encargado = $request->input('encargado');
		$puestoencargado = $request->input('puestoencargado');
		$diasvence = $request->input('diasvence');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$inspeccion->idinspector = $inspector;
		$inspeccion->idgestores = $gestor;
		$inspeccion->idtipoinspeccion = $tipoinspeccion;
		$inspeccion->idformavalorada = $formavalorada;
		$inspeccion->idgiro = $giro;
		$inspeccion->idsubgirocomercial = $subgiro;
		$inspeccion->idejerciciofiscal = $ejerciciofiscal;
		$inspeccion->idestatusinspeccion = $estatus;
		$inspeccion->idcolonia = $colonia;
		$inspeccion->nombrelocal = $local;
		$inspeccion->domicilio = $domicilio;
		$inspeccion->nombreencargado = $encargado;
		$inspeccion->cargoencargado = $puestoencargado;
		$inspeccion->diasvence = $diasvence;
		$inspeccion->fechavence = $fecha_format;
		$inspeccion->update();

        // Indica que fue correcta la modificación de la inspección
    	return $inspeccion;

	}

	public function asignarInspecciones(Request $request){

		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
			'ejerciciofiscal-asignar' => 'required|string',
			'tipoinspeccion-asignar' => 'required|string',
            'cantidad-asignar' => 'required|string',
            'inspectores-asignar.*' => 'required|string'
        ]);

		$data = $request->all();
    	$ejerciciofiscal = $request->input('ejerciciofiscal-asignar');
    	$tipoinspeccion = $request->input('tipoinspeccion-asignar');
    	$cantidad = $request->input('cantidad-asignar');
		$inspectores = array_get($data, 'inspectores-asignar');

		$estatus_anterior = EstatusInspeccion::where('clave', 'NA')->get();
		foreach ($estatus_anterior as $estatus) {
    		$id_estatus_anterior = $estatus->id;
		}

		$estatus_nuevo = EstatusInspeccion::where('clave', 'A')->get();
		foreach ($estatus_nuevo as $estatus) {
    		$id_estatus_nuevo = $estatus->id;
		}

		$inspecciones = Inspeccion::where('idestatusinspeccion', $id_estatus_anterior)
									->where('idtipoinspeccion', $tipoinspeccion)->get();
		$tipos_inspecciones = TipoDeInspeccion::find($tipoinspeccion);
		$total_inspectores = count($inspectores);
		$total_inspecciones = $cantidad * $total_inspectores;
		$numero_inspecciones = count($inspecciones);

		if ($numero_inspecciones >= $total_inspecciones) {
			for ($i = 0; $i < $total_inspectores; $i++) {
	    		for ($a = 0; $a < $cantidad; $a++) {
	    			for ($b = 0; $b < $numero_inspecciones; $b++) {
						if ($inspecciones[$b]->idtipoinspeccion == $tipos_inspecciones->id && $inspecciones[$b]->idestatusinspeccion == $id_estatus_anterior) {
							$inspecciones[$b]->idinspector = $inspectores[$i];
							$inspecciones[$b]->idestatusinspeccion = $id_estatus_nuevo;
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

	public function obtenerTotalInspecciones($id){
		$total_inspecciones = Inspeccion::where('idtipoinspeccion', $id)
										->where('idestatusinspeccion', 1)
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
		$forma_valorada = FormaValorada::where('idtipoinspeccion', $tipo_inspeccion_id)->get();

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

    	$inspecciones = Inspeccion::where('idestatusinspeccion', 1)
							->where('idtipoinspeccion', $tipo_inspeccion_id)->get();

		$total_inspectores = count($inspectores);


		for ($i = 1; $i <= $total_inspectores; $i++) {
			$cantidad_final = $cantidad * $i;
			if ($i == 1) {
				$datos = array(	
					$i-1 => array(
						'folioinicio' => $inspecciones[$i-1]->folio,
						'foliofin'  => $inspecciones[$cantidad_final-1]->folio,
						'inspector'  => $inspectores[$i-1]
					)
				);
			}else{	
				$datos = array(	
					$i-1 => array(
						'folioinicio' => $inspecciones[$cantidad_final-$cantidad]->folio,
						'foliofin'  => $inspecciones[$cantidad_final-1]->folio,
						'inspector'  => $inspectores[$i-1]
					)
				);	
			}
		}
		return $datos;
	}
}
