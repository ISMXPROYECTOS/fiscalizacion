$(document).ready(function(){
    var url = "http://localhost/fiscalizacion/public";

    /*function buscarPorSupermanzana(){
        $('#buscar-sm').click(function(){
            var calle = $('#calle').val();
            $( ".results").remove();
            $.ajax({
                url: url + '/comercios/buscar/supermanzana/' + calle,
                type: 'get',
                success: function (response) {
                    listadoDeComerciosPorSM(response);
                    /*$('#comercios-label').removeClass('hidden');
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
                }
            });
        });
    }

    buscarPorSupermanzana();*/

    $("#seleccionar-todos").click(function() {
        $(".check").prop("checked", this.checked);
    });

    function listadoDeComerciosPorSM(){
        $('#buscar-sm').click(function(){
            var calle = $('#calle').val();

            if (calle == '') {
                $('#error-sm').removeClass('hidden');
                $('#error-sm').text('Rellena el campo correctamente');
            } else {
                $('#error-sm').addClass('hidden');
                $('#comercios-datatable').removeClass('hidden');
                $('#comercios-datatable').DataTable({
                    'serverSide': true,
                    'destroy': true,
                    'ajax': url + '/comercios/buscar/supermanzana/' + calle,
                    'order': [ 1, 'asc' ],
                    "ordering": false,
                    'columns': [
                        {data: 'checkbox'},
                        {data: 'denominacion'},
                        {data: 'nombreestablecimiento'},
                        {data: 'domiciliofiscal'},
                    ],

                    'language': {
                        'info': 'Total de registros _TOTAL_',
                        'paginate': {
                            'next': 'Siguiente',
                            'previous': 'Anterior',
                        },
                        'lengthMenu': 'Mostrar _MENU_ registros',
                        'loadingRecords': 'Cargando...',
                        'processing': 'Procesando...',
                        'emptyTable': 'No se encontraron registros',
                        'zeroRecords': 'No se encontraron registros',
                        'infoEmpty': '',
                        'infoFiltered': ''
                    }
                });
            }
                             
        });    
    }

    listadoDeComerciosPorSM();
});