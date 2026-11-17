# Plan: nuevo panel del perfil DIRECTIVO (TailAdmin + Tailwind v4)

Rama: `feature/dash-directivo` (creada desde `cacique`). Fase 2: **plan sin cambios de código**.
Referencias: `docs/ANALISIS_SISTEMA.md`, `docs/INVENTARIO_DIRECTIVO.md` (166 entradas) y la plantilla en `plantilla_dashboard/tailadmin-free/` (TailAdmin Free 2.5.1, MIT; ignorada en git).

## 0. Decisiones confirmadas y pendientes

| Tema | Decisión |
|---|---|
| Versión de Tailwind | **v4** (todos los equipos usan Chrome/Edge actualizados) |
| Despliegue | **Se versiona `public/build`** (se quita de `.gitignore`); el servidor no necesita Node |
| Aviso verde RETÍCULA/DOCENTE | **Se queda** como alerta informativa |
| `?debug_tutor=1` | No se migra |
| Campana de notificaciones | Se quita (el AJAX del menú viejo nunca se ejecuta) |
| P.A.AC (#90-97) | En `MenuDirectivo`, marcada `oculto` con un comentario; no se pinta |
| Selector de periodo #62 | Se fusiona con el selector único del header |
| Etiquetas | Se corrigen acentos y ortografía; URL y condición, idénticas |
| Enlaces dudosos #54 y #95-97 | Se conservan; quedan anotados en `docs/panel.md` para un commit aparte |
| **Pendiente A** | `id_unidad_admin` real de los directivos: **MySQL no estaba en ejecución** (puerto 3306 cerrado), no se pudo consultar |
| **Pendiente B** | Aprobar las consultas de indicadores (§8.3) |
| **Pendiente C** | Logo para el modo oscuro y el sidebar colapsado (§2.4) |

## 1. Integración con el Vite del proyecto

### 1.1 Dependencias (`package.json`)

| Paquete | Acción | Versión propuesta | Para qué |
|---|---|---|---|
| `tailwindcss` | **Actualizar** de ^3.1 a ^4 | ^4.3 | Motor de estilos de la plantilla (v4, sin config JS) |
| `@tailwindcss/vite` | Ya está | ^4.3 | Integra Tailwind v4 con Vite (sustituye a PostCSS) |
| `@tailwindcss/forms` | Ya está | ^0.5 | La plantilla lo usa con `@plugin` (estilos base de inputs del buscador) |
| `tw-animate-css` | Agregar | ^1.4 | Clases `animate-in`, `fade-in-0` y `slide-in-from-top-1` de los submenús y dropdowns |
| `alpinejs` | Ya está | ^3.17 | Estado del layout (sidebar, tema, dropdowns, modal de periodo, buscador) |
| `@alpinejs/persist` | Agregar | ^3.17 | `$persist` del submenú abierto (igual que la plantilla) y del sidebar colapsado |
| `@alpinejs/collapse` | Agregar | ^3.17 | `x-collapse` para abrir y cerrar submenús |
| `@floating-ui/dom` | Agregar | ^1.8 | Posiciona el dropdown de usuario (`dropdown.js` de la plantilla) |
| `apexcharts` | Agregar | ^7.3 (la de la plantilla) | Gráficas del dashboard |
| `@fontsource-variable/outfit` | Agregar | última | Fuente Outfit **local**, sin Google Fonts |
| `autoprefixer`, `postcss` | **Quitar** | — | v4 ya genera prefijos (Lightning CSS); sin ellos no hay PostCSS de v3 |
| `axios` | Se mantiene | — | Lo usa `resources/js/bootstrap.js` (Breeze) para que no se rompa su entrada |
| `concurrently`, `laravel-vite-plugin`, `vite` | Se mantienen | — | `composer dev` y la compilación |

**No se incluyen** (vienen en la plantilla, pero el panel no los usa): i18next, flatpickr, dropzone, jsvectormap, swiper, fullcalendar, @tanstack/alpine-table y prism.

### 1.2 `vite.config.js`

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 'resources/js/app.js',   // Breeze (se conservan para no romper @vite de guest.blade.php)
                'resources/css/panel.css', 'resources/js/panel.js', // nuevo diseño
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
```

### 1.3 Archivos de Breeze y de Tailwind 3
- `postcss.config.js`: **se elimina**. Vite lo carga solo y Tailwind v4 rechaza `tailwindcss` como plugin de PostCSS, así que la compilación fallaría.
- `tailwind.config.js`: **se elimina**. v4 lo ignora.
- `resources/css/app.css`: se reescribe a la sintaxis de v4 (`@import "tailwindcss"; @plugin "@tailwindcss/forms";` + `@source` a las vistas de Breeze). Así `layouts/guest.blade.php` (sin cambios) sigue compilando. No se toca ningún layout.
- `resources/js/app.js` y `bootstrap.js`: sin cambios.
- `public/hot`: **se borra** (es local y está ignorado; apunta a `[::1]:5173`).

### 1.4 Despliegue con `public/build` versionado
- Se quita `/public/build` de `.gitignore`.
- Cada cambio de CSS o JS del panel se acompaña de `npm run build` y del commit de `public/build`.
- Se documenta en `docs/panel.md`. Si dos ramas compilan a la vez, puede haber conflictos en `public/build/manifest.json`; se resuelven recompilando.

## 2. Estructura de archivos

### 2.1 Configuración y lógica (`app/`, `config/`)

| Archivo | Responsabilidad |
|---|---|
| `config/tesvb.php` | `'panel_directivo_nuevo' => (bool) env('PANEL_DIRECTIVO_NUEVO', false)` y `'menus' => ['directivo' => MenuDirectivo::class]` |
| `app/Menus/ElementoMenu.php` | Objeto de valor: `etiqueta`, `url`, `metodo` (GET/POST), `icono`, `visible` (closure), `oculto` (bool), `hijos` (ElementoMenu[]), `activo` (patrones para `request()->is()`), `numeroInventario` (para trazabilidad y pruebas) |
| `app/Menus/GrupoMenu.php` | Título del grupo (mayúsculas pequeñas) + elementos |
| `app/Menus/ContextoMenu.php` | **Un solo lugar** para las banderas: lee la sesión (`directivo`, `personal_tesvb`, `id_unidad_admin`, `isAuditor`, `seguimiento_asesor`, `encargado_ambiental`, `tipo_persona`, `usuario_alumno`, `id_perso`) y hace **las mismas consultas** que hoy están dentro de `menu_admin.blade.php` (tutor de reprobación, responsable de área, auditor líder/auditor/líder de acciones/seguimiento, docente investigador). Las consultas se ejecutan una vez por petición y de forma perezosa |
| `app/Menus/Menu.php` | Clase base: `grupos(ContextoMenu)`, filtrado de visibles, `hojas()` (para el buscador), `estaActivo()` |
| `app/Menus/MenuDirectivo.php` | Los 166 elementos del inventario, con su `#` como comentario. P.A.AC con `->oculto()` y comentario |
| `app/Menus/PerfilPanel.php` | Detecta el perfil (`session()->has('directivo')` → `'directivo'`) y resuelve la clase de menú desde `config('tesvb.menus')` |
| `app/View/Composers/PanelComposer.php` | Entrega `$menu` (grupos visibles), `$indiceBusqueda`, `$usuarioPanel` (nombre y periodo) y `$periodosPanel` a `partials.panel.*`. Se registra en `AppServiceProvider::boot()` con `View::composer('partials.panel.*', ...)` |
| `app/Services/PanelDirectivoService.php` | Datos del dashboard: `men`, avisos (RETÍCULA/DOCENTE y canalización por reprobación, con la **misma lógica** que hoy calcula `home_recargado` en la vista), accesos rápidos e indicadores |

### 2.2 Vistas

```
resources/views/layouts/panel.blade.php           layout nuevo: @vite, <body x-data> de la plantilla, @yield('title'), @yield('content'), @stack('scripts')
resources/views/partials/panel/sidebar.blade.php            <aside>, backdrop móvil y <nav x-data="{selected: $persist(...)}">
resources/views/partials/panel/sidebar_encabezado.blade.php logo expandido / colapsado
resources/views/partials/panel/sidebar_grupo.blade.php      título del grupo + lista de elementos
resources/views/partials/panel/sidebar_elemento.blade.php   elemento recursivo (niveles 1 a 4); los POST se pintan como <form> con @csrf
resources/views/partials/panel/header.blade.php             botón de colapsar, logo móvil, buscador, tema, periodo, usuario
resources/views/partials/panel/buscador.blade.php           input + resultados (Ctrl+K)
resources/views/partials/panel/tema.blade.php               botón de modo oscuro
resources/views/partials/panel/usuario.blade.php            dropdown con nombre, periodo, Datos personales, Cambiar periodo y Cerrar sesión (POST /logout)
resources/views/partials/panel/periodos.blade.php           modal Alpine de cambio de periodo
resources/views/partials/panel/alerta.blade.php             alerta con el estilo de la plantilla (info, éxito, advertencia)
resources/views/partials/panel/iconos/*.blade.php           un SVG por ícono (ver §4)
resources/views/directivo/panel.blade.php                   @extends('layouts.panel'): grid del dashboard
resources/views/directivo/partials/avisos.blade.php
resources/views/directivo/partials/accesos_rapidos.blade.php
resources/views/directivo/partials/indicadores.blade.php     (tras aprobar §8.3)
resources/views/directivo/partials/grafica_matricula.blade.php
resources/views/directivo/partials/grafica_carreras.blade.php
resources/views/directivo/partials/grafica_aprobacion.blade.php
```

No hay `notificaciones.blade.php` porque la campana se quita.

### 2.3 CSS y JS

```
resources/css/panel.css      basado en src/css/style.css de la plantilla:
                             - comentario inicial con la licencia MIT de TailAdmin (copiada de LICENSE)
                             - @import "@fontsource-variable/outfit"; --font-outfit: "Outfit Variable", sans-serif
                             - @import "tailwindcss" source(none) + @source a layouts/panel, partials/panel, directivo y app/Menus
                               (así Tailwind no escanea las 1 270 vistas de Bootstrap)
                             - se conservan @theme, @custom-variant dark y las @utility menu-*
                             - se quitan los estilos de prism, docs-* y badge-pro (no se usan)
resources/js/panel.js        punto de entrada: importa y arranca los módulos
resources/js/panel/alpine.js     Alpine + persist + collapse; registra componentes; Alpine.start()
resources/js/panel/dropdown.js   copia de src/js/components/ui/dropdown.js (MIT)
resources/js/panel/buscador.js   componente "buscador" (filtra el índice; Ctrl+K)
resources/js/panel/periodos.js   componente "selectorPeriodo" (anterior, actual y siguiente con flechas, igual que hoy)
resources/js/panel/graficas.js   inicializa ApexCharts leyendo los datos de <script type="application/json"> generados con @json
```

El modo oscuro se aplica con un **script en línea de 3 líneas** en el `<head>` del layout (lee `localStorage.darkMode` antes de pintar, para evitar el parpadeo). No carga nada externo.

### 2.4 Logo (pendiente C)
- **Expandido (modo claro):** `public/img/TESVB.png` (3146×1170, 125 KB) a `h-10`.
- **Modo oscuro:** el logo tiene texto negro y no se lee sobre `dark:bg-gray-900`. **Propuesta:** mostrarlo sobre un fondo blanco redondeado (`dark:bg-white dark:rounded-lg dark:p-1`). Si tienes una versión en blanco, se usa esa.
- **Colapsado (`size-8`):** no existe un ícono cuadrado. **Propuesta:** recortar los cuadros "VB" de `TESVB.png` en `public/img/panel/tesvb-icono.png` y generar una versión ligera `public/img/panel/tesvb-logo.png` (~600 px de ancho). Requiere tu visto bueno, porque son archivos nuevos derivados del logo.

## 3. Menú definido en un solo lugar

Ejemplo de cómo se ve una entrada en `MenuDirectivo`:

```php
// #17-19 Reporte de profesores (menu_admin L1168: unidad 5 o 26)
Elemento::modulo('Reporte de profesores', icono: 'tablas')
    ->visible(fn (ContextoMenu $c) => in_array($c->unidad, [5, 26]))
    ->hijos([
        Elemento::enlace('Distribución de total de horas de los profesores', '/distribucion_horas_profesores/total/', inventario: 17),
        ...
    ]),

// #90-97 P.A.AC — en el original está dentro de <ul style="display:none">
// (menu_admin L1774). Se conserva para trazabilidad, pero no se muestra.
Elemento::modulo('P.A.AC', icono: 'paginas')->oculto()->visible(fn ($c) => $c->tieneUnidad)->hijos([...]),
```

- El enlace activo se marca con `request()->is(trim($url, '/').'*')`. Como el panel solo vive en `/inicio`, en esta etapa solo se marca "Inicio". Cuando se migren los módulos, se marcarán solos.
- Para agregar otro perfil: crear `MenuAlumno extends Menu`, registrarlo en `config('tesvb.menus')` y detectarlo en `PerfilPanel`. El HTML del sidebar no cambia.

## 4. Agrupación del sidebar e íconos

Títulos de grupo en mayúsculas pequeñas (`text-xs uppercase text-gray-400`), como "MENU" y "OTHERS" en la plantilla. Niveles: 1 = `menu-item`; 2 = `menu-dropdown-item`; 3 y 4 = subgrupo plegable dentro del dropdown (mismas clases, con flecha y sangría `pl-3`), porque la plantilla solo trae 2 niveles.

| Grupo | Módulo (etiqueta corregida) | Entradas del inventario | Ícono (origen en la plantilla) |
|---|---|---|---|
| **INICIO** | Inicio (`/inicio`) | nuevo (es el panel) | `cuadricula` (Dashboard) |
| **ACADÉMICO** | Control Escolar | #9-16 | `formularios` (Forms) |
| | Reporte de profesores | #17-19 | `tablas` (Tables) |
| | Complementarias | #21-24 | `graficas` (Charts) |
| | Calificaciones | #25 | `tablas` |
| | Evaluación Doc. | #26-27 | `graficas` |
| | Horarios | #28-31 | `calendario` (Calendar) |
| | Formatos | #32-35 | `paginas` (Pages) |
| | Plantilla | #36-37 | `tablas` |
| | Generales (› Académico) | #38-50 | `elementos` (UI Elements) |
| | Tutorías | #5 | `usuario` (User Profile) |
| | PIASE | #6-7 | `grupo` (ícono "Customers" de las métricas) |
| | Seguimiento de Residencia | #3 | `grupo` |
| | Examen Conocimientos Gral. | #4 | `formularios` |
| | Inglés | #8 | `paginas` |
| | Validar Cargas | #164 | `formularios` |
| **ADMINISTRACIÓN** | Oficios Com. | #51-53 | `paginas` |
| | Seg. de Oficios | #54 | `paginas` |
| | Incidencias de Asistencia | #101-109 | `formularios` |
| | Adeudos de Estudiantes | #59-61 | `formularios` |
| | Solicitudes de beca / Solicitudes / Residencia | #81-84 | `paginas` |
| | Titulación | #55-56 | `paginas` |
| | Ipomex | #77-80 | `paginas` |
| | Materiales y solicitudes | #165-166 | `caja` (ícono "Orders" de las métricas) |
| | Inventario TESVB | #153-163 | `caja` |
| **FINANZAS** | Req. Anteproyecto | #63-67 | `caja` |
| | Catálogo de Requisiciones | #68-70 | `tablas` |
| | Presupuesto autorizado | #71-76 | `graficas` |
| | Req. de Mat. Anteproyecto | #98 | `formularios` |
| | Solicitudes de req. del presupuesto autorizado | #99-100 | `paginas` |
| | P.A.AC (**oculto**) | #90-97 | `paginas` |
| **CALIDAD Y AMBIENTAL** | SGOE (› Riesgos y Oportunidades › Catálogos; Auditorías; No conformidades; Encuestas…) | #110-152 | `graficas` |
| | Evidencias Inf. Doc. | #85-89 | `paginas` |
| | Procedimiento Amb. | #57-58 | `paginas` |
| **CUENTA** | Datos P. › Editar | #20 | `usuario` |
| | Cambiar periodo (abre el modal) | #1 y #62 | `calendario` |
| | Cerrar sesión (formulario POST + `@csrf`) | #2 | `candado` (Authentication) |

Los grupos sin elementos visibles no se muestran (por ejemplo FINANZAS para un directivo sin unidad 1, 2, 24 o 25). "Cerrar sesión" y "Cambiar periodo" aparecen **también** en el header; la regla 1 exige que estén en el sidebar.

## 5. Activación y reversión

```php
// HomeController2@index — primeras líneas (el resto queda igual)
public function index(PanelDirectivoService $panel)
{
    if (session()->has('directivo') && config('tesvb.panel_directivo_nuevo')) {
        return view('directivo.panel', $panel->datos());
    }
    // ... código actual sin cambios ...
}
```

- `.env`: `PANEL_DIRECTIVO_NUEVO=true` lo activa; `false` o sin definir deja el panel clásico. También se agrega a `.env.example`.
- **Reversión inmediata:** poner la variable en `false` y ejecutar `php artisan config:clear`. No hace falta desplegar.
- El flujo `/home` → `/inicio`, `HomeController@index`, las banderas y `layouts/app.blade.php` no cambian.

## 6. Header
- Botón para colapsar el sidebar (`sidebarToggle`), igual que la plantilla, y backdrop en móvil.
- **Buscador:** filtra **solo los enlaces visibles** del menú (el índice lo genera el View Composer). Muestra "Módulo › Submódulo", navega con ↑/↓/Enter y se enfoca con Ctrl+K (⌘K en Mac). Usa el estilo de input de la plantilla.
- Botón de modo oscuro (`localStorage.darkMode`).
- **Periodo:** botón con el nombre del periodo actual (sustituye al ícono de calendario y su tooltip); abre el modal.
- **Usuario:** nombre real (`Session::get('nombre')`, que viene de `gnral_personales.nombre`) y periodo (`nombre_periodo`). Opciones: Datos personales (`/docentes/modificar/`), Cambiar periodo y **Cerrar sesión** (formulario POST a `/logout` con `@csrf`).
- **Sin campana** de notificaciones.

## 7. Cambio de periodo
- Modal de Alpine (`x-show`, `x-transition`, cierre con Esc y clic afuera).
- Datos: `Session::get('arre_periodos')` y `periodo_actual`, entregados por el composer. Son los mismos que hoy, sin consultas nuevas.
- Comportamiento: igual que `partials/periodos` (anterior, actual y siguiente, con flechas ↑↓ para recorrer). El actual se resalta con `bg-brand-500`. Cada fila enlaza a `GET /periodo/{id}`; `recargaperiodo()` hace `back()` y regresa a `/inicio`.

## 8. Contenido del dashboard

### 8.1 Grid (como `src/pages/index.html`)

```
grid grid-cols-12 gap-4 md:gap-6
├─ col-span-12                      Avisos: mensaje global (men), aviso RETÍCULA/DOCENTE, aviso de canalización (si aplica)
├─ col-span-12 xl:col-span-7        Indicadores (2×2, estilo ecommerce-metrics) + gráfica de barras por carrera
├─ col-span-12 xl:col-span-5        Gráfica radial de aprobación (estilo monthly-target)
├─ col-span-12                      Gráfica de matrícula por periodo (estilo statistics-chart)
└─ col-span-12                      Accesos rápidos: tarjetas rounded-2xl a los módulos principales
```

Las tarjetas usan las clases de la plantilla: `rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/3`.

### 8.2 Avisos y accesos (sin consultas nuevas)
- **Mensaje global:** `men.id = 1` (ya está en la sesión como `men`).
- **Aviso RETÍCULA/DOCENTE:** texto fijo, con ortografía corregida.
- **Canalización por reprobación:** se mueve **la misma consulta** que hoy hace `home_recargado.blade.php:28-117` a `PanelDirectivoService::avisoCanalizacion()`.
- **Accesos rápidos:** salen de `MenuDirectivo` (los módulos marcados `->destacado()`: Control Escolar, Evaluación Doc., Horarios, Generales, Oficios Com., Incidencias de Asistencia y SGOE). Así respetan la misma visibilidad.

### 8.3 Indicadores y gráficas: **requieren tu aprobación** (pendiente B)

Todo con parámetros enlazados y `:p = Session::get('periodo_actual')`. No hay números fijos. Si una consulta no devuelve datos, la tarjeta dice "Sin datos".

| ID | Indicador / gráfica | Tablas | Consulta propuesta |
|---|---|---|---|
| K1 | Estudiantes con carga académica en el periodo | `eva_carga_academica` | `SELECT COUNT(DISTINCT id_alumno) FROM eva_carga_academica WHERE id_periodo = :p` |
| K2 | Docentes con horario en el periodo | `gnral_horarios`, `gnral_periodo_carreras` | `SELECT COUNT(DISTINCT h.id_personal) FROM gnral_horarios h JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera WHERE pc.id_periodo = :p` |
| K3 | Índice de reprobación del periodo (%) | `cal_evaluaciones`, `eva_carga_academica` | `SELECT ROUND(100 * SUM(ev.calificacion < 70) / NULLIF(COUNT(*),0), 1) FROM cal_evaluaciones ev JOIN eva_carga_academica ca ON ca.id_carga_academica = ev.id_carga_academica WHERE ca.id_periodo = :p` (el criterio `< 70` es el que ya usan `HomeController2` y `Beca_SolicitudController`) |
| K4 | Oficios de incidencias por validar | `inc_solicitudes` | `SELECT COUNT(*) FROM inc_solicitudes WHERE id_estado_solicitud = 1 AND direc_finanzas = 0 AND id_jefe = :id_perso` (misma regla que `IncidenciasController@vista5`, L256-261) ⚠ ver la nota |
| G1 | Barras: estudiantes por carrera | `eva_carga_academica`, `gnral_alumnos`, `gnral_carreras` | `SELECT c.siglas, c.COLOR, COUNT(DISTINCT ca.id_alumno) total FROM eva_carga_academica ca JOIN gnral_alumnos a ON a.id_alumno = ca.id_alumno JOIN gnral_carreras c ON c.id_carrera = a.id_carrera WHERE ca.id_periodo = :p GROUP BY c.id_carrera, c.siglas, c.COLOR ORDER BY c.siglas` |
| G2 | Línea: matrícula de los últimos 6 periodos | `eva_carga_academica`, `gnral_periodos` | `SELECT gp.periodo, COUNT(DISTINCT ca.id_alumno) total FROM eva_carga_academica ca JOIN gnral_periodos gp ON gp.id_periodo = ca.id_periodo WHERE ca.id_periodo BETWEEN :p - 5 AND :p GROUP BY gp.id_periodo, gp.periodo ORDER BY gp.id_periodo` |
| G3 | Radial: índice de aprobación del periodo | igual que K3 | `100 − K3` (sin consulta extra) |

Notas:
- **K4:** `IncidenciasController@vista5` (L251-261) compara `id_jefe` con el **objeto** `$id_personal` completo, no con su id, y en L281 lo concatena dentro del SQL. Parece un bug existente (no se corrige en esta tarea). K4 usaría `id_perso` (entero), así que el número podría no coincidir con la pantalla actual. Propongo validarlo con la BD encendida o dejar K4 fuera.
- **Rendimiento:** `cal_evaluaciones` puede ser grande. Propongo `Cache::remember(…, 10 min)` por periodo y medir los tiempos con la BD real antes de activar el panel.

## 9. Responsivo (igual que la plantilla)

| Ancho | Sidebar | Header |
|---|---|---|
| ≥ 1280 px (`xl`) | Fijo, `w-72.5`; colapsable a `w-22.5` (solo íconos; los submenús se ocultan) | Buscador visible; tema, periodo y usuario a la derecha |
| 768-1279 px | Fuera de pantalla; se abre sobre el contenido con backdrop | Botón de menú + logo; acciones en el menú desplegable "⋯" |
| < 768 px | Igual que tablet, a ancho `w-72.5` | Igual; grid a 1 columna (`col-span-12`) |

## 10. Pruebas y documentación

Las pruebas siguen el patrón de `tests/Unit/EditarDocenteTest.php`: SQLite en memoria con `Schema::create` solo de las tablas que tocan los menús. Un helper `tests/Support/EsquemaMenus.php` crea `gnral_personales`, `gnral_periodos`, `gnral_jefes_periodos`, `exp_asigna_*`, `ar_*`, `aud_auditores`, `aud_lider_acciones`, `aud_seguimiento_auditorias` y `gnral_alumnos`.

| Archivo | Qué verifica |
|---|---|
| `tests/Feature/Panel/ComparacionEnlacesDirectivoTest.php` | Renderiza `partials.menu_admin` (vía `@yield('menu')`) y `partials.panel.sidebar` con la misma sesión de directivo; extrae `href` y `action` y exige **0 faltantes**. Variantes con dataset: sin unidad; unidades 1, 2, 5, 6, 8, 14, 16, 17, 19, 24, 25, 26, 28 y 40; auditor y auditor líder; líder de acciones; tutor; responsable de área; ids 2630 y 2662; encargado ambiental; asesor |
| `tests/Feature/Panel/NoRegresionPanelTest.php` | Un alumno, un docente y un jefe de división en `/inicio` siguen viendo `home_recargado` y `layouts.app`; un directivo con la bandera en `false` también ve el panel clásico; con `true` ve `directivo.panel` |
| `tests/Unit/Menus/MenuDirectivoTest.php` | 166 elementos con números de inventario únicos (1-166); P.A.AC marcado oculto y sin renderizar; `/logout` es POST con token |

`docs/panel.md` cubrirá: arquitectura (layout, composer, menús por perfil), cómo agregar un módulo o un perfil, cómo compilar y desplegar (`npm ci && npm run build` + commit de `public/build`), activación y reversión, pendientes (#54, #95-97) y la sección **"Cómo migrar un módulo al nuevo layout"** con la tabla de equivalencias Bootstrap 3 → Tailwind y los reemplazos de plugins jQuery.

## 11. Archivos y commits

**Crear:** `config/tesvb.php`, `app/Menus/{ElementoMenu,GrupoMenu,ContextoMenu,Menu,MenuDirectivo,PerfilPanel}.php`, `app/View/Composers/PanelComposer.php`, `app/Services/PanelDirectivoService.php`, `resources/css/panel.css`, `resources/js/panel.js`, `resources/js/panel/{alpine,dropdown,buscador,periodos,graficas}.js`, `resources/views/layouts/panel.blade.php`, `resources/views/partials/panel/*` (10 parciales + `iconos/`), `resources/views/directivo/panel.blade.php` + `directivo/partials/*`, las pruebas de §10, `tests/Support/EsquemaMenus.php`, `docs/panel.md`, `public/build/*` y, si se aprueban, `public/img/panel/*`.

**Modificar:** `package.json`, `package-lock.json`, `vite.config.js`, `.gitignore` (quitar `/public/build`), `resources/css/app.css` (sintaxis v4), `app/Providers/AppServiceProvider.php`, `app/Http/Controllers/HomeController2.php` (solo el arranque de `index()`), `.env.example`.

**Eliminar:** `postcss.config.js`, `tailwind.config.js` y `public/hot` (local, no versionado).

**No se tocan:** `layouts/app.blade.php`, `partials/menu_admin.blade.php`, el resto de los layouts, `HomeController.php`, `routes/*.php` ni las 667 vistas.

| # | Commit | Estado |
|---|---|---|
| 1 | `docs: análisis del sistema tesvb_relaciones` | hecho (`6c80239`) |
| 2 | `docs(panel): inventario del menú del perfil directivo e ignorar plantilla de referencia` | hecho (`7e7be9e`) |
| 3 | `docs(panel): plan del nuevo panel del directivo` | este documento |
| 4 | `build(panel): Tailwind v4, Alpine y ApexCharts en el Vite del proyecto` | Fase 3 |
| 5 | `feat(panel): configuración tesvb y bandera PANEL_DIRECTIVO_NUEVO` | Fase 3 |
| 6 | `feat(panel): layout base TailAdmin` | Fase 3 |
| 7 | `feat(panel): estructura de menús por perfil y View Composer` | Fase 3 |
| 8 | `feat(panel): MenuDirectivo con las 166 entradas del inventario` | Fase 3 |
| 9 | `feat(panel): sidebar` | Fase 3 |
| 10 | `feat(panel): header con buscador, tema y usuario` | Fase 3 |
| 11 | `feat(panel): selector de periodo` | Fase 3 |
| 12 | `feat(panel): servicio y contenido del dashboard del directivo` | Fase 3 |
| 13 | `feat(panel): indicadores y gráficas` (solo con §8.3 aprobado) | Fase 3 |
| 14 | `feat(panel): activar panel nuevo del directivo en HomeController2` | Fase 3 |
| 15 | `test(panel): comparación de enlaces y no regresión` | Fase 4 |
| 16 | `docs(panel): arquitectura y guía de migración` | Fase 4 |
| 17 | `build(panel): compilación de producción` | Fase 4 |

**Cómo revertir:**
1. Sin desplegar: `PANEL_DIRECTIVO_NUEVO=false` + `php artisan config:clear`.
2. En código: `git revert` del commit 14 (desactiva la entrada) o de toda la rama.
3. Nada del sistema viejo se modifica, así que no hay que restaurar nada más.

## 12. Hallazgos incidentales (no se corrigen en esta tarea)
- `IncidenciasController@vista5` (L251-261, L281): usa el objeto `$id_personal` como id y lo concatena en el SQL (ver la nota de K4).
- MySQL local apagado: impide confirmar las unidades reales de los directivos (pendiente A).
