$(document).ready(function(){
    var url = "http://localhost/fiscalizacion/public";

    function buscarPorSupermanzana(){
        $('#buscar-sm').click(function(){
            var calle = $('#calle').val();
            
            $.ajax({
                url: url + '/comercios/buscar/supermanzana/' + calle,
                type: 'get',
                success: function (response) {
                    $('#comercios-label').removeClass('hidden');
                    $('#comercios').removeClass('hidden');

                    $.each(response, function( key, value ) {
                        $('#comercios').append("<div class='form-check' id='empresa-"+key+"'><input class='form-check-input' type='checkbox' value='"+ value.id +"' id='"+ value.id +"'><label class='form-check-label' for='"+ value.id +"'>"+ value.nombreestablecimiento +"</label></div>");
                    });
                }
            });
        });
    }

    buscarPorSupermanzana();
    
});