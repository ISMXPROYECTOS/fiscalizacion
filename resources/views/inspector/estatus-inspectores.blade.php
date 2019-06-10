@if ($estatus == 'A')
<span class="badge badge-success">Activo</span>
@elseif ($estatus == 'B')
<span class="badge badge-danger">Baja</span>
@elseif ($estatus == 'S')
<span class="badge badge-warning">Suspendido</span>
@elseif ($estatus == 'V')
<span class="badge badge-info">Vigente</span>
@endif
