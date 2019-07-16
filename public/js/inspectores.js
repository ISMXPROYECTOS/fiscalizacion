$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').addClass('hidden');
    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').text('');

    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').addClass('hidden');
    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').text('');

    // Esta función muetra los inspectores en una tabla
    function viewData(){
        // Selecciona la tabla con el id datatable, esta funcion se relaciona con el metodo tbody del InspectorController
        // el metodo del controlador obtiene todos los registros de los inspectores y lo retorna a esta función en
        // formato Json para que la libreria Datatable pueda detectar cada campo
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/inspectores/listado',
            // Se seleccionan los campos que se desean mostrar en la tabla
            'columns': [
                {data: 'nombre'},
                {data: 'apellidopaterno'},
                {data: 'apellidomaterno'},
                {data: 'clave'},
                // Este campo contiene una funcion la cual selecciona la columna estatus y
                // realiza el cambio del caracter A por la palabra Activo 
                // esto dependera de cada inspector y su estatus
                {data: 'estatus',
                    'render': function(data, type, row){
                        if (row.estatus == 'A') {
                            return "<span class='badge badge-pill badge-success'>Activo</span>"
                        }else if(row.estatus == 'B'){
                            return "<span class='badge badge-pill badge-danger'>Baja</span>"
                        }else if(row.estatus == 'S'){
                            return "<span class='badge badge-pill badge-warning'>Suspendido</span>"
                        } else if (row.estatus == 'V') {
                            return "<span class='badge badge-pill badge-primary'>Vigente</span>"
                        }
                    }
                },
                // La columna pertenece a los botones de editar o eliminar de cada registro
                {data: 'editar'},
                {data: 'cambiarestatus'},
                {data: 'gafete'},
            ],
            // Aquí se realiza la traduccion de la tabla, la libreria datatable esta en ingles
            // pero aqui se realiza las respectivas configuraciones y traducciones
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

    // Se ejecuta la función cuando todo el archivo este cargado
    viewData();

    // Esta función agrega nuevos registros, se encuentra enlazada con el método create de InspectorController
    function saveData(){
        // Se crea un objeto data que contiene todos los campos necesarios para generar un nuevo registro
        // crea un Json clave : valor, la clave sera el campo de la BD y el valor el campo del formulario 
        $('#btn-enviar').click(function(){
            var data = {
                'nombre' : $('#nombre').val(),
                'apellidopaterno' : $('#apellidopaterno').val(),
                'apellidomaterno' : $('#apellidomaterno').val(),
                'clave' : $('#clave').val(),
                'estatus' : $('#estatus').val()
            }
            // Mediante ajax se envian los datos al controlador y espera una respuesta
            // si la respuesta es exitosa se invoca al método viewData el cual muetra la lista de los registro
            // por ende mostrara el registro que se agrego recientemente, si la respuesta es erronea
            // se indican los errores al usuario para que realice la corrección
            $.ajax({
                url: url + '/inspectores/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Inspector...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Inspector');
                    $("#formulario-inspector")[0].reset();
                    $('#crear-inspector').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Inspector');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });
                }
            });

        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    saveData();

    // Esta función selecciona registros para modificarlos, se encuentra enlazada con el método editarInspector de InspectorController
    function editData(){
        $(document).on('click', '.editar', function(e){
            e.preventDefault();
            // Se crea una variable id con la id del registro que se desea editar
            var id = $(this).attr('id');
            // Se envía esa variable al metodo editarInspector de InspectorController, el metodo regresa un registro
            // con los datos que se tienen guardados para poder mostrarlos en el formulario de modificación
             $.ajax({
                url: url + '/inspectores/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-inspector').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#apellidopaterno-edit').val(response.apellidopaterno);
                        $('#apellidomaterno-edit').val(response.apellidomaterno);
                        $('#clave-edit').val(response.clave);
                    }
                }
            });
        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    editData();

    // Esta función modifica registros, se encuentra enlazada con el método update de InspectorController
    function updateData(){
        // Se crea un objeto data que contiene todos los campos necesarios para modificar un registro
        $('#btn-editar').click(function(){
            var data = {
                'id' : $('#id-edit').val(),
                'nombre' : $('#nombre-edit').val(),
                'apellidopaterno' : $('#apellidopaterno-edit').val(),
                'apellidomaterno' : $('#apellidomaterno-edit').val(),
                'clave' : $('#clave-edit').val()
            }
            // Se envía esa variable al metodo update de InspectorController, el metodo regresa un registro
            // con las modificaciones realizadas si no hubo algun problema en la validación, de lo contrario
            // si ocurrió un error se le indica al usuario para que realice la modificación a los campos.
            $.ajax({
                url: url + '/inspectores/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-inspector').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit').text('');
                    viewData();
                },

                error: function(response) {
                    $('#btn-editar').text('Guardar');
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

    // Se ejecuta la función cuando todo el archivo este cargado
    updateData();

    // La funcioón envia el id del registro que se desea modificar su estatus y recibe la información
    // de ese registro para poder poner los datos en el modal de edición
    function editEstatus(){
        $(document).on('click', '.estatus', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/inspectores/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-estatus').modal('show');
                        $('#id-edit-estatus').val(response.id);
                        $('#estatus-edit').val(response.estatus);
                    }
                }
            });
        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    editEstatus();

    // Esta función modifica el estatus del registro, se encuentra enlazada con el método updateEstatus de InspectorController
    function updateEstatus(){
        $('#btn-estatus').click(function(){
            // Se crea un array con los datos para modificar y ser enviados al método del controlador
            var data = {
                'id' : $('#id-edit-estatus').val(),
                'estatus' : $('#estatus-edit').val()
            }

            $.ajax({
                url: url + '/inspectores/estatus',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-estatus').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-estatus').text('Guardar');
                    $('#editar-estatus').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-estatus-edit').addClass('hidden');
                    $('#error-estatus-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-estatus').text('Guardar');
                    $('#error-estatus-edit').addClass('hidden');
                    $('#error-estatus-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    updateEstatus();

});