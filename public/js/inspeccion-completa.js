$(document).ready(function(){

	// Se crea una variable con la ruta raíz del proyecto
	var url = "http://localhost/fiscalizacion/public";

	function cambiarInspector(){
        $(document).on('click', '.cambiar-inspector', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/inspecciones/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#cambiar-inspector').modal('show');
                        $('#id-cambio-inspector').val(response.id);
                        $('#inspector-edit').val(response.inspector_id);
                    }
                }
            });
        });
    }

    cambiarInspector();

    function updateInspector(){
        $('#btn-cambiar-inspector').click(function(){
            var data = {
                'id' : $('#id-cambio-inspector').val(),
                'inspector' : $('#inspector-edit').val()
            }
            $.ajax({
                url: url + '/inspecciones/inspector',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#cambiar-inspector').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-inspector-edit').addClass('hidden');
                    $('#error-inspector-edit').text('');
                },
                error: function(response) {
                    $('#error-inspector-edit').addClass('hidden');
                    $('#error-inspector-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateInspector();

});