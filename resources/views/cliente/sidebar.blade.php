<ul class="list-unstyled components">

    <li>
        <a href="/profile"><i class="fas fa-user-edit"></i>
            Perfil de usuario</a>
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