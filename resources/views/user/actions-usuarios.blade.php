@if($id != Auth::user()->id)
	<button type="button" class="btn btn-info btn-sm editar" id="{{ $id }}">
	    <i class="fas fa-edit"></i>
	</button>

	<button  class="btn btn-danger btn-sm eliminar" id="{{ $id }}">
	    <i class="fas fa-trash-alt"></i>
	</button>

	<button type="button" class="btn btn-info btn-sm estatus" id="{{ $id }}">
	    <i class="fas fa-edit"></i>
	</button>
@endif