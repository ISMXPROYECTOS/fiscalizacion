$(document).ready(function(){

	//var url = "http://localhost/fiscalizacion/public";

	function viewData(){
		$('#datatable').DataTable({
			'serverSide': true,
			'processing': true,
			'destroy': true,
			'deferRender': true,
			'pageLength': 10,
			'order': [[2, 'desc'], [0, 'asc']],
			'ajax': url + '/pdf/listado',
			'columns': [
				{data: 'folioinicio',
					'render': function ( data, type, row ) {
						return "<a href='#' class='inspecciones' id='"+ row.id +"'>"+ row.folioinicio +"</a>";
					}
				},
				{data: 'foliofin'},
				{data: 'created_at',
					'render': function ( data, type, row ) {
						if (row.created_at == null) {
							return "<span class='badge badge-pill badge-secondary'>No ha sido capturada</span>";
						} else {
							return "<span class='badge badge-pill badge-primary'>"+ row.created_at +"</span> ";
						}
					}
				},
				{data: 'descargar'}
			],
			'language': {
				'info': 'Total de registros _TOTAL_',
				'paginate': {
					'next': 'Siguiente',
					'previous': 'Anterior',
				},
				'lengthMenu': 'Mostrar _MENU_ registros',
				'loadingRecords': 'Cargando...',
				'processing': 'Procesando...',
				'emptyTable': 'No se encontraron registros',
				'zeroRecords': 'No se encontraron registros',
				'infoEmpty': '',
				'infoFiltered': ''
			}
		});
	}

	viewData();

	/*function validarActaInspeccion(){
		$(document).on('click', '.imprimir', function(){
			var id = $(this).attr('id');
			$.ajax({
				url: url + '/pdf/validar-acta-inspeccion/' + id,
				type: 'get',
				success: function (response) {
					//console.log(response.id);
					if (typeof response == 'string') {
						alert('no esta asignado');
					} else {
						pdfActaInspeccion(response.id);
					}
				}
			});

		});
	}

	validarActaInspeccion();*/

	function validarFoliosAsignados(){
		$(document).on('click', '.descargar', function(e){
			e.preventDefault();
			$('#folios-no-asignados').text('');
			$('#descargas').text('');
			var id = $(this).attr('id');

			$.ajax({
				url: url + '/pdf/validar-folios-asignados/' + id,
				type: 'get',
				success: function (response) {
					if (response.code == 200) {
						$('#creando-pdf-inspecciones').modal('show');
						if (response.FormaValorada.tipo_inspeccion.clave == 'OIF') {
							$('#descargas').append(
								"<a href='"+url+'/pdf/descargar-pdf-inspecciones/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Formato Común</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-inspecciones-complejas/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Formato Complejo</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-citatorios/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Citatorios</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-clausuras/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
							);
						} else {
							$('#descargas').append(
								"<a href='"+ url + '/pdf/descargar-pdf-inspecciones/' + id +"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Formato Común</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-clausuras/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
							);
						}
						//window.location.replace(url + "/pdf/descargar-pdf-inspecciones/" + id);
					} else {
						$('#validar-folios-asignados').modal('show');
						$.each(response.inspecciones, function( key, value ){
							$('#folios-no-asignados').append(
								"<li>"+ value.folio +"</li>"
							);
						});
					}
				}
			});
		});
	}

	validarFoliosAsignados();
	
	function inspeccionesPorPaquete(){
		$(document).on('click', '.inspecciones', function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$('#inspecciones').modal({backdrop: 'static', keyboard: false})
			$('#inspecciones').modal('show');
			$('#inspecciones-datatable').DataTable({
				'serverSide': true,
				'destroy': true,
				'order': [ 0, 'asc' ],
				'ajax': url + '/pdf/inspecciones/' + id,
				'columns': [
					{data: 'folio',
						'render': function ( data, type, row ) {
							return row.folio + "<input type='hidden' id='idFormaValoradaReasignar' value='" + row.formavalorada_id + "'>";
						}
					},
					{data: 'estatus_inspeccion.nombre',
						'render': function(data, type, row){
							if (row.estatus_inspeccion.clave == 'NA') {
								return "<span class='badge badge-pill badge-secondary'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if(row.estatus_inspeccion.clave == 'A'){
								return "<span class='badge badge-pill badge-primary'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if(row.estatus_inspeccion.clave == 'Cap'){
								return "<span class='badge badge-pill badge-success'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if (row.estatus_inspeccion.clave == 'V') {
								return "<span class='badge badge-pill badge-danger'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if (row.estatus_inspeccion.clave == 'Epc') {
								return "<span class='badge badge-pill badge-epc'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if(row.estatus_inspeccion.clave == 'M'){
								return "<span class='badge badge-pill badge-multa'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if(row.estatus_inspeccion.clave == 'P'){
								return "<span class='badge badge-pill badge-info'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if(row.estatus_inspeccion.clave == 'S'){
								return "<span class='badge badge-pill badge-solventada'>"+ row.estatus_inspeccion.nombre +"</span>";
							} else if (row.estatus_inspeccion.clave == 'C') {
								return "<span class='badge badge-pill badge-warning'>"+ row.estatus_inspeccion.nombre +"</span>";
							}
						}
					},
				],
				'language': {
					'info': 'Total de registros _TOTAL_',
					'paginate': {
						'next': 'Siguiente',
						'previous': 'Anterior',
					},
					'lengthMenu': 'Mostrar _MENU_ registros',
					'loadingRecords': 'Cargando...',
					'processing': 'Procesando...',
					'emptyTable': 'No se encontraron registros',
					'zeroRecords': 'No se encontraron registros',
					'infoEmpty': '',
					'infoFiltered': ''
				}
			});
		});
	}

	inspeccionesPorPaquete();

	function reasignarInspeccionesPorPaquete(){
		$('#reasignar').click(function(){
			var id = $('#idFormaValoradaReasignar').val();
			$.ajax({
				url: url + '/pdf/inspecciones/reasignar/' + id,
				type: 'get',
				beforeSend: function(){
					$('#reasignar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Reasignando...');
				},
				success: function (response) {
					if (response.code == 200) {
						$('#reasignar').text('Reasignar');
						$('#inspecciones').modal('hide');
						$('#actualizacion-reasignar').modal('show');
					} else {
						console.log(response);
					}
				}
			});
		});
	}

	reasignarInspeccionesPorPaquete();

});