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
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#crear-inspector">
<i class="fas fa-user-plus"></i> Agregar Inspector
</button>
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
            <tbody id="tbody">
                
            </tbody>
        </table>
        
    </div>
</div>
<div class="modal fade" id="crear-inspector" tabindex="-1" role="dialog" aria-labelledby="modal-crear-inspector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-crear-inspector">Agregar Inspector</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario-inspector" role="form">
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
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block" id="btn-enviar">{{ __('Crear Inspector') }}</button>
                            
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