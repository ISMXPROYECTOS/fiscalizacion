@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-4 py-3 border-left-primary-custom">
        <div class="card-body">
            <h3 class="m-0 font-weight-bold text-primary-color">{{ __('Catalogo de Gestores') }}</h3>
        </div>
    </div>

    <a href="{{ route('registro-gestores') }}" class="btn btn-success btn-icon-split mb-4 ">
        <span class="icon text-white-50">
          <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Agregar Inspector</span>
    </a>


    <!-- DataTales Example -->
    <div class="card shadow mb-4 border-bottom-primary-custom">
        
        <div class="card-body">
            <div class="table-responsive">
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-head">
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
                    <tfoot class="table-footer">
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
                            <td>
                              @if ($gestor->estatus == 'A')
                                <span class="badge badge-success">Activo</span>
                              @elseif ($gestor->estatus == 'B')
                                <span class="badge badge-danger">Baja</span>
                              @elseif ($gestor->estatus == 'S')
                                <span class="badge badge-warning">Suspendido</span>
                              @elseif ($gestor->estatus == 'V')
                                <span class="badge badge-info">Vigente</span>
                              @endif
                            </td>

                            <td>
                              <a href="{{ route('editar-gestor', ['id' => $gestor->id]) }}" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> </a>
                              <a href="{{ route('gestor-delete', ['id' => $gestor->id]) }}" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i>
                            </td>
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