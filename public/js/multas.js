$(document).ready(function(){
	// Se crea una variable con la ruta raiz del proyecto
    //var url = "http://localhost/fiscalizacion/public";

    $('#error-estatus-edit').addClass('hidden');
    $('#error-estatus-edit').text('');

    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'processing': true,
            'deferRender': true,
            'pageLength': 10,
            'destroy': true,
            'ajax': url + '/multas/listado',
            'columns': [
                {data: 'folioMulta'},
                {data: 'folioInspeccion',
                    'render': function(data, type, row){
                        return "<a href='#' class='folio-inspeccion' id='"+ row.idInspeccion +"'>" + row.folioInspeccion + "</a>"
                    }
                },
                {data: 'montoMulta'},
                {data: 'valorUma'},
                {data: 'total'},
                {data: 'estatus'},
                {data: 'fechacreada'},
                {data: 'fechavence'},
                {data: 'cambiarestatus', orderable: false, searchable: false},
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

    function editEstatus(){
        $(document).on('click', '.estatus', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/multas/editarEstatus/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-estatus').modal({backdrop: 'static', keyboard: false});
                        $('#editar-estatus').modal('show');
                        $('#id-edit-estatus').val(response.id);
                        $('#estatus-edit').val(response.estatus);
                    }
                }
            });
        });
    }

    editEstatus();

    function updateEstatus(){
        $('#btn-estatus').click(function(){
            var data = {
                'id' : $('#id-edit-estatus').val(),
                'estatus' : $('#estatus-edit').val()
            }

            $.ajax({
                url: url + '/multas/estatus',
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

    updateEstatus();
});