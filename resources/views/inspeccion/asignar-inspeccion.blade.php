@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Agregar Inspecciones</h2>
</header>

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-error">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('asignar-inspecciones') }}" id="formulario-crear-inspeccion">
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
    @php $var = 1; @endphp
    <label for="inspectores-asignar">Inspectores </label>
    <p class="text-danger" id="error-inspectores-asignar"></p>

    @foreach($inspectores as $inspector)
    @if($inspector->estatus == 'A' or $inspector->estatus == 'V')
    <div class="form-check">
        <input name="inspectores-asignar[]" class="form-check-input" type="checkbox" value="{{ $inspector->id}}" id="inspector-{{ $var }}">
        <label class="form-check-label" for="inspector-{{ $var }}">
            {{ $inspector->nombre }} {{ $inspector->apellidopaterno }}
        </label>
        <div class="row">
            <div class="col-md-4">
                <h5>Folio inicio: <b id="folio-inicio-{{ $var }}"></b></h5>
            </div>
            <div class="col-md-4">
                <h5>Folio fin: <b id="folio-fin-{{ $var }}"></b></h5>
            </div>
        </div>
    </div>
    @endif
    @php $var++; @endphp
    @endforeach
    
    <br>
    <div class="form-group row mb-0">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-asignar">{{ __('Crear Inspecciones') }}</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script src="{{ asset('js/asignar-inspeccion.js') }}" defer></script>
@endsection