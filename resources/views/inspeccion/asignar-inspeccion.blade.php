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
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
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
                <label for="tipoinspeccion-asignar">Tipo de Inspección</label>
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
        <p class="text-danger mb-0">{{ $errors->first('cantidad-asignar') }}</p>
    </div>
    @php $var = 1; @endphp
    <label for="inspectores-asignar">Inspectores </label>
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
            <button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-asignar">{{ __('Crear Inspecciones') }}</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script src="{{ asset('js/asignar-inspeccion.js') }}"></script>
@endsection