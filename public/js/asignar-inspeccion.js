$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	$('#btn-asignar').click(function(){
		$('#btn-asignar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Asignando Inspecciones...');
	});

	$('#tipoinspeccion-asignar, #ejerciciofiscal-asignar').change(function(){
		if ($('#tipoinspeccion-asignar').val() == '' || $('#ejerciciofiscal-asignar').val() == '') {
			$('#cantidadexistente-asignar').val('');
		} else {
			obtenerTotalInspecciones();
		}
	});

	function obtenerTotalInspecciones(){
		var idtipo = $('#tipoinspeccion-asignar').val();
		var anio = $('#ejerciciofiscal-asignar').val();


        $.ajax({
            url: url + '/inspecciones/obtener-total-inspecciones/' + idtipo +'/'+ anio,
            type: 'get',
            success: function (response) {
                $('#cantidadexistente-asignar').val(response);
            } 
        });
	}

	$('#tipoinspeccion-asignar, #ejerciciofiscal-asignar, #cantidad-asignar').change(function(){
		$('input[type=checkbox]').prop('checked',false);
		$('#error-inspectores-asignar').text('');
		$('.folios-reset').text('');
	});
	

    $(".form-check-input").each(function(i){
		$('#inspector-'+$(this).val()).click(function(){

			if ($('#inspector-'+$(this).val()).is(':checked')) {
				//alert('checked');
				//$('#inspector-'+$(this).val()).attr('checked', true);

				obtenerFoliosInspecciones();
			} else {
				//$('#inspector-'+$(this).val()).attr('checked', false);
				//alert('unchecked');
				obtenerFoliosInspecciones();
				$('#folios-'+$(this).val()).text('');
			}
		});

	});
	
	function obtenerFoliosInspecciones(){
		var data = $("#formulario-asignar-inspeccion").serializeArray();
		
	
		$.ajax({
            url: url + '/inspecciones/obtener-folios-inspecciones',
            data: data,
            type: 'post',
        	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
            	$('#error-inspectores-asignar').text('');
            	$.each(response, function(i, item) {
            		//console.log(response);
            		$('#folios-'+response[i].inspector).text('Folio inicio: '+response[i].folioinicio+' Folio final: '+response[i].foliofin)
                    //$('#folio-inicio-'+response[i].inspector).text(response[i].folioinicio);
                    //$('#folio-fin-'+response[i].inspector).text(response[i].foliofin);
                }); 
            },
            error: function(response){
            	$('#error-inspectores-asignar').text(response.responseJSON.mensaje);
            } 
        });	
	}

});
