$(document).ready(function(){

	// Se crea una variable con la ruta raíz del proyecto
	// var url = "http://localhost/fiscalizacion/public";

	$('#error-estatusinspeccion-edit, #error-comentario-edit').addClass('hidden');
	$('#error-estatusinspeccion-edit, #error-comentario-edit').text('');

	function viewData(){
		$('#datatable').DataTable({
			'serverSide': true,
			'processing': true,
			'destroy': true,
			'deferRender': true,
			'pageLength': 10,
			'order': [[1, 'asc'], [6, 'desc'], [0, 'desc']],
			'ajax': url + '/inspecciones/listado',
			'columns': [
				{data: 'folio',
					'render': function(data, type, row){
						return "<a href='#' class='folio-inspeccion' id='"+ row.id +"'>" + data + "</a>"
					}
				},
				{data: 'tipoinspeccion'},
				{data: 'estatusinspeccion_nombre',
					'render': function(data, type, row){
						if (row.estatusinspeccion_clave == 'NA') {
							return "<span class='badge badge-pill badge-secondary'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if(row.estatusinspeccion_clave == 'A'){
							return "<span class='badge badge-pill badge-primary'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if(row.estatusinspeccion_clave == 'Cap'){
							return "<span class='badge badge-pill badge-success'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if (row.estatusinspeccion_clave == 'V') {
							return "<span class='badge badge-pill badge-danger'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if (row.estatusinspeccion_clave == 'Epc') {
							return "<span class='badge badge-pill badge-epc'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if (row.estatusinspeccion_clave == 'Claus') {
							return "<span class='badge badge-pill badge-claus'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if(row.estatusinspeccion_clave == 'M'){
							return "<span class='badge badge-pill badge-multa'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if(row.estatusinspeccion_clave == 'P'){
							return "<span class='badge badge-pill badge-info'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if(row.estatusinspeccion_clave == 'S'){
							return "<span class='badge badge-pill badge-solventada'>"+ row.estatusinspeccion_nombre +"</span>";
						} else if (row.estatusinspeccion_clave == 'C') {
							return "<span class='badge badge-pill badge-warning'>"+ row.estatusinspeccion_nombre +"</span>";
						} else {
							return row.estatusinspeccion_nombre;
						}
					}
				},
				{data: 'inspector', defaultContent: '', orderable: false},
				{data: 'comercio_denominacion', defaultContent: '', orderable: false},
				{data: 'comercio_nombre', defaultContent: '', orderable: false},
				{data: 'created_at',
					'render': function(data, type, row){
						console.log(data);
						if (row.created_at == null) {
							return "<span class='badge badge-pill badge-secondary'>No ha sido capturada</span>";
						} else {
							return "<span class='badge badge-pill badge-primary'>"+ row.created_at +"</span> ";
						}
					}
				},
				{data: 'fechavence',
					'render': function(data, type, row){
						if (row.fechavence == '') {
							return "<span class='badge badge-pill badge-secondary'>No ha sido capturada</span>";
						} else if(row.dia_anterior == row.hoy ){
							return "<span class='badge badge-pill badge-warning'>"+ row.fechavence +"</span> ";
						} else if(row.fechavence > row.hoy){
							return "<span class='badge badge-pill badge-success'>"+ row.fechavence +"</span>";
						} else {
							return "<span class='badge badge-pill badge-danger'>"+ row.fechavence +"</span> ";
						}
					}
				},
				{data: 'fechaprorroga',
					'render': function(data, type, row){
						if (row.fechaprorroga == '') {

							return "<span class='badge badge-pill badge-secondary'>No hay prorroga</span>";
						} else if(row.fechaprorroga == row.hoy ){
							return "<span class='badge badge-pill badge-warning'>"+ row.fechaprorroga +"</span>";
						} else if (row.fechaprorroga > row.hoy) {
							return "<span class='badge badge-pill badge-danger'>"+ row.fechaprorroga +"</span>";
						} else {
							return "<span class='badge badge-pill badge-success'>"+ row.fechaprorroga +"</span>";
						}
					}
				},
				{data: 'cambiarestatus', orderable: false, searchable: false},
				{data: 'imprimir', orderable: false, searchable: false}
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

	function editEstatus(){
		$(document).on('click', '.estatus', function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			 $.ajax({
				url: url + '/inspecciones/editar/' + id,
				type: 'get',
				success: function (response) {
					if (response != ""){
						$('#editar-estatus').modal({backdrop: 'static', keyboard: false})
						$('#editar-estatus').modal('show');
						$('#id-edit-estatusinspeccion').val(response.id);
						//$('#estatusinspeccion-edit').val(response.estatusinspeccion_id);
					}
				}
			});
		});
	}

	editEstatus();

	function updateEstatus(){
		$('#btn-estatus').click(function(){
			var data = {
				'id' : $('#id-edit-estatusinspeccion').val(),
				'estatusinspeccion' : $('#estatusinspeccion-edit').val(),
				'comentario' : $('#comentario-edit').val()
			}
			$.ajax({
				url: url + '/inspecciones/estatus',
				data: data,
				type: 'post',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				success: function (response) {
					$('#editar-estatus').modal('hide');
					$(".formulario-estatus")[0].reset();
					if (response.code == 200){
						$('#actualizacion-correcta').modal('show');
					}else{
						$('#accion-incorrecta').modal('show');
					}
					$('#error-estatusinspeccion-edit').addClass('hidden');
					$('#error-estatusinspeccion-edit').text('');
					viewData();
				},
				error: function(response) {
					$('#error-estatusinspeccion-edit').addClass('hidden');
					$('#error-estatusinspeccion-edit').text('');
					$.each(response.responseJSON.errors, function(i, item) {
						$('#error-'+i+'-edit').removeClass('hidden');
						$('#error-'+i+'-edit').text(item[0]);
					});
				}
			});

		});
	}

	updateEstatus();

	function validarFolioAsignado(){
		$(document).on('click', '.folio-inspeccion', function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			 $.ajax({
				url: url + '/inspecciones/validar-folio-asignado/' + id,
				type: 'get',
				success: function (response) {
					if (response == 'true') {
						window.location.href = url + '/inspecciones/informacion/' + id;
					} else {
						$('#validar-folio-asignado').modal('show');
					}
				}
			});
		});
	}

	validarFolioAsignado();

	function cambiarEstatusAutomaticamente(){
		$.ajax({
			url: url + '/inspecciones/cambio-de-estatus',
			type: 'get',
			success: function (response) {
				if (response) {
					viewData();
				} else {
					$('#validar-folio-asignado').modal('show');
				}
			}
		});
	}

	cambiarEstatusAutomaticamente();

	function modalImprimirInspeccionIndividual(){
		$(document).on('click', '.descargar', function(e){
			e.preventDefault();
			$('#descargas').text('');
			$('#form-group-inspectores').text('');

			var id = $(this).attr('id');

			imprimirInspeccionComunIndividual(id);
			imprimirInspeccionComplejoIndividual(id);

			$.ajax({
				url: url + '/pdf/imprimir-inspeccion-individual/' + id,
				type: 'get',
				success: function (response) {
					console.log(response);
					$('#creando-pdf-inspecciones').modal('show');
					if (response.code == 200) {
						if (response.tipoInspeccion == 'OIF') {
							$('#descargas').append(
								"<a target='_blank' href='' class='btn btn-primary btn-lg btn-primary-custom' role='button' id='formato-comun'>Formato Común</a>" +
								"&nbsp;" +
								"<a target='_blank' href='' class='btn btn-primary btn-lg btn-primary-custom' role='button' id='formato-complejo'>Formato Complejo</a>" +
								"&nbsp;" +
								"<a target='_blank' href='"+url+'/pdf/descargar-pdf-citatorio-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Citatorios</a>" +
								"&nbsp;" +
								"<a target='_blank' href='"+url+'/pdf/descargar-pdf-clausura-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
							);

							$.each(response.inspectores, function( key, value ){
								if (value.id != response.inspeccion.inspector_id) {
									$('#form-group-inspectores').append(
		                            	"<div class='form-check'>"+
		                            		"<input name='inspectores[]' class='form-check-input inspectores' type='checkbox' value='"+value.id+"' id='inspector-"+ value.id +"'/> "+
		                            		"<label class='form-check-label' for='inspector-"+value.id +"'>"+ 
		                            			value.nombre +" "+ value.apellidopaterno +" "+ value.apellidomaterno +
		                            		"</label>"+
		                            	"</div>");
								}
	                        });
	
						} else {
							$('#descargas').append(
								"<a target='_blank' href='#' class='btn btn-primary btn-lg btn-primary-custom' role='button' id='formato-comun'>Formato Común</a>" +
								"&nbsp;" +
								"<a target='_blank' href='"+url+'/pdf/descargar-pdf-clausura-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
							);

							$.each(response.inspectores, function( key, value ){
								if (value.id != response.inspeccion.inspector_id) {
									$('#form-group-inspectores').append(
		                            	"<div class='form-check'>"+
		                            		"<input name='inspectores[]' class='form-check-input inspectores' type='checkbox' value='"+value.id+"' id='inspector-"+ value.id +"'/> "+
		                            		"<label class='form-check-label' for='inspector-"+value.id +"'>"+ 
		                            			value.nombre +" "+ value.apellidopaterno +" "+ value.apellidomaterno +
		                            		"</label>"+
		                            	"</div>");
								}
	                        });
						}
					} else {
						$('#descargas').text(response.message);
					}
				}
			});
		});
	}

	modalImprimirInspeccionIndividual();

	function imprimirInspeccionComunIndividual(id){
		$(document).on('click', '#formato-comun', function(e){

			var inspectores = [];

			$("input[type=checkbox]:checked").each(function(){
				inspectores.push(this.value);
			});

			inspectores = JSON.stringify(inspectores);

			window.location.replace(url+'/pdf/descargar-pdf-inspeccion-individual/'+id+'/'+inspectores)
			//console.log(url);
		});
	}

	imprimirInspeccionComunIndividual();

	function imprimirInspeccionComplejoIndividual(id){
		$(document).on('click', '#formato-complejo', function(e){

			var inspectores = [];

			$("input[type=checkbox]:checked").each(function(){
				inspectores.push(this.value);
			});

			inspectores = JSON.stringify(inspectores);

			window.location.replace(url+'/pdf/descargar-pdf-inspeccion-compleja-individual/'+id+'/'+inspectores)
			//console.log(url);
		});
	}

	imprimirInspeccionComplejoIndividual();

});