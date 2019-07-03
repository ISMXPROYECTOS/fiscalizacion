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
		/*
		$inspeccion = DB::table('inspeccion')
			->join('inspector', 'inspeccion.idinspector', '=', 'inspector.id')
			->get();
		*/
		//var_dump($inspeccion);

		return datatables()
			->eloquent(Inspeccion::query())
			->addColumn('btn', 'inspeccion/actions-inspecciones')
			->rawColumns(['btn'])->toJson();
	}

	public function create(Request $request){

		$data = $request->all();
    	$cantidades = array_get($data, 'cantidad');
    	$ejercicios_fiscales = array_get($data, 'ejerciciofiscal');
    	$tipos_inspecciones = array_get($data, 'tipoinspeccion');
    	$usuario = Auth::user();
    	
    	$estatus_inspeccion = EstatusInspeccion::where('nombre', 'No asignada')->get();

    	foreach ($estatus_inspeccion as $estatus) {
    		$id_estatus_inspeccion = $estatus->id;
    	}
    	

		// Valida cada array en cada posición con el .*
		$validate = $this->validate($request, [
            'cantidad.*' => 'required|string',
            'ejerciciofiscal.*' => 'required|string',
            'tipoinspeccion.*' => 'required|string'
        ]);


    	for ($i = 0; $i < count($cantidades); $i++) {
			$cantidad = $cantidades[$i];

			$forma_valorada = FormaValorada::all();
			
			if ($forma_valorada->count() == 0) {
				$datos = [
					'idusuario' => $usuario->id,
					'idtipoinspeccion' => $tipos_inspecciones[$i],
					'idejerciciofiscal' => $ejercicios_fiscales[$i],
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
					'idtipoinspeccion' => $tipos_inspecciones[$i],
					'idejerciciofiscal' => $ejercicios_fiscales[$i],
					'idconfiguracion' => 1,
					'folioinicio' => $nuevo_folio_inicio,
					'foliofin' => $nuevo_folio_fin
				];

				FormaValorada::create($datos);
			}

			for ($a = 0; $a < $cantidad; $a++) {

				$forma_valorada = FormaValorada::all();
				$id_forma_valorada = $forma_valorada->last()->id;

				$folio_inicio = $forma_valorada->last()->folioinicio;
				$folio = $folio_inicio + $a;

    			$ejercicio_fiscal = EjercicioFiscal::find($ejercicios_fiscales[$i]);
    			$ejercicio_fiscal_anio = $ejercicio_fiscal->anio;

    			$tipo_inspeccion = TipoDeInspeccion::find($tipos_inspecciones[$i]);
    			$tipo_inspeccion_clave = $tipo_inspeccion->clave;

    			$inspecciones = Inspeccion::all();

    			$datos = [
    				'idformavalorada' => $id_forma_valorada,
    				'idtipoinspeccion' => $tipos_inspecciones[$i],
    				'idusuario' => $usuario->id,
    				'idejerciciofiscal' => $ejercicios_fiscales[$i],
    				'idestatusinspeccion' => $id_estatus_inspeccion,
    				'folio' => $ejercicio_fiscal_anio.'/'.$tipo_inspeccion_clave.'/'.$folio
    			];

    			Inspeccion::create($datos);
    		}
    	}
    	return $datos;
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

}