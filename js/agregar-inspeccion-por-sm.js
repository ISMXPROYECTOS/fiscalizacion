$(document).ready(function(){
    //var url = "http://localhost/fiscalizacion/public";

    /*$("#seleccionar-todos").click(function() {
        $(".check").attr("checked", this.checked);
        $(".check").prop("checked", this.checked);
    */

    $('#formulario-crear-inspeccion-por-sm').keypress(function(e){   
        if(e == 13){
          return false;
        }
    });

    $('#formulario-crear-inspeccion-por-sm').keypress(function(e){
        if(e.which == 13){
          return false;
        }
    });
    
    $('#error-comercios').addClass('hidden');
    $('#error-results').addClass('hidden');
    $('#error-sm').addClass('hidden');

    $('#ejerciciofiscal').attr('disabled', '');
    $('#encargadoGob').attr('disabled', '');
    $('#calle').attr('disabled', '');

    $('#tipoinspeccion').change(function(){
        if ($('#tipoinspeccion').val() != '') {
            $('#ejerciciofiscal').removeAttr('disabled');
        } 

        $("#ejerciciofiscal").val('');
        $("#encargadoGob").val('');
        $("#calle").val('');
        $('#folio-inicio').text('');
        $('#folio-fin').text('');
        $('.results').remove();
        $("#seleccionar-todos").prop("checked", false);
        
    });

    $('#ejerciciofiscal').change(function(){

        if ($('#ejerciciofiscal').val() != '') {
            $('#encargadoGob').removeAttr('disabled');
        }

        $("#encargadoGob").val('');
        $("#calle").val('');
        $('#folio-inicio').text('');
        $('#folio-fin').text('');
        $('.results').remove();
        $("#seleccionar-todos").prop("checked", false);
    });

    $('#encargadoGob').change(function(){
        $('#calle').removeAttr('disabled');
    });

    function busquedaDeComerciosPorSM(){
        $('#buscar-sm').click(function(){
            var calle = $('#calle').val();
            
            if (calle == '') {
                var calle = null;
                $.ajax({
                    url: url + '/comercios/buscar/supermanzana/' + calle,
                    type: 'get',
                    success: function (response) {
                        $('#comercios').removeClass('hidden');
                        $('#error-sm').addClass('hidden');
                        $('#tabla-comercios').addClass('hidden');

                        $.each(response, function( key, value ){
                            $('#tbody-comercios').append(
                                "<tr class='results'>"+
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
                    },
                    error: function(response) {
                        $('#error-sm').removeClass('hidden');
                        $('#error-sm').text(response.responseJSON.mensaje);
                    }
                });
            } else {
                $('.results').remove();
                $.ajax({
                    url: url + '/comercios/buscar/supermanzana/' + calle,
                    type: 'get',
                    success: function (response) {
                        $('#comercios').removeClass('hidden');
                        $('#tabla-comercios').removeClass('hidden');
                        $('#error-results').addClass('hidden');
                        $('#error-comercios').addClass('hidden');
                        $('#error-sm').addClass('hidden');

                        $.each(response, function( key, value ){
                            $('#tbody-comercios').append(
                                "<tr class='results'>"+
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
                    },
                    error: function(response) {
                        $('#tabla-comercios').addClass('hidden');
                        $('#comercios').removeClass('hidden');
                        $('#error-results').removeClass('hidden');
                        $('#error-results').text(response.responseJSON.mensaje);
                        $('#error-comercios').addClass('hidden');
                    }
                });
            }
        });
    }

    busquedaDeComerciosPorSM();

    function seleccionarTodosObtenerFoliosPorSM(){
        $("#seleccionar-todos").click(function() {
            $(".check").prop("checked", this.checked);
            var data = {
                'tipoinspeccion' :$('#tipoinspeccion').val(),
                'cantidad' : $('.check:checked').length,
                'ejerciciofiscal' : $('#ejerciciofiscal').val()
            }
            
            obtenerFoliosPorSMAjax(data);
        });
    }

    seleccionarTodosObtenerFoliosPorSM();

    function obtenerFoliosPorSM(){
        $('.check').each(function(key, value){
            $('#'+value.id).click(function(){
                if ($(".check").length == $(".check:checked").length) {
                    $("#seleccionar-todos").prop("checked", true);
                    var data = {
                        'tipoinspeccion' :$('#tipoinspeccion').val(),
                        'cantidad' : $('.check:checked').length,
                        'ejerciciofiscal' : $('#ejerciciofiscal').val()
                    }

                    obtenerFoliosPorSMAjax(data);
                } else {
                    $("#seleccionar-todos").prop("checked", false);
                    var data = {
                        'tipoinspeccion' :$('#tipoinspeccion').val(),
                        'cantidad' : $('.check:checked').length,
                        'ejerciciofiscal' : $('#ejerciciofiscal').val()
                    }

                    obtenerFoliosPorSMAjax(data);
                }
            }); 
        }); 
    }

    obtenerFoliosPorSM();

    function obtenerFoliosPorSMAjax(data){
        $.ajax({
            url: url + '/inspecciones/obtener-folios',
            data: data,
            type: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                $('#error-comercios').addClass('hidden');
                $('#folio-inicio').text(response.folioinicio);
                $('#folio-fin').text(response.foliofin);
            },

            error: function(response) {
                $('#error-comercios').removeClass('hidden');
                $('#error-comercios').text(response.responseJSON.mensaje);
                $('#folio-inicio').text('');
                $('#folio-fin').text('');
            }
        });
    }

    
});