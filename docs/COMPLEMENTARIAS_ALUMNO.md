# Complementarias del alumno: inventario y rediseño

Fecha: 2026-11-18. Rama `cacique` (sin push). Reglas: `docs/panel.md` §7 y §11. Inventarios: `docs/INVENTARIO_MENU.md` (M220-M223), `docs/MIGRACION_VISTAS.md` (`actividades_complementarias`).

## 1. Opciones del menú (alumno)

Todas con la condición `($palumno==true)` de `partials/menu_admin` L1855-1858 (y su copia en `partials/panel/sidebar`):

| Id | Opción | Ruta |
|---|---|---|
| M220 | Complementarias › Registrar | `/consulta_actividades/` |
| M221 | Complementarias › Evidencias | `/evidencias_alumnos` |
| M222 | Complementarias › Liberación | `/liberacion_alumno` |
| M223 | Complementarias › Créditos | `/creditos` |

## 2. Pantallas que se abren desde ellas

| # | Pantalla | Ruta | Controlador@método | Vista | Modifica datos | Complejidad |
|---|---|---|---|---|---|---|
| 1 | Actividades registradas | `GET /consulta_actividades` | `ConsultaRegActividadesController@index` | `actividades_complementarias.alumnos.consulta_reg_actividades` | — | Alta |
| 1a | ↳ Modal "Registro de Actividad" (`#agrega_actalu`) + confirmación (`#modal_confirmacion`, `#form_confirma`) | `POST /consulta_actividades` | `@store` | (misma vista) | **Sí: registra la actividad** | — |
| 1b | ↳ Modal eliminar (`#modal_elimina`, `#form_delete`) | `DELETE /consulta_actividades_elimina/{id}` | `Consulta_modificar_ActividadController@eliminar_registro` | (misma vista) | **Sí: elimina el registro** (solo en espera del jefe de división) | — |
| 1c | ↳ Avisos `#mensaje_actividad` y `#actividad_registrada` | — | — | (misma vista) | — | — |
| 2 | Modificar actividad (el enlace está comentado en la vista; la ruta existe) | `GET /consulta_actividades/{id}/edit` | `@edit` | la misma vista + parcial `partials_actividades.alumno.editar_actividad_alumno` (modal `#modal_edit_actalu` que se abre solo) | — | Media |
| 2a | ↳ Formulario `#modificar_actalu` | `PUT /consulta_actividades/{id}` | `@update` | (parcial) | **Sí: modifica el registro** | — |
| 3 | Evidencias | `GET /evidencias_alumnos` | `EvidenciasAlumnosController@index` | `actividades_complementarias.alumnos.carga_evidencias_alumnos` | — | Media |
| 3a | ↳ Formularios `#agrega_evidencia{i}` (uno por evidencia faltante, `multipart/form-data`, `urlImg[]`) | `POST /evidencias_alumnos` | `@store` | (misma vista) | **Sí: sube la evidencia** | — |
| 3b | ↳ Rúbrica (archivo del docente) | `GET /ArchivosDocentes/{archivo}` | — (archivo) | — | — | — |
| 4 | Aviso "AÚN NO HA SIDO ACEPTADA TU ACTIVIDAD" (Evidencias sin actividad aprobada) | `GET /evidencias_alumnos` | `@index` | `actividades_complementarias.alumnos.mensajes` | — | Baja |
| 5 | Liberación de actividades | `GET /liberacion_alumno` | `LiberacionAlumnosActividadesController@index` | `actividades_complementarias.alumnos.liberacion_actividades` | — | Baja |
| 6 | Créditos liberados | `GET /creditos` | `CreditosSemestresController@index` | `actividades_complementarias.alumnos.creditos_semestres` | — | Baja |

Total: **6 vistas** (5 pantallas + 1 parcial) con 4 modales y 5 formularios: menos de 12, se migra en un solo lote. No hay constancias ni PDF en el menú del alumno (las constancias las imprime el jefe de división).

**Vista compartida:** `alumnos.mensajes` (#4) también la devuelven `DocenteActividadJefeController` (jefe de división, `/docente_actividad`), `PlaneaActividadProfController` (docente con actividad) y `HomeController`. Como la regla es no tocar las vistas de otros roles, **se queda como está** (con `layouts.app`) y se reporta.

## 3. Rediseño (terminado)

**Cuenta de prueba:** `alumno02@example.com` / `Tesvb.Prueba2026` (tiene una actividad aprobada en el periodo 12: ve Evidencias con formularios de subida). Para Registrar con una actividad en espera (botón de eliminar): `alumno01@example.com`.

| Vista | Ruta | Resultado | Modifica datos |
|---|---|---|---|
| `alumnos.consulta_reg_actividades` | `/consulta_actividades` | Migrada (tabla, badges de estado, modales `#agrega_actalu`, `#modal_confirmacion`, `#modal_elimina`, `#mensaje_actividad`, `#actividad_registrada` como `x-panel.modal`) | Sí: registrar (`POST /consulta_actividades`) y eliminar (`DELETE /consulta_actividades_elimina/{id}`) |
| `partials_actividades.alumno.editar_actividad_alumno` | `/consulta_actividades/{id}/edit` | Migrada (modal `#modal_edit_actalu`) | Sí: modificar (`PUT /consulta_actividades/{id}`) |
| `alumnos.carga_evidencias_alumnos` | `/evidencias_alumnos` | Migrada (nota, tabla, formularios `multipart/form-data` por evidencia, blockUI) | Sí: subir evidencia (`POST /evidencias_alumnos`) |
| `alumnos.liberacion_actividades` | `/liberacion_alumno` | Migrada | No |
| `alumnos.creditos_semestres` | `/creditos` | Migrada | No |
| `alumnos.mensajes` | `/evidencias_alumnos` (sin actividad aprobada) | **Sin cambios** (vista compartida con jefe de división, docente y HomeController) | No |

### Qué se conservó

- Formularios como los arma el navegador: el original de Registrar abre un `<form>` sin atributos que envuelve la tabla y el modal de registro, y dentro un `<form id="agregar_actividad_alu">` que el navegador **ignora** (por eso `$("#agregar_actividad_alu").validate()` no hacía nada). Se conserva el formulario anónimo y no se incluye el anidado: mismo resultado en el navegador.
- Mismos `action`, `method`, `enctype`, `@csrf`, `_method`, `name` y `value`; mismos ids y clases de los scripts (`.elimina`, `.registra`, `#confirma_actividad`, `#confirma_elimina`, `#total_horas`, `#archivo{i}`, `#modifica_actalu`…); scripts sin cambios. Librerías: jQuery Validate (Registrar) y blockUI (Evidencias) con `recursos_app`.
- En el parcial de edición el `<form>` original no se cerraba (el botón Modificar del pie le pertenecía): ahora el formulario envuelve cuerpo y pie.

### Fallas que ya existían (no se tocaron)

- **Modificar actividad** (`/consulta_actividades/{id}/edit`, el enlace está comentado en el menú de la pantalla): si hay actividades disponibles, la vista falla con *Attempt to read property "id_docente_actividad" on int*, porque el `@foreach($docente_actividad as $docente_actividad)` de la vista principal reemplaza la lista antes de que el parcial la recorra. La prueba confirma que la versión anterior falla igual.
- Con datos de Evidencias en `$existe_id == 1` el original dejaba `</tbody></table>` sueltos; no ocurre (el controlador siempre manda 0).

### Pruebas

- `tests/Feature/Panel/ComplementariasAlumnoVistasTest.php`: cada rama con datos sintéticos contra la versión anterior (menos de 40 horas, 40 horas, actividad repetida, edición, evidencias faltantes 0/2/3, Liberación y Créditos).
- `tests/Integracion/ComplementariasAlumnoTest.php`: las 4 opciones del menú y la edición con `alumno02` y `alumno01` contra MySQL (transacción revertida).

## 4. Revisión de pantallas faltantes (2026-11-18)

**`evidencia_alumnos`:** no existe ninguna vista con ese nombre (`resources/views/**/evidencia_alumnos*.blade.php` no da resultados, ni hay referencias en controladores, rutas o vistas, ni aparece en el historial de git). La pantalla de evidencias del alumno es `actividades_complementarias.alumnos.carga_evidencias_alumnos` (`GET /evidencias_alumnos`, `EvidenciasAlumnosController@index`, menú Complementarias › Evidencias), ya migrada en `64a7658`. Las otras vistas con "evidencia" en el nombre son de otros módulos o roles: `actividades_complementarias.profesor.evaluacion_evidencias` (docente con actividad, la incluye `profesor.index`), `tutorias/profesor/evidencias`, `incidencias/*`, `auditorias/*`.

**Búsqueda completa** (todas las vistas de `actividades_complementarias`, los 20 controladores que las usan o leen tablas `actcomple_*`, sus rutas, `return view`, `@include`, `redirect`, y los enlaces y formularios de las pantallas migradas):

| Lo que sale de las pantallas del alumno | Destino | ¿Vista? |
|---|---|---|
| `POST /consulta_actividades` (`#form_confirma`) | `@store` → `redirect('/consulta_actividades')` | No (vuelve a Registrar) |
| `DELETE /consulta_actividades_elimina/{id}` (`#form_delete`) | `Consulta_modificar_ActividadController@eliminar_registro` → redirect | No |
| `PUT /consulta_actividades/{id}` (`#modificar_actalu`) | `@update` → redirect | No |
| `DELETE /consulta_actividades/{id}` (resource) | `@destroy` → redirect | No |
| `GET /consulta_actividades/create`, `/{id}` (resource) | `@create`, `@show` vacíos | No (respuesta vacía, igual que antes) |
| `POST /evidencias_alumnos` (`#agrega_evidencia{i}`) | `@store` → `redirect('/evidencias_alumnos')` | No |
| `GET /ArchivosDocentes/{rubrica}` | archivo del docente | No |
| `GET /carga_evidencia/{arreglo}` | `EvidenciasAlumnosController@cargar_evidencias` → `abort(501)` | No (ninguna pantalla la enlaza) |
| create/show/edit de `/evidencias_alumnos`, `/liberacion_alumno`, `/creditos` | métodos vacíos | No |

Todas las vistas de la carpeta tienen dueño identificado: las 5 del alumno (4 pantallas migradas + parcial de edición), `alumnos.mensajes` (compartida: alumno sin actividad aprobada, jefe de división, docente con y sin actividad desde `HomeController`), y las de `jefatura`, `profesor` y `subdireccion` (otros roles; las constancias `/Constancia/{id}` y `/constancias_todas` solo las enlaza `jefatura.imprimir_constancias`).

**Resultado:** no falta ninguna pantalla del alumno. La única que no se rediseñó es `alumnos.mensajes`, por ser compartida con otros roles (§2).
