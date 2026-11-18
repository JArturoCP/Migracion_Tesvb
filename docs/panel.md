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
| `resources/views/layouts/panel.blade.php` | Layout nuevo de `/inicio` y de las pantallas migradas. Secciones `title` y `content` (iguales a `layouts.app`), `@stack('cabeza')`, `@stack('scripts')`, puente de Bootstrap y pie institucional (§11.2). Sin Bootstrap; `@vite(['resources/css/marco.css', 'resources/js/panel.js'])` |
| `resources/views/partials/panel/sidebar.blade.php` | **Copia de `partials/menu_admin.blade.php`** con el marcado de TailAdmin |
| `resources/views/panel/inicio.blade.php` | **Copia de `home_recargado.blade.php`** con el marcado de TailAdmin y una tarjeta de bienvenida |
| `resources/views/partials/panel/periodos.blade.php` | Copia de `partials/periodos.blade.php` (mismo PHP, mismos enlaces `/periodo/{id}`), como modal de Alpine |
| `resources/views/partials/panel/header.blade.php`, `buscador`, `tema`, `usuario` | Header de la plantilla: botón del menú, buscador, modo oscuro y menú de usuario (insignia copiada de `menu_admin` L340-370 y "Cerrar sesión" con el mismo POST `/logout`) |
| `resources/views/partials/panel/sidebar_encabezado.blade.php` | Logo del sidebar |
| `resources/views/partials/panel/periodo_header.blade.php` | Botón "Cambiar periodo" del **header** (junto al modo oscuro). Sustituye a los 4 íconos de calendario del menú viejo, con las mismas condiciones (se muestra si se cumple cualquiera) |
| `resources/views/partials/panel/iconos/*.blade.php` | Íconos SVG de la plantilla |
| `resources/css/marco.css` y `resources/css/panel/*.css` | Tema de TailAdmin (MIT) para Tailwind v4 con prefijo `tw:` (§10), base del contenido, componentes y librerías (§11); fuente Outfit local |
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
- **`public/build` se versiona en git.** Después de cualquier cambio en `resources/css/**`, `resources/js/**` o en las clases de las vistas del panel, compila y commitea `public/build`. El servidor de producción **no** necesita Node: basta con `git pull`.
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

## 7. Cómo migrar un módulo al nuevo diseño

Regla: **la lógica no cambia**. Se conservan rutas, controladores, consultas, `@if`/`@foreach`, permisos,
`action` y `method` de cada formulario, `name` de los campos, `id` y clases que usan los scripts, y los datos.
Solo cambia el marcado visual. Ejemplos completos: las vistas del piloto (§11.4).

1. **Guarda la versión anterior** en `tests/Fixtures/vistas_antes/<misma ruta>.blade.php` (para la prueba de comparación).
2. **Cambia el layout:** `@extends('layouts.app')` (o `tutorias.app_tutorias`) → `@extends('layouts.panel')`. Las secciones `title` y `content` se conservan.
3. **Carga sus librerías con `@push('cabeza')`**, en el mismo orden que su layout anterior y **sin el CSS de Bootstrap**. Ya hay dos parciales:
   - `@include('partials.panel.recursos_app', ['datatables' => true, 'graficas' => true, 'validacion' => true, 'colorpicker' => true, 'blockui' => true])` — jQuery, Font Awesome 4.7, SweetAlert2/TNotify y, si se piden, DataTables 1.13.6 local, Highcharts, bootstrap-colorpicker, jQuery Validate y blockUI (pantallas que venían de `layouts.app`). **Carga todo plugin que llame el script**, aunque sea fuera de `$(document).ready`: si falta, el error detiene el script completo;
   - `@include('tutorias.partials.recursos_panel', ['calendario' => true])` — `js_tutorias/app.js` (jQuery + Vue 2 + axios), Font Awesome 5 y, si se pide, FullCalendar (pantallas de Tutorías).
4. **Reescribe el marcado con los componentes** `x-panel.*` (§11): encabezado, tarjetas, tablas, botones, campos, modales, alertas, badges y pestañas. Para pantallas CRUD de `layouts.app` se puede partir de `tools/panel/estructura_bs.php` y `tools/panel/bs2tw.php` (§11.5) y revisar a mano. Corrige el HTML mal anidado conservando lo que hace el navegador (ver `docs/LOTE1_DIRECTIVO.md` §4).
5. **Modales:** el `div.modal` de Bootstrap pasa a `<x-panel.modal id="mismo_id">`. `data-toggle="modal"`, `data-dismiss="modal"` y `$('#id').modal('show'|'hide')` siguen funcionando sin cambiar el script (puente, §11.3).
6. **Contenedores de Vue** (`new Vue({ el: '#x' })`): agrega `x-ignore` al elemento `#x` para que Alpine no interprete sus `@click` y `:class`. En atributos de componentes Blade, `:atributo` es PHP; para Vue usa `v-bind:atributo`.
7. **Agrega la carpeta a Tailwind:** `@source "../views/<carpeta>";` en `resources/css/marco.css`.
8. **Prueba:** agrega la vista al dataset de `tests/Feature/Panel/PilotoVistasTest.php` (compara formularios, campos, ids, clases de scripts y textos con la versión anterior) y su ruta a `tests/Integracion/PilotoHttpTest.php` (200 con la cuenta del rol, contra MySQL local). Revisa en el navegador: consola sin errores, modales, pestañas, tablas y envío de formularios.
9. **Compila** (`npm run build`) y commitea `public/build`.

Cuidados que salieron en el piloto:

- Las clases `tw:` son `!important`. Un `style="display:none"`, `.hide()` de jQuery o `v-show` de Vue igual ocultan (regla en `componentes.css`), pero **un contenedor que se oculta con una regla CSS propia** (p. ej. `<style>.condicion{display:none}</style>`) no debe llevar clases de display (`tw:flex`, `tw:grid`…).
- Algunos scripts cuentan elementos de toda la página (`$("input:checked").length`): el sidebar y el header no tienen campos marcados, así que los conteos no cambian; no agregues campos marcados fuera del contenido.
- Un `<a href="">` dibujado con `<x-panel.boton href="">` navega: si el original era `<button href="">`, no pases `href`.
- Las clases de estado que usan los scripts (`active`, `show`, `in`, `collapse`, `hidden`, `tab-pane`, `tab-content`) se conservan; `componentes.css` les da el comportamiento que antes daba Bootstrap.

## 8. Pendientes

| Tema | Detalle |
|---|---|
| **Enlace dudoso M174 (#54)** | "Seg. de Oficios › Editar" lleva a `/docentes/modificar/`, el mismo destino que "Datos P. › Editar". Parece un error de copia. Corregir en un commit aparte, en **los dos** archivos del menú |
| **Enlaces dudosos M214-M216 (#95-97)** | En P.A.AC (oculto), las etiquetas no corresponden a su URL ("Modificar P.A.A" → `/paa/subprograma_paa`, "Cargar evidencia" → `/paa/acciones_paa`, "Modificar" → `/paa/unidad_medida_paa`). Corregir en un commit aparte, en los dos archivos |
| M112 | `/servicio_social/asignar_tipo_servicio/` no tiene ruta (está oculto) |
| Inglés y Tutorías | Siguen con `layout_ingles` y `app_tutorias`; migrarlos después |
| ~~Pantalla "CARGANDO"~~ | **Resuelto:** `home.blade.php` ya no usa `layouts.app`; es una página mínima del panel (logo y spinner) que pasa de inmediato a `/inicio` con `window.location.replace`, con `<noscript>` de respaldo. `HomeController@index` y las rutas no cambiaron |
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
- **`resources/css/marco.css`** (sustituye a `panel.css`; importa `resources/css/panel/*.css`): Tailwind v4 con **prefijo `tw:`** (`tw:flex`, `tw:hidden`, `tw:dark:bg-gray-900`…), sin preflight global y con las utilidades fuera de capas y en `!important`, para convivir con Bootstrap 3/4 en la misma página. El reinicio de estilos con `!important` solo aplica dentro de `.tw-marco` (sidebar, header y modales del marco); el contenido de `layouts.panel` usa `.tw-modulo`, sin `!important` (§11.2). Las medidas están en px porque Bootstrap 3 fija `html { font-size: 10px }`.
- En las vistas del marco se usa **`x-show.important`** (Alpine), porque las clases de `display` son `!important`.
- **`layouts/marco.blade.php`**: con sesión iniciada, un layout de origen se muestra dentro del sidebar y el header del panel con su mismo `<head>` (Bootstrap, jQuery, Vue, FullCalendar…) y su mismo cuerpo. El contenido va dentro de `x-ignore` para que Alpine no interprete las plantillas Vue (`@click`, `:class`). El marco de los módulos siempre es claro (sin botón de modo oscuro). Sin sesión (invitados) se muestra el diseño original.
- **Tutorías** (`tutorias/app_tutorias.blade.php`) ya usa el marco: el layout se dividió en `tutorias/partials/cabeza`, `encabezado` y `cuerpo` sin cambiar su HTML.
- Scroll de la **página completa** (sidebar `tw:xl:sticky`, header `tw:sticky`), como en el marco, para que funcionen FixedHeader, datepickers y los scripts que usan el scroll de la ventana.
- Al escribir vistas nuevas del panel, **todas las clases de Tailwind llevan `tw:`**. Las clases propias del marco también: `tw:menu-item`, `tw:sidebar`, `tw:custom-scrollbar`…

## 11. Componentes del panel (`resources/views/components/panel/`)

Componentes Blade con el estilo de TailAdmin para rediseñar las pantallas de los módulos. Todos pasan los
atributos extra (`id`, `class`, `name`, `data-*`, `onclick`, `v-if`, `v-model`…) al elemento HTML principal,
así los scripts y Vue siguen encontrando lo mismo. Estilos que no son clases `tw:` en `resources/css/panel/componentes.css`.

### 11.1 Catálogo

**Encabezado de página** (título + breadcrumb; "Inicio" siempre va primero):
```blade
<x-panel.encabezado titulo="Actividades" :migas="['Tutorías' => url('/tutorias/inicioalu')]">
    <x-slot:extra><x-panel.badge>Periodo 2026-1</x-panel.badge></x-slot:extra>
</x-panel.encabezado>
```

**Tarjeta** (`sin-relleno` para que una tabla llegue al borde):
```blade
<x-panel.tarjeta titulo="Docentes" subtitulo="Periodo actual">
    <x-slot:acciones><x-panel.boton tamano="sm">Nuevo</x-panel.boton></x-slot:acciones>
    Contenido…
</x-panel.tarjeta>
```

**Tabla** (las filas van tal cual en el slot; el `id` llega al `<table>`, útil para DataTables):
```blade
<x-panel.tabla id="ejemplo" compacta>
    <thead><tr><th>Nombre</th><th>Grupo</th></tr></thead>
    <tbody>@foreach ($filas as $f)<tr><td>{{ $f->nombre }}</td><td>{{ $f->grupo }}</td></tr>@endforeach</tbody>
</x-panel.tabla>
```

**Botón** (`<button type="button">`; con `href` se dibuja como `<a>`). Variantes: `primario`, `secundario`, `exito`, `peligro`, `advertencia`, `info`, `contorno-primario`, `contorno-exito`, `contorno-peligro`. Tamaños: `sm`, `md`, `lg`.
```blade
<x-panel.boton type="submit">Guardar</x-panel.boton>
<x-panel.boton variante="peligro" tamano="sm" :href="url('/tutorias/pdf/all')" target="_blank">PDF</x-panel.boton>
```

**Input** (`type="file"` usa el estilo de archivo de la plantilla; `ayuda` y `error` opcionales):
```blade
<x-panel.input etiqueta="Correo" name="email" id="email" type="email" required :error="$errors->first('email')" />
```

**Select** (las `<option>` van en el slot):
```blade
<x-panel.select etiqueta="Carrera" name="id_carrera" id="id_carrera">
    @foreach ($carreras as $c)<option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>@endforeach
</x-panel.select>
```

**Textarea** (el valor va en el slot):
```blade
<x-panel.textarea etiqueta="Comentario" name="comentario" id="comentario" rows="4">{{ old('comentario') }}</x-panel.textarea>
```

**Checkbox** y **radio**:
```blade
<x-panel.checkbox name="acepto" id="acepto" value="1">Acepto los términos</x-panel.checkbox>
<x-panel.radio name="pregunta_1" value="5" required>Excelente</x-panel.radio>
```

**Modal** (JS propio, sin Alpine ni Bootstrap; tamaños `sm`, `md`, `lg`, `xl`; `estatico` = no cierra con clic fuera ni Esc):
```blade
<x-panel.boton data-toggle="modal" data-target="#editar">Editar</x-panel.boton>

<x-panel.modal id="editar" titulo="Editar evidencia">
    Contenido…
    <x-slot:pie>
        <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
        <x-panel.boton type="submit">Guardar</x-panel.boton>
    </x-slot:pie>
</x-panel.modal>

{{-- Si un <form> envuelve cuerpo y botones: --}}
<x-panel.modal id="edit" titulo="Evidencia" sin-relleno>
    <form action="{{ url('tutorias/actividad') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="tw-modal-cuerpo">…campos…</div>
        <x-panel.modal-pie><x-panel.boton type="submit">Guardar</x-panel.boton></x-panel.modal-pie>
    </form>
</x-panel.modal>
```
Desde JS: `$('#editar').modal('show')`, `$('#editar').modal('hide')` o `PanelModal.abrir('editar')` / `PanelModal.cerrar('editar')`.
Si un script usa la × del modal original, conserva su clase o su id: `<x-panel.modal id="x" clase-cerrar="close" id-cerrar="acepta2">`.

**Alerta** (`info`, `exito`, `advertencia`, `error`):
```blade
<x-panel.alerta tipo="exito" titulo="Listo">Se guardó la evaluación.</x-panel.alerta>
```

**Badge** (`marca`, `exito`, `advertencia`, `error`, `info`, `gris`):
```blade
<x-panel.badge tono="exito">Activo</x-panel.badge>
```

**Pestañas** — de navegación entre páginas, o de paneles en la misma página (`data-toggle="tab"`):
```blade
<x-panel.pestanas :items="[
    ['etiqueta' => 'Expediente', 'url' => '/tutorias/inicioalu', 'activa' => true],
    ['etiqueta' => 'Actividades', 'url' => '/tutorias/actividad'],
]" />

<x-panel.pestanas :items="[['etiqueta' => 'Datos', 'destino' => '#datos', 'activa' => true], ['etiqueta' => 'Notas', 'destino' => '#notas']]" />
<div class="tab-content">
    <div class="tab-pane active" id="datos">…</div>
    <div class="tab-pane" id="notas">…</div>
</div>
```

**Estado vacío**:
```blade
<x-panel.vacio titulo="Sin actividades" mensaje="Tu tutor aún no registra actividades." />
```

### 11.2 Layout y estilos base

- `layouts/panel.blade.php`: `<body class="tw-modulo">` (reinicio de estilos SIN `!important`, en `resources/css/panel/modulo.css`, para que DataTables, FullCalendar, Highcharts y SweetAlert2 conserven sus estilos), `@stack('cabeza')`, puente, `@stack('scripts')` y pie institucional (`partials/panel/pie.blade.php`; `@section('sin_pie', '1')` lo quita, como en `/inicio`).
- `.tw-pantalla` en un contenedor da tipografía base (h1–h6, label, small) al marcado convertido de Bootstrap.
- `resources/css/panel/librerias.css`: tema de la plantilla para DataTables, FullCalendar 3 y Highcharts.

### 11.3 Puente de Bootstrap (`partials/panel/puente.blade.php`)

Script en línea, después de las librerías de la pantalla. Hace que el código de siempre funcione sin Bootstrap:

| Código existente | Qué hace el puente |
|---|---|
| `data-toggle="modal" data-target="#x"`, `data-dismiss="modal"` | Abre/cierra el `<x-panel.modal id="x">` |
| `$('#x').modal('show' \| 'hide' \| 'toggle')` | Igual, con los eventos `show/shown/hide/hidden.bs.modal` (se pueden cancelar con `preventDefault`) |
| `data-toggle="tab"` / `"pill"`, `$('#a').tab('show')` | Activa la pestaña (`active` en el enlace o su `<li>`) y su panel (`active show in`); respeta `disabled` |
| `data-toggle="collapse"`, `data-parent`, `$('#x').collapse(...)` | Alterna `show`/`in`; con `data-parent` cierra los demás (acordeón) |
| `data-dismiss="alert"` | Quita la alerta |
| `.tooltip()` / `.popover()` de Bootstrap | No hacen nada: se usa el `title` nativo |

Si la pantalla trae Bootstrap JS dentro de otra librería (`js_tutorias/app.js`), el puente quita sus manejadores `data-api` para que no dibuje sus propios modales. También se instala en una segunda copia de jQuery que cargue la pantalla (p. ej. el calendario de Tutorías). Ids que empiezan con número (`href="#5"`) se buscan como lo hace jQuery.

### 11.4 Piloto migrado

Lote 1 del directivo (Generales, Formatos, Horarios, Plantilla): `docs/LOTE1_DIRECTIVO.md`.

| Vistas | Rutas | Rol |
|---|---|---|
| `tutorias/alumnos/{index, incio_registro, expediente, expedienteUpdate, partial/modalNSE}` | `/tutorias/inicioalu`, `/tutorias/Alum`, `/tutorias/AlumActualizar` | Alumno |
| `tutorias/actividades_alumno/actividades_alumno`, `tutorias/calendario_eventos/calendario_eventos` | `/tutorias/actividad`, `/tutorias/calendario` | Alumno |
| `tutorias/eva_tutorias/{alumnos_index, _dos, _tres, encuesta_realizada}` | `/tutoras_evaluacion/evaluacion_al_tutor/` (+ `dos/`, `tres/`) | Alumno |
| `evaluacion_docente/Alumnos/{evaluacion_docente, mensages, mensaje_modi_carga, mensaje_dual}` | `/evaluacion_alumno` | Alumno (`mensages` también lo usa `checar_cargaController`) |
| `evaluacion_docente/Admin/{buscar, reportes2, mencamper, reportes, mensages2}`, `evaluacion_docente/Alumnos/buscar` | `/buscar_profesores`, `/buscar_profesores_carrera`, `/reportes2/…`, `/reportes/…`, `/buscar_alumnos`, `/Migrar` | Directivo (y quien tenga esas rutas) |

La navegación interna de Tutorías (`tutorias/alumnos/partial/navegacion_panel.blade.php`) son pestañas con las mismas condiciones de sesión del menú anterior. Las demás pantallas de Tutorías (tutor, jefe, coordinador…) siguen con `tutorias.app_tutorias` dentro del marco.

### 11.5 Herramientas de conversión (`tools/panel/`)

`php tools/panel/estructura_bs.php resources/views/<vista>.blade.php [opciones]` hace los cambios de estructura de una vista de `layouts.app`: layout y `recursos_app` (opciones separadas por coma: `validacion,datatables`…), título → `x-panel.encabezado`, alerta flash → `x-panel.alerta`, botón flotante, tablas en contenedor y modales de Bootstrap → `x-panel.modal` (conserva el id de `.modal-content` y la clase o id de la ×). Después se pasa `bs2tw.php` y se revisa a mano.

#### Convertidor de clases (`tools/panel/bs2tw.php`)

`php tools/panel/bs2tw.php resources/views/<vista>.blade.php 3|4` reescribe los `class="…"` estáticos de Bootstrap 3 o 4 a clases `tw:` (rejilla, tarjetas/paneles, botones, campos, alertas, tablas, pestañas, glyphicons → Font Awesome 4.7). No toca `:class`/`v-bind:class` ni fragmentos Blade, y conserva las clases de estado y las que usan los `<script>` de la vista. Imprime las clases que conviene revisar a mano (p. ej. modales, que se pasan a `<x-panel.modal>`).
