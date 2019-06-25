@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Inspecciones</h2>
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-inspector">
<i class="fas fa-user-plus"></i> Agregar Inspección
</button>
<div class="row">
    <div class="col">
        
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Inspector</th>
                    <th>Gestor</th>
                    <th>Tipo Inspección</th>
                    <th>Forma Valorada</th>
                    <th>Giro Comercial</th>
                    <th>Subgiro Comercial</th>
                    <th>Año</th>
                    <th>Estatus</th>
                    <th>Colonia</th>
                    <th>Fecha Generada</th>
                    <th>Fecha Asignada</th>
                    <th>Fecha Capturada</th>
                    <th>Fecha Prorroga</th>
                    <th>Nombre del Local</th>
                    <th>Domicilio</th>
                    <th>Folio</th>
                    <th>Encargado</th>
                    <th>Puesto del Encargado</th>
                    <th>Días de vencimiento</th>
                    <th>Fecha de vencimiento</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
    </div>
</div>
<!-- Modal para Crear -->
<div class="modal fade" id="crear-inspector" tabindex="-1" role="dialog" aria-labelledby="modal-crear-inspector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-crear-inspector">Agregar Inspección</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario-inspector" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="inspeccion">{{ __('Número de Inspecciones') }}</label>
                        <input id="inspeccion" type="number" class="form-control">
                        <p class="text-danger" id="error-inspeccion"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="inspector">{{ __('Inspector') }}</label>
                                <select id="inspector" class="form-control" >
                                    <option value="">Seleccionar</option>
                                    @foreach($inspectores as $inspector)
                                        @if($inspector->estatus == 'A' or $inspector->estatus == 'V')
                                            <option value="{{ $inspector->id}}">{{ $inspector->nombre }} {{ $inspector->apellidopaterno }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="gestor">{{ __('Gestor') }}</label>
                                <select id="gestor" class="form-control" >
                                    <option value="">Seleccionar</option>
                                    @foreach($gestores as $gestor)
                                        @if($gestor->estatus == 'A' or $gestor->estatus == 'V')
                                            <option value="{{ $gestor->id}}">{{ $gestor->nombre }} {{ $gestor->apellidopaterno }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-inspector"></p>
                            <p class="text-danger" id="error-gestor"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipoInspeccion">{{ __('Tipo de Inspección') }}</label>
                        <select id="tipoInspeccion" class="form-control" >
                            <option value="">Seleccionar</option>
                            @foreach($tipoInspecciones as $tipoInspeccion)
                                <option value="{{ $tipoInspeccion->id}}">{{ $tipoInspeccion->nombre }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger" id="error-tipoInspeccion"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="giro">{{ __('Giro Comercial') }}</label>
                                <select id="giro" class="form-control" >
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="subgiro">{{ __('Subgiro Comercial') }}</label>
                                <select id="subgiro" class="form-control" >
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-giro"></p>
                            <p class="text-danger" id="error-subgiro"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ejercicioFiscal">{{ __('Año Fiscal') }}</label>
                        <select id="ejercicioFiscal" class="form-control" >
                            <option value="">Seleccionar</option>
                        </select>
                        <p class="text-danger" id="error-ejercicioFiscal"></p>
                    </div>
                    <div class="form-group">
                        <label for="estatus">{{ __('Estatus') }}</label>
                        <select id="estatus" class="form-control" >
                            <option value="">Seleccionar</option>
                        </select>
                        <p class="text-danger" id="error-estatus"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Inspector') }}</button>
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
<!-- Modal para Editar -->
<div class="modal fade" id="editar-inspector" tabindex="-1" role="dialog" aria-labelledby="modal-editar-inspector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-inspector">Editar Inspector</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formulario-gestor" role="form">
                    @csrf
                    <input type="hidden" id="id-edit">
                    <div class="form-group">
                        <label for="nombre-edit">{{ __('Nombre Completo') }}</label>
                        <input id="nombre-edit" type="text" class="form-control" required>
                        <p class="text-danger" id="error-nombre-edit"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidopaterno-edit">{{ __('Apellido Paterno') }}</label>
                                <input id="apellidopaterno-edit" type="text" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidomaterno-edit">{{ __('Apellido Materno') }}</label>
                                <input id="apellidomaterno-edit" type="text" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-apellidopaterno-edit"></p>
                            <p class="text-danger" id="error-apellidomaterno-edit"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="clave-edit">{{ __('Clave') }}</label>
                        <input id="clave-edit" type="text" class="form-control">
                        <p class="text-danger" id="error-clave-edit"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
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
<div class="modal fade" id="editar-estatus" tabindex="-1" role="dialog" aria-labelledby="modal-editar-estatus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-estatus">Estatus Inspector</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formulario-estatus" role="form">
                    @csrf
                    <input type="hidden" id="id-edit-estatus">
                    <div class="form-group">
                        <label for="estatus-edit">{{ __('Estatus') }}</label>
                        <select id="estatus-edit" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="A">Activo</option>
                            <option value="B">Baja</option>
                            <option value="S">Suspendido</option>
                            <option value="V">Vigente</option>
                        </select>

                        <p class="text-danger" id="error-estatus-edit"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-estatus">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
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
<script src="{{ asset('js/inspecciones.js') }}" defer></script>
@endsection