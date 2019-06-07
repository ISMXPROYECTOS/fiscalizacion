@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Catalogo de Inspectores</h2>
    
    <div class="right-wrapper text-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li><span>Pages</span></li>
            <li><span>Blank Page</span></li>
        </ol>
        
        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
    </div>
</header>

<a class="mb-3 mt-1 mr-1 modal-with-zoom-anim ws-normal btn btn-default" href="#agregarInspector"><i class="fas fa-user-plus"></i> Agregar Inspector</a>

<div class="row">
    <div class="col">
        
        
        <table class="table table-bordered table-striped mb-0" id="datatable-default">
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

<div id="agregarInspector" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Agregar Inspector</h2>
        </header>
        <div class="card-body">
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
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default modal-dismiss btn-block" >Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary modal-confirm btn-block" id="btn-enviar">{{ __('Crear Inspector') }}</button>
                            
                        </div>
                    </div>
                </form>
        </div>

    </section>
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/inspectores.js') }}" defer></script>
@endsection