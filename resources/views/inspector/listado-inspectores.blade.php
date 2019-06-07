@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">{{ __('Catalogo de Inspectores') }}</h1>
                <p class="text-muted float-right">
                    Ultima Sesión Ayer: 8:20 AM
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <button type="button" class="btn btn-primary mb-4 " id="btn-crear-inspector" data-toggle="modal" data-target="#crear-inspector">
        <span><i class="fas fa-user-plus"></i></span> Agregar Inspector
    </button>

    <div class="card mb-3">
        
        <div class="card-body">
            
            <table class="table table-responsive-xl table-striped">
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
                            <a href="{{ route('inspector-delete', ['id' => $inspector->id]) }}" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="crear-inspector" tabindex="-1" role="dialog" aria-labelledby="formulario-crear-inspector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formulario-crear-inspector">Agregar Inspector</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formulario-inspector" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">{{ __('Nombre Completo') }}</label>
                        <input id="nombre" type="text" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidopaterno">{{ __('Apellido Paterno') }}</label>
                                <input id="apellidopaterno" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidomaterno">{{ __('Apellido Materno') }}</label>
                                <input id="apellidomaterno" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="clave">{{ __('Clave') }}</label>
                        <input id="clave" type="text" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="estatus">{{ __('Estatus') }}</label>
                        <select id="estatus" class="form-control" >
                            <option value="">Seleccionar</option>
                            <option value="A">Activo</option>
                            <option value="B">Baja</option>
                            <option value="S">Suspendido</option>
                            <option value="V">Vigente</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-12 ">
                            <button type="button" class="btn btn-secondary " data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btn-enviar">{{ __('Crear Inspector') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/inspectores.js') }}" defer></script>
@endsection