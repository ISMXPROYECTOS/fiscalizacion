@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-white">{{ __('Catalogo de Gestores') }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('registro-gestores') }}">Agregar</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>E-mail</th>
                            <th>INE</th>
                            <th>Estatus</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>E-mail</th>
                            <th>INE</th>
                            <th>Estatus</th>
                            <th>Acción</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($gestores as $gestor)
                        <tr>
                            <td>{{ $gestor->nombre }}</td>
                            <td>{{ $gestor->apellidopaterno }}</td>
                            <td>{{ $gestor->apellidomaterno }}</td>
                            <td>{{ $gestor->telefono }}</td>
                            <td>{{ $gestor->celular }}</td>
                            <td>{{ $gestor->correoelectronico }}</td>
                            <td>{{ $gestor->ine }}</td>
                            <td>{{ $gestor->estatus }}</td>
                            <td><a href="{{ route('editar-gestor', ['id' => $gestor->id]) }}">Modificar</a> | <a href="{{ route('gestor-delete', ['id' => $gestor->id]) }}">Eliminar</a> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
