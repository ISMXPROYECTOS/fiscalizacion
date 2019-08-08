$(document).ready(function(){
    var url = "http://localhost/fiscalizacion/public";

    $("#seleccionar-todos").click(function() {
        $(".check").prop("checked", this.checked);
    });

    $('#ejerciciofiscal').attr('disabled', '');
    $('#calle').attr('disabled', '');

    $('#tipoinspeccion').change(function(){
        if ($('#tipoinspeccion').val() != '') {
            $('#ejerciciofiscal').removeAttr('disabled');
        } 

        $("#ejerciciofiscal").val('');
        $("#calle").val('');
        $('#folio-inicio').text('');
        $('#folio-fin').text('');
        
    });

    $('#ejerciciofiscal').change(function(){
        $('#calle').removeAttr('disabled');
    });


    function busquedaDeComerciosPorSM(){
 
        $('#buscar-sm').click(function(){
            var calle = $('#calle').val();
            $( ".results").remove();
            $.ajax({
                url: url + '/comercios/buscar/supermanzana/' + calle,
                type: 'get',
                success: function (response) {

                    $('#comercios-label').removeClass('hidden');
                    $('#comercios').removeClass('hidden');
                    $('#no-results').remove();
                    if (response == '') {
                        $('#seleccionar-todos').addClass('hidden');
                        $('#comercios').append("<p id='no-results'>No se encontraron resultados</p>");
                    } else {
                        $('#seleccionar-todos').removeClass('hidden');
                        
                        $('#no-results').remove();
                        $.each(response, function( key, value ) {
                        
                            $('#comercios').append("<div class='form-check results' id='empresa-"+key+"'>"+
                                "<input class='form-check-input' type='checkbox' value='"+ value.id +"' id='"+ value.id +"'>"+
                                "<label class='form-check-label' for='"+ value.id +"'>"+ value.nombreestablecimiento +"</label>"+
                                "</div>"
                            );
                        });
                    }
                    obtenerFoliosPorSM()
                }
            });
        });
    }


    busquedaDeComerciosPorSM();

    function obtenerFoliosPorSM(){
        $(".form-check-input").each(function(i){
            
            if ($(this).checked == true) {
                console.log('hola');
            }
        });
    }
});