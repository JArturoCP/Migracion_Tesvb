{{-- Sidebar del nuevo diseño (estructura de TailAdmin: sidebar/index.html). --}}
<a class="sr-only" href="#main-content">Saltar al contenido</a>

{{-- Fondo oscuro al abrir el sidebar en móvil --}}
<div
    x-cloak
    x-show="sidebarToggle"
    class="fixed inset-0 z-99 bg-gray-900/50 backdrop-blur-xs xl:hidden"
    aria-hidden="true"
    @click="sidebarToggle = false"
    x-transition.opacity
></div>

<aside
    x-cloak
    :class="sidebarToggle ? 'translate-x-0 xl:w-22.5' : '-translate-x-full'"
    class="sidebar fixed top-0 left-0 z-9999 flex h-screen w-72.5 flex-col border-r border-gray-200 bg-white px-5 transition-all duration-300 xl:static xl:translate-x-0 dark:border-gray-800 dark:bg-black"
    @click.outside="if (window.innerWidth < 1280) sidebarToggle = false"
    aria-label="Menú lateral"
>
    @include('partials.panel.sidebar_encabezado')

    <div class="no-scrollbar flex flex-1 flex-col overflow-y-auto duration-300 ease-linear">
        <nav x-data="{ selected: $persist('').as('panel_menu_abierto') }" aria-label="Menú principal">
            <div>
                <h3 class="mb-4 text-xs leading-5 text-gray-400 uppercase">
                    <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">MENÚ</span>
                </h3>

                <ul class="mb-6 flex flex-col gap-1" data-panel-menu>
                    {{-- El contenido del menú (copia de partials/menu_admin.blade.php) se agrega en el siguiente paso. --}}
                </ul>
            </div>
        </nav>
    </div>
</aside>
