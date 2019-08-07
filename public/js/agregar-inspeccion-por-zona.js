$(document).ready(function(){
    var url = "http://localhost/fiscalizacion/public";

    function buscarPorSupermanzana(){
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
                        $('#deseleccionar-todos').addClass('hidden');
                        $('#comercios').append("<p id='no-results'>No se encontraron resultados</p>");
                    } else {
                        $('#seleccionar-todos').removeClass('hidden');
                        $('#deseleccionar-todos').removeClass('hidden');
                        $('#no-results').remove();
                        $.each(response, function( key, value ) {
                        
                            $('#comercios').append("<div class='form-check results' id='empresa-"+key+"'>"+
                                "<input class='form-check-input' type='checkbox' value='"+ value.id +"' id='"+ value.id +"'>"+
                                "<label class='form-check-label' for='"+ value.id +"'>"+ value.nombreestablecimiento +"</label>"+
                                "</div>"
                            );
                        });
                    }  
                }
            });
        });
    }

    buscarPorSupermanzana();
    
});