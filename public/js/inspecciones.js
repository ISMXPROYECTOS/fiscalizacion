$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-ejerciciofiscal, #error-tipoinspeccion').addClass('hidden');
    $('#error-ejerciciofiscal, #error-tipoinspeccion').text('');
    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').addClass('hidden');
    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').text('');
    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').addClass('hidden');
    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').text('');
    $('#error-estatusinspeccion-edit, #error-comentario-edit').addClass('hidden');
    $('#error-estatusinspeccion-edit, #error-comentario-edit').text('');

    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'order': [ 0, 'asc' ],
            'ajax': url + '/inspecciones/listado',
            'columns': [
                {data: 'folio',
                    'render': function(data, type, row){
                        return "<a href='#' class='folio-inspeccion' id='"+ row.id +"'>" + data + "</a>"
                    }
                },
                {data: 'tipo_inspeccion.clave'},
                {data: 'estatus_inspeccion.nombre',
                    'render': function(data, type, row){
                        if (row.estatus_inspeccion.clave == 'NA') {
                            return "<span class='badge badge-pill badge-secondary'>"+ row.estatus_inspeccion.nombre +"</span>";
                        } else if(row.estatus_inspeccion.clave == 'A'){
                            return "<span class='badge badge-pill badge-primary'>"+ row.estatus_inspeccion.nombre +"</span>";
                        } else if(row.estatus_inspeccion.clave == 'Cap'){
                            return "<span class='badge badge-pill badge-success'>"+ row.estatus_inspeccion.nombre +"</span>";
                        } else if(row.estatus_inspeccion.clave == 'S'){
                            return "<span class='badge badge-pill badge-success'>"+ row.estatus_inspeccion.nombre +"</span>";
                        } else if (row.estatus_inspeccion.clave == 'V') {
                            return "<span class='badge badge-pill badge-danger'>"+ row.estatus_inspeccion.nombre +"</span>";
                        } else if (row.estatus_inspeccion.clave == 'C') {
                            return "<span class='badge badge-pill badge-warning'>"+ row.estatus_inspeccion.nombre +"</span>";
                        } else if(row.estatus_inspeccion.clave == 'P'){
                            return "<span class='badge badge-pill badge-info'>"+ row.estatus_inspeccion.nombre +"</span>";
                        }
                    }
                },
                {data: 'inspector.nombre', defaultContent: ''},
                {data: 'comercio.nombreestablecimiento', defaultContent: ''},
                {data: 'created_at', defaultContent: ''},
                {data: 'fechavence',
                    'render': function(data, type, row){

                        var month = new Array();
                        month[0] = "01";
                        month[1] = "02";
                        month[2] = "03";
                        month[3] = "04";
                        month[4] = "05";
                        month[5] = "06";
                        month[6] = "07";
                        month[7] = "08";
                        month[8] = "09";
                        month[9] = "10";
                        month[10] = "11";
                        month[11] = "12";

                        var hoy = new Date();

                        var fecha = new Date(row.fechavence);
                        var dia = fecha.getDate() + 1;
                        var mes = month[fecha.getMonth()];;
                        var anio = fecha.getFullYear();

                        if (row.fechavence == null) {
                            return "<span class='badge badge-pill badge-secondary'>No ha sido capturada</span>";
                        } else if(fecha < hoy){
                            return "<span class='badge badge-pill badge-danger'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
                        } else {
                            return "<span class='badge badge-pill badge-success'>"+ dia +"/"+ mes +"/"+ anio +"</span>"
                        }
                    }
                },
                {data: 'fechaprorroga',
                    'render': function(data, type, row){
                        var month = new Array();
                        month[0] = "01";
                        month[1] = "02";
                        month[2] = "03";
                        month[3] = "04";
                        month[4] = "05";
                        month[5] = "06";
                        month[6] = "07";
                        month[7] = "08";
                        month[8] = "09";
                        month[9] = "10";
                        month[10] = "11";
                        month[11] = "12";

                        var hoy = new Date();

                        var fecha = new Date(row.fechaprorroga);
                        var dia = fecha.getDate();
                        var mes = month[fecha.getMonth()];
                        var anio = fecha.getFullYear();


                        if (row.fechaprorroga == null) {
                            return "<span class='badge badge-pill badge-secondary'>No hay prorroga</span>";
                        } else if (fecha < hoy) {
                            return "<span class='badge badge-pill badge-danger'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
                        } else {
                            return "<span class='badge badge-pill badge-success'>"+ dia +"/"+ mes +"/"+ anio +"</span>";
                        }
                    }
                },
                {data: 'cambiarestatus'}
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
                        $('#inspector-edit').val(response.inspector_id);
                        $('#gestor-edit').val(response.gestores_id);
                        $('#tipoinspeccion-edit').val(response.tipoinspeccion_id);
                        $('#ejerciciofiscal-edit').val(response.ejerciciofiscal_id);
                        $('#colonia-edit').val(response.colonia_id);
                        $('#local-edit').val(response.nombrelocal);
                        $('#domicilio-edit').val(response.domicilio);
                        $('#encargado-edit').val(response.nombreencargado);
                        $('#puestoencargado-edit').val(response.cargoencargado);
                        $('#diasvence-edit').val(response.diasvence);
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
                'ejerciciofiscal' : $('#ejerciciofiscal-edit').val(),
                'colonia' : $('#colonia-edit').val(),
                'local' : $('#local-edit').val(),
                'domicilio' : $('#domicilio-edit').val(),
                'encargado' : $('#encargado-edit').val(),
                'puestoencargado' : $('#puestoencargado-edit').val(),
                'diasvence' : $('#diasvence-edit').val()
            }
            $.ajax({
                url: url + '/inspecciones/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-inspeccion').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').addClass('hidden');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').text('');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').addClass('hidden');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').text('');
                    viewData();
                },

                error: function(response) {
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').addClass('hidden');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').text('');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').addClass('hidden');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateData();

    function editEstatus(){
        $(document).on('click', '.estatus', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/inspecciones/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-estatus').modal({backdrop: 'static', keyboard: false})
                        $('#editar-estatus').modal('show');
                        $('#id-edit-estatusinspeccion').val(response.id);
                        $('#estatusinspeccion-edit').val(response.estatusinspeccion_id);
                    }
                }
            });
        });
    }

    editEstatus();

    function updateEstatus(){
        $('#btn-estatus').click(function(){
            var data = {
                'id' : $('#id-edit-estatusinspeccion').val(),
                'estatusinspeccion' : $('#estatusinspeccion-edit').val(),
                'comentario' : $('#comentario-edit').val()
            }
            $.ajax({
                url: url + '/inspecciones/estatus',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-estatus').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-estatusinspeccion-edit').addClass('hidden');
                    $('#error-estatusinspeccion-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#error-estatusinspeccion-edit').addClass('hidden');
                    $('#error-estatusinspeccion-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateEstatus();

    function validarFolioAsignado(){
        $(document).on('click', '.folio-inspeccion', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/inspecciones/validar-folio-asignado/' + id,
                type: 'get',
                success: function (response) {
                    if (response == 'true') {
                        window.location.href = url + '/inspecciones/informacion/' + id;
                    } else {
                         $('#validar-folio-asignado').modal('show');
                    }
                }
            });
        });
    }

    validarFolioAsignado();

   
    
});