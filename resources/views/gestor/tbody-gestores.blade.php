@foreach ($gestores as $gestor)
    <tr>
        <td>{{ $gestor->nombre }}</td>
        <td>{{ $gestor->apellidopaterno }}</td>
        <td>{{ $gestor->apellidomaterno }}</td>
        <td>{{ $gestor->telefono }}</td>
        <td>{{ $gestor->celular }}</td>
        <td>{{ $gestor->correoelectronico }}</td>
        <td>{{ $gestor->ine }}</td>
        <td>
            @if ($gestor->estatus == 'A')
            <span class="badge badge-success">Activo</span>
            @elseif ($gestor->estatus == 'B')
            <span class="badge badge-danger">Baja</span>
            @elseif ($gestor->estatus == 'S')
            <span class="badge badge-warning">Suspendido</span>
            @elseif ($gestor->estatus == 'V')
            <span class="badge badge-info">Vigente</span>
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-primary editar"  id="{{ $gestor->id }}">
                <i class="fas fa-edit"></i>
            </button>

            <button type="button" class="btn btn-danger eliminar"  id="{{ $gestor->id }}">
                <i class="fas fa-trash-alt"></i>
            </button>

        </td>
    </tr>
@endforeach