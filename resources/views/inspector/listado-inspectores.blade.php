@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-white">{{ __('Catalogo de Inspectores') }}</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        <a href="{{ route('registro-inspector') }}">Agregar</a>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Clave</th>
              <th>Estatus</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tfoot>
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
              <td>{{ $inspector->estatus }}</td>
              <td><a href="{{ route('editar-inspector', ['id' => $inspector->id]) }}">Modificar</a> | <a href="{{ route('inspector-delete', ['id' => $inspector->id]) }}">Eliminar</a> </td>
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
