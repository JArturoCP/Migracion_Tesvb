# Inventario de vistas por migrar al diseño del panel

Fecha: 2026-11-17. Rama `cacique`. Generado con un script de solo lectura sobre `resources/views`, `app/`, `routes/`, `php artisan route:list --json` (2 915 rutas) y `docs/INVENTARIO_MENU.md`.
Referencias: `docs/panel.md` (cómo migrar, §7 y §11) y `docs/PLAN_PANEL.md`.

## Avance

| Lote | Pantallas | Detalle |
|---|---|---|
| Piloto | Tutorías del alumno y Evaluación docente (alumno y directivo) | `docs/panel.md` §11.4 |
| Lote 1 del directivo | Generales (13), Formatos (4), Horarios (4), Plantilla (2) | `docs/LOTE1_DIRECTIVO.md` |

Los totales de abajo son del inventario inicial (antes del lote 1).

## 1. Resumen

| Concepto | Vistas |
|---|---|
| Archivos `.blade.php` en `resources/views` | 1328 |
| **Pantallas por migrar** (extienden un layout viejo y se usan) | **700** |
| &nbsp;&nbsp;con `layouts.app` (Bootstrap 3, sin marco) | 609 |
| &nbsp;&nbsp;con `tutorias.app_tutorias` (ya dentro del marco) | 51 |
| &nbsp;&nbsp;con el layout de Inglés (`ingles.inicio_ingles.layout_ingles`) | 39 |
| &nbsp;&nbsp;con el layout de SGOE (`sgoe.inicio`) | 1 |
| Parciales que se migran junto con su pantalla (modales, tablas, formularios incluidos) | 351 |
| Layouts propios de módulo que se retiran al migrar sus pantallas (Tutorías, Inglés, SGOE) | 3 |
| Páginas HTML sueltas (sin layout) en uso | 2 |
| Ya migradas (piloto, `layouts.panel`) | 24 |
| Sin uso detectado (no se migran hasta confirmar) | 109 |
| Fuera del alcance: PDF / Excel | 24 / 20 |
| Fuera del alcance: login y perfil (Breeze), errores, layouts, componentes, `panel/`, `partials/` del menú | 95 |

Complejidad de las 700 pantallas: **Alta 206**, Media 310, Baja 184 (criterios en §6).

## 2. Totales por módulo

Módulo = carpeta de `resources/views`. "Pantallas" son las que se migran una por una; las parciales van con ellas.

| Módulo | Pantallas | app | Tutorías | Inglés | SGOE | Alta / Media / Baja | Líneas | Parciales | Sin uso | Roles (menú) |
|---|---|---|---|---|---|---|---|---|---|---|
| `residencia` | 69 | 69 | 0 | 0 | 0 | 27 / 27 / 15 | 25 251 | 26 | 5 | Alumno, Doc. c/act., Doc. s/act., Jefe div., Residencias, Por unidad, BD/ids |
| `departamento_finanzas` | 67 | 67 | 0 | 0 | 0 | 39 / 9 / 19 | 47 083 | 55 | 10 | Finanzas, Por unidad |
| `tutorias` | 57 | 7 | 50 | 0 | 0 | 19 / 11 / 27 | 15 471 | 42 | 21 | Alumno, Escolar/Dir., Cómputo, Titulación, Personal |
| `titulacion` | 56 | 54 | 0 | 2 | 0 | 19 / 28 / 9 | 23 440 | 81 | 17 | Alumno, Titulación, Inglés, Por unidad, BD/ids |
| `servicios_escolares` | 45 | 45 | 0 | 0 | 0 | 8 / 17 / 20 | 6 193 | 11 | 4 | Desarrollo, Escolar/Dir., Cómputo |
| `encuestas_satisfacion_cliente` | 42 | 42 | 0 | 0 | 0 | 7 / 25 / 10 | 12 629 | 11 | 0 | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids |
| `ingles` | 38 | 1 | 0 | 37 | 0 | 7 / 16 / 15 | 5 825 | 12 | 6 | Alumno, Inglés, Por unidad |
| `auditorias` | 35 | 35 | 0 | 0 | 0 | 13 / 19 / 3 | 12 048 | 2 | 3 | Personal |
| `riesgos` | 26 | 26 | 0 | 0 | 0 | 3 / 23 / 0 | 6 056 | 8 | 1 | Personal |
| `incidencias` | 25 | 25 | 0 | 0 | 0 | 4 / 18 / 3 | 4 527 | 6 | 0 | Personal |
| `examen_egel` | 20 | 20 | 0 | 0 | 0 | 0 / 7 / 13 | 2 595 | 0 | 0 | Alumno, Desarrollo |
| `examen_gnral_con` | 19 | 19 | 0 | 0 | 0 | 0 / 10 / 9 | 3 177 | 0 | 2 | Desarrollo, BD/ids |
| `ambiental` | 18 | 18 | 0 | 0 | 0 | 15 / 0 / 3 | 13 583 | 40 | 4 | Por unidad, BD/ids |
| `actividades_complementarias` | 17 | 17 | 0 | 0 | 0 | 5 / 8 / 4 | 2 718 | 5 | 0 | Alumno, Doc. c/act., Jefe div., Dir./Consultas |
| `evaluacion_docente` | 15 | 15 | 0 | 0 | 0 | 4 / 8 / 3 | 5 427 | 3 | 6 | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids |
| `duales` | 14 | 14 | 0 | 0 | 0 | 3 / 5 / 6 | 3 869 | 1 | 2 | Doc. c/act., Jefe div., Escolar/Dir. |
| `RMateriales` | 11 | 11 | 0 | 0 | 0 | 6 / 1 / 4 | 2 099 | 0 | 6 | Por unidad |
| `generales` | 11 | 11 | 0 | 0 | 0 | 1 / 10 / 0 | 2 024 | 9 | 0 | Jefe div., Dir./Consultas, RH |
| `servicio_social` | 10 | 10 | 0 | 0 | 0 | 4 / 4 / 2 | 3 058 | 8 | 9 | Alumno, Residencias |
| `centro_computo` | 9 | 9 | 0 | 0 | 0 | 0 / 5 / 4 | 764 | 2 | 1 | Cómputo, Titulación |
| `comision_oficio` | 9 | 9 | 0 | 0 | 0 | 2 / 7 / 0 | 2 563 | 6 | 0 | RH, Por unidad |
| `sgc` | 9 | 9 | 0 | 0 | 0 | 2 / 6 / 1 | 1 888 | 1 | 4 | — |
| `docentes` | 8 | 8 | 0 | 0 | 0 | 5 / 3 / 0 | 3 521 | 3 | 0 | Doc. c/act., Doc. s/act., Jefe div., Dir./Consultas, RH, Cómputo, Titulación, Por unidad |
| `horarios` | 8 | 8 | 0 | 0 | 0 | 1 / 3 / 4 | 1 195 | 6 | 0 | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids |
| `jefe_carrera` | 8 | 8 | 0 | 0 | 0 | 1 / 7 / 0 | 1 639 | 2 | 0 | Jefe div., Por unidad |
| `formatos` | 6 | 6 | 0 | 0 | 0 | 0 / 2 / 4 | 825 | 0 | 0 | Jefe div., Dir./Consultas |
| `reportes_profesores` | 6 | 6 | 0 | 0 | 0 | 0 / 6 / 0 | 986 | 0 | 3 | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids |
| `beca_estimulo` | 5 | 5 | 0 | 0 | 0 | 0 / 4 / 1 | 1 651 | 0 | 0 | Alumno, Escolar/Dir., Por unidad |
| `computo` | 4 | 4 | 0 | 0 | 0 | 0 / 2 / 2 | 427 | 0 | 0 | Escolar/Dir., Cómputo |
| `constancia_adeudo` | 4 | 4 | 0 | 0 | 0 | 1 / 2 / 1 | 687 | 2 | 0 | Alumno, Por unidad |
| `informe_paa` | 4 | 4 | 0 | 0 | 0 | 0 / 4 / 0 | 543 | 1 | 1 | Por unidad |
| `prestamo` | 4 | 4 | 0 | 0 | 0 | 4 / 0 / 0 | 1 139 | 0 | 0 | Alumno, Doc. c/act., Por unidad |
| `plantilla` | 3 | 3 | 0 | 0 | 0 | 1 / 2 / 0 | 991 | 2 | 0 | Jefe div., Dir./Consultas |
| `(raíz)` | 2 | 2 | 0 | 0 | 0 | 0 / 2 / 0 | 166 | 1 | 2 | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids |
| `ipomex` | 2 | 2 | 0 | 0 | 0 | 0 / 1 / 1 | 182 | 0 | 0 | Por unidad |
| `laboratorios` | 2 | 2 | 0 | 0 | 0 | 1 / 1 / 0 | 565 | 2 | 0 | Cómputo |
| `plantilla_personal` | 2 | 2 | 0 | 0 | 0 | 1 / 1 / 0 | 325 | 0 | 0 | RH |
| `prorroga` | 2 | 2 | 0 | 0 | 0 | 0 / 2 / 0 | 268 | 0 | 0 | Alumno, Por unidad |
| `analisis_reprobacion` | 1 | 1 | 0 | 0 | 0 | 1 / 0 / 0 | 584 | 0 | 0 | Jefe div. |
| `areas_atencion` | 1 | 1 | 0 | 0 | 0 | 1 / 0 / 0 | 3 135 | 0 | 0 | BD/ids |
| `canalizacion_reprobacion_principal` | 1 | 1 | 0 | 0 | 0 | 0 / 1 / 0 | 328 | 0 | 0 | BD/ids |
| `desarrollo_academico` | 1 | 1 | 0 | 0 | 0 | 1 / 0 / 0 | 570 | 0 | 0 | BD/ids |
| `encuesta_tutorias` | 1 | 0 | 1 | 0 | 0 | 0 / 0 / 1 | 65 | 0 | 1 | — |
| `piase` | 1 | 1 | 0 | 0 | 0 | 0 / 1 / 0 | 360 | 0 | 0 | BD/ids |
| `reticulas` | 1 | 1 | 0 | 0 | 0 | 0 / 1 / 0 | 388 | 2 | 1 | Jefe div., Dir./Consultas |
| `sgoe` | 1 | 0 | 0 | 0 | 1 | 0 / 1 / 0 | 155 | 1 | 0 | Personal |
| **Total** | **700** | 609 | 51 | 39 | 1 | 206 / 310 / 184 | 222 983 | 351 | 109 | |

## 3. Totales por rol

Grupos de rol del menú (`docs/INVENTARIO_MENU.md`, "Matriz rol → secciones"). Una pantalla cuenta en cada grupo que la ve, así que la suma es mayor que el total. **Confirmadas:** su ruta está en el menú del grupo, se llega por un enlace desde una pantalla del grupo o la incluye una de ellas. **Estimadas:** solo se dedujo por otras rutas del mismo controlador o por su subcarpeta; hay que confirmarlas al migrar. Los roles reales combinan grupos: por ejemplo, el **directivo** ve Global + Dir./Consultas + Escolar/Dir. + Personal + Por unidad; un **docente** ve Global + su grupo de docente + Personal.

| Rol / grupo del menú | Confirmadas | Estimadas | Total | Módulos con más pantallas |
|---|---|---|---|---|
| Sin enlace en el menú (se llega por URL o desde otra pantalla sin menú) | 0 | 45 | **45** | `examen_egel` (14), `examen_gnral_con` (13), `sgc` (9), `tutorias` (5), `departamento_finanzas` (2) |
| Alumno (`palumno`) | 94 | 61 | **155** | `residencia` (40), `ingles` (38), `encuestas_satisfacion_cliente` (26), `evaluacion_docente` (9), `titulacion` (9) |
| Docente con actividad (`profesor_conact`) | 20 | 30 | **50** | `encuestas_satisfacion_cliente` (19), `residencia` (7), `docentes` (6), `evaluacion_docente` (5), `horarios` (4) |
| Docente sin actividad (`profesor_sinact`) | 16 | 29 | **45** | `encuestas_satisfacion_cliente` (19), `residencia` (8), `docentes` (6), `evaluacion_docente` (5), `horarios` (4) |
| Jefe de división (`jefe_division`) | 38 | 34 | **72** | `encuestas_satisfacion_cliente` (19), `actividades_complementarias` (7), `residencia` (6), `docentes` (5), `duales` (5) |
| Desarrollo académico (`desa`) | 19 | 32 | **51** | `encuestas_satisfacion_cliente` (19), `servicios_escolares` (8), `evaluacion_docente` (7), `horarios` (7), `examen_gnral_con` (4) |
| Directivo y Planeación/Consultas (`directivo || consultas`) | 41 | 27 | **68** | `encuestas_satisfacion_cliente` (19), `generales` (11), `docentes` (8), `horarios` (8), `formatos` (6) |
| Servicios Escolares y Directivo (`escolar || directivo`) | 50 | 48 | **98** | `servicios_escolares` (43), `encuestas_satisfacion_cliente` (25), `evaluacion_docente` (8), `duales` (7), `reportes_profesores` (6) |
| Recursos Humanos (`personal`) | 19 | 24 | **43** | `encuestas_satisfacion_cliente` (19), `docentes` (5), `comision_oficio` (4), `evaluacion_docente` (4), `horarios` (4) |
| Centro de Cómputo (`computo`) | 25 | 36 | **61** | `encuestas_satisfacion_cliente` (23), `centro_computo` (9), `servicios_escolares` (8), `computo` (4), `evaluacion_docente` (4) |
| Residencias (`residencia`) | 35 | 27 | **62** | `residencia` (24), `encuestas_satisfacion_cliente` (22), `servicio_social` (5), `evaluacion_docente` (4), `horarios` (4) |
| Titulación (`titulacion`) | 27 | 63 | **90** | `titulacion` (47), `encuestas_satisfacion_cliente` (27), `evaluacion_docente` (4), `horarios` (4), `docentes` (3) |
| Finanzas y unidades presupuestales | 30 | 55 | **85** | `departamento_finanzas` (55), `encuestas_satisfacion_cliente` (19), `evaluacion_docente` (4), `horarios` (4), `reportes_profesores` (2) |
| Profesor de inglés (`profesor_ingles`) | 31 | 10 | **41** | `ingles` (38), `titulacion` (3) |
| Todo el personal TESVB (Tutorías, Incidencias, SGOE) | 107 | 80 | **187** | `tutorias` (51), `encuestas_satisfacion_cliente` (38), `auditorias` (35), `riesgos` (26), `incidencias` (25) |
| Por unidad administrativa (`id_unidad_admin`) | 84 | 47 | **131** | `ingles` (38), `encuestas_satisfacion_cliente` (19), `ambiental` (13), `RMateriales` (11), `departamento_finanzas` (10) |
| Por relación en BD o id fijo | 22 | 33 | **55** | `encuestas_satisfacion_cliente` (19), `titulacion` (10), `ambiental` (5), `evaluacion_docente` (4), `horarios` (4) |

Roles reales (unión de sus grupos, sin repetir pantallas). No incluyen las pantallas **Por unidad administrativa** ni **Por relación en BD o id fijo**, que dependen de la unidad o los datos de cada persona (se suman según el caso):

| Rol | Confirmadas | Total con estimadas |
|---|---|---|
| Alumno | 94 | 155 |
| Docente con actividad | 116 | 207 |
| Docente sin actividad | 112 | 202 |
| Jefe de división | 134 | 229 |
| Desarrollo académico | 146 | 258 |
| Directivo | 170 | 286 |
| Planeación y Consultas | 137 | 225 |
| Servicios Escolares | 140 | 249 |
| Recursos Humanos | 115 | 200 |
| Centro de Cómputo | 120 | 215 |
| Residencias | 129 | 217 |
| Titulación | 122 | 240 |
| Finanzas | 126 | 242 |
| Profesor de inglés | 31 | 41 |

## 4. Detalle por módulo

Columnas: **Layout** actual · **Rutas** (hasta 2; método y URI de `route:list`) · **Rol** (grupo del menú) y de dónde se dedujo (**menú** = la ruta está en el menú; **enlace** = se llega desde una pantalla con rol; **ctrl.** = otra ruta del mismo controlador está en el menú; **incl.** = la incluye una vista con rol; **carpeta** = otras vistas de la misma subcarpeta; ctrl. y carpeta son estimados) · **Elementos** que hay que cuidar al migrar · **Complejidad**.

### `residencia` — 69 pantallas, 26 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `agregar_datos_solicitud` | app (Bootstrap 3) | 873 | `GET /residencia/registrar_solicitud_residencia` | Alumno (menú) | 2 form | Alta |
| `agregar_empresa_anteproyecto` | app (Bootstrap 3) | 248 | `GET /residencia/agregar_empresa` | Alumno (menú) | 2 form, AJAX | Media |
| `asignar_academia` | app (Bootstrap 3) | 154 | `GET /residencia/asignar_academia` | Jefe div. (menú) | 3 form, 2 modal, AJAX | Media |
| `asignar_revisores` | app (Bootstrap 3) | 178 | `GET /residencia/asignar_revisores` | Jefe div. (menú) | 2 form, 3 modal, DataTables, AJAX | Alta |
| `autorizacion_documentos_alta_residencia.autorizacion_doc_alta_residencia` | app (Bootstrap 3) | 24 | `GET /residencia/documentos_alta_residencia` | Alumno (menú) | — | Baja |
| `autorizacion_documentos_alta_residencia.carrera_autorizar_documentacion` | app (Bootstrap 3) | 24 | `GET /residencia/autorizar_documentacion_anteproyecto` | Residencias (menú) | — | Baja |
| `autorizacion_documentos_alta_residencia.documentacion_autorizar_ante` | app (Bootstrap 3) | 121 | `GET /residencia/autorizar_doc_anteproyecto_alum/{id_carrera}` | Alumno, Residencias (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `autorizacion_documentos_alta_residencia.envio_documento` | app (Bootstrap 3) | 24 | `GET /residencia/documentos_alta_residencia` | Alumno (menú) | — | Baja |
| `autorizacion_documentos_alta_residencia.modificacion_documentos_alumnos` | app (Bootstrap 3) | 826 | `GET /residencia/documentos_alta_residencia` | Alumno (menú) | 10 form, 10 modal | Alta |
| `autorizacion_documentos_alta_residencia.registrar_datos_alumnos` | app (Bootstrap 3) | 86 | `GET /residencia/documentos_alta_residencia` | Alumno (menú) | 1 form | Baja |
| `autorizacion_documentos_alta_residencia.registrar_documentos_alta_residencia` | app (Bootstrap 3) | 937 | `GET /residencia/documentos_alta_residencia` | Alumno (menú) | 20 form, 10 modal | Alta |
| `autorizacion_documentos_final_residencia.autorizar_doc_finales` | app (Bootstrap 3) | 194 | `GET /residencia/revision_documentos_finales`<br>`GET /residencia/revision_doc_finales/{id_carrera}` | Alumno (carpeta (estimado)) | 2 modal, DataTables, AJAX | Media |
| `autorizacion_documentos_final_residencia.doc_finales_autorizado` | app (Bootstrap 3) | 165 | `GET /residencia/doc_autorizada_finales/{id_liberacion_documentos}` | Alumno (carpeta (estimado)) | 1 modal, DataTables, AJAX | Media |
| `autorizacion_documentos_final_residencia.enviar_doc_mod_finales_alumn` | app (Bootstrap 3) | 739 | `GET /residencia/enviar_documentacion/alumno` | Alumno (menú) | 11 form, 11 modal | Alta |
| `autorizacion_documentos_final_residencia.enviar_documento_alumno` | app (Bootstrap 3) | 1048 | `GET /residencia/enviar_documentacion/alumno` | Alumno (menú) | 23 form, 11 modal | Alta |
| `autorizacion_documentos_final_residencia.estado_documentacion_residencia` | app (Bootstrap 3) | 48 | `GET /residencia/enviar_documentacion/alumno` | Alumno (menú) | — | Baja |
| `autorizacion_documentos_final_residencia.proceso_mod_doc_finales` | app (Bootstrap 3) | 115 | `GET /residencia/proceso_mod_doc_finales/{id_carrera}` | Alumno (carpeta (estimado)) | DataTables | Media |
| `autorizar_anteproyecto.anteproyectos_autorizados_carreras` | app (Bootstrap 3) | 137 | `GET /residencia/anteproyectos_autorizados`<br>`GET /residencia/anteproyectos_autorizados_carrera/{id_carrera}` | Alumno, Residencias (ctrl.) | 2 modal, DataTables, AJAX | Media |
| `autorizar_anteproyecto.departamento_autorizar_anteproyecto` | app (Bootstrap 3) | 196 | `GET /residencia/autorizar_anteproyecto`<br>`GET /residencia/autorizar_anteproyecto/anteproyecto_autorizar/{id_carrera}` | Alumno, Residencias (ctrl.) | 2 modal, DataTables, AJAX | Media |
| `autorizar_anteproyecto.proceso_modificacion_documento_resi` | app (Bootstrap 3) | 135 | `GET /residencia/autorizar_anteproyecto/anteproyecto_proceso_modificacion/{id_carrera}` | Alumno, Residencias (ctrl.) | 1 modal, DataTables, AJAX | Media |
| `carreras_revisores` | app (Bootstrap 3) | 23 | `GET /residencia/revisores_anteproyecto` | Doc. c/act., Doc. s/act. (menú) | — | Baja |
| `correcciones_anteproyecto.corregir_alcances` | app (Bootstrap 3) | 653 | `GET /residencia/anteproyecto/corregir_alcances` | Alumno (enlace) | 2 form, 1 modal | Alta |
| `correcciones_anteproyecto.corregir_anteproyecto` | app (Bootstrap 3) | 70 | `GET /residencia/correcciones_anteproyecto` | Alumno (menú) | — | Baja |
| `correcciones_anteproyecto.corregir_cronograma` | app (Bootstrap 3) | 1162 | `GET /residencia/anteproyecto/corregir_cronograma` | Alumno (enlace) | 1 form, 1 modal | Alta |
| `correcciones_anteproyecto.corregir_justificacion` | app (Bootstrap 3) | 717 | `GET /residencia/anteproyecto/corregir_justificacion` | Alumno (enlace) | 2 form, 1 modal | Alta |
| `correcciones_anteproyecto.corregir_marco_teorico` | app (Bootstrap 3) | 718 | `GET /residencia/anteproyecto/corregir_marco_teorico` | Alumno (enlace) | 2 form, 1 modal | Alta |
| `correcciones_anteproyecto.corregir_objetivos` | app (Bootstrap 3) | 649 | `GET /residencia/anteproyecto/corregir_objetivos` | Alumno (enlace) | 2 form, 1 modal | Alta |
| `correcciones_anteproyecto.corregir_portada` | app (Bootstrap 3) | 722 | `GET /residencia/correcciones_anteproyecto` | Alumno (menú) | 2 form, 2 modal | Alta |
| `departamento_residencia.anteproyectos_institucional` | app (Bootstrap 3) | 65 | `GET /residencia/institucional_proyectos` | Residencias (enlace) | DataTables | Media |
| `departamento_residencia.autorizar_impresion_acta` | app (Bootstrap 3) | 145 | `GET /residencia/autorizar_imprimir_acta` | Residencias (menú) | 1 form, 1 modal, DataTables, AJAX | Media |
| `departamento_residencia.carreras_estadisticas` | app (Bootstrap 3) | 145 | `GET /residencia/institucional_estadisticas` | Residencias (enlace) | gráficas | Alta |
| `departamento_residencia.empresa_institucional` | app (Bootstrap 3) | 156 | `GET /residencia/empresa_institucional` | Residencias (enlace) | gráficas | Alta |
| `departamento_residencia.estadisticas_carreras.carrera_sector_estadisticas` | app (Bootstrap 3) | 226 | `GET /residencia/carrera_sector_estadisticas`<br>`GET /residencia/carrera_sector/{id_carrera}` | Residencias (enlace) | gráficas | Alta |
| `departamento_residencia.estadisticas_carreras.empresa_carrera` | app (Bootstrap 3) | 219 | `GET /residencia/carrera_empresa`<br>`GET /residencia/carrera_empresa_mostrar/{id_carrera}` | Residencias (enlace) | gráficas | Alta |
| `departamento_residencia.estadisticas_carreras.inicio_estadisticas_carrera` | app (Bootstrap 3) | 225 | `GET /residencia/carreras_estadisticas`<br>`GET /residencia/carrera_giro_estadisticas/{id_carrera}` | Residencias (enlace) | gráficas | Alta |
| `departamento_residencia.giro_estadistica` | app (Bootstrap 3) | 148 | `GET /residencia/giro_estadisticas` | Residencias (enlace) | gráficas | Alta |
| `departamento_residencia.inicio_carrera` | app (Bootstrap 3) | 112 | `GET /residencia/carreras_proyectos`<br>`GET /residencia/departamento_carreras/{id_carrera}` | Por unidad (menú) | DataTables | Media |
| `departamento_residencia.inicio_estadisticas` | app (Bootstrap 3) | 24 | `GET /residencia/estadisticas_residencia` | Residencias (menú) | — | Baja |
| `departamento_residencia.inicio_residencia` | app (Bootstrap 3) | 24 | `GET /residencia/departamento_residencia` | Residencias (menú) | — | Baja |
| `departamento_residencia.oficio_aceptacion` | app (Bootstrap 3) | 159 | `GET /residentes/carrera_oficio_aceptacion` | Jefe div. (menú) | 2 modal, AJAX | Media |
| `departamento_residencia.residentes_carrera` | app (Bootstrap 3) | 51 | `GET /residentes/carrera` | Jefe div. (menú) | — | Baja |
| `departamento_residencia.sector_estadisticas` | app (Bootstrap 3) | 150 | `GET /residencia/sector_estadisticas` | Residencias (enlace) | gráficas | Alta |
| `departamento_servicio_social.inicio_carrera_servicio_social` | app (Bootstrap 3) | 601 | `GET /servicio_social/departamento_carreras`<br>`GET /servicio_social/departamento_carreras/{id_carrera}` | Residencias (menú) | 1 form, 1 modal, DataTables | Alta |
| `documento_pressent_resi.estado_alumno_anteproyecto` | app (Bootstrap 3) | 2599 | `GET /residencia/ver_anteproyectos_revisores`<br>`GET /residencia/ver_estados_alumnos/{id_carrera}` | Residencias (menú) | 2 modal, DataTables, AJAX | Alta |
| `documento_pressent_resi.mod_anteproyecto_revision` | app (Bootstrap 3) | 1798 | `GET /residencia/proceso_mod_anteproyecto/{id_carrera}` | Residencias (carpeta (estimado)) | DataTables | Alta |
| `documento_pressent_resi.rev_anteproyecto_alumno` | app (Bootstrap 3) | 1702 | `GET /residencia/proceso_revision_anteproyecto/{id_carrera}` | Residencias (carpeta (estimado)) | DataTables | Alta |
| `empresas` | app (Bootstrap 3) | 155 | `GET /residencia/empresa` | Residencias (menú) | 2 form, 2 modal, DataTables, AJAX | Media |
| `mostrar_anteproyectos` | app (Bootstrap 3) | 67 | `GET /residencia/carrera_anteproyecto/{id_revisores}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Residencias (carpeta (estimado)) | — | Baja |
| `notificacion` | app (Bootstrap 3) | 27 | `GET /residencia/notificacion_anteproyecto` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Residencias (carpeta (estimado)) | — | Baja |
| `partials.alcances` | app (Bootstrap 3) | 164 | `GET /residencia/anteproyecto/alcances` | Alumno (enlace) | 1 form | Media |
| `partials.cronograma` | app (Bootstrap 3) | 201 | `GET /residencia/anteproyecto/cronograma` | Alumno (enlace) | 2 form, 2 modal, AJAX | Media |
| `partials.justificacion` | app (Bootstrap 3) | 139 | `GET /residencia/anteproyecto/justificacion` | Alumno (enlace) | 1 form | Baja |
| `partials.marco_teorico` | app (Bootstrap 3) | 147 | `GET /residencia/anteproyecto/marco_teorico` | Alumno (enlace) | 1 form | Baja |
| `partials.objetivos` | app (Bootstrap 3) | 157 | `GET /residencia/anteproyecto/objetivos` | Alumno (enlace) | 1 form | Media |
| `partials.portada` | app (Bootstrap 3) | 194 | `GET /residencia/anteproyecto/portada` | Alumno (enlace) | 1 form, 1 modal | Media |
| `periodo_evaluacion_anteproyecto` | app (Bootstrap 3) | 822 | `GET /residencia/evalucion_anteproyecto` | Residencias (menú) | 5 form, 5 modal, DataTables, fechas/calendario | Alta |
| `registro_anteproyecto` | app (Bootstrap 3) | 152 | `GET /residencia/registrar_anteproyecto` | Alumno (menú) | 1 form, 2 modal | Media |
| `revisar_anteproyecto.enviar_anteproyecto` | app (Bootstrap 3) | 104 | `GET /residencia/anteproyecto/corregir_enviar_anteproyecto` | Alumno (enlace) | 1 form, 1 modal, AJAX | Media |
| `revisar_anteproyecto.revisar_alcances` | app (Bootstrap 3) | 344 | `GET /residencia/revisar_alcances/{id_anteproyecto}/{id_profesor}` | Alumno (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `revisar_anteproyecto.revisar_cronograma` | app (Bootstrap 3) | 359 | `GET /residencia/revisar_cronograma/{id_anteproyecto}/{id_profesor}` | Alumno (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `revisar_anteproyecto.revisar_justificacion` | app (Bootstrap 3) | 338 | `GET /residencia/revisar_justificacion/{id_anteproyecto}/{id_profesor}` | Alumno (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `revisar_anteproyecto.revisar_marcoteorico` | app (Bootstrap 3) | 340 | `GET /residencia/revisar_marcoteorico/{id_anteproyecto}/{id_profesor}` | Alumno (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `revisar_anteproyecto.revisar_objetivos` | app (Bootstrap 3) | 347 | `GET /residencia/revisar_objetivos/{id_anteproyecto}/{id_profesor}` | Alumno (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `revisar_anteproyecto.revisar_portada` | app (Bootstrap 3) | 348 | `GET /residencia/revisar_anteproyecto/{id_anteproyecto}/{id_profesor}`<br>`GET /residencia/mostrar_alumno_residencia/{id}` | Alumno (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `seguimiento.actividades_evaluadas` | app (Bootstrap 3) | 260 | `GET /residencia/seguimiento_alumno_residencia/{id}` | Doc. c/act., Doc. s/act., BD/ids (carpeta (estimado)) | 3 modal, AJAX | Alta |
| `seguimiento.agregar_asesores_anteproyecto` | app (Bootstrap 3) | 142 | `GET /residencia/agregar_anteproyecto_asesores` | Doc. c/act., Doc. s/act. (menú) | 2 modal, AJAX | Media |
| `seguimiento.consultar_cal_residencia` | app (Bootstrap 3) | 575 | `GET /residencia/seguimiento_cronograma_alumno/{id}` | Doc. c/act., Doc. s/act., BD/ids (carpeta (estimado)) | 1 form, 4 modal, AJAX | Alta |
| `seguimiento.consultar_proyectos_aceptados` | app (Bootstrap 3) | 48 | `GET /residencia/seguimiento_asesor` | Doc. s/act., BD/ids (menú) | — | Baja |
| `seguimiento.mostrar_actividades_evaluadas_alumno` | app (Bootstrap 3) | 286 | `GET /residentes/alumno/{id_anteproyecto}` | Doc. c/act., Doc. s/act., BD/ids (carpeta (estimado)) | 1 form, 4 modal, AJAX | Alta |

<details><summary>Parciales (26)</summary>

`autorizacion_documentos_alta_residencia.datos_alumno_anteproyecto`, `autorizacion_documentos_final_residencia.partials_autorizar_doc_final`, `autorizacion_documentos_final_residencia.partials_autorizar_doc_modi_final`, `autorizacion_documentos_final_residencia.ver_doc_final_aut_al`, `autorizar_anteproyecto.autorizar_alumno_anteproyecto`, `autorizar_anteproyecto.partial_documento_alumno`, `autorizar_anteproyecto.partial_documento_modificado_autorizar`, `autorizar_anteproyecto.ver_doc_aceptado_alta`, `departamento_residencia.agregar_numero_oficio`, `departamento_residencia.modificar_numero_oficio`, `partials.asesor`, `partials.insertar_actividad`, `partials.modificar_academia`, `partials.modificar_actividad`, `partials.modificar_empresa`, `revisar_anteproyecto.comentario_cronograma`, `revisar_anteproyecto.comentario_marco_teorico`, `revisar_anteproyecto.comentarios_alcances`, `revisar_anteproyecto.comentarios_justificacion`, `revisar_anteproyecto.comentarios_objetivos`, `revisar_anteproyecto.comentarios_portada`, `seguimiento.calificar_residencia`, `seguimiento.calificar_semana`, `seguimiento.modal_dato_autorizar_acta`, `seguimiento.modificar_asesores_anteproyecto`, `seguimiento.profesor_plantilla`

</details>

### `departamento_finanzas` — 67 pantallas, 55 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `catalogo.inicio_proyectos` | app (Bootstrap 3) | 24 | `GET /presupuesto_anteproyecto/proyectos_metas` | Finanzas (menú) | — | Baja |
| `catalogo.metas` | app (Bootstrap 3) | 171 | `GET /presupuesto_anteproyecto/metas_presupuestales/{id_proyecto}` | Finanzas (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `catalogo.partidas_presupuestales` | app (Bootstrap 3) | 179 | `GET /presupuesto_anteproyecto/partida_presupuestal` | Finanzas (menú) | 1 form, 2 modal, DataTables, AJAX | Media |
| `catalogo.proyectos` | app (Bootstrap 3) | 241 | `GET /presupuesto_anteproyecto/proyectos_presupuestales` | Finanzas (menú) | 1 form, 4 modal, AJAX | Alta |
| `jefe_departamento.modificaciones_material_documentos` | app (Bootstrap 3) | 1293 | `GET /presupuesto_anteproyecto/modificar_bienes_servicios_anteproyecto/{id_actividades_req_ante}` | Por unidad (carpeta (estimado)) | 1 form, 15 modal, AJAX | Alta |
| `jefe_departamento.modificaciones_requisiciones` | app (Bootstrap 3) | 1490 | `GET /presupuesto_anteproyecto/modificar_requisicones/{id_req_mat_ante}` | Por unidad (carpeta (estimado)) | 2 form, 4 modal, AJAX | Alta |
| `jefe_departamento.reg_actividades_requerimientos` | app (Bootstrap 3) | 1098 | `GET /presupuesto_anteproyecto/registro_inicio_req_ant/{id_req_mat_ante}` | Por unidad (carpeta (estimado)) | 2 form, 4 modal, AJAX | Alta |
| `jefe_departamento.reg_envio_requisicion` | app (Bootstrap 3) | 169 | `GET /presupuesto_anteproyecto/registrar_requerimientos_anteproyecto` | Por unidad (menú) | 1 form, 1 modal | Media |
| `jefe_departamento.solicitudes_presupuesto.mostrar_documento_autorizado` | app (Bootstrap 3) | 680 | `GET /presupuesto_autorizado/ver_docu_solicitud_aut_departamento/{id_solicitud}` | Por unidad (carpeta (estimado)) | 8 modal, AJAX | Alta |
| `jefe_departamento.solicitudes_presupuesto.registro_solicitud_documentos` | app (Bootstrap 3) | 983 | `GET /presupuesto_autorizado/registrar_documentacion_solicitud/{id_solicitud}` | Por unidad (carpeta (estimado)) | 2 form, 14 modal, AJAX | Alta |
| `jefe_departamento.solicitudes_presupuesto.solicitudes_departamento` | app (Bootstrap 3) | 96 | `GET /presupuesto_autorizado/agregar_req_solicitud_autorizadas` | Por unidad (menú) | — | Baja |
| `jefe_departamento.solicitudes_presupuesto.ver_solicitudes_dep_aceptadas` | app (Bootstrap 3) | 42 | `GET /presupuesto_autorizado/solicitudes_aut_departamento` | Por unidad (menú) | — | Baja |
| `jefe_departamento.ver_registroactividades` | app (Bootstrap 3) | 1285 | `GET /presupuesto_anteproyecto/agregar_bienes_servicios_anteproyecto/{id_actividades_req_ante}` | Por unidad (carpeta (estimado)) | 1 form, 15 modal, AJAX | Alta |
| `jefe_departamento.ver_requisiciones_autorizadas` | app (Bootstrap 3) | 1187 | `GET /presupuesto_anteproyecto/ver_requisiciones_autorizadas/{id_req_mat_ante}` | Por unidad (carpeta (estimado)) | 2 form, 4 modal, AJAX | Alta |
| `jefe_finanazas.evaluacion_requisiciones.autorizacion_req_departamento` | app (Bootstrap 3) | 149 | `GET /presupuesto_anteproyecto/autorizados_mod_jefe_depart` | Finanzas (enlace) | 2 modal, DataTables, AJAX | Media |
| `jefe_finanazas.evaluacion_requisiciones.proceso_modificacion_departamento` | app (Bootstrap 3) | 146 | `GET /presupuesto_anteproyecto/permiso_mod_jefe_depart` | Finanzas (enlace) | 2 modal, DataTables, AJAX | Media |
| `jefe_finanazas.evaluacion_requisiciones.req_autorizada_departamento` | app (Bootstrap 3) | 1332 | `GET /presupuesto_anteproyecto/ver_autorizacion_bienes_servicios_departamento/{id_actividades_req_ante}/{id_req_mat_ante}` | Finanzas (carpeta (estimado)) | 4 form, 16 modal, AJAX | Alta |
| `jefe_finanazas.evaluacion_requisiciones.requisiciones_autorizadas_dep` | app (Bootstrap 3) | 1026 | `GET /presupuesto_anteproyecto/autorizados_req_departamento/{id_req_mat_ante}` | Finanzas (enlace) | 2 form, 4 modal, AJAX | Alta |
| `jefe_finanazas.evaluacion_requisiciones.revision_departamento` | app (Bootstrap 3) | 217 | `GET /presupuesto_anteproyecto/revicion_req_departamento/{id_req_mat_ante}`<br>`GET /presupuesto_anteproyecto/revicion_mod_req_departamento/{id_req_mat_ante}` | Finanzas (enlace) | 2 form, 2 modal | Media |
| `jefe_finanazas.evaluacion_requisiciones.revision_proy_departamento` | app (Bootstrap 3) | 1610 | `GET /presupuesto_anteproyecto/revisicion_bienes_servicios_departamento/{id_actividades_req_ante}/{id_req_mat_ante}` | Finanzas (carpeta (estimado)) | 4 form, 17 modal, AJAX | Alta |
| `jefe_finanazas.evaluacion_requisiciones.revision_requisiciones` | app (Bootstrap 3) | 151 | `GET /presupuesto_anteproyecto/revicion_requisiciones_anteproyecto` | Finanzas (menú) | 2 modal, DataTables, AJAX | Media |
| `jefe_finanazas.historial_anteproyecto.inicio_historial_anteproyecto` | app (Bootstrap 3) | 48 | `GET /presupuesto_anteproyecto/inicio_historial_anteproyecto` | Finanzas (menú) | — | Baja |
| `jefe_finanazas.historial_anteproyecto.inicio_proyecto_anteproyecto_historial` | app (Bootstrap 3) | 72 | `GET /presupuesto_anteproyecto/proyecto_inicio_anteproyecto_historial/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.historial_anteproyecto.inicio_req_aut_proy_historial` | app (Bootstrap 3) | 41 | `GET /presupuesto_anteproyecto/historial_anteproyecto_proyectos/{id_year}` | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.historial_anteproyecto.menu_year_anteproyecto` | app (Bootstrap 3) | 65 | `GET /presupuesto_anteproyecto/inicio_historial_anteproyecto_year/{id_year}` | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.historial_anteproyecto.proyecto_cap_ante_inc_historial` | app (Bootstrap 3) | 1132 | `GET /presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_inc_historial/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto_inc_historial/{id_fuente_financiamiento}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.proyecto_capitulos_anteproyecto_historial` | app (Bootstrap 3) | 1146 | `GET /presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_historial/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto_historial/{id_fuente_financiamiento}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.req_proyecto_aut_inc_historial` | app (Bootstrap 3) | 1431 | `GET /presupuesto_anteproyecto/presupuesto_total_anteproyecto_inc_historial/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.req_proyecto_historial` | app (Bootstrap 3) | 1451 | `GET /presupuesto_anteproyecto/presupuesto_total_anteproyecto_historial/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.requ_por_mes_anteproyecto_historial` | app (Bootstrap 3) | 1484 | `GET /presupuesto_anteproyecto/proyecto_meses_anteproyecto_historial/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.requ_por_metas_anteproyecto_historial` | app (Bootstrap 3) | 1502 | `GET /presupuesto_anteproyecto/proyecto_meta_anteproyecto_historial/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_meta_anteproyecto_historial/{id_meta}/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.requ_por_metas_inc_ante_historial` | app (Bootstrap 3) | 1472 | `GET /presupuesto_anteproyecto/proyecto_metas_anteproyecto_inc_historial/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_meta_ante_inc_historial/{id_meta}/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.reque_mes_anteproyecto_inc_historial` | app (Bootstrap 3) | 1477 | `GET /presupuesto_anteproyecto/proyecto_meses_anteproyecto_inc_historial/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_mes_anteproyecto_inc_historial/{id_mes}/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.historial_anteproyecto.techo_presupuestal_historial` | app (Bootstrap 3) | 819 | `GET /presupuesto_anteproyecto/historial_anteproyecto_techo/{id_year}` | Finanzas (carpeta (estimado)) | 1 form, 3 modal, AJAX | Alta |
| `jefe_finanazas.historial_proyecto.inicio_presupuesto_autorizado_historial` | app (Bootstrap 3) | 48 | `GET /presupuesto_autorizado/inicio_presupuesto_autorizado_historial` | Finanzas (menú) | — | Baja |
| `jefe_finanazas.historial_proyecto.menu_presupuesto_autorizado_historial` | app (Bootstrap 3) | 81 | `GET /presupuesto_autorizado/menu_presupuesto_autorizado_historial/{id_year}` | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.historial_proyecto.partidas_presupuesto_historial` | app (Bootstrap 3) | 695 | `GET /presupuesto_autorizado/presupesto_partida_historial/{id_year}` | Finanzas (carpeta (estimado)) | AJAX | Alta |
| `jefe_finanazas.historial_proyecto.presupuesto_autorizado_copia_historial` | app (Bootstrap 3) | 877 | `GET /presupuesto_autorizado/presupesto_partida_copia_historial/{id_year}` | Finanzas (carpeta (estimado)) | AJAX | Alta |
| `jefe_finanazas.historial_proyecto.solicitudes_autorizadas_dep_historial` | app (Bootstrap 3) | 39 | `GET /presupuesto_autorizado/solicitudes_autorizadas_departamentos_historial/{id_year}` | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.historial_proyecto.solicitudes_autorizadas_historial` | app (Bootstrap 3) | 816 | `GET /presupuesto_autorizado/mostrar_doc_solicitud_historial/{id_solicitud}/{id_unidad_admin}` | Finanzas (carpeta (estimado)) | 10 modal, AJAX | Alta |
| `jefe_finanazas.historial_proyecto.ver_solicitudes_departamento_historial` | app (Bootstrap 3) | 56 | `GET /presupuesto_autorizado/solicitudes_ver_departamento_historial/{id_unidad_admin}/{id_year}` | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.reg_requisiciones_admin.iniciar_reg_req_admin` | app (Bootstrap 3) | 519 | `GET /presupuesto_anteproyecto/agregar_requisiciones_admin/{id_presupuesto}` | Sin enlace en el menú (—) | 2 form, 4 modal, AJAX | Alta |
| `jefe_finanazas.reg_requisiciones_admin.ver_reg_act_admin` | app (Bootstrap 3) | 1530 | `GET /presupuesto_anteproyecto/agregar_bienes_servicios_ant_admin/{id_actividades_req_ante}` | Sin enlace en el menú (—) | 2 form, 16 modal, AJAX | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.inicio_proyecto_anteproyecto` | app (Bootstrap 3) | 76 | `GET /presupuesto_anteproyecto/proyecto_inicio_anteproyecto/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.requisiciones_autorizadas_pro.inicio_req_aut_proy` | app (Bootstrap 3) | 28 | `GET /presupuesto_anteproyecto/requisiciones_autorizadas_proyecto` | Finanzas (menú) | — | Baja |
| `jefe_finanazas.requisiciones_autorizadas_pro.proyecto_cap_ante_inc` | app (Bootstrap 3) | 1133 | `GET /presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_inc/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto_inc/{id_fuente_financiamiento}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.proyecto_capitulos_anteproyecto` | app (Bootstrap 3) | 1146 | `GET /presupuesto_anteproyecto/proyecto_capitulo_anteproyecto/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto/{id_fuente_financiamiento}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.req_proyecto` | app (Bootstrap 3) | 1455 | `GET /presupuesto_anteproyecto/presupuesto_total_anteproyecto/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.req_proyecto_aut_inc` | app (Bootstrap 3) | 1438 | `GET /presupuesto_anteproyecto/presupuesto_total_anteproyecto_inc/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.requ_por_mes_anteproyecto` | app (Bootstrap 3) | 1484 | `GET /presupuesto_anteproyecto/proyecto_meses_anteproyecto/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_mes_anteproyecto/{id_mes}/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.requ_por_metas_anteproyecto` | app (Bootstrap 3) | 1502 | `GET /presupuesto_anteproyecto/proyecto_meta_anteproyecto/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_meta_anteproyecto/{id_meta}/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.requ_por_metas_inc_ante` | app (Bootstrap 3) | 1475 | `GET /presupuesto_anteproyecto/proyecto_metas_anteproyecto_inc/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_meta_ante_inc/{id_meta}/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.reque_mes_anteproyecto_inc` | app (Bootstrap 3) | 1478 | `GET /presupuesto_anteproyecto/proyecto_meses_anteproyecto_inc/{id_presupuesto}`<br>`GET /presupuesto_anteproyecto/ver_proyecto_mes_anteproyecto_inc/{id_mes}/{id_presupuesto}` | Finanzas (carpeta (estimado)) | — | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.inicio_departamento_solicitudes_aut` | app (Bootstrap 3) | 26 | `GET /presupuesto_autorizado/solicitudes_autorizadas_departamentos` | Finanzas (menú) | — | Baja |
| `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.mostrar_documentacion_solicitud` | app (Bootstrap 3) | 817 | `GET /presupuesto_autorizado/mostrar_documentacion_solicitud/{id_solicitud}` | Finanzas (carpeta (estimado)) | 10 modal, AJAX | Alta |
| `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.proceso_modificar_solicitudes` | app (Bootstrap 3) | 65 | `GET /presupuesto_autorizado/proceso_mod_solicitudes` | Finanzas (enlace) | — | Baja |
| `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.revisar_solicitudes` | app (Bootstrap 3) | 79 | `GET /presupuesto_autorizado/revisar_solicitudes` | Finanzas (menú) | — | Baja |
| `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.revision_documentacion_solicitud` | app (Bootstrap 3) | 242 | `GET /presupuesto_autorizado/revisar_documentacion_solicitud/{id_solicitud}` | Finanzas (carpeta (estimado)) | 2 form, 2 modal | Media |
| `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.solicitudes_autorizadas` | app (Bootstrap 3) | 64 | sin ruta directa | Finanzas (carpeta (estimado)) | — | Baja |
| `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.ver_solicitudes_departamento` | app (Bootstrap 3) | 56 | `GET /presupuesto_autorizado/solicitudes_ver_departamento/{id_unidad_admin}` | Finanzas (carpeta (estimado)) | — | Baja |
| `presupuesto_autorizado.agregar_presupuesto.agregar_partida_presupuesto` | app (Bootstrap 3) | 937 | `GET /presupuesto_autorizado/agregar_presupesto_partida` | Finanzas (menú) | 2 form, 4 modal, AJAX | Alta |
| `presupuesto_autorizado.agregar_presupuesto.departamentos_presupuesto` | app (Bootstrap 3) | 38 | `GET /presupuesto_autorizado/departamentos_presupesto_partida` | Finanzas (menú) | — | Baja |
| `presupuesto_autorizado.agregar_presupuesto.presupuesto_autorizado_copia` | app (Bootstrap 3) | 955 | `GET /presupuesto_autorizado/presupesto_partida_copia` | Finanzas (menú) | 2 modal, AJAX | Alta |
| `presupuesto_autorizado.agregar_presupuesto.registrar_presupuesto_departamento` | app (Bootstrap 3) | 691 | `GET /presupuesto_autorizado/departamentos_agregar_presupuesto/{id_unidad_admin}` | Finanzas (carpeta (estimado)) | 2 form, 7 modal, AJAX | Alta |
| `requisicion_mat_anteproyecto.periodos_anteproyecto` | app (Bootstrap 3) | 347 | `GET /presupuesto_anteproyecto/periodos_anteproyecto` | Finanzas (menú) | 2 form, 4 modal, fechas/calendario, AJAX | Alta |
| `techo_presupuestal_anteproyecto.agregar_capitulos_anteproyecto` | app (Bootstrap 3) | 365 | `GET /presupuesto_anteproyecto/techo_presupuestal/agregar_fuentes_f_ante/{id_proyecto}` | Finanzas (carpeta (estimado)) | 2 modal, AJAX | Media |
| `techo_presupuestal_anteproyecto.techo_presupuestal_ante` | app (Bootstrap 3) | 816 | `GET /presupuesto_anteproyecto/techo_presupuestal` | Finanzas (menú) | 1 form, 3 modal, AJAX | Alta |

<details><summary>Parciales (55)</summary>

`catalogo.partials_activar_proyecto`, `catalogo.partials_desactivar_proyecto`, `catalogo.partials_modificar_meta`, `catalogo.partials_modificar_partida`, `catalogo.partials_modificar_proyecto`, `jefe_departamento.partial_eliminar_servicio`, `jefe_departamento.partials_agregar_anexo1`, `jefe_departamento.partials_agregar_req_pdf`, `jefe_departamento.partials_agregar_suficiencia_pdf`, `jefe_departamento.partials_cotizacion`, `jefe_departamento.partials_eliminar_req_mat`, `jefe_departamento.partials_justificacionpdf`, `jefe_departamento.partials_mod_anexo1`, `jefe_departamento.partials_mod_cotizacion`, `jefe_departamento.partials_mod_justificacion_pdf`, `jefe_departamento.partials_mod_req_mat`, `jefe_departamento.partials_mod_servicio`, `jefe_departamento.partials_mod_suficiencia`, `jefe_departamento.partials_modificar_req_mat`, `jefe_departamento.solicitudes_presupuesto.partial_modificar_servicio`, `jefe_departamento.solicitudes_presupuesto.partials_agregar_anexo_1`, `jefe_departamento.solicitudes_presupuesto.partials_agregar_cotizacion`, `jefe_departamento.solicitudes_presupuesto.partials_agregar_justificacion`, `jefe_departamento.solicitudes_presupuesto.partials_agregar_material_partida`, `jefe_departamento.solicitudes_presupuesto.partials_agregar_oficio_suficiencia`, `jefe_departamento.solicitudes_presupuesto.partials_agregar_requisicion`, `jefe_departamento.solicitudes_presupuesto.partials_modificar_anexo1`, `jefe_departamento.solicitudes_presupuesto.partials_modificar_cotizacion`, `jefe_departamento.solicitudes_presupuesto.partials_modificar_justificacion`, `jefe_departamento.solicitudes_presupuesto.partials_modificar_requisicion`, `jefe_departamento.solicitudes_presupuesto.partials_modificar_suficiencia`, `jefe_finanazas.reg_requisiciones_admin.partials_modificar_req_admin`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_agregar_contrato`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_agregar_factura`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_agregar_oficio`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_agregar_pago`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_mod_factura`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_mod_oficio`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_mod_pago`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partial_modificar_contrato`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partials_agregar_solicitud_pago`, `jefe_finanazas.requisiciones_autorizadas_pro.revision_solicitudes.partials_modificar_solicitud_pago`, `presupuesto_autorizado.agregar_presupuesto.agregar_partida_solicitud`, `presupuesto_autorizado.agregar_presupuesto.eliminar_partida_presupuesto`, `presupuesto_autorizado.agregar_presupuesto.eliminar_partida_solicitud`, `presupuesto_autorizado.agregar_presupuesto.eliminar_solicitud`, `presupuesto_autorizado.agregar_presupuesto.modificar_partida_presupuestal`, `presupuesto_autorizado.agregar_presupuesto.partials_agregar_presupuesto_partida`, `presupuesto_autorizado.agregar_presupuesto.partials_enviar_solicitud`, `presupuesto_autorizado.agregar_presupuesto.partials_modificar_presupuesto_autorizar`, `presupuesto_autorizado.agregar_presupuesto.revisar_requisicion_autorizar`, `requisicion_mat_anteproyecto.partials_activar_periodo`, `requisicion_mat_anteproyecto.partials_modificar_periodo`, `techo_presupuestal_anteproyecto.partials_agregar_capitulo`, `techo_presupuestal_anteproyecto.partials_modificar_capitulo`

</details>

### `tutorias` — 57 pantallas, 42 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `FO-40.index` | Tutorías (marco) | 99 | `GET /tutorias/FO_40` | Personal (enlace) | 1 form | Baja |
| `FO-40.periodo` | Tutorías (marco) | 67 | `GET /tutorias/FO-40` | Personal (enlace) | — | Baja |
| `FO-40.resultados` | Tutorías (marco) | 59 | `GET /tutorias/FO_40` | Personal (enlace) | — | Baja |
| `administrador.reg_imagenes` | app (Bootstrap 3) | 76 | `GET /computo/registrar_imagen` | Escolar/Dir., Cómputo, Titulación (ctrl.) | 1 form, DataTables | Media |
| `alumno.index` | Tutorías (marco) | 343 | `GET /tutorias/alumnos` | Personal (enlace) | 1 form, Vue, AJAX | Alta |
| `asignacoo.index` | Tutorías (marco) | 100 | `GET /tutorias/asignacovista` | Personal (enlace) | Vue, AJAX | Alta |
| `asignacorgen.index` | Tutorías (marco) | 121 | `GET /tutorias/asignacorgenvista` | Personal (enlace) | Vue, AJAX | Alta |
| `asignatuto.index` | Tutorías (marco) | 162 | `GET /tutorias/asignatuvista` | Personal (enlace) | Vue, AJAX | Alta |
| `coordina_inst.carreras` | Tutorías (marco) | 1488 | sin ruta directa | Personal (carpeta (estimado)) | Vue, gráficas, AJAX | Alta |
| `coordina_inst.edit` | app (Bootstrap 3) | 55 | sin ruta directa | Alumno, Personal (carpeta (estimado)) | 1 form | Baja |
| `coordina_inst.index` | Tutorías (marco) | 320 | `GET /tutorias/planeacioncoorgen` | Personal (enlace) | DataTables, Vue, AJAX | Alta |
| `coordina_inst.reportecarrerains.reporte_institucional` | Tutorías (marco) | 145 | `GET /tutorias/reporteinstitucional/repsemestral_ins` | Personal (enlace) | 1 form, 2 modal, AJAX | Media |
| `coordina_inst.revision` | Tutorías (marco) | 1710 | sin ruta directa | Personal (carpeta (estimado)) | 1 form, Vue, gráficas, AJAX | Alta |
| `coordinadorc.index` | Tutorías (marco) | 1936 | sin ruta directa | Sin enlace en el menú (—) | 1 form, Vue, gráficas, AJAX | Alta |
| `coordinadorc.reportecarrera.inicio_reporte_coordinador` | Tutorías (marco) | 23 | `GET /tutorias/reportecoordinador/repsemestralcarrera` | Personal (enlace) | — | Baja |
| `coordinadorc.reportecarrera.reporte_tutores` | Tutorías (marco) | 149 | `GET /tutorias/reportecoordinador/inicio_reporte_coordinador/{id_asigna_coordinador}` | Personal (carpeta (estimado)) | 1 form, 2 modal, AJAX | Media |
| `dep_desarrollo.index` | Tutorías (marco) | 242 | `GET /tutorias/planeaciondesarrollo` | Personal (enlace) | DataTables, Vue, AJAX | Alta |
| `dep_desarrollo.revisiondesarrollo` | app (Bootstrap 3) | 1670 | sin ruta directa | Alumno, Personal (carpeta (estimado)) | 1 form, Vue, gráficas, AJAX | Alta |
| `desarrollo.index` | Tutorías (marco) | 82 | `GET /tutorias/desarrollovista` | Personal (enlace) | Vue, AJAX | Alta |
| `eva_analisis.analisis` | Tutorías (marco) | 218 | `GET /tutorias/analisis/estadistico` | Personal (enlace) | gráficas, AJAX | Alta |
| `eva_analisis.areas` | Tutorías (marco) | 45 | `GET /tutorias/analisis` | Personal (enlace) | — | Baja |
| `eva_analisis.index` | Tutorías (marco) | 267 | `GET /tutorias/analisis/categorias` | Personal (enlace) | — | Media |
| `eva_autoeva_tutor.auto_eva_grafica` | Tutorías (marco) | 195 | `GET /tutorias_evaluacion/auto_eveluacion/grafica/{id_grupo_semestre}/{grupo}/{carrera}`<br>`GET /tutoras_evaluacion/auto_eveluacion` | Personal (enlace) | gráficas, AJAX | Alta |
| `eva_autoeva_tutor.auto_evaluacion2` | Tutorías (marco) | 143 | `GET /tutoras_evaluacion/auto_eveluacion/dos` | Personal (carpeta (estimado)) | 1 form | Baja |
| `eva_autoeva_tutor.auto_evaluacion_tutor` | Tutorías (marco) | 142 | `GET /tutoras_evaluacion/auto_eveluacion` | Personal (enlace) | 1 form | Baja |
| `eva_autoeva_tutor.comentario` | Tutorías (marco) | 20 | `POST /tutoras_evaluacion/auto_eveluacion/guardar_evaluacion/dos` | Personal (carpeta (estimado)) | 1 form | Baja |
| `eva_autoeva_tutor.sin_registro` | Tutorías (marco) | 10 | `GET /tutorias_evaluacion/auto_eveluacion/grafica/{id_grupo_semestre}/{grupo}/{carrera}` | Personal (carpeta (estimado)) | — | Baja |
| `eva_autoeva_tutor.tutores_sin_registro` | Tutorías (marco) | 24 | `GET /tutorias/tutores_sin_registro` | Personal (enlace) | — | Baja |
| `eva_buscador.cor_car` | Tutorías (marco) | 61 | `GET /tutorias/formulario` | Personal (enlace) | — | Baja |
| `eva_buscador.grupos` | Tutorías (marco) | 43 | sin ruta directa | Personal (carpeta (estimado)) | — | Baja |
| `eva_buscador.grupos_car` | Tutorías (marco) | 60 | `GET /tutorias/buscador/carrera/{id_carrera}` | Personal (enlace) | — | Baja |
| `eva_buscador.grupos_tutor` | Tutorías (marco) | 39 | `GET /tutorias/buscador/grupo/{id_grupo_semestre}` | Personal (enlace) | — | Baja |
| `eva_buscador.index` | Tutorías (marco) | 244 | `GET /tutorias/buscador/{id_grupo_semestre}`<br>`GET /tutorias/buscador/grupo/{id_grupo_semestre}` | Personal (enlace) | 1 form | Media |
| `eva_seguimiento_tu.com` | Tutorías (marco) | 30 | `POST /seguimiento_tutorias/formulario/guardar` | Sin enlace en el menú (—) | 1 form | Baja |
| `eva_seguimiento_tu.formato17` | Tutorías (marco) | 271 | `GET /seguimiento_tutorias/formulario/{per}/{id_grupo_semestre}` | Sin enlace en el menú (—) | 1 form | Media |
| `eva_seguimiento_tu.periodos` | Tutorías (marco) | 91 | `GET /seguimiento_tutorias/formulario/{id_grupo_semestre}/{grupo}/{carrera}` | Sin enlace en el menú (—) | — | Baja |
| `eva_seguimiento_tu.resultado` | Tutorías (marco) | 164 | `GET /seguimiento_tutorias/formulario/{per}/{id_grupo_semestre}` | Sin enlace en el menú (—) | — | Media |
| `eva_tutorias.activacion_index` | Tutorías (marco) | 63 | `GET /tutorias/evaluacion_tutor/estado` | Personal (enlace) | 1 modal | Media |
| `eva_tutorias.alumnos_index_uno` | Tutorías (marco) | 155 | sin ruta directa | Personal (carpeta (estimado)) | 1 form | Media |
| `eva_tutorias.carreras_index` | Tutorías (marco) | 61 | `GET /tutoras_evaluacion/resultado_tutorias_cordinador` | Personal (enlace) | — | Baja |
| `eva_tutorias.cordinador_index` | Tutorías (marco) | 88 | `GET /tutoras_evaluacion/resultado_tutorias_cordinador/carrera/{id_carrera}`<br>`GET /tutoras_evaluacion/resultado_tutorias_jefe/{id_asigna_coordinador}` | Personal (enlace) | — | Baja |
| `eva_tutorias.grafica_index` | Tutorías (marco) | 202 | `GET /tutoras_evaluacion/resultado_tutorias_cordinador/evaluacion_tutor/{id_grupo_semestre}/{grupo}/{carrera}`<br>`GET /tutoras_evaluacion/resultado_grafica/{id_grupo_semestre}` | Personal (carpeta (estimado)) | 1 form, gráficas, AJAX | Alta |
| `eva_tutorias.inicio_carrera` | Tutorías (marco) | 31 | `GET /tutoras_evaluacion/resultado_tutorias_jefe/carreras` | Personal (enlace) | — | Baja |
| `eva_tutorias.registro_index` | Tutorías (marco) | 40 | `GET /tutoras_evaluacion/resultado_tutorias_cordinador/registro_alumnos/{id_asigna_generacion}/{id_carrera}` | Personal (carpeta (estimado)) | — | Baja |
| `eva_tutorias.tutores_index` | Tutorías (marco) | 43 | `GET /tutoras_evaluacion/resultado_tutorias` | Personal (enlace) | — | Baja |
| `home` | Tutorías (marco) | 23 | `GET /tutorias` | Alumno, Personal (menú) | — | Baja |
| `jefe.index` | Tutorías (marco) | 123 | `GET /tutorias/jefevista` | Personal (enlace) | Vue, AJAX | Alta |
| `jefe.lista_estudiantes_semestre` | Tutorías (marco) | 40 | `GET /tutorias/ver_estudiantes_grupo/{id_asigna_tutor}` | Personal (carpeta (estimado)) | — | Baja |
| `jefe.listas_asistencias` | Tutorías (marco) | 131 | `GET /tutorias/listas_asistencia_semestre` | Personal (carpeta (estimado)) | 2 form, 2 modal, AJAX | Media |
| `profesor.canaliza` | app (Bootstrap 3) | 181 | sin ruta directa | Alumno, Personal (carpeta (estimado)) | 1 form, AJAX | Media |
| `profesor.canalizacion` | app (Bootstrap 3) | 55 | sin ruta directa | Alumno, Personal (carpeta (estimado)) | — | Baja |
| `profesor.desercion` | Tutorías (marco) | 285 | `GET /tutorias/desercion` | Personal (enlace) | 1 form, DataTables, Vue, AJAX | Alta |
| `profesor.eventos` | app (Bootstrap 3) | 79 | sin ruta directa | Alumno, Personal (carpeta (estimado)) | — | Baja |
| `profesor.evidencias` | app (Bootstrap 3) | 11 | sin ruta directa | Alumno, Personal (carpeta (estimado)) | — | Baja |
| `profesor.index` | Tutorías (marco) | 2464 | `GET /tutorias/tutorvista` | Personal (enlace) | 3 form, DataTables, Vue, gráficas, AJAX | Alta |
| `profesor.repsemestral` | Tutorías (marco) | 321 | `GET /tutorias/repsemestral` | Personal (enlace) | 1 form, DataTables, Vue, AJAX | Alta |
| `profesor.seguimiento` | Tutorías (marco) | 161 | `GET /tutorias/seguimiento` | Personal (enlace) | 1 form, DataTables, Vue, AJAX | Alta |

<details><summary>Parciales (42)</summary>

`alumno.AgregarAlumnos`, `alumno.ConfirmaRevalidacion`, `alumno.EliminarAlumno`, `alumno.EliminarGrupo`, `alumno.QuitarRevalidacion`, `alumno.modalCrearGrupo`, `coordina_inst.estadisticas`, `coordina_inst.modalagregar`, `coordina_inst.modaldesarrollosug`, `coordina_inst.modaleliminar`, `coordina_inst.modalestrategia`, `coordina_inst.modalsugerencia`, `coordina_inst.modalveractualiza`, `coordina_inst.modalveraprobados`, `coordina_inst.reportecarrerains.mood_observacion`, `coordina_inst.responsable`, `coordinadorc.estadisticas`, `coordinadorc.reportecarrera.mood_observacion`, `dep_desarrollo.modalcorrecion`, `dep_desarrollo.modalsugerencia`, `dep_desarrollo.modalsugerencia2`, `dep_desarrollo.modalveractividades`, `dep_desarrollo.modalvercorrecion`, `jefe.eliminarcoor`, `jefe.eliminartutor`, `jefe.modal_mod_semestre`, `jefe.modal_reg_semestre`, `partials.cabeza`, `partials.cuerpo`, `partials.encabezado`, `profesor.modal_agregar_semestre_grupo`, `profesor.modal_modificar_semestre_grupo`, `profesor.modalborrar`, `profesor.modalcanalizacion`, `profesor.modalcanalizacionact`, `profesor.modaleditar`, `profesor.modalestrategia`, `profesor.modalevidenciactividad`, `profesor.modalnuevaestra`, `profesor.modalreportesemactualiza`, `profesor.modalreportesemestral`, `profesor.modalseleccionactividad`

</details>

### `titulacion` — 56 pantallas, 81 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `alumno_titulacion.requisitos_titulacion_documentos` | app (Bootstrap 3) | 1649 | `GET /titulacion/documentacion_requisitos_titulacion` | Alumno (menú) | Vue, AJAX | Alta |
| `alumno_titulacion.segunda_etapa.registro_datos_personales` | app (Bootstrap 3) | 2653 | `GET /titulacion/reg_datos_personales/segunda_etapa` | Alumno (menú) | Vue, AJAX | Alta |
| `alumno_titulacion.tercera_etapa.consultar_fecha_titulacion` | app (Bootstrap 3) | 124 | sin ruta directa | Alumno (carpeta (estimado)) | fechas/calendario | Media |
| `alumno_titulacion.tercera_etapa.reg_fecha_hora_titulacion` | app (Bootstrap 3) | 128 | `GET /titulacion/fecha_titulacion_alumnos/{fecha_titulacion}/{sala_titulacion}` | Alumno (carpeta (estimado)) | 2 form, 1 modal | Media |
| `alumno_titulacion.tercera_etapa.reg_jurado_alumno` | app (Bootstrap 3) | 956 | `GET /titulacion/registro_jurado` | Alumno (menú) | 13 form, 12 modal, fechas/calendario, AJAX | Alta |
| `alumno_titulacion.ver_doc_autorizada` | app (Bootstrap 3) | 724 | `GET /titulacion/ver_documentacion_autorizada_alumno/{id_alumno}` | Alumno (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_ingles.registro_alumnos_certificado` | Inglés | 330 | `GET /titulacion/ingles_alumnos_carrera/{id_carrera}` | Alumno, Titulación, Inglés, Por unidad (carpeta (estimado)) | 4 form, 4 modal, DataTables, AJAX | Alta |
| `jefe_ingles.ver_carreras_ingles` | Inglés | 26 | `GET /titulacion/ingles_carreras` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `jefe_ingles.ver_carreras_titulacion` | app (Bootstrap 3) | 26 | `GET /titulacion/ver_certificado_ingles_carrera` | Titulación (menú) | — | Baja |
| `jefe_ingles.ver_estado_certificado` | app (Bootstrap 3) | 79 | `GET /titulacion/ingles_alumnos_carrera_ver/{id_carrrera}` | Alumno, Titulación, Inglés, Por unidad (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.alumnos_carrera` | app (Bootstrap 3) | 316 | `GET /titulacion/registro_alumnos_carrera/{id_carrera}` | Titulación (carpeta (estimado)) | 3 form, 4 modal, DataTables, AJAX | Alta |
| `jefe_titulacion.autorizar_doc_requisitos.autorizar_requisitos_alumno` | app (Bootstrap 3) | 103 | `GET /titulacion/autorizar_alumnos_doc_requisitos/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_doc_requisitos.carrera_doc_requisitos` | app (Bootstrap 3) | 30 | `GET /titulacion/autorizar_doc_requisitos` | Titulación (menú) | — | Baja |
| `jefe_titulacion.autorizar_doc_requisitos.proceso_autorizado` | app (Bootstrap 3) | 99 | `GET /titulacion/autorizados_doc_requisitos/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_doc_requisitos.proceso_modificacion` | app (Bootstrap 3) | 94 | `GET /titulacion/proceso_modificacion_doc_requisitos/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_doc_requisitos.revisar_doc_requisitos_alumn` | app (Bootstrap 3) | 2399 | `GET /titulacion/revisar_doc_requisitos/{id_alumno}` | Titulación (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_titulacion.autorizar_doc_requisitos.ver_documentacion_autorizada_alumno` | app (Bootstrap 3) | 760 | `GET /titulacion/ver_documentacion_autorizada/{id_alumno}` | Titulación (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_titulacion.autorizar_seg_parte.alumnos_carrera_centro_informacion` | app (Bootstrap 3) | 65 | `GET /titulacion/carrera_informacion/{id_carrera}` | Titulación, BD/ids (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_seg_parte.autorizar_centro_informacion` | app (Bootstrap 3) | 365 | `GET /titulacion/autorizacion_entrega_cd` | BD/ids (menú) | 3 form, 3 modal, DataTables, AJAX | Alta |
| `jefe_titulacion.autorizar_seg_parte.carrera_centro_informacion` | app (Bootstrap 3) | 23 | `GET /titulacion/documento_titulacion_autorizado` | BD/ids (menú) | — | Baja |
| `jefe_titulacion.autorizar_seg_parte.carreras_seg_parte` | app (Bootstrap 3) | 23 | `GET /titulacion/autorizar_datos_personales` | Titulación (menú) | — | Baja |
| `jefe_titulacion.autorizar_seg_parte.mostrar_dat_aut_alum_ti` | app (Bootstrap 3) | 792 | `GET /titulacion/ver_datos_per_ti_aut/{id_alumno}/{id_carrera}` | Titulación, BD/ids (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_titulacion.autorizar_seg_parte.mostrar_datos_autorizados_alumno_ti` | app (Bootstrap 3) | 792 | `GET /titulacion/ver_datos_personales_alumno_ti/{id_alumno}/{id_carrera}` | Titulación, BD/ids (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_titulacion.autorizar_seg_parte.proceso_autorizados_datos_alumno` | app (Bootstrap 3) | 102 | `GET /titulacion/autorizados_datos_alumno/{id_carrera}` | Titulación, BD/ids (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_seg_parte.proceso_faltante_entregar_centro_informacion` | app (Bootstrap 3) | 102 | `GET /titulacion/faltante_datos_alumno/{id_carrera}` | Titulación, BD/ids (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_seg_parte.proceso_modificacion_datos_alumno` | app (Bootstrap 3) | 99 | `GET /titulacion/proceso_modificacion_datos_alumno/{id_carrera}` | Titulación, BD/ids (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_seg_parte.proceso_revision_datos_personales` | app (Bootstrap 3) | 109 | `GET /titulacion/carrera_alum_reg_datos/{id_carrera}` | Titulación, BD/ids (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_seg_parte.revision_alumno` | app (Bootstrap 3) | 2019 | `GET /titulacion/revisar_datos_generales/{id_alumno}` | Titulación, BD/ids (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_titulacion.autorizar_tercer_parte.carrera_jurado` | app (Bootstrap 3) | 24 | `GET /titulacion/autorizar_jurado_estudiantes` | Titulación (menú) | — | Baja |
| `jefe_titulacion.autorizar_tercer_parte.proceso_autorizacion_jurado` | app (Bootstrap 3) | 102 | `GET /titulacion/autorizados_jurado/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_tercer_parte.proceso_modificacion_jurado` | app (Bootstrap 3) | 98 | `GET /titulacion/proceso_modificacion_jurado/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_tercer_parte.proceso_revision_jurado` | app (Bootstrap 3) | 107 | `GET /titulacion/autorizar_jurado_estudiantes_carrera/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.autorizar_tercer_parte.revision_jurado_estudiante` | app (Bootstrap 3) | 646 | `GET /titulacion/revisar_jurado_estudiante/{id_alumno}` | Titulación (carpeta (estimado)) | 8 form, 9 modal, fechas/calendario, AJAX | Alta |
| `jefe_titulacion.autorizar_tercer_parte.ver_jurado_autorizado_alumno` | app (Bootstrap 3) | 1146 | `GET /titulacion/ver_jurado_estudiante_autorizado/{id_alumno}` | Titulación (carpeta (estimado)) | 13 form, 13 modal, fechas/calendario, AJAX | Alta |
| `jefe_titulacion.catalogos_titulacion.reg_domo_titulacion` | app (Bootstrap 3) | 272 | `GET /titulacion/reg_catalogo_tomos_titulo` | Titulación (menú) | 4 form, 4 modal | Alta |
| `jefe_titulacion.catalogos_titulacion.reg_preparatoria` | app (Bootstrap 3) | 214 | `GET /titulacion/agregar_escuelas_preparatorias` | Titulación (menú) | 2 form, 2 modal, AJAX | Media |
| `jefe_titulacion.catalogos_titulacion.ver_domos_titulacion` | app (Bootstrap 3) | 269 | `GET /titulacion/consultar_domos_numeros_titulos/{id_reg_domo}` | Titulación (carpeta (estimado)) | 3 form, 3 modal, AJAX | Alta |
| `jefe_titulacion.consultar_dia` | app (Bootstrap 3) | 1180 | `GET /titulacion/calendario_estudiantes_autorizado`<br>`GET /titulacion/consultar_fecha_dia_titulacion_autorizadas/{fecha_dia}` | Titulación (menú) | 2 form, 2 modal, fechas/calendario | Alta |
| `jefe_titulacion.editar_titulo_cedula` | app (Bootstrap 3) | 248 | `GET /titulacion/editar_titulo_cedula` | Titulación (carpeta (estimado)) | 3 form, 3 modal, DataTables, AJAX | Alta |
| `jefe_titulacion.formulario_datos_titulado.alumnos_autorizados_dat_dep` | app (Bootstrap 3) | 131 | `GET /titulacion/alumnos_autorizados_carrera/{id_carrera}` | Titulación (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `jefe_titulacion.formulario_datos_titulado.alumnos_formulario` | app (Bootstrap 3) | 98 | `GET /titulacion/autorizar_titulacion_alumnos/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables, AJAX | Media |
| `jefe_titulacion.formulario_datos_titulado.autorizar_alumno_titulacion` | app (Bootstrap 3) | 103 | `GET /titulacion/formulario_datos_titulado/dato_alumno/{id_alumno}` | Titulación (carpeta (estimado)) | 1 form, 1 modal | Media |
| `jefe_titulacion.formulario_datos_titulado.carreras_formulario` | app (Bootstrap 3) | 23 | `GET /titulacion/formulario_datos_titulado/inicio/carrera` | Titulación (menú) | — | Baja |
| `jefe_titulacion.formulario_datos_titulado.dato_alumno_autorizado` | app (Bootstrap 3) | 463 | `GET /titulacion/formulario_datos_titulado_autorizado/dato_alumno/{id_alumno}` | Titulación (carpeta (estimado)) | — | Media |
| `jefe_titulacion.formulario_datos_titulado.reg_datos_alumno` | app (Bootstrap 3) | 1560 | `GET /titulacion/formulario_registrar_datos_al_ti/{id_alumno}` | Titulación (carpeta (estimado)) | 9 form, 5 modal, fechas/calendario, AJAX | Alta |
| `jefe_titulacion.formulario_datos_titulado.registrar_datos_alumnos_autorizados` | app (Bootstrap 3) | 99 | `GET /titulacion/alumnos_registrar_datos_dep/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables, AJAX | Media |
| `jefe_titulacion.liberacion_titulacion.datos_titulado_liberado` | app (Bootstrap 3) | 399 | `GET /titulacion/ver_datos_titulado/{id_alumno}` | Titulación (carpeta (estimado)) | — | Media |
| `jefe_titulacion.liberacion_titulacion.libera_carrera` | app (Bootstrap 3) | 90 | `GET /titulacion/liberacion_titulado_carrera` | Titulación (menú) | 1 modal, AJAX | Media |
| `jefe_titulacion.liberacion_titulacion.titulados_carrera` | app (Bootstrap 3) | 60 | `GET /titulacion/registro_titulados_carrera/{id_carrera}` | Titulación (carpeta (estimado)) | DataTables | Media |
| `jefe_titulacion.registrar_alumnos` | app (Bootstrap 3) | 30 | `GET /titulacion/registro_alumnos_titulacion` | Titulación (menú) | — | Baja |
| `jefe_titulacion.relacion_documentos.relacion_actas_alumnos` | app (Bootstrap 3) | 261 | `GET /titulacion/relacion_actas_titulos/{fecha}` | Titulación (carpeta (estimado)) | 3 form, 1 modal, fechas/calendario | Media |
| `jefe_titulacion.relacion_documentos.relacion_docu_carrera` | app (Bootstrap 3) | 148 | `GET /titulacion/relacion de documentos/inicio`<br>`GET /titulacion/consultar_fecha_dia_relacion_doc/{fecha_dia}` | Titulación (menú) | fechas/calendario | Media |
| `jefe_titulacion.relacion_documentos.relacion_mencion_honorifica` | app (Bootstrap 3) | 265 | `GET /titulacion/relacion_mencion_honorifica/{fecha}` | Titulación (carpeta (estimado)) | 3 form, 1 modal, fechas/calendario | Media |
| `jefe_titulacion.relacion_documentos.relacion_titulos_alumnos` | app (Bootstrap 3) | 267 | `GET /titulacion/relacion_titulos/{fecha}` | Titulación (carpeta (estimado)) | 3 form, 1 modal, fechas/calendario | Media |
| `jefe_titulacion.validar_agregar_jurado.alumnos_validar_agregar_jurado` | app (Bootstrap 3) | 126 | `GET /titulacion/validacion_agregar_jurado/alumnos/{id_carrera}` | Titulación (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `jefe_titulacion.validar_agregar_jurado.carrera_validar_gregar_jurado` | app (Bootstrap 3) | 24 | `GET /titulacion/validacion_agregar_jurado/carreras` | Titulación (menú) | — | Baja |

<details><summary>Parciales (81)</summary>

`alumno_titulacion.correccion_doc_alumno`, `alumno_titulacion.enviar_doc_requisitos`, `alumno_titulacion.modal_acta_residencia`, `alumno_titulacion.modal_certificado_ingles`, `alumno_titulacion.modal_certificado_tec`, `alumno_titulacion.modal_enviar_correcciones`, `alumno_titulacion.modal_enviar_requisitos`, `alumno_titulacion.modal_opciones_titulacion`, `alumno_titulacion.modal_pago_concepto_autenticacion`, `alumno_titulacion.modal_pago_constancia`, `alumno_titulacion.modal_pago_derecho_titulacion`, `alumno_titulacion.modal_pago_integrantes`, `alumno_titulacion.modal_pago_titulo`, `alumno_titulacion.modal_reg_acta`, `alumno_titulacion.modal_reg_certificado_prepa`, `alumno_titulacion.modal_reg_contancia_ss`, `alumno_titulacion.modal_reg_curp`, `alumno_titulacion.modal_reg_reporte_egel`, `alumno_titulacion.segunda_etapa.modal_agregar_computo`, `alumno_titulacion.segunda_etapa.modal_agregar_libro`, `alumno_titulacion.segunda_etapa.modal_eliminar_computo`, `alumno_titulacion.segunda_etapa.modal_eliminar_libro`, `alumno_titulacion.segunda_etapa.modal_enviar`, `alumno_titulacion.segunda_etapa.modal_enviar_modificacion`, `alumno_titulacion.segunda_etapa.modal_modificar_computo`, `alumno_titulacion.segunda_etapa.modal_modificar_libro`, `alumno_titulacion.tercera_etapa.modal_agregar_presidente`, `alumno_titulacion.tercera_etapa.modal_agregar_secretario`, `alumno_titulacion.tercera_etapa.modal_agregar_suplente`, `alumno_titulacion.tercera_etapa.modal_agregar_vocal`, `alumno_titulacion.tercera_etapa.modal_modificar_fecha`, `alumno_titulacion.tercera_etapa.modal_modificar_presidente`, `alumno_titulacion.tercera_etapa.modal_modificar_secretario`, `alumno_titulacion.tercera_etapa.modal_modificar_suplente`, `alumno_titulacion.tercera_etapa.modal_modificar_vocal`, `jefe_ingles.eliminar_alumno_certificado`, `jefe_ingles.enviar_certificado`, `jefe_ingles.modal_agregar_certificado`, `jefe_ingles.modificar_certificado`, `jefe_titulacion.autorizar_doc_requisitos.aceptar_documentacion`, `jefe_titulacion.autorizar_doc_requisitos.enviar_revision_doc`, `jefe_titulacion.autorizar_doc_requisitos.modal_enviar_correccion`, `jefe_titulacion.autorizar_doc_requisitos.modal_reg_constancia_adeudo`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc1`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc10`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc11`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc12`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc13`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc14`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc2`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc3`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc4`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc5`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc6`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc7`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc8`, `jefe_titulacion.autorizar_doc_requisitos.revision_doc9`, `jefe_titulacion.autorizar_seg_parte.autorizacion_dat_personales`, `jefe_titulacion.autorizar_seg_parte.enviar_reporte_centro_informacion`, `jefe_titulacion.autorizar_seg_parte.modal_enviar_modificacion_dat`, `jefe_titulacion.autorizar_seg_parte.modal_mod_datos_reporte_informacion`, `jefe_titulacion.autorizar_seg_parte.modal_mod_reporte_tit_compu`, `jefe_titulacion.autorizar_seg_parte.mostrar_datos_centro`, `jefe_titulacion.autorizar_tercer_parte.modal_comentario_modificacion`, `jefe_titulacion.autorizar_tercer_parte.modal_dia_titulacion`, `jefe_titulacion.catalogos_titulacion.agregar_estudiante_folio_titulo`, `jefe_titulacion.catalogos_titulacion.editar_folio_titulacion`, `jefe_titulacion.catalogos_titulacion.modificar_estado_folio_titulo`, `jefe_titulacion.catalogos_titulacion.partials_modificar_preparatoria`, `jefe_titulacion.formulario_datos_titulado.modal_liberar_titulado`, `jefe_titulacion.formulario_datos_titulado.modificar_dat_estudiantes`, `jefe_titulacion.formulario_datos_titulado.modificar_datos_acta`, `jefe_titulacion.formulario_datos_titulado.partials_modificacion_datos_oficio_recursos`, `jefe_titulacion.liberacion_titulacion.seleccion_year`, `jefe_titulacion.modal_agregar`, `jefe_titulacion.modal_edicion_titulo_profesor`, `jefe_titulacion.modal_editar`, `jefe_titulacion.modal_editar_cedula_jurado`, `jefe_titulacion.modal_eliminar_registro_alumno`, `jefe_titulacion.validar_agregar_jurado.autorizar_alumno_agregar_jurado`, `jefe_titulacion.ver_datos_alumnos_descuento`

</details>

### `servicios_escolares` — 45 pantallas, 11 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `bajas_estudiantes.bajas_definitivas_estudiantes` | app (Bootstrap 3) | 281 | `GET /servicios_escolares/bajas_definitivas`<br>`GET /servicios_escolares/bajas_definitivas/ver/{id_carrera}` | Escolar/Dir. (menú) | 1 form, 2 modal, DataTables, AJAX | Media |
| `bajas_estudiantes.bajas_temporales_estudiantes` | app (Bootstrap 3) | 318 | `GET /servicios_escolares/bajas_temporales`<br>`GET /servicios_escolares/bajas_temporales/ver/{id_carrera}` | Escolar/Dir. (menú) | 1 form, 2 modal, DataTables, AJAX | Media |
| `bajas_estudiantes.bitacora_bajas_def_tem` | app (Bootstrap 3) | 108 | `GET /servicios_escolares/bitacora_def_temp/{id_carrera?}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `bitacora_calificaciones` | app (Bootstrap 3) | 38 | `GET /servicios_escolares/bitacora_evaluaciones` | Escolar/Dir. (menú) | — | Baja |
| `bitacora_periodos` | app (Bootstrap 3) | 54 | `GET /servicios_escolares/bitacora_periodos` | Escolar/Dir. (menú) | DataTables | Media |
| `bitacora_sumativas` | app (Bootstrap 3) | 38 | `GET /servicios_escolares/bitacora_evaluaciones_sumativas` | Escolar/Dir. (menú) | — | Baja |
| `calificaciones` | app (Bootstrap 3) | 310 | `GET /servicios_escolares/acciones/{id_docente}/{id_materia}/{id_grupo}/{id_carrera}` | Desarrollo, Escolar/Dir., Cómputo (carpeta (estimado)) | 1 modal, AJAX | Media |
| `calificaciones_academico` | app (Bootstrap 3) | 128 | `GET /servicios_escolares/acciones_academico/{id_docente}/{id_materia}/{id_grupo}` | Desarrollo, Escolar/Dir., Cómputo (carpeta (estimado)) | — | Baja |
| `calificar_duales` | app (Bootstrap 3) | 221 | `GET /calificar_estudiante/{id_carga}` | Desarrollo, Escolar/Dir., Cómputo (carpeta (estimado)) | 3 form, 3 modal, AJAX | Alta |
| `carreras_calificaciones` | app (Bootstrap 3) | 211 | `GET /servicios_escolares/carreras_calificaciones` | Escolar/Dir. (menú) | 1 modal, AJAX | Media |
| `concentrado_calificaciones.concentrado_carreras` | app (Bootstrap 3) | 28 | `GET /servicios_escolare/concentrados_calificaciones` | Escolar/Dir. (menú) | — | Baja |
| `concentrado_calificaciones.concentrado_semestres` | app (Bootstrap 3) | 26 | `GET /servicios_escolares/concentrado_calificaciones/semestres/{id_semestre}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `duales.agregar_alumnos_dual` | app (Bootstrap 3) | 176 | `GET /servicios_escolares/duales/agregar_alumnos_dual` | Escolar/Dir. (menú) | 3 form, 3 modal, DataTables | Alta |
| `duales.checar_carga_academica` | app (Bootstrap 3) | 467 | `GET /servicios_escolares/duales/checar_carga_academica`<br>`GET /servicios_escolares/duales/revision_control_escolar/{id_alumno}` | Escolar/Dir. (carpeta (estimado)) | 3 form, 2 modal, AJAX | Media |
| `duales.dual_mensages` | app (Bootstrap 3) | 45 | `GET /servicios_escolares/duales/checar_carga_academica`<br>`GET /servicios_escolares/duales/checar_carga_academica/{checar_carga_academica}/edit` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `duales.llenar_carga_academica_dual` | app (Bootstrap 3) | 160 | `GET /servicios_escolares/duales/llenar_carga_academica_dual` | Escolar/Dir. (menú) | 2 form, 2 modal, DataTables, AJAX | Media |
| `escuelas_procedencia` | app (Bootstrap 3) | 156 | `GET /agregar_escuelas_procedencia` | Desarrollo, Escolar/Dir., Cómputo (carpeta (estimado)) | 2 form, 2 modal, DataTables, AJAX | Media |
| `estadisticas` | app (Bootstrap 3) | 24 | `GET /servicios_escolares/estadisticas` | Escolar/Dir. (menú) | — | Baja |
| `evaluaciones` | app (Bootstrap 3) | 214 | `GET /servicios_escolares/evaluaciones/{id_carrera}` | Desarrollo, Escolar/Dir., Cómputo (carpeta (estimado)) | 1 modal, AJAX | Media |
| `evaluaciones_academico` | app (Bootstrap 3) | 130 | `GET /servicios_escolares/evaluaciones_academicas` | Desarrollo (menú) | 1 modal | Media |
| `evaluaciones_cc_academico` | app (Bootstrap 3) | 130 | `GET /servicios_escolares/evaluaciones_cc_academico` | Cómputo (menú) | 1 modal | Media |
| `historial_academico.especialidades` | app (Bootstrap 3) | 177 | `GET /servicios_escolares/especialidades`<br>`GET /servicios_escolares/especialidades/carreras/{id_carrera}` | Escolar/Dir. (menú) | 1 form, 2 modal, AJAX | Media |
| `historial_academico.historial_academico` | app (Bootstrap 3) | 624 | `GET /servicios_escolares/historial_academico/alumno/{id_alumno}/{calificada}` | Escolar/Dir. (carpeta (estimado)) | 6 form, 7 modal, DataTables, fechas/calendario | Alta |
| `historial_academico.historial_alumnos` | app (Bootstrap 3) | 119 | `GET /servicios_escolares/historial_academico/carrera/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | 1 form, 1 modal, DataTables | Media |
| `historial_academico.historial_carreras` | app (Bootstrap 3) | 28 | `GET /servicios_escolares/historial_academico` | Escolar/Dir. (menú) | — | Baja |
| `historial_academico.planes_estudio` | app (Bootstrap 3) | 185 | `GET /servicios_escolares/plan_estudio`<br>`GET /servicios_escolares/plan_estudio/carreras/{id_carrera}` | Escolar/Dir. (menú) | 1 form, 2 modal, AJAX | Media |
| `historial_modificaciones_carga` | app (Bootstrap 3) | 50 | `GET /servicios_escolares/modificaciones_cargas_cademicas` | Escolar/Dir. (menú) | DataTables | Media |
| `index` | app (Bootstrap 3) | 61 | `GET /servicios_escolares` | Desarrollo, Escolar/Dir., Cómputo (carpeta (estimado)) | — | Baja |
| `indice_reprobacion_carreras` | app (Bootstrap 3) | 26 | `GET /servicios_escolares/estadisticas/carreras_indice_reprobacion` | Escolar/Dir. (enlace) | — | Baja |
| `partials.alumnos` | app (Bootstrap 3) | 170 | `GET /servicios_escolares/estadisticas/genero` | Escolar/Dir. (enlace) | gráficas | Alta |
| `partials.edad` | app (Bootstrap 3) | 209 | `GET /servicios_escolares/estadisticas/edad` | Escolar/Dir. (enlace) | gráficas | Alta |
| `partials.ind_reprobacion` | app (Bootstrap 3) | 69 | `GET /servicios_escolares/estadisticas/indice_reprobacion_semestre/{id_carrera}/{id_semestre}`<br>`GET /servicios_escolares/estadisticas/indice_reprobacion_semestre_materia/{id_carrera}/{id_semestre}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `partials.indice_rep_semestre` | app (Bootstrap 3) | 27 | `GET /servicios_escolares/estadisticas/indice_reprobacion/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `partials.municipio` | app (Bootstrap 3) | 213 | `GET /servicios_escolares/estadisticas/municipios` | Escolar/Dir. (enlace) | gráficas | Alta |
| `periodos` | app (Bootstrap 3) | 89 | `GET /servicios_escolares/acciones/periodos/{id_docente}/{id_materia}/{id_grupo}/{id_carrera}` | Desarrollo, Escolar/Dir., Cómputo (carpeta (estimado)) | — | Baja |
| `promedio_al_periodo.promedio_alumnos` | app (Bootstrap 3) | 49 | `GET /servicios_escolares/promedio_alumno_grupo/{id_carrera}/{id_semestre}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `promedio_al_periodo.promedio_carrera` | app (Bootstrap 3) | 28 | `GET /servicios_escolares/promedio_semestre` | Escolar/Dir. (menú) | — | Baja |
| `promedio_al_periodo.promedio_semestres_carrera` | app (Bootstrap 3) | 26 | `GET /servicios_escolares/promedio_alumnos_periodo/semestres/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `reg_datos_alumno.alumnos_actualizar_semestre` | app (Bootstrap 3) | 137 | `GET /servicios_escolares/carrera_estudiantes_act_sem/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | 1 form, 1 modal, DataTables | Media |
| `reg_datos_alumno.alumnos_inactivos` | app (Bootstrap 3) | 99 | `GET /servicios_escolares/estudiantes_inactivos/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | 1 modal, DataTables, AJAX | Media |
| `reg_datos_alumno.alumnos_reg_semestre` | app (Bootstrap 3) | 254 | `GET /servicios_escolares/registrar_semestre_al/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | 3 modal, DataTables, AJAX | Alta |
| `reg_datos_alumno.carrera_estudiantes_inactivos` | app (Bootstrap 3) | 28 | `GET /servicios_escolares/carrera_estudiantes_desactivados` | Escolar/Dir. (menú) | — | Baja |
| `reg_datos_alumno.carreras_actualizacion_semestre` | app (Bootstrap 3) | 28 | `GET /servicios_escolares/carreras_act_sem` | Escolar/Dir. (enlace) | — | Baja |
| `reg_datos_alumno.periodos_actualizar_sem` | app (Bootstrap 3) | 206 | `GET /servicios_escolares/carrera_actualizar_semestre_periodo` | Escolar/Dir. (menú) | 2 form, 3 modal, AJAX | Alta |
| `reg_datos_alumno.reg_semestre_alumno` | app (Bootstrap 3) | 28 | `GET /servicios_escolares/registrar_semestre_alumnos/carrera` | Escolar/Dir. (menú) | — | Baja |

<details><summary>Parciales (11)</summary>

`duales.partials.materias`, `historial_academico.modificar_especialidad`, `historial_academico.modificar_plan`, `partials.edit_escuela_procedencia`, `reg_datos_alumno.desactivar_estudiante`, `reg_datos_alumno.partials_activacion_estudiante`, `reg_datos_alumno.partials_activacion_periodo`, `reg_datos_alumno.partials_agregar_semestre`, `reg_datos_alumno.partials_autorizar_semestre`, `reg_datos_alumno.partials_eliminar_reg_estudiante`, `reg_datos_alumno.partials_modificar_semestre`

</details>

### `encuestas_satisfacion_cliente` — 42 pantallas, 11 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `computo.menu_historial` | app (Bootstrap 3) | 54 | `GET /encuestas_satisfaccion/menu_historial_mantenimiento` | Cómputo, Personal (menú) | — | Baja |
| `computo.periodos_mantenimiento` | app (Bootstrap 3) | 185 | `GET /encuestas_satisfaccion/periodo_mantenimiento`<br>`GET /encuestas_satisfaccion/menu_historial_mantenimiento_year/{year}` | Cómputo (menú) | 2 form, 2 modal, AJAX | Media |
| `computo.personal_tec` | app (Bootstrap 3) | 334 | `GET /encuestas_satisfaccion/ver_encuestas_mant/{mes}/{year}` | Cómputo, Personal (carpeta (estimado)) | 3 form, 4 modal, DataTables, fechas/calendario, AJAX | Alta |
| `computo.registro_encuestas` | app (Bootstrap 3) | 175 | `GET /encuestas_satisfaccion/registro_enc_mante_usuario` | Personal (menú) | 1 modal, DataTables, fechas/calendario, AJAX | Media |
| `computo.resultados_graficas` | app (Bootstrap 3) | 673 | `GET /encuestas_satisfaccion/ver_resultado_mantenimiento/{mes}/{year}` | Cómputo, Personal (carpeta (estimado)) | gráficas | Alta |
| `inscripcion.carerras_inscripcion` | app (Bootstrap 3) | 39 | `GET /encuestas_satisfaccion/carrera_enc_incripcion` | Escolar/Dir., Personal (enlace) | — | Baja |
| `inscripcion.encuesta_contestada` | app (Bootstrap 3) | 228 | `GET /encuestas_satisfaccion/enc_est_inscripcion/{id_incripcion}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Media |
| `inscripcion.encuesta_inscripcion` | app (Bootstrap 3) | 377 | `GET /encuestas_satisfaccion/encuesta_incripcion` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | 1 form | Media |
| `inscripcion.encuestas_carrera` | app (Bootstrap 3) | 82 | `GET /encuestas_satisfaccion/alumnos_enc_incripcion/{id_carrera}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | DataTables, AJAX | Media |
| `inscripcion.graficas_inscripcion` | app (Bootstrap 3) | 1232 | `GET /encuestas_satisfaccion/ver_resultados_enc_incripcion` | Escolar/Dir., Personal (enlace) | gráficas | Alta |
| `inscripcion.periodo_encuestas` | app (Bootstrap 3) | 158 | `GET /encuestas_satisfaccion/encuesta_incripcion_periodo` | Escolar/Dir., Personal (menú) | 1 form, 1 modal | Media |
| `reinscripcion.carreras_reinscripcion` | app (Bootstrap 3) | 39 | `GET /encuestas_satisfaccion/carrera_enc_reincripcion` | Escolar/Dir., Personal (enlace) | — | Baja |
| `reinscripcion.encuesta_contestada` | app (Bootstrap 3) | 228 | `GET /encuestas_satisfaccion/enc_est_reinscripcion/{id_reinscripcion}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Media |
| `reinscripcion.encuesta_reinscripcion` | app (Bootstrap 3) | 377 | `GET /encuestas_satisfaccion/encuesta_reincripcion` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | 1 form | Media |
| `reinscripcion.encuestas_carrera` | app (Bootstrap 3) | 82 | `GET /encuestas_satisfaccion/alumnos_enc_reincripcion/{id_carrera}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | DataTables, AJAX | Media |
| `reinscripcion.graficas_reinscripcion` | app (Bootstrap 3) | 1232 | `GET /encuestas_satisfaccion/ver_resultados_enc_reincripcion` | Escolar/Dir., Personal (enlace) | gráficas | Alta |
| `reinscripcion.periodo_encuestas` | app (Bootstrap 3) | 162 | `GET /encuestas_satisfaccion/encuesta_reincripcion_periodo` | Escolar/Dir., Personal (menú) | 1 form, 1 modal | Media |
| `residencia.alumnos_enc_autorizada` | app (Bootstrap 3) | 105 | `GET /encuestas_satisfaccion/ver_enc_contestadas_resi_alum/{id_carrera}/{id_periodo_residencia}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `residencia.carreras_enc_autorizadas` | app (Bootstrap 3) | 38 | `GET /encuestas_satisfaccion/ver_enc_contestadas_residencia/{id_periodo_residencia}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Baja |
| `residencia.enc_alumno_contestada` | app (Bootstrap 3) | 235 | `GET /encuestas_satisfaccion/ver_enc_alumno_contestada/{id_residencia_profesional}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Media |
| `residencia.encuesta_alumno_residencia` | app (Bootstrap 3) | 338 | `GET /encuestas_satisfaccion/encuesta_residencia` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | 1 form | Media |
| `residencia.encuesta_alumnos_residencia` | app (Bootstrap 3) | 150 | `GET /encuestas_satisfaccion/ver_encuesta_residencia_alumno/{id_carrera}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `residencia.encuesta_carrera_residencia` | app (Bootstrap 3) | 36 | `GET /encuestas_satisfaccion/ver_carreras_encuesta_residencia/{id_periodo}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Baja |
| `residencia.graficas_porcentajes_resi` | app (Bootstrap 3) | 1511 | `GET /encuestas_satisfaccion/ver_enc_carreras_res_residencia/{id_periodo_residencia}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | gráficas | Alta |
| `residencia.periodo_encuesta_residencia` | app (Bootstrap 3) | 177 | `GET /encuestas_satisfaccion/agregar_periodo_year_residencia` | Residencias, Personal (menú) | 2 form, 2 modal, AJAX | Media |
| `servicio_social.alumnos_periodo_terminado` | app (Bootstrap 3) | 126 | `GET /encuestas_satisfaccion/ver_enc_serv_alum_terminado/{id_carrera}/{mes}/{year}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `servicio_social.encuesta_alumno_servicio` | app (Bootstrap 3) | 337 | `GET /encuestas_satisfaccion/encuesta_servicio_social` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | 1 form | Media |
| `servicio_social.encuesta_alumnos_servicio` | app (Bootstrap 3) | 158 | `GET /encuestas_satisfaccion/ver_encuesta_servicio_alumno/{id_carrera}/{mes}/{year}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `servicio_social.encuesta_carrera_servicio` | app (Bootstrap 3) | 111 | `GET /encuestas_satisfaccion/ver_carreras_encuesta_servicio/{mes}/{year}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Baja |
| `servicio_social.encuesta_servicio_social_admin` | app (Bootstrap 3) | 258 | `GET /encuestas_satisfaccion/ver_enc_terminada/{id_servicio}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Media |
| `servicio_social.graficas_porcentajes_servicio` | app (Bootstrap 3) | 1536 | `GET /encuestas_satisfaccion/ver_enc_resultados/{mes}/{year}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | gráficas | Alta |
| `servicio_social.menu_historial` | app (Bootstrap 3) | 51 | `GET /encuestas_satisfaccion/historial_periodo_year` | Residencias, Personal (menú) | — | Baja |
| `servicio_social.periodos_servicio_social` | app (Bootstrap 3) | 180 | `GET /encuestas_satisfaccion/agregar_periodo_year`<br>`GET /encuestas_satisfaccion/menu_historial_servicio_s_year/{year}` | Residencias (menú) | 2 form, 2 modal, AJAX | Media |
| `titulacion.carrera_alumno` | app (Bootstrap 3) | 107 | `GET /encuestas_satisfaccion/encuesta_estudiante_titulacion_carrera/{id_carrera}/{year}/{mes}` | Alumno, Titulación, Personal (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `titulacion.carrera_alumno_termino` | app (Bootstrap 3) | 125 | `GET /encuestas_satisfaccion/enc_est_ti_carrera_termino/{id_carrera}/{mes}/{year}` | Alumno, Titulación, Personal (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `titulacion.carreras` | app (Bootstrap 3) | 79 | `GET /encuestas_satisfaccion/enviar_enc_carreras_ti/{mes}/{year}` | Alumno, Titulación, Personal (carpeta (estimado)) | — | Baja |
| `titulacion.carreras_autorizadas` | app (Bootstrap 3) | 80 | `GET /encuestas_satisfaccion/enc_contestadas_carreras_ti/{mes}/{year}` | Alumno, Titulación, Personal (carpeta (estimado)) | — | Baja |
| `titulacion.encuesta_alumno_ti` | app (Bootstrap 3) | 465 | `GET /encuestas_satisfaccion/contestar_encuesta_alumno` | Alumno (enlace) | 1 form | Media |
| `titulacion.encuesta_contestada` | app (Bootstrap 3) | 261 | `GET /encuestas_satisfaccion/enc_est_ti_alumno_termino/{id_titulacion}` | Alumno, Titulación, Personal (carpeta (estimado)) | — | Media |
| `titulacion.menu_historial_encuesta` | app (Bootstrap 3) | 51 | `GET /encuestas_satisfaccion/historial_encuesta_estudiante_titulacion` | Titulación, Personal (menú) | — | Baja |
| `titulacion.periodos_titulacion` | app (Bootstrap 3) | 188 | `GET /encuestas_satisfaccion/enviar_encuesta_estudiante_titulacion`<br>`GET /encuestas_satisfaccion/menu_historial_titulacion_year/{year}` | Titulación (menú) | 2 form, 2 modal, AJAX | Media |
| `titulacion.resultados_graficas` | app (Bootstrap 3) | 269 | `GET /encuestas_satisfaccion/ver_resultados_enc_ti/{mes}/{year}` | Alumno, Titulación, Personal (carpeta (estimado)) | gráficas | Alta |

<details><summary>Parciales (11)</summary>

`computo.datos_personal`, `computo.eliminar_mantenimiento`, `computo.encuesta_mantenimiento`, `computo.modal_ver_encuesta`, `computo.termino_periodo`, `residencia.dato_alumno_residencia`, `residencia.terminar_periodo_resi`, `servicio_social.datos_alumno`, `servicio_social.terminar_periodo`, `titulacion.dato_alumno`, `titulacion.partials_terminar_periodo`

</details>

### `ingles` — 38 pantallas, 12 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `alumno_ingles.estado_periodo` | Inglés | 28 | `GET /ingles_horarios/iniciar_carga_academica` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `alumno_ingles.estado_registro_carga_academica` | Inglés | 38 | `GET /ingles_horarios/iniciar_carga_academica` | Alumno, Inglés, Por unidad (enlace) | 1 form | Baja |
| `alumno_ingles.estado_voucher` | Inglés | 27 | `GET /ingles_horarios/iniciar_carga_academica` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `alumno_ingles.llenar_carga_ingles` | Inglés | 288 | `GET /ingles_horarios/llenar_carga_academica`<br>`GET /ingles_horarios/carga_academica_grupo/{id_hrs_niveles_grupo}` | Alumno, Inglés, Por unidad (carpeta (estimado)) | AJAX | Media |
| `alumno_ingles.revision_carga_ingles` | Inglés | 206 | `GET /ingles_horarios/revision_carga_academica` | Alumno, Inglés, Por unidad (enlace) | — | Media |
| `armar_horarios_ingles` | Inglés | 332 | `GET /ingles_horarios/agregar`<br>`GET /ingles_horarios/profesor_horarios/{id_profesor}/{id_niveles}/{id_grupo}` | Alumno, Inglés, Por unidad (enlace) | AJAX | Media |
| `cargas_ingles.cargar_voucher_pago` | Inglés | 512 | `GET /ingles_horarios/cargar_voucher_pago` | Alumno, Inglés, Por unidad (enlace) | 2 form | Alta |
| `cargas_ingles.maximo_grupo_alumnos` | Inglés | 99 | `GET /ingles/maximo_grupo_alumnos` | Alumno, Inglés, Por unidad (enlace) | 3 form | Media |
| `cargas_ingles.vouchers_aceptados` | Inglés | 250 | `GET /ingles/vouchers_aceptados` | Alumno, Inglés, Por unidad (enlace) | 2 form, 4 modal, DataTables, AJAX | Alta |
| `cargas_ingles.vouchers_rechazados` | Inglés | 82 | `GET /ingles/vouchers_rechazados` | Alumno, Inglés, Por unidad (enlace) | 1 modal, DataTables, AJAX | Media |
| `cargas_ingles.vouchers_validar` | Inglés | 127 | `GET /ingles/vouchers_validacion` | Alumno, Inglés, Por unidad (enlace) | 1 form, 2 modal, DataTables, AJAX | Media |
| `create_profesores` | app (Bootstrap 3) | 114 | `GET /profesores_ingles/create` | Alumno, Inglés, Por unidad (carpeta (estimado)) | 1 form, fechas/calendario | Media |
| `departamento.agregar_usuarios_grupos` | Inglés | 248 | `GET /ingles/profesores/agregar_usuarios_grupo_prof/{id_nivel}/{id_grupo}`<br>`GET /ingles/consultar_usuarios_grupo_prof/{id_nivel}/{id_grupo}/{id_carrera}/{id_semestre}/{id_grupos_carrera}` | Alumno, Inglés, Por unidad (carpeta (estimado)) | 1 modal, DataTables, AJAX | Media |
| `departamento.carreras_historial` | Inglés | 27 | `GET /ingles/historial_academico_alumno` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `departamento.desactivacion_grupos` | Inglés | 57 | `GET /ingles/profesores/desactivar_grupos_profesor/{id_profesores}` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `departamento.generar_constancias` | Inglés | 81 | `GET /ingles/historial/generar_constancias_alumnos_carrera/{id_carrera}` | Alumno, Inglés, Por unidad (carpeta (estimado)) | DataTables | Media |
| `departamento.mostrar_calificaciones` | Inglés | 115 | `GET /ingles/historial/ver_alumnos_carrera/{id_carrera}` | Alumno, Inglés, Por unidad (carpeta (estimado)) | DataTables | Media |
| `departamento.nuevo_ingreso` | Inglés | 826 | `GET /ingles/control-escolar` | Alumno, Inglés, Por unidad (enlace) | 2 modal, DataTables, AJAX | Alta |
| `departamento.profesores_calificaciones` | Inglés | 45 | `GET /ingles/profesores/calificaciones` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `departamento.profesores_validar_grupos` | Inglés | 45 | `GET /ingles/desactivar_grupos` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `departamento.validar_carga_ingles` | Inglés | 100 | `GET /ingles/autorizacion_cargas` | Alumno, Inglés, Por unidad (enlace) | 1 modal, DataTables, AJAX | Media |
| `departamento.ver_carga_academica_ingles` | Inglés | 90 | `GET /ingles/ver_carga_academica_ingles/{id_validar_carga}` | Alumno, Inglés, Por unidad (carpeta (estimado)) | — | Baja |
| `desempeno_academico.estadisticas_generales` | Inglés | 327 | `GET /ingles/desempeno_academico/estadisticas_generales` | Alumno, Inglés, Por unidad (enlace) | gráficas | Alta |
| `desempeno_academico.niveles` | Inglés | 283 | `GET /ingles/desempeno_academico/niveles` | Alumno, Inglés, Por unidad (enlace) | — | Media |
| `estadisticas.estadisticas_genero` | Inglés | 123 | `GET /ingles_estadistica/estadisticas_genero` | Alumno, Inglés, Por unidad (enlace) | gráficas | Alta |
| `estadisticas.grafica_genero` | Inglés | 115 | `GET /ingles/estadisticas/grafica_genero` | Alumno, Inglés, Por unidad (carpeta (estimado)) | gráficas | Alta |
| `horarios_facilitadores` | Inglés | 45 | `GET /ingles/mostrar_horarios_profesores` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `inicio_ingles.inicio_ingles` | Inglés | 18 | `GET /ingles` | Alumno, Inglés, Por unidad (menú) | — | Baja |
| `mostrar_grupos_niveles` | Inglés | 196 | `GET /ingles/mostrar_horario_profesor_grupo`<br>`GET /ingles/grupos_niveles/{id_grupos}/{id_nivel}` | Alumno, Inglés, Por unidad (enlace) | AJAX | Media |
| `mostrar_profesores_ingles` | Inglés | 183 | `GET /armar_plantilla/profesore_ingles` | Alumno, Inglés, Por unidad (enlace) | 2 modal, Vue, AJAX | Alta |
| `partials.modificar_profesor` | Inglés | 127 | `GET /profesores_ingles/modificar/{id_usuario}` | Alumno, Inglés, Por unidad (enlace) | 1 form, fechas/calendario | Media |
| `partials.mostrar_grupo` | Inglés | 44 | `GET /ingles_horarios/mostrar_grupo` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `partials.mostrar_niveles` | Inglés | 45 | `GET /ingles/mostrar_niveles` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `partials.mostrar_periodos` | Inglés | 48 | `GET /ingles/mostrar_periodos` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `plantilla_ingles_periodo` | Inglés | 141 | `GET /agregar_profesor/ingles_periodo` | Alumno, Inglés, Por unidad (enlace) | 2 form, 2 modal, DataTables, AJAX | Media |
| `profesor_nivel` | Inglés | 93 | `GET /ingles/mostrar_horario_profesor/{id_profesor}` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `profesores_ingles.inicio_calificaciones` | Inglés | 52 | `GET /ingles/Calificaciones`<br>`GET /ingles/profesores/calificacion_profesor/{id_profesor}` | Alumno, Inglés, Por unidad (enlace) | — | Baja |
| `profesores_ingles.periodos_calificaciones` | Inglés | 248 | `GET /ingles/Calificaciones/periodos_ingles/{id_nivel}/{id_grupo}` | Alumno, Inglés, Por unidad (carpeta (estimado)) | 2 form, 2 modal, AJAX | Media |

<details><summary>Parciales (12)</summary>

`cargas_ingles.registro_voucher_alumno`, `departamento.datos_usuario`, `departamento.mensaje_permiso`, `departamento.modificar_calificacion_ingles`, `estadisticas.estadisticas_atencion_demanda`, `estadisticas.estadisticas_eficiencia_terminal`, `inicio_ingles.menu_ingles`, `partials.agregar_profesor_plantilla`, `partials.insertar_horas`, `periodos_ingles`, `profesores_ingles.crear_periodo_calificacion`, `profesores_ingles.modificar_periodo_ingles_calificaciones`

</details>

### `auditorias` — 35 pantallas, 2 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `actividades_auditoria` | app (Bootstrap 3) | 163 | `GET /auditorias/actividades` | Personal (menú) | 3 form, 2 modal | Media |
| `agenda` | app (Bootstrap 3) | 546 | sin ruta directa | Personal (carpeta (estimado)) | 3 form, 1 modal, AJAX | Alta |
| `agenda2` | app (Bootstrap 3) | 677 | `GET /auditorias/agenda/{agenda}` | Personal (carpeta (estimado)) | 2 form, 2 modal, AJAX | Alta |
| `asignar_acciones` | app (Bootstrap 3) | 163 | `GET /auditorias/asignar_acciones` | Personal (carpeta (estimado)) | 2 form, 2 modal | Media |
| `asignar_lider` | app (Bootstrap 3) | 83 | `GET /auditorias/asignar_lider` | Personal (menú) | 2 form | Media |
| `auditor_nota` | app (Bootstrap 3) | 300 | `GET /auditorias/notas_auditor` | Personal (menú) | 1 form, 3 modal | Alta |
| `auditores` | app (Bootstrap 3) | 220 | `GET /auditorias/auditores` | Personal (menú) | 2 form, 1 modal, AJAX | Media |
| `edit_evento` | app (Bootstrap 3) | 381 | `GET /auditorias/evento/{evento}`<br>`GET /auditorias/editar_evento/{id}/{type}` | Personal (carpeta (estimado)) | 2 form, AJAX | Media |
| `edita_procesos_agenda` | app (Bootstrap 3) | 93 | `GET /auditorias/agenda/{id}/{fecha}/edit` | Personal (carpeta (estimado)) | 2 form | Media |
| `edita_procesos_evento` | app (Bootstrap 3) | 94 | `GET /auditorias/evento/{evento}/edit` | Personal (carpeta (estimado)) | 1 form | Baja |
| `editar_auditores_auditoria` | app (Bootstrap 3) | 200 | `GET /auditorias/auditores_asignados/{auditores_asignado}/edit` | Personal (carpeta (estimado)) | 2 form, 1 modal, AJAX | Media |
| `editar_procesosA` | app (Bootstrap 3) | 198 | `GET /auditorias/procesos_plan/{procesos_plan}` | Personal (carpeta (estimado)) | 2 form | Media |
| `generales` | app (Bootstrap 3) | 472 | `GET /auditorias/generales` | Personal (menú) | 6 form, 4 modal | Alta |
| `hoja_trabajo` | app (Bootstrap 3) | 279 | `GET /auditorias/hoja_trabajo/{hoja_trabajo}` | Personal (carpeta (estimado)) | 3 form, AJAX | Media |
| `informe` | app (Bootstrap 3) | 576 | `GET /auditorias/informe/{informe}` | Personal (carpeta (estimado)) | 2 form, 2 modal, fechas/calendario | Alta |
| `informe_estado` | app (Bootstrap 3) | 66 | `GET /auditorias/informe_estado` | Personal (carpeta (estimado)) | — | Baja |
| `lider_acciones` | app (Bootstrap 3) | 1390 | `GET /auditorias/lider_acciones` | Personal (menú) | 4 form, 4 modal | Alta |
| `normatividad` | app (Bootstrap 3) | 159 | sin ruta directa | Personal (carpeta (estimado)) | 4 form, 2 modal | Media |
| `notas_auditorias` | app (Bootstrap 3) | 404 | `GET /auditorias/acciones`<br>`GET /auditorias/conformidadesyacciones`<br>+1 | Personal (menú) | 2 modal | Media |
| `objetivos` | app (Bootstrap 3) | 159 | sin ruta directa | Personal (carpeta (estimado)) | 4 form, 2 modal | Media |
| `partials.unidad_proceso` | app (Bootstrap 3) | 108 | `GET /auditorias/procesos/{proceso}` | Personal (ctrl.) | 2 form, 1 modal | Media |
| `procesos` | app (Bootstrap 3) | 228 | `GET /auditorias/procesos` | Personal (menú) | 3 form, 2 modal, DataTables, AJAX | Alta |
| `procesos_auditoria` | app (Bootstrap 3) | 574 | `GET /auditorias/programas/{programa}/edit`<br>`GET /auditorias/responsables/{responsable}/edit` | Personal (carpeta (estimado)) | 6 form, 4 modal, fechas/calendario, AJAX | Alta |
| `programas` | app (Bootstrap 3) | 281 | `GET /auditorias/programas`<br>`GET /auditorias/programas/create` | Personal (menú) | 3 form, 1 modal, fechas/calendario | Media |
| `reporte_evidencia` | app (Bootstrap 3) | 636 | `GET /auditorias/informe_estado/{informe_estado}` | Personal (carpeta (estimado)) | 2 form, 2 modal, fechas/calendario | Alta |
| `reporte_nc_f16` | app (Bootstrap 3) | 931 | `GET /auditorias/lider_acciones/reporte_nc/{id_responsable}` | Personal (carpeta (estimado)) | 1 form, AJAX | Alta |
| `reporte_om` | app (Bootstrap 3) | 344 | `GET /auditorias/lider_acciones/reporte_om/{id_responsable}` | Personal (carpeta (estimado)) | 1 form | Media |
| `responsables_implantar` | app (Bootstrap 3) | 176 | `GET /auditorias/responsables_implementar` | Personal (menú) | 1 form, 1 modal | Media |
| `responsables_revisar` | app (Bootstrap 3) | 166 | `GET /auditorias/responsables_revisar` | Personal (menú) | 2 form, 2 modal | Media |
| `revisar_acciones` | app (Bootstrap 3) | 200 | `GET /auditorias/revisar_acciones` | Personal (carpeta (estimado)) | 2 form, 3 modal | Alta |
| `seguimiento` | app (Bootstrap 3) | 75 | `GET /auditorias/responsables` | Personal (menú) | — | Baja |
| `seguimiento_auditorias` | app (Bootstrap 3) | 593 | `GET /auditorias/seguimiento_auditorias` | Personal (menú) | 4 form | Alta |
| `seguimiento_informe` | app (Bootstrap 3) | 612 | `GET /auditorias/responsables/{responsable}` | Personal (carpeta (estimado)) | 4 form, 1 modal, fechas/calendario | Alta |
| `ver_plan` | app (Bootstrap 3) | 230 | `GET /auditorias/planes/{plane}` | Personal (carpeta (estimado)) | 2 form, 1 modal, fechas/calendario | Media |
| `ver_programa` | app (Bootstrap 3) | 271 | `GET /auditorias/programas/{programa}`<br>`GET /auditorias/responsables/{responsable}` | Personal (carpeta (estimado)) | 2 form, 2 modal, fechas/calendario | Media |

<details><summary>Parciales (2)</summary>

`calcula_horas_f`, `calcula_horas_i`

</details>

### `riesgos` — 26 pantallas, 8 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `addpartes` | app (Bootstrap 3) | 522 | `GET /riesgos/add_partes/{id_proceso}` | Personal (carpeta (estimado)) | 6 form, 5 modal, AJAX | Alta |
| `clasifica` | app (Bootstrap 3) | 184 | `GET /riesgos/clasifica` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `cronograma` | app (Bootstrap 3) | 184 | `GET /riesgos/seguimiento/tabla` | Personal (menú) | 6 form | Media |
| `decision` | app (Bootstrap 3) | 184 | `GET /riesgos/decision` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `detalle_oportunidad` | app (Bootstrap 3) | 547 | `GET /riesgos/regoportunidad/{regoportunidad}` | Personal (carpeta (estimado)) | 5 form, 4 modal, fechas/calendario, AJAX | Alta |
| `detalle_riesgo` | app (Bootstrap 3) | 388 | `GET /riesgos/registroriesgos/{id_regriesgo}` | Personal (carpeta (estimado)) | 3 form, 1 modal, AJAX | Media |
| `estrategia` | app (Bootstrap 3) | 176 | `GET /riesgos/estrategia` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `factor` | app (Bootstrap 3) | 183 | `GET /riesgos/factor` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `mejoracliente` | app (Bootstrap 3) | 224 | `GET /riesgos/mejoracliente` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `mejorareputacion` | app (Bootstrap 3) | 221 | `GET /riesgos/mejorareputacion` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `mejorasgc` | app (Bootstrap 3) | 220 | `GET /riesgos/mejorasgc` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `ocurrenciasp` | app (Bootstrap 3) | 223 | `GET /riesgos/ocurrenciasp` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `partes` | app (Bootstrap 3) | 186 | `GET /riesgos/partes` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `potencialapertura` | app (Bootstrap 3) | 218 | `GET /riesgos/potencialapertura` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `potencialcosto` | app (Bootstrap 3) | 182 | `GET /riesgos/potencialcosto` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `potencialcrecimiento` | app (Bootstrap 3) | 223 | `GET /riesgos/potencialcrecimiento` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `probabilidad` | app (Bootstrap 3) | 223 | `GET /riesgos/probabilidad` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `proceso` | app (Bootstrap 3) | 229 | `GET /riesgos/proceso` | Personal (menú) | — | Media |
| `registro_riesgos` | app (Bootstrap 3) | 213 | `GET /api/riesgos/registroriesgos` | Personal (carpeta (estimado)) | 1 form, 1 modal, Vue, AJAX | Alta |
| `ri_o_calificacion` | app (Bootstrap 3) | 182 | `GET /riesgos/calificacion` | Personal (menú) | 1 form, 1 modal, AJAX | Media |
| `riesgos` | app (Bootstrap 3) | 171 | `GET /api/searchriesgo`<br>`GET /riesgos/riesgo` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `seguimiento` | app (Bootstrap 3) | 235 | `GET /riesgos/seguimiento` | Personal (menú) | fechas/calendario, AJAX | Media |
| `selecciones` | app (Bootstrap 3) | 184 | `GET /riesgos/seleccion` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `sistema` | app (Bootstrap 3) | 186 | `GET /riesgos/sistema` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `tipoeva` | app (Bootstrap 3) | 184 | `GET /riesgos/tipoeva` | Personal (menú) | 3 form, 2 modal, AJAX | Media |
| `tipof` | app (Bootstrap 3) | 184 | `GET /riesgos/tipof` | Personal (menú) | 3 form, 2 modal, AJAX | Media |

<details><summary>Parciales (8)</summary>

`partials.edit_dates`, `partials.evaluacion_control`, `partials.factores`, `partials.modal_modi_desRiesgo`, `partials.modal_valoracion_efectos`, `partials.modals_acciones`, `partials.modals_control`, `partials.msg_ok`

</details>

### `incidencias` — 25 pantallas, 6 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `agregar` | app (Bootstrap 3) | 1351 | `GET /incidencias/solicitar_oficio` | Personal (menú) | 1 form, 1 modal, fechas/calendario, AJAX | Alta |
| `agregar_perido_dia_inc` | app (Bootstrap 3) | 100 | `GET /incidencias/cargar_otra_evidencia` | Personal (menú) | — | Baja |
| `articulos_evidencia` | app (Bootstrap 3) | 121 | `GET /incidencias/articulos_evidencia` | Personal (carpeta (estimado)) | 1 form, 1 modal, AJAX | Media |
| `cargar_evidencia` | app (Bootstrap 3) | 87 | `GET /incidencias/cargar_evidencia/{id_evid}` | Personal (carpeta (estimado)) | 1 form | Baja |
| `cargar_evidencia_otra` | app (Bootstrap 3) | 136 | `GET /incidencias/cargar_evidencia_tipo_fecha/{id_tipo_evid}/{tipo_fecha}`<br>`GET /incidencias/cargar_otra_evid_estado/{id_periodo}` | Personal (carpeta (estimado)) | 1 form, fechas/calendario | Media |
| `cargar_evidencia_otra2` | app (Bootstrap 3) | 161 | `GET /incidencias/cargar_evidencia_tipo_fecha/{id_tipo_evid}/{tipo_fecha}` | Personal (carpeta (estimado)) | 1 form, fechas/calendario | Media |
| `cargar_oficio` | app (Bootstrap 3) | 62 | `GET /incidencias/cargar_oficio/{id_oficio}` | Personal (carpeta (estimado)) | 1 form | Baja |
| `director_validar` | app (Bootstrap 3) | 106 | `GET /incidencias/validar_oficios_departamentos` | Personal (menú) | 1 modal, DataTables, AJAX | Media |
| `editar_evidencia` | app (Bootstrap 3) | 193 | `GET /incidencias/editar_evidencia/{id_evid}` | Personal (carpeta (estimado)) | 1 form, 3 modal, AJAX | Alta |
| `editar_evidencia2` | app (Bootstrap 3) | 204 | `GET /incidencias/editar_evidencia2/{id_evid}` | Personal (carpeta (estimado)) | 1 form, 3 modal, AJAX | Alta |
| `editar_evidencia_oficio` | app (Bootstrap 3) | 135 | `GET /incidencias/editar_evidencia_oficio/{id_evid}` | Personal (carpeta (estimado)) | 1 form, 1 modal, AJAX | Media |
| `editar_oficio_autiruzar` | app (Bootstrap 3) | 120 | `GET /incidencias/editar_oficio_firmado/{id_solicitud}` | Personal (carpeta (estimado)) | 1 form, 1 modal | Media |
| `historial_docentesEv` | app (Bootstrap 3) | 72 | `GET /incidencias/historial_docentesEv` | Personal (menú) | DataTables | Media |
| `historial_docentesSo` | app (Bootstrap 3) | 222 | `GET /incidencias/historial_docentesSo` | Personal (menú) | 3 modal, DataTables, AJAX | Alta |
| `historial_evidencia_conocimiento` | app (Bootstrap 3) | 119 | `GET /incidencias/historial_evidencias_conocimient/{id_personal}`<br>`GET /incidencias/historial_evid_personal` | Personal (menú) | DataTables | Media |
| `historial_evidencias` | app (Bootstrap 3) | 86 | `GET /incidencias/historial_evidencias` | Personal (menú) | DataTables | Media |
| `historial_oficio` | app (Bootstrap 3) | 122 | `GET /incidencias/historial_oficios` | Personal (menú) | 1 modal, DataTables, AJAX | Media |
| `historial_oficio_autorizados` | app (Bootstrap 3) | 124 | `GET /incidencias/historial_oficios_autorizados` | Personal (menú) | 1 modal, DataTables, AJAX | Media |
| `historiales_direct_valida` | app (Bootstrap 3) | 120 | `GET /incidencias/validar_oficios_direct_historial` | Personal (enlace) | 1 modal, DataTables, AJAX | Media |
| `reportes_quincenales` | app (Bootstrap 3) | 241 | `GET /incidencias/reportes_incidencias`<br>`GET /incidencias/reportes_incidencias_ver/{id_articulo}/{fecha_inicial}/{fecha_final}/{estado}` | Personal (menú) | 1 form, DataTables, fechas/calendario | Media |
| `validacion_historial` | app (Bootstrap 3) | 130 | `GET /incidencias/validar_oficios/historial` | Personal (enlace) | 1 modal, DataTables, AJAX | Media |
| `validacion_historial_oficios_depart` | app (Bootstrap 3) | 130 | `GET /incidencias/validar_oficios_departamentos/historial` | Personal (enlace) | 1 modal, DataTables, AJAX | Media |
| `validar_aca_finanzas` | app (Bootstrap 3) | 136 | `GET /incidencias/validar_oficios_dep_acad_finanzas` | Personal (menú) | 1 modal, DataTables, AJAX | Media |
| `validar_evidencia_departamentos` | app (Bootstrap 3) | 113 | `GET /incidencias/validar_evidencia_departamentos` | Personal (menú) | 1 modal, DataTables, AJAX | Media |
| `validar_oficios` | app (Bootstrap 3) | 136 | `GET /incidencias/validar_oficios` | Personal (menú) | 1 modal, DataTables, AJAX | Media |

<details><summary>Parciales (6)</summary>

`agregar_evidencia_oficio`, `agregar_oficio_firmado`, `datos_oficio_evidencia`, `modal_ver`, `partials_mod_evidencia`, `partials_mod_evidencia2`

</details>

### `examen_egel` — 20 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `admin.alumno` | app (Bootstrap 3) | 164 | `GET /admin/egel/alumno` | Desarrollo (carpeta (estimado)) | — | Media |
| `admin.dashboard` | app (Bootstrap 3) | 49 | `GET /examen_egel/admin/dashboard` | Desarrollo (menú) | — | Baja |
| `admin.examenes.completo` | app (Bootstrap 3) | 139 | sin ruta directa | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.create` | app (Bootstrap 3) | 49 | `GET /admin/examen/create` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.edit` | app (Bootstrap 3) | 72 | `GET /admin/examen/edit/{id_examen_egel}` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.edit_pregunta` | app (Bootstrap 3) | 115 | `GET /admin/pregunta/edit/{id_pregunta}` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.edit_respuesta` | app (Bootstrap 3) | 108 | `GET /admin/respuesta/edit/{id_respuesta}` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.index` | app (Bootstrap 3) | 107 | `GET /admin/examenes` | Sin enlace en el menú (—) | — | Baja |
| `admin.examenes.preguntas` | app (Bootstrap 3) | 194 | `GET /examen/{id_examen_egel}/preguntas` | Sin enlace en el menú (—) | — | Media |
| `admin.examenes.rapido` | app (Bootstrap 3) | 198 | `GET /admin/examen/rapido/{id_examen_egel}` | Sin enlace en el menú (—) | 1 form | Media |
| `admin.periodos.edit` | app (Bootstrap 3) | 222 | `GET /admin/periodos/editar/{id_periodo_examen}` | Sin enlace en el menú (—) | 2 form | Media |
| `admin.periodos.index` | app (Bootstrap 3) | 291 | `GET /admin/periodos` | Sin enlace en el menú (—) | 3 form | Media |
| `admin.resultados` | app (Bootstrap 3) | 156 | `GET /admin/egel/resultados` | Desarrollo (carpeta (estimado)) | — | Media |
| `dashboard` | app (Bootstrap 3) | 243 | `GET /examen_egel/dashboard` | Alumno (menú) | — | Media |
| `dashboard-resultados` | app (Bootstrap 3) | 142 | `GET /egel/resultados` | Alumno (carpeta (estimado)) | — | Baja |
| `reporte_resultados` | app (Bootstrap 3) | 140 | `GET /egel/reporte-final` | Alumno (carpeta (estimado)) | — | Baja |
| `seccion1.finalizada` | app (Bootstrap 3) | 38 | `GET /egel/seccion/{id_seccion}/finalizada` | Sin enlace en el menú (—) | — | Baja |
| `seccion1.index` | app (Bootstrap 3) | 51 | `GET /egel/seccion/{id_seccion}` | Sin enlace en el menú (—) | — | Baja |
| `seccion1.pregunta` | app (Bootstrap 3) | 73 | `GET /egel/seccion/{id_seccion}/pregunta` | Sin enlace en el menú (—) | 1 form | Baja |
| `seccion1.transicion` | app (Bootstrap 3) | 44 | `POST /egel/seccion/{id_seccion}/responder` | Sin enlace en el menú (—) | — | Baja |

### `examen_gnral_con` — 19 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `admin.docentes_resultados` | app (Bootstrap 3) | 132 | `GET /admin/examen_general/ver_resultados_docentes` | Desarrollo (carpeta (estimado)) | DataTables | Media |
| `admin.examenes.create` | app (Bootstrap 3) | 80 | `GET /admin/examen_general/create` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.edit` | app (Bootstrap 3) | 72 | `GET /admin/examen_general/edit/{id_examen_egel}` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.edit_pregunta` | app (Bootstrap 3) | 79 | `GET /admin/examen_general/pregunta/edit/{id_pregunta}` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.edit_respuesta` | app (Bootstrap 3) | 65 | `GET /admin/examen_general/respuesta/edit/{id_respuesta}` | Sin enlace en el menú (—) | 1 form | Baja |
| `admin.examenes.index` | app (Bootstrap 3) | 135 | `GET /admin/examenes_generales` | Sin enlace en el menú (—) | — | Baja |
| `admin.examenes.preguntas` | app (Bootstrap 3) | 175 | `GET /examen_general/{id_examen_egel}/preguntas` | Sin enlace en el menú (—) | — | Media |
| `admin.examenes.rapido` | app (Bootstrap 3) | 198 | `GET /admin/examen_general/rapido/{id_examen_egel}` | Sin enlace en el menú (—) | 1 form | Media |
| `admin.guardar_docentes` | app (Bootstrap 3) | 219 | `GET /admin/examen_general/nuevos_docentes` | Desarrollo (carpeta (estimado)) | 1 form, DataTables | Media |
| `admin.index` | app (Bootstrap 3) | 158 | `GET /admin_examen_conocimientos` | Desarrollo (menú) | — | Media |
| `admin.periodos.edit` | app (Bootstrap 3) | 222 | `GET /admin/examen_general/periodos/editar/{id_periodo_examen}` | Sin enlace en el menú (—) | 2 form | Media |
| `admin.periodos.index` | app (Bootstrap 3) | 291 | `GET /admin/examen_general/periodos` | Sin enlace en el menú (—) | 3 form | Media |
| `admin.resultados` | app (Bootstrap 3) | 500 | `GET /admin/examen_general/resultados` | Desarrollo (carpeta (estimado)) | 2 form, 2 modal, DataTables | Media |
| `dashboard-resultados` | app (Bootstrap 3) | 377 | `GET /examen_general/resultados` | BD/ids (carpeta (estimado)) | — | Media |
| `index_examen` | app (Bootstrap 3) | 254 | `GET /docentes/create`<br>`GET /examen_conocimientos` | BD/ids (menú) | — | Media |
| `seccion1.finalizada` | app (Bootstrap 3) | 38 | `GET /examen_general/seccion/{id_seccion}/finalizada` | Sin enlace en el menú (—) | — | Baja |
| `seccion1.index` | app (Bootstrap 3) | 65 | `GET /examen_general/seccion/{id_seccion}` | Sin enlace en el menú (—) | — | Baja |
| `seccion1.pregunta` | app (Bootstrap 3) | 73 | `GET /examen_general/seccion/{id_seccion}/pregunta` | Sin enlace en el menú (—) | 1 form | Baja |
| `seccion1.transicion` | app (Bootstrap 3) | 44 | `POST /examen_general/seccion/{id_seccion}/responder` | Sin enlace en el menú (—) | — | Baja |

### `ambiental` — 18 pantallas, 40 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `encargado_amb.activo_periodo` | app (Bootstrap 3) | 39 | `GET /ambiental/enviar_documentacion` | BD/ids (menú) | — | Baja |
| `encargado_amb.desactivo_periodo` | app (Bootstrap 3) | 33 | `GET /ambiental/enviar_documentacion` | BD/ids (menú) | — | Baja |
| `encargado_amb.historial_envio_documentacion` | app (Bootstrap 3) | 151 | `GET /ambiental/historial_documentacion` | BD/ids (menú) | Vue, AJAX | Alta |
| `encargado_amb.procedimiento_doc` | app (Bootstrap 3) | 1631 | `GET /ambiental/ver_estado_documentacion/{id_encargado}` | BD/ids (carpeta (estimado)) | Vue, AJAX | Alta |
| `encargado_amb.ver_doc_autorizada_dep` | app (Bootstrap 3) | 1984 | `GET /ambiental/ver_doc_encargado_dep_aut/{id_documentacion_encar}` | BD/ids (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_ambiental.agregar_doc_entregar` | app (Bootstrap 3) | 654 | `GET /ambiental/ver_proc_encargado_doc/{id_periodo}/{id_encargado}` | Por unidad (carpeta (estimado)) | 3 modal, Vue, AJAX | Alta |
| `jefe_ambiental.autorizar_documentacion` | app (Bootstrap 3) | 159 | `GET /ambiental/ver_documentacion_ambiental` | Por unidad (menú) | Vue, AJAX | Alta |
| `jefe_ambiental.documentacion_autorizada` | app (Bootstrap 3) | 116 | `GET /ambiental/documentacion_autorizada` | Por unidad (enlace) | Vue, AJAX | Alta |
| `jefe_ambiental.documentacion_modificacion` | app (Bootstrap 3) | 54 | `GET /ambiental/proceso_de_modificacion` | Por unidad (enlace) | — | Baja |
| `jefe_ambiental.encargado_procedimientos` | app (Bootstrap 3) | 183 | `GET /ambiental/ver_encargados` | Por unidad (menú) | Vue, AJAX | Alta |
| `jefe_ambiental.evaluar_doc_modificada` | app (Bootstrap 3) | 1976 | `GET /ambiental/documentacion_encar_mod/{id_documentacion_encar}` | Por unidad (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_ambiental.evaluar_documentacion1` | app (Bootstrap 3) | 1993 | `GET /ambiental/documentacion_encar/{id_documentacion_encar}` | Por unidad (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_ambiental.historial_documentacion` | app (Bootstrap 3) | 151 | `GET /ambiental/historial_ambiental_departamento` | Por unidad (menú) | Vue, AJAX | Alta |
| `jefe_ambiental.historial_ver_doc_encargado` | app (Bootstrap 3) | 1984 | `GET /ambiental/ver_doc_encargado_aut/{id_documentacion_encar}` | Por unidad (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_ambiental.periodos_ambiental` | app (Bootstrap 3) | 191 | `GET /ambiental/ver_periodos` | Por unidad (menú) | Vue, AJAX | Alta |
| `jefe_ambiental.procedimientos` | app (Bootstrap 3) | 163 | `GET /ambiental/ver_procedimientos` | Por unidad (menú) | Vue, AJAX | Alta |
| `jefe_ambiental.ver_doc_autorizada` | app (Bootstrap 3) | 1984 | `GET /ambiental/ver_doc_autorizada_departamento/{id_documentacion_encar}` | Por unidad (carpeta (estimado)) | Vue, AJAX | Alta |
| `jefe_ambiental.ver_procedimientos_encargados` | app (Bootstrap 3) | 137 | `GET /ambiental/ver_proc_ambiental/{id_periodo}` | Por unidad (carpeta (estimado)) | Vue, AJAX | Alta |

<details><summary>Parciales (40)</summary>

`encargado_amb.condicionante_envio`, `encargado_amb.correcciones_procedimiento_doc`, `encargado_amb.modal_doc_1`, `encargado_amb.modal_doc_10`, `encargado_amb.modal_doc_11`, `encargado_amb.modal_doc_12`, `encargado_amb.modal_doc_13`, `encargado_amb.modal_doc_14`, `encargado_amb.modal_doc_2`, `encargado_amb.modal_doc_3`, `encargado_amb.modal_doc_4`, `encargado_amb.modal_doc_5`, `encargado_amb.modal_doc_6`, `encargado_amb.modal_doc_7`, `encargado_amb.modal_doc_8`, `encargado_amb.modal_doc_9`, `encargado_amb.modal_enviar_documentacion`, `encargado_amb.modal_enviar_modificacion_doc`, `jefe_ambiental.activar_periodo`, `jefe_ambiental.agregar_encargado`, `jefe_ambiental.autorizacion_documentacion`, `jefe_ambiental.crear_procedimiento`, `jefe_ambiental.desactivar_periodo`, `jefe_ambiental.enviar_correcciones`, `jefe_ambiental.modificar_encargado`, `jefe_ambiental.validacion_envio`, `jefe_ambiental.validar_doc1`, `jefe_ambiental.validar_doc10`, `jefe_ambiental.validar_doc11`, `jefe_ambiental.validar_doc12`, `jefe_ambiental.validar_doc13`, `jefe_ambiental.validar_doc14`, `jefe_ambiental.validar_doc2`, `jefe_ambiental.validar_doc3`, `jefe_ambiental.validar_doc4`, `jefe_ambiental.validar_doc5`, `jefe_ambiental.validar_doc6`, `jefe_ambiental.validar_doc7`, `jefe_ambiental.validar_doc8`, `jefe_ambiental.validar_doc9`

</details>

### `actividades_complementarias` — 17 pantallas, 5 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `alumnos.carga_evidencias_alumnos` | app (Bootstrap 3) | 116 | `GET /evidencias_alumnos` | Alumno (menú) | 1 form | Baja |
| `alumnos.consulta_reg_actividades` | app (Bootstrap 3) | 341 | `GET /consulta_actividades`<br>`GET /consulta_actividades/{consulta_actividade}/edit` | Alumno (menú) | 4 form, 5 modal | Alta |
| `alumnos.creditos_semestres` | app (Bootstrap 3) | 44 | `GET /creditos` | Alumno (menú) | 1 form | Baja |
| `alumnos.liberacion_actividades` | app (Bootstrap 3) | 46 | `GET /liberacion_alumno` | Alumno (menú) | 1 form | Baja |
| `alumnos.mensajes` | app (Bootstrap 3) | 32 | `GET /docente_actividad`<br>`GET /evidencias_alumnos`<br>+2 | Alumno, Doc. c/act., Jefe div. (menú) | — | Baja |
| `jefatura.alumnos_act` | app (Bootstrap 3) | 268 | `GET /alumnos_actividades` | Jefe div. (menú) | 1 modal, DataTables | Media |
| `jefatura.constancia_general` | app (Bootstrap 3) | 54 | `GET /constancia_gen` | Jefe div. (menú) | 1 form, DataTables | Media |
| `jefatura.datos_historicos` | app (Bootstrap 3) | 60 | `GET /datos_historicos` | Jefe div. (carpeta (estimado)) | 1 form, DataTables | Media |
| `jefatura.docente_actividad` | app (Bootstrap 3) | 231 | `GET /docente_actividad`<br>`GET /docente_actividad/{docente_actividad}/edit` | Jefe div. (menú) | 2 form, 2 modal, AJAX | Media |
| `jefatura.imprimir_constancias` | app (Bootstrap 3) | 240 | `GET /constancias` | Jefe div. (menú) | 1 modal, DataTables | Media |
| `jefatura.liberacion_planeacion` | app (Bootstrap 3) | 209 | `GET /libera_planeacion` | Jefe div. (menú) | 1 modal | Media |
| `profesor.index` | app (Bootstrap 3) | 93 | `GET /consulta_general`<br>`GET /consulta_general/{consulta_general}/edit` | Doc. c/act. (menú) | 1 form, DataTables | Media |
| `profesor.planeacion_actividad` | app (Bootstrap 3) | 251 | `GET /planeacion_actividad`<br>`GET /planeacion_actividad/{planeacion_actividad}/edit` | Doc. c/act. (menú) | 2 form, 3 modal | Alta |
| `subdireccion.agregar_actividades` | app (Bootstrap 3) | 298 | `GET /nueva_actividad`<br>`GET /nueva_actividad/{nueva_actividad}/edit` | Dir./Consultas (menú) | 3 form, 3 modal, DataTables, AJAX | Alta |
| `subdireccion.datos_estadisticos` | app (Bootstrap 3) | 101 | `GET /datos_estadisticos` | Dir./Consultas (menú) | 1 form, gráficas | Alta |
| `subdireccion.datos_graficos_historicos` | app (Bootstrap 3) | 103 | `GET /datos_historicos_graficos` | Dir./Consultas (menú) | 1 form, gráficas | Alta |
| `subdireccion.solicitud_alumnos` | app (Bootstrap 3) | 231 | `GET /solicitud_alumnos` | Dir./Consultas (menú) | 1 modal, DataTables | Media |

<details><summary>Parciales (5)</summary>

`partials_actividades.alumno.editar_actividad_alumno`, `partials_actividades.jefatura.editar_docente`, `partials_actividades.profesor.editar_planeacion`, `partials_actividades.subdireccion.editar_actividad`, `profesor.evaluacion_evidencias`

</details>

### `evaluacion_docente` — 15 pantallas, 3 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `Admin.reporte_comentario_docente` | app (Bootstrap 3) | 121 | `GET /reporte_comentario_docente/{id_docente}` | Desarrollo (enlace) | DataTables | Media |
| `Admin.reporte_comentarios` | app (Bootstrap 3) | 44 | `GET /comentarios_docentes` | Desarrollo (menú) | DataTables | Media |
| `Admin.validacion_de_carga` | app (Bootstrap 3) | 423 | `GET /duales/validacion_de_carga`<br>`GET /servicios_escolares/duales/validacion_de_carga`<br>+1 | Escolar/Dir. (menú) | 3 form, 2 modal, DataTables | Alta |
| `Admin.ver_comentarios_eva_doc` | app (Bootstrap 3) | 62 | `GET /ver_comentario_docente/{id_docente}/{id_grupo}/{grupo}/{id_materia}` | Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir. (carpeta (estimado)) | DataTables | Media |
| `Alumnos.calificaciones` | app (Bootstrap 3) | 135 | `GET /calificaciones` | Alumno (menú) | — | Baja |
| `Alumnos.calificaciones_alumno` | app (Bootstrap 3) | 254 | `GET /servicios_escolares/alumnos/mostrar_calificaciones/{id_alumno}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | 1 form, 2 modal, fechas/calendario | Media |
| `Alumnos.carga_academica` | app (Bootstrap 3) | 570 | `GET /carga_academica`<br>`GET /reticulas/{reti}` | Alumno (menú) | — | Alta |
| `Alumnos.cct` | app (Bootstrap 3) | 84 | `GET /datos_alumno` | Alumno (menú) | 1 form, DataTables | Media |
| `Alumnos.checar_carga` | app (Bootstrap 3) | 1646 | `GET /checar`<br>`GET /checar_carga`<br>+5 | Alumno (menú) | 4 form, 3 modal, AJAX | Alta |
| `Alumnos.datos_alumno` | app (Bootstrap 3) | 1583 | `GET /datos_alumno` | Alumno (menú) | 1 form, fechas/calendario, AJAX | Alta |
| `Alumnos.datos_generales_alumnos` | app (Bootstrap 3) | 119 | `GET /servicios_escolares/alumnos/carrera`<br>`GET /servicios_escolares/alumnos/generales/{id}` | Escolar/Dir. (menú) | 1 modal, DataTables, AJAX | Media |
| `Alumnos.editar_cct` | app (Bootstrap 3) | 104 | `GET /datos_alumnos/modificar_cct/{id_alumno}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | 1 form, DataTables | Media |
| `Alumnos.mensages2` | app (Bootstrap 3) | 37 | `POST /datos_alumno` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | — | Baja |
| `Alumnos.promedio_academico` | app (Bootstrap 3) | 31 | `GET /alumno/academico/cal` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Baja |
| `escuelas.escuelas_cct` | app (Bootstrap 3) | 214 | `GET /cct/registros` | Escolar/Dir. (menú) | 2 form, 2 modal, DataTables, AJAX | Media |

<details><summary>Parciales (3)</summary>

`Alumnos.editar_carga`, `Alumnos.ver_alumnos_datos`, `escuelas.editar_escuela`

</details>

### `duales` — 14 pantallas, 1 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `Agregar_docentes_duales` | app (Bootstrap 3) | 359 | `GET /duales/Agregar_docentes_duales` | Jefe div. (menú) | 2 form, 2 modal, DataTables | Media |
| `Gestion_Academica.alumnos_duales` | app (Bootstrap 3) | 60 | `GET /duales/gestion_academica/alumnos/{id_personal}` | Escolar/Dir. (carpeta (estimado)) | DataTables | Media |
| `Gestion_Academica.carreras_duales` | app (Bootstrap 3) | 32 | `GET /duales/gestion_academica` | Escolar/Dir. (menú) | — | Baja |
| `Gestion_Academica.docentes_duales` | app (Bootstrap 3) | 66 | `GET /duales/gestion_academica/docentes/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | DataTables | Media |
| `Gestion_Academica.mostrar_calificaciones_duales` | app (Bootstrap 3) | 82 | `GET /duales/gestion_academica/mostrar_calificaciones_duales/{id_carga}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `Mentor_Dual_Calificar.calificar_duales` | app (Bootstrap 3) | 61 | `GET /duales/mentor_calificar` | Doc. c/act. (menú) | DataTables | Media |
| `Mentor_Dual_Calificar.calificar_estudiante_dual` | app (Bootstrap 3) | 164 | `GET /duales/calificar_estudiante/{id_carga}` | Doc. c/act. (carpeta (estimado)) | 2 form, 2 modal, AJAX | Media |
| `agregar_alumnos_dual` | app (Bootstrap 3) | 697 | `GET /duales/agregar_alumnos_dual` | Jefe div. (menú) | 3 form, 3 modal, DataTables | Alta |
| `checar_carga_academica` | app (Bootstrap 3) | 1170 | `GET /duales/checar_carga_academica`<br>`GET /duales/revision_control_escolar/{id_alumno}`<br>+1 | Jefe div. (carpeta (estimado)) | 2 form, 1 modal | Alta |
| `concentrado_calificaciones_duales.concentrado_calificaciones` | app (Bootstrap 3) | 30 | `GET /duales/concentrado_calificaciones_duales` | Escolar/Dir. (menú) | — | Baja |
| `concentrado_calificaciones_duales.concentrado_materias` | app (Bootstrap 3) | 63 | `GET /duales/concentrado_calificaciones_duales/materias/{id_carrera}/{id_semestre}/{id_grupo}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `concentrado_calificaciones_duales.concentrado_semestres` | app (Bootstrap 3) | 34 | `GET /duales/concentrado_calificaciones_duales/semestres/{id_carrera}` | Escolar/Dir. (carpeta (estimado)) | — | Baja |
| `dual_mensages` | app (Bootstrap 3) | 45 | `GET /duales/checar_carga_academica` | Jefe div. (carpeta (estimado)) | — | Baja |
| `llenar_carga_academica_dual` | app (Bootstrap 3) | 1006 | `GET /duales/llenar_carga_academica_dual` | Jefe div. (menú) | 2 form, 2 modal, DataTables, AJAX | Alta |

<details><summary>Parciales (1)</summary>

`partials.materias`

</details>

### `RMateriales` — 11 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `RMCategorias.agregarcate` | app (Bootstrap 3) | 274 | `GET /Categorias` | Por unidad (menú) | 4 form, 4 modal | Alta |
| `bienes` | app (Bootstrap 3) | 497 | `GET /Buscar-Bien`<br>`GET /Bienes` | Por unidad (menú) | 5 form, 4 modal | Alta |
| `excelbienes` | app (Bootstrap 3) | 41 | `GET /Reportes` | Por unidad (menú) | — | Baja |
| `listadoareas` | app (Bootstrap 3) | 44 | `GET /Areas` | Por unidad (menú) | — | Baja |
| `marcas` | app (Bootstrap 3) | 203 | `GET /Buscar-Marca`<br>`GET /Marcas` | Por unidad (menú) | 5 form, 4 modal | Alta |
| `modelos` | app (Bootstrap 3) | 179 | `GET /Buscar-Modelo`<br>`GET /Modelos` | Por unidad (menú) | 5 form, 4 modal | Alta |
| `padronbienes` | app (Bootstrap 3) | 83 | `GET /Resguardos-Padron` | Por unidad (menú) | 1 form | Baja |
| `provedores` | app (Bootstrap 3) | 224 | `GET /Buscar-Provedor`<br>`GET /Provedores` | Por unidad (menú) | 5 form, 4 modal | Alta |
| `resguardos` | app (Bootstrap 3) | 235 | `GET /Buscar-Resguardo`<br>`GET /Resguardos` | Por unidad (menú) | 3 form, 2 modal | Media |
| `resguardost` | app (Bootstrap 3) | 71 | `GET /Resguardos-Consulta` | Por unidad (menú) | 1 form | Baja |
| `sectorauxs` | app (Bootstrap 3) | 248 | `GET /SectorAux` | Por unidad (menú) | 4 form, 3 modal | Alta |

### `generales` — 11 pantallas, 9 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `aulas` | app (Bootstrap 3) | 218 | `GET /generales/aulas`<br>`GET /generales/aulas/{aula}/edit` | Jefe div., Dir./Consultas (menú) | 2 form, 2 modal, DataTables | Media |
| `cargos` | app (Bootstrap 3) | 171 | `GET /generales/cargos`<br>`GET /generales/cargos/{cargo}/edit` | Dir./Consultas, RH (menú) | 3 form, 2 modal | Media |
| `carreras` | app (Bootstrap 3) | 186 | `GET /generales/carreras`<br>`GET /generales/carreras/{carrera}/edit` | Dir./Consultas (menú) | 3 form, 2 modal | Media |
| `edificios` | app (Bootstrap 3) | 179 | `GET /generales/edificios`<br>`GET /generales/edificios/{edificio}/edit` | Jefe div., Dir./Consultas (menú) | 3 form, 2 modal | Media |
| `extra_clase` | app (Bootstrap 3) | 148 | `GET /generales/extra_clases`<br>`GET /generales/extra_clases/{extra_clase}/edit` | Dir./Consultas (menú) | 3 form, 2 modal | Media |
| `jefaturas` | app (Bootstrap 3) | 199 | `GET /generales/jefaturas`<br>`GET /generales/jefaturas/{jefatura}/edit` | Dir./Consultas (menú) | 3 form, 2 modal | Media |
| `jefe_unidad_administrativa` | app (Bootstrap 3) | 222 | `GET /generales/jefe_unidad_administrativa` | Dir./Consultas (menú) | 3 form, 2 modal, AJAX | Media |
| `perfiles` | app (Bootstrap 3) | 158 | `GET /generales/perfiles`<br>`GET /generales/perfiles/{perfile}/edit` | Jefe div., Dir./Consultas (menú) | 3 form, 2 modal, DataTables | Alta |
| `situaciones` | app (Bootstrap 3) | 173 | `GET /generales/situaciones`<br>`GET /generales/situaciones/{situacione}/edit` | Jefe div., Dir./Consultas (menú) | 3 form, 2 modal | Media |
| `tipo_personales` | app (Bootstrap 3) | 148 | `GET /generales/personales`<br>`GET /generales/personales/{personale}/edit` | Jefe div., Dir./Consultas, RH (carpeta (estimado)) | 3 form, 2 modal | Media |
| `unidad_administrativa` | app (Bootstrap 3) | 222 | `GET /generales/unidad_administrativa` | Dir./Consultas (menú) | 3 form, 2 modal, AJAX | Media |

<details><summary>Parciales (9)</summary>

`partialsg.partial_mo_aula`, `partialsg.partial_mo_cargo`, `partialsg.partial_mo_carrera`, `partialsg.partial_mo_edificio`, `partialsg.partial_mo_extraclase`, `partialsg.partial_mo_jefe`, `partialsg.partial_mo_perfil`, `partialsg.partial_mo_personal`, `partialsg.partial_mo_situacion`

</details>

### `servicio_social` — 10 pantallas, 8 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `departamento_servicio.doc_enviar_alumno.envio_carta_presentacion` | app (Bootstrap 3) | 229 | `GET /servicio_social/enviocartapresentacionalumno/alumno` | Alumno (menú) | 3 form, 2 modal | Media |
| `departamento_servicio.doc_enviar_alumno.estado_carta_presentacion` | app (Bootstrap 3) | 109 | `GET /servicio_social/enviocartapresentacionalumno/alumno` | Alumno (menú) | — | Baja |
| `departamento_servicio.doc_enviar_alumno.modificacion_carta_presentacion` | app (Bootstrap 3) | 204 | `GET /servicio_social/enviocartapresentacionalumno/alumno` | Alumno (menú) | 2 form, 2 modal | Media |
| `departamento_servicio.documentos_alumnos.estado_constancia_presentacion` | app (Bootstrap 3) | 277 | `GET /servicio_social/ingresar_contancia/departamento` | Residencias (menú) | 1 form, 4 modal, DataTables, AJAX | Alta |
| `departamento_servicio.documentos_alumnos.proceso_autorizacion_carta_presentacion` | app (Bootstrap 3) | 121 | `GET /servicio_social/proceso_autorizadas_cartapresentacion/departamento` | Residencias (enlace) | 1 form, 1 modal, DataTables | Media |
| `departamento_servicio.documentos_alumnos.proceso_modificacion_carta_presentacion` | app (Bootstrap 3) | 75 | `GET /servicio_social/proceso_modificacion_cartapresentacion/departamento` | Residencias (enlace) | — | Baja |
| `departamento_servicio.documentos_alumnos.proceso_revicion_carta_presentacion` | app (Bootstrap 3) | 169 | `GET /servicio_social/proceso_revicion_cartapresentacion/departamento` | Residencias (enlace) | 1 form, 2 modal, DataTables, AJAX | Media |
| `departamento_servicio.revision_documentacion_primera_etapa` | app (Bootstrap 3) | 267 | `GET /servicio_social/departamento_revision_primera_etapa` | Residencias (menú) | 3 modal, DataTables, AJAX | Alta |
| `primera_etapa.modificacion_documentacion` | app (Bootstrap 3) | 664 | `GET /servicio_social/docuemtacion_priemra_etapa` | Alumno (menú) | 7 form, 7 modal | Alta |
| `primera_etapa.registro_tipo_empresa` | app (Bootstrap 3) | 943 | `GET /servicio_social/docuemtacion_priemra_etapa` | Alumno (menú) | 20 form, 9 modal, AJAX | Alta |

<details><summary>Parciales (8)</summary>

`departamento_servicio.autorizacion_modifcacion_primera_etapa`, `departamento_servicio.autorizacion_primera_etapa`, `departamento_servicio.doc_enviar_alumno.partials_modificacion_carta_presentacion`, `departamento_servicio.documentos_alumnos.modificar_carta_presentacion`, `departamento_servicio.documentos_alumnos.registra_constancia`, `departamento_servicio.documentos_alumnos.ver_carta_presentacion`, `departamento_servicio.documentos_autorizados_serv`, `primera_etapa.partials.modificar_datos_alumno`

</details>

### `centro_computo` — 9 pantallas, 2 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `agregar_pdf_informe` | app (Bootstrap 3) | 121 | `GET /centro_computo/informes_titulacion` | Cómputo, Titulación (menú) | 1 form, 1 modal, DataTables, AJAX | Media |
| `registrar_usuarios.estudiantes` | app (Bootstrap 3) | 143 | `GET /centro_computo/ver_usuario_estudiante` | Cómputo (menú) | 2 form, 2 modal, DataTables, AJAX | Media |
| `registrar_usuarios.facilitadores` | app (Bootstrap 3) | 143 | `GET /centro_computo/ver_usuario_facilitadores` | Cómputo (menú) | 2 form, 2 modal, DataTables, AJAX | Media |
| `registrar_usuarios.notificacion_usuario` | app (Bootstrap 3) | 23 | `POST /centro_computo/verificar_usuario` | Cómputo (enlace) | — | Baja |
| `registrar_usuarios.notificacion_usuarios_reg` | app (Bootstrap 3) | 22 | `GET /centro_computo/notificacion_datos_reg` | Cómputo (carpeta (estimado)) | — | Baja |
| `registrar_usuarios.personal_tesvb` | app (Bootstrap 3) | 143 | `GET /centro_computo/ver_usuario_personal_tesvb` | Cómputo (menú) | 2 form, 2 modal, DataTables, AJAX | Media |
| `registrar_usuarios.registrar_usuario` | app (Bootstrap 3) | 37 | `GET /centro_computo/registro_estudiantes_correo` | Cómputo (menú) | 1 form | Baja |
| `registrar_usuarios.usuario_per` | app (Bootstrap 3) | 82 | `GET /centro_computo/agregar_usuario_per` | Cómputo (carpeta (estimado)) | 1 form, 1 modal, DataTables, AJAX | Media |
| `registrar_usuarios.verificacion_user` | app (Bootstrap 3) | 50 | `GET /centro_computo/usuario` | Cómputo (menú) | 1 form | Baja |

<details><summary>Parciales (2)</summary>

`registrar_usuarios.datos_usuario`, `registrar_usuarios.ver_reg_eliminar_user`

</details>

### `comision_oficio` — 9 pantallas, 6 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `evaluacion_oficio` | app (Bootstrap 3) | 176 | `GET /oficios/evaluacion` | RH (menú) | 1 form, 1 modal, DataTables, AJAX | Media |
| `historial_oficios_enviado` | app (Bootstrap 3) | 144 | `GET /oficios/historialoficios` | Por unidad (enlace) | 1 form, 2 modal, DataTables, AJAX | Media |
| `historial_oficios_profesores` | app (Bootstrap 3) | 185 | `GET /oficios/evaluacion/historialprofesores`<br>`GET /oficios/evaluacion/historial_mostrar_profesores/{id_anos}` | Por unidad (enlace) | 1 modal, DataTables, AJAX | Media |
| `historial_oficios_recibidos` | app (Bootstrap 3) | 267 | `GET /oficios/evaluacion/historialrecibidos`<br>`GET /oficios/evaluacion/historial_mostrar/{id_anos}` | RH (enlace) | 1 form, 2 modal, DataTables, AJAX | Media |
| `modificar_oficio_aceptado` | app (Bootstrap 3) | 503 | `GET /oficios/modificar/oficio_aceptado/{id_oficio}` | RH, Por unidad (carpeta (estimado)) | 9 form, 7 modal, AJAX | Alta |
| `registro_oficios` | app (Bootstrap 3) | 166 | `GET /oficios/registrosoficio` | Por unidad (menú) | 1 modal, DataTables, AJAX | Media |
| `solicitud_comisionados` | app (Bootstrap 3) | 554 | `GET /oficios/comisionados/{id}` | RH, Por unidad (carpeta (estimado)) | 9 form, 7 modal, AJAX | Alta |
| `solicitud_oficio` | app (Bootstrap 3) | 392 | `GET /oficios/solicitud` | Por unidad (menú) | 1 form, fechas/calendario, AJAX | Media |
| `validacion_profesores` | app (Bootstrap 3) | 176 | `GET /oficios/evaluacionsubdirecion` | Por unidad (menú) | 1 form, 1 modal, DataTables, AJAX | Media |

<details><summary>Parciales (6)</summary>

`partialsof.edit_comision`, `partialsof.edit_comisionado`, `partialsof.edit_dependencia`, `partialsof.editar_oficio_comision`, `partialsof.modal_comisionados`, `partialsof.modal_oficio`

</details>

### `sgc` — 9 pantallas, 1 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `add_auditorias` | app (Bootstrap 3) | 237 | `GET /sgc/programa/{programa}/edit` | Sin enlace en el menú (—) | 1 form, 1 modal, fechas/calendario, AJAX | Media |
| `auditores` | app (Bootstrap 3) | 171 | `GET /sgc/auditores` | Sin enlace en el menú (—) | 2 form, 1 modal | Media |
| `auditorias` | app (Bootstrap 3) | 333 | `GET /sgc/auditorias` | Sin enlace en el menú (—) | 4 form, 3 modal, AJAX | Alta |
| `detalle_plan` | app (Bootstrap 3) | 394 | `GET /sgc/ver_plan_auditoria/{id}` | Sin enlace en el menú (—) | 7 form, 5 modal | Alta |
| `hoja_trabajo` | app (Bootstrap 3) | 199 | `GET /sgc/hoja_trabajo/{hoja_trabajo}` | Sin enlace en el menú (—) | 3 form, 1 modal | Media |
| `normatividad` | app (Bootstrap 3) | 159 | `GET /sgc/normatividad` | Sin enlace en el menú (—) | 4 form, 2 modal | Media |
| `programas` | app (Bootstrap 3) | 160 | `GET /sgc/programa` | Sin enlace en el menú (—) | 2 form, 1 modal, fechas/calendario | Media |
| `reporte_final` | app (Bootstrap 3) | 63 | sin ruta directa | Sin enlace en el menú (—) | — | Baja |
| `ver_programa` | app (Bootstrap 3) | 172 | `GET /sgc/programa/{programa}` | Sin enlace en el menú (—) | 2 form, 2 modal | Media |

<details><summary>Parciales (1)</summary>

`auditores_evento`

</details>

### `docentes` — 8 pantallas, 3 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `docentes_carreras` | app (Bootstrap 3) | 112 | `GET /docente/{id_docente}/carreras` | Doc. c/act., Doc. s/act., Dir./Consultas (menú) | 1 modal | Media |
| `docentes_create` | app (Bootstrap 3) | 878 | `GET /docentes/create` | Jefe div., Dir./Consultas, RH (enlace) | 1 form, 4 modal, fechas/calendario, AJAX | Alta |
| `docentes_edit` | app (Bootstrap 3) | 716 | `GET /docentes/modificar` | Doc. c/act., Doc. s/act., Jefe div., Dir./Consultas, RH, Cómputo, Titulación, Por unidad (menú) | 1 form, 4 modal, fechas/calendario, AJAX | Alta |
| `docentes_periodos` | app (Bootstrap 3) | 140 | `GET /docente/acciones/periodo/{id_docente}/{id_materia}/{id_grupo}` | Doc. c/act., Doc. s/act., Jefe div., Dir./Consultas, RH, Cómputo, Titulación, Por unidad (carpeta (estimado)) | 1 form, 1 modal, AJAX | Media |
| `docentes_sumativas` | app (Bootstrap 3) | 300 | `GET /docente/{id_docente}/{id_materia}/{id_semestre}/{id_grupo}/{nom_carrera}/sumativas` | Doc. c/act., Doc. s/act., Jefe div., Dir./Consultas, RH, Cómputo, Titulación, Por unidad (carpeta (estimado)) | AJAX | Media |
| `mostrar_docentes` | app (Bootstrap 3) | 328 | `GET /docente` | Jefe div., Dir./Consultas, RH (menú) | 3 form, 3 modal, DataTables, AJAX | Alta |
| `partials.docentes_evaluaciones` | app (Bootstrap 3) | 461 | `GET /docente/acciones/calificacion/{id_docente}/{id_materia}/{id_grupo}` | Doc. c/act., Doc. s/act., Dir./Consultas (ctrl.) | 3 form, 4 modal, AJAX | Alta |
| `partials.docentes_evaluaciones_reportes` | app (Bootstrap 3) | 586 | `GET /docente/acciones/calificacion/{id_docente}/{id_materia}/{id_grupo}` | Doc. c/act., Doc. s/act., Dir./Consultas (ctrl.) | 1 form, 2 modal, AJAX | Alta |

<details><summary>Parciales (3)</summary>

`partials.insertar_periodo`, `partials.materias_perfil`, `partials.partial_mo_docente`

</details>

### `horarios` — 8 pantallas, 6 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `armar_horarios` | app (Bootstrap 3) | 720 | `GET /horarios/armar_horarios`<br>`GET /ver/profesores/{id}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | 3 form, 12 modal, fechas/calendario, AJAX | Alta |
| `horarios` | app (Bootstrap 3) | 56 | `GET /horarios/horarios_docentes`<br>`GET /horarios_docentes/{docente}` | Dir./Consultas (menú) | DataTables | Media |
| `horarios_aulas` | app (Bootstrap 3) | 87 | `GET /horarios/hrs_aulas`<br>`GET /horarios_aulas/{carrera}/{aula}` | Desarrollo, Dir./Consultas (menú) | AJAX | Media |
| `horarios_grupos` | app (Bootstrap 3) | 66 | `GET /horarios/hrs_grupos`<br>`GET /horarios_grupos/{semestre}/{grupo}/{carrera}` | Desarrollo, Dir./Consultas (menú) | — | Baja |
| `horarios_jefes_aulas` | app (Bootstrap 3) | 51 | `GET /horarios/hrs_aulas/jefes`<br>`GET /horarios_aulas/jefes/{aula}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | — | Baja |
| `horarios_jefes_grupos` | app (Bootstrap 3) | 57 | `GET /horarios/hrs_grupos/jefes`<br>`GET /horarios_grupos/jefes/{semestre}/{grupo}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | — | Baja |
| `hrs_carrera` | app (Bootstrap 3) | 97 | `GET /hrs_carrera`<br>`GET /hrs_carrera/categoria/{categoria}` | Desarrollo, Dir./Consultas (menú) | — | Baja |
| `prof_mat` | app (Bootstrap 3) | 61 | `GET /profesores/materias` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | DataTables | Media |

<details><summary>Parciales (6)</summary>

`partialsh.partial_armar_horarios`, `partialsh.partial_ver_aulas`, `partialsh.partial_ver_aulas_jefes`, `partialsh.partial_ver_grupos`, `partialsh.partial_ver_grupos_jefes`, `partialsh.partial_ver_horarios`

</details>

### `jefe_carrera` — 8 pantallas, 2 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `carga_academicas.carga_estudiante` | app (Bootstrap 3) | 161 | `GET /revicion_carga_estudiante/{id_alumno}/{id_semestre}` | Por unidad (carpeta (estimado)) | 1 form | Media |
| `carga_academicas.ver_cargas_academicas` | app (Bootstrap 3) | 54 | `GET /revicion_carga_jefe` | Por unidad (menú) | DataTables | Media |
| `index` | app (Bootstrap 3) | 129 | `GET /{id_carrera}/docentes` | Jefe div. (menú) | 1 modal | Media |
| `ingles.seguimiento_estudiantes_ingles` | app (Bootstrap 3) | 154 | sin ruta directa | Sin enlace en el menú (—) | DataTables | Media |
| `jefe_cc_periodos` | app (Bootstrap 3) | 183 | `GET /servicios_escolares/acciones_cc_academico/{id_docente}/{id_materia}/{id_grupo}` | Jefe div. (carpeta (estimado)) | 2 form, 2 modal, AJAX | Media |
| `jefe_evaluaciones` | app (Bootstrap 3) | 492 | `GET /j_carrera/acciones/calificaciones/{id_docente}/{id_materia}/{id_grupo}` | Jefe div. (carpeta (estimado)) | 3 form, 4 modal, AJAX | Alta |
| `jefe_periodos` | app (Bootstrap 3) | 184 | `GET /j_carrera/periodos/{id_docente}/{id_materia}/{id_grupo}` | Jefe div. (carpeta (estimado)) | 2 form, 2 modal, AJAX | Media |
| `jefe_sumativas` | app (Bootstrap 3) | 282 | `GET /j_carrera/{id_docente}/{id_materia}/{id_semestre}/{id_grupo}/{nom_carrera}/sumativas` | Jefe div. (carpeta (estimado)) | AJAX | Media |

<details><summary>Parciales (2)</summary>

`calificar_duales`, `modificar_periodo`

</details>

### `formatos` — 6 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `con_edu` | app (Bootstrap 3) | 84 | `GET /formatos/con_edu` | Dir./Consultas (menú) | — | Baja |
| `distribucion` | app (Bootstrap 3) | 193 | `GET /distribucion/{carrera}`<br>`GET /formatos/distribucion/{distribucion}` | Jefe div., Dir./Consultas (carpeta (estimado)) | — | Media |
| `distribucion_admin` | app (Bootstrap 3) | 145 | `GET /formatos/distribucion`<br>`GET /distribucion/{carrera}`<br>+1 | Jefe div., Dir./Consultas (menú) | — | Baja |
| `horas_docente` | app (Bootstrap 3) | 77 | `GET /formatos/horas_docentes` | Dir./Consultas (menú) | — | Baja |
| `relacion` | app (Bootstrap 3) | 185 | `GET /formatos/relacion/{relacion}`<br>`GET /relacion/ver/{ver}` | Jefe div., Dir./Consultas (carpeta (estimado)) | — | Media |
| `relacion_admin` | app (Bootstrap 3) | 141 | `GET /formatos/relacion`<br>`GET /relacion/ver`<br>+2 | Jefe div., Dir./Consultas (menú) | — | Baja |

### `reportes_profesores` — 6 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `distribucion_hrs_profesores` | app (Bootstrap 3) | 101 | `GET /distribucion_horas_profesores`<br>`GET /distribucion_horas_profesores/profesores_categoria/{id_categoria}` | Escolar/Dir. (menú) | DataTables | Media |
| `distribucion_materias` | app (Bootstrap 3) | 85 | `GET /distribucion_horas_profesores/materias/{id_personal}` | Escolar/Dir. (carpeta (estimado)) | DataTables | Media |
| `distribucion_total_materias` | app (Bootstrap 3) | 113 | `GET /distribucion_horas_profesores/total`<br>`GET /distribucion_horas_profesores/totales_profesor/{id_categoria}` | Escolar/Dir. (menú) | DataTables | Media |
| `distribucion_totales` | app (Bootstrap 3) | 118 | `GET /distribucion_horas_profesores/total_totales`<br>`GET /distribucion_horas_profesores/profesores_categorias/{id_categoria}` | Escolar/Dir. (menú) | DataTables | Media |
| `indice_reprobacion.indice_carrera` | app (Bootstrap 3) | 297 | `GET /indices_repro_prof`<br>`GET /indices_repro_prof/carrera_categoria/{id_carrera}`<br>+1 | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | — | Media |
| `indice_reprobacion.indice_carrera_jefe` | app (Bootstrap 3) | 272 | `GET /indices_repro_prof/carrera_categoria_jefe/{id_carrera}` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (carpeta (estimado)) | — | Media |

### `beca_estimulo` — 5 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `autorizar_academico` | app (Bootstrap 3) | 271 | `GET /beca_estimulo/academico/autorizar` | Por unidad (menú) | DataTables | Media |
| `autorizar_escolares` | app (Bootstrap 3) | 346 | `GET /beca_estimulo/escolares/autorizar` | Escolar/Dir. (menú) | DataTables | Media |
| `solicitud_beca` | app (Bootstrap 3) | 460 | `GET /beca_estimulo` | Alumno (menú) | — | Media |
| `solicitud_beca_vulnerabilidad` | app (Bootstrap 3) | 480 | `GET /beca_estimulo` | Alumno (menú) | — | Media |
| `vulnerabilidad` | app (Bootstrap 3) | 94 | `GET /beca_estimulo` | Alumno (menú) | 1 form | Baja |

### `computo` — 4 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `cal_alumno` | app (Bootstrap 3) | 232 | `GET /computo/calificacion_al/{id_carga}` | Escolar/Dir., Cómputo (carpeta (estimado)) | 1 form, 1 modal, AJAX | Media |
| `calificar_alumnos` | app (Bootstrap 3) | 144 | `GET /computo/calificar` | Escolar/Dir., Cómputo (menú) | DataTables | Media |
| `promedio_alumnos.alumnos_contados_beca` | app (Bootstrap 3) | 23 | `GET /computo/ver_carrera_alumno/{id_carrera}` | Cómputo (carpeta (estimado)) | — | Baja |
| `promedio_alumnos.promedio_carrera` | app (Bootstrap 3) | 28 | `GET /computo/ver_cal/promedios` | Cómputo (menú) | — | Baja |

### `constancia_adeudo` — 4 pantallas, 2 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `adeudo_encuestas_alumno` | app (Bootstrap 3) | 222 | `GET /ver_carrera_encuestas_adeudo`<br>`GET /encuestas_adeudo/ver_alumnos_encuestas_adeudo/{id_carrera}` | Por unidad (menú) | 1 form, 2 modal, DataTables | Media |
| `constancias_carreras` | app (Bootstrap 3) | 148 | `GET /constancia_adeudo`<br>`GET /constancia_carrera/{id_carrera}` | Por unidad (menú) | 1 modal, DataTables, AJAX | Media |
| `estado_alumno_adeudo` | app (Bootstrap 3) | 58 | `GET /verificacion_adeudo_alumno` | Alumno (menú) | — | Baja |
| `registrar_alumnos_adeudo` | app (Bootstrap 3) | 259 | `GET /solicitud_adeudo`<br>`GET /solicitud_alumno_adeudo/{id_carrera}` | Por unidad (menú) | 1 form, 3 modal, DataTables, AJAX | Alta |

<details><summary>Parciales (2)</summary>

`editar_comentario_adeudo`, `ver_estado_alumno`

</details>

### `informe_paa` — 4 pantallas, 1 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `accion` | app (Bootstrap 3) | 142 | `GET /paa/acciones_paa` | Por unidad (menú) | 2 form, 2 modal, DataTables, AJAX | Media |
| `programa` | app (Bootstrap 3) | 134 | `GET /paa/programa_paa` | Por unidad (menú) | 2 form, 2 modal, AJAX | Media |
| `subprograma` | app (Bootstrap 3) | 133 | `GET /paa/subprograma_paa` | Por unidad (menú) | 2 form, 2 modal, AJAX | Media |
| `unidad_medida` | app (Bootstrap 3) | 134 | `GET /paa/unidad_medida_paa` | Por unidad (menú) | 2 form, 2 modal, DataTables, AJAX | Media |

<details><summary>Parciales (1)</summary>

`modificar_accion`

</details>

### `prestamo` — 4 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `Alumnos_Prestamos_material.docente_index` | app (Bootstrap 3) | 246 | `GET /materiales-docentes` | Doc. c/act. (menú) | 5 form, 2 modal, DataTables | Alta |
| `Alumnos_Prestamos_material.index` | app (Bootstrap 3) | 239 | `GET /prestamo/Alumnos_Prestamos_material` | Alumno (menú) | 4 form, 2 modal, DataTables | Alta |
| `Jefe_prestamos_materiales.materiales_index` | app (Bootstrap 3) | 350 | `GET /prestamo/materials` | Por unidad (menú) | 7 form, 6 modal, DataTables | Alta |
| `Jefe_prestamos_materiales.vista_solicitudes_material` | app (Bootstrap 3) | 304 | `GET /prestamo/Jefe_prestamos_materiales` | Por unidad (menú) | 6 form, 1 modal, DataTables | Alta |

### `plantilla` — 3 pantallas, 2 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `docentes_plantilla` | app (Bootstrap 3) | 203 | `GET /plantilla/docentes` | Jefe div. (menú) | 3 form, 3 modal, DataTables, AJAX | Alta |
| `plantilla` | app (Bootstrap 3) | 299 | `GET /plantilla/ver`<br>`GET /plantilla/datos/{id_carrera}/{id_cargo}` | Jefe div., Dir./Consultas (menú) | 1 modal, AJAX | Media |
| `plantilla_educativa` | app (Bootstrap 3) | 489 | `GET /plantilla/educativa`<br>`GET /p_educativa/datos/{carrera}/{cargo}` | Dir./Consultas (menú) | 1 modal, AJAX | Media |

<details><summary>Parciales (2)</summary>

`partialsh.graficas`, `partialsh.partial_ver_horarios`

</details>

### `(raíz)` — 2 pantallas, 1 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `` | app (Bootstrap 3) | 49 | `GET /home` | Alumno, Doc. c/act., Doc. s/act., Jefe div., Desarrollo, Dir./Consultas, Escolar/Dir., RH, Cómputo, Residencias, Titulación, Finanzas, Personal, Por unidad, BD/ids (enlace) | 1 modal | Media |
| `` | app (Bootstrap 3) | 117 | `GET /persona`<br>`GET /personales`<br>+4 | Dir./Consultas (menú) | 1 form, 1 modal, DataTables | Media |

<details><summary>Parciales (1)</summary>

`ersonal`

</details>

### `ipomex` — 2 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `mostrar_articulos` | app (Bootstrap 3) | 86 | `GET /ipomex/mostrar_fracciones` | Por unidad (menú) | — | Baja |
| `mostrar_jefes_ipomex` | app (Bootstrap 3) | 96 | `GET /ipomex/mostrar_fracciones/contralor_ver_ipomex` | Por unidad (menú) | DataTables | Media |

### `laboratorios` — 2 pantallas, 2 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `laboratorios` | app (Bootstrap 3) | 450 | `GET /laboratorios/mostrar/{laboratorio}/{fecha_inicial}/{fecha_final}` | Cómputo (carpeta (estimado)) | 4 form, 5 modal, fechas/calendario, AJAX | Alta |
| `ver_laboratorios` | app (Bootstrap 3) | 115 | `GET /laboratorios/laboratorios` | Cómputo (menú) | fechas/calendario | Media |

<details><summary>Parciales (2)</summary>

`estado_lab`, `ver_hora_laboratorio`

</details>

### `plantilla_personal` — 2 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `consultar_personal` | app (Bootstrap 3) | 121 | `GET /departamento/plantillas/{id}`<br>`GET /departamentoplantilla/ver` | RH (menú) | 2 form, 1 modal, DataTables | Media |
| `personal_plantilla` | app (Bootstrap 3) | 204 | `GET /departamento/plantilla` | RH (menú) | 3 form, 3 modal, DataTables | Alta |

### `prorroga` — 2 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `solicitud_prorroga` | app (Bootstrap 3) | 184 | `GET /solicitud/prorroga` | Alumno (menú) | 1 form | Media |
| `solicitudes_subdireccion` | app (Bootstrap 3) | 84 | `GET /solicitud/prorroga_autorizar` | Por unidad (menú) | DataTables | Media |

### `analisis_reprobacion` — 1 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `index` | app (Bootstrap 3) | 584 | `GET /analisis-reprobacion` | Jefe div. (menú) | 3 form, 3 modal, AJAX | Alta |

### `areas_atencion` — 1 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `mis_casos.index` | app (Bootstrap 3) | 3135 | `GET /areas-atencion/mis-casos`<br>`GET /areas-atencion/mis-casos/piase` | BD/ids (menú) | 11 form, 10 modal, AJAX | Alta |

### `canalizacion_reprobacion_principal` — 1 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `index` | app (Bootstrap 3) | 328 | `GET /canalizacion-reprobacion-principal` | BD/ids (menú) | 1 form, 1 modal | Media |

### `desarrollo_academico` — 1 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `areas_atencion.index` | app (Bootstrap 3) | 570 | `GET /desarrollo-academico/areas-atencion` | BD/ids (menú) | 7 form, AJAX | Alta |

### `encuesta_tutorias` — 1 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `encuesta_tutorias` | Tutorías (marco) | 65 | sin ruta directa | Sin enlace en el menú (—) | 1 form | Baja |

### `piase` — 1 pantallas

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `estudiante.index` | app (Bootstrap 3) | 360 | `GET /piase-estudiante` | BD/ids (menú) | 1 form, 1 modal | Media |

### `reticulas` — 1 pantallas, 2 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `materias` | app (Bootstrap 3) | 388 | `GET /reticulass`<br>`PUT|PATCH /reticulass/{reticulass}`<br>+2 | Jefe div., Dir./Consultas (menú) | 2 form, 2 modal, AJAX | Media |

<details><summary>Parciales (2)</summary>

`partialsg.partial_materias`, `partialsg.partial_mo_reticula`

</details>

### `sgoe` — 1 pantallas, 1 parciales

| Vista | Layout | Líneas | Rutas | Rol (origen) | Elementos | Complejidad |
|---|---|---|---|---|---|---|
| `ejemplo` | SGOE | 155 | `GET /sgoe/documentacion` | Personal (enlace) | DataTables | Media |

<details><summary>Parciales (1)</summary>

`menu_sgoe`

</details>

## 5. Otras listas

### 5.1 Layouts propios y páginas sueltas

- `incidencias.pdfincidencia` (página HTML sin layout) — también la devuelve `PDF_PdfSolicitudIncidenciaContratoController@index1`, `PDF_PdfSolicitudIncidenciaContratoController@index4`
- `ingles.inicio_ingles.layout_ingles` (layout de módulo; lo usan 44 vistas)
- `sgoe.inicio` (layout de módulo; lo usan 1 vistas) — también la devuelve `Sgoe_inicioController@index`
- `tutorias.app_tutorias` (layout de módulo; lo usan 54 vistas)
- `welcome` (página HTML sin layout)

### 5.2 Ya migradas (piloto)

`evaluacion_docente.Admin.buscar`, `evaluacion_docente.Admin.mencamper`, `evaluacion_docente.Admin.mensages2`, `evaluacion_docente.Admin.reportes`, `evaluacion_docente.Admin.reportes2`, `evaluacion_docente.Alumnos.buscar`, `evaluacion_docente.Alumnos.evaluacion_docente`, `evaluacion_docente.Alumnos.mensages`, `evaluacion_docente.Alumnos.mensaje_dual`, `evaluacion_docente.Alumnos.mensaje_modi_carga`, `evaluacion_docente.partials.recursos_panel`, `tutorias.actividades_alumno.actividades_alumno`, `tutorias.alumnos.expediente`, `tutorias.alumnos.expedienteUpdate`, `tutorias.alumnos.incio_registro`, `tutorias.alumnos.index`, `tutorias.alumnos.partial.modalNSE`, `tutorias.alumnos.partial.navegacion_panel`, `tutorias.calendario_eventos.calendario_eventos`, `tutorias.eva_tutorias.alumnos_index`, `tutorias.eva_tutorias.alumnos_index_dos`, `tutorias.eva_tutorias.alumnos_index_tres`, `tutorias.eva_tutorias.encuesta_realizada`, `tutorias.partials.recursos_panel`

### 5.3 Sin uso detectado (109)

Ningún controlador, ruta ni vista las referencia por nombre literal. No se borran ni se migran hasta confirmar que no se usan (podrían abrirse con un nombre armado en tiempo de ejecución).

<details><summary>Lista</summary>

`RMateriales.RMCategorias.listadocate`, `RMateriales.errores`, `RMateriales.notificaciones`, `RMateriales.pdfpadron`, `RMateriales.pdfresguardo`, `RMateriales.resguardoUI`, `ambiental.encargado_amb.notificacion_envio_doc`, `ambiental.jefe_ambiental.modificar_doc_entregar`, `ambiental.jefe_ambiental.notificacion_aceptacion`, `ambiental.jefe_ambiental.notificacion_correcciones`, `auditorias.acciones_correctivas`, `auditorias.auditorias`, `auditorias.evidencias_acciones`, `centro_computo.activacion_armar_horarios`, `dashboard`, `departamento_finanzas.jefe_departamento.notificacion_envio_correcciones_req`, `departamento_finanzas.jefe_departamento.notificacion_envio_requsiciones`, `departamento_finanzas.jefe_departamento.solicitudes_presupuesto.doc_aceptados_solicitud`, `departamento_finanzas.jefe_finanazas.evaluacion_requisiciones.inicio_ver_proyectos_req`, `departamento_finanzas.jefe_finanazas.evaluacion_requisiciones.notificacion_modificacion_requisicion`, `departamento_finanzas.jefe_finanazas.evaluacion_requisiciones.notificacion_revision_todas_req`, `departamento_finanzas.jefe_finanazas.evaluacion_requisiciones.revision_mod_departamento`, `departamento_finanzas.jefe_finanazas.reg_requisiciones_admin.agregar_bienes_serv_admin_ante`, `departamento_finanzas.presupuesto_autorizado.agregar_presupuesto.modificar_presupuesto_partida`, `departamento_finanzas.presupuesto_autorizado.notificaciones.notificacion_envio_solicitud`, `duales.Mentor_Dual_Calificar.generar_listas_duales`, `duales.validar_carga_academica`, `encuesta_tutorias.verificar`, `evaluacion_docente.Admin.grafica_materia`, `evaluacion_docente.Admin.mensages`, `evaluacion_docente.Admin.mensages_coment`, `evaluacion_docente.Alumnos.mencamper`, `evaluacion_docente.Alumnos.puente`, `evaluacion_docente.Alumnos.vista`, `examen_gnral_con.admin.examenes.completo`, `examen_gnral_con.reporte_resultados`, `home_recargado`, `informe_paa.generar_paa`, `ingles.departamento.mostrar_calificacion_ingles_coordinador`, `ingles.departamento.partials_enviar_mod`, `ingles.departamento.ver_cal_coordinador_ingles`, `ingles.profesores_ingles.asignacion_calificaciones`, `ingles.profesores_ingles.asignacion_calificaciones_act`, `ingles.ver_cal_alumno_ingles`, `reportes_profesores.indice_reprobacion.indice_grupo`, `reportes_profesores.indice_reprobacion.indice_profesor`, `reportes_profesores.indice_reprobacion.indice_semestre`, `residencia.autorizacion_documentos_alta_residencia.mensaje_autoriza_doc_alta_resi`, `residencia.autorizacion_documentos_alta_residencia.mensaje_mod_doc_alta_resi`, `residencia.autorizacion_documentos_final_residencia.comentario_aceptar_doc_final`, `residencia.autorizacion_documentos_final_residencia.comentario_modificar_doc_final`, `residencia.departamento_residencia.ver_subdireccion_carreras`, `reticulas.partialsg.mensajes`, `riesgos.addpartes1`, `servicio_social.departamento_servicio.doc_enviar_alumno.comentario_autorizacion_carta`, `servicio_social.departamento_servicio.doc_enviar_alumno.comentario_autorizar_carta_presentacion`, `servicio_social.departamento_servicio.doc_enviar_alumno.comentario_enviar_pre`, `servicio_social.departamento_servicio.doc_enviar_alumno.comentario_rechazo_carta`, `servicio_social.departamento_servicio.documentos_alumnos.mensaje_envio_cartaaceptacion`, `servicio_social.primera_etapa.partials.mensaje_departamento_autorizacion`, `servicio_social.primera_etapa.partials.mensaje_departamento_modificacion`, `servicio_social.primera_etapa.partials.mensaje_envio`, `servicio_social.primera_etapa.partials.mensaje_modificacion`, `servicios_escolares.duales.validar_carga_academica`, `servicios_escolares.evaluaciones_sumativas`, `servicios_escolares.partials.discapacidad`, `servicios_escolares.partials.l_indigena`, `sgc.agenda`, `sgc.prueba`, `sgc.prueba2`, `sgc.prueba3`, `titulacion.alumno_titulacion.modal_modificar_correo`, `titulacion.alumno_titulacion.notificacion_envio_correcciones_doc`, `titulacion.alumno_titulacion.notificacion_envio_doc`, `titulacion.alumno_titulacion.segunda_etapa.notificacion_envio_correciones`, `titulacion.alumno_titulacion.segunda_etapa.notificacion_envio_reg_datos`, `titulacion.alumno_titulacion.tercera_etapa.notificacion_envio`, `titulacion.alumno_titulacion.tercera_etapa.notificaxion_envio_mod`, `titulacion.jefe_titulacion.autorizar_doc_requisitos.notificacion_autorizacion_doc`, `titulacion.jefe_titulacion.autorizar_doc_requisitos.notificacion_para_correcciones`, `titulacion.jefe_titulacion.autorizar_seg_parte.notificacion_autorizacion_datos`, `titulacion.jefe_titulacion.autorizar_seg_parte.notificacion_envio_centro`, `titulacion.jefe_titulacion.autorizar_seg_parte.notificacion_modificacion_envio`, `titulacion.jefe_titulacion.autorizar_seg_parte.ver_datos_per_ti_aut`, `titulacion.jefe_titulacion.autorizar_tercer_parte.autorizar_jurado_alumno`, `titulacion.jefe_titulacion.autorizar_tercer_parte.notificacion_autorizacion_jurado`, `titulacion.jefe_titulacion.autorizar_tercer_parte.notificacion_modificacion_jurado`, `titulacion.jefe_titulacion.modal_editar_nombre_jurado`, `tutorias.administrador.ver_alumnos`, `tutorias.alumnos.pdf`, `tutorias.coordina_inst.cuarto_sem`, `tutorias.coordina_inst.modalsugerencia1`, `tutorias.coordina_inst.octavo_sem`, `tutorias.coordina_inst.quinto_sem`, `tutorias.coordina_inst.reportecarrerains.Inicio_rep_institucional`, `tutorias.coordina_inst.reportecarrerains.repsemestral_ins`, `tutorias.coordina_inst.segundo_sem`, `tutorias.coordina_inst.septimo_sem`, `tutorias.coordina_inst.sexto_sem`, `tutorias.coordina_inst.tercer_sem`, `tutorias.coordinadorc.reportecarrera.repsemestralcarrera`, `tutorias.dep_desarrollo.edit`, `tutorias.dep_desarrollo.modaleditar`, `tutorias.desarrollo.eliminarcoor`, `tutorias.profesor.actividades`, `tutorias.profesor.canalizados`, `tutorias.profesor.edit`, `tutorias.profesor.generapdf`, `tutorias.profesor.modalsugerencia`

</details>

### 5.4 Fuera del alcance

- **PDF (24) y Excel (20):** se generan con DomPDF / Maatwebsite y no llevan el diseño de pantalla.
- **95 vistas de infraestructura:** login, registro y perfil de Breeze (`auth/`, `profile/`), `errors/`, `vendor/`, `layouts/`, `components/`, `panel/` y `partials/` (menú viejo, periodos y pie, que se retiran cuando todas las pantallas estén migradas).

## 6. Criterios y límites

- **Pantalla por migrar:** vista con `@extends` de `layouts.app`, `tutorias.app_tutorias`, el layout de Inglés o `sgoe.inicio`, referenciada por un controlador, una ruta o una vista.
- **Parcial:** vista sin `@extends` incluida por una pantalla pendiente (o devuelta por un controlador como fragmento, p. ej. AJAX). Se migra junto con su pantalla.
- **Rol:** el de los elementos del menú cuya URL coincide con una ruta de la vista. Si no hay, se siguen los enlaces (`href`, `action`, `url()`, `window.location`) desde las pantallas con rol, luego la vista que la incluye y, como estimado, su subcarpeta o las otras rutas del mismo controlador (columna "origen"). Las URL del menú hechas con `route(nombre)` se resuelven por el nombre de la ruta. El permiso real depende de las condiciones de cada elemento del menú (unidad, BD, sesión); las pantallas "Sin enlace en el menú" se abren por URL o desde otra pantalla que no está en el menú.
- **Tutorías:** las pantallas con `tutorias.app_tutorias` que quedan son del personal (tutor, jefe, coordinador, desarrollo): el menú interno del alumno solo lleva a sus 4 pantallas, ya migradas.
- **Complejidad:** Alta = más de 500 líneas, Vue, gráficas, 3 o más modales, o DataTables con 3 o más formularios; Media = más de 150 líneas, algún modal, DataTables, fechas/calendario, 2 o más formularios o AJAX; Baja = el resto.
- No se ejecutó ninguna pantalla ni se consultó la base de datos para este inventario.
