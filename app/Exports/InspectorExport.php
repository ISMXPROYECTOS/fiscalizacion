<?php

namespace App\Exports;

use App\Inspector;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InspectorExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inspector::all(['id', 'nombre', 'apellidopaterno', 'apellidomaterno', 'clave', 'estatus', 'vigenciainicio', 'vigenciafin', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Apellido Paterno',
            'Apellido Materno',
            'Clave',
            'Status',
            'Vigencia Inicio',
            'Vigencia Fin',
            'Creado El',
            'Actualizado El'
        ];
    }
}
