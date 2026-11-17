# Inventario del menú del perfil DIRECTIVO

Fuente: `resources/views/partials/menu_admin.blade.php` (rama `cacique`, commit `067d959`).
Fecha: 2026-11-17. Aprobado en la Fase 1 del rediseño del panel (rama `cacique`).

Este documento es la **lista de control** del nuevo sidebar: cada entrada debe existir en `app/Menus/MenuDirectivo.php` con la misma URL, el mismo método y la misma condición. La prueba Pest de comparación de enlaces (Fase 4) se basa en esta tabla.

## Cómo se evaluaron las condiciones

Perfil directivo = `users.tipo_usuario = 2` + `gnral_personales.id_departamento = 1` (`HomeController.php:533-541`).

| Bandera de sesión | Valor para el directivo | Origen |
|---|---|---|
| `directivo` | **siempre** (se guarda como `directivo.`, y `session()->has('directivo')` da `true` por la notación de punto) | `HomeController.php:537` |
| `personal_tesvb`, `tipo_persona=2`, `id_perso`, `nombre`, `men`, `permiso=2` | siempre | `HomeController.php:327-397, 536-540` |
| `id_unidad_admin` | solo si tiene fila en `gnral_unidad_personal` | `HomeController.php:332-377` |
| `isAuditor` | si es auditor de una auditoría próxima o en curso | `HomeController.php:291-305` |
| `revisor`, `seguimiento_asesor`, `personal_academia` | según `resi_*` | `HomeController.php:345-372` |
| `encargado_ambiental` | según `amb_encargados` | `HomeController.php:380-387` |
| `jefe_division`, `desa`, `consultas`, `escolar`, `profesor_conact`, `profesor_sinact`, `palumno`, `cambio_carreras` | **nunca** | — |

En el menú, `$id_unidad_admin` es booleano (`session()->has('id_unidad_admin')`) y `$unidad` es el número de la unidad (`Session::get('id_unidad_admin')`, L295 y L2410). `$id_per` es `Session::get('usuario_alumno')`, es decir, el `users.id` (L1490, L1697).

**Bloques que el directivo nunca ve:** profesor (L445, L579, L594), por lo que los enlaces de revisor y academia de L526/530/620/624 **no le aparecen aunque sea revisor**; además Cómputo (L700), RH (L781), Jefe de división (L822, L2456), Desarrollo (L992), Residencias (L1189), Titulación (L1273), Alumno (L1842), Inglés (L2118) y el cambio de carrera (L410).

**Unidad real de los directivos:** **[No confirmado]**. MySQL no estaba disponible durante el análisis. Consulta pendiente:

```sql
SELECT p.id_personal, p.tipo_usuario AS users_id, up.id_unidad_admin, ua.nom_departamento
FROM gnral_personales p
LEFT JOIN gnral_unidad_personal up ON up.id_personal = p.id_personal
LEFT JOIN gnral_unidad_administrativa ua ON ua.id_unidad_admin = up.id_unidad_admin
WHERE p.id_departamento = 1;
```

## Convenciones de la tabla

- **S** = siempre visible para el directivo.
- **U** = `session()->has('id_unidad_admin')`.
- **u=N** = `Session::get('id_unidad_admin') == N`.
- Los textos de "Módulo" y "Submódulo" se copian **tal como están en el original**. En el sidebar se pueden corregir acentos y ortografía; la URL y la condición no cambian.
- ⚠ = enlace dudoso (ver la sección final).

## Inventario

| # | Módulo (original) | Submódulo (original) | URL / ruta | Método | Condición de visibilidad | Línea |
|---|---|---|---|---|---|---|
| 1 | (ícono calendario) | Cambio de periodo (modal `partials/periodos`) | `/periodo/{id_periodo}` | GET | S (bloque L396) | 396-408; `periodos.blade.php:153,167` |
| 2 | Salir | — | `/logout` | POST + CSRF | S | 433-440 |
| 3 | Seguimiento de Residencia | — | `/residencia/seguimiento_asesor` | GET | `seguimiento_asesor` | 542 |
| 4 | Examen Conocimientos Gral. | — | `route('examen_conocimientos')` | GET | `gnral_personales.estado_docente_inv == 1` (consulta en la vista) | 565-575 |
| 5 | Tutorias | — | `/tutorias` | GET | `tipo_persona == 2` y **no** U | 641-644 |
| 6 | PIASE | Canalizar por reprobación | `/canalizacion-reprobacion-principal` | GET | tutor con asignación en el periodo vigente (consulta L43-93) | 662-667 |
| 7 | PIASE | Atención y seguimiento | `route('areas_atencion.mis_casos.index')` | GET | responsable activo de un área de atención (consulta L101-146) | 668-672 |
| 8 | Ingles | — | `/ingles/` | GET | U y u=19 | 688-697 |
| 9 | Control Escolar | Revision de cargas | `/validacion_de_carga` | GET | S | 1061 |
| 10 | Control Escolar | Gestión de Académica de Alumnos Duales | `/duales/gestion_academica` | GET | S (`@if($directivo)`) | 1067 |
| 11 | Control Escolar | Evaluaciones | `/servicios_escolares/carreras_calificaciones` | GET | S | 1071 |
| 12 | Control Escolar | Estadísticas | `/servicios_escolares/estadisticas` | GET | S | 1073 |
| 13 | Control Escolar | Modificaciones en periodos | `/servicios_escolares/bitacora_periodos` | GET | S | 1074 |
| 14 | Control Escolar | Modificaciones en evaluaciones ordinarias | `/servicios_escolares/bitacora_evaluaciones` | GET | S | 1076 |
| 15 | Control Escolar | Modificaciones en evaluaciones sumativas | `/servicios_escolares/bitacora_evaluaciones_sumativas` | GET | S | 1078 |
| 16 | Control Escolar | Datos de los alumnos por carrera | `/servicios_escolares/alumnos/carrera` | GET | S | 1081 |
| 17 | Reporte de profesores | Distribución de total de horas de los profesores | `/distribucion_horas_profesores/total/` | GET | u=5 o u=26 | 1176 |
| 18 | Reporte de profesores | Distribución de horas de todos los profesores | `/distribucion_horas_profesores/total_totales/` | GET | u=5 o u=26 | 1178 |
| 19 | Reporte de profesores | Distribución de horas de los profesores | `/distribucion_horas_profesores/` | GET | u=5 o u=26 | 1180 |
| 20 | Datos P. | Editar | `/docentes/modificar/` | GET | S | 1346 |
| 21 | Complementarias | Registrar Nueva Actividad | `/nueva_actividad` | GET | S | 1357 |
| 22 | Complementarias | Solicitud Alumnos | `/solicitud_alumnos` | GET | S | 1358 |
| 23 | Complementarias | Datos Estadísticos | `/datos_estadisticos` | GET | S | 1359 |
| 24 | Complementarias | Datos Históricos | `/datos_historicos_graficos` | GET | S | 1360 |
| 25 | Calificaciones | — | `/docente/{id_perso}/carreras` | GET | S | 1368 |
| 26 | Evaluacion Doc. | Profesores | `/buscar_profesores` | GET | S | 1380 |
| 27 | Evaluacion Doc. | Alumnos | `/buscar_alumnos` | GET | S | 1385 |
| 28 | Horarios | Ver Horarios Docentes | `/horarios/horarios_docentes` | GET | S | 1399 |
| 29 | Horarios | Ver Horarios Grupos | `/horarios/hrs_grupos` | GET | S | 1401 |
| 30 | Horarios | Ver Horarios Aulas | `/horarios/hrs_aulas` | GET | S | 1402 |
| 31 | Horarios | Horas por carrera | `/hrs_carrera` | GET | S | 1403 |
| 32 | Formatos | Concentrado Estructura Educ. | `/formatos/con_edu` | GET | S | 1410 |
| 33 | Formatos | Distrib.de hrs. frente a grupo | `/formatos/distribucion` | GET | S | 1411 |
| 34 | Formatos | Relación de personal docente | `/formatos/relacion` | GET | S | 1413 |
| 35 | Formatos | Horas por docentes | `/formatos/horas_docentes/` | GET | S | 1415 |
| 36 | Plantilla | Ver Plantilla | `/plantilla/ver` | GET | S | 1422 |
| 37 | Plantilla | Plantilla Educativa | `/plantilla/educativa` | GET | S | 1423 |
| 38 | Generales › Academico | Reticulas | `/reticulass` | GET | S | 1433 |
| 39 | Generales › Academico | Docentes | `/docente` | GET | S | 1434 |
| 40 | Generales | Edificios | `/generales/edificios` | GET | S | 1437 |
| 41 | Generales | Aulas | `/generales/aulas` | GET | S | 1438 |
| 42 | Generales | Situación Profesional | `/generales/situaciones` | GET | S (`@if($directivo)`) | 1440 |
| 43 | Generales | Perfil | `/generales/perfiles` | GET | S (`@if($directivo)`) | 1442 |
| 44 | Generales | Carreras | `/generales/carreras` | GET | S (`@if($directivo)`) | 1443 |
| 45 | Generales | Extra Clase | `/generales/extra_clases` | GET | S (`@if($directivo)`) | 1444 |
| 46 | Generales | Categoría Docente | `/generales/cargos` | GET | S (`@if($directivo)`) | 1445 |
| 47 | Generales | Jefaturas de División | `/generales/jefaturas` | GET | S (`@if($directivo)`) | 1446 |
| 48 | Generales | Asignación de Permisos | `/personales` | GET | S (`@if($directivo)`) | 1447 |
| 49 | Generales | Unidades Administrativas | `/generales/unidad_administrativa` | GET | S (`@if($directivo)`) | 1448 |
| 50 | Generales | Jefes Unidades Administrativas | `/generales/jefe_unidad_administrativa` | GET | S (`@if($directivo)`) | 1451 |
| 51 | Oficios Com. | Validar Oficios | `/oficios/evaluacionsubdirecion` | GET | u=26 | 1467 |
| 52 | Oficios Com. | Solicitud Oficio | `/oficios/solicitud` | GET | S | 1470 |
| 53 | Oficios Com. | Ver Oficios | `/oficios/registrosoficio` | GET | S | 1471 |
| 54 | Seg. de Oficios | Editar | `/docentes/modificar/` ⚠ | GET | S | 1483 |
| 55 | Titulación | Autorizar entrega de PDF | `/titulacion/autorizacion_entrega_cd` | GET | `users.id == 2630` | 1501 |
| 56 | Titulación | Documento de Titulacion autorizado de los estudiantes | `/titulacion/documento_titulacion_autorizado/` | GET | `users.id == 2630` | 1503 |
| 57 | Procedimiento Amb. | Enviar evidencias del procedimiento | `/ambiental/enviar_documentacion/` | GET | `encargado_ambiental` | 1520 |
| 58 | Procedimiento Amb. | Historial de las evidencias procedimiento | `/ambiental/historial_documentacion/` | GET | `encargado_ambiental` | 1522 |
| 59 | Adeudos de Estudiantes | Registrar alumnos con adeudo | `/solicitud_adeudo/` | GET | U o `users.id === 2630` o `=== 2662` | 1580 |
| 60 | Adeudos de Estudiantes | Constancias de no adeudo | `/constancia_adeudo/` | GET | (condición del #59) y (u=16 o u=28) | 1582 |
| 61 | Adeudos de Estudiantes | Adeudo de Encuestas | `/ver_carrera_encuestas_adeudo//` ⚠ | GET | (condición del #59) y `users.id === 2662` | 1585 |
| 62 | (2º ícono calendario) | Cambio de periodo (mismo modal) | `/periodo/{id_periodo}` | GET | (condición del #59) y (u=14 o u=20). **Se fusiona con el selector único del header** | 1590-1601 ⚠ |
| 63 | Req. Anteproyecto | Techo presupuestal | `/presupuesto_anteproyecto/techo_presupuestal/` | GET | u=24 o u=25 | 1612 |
| 64 | Req. Anteproyecto | Periodos de anteproyectos | `/presupuesto_anteproyecto/periodos_anteproyecto/` | GET | u=24 o u=25 | 1614 |
| 65 | Req. Anteproyecto | Revisión de requisiciones | `/presupuesto_anteproyecto/revicion_requisiciones_anteproyecto/` | GET | u=24 o u=25 | 1616 |
| 66 | Req. Anteproyecto | Requisiciones autorizadas de los proyectos | `/presupuesto_anteproyecto/requisiciones_autorizadas_proyecto/` | GET | u=24 o u=25 | 1618 |
| 67 | Req. Anteproyecto | Historiales de los anteproyectos del los presupuestos | `/presupuesto_anteproyecto/inicio_historial_anteproyecto/` | GET | u=24 o u=25 | 1620 |
| 68 | Catalogo de Requisiciones | Partidas presupuestales | `/presupuesto_anteproyecto/partida_presupuestal/` | GET | u=24 o u=25 | 1635 |
| 69 | Catalogo de Requisiciones | Proyectos presupuestales | `/presupuesto_anteproyecto/proyectos_presupuestales/` | GET | u ∈ {1, 2, 24, 25} | 1638 |
| 70 | Catalogo de Requisiciones | Metas de los proyectos presupuestales | `/presupuesto_anteproyecto/proyectos_metas/` | GET | u ∈ {1, 2, 24, 25} | 1640 |
| 71 | Presupuesto autorizado | Agregar presupuesto autorizado | `/presupuesto_autorizado/agregar_presupesto_partida/` | GET | u=24 o u=25 | 1652 |
| 72 | Presupuesto autorizado | Presupuesto autorizado para modificar | `/presupuesto_autorizado/presupesto_partida_copia/` | GET | u=24 o u=25 | 1654 |
| 73 | Presupuesto autorizado | Departamentos con presupuesto autorizado | `/presupuesto_autorizado/departamentos_presupesto_partida/` | GET | u=24 o u=25 | 1656 |
| 74 | Presupuesto autorizado | Revisión de solicitudes | `/presupuesto_autorizado/revisar_solicitudes/` | GET | u=24 o u=25 | 1658 |
| 75 | Presupuesto autorizado | Solicitudes autorizadas liberadas | `/presupuesto_autorizado/solicitudes_autorizadas_departamentos` | GET | u=24 o u=25 | 1660 |
| 76 | Presupuesto autorizado | Historial de presupuesto autorizado | `/presupuesto_autorizado/inicio_presupuesto_autorizado_historial/` | GET | u=24 o u=25 | 1663 |
| 77 | Ipomex | — (enlace directo) | `/ipomex/mostrar_fracciones/contralor_ver_ipomex/` | GET | U y u=40 | 1676 |
| 78 | Ipomex | Ver jefes con fracciones | `/ipomex/mostrar_fracciones/contralor_ver_ipomex/` | GET | U y u=1 | 1684 |
| 79 | Ipomex | Ver mis fracciones | `/ipomex/mostrar_fracciones` | GET | U y u=1 | 1686 |
| 80 | Ipomex | — (enlace directo) | `/ipomex/mostrar_fracciones` | GET | U y u ∉ {1, 40} | 1694 |
| 81 | Solicitudes de beca | — (enlace directo) | `/beca_estimulo/academico/autorizar` | GET | U y u=5 | 1701 |
| 82 | Solicitudes | Solicitudes de beca | `/beca_estimulo/academico/autorizar` | GET | U y u=26 | 1713 |
| 83 | Solicitudes | Solicitud de prorroga | `/solicitud/prorroga_autorizar` | GET | U y u=26 | 1714 |
| 84 | Residencia | — (enlace directo) | `/residencia/carreras_proyectos` | GET | U y u=26 | 1717 |
| 85 | Evidencias Inf. Doc. | Procedimientos | `/ambiental/ver_procedimientos/` | GET | U y u=17 | 1731 |
| 86 | Evidencias Inf. Doc. | Encargados de los Procedimientos | `/ambiental/ver_encargados/` | GET | U y u=17 | 1732 |
| 87 | Evidencias Inf. Doc. | Periodos de Envió de Documentación | `/ambiental/ver_periodos/` | GET | U y u=17 | 1734 |
| 88 | Evidencias Inf. Doc. | Autorizar Documentación | `/ambiental/ver_documentacion_ambiental/` | GET | U y u=17 | 1736 |
| 89 | Evidencias Inf. Doc. | Historial Documentación Ambiental | `/ambiental/historial_ambiental_departamento/` | GET | U y u=17 | 1738 |
| 90 | P.A.AC › Catálogo | Programa | `/paa/programa_paa` | GET | U y u=1 — **OCULTO** (`display:none`) | 1785 |
| 91 | P.A.AC › Catálogo | Subprograma | `/paa/subprograma_paa` | GET | U y u=1 — **OCULTO** | 1786 |
| 92 | P.A.AC › Catálogo | Acción | `/paa/acciones_paa` | GET | U y u=1 — **OCULTO** | 1787 |
| 93 | P.A.AC › Catálogo | Unidad de medida | `/paa/unidad_medida_paa` | GET | U y u=1 — **OCULTO** | 1788 |
| 94 | P.A.AC › OPCIONES DE P.A.AC | Generar | `/paa/generarpaa` | GET | U — **OCULTO** | 1798 |
| 95 | P.A.AC › OPCIONES DE P.A.AC | Modificar P.A.A | `/paa/subprograma_paa` ⚠ | GET | U — **OCULTO** | 1799 |
| 96 | P.A.AC › OPCIONES DE P.A.AC | Cargar evidencia | `/paa/acciones_paa` ⚠ | GET | U — **OCULTO** | 1800 |
| 97 | P.A.AC › OPCIONES DE P.A.AC | Modificar | `/paa/unidad_medida_paa` ⚠ | GET | U — **OCULTO** | 1801 |
| 98 | Req. de Mat. Anteproyecto | Registrar requisición de materiales del anteproyecto | `/presupuesto_anteproyecto/registrar_requerimientos_anteproyecto/` | GET | U | 1813 |
| 99 | Solicitudes de req. del presupuesto autorizado | Registrar requisiciones a las solicitudes autorizadas | `/presupuesto_autorizado/agregar_req_solicitud_autorizadas/` | GET | U | 1825 |
| 100 | Solicitudes de req. del presupuesto autorizado | Ver solicitudes autorizadas liberadas | `/presupuesto_autorizado/solicitudes_aut_departamento/` | GET | U | 1829 |
| 101 | Incidencias de Asistencia | Validar oficios de los departamentos | `/incidencias/validar_oficios_departamentos` | GET | u=3 | 2141 |
| 102 | Incidencias de Asistencia | Validar oficios de los departamentos | `/incidencias/validar_oficios_dep_acad_finanzas` | GET | u=5 o u=22 (`@elseif` del #101) | 2145 |
| 103 | Incidencias de Asistencia | Validar oficios del departamento | `/incidencias/validar_oficios` | GET | S | 2150 |
| 104 | Incidencias de Asistencia | Historial de oficios autorizados del departamento | `/incidencias/historial_oficios_autorizados` | GET | S | 2152 |
| 105 | Incidencias de Asistencia | Historial de evidencias de conocimiento del departamento | `/incidencias/historial_evid_personal` | GET | S | 2154 |
| 106 | Incidencias de Asistencia | Solicitar oficio | `/incidencias/solicitar_oficio` | GET | **no** U | 2164 |
| 107 | Incidencias de Asistencia | Subir evidencia de conocimiento | `/incidencias/cargar_otra_evidencia` | GET | no U | 2165 |
| 108 | Incidencias de Asistencia | Historial oficios autorizados | `/incidencias/historial_docentesSo` | GET | no U | 2169 |
| 109 | Incidencias de Asistencia | Historial evidencias de conocimiento | `/incidencias/historial_docentesEv` | GET | no U | 2171 |
| 110 | SGOE | SGOE | `/sgoe/inicio` | GET | S | 2210 |
| 111 | SGOE › Riesgos y Oportuni. | Registro Procesos | `/riesgos/proceso` | GET | S (`personal_tesvb && (U \|\| directivo)`) | 2218 |
| 112 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Riesgos | `/riesgos/riesgo` | GET | S | 2224 |
| 113 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Selecciones | `/riesgos/seleccion` | GET | S | 2225 |
| 114 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Tipo Evaluación | `/riesgos/tipoeva` | GET | S | 2226 |
| 115 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Factor | `/riesgos/factor` | GET | S | 2227 |
| 116 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Tipo Factor | `/riesgos/tipof` | GET | S | 2228 |
| 117 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Estrategias | `/riesgos/estrategia` | GET | S | 2229 |
| 118 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Nivel Decisión | `/riesgos/decision` | GET | S | 2230 |
| 119 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Clasificación Riesgo | `/riesgos/clasifica` | GET | S | 2231 |
| 120 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Categoria del Proceso | `/riesgos/sistema` | GET | S | 2233 |
| 121 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Mejoras del Cliente | `/riesgos/mejoracliente` | GET | S | 2241 |
| 122 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Reputación Institucional | `/riesgos/mejorareputacion` | GET | S | 2243 |
| 123 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Mejora SGC | `/riesgos/mejorasgc` | GET | S | 2245 |
| 124 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Potencial Apertura Nuevos Programas de Estudio | `/riesgos/potencialapertura` | GET | S | 2246 |
| 125 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Potencial Costo de Implementación | `/riesgos/potencialcosto` | GET | S | 2248 |
| 126 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Potencial de Crecimiento de la Matrícula Actual | `/riesgos/potencialcrecimiento` | GET | S | 2250 |
| 127 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Registra Probabilidad | `/riesgos/probabilidad` | GET | S | 2252 |
| 128 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Registra Ocurrencias Previas | `/riesgos/ocurrenciasp` | GET | S | 2254 |
| 129 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Registra Calificación Máxima | `/riesgos/calificacion` | GET | S | 2256 |
| 130 | SGOE › Riesgos y Oportuni. | Partes Interesadas | `/riesgos/partes` | GET | S | 2261 |
| 131 | SGOE › Riesgos y Oportuni. | Seguimiento | `/riesgos/seguimiento` | GET | S (`directivo \|\| u=10`) | 2264 |
| 132 | SGOE › Riesgos y Oportuni. | Cronograma | `riesgos/seguimiento/tabla` | GET | S (`directivo \|\| u=10`) | 2265 |
| 133 | SGOE › Auditorías | Actividades para la agenda | `/auditorias/actividades` | GET | auditor líder (`aud_auditores.id_categoria = 1`) | 2278 |
| 134 | SGOE › Auditorías | Auditores | `/auditorias/auditores` | GET | auditor líder | 2280 |
| 135 | SGOE › Auditorías | Catálogo Generales | `/auditorias/generales` | GET | auditor líder | 2281 |
| 136 | SGOE › Auditorías | Procesos | `/auditorias/procesos` | GET | auditor líder | 2282 |
| 137 | SGOE › Auditorías | Seguimiento | `/auditorias/responsables` | GET | auditor líder | 2283 |
| 138 | SGOE › Auditorías | Programa de auditorías | `/auditorias/programas` | GET | auditor líder o auditor (cualquier fila en `aud_auditores`) | 2285 |
| 139 | SGOE › No conformidades | Acciones Correctivas | `/auditorias/notas_auditorias` | GET | S | 2297 |
| 140 | SGOE › Encuestas Satisfacción | Inscripción | `/encuestas_satisfaccion/encuesta_incripcion_periodo` | GET | u=2 o u=5 | 2312 |
| 141 | SGOE › Encuestas Satisfacción | Reinscripción | `/encuestas_satisfaccion/encuesta_reincripcion_periodo/` | GET | u=2 o u=5 | 2315 |
| 142 | SGOE › Encuestas Satisfacción | Centro de cómputo | `/encuestas_satisfaccion/menu_historial_mantenimiento/` | GET | u=2 o u=5 | 2317 |
| 143 | SGOE › Encuestas Satisfacción | Servicio social | `/encuestas_satisfaccion/historial_periodo_year/` | GET | u=2 o u=5 | 2319 |
| 144 | SGOE › Encuestas Satisfacción | Residencia Profesional | `/encuestas_satisfaccion/agregar_periodo_year_residencia/` | GET | u=2 o u=5 | 2322 |
| 145 | SGOE › Encuestas Satisfacción | Titulación | `/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion` | GET | u=2 o u=5 | 2325 |
| 146 | SGOE › Encuestas | Encuesta de satisfacción al cliente Centro de Cómputo | `/encuestas_satisfaccion/registro_enc_mante_usuario/` | GET | S | 2337 |
| 147 | SGOE › Seguimiento OM/NC/AC | Ejecutar | `/auditorias/responsables_implementar` | GET | S | 2349 |
| 148 | SGOE › Seguimiento OM/NC/AC | Revisar | `/auditorias/responsables_revisar` | GET | S | 2351 |
| 149 | SGOE | Seguimiento Auditorías Anteriores | `/auditorias/notas_auditor` | GET | sesión `isAuditor` | 2360 |
| 150 | SGOE | Asignar Líder | `route('auditorias.asignar_lider')` | GET | auditor líder | 2367 |
| 151 | SGOE | Ver Acciones | `route('auditorias.lider_acciones')` | GET | líder de acciones (`aud_lider_acciones`, sin `deleted_at`) | 2374 |
| 152 | SGOE | Seguimiento de auditorías | `route('auditorias.seguimiento_auditorias.index')` | GET | auditor líder, o seguimiento asignado (`aud_seguimiento_auditorias`), o auditor | 2381 |
| 153 | Inventario TESVB | Sector Auxiliar | `/SectorAux` | GET | u=25 | 2419 |
| 154 | Inventario TESVB › Bienes › Gestionar atributos del Bien | Marcas | `/Marcas` | GET | u=25 | 2425 |
| 155 | Inventario TESVB › Bienes › Gestionar atributos del Bien | Proveedores | `/Provedores` | GET | u=25 | 2426 |
| 156 | Inventario TESVB › Bienes › Gestionar atributos del Bien | Modelos | `/Modelos` | GET | u=25 | 2427 |
| 157 | Inventario TESVB › Bienes | Registro, Gestión y consulta de Bienes | `/Bienes` | GET | u=25 | 2430 |
| 158 | Inventario TESVB | Categorías | `/Categorias` | GET | u=25 | 2433 |
| 159 | Inventario TESVB › Resguardos | Asignacion y Consulta de Resguardos | `/Resguardos` | GET | u=25 | 2436 |
| 160 | Inventario TESVB › Resguardos | Tarjetas de Resguardo | `/Resguardos-Consulta` | GET | u=25 | 2437 |
| 161 | Inventario TESVB › Padrón de Bienes | Padron del TESVB | `/Resguardos-Padron` | GET | u=25 | 2442 |
| 162 | Inventario TESVB | Historial Departamentos | `/Areas` | GET | u=25 | 2445 |
| 163 | Inventario TESVB › Reportes | Reportes en Excel | `/Reportes` | GET | u=25 | 2448 |
| 164 | Validar Cargas | — (enlace directo) | `/revicion_carga_jefe/` | GET | u=8 | 2484 |
| 165 | Materiales y solicitudes | Ver solicitudes | `/prestamo/Jefe_prestamos_materiales/` | GET | u=6 | 2494 |
| 166 | Materiales y solicitudes | Ver materiales | `/prestamo/materials` | GET | u=6 | 2495 |

## Totales

| Concepto | Cantidad | Entradas |
|---|---|---|
| **Total** | **166** | #1-#166, numeración continua |
| Siempre visibles (S) | **74** | #1-2 (2), #9-16 (8), #20-50 (31), #52-54 (3), #103-105 (3), #110-132 (23), #139 (1), #146-148 (3) |
| Condicionales | **92** | el resto; incluye 8 ocultos |
| Ocultos (`display:none`, P.A.AC) | 8 | #90-97: van en `MenuDirectivo` marcados como ocultos y **no se muestran** en el sidebar |

Comprobación: 2 + 8 + 31 + 3 + 3 + 23 + 1 + 3 = **74**; 166 − 74 = **92**.

Validación de rutas: las 166 URLs existen como rutas **GET** en `php artisan route:list` (2 915 rutas), y `/logout` existe como **POST**. Ningún enlace del directivo está roto.

## Elementos que no son enlaces

| Elemento | Línea | Destino en el nuevo diseño |
|---|---|---|
| Insignia "nombre · periodo actual" | 365-368 | Menú de usuario del header |
| Tooltip del calendario: "{periodo}<br>Cambia el periodo aqui" | 397-398 | Botón de periodo del header |
| Modal `#modal_modificar_periodo` y JS `.periodo_ingles` | 2507-2575 | Solo es del perfil de inglés; no aplica |
| JS `cargar()` / `cargarpersonal()` (AJAX `/mostrar_validacion*`) | 2540-2551 | No se llama nunca (intervalos y badges comentados). **Se quita la campana** |
| JS de submenús (hover/click) y `<style>` | 2577-2643 | Lo reemplazan Alpine y `x-collapse` |

## Contenido actual del panel del directivo (`home_recargado.blade.php`)

| Contenido | Línea | Decisión |
|---|---|---|
| Aviso "ATENCION: !!!!El modulo de RETICULA y DOCENTE se cambio a Generales en el submenu ACADEMICO!!" | 130-134 | **Pendiente** (se queda o se quita) |
| Mensaje global `{{$men}}` (`men.id = 1`) | 140 | Se conserva como alerta |
| Aviso "Canalización por reprobación" (tutor con reprobados en el periodo vigente) | 145-171 | Se conserva; la consulta pasa a un servicio |
| Diagnóstico `?debug_tutor=1` | 173-191 | **No se migra** |
| Encuestas y adeudos | 194+ | Solo alumnos; no aplica |

## Enlaces dudosos (se conservan sin cambios)

| # | Problema | Acción |
|---|---|---|
| 54 | "Seg. de Oficios › Editar" lleva a `/docentes/modificar/`, el mismo destino que "Datos P. › Editar" (#20). Parece un error de copia | Pendiente de corregir en un commit aparte (anotado en `docs/panel.md`) |
| 95-97 | Las etiquetas no corresponden a su URL ("Modificar P.A.A" → `subprograma_paa`, "Cargar evidencia" → `acciones_paa`, "Modificar" → `unidad_medida_paa`). Además están ocultos | Pendiente de corregir en un commit aparte (anotado en `docs/panel.md`) |
| 61 | Doble barra final (`//`) | Se conserva; funciona igual |
| 62 | Crea un segundo `id="periodo"` (el JS solo se engancha al primero) | Se fusiona con el selector único del header |
| 77/78 | Misma URL con dos etiquetas según la unidad | Se conserva |

No se incluyen los elementos comentados del original: L1182 (comentario HTML `indices_repro_prof`), L1532-1555 (Auditorías y No conformidades antiguas), L1747-1773 (Encuestas de satisfacción antiguas) y L2389-2401 (Asignar y Revisar acciones).
