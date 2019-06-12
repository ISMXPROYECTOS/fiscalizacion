@if($id != Auth::user()->id)
	<button type="button" class="btn btn-info btn-sm editar" id="{{ $id }}">
	    <i class="fas fa-edit"></i>
	    <a href="{{ route('usuario-edit', $id) }}"></a>
	</button>

	<button  class="btn btn-danger btn-sm eliminar" id="{{ $id }}">
	    <i class="fas fa-trash-alt"></i>
	    <a href="{{ route('usuario-delete', $id) }}"></a>
	</button>
@endif