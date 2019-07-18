@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Catalogo de Inspectores</h2>
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-inspector">
    <i class="fas fa-user-plus"></i> Agregar Inspector
</button>
<div class="row">
    <div class="col">
        
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Clave</th>
                    <th>Estatus</th>
                    <th>Editar</th>
                    <th>Cambiar Estatus</th>
                    <th>Gafete</th>
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
                <h3 class="modal-title" id="modal-crear-inspector">Agregar Inspector</h3>
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
                        <p class="text-danger" id="error-nombre"></p>
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

                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-apellidopaterno"></p>
                            <p class="text-danger" id="error-apellidomaterno"></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="clave">{{ __('Clave') }}</label>
                        <input id="clave" type="text" class="form-control" >
                        <p class="text-danger" id="error-clave"></p>
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

                        <p class="text-danger" id="error-estatus"></p>
                    </div>
                    <hr>

                    
                    
                    <div class="form-group row mb-0">

                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">

                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">
                                {{ __('Crear Inspector') }} 
                            </button>
                            
                        </div>
                    </div>
                </form>
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

<!-- Modal para Generar Gafete -->
<div class="modal fade" id="generar-gafete" tabindex="-1" role="dialog" aria-labelledby="modal-generar-gafete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-generar-gafete">Generar Gafete</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario-generar-gafete" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="gafete-id" id="gafete-id">
                    <div class="form-group">
                        <p>Nombre Completo: <b id="gafete-nombre"></b></p>
                        <p>Apellido Paterno: <b id="gafete-apellidopaterno"></b></p>
                        <p>Apellido Materno: <b id="gafete-apellidomaterno"></b></p>
                        <p>Clave de Inspector: <b id="gafete-clave"></b></p>
                    </div>

                    <div class="form-group">
                        <label for="gafete-image">Foto del Inspector (99px x 142px)</label>
                        <input  name="gafete-image" type="file" class="form-control-file" >
                        <p class="text-danger" id="error-gafete-image"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-generar-gafete">{{ __('Crear Gafete') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Imprimir Gafete (PDF) -->
<div class="modal fade" id="imprimir-gafete" tabindex="-1" role="dialog" aria-labelledby="modal-imprimir-gafete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-imprimir-gafete">Imprimir Gafete</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="far fa-address-card"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Este usuario ya cuenta con un gafete</h4>
                        <p>Para generar nuevamente el gafete, da click en el boton "Descargar"</p>
                    </div>
                </div>

                <hr>
                  
                <button type="button" class="btn btn-success pull-right btn-primary-custom" id="btn-descargar" data-dismiss="modal">
                    Descargar
                </button>
                    
                
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
<script src="{{ asset('js/inspectores.js') }}" defer></script>
<script src="{{ asset('js/gafetes.js') }}" defer></script>
@endsection