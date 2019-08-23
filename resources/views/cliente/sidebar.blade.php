<ul class="list-unstyled components">

    <li>
        <a href="/profile"><i class="fas fa-user-edit"></i>
            Perfil de usuario</a>
    </li>
    <li>
        <a href={{route("consultar_viaje")}}><i class="fas fa-search"></i>
            Consultar viaje</a>
    </li>
    <li>
        <a href={{route("historial")}}><i class="fas fa-history"></i>
            historial de viajes</a>
    </li>

    <li>
        <a href={{route("cancelarViaje")}}><i class="fas fa-window-close"></i>
            cancelar viajes</a>
    </li>

</ul>
<ul class="list-unstyled">
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> {{ __('Cerrar sesión') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>