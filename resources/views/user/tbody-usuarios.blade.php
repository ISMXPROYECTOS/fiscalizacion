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
            <a href="{{ route('editar-usuario', ['id' => $usuario->id]) }}" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></a>
            <a href="{{ route('usuario-delete', ['id' => $usuario->id]) }}" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i></a>
        </td>
    </tr>
    @endif
@endforeach