<li class="nav-item @if (request()->route()->getPrefix() == $prefix) active @endif">
    <a data-bs-toggle="collapse" href="#{{ $prefix }}" @if (request()->route()->getPrefix() != $prefix) class="collapsed" @endif
        @if (request()->route()->getPrefix() != $prefix) aria-expanded="false" @else aria-expanded="true" @endif>
        {{ $slot }}
        <span class="caret"></span>
    </a>
    <div class="collapse @if (request()->route()->getPrefix() == $prefix) active show @endif" id="{{ $prefix }}"
        style="background-color: #161b2c; padding-bottom: 10px;">
        <ul class="nav nav-collapse">
            @foreach ($sub as $key => $item)
                <li @if (request()->routeIs($item) == $item) class="active" @endif>
                    <a href="{{ route($item) }}">
                        <span class="sub-item">{{ $key }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>
