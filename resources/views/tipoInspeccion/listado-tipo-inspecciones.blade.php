@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Tipo de Inspecciones</h2>
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-tipo-inspeccion" data-backdrop="static" data-keyboard="false">
    <i class="fas fa-user-plus"></i> Agregar Tipo de Inspección
</button>
<div class="row">
    <div class="col">
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Formato</th>
                    <th>Fecha creado</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
    </div>
</div>
<!-- Modal para Crear -->
<div class="modal fade" id="crear-tipo-inspeccion" tabindex="-1" role="dialog" aria-labelledby="modal-crear-tipo-inspeccion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-crear-tipo-inspeccion">Agregar Tipo de Inspección</h3>
            </div>
            <div class="modal-body">
                <form id="formulario-tipo-inspeccion" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">{{ __('Nombre') }}</label>
                        <input id="nombre" type="text" class="form-control" name="nombre">
                        <p class="text-danger" id="error-nombre"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="clave">{{ __('Clave') }}</label>
                                <input id="clave" type="text" class="form-control" name="clave">
                               
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="formato">{{ __('Formato') }}</label>
                                <input id="formato" type="text" class="form-control" name="formato">
                                
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p class="text-danger mb-0" id="error-clave"></p>
                            <p class="text-danger mb-0" id="error-formato"></p>
                            <br>
                        </div>
                    </div>
                    <div class="alert alert-info" role="alert">
                      Selecciona los documentos requeridos para este tipo de inspección.
                    </div>
                    <div id="documentos">
                        @foreach($documentos as $documento)
                            <div class="form-check">
                              <input class="form-check-input checkbox-documento" type="checkbox" value="{{ $documento->id }}" id="documento-{{ $documento->id }}" name="documentos-requeridos[]">
                              <label class="form-check-label" for="documento-{{ $documento->id }}">
                                {{ $documento->nombre }}
                              </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Tipo de Inspección') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para Editar -->
<div class="modal fade" id="editar-tipo-inspeccion" tabindex="-1" role="dialog" aria-labelledby="modal-editar-tipo-inspeccion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-tipo-inspeccion">Editar Tipo Inspección</h3>
            </div>
            <div class="modal-body">
                <form id="formulario-tipo-inspeccion-editar" role="form">
                    @csrf
                    <input type="hidden" id="id-edit" name="id-edit">
                    <div class="form-group">
                        <label for="nombre-edit">{{ __('Nombre') }}</label>
                        <input id="nombre-edit" type="text" class="form-control" name="nombre">
                        <p class="text-danger" id="error-nombre-edit"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="clave-edit">{{ __('Clave') }}</label>
                                <input id="clave-edit" type="text" class="form-control" name="clave">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="formato-edit">{{ __('Formato') }}</label>
                                <input id="formato-edit" type="text" class="form-control" name="formato">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p class="text-danger mb-0" id="error-clave-edit"></p>
                            <p class="text-danger mb-0" id="error-formato-edit"></p>
                            <br>
                        </div>
                    </div>
                    <div id="documentos-editar">
                       
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
                        <p>Se ha registrado al inspector correctamente.</p>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
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
<script src="{{ asset('js/tipoInspecciones.js') }}" defer></script>
@endsection