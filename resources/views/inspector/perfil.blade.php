<!doctype html>
<html class="fixed">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Sistema de Fiscalización') }}</title>
        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/animate/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
        <!-- Skin CSS -->
        <link rel="stylesheet" href="{{ asset('css/skins/default.css') }}" />
        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <!-- Head Libs -->
        <script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>
    </head>
    <body>
		<div class="row">
			<div class="col-lg-4 col-xl-3 mb-4 mb-xl-0"></div>
			<div class="col-lg-8 col-xl-6">
				<div class="tabs">
					<div class="tab-content">
						<h4 class="mb-3">Datos del Inspector</h4>
						<div class="form-group">
							<img src="{{ asset('img/inspectores/'. $gafete->imageninspector) }}" alt="Foto-del-inspector">
						</div>
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" id="nombre" value="{{ $inspector->nombre }}" disabled="disabled">
						</div>
						<div class="form-group">
							<label for="apellidopaterno">Apellido Paterno</label>
							<input type="text" class="form-control" id="apellidopaterno" value="{{ $inspector->apellidopaterno }}" disabled="disabled">
						</div>
						<div class="form-group">
							<label for="apellidomaterno">Apellido Materno</label>
							<input type="text" class="form-control" id="apellidomaterno" value="{{ $inspector->apellidomaterno }}" disabled="disabled">
						</div>
						<div class="form-group">
							<label for="clave">Clave</label>
							<input type="text" class="form-control" id="clave" value="{{ $inspector->clave }}" disabled="disabled">
						</div>
						<div class="form-group">
							<label for="estatus">Estatus</label>
							<select id="estatus" class="form-control">
								@if($inspector->estatus == 'A')
									<option value="{{ $inspector->estatus }}">Activo</option>
								@elseif($inspector->estatus == 'V')
									<option value="{{ $inspector->estatus }}">Vigente</option>
								@elseif($inspector->estatus == 'B')
									<option value="{{ $inspector->estatus }}">Baja</option>
								@else
									<option value="{{ $inspector->estatus }}">Suspendido</option>
								@endif
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
        <script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ asset('vendor/popper/umd/popper.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('vendor/common/common.js') }}"></script>
        <script src="{{ asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
        <!-- Specific Page Vendor -->
        <script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
        <script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js') }}"></script> 
        <!-- Theme Base, Components and Settings -->
        <script src="{{ asset('js/theme.js') }}"></script>
        <!-- Theme Custom -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <!-- Theme Initialization Files -->
        <script src="{{ asset('js/theme.init.js') }}"></script>
        <script src="{{ asset('js/examples/examples.modals.js') }} "></script>

	</body>
</html>