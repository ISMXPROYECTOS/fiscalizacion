$(document).ready(function(){

	// Se crea una variable con la ruta raíz del proyecto
	//var url = "http://localhost/fiscalizacion/public";

	$('#error-estatusinspeccion-edit, #error-comentario-edit').addClass('hidden');
	$('#error-estatusinspeccion-edit, #error-comentario-edit').text('');

	function viewData(){
		$('#datatable').DataTable({
			'serverSide': true,
			'processing': true,
			'destroy': true,
			'deferRender': true,
			'pageLength': 10,
			'ajax': url + '/inspecciones/listado',
			'columns': [
				{data: 'folio',
					'render': function(data, type, row){
						return "<a href='#' class='folio-inspeccion' id='"+ row.id +"'>" + data + "</a>"
					}
				},
				{data: 'tipoinspeccion_id',
					'render': function ( data, type, row ) {
						return (row.tipo_inspeccion.clave);
					}
				},
				{data: 'estatusinspeccion_id',
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
						} else if (row.estatus_inspeccion.clave == 'Claus') {
							return "<span class='badge badge-pill badge-claus'>"+ row.estatus_inspeccion.nombre +"</span>";
						} else if(row.estatus_inspeccion.clave == 'M'){
							return "<span class='badge badge-pill badge-multa'>"+ row.estatus_inspeccion.nombre +"</span>";
						} else if(row.estatus_inspeccion.clave == 'P'){
							return "<span class='badge badge-pill badge-info'>"+ row.estatus_inspeccion.nombre +"</span>";
						} else if(row.estatus_inspeccion.clave == 'S'){
							return "<span class='badge badge-pill badge-solventada'>"+ row.estatus_inspeccion.nombre +"</span>";
						} else if (row.estatus_inspeccion.clave == 'C') {
							return "<span class='badge badge-pill badge-warning'>"+ row.estatus_inspeccion.nombre +"</span>";
						} else {
							return row.estatus_inspeccion.nombre;
						}
					}, orderable: false, searchable: false
				},
				{data: 'inspector.nombre', defaultContent: '', orderable: false},
				{data: 'comercio.denominacion', defaultContent: '', orderable: false},
				{data: 'comercio.nombreestablecimiento', defaultContent: '', orderable: false},
				{data: 'created_at',
					'render': function(data, type, row){
						var fecha = new Date(row.created_at);
						var meses = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

						var dia = fecha.getUTCDate();
						var mes = fecha.getUTCMonth();
						var anio = fecha.getUTCFullYear();
						//console.log(dia + '/' + meses[mes] + '/' + anio);

						if (row.created_at == null) {
							return "<span class='badge badge-pill badge-secondary'>No ha sido capturada</span>";
						} else {
							return "<span class='badge badge-pill badge-primary'>"+ dia + '/' + meses[mes] + '/' + anio +"</span> ";
						}
					}
				},
				{data: 'fechavence',
					'render': function(data, type, row){
						var fechavence = new Date(row.fechavence);
						var hoy = new Date();
						var meses = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

						var dia = fechavence.getUTCDate();
						var mes = fechavence.getUTCMonth();
						var anio = fechavence.getUTCFullYear();
						//console.log(dia + '/' + meses[mes] + '/' + anio);

						if (row.fechavence == null) {
							return "<span class='badge badge-pill badge-secondary'>No ha sido capturada</span>";
						} else if(fechavence.getUTCDate() == hoy.getUTCDate() ){
							return "<span class='badge badge-pill badge-warning'>"+ dia + '/' + meses[mes] + '/' + anio +"</span> ";
						} else if(fechavence.toISOString() > hoy.toISOString()){
							//return "<span class='badge badge-pill badge-success'>"+ dia +"/"+ mes +"/"+ anio +"</span>"
							return "<span class='badge badge-pill badge-success'>"+ dia + '/' + meses[mes] + '/' + anio +"</span>";
						} else {
							//return "<span class='badge badge-pill badge-danger'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
							return "<span class='badge badge-pill badge-danger'>"+ dia + '/' + meses[mes] + '/' + anio +"</span> ";
						}
					}
				},
				{data: 'fechaprorroga',
					'render': function(data, type, row){
						var fechaprorroga = new Date(row.fechaprorroga);
						var hoy = new Date();
						var meses = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

						var dia = fechaprorroga.getUTCDate();
						var mes = fechaprorroga.getUTCMonth();
						var anio = fechaprorroga.getUTCFullYear();

						if (row.fechaprorroga == null) {
							return "<span class='badge badge-pill badge-secondary'>No hay prorroga</span>";
						} else if(fechaprorroga.getUTCDate() == hoy.getUTCDate() ){
							return "<span class='badge badge-pill badge-warning'>"+ dia + '/' + meses[mes] + '/' + anio +"</span>";
						} else if (fechaprorroga.toISOString() < hoy.toISOString()) {
							//return "<span class='badge badge-pill badge-danger'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
							return "<span class='badge badge-pill badge-danger'>"+ dia + '/' + meses[mes] + '/' + anio +"</span>";
						} else {
							//return "<span class='badge badge-pill badge-success'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
							return "<span class='badge badge-pill badge-success'>"+ dia + '/' + meses[mes] + '/' + anio +"</span>";
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
								"<a href='javascript:void(0)' class='btn btn-primary btn-lg btn-primary-custom' role='button' id='formato-comun'>Formato Común</a>" +
								"&nbsp;" +
								"<a href='javascript:void(0)' class='btn btn-primary btn-lg btn-primary-custom' role='button' id='formato-complejo'>Formato Complejo</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-citatorio-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Citatorios</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-clausura-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
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
								"<a href='javascript:void(0)' class='btn btn-primary btn-lg btn-primary-custom' role='button' id='formato-comun'>Formato Común</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-clausura-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
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