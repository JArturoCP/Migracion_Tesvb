# Plan: panel del profesor de inglés (y del módulo de Inglés) con el diseño del panel

Fecha: 2026-11-18. Rama `cacique`. Estado: **base implementada** (layout en el marco, menú en el sidebar, periodo de inglés en el header y nuevo /ingles). Los 5 lotes de vistas siguen pendientes. Ver §3.
Referencias: `docs/panel.md` (marco, componentes, cómo migrar), `docs/PLAN_PANEL.md`, `docs/MIGRACION_VISTAS.md`, `docs/INVENTARIO_MENU.md` (sección 14).

Regla principal: no se quita ni se modifica ningún módulo, submódulo, ruta, controlador, modelo, consulta, permiso ni bandera de sesión (`profesor_ingles`, `id_profesor_ingles`, `nombre_ingles`, `periodo_ingles`, `nombre_periodo_ingles`), ni la redirección a `/ingles` de `HomeController` ni `In_inicioController`. Solo cambia el diseño, reutilizando el marco, el sidebar, el header, `marco.css` y los componentes `x-panel.*`.

---

## PASO 1 — Análisis (solo lectura)

### 1.1 `ingles/inicio_ingles/layout_ingles.blade.php`

**Carga** (casi lo mismo que `layouts.app`, con diferencias):

| Recurso | Detalle |
|---|---|
| JS | Vue **1.0.18** (CDN), axios (unpkg, sin versión), jQuery `/js/jquery.min.js`, **Bootstrap 3.4.0 JS** (CDN), jQuery UI, `tooltip.js`, bootstrap-datepicker (+ `es`), bootstrap-colorpicker, bootstrap-toggle, **Highcharts desde code.highcharts.com sin versión** (+ exporting, export-data), jQuery Validate, **DataTables local `/js/jquery.dataTables.min.js`** + `dataTables.bootstrap.min.js` + FixedHeader + accent-neutralise + tesvb-datatables, blockUI, SweetAlert2, pickadate (`picker.js`, `picker.time.js`), `legacy.js`, `tesvb-notify.js` |
| CSS | `/css/app.css` (Bootstrap 3 del sistema), datepicker, `dataTables.bootstrap.min.css`, tesvb-datatables/responsivo, SweetAlert2, open-iconic, Font Awesome 4.7, bootstrap-toggle, timepicker, pickadate themes, colorpicker |
| Script en línea | `$('#nav').affix(…)` y `$('#sidebar').affix(…)` (plugin de Bootstrap; no hay elementos `#nav` ni `#sidebar` en el layout) |
| Estructura | `@section('header')` → `partials.head` (franja); `@section('menu_ingles')` → **invitado:** `partials.menu_register`; **con sesión:** `ingles.inicio_ingles.menu_ingles`; `<div class="tesvb-contenido">@yield('content')</div>`; `@section('footer')` → `partials.footer`; `@yield('scripts')` |

**Menú propio (`ingles/inicio_ingles/menu_ingles.blade.php`)**, con sus condiciones exactas (variables: `$unidad = Session::get('id_unidad_admin')`, `$palumno`, `$profesor_ingles`):

| Orden | Opción | URL | Condición |
|---|---|---|---|
| Insignia | Nombre del profesor (`nombre_ingles`) | — | `$profesor_ingles==true` |
| Insignia | Nombre (`nombre`) | — | `elseif($palumno==true \|\| $unidad == 19)` |
| Insignia | **Periodo de Ingles: {nombre_periodo_ingles}** (`a.periodo_ingles`, `id="{periodo_ingles}"`) | `#` (abre el modal) | siempre (con sesión) |
| 1 | Salir | `POST /logout` | siempre |
| 2 | Datos P. › Editar | `/profesores_ingles/modificar/{id_usuario}/` | `$profesor_ingles==true` |
| 3 | Facilitadores de ingles | `/armar_plantilla/profesore_ingles` | `$unidad==19` |
| 4 | Horarios › Agregar plantilla al periodo / Armar horarios / Horarios de los Facilitadores / Horarios por grupo | `/agregar_profesor/ingles_periodo/`, `/ingles_horarios/agregar`, `/ingles/mostrar_horarios_profesores`, `/ingles/mostrar_horario_profesor_grupo/` | `$unidad==19` |
| 5 | Niveles · Grupos · Periodos intersemestrales · Cargas academicas | `/ingles/mostrar_niveles`, `/ingles_horarios/mostrar_grupo`, `/ingles/mostrar_periodos`, `/ingles/autorizacion_cargas/` | `$unidad==19` |
| 6 | Calificaciones › Calificaciones / Boleta de Calificaciones / Certificado de Acreditacion / Historial de Calificaciones | `/ingles/profesores/calificaciones`, `/ingles/ver_cal_coordinador_ingles/`, `/titulacion/ingles_carreras/`, `/ingles/historial_academico_alumno/` | `$unidad==19` |
| 7 | Validación de Vouchers › En espera / Aceptados / Rechazados / Maximo de Estudiantes por Periodo / Examen Ubicacion | `/ingles/vouchers_validacion`, `/ingles/vouchers_aceptados`, `/ingles/vouchers_rechazados`, `/ingles/maximo_grupo_alumnos`, `/ingles/control-escolar` | `$unidad==19` |
| 8 | Desactivar grupos › Desactivacion de grupos | `/ingles/desactivar_grupos/` | `$unidad==19` |
| 9 | Desempeño Academico › Programas Academicos; Estadísticas › Estadisticas Trimestrales / Estadísticas Generales | `/ingles/desempeno_academico/niveles`, `/ingles/desempeno_academico/estadisticas_generales`, `/ingles_estadistica/estadisticas_genero/` | `$unidad==19` (submenú de 3 niveles) |
| 10 | Carga academica de ingles › Cargar voucher de pago / Registrar carga academica de ingles / Ver carga academica de ingles / Ver calificaciones de ingles | `/ingles_horarios/cargar_voucher_pago`, `/ingles_horarios/iniciar_carga_academica/`, `/ingles_horarios/revision_carga_academica/`, `/ingles/ver_cal_alumno_ingles/` | `$palumno==true` |
| 11 | **Calificaciones** | `/ingles/Calificaciones` | `$profesor_ingles==true` |
| 12 | Regresar | `/` | `$profesor_ingles!=true` |

Total: 30 enlaces (Salir, Datos P., 22 de la unidad 19, 4 del alumno, Calificaciones y Regresar) y la insignia del periodo. Las condiciones no son excluyentes (un usuario con unidad 19 que además fuera alumno vería ambos bloques).

**Periodo de inglés:**
- La insignia `a.periodo_ingles` lleva `id = Session::get('periodo_ingles')`. Al hacer clic, `GET /profesores_ingles/periodos/{id}` (`In_registrar_profesoresController@periodo`) devuelve `ingles/periodos_ingles.blade.php` (lista de periodos de `in_periodos`), que se pone en `#contenedor_modificar_periodo` y se abre `#modal_modificar_periodo`.
- Cada periodo distinto al actual es un enlace `GET /recargar/periodos_ingles/{id}` (`@recargar_periodo`): pone `periodo_ingles` y `nombre_periodo_ingles` en la sesión y regresa (`back()`).
- `HomeController` fija el periodo de inglés inicial según la fecha (L72-74, para todos los usuarios).
- El modal tiene un `<form method="POST">` sin action ni campos (solo `@csrf`); en la práctica se usan los enlaces.

### 1.2 `In_inicioController@index` e `inicio_ingles.blade.php`

- `index()` solo devuelve `view('ingles.inicio_ingles.inicio_ingles')`, **sin datos**.
- La vista muestra un panel con **"!!!!!Bienvenido(a)!!!!!"** y nada más. El nombre y el periodo los muestra el menú (insignias).
- `HomeController` (tipo 3) guarda `men` (mensaje global) en la sesión del profesor, pero **ninguna vista de inglés lo muestra**.
- La ruta `/ingles` es la misma para el **profesor** (M252), el **alumno** (M227) y la **unidad 19** (M026): la vista es compartida.

### 1.3 Qué menú ve el profesor de inglés

- **`HomeController` (tipo_usuario 3):** si no tiene ficha en `in_profesores_ingles` → `profesores_ingles/create` (vista `ingles.create_profesores`, con `layouts.app`); si la tiene → pone `profesor_ingles`, `id_usuario`, `nombre_ingles`, `id_profesor_ingles`, `men` y **redirige a `/ingles/`**. Nunca llega a `/inicio`.
- **En `menu_admin`** (solo lo vería en una pantalla con `layouts.app`) tiene: la insignia con `nombre_ingles` y `nombre_periodo_ingles` (L357-365), **M252 "Ingles" → `/ingles/`** (L2118-2124), "Salir" (M002) y el modal `#modal_modificar_periodo` con su script (L2507-2575), **sin disparador** `.periodo_ingles`.
- **Su menú real es el de `layout_ingles` (`menu_ingles`)**: todas las pantallas a las que llega usan ese layout. Opciones: Salir, Datos P. › Editar, Calificaciones e insignia del periodo de inglés.
- El sidebar del panel (copia de `menu_admin`) ya trae M252, la insignia (en el menú de usuario del header) y el modal de periodo de inglés (Alpine + `resources/js/panel/modal_periodo_ingles.js`), sin disparador visible.

### 1.4 Las 44 vistas con `layout_ingles`

42 en `resources/views/ingles` y 2 en `resources/views/titulacion/jefe_ingles`. Rol según la opción del menú que las abre (o la pantalla desde la que se llega). Complejidad con los criterios de `docs/MIGRACION_VISTAS.md` §6.

**Compartida (profesor, alumno y unidad 19):**

| Vista | Ruta | Complejidad |
|---|---|---|
| `inicio_ingles/inicio_ingles` | `/ingles` | Baja |

**Profesor de inglés (5):**

| Vista | Ruta (cómo se llega) | Complejidad |
|---|---|---|
| `partials/modificar_profesor` | `/profesores_ingles/modificar/{id_usuario}` (Datos P. › Editar) — 1 formulario | Media |
| `profesores_ingles/inicio_calificaciones` | `/ingles/Calificaciones` (también la usa la unidad 19 desde `/ingles/profesores/calificacion_profesor/{id}`) | Baja |
| `profesores_ingles/periodos_calificaciones` | `/ingles/Calificaciones/periodos_ingles/{nivel}/{grupo}` — 2 formularios, 2 modales, AJAX | Media |
| `profesores_ingles/asignacion_calificaciones` | `/ingles/Calificaciones/mostrar_alumnos/{n}/{g}` (y actas, `In_acta_ordinariaController`) — 858 líneas, formulario, modal, AJAX | Alta |
| `profesores_ingles/asignacion_calificaciones_act` | misma familia (`In_inicioController` L745) — 858 líneas | Alta |

Fragmentos sin layout que van con ellas: `periodos_ingles` (modal de periodo), `profesores_ingles/crear_periodo_calificacion`, `profesores_ingles/modificar_periodo_ingles_calificaciones`.

**Alumno (7):**

| Vista | Ruta | Complejidad |
|---|---|---|
| `alumno_ingles/estado_periodo`, `estado_voucher`, `estado_registro_carga_academica` | `/ingles_horarios/iniciar_carga_academica/` (según el estado) | Baja |
| `alumno_ingles/llenar_carga_ingles` | `/ingles_horarios/llenar_carga_academica`, `/ingles_horarios/carga_academica_grupo/{id}` — AJAX | Media |
| `alumno_ingles/revision_carga_ingles` | `/ingles_horarios/revision_carga_academica/` | Media |
| `cargas_ingles/cargar_voucher_pago` | `/ingles_horarios/cargar_voucher_pago` — 512 líneas, 2 formularios | Alta |
| `ver_cal_alumno_ingles` | `/ingles/ver_cal_alumno_ingles/` | Baja |

**Coordinación de inglés (unidad 19) (31):**

| Grupo | Vistas | Complejidad |
|---|---|---|
| Facilitadores y horarios (7) | `mostrar_profesores_ingles` (modales, AJAX), `plantilla_ingles_periodo` (DataTables, 2 formularios, 2 modales), `armar_horarios_ingles` (332 líneas, AJAX), `horarios_facilitadores`, `profesor_nivel`, `mostrar_grupos_niveles` (AJAX), `partials/mostrar_grupo` | 1 Alta, 3 Media, 3 Baja |
| Catálogos y cargas (5) | `partials/mostrar_niveles`, `partials/mostrar_periodos`, `departamento/validar_carga_ingles` (DataTables, modal, AJAX), `departamento/ver_carga_academica_ingles`, `departamento/profesores_validar_grupos` | 1 Media, 4 Baja |
| Calificaciones y certificados (8) | `departamento/profesores_calificaciones`, `ver_cal_coordinador_ingles`, `mostrar_calificacion_ingles_coordinador` (DataTables, modal), `carreras_historial`, `mostrar_calificaciones` (DataTables), `generar_constancias` (DataTables), `titulacion/jefe_ingles/ver_carreras_ingles`, `titulacion/jefe_ingles/registro_alumnos_certificado` (330 líneas, 4 formularios, 4 modales, DataTables) | 1 Alta, 3 Media, 4 Baja |
| Vouchers y control escolar (7) | `cargas_ingles/vouchers_validar` (DataTables, 2 modales), `vouchers_aceptados` (4 modales), `vouchers_rechazados`, `maximo_grupo_alumnos` (3 formularios), `departamento/nuevo_ingreso` (826 líneas, 2 modales), `departamento/desactivacion_grupos`, `departamento/agregar_usuarios_grupos` (DataTables, modal) | 2 Alta, 4 Media, 1 Baja |
| Desempeño y estadísticas (4) | `desempeno_academico/niveles`, `desempeno_academico/estadisticas_generales` (Highcharts), `estadisticas/estadisticas_genero` (Highcharts), `estadisticas/grafica_genero` (Highcharts) | 3 Alta, 1 Media |

Fuera de `layout_ingles`, en la misma carpeta: `create_profesores` (`layouts.app`, alta del profesor sin ficha) y 20 vistas sin layout (fragmentos AJAX, Excel y PDF).

---

## PASO 2 — Plan

### 2.1 Sidebar del módulo de Inglés (sin copia nueva)

Se usa el **mismo** `partials/panel/sidebar.blade.php`. Las opciones de `menu_ingles` se agregan **una sola vez**, como submenú de la entrada "Ingles" que cada rol ya tiene (M252 profesor, M227 alumno, M026 unidad 19), con **las mismas condiciones y el mismo orden** de `menu_ingles` (tabla 1.1):

```
Ingles                                  (misma condición que hoy: M252 / M227 / M026)
├── Inicio de Inglés  → /ingles/        (el enlace que hoy tiene la entrada)
├── Datos P. › Editar                   @if($profesor_ingles==true)
├── Facilitadores de ingles … Desempeño Academico › Estadísticas …   @if($unidad==19)   (22 enlaces, en el mismo orden; los submenús de 2 y 3 niveles como subgrupos plegables, igual que SGOE)
├── Carga academica de ingles › …       @if($palumno==true)
└── Calificaciones                      @if($profesor_ingles==true)
```

- "Salir" ya está en el header (Cerrar sesión, mismo POST `/logout`). "Regresar" (`/`, para quien no es profesor) lo cubre "Inicio" del sidebar, como se hizo con Tutorías.
- **Variables:** `menu_ingles` usa `$unidad = Session::get('id_unidad_admin')` y `$id_usuario = Session::get('id_usuario')`; se copian igual en el bloque.
- **Duda (pregunta 1):** en `menu_admin` (y en el sidebar actual) solo está el enlace "Ingles"; las opciones internas solo aparecen dentro de las pantallas de inglés. Con este plan aparecerían también al desplegar "Ingles" desde cualquier pantalla. Las rutas y los permisos no cambian, pero sí dónde se ven.

### 2.2 Selector de periodo de inglés en el header

- Un botón en el header **"Periodo de Inglés: {nombre_periodo_ingles}"** (mismo estilo que "Cambiar periodo"), con la clase `periodo_ingles` y `id = Session::get('periodo_ingles')`, como la insignia de `menu_ingles`.
- Al hacer clic, el JS que ya existe (`modal_periodo_ingles.js`) hace el mismo `GET /profesores_ingles/periodos/{id}` y abre el modal de periodo de inglés que ya está en el sidebar. Los enlaces siguen siendo `GET /recargar/periodos_ingles/{id}`.
- El fragmento `periodos_ingles.blade.php` (Bootstrap) se rediseña con clases `tw:` sin cambiar enlaces ni datos.
- **Cuándo se muestra (pregunta 2):** hoy aparece en todas las pantallas con `layout_ingles` (para cualquier rol). Propuesta: en esas mismas pantallas y, para el profesor, siempre (todas sus pantallas son de inglés). El botón "Cambiar periodo" escolar mantiene sus 4 condiciones.

### 2.3 Dashboard de `/ingles`

`inicio_ingles.blade.php` pasa a `layouts.panel` (como `/inicio`):

- **Bienvenida** (tarjeta como la de `/inicio`): el texto "Bienvenido(a)", el nombre (`nombre_ingles` para el profesor; `nombre` para alumno y unidad 19, igual que las insignias) y "Periodo de Inglés: {nombre_periodo_ingles}".
- **Avisos:** hoy no muestra ninguno. **Pregunta 4:** ¿mostrar el mensaje global `men` (ya está en la sesión del profesor) como lo hace `/inicio`?
- **Accesos a sus módulos:** tarjetas con las mismas opciones del menú de su rol (2.1) y sus mismas condiciones.
- **Métricas para el profesor (propuesta, solo lectura, pendiente de aprobación).** Todas con el profesor de la sesión (`id_profesor_ingles`) y el periodo de inglés de la sesión (`periodo_ingles`), con las mismas reglas que ya usa `In_inicioController`:

| # | Métrica | Tabla / consulta (misma regla que…) |
|---|---|---|
| M1 | **Mis grupos del periodo** | `COUNT(*) FROM in_hrs_ingles_profesor WHERE id_profesor = ? AND id_periodo = ?` (como `inicio_calificaciones`) |
| M2 | **Alumnos inscritos en mis grupos** | por cada grupo de M1: `COUNT(in_validar_carga.id_validar_carga)` de `in_validar_carga ⨝ in_carga_academica_ingles` (mismo nivel, grupo y `id_periodo_ingles`), `in_validar_carga.id_periodo = ?` y `id_estado = 2` (como `mostrar_alumnos`) |
| M3 | **Evaluaciones por capturar** | `in_cal_periodo` de mis grupos y periodo con `evaluada = 0` (`agregar_calificacion` la pone en 1 al capturar) |
| M4 | **Evaluaciones sin fecha registrada** | grupos de M1 con menos de 2 registros en `in_cal_periodo` (unidades 1 y 4, como `periodos_ingles`) |
| M5 | **Tabla "Mis grupos"** | nivel, grupo, inscritos (M2), evaluaciones capturadas (x/2) y enlace a `/ingles/Calificaciones/periodos_ingles/{nivel}/{grupo}` (ruta que ya existe) |

Se calcularían en un servicio de solo lectura (como `App\Services\Panel\DatosDirectivo`), con parámetros enlazados, caché corta por profesor y periodo y "Sin datos" si algo falla. Datos de prueba: `ingles01@example.com` (usuario 1) es el profesor 1; hay 15 filas en cada tabla. Para alumno y unidad 19 no propongo métricas en este paso.

### 2.4 `layout_ingles` dentro del marco (como Tutorías)

- Igual que `tutorias/app_tutorias`: dividir `layout_ingles` en `ingles/inicio_ingles/partials/cabeza` (su `<head>` sin cambios), `encabezado` (`partials.head`) y `cuerpo` (menú, contenido, pie, `@yield('scripts')`), **sin cambiar su HTML**.
- **Con sesión** → `layouts.marco` (sidebar y header del panel; el contenido en `x-ignore`; marco siempre claro). **Sin sesión** → igual que hoy (franja + `menu_register`).
- `menu_ingles` deja de mostrarse dentro del marco **solo cuando** el sidebar (2.1) y el header (2.2) ya tienen todas sus opciones (lo verifica la prueba de comparación); el modal `#modal_modificar_periodo` y su script se conservan.
- Mientras una vista no se rediseñe, se ve con su CSS y JS de siempre dentro del marco.
- **Riesgo a revisar en el navegador:** el layout carga **Bootstrap 3.4 JS** y **Vue 1.0.18**; el puente del panel no se usa en el marco (las vistas siguen con su Bootstrap), igual que en Tutorías.

### 2.5 Vistas a rediseñar después (por lotes)

| Lote | Rol | Vistas | Complejidad |
|---|---|---|---|
| I-1 | Profesor | `inicio_ingles` (dashboard, 2.3), `partials/modificar_profesor`, `profesores_ingles/inicio_calificaciones`, `periodos_calificaciones`, `asignacion_calificaciones`, `asignacion_calificaciones_act` + fragmentos `periodos_ingles`, `crear_periodo_calificacion`, `modificar_periodo_ingles_calificaciones` | 2 Alta, 2 Media, 2 Baja |
| I-2 | Alumno | `alumno_ingles/*` (5), `cargas_ingles/cargar_voucher_pago`, `ver_cal_alumno_ingles` | 1 Alta, 2 Media, 4 Baja |
| I-3 | Unidad 19 | Facilitadores, horarios y catálogos (12) | 1 Alta, 4 Media, 7 Baja |
| I-4 | Unidad 19 | Calificaciones, certificados, vouchers y control escolar (15) | 3 Alta, 7 Media, 5 Baja |
| I-5 | Unidad 19 | Desempeño y estadísticas (Highcharts) (4) | 3 Alta, 1 Media |

Cada lote con las reglas del Lote 1 (`docs/LOTE1_DIRECTIVO.md`): `@extends('layouts.panel')`, componentes `x-panel.*`, `recursos_app` con los mismos plugins, prueba de comparación contra la versión anterior con los datos del controlador.

### 2.6 Pruebas

1. **Comparación de enlaces de Inglés** (nueva, como `ComparacionEnlacesTest`): para profesor de inglés, alumno, unidad 19 y combinaciones (alumno + unidad 19), con la misma sesión:
   - **antes:** enlaces de `menu_ingles` + `menu_admin` (lo que el usuario puede ver hoy entre las pantallas de inglés y las demás);
   - **después:** enlaces del sidebar + header del panel;
   - **0 faltantes y 0 sobrantes**, con repeticiones; "Salir" y la insignia del periodo se buscan en el header; "Regresar" (`/`) se acepta como "Inicio".
2. **Destino del profesor:** `ingles01@example.com` → `/home` → redirección a `/ingles` (ya cubierto en `tests/Integracion/LoginRolesTest.php`) y `/ingles` responde 200 dentro del panel; el profesor sin ficha sigue yendo a `/profesores_ingles/create`.
3. **Marco de `layout_ingles`:** con sesión, dentro del marco con los mismos recursos del `<head>` y el mismo contenido; sin sesión, HTML idéntico al de hoy.
4. **Periodo de inglés:** el botón del header tiene `class="periodo_ingles"` e `id` del periodo, y el fragmento conserva los enlaces `/recargar/periodos_ingles/{id}`.
5. **Por vista rediseñada:** formularios (action, method, `_token`, `name` y `value`), ids y clases de scripts y textos contra la versión anterior, con los datos que entrega el controlador (como `LoteDirectivoTest`), en MySQL dentro de una transacción.
6. **Métricas (si se aprueban):** solo lecturas (`DB::listen`), números iguales a los de las pantallas de calificaciones con los datos de prueba, "Sin datos" si falla.

### 2.7 Orden de commits propuesto

1. `layout_ingles` dentro del marco (2.4) + prueba de marco.
2. Sidebar de Inglés (2.1) + selector de periodo (2.2) + prueba de comparación de enlaces; quitar `menu_ingles` del marco.
3. Dashboard `/ingles` (2.3) con o sin métricas, según lo aprobado.
4. Lote I-1 (profesor) y, después, I-2 … I-5, uno por commit.

### 2.8 Hallazgos (no se tocan)

- "Datos P. › Editar" apunta a `/profesores_ingles/modificar/{id_usuario}/` (con barra final); la ruta es sin barra; Laravel la resuelve igual.
- El script en línea de `layout_ingles` llama a `.affix()` (Bootstrap) sobre `#nav` y `#sidebar`, que no existen; no hace nada.
- Highcharts y axios se cargan desde CDN **sin versión fija** (cambian solos con el tiempo); al rediseñar se usaría el Highcharts local de `/js` solo si la gráfica es compatible, si no se conserva el CDN.
- El modal `#modal_modificar_periodo` tiene un `<form method="POST">` sin `action` ni campos; se conserva igual.

---

## 3. Base implementada (2026-11-18)

Respuestas del usuario: submenú "Inglés" en el sidebar (opción a); botón de periodo de inglés siempre para el profesor y en las pantallas de inglés para los demás, distinto del periodo escolar; M1-M5 aprobadas (solo lectura, solo profesor); mostrar `men`; alumno y unidad 19 también ven el nuevo /ingles.

| Commit | Qué cambia |
|---|---|
| `dee246e` | `layout_ingles` dividido en `ingles/inicio_ingles/partials/{cabeza,encabezado,cuerpo}`; con sesión se muestra en `layouts.marco` (mismo `<head>`), sin sesión HTML idéntico |
| `52c4a7f` | `partials/panel/menu_ingles`: la entrada "Inglés" (M026/M227/M252) es un módulo con "Inicio de Inglés" + las 28 opciones de `menu_ingles` con sus condiciones y href (la primera entrada; si un usuario tuviera dos, la segunda queda como enlace directo). `partials/panel/periodo_ingles_header`: botón verde "Inglés" con ícono de libro, `class="periodo_ingles"` e `id` del periodo (mismo GET y modal). `ingles/periodos_ingles` con diseño del panel (mismos enlaces). Dentro del marco ya no se repite `menu_ingles` |
| (este) | `/ingles` en `layouts.panel`: bienvenida (nombre y periodo de inglés), aviso `men`, métricas M1-M5 del profesor (`App\Services\Panel\DatosProfesorIngles` vía `App\View\Composers\InglesInicioComposer`; `In_inicioController` sin cambios) y accesos por rol con las condiciones de `menu_ingles` |

Definición final de las métricas (§2.3): M3 cuenta las evaluaciones de la unidad 1 y 4 con `evaluada = 0` (las que `periodos_ingles` muestra como "Evaluación pendiente"); M4 = 2 − registros de `in_cal_periodo` del grupo (los "Asignar fecha" de esa pantalla). Caché de 5 minutos por profesor y periodo.

**Pruebas:** `ComparacionEnlacesTest` (menú viejo + `menu_ingles` = sidebar + header, 0 faltantes / 0 sobrantes en los 90 escenarios), `MenuInglesTest`, `MarcoInglesTest`, `tests/Integracion/InglesInicioTest.php` (MySQL en transacción: /home → /ingles, solo lecturas, M1-M4 iguales a lo que entregan `/ingles/Calificaciones`, `mostrar_alumnos` y `periodos_ingles`, con los datos de prueba y con datos extra; alumno; unidad 19).

**Sin cuenta de unidad 19 en la base local:** ningún registro de `gnral_unidad_personal` tiene `id_unidad_admin = 19`; la prueba la simula dentro de la transacción.

**Hallazgo (no se tocó):** `periodos_calificaciones` lee `$periodo1[0]` sin revisar que exista; si un grupo tuviera un solo registro en `in_cal_periodo` y no fuera de la unidad 1, la pantalla fallaría. Las métricas no dependen de eso.

## 4. Ajuste: /ingles igual al dashboard de /inicio (2026-11-18)

- `/ingles` en `layouts.panel` con `sin_pie` y `modo_oscuro` (como /inicio). Bienvenida con el parcial compartido `panel.dashboard.bienvenida` (extraído de `panel/inicio`, mismo HTML), aviso `men` igual que /inicio y `@include('panel.dashboard.' . $perfilTablero)` como /inicio.
- Profesor: `panel/dashboard/profesor_ingles.blade.php`, con la misma disposición que `directivo.blade.php` y los mismos parciales (`metricas`, `barras`, `radial`, `linea`, `lista`, `tabla`). Datos: `App\Services\Panel\DatosIngles` (reemplaza a `DatosProfesorIngles`; caché 10 min) vía `InglesInicioComposer` (`$tablero`, `$perfilTablero`).
  - Métricas: M1 mis grupos y M2 alumnos inscritos, comparadas con el periodo de inglés anterior.
  - Barras: alumnos inscritos por grupo. Radial: capturadas / (grupos × 2), detalle capturadas · por capturar (M3) · sin fecha (M4).
  - Línea: grupos y alumnos inscritos del profesor en los últimos 6 periodos de `in_periodos`. Lista: alumnos por nivel. Tabla: Mis grupos (M5) con enlace "Periodos" por fila.
  - `panel.dashboard.tabla` acepta una celda `['enlace' => texto, 'url' => …]` (nuevo tipo de celda; el directivo no cambia).
- Alumno y unidad 19: bienvenida, aviso y accesos (con `x-panel.tarjeta`); sin métricas.

### Propuesta de métricas para la unidad 19 (pendiente de aprobación)

Mismo formato (`panel.dashboard.*`), periodo = `Session periodo_ingles`, solo lectura, mismas reglas que las pantallas del menú de la coordinación:

| Bloque | Dato | Tabla / regla (pantalla) |
|---|---|---|
| Métrica | Grupos con facilitador en el periodo | `in_hrs_ingles_profesor` del periodo unido con niveles y grupos (Horarios de los Facilitadores) |
| Métrica | Alumnos con carga validada | `in_validar_carga` del periodo con `id_estado = 2` (Cargas academicas) |
| Métrica | Vouchers por validar | `in_voucher_pago` del periodo con `id_estado_valida_voucher = 1`, unido con `users` y `gnral_alumnos` (`In_voucher_validacionController@index`, En espera) |
| Barras | Alumnos por grupo | regla de `mostrar_alumnos` por cada grupo del periodo |
| Lista | Alumnos por nivel | misma regla agrupada por `in_niveles_ingles` |
| Radial | Avance de captura de calificaciones de todos los grupos | `in_cal_periodo` unidades 1 y 4 (`evaluada`) |
| Línea | Alumnos inscritos y vouchers aceptados por periodo (últimos 6) | mismas reglas por periodo |
| Tabla | Vouchers: en espera / aceptados / rechazados | `in_voucher_pago.id_estado_valida_voucher` (pantallas En espera, Aceptados, Rechazados; falta confirmar los ids de aceptado y rechazado en sus consultas) |

## 5. Lote I-1 (profesor) terminado (2026-11-18)

Detalle en `docs/LOTE1_INGLES.md`. Pendientes: lotes I-2 (alumno) a I-5 (unidad 19), y las métricas de la unidad 19 (§4, por aprobar).
