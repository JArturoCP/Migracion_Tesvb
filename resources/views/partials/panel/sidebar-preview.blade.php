<li>
    <span class="tw:menu-item tw:menu-item-active" aria-current="page">
        @include('partials.panel.iconos.graficas')
        <span class="tw:menu-item-text" :class="sidebarToggle ? 'tw:xl:hidden' : ''">Inicio</span>
    </span>
</li>
@foreach($estudiante['accesos'] as $acceso)
    <li>
        <span class="tw:menu-item tw:menu-item-inactive" aria-disabled="true">
            @include('partials.panel.iconos.'.$acceso['icono'])
            <span class="tw:menu-item-text" :class="sidebarToggle ? 'tw:xl:hidden' : ''">{{ $acceso['titulo'] }}</span>
        </span>
    </li>
@endforeach
