@extends('layouts.app')
@section('content')
<header class="page-header">
	<h2>Descargar Inspecciones</h2>
</header>
<div class="row">
	<div class="col">
		<table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
			<thead>
				<tr>
					<th>Folio Inicio</th>
					<th>Folio Fin</th>
					<th>Descargar PDF</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>


<!-- Alerta de Generando PDF -->
<div class="modal fade" id="creando-pdf-inspecciones" tabindex="-1" role="dialog" aria-labelledby="modal-registro-exitoso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-registro-correcto">Las inspecciones se han creado</h3>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <div class="spinner-border text-success" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-text">
                        <h4>Descargando</h4>
                        <p>En breve el archivo PDF sera descargado</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<!-- Alerta de no asignado -->
<div class="modal fade" id="validar-folios-asignados" tabindex="-1" role="dialog" aria-labelledby="modal-validar-folios-asignados" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-validar-folios-asignados">Folios no asignados</h3>
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
                        <h4>Hay folios sin asignar</h4>
                        <p>Los siguientes folios no han sido asignados</p>

                        <div id="folios-no-asignados-div">
                            <ul id="folios-no-asignados">
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/descarga-de-inspecciones.js') }}" defer></script>
@endsection