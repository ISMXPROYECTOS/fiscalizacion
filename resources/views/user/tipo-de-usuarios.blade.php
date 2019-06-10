@if ($role == 'ROLE_ADMIN')
    <span class="badge badge-success">Administrador</span>
    @elseif ($role == 'ROLE_INSPECTOR')
    <span class="badge badge-warning">Inspector</span>
    @elseif ($role == 'ROLE_VENTANILLA')
    <span class="badge badge-info">Ventanilla</span>
@endif