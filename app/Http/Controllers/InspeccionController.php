<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspeccion;
use App\Inspector;
use App\Gestor;
use App\TipoDeInspeccion;

class InspeccionController extends Controller
{
	// Muetra la vista del listado de las inspecciones
	public function listadoInspecciones(){
		$inspectores = Inspector::all();
		$gestores = Gestor::all();
		return view('inspeccion.listado-inspecciones', [
			'inspectores' => $inspectores,
			'gestores' => $gestores
		]);
	}

	public function tbody(){
		return datatables()
			->eloquent(Inspeccion::query())
			->addColumn('btn', 'inspeccion/actions-inspecciones')
			->rawColumns(['btn'])->toJson();
	}

	public function create(Request $request){

		$data = $request->all();
    	$cantidades = array_get($data, 'cantidad');
    	$inspectores = array_get($data, 'inspector');

		// Valida cada array en cada posición con el .*
		$this->validate($request, [
            'cantidad.*' => 'required|string',
            'inspector.*' => 'required|string'
        ]);

    	for ($i = 0; $i < count($cantidades); $i++) {
    		$cantidad = $cantidades[$i];
    		for ($a = 0; $a < $cantidad; $a++) {
    			$datos = [
    				'idinspector' => $inspectores[$i]
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
		// Se reciben la id de la inspección que se esta modificando
		$id = $request->input('id');

		// Se selecciona la inspección para ser modificado
		$inspector = Inspector::where('id', $id)->first();

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'clave' => 'required|string|max:10|unique:inspector,clave,' . $id
		]);

		// Se reciben los datos del formulario y se crean variables
		$nombre = $request->input('nombre');
		$apellidopaterno = $request->input('apellidopaterno');
		$apellidomaterno = $request->input('apellidomaterno');
		$clave = $request->input('clave');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$inspector->idusuario = $idUser;
		$inspector->nombre = $nombre;
		$inspector->apellidopaterno = $apellidopaterno;
		$inspector->apellidomaterno = $apellidomaterno;
		$inspector->clave = $clave;
		$inspector->update();

        // Indica que fue correcta la modificación de la inspección
    	return $inspector;

	}

}
