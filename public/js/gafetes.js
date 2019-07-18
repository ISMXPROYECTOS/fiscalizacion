$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

    $('#error-gafete-nombre, #error-gafete-apellidopaterno, #error-gafete-apellidomaterno, #error-gafete-clave, #error-gafete-image').addClass('hidden');
    $('#error-gafete-nombre, #error-gafete-apellidopaterno, #error-gafete-apellidomaterno, #error-gafete-clave, #error-gafete-image').text('');

    function informacionGafete(){
    	$(document).on('click', '.generar-gafete', function(){
            var id = $(this).attr('id');
            $.ajax({
                url: url + '/gafetes/registrar/' + id,
                type: 'get',
                success: function (response) {
                    if (typeof response == 'string') {
                        $('#imprimir-gafete').modal('show');
                        $('#btn-descargar').click(function(){
                            pdfGafete(response);
                        });
                    } else {
                        $('#generar-gafete').modal('show');
                        $('#gafete-id').val(response.id);
                        $('#gafete-nombre').val(response.nombre);
                        $('#gafete-apellidopaterno').val(response.apellidopaterno);
                        $('#gafete-apellidomaterno').val(response.apellidomaterno);
                        $('#gafete-clave').val(response.clave);
                    }
                }
            });

        });
    }

    informacionGafete();

    function generarGafete(){
        $(document).on('submit', '#formulario-generar-gafete', function(event){
            event.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: url + '/gafetes/generar',
                method:"POST",
                data: data,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response){
                    $('#generar-gafete').modal('hide');
                    $('#error-gafete-nombre, #error-gafete-apellidopaterno, #error-gafete-apellidomaterno, #error-gafete-clave, #error-gafete-image').addClass('hidden');
                    $('#error-gafete-nombre, #error-gafete-apellidopaterno, #error-gafete-apellidomaterno, #error-gafete-clave, #error-gafete-image').text('');

                    pdfGafete(response.id);
                },

                error: function(response) {
                    $('#error-gafete-nombre, #error-gafete-apellidopaterno, #error-gafete-apellidomaterno, #error-gafete-clave, #error-gafete-image').addClass('hidden');
                    $('#error-gafete-nombre, #error-gafete-apellidopaterno, #error-gafete-apellidomaterno, #error-gafete-clave, #error-gafete-image').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });
                }
            })
        });
    }

    generarGafete();

    function pdfGafete(id){
        window.location.replace(url + "/pdf/ver-gafete/" + id);
    }

});