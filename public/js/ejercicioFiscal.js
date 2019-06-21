$(document).ready(function(){
	// Se crea una variable con la ruta raiz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-ejercicio-fiscal').addClass('hidden');
    $('#error-ejercicio-fiscal').text('');

    // Esta función muetra los años fiscales en una tabla
    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/ejercicios-fiscales/listado',
            'columns': [
                {data: 'anio'},
                {data: 'activo',
                    'render': function(data, type, row){
                        if (row.activo == 1) {
                            return "<span class='badge badge-pill badge-success'>Activo</span>"
                        }else if(row.activo != 1){
                            return "<span class='badge badge-pill badge-danger'>Inactivo</span>"
                        }
                    }
                },
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

    // Se ejecuta la función cuando todo el archivo este cargado
    viewData();

    // Esta función agrega nuevos registros, se encuentra enlazada con el método create de EjercicioFiscalController
    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'anio' : $('#ejercicio-fiscal').val()
            }
            $.ajax({
                url: url + '/ejercicios-fiscales/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $("#formulario-ejercicio-fiscal")[0].reset();
                    $('#crear-ejercicio-fiscal').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-ejercicio-fiscal').addClass('hidden');
                    $('#error-ejercicio-fiscal').text('');
                    viewData();
                },
                error: function(response) {
                    $('#error-ejercicio-fiscal').addClass('hidden');
                    $('#error-ejercicio-fiscal').text('');
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

});