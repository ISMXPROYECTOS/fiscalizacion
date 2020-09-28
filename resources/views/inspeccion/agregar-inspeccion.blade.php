@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Generar Requerimientos</h2>
</header>


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
            <div class="col-md-3">
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="tipoinspeccion" class="form-control" id="tipoinspeccion"  >
                        <option value="">Seleccionar</option>
                        @foreach($tiposInspecciones as $tipoInspeccion)
                            <option value="{{ $tipoInspeccion->id}}">{{ $tipoInspeccion->nombre }}</option>
                        @endforeach
                    </select>
                    <p class="text-danger mb-0">{{ $errors->first('tipoinspeccion') }}</p>   
                </div>
            </div>
			<div class="col-md-3">
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
            <div class="col-md-3">
                <div class="form-group">
                    <label>Encargado</label>
                    <select name="encargadoGob" class="form-control" id="encargadoGob">
                        <option value="">Seleccionar</option>
                        @foreach($encargadosGob as $encargadoGob)
                            @if($encargadoGob->activo == 1)
                                <option value="{{ $encargadoGob->id}}">{{ $encargadoGob->nombre }} {{ $encargadoGob->apellidopaterno }} {{ $encargadoGob->apellidomaterno }} </option>
                            @endif
                        @endforeach
                    </select>
                    <p class="text-danger mb-0">{{ $errors->first('encargadoGob') }}</p>   
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Cantidad</label>
                    <select name="cantidad" class="form-control" id="cantidad" >
                        <option value="">Seleccionar</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                    </select>
                    <p class="text-danger mb-0">{{ $errors->first('cantidad') }}</p>
                </div>
            </div>
            
	    </div>
        <br>
        <div class="form-group row mb-0">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear') }}</button>
                
            </div>
        </div>         
    </form>
@endsection

@if (session('status'))
    <!-- Alerta de creacion correcta -->
    <div class="modal fade" id="creacion-inspecciones-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-creacion-inspecciones-correcta" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-creacion-inspecciones-correcta">Creación Exitosa</h3>
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
                            <h4>Creación Exitosa</h4>
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

@section('scripts')
<script>
    $('#creacion-inspecciones-correcta').modal('show')
</script>
<script src="{{ asset('js/agregar-inspeccion.js') }}" defer></script>
@endsection
