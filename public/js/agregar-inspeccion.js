$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	$('#btn-enviar').click(function(){
		$('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Inspecciones...');
	});

	$('#ejerciciofiscal').attr('disabled', '');
	$('#cantidad').attr('disabled', '');
	
	$('#tipoinspeccion').change(function(){
		if ($('#tipoinspeccion').val() != '') {
			$('#ejerciciofiscal').removeAttr('disabled');
		} 

		$("#ejerciciofiscal").val('');
		$("#cantidad").val('');
		$('#folio-inicio').text('');
        $('#folio-fin').text('');
		
	});

	$('#ejerciciofiscal').change(function(){
		$('#cantidad').removeAttr('disabled');
	});
	
	$('#cantidad').change(function(){

		var data = {
			'tipoinspeccion' :$('#tipoinspeccion').val(),
			'cantidad' : $('#cantidad').val(),
			'ejerciciofiscal' : $('#ejerciciofiscal').val()
		}

        $.ajax({
            url: url + '/inspecciones/obtener-folios',
            data: data,
            type: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                $('#folio-inicio').text(response.folioinicio);
                $('#folio-fin').text(response.foliofin);
            }
        });
    });

});