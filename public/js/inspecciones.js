$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-cantidad, #error-inspector').addClass('hidden');
    $('#error-cantidad, #error-inspector').text('');

    $('#add-row').click(function(){
        addRow();
    });

    function addRow(){
        var clone = $('#inspecciones:first').clone();
        var section = clone.clone();
        section.find("input").val("");
        section.find("select").val("");
        $('#new-row').append(section);
    }

    $('#remove').live('click', function(){
        var last = $('.duplicados').length; // how many "duplicatable" input fields we currently have
        $('#inspecciones' + last).remove();
        if(last != 1){
            $(this).parent().parent().remove();
        }
    });

    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/inspecciones/listado',
            'columns': [
                {data: 'idusuario'},
                {data: 'idinspector'},
                {data: 'idgestor'},
                {data: 'idtipoinspeccion'},
                {data: 'idformavalorada'},
                {data: 'idgiro'},
                {data: 'idsubgirocomercial'},
                {data: 'idejerciciofiscal'},
                {data: 'idestatusinspeccion'},
                {data: 'idcolonia'},
                {data: 'created_at'},
                {data: 'fechaasignada'},
                {data: 'fechacapturada'},
                {data: 'fechaprorroga'},
                {data: 'nombrelocal'},
                {data: 'domicilio'},
                {data: 'folio'},
                {data: 'nombreencargado'},
                {data: 'cargoencargado'},
                {data: 'diasvence'},
                {data: 'fechavence'},
                {data: 'btn'},
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

    viewData();

    function saveData(){
        $('#btn-enviar').click(function(){
            // Convierte los datos de form en array
            var data = $("#formulario-inspeccion").serializeArray();
            $.ajax({
                url: url + '/inspecciones/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $("#formulario-inspeccion")[0].reset();
                    $('#crear-inspeccion').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-cantidad, #error-inspector').addClass('hidden');
                    $('#error-cantidad, #error-inspector').text('');
                },
                error: function(response) {
                    $('#error-cantidad, #error-inspector').addClass('hidden');
                    $('#error-cantidad, #error-inspector').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });
                }
            });

        });
    }

    saveData();

});