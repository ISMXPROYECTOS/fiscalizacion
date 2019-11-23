$(document).ready(function(){

	// Se crea una variable con la ruta raíz del proyecto
	var url = "http://localhost/fiscalizacion/public";

	function cambiarInspector(){
		$(document).on('click', '.cambiar-inspector', function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$.ajax({
				url: url + '/inspecciones/editar/' + id,
				type: 'get',
				success: function (response) {
					if (response != ""){
						$('#cambiar-inspector').modal('show');
						$('#id-cambio-inspector').val(response.id);
						$('#inspector-edit').val(response.inspector_id);
					}
				}
			});
		});
	}

	cambiarInspector();

	function updateInspector(){
		$('#btn-cambiar-inspector').click(function(){
			var data = {
				'id' : $('#id-cambio-inspector').val(),
				'inspector' : $('#inspector-edit').val()
			}
			$.ajax({
				url: url + '/inspecciones/inspector',
				data: data,
				type: 'post',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				success: function (response) {
					$('#cambiar-inspector').modal('hide');
					$('#actualizacion-correcta').modal('show');
					$('#nombre-inspector').text('');

					console.log(response.inspector);

					if (response.inspector) {
						$('#nombre-inspector').text(response.inspector.nombre +' '+ response.inspector.apellidopaterno +' '+ response.inspector.apellidomaterno);
					}else if (response.inspector == null){
						$('#nombre-inspector').text('');
						window.location.replace(url + "/inspecciones");
					}
					$('#error-inspector-edit').addClass('hidden');
					$('#error-inspector-edit').text('');


				},
				error: function(response) {
					$('#error-inspector-edit').addClass('hidden');
					$('#error-inspector-edit').text('');
					$.each(response.responseJSON.errors, function(i, item) {
						$('#error-'+i+'-edit').removeClass('hidden');
						$('#error-'+i+'-edit').text(item[0]);
					});
				}
			});

		});
	}

	updateInspector();

	function busquedaDeComerciosPorNombre(){
		$('#buscar-sm').click(function(){
			var calle = $('#calle').val();

			if (calle == '') {
				var calle = null;
				$.ajax({
					url: url + '/comercios/buscar/nombre/' + calle,
					type: 'get',
					success: function (response) {
						$('#comercios').removeClass('hidden');
						$('#error-sm').addClass('hidden');
						$('#tabla-comercios').addClass('hidden');

						$.each(response, function( key, value ){
							$('#tbody-comercios').append(
								"<tr class='results'>"+
								"<th>"+
								"<div class='form-check'>"+
								"<input class='form-check-input ' type='radio' value='"+ value.id +"' id='comercio-"+ value.id +"' name='establecimiento'>"+
								"</div>"+
								"</th>"+
								"<td>"+ value.licenciafuncionamiento +"</td>"+
								"<td>"+ value.nombreestablecimiento +"</td>"+
								"<td>"+ value.domiciliofiscal +"</td>"+
								"</tr>");
						});
					},
					error: function(response) {
						$('#error-sm').removeClass('hidden');
						$('#error-sm').text(response.responseJSON.mensaje);
					}
				});
			} else {
				$('.results').remove();
				$.ajax({
					url: url + '/comercios/buscar/nombre/' + calle,
					type: 'get',
					success: function (response) {
						$('#comercios').removeClass('hidden');
						$('#tabla-comercios').removeClass('hidden');
						$('#error-results').addClass('hidden');
						$('#error-comercios').addClass('hidden');
						$('#error-sm').addClass('hidden');

						$.each(response, function( key, value ){
							$('#tbody-comercios').append(
								"<tr class='results'>"+
								"<th>"+
								"<div class='form-check'>"+
								"<input class='form-check-input ' type='radio' value='"+ value.id +"' id='comercio-"+ value.id +"' name='establecimiento'>"+
								"</div>"+
								"</th>"+
								"<td>"+ value.licenciafuncionamiento +"</td>"+
								"<td>"+ value.nombreestablecimiento +"</td>"+
								"<td>"+ value.domiciliofiscal +"</td>"+
								"</tr>");
						});
					},
					error: function(response) {
						$('#tabla-comercios').addClass('hidden');
						$('#comercios').removeClass('hidden');
						$('#error-results').removeClass('hidden');
						$('#error-results').text(response.responseJSON.mensaje);
						$('#error-comercios').addClass('hidden');
					}
				});
			}
		});
	}

	busquedaDeComerciosPorNombre();

	function seleccionarTodosDocumentosRequeridosSolicitado(){
		$("#seleccionar-todos-solicitado").click(function() {
			$(".check-solicitado").prop("checked", this.checked);
		});

		$('.check-solicitado').each(function(key, value){
			
	        $('#'+value.id).click(function(){
	            if ($(".check-solicitado").length == $(".check-solicitado:checked").length) {
	                $("#seleccionar-todos-solicitado").prop("checked", true);
	                
	            } else {
	                $("#seleccionar-todos-solicitado").prop("checked", false);
	                
	            }
	        }); 
	    }); 
	}

	seleccionarTodosDocumentosRequeridosSolicitado();

	function seleccionarTodosDocumentosRequeridosExhibido(){
		$("#seleccionar-todos-exhibido").click(function() {
			$(".check-exhibido").prop("checked", this.checked);
		});

		$('.check-exhibido').each(function(key, value){
			
	        $('#'+value.id).click(function(){
	            if ($(".check-exhibido").length == $(".check-exhibido:checked").length) {
	                $("#seleccionar-todos-exhibido").prop("checked", true);
	                
	            } else {
	                $("#seleccionar-todos-exhibido").prop("checked", false);
	                
	            }
	        }); 
	    }); 
	}

	seleccionarTodosDocumentosRequeridosExhibido();

	function mostrarModalParaAgregarProrroga(){
		$('.prorroga').click(function(){
			$('#agregar-prorroga').modal({backdrop: 'static', keyboard: false})
			$('#agregar-prorroga').modal('show');
		});
	}

	mostrarModalParaAgregarProrroga();

	function confirmarAgregarProrroga(){
		$('#btn-agregar-prorroga').click(function(){
			var id = $('#id-agregar-prorroga').val();
			var data = {
				'id' : id,
				'folio-multa' : $('#folio-multa').val(),
				'prorroga' : $('#prorroga').val(),
				'observacion-prorroga' : $('#observacion-prorroga').val()
			}
			$.ajax({
				url: url + '/inspecciones/agregar-prorroga',
				data: data,
				type: 'post',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				success: function (response) {
					if (response.code == 200){
						//$('#formulario-prorroga')[0].reset();
						$('#agregar-prorroga').modal('hide');
						$('#error-folio-multa, #error-prorroga, #error-observacion-prorroga').addClass('hidden');
						$('#error-folio-multa, #error-prorroga, #error-observacion-prorroga').text('');
						$('#actualizacion-correcta').modal('show');
					} else {
						$('#agregar-prorroga').modal('hide');
						$('#actualizacion-correcta').modal('show');
					}
				},
				error: function(response) {
					$('#error-folio-multa, #error-prorroga, #error-observacion-prorroga').addClass('hidden');
					$('#error-folio-multa, #error-prorroga, #error-observacion-prorroga').text('');
					$.each(response.responseJSON.errors, function(i, item) {
						$('#error-'+i).removeClass('hidden');
						$('#error-'+i).text(item[0]);
					});
				}
			});
			
		});
	}

	confirmarAgregarProrroga();

	function mostrarModalParaGenerarMulta(){
		$('.multa').click(function(){
			$('#agregar-multa').modal({backdrop: 'static', keyboard: false})
			$('#agregar-multa').modal('show');
		});
	}

	mostrarModalParaGenerarMulta();

	function confirmarMulta(){
		$('#btn-agregar-multa').click(function(){
			var id = $('#id-agregar-multa').val();
			var data = {
				'id' : id,
				'cantidad-multa' : $('#cantidad-multa').val()
			}
			$.ajax({
				url: url + '/multas/agregar-multa',
				data: data,
				type: 'post',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				success: function (response) {
					if (response.code == 200){
						//$('#formulario-multa')[0].reset();
						$('#agregar-multa').modal('hide');
						$('#error-cantidad-multa').addClass('hidden');
						$('#error-cantidad-multa').text('');
						$('#actualizacion-correcta').modal('show');
					} else {
						$('#agregar-multa').modal('hide');
						$('#ocurrio-un-error').modal('show');
					}
				},
				error: function(response) {
					$('#error-cantidad-multa').addClass('hidden');
					$('#error-cantidad-multa').text('');
					$.each(response.responseJSON.errors, function(i, item) {
						$('#error-'+i).removeClass('hidden');
						$('#error-'+i).text(item[0]);
					});
				}
			});
			
		});
	}

	confirmarMulta();


});