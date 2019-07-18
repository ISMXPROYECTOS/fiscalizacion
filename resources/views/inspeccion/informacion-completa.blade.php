@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Inspección {{ $inspeccion->folio }}</h2>
</header>
<div class="row">
    <div class="col-md-6">
        <h3>Datos comerciales</h3>
        <div>
            <label for="">Nombre del Lugar: </label>
            <label for="">{{ $inspeccion->nombrelocal }}</label>
        </div>
        <div>
            <label for="">Domicilio: </label>
            <label for="">{{ $inspeccion->domicilio }}</label>
        </div>
        <div>
            <label for="">Hora de la inspección: </label>
            <label for="">{{ $inspeccion->horarealizada }}</label>
        </div>
        <div>
            <label for="">Encargado: </label>
            <label for="">{{ $inspeccion->nombreencargado }}</label>
        </div>
        <div>
            <label for="">Puesto del encargado:</label>
            <label for="">{{ $inspeccion->cargoencargado }}</label>
        </div>
        <div>
            <label for="">Identificación del encargado: </label>
            <label for="">{{ $inspeccion->identificacion }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <h3>Requisitos Presentados</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3>Gestor</h3>
        @if(is_object($inspeccion->gestor))
            <div>
                <label for="nombre">Nombre: </label>
                <label for="">{{ $inspeccion->gestor->nombre }}</label>
            </div>
            <div>
                <label for="apellidos">Apellidos: </label>
                <label for="">{{ $inspeccion->gestor->apellidopaterno }} {{ $inspeccion->gestor->apellidomaterno }}</label>
            </div>
            <div>
                <label for="telefono">Teléfono: </label>
                <label for="">{{ $inspeccion->gestor->telefono }}</label>
            </div>
            <div>
                <label for="celular">Celular: </label>
                <label for="">{{ $inspeccion->gestor->celular }}</label>
            </div>
            <div>
                <label for="correo">Correo: </label>
                <label for="">{{ $inspeccion->gestor->correoelectronico }}</label>
            </div>
            <div>
                <label for="ine"0>INE: </label>
                <label for="">{{ $inspeccion->gestor->ine }}</label>
            </div>
            <div>
                <label for="estatus">Estatus: </label>
                <label for="">{{ $inspeccion->gestor->estatus }}</label>
            </div>
        @endif
    </div>
    <div class="col-md-4">
        <h3>Prorroga</h3>
        <div>
            <label for="">Días de Prorroga: </label>
            <label for="">{{ $inspeccion->diasvence }} Días</label>
        </div>
        <div>
            <label for="">Fecha de vencimiento: </label>
            <label for="">{{ $inspeccion->fechavence }}</label>
        </div>
    </div>
    <div class="col-md-4">
        <h3>Estatus</h3>
        @if(is_object($inspeccion->estatusInspeccion))
            <div>
                <label for="">Estatus: </label>
                <label for="">{{ $inspeccion->estatusInspeccion->nombre }}</label>
            </div>
        @endif
    </div>
</div>

@endsection