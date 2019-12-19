@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Inspecciones</h2>
</header>
<div class="row">
    <div class="col">
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Tipo de Inspección</th>
                    <th>Estatus</th>
                    <th>Inspector</th>
                    <th>Razón social</th>
                    <th>Nombre del Local</th>
                    <th>Fecha Generada</th>
                    <th>Fecha vence</th>
                    <th>Fecha prorroga</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal para Editar Estatus -->
<div class="modal fade" id="editar-estatus" tabindex="-1" role="dialog" aria-labelledby="modal-editar-estatus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-estatus">Estatus Inspector</h3>
            </div>
            <div class="modal-body">
                <form class="formulario-estatus" role="form">
                    @csrf
                    <input type="hidden" id="id-edit-estatusinspeccion">
                    <div class="form-group">
                        <label for="estatusinspeccion-edit">{{ __('Estatus') }}</label>
                        <select id="estatusinspeccion-edit" class="form-control">
                            <option value="">Seleccionar</option>
                            @foreach($estatusInspecciones as $estatus)
                                @if($estatus->clave == 'S' || $estatus->clave == 'C' || $estatus->clave == 'Claus')
                                    <option value="{{ $estatus->id }}">{{ $estatus->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                        <p class="text-danger" id="error-estatusinspeccion-edit"></p>
                    </div>
                    <div class="form-group">
                        <label for="comentario-edit">Comentario</label>
                        <input type="text" id="comentario-edit" class="form-control">
                        <p class="text-danger" id="error-comentario-edit"></p>
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

<!-- Alerta de no asignado -->
<div class="modal fade" id="validar-folio-asignado" tabindex="-1" role="dialog" aria-labelledby="modal-validar-folio-asignado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-validar-folio-asignado">Folio no asignado</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Este folio no ha sido asignado</h4>
                        <p>Favor de realizar la asignación antes de continuar</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Alerta de no asignado -->
<div class="modal fade" id="accion-incorrecta" tabindex="-1" role="dialog" aria-labelledby="modal-accion-incorrecta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-accion-incorrecta">No se puede realizar la accion</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Este folio ya ha sido solventado</h4>
                        <p>No se puede realizar la acción por que el folio ya ha sido solventado</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="{{ asset('js/inspecciones.js') }}" defer></script>
@endsection