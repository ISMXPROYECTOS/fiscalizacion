<?php

namespace App\Http\Controllers\Api;

use App\BitacoraDeEstatus;
use App\DocumentacionPorInspeccion;
use App\DocumentacionPorTipoDeInspeccion;
use App\EjercicioFiscal;
use App\EstatusInspeccion;
use App\FormaValorada;
use App\Http\Requests\InspeccionCreateRequest;
use App\Inspeccion;
use App\TipoDeInspeccion;
use Illuminate\Http\Request;

class InspeccionController extends Controller
{
    public function create(InspeccionCreateRequest $request)
    {
        $cantidad = $request->input('cantidad');
        $ejercicioFiscalId = $request->input('ejerciciofiscal_id');
        $tipoInspeccionId = $request->input('tipoinspeccion_id');
        $usuario = $request->user();

        $estatusInspeccion = EstatusInspeccion::where('clave', 'NA')->first();
        $formaValorada = FormaValorada::where('tipoinspeccion_id', $tipoInspeccionId)->where('ejerciciofiscal_id', $ejercicioFiscalId)->orderBy('created_at', 'DESC')->first();
        $documentacionPorInspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $tipoInspeccionId)->get(['id', 'documentacionrequerida_id']);

        $ejercicioFiscal = EjercicioFiscal::find($ejercicioFiscalId);
        $tipoInspeccion = TipoDeInspeccion::find($tipoInspeccionId);

        if (! $formaValorada) {
            $nuevaFormaValorada = $this->createFormaValorada($request, $cantidad);
        } else {
            $nuevoFolioInicio = $formaValorada->foliofin + 1;
            $nuevoFolioFin = $formaValorada->foliofin + $cantidad;
            $nuevaFormaValorada = $this->createFormaValorada($request, $nuevoFolioFin, $nuevoFolioInicio);
        }

        for ($a = 0; $a < $cantidad; $a++) {
            $folio = $nuevaFormaValorada->folioinicio + $a;
            $inspeccion = $nuevaFormaValorada->inspeccion()->create([
                'formavalorada_id' => $nuevaFormaValorada->id,
                'tipoinspeccion_id' => $tipoInspeccionId,
                'usuario_id' => $usuario->id,
                'ejerciciofiscal_id' => $ejercicioFiscalId,
                'estatusinspeccion_id' => $estatusInspeccion->id,
                'folio' => $ejercicioFiscal->anio . '/' . $tipoInspeccion->clave . '/' . $folio
            ]);

            $this->guardarEnBitacora($inspeccion, $usuario, $estatusInspeccion);

            for ($b = 0; $b < count($documentacionPorInspeccion); $b++) {
                $inspeccion->documentacionPorInspeccion()->create([
                    'tipoinspeccion_id' => $tipoInspeccionId,
                    'documentacionrequerida_id' => $documentacionPorInspeccion[$b]->documentacionrequerida_id,
                    'inspeccion_id' => $inspeccion->id,
                    'solicitado' => 0,
                    'exhibido' => 0
                ]);
            }
        }

        return response()->json([
            'message' => 'Las inspecciones se han creado correctamente.',
        ], 201);
    }

    public function createFormaValorada(Request $request, $folioFin, $folioInicio = 1)
    {
        $nuevaFormaValorada = FormaValorada::create([
            'usuario_id' 			=> $request->user()->id,
            'tipoinspeccion_id' 	=> $request->input('tipoinspeccion_id'),
            'ejerciciofiscal_id' 	=> $request->input('ejerciciofiscal_id'),
            'encargado_id' 		    => $request->input('encargado_id'),
            'folioinicio' 			=> $folioInicio,
            'foliofin' 			    => $folioFin
        ]);

        return $nuevaFormaValorada;
    }

    public function guardarEnBitacora($inspeccion, $usuario, $estatusInspeccion)
    {
        $datosBitacora = [
            'inspeccion_id' => $inspeccion->id,
            'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
            'usuario_id' => $usuario->id,
            'observacion' => 'Creada - ' . $estatusInspeccion->nombre
        ];

        return BitacoraDeEstatus::create($datosBitacora);
    }
}
