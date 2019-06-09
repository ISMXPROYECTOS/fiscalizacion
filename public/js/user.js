$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

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
                    viewData();
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
                    viewData();
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