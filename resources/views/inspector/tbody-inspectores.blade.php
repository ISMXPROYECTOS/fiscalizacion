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
        <a href="{{ route('editar-inspector', ['id' => $inspector->id]) }}" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> </a>
        <a href="{{ route('inspector-delete', ['id' => $inspector->id]) }}" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i></a>
    </td>
</tr>
@endforeach