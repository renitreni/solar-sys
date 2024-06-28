
<li class="nav-item @if(request()->routeIs($routeName)) submenu active @endif">
    <a href="{{ route($routeName) }}">
        {{ $slot }}
    </a>
</li>
