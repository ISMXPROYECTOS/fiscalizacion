<button type="button" class="btn btn-info btn-sm editar" id="{{ $id }}">
    <i class="fas fa-edit"></i>
    <a href="{{ route('inspector-edit', $id) }}"></a>
</button>

<button type="button" class="btn btn-danger btn-sm eliminar" id="{{ $id }}">
    <i class="fas fa-trash-alt"></i>
    <a href="{{ route('inspector-delete', $id) }}"></a>
</button>
