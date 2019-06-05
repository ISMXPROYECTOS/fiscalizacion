@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card mb-4 py-3 border-left-primary-custom">
        <div class="card-body">
            <h3 class="m-0 font-weight-bold text-primary-color">{{ __('Catalogo de Usuarios') }}</h3>
        </div>
    </div>

    <a href="{{ route('registro-usuarios') }}" class="btn btn-success btn-icon-split mb-4 ">
        <span class="icon text-white-50">
          <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Agregar Usuario</span>
    </a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 border-bottom-primary-custom">
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Usuario</th>
                            <th>Activo</th>
                            <th>Rol</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tfoot class="table-footer">
                        <tr>
                            <th>Usuario</th>
                            <th>Activo</th>
                            <th>Rol</th>
                            <th>Acción</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            @if($usuario->id != Auth::user()->id)
                                <tr>
                                    <td>{{ $usuario->usuario }}</td>
                                    <td>{{ $usuario->activo }}</td>
                                    <td>
                                        @if ($usuario->role == 'ROLE_ADMIN')
                                            <span class="badge badge-success">Administrador</span>
                                        @elseif ($usuario->role == 'ROLE_INSPECTOR')
                                            <span class="badge badge-warning">Inspector</span>
                                        @elseif ($usuario->role == 'ROLE_VENTANILLA')
                                            <span class="badge badge-info">Ventanilla</span>
                                        @endif
                                    </td>
                                    <td>
                                      <a href="#" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> </a>
                                      <a href="#" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
