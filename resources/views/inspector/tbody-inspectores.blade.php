@foreach ($inspectores as $inspector)
<tr>
    <td>{{ $inspector->nombre }}</td>
    <td>{{ $inspector->apellidopaterno }}</td>
    <td>{{ $inspector->apellidomaterno }}</td>
    <td>{{ $inspector->clave }}</td>
    <td>
        @if ($inspector->estatus == 'A')
        <span class="badge badge-success">Activo</span>
        @elseif ($inspector->estatus == 'B')
        <span class="badge badge-danger">Baja</span>
        @elseif ($inspector->estatus == 'S')
        <span class="badge badge-warning">Suspendido</span>
        @elseif ($inspector->estatus == 'V')
        <span class="badge badge-info">Vigente</span>
        @endif
    </td>
    <td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarInspector">
            <i class="fas fa-edit"></i>
        </button>

        <button type="button" class="btn btn-danger eliminar" data-toggle="modal" data-target="#eliminarInspector" id="{{ $inspector->id }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
@endforeach