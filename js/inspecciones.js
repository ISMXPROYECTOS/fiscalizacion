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
			'order': [[1, 'desc'], [6, 'desc'], [0, 'desc']],
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
				{data: 'created_at', defaultContent: ''},
				{data: 'fechavence',
					'render': function(data, type, row){

						var month = new Array();
						month[0] = "01";
						month[1] = "02";
						month[2] = "03";
						month[3] = "04";
						month[4] = "05";
						month[5] = "06";
						month[6] = "07";
						month[7] = "08";
						month[8] = "09";
						month[9] = "10";
						month[10] = "11";
						month[11] = "12";

						var hoy = new Date();
						var fecha = new Date(row.fechavence);
						var dia = fecha.getDate();
						var mes = month[fecha.getMonth()];
						var anio = fecha.getFullYear();


						if (row.fechavence == null) {
							return "<span class='badge badge-pill badge-secondary'>No ha sido capturada</span>";
						} else if(fecha.getDate() == hoy.getDate() ){
							return "<span class='badge badge-pill badge-warning'>"+ row.fechavence +"</span> ";
						} else if(fecha > hoy){
							//return "<span class='badge badge-pill badge-success'>"+ dia +"/"+ mes +"/"+ anio +"</span>"
							return "<span class='badge badge-pill badge-success'>"+ row.fechavence +"</span>";
						} else {
							//return "<span class='badge badge-pill badge-danger'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
							return "<span class='badge badge-pill badge-danger'>"+ row.fechavence +"</span> ";
						}
					}
				},
				{data: 'fechaprorroga',
					'render': function(data, type, row){
						var month = new Array();
						month[0] = "01";
						month[1] = "02";
						month[2] = "03";
						month[3] = "04";
						month[4] = "05";
						month[5] = "06";
						month[6] = "07";
						month[7] = "08";
						month[8] = "09";
						month[9] = "10";
						month[10] = "11";
						month[11] = "12";

						var hoy = new Date();
						var fecha = new Date(row.fechaprorroga);
						var dia = fecha.getDate();
						var mes = month[fecha.getMonth()];
						var anio = fecha.getFullYear();

						if (row.fechaprorroga == null) {
							return "<span class='badge badge-pill badge-secondary'>No hay prorroga</span>";

						} else if(fecha.getDate() == hoy.getDate() ){
							return "<span class='badge badge-pill badge-warning'>"+ row.fechaprorroga +"</span> <span class='badge badge-pill badge-warning'> Vence mañana </span>";
						} else if (fecha < hoy) {
							//return "<span class='badge badge-pill badge-danger'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
							return "<span class='badge badge-pill badge-danger'>"+ row.fechaprorroga +"</span>";
						} else {
							//return "<span class='badge badge-pill badge-success'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
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

	function imprimirInspeccionIndividual(){
		$(document).on('click', '.descargar', function(e){
			e.preventDefault();
			$('#descargas').text('');

			var id = $(this).attr('id');
			var inspectores = [];

			$("input[type=checkbox]:checked").each(function(){
				inspectores.push(this.value);
			});

			inspectores = JSON.stringify(inspectores);

			$.ajax({
				url: url + '/pdf/imrpimir-inspeccion-individual/' + id,
				type: 'get',
				success: function (response) {
					$('#creando-pdf-inspecciones').modal('show');
					if (response.code == 200) {
						if (response.tipoInspeccion == 'OIVP') {
							$('#descargas').append(
								"<a href='"+url+'/pdf/descargar-pdf-citatorio-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Citatorios</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-inspeccion-individual/'+id+'/'+inspectores+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Formato Común</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-inspeccion-compleja-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Formato Complejo</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-clausura-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
							);
							
						} else {
							$('#descargas').append(
								"<a href='"+url+'/pdf/descargar-pdf-inspeccion-individual/'+id+'/'+inspectores+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Formato Común</a>" +
								"&nbsp;" +
								"<a href='"+url+'/pdf/descargar-pdf-clausura-individual/'+id+"' class='btn btn-primary btn-lg btn-primary-custom' role='button'>Clausuras</a>"
							);
						}
					} else {
						$('#descargas').text(response.message);
					}
				}
			});
		});
	}

	imprimirInspeccionIndividual();
});