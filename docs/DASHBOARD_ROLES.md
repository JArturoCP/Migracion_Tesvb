# Dashboard de `/inicio` por rol

Bloques de la plantilla TailAdmin (`src/pages/index.html`):

| Bloque | Componente de la plantilla | Vista en el proyecto |
|---|---|---|
| Métricas (2 tarjetas) | `ecommerce-metrics.html` | `panel/dashboard/metricas.blade.php` |
| Barras | `monthly-sales-chart.html` | `panel/dashboard/barras.blade.php` |
| Medidor radial | `monthly-target` | `panel/dashboard/radial.blade.php` |
| Línea/área con pestañas | `statistics-chart` | `panel/dashboard/linea.blade.php` |
| Lista con porcentajes | `demographic-card` (sin mapa) | `panel/dashboard/lista.blade.php` |
| Tabla | `recent-orders` | `panel/dashboard/tabla.blade.php` |

Reglas comunes:
- Solo consultas de **lectura** con parámetros enlazados, en una clase por rol (`app/Services/Panel/Datos{Rol}.php`), con caché de 10 minutos por periodo. Ninguna consulta va en las vistas.
- Cada indicador **replica la regla de una pantalla que ya existe**, para que los números coincidan.
- Si un dato no está disponible, el bloque muestra **"Sin datos"**; nunca se inventan números.
- Periodo: `Session::get('periodo_actual')` (el que el usuario elige con "Cambiar periodo").

> **Base de datos usada para validar:** `tesvb_relaciones` local, que contiene los **datos de prueba de los seeders** (15 filas por tabla, catálogos ficticios). Los números de abajo prueban que las consultas funcionan y que coinciden con las pantallas, pero **no son los de producción**. El log de MariaDB registra avisos de InnoDB ("Your database may be corrupt…"); conviene revisarlo aparte.

---

## 1. DIRECTIVO (implementado)

Clase: `app/Services/Panel/DatosDirectivo.php`. Vista: `panel/dashboard/directivo.blade.php`. Se entrega a la vista con `app/View/Composers/PanelInicioComposer.php`.

| Bloque | Dato | Regla (pantalla que replica) | Tablas |
|---|---|---|---|
| Métrica 1 | **Estudiantes inscritos** (+ variación contra el periodo anterior) | `SEscolaresController@estadisticas_genero` (Servicios Escolares › Estadísticas): `SUM(genero='M') + SUM(genero='F')` de alumnos con `eva_validacion_de_cargas.estado_validacion IN (2,8,9)` en el periodo, semestres de `gnral_semestres`, sin carreras 9, 11 y 15 | `gnral_alumnos`, `eva_validacion_de_cargas`, `gnral_carreras`, `gnral_semestres` |
| Métrica 2 | **Docentes con horario** (+ variación) | `HrsDocentesController@index` (Horarios › Ver Horarios Docentes): `COUNT(DISTINCT id_personal)` con horario en el periodo | `gnral_personales`, `gnral_horarios`, `gnral_periodo_carreras`, `gnral_periodos` |
| Barras | **Inscritos por carrera** | Igual que la métrica 1, agrupado por carrera | ídem |
| Radial | **Índice de aprobación** = cargas sin unidades reprobadas / cargas | `SEscolaresController@estadisticas_indice_reprobacion_sem` (índice de reprobación): cargas con `id_status_materia = 1` de alumnos con validación `IN (2,9)`; una carga está reprobada si alguna unidad (`cal_evaluaciones`) tiene `calificacion < 70` | `eva_carga_academica`, `eva_validacion_de_cargas`, `cal_evaluaciones`, `gnral_alumnos` |
| Línea | **Inscritos y docentes** de los últimos 6 periodos (pestañas General / Estudiantes / Docentes) | Reglas de las métricas 1 y 2 por periodo | ídem |
| Lista | **Distribución de inscritos por carrera** (%) | Métrica 1 por carrera / total | ídem |
| Tabla | **Resumen por carrera**: estudiantes, docentes con horario y % de aprobación; botón "Ver estadísticas" (`/servicios_escolares/estadisticas`, módulo que el directivo ya tiene) | Reglas anteriores por carrera | ídem |

SQL principal (los valores van como parámetros):

```sql
-- Inscritos por carrera
SELECT a.id_carrera, SUM(a.genero = 'M') + SUM(a.genero = 'F') AS total
  FROM gnral_alumnos a
  JOIN eva_validacion_de_cargas v ON v.id_alumno = a.id_alumno
  JOIN gnral_carreras c ON c.id_carrera = a.id_carrera
 WHERE v.id_periodo = ? AND v.estado_validacion IN (?, ?, ?)        -- 2, 8, 9
   AND a.id_carrera NOT IN (?, ?, ?)                                -- 9, 11, 15
   AND a.id_semestre IN (SELECT id_semestre FROM gnral_semestres)
 GROUP BY a.id_carrera;

-- Docentes con horario (total)
SELECT COUNT(DISTINCT p.id_personal)
  FROM gnral_personales p
  JOIN gnral_horarios h ON h.id_personal = p.id_personal
  JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera
  JOIN gnral_periodos g ON g.id_periodo = pc.id_periodo
 WHERE g.id_periodo = ?;

-- Aprobación por carrera
SELECT a.id_carrera, COUNT(*) AS cargas, SUM(t.reprobadas = 0) AS aprobadas
  FROM (SELECT ca.id_carga_academica, ca.id_alumno, COALESCE(SUM(ev.calificacion < 70), 0) AS reprobadas
          FROM eva_carga_academica ca
          JOIN eva_validacion_de_cargas v ON v.id_alumno = ca.id_alumno AND v.id_periodo = ca.id_periodo
                                         AND v.estado_validacion IN (?, ?)      -- 2, 9
          LEFT JOIN cal_evaluaciones ev ON ev.id_carga_academica = ca.id_carga_academica
         WHERE ca.id_periodo = ? AND ca.id_status_materia = 1
         GROUP BY ca.id_carga_academica, ca.id_alumno) t
  JOIN gnral_alumnos a ON a.id_alumno = t.id_alumno
 GROUP BY a.id_carrera;
```

### Validación contra MySQL (periodo 12, AGOSTO 2026-ENERO 2027)

| Dato | Dashboard | Pantalla actual (controlador ejecutado con la misma sesión) | ¿Cuadra? |
|---|---|---|---|
| Inscritos | **2** (ISC 1, IIND 1) | Estadísticas (`estadisticas_genero`): **2** (ISC 1, IIND 1) | ✅ |
| Docentes con horario | **11** | Ver Horarios Docentes (`HrsDocentesController@index`): **11** | ✅ |
| Docentes por carrera | ISC 2, IIND 1, IC 1, IGE 2, LG 2, IE 1, LT 2 (suma 11) | — | ✅ (suma = total) |
| Aprobación | **Sin datos** | No hay cargas con `id_status_materia = 1` y validación 2 o 9 en el periodo, así que el índice de reprobación tampoco tiene datos | ✅ (la regla es la misma; no se pudo contrastar con un número) |
| Histórico | 2024-1: 0 · 2024-2: 0 · 2025-1: 1 · 2025-2: 0 · 2026-1: 0 · 2026-2: 2 | — | — |

### Números que NO cuadraban con la propuesta original (y cómo se resolvió)

| Propuesta original | Problema | Resolución |
|---|---|---|
| K1 = `COUNT(DISTINCT id_alumno)` de `eva_carga_academica` | Daba **11**; la pantalla de Estadísticas muestra **2**, porque solo cuenta cargas **validadas** (2, 8, 9) y alumnos con género M/F | Se usa la regla de Estadísticas |
| K3 = % de **unidades** con calificación < 70 | La pantalla de índice de reprobación cuenta **cargas** (alumno-materia): una carga está reprobada si alguna unidad < 70 | Se usa la regla de la pantalla |
| — | Las dos pantallas usan universos distintos: Estadísticas cuenta validación 2, 8 y 9; el índice de reprobación solo 2 y 9 (sin la 8) | Se respeta cada una; queda documentado en la clase |

---

## 2. Propuesta para los demás roles (no implementada)

Todas las consultas se validaron contra la base local con casos de muestra (periodo 12; alumno 1; docente 1; carrera 1). Donde existe una pantalla equivalente, se ejecutó su controlador con la misma sesión.

### 2.1 ALUMNO (`palumno`; alumno = `gnral_alumnos.id_usuario = usuario_alumno`)

| Bloque | Dato | Regla / pantalla | Tablas |
|---|---|---|---|
| Métrica 1 | **Materias cursando** | `calalumnosController@index` (Calificaciones): cargas `id_status_materia = 1`, validación `IN (2,8,9)`, sin las materias especiales que excluye esa pantalla (773, 845, 853, 1160, 1263-1265, 1443, 1496, 1502, 1565-1569, 1571) | `eva_carga_academica`, `eva_validacion_de_cargas` |
| Métrica 2 | **Promedio del periodo** | Promedio de los promedios por materia con la regla de Calificaciones (0 si alguna unidad < 70; si no, promedio de unidades) | `cal_evaluaciones` |
| Barras | **Promedio por materia** | Misma regla | `gnral_materias`, `cal_evaluaciones` |
| Radial | **Materias sin unidades reprobadas** / materias cursando | Regla del índice de reprobación, aplicada al alumno | ídem |
| Línea | **Promedio por periodo** (últimos 6) | `Cal_historial_academicoController` (historial académico) — **pendiente de revisar su regla exacta** antes de implementar | `eva_carga_academica`, `cal_evaluaciones` |
| Lista | **Unidades por estado** (aprobadas / reprobadas / sin calificar, %) | Unidades de `gnral_materias.unidades` contra `cal_evaluaciones` | `gnral_materias`, `cal_evaluaciones` |
| Tabla | **Mis materias del periodo**: materia, grupo, unidades calificadas / total, promedio, estado | Calificaciones | ídem + `gnral_grupos` |

```sql
SELECT COUNT(*) FROM eva_carga_academica ca
  JOIN eva_validacion_de_cargas v ON v.id_alumno = ca.id_alumno AND v.id_periodo = ca.id_periodo
 WHERE ca.id_alumno = ? AND ca.id_periodo = ? AND ca.id_status_materia = 1
   AND v.estado_validacion IN (2, 8, 9) AND ca.id_materia NOT IN (/* materias especiales */);
```
**Validación:** alumno 1 → **0** materias. La pantalla Calificaciones (`calalumnosController@index`) también da **0** ✅. Tiene 1 carga en `eva_carga_academica`, pero su validación está en estado 1 (no validada), así que ninguna de las dos la cuenta.

### 2.2 DOCENTE (`profesor_conact` / `profesor_sinact`; docente = `id_perso`)

| Bloque | Dato | Regla / pantalla | Tablas |
|---|---|---|---|
| Métrica 1 | **Grupos-materia asignados** | `DocentesAgController@carreras` (Calificaciones del docente) | `gnral_horas_profesores`, `gnral_horarios`, `gnral_periodo_carreras`, `gnral_materias_perfiles` |
| Métrica 2 | **Estudiantes en sus grupos** | Cargas con la misma materia y grupo (como el índice de reprobación); validación `IN (2,9)` | + `eva_carga_academica`, `eva_validacion_de_cargas` |
| Barras | **Estudiantes por grupo-materia** | ídem | ídem |
| Radial | **Aprobación en sus grupos** | Regla del índice de reprobación, restringida a sus materias y grupos | + `cal_evaluaciones` |
| Línea | **Estudiantes atendidos** por periodo (últimos 6) | ídem por periodo | ídem |
| Lista | **Estudiantes por carrera** (%) de sus grupos | ídem + `gnral_carreras` | ídem |
| Tabla | **Mis grupos**: materia, grupo, carrera, estudiantes, % de aprobación | ídem | ídem |

**Validación:** docente 1 → **1** grupo-materia (CÁLCULO DIFERENCIAL, grupo 1); `DocentesAgController@carreras` muestra **1** carrera ✅. Estudiantes en sus grupos: **1** en carga, **0** validados (estado 1). ⚠ El docente vería "0 estudiantes" aunque tenga un alumno inscrito con la carga sin validar; habría que decidir si la métrica cuenta solo cargas validadas (como el índice) o todas.

### 2.3 JEFE DE DIVISIÓN (`jefe_division`; carrera = `Session::get('carrera')`)

| Bloque | Dato | Regla / pantalla | Tablas |
|---|---|---|---|
| Métrica 1 | **Inscritos de la carrera** | Estadísticas (`estadisticas_genero`) filtrado por carrera | como directivo |
| Métrica 2 | **Docentes con horario en la carrera** | `gnral_horarios` del periodo y carrera | como directivo |
| Barras | **Inscritos por semestre** | Estadísticas por semestre (la misma pantalla los desglosa así) | + `gnral_semestres` |
| Radial | **Aprobación de la carrera** | Índice de reprobación de la carrera | como directivo |
| Línea | **Matrícula de la carrera** (últimos 6 periodos) | Métrica 1 por periodo | ídem |
| Lista | **Inscritos por género** (M/F, %) | Estadísticas (Masculino/Femenino) | `gnral_alumnos` |
| Tabla | **Materias con mayor índice de reprobación** (top 10: materia, grupo, docente, alumnos, % reprobación) | `estadisticas_indice_reprobacion_sem` | `gnral_horas_profesores`, `gnral_materias`, `eva_carga_academica`, `cal_evaluaciones` |

**Validación:** carrera 1 (ISC) → **1** inscrito (semestre 8) y **2** docentes; coincide con la fila ISC de Estadísticas y del dashboard del directivo ✅.

### 2.4 SERVICIOS ESCOLARES (`escolar`)

| Bloque | Dato | Regla / pantalla | Tablas |
|---|---|---|---|
| Métrica 1 | **Estudiantes inscritos** | Estadísticas (igual que directivo) | — |
| Métrica 2 | **Cargas por validar** | `validacion_de_cargaController@index` (Revisión de cargas): `estado_validacion IN (1, 888)` del periodo | `eva_validacion_de_cargas`, `gnral_alumnos`, `gnral_carreras` |
| Barras | **Inscritos por carrera** | Estadísticas | — |
| Radial | **Avance de validación** = validadas (2,8,9) / (validadas + por validar (1,888)) | Estados que usan Estadísticas y Revisión de cargas | `eva_validacion_de_cargas` |
| Línea | **Inscritos** (últimos 6 periodos) | Estadísticas | — |
| Lista | **Inscritos por género** (%) | Estadísticas | — |
| Tabla | **Últimas modificaciones de calificaciones** del periodo (fecha, materia, docente, calificación anterior → nueva) | "Modificaciones en evaluaciones ordinarias" (`/servicios_escolares/bitacora_evaluaciones`) | `cal_bitacora_evaluaciones`, `gnral_materias`, `gnral_personales` |

**Validación:** cargas por validar = **1**, y Revisión de cargas (`validacion_de_cargaController@index`) muestra **1** ✅. Avance de validación = 2 / (2 + 1) = **66.67 %**. Bitácora de evaluaciones del periodo: **11** registros (último 2026-05-02).

Significado de los estados de validación según el código: 0 = en captura; 1 = validada por el jefe (pendiente en Escolares); 3 = rechazada por el jefe; 2 = validada por Escolares; 8 y 9 = variantes de alumnos duales validados; 888 = pendiente (usada en Revisión de cargas). **[Por confirmar con Servicios Escolares.]**

### 2.5 Genérico para los demás departamentos (RH, cómputo, residencias, titulación, finanzas, consultas, desarrollo académico)

Usa los módulos que **todo el personal** tiene en el menú: Incidencias de Asistencia y Oficios de comisión.

| Bloque | Dato | Regla / pantalla | Tablas |
|---|---|---|---|
| Métrica 1 | **Oficios de incidencias por validar** (de su personal) | `IncidenciasController@vista5` ("Validar oficios del departamento"): `id_estado_solicitud = 1`, `direc_finanzas = 0`, `id_jefe = id_perso` | `inc_solicitudes` |
| Métrica 2 | **Oficios de comisión vigentes** | `OcRegOficioController@index` ("Ver Oficios"): `oc_oficio.id_usuario = usuario_alumno` y `fecha_salida > ayer` | `oc_oficio` |
| Barras | **Solicitudes de incidencias de su personal por mes** (últimos 6 meses) | `inc_solicitudes.id_jefe = id_perso` por `fecha_solicitud` | `inc_solicitudes` |
| Radial | **Solicitudes atendidas** / total del personal a cargo | Depende del catálogo `inc_estado_solicitud` (en la BD local es ficticio) — **[por confirmar qué estados significan "atendida"]** | `inc_solicitudes`, `inc_estado_solicitud` |
| Línea | **Oficios de comisión por mes** (últimos 6 meses) | `oc_oficio` del usuario | `oc_oficio` |
| Lista | **Solicitudes por tipo de incidencia** (%) | `inc_articulos.nombre_articulo` | `inc_solicitudes`, `inc_articulos` |
| Tabla | **Oficios por validar**: personal, artículo, fecha | Igual que "Validar oficios del departamento" | `inc_solicitudes`, `inc_articulos`, `gnral_personales` |

**Validación:** para el personal 1, oficios por validar = **0** y `IncidenciasController@vista5` también devuelve **0** ✅ (consulta con `id_jefe = 1`). Oficios de comisión vigentes: **0** (todos los de prueba tienen `fecha_salida` anterior a hoy).

**Corrección:** antes había anotado un posible error en `IncidenciasController@vista5` (que usaba el objeto `$id_personal`). **No existe:** la línea 252 lo reasigna a `$id_personal->id_personal`, y la concatenación de la línea 281 está dentro de un bloque comentado. La pantalla funciona bien.

Siguiente paso posible: dashboards específicos por departamento (Residencias: anteproyectos y asesores; Titulación: alumnos por etapa; Finanzas: requisiciones y presupuesto), con la misma estructura.

---

## 3. Cómo agregar el dashboard de otro rol

1. Crea `app/Services/Panel/Datos{Rol}.php` con el mismo patrón que `DatosDirectivo` (método `paraPeriodo()` con `Cache::remember`, consultas de solo lectura y `try/catch` que devuelve `null`).
2. En `app/View/Composers/PanelInicioComposer.php`, detecta el rol con la misma bandera de sesión que usa el menú y asigna `$perfilTablero` y `$tablero`.
3. Crea `resources/views/panel/dashboard/{rol}.blade.php` usando los bloques (`metricas`, `barras`, `radial`, `linea`, `lista`, `tabla`, `sin_datos`).
4. Agrega pruebas como `tests/Feature/Panel/DashboardDirectivoTest.php` (reglas, solo lecturas, caché, "Sin datos" y que otros roles no lo vean).
5. Valida cada número contra la pantalla equivalente del sistema y documenta el resultado aquí.
