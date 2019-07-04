$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').addClass('hidden');
    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').text('');
    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').addClass('hidden');
    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').text('');
    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-formavalorada-edit, #error-giro-edit').addClass('hidden');
    $('#error-subgiro-edit, #error-ejerciciofiscal-edit, #error-estatus-edit, #error-colonia-edit, #error-domicilio-edit').addClass('hidden');
    $('#error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit, #error-fechavence-edit').addClass('hidden');
    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-formavalorada-edit, #error-giro-edit').text('');
    $('#error-subgiro-edit, #error-ejerciciofiscal-edit, #error-estatus-edit, #error-colonia-edit, #error-domicilio-edit').text('');
    $('#error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit, #error-fechavence-edit').text('');

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
                {data: 'folio'},
                {data: 'idtipoinspeccion'},
                {data: 'idestatusinspeccion'},
                {data: 'idinspector'},
                {data: 'nombrelocal'},
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
                    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').addClass('hidden');
                    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').text('');
                    viewData();
                },
                error: function(response) {
                    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').addClass('hidden');
                    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').text('');
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
                'inspector' : $('#inspector-edit').val(),
                'gestor' : $('#gestor-edit').val(),
                'tipoinspeccion' : $('#tipoinspeccion-edit').val(),
                'formavalorada' : $('#formavalorada-edit').val(),
                'giro' : $('#giro-edit').val(),
                'subgiro' : $('#subgiro-edit').val(),
                'ejerciciofiscal' : $('#ejerciciofiscal-edit').val(),
                'estatus' : $('#estatus-edit').val(),
                'colonia' : $('#colonia-edit').val(),
                'local' : $('#local-edit').val(),
                'domicilio' : $('#domicilio-edit').val(),
                'encargado' : $('#encargado-edit').val(),
                'puestoencargado' : $('#puestoencargado-edit').val(),
                'diasvence' : $('#diasvence-edit').val(),
                'fechavence' : $('#fechavence-edit').val()
            }
            $.ajax({
                url: url + '/inspecciones/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-inspector').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-formavalorada-edit, #error-giro-edit').addClass('hidden');
                    $('#error-subgiro-edit, #error-ejerciciofiscal-edit, #error-estatus-edit, #error-colonia-edit, #error-domicilio-edit').addClass('hidden');
                    $('#error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit, #error-fechavence-edit').addClass('hidden');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-formavalorada-edit, #error-giro-edit').text('');
                    $('#error-subgiro-edit, #error-ejerciciofiscal-edit, #error-estatus-edit, #error-colonia-edit, #error-domicilio-edit').text('');
                    $('#error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit, #error-fechavence-edit').text('');
                    viewData();
                },

                error: function(response) {
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-formavalorada-edit, #error-giro-edit').addClass('hidden');
                    $('#error-subgiro-edit, #error-ejerciciofiscal-edit, #error-estatus-edit, #error-colonia-edit, #error-domicilio-edit').addClass('hidden');
                    $('#error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit, #error-fechavence-edit').addClass('hidden');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-formavalorada-edit, #error-giro-edit').text('');
                    $('#error-subgiro-edit, #error-ejerciciofiscal-edit, #error-estatus-edit, #error-colonia-edit, #error-domicilio-edit').text('');
                    $('#error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit, #error-fechavence-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateData();

    $(document).on("change", "#tipoinspeccion-asignar", function(){
        var tipoinspeccion = $('#tipoinspeccion-asignar').val();
        console.log(tipoinspeccion);
    });

    function asignar(){
        $('#btn-asignar').click(function(){
            var data = $("#formulario-asignacion").serializeArray();
            $.ajax({
                url: url + '/inspecciones/asignar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#asignar-inspeccion').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').addClass('hidden');
                    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').text('');
                    viewData();
                },

                error: function(response) {
                    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').addClass('hidden');
                    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });
                }
            });
        });
    }

    asignar();

});