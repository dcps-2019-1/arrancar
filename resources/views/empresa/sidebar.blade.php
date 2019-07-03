<ul class="list-unstyled components">

    <li>
    <a href="/profile"><i class="fas fa-user-edit"></i>
        Perfil de usuario</a>
    </li>
    <li>
        <a href="/empresa/registrar-conductor"><i class="fas fa-user-plus"></i> Registrar conductor</a>
    </li>
    <li>
        <a href="/empresa/registrar-bus"><i class="fas fa-bus"></i>  Registrar bus</a>
    </li>
    <li>
        <a href="/empresa/programar-viaje"><i class="fas fa-road"></i> Programar viaje</a>
    </li>
    <li>
        <a href="/empresa/registrar-ruta"><i class="fas fa-map-marked-alt"></i> Registrar ruta</a>
    </li>
    <li>
        <a href="/empresa/programar-mantenimiento"><i class="fas fa-wrench"></i> Programar mantenimiento</a>
    </li>
    <li>
        <a href="/empresa/consultar-informacion"><i class="fas fa-question-circle"></i> Consultar información</a>
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