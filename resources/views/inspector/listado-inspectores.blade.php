@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  
  <div class="card mb-4 py-3 border-left-primary-custom">
    <div class="card-body">
      <h3 class="m-0 font-weight-bold text-primary-color">{{ __('Catalogo de Inspectores') }}</h3>
    </div>
  </div>



  <a href="{{ route('registro-inspector') }}" class="btn btn-success btn-icon-split mb-4 ">
    <span class="icon text-white-50">
      <i class="fas fa-user-plus"></i>
    </span>
    <span class="text">Agregar Inspector</span>
  </a>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 border-bottom-primary-custom">
    
    <div class="card-body">
      <div class="table-responsive">
        
        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
          <thead class="table-head">
            <tr>
              <th>Nombre</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Clave</th>
              <th>Estatus</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tfoot class="table-footer">
          <tr>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Clave</th>
            <th>Estatus</th>
            <th>Acción</th>
          </tr>
          </tfoot>
          <tbody>
            @foreach ($inspectores as $inspector)
              <tr>
                <td>{{ $inspector->nombre }}</td>
                <td>{{ $inspector->apellidopaterno }}</td>
                <td>{{ $inspector->apellidomaterno }}</td>
                <td>{{ $inspector->clave }}</td>
                <td>
                  @if ($inspector->estatus == 'A')
                    <span class="badge badge-success">Activo</span>
                  @elseif ($inspector->estatus == 'B')
                    <span class="badge badge-danger">Baja</span>
                  @elseif ($inspector->estatus == 'S')
                    <span class="badge badge-warning">Suspendido</span>
                  @elseif ($inspector->estatus == 'V')
                    <span class="badge badge-info">Vigente</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('editar-inspector', ['id' => $inspector->id]) }}" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> </a>
                  <a href="{{ route('inspector-delete', ['id' => $inspector->id]) }}" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i>
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