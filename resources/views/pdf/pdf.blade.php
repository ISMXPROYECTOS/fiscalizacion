<h1>Inspecciones</h1>
<table>
	<thead>
		<tr>
			<th>Folio</th>
			<th>Tipo Inspección</th>
			<th>Estatus</th>
			<th>Inspector</th>
			<th>Local</th>
		</tr>
	</thead>
	<tbody>
		@foreach($inspecciones as $inspeccion)
			<tr>
				<td>{{ $inspeccion->folio }}</td>
				<td>{{ $inspeccion->tipoInspeccion->nombre }}</td>
				<td>{{ $inspeccion->estatusInspeccion->nombre }}</td>
				<td>{{ $inspeccion->idinspector }}</td>
				<td>{{ $inspeccion->nombrelocal }}</td>
			</tr>
		@endforeach
	</tbody>
</table>