<div class="sidebar">
    <div id="role" style="visibility: hidden">{{ $activation }}</div>
    @if($activation == 'Administrador')
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">Administradores</li>
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users-create') }}"><i class="nav-icon icon-plus"></i>Nuevo administrador</a></li>
                <li class="nav-title">Producción</li>
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/production-list') }}"><i class="nav-icon icon-grid"></i>Consultar</a></li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    @endif
</div>

<script>
    window.onload = function()
    {
        document.getElementsByClassName("hidden-md-down")[0].innerHTML = document.getElementById('role').textContent
    }
</script>