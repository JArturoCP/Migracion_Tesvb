# Nuevo diseño de `/inicio` (TailAdmin + Tailwind v4)

Este documento explica cómo está hecho el nuevo diseño de la página de inicio, cómo mantenerlo y cómo migrar más pantallas a él.
Plan aprobado: `docs/PLAN_PANEL.md`. Inventario del menú: `docs/INVENTARIO_MENU.md`.

## 1. Qué cambió y qué no

- **Cambió:** solo el diseño de `/inicio` y de su menú lateral, para todos los roles que llegan a `/inicio`.
- **No cambió:** el login, `HomeController@index`, la sesión, las rutas, los permisos, los módulos que ve cada rol y las pantallas internas de los módulos, que siguen con `layouts/app.blade.php` y el menú de siempre.
- La única línea de lógica modificada es `HomeController2@index`, que ahora devuelve `panel.inicio` en lugar de `home_recargado`, con los mismos datos.

## 2. Archivos

| Archivo | Qué es |
|---|---|
| `resources/views/layouts/panel.blade.php` | Layout nuevo. Secciones `title` y `content` (iguales a `layouts.app`) y `@stack('scripts')`. Carga solo `@vite(['resources/css/panel.css', 'resources/js/panel.js'])` |
| `resources/views/partials/panel/sidebar.blade.php` | **Copia de `partials/menu_admin.blade.php`** con el marcado de TailAdmin |
| `resources/views/panel/inicio.blade.php` | **Copia de `home_recargado.blade.php`** con el marcado de TailAdmin y una tarjeta de bienvenida |
| `resources/views/partials/panel/periodos.blade.php` | Copia de `partials/periodos.blade.php` (mismo PHP, mismos enlaces `/periodo/{id}`), como modal de Alpine |
| `resources/views/partials/panel/header.blade.php`, `buscador`, `tema`, `usuario` | Header de la plantilla: botón del menú, buscador, modo oscuro y menú de usuario (insignia copiada de `menu_admin` L340-370 y "Cerrar sesión" con el mismo POST `/logout`) |
| `resources/views/partials/panel/sidebar_encabezado.blade.php` | Logo del sidebar |
| `resources/views/partials/panel/periodo_header.blade.php` | Botón "Cambiar periodo" del **header** (junto al modo oscuro). Sustituye a los 4 íconos de calendario del menú viejo, con las mismas condiciones (se muestra si se cumple cualquiera) |
| `resources/views/partials/panel/iconos/*.blade.php` | Íconos SVG de la plantilla |
| `resources/css/panel.css` | Tema de TailAdmin (MIT) para Tailwind v4: fuente Outfit local; solo escanea las vistas del panel |
| `resources/js/panel.js` y `resources/js/panel/*` | Alpine (persist, collapse), `dropdown` de TailAdmin, buscador, modal de periodos y modal de periodo de inglés |
| `config/tesvb.php` | Rutas de los logos |
| `public/img/panel/tesvb-icono.png` | Recorte "VB" de `public/img/TESVB.png` para el sidebar colapsado |
| `tests/Feature/Panel/*`, `tests/Support/EscenariosPanel.php` | Pruebas de comparación, avisos e inicio |

### Logo
Para usar el logo oficial, reemplaza `public/img/TESVB.png` y `public/img/panel/tesvb-icono.png`, o cambia las rutas en `config/tesvb.php`. En modo oscuro el logo se muestra sobre un fondo blanco porque el actual tiene texto negro. Si el oficial tiene una versión clara, se pueden quitar las clases `dark:bg-white` de `sidebar_encabezado.blade.php` y `header.blade.php`.

## 3. Mantenimiento doble (importante)

Mientras las pantallas internas sigan con el diseño viejo, **hay dos copias** del menú y del panel:

| Original (pantallas internas) | Copia (`/inicio`) |
|---|---|
| `resources/views/partials/menu_admin.blade.php` | `resources/views/partials/panel/sidebar.blade.php` |
| `resources/views/home_recargado.blade.php` | `resources/views/panel/inicio.blade.php` |
| `resources/views/partials/periodos.blade.php` | `resources/views/partials/panel/periodos.blade.php` |

**Todo cambio en uno se repite en el otro.** Las pruebas detectan si se desincronizan.

### Cómo agregar un módulo o submódulo al menú
1. **En `menu_admin.blade.php`** (diseño viejo), agrégalo como siempre, dentro del `@if` que corresponda:
   ```blade
   <li><a href="{{url('/mi_modulo/nuevo')}}">Nuevo reporte</a></li>
   ```
2. **En `partials/panel/sidebar.blade.php`**, busca el mismo bloque (cada bloque tiene un comentario `[menu_admin Lxxx]` y las mismas condiciones) y agrega el enlace con **la misma URL y la misma condición**, con las clases de la plantilla:
   - Submódulo dentro de un módulo existente:
     ```blade
     <li><a href="{{url('/mi_modulo/nuevo')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Nuevo reporte</a></li>
     ```
   - Módulo nuevo con submenú (usa una clave única, por ejemplo `m100`):
     ```blade
     <li>
         <a href="#" @click.prevent="selected = (selected === 'm100' ? '' : 'm100')" class="group menu-item" :class="selected === 'm100' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
             @include('partials.panel.iconos.paginas', ['clave' => 'm100'])
             <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Mi módulo</span>
             @include('partials.panel.iconos.flecha', ['clave' => 'm100'])
         </a>
         <div x-cloak x-show="$store.buscador.activo || selected === 'm100'" x-collapse>
             <ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                 <li><a href="{{url('/mi_modulo/nuevo')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Nuevo reporte</a></li>
             </ul>
         </div>
     </li>
     ```
   - Enlace directo de primer nivel:
     ```blade
     <li><a href="{{url('/mi_modulo')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
         @include('partials.panel.iconos.paginas')
         <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Mi módulo</span>
     </a></li>
     ```
   - Subgrupo dentro de un submenú (niveles 3 y 4): ver el bloque de SGOE como ejemplo (`<li x-data="{ abierto: false }">`).
3. Si el enlace depende de una condición que ningún escenario de prueba cumple, agrega un escenario en `tests/Support/EscenariosPanel.php` (`escenarios()` y, si hace falta, `preparar()`).
4. Agrega la fila en `docs/INVENTARIO_MENU.md`.
5. Corre la prueba de comparación:
   ```bash
   php artisan test --filter=ComparacionEnlaces
   ```
   Debe terminar con **0 faltantes y 0 sobrantes** en todos los escenarios. Si el nuevo elemento sube el número de combinaciones distintas, actualiza el umbral de la prueba "los escenarios cubren todos los elementos del inventario".
6. Compila y commitea el build (§4).

### Cómo cambiar un aviso del panel
Edita `home_recargado.blade.php` **y** `panel/inicio.blade.php` (cada bloque tiene su comentario `[home_recargado Lxxx]`) y corre:
```bash
php artisan test --filter=Avisos
```

### Íconos disponibles
`cuadricula`, `calendario`, `usuario`, `grupo`, `formularios`, `tablas`, `graficas`, `elementos`, `paginas`, `caja`, `candado` (en `partials/panel/iconos/`).

## 4. Compilar y desplegar

- **Requisitos para compilar:** Node 20+ y npm.
- **Compilar:**
  ```bash
  npm ci
  npm run build
  ```
- **`public/build` se versiona en git.** Después de cualquier cambio en `resources/css/panel.css`, `resources/js/**` o en las clases de las vistas del panel, compila y commitea `public/build`. El servidor de producción **no** necesita Node: basta con `git pull`.
- Si dos ramas compilan a la vez, `public/build/manifest.json` puede dar conflicto: se resuelve compilando de nuevo después de unir las ramas.
- En desarrollo: `npm run dev` crea `public/hot`; detenlo y borra `public/hot` antes de probar el build de producción.
- Todo se sirve localmente: no hay CDNs ni Google Fonts en el panel.

## 5. Revertir
- **Volver al panel anterior:** `git revert` del commit `feat(panel): /inicio usa la vista panel.inicio`. Solo cambia la vista que devuelve `HomeController2@index`; todo lo demás queda igual.
- Las vistas viejas no se borraron, así que no hay nada que restaurar.

## 6. Comportamiento del nuevo diseño
- **Sidebar:** un solo título "MENÚ", con los módulos en el mismo orden que el menú viejo. Los submenús se pliegan y solo hay uno abierto a la vez; el submenú abierto se recuerda (`localStorage`). En escritorio (≥ 1280 px) se colapsa a íconos con el botón del header y se expande al pasar el mouse; en tablet y móvil se abre sobre el contenido.
- **Buscador (Ctrl+K / ⌘K):** filtra en el navegador los enlaces del sidebar, sin distinguir acentos ni mayúsculas, y abre los submenús mientras hay texto. Esc lo limpia. Los elementos ocultos del original siguen ocultos.
- **Modo oscuro:** se guarda en `localStorage.darkMode`.
- **Cambiar periodo:** botón en el **header**, a la derecha, junto al modo oscuro (ícono de calendario y, en pantallas anchas, el periodo actual abreviado, p. ej. "AGO 2026 – ENE 2027"). Aparece con las mismas condiciones que los 4 íconos de calendario del menú viejo y abre el modal con los mismos enlaces `/periodo/{id}`.
- **Cerrar sesión:** solo en el menú de usuario del header (mismo `POST /logout` con CSRF). El sidebar ya no tiene "Salir" ni el ícono de periodo; la prueba de comparación los busca en el header.

## 7. Cómo migrar un módulo al nuevo layout

Cuando se quiera pasar una pantalla interna al diseño nuevo:

1. **Cambia el layout:** `@extends('layouts.app')` → `@extends('layouts.panel')`. Las secciones `title` y `content` se conservan. Los `<script>` que dependan del orden de carga pásalos a `@push('scripts') … @endpush`.
2. **Agrega las vistas a Tailwind:** añade `@source "../views/<carpeta_del_modulo>";` en `resources/css/panel.css`, para que se generen sus clases.
3. **Reescribe las clases de Bootstrap 3** con la tabla de §7.1. No mezcles las dos: `layouts.panel` no carga Bootstrap, y clases como `hidden`, `collapse`, `container`, `table` e `invisible` significan cosas distintas en Tailwind.
4. **Sustituye los plugins de jQuery** (§7.2). `layouts.panel` no carga jQuery, Bootstrap JS, DataTables, Vue 1 ni los pickers.
5. **Prueba:** abre la pantalla con cada rol que la usa, en modo claro y oscuro, en escritorio y en móvil; revisa la consola (sin errores ni 404) y que los formularios conserven `@csrf`, `name` y `action`.
6. **Compila** (`npm run build`) y commitea `public/build`.
7. Cuando **todas** las pantallas usen `layouts.panel`, `menu_admin.blade.php`, `home_recargado.blade.php` y `partials/periodos.blade.php` se pueden retirar, y con ellos el mantenimiento doble.

### 7.1 Equivalencias Bootstrap 3 → Tailwind (estilo TailAdmin)

| Bootstrap 3 | Tailwind / TailAdmin |
|---|---|
| `container` | `mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6` (ya lo pone `layouts.panel`) |
| `row` + `col-md-6` / `col-md-4` / `col-md-12` | `grid grid-cols-12 gap-4 md:gap-6` + `col-span-12 md:col-span-6` / `md:col-span-4` / `col-span-12` |
| `col-md-offset-2` | `md:col-start-3` |
| `panel panel-default` | `rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3` |
| `panel-heading` | `border-b border-gray-200 px-5 py-4 text-base font-semibold text-gray-800 dark:border-gray-800 dark:text-white/90` |
| `panel-body` | `p-5 md:p-6` |
| `btn btn-primary` | `inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600` |
| `btn btn-default` | `inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400` |
| `btn btn-success` / `btn-danger` / `btn-warning` | Igual que `btn-primary` con `bg-green-500` / `bg-red-500` / `bg-amber-500` |
| `btn-sm` / `btn-lg` | `px-3 py-2 text-xs` / `px-5 py-3.5 text-base` |
| `table table-bordered table-striped` | `<div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-800">`, celdas `px-4 py-3 text-left`, filas alternas `odd:bg-gray-50 dark:odd:bg-white/3` |
| `table-responsive` | `overflow-x-auto` |
| `form-group` | `mb-4` |
| `control-label` / `label` (de formulario) | `mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400` |
| `form-control` | `h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90` |
| `select.form-control` | Igual que `form-control` (el plugin `@tailwindcss/forms` da la flecha) |
| `label label-success` (etiqueta) | `inline-flex rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-600 dark:bg-green-500/15 dark:text-green-500` |
| `badge` | `inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700 dark:bg-white/5 dark:text-white/80` |
| `alert alert-success` / `info` / `warning` / `danger` | `rounded-xl border p-4 text-sm` + `border-green-500 bg-green-50 text-green-700` / `border-blue-500 bg-blue-50 text-blue-700` / `border-amber-500 bg-amber-50 text-amber-700` / `border-red-500 bg-red-50 text-red-700` (y sus `dark:` como en `panel/inicio.blade.php`) |
| `modal` | Modal de Alpine (ver `partials/panel/periodos.blade.php`): `fixed inset-0 z-99999 flex items-center justify-center` + fondo `bg-gray-400/50 backdrop-blur-[32px]` + caja `rounded-3xl bg-white p-6 dark:bg-gray-900` |
| `text-center` / `text-right` / `pull-right` | `text-center` / `text-right` / `ml-auto` o `float-right` |
| `hidden-xs` / `visible-xs` | `hidden sm:block` / `sm:hidden` |
| `glyphicon …` | SVG de `partials/panel/iconos` o de la plantilla |
| `nav nav-tabs` | `flex gap-2 border-b border-gray-200` + pestañas con `x-data="{ tab: '…' }"` |

### 7.2 Sustitución de plugins de jQuery

| Antes | Después |
|---|---|
| `$('#x').modal('show')` / `data-toggle="modal"` | Modal de Alpine: `x-data="{ abierto: false }"`, `x-show="abierto"`, abrir con `@click="abierto = true"` o un evento (`$dispatch('abrir-x')` + `@abrir-x.window`) |
| `data-toggle="dropdown"` | Componente `dropdown` de TailAdmin (ya registrado): `x-data="dropdown({ placement: 'bottom-end' })"` (ver `partials/panel/usuario.blade.php`) |
| `collapse` / acordeones | `x-show` + `x-collapse` |
| `tooltip` | Atributo `title` o el componente `tooltip` de la plantilla (`src/js/components/ui/tooltip.js`) |
| DataTables | Para listas cortas: búsqueda y orden con Alpine (`x-model` + filtro). Para tablas grandes: paginación y filtros del lado del servidor con `->paginate()` de Laravel. Alternativa sin jQuery: Simple-DataTables (npm, sin CDN) |
| bootstrap-datepicker / pickadate / timepicker | `<input type="date">`, `<input type="time">`, `<input type="datetime-local">`; si se necesita más: flatpickr (npm), que es el que usa TailAdmin |
| bootstrap-colorpicker | `<input type="color">` |
| bootstrap-toggle | Interruptor con Alpine y clases (ver "Toggle switch" en la plantilla) |
| blockUI | Estado de carga con Alpine: `x-data="{ cargando: false }"` + capa `fixed inset-0` con `x-show="cargando"` |
| `$.get` / `$.ajax` | `fetch()` (con `X-CSRF-TOKEN` de `<meta name="csrf-token">` para POST) o `axios` (ya está en `package.json`) |
| SweetAlert2 / `tesvb-notify.js` | Se pueden importar desde npm en `resources/js/panel.js` si se necesitan; no cargarlos desde `public/js` |
| Highcharts | ApexCharts (npm), como en la plantilla |

## 8. Pendientes

| Tema | Detalle |
|---|---|
| **Enlace dudoso M174 (#54)** | "Seg. de Oficios › Editar" lleva a `/docentes/modificar/`, el mismo destino que "Datos P. › Editar". Parece un error de copia. Corregir en un commit aparte, en **los dos** archivos del menú |
| **Enlaces dudosos M214-M216 (#95-97)** | En P.A.AC (oculto), las etiquetas no corresponden a su URL ("Modificar P.A.A" → `/paa/subprograma_paa`, "Cargar evidencia" → `/paa/acciones_paa`, "Modificar" → `/paa/unidad_medida_paa`). Corregir en un commit aparte, en los dos archivos |
| M112 | `/servicio_social/asignar_tipo_servicio/` no tiene ruta (está oculto) |
| Inglés y Tutorías | Siguen con `layout_ingles` y `app_tutorias`; migrarlos después |
| Pantalla "CARGANDO" | `home.blade.php` muestra 1 s el diseño viejo antes de `/inicio` |
| Pantallas internas | Siguen con `layouts.app`; migrarlas una por una (§7) |
| `IncidenciasController@vista5` | **Descartado.** Se había anotado un posible error (uso del objeto `$id_personal`), pero la L252 lo reasigna a `$id_personal->id_personal` y la concatenación de la L281 está comentada. Se comprobó contra MySQL: la pantalla funciona bien (ver `docs/DASHBOARD_ROLES.md` §2.5) |
| `<ul>` sin cerrar en `menu_admin` | El bloque del jefe de división (L873) abre un `<ul class="nav">` que nunca cierra; el navegador lo corrige solo. Sin efecto en el panel nuevo |
| MySQL | Las pruebas usan SQLite. Validar con la BD real cuando esté disponible (consultas en `docs/INVENTARIO_MENU.md`) |

## 9. Dashboard por rol

Debajo de la bienvenida y de los avisos, `/inicio` muestra un dashboard con los componentes de TailAdmin (métricas, barras, medidor radial, línea, lista con porcentajes y tabla), con **datos reales** del rol.

| Archivo | Qué es |
|---|---|
| `app/Services/Panel/DatosDirectivo.php` | Datos del directivo: consultas de solo lectura, parámetros enlazados, caché de 10 minutos por periodo, `null` si falla |
| `app/View/Composers/PanelInicioComposer.php` | Elige el dashboard según la sesión y entrega `$tablero` y `$perfilTablero` a `panel.inicio` (registrado en `AppServiceProvider`) |
| `resources/views/panel/dashboard/*.blade.php` | Bloques de la plantilla y el acomodo por rol (`directivo.blade.php`) |
| `resources/js/panel/graficas.js` | Gráficas ApexCharts (opciones de la plantilla); ApexCharts se carga solo en páginas con gráficas |
| `tests/Feature/Panel/DashboardDirectivoTest.php` | Reglas, solo lecturas, caché, "Sin datos" y que otros roles no lo vean |

- Hoy solo el **directivo** tiene dashboard. La propuesta para los demás roles (alumno, docente, jefe de división, servicios escolares y un genérico), las consultas, la validación contra MySQL y los pasos para agregar un rol están en **`docs/DASHBOARD_ROLES.md`**.
- Cada indicador replica la regla de una pantalla existente (Estadísticas, Ver Horarios Docentes, índice de reprobación), para que los números coincidan.
- Si un dato no está disponible se muestra "Sin datos"; nunca se inventan números.
- La caché usa el store configurado (`CACHE_STORE`); para ver cambios de inmediato: `php artisan cache:clear`.

## 10. Marco de los módulos y prefijo `tw:`

- **Una sola copia del sidebar y del header** (`partials/panel/*`) para `/inicio` y para las pantallas de los módulos.
- **`resources/css/marco.css`** (sustituye a `panel.css`): Tailwind v4 con **prefijo `tw:`** (`tw:flex`, `tw:hidden`, `tw:dark:bg-gray-900`…), sin preflight global y con las utilidades fuera de capas y en `!important`, para convivir con Bootstrap 3/4 en la misma página. El reinicio de estilos solo aplica dentro de `.tw-marco` (sidebar, header, modales del marco y todo `/inicio`). Las medidas están en px porque Bootstrap 3 fija `html { font-size: 10px }`.
- En las vistas del marco se usa **`x-show.important`** (Alpine), porque las clases de `display` son `!important`.
- **`layouts/marco.blade.php`**: con sesión iniciada, un layout de origen se muestra dentro del sidebar y el header del panel con su mismo `<head>` (Bootstrap, jQuery, Vue, FullCalendar…) y su mismo cuerpo. El contenido va dentro de `x-ignore` para que Alpine no interprete las plantillas Vue (`@click`, `:class`). El marco de los módulos siempre es claro (sin botón de modo oscuro). Sin sesión (invitados) se muestra el diseño original.
- **Tutorías** (`tutorias/app_tutorias.blade.php`) ya usa el marco: el layout se dividió en `tutorias/partials/cabeza`, `encabezado` y `cuerpo` sin cambiar su HTML.
- Scroll de la **página completa** (sidebar `tw:xl:sticky`, header `tw:sticky`), como en el marco, para que funcionen FixedHeader, datepickers y los scripts que usan el scroll de la ventana.
- Al escribir vistas nuevas del panel, **todas las clases de Tailwind llevan `tw:`**. Las clases propias del marco también: `tw:menu-item`, `tw:sidebar`, `tw:custom-scrollbar`…
