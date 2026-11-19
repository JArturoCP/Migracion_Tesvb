# Lote 1 de Inglés: vistas del profesor de inglés

Fecha: 2026-11-18. Rama `cacique` (sin push). Reglas: `docs/panel.md` §7 y §11; plan: `docs/PLAN_INGLES.md` §2.5.

**Alcance:** las pantallas a las que llega el profesor de inglés (`tipo_usuario = 3`, sesión `profesor_ingles`) desde su menú: Datos P. › Editar y Calificaciones, con todo lo que esas pantallas muestran (modales y fragmentos AJAX). No se tocó ninguna vista del alumno ni de la unidad 19, ni ningún controlador, ruta, consulta, permiso o bandera de sesión.

**Cuenta de prueba:** `ingles01@example.com` / `Tesvb.Prueba2026` (profesor 1, grupo nivel 1 · grupo 1 en el periodo de inglés 12).

## 1. Pantallas migradas

| Menú | Ruta | Vista | También migrado |
|---|---|---|---|
| Datos P. › Editar | `/profesores_ingles/modificar/{id_usuario}` | `ingles/partials/modificar_profesor` | — |
| Calificaciones | `/ingles/Calificaciones` | `ingles/profesores_ingles/inicio_calificaciones` | (la misma vista la abre la unidad 19 desde `/ingles/profesores/calificacion_profesor/{id}`) |
| Calificaciones › Periodos | `/ingles/Calificaciones/periodos_ingles/{nivel}/{grupo}` | `profesores_ingles/periodos_calificaciones` | fragmentos `crear_periodo_calificacion` (`/ingles/registro_periodo_ingles/…`) y `modificar_periodo_ingles_calificaciones` (`/ingles/modificar_per/…`, solo unidad 19) |
| Calificaciones › Evaluaciones | `/ingles/Calificaciones/mostrar_alumnos/{nivel}/{grupo}` | `profesores_ingles/asignacion_calificaciones` (periodos de inglés < 18) y `asignacion_calificaciones_act` (≥ 18) | modal `#modal_modificar_cal` |

Las **actas** (`/ingles/acta_ordinaria/…`, `/ingles/acta_ordinaria_act/…`) y la **lista de asistencia** (`/ingles/lista_asistencia/…`) son PDF generados con FPDF en `In_acta_ordinariaController`: no tienen vista; se abren igual que antes con los botones de la pantalla de Evaluaciones (`window.open`).

Commits: `7c0e0d9` (Datos P.), `035a8e1` (Calificaciones y periodos), el de esta pantalla de Evaluaciones y este documento.

## 2. Acciones que modifican datos

| Pantalla | Acción | Petición |
|---|---|---|
| Datos P. › Editar | **Guardar datos** | `POST /profesores_ingles/modificacion/profesor` |
| Periodos | **Asignar fecha** → modal → **Guardar** | `POST /ingles/calificaciones/crear_periodos` |
| Periodos (solo unidad 19) | **Modificar fecha** → modal → **Guardar** | `POST /ingles/modificacion_per/` |
| Evaluaciones | **guardar** (botón de la columna de la habilidad en captura) | `POST /ingles/agregar_calificaciones_unidad/{nivel}/{grupo}/{unidad}/insert_calificacion` (AJAX) y recarga |
| Evaluaciones (solo unidad 19) | lápiz en una calificación → modal → **Guardar** | `POST /ingles/guardar_modificacion/calificacion` |
| Evaluaciones | **Acta ordinaria**, **Lista de asistencia** | `GET` PDF (solo lectura) |

## 3. Qué se conservó y qué cambió

- Layout `layouts.panel` con `partials.panel.recursos_app` (jQuery, Font Awesome, SweetAlert2 11 y TNotify, igual que en `layout_ingles`); sin Bootstrap. Nueva opción `datepicker` de `recursos_app` (bootstrap-datepicker con su CSS *standalone* y el idioma `es`), que usan Datos P. y los modales de fecha.
- Formularios: mismos `action`, `method`, `@csrf`, `name`, `value` y opciones seleccionadas. Ids y clases que usan los scripts (`.agregar`, `.modificar` con id 1/2, `#guardar_periodo`, `#modif_periodo`, `.calificacion_N` con `id="error_{carga}"` y `data-id`, `#guardar_calificacion` con `data-id_unidad`/`data-token`, `.modificar_calN`, `.close`): iguales. Scripts sin cambios.
- Modales de Bootstrap → `x-panel.modal` con el mismo id; el formulario sigue envolviendo título, cuerpo y botones (el puente los abre con `.modal('show')`).
- Evaluaciones: el cuerpo de la tabla (todas las ramas por etapa de captura y por unidad 19, celdas y **colores de aprobación en línea**) quedó idéntico; solo cambian la tabla (`x-panel.tabla` con bordes y celdas centradas), los botones y el ícono del lápiz (Open Iconic → Font Awesome). A los campos de captura no se les puso color de fondo de Tailwind para que el script los siga marcando en rojo o naranja.
- Iconos `oi oi-*` (Open Iconic, que el panel no carga) → Font Awesome 4.7.

## 4. Lo que no se pudo migrar o no funciona (igual que antes)

Ninguna pantalla del lote se quedó con el diseño anterior. Se observó (no se tocó, es lógica existente):

- `periodos_calificaciones` lee `$periodo1[0]` sin comprobar que exista: si el grupo tiene un solo registro en `in_cal_periodo` y no es de la unidad 1, la pantalla falla (antes y ahora).
- Los botones "Asignar fecha"/"Modificar fecha" usan `id="1"`/`id="2"` y puede haber dos elementos con el mismo id en la página; el script los lee con `$(this).attr('id')`, así que se conservaron.

## 5. Pruebas

- `tests/Feature/Panel/LoteInglesVistasTest.php` (55 casos, sin base de datos): cada rama con datos sintéticos — periodos (sin fechas, una o dos, evaluada o pendiente, con y sin unidad 19), inicio (con y sin grupos), Datos P., y Evaluaciones en las 11 etapas de captura (`unidad1` = 1–10 y 13) de las dos vistas, con y sin unidad 19, y sin inscritos. Se compara con la versión anterior renderizada con los mismos datos: formularios, campos, ids, clases de scripts, textos, sin clases ni archivos de Bootstrap, HTML balanceado y, en Evaluaciones, los mismos estilos de las celdas, número de celdas, campos de captura, botones de guardar, lápices y enlace del acta.
- `tests/Integracion/LoteInglesTest.php` (MySQL local, transacción revertida, cuenta `ingles01`): las 4 pantallas responden 200 en el panel y se comparan con la versión anterior con los datos que entregó el controlador; fragmentos AJAX de fecha; Evaluaciones sin inscritos y con un alumno inscrito agregado dentro de la transacción.
