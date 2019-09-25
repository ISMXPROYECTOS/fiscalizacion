$(document).ready(function(){
    
    var url = "http://localhost/fiscalizacion/public";

    $('#error-usuario, #error-role, #error-vigencia, #error-password').addClass('hidden');
    $('#error-usuario, #error-role, #error-vigencia, #error-password').text('');

    $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-activo-edit, #error-password-edit').addClass('hidden');
    $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-activo-edit, #error-password-edit').text('');

    $(document).on('click', '#btn-cancelar', function(e){
        $('#error-usuario, #error-role, #error-vigencia, #error-password').addClass('hidden');
        $('#error-usuario, #error-role, #error-vigencia, #error-password').text('');

        $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-activo-edit, #error-password-edit').addClass('hidden');
        $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-activo-edit, #error-password-edit').text('');
    });
    
    function viewData(){
        $('#datatable-usuarios').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/usuarios/listado',
            'columns': [
                {data: 'usuario'},
                {data: 'activo',
                    'render': function(data, type, row){
                        if (row.activo == 1) {
                            return "<span class='badge badge-pill badge-success'>Activo</span>"
                        }else if(row.activo != 1){
                            return "<span class='badge badge-pill badge-danger'>Inactivo</span>"
                        }
                    }
                },
                {data: 'role',
                    'render': function(data, type, row){
                        if (row.role == 'ROLE_ADMIN') {
                            return "<span class='badge badge-pill badge-success'>Administrador</span>"
                        }else if(row.role == 'ROLE_INSPECTOR'){
                            return "<span class='badge badge-pill badge-info'>Inspector</span>"
                        }else if(row.role == 'ROLE_VENTANILLA'){
                            return "<span class='badge badge-pill badge-secondary'>Ventanilla</span>"
                        }
                    }
                },
                {data: 'vigencia'},
                {data: 'editar'},
                {data: 'cambiarestatus'},
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
                'emptyTable': 'No se hay registros',
                'zeroRecords': 'No se encontraron registros',
                'infoEmpty': '',
                'infoFiltered': ''
            }
        });
    }

    viewData();

    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'usuario' : $('#usuario').val(),
                'role' : $('#role').val(),
                'vigencia' : $('#vigencia').val(),
                'password' : $('#password').val(),
                'password_confirmation' : $('#password-confirm').val()
            }

            $.ajax({
                url: url + '/usuarios/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Usuario...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Usuario');
                    $("#formulario-usuario")[0].reset();
                    $('#crear-usuario').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-usuario, #error-role, #error-vigencia, #error-password').addClass('hidden');
                    $('#error-usuario, #error-role, #error-vigencia, #error-password').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Usuario');
                    $('#error-usuario, #error-role, #error-vigencia, #error-password').addClass('hidden');
                    $('#error-usuario, #error-role, #error-vigencia, #error-password').text('');
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
                url: url + '/usuarios/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-usuario').modal({backdrop: 'static', keyboard: false})
                        $('#editar-usuario').modal('show');
                        $('#id-edit').val(response.id);
                        $('#usuario-edit').val(response.usuario);
                        $('#role-edit').val(response.role);
                        $('#vigencia-edit').val(response.vigencia);
                        $('#password-edit').val(response.password);
                        $('#password-confirm-edit').val(response.password);
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
                'usuario' : $('#usuario-edit').val(),
                'role' : $('#role-edit').val(),
                'vigencia' : $('#vigencia-edit').val(),
                'password' : $('#password-edit').val(),
                'password_confirmation' : $('#password-confirm-edit').val()
            }

            $.ajax({
                url: url + '/usuarios/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-usuario').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-password-edit').addClass('hidden');
                    $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-password-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-password-edit').addClass('hidden');
                    $('#error-usuario-edit, #error-role-edit, #error-vigencia-edit, #error-password-edit').text('');
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
                url: url + '/usuarios/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-activo').modal({backdrop: 'static', keyboard: false})
                        $('#editar-activo').modal('show');
                        $('#id-edit-activo').val(response.id);
                        $('#activo-edit').val(response.activo);
                    }
                }
            });
        });
    }

    editEstatus();

    function updateEstatus(){
        $('#btn-activo').click(function(){
            var data = {
                'id' : $('#id-edit-activo').val(),
                'activo' : $('#activo-edit').val()
            }

            $.ajax({
                url: url + '/usuarios/estatus',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-activo').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-activo').text('Guardar');
                    $('#editar-activo').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-activo-edit').addClass('hidden');
                    $('#error-activo-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-activo').text('Guardar');
                    $('#error-activo-edit').addClass('hidden');
                    $('#error-activo-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateEstatus();
    
});