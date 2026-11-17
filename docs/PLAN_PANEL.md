# Plan: nuevo diseño de `/inicio` y su sidebar para todos los roles (TailAdmin + Tailwind v4)

Rama: `cacique`. Estado: **plan sin cambios de código** (Fase 2, revisión con el nuevo alcance).
Sustituye a `docs/PLAN_DASH_DIRECTIVO.md` (que solo cubría al directivo).
Referencias: `docs/ANALISIS_SISTEMA.md`, `docs/INVENTARIO_MENU.md` (326 elementos, todos los roles) y `docs/INVENTARIO_DIRECTIVO.md` (#1-#166). La plantilla está en `plantilla_dashboard/tailadmin-free/` (TailAdmin Free 2.5.1, MIT; ignorada en git).

## 0. Alcance y decisiones

**Solo cambia el diseño de `/inicio` y de su sidebar.** No cambian el login, `HomeController@index`, las banderas de sesión, las redirecciones por rol, las rutas, los permisos ni los módulos que ve cada rol.

| Tema | Decisión |
|---|---|
| Roles | Todos los que llegan a `/inicio` con `layouts/app.blade.php`: alumno, docente con y sin actividad, jefe de división, desarrollo académico, directivo, planeación y consultas, servicios escolares, RH, cómputo, residencias, titulación y finanzas, con sus variantes (unidad, auditor, tutor, ids fijos…) |
| Fuera de alcance (pendientes) | Inglés (`ingles/inicio_ingles/layout_ingles.blade.php`, 44 vistas) y Tutorías (`tutorias/app_tutorias.blade.php`, 64 vistas); la pantalla intermedia "CARGANDO" (`home.blade.php`); el login; las pantallas internas de los módulos |
| `partials/menu_admin.blade.php` | **No se modifica**: sigue siendo el menú de las 667 pantallas internas. Su equivalente con diseño TailAdmin es el nuevo sidebar de `/inicio`, alimentado por `MenuPrincipal` ⚠ ver §0.1 |
| Definición del menú | Una sola: `app/Menus/MenuPrincipal.php`, con los 326 elementos de `INVENTARIO_MENU.md`. Alimenta el sidebar y las tarjetas del dashboard |
| Consultas del menú | Se mueven **tal cual** de la vista a `app/Menus/ContextoMenu.php`, sin reinterpretar condiciones |
| Etiquetas | Solo se corrigen acentos |
| Dashboard | Bienvenida (nombre, rol y periodo) + avisos actuales de `home_recargado` (misma lógica) + tarjetas de acceso rápido. **Sin indicadores ni gráficas** |
| Versión de Tailwind | v4 (equipos con Chrome/Edge actualizados) |
| Despliegue | Se versiona `public/build` |
| Activación | `PANEL_NUEVO_ROLES` en `.env`: lista de roles separados por comas, `todos` o vacío (ninguno) |
| Logo | `TESVB.png` sobre fondo blanco en modo oscuro; recorte "VB" en `public/img/panel/` para el sidebar colapsado; ambos se cambian desde `config/tesvb.php` |
| Campana de notificaciones / `?debug_tutor=1` | No se migran |
| P.A.AC y demás ocultos (17 elementos) | En `MenuPrincipal` con `->oculto()` y comentario; no se pintan |
| Enlaces dudosos M174 (#54) y M214-M216 (#95-97) | Se conservan; anotados en `docs/panel.md` para un commit aparte |

### 0.1 Interpretación que necesito confirmar
El punto 1 del alcance dice "`menu_admin.blade.php` se convierte en un sidebar", y el punto 5 dice "las pantallas internas siguen con el diseño actual; solo cambian `/inicio` y su sidebar". Para cumplir los dos, **el archivo `menu_admin.blade.php` no se toca** (lo siguen usando las pantallas internas a través de `layouts/app.blade.php`). En `/inicio`, en su lugar, se muestra el nuevo sidebar, que reproduce **exactamente** sus enlaces y condiciones. La prueba de comparación garantiza que ambos coincidan. Más adelante, cuando se migren las pantallas internas, `menu_admin` se podrá retirar.

## 1. Integración con el Vite del proyecto

### 1.1 Dependencias (`package.json`)

| Paquete | Acción | Para qué |
|---|---|---|
| `tailwindcss` | Actualizar de ^3.1 a **^4.3** | Motor de estilos de la plantilla |
| `@tailwindcss/vite` | Ya está (4.3.5) | Integra Tailwind v4 con Vite |
| `@tailwindcss/forms` | Ya está | `@plugin` de la plantilla (input del buscador) |
| `tw-animate-css` | Agregar | Animaciones `animate-in` / `fade-in-0` / `slide-in-from-top-1` de submenús y dropdowns |
| `alpinejs` | Ya está | Estado del layout, sidebar, dropdowns, modales y buscador |
| `@alpinejs/persist` | Agregar | `$persist` del submenú abierto y del sidebar colapsado (como la plantilla) |
| `@alpinejs/collapse` | Agregar | `x-collapse` de los submenús |
| `@floating-ui/dom` | Agregar | Posición del dropdown de usuario (`dropdown.js` de la plantilla) |
| `@fontsource-variable/outfit` | Agregar | Fuente Outfit local |
| `autoprefixer`, `postcss` | Quitar | v4 ya prefija; sin ellos no hay PostCSS de v3 |
| `axios`, `concurrently`, `laravel-vite-plugin`, `vite` | Se mantienen | Breeze, `composer dev` y compilación |

**Ya no se incluye `apexcharts`** (no hay gráficas). Tampoco i18next, flatpickr, dropzone, jsvectormap, swiper, fullcalendar ni @tanstack/alpine-table.

### 1.2 Configuración
- `vite.config.js`: entradas `resources/css/app.css`, `resources/js/app.js` (Breeze, se conservan para que no falle el `@vite` de `layouts/guest.blade.php`), `resources/css/panel.css` y `resources/js/panel.js`, más el plugin `tailwindcss()`.
- **Se eliminan** `postcss.config.js` (con Tailwind v4 rompe la compilación) y `tailwind.config.js` (v4 lo ignora).
- `resources/css/app.css` se reescribe con la sintaxis de v4 (`@import "tailwindcss"; @plugin "@tailwindcss/forms";` y `@source` a las vistas de Breeze).
- Se borra `public/hot` (archivo local que apunta a `[::1]:5173`).
- Se quita `/public/build` de `.gitignore`; cada cambio de CSS o JS se acompaña de `npm run build` y del commit de `public/build`.

## 2. Estructura de archivos

### 2.1 Lógica (`app/`, `config/`)

| Archivo | Responsabilidad |
|---|---|
| `config/tesvb.php` | `panel_nuevo_roles` (lee `PANEL_NUEVO_ROLES`), rutas de los logos (`logo`, `logo_icono`), nombres visibles de los roles |
| `app/Menus/ElementoMenu.php` | `id` (M001-M326), `etiqueta`, `url`, `metodo`, `icono`, `visible` (closure), `oculto`, `hijos`, `grupo` |
| `app/Menus/ContextoMenu.php` | Lee las banderas de sesión (tabla de `INVENTARIO_MENU.md`) y ejecuta **las mismas consultas** que hoy están en `menu_admin.blade.php` L33-290, L447-462, L556-563 y L1896-1901, con la misma resolución de personal (`id_perso` → `tipo_usuario` → correo) y los mismos `try/catch`. Las consultas se hacen de forma perezosa, una vez por petición. **Conserva el efecto secundario** de L447-462: con `profesor_conact`, guarda en la sesión el `id_carrera` de la carrera I.S.C. del docente, igual que hoy |
| `app/Menus/MenuPrincipal.php` | Los 326 elementos, cada uno con su `Mxxx` en un comentario y su condición copiada del inventario. Ejemplo: `->visible(fn (ContextoMenu $c) => $c->profesorSinAct && ! $c->tieneUnidad && $c->revisor)` para M019 |
| `app/Menus/PerfilPanel.php` | Detecta el rol de la sesión (para la bienvenida y para `PANEL_NUEVO_ROLES`) en el mismo orden en que `HomeController@index` asigna las banderas (§5) |
| `app/View/Composers/PanelComposer.php` | Entrega a `partials.panel.*` el menú visible, el índice del buscador, el usuario (nombre, rol y periodo), los periodos, la regla del botón de periodo y el cambio de carrera |
| `app/Services/PanelInicioService.php` | Datos del dashboard: bienvenida, avisos (con la misma lógica que `home_recargado.blade.php` y `HomeController2@index`) y tarjetas a partir de `MenuPrincipal` |

### 2.2 Vistas

```
resources/views/layouts/panel.blade.php                 @vite, <body x-data> de la plantilla, @yield('title'), @yield('content'), @stack('scripts')
resources/views/partials/panel/sidebar.blade.php
resources/views/partials/panel/sidebar_encabezado.blade.php
resources/views/partials/panel/sidebar_grupo.blade.php
resources/views/partials/panel/sidebar_elemento.blade.php   recursivo (niveles 1-4); los POST se pintan como <form> con @csrf
resources/views/partials/panel/header.blade.php
resources/views/partials/panel/buscador.blade.php
resources/views/partials/panel/tema.blade.php
resources/views/partials/panel/usuario.blade.php
resources/views/partials/panel/periodos.blade.php           modal Alpine (reemplaza los 4 íconos de periodo)
resources/views/partials/panel/carreras.blade.php           selector de cambio de carrera (M001)
resources/views/partials/panel/alerta.blade.php
resources/views/partials/panel/modal.blade.php              modal genérico Alpine (adeudos del alumno)
resources/views/partials/panel/iconos/*.blade.php
resources/views/panel/inicio.blade.php                      @extends('layouts.panel'): dashboard común a todos los roles
resources/views/panel/partials/bienvenida.blade.php
resources/views/panel/partials/avisos.blade.php
resources/views/panel/partials/encuestas_alumno.blade.php
resources/views/panel/partials/adeudos_alumno.blade.php
resources/views/panel/partials/accesos.blade.php
```

Hay una sola vista de dashboard para todos los roles, y el contenido cambia según los datos que entrega el servicio. No se duplica HTML por rol.

### 2.3 CSS y JS

```
resources/css/panel.css      basado en src/css/style.css de la plantilla:
                             - comentario inicial con la licencia MIT de TailAdmin
                             - Outfit local (@fontsource-variable/outfit), sin Google Fonts
                             - @import "tailwindcss" source(none) + @source solo a layouts/panel, partials/panel, panel/ y app/Menus
                             - @theme, @custom-variant dark y @utility menu-* sin cambios
resources/js/panel.js        punto de entrada
resources/js/panel/alpine.js     Alpine + persist + collapse; registro de componentes
resources/js/panel/dropdown.js   copia de src/js/components/ui/dropdown.js (MIT)
resources/js/panel/buscador.js   filtra el índice del menú; Ctrl+K / ⌘K
resources/js/panel/periodos.js   anterior, actual y siguiente con flechas ↑↓ (mismo comportamiento que partials/periodos)
```

El modo oscuro se fija con un script en línea de 3 líneas en el `<head>` (`localStorage.darkMode`), para evitar parpadeo.

### 2.4 Logo
- `config('tesvb.logo')` = `img/TESVB.png`; en modo oscuro va dentro de un fondo blanco redondeado.
- `config('tesvb.logo_icono')` = `img/panel/tesvb-icono.png`: recorte de los cuadros "VB" de `TESVB.png`, generado una vez con GD y versionado.
- Para usar el logo oficial basta reemplazar los archivos o cambiar las dos claves de configuración.

## 3. Sidebar

### 3.1 Niveles y estilo
- Nivel 1 = `menu-item`; nivel 2 = `menu-dropdown-item`; niveles 3-4 (SGOE, Generales › Académico, Inventario) = subgrupo plegable dentro del dropdown, con las mismas clases, flecha y sangría.
- Los módulos de primer nivel que en el original son enlaces directos (por ejemplo "Calificaciones", "Tutorías", "Laboratorios") se pintan como `menu-item` con `href`, sin submenú.
- El orden de los módulos dentro de cada grupo es **el orden en que aparecen en `menu_admin`**.
- Los duplicados del original se conservan. Por ejemplo, Desarrollo académico ve hoy "Datos P." dos veces (M014 y M047); el sidebar mostrará lo mismo. La prueba compara listas con repeticiones. Unificarlos sería una mejora que queda fuera de este alcance.

### 3.2 Grupos (títulos en mayúsculas pequeñas, como "MENU" y "OTHERS" en la plantilla)

Cada usuario ve solo los grupos que tienen algún elemento visible para él.

| Grupo | Módulos (etiqueta con acentos corregidos) | IDs |
|---|---|---|
| **INICIO** | Inicio (`/inicio`) | nuevo |
| **MI ESPACIO** | Datos P. (docente, cómputo, RH, jefe, titulación, directivo/consultas, desa), Datos Alumno(a), Complementarias (docente y alumno), Duales (docente), Solicitudes (docente y alumno), Evaluación Docente (docente y alumno), Calificaciones (docente, jefe, directivo/consultas y alumno), Residencia (docente), Seguimiento de Residencia, Examen Conocimientos Gral., Tutorías (personal y alumno), PIASE, Inglés (alumno), Examen EGEL, Datos Residencia Profesional, Seguimiento Residencia, Servicio Social, Titulación (alumno) | M003-M019, M020-M025, M220-M251 y los "Datos P." / "Calificaciones" de cada bloque |
| **ACADÉMICO** | Complementarias (jefe y directivo/consultas), Evaluación, Evaluación Doc., Horarios, Formatos, Plantilla, Generales, Análisis de reprobación, Residencia (jefe), Evaluaciones, Administrar Examen EGEL, Administrar Examen Conocimientos Gral., Duales (jefe), Seguimiento Inglés, Validar Cargas | M047-M078, M140-M170, M320-M324 |
| **SERVICIOS ESCOLARES** | Control Escolar, Solicitudes de Beca, Reporte de profesores, Servicios Escolares (cómputo), Laboratorios, Herramientas, Envío Encuesta Sat. | M079-M109, M027-M040 |
| **RESIDENCIAS Y TITULACIÓN** | Servicio social, Seg. Anteproyecto, Seg. Residencia, Seg. Servicio Social, Envío Encuestas Sat., Titulación, Catálogos Titulación, Titulación (usuario 2630) | M110-M139, M175-M176 |
| **ADMINISTRACIÓN** | Cargos del Personal, Validar Oficios, Plantilla Personal, Oficios Com., Seg. de Oficios, Adeudos de Estudiantes, Ipomex, Solicitudes de beca, Solicitudes, Residencia (unidad 26), Incidencias de Asistencia, Inventario TESVB, Materiales y solicitudes, Inglés (unidad 19) | M041-M046, M171-M174, M179-M181, M196-M203, M253-M265, M309-M319, M325-M326, M026 |
| **FINANZAS** | Req. Anteproyecto, Catálogo de Requisiciones, Presupuesto autorizado, Req. de Mat. Anteproyecto, Solicitudes de req. del presupuesto autorizado, P.A.AC (**oculto**) | M182-M195, M209-M219 |
| **CALIDAD Y AMBIENTAL** | SGOE (con sus submenús), Evidencias Inf. Doc., Procedimiento Amb. | M266-M308, M204-M208, M177-M178 |
| **CUENTA** | Cambiar periodo (si aplica la regla del botón), Cambio de carrera (M001), Inglés (profesor de inglés, M252), Salir (M002, POST) | M001, M002, M252 |

Los rangos de IDs son orientativos; la asignación exacta de cada elemento a su grupo queda en `MenuPrincipal` (propiedad `grupo`) y se revisará contra el inventario en la prueba unitaria.

### 3.3 Íconos (SVG de la plantilla, uno por archivo en `partials/panel/iconos/`)

| Ícono | Origen en la plantilla | Módulos |
|---|---|---|
| `cuadricula` | Dashboard | Inicio |
| `usuario` | User Profile | Datos P., Datos Alumno(a), Tutorías, Cargos del Personal |
| `grupo` | métrica "Customers" | PIASE, Seguimiento de Residencia, Residencia (docente), Duales |
| `formularios` | Forms | Control Escolar, Incidencias, Adeudos, Solicitudes, Validar Cargas, Herramientas |
| `tablas` | Tables | Calificaciones, Formatos, Plantilla, Plantilla Personal, Reporte de profesores, Catálogo de Requisiciones |
| `graficas` | Charts | Evaluación, Evaluación Doc./Docente, Complementarias, Análisis de reprobación, SGOE, Presupuesto autorizado |
| `calendario` | Calendar | Horarios, Cambiar periodo |
| `paginas` | Pages | Oficios, Seg. de Oficios, Titulación, Ipomex, Servicio Social, Residencia, Encuestas, Evidencias, Procedimiento Amb., P.A.AC |
| `elementos` | UI Elements | Generales, Catálogos Titulación, Laboratorios |
| `caja` | métrica "Orders" | Inventario TESVB, Materiales y solicitudes, Req. Anteproyecto, Req. de Mat. Anteproyecto |
| `candado` | Authentication | Salir |
| `idioma` | — (se reutiliza `paginas`) | Inglés, Seguimiento Inglés, Examen EGEL, Examen Conocimientos |

## 4. Header
- Botón para colapsar el sidebar; backdrop en móvil.
- **Buscador** (Ctrl+K): filtra solo los enlaces **visibles** para el usuario ("Módulo › Submódulo"); se navega con ↑/↓/Enter.
- Botón de modo oscuro.
- **Periodo:** botón con el nombre del periodo. Se muestra si se cumple **cualquiera** de las 4 condiciones de los íconos actuales (`INVENTARIO_MENU.md`, "Elementos que no son enlaces"). Abre el modal con los mismos datos y enlaces (`GET /periodo/{id}`).
- **Cambio de carrera:** dropdown con las carreras de la sesión (`cambio_carreras == 1`), enlaces `GET /recarga_personal/{id}`.
- **Usuario:** nombre, rol y periodo, con la misma regla que las insignias actuales (jefe/consultas: nombre · carrera · periodo; resto: nombre · periodo). Opción "Cerrar sesión" (POST `/logout` + `@csrf`). **No** se agregan opciones que el rol no tenga hoy.
- Sin campana.

## 5. Activación y reversión

`config/tesvb.php`:
```php
'panel_nuevo_roles' => array_filter(array_map('trim', explode(',', env('PANEL_NUEVO_ROLES', '')))),
```

**Claves de rol** (detectadas por `PerfilPanel` en este orden, el mismo de `HomeController@index`):

| Clave | Condición de sesión |
|---|---|
| `alumno` | `palumno` |
| `docente_actividad` | `profesor_conact` |
| `docente` | `profesor_sinact` |
| `desarrollo` | `desa` (se evalúa **antes** que `jefe_division`, porque Desarrollo también tiene esa bandera) |
| `jefe_division` | `jefe_division` |
| `directivo` | `directivo` |
| `consultas` | `consultas` |
| `escolar` | `escolar` |
| `rh` | `personal` |
| `computo` | `computo` |
| `residencias` | `residencia` |
| `titulacion` | `titulacion` |
| `finanzas` | `finanzas` |

`HomeController2@index` (solo cambian sus primeras líneas):
```php
public function index(PanelInicioService $panel)
{
    if (PerfilPanel::usaPanelNuevo()) {          // rol de la sesión ∈ PANEL_NUEVO_ROLES, o "todos"
        return view('panel.inicio', $panel->datos());
    }
    // ... código actual, sin cambios ...
}
```

- Ejemplos: `PANEL_NUEVO_ROLES=directivo,escolar`; `PANEL_NUEVO_ROLES=todos`; vacío o sin definir = panel clásico para todos.
- **Apagar un rol que falle:** quitarlo de la lista y ejecutar `php artisan config:clear`. No hace falta desplegar.
- `home.blade.php` sigue redirigiendo a `/inicio`; el flujo `/home` → `/inicio` no cambia.
- La lógica clásica de `HomeController2` no se toca. El servicio **replica** su lógica (adeudos y encuestas) y la de `home_recargado` (aviso de tutor) en lugar de reutilizar el controlador, para que el panel clásico quede exactamente igual. Una prueba compara los resultados de ambos con los mismos datos.

## 6. Dashboard (`panel/inicio.blade.php`)

Grid de la plantilla (`grid grid-cols-12 gap-4 md:gap-6`, tarjetas `rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/3`):

| Bloque | Contenido | Condición (misma lógica que hoy) |
|---|---|---|
| Bienvenida (`col-span-12`) | "Bienvenido(a), {nombre}" · {rol} · {periodo actual} (+ carrera para jefe de división y consultas) | todos |
| Avisos (`col-span-12`) | Mensaje global `men`, con la "NOTA … fecha de liberación de Actividades Complementarias" si hay `profesor_men` | si `men` está en la sesión |
| | Aviso verde RETÍCULA/DOCENTE (con acentos corregidos) | `jefe_division \|\| directivo` |
| | Aviso "Canalización por reprobación" + botón | tutor en el periodo vigente con reprobados (lógica de `home_recargado.blade.php:28-171`) |
| Encuestas (`col-span-12`) | Botones de las encuestas de satisfacción pendientes | `palumno` y alguna pendiente (`HomeController2.php:83-125`) |
| Modal de adeudos | Lista de departamentos y adeudos; se abre al cargar (Alpine) | `palumno` y `adeudo == 1` (`HomeController2.php:24-77`) |
| Accesos rápidos (`col-span-12`, grid `sm:grid-cols-2 xl:grid-cols-3`) | Una tarjeta por módulo de primer nivel visible (ícono, nombre y sus submódulos como enlaces). Salen de `MenuPrincipal`, sin INICIO ni CUENTA, y los ocultos no se muestran | misma visibilidad que el sidebar |

No hay indicadores, gráficas ni datos inventados.

## 7. Responsivo (igual que la plantilla)

| Ancho | Sidebar | Header |
|---|---|---|
| ≥ 1280 px | Fijo `w-72.5`, colapsable a `w-22.5` (solo íconos) | Buscador visible; acciones a la derecha |
| 768-1279 px | Fuera de pantalla con backdrop | Botón de menú + logo; acciones en "⋯" |
| < 768 px | Igual que tablet | Igual; tarjetas en una columna |

## 8. Pruebas

Patrón de `tests/Unit/EditarDocenteTest.php`: SQLite en memoria con `Schema::create` solo de las tablas que tocan el menú y el panel (helper `tests/Support/EsquemaPanel.php`).

| Archivo | Qué verifica |
|---|---|
| `tests/Feature/Panel/ComparacionEnlacesTest.php` | Para **cada rol y variante**, renderiza `partials.menu_admin` (vía `@yield('menu')`) y `partials.panel.sidebar` con la misma sesión y los mismos datos, extrae `href`/`action` + método y compara las listas **con repeticiones**: **0 faltantes y 0 sobrantes** (salvo los elementos nuevos declarados: Inicio y el botón de periodo). Excluye los ocultos (`display:none`) en ambos lados |
| `tests/Unit/Menus/MenuPrincipalTest.php` | 326 elementos con IDs únicos M001-M326; 17 ocultos; M002 es POST; cada elemento tiene grupo e ícono |
| `tests/Feature/Panel/ActivacionTest.php` | Con `PANEL_NUEVO_ROLES` vacío, todos ven `home_recargado`; con `directivo`, solo el directivo ve `panel.inicio`; con `todos`, todos los roles en alcance; el profesor de inglés sigue yendo a `/ingles` |
| `tests/Feature/Panel/AvisosTest.php` | Los avisos del panel nuevo y del clásico coinciden con los mismos datos (men, verde, tutor, encuestas, adeudos) |

**Dataset de roles y variantes de la comparación** (cada uno con sesión y filas mínimas en SQLite):

| Grupo | Casos |
|---|---|
| Roles base | alumno (con y sin encuestas/adeudos; semestre < 5, 5-7 y ≥ 8; carreras 2, 6 y 8; con y sin `ver_eva`/`ver_carga`; residencia y titulación por etapas), docente con actividad (carrera I.S.C. y otra), docente sin actividad, jefe de división (1 y 2 carreras), desarrollo académico (depto 4 y depto 2 + correo), directivo, consultas, escolar, RH, cómputo, residencias, titulación, finanzas |
| Unidad administrativa | sin unidad; unidades 1, 2, 3, 5, 6, 8, 10, 14, 16, 17, 19, 20, 22, 24, 25, 26, 28 y 40 (combinadas con docente y directivo) |
| Relaciones en BD | auditor (`isAuditor`), auditor líder, auditor responsable, líder de acciones, seguimiento asignado, tutor de reprobación, responsable de área, alumno PIASE, asesor, revisor, academia, encargado ambiental, docente investigador |
| Ids fijos | usuario 2630, usuario 2662 |

Cuando la BD esté disponible, se tomarán de ella las combinaciones reales (consultas en `INVENTARIO_MENU.md`) para confirmar que el dataset las cubre.

## 9. Documentación
`docs/panel.md`: arquitectura (layout, composer, `MenuPrincipal`, `ContextoMenu`, `PerfilPanel`), cómo agregar un módulo o un rol, cómo compilar y desplegar, `PANEL_NUEVO_ROLES`, pendientes (M174, M214-M216, Inglés y Tutorías, "CARGANDO") y la sección **"Cómo migrar un módulo al nuevo layout"** (equivalencias Bootstrap 3 → Tailwind y reemplazo de plugins jQuery).

## 10. Archivos y commits

**Crear:** `config/tesvb.php`; `app/Menus/{ElementoMenu,ContextoMenu,MenuPrincipal,PerfilPanel}.php`; `app/View/Composers/PanelComposer.php`; `app/Services/PanelInicioService.php`; `resources/css/panel.css`; `resources/js/panel.js` + `resources/js/panel/*`; `resources/views/layouts/panel.blade.php`; `resources/views/partials/panel/*`; `resources/views/panel/*`; `public/img/panel/*`; pruebas y `tests/Support/EsquemaPanel.php`; `docs/panel.md`; `public/build/*`.

**Modificar:** `package.json`, `package-lock.json`, `vite.config.js`, `.gitignore`, `resources/css/app.css`, `app/Providers/AppServiceProvider.php`, `app/Http/Controllers/HomeController2.php` (solo las primeras líneas de `index()`), `.env.example`.

**Eliminar:** `postcss.config.js`, `tailwind.config.js`, `public/hot` (local).

**No se tocan:** `layouts/app.blade.php`, `partials/menu_admin.blade.php`, `partials/periodos.blade.php`, `home_recargado.blade.php`, `home.blade.php`, el resto de los layouts, `HomeController.php`, `routes/*.php` ni las vistas de los módulos.

| # | Commit |
|---|---|
| 1 | `build(panel): Tailwind v4, Alpine y fuente local en el Vite del proyecto` |
| 2 | `feat(panel): configuración tesvb y PANEL_NUEVO_ROLES` |
| 3 | `feat(panel): layout base TailAdmin y logo` |
| 4 | `feat(panel): ContextoMenu con las consultas del menú actual` |
| 5 | `feat(panel): MenuPrincipal con los 326 elementos del inventario` |
| 6 | `feat(panel): sidebar y View Composer` |
| 7 | `feat(panel): header con buscador, tema, periodo, carrera y usuario` |
| 8 | `feat(panel): servicio y dashboard de inicio (bienvenida, avisos y accesos)` |
| 9 | `feat(panel): activar el panel nuevo por rol en HomeController2` |
| 10 | `test(panel): comparación de enlaces por rol, activación y avisos` |
| 11 | `docs(panel): arquitectura y guía de migración` |
| 12 | `build(panel): compilación de producción` |

**Revertir:** `PANEL_NUEVO_ROLES=` (vacío) + `php artisan config:clear`; o `git revert` del commit 9 (o de todos los del panel). Nada del sistema actual se modifica.

## 11. Pendientes y hallazgos

| Tema | Detalle |
|---|---|
| **BD no disponible** | MySQL rechaza conexiones (`ERROR 2013` en el handshake; el log se queda en "Server socket created" y hay errores de tablespace en `microseed_control_test`). Faltan las consultas de unidades y variantes |
| Interpretación de §0.1 | Confirmar que `menu_admin.blade.php` se conserva para las pantallas internas |
| Inglés y Tutorías | Siguen con sus layouts; se migran después |
| Pantalla "CARGANDO" | `home.blade.php` sigue 1 s con el diseño viejo antes de `/inicio` |
| Enlaces dudosos | M174 (#54) y M214-M216 (#95-97): commit aparte |
| M112 | Ruta inexistente; está oculto |
| **Posible error en `IncidenciasController@vista5`** | L251 obtiene `$id_personal` como **objeto** (`DB::SelectOne(...)`) y en L261 lo compara con `inc_solicitudes.id_jefe` (`->where('inc_solicitudes.id_jefe','=',$id_personal)`); en L281 lo concatena dentro del SQL (`'.$id_personal.'`). Probablemente debería usar `$id_personal->id_personal`. Revisar aparte |
| Efecto secundario del menú actual | El bloque del docente con actividad guarda `id_carrera` en la sesión (L447-462). `ContextoMenu` lo conserva igual |
| Duplicados | Desarrollo académico ve "Datos P." dos veces (M014 y M047); se conserva |
| Desarrollo académico sin `men` | `HomeController.php:601-604` está comentado; su panel no muestra mensaje global (igual que hoy) |
