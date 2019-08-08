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
                    <p class="text-danger mb-0 hidden" id="error-sm">{{ $errors->first('calle') }}</p>
                </div>
            </div>
	    </div>


        <div class="row">
            <div class="col">
                <table class="table table-responsive-lg table-bordered mb-0 hidden" id="comercios-datatable">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="seleccionar-todos">
                                </div>
                            </th>
                            <th>Razon Social</th>
                            <th>Nombre Comercial</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
