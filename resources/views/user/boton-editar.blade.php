@if($id != Auth::user()->id)
	<button type="button" class="btn btn-primary btn-sm editar" id="{{ $id }}">
	    <i class="fas fa-edit"></i>
	    Editar
	</button>
@endif