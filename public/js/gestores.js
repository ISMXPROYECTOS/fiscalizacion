$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').addClass('hidden');
    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').text('');

    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').addClass('hidden');
    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').text('');

    function viewData(){
        $.ajax({
            url: url + '/gestores/listado',
            success: function (response) {
                $('#tbody').html(response);
            }
        });
    }

    viewData();

    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'nombre' : $('#nombre').val(),
                'apellidopaterno' : $('#apellidopaterno').val(),
                'apellidomaterno' : $('#apellidomaterno').val(),
                'telefono' : $('#telefono').val(),
                'celular' : $('#celular').val(),
                'correoelectronico' : $('#correoelectronico').val(),
                'ine' : $('#ine').val(),
                'estatus' : $('#estatus').val()
            }

            $.ajax({
                url: url + '/gestores/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $("#formulario-gestor")[0].reset();
                    $('#crear-gestor').modal('hide');
                    $('#registro-correcto').modal('show');

                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').text('');


                    viewData();
                },
                error: function(response) {

                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').text('');

                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });

                    /*if (typeof(response.responseJSON.errors.nombre) != 'undefined') {
                        $('#error-nombre').removeClass('hidden');
                        $('#error-nombre').text(response.responseJSON.errors.nombre[0]);
                    }else{
                        $('#error-nombre').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.apellidopaterno) != 'undefined') {
                        $('#error-apellidopaterno').removeClass('hidden');
                        $('#error-apellidopaterno').text(response.responseJSON.errors.apellidopaterno[0]);
                    }else{
                        $('#error-apellidopaterno').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.apellidomaterno) != 'undefined') {
                        $('#error-apellidomaterno').removeClass('hidden');
                        $('#error-apellidomaterno').text(response.responseJSON.errors.apellidomaterno[0]);
                    }else{
                        $('#error-apellidomaterno').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.telefono) != 'undefined') {
                        $('#error-telefono').removeClass('hidden');
                        $('#error-telefono').text(response.responseJSON.errors.telefono[0]);
                    }else{
                        $('#error-telefono').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.celular) != 'undefined') {
                        $('#error-celular').removeClass('hidden');
                        $('#error-celular').text(response.responseJSON.errors.celular[0]);
                    }else{
                        $('#error-celular').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.correoelectronico) != 'undefined') {
                        $('#error-correoelectronico').removeClass('hidden');
                        $('#error-correoelectronico').text(response.responseJSON.errors.correoelectronico[0]);
                    }else{
                        $('#error-correoelectronico').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.ine) != 'undefined') {
                        $('#error-ine').removeClass('hidden');
                        $('#error-ine').text(response.responseJSON.errors.ine[0]);
                    }else{
                        $('#error-ine').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.estatus) != 'undefined') {
                        $('#error-estatus').removeClass('hidden');
                        $('#error-estatus').text(response.responseJSON.errors.estatus[0]);
                    }else{
                        $('#error-estatus').addClass('hidden');
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
                url: url + '/gestores/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-gestor').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#apellidopaterno-edit').val(response.apellidopaterno);
                        $('#apellidomaterno-edit').val(response.apellidomaterno);
                        $('#telefono-edit').val(response.telefono);
                        $('#celular-edit').val(response.celular);
                        $('#correoelectronico-edit').val(response.correoelectronico);
                        $('#ine-edit').val(response.ine);
                        $('#estatus-edit').val(response.estatus);
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
                'telefono' : $('#telefono-edit').val(),
                'celular' : $('#celular-edit').val(),
                'correoelectronico' : $('#correoelectronico-edit').val(),
                'ine' : $('#ine-edit').val(),
                'estatus' : $('#estatus-edit').val()
            }

            $.ajax({
                url: url + '/gestores/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-gestor').modal('hide');
                    $('#actualizacion-correcta').modal('show');

                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').text('');

                    viewData();
                },
                error: function(response) {

                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').text('');

                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });

                    /*if (typeof(response.responseJSON.errors.nombre) != 'undefined') {
                        $('#error-nombre-edit').removeClass('hidden');
                        $('#error-nombre-edit').text(response.responseJSON.errors.nombre[0]);
                    }else{
                        $('#error-nombre-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.apellidopaterno) != 'undefined') {
                        $('#error-apellidopaterno-edit').removeClass('hidden');
                        $('#error-apellidopaterno-edit').text(response.responseJSON.errors.apellidopaterno[0]);
                    }else{
                        $('#error-apellidopaterno-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.apellidomaterno) != 'undefined') {
                        $('#error-apellidomaterno-edit').removeClass('hidden');
                        $('#error-apellidomaterno-edit').text(response.responseJSON.errors.apellidomaterno[0]);
                    }else{
                        $('#error-apellidomaterno-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.telefono) != 'undefined') {
                        $('#error-telefono-edit').removeClass('hidden');
                        $('#error-telefono-edit').text(response.responseJSON.errors.telefono[0]);
                    }else{
                        $('#error-telefono-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.celular) != 'undefined') {
                        $('#error-celular-edit').removeClass('hidden');
                        $('#error-celular-edit').text(response.responseJSON.errors.celular[0]);
                    }else{
                        $('#error-celular-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.correoelectronico) != 'undefined') {
                        $('#error-correoelectronico-edit').removeClass('hidden');
                        $('#error-correoelectronico-edit').text(response.responseJSON.errors.correoelectronico[0]);
                    }else{
                        $('#error-correoelectronico-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.ine) != 'undefined') {
                        $('#error-ine-edit').removeClass('hidden');
                        $('#error-ine-edit').text(response.responseJSON.errors.ine[0]);
                    }else{
                        $('#error-ine-edit').addClass('hidden');
                    }

                    if (typeof(response.responseJSON.errors.estatus) != 'undefined') {
                        $('#error-estatus-edit').removeClass('hidden');
                        $('#error-estatus-edit').text(response.responseJSON.errors.estatus[0]);
                    }else{
                        $('#error-estatus-edit').addClass('hidden');
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
                    url: url + '/gestores/eliminar/' + id,
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