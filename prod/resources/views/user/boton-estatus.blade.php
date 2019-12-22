@if($id != Auth::user()->id)
	<button type="button" class="btn btn-warning btn-sm estatus" id="{{ $id }}">
	    <i class="fas fa-toggle-on"></i>
	    Estatus
	</button>
@endif