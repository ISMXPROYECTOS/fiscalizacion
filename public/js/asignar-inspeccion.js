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

        	$('#folios-'+$(this).val()).append('');

			var data = $("#formulario-asignar-inspeccion").serializeArray();
			
			$.ajax({
	            url: url + '/inspecciones/obtener-folios-inspecciones',
	            data: data,
	            type: 'post',
            	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	            success: function (response) {
	            	$.each(response, function(i, item) {
	            		$('#folios-'+response[i].inspector).append('Folio inicio: '+response[i].folioinicio+' Folio final: '+response[i].foliofin)
                        //$('#folio-inicio-'+response[i].inspector).text(response[i].folioinicio);
                        //$('#folio-fin-'+response[i].inspector).text(response[i].foliofin);
                    }); 
	            } 
	        });

		});
    });

});
