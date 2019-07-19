$(document).ready(function(){
    var url = "http://localhost/fiscalizacion/public";

    function validarActaInspeccion(){
        $(document).on('click', '.imprimir', function(){
            var id = $(this).attr('id');
            $.ajax({
                url: url + '/pdf/validar-acta-inspeccion/' + id,
                type: 'get',
                success: function (response) {

                    //console.log(response.id);
                    if (typeof response == 'string') {
                        alert('no esta asignado');
                    } else {
                        pdfActaInspeccion(response.id);
                    }
                }
            });

        });
    }

    validarActaInspeccion();

    function pdfActaInspeccion(id){
        window.location.replace(url + "/pdf/descargar-acta-inspeccion/" + id);
    }

});