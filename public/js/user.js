$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    $('#error-usuario, #error-role, #error-password').addClass('hidden');
    $('#error-usuario, #error-role, #error-password').text('');

    $('#error-usuario-edit, #error-role-edit, #error-password-edit').addClass('hidden');
    $('#error-usuario-edit, #error-role-edit, #error-password-edit').text('');

    function viewData(){
        $.ajax({
            url: url + '/usuarios/listado',
            success: function (response) {
                $('#tbody').html(response);
            }
        });
    }

    viewData();

    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'usuario' : $('#usuario').val(),
                'role' : $('#role').val(),
                'password' : $('#password').val(),
                'password_confirmation' : $('#password-confirm').val()
            }

            $.ajax({
                url: url + '/usuarios/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {

                    $("#formulario-usuario")[0].reset();
                    $('#crear-usuario').modal('hide');
                    $('#registro-correcto').modal('show');

                    $('#error-usuario, #error-role, #error-password').addClass('hidden');
                    $('#error-usuario, #error-role, #error-password').text('');

                    viewData();
                },
                error: function(response) {

                    $('#error-usuario, #error-role, #error-password').addClass('hidden');
                    $('#error-usuario, #error-role, #error-password').text('');

                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });


                    /*if (typeof(response.responseJSON.errors.usuario) != 'undefined') {
                        $('#error-usuario').removeClass('hidden');
                        $('#error-usuario').text(response.responseJSON.errors.usuario[0]);
                    }else{
                        $('#error-usuario').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.role) != 'undefined') {
                        $('#error-role').removeClass('hidden');
                        $('#error-role').text(response.responseJSON.errors.role[0]);
                    }else{
                        $('#error-role').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.password) != 'undefined') {
                        $('#error-password').removeClass('hidden');
                        $('#error-password').text(response.responseJSON.errors.password[0]);
                    }else{
                        $('#error-password').addClass('hidden');
                    }*/
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
                        $('#editar-usuario').modal('show');
                        $('#id-edit').val(response.id);
                        $('#usuario-edit').val(response.usuario);
                        $('#role-edit').val(response.role);
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
                'password' : $('#password-edit').val(),
                'password_confirmation' : $('#password-confirm-edit').val()
            }

            $.ajax({
                url: url + '/usuarios/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-usuario').modal('hide');
                    $('#actualizacion-correcta').modal('show');

                    $('#error-usuario-edit, #error-role-edit, #error-password-edit').addClass('hidden');
                    $('#error-usuario-edit, #error-role-edit, #error-password-edit').text('');

                    viewData();
                },
                error: function(response) {

                    $('#error-usuario-edit, #error-role-edit, #error-password-edit').addClass('hidden');
                    $('#error-usuario-edit, #error-role-edit, #error-password-edit').text('');

                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);

                        console.log(item[0]);
                    });

                    /*if (typeof(response.responseJSON.errors.usuario) != 'undefined') {
                        $('#error-usuario-edit').removeClass('hidden');
                        $('#error-usuario-edit').text(response.responseJSON.errors.usuario[0]);
                    }else{
                        $('#error-usuario-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.role) != 'undefined') {
                        $('#error-role-edit').removeClass('hidden');
                        $('#error-role-edit').text(response.responseJSON.errors.role[0]);
                    }else{
                        $('#error-role-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.password) != 'undefined') {
                        $('#error-password-edit').removeClass('hidden');
                        $('#error-password-edit').text(response.responseJSON.errors.password[0]);
                    }else{
                        $('#error-password-edit').addClass('hidden');
                    }*/
                }
            });

        });
    }

    updateData();

    function deleteData(){
        $(document).on('click', '.eliminar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $('#desea-eliminar').modal('show');
            $('.delete-confirm').click(function(){
                $.ajax({
                    url: url + '/usuarios/eliminar/' + id,
                    type: 'get',
                    success: function (response) {
                        if (response == "realizado"){
                            $('#desea-eliminar').modal('hide');
                            $('#eliminacion-correcta').modal('show');
                            viewData();
                        }
                    }  
                });
            });            
        });
    }

    deleteData();

});