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
        var section = clone;
        section.find("input").val("");
        section.find("select").val("");
        $('#new-row').append(section);
    }

    $(document).on("click", "#remove", function() {
        var last = $('.duplicados').length;
        if(last != 1){
            $(this).closest("#inspecciones").remove();
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
                {data: 'idgestores'},
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
                    viewData();
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

    function editData(){
        $(document).on('click', '.editar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/inspecciones/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-inspeccion').modal('show');
                        $('#id-edit').val(response.id);
                        $('#inspector-edit').val(response.idinspector);
                        $('#gestor-edit').val(response.idgestores);
                        $('#tipoinspeccion-edit').val(response.idtipoinspeccion);
                        $('#formavalorada-edit').val(response.idformavalorada);
                        $('#giro-edit').val(response.idgiro);
                        $('#subgiro-edit').val(response.idsubgirocomercial);
                        $('#ejerciciofiscal-edit').val(response.idejerciciofiscal);
                        $('#estatus-edit').val(response.idestatusinspeccion);
                        $('#colonia-edit').val(response.idcolonia);
                        $('#local-edit').val(response.nombrelocal);
                        $('#domicilio-edit').val(response.domicilio);
                        $('#encargado-edit').val(response.nombreencargado);
                        $('#puestoencargado-edit').val(response.cargoencargado);
                        $('#diasvence-edit').val(response.diasvence);
                        $('#fechavence-edit').val(response.fechavence);
                    }
                }
            });
        });
    }

    editData();

    function updateData(){
        $('#btn-editar').click(function(){
            var data = {
                'id' : $('#id-edit').val(),
                'nombre' : $('#nombre-edit').val(),
                'apellidopaterno' : $('#apellidopaterno-edit').val(),
                'apellidomaterno' : $('#apellidomaterno-edit').val(),
                'clave' : $('#clave-edit').val()
            }
            $.ajax({
                url: url + '/inspecciones/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-inspector').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit').text('');
                    viewData();
                },

                error: function(response) {
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateData();

});