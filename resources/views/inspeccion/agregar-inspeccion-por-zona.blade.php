@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Agregar Inspecciones Por Zona</h2>
</header>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
    <div class="row">
        <div class="col-md-4">
            <h4 >Folio inicio: <b id="folio-inicio"></b></h4>
        </div>
        <div class="col-md-4">
            <h4 >Folio fin: <b id="folio-fin"></b></h4>
        </div>
    </div>
    <hr>
	<form method="POST" action="{{ route('crear-inspeccion') }}" id="formulario-crear-inspeccion">
        @csrf
		<div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tipo de Inspección</label>
                    <select name="tipoinspeccion" class="form-control" id="tipoinspeccion">
                        <option value="">Seleccionar</option>
                        @foreach($tiposInspecciones as $tipoInspeccion)
                            <option value="{{ $tipoInspeccion->id}}">{{ $tipoInspeccion->nombre }}</option>
                        @endforeach
                    </select>
                    <p class="text-danger mb-0">{{ $errors->first('tipoinspeccion') }}</p>   
                </div>
            </div>
			<div class="col-md-4">
                <div class="form-group">
                    <label>Ejercicio Fiscal</label>
                    <select name="ejerciciofiscal" class="form-control" id="ejerciciofiscal" >
                        <option value="">Seleccionar</option>
                        @foreach($ejerciciosFiscales as $ejercicioFiscal)
                            @if($ejercicioFiscal->activo == 1)
                                <option value="{{ $ejercicioFiscal->id}}">{{ $ejercicioFiscal->anio }}</option>
                            @endif
                        @endforeach
                    </select>
                    <p class="text-danger mb-0">{{ $errors->first('ejerciciofiscal') }}</p>
                </div>
			</div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Buscar por Supermanzana</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="calle" id="calle" placeholder="ej. SM-095">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="buscar-sm">Buscar</button>
                      </div>
                    </div>
                    <p class="text-danger mb-0">{{ $errors->first('calle') }}</p>
                </div>
            </div>
	    </div>

        <label id="comercios-label" class="hidden">Comercios</label>
        <div id="comercios" class="hidden">
            <button type="button" class="btn btn-secondary btn-sm mb-2" id="seleccionar-todos">Seleccionar todos</button>
            <button type="button" class="btn btn-secondary btn-sm mb-2" id="deseleccionar-todos">Deseleccionar todos</button>
        </div>
        

        <br>
        <div class="form-group row mb-0">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Inspecciones') }}</button>
            </div>
        </div>         
    </form>
@endsection
@section('scripts')
<script src="{{ asset('js/agregar-inspeccion-por-zona.js') }}" defer></script>
@endsection
