# Lote 1 del directivo: Generales, Formatos, Horarios y Plantilla

Fecha: 2026-11-18. Rama `cacique` (sin push). Commits: `ef622ab` (Generales), `d50d5d3` (Formatos), `59c0daa` (Horarios), `167b183` (Plantilla).
Reglas: `docs/panel.md` §7 y §11. Inventario general: `docs/MIGRACION_VISTAS.md`.

**Alcance:** las pantallas que abren los enlaces del menú del directivo / Planeación y Consultas (`directivo || consultas`, M148-M170 de `docs/INVENTARIO_MENU.md`), más lo que esas pantallas muestran en la misma página: modales de edición, vistas de detalle a las que llevan sus enlaces y fragmentos que cargan por AJAX. Ningún módulo ni submódulo del menú se quitó, y no cambió ninguna ruta, controlador, consulta, condición ni permiso.

**Cuenta de prueba:** `directivo@example.com` / `Tesvb.Prueba2026` (`consultas@example.com` ve los mismos menús). Servir con `php artisan serve` y abrir http://127.0.0.1:8000.

## 1. Pantallas migradas

| Menú | Ruta | Vista | También migrado (misma pantalla) |
|---|---|---|---|
| Generales › Edificios (M160) | `/generales/edificios` | `generales/edificios` | modal de edición `partialsg/partial_mo_edificio` (`/generales/edificios/{id}/edit`) |
| Generales › Aulas (M161) | `/generales/aulas` | `generales/aulas` | `partial_mo_aula` |
| Generales › Situación Profesional (M162) | `/generales/situaciones` | `generales/situaciones` | `partial_mo_situacion` |
| Generales › Perfil (M163) | `/generales/perfiles` | `generales/perfiles` | `partial_mo_perfil` |
| Generales › Carreras (M164) | `/generales/carreras` | `generales/carreras` | `partial_mo_carrera` (colorpicker) |
| Generales › Extra Clase (M165) | `/generales/extra_clases` | `generales/extra_clase` | `partial_mo_extraclase` |
| Generales › Categoría Docente (M166) | `/generales/cargos` | `generales/cargos` | `partial_mo_cargo` |
| Generales › Jefaturas de División (M167) | `/generales/jefaturas` | `generales/jefaturas` | `partial_mo_jefe` |
| Generales › Unidades Administrativas (M169) | `/generales/unidad_administrativa` | `generales/unidad_administrativa` | modales de alta y edición (por AJAX) |
| Generales › Jefes Unidades Administrativas (M170) | `/generales/jefe_unidad_administrativa` | `generales/jefe_unidad_administrativa` | modales de alta y edición (por AJAX) |
| Generales › Académico › Retículas (M158) | `/reticulass` | `reticulas/materias` | fragmentos `reticulas/partialsg/partial_materias` y `partial_mo_reticula` |
| Generales › Académico › Docentes (M159) | `/docente` | `docentes/mostrar_docentes` | fragmentos `docentes/partials/partial_mo_docente` y `materias_perfil` |
| Generales › Asignación de Permisos (M168) | `/personales` | `personal` | modal de edición `editar_personal` (`/personales/{id}/edit`) |
| Formatos › Concentrado Estructura Educ. (M152) | `/formatos/con_edu` | `formatos/con_edu` | — |
| Formatos › Distrib. de hrs. frente a grupo (M153) | `/formatos/distribucion` | `formatos/distribucion_admin` | por carrera: `/distribucion/{id}` (misma vista) |
| Formatos › Relación de personal docente (M154) | `/formatos/relacion` | `formatos/relacion_admin` | por carrera: `/relacion/ver/{id}` (misma vista) |
| Formatos › Horas por docentes (M155) | `/formatos/horas_docentes/` | `formatos/horas_docente` | — |
| Horarios › Ver Horarios Docentes (M148) | `/horarios/horarios_docentes` | `horarios/horarios` | modal de horario `partialsh/partial_ver_horarios` (`/horarios_docentes/{id}`) |
| Horarios › Ver Horarios Grupos (M149) | `/horarios/hrs_grupos` | `horarios/horarios_grupos` | `partialsh/partial_ver_grupos` (`/horarios_grupos/{s}/{g}/{c}`) |
| Horarios › Ver Horarios Aulas (M150) | `/horarios/hrs_aulas` | `horarios/horarios_aulas` | `partialsh/partial_ver_aulas` (`/horarios_aulas/{c}/{a}`) |
| Horarios › Horas por carrera (M151) | `/hrs_carrera` | `horarios/hrs_carrera` | por categoría: `/hrs_carrera/categoria/{id}` |
| Plantilla › Ver Plantilla (M156) | `/plantilla/ver` | `plantilla/plantilla` | `/plantilla/datos/{c}/{g}`; fragmento `partialsh/graficas` (`/graficas/{p}/{ciclo}`) |
| Plantilla › Plantilla Educativa (M157) | `/plantilla/educativa` | `plantilla/plantilla_educativa` | `/p_educativa/datos/{c}/{g}`; `partialsh/graficas` (`/graficas_admin/…`) |

23 enlaces del menú; 23 vistas de pantalla, 11 modales o parciales de edición y 7 fragmentos AJAX.

## 2. Acciones que modifican datos (probar con cuidado)

| Pantalla | Acción | Petición |
|---|---|---|
| Edificios, Aulas, Situación Profesional, Perfil, Carreras, Extra Clase, Categoría Docente, Jefaturas | Botón **+** (flotante) → **Guardar** | `POST` a la ruta del catálogo (alta) |
| (mismas) | Ícono ⚙ → modal → **Guardar** | `PUT /generales/…/{id}` (edición) |
| (mismas) | Ícono 🗑 → **Aceptar** | `DELETE /generales/…/{id}` |
| Aulas | Ícono de **Estado** (compartida / no compartida) | `GET /aulas/estados/{id}`: **cambia el estado con solo un clic**, sin confirmar |
| Jefaturas | Modal "periodo igual" | `POST` (form `#periodo_igual`) |
| Unidades Administrativas, Jefes Unidades Administrativas | Agregar, Editar (⚙), Eliminar (confirmación) | `POST` / `PUT` / `DELETE` |
| Retículas | Opción **"Agrega Reticula"** del select | `GET /agrega/reticulas/{nombre}`: crea la retícula |
| Retículas | Agregar materia / editar materia / eliminar materia | `POST /agregar_materias/`, `PUT /reticulass/{id}`, `DELETE` |
| Docentes | **Datos académicos** → Guardar | `GET /modifica_datos/{cargo}/{hm}/{hmi}`: actualiza el docente |
| Docentes | Materias del perfil → Aceptar | `POST /agrega/materias_perfil` |
| Docentes | Eliminar | `POST /docente/eliminar/{id}` |
| Asignación de Permisos | ⚙ → modal → Guardar permiso | `PUT /personalesu/{id}` |
| Asignación de Permisos | 🗑 → Aceptar | `DELETE /personales/{id}` |
| Plantilla Educativa | **Interruptores SI/NO** de aprobación (al cambiarlos) | `GET /aprobar_act/{horario}/{act}`: **aprueba o desaprueba con solo cambiar el interruptor** |

Formatos y Horarios son de solo lectura (sus botones solo descargan Excel o abren horarios). En Plantilla, "Imprimir" descarga el Excel.

## 3. Lo que no se pudo migrar o no funciona (igual que antes)

Ninguna pantalla del lote se quedó con el diseño anterior. Encontré dos fallas que **ya existían** y no dependen de la vista (no se tocaron porque son lógica de controlador o de datos):

| Dónde | Qué pasa | Causa |
|---|---|---|
| Formatos › Horas por docentes (`/formatos/horas_docentes/`) | Error 500 con los datos de prueba | `$nombre_periodo1` (periodo anterior) viene nulo y la vista lee `->periodo`. La prueba confirma que la vista anterior falla con el mismo error y los mismos datos |
| Ver Plantilla: clic en el nombre del docente; Plantilla Educativa: ícono "Horario docente" | El horario no aparece (500 en `/plantilla/horario/{id}`) | El controlador ejecuta `CREATE OR REPLACE VIEW` con parámetros y MySQL lo rechaza (error 1351) antes de llegar a la vista. La vista del modal (`partialsh/partial_ver_horarios`) sí se migró |

Pantallas relacionadas que **no** entraron al lote porque no las abre el menú del directivo (siguen con `layouts.app`): `formatos/distribucion` y `formatos/relacion` (versión del jefe de división), `generales/tipo_personales`, `docentes/docentes_edit`, `horarios/partialsh/partial_ver_*_jefes` y `plantilla/partialsh/plantilla` (Excel).

## 4. Correcciones de HTML (mismo comportamiento en el navegador)

Los originales tenían HTML mal anidado que en `layouts.app` no se notaba, pero en el panel descuadraría el sidebar y el pie. Se corrigió conservando lo que el navegador ya hacía:

- `</div>` sobrante después del modal de eliminar (cerraba el contenido antes de tiempo).
- `<form>` que se abría dentro del cuerpo del modal y se cerraba después del pie: ahora envuelve cuerpo y pie (los botones del pie siguen perteneciendo al formulario, como antes).
- `<form>` vacío anidado dentro del formulario real (el navegador lo ignoraba): se quitó; el formulario real conserva token, campos y botones.
- `</a>` faltante (Aulas) y `</span>` sobrante (Asignación de Permisos).

## 5. Pruebas

`tests/Integracion/LoteDirectivoTest.php` (29 casos, contra la MySQL local en una transacción que se revierte; se omite sin MySQL):

- cada pantalla responde 200 con la cuenta del directivo, usa el panel, no carga Bootstrap y tiene el HTML balanceado (se aceptan solo los cierres implícitos válidos de tablas que arma la lógica original);
- se compara con la versión anterior (`tests/Fixtures/vistas_antes`) **renderizada con los mismos datos que entregó el controlador**: formularios (action, method, `_token` y `name`, agrupados como los arma el navegador), campos, ids, clases que usan los scripts y textos;
- también se abren el primer modal de edición de cada catálogo, la vista de detalle de cada pantalla de Horarios y Formatos, y los fragmentos AJAX de Retículas, Docentes y Plantilla;
- si la vista nueva falla con los datos de prueba, se exige que la anterior falle igual (caso de Horas por docentes).

Nota: el endpoint `/plantilla/horario/{id}` no se abre en las pruebas: su `CREATE OR REPLACE VIEW` confirmaría la transacción. En una corrida anterior eso ocurrió una vez: lo único escrito antes había sido el re-cifrado automático de la contraseña de `directivo@example.com` al iniciar sesión (misma contraseña, otro hash).

## 6. Herramientas y componentes agregados

- `partials/panel/recursos_app.blade.php` (antes `evaluacion_docente/partials/recursos_panel`, que queda como alias): librerías de `layouts.app` sin Bootstrap, con opciones `datatables`, `graficas`, `colorpicker`, `validacion` (jQuery Validate) y `blockui`.
- `x-panel.modal`: `clase-cerrar` y `id-cerrar` para conservar la clase o el id de la × que usan los scripts (`$(".close")`, `#acepta2`).
- `tools/panel/estructura_bs.php`: encabezado, alerta flash, botón flotante, tablas y modales de Bootstrap 3 → componentes del panel.
- `tools/panel/bs2tw.php`: más glyphicons, atributos `class` pegados a otro atributo o con expresiones Blade con comillas.
- CSS: pestañas verticales (`tw-lista-pestanas`), interruptor SI/NO (`.switch-p`), encabezados en `<td>` (`tw-tabla-encabezado`) y columnas flex sin desbordes.
