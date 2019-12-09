$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

	$('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').addClass('hidden');
	$('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').text('');
	$('#error-nointerior, #error-noexterior, #error-rfc').addClass('hidden');
	$('#error-nointerior, #error-noexterior, #error-rfc').text('');
	$('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').addClass('hidden');
	$('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').text('');
	$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').addClass('hidden');
	$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').text('');

	$(document).on('click', '#btn-cancelar', function(e){
		$('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').addClass('hidden');
		$('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').text('');
		$('#error-nointerior, #error-noexterior, #error-rfc').addClass('hidden');
		$('#error-nointerior, #error-noexterior, #error-rfc').text('');
		$('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').addClass('hidden');
		$('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').text('');
		$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').addClass('hidden');
		$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').text('');
	});

	function viewData(){
		$('#datatable').DataTable({
			'serverSide': true,
            'processing': true,
			'destroy': true,
            'deferRender': true,
            'pageLength': 10,
            'order': [ 1, 'asc' ],
			'ajax': {
                'url': url + '/comercios/listado',
                'type': 'GET'
            },
			'columns': [
				{data: 'propietarionombre'},
				{data: 'nombreestablecimiento'},
				{data: 'domiciliofiscal'},
				{data: 'rfc'},
				{data: 'clavecatastral'},
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
				{data: 'cambiarestatus', orderable: false, searchable: false},
				{data: 'editar', orderable: false, searchable: false}
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

	function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'rfc' : $('#rfc').val(),
                'licenciafuncionamiento' : $('#licenciafuncionamiento').val(),
                'propietario' : $('#propietario').val(),
                'clavecatastral' : $('#clavecatastral').val(),
                'denominacion' : $('#denominacion').val(),
                'nombreestablecimiento' : $('#nombreestablecimiento').val(),
                'domiciliofiscal' : $('#domiciliofiscal').val(),
                'nointerior' : $('#nointerior').val(),
                'noexterior' : $('#noexterior').val()
            }
            $.ajax({
                url: url + '/comercios/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Comercio...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Comercio');
                    $("#formulario-comercio")[0].reset();
                    $('#crear-comercio').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').addClass('hidden');
					$('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').text('');
					$('#error-nointerior, #error-noexterior, #error-rfc').addClass('hidden');
					$('#error-nointerior, #error-noexterior, #error-rfc').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Comercio');
                    $('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').addClass('hidden');
					$('#error-propietario, #error-denominacion, #error-nombreestablecimiento, #error-domiciliofiscal').text('');
					$('#error-nointerior, #error-noexterior, #error-rfc').addClass('hidden');
					$('#error-nointerior, #error-noexterior, #error-rfc').text('');
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
				url: url + '/comercios/editar/' + id,
				type: 'get',
				success: function (response) {
					if (response != ""){
						$('#editar-comercio').modal({backdrop: 'static', keyboard: false})
						$('#editar-comercio').modal('show');
						$('#id-edit').val(response.id);
                        $('#rfc-edit').val(response.rfc);
                        $('#licenciafuncionamiento-edit').val(response.licenciafuncionamiento);
                        $('#propietario-edit').val(response.propietarionombre);
                        $('#clavecatastral-edit').val(response.clavecatastral);
                        $('#denominacion-edit').val(response.denominacion);
                        $('#nombreestablecimiento-edit').val(response.nombreestablecimiento);
                        $('#domiciliofiscal-edit').val(response.domiciliofiscal);
                        $('#nointerior-edit').val(response.nointerior);
                        $('#noexterior-edit').val(response.noexterior);
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
                'rfc' : $('#rfc-edit').val(),
                'licenciafuncionamiento' : $('#licenciafuncionamiento-edit').val(),
                'propietario' : $('#propietario-edit').val(),
                'clavecatastral' : $('#clavecatastral-edit').val(),
                'denominacion' : $('#denominacion-edit').val(),
                'nombreestablecimiento' : $('#nombreestablecimiento-edit').val(),
                'domiciliofiscal' : $('#domiciliofiscal-edit').val(),
                'nointerior' : $('#nointerior-edit').val(),
                'noexterior' : $('#noexterior-edit').val()
            }
            $.ajax({
                url: url + '/comercios/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-comercio').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').addClass('hidden');
					$('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').text('');
					$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').addClass('hidden');
					$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').addClass('hidden');
					$('#error-propietario-edit, #error-denominacion-edit, #error-nombreestablecimiento-edit, #error-domiciliofiscal-edit').text('');
					$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').addClass('hidden');
					$('#error-nointerior-edit, #error-noexterior-edit, #error-rfc-edit, #error-estatus-edit').text('');
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
                url: url + '/comercios/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-estatus').modal({backdrop: 'static', keyboard: false})
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
                url: url + '/comercios/estatus',
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

    function sincronizarComercios(){
         $('#btn-sincronizar').click(function(){
            $('#btn-sincronizar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Sincronizando...');
         });
    }

    sincronizarComercios()


});