# Plan: nuevo diseño de `/inicio` (TailAdmin + Tailwind v4)

Rama: `cacique`. Estado: **plan aprobado en alcance, pendiente de visto bueno para iniciar la Fase 3**.
Referencias: `docs/ANALISIS_SISTEMA.md`, `docs/INVENTARIO_MENU.md` (328 elementos, todos los roles) y la plantilla en `plantilla_dashboard/tailadmin-free/` (TailAdmin Free 2.5.1, MIT; ignorada en git).

## 1. Alcance

**Solo cambia el diseño de `/inicio` para cada rol.** No se reorganiza, no se mueve y no se reinterpreta nada.

- El sidebar nuevo es una **copia literal** de `menu_admin.blade.php` con HTML y clases de TailAdmin.
- El dashboard nuevo es una **copia literal** de `home_recargado.blade.php` con HTML y clases de TailAdmin, más una tarjeta de bienvenida.
- `HomeController2@index` solo cambia el nombre de la vista que devuelve.

**No se tocan:** `partials/menu_admin.blade.php`, `layouts/app.blade.php`, `home_recargado.blade.php`, `home.blade.php`, `partials/periodos.blade.php`, `HomeController`, la sesión, las rutas, los permisos, las pantallas de los módulos, Inglés (`layout_ingles`) ni Tutorías (`app_tutorias`).

**Descartado del plan anterior:** MenuPrincipal, ElementoMenu, ContextoMenu, PerfilPanel, PanelComposer, PanelInicioService, PANEL_NUEVO_ROLES, tarjetas de acceso rápido, indicadores, gráficas y apexcharts.

## 2. Frontend (Vite del proyecto)

| Cambio | Detalle |
|---|---|
| `package.json` | `tailwindcss` ^3 → **^4.3**; se agregan `@alpinejs/persist`, `@alpinejs/collapse`, `@floating-ui/dom`, `tw-animate-css` y `@fontsource-variable/outfit`; se quitan `autoprefixer` y `postcss`. Se conservan `@tailwindcss/vite`, `@tailwindcss/forms`, `alpinejs`, `axios`, `laravel-vite-plugin`, `vite` y `concurrently` |
| `vite.config.js` | Entradas `resources/css/app.css`, `resources/js/app.js` (Breeze, para que no falle `layouts/guest.blade.php`), `resources/css/panel.css` y `resources/js/panel.js`; plugin `tailwindcss()` |
| Eliminar | `postcss.config.js`, `tailwind.config.js` y `public/hot` (local) |
| `resources/css/app.css` | Reescrito con la sintaxis de v4 |
| `resources/css/panel.css` | Basado en `src/css/style.css` de la plantilla: comentario con la licencia MIT de TailAdmin, Outfit local, `@import "tailwindcss" source(none)` + `@source` solo a las vistas nuevas; `@theme`, `dark` y `@utility menu-*` sin cambios |
| `resources/js/panel.js` (+ `resources/js/panel/*`) | Alpine con persist y collapse, `dropdown.js` de la plantilla (MIT) y los componentes del buscador y del modal de periodos |
| `.gitignore` | Se quita `/public/build`; el build se versiona |

## 3. Vistas nuevas

| Archivo | Origen y contenido |
|---|---|
| `resources/views/layouts/panel.blade.php` | Estructura de `src/pages/index.html`: `<body x-data>` con `darkMode`, `sidebarToggle`, etc., sidebar + header + `@yield('content')`, secciones `title` y `content`, `@stack('scripts')`. Script en línea de 3 líneas para aplicar el modo oscuro antes de pintar. Sin Bootstrap, jQuery, Vue 1 ni CDNs |
| `resources/views/partials/panel/header.blade.php` | Header de la plantilla: botón del menú, **buscador** que filtra en el navegador los enlaces del sidebar (Ctrl+K), modo oscuro, **insignia de usuario copiada literalmente** de `menu_admin` L340-370 (misma lógica: jefe/consultas, profesor de inglés o resto) y **Cerrar sesión** con el mismo POST `/logout` + CSRF. Sin campana ni selector de idioma |
| `resources/views/partials/panel/sidebar.blade.php` | **Copia de `menu_admin.blade.php`** (ver §4) |
| `resources/views/partials/panel/periodos.blade.php` | Copia de `partials/periodos.blade.php` con **el mismo bloque PHP** (lectura de `arre_periodos`, `periodo_actual`, `p1`, `p2`) y los mismos enlaces `GET /periodo/{id}`. Solo cambia a un modal de Alpine (sin jQuery ni modal de Bootstrap), con las mismas flechas ↑↓ y el mismo rango de anterior, actual y siguiente |
| `resources/views/partials/panel/iconos/*.blade.php` | SVG de la plantilla, uno por archivo |
| `resources/views/panel/inicio.blade.php` | **Copia de `home_recargado.blade.php`** (ver §5) |
| `config/tesvb.php` | Solo dos claves: `logo` (`img/TESVB.png`) y `logo_icono` (`img/panel/tesvb-icono.png`), para reemplazarlos fácilmente por el logo oficial |
| `public/img/panel/tesvb-icono.png` | Recorte de los cuadros "VB" de `TESVB.png` para el sidebar colapsado. En modo oscuro el logo completo va sobre un fondo blanco redondeado |

## 4. Sidebar = copia de `menu_admin.blade.php`

**Se conserva literalmente:**
- Todo el bloque PHP inicial (L2-290): banderas, variables y las consultas de tutor de reprobación, responsable de área, alumno PIASE y SGOE, **en el mismo lugar de la vista**.
- Cada `@if / @elseif / @else / @endif` con su condición exacta.
- Los `<?php ?>` intermedios (`$unidad`, `$id_per`, `$tipo_p`, `$personal_tesvb`, `$encargado_ambiental`, el bloque del docente con actividad que **guarda `id_carrera` en la sesión** (L447-462), la consulta de docente investigador y la carrera del alumno).
- Cada `href` y su texto (con acentos corregidos en las etiquetas), los duplicados y los elementos con `display:none` (se mantienen ocultos).
- Los 4 íconos de periodo y el cambio de carrera, con sus mismas condiciones. Ahora abren el modal de Alpine o un dropdown, en lugar de los de Bootstrap.
- El enlace "Salir" (POST `/logout`).

**Solo cambia:**
- Las etiquetas de Bootstrap (`<ul class="nav navbar-nav">`, `<li class="dropdown">`, `dropdown-menu`, `dropdown-submenu`) pasan al marcado de la plantilla. El primer nivel usa `menu-item` con ícono, flecha y `x-collapse`; el segundo, `menu-dropdown-item`; los niveles 3 y 4 (SGOE, Generales › Académico, Inventario TESVB) son subgrupos plegables dentro del dropdown.
- **Un solo título "MENÚ"** y los módulos **en el mismo orden** que hoy, como elementos de primer nivel.
- Sidebar colapsable (solo íconos) y fuera de pantalla en móvil, como en la plantilla.
- El JS jQuery del final (submenús, tooltips) se sustituye por Alpine. Los badges y el AJAX de oficios ya estaban comentados o sin llamar, así que se quedan comentados igual. El modal `#modal_modificar_periodo` y `.periodo_ingles` (solo del perfil de inglés) se copian con su condición, pero en Alpine.
- Se quitan el envoltorio `@section('menu') … @endsection` y la fila superior de insignias, que pasa al header.

Cada bloque copiado lleva un comentario con su rango de líneas de origen (`{{-- menu_admin L1051-1187 --}}`) para poder auditarlo.

## 5. Dashboard = copia de `home_recargado.blade.php`

**Se conserva literalmente:** el bloque PHP inicial (L4-125, incluido el cálculo del aviso de tutor en la vista), cada `@if` y cada texto (con acentos corregidos):
- El aviso verde RETÍCULA/DOCENTE (`jefe_division || directivo`).
- El mensaje `men`, con la nota de fecha si hay `profesor_men`.
- El aviso de canalización por reprobación con su botón.
- La tarjeta de encuestas del alumno con sus 4 botones.
- El modal de adeudos, que se sigue abriendo al cargar.

**Solo cambia:**
- El diseño a las tarjetas y alertas de la plantilla (`rounded-2xl`, colores `brand`, `success` y `warning`, `dark:`).
- Los `onclick="window.location=…"` pasan a enlaces con la misma URL.
- El modal pasa a Alpine (sin `$('#modal_adeudo').modal('show')`).

**Se agrega arriba:** una tarjeta de bienvenida con `Session::get('nombre')` y `Session::get('nombre_periodo')`. No hay consultas nuevas.

**Pendiente de confirmar:** el bloque de diagnóstico `?debug_tutor=1` (L173-191). Antes se acordó no migrarlo; con "misma lógica" se podría copiar tal cual. Por defecto **no se copia** (decisión anterior).

## 6. Controlador

```php
// HomeController2@index — única línea modificada
return view('panel.inicio', compact(/* exactamente las mismas variables que hoy */));
```

Esto aplica a todos los roles que llegan a `/inicio`. **Para revertir:** `git revert` de ese commit, que devuelve `home_recargado`.

## 7. Pruebas (Pest, SQLite en memoria, patrón de `tests/Unit/EditarDocenteTest.php`)

| Prueba | Qué verifica |
|---|---|
| `tests/Feature/Panel/ComparacionEnlacesTest.php` | Para cada rol y variante, renderiza `partials.menu_admin` (vía `@yield('menu')`) y `partials.panel.sidebar` con la misma sesión y los mismos datos. Extrae todos los `href` y `action` con su método (incluidos los ocultos, cada lado con su marca de oculto) y exige **0 faltantes y 0 sobrantes, con repeticiones**. También compara las condiciones de los íconos de periodo y del cambio de carrera |
| `tests/Feature/Panel/AvisosTest.php` | Con los mismos datos, `home_recargado` y `panel.inicio` muestran los mismos avisos: textos de `men`, nota de fecha, aviso verde, aviso de tutor (y su conteo), URLs de las encuestas y lista de adeudos del modal |
| `tests/Feature/Panel/InicioTest.php` | `/inicio` devuelve `panel.inicio` con `layouts.panel`, y la página no incluye Bootstrap, jQuery ni URLs externas |

**Roles y variantes:** alumno (semestres < 5, 5-7 y ≥ 8; carreras 2, 6 y 8; `ver_eva`/`ver_carga`; etapas de residencia y titulación; encuestas y adeudos), docente con actividad (I.S.C. y otra carrera), docente sin actividad, jefe de división (1 y 2 carreras), desarrollo académico (depto 4 y depto 2 + correo), directivo, consultas, escolar, RH, cómputo, residencias, titulación, finanzas; unidades 1, 2, 3, 5, 6, 8, 10, 14, 16, 17, 19, 20, 22, 24, 25, 26, 28 y 40; auditor, auditor líder, auditor responsable, líder de acciones, seguimiento asignado, tutor, responsable de área, alumno PIASE, asesor, revisor, academia, encargado ambiental, docente investigador; usuarios 2630 y 2662. MySQL queda para revisión aparte.

## 8. Commits de la Fase 3

| # | Commit |
|---|---|
| 1 | `build(panel): Tailwind v4, Alpine, floating-ui y fuente local en el Vite del proyecto` |
| 2 | `feat(panel): layout base TailAdmin con header, tema y logo` |
| 3 | `feat(panel): sidebar copiado de menu_admin con diseño TailAdmin` |
| 4 | `feat(panel): buscador del sidebar y modal de periodos` |
| 5 | `feat(panel): panel/inicio copiado de home_recargado con bienvenida` |
| 6 | `feat(panel): /inicio usa la vista panel.inicio` |
| 7 | `test(panel): comparación de enlaces por rol y avisos` |
| 8 | `docs(panel): arquitectura y guía de migración (docs/panel.md)` |
| 9 | `build(panel): compilación de producción en public/build` |

## 9. Pendientes y hallazgos

| Tema | Detalle |
|---|---|
| MySQL | No acepta conexiones (`ERROR 2013`); se revisa aparte. Las pruebas usan SQLite |
| Doble mantenimiento | Mientras existan las dos copias, un cambio en el menú o en el panel hay que hacerlo en `menu_admin` y en `partials/panel/sidebar` (y en `home_recargado` y `panel/inicio`). La prueba de comparación detecta si se desincronizan |
| Inglés y Tutorías | Siguen con sus layouts |
| Pantalla "CARGANDO" | `home.blade.php` muestra 1 s el diseño viejo antes de `/inicio` |
| Enlaces dudosos | M174 (#54) y M214-M216 (#95-97): commit aparte |
| M112 | Ruta inexistente; está oculto |
| `IncidenciasController@vista5` | **Descartado.** Se había anotado un posible error (uso del objeto `$id_personal`), pero la L252 lo reasigna a `$id_personal->id_personal` y la concatenación de la L281 está comentada. Se comprobó contra MySQL: la pantalla funciona bien (ver `docs/DASHBOARD_ROLES.md` §2.5) |