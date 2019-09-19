@extends('layouts.app')
@section('content')
<header class="page-header">
	<h2>Comercios SOAP</h2>
</header>
<div class="row">
	<div class="col">
		<table class="table table-sm table-responsive-lg table-bordered table-striped mb-0" id="datatable">
			<thead>
				<tr>
					<th>CP</th>
					<th>Clave colonia</th>
					<th>Entidad Federativa</th>
					<th>Localidad</th>
					<th>Municipio</th>
					<th>Domicilio Fiscal</th>
					<th>Fecha Inicio Operación</th>
					<th>Folio</th>
					<th>Habitaciones</th>
					<th>Licencia de funcionamiento Folio</th>
					<th>Licencia de funcionamiento Id</th>
					<th>Licencia de funcionamiento Status</th>
					<th>Nombre Colonia</th>
					<th>Nombre Entidad Federativa</th>
					<th>Nombre Localidad</th>
					<th>Nombre Municipio</th>
					<th>Num Ext</th>
					<th>Num Int</th>
					<th>Predio Catastral</th>
					<th>RFC Persona</th>
					<th>Razon social</th>
					<th>Calle</th>
					<th>Nombre comercial</th>
					<th>Propietario</th>
					<th>Propietario id</th>
				</tr>
			</thead>
			<tbody>
				@foreach($comercios as $comercio)
				<tr>
					<td>{{ $comercio->CodigoPostalColonia }}</td>
					<td>{{ $comercio->CveColonia }}</td>
					<td>{{ $comercio->CveEntidadFederativa }}</td>
					<td>{{ $comercio->CveLocalidad }}</td>
					<td>{{ $comercio->CveMunicipio }}</td>
					<td>{{ $comercio->Domicilio_Fiscal }}</td>
					<td>{{ $comercio->FechaInicioOperacion }}</td>
					<td>{{ $comercio->Folio }}</td>
					<td>{{ $comercio->Habitaciones }}</td>
					<td>{{ $comercio->LicenciasFuncionamientoFolio }}</td>
					<td>{{ $comercio->LicenciasFuncionamientoId }}</td>
					<td>{{ $comercio->LicenciasFuncionamientoStatus }}</td>
					<td>{{ $comercio->NombreColonia }}</td>
					<td>{{ $comercio->NombreEntidadFederativa }}</td>
					<td>{{ $comercio->NombreOficialLocalidad }}</td>
					<td>{{ $comercio->NombreOficialMunicipio }}</td>
					<td>{{ $comercio->NumExt }}</td>
					<td>{{ $comercio->NumInt }}</td>
					<td>{{ $comercio->PredioCveCatastral }}</td>
					<td>{{ $comercio->RFCPersona }}</td>
					<td>{{ $comercio->RazonSocialPersona }}</td>
					<td>{{ $comercio->calle }}</td>
					<td>{{ $comercio->nombrecomercial }}</td>
					<td>{{ $comercio->propietario }}</td>
					<td>{{ $comercio->propietario_id }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection