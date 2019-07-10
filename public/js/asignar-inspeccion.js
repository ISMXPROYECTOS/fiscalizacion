$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	$('#tipoinspeccion-asignar').change(function(){
		if ($('#tipoinspeccion-asignar').val() == '') {
			$('#cantidadexistente-asignar').val('');
		} else {
			obtenerTotalInspecciones();
		}

		
	});

	function obtenerTotalInspecciones(){
		var idtipo = $('#tipoinspeccion-asignar').val();

        $.ajax({
            url: url + '/inspecciones/obtener-total-inspecciones/' + idtipo,
            type: 'get',
            success: function (response) {
                $('#cantidadexistente-asignar').val(response);
            } 
        });
	}


    $(".form-check-input").each(function(){

        $('#inspector-'+$(this).val()).click(function(){

        	var data = {
				'tipoinspeccion' :$('#tipoinspeccion-asignar').val(),
				'cantidad' : $('#cantidad-asignar').val(),
				'ejerciciofiscal' : $('#ejerciciofiscal-asignar').val(),
				'inspectores-asignar': JSON.stringify($('[name="inspectores-asignar[]"]').serializeArray())
			}

			console.log(data);

			$.ajax({
	            url: url + '/inspecciones/obtener-folios-inspecciones',
	            data: data,
	            type: 'post',
            	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	            success: function (response) {

	            	console.log('#folio-inicio-'+$(this).val())
	                //$('#folio-inicio-'+$(this).val()).text(response.folioinicio);
	                //$('#folio-fin-'+$(this).val()).text(response.foliofin);
	            } 
	        });
		});

        
    });

	

	

});