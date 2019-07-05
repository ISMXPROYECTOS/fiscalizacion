$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	$(document).on('click', '.generar-gafete', function(){

		var data = {
			'id' : $(this).attr('id')	
		} 

        $.ajax({
            url: url + '/gafetes/crear',
            data: data,
            type: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                
            },
            error: function(response) {


            }
        });

    });
});