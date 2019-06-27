$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#add-row').click(function(){
        addRow();
    });

    function addRow(){
        var i = $('.duplicados').length; // how many "duplicatable" input fields we currently have
        var contador = new Number(i + 1);
        
        var clone = $('#inspecciones:first').clone();

        var section = clone.clone();

        section.find("input").attr('name', 'cantidad-'+contador).val("");
        section.find("select").attr('name', 'inspector-'+contador).val("");
        $('#new-row').append(section);
    }

    function saveData(){
        $('#btn-enviar').click(function(){
            //esta te la convierte en una URL
            //var data = $("#formulario-inspeccion").serialize(); 

            // esta en array
            var data = $("#formulario-inspeccion").serializeArray();
            console.log(data);

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

    $('#remove').live('click', function(){
        var last = $('.duplicados').length; // how many "duplicatable" input fields we currently have

        $('#inspecciones' + last).remove();

        if(last != 1){
            $(this).parent().parent().remove();
        }
    });

});