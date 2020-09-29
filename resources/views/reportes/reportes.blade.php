@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Reportes</h2>
</header>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Fiscalizadores</h5>
                <p class="card-text">Generar reporte de fiscalizadores</p>
                <a href="#" class="btn btn-primary btn-primary-custom">Generar</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Inspecciones</h5>
                <p class="card-text">Generar reporte de inspecciones</p>
                <a href="#" class="btn btn-primary btn-primary-custom">Generar</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection