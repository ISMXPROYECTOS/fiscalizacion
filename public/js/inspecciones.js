$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('.addRow').on('click', function(){
        addRow();
    });

    $('.remove').live('click', function(){
        var last = $('tbody tr').length;
        if(last != 1){
            $(this).parent().parent().remove();
        }
    });

    function addRow(){
        var clone = $('#trOriginal:first').clone();
        var section = clone.clone();
        section.find("input").val("");
        $('tbody').append(section);
    }

    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'cantidad' : $('.cantidad').val(),
                'inspector' : $('.inspector').val()
            }
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