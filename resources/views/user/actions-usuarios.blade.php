<button type="button" class="btn btn-primary editar" id="{{ $id }}">
    <i class="fas fa-edit"></i>
    <a href="{{ route('usuario-edit', $id) }}"></a>
</button>

<button type="button" class="btn btn-danger eliminar" id="{{ $id }}">
    <i class="fas fa-trash-alt"></i>
    <a href="{{ route('usuario-delete', $id) }}"></a>
</button>
