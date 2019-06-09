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
<!-- Modal para Crear -->
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
<!-- Modal para Editar -->
<div class="modal fade" id="editar-inspector" tabindex="-1" role="dialog" aria-labelledby="modal-editar-inspector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-editar-inspector">Editar Gestor</h5>
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
                    </div>
                    <div class="form-group">
                        <label for="clave-edit">{{ __('Clave') }}</label>
                        <input id="clave-edit" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="estatus-edit">{{ __('Estatus') }}</label>
                        <select id="estatus-edit" class="form-control">
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
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block" id="btn-editar">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="registro-correcto" tabindex="-1" role="dialog" aria-labelledby="modal-registro-exitoso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-registro-correcto">Registro Exitoso</h5>
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
<div class="modal fade" id="actualizacion-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-actualizacion-correcta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-actualizacion-correcta">Actualización Exitosa</h5>
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
<div class="modal fade" id="desea-eliminar" tabindex="-1" role="dialog" aria-labelledby="modal-desea-eliminar" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-desea-eliminar">¡Cuidado!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Eliminar registro</h4>
                        <p>¿Estas seguro que deseas eliminar este registro?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary delete-confirm">Si, eliminar</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="eliminacion-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-eliminacion-correcta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-eliminacion-correcta">Eliminación Exitosa</h5>
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
                        <h4>Eliminación Exitosa</h4>
                        <p>La información se ha eliminado correctamente.</p>
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
@endsection