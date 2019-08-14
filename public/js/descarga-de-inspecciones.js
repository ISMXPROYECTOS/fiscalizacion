$(document).ready(function(){
	var url = "http://localhost/fiscalizacion/public";

	function viewData(){
		$('#datatable').DataTable({
			'serverSide': true,
			'destroy': true,
			'ajax': url + '/pdf/listado',
			'columns': [
				{data: 'folioinicio'},
				{data: 'foliofin'},
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


	$(document).on('click', '.descargar', function(){
		var id = $(this).attr('id');
		window.location.replace(url + "/pdf/descargar-pdf-inspecciones/" + id);
	});
		
	



});