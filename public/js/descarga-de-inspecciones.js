$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	function viewData(){
		$('#datatable').DataTable({
			'serverSide': true,
			'destroy': true,
			'ajax': url + '/pdf/listado',
			'columns': [
				{data: 'folioinicio',
					'render': function ( data, type, row ) {
						return "<a href='#' class='inspecciones' id='"+ row.id +"'>" + row.ejercicio_fiscal.anio + '/' + row.tipo_inspeccion.clave + '/' + row.folioinicio + "</a>";
					}
				},
				{data: 'foliofin',
					'render': function ( data, type, row ) {
						return row.ejercicio_fiscal.anio + '/' + row.tipo_inspeccion.clave + '/' + row.foliofin;
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
			var id = $(this).attr('id');

			$.ajax({
				url: url + '/pdf/validar-folios-asignados/' + id,
				type: 'get',
				success: function (response) {
					if (response == 'true') {
						$('#creando-pdf-inspecciones').modal('show');
						window.location.replace(url + "/pdf/descargar-pdf-inspecciones/" + id);
					} else {
						$('#validar-folios-asignados').modal('show');
						$.each(response, function( key, value ){
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
					{data: 'folio'},
					{data: 'estatus_inspeccion.nombre'}
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
			var id = $('.inspecciones').val();
			console.log(id);
			

		});
	}

	reasignarInspeccionesPorPaquete();

});