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
            <button type="button" data-toggle="modal" data-target="#editar-gestor" id="btn-editar-gestor" class="btn btn-edit btn-sm editar">
                <i class="fas fa-edit"></i>
            </button>
            <!--<a href="#" id="{{ $gestor->id }}" class="btn btn-edit btn-sm editar"><i class="fas fa-edit"></i></a>-->
            <a href="#" id="{{ $gestor->id }}" class="btn btn-delete btn-sm eliminar"><i class="fas fa-trash-alt"></i></a>
        </td>
    </tr>
@endforeach