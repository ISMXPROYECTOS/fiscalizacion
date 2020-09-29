<?php

namespace App\Exports;

use App\Inspeccion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class InspeccionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

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
		])->get([
            'folio',
            'tipoinspeccion_id',
			'estatusinspeccion_id',
            'inspector_id',
            'comercio_id',
			'fechavence',
            'fechaprorroga',
            'created_at',
            'updated_at'
        ]);
        
        if ($inspecciones) {
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

				

				$tmp = [
                    'folio' => $inspeccion->folio,
                    'tipoinspeccion' => $inspeccion->tipoInspeccion->clave,
                    'estatusinspeccion_nombre' => $inspeccion->estatusInspeccion->nombre,
                    'inspector' => is_object($inspeccion->inspector) ? $inspeccion->inspector->nombre.' '.$inspeccion->inspector->apellidopaterno.' '.$inspeccion->inspector->apellidomaterno : '',
					'comercio_denominacion' => is_object($inspeccion->comercio) ? $inspeccion->comercio->denominacion : 'NULL',
                    'comercio_nombre' => is_object($inspeccion->comercio) ? $inspeccion->comercio->nombreestablecimiento : 'NULL',
                    'fechaprorroga' => ($fechaprorroga) ? $fechaprorroga : 'NULL',
                    'fechavence' => ($fechavence) ? $fechavence : 'NULL',
                    'created_at' => $inspeccion->created_at->format('d/m/Y'),
                    'updated_at' => $inspeccion->updated_at->format('d/m/Y'),
					// 'estatusinspeccion_id' => $inspeccion->estatusInspeccion->id,
					// 'estatusinspeccion_clave' => $inspeccion->estatusInspeccion->clave,
				];
				
				$collection->push($tmp);
				unset($tmp);
            }
        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Folio',
            'Tipo de Inspeccion',
            'Estatus',
            'Fiscal',
            'Razon Social',
            'Nombre del Local',
            'Fecha de Prorroga',
            'Fecha Vencimiento',
            'Creado El',
            'Actualizado El'
        ];
    }
}
