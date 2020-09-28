@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Asignar Inspecciones</h2>
</header>

<form method="POST" action="{{ route('asignar-inspecciones') }}" id="formulario-asignar-inspeccion">
    @csrf
    <div class="form-group">
        <label for="ejerciciofiscal-asignar">Ejercicio Fiscal</label>
        <select name="ejerciciofiscal-asignar" class="form-control" id="ejerciciofiscal-asignar">
            <option value="">Seleccionar</option>
            @foreach ($ejerciciosFiscales as $ejercicioFiscal)
                @if($ejercicioFiscal->activo == 1)
                    <option value="{{ $ejercicioFiscal->id}}">{{ $ejercicioFiscal->anio }}</option>
                @endif
            @endforeach
        </select>
        <p class="text-danger mb-0">{{ $errors->first('ejerciciofiscal-asignar') }}</p>
    </div>
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="form-group">
                <label for="tipoinspeccion-asignar">Tipo</label>
                <select name="tipoinspeccion-asignar" class="form-control" id="tipoinspeccion-asignar">
                    <option value="">Seleccionar</option>
                    @foreach($tiposInspecciones as $tipoInspeccion)
                    <option value="{{ $tipoInspeccion->id}}">
                        {{ $tipoInspeccion->nombre }}
                    </option>
                    @endforeach
                </select>
                <p class="text-danger mb-0">{{ $errors->first('tipoinspeccion-asignar') }}</p>
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
            <option value="1">1</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="150">150</option>
            <option value="200">200</option>
        </select>
        <p class="text-danger mb-0">{{ $errors->first('cantidad-asignar') }}</p>
    </div>
    @php $var = 1; @endphp
    <label for="inspectores-asignar">Fiscales</label>
    <p class="text-danger mb-0" id="error-inspectores-asignar"></p>
    <p class="text-danger mb-0">{{ $errors->first('inspectores-asignar.*') }}</p>
    @foreach($inspectores as $inspector)
        @if($inspector->estatus == 'A' or $inspector->estatus == 'V')
            <div class="form-check">
                <input name="inspectores-asignar[]" class="form-check-input" type="checkbox" value="{{ $inspector->id}}" id="inspector-{{ $var }}">
                <label class="form-check-label" for="inspector-{{ $var }}">
                    {{ $inspector->nombre }} {{ $inspector->apellidopaterno }}
                </label>
                <b><p class="folios-reset mb-0" id="folios-{{ $var }}"></p></b>
            </div>
        @endif
        @php $var++; @endphp
    @endforeach
    <br>
    <div class="form-group row mb-0">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-asignar">{{ __('Asignar') }}</button>
        </div>
    </div>
</form>

@if (session('status'))
    <!-- Alerta de asignacion exitosa -->
    <div class="modal fade" id="asignacion-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-asignacion-correcta" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-asignacion-correcta">Asignación Exitosa</h3>
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
                            <h4>Asignación Exitosa</h4>
                            <p>{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <!-- Alerta no hay inspecciones -->
    <div class="modal fade" id="inspecciones-insuficientes" tabindex="-1" role="dialog" aria-labelledby="modal-inspecciones-insuficientes" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-inspecciones-insuficientes">Inspecciones insuficientes</h3>
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
                            <h4>Inspecciones insuficientes</h4>
                            <p>{{ session('error') }}</p>
                            <ul id="folios-no-asignados">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection

@section('scripts')
<script>
    $('#asignacion-correcta').modal('show');
    $('#inspecciones-insuficientes').modal('show');
</script>
<script src="{{ asset('js/asignar-inspeccion.js') }}"></script>
@endsection