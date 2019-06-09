@foreach ($usuarios as $usuario)
    @if($usuario->id != Auth::user()->id)
    <tr>
        <td>{{ $usuario->usuario }}</td>
        <td>{{ $usuario->activo }}</td>
        <td>
            @if ($usuario->role == 'ROLE_ADMIN')
            <span class="badge badge-success">Administrador</span>
            @elseif ($usuario->role == 'ROLE_INSPECTOR')
            <span class="badge badge-warning">Inspector</span>
            @elseif ($usuario->role == 'ROLE_VENTANILLA')
            <span class="badge badge-info">Ventanilla</span>
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-primary editar"  id="{{ $usuario->id }}">
                <i class="fas fa-edit"></i>
            </button>

            <button type="button" class="btn btn-danger eliminar"  id="{{ $usuario->id }}">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
    @endif
@endforeach