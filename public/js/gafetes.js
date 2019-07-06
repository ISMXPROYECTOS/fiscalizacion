$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	$(document).on('click', '.generar-gafete', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: url + '/gafetes/registrar/' + id,
            type: 'get',
            success: function (response) {
                if (response != ""){
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
            success:function(data){

            }
        })
    });
});