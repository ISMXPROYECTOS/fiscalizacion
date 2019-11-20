$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	$('#error-nombre, #error-clave, #error-diasvencimiento').addClass('hidden');
	$('#error-nombre, #error-clave, #error-diasvencimiento').text('');
	$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').addClass('hidden');
	$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').text('');

	$(document).on('click', '#btn-cancelar', function(e){
		$('#error-nombre, #error-clave, #error-diasvencimiento').addClass('hidden');
		$('#error-nombre, #error-clave, #error-diasvencimiento').text('');
		$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').addClass('hidden');
		$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').text('');

		$('#documentos-editar').text('');
	});

	
	function viewData(){
		$('#datatable').DataTable({
			'serverSide': true,
			'destroy': true,
			'ajax': url + '/tipo-inspecciones/listado',
			'columns': [
			{data: 'clave'},
			{data: 'nombre'},
			{data: 'diasvencimiento'},
			{data: 'created_at'},
			{data: 'btn'},
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
				'emptyTable': 'No se hay registros',
				'zeroRecords': 'No se encontraron registros',
				'infoEmpty': '',
				'infoFiltered': ''
			}
		});
	}

	viewData();

	function saveData(){
		$('#btn-enviar').click(function(){
			var data = $("#formulario-tipo-inspeccion").serializeArray();
			$.ajax({
				url: url + '/tipo-inspecciones/nuevo',
				data: data,
				type: 'post',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				beforeSend: function(){
					$('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando...');
				},
				success: function (response) {
					$('#btn-enviar').text('Crear Tipo de Inspección');
					$("#formulario-tipo-inspeccion")[0].reset();
					$('#crear-tipo-inspeccion').modal('hide');
					$('#registro-correcto').modal('show');
					$('#error-nombre, #error-clave, #error-diasvencimiento').addClass('hidden');
					$('#error-nombre, #error-clave, #error-diasvencimiento').text('');
					viewData();
				},
				error: function(response) {
					$('#btn-enviar').text('Crear Tipo de Inspección');
					$('#error-nombre, #error-clave, #error-diasvencimiento').addClass('hidden');
					$('#error-nombre, #error-clave, #error-diasvencimiento').text('');
					$.each(response.responseJSON.errors, function(i, item) {
						$('#error-'+i).removeClass('hidden');
						$('#error-'+i).text(item[0]);
					});
				}
			});

		});
	}

	saveData();

	function editData(){
		$(document).on('click', '.editar', function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$('#documentos-editar').text('');
			$.ajax({
				url: url + '/tipo-inspecciones/editar/' + id,
				type: 'get',
				success: function (response) {
					//console.log(response);
					if (response.status == 200){
						$('#editar-tipo-inspeccion').modal({backdrop: 'static', keyboard: false});
						$('#editar-tipo-inspeccion').modal('show');
						$('#id-edit').val(response.tipoInspeccion.id);
						$('#nombre-edit').val(response.tipoInspeccion.nombre);
						$('#clave-edit').val(response.tipoInspeccion.clave);
						$('#diasvencimiento-edit').val(response.tipoInspeccion.diasvencimiento);

						if (response.documentacionPorTipoDeInspeccion.length > 0) {
							for (var i = 0; i < response.documentacionPorTipoDeInspeccion.length; i++) {
								for (var a = 0; a < response.documentacionRequerida.length; a++) {
									if ((i+1) == response.documentacionPorTipoDeInspeccion.length) {
										if (response.documentacionPorTipoDeInspeccion[i].documentacionrequerida_id == response.documentacionRequerida[a].id) {
											$('#documentos-editar').append(
												"<div class='form-check'>"+
												"<input class='form-check-input checkbox-documento' checked='checked' type='checkbox' value='"+ response.documentacionRequerida[a].id +"'"+
												"id='documento-editar-"+response.documentacionRequerida[a].id+"' name='documentos-requeridos[]'>"+
												"<label class='form-check-label' for='documento-editar-"+response.documentacionRequerida[a].id+"'>"+
												response.documentacionRequerida[a].nombre+
												"</label>"+
												"</div>"
												);
										} else {
											$('#documentos-editar').append(
												"<div class='form-check'>"+
												"<input class='form-check-input checkbox-documento' type='checkbox' value='"+ response.documentacionRequerida[a].id +"'"+
												"id='documento-editar-"+response.documentacionRequerida[a].id+"' name='documentos-requeridos[]'>"+
												"<label class='form-check-label' for='documento-editar-"+response.documentacionRequerida[a].id+"'>"+
												response.documentacionRequerida[a].nombre+
												"</label>"+
												"</div>"
												);
										}
									} else {
										if (response.documentacionPorTipoDeInspeccion[i].documentacionrequerida_id == response.documentacionRequerida[a].id) {
											$('#documentos-editar').append(
												"<div class='form-check'>"+
												"<input class='form-check-input checkbox-documento' checked='checked' type='checkbox' value='"+ response.documentacionRequerida[a].id +"'"+
												"id='documento-editar-"+response.documentacionRequerida[a].id+"' name='documentos-requeridos[]'>"+
												"<label class='form-check-label' for='documento-editar-"+response.documentacionRequerida[a].id+"'>"+
												response.documentacionRequerida[a].nombre+
												"</label>"+
												"</div>"
												);
											i++;
										} else {
											$('#documentos-editar').append(
												"<div class='form-check'>"+
												"<input class='form-check-input checkbox-documento'  type='checkbox' value='"+ response.documentacionRequerida[a].id +"'"+
												"id='documento-editar-"+response.documentacionRequerida[a].id+"' name='documentos-requeridos[]'>"+
												"<label class='form-check-label' for='documento-editar-"+response.documentacionRequerida[a].id+"'>"+
												response.documentacionRequerida[a].nombre+
												"</label>"+
												"</div>"
												);
										}
									}
								}
							}
						} else {
							for (var a = 0; a < response.documentacionRequerida.length; a++) {
								$('#documentos-editar').append("<div class='form-check'>"+
									"<input class='form-check-input checkbox-documento'  type='checkbox' value='"+ response.documentacionRequerida[a].id +"'"+
									"id='documento-editar-"+response.documentacionRequerida[a].id+"' name='documentos-requeridos[]'>"+
									"<label class='form-check-label' for='documento-editar-"+response.documentacionRequerida[a].id+"'>"+
									response.documentacionRequerida[a].nombre+
									"</label></div>");
							}
						}
					} else {
						$('#registro-correcto').modal('show');
					}
				}
			});
		});
	}

	editData();

	function updateData(){
		$('#btn-editar').click(function(){
			var data = $("#formulario-tipo-inspeccion-editar").serializeArray();
			
			$.ajax({
				url: url + '/tipo-inspecciones/actualizar',
				data: data,
				type: 'post',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				beforeSend: function(){
					$('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
				},
				success: function (response) {
					$('#btn-editar').text('Guardar');
					$('#editar-tipo-inspeccion').modal('hide');
					$('#actualizacion-correcta').modal('show');
					$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').addClass('hidden');
					$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').text('');
					viewData();
				},
				error: function(response) {
					$('#btn-editar').text('Guardar');
					$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').addClass('hidden');
					$('#error-nombre-edit, #error-clave-edit, #error-diasvencimiento-edit').text('');
					$.each(response.responseJSON.errors, function(i, item) {
						$('#error-'+i+'-edit').removeClass('hidden');
						$('#error-'+i+'-edit').text(item[0]);
					});
				}
			});

		});
	}

	updateData();

	function seleccionarTodos(){
		$("#seleccionar-todos").click(function() {
	        $(".check").prop("checked", this.checked);
	    });

		$('.check').each(function(key, value){
			console.log('#'+value.id);
	        $('#'+value.id).click(function(){
	            if ($(".check").length == $(".check:checked").length) {
	                $("#seleccionar-todos").prop("checked", true);
	                
	            } else {
	                $("#seleccionar-todos").prop("checked", false);
	                
	            }
	        }); 
	    }); 
	}

	seleccionarTodos();

	
	
});