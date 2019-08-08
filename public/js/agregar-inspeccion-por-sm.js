$(document).ready(function(){
    var url = "http://localhost/fiscalizacion/public";

    /*$("#seleccionar-todos").click(function() {
        $(".check").attr("checked", this.checked);
        $(".check").prop("checked", this.checked);
    */

    

   

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
                        $.each(response, function( key, value ){
                        
                            /*$('#comercios').append("<div class='form-check results' id='empresa-"+key+"'>"+
                                "<input class='form-check-input' type='checkbox' value='"+ value.id +"' id='"+ value.id +"'>"+
                                "<label class='form-check-label' for='"+ value.id +"'>"+ value.nombreestablecimiento +"</label>"+
                                "</div>"
                            );*/

                            $('#tbody-comercios').append(
                                "<tr>"+
                                    "<th>"+
                                        "<div class='form-check'>"+
                                          "<input class='form-check-input check' type='checkbox' value='"+ value.id +"' id='comercio-"+ value.id +"' name='comercio[]'>"+
                                        "</div>"+
                                    "</th>"+
                                    "<td>"+ value.denominacion +"</td>"+
                                    "<td>"+ value.nombreestablecimiento +"</td>"+
                                    "<td>"+ value.domiciliofiscal +"</td>"+
                                "</tr>");
                        });
                        obtenerFoliosPorSM();
                    }
                }
            });
        });
    }


    busquedaDeComerciosPorSM();



    function obtenerFoliosPorSM(){
       

        $('.check').each(function(key, value){
            $("#seleccionar-todos").click(function() {
                $(".check").prop("checked", this.checked);
                console.log($('.check:checked').length);

                // hacer una petición ajax con la cantidad
            });

            $('#'+value.id).click(function(){
                if ($(".check").length == $(".check:checked").length) {
                    $("#seleccionar-todos").prop("checked", true);
                } else {
                    $("#seleccionar-todos").prop("checked", false);
                }
                //console.log(key, value);
                /*if ($('#'+value.id).is(':checked')) {
                    alert('checked');
                    //$('#'+value.id).attr('checked', true);
                } else {
                    //$('#inspector-'+$(this).val()).attr('checked', false);
                    alert('unchecked');
                    //$('#folios-'+$(this).val()).text('');
                }*/

                // hacer una petición ajax con la cantidad

                console.log($('.check:checked').length);
            }); 
        }); 
    }

    obtenerFoliosPorSM();

    
});