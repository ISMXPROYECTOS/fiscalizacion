@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inspectores') }}</div>
                <div class="card-body">
                    <a href="{{ route('registro-inspector') }}">Agregar</a>
                    <table style="text-align: center;">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Clave</th>
                            <th>Estatus</th>
                        </tr>
                        @foreach ($inspectores as $inspector)
                        <tr>
                            <td>{{ $inspector->nombre }}</td>
                            <td>{{ $inspector->apellidopaterno }}</td>
                            <td>{{ $inspector->apellidomaterno }}</td>
                            <td>{{ $inspector->clave }}</td>
                            <td>{{ $inspector->estatus }}</td>
                            <td><a href="{{ route('editar-inspector', ['id' => $inspector->id]) }}">Modificar</a></td>
                            <td><a href="{{ route('inspector-delete', ['id' => $inspector->id]) }}">Eliminar</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
