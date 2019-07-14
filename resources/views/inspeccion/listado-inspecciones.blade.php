@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Inspecciones</h2>
</header>
<!--<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-inspeccion">
    <i class="fas fa-user-plus"></i> Agregar Inspección
</button>
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#asignar-inspeccion">
    <i class="fas fa-user-plus"></i> Asignar Inspecciones
</button> -->
<a class="btn btn-success mb-3" href="{{ route('pdf') }}">
    <i class="fas fa-file-pdf"></i> PDF
</a>
<div class="row">
    <div class="col">
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Tipo de Inspección</th>
                    <th>Estatus</th>
                    <th>Inspector</th>
                    <th>Nombre del Local</th>
                    <th>Editar</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!-- Modal para Crear -->
<div class="modal fade" id="crear-inspeccion" tabindex="-1" role="dialog" aria-labelledby="modal-crear-inspeccion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-crear-inspeccion">Agregar Inspecciones</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="prueba"></div>
                <form id="formulario-inspeccion" role="form">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="">Cantidad</label>
                        </div>
                        <div class="col-md-3">
                            <label for="">Año</label>
                        </div>
                        <div class="col-md-4">
                            <label for="">Tipo de Inspección</label>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn btn-success btn-sm" id="add-row"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="row mb-3 duplicados" id="inspecciones">
                        <div class="col-md-3">
                            <select name="cantidad[]" class="form-control" id="cantidad">
                                <option value="">Seleccionar</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="300">300</option>
                            </select>
                            <p class="text-danger" id="error-cantidad"></p>
                        </div>
                        <div class="col-md-3">
                            <select name="ejerciciofiscal[]" class="form-control" id="ejerciciofiscal">
                                <option value="">Seleccionar</option>
                                @foreach($ejerciciosFiscales as $ejercicioFiscal)
                                    <option value="{{ $ejercicioFiscal->id}}">{{ $ejercicioFiscal->anio }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger" id="error-ejerciciofiscal"></p>
                        </div>
                        <div class="col-md-4">
                            <select name="tipoinspeccion[]" class="form-control" id="tipoinspeccion">
                                <option value="">Seleccionar</option>
                                @foreach($tiposInspecciones as $tipoInspeccion)
                                    <option value="{{ $tipoInspeccion->id}}">{{ $tipoInspeccion->nombre }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger" id="error-tipoinspeccion"></p>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn btn-danger" id="remove"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>
                    <div id="new-row"></div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Inspecciones') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para asignar -->
<div class="modal fade " id="asignar-inspeccion" tabindex="-1" role="dialog" aria-labelledby="modal-crear-inspeccion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-crear-inspeccion">Asignar Inspecciones</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="prueba"></div>
                <form id="formulario-asignacion" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="ejerciciofiscal-asignar">Año</label>
                        @foreach ($ejerciciosFiscales as $ejercicioFiscal)
                            @if ($ejercicioFiscal->anio == date('Y'))
                            <input type="text" class="form-control" disabled="" value="{{ $ejercicioFiscal->anio }}">
                            <input type="hidden" name="ejerciciofiscal-asignar" id="ejerciciofiscal-asignar" 
                            value="{{ $ejercicioFiscal->anio }}">
                            @endif
                        @endforeach
                        <p class="text-danger" id="error-ejerciciofiscal-asignar"></p>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="form-group">
                            <label for="tipoinspeccion-asignar">Tipo de Inspección</label>
                            <select name="tipoinspeccion-asignar" class="form-control" id="tipoinspeccion-asignar">
                                <option value="">Seleccionar</option>
                                @foreach($tiposInspecciones as $tipoInspeccion)
                                    <option value="{{ $tipoInspeccion->id}}">
                                        {{ $tipoInspeccion->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-danger" id="error-tipoinspeccion-asignar"></p>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cantidadexistente-asignar">Cantidad existente</label>
                                <input type="text" class="form-control" id="cantidadexistente-asignar" disabled>
                            </div>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cantidad-asignar">Cantidad a Asignar</label>
                        <select name="cantidad-asignar" class="form-control" id="cantidad-asignar">
                            <option value="">Seleccionar</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="300">300</option>
                        </select>
                        <p class="text-danger" id="error-cantidad-asignar"></p>
                    </div>
                    @php
                       $var = 0; 
                    @endphp
                    <label for="inspectores-asignar">Inspectores </label>
                    @foreach($inspectores as $inspector)
                        @if($inspector->estatus == 'A' or $inspector->estatus == 'V')
                            <div class="form-check">
                                <input name="inspectores-asignar[]" class="form-check-input" type="checkbox" value="{{ $inspector->id}}" id="inspector-{{ $var }}">
                                <label class="form-check-label" for="inspector-{{ $var }}">
                                    {{ $inspector->nombre }} {{ $inspector->apellidopaterno }}
                                </label>
                            </div> 
                            <p class="text-danger" id="error-inspectores-asignar"></p>
                        @endif
                    @php
                       $var++; 
                    @endphp
                    @endforeach
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-asignar">{{ __('Crear Inspecciones') }}</button>
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
<div class="modal fade" id="editar-inspeccion" tabindex="-1" role="dialog" aria-labelledby="modal-editar-inspeccion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-inspeccion">Editar Inspector</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formulario-inspeccion" role="form">
                    @csrf
                    <input type="hidden" id="id-edit">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="inspector-edit">{{ __('Inspector') }}</label>
                                <select id="inspector-edit" class="form-control">
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
                                <label for="gestor-edit">{{ __('Gestor') }}</label>
                                <select id="gestor-edit" class="form-control">
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
                            <p class="text-danger" id="error-inspector-edit"></p>
                            <p class="text-danger" id="error-gestor-edit"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="tipoinspeccion-edit">{{ __('Tipo de Inspección') }}</label>
                                <select id="tipoinspeccion-edit" class="form-control">
                                    <option value="" selected="selected">Seleccionar</option>
                                    @foreach($tiposInspecciones as $tipoInspeccion)
                                        <option value="{{ $tipoInspeccion->id}}">{{ $tipoInspeccion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="formavalorada-edit">{{ __('Forma Valorada') }}</label>
                                <select id="formavalorada-edit" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($formasValoradas as $formaValorada)
                                        <option value="{{ $formaValorada->id}}">{{ $formaValorada->nombreencargado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-tipoinspeccion-edit"></p>
                            <p class="text-danger" id="error-formavalorada-edit"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="giro-edit">{{ __('Giro Comercial') }}</label>
                                <select id="giro-edit" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($giros as $giro)
                                        <option value="{{ $giro->id}}">{{ $giro->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="subgiro-edit">{{ __('Subgiro Comercial') }}</label>
                                <select id="subgiro-edit" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($subgiros as $subgiro)
                                        <option value="{{ $subgiro->id}}">{{ $subgiro->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-giro-edit"></p>
                            <p class="text-danger" id="error-subgiro-edit"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="ejerciciofiscal-edit">{{ __('Ejercicio Fiscal') }}</label>
                                <select id="ejerciciofiscal-edit" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($ejerciciosFiscales as $ejercicioFiscal)
                                        <option value="{{ $ejercicioFiscal->id}}">{{ $ejercicioFiscal->anio }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="estatus-edit">{{ __('Estatus') }}</label>
                                <select id="estatus-edit" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($estatusInspecciones as $estatus)
                                        <option value="{{ $estatus->id}}">{{ $estatus->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-ejerciciofiscal-edit"></p>
                            <p class="text-danger" id="error-estatus-edit"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="colonia-edit">{{ __('Colonia') }}</label>
                        <select id="colonia-edit" class="form-control">
                            <option value="">Seleccionar</option>
                            @foreach($colonias as $colonia)
                                <option value="{{ $colonia->id}}">{{ $colonia->nombrecolonia }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger" id="error-colonia-edit"></p>
                    </div>
                    <div class="form-group">
                        <label for="local-edit">{{ __('Nombre del Local') }}</label>
                        <input id="local-edit" type="text" class="form-control">
                        <p class="text-danger" id="error-local-edit"></p>
                    </div>
                    <div class="form-group">
                        <label for="domicilio-edit">{{ __('Domicilio') }}</label>
                        <input id="domicilio-edit" type="text" class="form-control">
                        <p class="text-danger" id="error-domicilio-edit"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="encargado-edit">{{ __('Encargado') }}</label>
                                <input id="encargado-edit" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="puestoencargado-edit">{{ __('Puesto del Encargado') }}</label>
                                <input id="puestoencargado-edit" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-encargado-edit"></p>
                            <p class="text-danger" id="error-puestoencargado-edit"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="diasvence-edit">{{ __('Días de vencimiento') }}</label>
                                <input id="diasvence-edit" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="fechavence-edit">{{ __('Fecha de vencimiento') }}</label>
                                <input id="fechavence-edit" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger" id="error-diasvence-edit"></p>
                            <p class="text-danger" id="error-fechavence-edit"></p>
                        </div>
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
                    <input type="hidden" id="id-edit-estatusinspeccion">
                    <div class="form-group">
                        <label for="estatusinspeccion-edit">{{ __('Estatus') }}</label>
                        <select id="estatusinspeccion-edit" class="form-control">
                            <option value="">Seleccionar</option>
                            @foreach($estatusInspecciones as $estatus)
                                <option value="{{ $estatus->id }}">{{ $estatus->nombre }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger" id="error-estatusinspeccion-edit"></p>
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