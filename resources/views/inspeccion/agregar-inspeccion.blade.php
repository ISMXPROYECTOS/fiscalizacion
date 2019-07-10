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
                </div>
                
            </div>
			
			<div class="col-md-4">
                <div class="form-group">
                    <label>Ejercicio Fiscal</label>
                    <select name="ejerciciofiscal" class="form-control" id="ejerciciofiscal">
                    <option value="">Seleccionar</option>
                    @foreach($ejerciciosFiscales as $ejercicioFiscal)
                        <option value="{{ $ejercicioFiscal->id}}">{{ $ejercicioFiscal->anio }}</option>
                    @endforeach
                </select>
                </div>
				
			</div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Cantidad</label>
                    <select name="cantidad" class="form-control" id="cantidad">
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
                </div>
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
<script src="{{ asset('js/agregar-inspeccion.js') }}" defer></script>
@endsection
