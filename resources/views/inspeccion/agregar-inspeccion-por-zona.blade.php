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
<form method="POST" action="{{ route('crear-inspeccion-por-sm') }}" id="formulario-crear-inspeccion-por-sm">
    @csrf
    <div class="row">
        <div class="col-md-3">
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
                <label>Buscar por Supermanzana</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="calle" id="calle" placeholder="ej. SM-095">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="buscar-sm">Buscar</button>
                    </div>
                </div>
                <p class="text-danger mb-0" id="error-sm">{{ $errors->first('calle') }}</p>
            </div>
        </div>
    </div>
    <div id="comercios" class="hidden mt-3">

        <p class="text-danger mb-0" id="error-comercios"></p>
        <p class=" mb-0" id="error-results"></p>
        <table class="table table-sm" id="tabla-comercios">
            <thead class="thead-dark">
                <tr>
                    <th>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="seleccionar-todos">
                      </div>
                    </th>
                    <th>RAZÓN SOCIAL</th>
                    <th>NOMBRE COMERCIAL</th>
                    <th>UBICACIÓN</th>
              </tr>
          </thead>
          <tbody id="tbody-comercios">

          </tbody>
      </table>

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

@if (session('idfv'))
<!--<script>
    var url = "http://localhost/fiscalizacion/public";
    window.location.replace(url + "/pdf/descargar-acta-inspeccion-multiple/" + {{ session('idfv') }});
</script>-->
@endif

<script src="{{ asset('js/agregar-inspeccion-por-sm.js') }}" defer></script>
@endsection