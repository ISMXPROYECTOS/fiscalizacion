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

			console.log(calle);
			
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
								"<input class='form-check-input check' type='checkbox' value='"+ value.id +"' id='comercio-"+ value.id +"' name='establecimiento'>"+
								"</div>"+
								"</th>"+
								"<td>"+ value.licenciafuncionamiento +"</td>"+
								"<td>"+ value.nombreestablecimiento +"</td>"+
								"<td>"+ value.domiciliofiscal +"</td>"+
								"</tr>");
						});

						//obtenerFoliosPorSM();
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
								"<input class='form-check-input check' type='checkbox' value='"+ value.id +"' id='comercio-"+ value.id +"' name='establecimiento'>"+
								"</div>"+
								"</th>"+
								"<td>"+ value.licenciafuncionamiento +"</td>"+
								"<td>"+ value.nombreestablecimiento +"</td>"+
								"<td>"+ value.domiciliofiscal +"</td>"+
								"</tr>");
						});

						//obtenerFoliosPorSM();
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
	}

	seleccionarTodosDocumentosRequeridosSolicitado();

	function seleccionarTodosDocumentosRequeridosExhibido(){
		$("#seleccionar-todos-exhibido").click(function() {
			$(".check-exhibido").prop("checked", this.checked);
		});
	}

	seleccionarTodosDocumentosRequeridosExhibido();

});