$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

    $('#error-gafete-image').addClass('hidden');
    $('#error-gafete-image').text('');

    $(document).on('click', '#btn-cancelar', function(e){

        $('#error-gafete-image').addClass('hidden');
        $('#error-gafete-image').text('');
    });

    function informacionGafete(){
    	$(document).on('click', '.generar-gafete', function(){
            var id = $(this).attr('id');
            $.ajax({
                url: url + '/gafetes/registrar/' + id,
                type: 'get',
                success: function (response) {
                    if (typeof response == 'string') {
                        $('#imprimir-gafete').modal({backdrop: 'static', keyboard: false})
                        $('#imprimir-gafete').modal('show');
                        $('#btn-descargar').click(function(){
                            $('#btn-descargar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Descargando...');
                            $('#descargando-gafete').modal('show');
                            pdfGafete(response);
                        });
                    } else {
                        $('#generar-gafete').modal({backdrop: 'static', keyboard: false})
                        $('#generar-gafete').modal('show');
                        $('#gafete-id').val(response.id);
                        $('#gafete-nombre').text(response.nombre);
                        $('#gafete-apellidopaterno').text(response.apellidopaterno);
                        $('#gafete-apellidomaterno').text(response.apellidomaterno);
                        $('#gafete-clave').text(response.clave);
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
                beforeSend: function(){
                    $('#btn-generar-gafete').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Gafete...');
                },
                success:function(response){

                    $('#btn-generar-gafete').text('Crear Gafete');
                    $("#formulario-generar-gafete")[0].reset();
                    $('#generar-gafete').modal('hide');
                    $('#creando-gafete').modal('show');
                    $('#error-gafete-image').addClass('hidden');
                    $('#error-gafete-image').text('');

                    pdfGafete(response.id);
                },

                error: function(response) {
                    $('#btn-generar-gafete').text('Crear Gafete');
                    $('#error-gafete-image').addClass('hidden');
                    $('#error-gafete-image').text('');
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