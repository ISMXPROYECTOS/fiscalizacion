@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Documentacion Requerida</h2>
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-colonia" data-backdrop="static" data-keyboard="false">
    <i class="fas fa-user-plus"></i> Agregar Documento
</button>
<div class="row">
    <div class="col">
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Cambiar Estatus</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
    </div>
</div>

<!-- Modal para Crear -->
<div class="modal fade" id="crear-colonia" tabindex="-1" role="dialog" aria-labelledby="modal-crear-colonia" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-crear-colonia">Agregar Documentación</h3>
            </div>
            <div class="modal-body">
                <form id="formulario-colonia" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">{{ __('Nombre') }}</label>
                        <input id="nombre" type="text" class="form-control">
                        <p class="text-danger" id="error-nombre"></p>
                    </div>
                    <div class="form-group">
                        <label for="clave">{{ __('Clave') }}</label>
                        <input id="clave" type="text" class="form-control">
                        <p class="text-danger" id="error-clave"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Documentacion') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editar-documento" tabindex="-1" role="dialog" aria-labelledby="modal-editar-documento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-documento">Editar Documento</h3>
            </div>
            <div class="modal-body">
                <form class="formulario-documentacion-requerida" role="form">
                    @csrf
                    <input type="hidden" id="id-edit">
                    <div class="form-group">
                        <label for="nombre-edit">{{ __('Nombre ') }}</label>
                        <input id="nombre-edit" type="text" class="form-control">
                        <p class="text-danger" id="error-nombre-edit"></p>
                    </div>
                    <div class="form-group">
                        <label for="clave-edit">{{ __('Clave') }}</label>
                        <input id="clave-edit" type="text" class="form-control">
                        <p class="text-danger" id="error-clave-edit"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-editar">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Estatus -->
<div class="modal fade" id="editar-activo" tabindex="-1" role="dialog" aria-labelledby="modal-editar-activo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-activo">Estatus Documento</h3>
            </div>
            <div class="modal-body">
                <form class="formulario-activo" role="form">
                    @csrf
                    <input type="hidden" id="id-edit-activo">
                    <div class="form-group">
                        <label for="activo-edit">{{ __('Estatus') }}</label>
                        <select id="activo-edit" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        <p class="text-danger" id="error-activo-edit"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-activo">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Alerta de registro -->
<div class="modal fade" id="registro-correcto" tabindex="-1" role="dialog" aria-labelledby="modal-registro-exitoso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-registro-correcto">Registro Exitoso</h3>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Registro Exitoso</h4>
                        <p>Se ha registrado la colonia correctamente.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Alerta de actualización -->
<div class="modal fade" id="actualizacion-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-actualizacion-correcta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-actualizacion-correcta">Actualización Exitosa</h3>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Actualización Exitosa</h4>
                        <p>La información se ha actualizado correctamente.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/documentacion-requerida.js') }}" defer></script>
@endsection