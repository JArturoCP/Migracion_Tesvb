# Auditoría sistemática de los 241 modelos Eloquent

Fecha: 12 de noviembre de 2026. Rama: codex/auditoria-modelos-laravel12. Esquema leído directamente: tesvb, MariaDB 10.4.32. Solo SELECT de information_schema.COLUMNS, TABLES, KEY_COLUMN_USAGE y variables de versión/modo SQL. Se examinaron 603 tablas y 4,312 columnas; no se leyeron filas de negocio ni se ejecutaron escrituras. Los seeders no participan en ninguna conclusión.

## Resumen y validación final

- 241 fichas y 153 relaciones revisadas. Se identificaron 40 correcciones aplicadas en 38 modelos, en grupos separados por módulo/tipo de fallo. Los conteos son hallazgos, no tablas distintas.
- Permanecen 36 hallazgos confirmados sin corregir, repartidos en 19 modelos, porque falta resolver su intención funcional o porque corregirlos requiere cambios de esquema no autorizados. Además se registran posibles incompatibilidades condicionadas a datos/modos SQL y comportamientos heredados que se conservan; una ficha puede contener más de una categoría.
- PHP 8.4.27: sintaxis correcta en los 241 modelos y los dos archivos PHP de pruebas (243 archivos).
- Pruebas PHPUnit aisladas: **5 casos aprobados, 2,873 aserciones**. Incluyen el rango horario Carbon, claves de relaciones corregidas, SQL simulado de altas sin timestamps ausentes, preservación de IDs manuales y generación exclusiva de updated_at cuando corresponde.
- La prueba de SQL utiliza pretend(), una conexión cuyo proveedor PDO lanza una excepción si se intenta conectar, y escapado local de valores de prueba para el log. No se ejecutan INSERT, UPDATE ni DELETE contra ninguna base de datos.
- El lanzador Pest Unit sigue detenido por `Cannot open bootstrap script` debido a la comprobación is_readable del entorno. No se declara aprobada la suite Pest existente. Los cinco casos PHPUnit se ejecutaron con `php tests/run-eloquent-compatibility.php` usando PHP 8.4. Feature se omite porque activa RefreshDatabase/migraciones.
- `git diff --check` correcto. Sin cambios a .env, controladores, rutas, esquema ni seeders; sin merge ni push. El código de consultas originales no se ejecutó para auditarlo.
- Evidencia reproducible: `consultas-auditoria-modelos.sql` contiene exclusivamente SELECT. `evidencia-mariadb-modelos.json` conserva la estructura de las tablas utilizadas por modelos; el informe estructurado de entrega es `auditoria-241-modelos.json`.

## Cómo interpretar este informe

Cada modelo puede tener hallazgos de varias clases: **error confirmado** (incompatibilidad demostrada con código/esquema o reproducción), **posible incompatibilidad** (requiere datos, flujo o contexto adicional) y **comportamiento heredado válido** (se conserva el contrato evaluado, sin certificar funcionalidad completa). Un error confirmado puede quedar pendiente si su solución exige cambiar el esquema o reconstruir la intención original. Los fallos de configuración heredados no se atribuyen automáticamente a Laravel 12.

Los metadatos físicos quedan en `evidencia-mariadb-modelos.json`. Los valores default se muestran tal como information_schema los devuelve: `null` JSON significa ausencia de valor en el campo de metadatos; `"NULL"` representa la expresión SQL NULL informada por MariaDB, no una cadena de negocio. Se muestran tipos completos, nulabilidad, default y EXTRA. La ausencia de FOREIGN KEY declarada no invalida por sí sola una relación Eloquent; sí se verifica la existencia de ambas columnas.

Código histórico: referencia DorianReb/tesvb, commit 36da4037a7dd478d90a5e61e3cef48b8f7e505b1 (Laravel 5.6). Aún no está certificada como revisión exacta del despliegue original. Se revisaron modelos y referencias de consumidores actuales e históricos. Las referencias textuales son navegación, pueden incluir imports sin uso/comentarios y no prueban que una ruta se ejecute. El informe JSON contiene la lista completa; aquí se muestran hasta ocho referencias por versión.

## Correcciones de esta continuación

- 32 modelos: timestamps deshabilitados porque ambas columnas faltan en MariaDB. Cambios divididos en catálogos, oficios, servicio y tutorías; preservan lecturas y evitan columnas inexistentes en escrituras Eloquent.
- oc_dependencias: CREATED_AT = null, conservando updated_at y su automatismo, igual que el caso ya corregido de oc_oficio.
- Cuatro claves sin AUTO_INCREMENT: Activa_evaluacion, Tutorias_Exp_bachillerato, Tutorias_Exp_familia_union y Tutorias_Exp_generacion pasan a incrementing=false. Los consumidores encontrados usan lecturas o actualización por clave, no un ID generado. Una futura alta debe proporcionar una clave válida explícitamente; no se cambia fillable ni se inventa generación de identificadores.
- RmBienes::adquisiciones y RmTipoadqui::bienes: id_tipoadqui confirmado en esquema y controlador original/actual. Se conserva cardinalidad. No se reescribe el fillable histórico, cuya depuración requiere revisar asignación masiva.
- AudValidarAgenda: addMinutes(30) reemplaza el argumento de texto que causaba TypeError en Carbon actual, preservando intervalos de media hora.
- Se conservan todas las ocho correcciones anteriores de primaryKey y los diez ajustes de timestamps previamente verificados.

## Riesgos prioritarios pendientes

- AudAuditoriaProceso usa SoftDeletes pero deleted_at es DATE NOT NULL, sin default. El filtro de activos IS NULL y restore no concuerdan con el esquema. No se desactiva el trait ni se modifica la tabla.
- Hay tablas efectivas ausentes, entre ellas clases auxiliares heredadas. No se inventan mapeos: una clase usada solo para helpers puede seguir funcionando sin persistir en su tabla inferida.
- Persisten relaciones de auditoría que mencionan claves ausentes y una relación de hábitos de estudio con nombre de columna incorrecto y dudas sobre el catálogo destino. Su rediseño necesita reconstruir el uso original; ver fichas.
- utf8_decode produce deprecaciones en los helpers PDF. Se conserva hasta validar la codificación y salida de documentos; no se confunde deprecación con función eliminada en PHP 8.4.
- Muchas columnas tienen defaults de fecha cero o ON UPDATE en created_at. Se documentan sin cambiar datos ni esquema. La sesión de metadatos tiene NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION; config/database.php habilita strict=true, por lo que el modo efectivo de Laravel puede ser distinto. No se arrancó la aplicación para consultar filas.
- SQL manual y consultas con agrupación requieren pruebas funcionales adicionales. Las comprobaciones de autoload, gramática y columnas no certifican resultados de todas las consultas.

## Fuentes de comportamiento del framework

Se contrastó con el código instalado de HasTimestamps, SoftDeletes, HasRelationships y Carbon, además de la documentación oficial: [Eloquent y timestamps](https://laravel.com/framework/docs/12.x/eloquent), [relaciones y claves explícitas](https://laravel.com/framework/docs/12.x/eloquent-relationships), [guía Laravel 12](https://laravel.com/framework/docs/12.x/upgrade). La configuración timestamps/constantes controla los atributos automáticos; SoftDeletes usa NULL para el estado activo. No se añaden traits por la mera presencia de deleted_at.

## Fichas por modelo

### `App\Abreviaciones`

Archivo: `app/Abreviaciones.php`. Tabla: `abreviaciones` (existe). Clave configurada: `id_abreviacion`; PRIMARY KEY físico: `id_abreviacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Abreviaciones.php`.

Consumidores actuales (6): `app/Http/Controllers/ConsultaRegActividadesController.php:8`, `app/Http/Controllers/DocenteActividadJefeController.php:7`, `app/Http/Controllers/DocentesAgController.php:15`, `app/Http/Controllers/DocentesAgController.php:217`, `app/Http/Controllers/DocentesController.php:15`, `app/Http/Controllers/SEscolaresController.php:18`.

Consumidores históricos (6): `app/Http/Controllers/ConsultaRegActividadesController.php:8`, `app/Http/Controllers/DocenteActividadJefeController.php:7`, `app/Http/Controllers/DocentesAgController.php:15`, `app/Http/Controllers/DocentesAgController.php:217`, `app/Http/Controllers/DocentesController.php:15`, `app/Http/Controllers/SEscolaresController.php:18`.

### `App\Abreviaciones_prof`

Archivo: `app/Abreviaciones_prof.php`. Tabla: `abreviaciones_prof` (existe). Clave configurada: `id_abreviacion_prof`; PRIMARY KEY físico: `id_abreviacion_prof`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `getAbreviatura` → `App\Abreviaciones`: abreviaciones_prof.id_abreviacion [int(11)] ↔ abreviaciones.id_abreviacion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `abreviaciones` → `App\Abreviaciones`: abreviaciones_prof.id_abreviacion [int(11)] ↔ abreviaciones.id_abreviacion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Abreviaciones_prof.php`.

Consumidores actuales (9): `app/Http/Controllers/ConsultaRegActividadesController.php:9`, `app/Http/Controllers/DocenteActividadJefeController.php:8`, `app/Http/Controllers/DocentesAgController.php:16`, `app/Http/Controllers/DocentesAgController.php:178`, `app/Http/Controllers/DocentesAgController.php:184`, `app/Http/Controllers/DocentesController.php:16`, `app/Http/Controllers/DocentesController.php:279`, `app/Http/Controllers/DocentesController.php:287`.

Consumidores históricos (9): `app/Http/Controllers/ConsultaRegActividadesController.php:9`, `app/Http/Controllers/DocenteActividadJefeController.php:8`, `app/Http/Controllers/DocentesAgController.php:16`, `app/Http/Controllers/DocentesAgController.php:178`, `app/Http/Controllers/DocentesAgController.php:184`, `app/Http/Controllers/DocentesController.php:16`, `app/Http/Controllers/DocentesController.php:279`, `app/Http/Controllers/DocentesController.php:287`.

### `App\Activa_evaluacion`

Archivo: `app/Activa_evaluacion.php`. Tabla: `eva_activa_evaluacion` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `false`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / ``.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **error confirmado — corregido:** incrementing ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Activa_evaluacion.php`.

Consumidores actuales (13): `app/Http/Controllers/Buscar_alumnos.php:8`, `app/Http/Controllers/Buscar_alumnos.php:167`, `app/Http/Controllers/Buscar_alumnos.php:175`, `app/Http/Controllers/Computo_calificarController.php:11`, `app/Http/Controllers/Dual_Validar_Carga_Academica_Alumno.php:10`, `app/Http/Controllers/Dual_Validar_Carga_Academica_Alumno.php:441`, `app/Http/Controllers/Dual_Validar_Carga_Academica_Alumno.php:447`, `app/Http/Controllers/Serv_Esc_Dual_Validar_Carga_Academica_AlumnoController.php:10`.

Consumidores históricos (13): `app/Http/Controllers/Buscar_alumnos.php:8`, `app/Http/Controllers/Buscar_alumnos.php:167`, `app/Http/Controllers/Buscar_alumnos.php:175`, `app/Http/Controllers/Computo_calificarController.php:11`, `app/Http/Controllers/Dual_Validar_Carga_Academica_Alumno.php:10`, `app/Http/Controllers/Dual_Validar_Carga_Academica_Alumno.php:441`, `app/Http/Controllers/Dual_Validar_Carga_Academica_Alumno.php:447`, `app/Http/Controllers/Serv_Esc_Dual_Validar_Carga_Academica_AlumnoController.php:10`.

### `App\Actividades`

Archivo: `app/Actividades.php`. Tabla: `actividades` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(10) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Actividades.php`.

Consumidores actuales (1): `app/Http/Controllers/Tutorias_Actividades_tutorController.php:32`.

Consumidores históricos (1): `app/Http/Controllers/Tutorias_Actividades_tutorController.php:32`.

### `App\ActividadesComplementarias`

Archivo: `app/ActividadesComplementarias.php`. Tabla: `actividades_complementarias` (existe). Clave configurada: `id_actividad_comple`; PRIMARY KEY físico: `id_actividad_comple`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ActividadesComplementarias.php`.

Consumidores actuales (14): `app/Http/Controllers/ConsultaRegActividadesController.php:10`, `app/Http/Controllers/DocenteActividadJefeController.php:9`, `app/Http/Controllers/DocenteActividadJefeController.php:23`, `app/Http/Controllers/LiberaActividadJefeController.php:9`, `app/Http/Controllers/PlaneaActividadProfController.php:8`, `app/Http/Controllers/PlaneaActividadProfController.php:51`, `app/Http/Controllers/PlaneaActividadProfController.php:202`, `app/Http/Controllers/RegistrarActSubController.php:10`.

Consumidores históricos (14): `app/Http/Controllers/ConsultaRegActividadesController.php:10`, `app/Http/Controllers/DocenteActividadJefeController.php:9`, `app/Http/Controllers/DocenteActividadJefeController.php:23`, `app/Http/Controllers/LiberaActividadJefeController.php:9`, `app/Http/Controllers/PlaneaActividadProfController.php:8`, `app/Http/Controllers/PlaneaActividadProfController.php:51`, `app/Http/Controllers/PlaneaActividadProfController.php:202`, `app/Http/Controllers/RegistrarActSubController.php:10`.

### `App\adscripcion_personal`

Archivo: `app/adscripcion_personal.php`. Tabla: `adscripcion_personal` (existe). Clave configurada: `id_adscripcion`; PRIMARY KEY físico: `id_adscripcion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/adscripcion_personal.php`.

Consumidores actuales (2): `app/Http/Controllers/PersonalPlantillaController.php:9`, `app/Http/Controllers/PersonalPlantillaController.php:62`.

Consumidores históricos (2): `app/Http/Controllers/PersonalPlantillaController.php:9`, `app/Http/Controllers/PersonalPlantillaController.php:62`.

### `App\Alumnos`

Archivo: `app/Alumnos.php`. Tabla: `gnral_alumnos` (existe). Clave configurada: `id_alumno`; PRIMARY KEY físico: `id_alumno`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **posible incompatibilidad — pendiente:** getAlumno referencia alias s en el ON de asigna_tutor antes de unir gnral_semestres; además asigna_tutor no figura en tesvb. Se conserva hasta resolver el flujo histórico.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 2 coincidencias. Líneas: 58, 77. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Alumnos.php`.

Consumidores actuales (32): `app/Exports/Datos_alumnExport.php:11`, `app/Exports/Datos_alumnExport.php:250`, `app/Http/Controllers/checar_cargaController.php:9`, `app/Http/Controllers/Computo_calificarController.php:8`, `app/Http/Controllers/DatosEstadisticosSubController.php:9`, `app/Http/Controllers/DatosGraficosHistoricos.php:11`, `app/Http/Controllers/datos_alumno.php:8`, `app/Http/Controllers/datos_alumno.php:53`.

Consumidores históricos (32): `app/Exports/Datos_alumnExport.php:11`, `app/Exports/Datos_alumnExport.php:250`, `app/Http/Controllers/checar_cargaController.php:9`, `app/Http/Controllers/Computo_calificarController.php:8`, `app/Http/Controllers/DatosEstadisticosSubController.php:9`, `app/Http/Controllers/DatosGraficosHistoricos.php:11`, `app/Http/Controllers/datos_alumno.php:8`, `app/Http/Controllers/datos_alumno.php:53`.

### `App\alumno_materias`

Archivo: `app/alumno_materias.php`. Tabla: `eva_alumno_materias` (existe). Clave configurada: `id_alumno_materia`; PRIMARY KEY físico: `id_alumno_materia`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/alumno_materias.php`.

Consumidores actuales (2): `app/Http/Controllers/evaluacion_alumnoController.php:21`, `app/Http/Controllers/evaluacion_alumnoController.php:358`.

Consumidores históricos (2): `app/Http/Controllers/evaluacion_alumnoController.php:21`, `app/Http/Controllers/evaluacion_alumnoController.php:358`.

### `App\amb_encargados`

Archivo: `app/amb_encargados.php`. Tabla: `amb_encargados` (existe). Clave configurada: `id_encargado`; PRIMARY KEY físico: `id_encargado`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/amb_encargados.php`.

Consumidores actuales (2): `app/Http/Controllers/Amb_encargadosController.php:7`, `app/Http/Controllers/Amb_jefe_ambientalController.php:7`.

Consumidores históricos (2): `app/Http/Controllers/Amb_encargadosController.php:7`, `app/Http/Controllers/Amb_jefe_ambientalController.php:7`.

### `App\amb_periodo_amb`

Archivo: `app/amb_periodo_amb.php`. Tabla: `amb_periodo_amb` (existe). Clave configurada: `id_periodo_amb`; PRIMARY KEY físico: `id_periodo_amb`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/amb_periodo_amb.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\amb_procedimientos`

Archivo: `app/amb_procedimientos.php`. Tabla: `amb_procedimientos` (existe). Clave configurada: `id_procedimiento`; PRIMARY KEY físico: `id_procedimiento`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/amb_procedimientos.php`.

Consumidores actuales (3): `app/Http/Controllers/Amb_encargadosController.php:8`, `app/Http/Controllers/Amb_encargadosController.php:87`, `app/Http/Controllers/Amb_jefe_ambientalController.php:8`.

Consumidores históricos (3): `app/Http/Controllers/Amb_encargadosController.php:8`, `app/Http/Controllers/Amb_encargadosController.php:87`, `app/Http/Controllers/Amb_jefe_ambientalController.php:8`.

### `App\AudAcciones`

Archivo: `app/AudAcciones.php`. Tabla: `aud_acciones` (ausente). Clave configurada: `id_acciones`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva aud_acciones no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAcciones.php`.

Consumidores actuales (2): `app/Http/Controllers/AudAccionesController.php:5`, `app/Http/Controllers/AudAccionesController.php:107`.

Consumidores históricos (2): `app/Http/Controllers/AudAccionesController.php:5`, `app/Http/Controllers/AudAccionesController.php:107`.

### `App\AudActividades`

Archivo: `app/AudActividades.php`. Tabla: `aud_actividad` (existe). Clave configurada: `id_actividad`; PRIMARY KEY físico: `id_actividad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `datetime` | NO | `null` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudActividades.php`.

Consumidores actuales (11): `app/Http/Controllers/AudActividadesController.php:5`, `app/Http/Controllers/AudActividadesController.php:21`, `app/Http/Controllers/AudActividadesController.php:50`, `app/Http/Controllers/AudActividadesController.php:96`, `app/Http/Controllers/AudActividadesController.php:111`, `app/Http/Controllers/AudAgendaController.php:5`, `app/Http/Controllers/AudAgendaController.php:393`, `app/Http/Controllers/AudAgendaController.php:668`.

Consumidores históricos (11): `app/Http/Controllers/AudActividadesController.php:5`, `app/Http/Controllers/AudActividadesController.php:21`, `app/Http/Controllers/AudActividadesController.php:50`, `app/Http/Controllers/AudActividadesController.php:96`, `app/Http/Controllers/AudActividadesController.php:111`, `app/Http/Controllers/AudAgendaController.php:5`, `app/Http/Controllers/AudAgendaController.php:393`, `app/Http/Controllers/AudAgendaController.php:668`.

### `App\AudAgenda`

Archivo: `app/AudAgenda.php`. Tabla: `aud_agenda` (existe). Clave configurada: `id_agenda`; PRIMARY KEY físico: `id_agenda`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **error confirmado — pendiente:** Relación getAsign referencia aud_agenda.id_asigna_audi, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getNombre referencia aud_agenda.id_auditor, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getAbrPer referencia aud_agenda.id_auditor, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación area referencia aud_agenda.id_area, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 4.

- `getAsign` → `App\SgcAsignaAudi`: aud_agenda.id_asigna_audi [AUSENTE] ↔ aud_asigna_audi.id_asigna_audi [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getNombre` → `App\GnralPersonales`: aud_agenda.id_auditor [AUSENTE] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbrPer` → `App\Abreviaciones_prof`: aud_agenda.id_auditor [AUSENTE] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `area` → `App\gnral_unidad_administrativa`: aud_agenda.id_area [AUSENTE] ↔ gnral_unidad_administrativa.id_unidad_admin [bigint(10)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 2 coincidencias. Líneas: 29, 32. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/AudAgenda.php`.

Consumidores actuales (39): `app/AudInforme.php:62`, `app/AudValidarAgenda.php:32`, `app/AudValidarAgenda.php:38`, `app/AudValidarAgenda.php:48`, `app/AudValidarAgenda.php:54`, `app/AudValidarAgenda.php:89`, `app/AudValidarAgenda.php:101`, `app/AudValidarAgenda.php:140`.

Consumidores históricos (39): `app/AudInforme.php:62`, `app/AudValidarAgenda.php:32`, `app/AudValidarAgenda.php:38`, `app/AudValidarAgenda.php:48`, `app/AudValidarAgenda.php:54`, `app/AudValidarAgenda.php:89`, `app/AudValidarAgenda.php:101`, `app/AudValidarAgenda.php:140`.

### `App\AudAgendaActividad`

Archivo: `app/AudAgendaActividad.php`. Tabla: `aud_agenda_actividad` (existe). Clave configurada: `id_agenda_actividad`; PRIMARY KEY físico: `id_agenda_actividad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAgendaActividad.php`.

Consumidores actuales (8): `app/AudValidarAgenda.php:63`, `app/AudValidarAgenda.php:67`, `app/Http/Controllers/AudAgendaController.php:7`, `app/Http/Controllers/AudAgendaController.php:118`, `app/Http/Controllers/AudAgendaController.php:394`, `app/Http/Controllers/AudAgendaController.php:836`, `app/Http/Controllers/AudAgendaEventoController.php:7`, `app/Http/Controllers/AudPrintController.php:6`.

Consumidores históricos (8): `app/AudValidarAgenda.php:63`, `app/AudValidarAgenda.php:67`, `app/Http/Controllers/AudAgendaController.php:7`, `app/Http/Controllers/AudAgendaController.php:118`, `app/Http/Controllers/AudAgendaController.php:394`, `app/Http/Controllers/AudAgendaController.php:836`, `app/Http/Controllers/AudAgendaEventoController.php:7`, `app/Http/Controllers/AudPrintController.php:6`.

### `App\AudAgendaActividadArea`

Archivo: `app/AudAgendaActividadArea.php`. Tabla: `aud_agenda_actividad_area` (existe). Clave configurada: `id_agenda_actividad_area`; PRIMARY KEY físico: `id_agenda_actividad_area`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAgendaActividadArea.php`.

Consumidores actuales (5): `app/Http/Controllers/AudAgendaController.php:8`, `app/Http/Controllers/AudAgendaController.php:128`, `app/Http/Controllers/AudAgendaController.php:403`, `app/Http/Controllers/AudAgendaController.php:835`, `app/Http/Controllers/AudAgendaEventoController.php:8`.

Consumidores históricos (5): `app/Http/Controllers/AudAgendaController.php:8`, `app/Http/Controllers/AudAgendaController.php:128`, `app/Http/Controllers/AudAgendaController.php:403`, `app/Http/Controllers/AudAgendaController.php:835`, `app/Http/Controllers/AudAgendaEventoController.php:8`.

### `App\AudAgendaActividadPersona`

Archivo: `app/AudAgendaActividadPersona.php`. Tabla: `aud_agenda_actividad_persona` (existe). Clave configurada: `id_agenda_actividad_persona`; PRIMARY KEY físico: `id_agenda_actividad_persona`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAgendaActividadPersona.php`.

Consumidores actuales (7): `app/Http/Controllers/AudAgendaController.php:9`, `app/Http/Controllers/AudAgendaController.php:135`, `app/Http/Controllers/AudAgendaController.php:431`, `app/Http/Controllers/AudAgendaController.php:453`, `app/Http/Controllers/AudAgendaController.php:458`, `app/Http/Controllers/AudAgendaController.php:834`, `app/Http/Controllers/AudAgendaEventoController.php:9`.

Consumidores históricos (7): `app/Http/Controllers/AudAgendaController.php:9`, `app/Http/Controllers/AudAgendaController.php:135`, `app/Http/Controllers/AudAgendaController.php:431`, `app/Http/Controllers/AudAgendaController.php:453`, `app/Http/Controllers/AudAgendaController.php:458`, `app/Http/Controllers/AudAgendaController.php:834`, `app/Http/Controllers/AudAgendaEventoController.php:9`.

### `App\AudAgendaArea`

Archivo: `app/AudAgendaArea.php`. Tabla: `aud_agenda_area` (existe). Clave configurada: `id_agenda_area`; PRIMARY KEY físico: `id_agenda_area`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAgendaArea.php`.

Consumidores actuales (10): `app/Http/Controllers/AudAgendaController.php:10`, `app/Http/Controllers/AudAgendaController.php:110`, `app/Http/Controllers/AudAgendaController.php:355`, `app/Http/Controllers/AudAgendaController.php:826`, `app/Http/Controllers/AudAgendaEventoController.php:10`, `app/Http/Controllers/AudAgendaEventoController.php:186`, `app/Http/Controllers/AudAgendaEventoController.php:396`, `app/Http/Controllers/AudPrintController.php:7`.

Consumidores históricos (10): `app/Http/Controllers/AudAgendaController.php:10`, `app/Http/Controllers/AudAgendaController.php:110`, `app/Http/Controllers/AudAgendaController.php:355`, `app/Http/Controllers/AudAgendaController.php:826`, `app/Http/Controllers/AudAgendaEventoController.php:10`, `app/Http/Controllers/AudAgendaEventoController.php:186`, `app/Http/Controllers/AudAgendaEventoController.php:396`, `app/Http/Controllers/AudPrintController.php:7`.

### `App\AudAgendaAuditor`

Archivo: `app/AudAgendaAuditor.php`. Tabla: `aud_agenda_auditor` (existe). Clave configurada: `id_agenda_auditor`; PRIMARY KEY físico: `id_agenda_auditor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAgendaAuditor.php`.

Consumidores actuales (9): `app/Http/Controllers/AudAgendaController.php:11`, `app/Http/Controllers/AudAgendaController.php:104`, `app/Http/Controllers/AudAgendaController.php:291`, `app/Http/Controllers/AudAgendaController.php:827`, `app/Http/Controllers/AudAgendaEventoController.php:11`, `app/Http/Controllers/AudAgendaEventoController.php:127`, `app/Http/Controllers/AudAgendaEventoController.php:337`, `app/Http/Controllers/AudGeneralesController.php:5`.

Consumidores históricos (9): `app/Http/Controllers/AudAgendaController.php:11`, `app/Http/Controllers/AudAgendaController.php:104`, `app/Http/Controllers/AudAgendaController.php:291`, `app/Http/Controllers/AudAgendaController.php:827`, `app/Http/Controllers/AudAgendaEventoController.php:11`, `app/Http/Controllers/AudAgendaEventoController.php:127`, `app/Http/Controllers/AudAgendaEventoController.php:337`, `app/Http/Controllers/AudGeneralesController.php:5`.

### `App\AudAgendaEvento`

Archivo: `app/AudAgendaEvento.php`. Tabla: `aud_agenda_evento` (existe). Clave configurada: `id_agenda_evento`; PRIMARY KEY físico: `id_agenda_evento`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | NO | `null` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAgendaEvento.php`.

Consumidores actuales (10): `app/Http/Controllers/AudAgendaController.php:12`, `app/Http/Controllers/AudAgendaController.php:171`, `app/Http/Controllers/AudAgendaController.php:177`, `app/Http/Controllers/AudAgendaEventoController.php:12`, `app/Http/Controllers/AudAgendaEventoController.php:251`, `app/Http/Controllers/AudAgendaEventoController.php:598`, `app/Http/Controllers/AudAgendaEventoController.php:600`, `app/Http/Controllers/AudAgendaEventoController.php:603`.

Consumidores históricos (10): `app/Http/Controllers/AudAgendaController.php:12`, `app/Http/Controllers/AudAgendaController.php:171`, `app/Http/Controllers/AudAgendaController.php:177`, `app/Http/Controllers/AudAgendaEventoController.php:12`, `app/Http/Controllers/AudAgendaEventoController.php:251`, `app/Http/Controllers/AudAgendaEventoController.php:598`, `app/Http/Controllers/AudAgendaEventoController.php:600`, `app/Http/Controllers/AudAgendaEventoController.php:603`.

### `App\AudAgendaProceso`

Archivo: `app/AudAgendaProceso.php`. Tabla: `aud_agenda_proceso` (existe). Clave configurada: `id_agenda_proceso`; PRIMARY KEY físico: `id_agenda_proceso`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAgendaProceso.php`.

Consumidores actuales (8): `app/Http/Controllers/AudAgendaController.php:13`, `app/Http/Controllers/AudAgendaController.php:98`, `app/Http/Controllers/AudAgendaController.php:337`, `app/Http/Controllers/AudAgendaController.php:828`, `app/Http/Controllers/AudAgendaEventoController.php:13`, `app/Http/Controllers/AudAgendaEventoController.php:169`, `app/Http/Controllers/AudAgendaEventoController.php:379`, `app/Http/Controllers/AudPrintController.php:10`.

Consumidores históricos (8): `app/Http/Controllers/AudAgendaController.php:13`, `app/Http/Controllers/AudAgendaController.php:98`, `app/Http/Controllers/AudAgendaController.php:337`, `app/Http/Controllers/AudAgendaController.php:828`, `app/Http/Controllers/AudAgendaEventoController.php:13`, `app/Http/Controllers/AudAgendaEventoController.php:169`, `app/Http/Controllers/AudAgendaEventoController.php:379`, `app/Http/Controllers/AudPrintController.php:10`.

### `App\AudAnalisisDatos`

Archivo: `app/AudAnalisisDatos.php`. Tabla: `aud_analisis_datos` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_analisis_datos no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAnalisisDatos.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\AudAreaGeneral`

Archivo: `app/AudAreaGeneral.php`. Tabla: `aud_area_general` (existe). Clave configurada: `id_area_general`; PRIMARY KEY físico: `id_area_general`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `datetime` | YES | `"NULL"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAreaGeneral.php`.

Consumidores actuales (15): `app/AudValidarAgenda.php:77`, `app/AudValidarAgenda.php:163`, `app/Http/Controllers/AudAgendaController.php:14`, `app/Http/Controllers/AudAgendaController.php:264`, `app/Http/Controllers/AudAgendaController.php:886`, `app/Http/Controllers/AudAgendaEventoController.php:14`, `app/Http/Controllers/AudAgendaEventoController.php:113`, `app/Http/Controllers/AudAgendaEventoController.php:283`.

Consumidores históricos (15): `app/AudValidarAgenda.php:77`, `app/AudValidarAgenda.php:163`, `app/Http/Controllers/AudAgendaController.php:14`, `app/Http/Controllers/AudAgendaController.php:264`, `app/Http/Controllers/AudAgendaController.php:886`, `app/Http/Controllers/AudAgendaEventoController.php:14`, `app/Http/Controllers/AudAgendaEventoController.php:113`, `app/Http/Controllers/AudAgendaEventoController.php:283`.

### `App\AudAreaGeneralUnidad`

Archivo: `app/AudAreaGeneralUnidad.php`. Tabla: `aud_area_general_unidad` (existe). Clave configurada: `id_area_general_unidad`; PRIMARY KEY físico: `id_area_general_unidad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | NO | `null` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAreaGeneralUnidad.php`.

Consumidores actuales (12): `app/Http/Controllers/AudAgendaController.php:15`, `app/Http/Controllers/AudAgendaController.php:267`, `app/Http/Controllers/AudAgendaEventoController.php:15`, `app/Http/Controllers/AudAgendaEventoController.php:116`, `app/Http/Controllers/AudAgendaEventoController.php:286`, `app/Http/Controllers/AudGeneralesController.php:7`, `app/Http/Controllers/AudGeneralesController.php:29`, `app/Http/Controllers/AudGeneralesController.php:111`.

Consumidores históricos (12): `app/Http/Controllers/AudAgendaController.php:15`, `app/Http/Controllers/AudAgendaController.php:267`, `app/Http/Controllers/AudAgendaEventoController.php:15`, `app/Http/Controllers/AudAgendaEventoController.php:116`, `app/Http/Controllers/AudAgendaEventoController.php:286`, `app/Http/Controllers/AudGeneralesController.php:7`, `app/Http/Controllers/AudGeneralesController.php:29`, `app/Http/Controllers/AudGeneralesController.php:111`.

### `App\AudAsignaAuditoria`

Archivo: `app/AudAsignaAuditoria.php`. Tabla: `aud_asigna_audi` (existe). Clave configurada: `id_asigna_audi`; PRIMARY KEY físico: `id_asigna_audi`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **error confirmado — pendiente:** Relación getAgenda referencia aud_agenda.id_asigna_audi, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 5.

- `getNombre` → `App\GnralPersonales`: aud_asigna_audi.id_auditor [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbrPer` → `App\Abreviaciones_prof`: aud_asigna_audi.id_auditor [int(11)] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAgenda` → `App\SgcAgenda`: aud_asigna_audi.id_asigna_audi [int(11)] ↔ aud_agenda.id_asigna_audi [AUSENTE]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAsign` → `App\SgcAsignaAudi`: aud_asigna_audi.id_asigna_audi [int(11)] ↔ aud_asigna_audi.id_asigna_audi [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAuditoria` → `App\SgcAuditorias`: aud_asigna_audi.id_auditoria [int(11)] ↔ aud_auditoria.id_auditoria [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAsignaAuditoria.php`.

Consumidores actuales (1): `app/Http/Controllers/AudPrintController.php:13`.

Consumidores históricos (1): `app/Http/Controllers/AudPrintController.php:13`.

### `App\AudAuditorAuditoria`

Archivo: `app/AudAuditorAuditoria.php`. Tabla: `aud_auditor_auditoria` (existe). Clave configurada: `id_auditor_auditoria`; PRIMARY KEY físico: `id_auditor_auditoria`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **error confirmado — pendiente:** Relación getAbrPer referencia aud_auditor_auditoria.id_auditor, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getAgenda referencia aud_auditor_auditoria.id_asigna_audi, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getAgenda referencia aud_agenda.id_asigna_audi, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getAsign referencia aud_auditor_auditoria.id_asigna_audi, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 6.

- `getName` → `App\GnralPersonales`: aud_auditor_auditoria.id_personal [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbr` → `App\Abreviaciones_prof`: aud_auditor_auditoria.id_personal [int(11)] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbrPer` → `App\Abreviaciones_prof`: aud_auditor_auditoria.id_auditor [AUSENTE] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAgenda` → `App\SgcAgenda`: aud_auditor_auditoria.id_asigna_audi [AUSENTE] ↔ aud_agenda.id_asigna_audi [AUSENTE]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAsign` → `App\SgcAsignaAudi`: aud_auditor_auditoria.id_asigna_audi [AUSENTE] ↔ aud_asigna_audi.id_asigna_audi [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAuditoria` → `App\SgcAuditorias`: aud_auditor_auditoria.id_auditoria [int(11)] ↔ aud_auditoria.id_auditoria [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAuditorAuditoria.php`.

Consumidores actuales (34): `app/AudInforme.php:32`, `app/AudInforme.php:39`, `app/AudInforme.php:46`, `app/Http/Controllers/AudAgendaController.php:16`, `app/Http/Controllers/AudAgendaController.php:242`, `app/Http/Controllers/AudAgendaController.php:673`, `app/Http/Controllers/AudAgendaEventoController.php:16`, `app/Http/Controllers/AudAgendaEventoController.php:92`.

Consumidores históricos (34): `app/AudInforme.php:32`, `app/AudInforme.php:39`, `app/AudInforme.php:46`, `app/Http/Controllers/AudAgendaController.php:16`, `app/Http/Controllers/AudAgendaController.php:242`, `app/Http/Controllers/AudAgendaController.php:673`, `app/Http/Controllers/AudAgendaEventoController.php:16`, `app/Http/Controllers/AudAgendaEventoController.php:92`.

### `App\AudAuditores`

Archivo: `app/AudAuditores.php`. Tabla: `aud_auditores` (existe). Clave configurada: `id_auditores`; PRIMARY KEY físico: `id_auditores`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `getName` → `App\GnralPersonales`: aud_auditores.id_personal [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbr` → `App\Abreviaciones_prof`: aud_auditores.id_personal [int(11)] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAuditores.php`.

Consumidores actuales (47): `app/Http/Controllers/AudAgendaController.php:17`, `app/Http/Controllers/AudAgendaController.php:388`, `app/Http/Controllers/AudAgendaController.php:389`, `app/Http/Controllers/AudAgendaEventoController.php:17`, `app/Http/Controllers/AudAuditorAuditoriaController.php:5`, `app/Http/Controllers/AudAuditoresController.php:5`, `app/Http/Controllers/AudAuditoresController.php:23`, `app/Http/Controllers/AudAuditoresController.php:24`.

Consumidores históricos (47): `app/Http/Controllers/AudAgendaController.php:17`, `app/Http/Controllers/AudAgendaController.php:388`, `app/Http/Controllers/AudAgendaController.php:389`, `app/Http/Controllers/AudAgendaEventoController.php:17`, `app/Http/Controllers/AudAuditorAuditoriaController.php:5`, `app/Http/Controllers/AudAuditoresController.php:5`, `app/Http/Controllers/AudAuditoresController.php:23`, `app/Http/Controllers/AudAuditoresController.php:24`.

### `App\AudAuditoriaProceso`

Archivo: `app/AudAuditoriaProceso.php`. Tabla: `aud_auditoria_proceso` (existe). Clave configurada: `id_auditoria_proceso`; PRIMARY KEY físico: `id_auditoria_proceso`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | NO | `null` |  |

Hallazgos:

- **error confirmado — pendiente:** SoftDeletes exige NULL para registros activos y restore(), pero deleted_at es NOT NULL. No se altera el trait ni el esquema: requiere decisión funcional y saneamiento autorizado fuera de este alcance.
- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `getProceso` → `App\ri_proceso`: aud_auditoria_proceso.id_proceso [int(11)] ↔ ri_proceso.id_proceso [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getProcesos` → `App\ri_proceso`: aud_auditoria_proceso.id_proceso [int(11)] ↔ ri_proceso.id_proceso [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudAuditoriaProceso.php`.

Consumidores actuales (20): `app/AudPrint.php:22`, `app/Http/Controllers/AudAgendaController.php:18`, `app/Http/Controllers/AudAgendaController.php:759`, `app/Http/Controllers/AudAuditoriaProcesoController.php:5`, `app/Http/Controllers/AudAuditoriaProcesoController.php:56`, `app/Http/Controllers/AudAuditoriaProcesoController.php:57`, `app/Http/Controllers/AudAuditoriaProcesoController.php:69`, `app/Http/Controllers/AudAuditoriaProcesoController.php:109`.

Consumidores históricos (20): `app/AudPrint.php:22`, `app/Http/Controllers/AudAgendaController.php:18`, `app/Http/Controllers/AudAgendaController.php:759`, `app/Http/Controllers/AudAuditoriaProcesoController.php:5`, `app/Http/Controllers/AudAuditoriaProcesoController.php:56`, `app/Http/Controllers/AudAuditoriaProcesoController.php:57`, `app/Http/Controllers/AudAuditoriaProcesoController.php:69`, `app/Http/Controllers/AudAuditoriaProcesoController.php:109`.

### `App\AudAuditorias`

Archivo: `app/AudAuditorias.php`. Tabla: `aud_auditoria` (existe). Clave configurada: `id_auditoria`; PRIMARY KEY físico: `id_auditoria`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | YES | `"NULL"` |  |
| `updated_at` | `date` | YES | `"NULL"` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getProcesos` → `App\AudAuditoriaProceso`: aud_auditoria.id_auditoria [int(11)] ↔ aud_auditoria_proceso.id_auditoria [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 1 coincidencias. Líneas: 32. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/AudAuditorias.php`.

Consumidores actuales (62): `app/AudPrint.php:15`, `app/Http/Controllers/AudAccionesController.php:6`, `app/Http/Controllers/AudAgendaController.php:19`, `app/Http/Controllers/AudAgendaController.php:220`, `app/Http/Controllers/AudAgendaController.php:222`, `app/Http/Controllers/AudAgendaController.php:223`, `app/Http/Controllers/AudAgendaController.php:641`, `app/Http/Controllers/AudAgendaController.php:642`.

Consumidores históricos (62): `app/AudPrint.php:15`, `app/Http/Controllers/AudAccionesController.php:6`, `app/Http/Controllers/AudAgendaController.php:19`, `app/Http/Controllers/AudAgendaController.php:220`, `app/Http/Controllers/AudAgendaController.php:222`, `app/Http/Controllers/AudAgendaController.php:223`, `app/Http/Controllers/AudAgendaController.php:641`, `app/Http/Controllers/AudAgendaController.php:642`.

### `App\AudCategoria`

Archivo: `app/AudCategoria.php`. Tabla: `aud_categoria` (existe). Clave configurada: `id_categoria`; PRIMARY KEY físico: `id_categoria`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudCategoria.php`.

Consumidores actuales (4): `app/Http/Controllers/AudAuditorAuditoriaController.php:7`, `app/Http/Controllers/AudAuditorAuditoriaController.php:97`, `app/Http/Controllers/AudAuditoresController.php:6`, `app/Http/Controllers/AudAuditoresController.php:40`.

Consumidores históricos (4): `app/Http/Controllers/AudAuditorAuditoriaController.php:7`, `app/Http/Controllers/AudAuditorAuditoriaController.php:97`, `app/Http/Controllers/AudAuditoresController.php:6`, `app/Http/Controllers/AudAuditoresController.php:40`.

### `App\AudClasificacion`

Archivo: `app/AudClasificacion.php`. Tabla: `aud_clasificacion` (existe). Clave configurada: `id_clasificacion`; PRIMARY KEY físico: `id_clasificacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudClasificacion.php`.

Consumidores actuales (2): `app/Http/Controllers/AudReporteController.php:9`, `app/Http/Controllers/AudReporteController.php:128`.

Consumidores históricos (2): `app/Http/Controllers/AudReporteController.php:9`, `app/Http/Controllers/AudReporteController.php:128`.

### `App\AudEvidencia`

Archivo: `app/AudEvidencia.php`. Tabla: `aud_evidencias` (existe). Clave configurada: `id_evidencia`; PRIMARY KEY físico: `id_evidencia`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudEvidencia.php`.

Consumidores actuales (2): `app/Http/Controllers/AudAccionesController.php:7`, `app/Http/Controllers/AudAccionesController.php:142`.

Consumidores históricos (2): `app/Http/Controllers/AudAccionesController.php:7`, `app/Http/Controllers/AudAccionesController.php:142`.

### `App\AudEvidenciasAcciones`

Archivo: `app/AudEvidenciasAcciones.php`. Tabla: `aud_evidencias_acciones` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_evidencias_acciones no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudEvidenciasAcciones.php`.

Consumidores actuales (1): `app/Http/Controllers/AudEvidenciasAccionesController.php:5`.

Consumidores históricos (1): `app/Http/Controllers/AudEvidenciasAccionesController.php:5`.

### `App\AudFortaleza`

Archivo: `app/AudFortaleza.php`. Tabla: `aud_fortalezas` (existe). Clave configurada: `id_fortaleza`; PRIMARY KEY físico: `id_fortaleza`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudFortaleza.php`.

Consumidores actuales (1): `app/AudInforme.php:106`.

Consumidores históricos (1): `app/AudInforme.php:106`.

### `App\AudHoja`

Archivo: `app/AudHoja.php`. Tabla: `aud_hojas` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_hojas no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudHoja.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\AudInforme`

Archivo: `app/AudInforme.php`. Tabla: `aud_informe` (existe). Clave configurada: `id_informe`; PRIMARY KEY físico: `id_informe`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudInforme.php`.

Consumidores actuales (23): `app/Http/Controllers/AudAccionesController.php:8`, `app/Http/Controllers/AudInformeController.php:8`, `app/Http/Controllers/AudInformeController.php:57`, `app/Http/Controllers/AudInformeController.php:59`, `app/Http/Controllers/AudInformeController.php:89`, `app/Http/Controllers/AudInformeController.php:90`, `app/Http/Controllers/AudInformeController.php:91`, `app/Http/Controllers/AudInformeController.php:92`.

Consumidores históricos (23): `app/Http/Controllers/AudAccionesController.php:8`, `app/Http/Controllers/AudInformeController.php:8`, `app/Http/Controllers/AudInformeController.php:57`, `app/Http/Controllers/AudInformeController.php:59`, `app/Http/Controllers/AudInformeController.php:89`, `app/Http/Controllers/AudInformeController.php:90`, `app/Http/Controllers/AudInformeController.php:91`, `app/Http/Controllers/AudInformeController.php:92`.

### `App\AudInformeEstado`

Archivo: `app/AudInformeEstado.php`. Tabla: `aud_informe_estados` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_informe_estados no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudInformeEstado.php`.

Consumidores actuales (3): `app/Http/Controllers/AudInformeEstadoController.php:7`, `app/Http/Controllers/AudInformeEstadoController.php:171`, `app/Http/Controllers/AudInformeEstadoController.php:177`.

Consumidores históricos (3): `app/Http/Controllers/AudInformeEstadoController.php:7`, `app/Http/Controllers/AudInformeEstadoController.php:171`, `app/Http/Controllers/AudInformeEstadoController.php:177`.

### `App\AudLiderAcciones`

Archivo: `app/AudLiderAcciones.php`. Tabla: `aud_lider_acciones` (existe). Clave configurada: `id_lider`; PRIMARY KEY físico: `id_lider`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `personal` → `App\Gnral_Personales`: aud_lider_acciones.id_personal [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudLiderAcciones.php`.

Consumidores actuales (13): `app/Http/Controllers/AudLiderAccionesController.php:9`, `app/Http/Controllers/AudLiderAccionesController.php:24`, `app/Http/Controllers/AudLiderAccionesController.php:271`, `app/Http/Controllers/AudLiderAccionesController.php:283`, `app/Http/Controllers/AudLiderAccionesController.php:448`, `app/Http/Controllers/AudLiderAccionesController.php:501`, `app/Http/Controllers/AudLiderAccionesController.php:570`, `app/Http/Controllers/AudLiderAccionesController.php:774`.

Consumidores históricos (13): `app/Http/Controllers/AudLiderAccionesController.php:9`, `app/Http/Controllers/AudLiderAccionesController.php:24`, `app/Http/Controllers/AudLiderAccionesController.php:271`, `app/Http/Controllers/AudLiderAccionesController.php:283`, `app/Http/Controllers/AudLiderAccionesController.php:448`, `app/Http/Controllers/AudLiderAccionesController.php:501`, `app/Http/Controllers/AudLiderAccionesController.php:570`, `app/Http/Controllers/AudLiderAccionesController.php:774`.

### `App\AudNormatividad`

Archivo: `app/AudNormatividad.php`. Tabla: `aud_normatividad` (existe). Clave configurada: `id_normatividad`; PRIMARY KEY físico: `id_normatividad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | YES | `"NULL"` |  |
| `updated_at` | `date` | YES | `"NULL"` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudNormatividad.php`.

Consumidores actuales (5): `app/Http/Controllers/AudNormatividadController.php:5`, `app/Http/Controllers/AudNormatividadController.php:18`, `app/Http/Controllers/AudNormatividadController.php:47`, `app/Http/Controllers/AudNormatividadController.php:89`, `app/Http/Controllers/AudNormatividadController.php:102`.

Consumidores históricos (5): `app/Http/Controllers/AudNormatividadController.php:5`, `app/Http/Controllers/AudNormatividadController.php:18`, `app/Http/Controllers/AudNormatividadController.php:47`, `app/Http/Controllers/AudNormatividadController.php:89`, `app/Http/Controllers/AudNormatividadController.php:102`.

### `App\AudNormatividadAuditoria`

Archivo: `app/AudNormatividadAuditoria.php`. Tabla: `aud_normatividad_auditoria` (existe). Clave configurada: `id_normatividad_auditoria`; PRIMARY KEY físico: `id_normatividad_auditoria`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getCriterio` → `App\SgcNormatividad`: aud_normatividad_auditoria.id_normatividad [int(11)] ↔ aud_normatividad.id_normatividad [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudNormatividadAuditoria.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\AudNota`

Archivo: `app/AudNota.php`. Tabla: `aud_notas` (existe). Clave configurada: `id_notas`; PRIMARY KEY físico: `id_notas`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudNota.php`.

Consumidores actuales (15): `app/Http/Controllers/AudAccionesController.php:9`, `app/Http/Controllers/AudReporteController.php:10`, `app/Http/Controllers/AudReporteController.php:116`, `app/Http/Controllers/AudReporteController.php:122`, `app/Http/Controllers/AudReporteController.php:126`, `app/Http/Controllers/AudReporteController.php:156`, `app/Http/Controllers/AudReporteController.php:193`, `app/Http/Controllers/AudReporteController.php:217`.

Consumidores históricos (15): `app/Http/Controllers/AudAccionesController.php:9`, `app/Http/Controllers/AudReporteController.php:10`, `app/Http/Controllers/AudReporteController.php:116`, `app/Http/Controllers/AudReporteController.php:122`, `app/Http/Controllers/AudReporteController.php:126`, `app/Http/Controllers/AudReporteController.php:156`, `app/Http/Controllers/AudReporteController.php:193`, `app/Http/Controllers/AudReporteController.php:217`.

### `App\AudObjetivo`

Archivo: `app/AudObjetivo.php`. Tabla: `aud_objetivo` (existe). Clave configurada: `id_objetivo`; PRIMARY KEY físico: `id_objetivo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudObjetivo.php`.

Consumidores actuales (6): `app/Http/Controllers/AudObjetivoController.php:5`, `app/Http/Controllers/AudObjetivoController.php:18`, `app/Http/Controllers/AudObjetivoController.php:47`, `app/Http/Controllers/AudObjetivoController.php:89`, `app/Http/Controllers/AudObjetivoController.php:102`, `app/Http/Controllers/AudProgramasController.php:8`.

Consumidores históricos (6): `app/Http/Controllers/AudObjetivoController.php:5`, `app/Http/Controllers/AudObjetivoController.php:18`, `app/Http/Controllers/AudObjetivoController.php:47`, `app/Http/Controllers/AudObjetivoController.php:89`, `app/Http/Controllers/AudObjetivoController.php:102`, `app/Http/Controllers/AudProgramasController.php:8`.

### `App\audParseCase`

Archivo: `app/audParseCase.php`. Tabla: `aud_parse_cases` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_parse_cases no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **error confirmado — pendiente:** Deprecación utf8_decode reproducida en PHP 8.4 (tres helpers PDF). No es eliminación de la función; sustituir exige preservar los bytes ISO-8859-1 consumidos por FPDF y validar documentos.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 3 coincidencias. Líneas: 22, 31, 36. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/audParseCase.php`.

Consumidores actuales (107): `app/Http/Controllers/AudAgendaController.php:20`, `app/Http/Controllers/AudAgendaController.php:350`, `app/Http/Controllers/AudAgendaController.php:364`, `app/Http/Controllers/AudAgendaController.php:413`, `app/Http/Controllers/AudAgendaEventoController.php:19`, `app/Http/Controllers/AudAgendaEventoController.php:106`, `app/Http/Controllers/AudAgendaEventoController.php:181`, `app/Http/Controllers/AudAgendaEventoController.php:196`.

Consumidores históricos (107): `app/Http/Controllers/AudAgendaController.php:20`, `app/Http/Controllers/AudAgendaController.php:350`, `app/Http/Controllers/AudAgendaController.php:364`, `app/Http/Controllers/AudAgendaController.php:413`, `app/Http/Controllers/AudAgendaEventoController.php:19`, `app/Http/Controllers/AudAgendaEventoController.php:106`, `app/Http/Controllers/AudAgendaEventoController.php:181`, `app/Http/Controllers/AudAgendaEventoController.php:196`.

### `App\AudPdfHoja`

Archivo: `app/AudPdfHoja.php`. Tabla: `aud_pdf_hojas` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_pdf_hojas no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudPdfHoja.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\AudPersonalGeneral`

Archivo: `app/AudPersonalGeneral.php`. Tabla: `aud_personal_general` (existe). Clave configurada: `id_personal_general`; PRIMARY KEY físico: `id_personal_general`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `datetime` | YES | `"NULL"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudPersonalGeneral.php`.

Consumidores actuales (9): `app/AudValidarAgenda.php:130`, `app/Http/Controllers/AudAgendaController.php:21`, `app/Http/Controllers/AudAgendaController.php:276`, `app/Http/Controllers/AudAgendaEventoController.php:20`, `app/Http/Controllers/AudGeneralesController.php:10`, `app/Http/Controllers/AudGeneralesController.php:59`, `app/Http/Controllers/AudGeneralesController.php:119`, `app/Http/Controllers/AudGeneralesController.php:186`.

Consumidores históricos (9): `app/AudValidarAgenda.php:130`, `app/Http/Controllers/AudAgendaController.php:21`, `app/Http/Controllers/AudAgendaController.php:276`, `app/Http/Controllers/AudAgendaEventoController.php:20`, `app/Http/Controllers/AudGeneralesController.php:10`, `app/Http/Controllers/AudGeneralesController.php:59`, `app/Http/Controllers/AudGeneralesController.php:119`, `app/Http/Controllers/AudGeneralesController.php:186`.

### `App\AudPersonalGeneralAuditor`

Archivo: `app/AudPersonalGeneralAuditor.php`. Tabla: `aud_personal_general_auditor` (ausente). Clave configurada: `id_personal_general_auditor`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva aud_personal_general_auditor no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudPersonalGeneralAuditor.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\AudPersonalGeneralPersonal`

Archivo: `app/AudPersonalGeneralPersonal.php`. Tabla: `aud_personal_general_persona` (existe). Clave configurada: `id_personal_general_persona`; PRIMARY KEY físico: `id_personal_general_persona`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `datetime` | YES | `"NULL"` |  |
| `updated_at` | `datetime` | YES | `"NULL"` |  |
| `deleted_at` | `datetime` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudPersonalGeneralPersonal.php`.

Consumidores actuales (9): `app/Http/Controllers/AudAgendaController.php:22`, `app/Http/Controllers/AudAgendaController.php:279`, `app/Http/Controllers/AudAgendaEventoController.php:21`, `app/Http/Controllers/AudGeneralesController.php:11`, `app/Http/Controllers/AudGeneralesController.php:61`, `app/Http/Controllers/AudGeneralesController.php:124`, `app/Http/Controllers/AudGeneralesController.php:187`, `app/Http/Controllers/AudGeneralesController.php:190`.

Consumidores históricos (9): `app/Http/Controllers/AudAgendaController.php:22`, `app/Http/Controllers/AudAgendaController.php:279`, `app/Http/Controllers/AudAgendaEventoController.php:21`, `app/Http/Controllers/AudGeneralesController.php:11`, `app/Http/Controllers/AudGeneralesController.php:61`, `app/Http/Controllers/AudGeneralesController.php:124`, `app/Http/Controllers/AudGeneralesController.php:187`, `app/Http/Controllers/AudGeneralesController.php:190`.

### `App\AudPlanAccion`

Archivo: `app/AudPlanAccion.php`. Tabla: `aud_plan_acciones` (existe). Clave configurada: `id_plan_acciones`; PRIMARY KEY físico: `id_plan_acciones`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudPlanAccion.php`.

Consumidores actuales (23): `app/Http/Controllers/AudAccionesController.php:10`, `app/Http/Controllers/AudAccionesController.php:228`, `app/Http/Controllers/AudAccionesController.php:236`, `app/Http/Controllers/AudAccionesController.php:269`, `app/Http/Controllers/AudAccionesController.php:277`, `app/Http/Controllers/AudAccionesController.php:310`, `app/Http/Controllers/AudAccionesController.php:318`, `app/Http/Controllers/AudLiderAccionesController.php:11`.

Consumidores históricos (23): `app/Http/Controllers/AudAccionesController.php:10`, `app/Http/Controllers/AudAccionesController.php:228`, `app/Http/Controllers/AudAccionesController.php:236`, `app/Http/Controllers/AudAccionesController.php:269`, `app/Http/Controllers/AudAccionesController.php:277`, `app/Http/Controllers/AudAccionesController.php:310`, `app/Http/Controllers/AudAccionesController.php:318`, `app/Http/Controllers/AudLiderAccionesController.php:11`.

### `App\AudPrint`

Archivo: `app/AudPrint.php`. Tabla: `aud_prints` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_prints no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudPrint.php`.

Consumidores actuales (20): `app/Http/Controllers/AudPrintController.php:20`, `app/Http/Controllers/AudPrintController.php:321`, `app/Http/Controllers/AudPrintController.php:533`, `app/Http/Controllers/AudPrintController.php:541`, `app/Http/Controllers/AudPrintController.php:547`, `app/Http/Controllers/AudPrintController.php:1116`, `app/Http/Controllers/AudPrintController.php:1272`, `app/Http/Controllers/AudPrintController.php:1283`.

Consumidores históricos (20): `app/Http/Controllers/AudPrintController.php:20`, `app/Http/Controllers/AudPrintController.php:321`, `app/Http/Controllers/AudPrintController.php:533`, `app/Http/Controllers/AudPrintController.php:541`, `app/Http/Controllers/AudPrintController.php:547`, `app/Http/Controllers/AudPrintController.php:1116`, `app/Http/Controllers/AudPrintController.php:1272`, `app/Http/Controllers/AudPrintController.php:1283`.

### `App\AudProgramas`

Archivo: `app/AudProgramas.php`. Tabla: `aud_programa` (existe). Clave configurada: `id_programa`; PRIMARY KEY físico: `id_programa`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudProgramas.php`.

Consumidores actuales (23): `app/AudPrint.php:48`, `app/Http/Controllers/AudAuditoriaProcesoController.php:7`, `app/Http/Controllers/AudAuditoriaProcesoController.php:99`, `app/Http/Controllers/AudAuditoriasController.php:9`, `app/Http/Controllers/AudAuditoriasController.php:78`, `app/Http/Controllers/AudInformeEstadoController.php:9`, `app/Http/Controllers/AudInformeEstadoController.php:24`, `app/Http/Controllers/AudInformeEstadoController.php:67`.

Consumidores históricos (23): `app/AudPrint.php:48`, `app/Http/Controllers/AudAuditoriaProcesoController.php:7`, `app/Http/Controllers/AudAuditoriaProcesoController.php:99`, `app/Http/Controllers/AudAuditoriasController.php:9`, `app/Http/Controllers/AudAuditoriasController.php:78`, `app/Http/Controllers/AudInformeEstadoController.php:9`, `app/Http/Controllers/AudInformeEstadoController.php:24`, `app/Http/Controllers/AudInformeEstadoController.php:67`.

### `App\AudReporte`

Archivo: `app/AudReporte.php`. Tabla: `aud_reportes` (existe). Clave configurada: `id_reporte`; PRIMARY KEY físico: `id_reporte`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudReporte.php`.

Consumidores actuales (8): `app/AudInforme.php:80`, `app/Http/Controllers/AudReporteController.php:12`, `app/Http/Controllers/AudReporteController.php:54`, `app/Http/Controllers/AudReporteController.php:95`, `app/Http/Controllers/AudReporteController.php:101`, `app/Http/Controllers/AudReporteController.php:168`, `app/Http/Controllers/AudResponsableAccionesController.php:13`, `app/Http/Controllers/AudResponsableAccionesController.php:121`.

Consumidores históricos (8): `app/AudInforme.php:80`, `app/Http/Controllers/AudReporteController.php:12`, `app/Http/Controllers/AudReporteController.php:54`, `app/Http/Controllers/AudReporteController.php:95`, `app/Http/Controllers/AudReporteController.php:101`, `app/Http/Controllers/AudReporteController.php:168`, `app/Http/Controllers/AudResponsableAccionesController.php:13`, `app/Http/Controllers/AudResponsableAccionesController.php:121`.

### `App\AudReporteEvidencia`

Archivo: `app/AudReporteEvidencia.php`. Tabla: `aud_reporte_evidencias` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_reporte_evidencias no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudReporteEvidencia.php`.

Consumidores actuales (2): `app/Http/Controllers/AudInformeEstadoController.php:8`, `app/Http/Controllers/AudReporteEvidenciaController.php:5`.

Consumidores históricos (2): `app/Http/Controllers/AudInformeEstadoController.php:8`, `app/Http/Controllers/AudReporteEvidenciaController.php:5`.

### `App\audreportes`

Archivo: `app/audreportes.php`. Tabla: `audreportes` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva audreportes no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/audreportes.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\AudResponsableAcciones`

Archivo: `app/AudResponsableAcciones.php`. Tabla: `audresponsable_acciones` (existe). Clave configurada: `id_responsable`; PRIMARY KEY físico: `id_responsable`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `personal` → `App\Gnral_Personales`: audresponsable_acciones.id_personal [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudResponsableAcciones.php`.

Consumidores actuales (22): `app/AudReporte.php:14`, `app/AudRevisorAcciones.php:23`, `app/Http/Controllers/AudAccionesController.php:12`, `app/Http/Controllers/AudAccionesController.php:48`, `app/Http/Controllers/AudAccionesController.php:134`, `app/Http/Controllers/AudAccionesController.php:148`, `app/Http/Controllers/AudAccionesController.php:184`, `app/Http/Controllers/AudLiderAccionesController.php:10`.

Consumidores históricos (22): `app/AudReporte.php:14`, `app/AudRevisorAcciones.php:23`, `app/Http/Controllers/AudAccionesController.php:12`, `app/Http/Controllers/AudAccionesController.php:48`, `app/Http/Controllers/AudAccionesController.php:134`, `app/Http/Controllers/AudAccionesController.php:148`, `app/Http/Controllers/AudAccionesController.php:184`, `app/Http/Controllers/AudLiderAccionesController.php:10`.

### `App\AudRevisorAcciones`

Archivo: `app/AudRevisorAcciones.php`. Tabla: `aud_revisor_acciones` (existe). Clave configurada: `id_revisor`; PRIMARY KEY físico: `id_revisor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `personal` → `App\Gnral_Personales`: aud_revisor_acciones.id_personal [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `responsable` → `App\AudResponsableAcciones`: aud_revisor_acciones.id_responsable [int(11)] ↔ audresponsable_acciones.id_responsable [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudRevisorAcciones.php`.

Consumidores actuales (5): `app/Http/Controllers/AudRevisorAccionesController.php:7`, `app/Http/Controllers/AudRevisorAccionesController.php:33`, `app/Http/Controllers/AudRevisorAccionesController.php:51`, `app/Http/Controllers/AudRevisorAccionesController.php:63`, `app/Http/Controllers/AudRevisorAccionesController.php:136`.

Consumidores históricos (5): `app/Http/Controllers/AudRevisorAccionesController.php:7`, `app/Http/Controllers/AudRevisorAccionesController.php:33`, `app/Http/Controllers/AudRevisorAccionesController.php:51`, `app/Http/Controllers/AudRevisorAccionesController.php:63`, `app/Http/Controllers/AudRevisorAccionesController.php:136`.

### `App\AudValidarAgenda`

Archivo: `app/AudValidarAgenda.php`. Tabla: `aud_validar_agendas` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva aud_validar_agendas no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **error confirmado — corregido:** Reproducido TypeError de Carbon al recibir addMinute("30"). Se cambió a addMinutes(30) y se comprobó la secuencia de media hora.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/AudValidarAgenda.php`.

Consumidores actuales (31): `app/Http/Controllers/AudAgendaController.php:23`, `app/Http/Controllers/AudAgendaController.php:84`, `app/Http/Controllers/AudAgendaController.php:85`, `app/Http/Controllers/AudValidarAgendaController.php:9`, `app/Http/Controllers/AudValidarAgendaController.php:269`, `app/Http/Controllers/AudValidarAgendaController.php:270`, `app/Http/Controllers/AudValidarAgendaController.php:272`, `app/Http/Controllers/AudValidarAgendaController.php:276`.

Consumidores históricos (31): `app/Http/Controllers/AudAgendaController.php:23`, `app/Http/Controllers/AudAgendaController.php:84`, `app/Http/Controllers/AudAgendaController.php:85`, `app/Http/Controllers/AudValidarAgendaController.php:9`, `app/Http/Controllers/AudValidarAgendaController.php:269`, `app/Http/Controllers/AudValidarAgendaController.php:270`, `app/Http/Controllers/AudValidarAgendaController.php:272`, `app/Http/Controllers/AudValidarAgendaController.php:276`.

### `App\calBitacoraEvaluaciones`

Archivo: `app/calBitacoraEvaluaciones.php`. Tabla: `cal_bitacora_evaluaciones` (existe). Clave configurada: `id_bitacora_eval`; PRIMARY KEY físico: `id_bitacora_eval`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/calBitacoraEvaluaciones.php`.

Consumidores actuales (3): `app/Http/Controllers/DocentesAgController.php:18`, `app/Http/Controllers/SEscolaresController.php:5`, `app/Http/Controllers/SEscolaresController.php:1018`.

Consumidores históricos (3): `app/Http/Controllers/DocentesAgController.php:18`, `app/Http/Controllers/SEscolaresController.php:5`, `app/Http/Controllers/SEscolaresController.php:1018`.

### `App\CalBitacoraEvaluacionesSumativas`

Archivo: `app/CalBitacoraEvaluacionesSumativas.php`. Tabla: `cal_bitacoras_sumativas` (existe). Clave configurada: `id_bitacora_sumativas`; PRIMARY KEY físico: `id_bitacora_sumativas`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/CalBitacoraEvaluacionesSumativas.php`.

Consumidores actuales (2): `app/Http/Controllers/SEscolaresController.php:6`, `app/Http/Controllers/SEscolaresController.php:1035`.

Consumidores históricos (2): `app/Http/Controllers/SEscolaresController.php:6`, `app/Http/Controllers/SEscolaresController.php:1035`.

### `App\calBitacoraPeriodos`

Archivo: `app/calBitacoraPeriodos.php`. Tabla: `cal_bitacora_periodos` (existe). Clave configurada: `id_bitacora_periodo`; PRIMARY KEY físico: `id_bitacora_periodo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/calBitacoraPeriodos.php`.

Consumidores actuales (3): `app/Http/Controllers/DocentesAgController.php:19`, `app/Http/Controllers/DocentesAgController.php:1070`, `app/Http/Controllers/DocentesAgController.php:1096`.

Consumidores históricos (3): `app/Http/Controllers/DocentesAgController.php:19`, `app/Http/Controllers/DocentesAgController.php:1070`, `app/Http/Controllers/DocentesAgController.php:1096`.

### `App\CalCanalizacion`

Archivo: `app/CalCanalizacion.php`. Tabla: `cal_canalizacion` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/CalCanalizacion.php`.

Consumidores actuales (2): `app/Http/Controllers/DocentesAgController.php:5`, `app/Http/Controllers/DocentesAgController.php:373`.

Consumidores históricos (2): `app/Http/Controllers/DocentesAgController.php:5`, `app/Http/Controllers/DocentesAgController.php:373`.

### `App\calEvaluaciones`

Archivo: `app/calEvaluaciones.php`. Tabla: `cal_evaluaciones` (existe). Clave configurada: `id_evaluacion`; PRIMARY KEY físico: `id_evaluacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/calEvaluaciones.php`.

Consumidores actuales (19): `app/Http/Controllers/DocentesAgController.php:6`, `app/Http/Controllers/DocentesAgController.php:1123`, `app/Http/Controllers/DocentesAgController.php:1148`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:6`, `app/Http/Controllers/PDFlistasController.php:6`, `app/Http/Controllers/PDFlistasController.php:302`, `app/Http/Controllers/PDFlistasController.php:307`, `app/Http/Controllers/PDFlistasController.php:329`.

Consumidores históricos (19): `app/Http/Controllers/DocentesAgController.php:6`, `app/Http/Controllers/DocentesAgController.php:1123`, `app/Http/Controllers/DocentesAgController.php:1148`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:6`, `app/Http/Controllers/PDFlistasController.php:6`, `app/Http/Controllers/PDFlistasController.php:302`, `app/Http/Controllers/PDFlistasController.php:307`, `app/Http/Controllers/PDFlistasController.php:329`.

### `App\calPeriodos`

Archivo: `app/calPeriodos.php`. Tabla: `cal_periodos_califica` (existe). Clave configurada: `id_periodo_cal`; PRIMARY KEY físico: `id_periodo_cal`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/calPeriodos.php`.

Consumidores actuales (10): `app/Http/Controllers/DocentesAgController.php:17`, `app/Http/Controllers/DocentesAgController.php:1071`, `app/Http/Controllers/DocentesAgController.php:1097`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:7`, `app/Http/Controllers/jcarreraController.php:10`, `app/Http/Controllers/PDFlistasController.php:7`, `app/Http/Controllers/PDFlistasController.php:288`, `app/Http/Controllers/PDFlistasController.php:298`.

Consumidores históricos (10): `app/Http/Controllers/DocentesAgController.php:17`, `app/Http/Controllers/DocentesAgController.php:1071`, `app/Http/Controllers/DocentesAgController.php:1097`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:7`, `app/Http/Controllers/jcarreraController.php:10`, `app/Http/Controllers/PDFlistasController.php:7`, `app/Http/Controllers/PDFlistasController.php:288`, `app/Http/Controllers/PDFlistasController.php:298`.

### `App\calperiodosSumativas`

Archivo: `app/calperiodosSumativas.php`. Tabla: `cal_periodos_sumativas` (existe). Clave configurada: `id_periodo_sum`; PRIMARY KEY físico: `id_periodo_sum`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/calperiodosSumativas.php`.

Consumidores actuales (11): `app/Http/Controllers/DocentesAgController.php:20`, `app/Http/Controllers/DocentesAgController.php:234`, `app/Http/Controllers/jcarreraController.php:12`, `app/Http/Controllers/jcarreraController.php:23`, `app/Http/Controllers/SEscolaresController.php:8`, `app/Http/Controllers/SEscolaresController.php:69`, `app/Http/Controllers/SEscolaresController.php:92`, `app/Http/Controllers/SEscolaresController.php:987`.

Consumidores históricos (11): `app/Http/Controllers/DocentesAgController.php:20`, `app/Http/Controllers/DocentesAgController.php:234`, `app/Http/Controllers/jcarreraController.php:12`, `app/Http/Controllers/jcarreraController.php:23`, `app/Http/Controllers/SEscolaresController.php:8`, `app/Http/Controllers/SEscolaresController.php:69`, `app/Http/Controllers/SEscolaresController.php:92`, `app/Http/Controllers/SEscolaresController.php:987`.

### `App\CargaAcademica`

Archivo: `app/CargaAcademica.php`. Tabla: `eva_carga_academica` (existe). Clave configurada: `id_carga_academica`; PRIMARY KEY físico: `id_carga_academica`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/CargaAcademica.php`.

Consumidores actuales (20): `app/Http/Controllers/Cal_historial_academicoController.php:606`, `app/Http/Controllers/checar_cargaController.php:8`, `app/Http/Controllers/checar_cargaController.php:367`, `app/Http/Controllers/checar_cargaController.php:478`, `app/Http/Controllers/checar_cargaController.php:508`, `app/Http/Controllers/checar_cargaController.php:514`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:7`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:753`.

Consumidores históricos (20): `app/Http/Controllers/Cal_historial_academicoController.php:606`, `app/Http/Controllers/checar_cargaController.php:8`, `app/Http/Controllers/checar_cargaController.php:367`, `app/Http/Controllers/checar_cargaController.php:478`, `app/Http/Controllers/checar_cargaController.php:508`, `app/Http/Controllers/checar_cargaController.php:514`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:7`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:753`.

### `App\Carreras`

Archivo: `app/Carreras.php`. Tabla: `gnral_carreras` (existe). Clave configurada: `id_carrera`; PRIMARY KEY físico: `id_carrera`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Carreras.php`.

Consumidores actuales (47): `app/Exports/EdadesMultiExport.php:5`, `app/Exports/Estudiantes_multiplesExport.php:5`, `app/Exports/MultiExport.php:5`, `app/Exports/MunicipiosMultiExport.php:5`, `app/Exports/MunicipiosMultiExport.php:18`, `app/Exports/Tutorias_carrerasMulti_export.php:5`, `app/Http/Controllers/AulaController.php:11`, `app/Http/Controllers/Beca_SolicitudController.php:7`.

Consumidores históricos (47): `app/Exports/EdadesMultiExport.php:5`, `app/Exports/Estudiantes_multiplesExport.php:5`, `app/Exports/MultiExport.php:5`, `app/Exports/MunicipiosMultiExport.php:5`, `app/Exports/MunicipiosMultiExport.php:18`, `app/Exports/Tutorias_carrerasMulti_export.php:5`, `app/Http/Controllers/AulaController.php:11`, `app/Http/Controllers/Beca_SolicitudController.php:7`.

### `App\CategoriaAct`

Archivo: `app/CategoriaAct.php`. Tabla: `actcomple_categorias` (existe). Clave configurada: `id_categoria`; PRIMARY KEY físico: `id_categoria`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/CategoriaAct.php`.

Consumidores actuales (12): `app/Http/Controllers/ConsultaRegActividadesController.php:11`, `app/Http/Controllers/DocenteActividadJefeController.php:10`, `app/Http/Controllers/PlaneaActividadProfController.php:10`, `app/Http/Controllers/PlaneaActividadProfController.php:50`, `app/Http/Controllers/PlaneaActividadProfController.php:201`, `app/Http/Controllers/RegistrarActSubController.php:8`, `app/Http/Controllers/RegistrarActSubController.php:24`, `app/Http/Controllers/RegistrarActSubController.php:85`.

Consumidores históricos (12): `app/Http/Controllers/ConsultaRegActividadesController.php:11`, `app/Http/Controllers/DocenteActividadJefeController.php:10`, `app/Http/Controllers/PlaneaActividadProfController.php:10`, `app/Http/Controllers/PlaneaActividadProfController.php:50`, `app/Http/Controllers/PlaneaActividadProfController.php:201`, `app/Http/Controllers/RegistrarActSubController.php:8`, `app/Http/Controllers/RegistrarActSubController.php:24`, `app/Http/Controllers/RegistrarActSubController.php:85`.

### `App\DocenteActividad`

Archivo: `app/DocenteActividad.php`. Tabla: `actcomple_docente_actividad` (existe). Clave configurada: `id_docente_actividad`; PRIMARY KEY físico: `id_docente_actividad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/DocenteActividad.php`.

Consumidores actuales (7): `app/Http/Controllers/ConsultaRegActividadesController.php:12`, `app/Http/Controllers/DocenteActividadJefeController.php:12`, `app/Http/Controllers/DocenteActividadJefeController.php:141`, `app/Http/Controllers/DocenteActividadJefeController.php:230`, `app/Http/Controllers/DocenteActividadJefeController.php:248`, `app/Http/Controllers/SolicitudAlumnosJefeController.php:11`, `app/Http/Controllers/Tutorias_GraficasInstitucionController.php:9`.

Consumidores históricos (7): `app/Http/Controllers/ConsultaRegActividadesController.php:12`, `app/Http/Controllers/DocenteActividadJefeController.php:12`, `app/Http/Controllers/DocenteActividadJefeController.php:141`, `app/Http/Controllers/DocenteActividadJefeController.php:230`, `app/Http/Controllers/DocenteActividadJefeController.php:248`, `app/Http/Controllers/SolicitudAlumnosJefeController.php:11`, `app/Http/Controllers/Tutorias_GraficasInstitucionController.php:9`.

### `App\Estados`

Archivo: `app/Estados.php`. Tabla: `gnral_estados` (existe). Clave configurada: `id_estado`; PRIMARY KEY físico: `id_estado`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Estados.php`.

Consumidores actuales (16): `app/Http/Controllers/datos_alumno.php:9`, `app/Http/Controllers/datos_alumno.php:28`, `app/Http/Controllers/datos_alumno.php:29`, `app/Http/Controllers/datos_alumno.php:31`, `app/Http/Controllers/datos_alumno.php:531`, `app/Http/Controllers/datos_alumno.php:563`, `app/Http/Controllers/OficiosComisionController.php:10`, `app/Http/Controllers/OficiosComisionController.php:25`.

Consumidores históricos (16): `app/Http/Controllers/datos_alumno.php:9`, `app/Http/Controllers/datos_alumno.php:28`, `app/Http/Controllers/datos_alumno.php:29`, `app/Http/Controllers/datos_alumno.php:31`, `app/Http/Controllers/datos_alumno.php:531`, `app/Http/Controllers/datos_alumno.php:563`, `app/Http/Controllers/OficiosComisionController.php:10`, `app/Http/Controllers/OficiosComisionController.php:25`.

### `App\EvaluacionEvidencias`

Archivo: `app/EvaluacionEvidencias.php`. Tabla: `actcomple_evaluaciones` (existe). Clave configurada: `id_evaluacion`; PRIMARY KEY físico: `id_evaluacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/EvaluacionEvidencias.php`.

Consumidores actuales (3): `app/Http/Controllers/ConsultaGenralProfController.php:9`, `app/Http/Controllers/ConsultaGenralProfController.php:338`, `app/Http/Controllers/LiberaActividadJefeController.php:10`.

Consumidores históricos (3): `app/Http/Controllers/ConsultaGenralProfController.php:9`, `app/Http/Controllers/ConsultaGenralProfController.php:338`, `app/Http/Controllers/LiberaActividadJefeController.php:10`.

### `App\Eva_calificaciones_pre`

Archivo: `app/Eva_calificaciones_pre.php`. Tabla: `eva_calificaciones_pre` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Eva_calificaciones_pre.php`.

Consumidores actuales (2): `app/Http/Controllers/Migrar.php:5`, `app/Http/Controllers/Migrar.php:152`.

Consumidores históricos (2): `app/Http/Controllers/Migrar.php:5`, `app/Http/Controllers/Migrar.php:152`.

### `App\Eva_docente_comentarios`

Archivo: `app/Eva_docente_comentarios.php`. Tabla: `eva_docente_comentarios` (existe). Clave configurada: `id_comentario`; PRIMARY KEY físico: `id_comentario`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Eva_docente_comentarios.php`.

Consumidores actuales (1): `app/Http/Controllers/evaluacion_alumnoController.php:22`.

Consumidores históricos (1): `app/Http/Controllers/evaluacion_alumnoController.php:22`.

### `App\EvidenciaAlumno`

Archivo: `app/EvidenciaAlumno.php`. Tabla: `actcomple_evidencias_alumno` (existe). Clave configurada: `id_evidencia_alumno`; PRIMARY KEY físico: `id_evidencia_alumno`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/EvidenciaAlumno.php`.

Consumidores actuales (4): `app/Http/Controllers/ConsultaGenralProfController.php:8`, `app/Http/Controllers/ConsultaGenralProfController.php:276`, `app/Http/Controllers/EvidenciasAlumnosController.php:8`, `app/Http/Controllers/EvidenciasAlumnosController.php:108`.

Consumidores históricos (4): `app/Http/Controllers/ConsultaGenralProfController.php:8`, `app/Http/Controllers/ConsultaGenralProfController.php:276`, `app/Http/Controllers/EvidenciasAlumnosController.php:8`, `app/Http/Controllers/EvidenciasAlumnosController.php:108`.

### `App\Exp_asigna_expediente`

Archivo: `app/Exp_asigna_expediente.php`. Tabla: `exp_asigna_expediente` (ausente). Clave configurada: `id_asigna_expediente`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva exp_asigna_expediente no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **error confirmado — pendiente:** Relación exp_generales referencia exp_asigna_expediente.id_exp_general, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación exp_antecedentes_academicos referencia exp_asigna_expediente.id_exp_antecedentes_academicos, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación exp_datos_familiares referencia exp_asigna_expediente.id_exp_datos_familiares, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación exp_habitos_estudio referencia exp_asigna_expediente.id_exp_habitos_estudio, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación exp_formacion_integral referencia exp_asigna_expediente.id_exp_formacion_integral, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación exp_area_psicopedagogica referencia exp_asigna_expediente.id_exp_area_psicopedagogica, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 6.

- `exp_generales` → `App\Tutorias_Exp_generale`: exp_asigna_expediente.id_exp_general [AUSENTE] ↔ exp_generales.id_exp_general [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `exp_antecedentes_academicos` → `App\Tutorias_Exp_antecedentes_academico`: exp_asigna_expediente.id_exp_antecedentes_academicos [AUSENTE] ↔ exp_antecedentes_academicos.id_exp_antecedentes_academicos [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `exp_datos_familiares` → `App\Tutorias_Exp_datos_familiare`: exp_asigna_expediente.id_exp_datos_familiares [AUSENTE] ↔ exp_datos_familiares.id_exp_datos_familiares [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `exp_habitos_estudio` → `App\Tutorias_Exp_habitos_estudio`: exp_asigna_expediente.id_exp_habitos_estudio [AUSENTE] ↔ exp_habitos_estudio.id_exp_habitos_estudio [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `exp_formacion_integral` → `App\Tutorias_Exp_formacion_integral`: exp_asigna_expediente.id_exp_formacion_integral [AUSENTE] ↔ exp_formacion_integral.id_exp_formacion_integral [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `exp_area_psicopedagogica` → `App\Tutorias_Exp_area_psicopedagogica`: exp_asigna_expediente.id_exp_area_psicopedagogica [AUSENTE] ↔ exp_area_psicopedagogica.id_exp_area_psicopedagogica [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 1 coincidencias. Líneas: 60. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_Exp_asigna_expediente.php`.

Consumidores actuales (1): `app/Http/Controllers/Tutorias_ViewAlumnosController.php:9`.

Consumidores históricos (1): `app/Http/Controllers/Tutorias_ViewAlumnosController.php:9`.

### `App\GnralJefeUnidadAdministrativa`

Archivo: `app/GnralJefeUnidadAdministrativa.php`. Tabla: `gnral_unidad_personal` (existe). Clave configurada: `id_unidad_persona`; PRIMARY KEY físico: `id_unidad_persona`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `jefe` → `App\GnralPersonales`: gnral_unidad_personal.id_personal [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/GnralJefeUnidadAdministrativa.php`.

Consumidores actuales (13): `app/AudValidarAgenda.php:17`, `app/Http/Controllers/AudAgendaEventoController.php:23`, `app/Http/Controllers/AudAgendaEventoController.php:458`, `app/Http/Controllers/AudAgendaEventoController.php:559`, `app/Http/Controllers/AudReporteController.php:14`, `app/Http/Controllers/AudValidarAgendaController.php:11`, `app/Http/Controllers/AudValidarAgendaController.php:81`, `app/Http/Controllers/AudValidarAgendaController.php:180`.

Consumidores históricos (13): `app/AudValidarAgenda.php:17`, `app/Http/Controllers/AudAgendaEventoController.php:23`, `app/Http/Controllers/AudAgendaEventoController.php:458`, `app/Http/Controllers/AudAgendaEventoController.php:559`, `app/Http/Controllers/AudReporteController.php:14`, `app/Http/Controllers/AudValidarAgendaController.php:11`, `app/Http/Controllers/AudValidarAgendaController.php:81`, `app/Http/Controllers/AudValidarAgendaController.php:180`.

### `App\GnralPersonales`

Archivo: `app/GnralPersonales.php`. Tabla: `gnral_personales` (existe). Clave configurada: `id_personal`; PRIMARY KEY físico: `id_personal`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getAbrPer` → `App\Abreviaciones_prof`: gnral_personales.id_personal [int(11)] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/GnralPersonales.php`.

Consumidores actuales (18): `app/Http/Controllers/AudAccionesController.php:11`, `app/Http/Controllers/AudAccionesController.php:144`, `app/Http/Controllers/AudAuditoriasController.php:10`, `app/Http/Controllers/AudAuditoriasController.php:115`, `app/Http/Controllers/AudInformeController.php:9`, `app/Http/Controllers/AudInformeController.php:71`, `app/Http/Controllers/AudPrintController.php:23`, `app/Http/Controllers/AudResponsableAccionesController.php:14`.

Consumidores históricos (18): `app/Http/Controllers/AudAccionesController.php:11`, `app/Http/Controllers/AudAccionesController.php:144`, `app/Http/Controllers/AudAuditoriasController.php:10`, `app/Http/Controllers/AudAuditoriasController.php:115`, `app/Http/Controllers/AudInformeController.php:9`, `app/Http/Controllers/AudInformeController.php:71`, `app/Http/Controllers/AudPrintController.php:23`, `app/Http/Controllers/AudResponsableAccionesController.php:14`.

### `App\Gnral_Cargos`

Archivo: `app/Gnral_Cargos.php`. Tabla: `gnral_cargos` (existe). Clave configurada: `id_cargo`; PRIMARY KEY físico: `id_cargo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Cargos.php`.

Consumidores actuales (14): `app/Extensiones/consultas.php:13`, `app/Http/Controllers/ArmarHorariosController.php:12`, `app/Http/Controllers/Cali_actaController.php:14`, `app/Http/Controllers/CargoController.php:10`, `app/Http/Controllers/CargoController.php:40`, `app/Http/Controllers/CargoController.php:54`, `app/Http/Controllers/CargoController.php:70`, `app/Http/Controllers/CargoController.php:76`.

Consumidores históricos (14): `app/Extensiones/consultas.php:13`, `app/Http/Controllers/ArmarHorariosController.php:12`, `app/Http/Controllers/Cali_actaController.php:14`, `app/Http/Controllers/CargoController.php:10`, `app/Http/Controllers/CargoController.php:40`, `app/Http/Controllers/CargoController.php:54`, `app/Http/Controllers/CargoController.php:70`, `app/Http/Controllers/CargoController.php:76`.

### `App\Gnral_escuela_procedencia`

Archivo: `app/Gnral_escuela_procedencia.php`. Tabla: `gnral_escuela_procedencia` (existe). Clave configurada: `id_escuela_procedencia`; PRIMARY KEY físico: `id_escuela_procedencia`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_escuela_procedencia.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Gnral_grupos`

Archivo: `app/Gnral_grupos.php`. Tabla: `gnral_grupos` (existe). Clave configurada: `id_grupo`; PRIMARY KEY físico: `id_grupo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_grupos.php`.

Consumidores actuales (4): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:24`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:91`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:142`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:171`.

Consumidores históricos (4): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:24`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:91`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:142`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:171`.

### `App\Gnral_Horas_Profesores`

Archivo: `app/Gnral_Horas_Profesores.php`. Tabla: `gnral_horas_profesores` (existe). Clave configurada: `id_hrs_profesor`; PRIMARY KEY físico: `id_hrs_profesor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Horas_Profesores.php`.

Consumidores actuales (4): `app/Extensiones/consultas.php:15`, `app/Http/Controllers/ArmarHorariosController.php:14`, `app/Http/Controllers/ArmarHorariosController.php:993`, `app/Http/Controllers/ArmarHorariosController.php:1081`.

Consumidores históricos (4): `app/Extensiones/consultas.php:15`, `app/Http/Controllers/ArmarHorariosController.php:14`, `app/Http/Controllers/ArmarHorariosController.php:993`, `app/Http/Controllers/ArmarHorariosController.php:1081`.

### `App\Gnral_Jefes_Periodos`

Archivo: `app/Gnral_Jefes_Periodos.php`. Tabla: `gnral_jefes_periodos` (existe). Clave configurada: `id_jefe_periodo`; PRIMARY KEY físico: `id_jefe_periodo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Jefes_Periodos.php`.

Consumidores actuales (9): `app/Http/Controllers/JefaturaController.php:10`, `app/Http/Controllers/JefaturaController.php:64`, `app/Http/Controllers/JefaturaController.php:110`, `app/Http/Controllers/JefaturaController.php:138`, `app/Http/Controllers/JefaturaController.php:159`, `app/Http/Controllers/JefaturaController.php:165`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:7`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:63`.

Consumidores históricos (9): `app/Http/Controllers/JefaturaController.php:10`, `app/Http/Controllers/JefaturaController.php:64`, `app/Http/Controllers/JefaturaController.php:110`, `app/Http/Controllers/JefaturaController.php:138`, `app/Http/Controllers/JefaturaController.php:159`, `app/Http/Controllers/JefaturaController.php:165`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:7`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:63`.

### `App\Gnral_Materias`

Archivo: `app/Gnral_Materias.php`. Tabla: `gnral_materias` (existe). Clave configurada: `id_materia`; PRIMARY KEY físico: `id_materia`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Materias.php`.

Consumidores actuales (11): `app/Http/Controllers/DocentesController.php:10`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:9`, `app/Http/Controllers/PDFlistasController.php:9`, `app/Http/Controllers/PDFlistasController.php:77`, `app/Http/Controllers/PDFlistasController.php:150`, `app/Http/Controllers/PDFlistasController.php:229`, `app/Http/Controllers/ReticulaController.php:10`, `app/Http/Controllers/ReticulaController.php:175`.

Consumidores históricos (11): `app/Http/Controllers/DocentesController.php:10`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:9`, `app/Http/Controllers/PDFlistasController.php:9`, `app/Http/Controllers/PDFlistasController.php:77`, `app/Http/Controllers/PDFlistasController.php:150`, `app/Http/Controllers/PDFlistasController.php:229`, `app/Http/Controllers/ReticulaController.php:10`, `app/Http/Controllers/ReticulaController.php:175`.

### `App\Gnral_Materias_Perfiles`

Archivo: `app/Gnral_Materias_Perfiles.php`. Tabla: `gnral_materias_perfiles` (existe). Clave configurada: `id_materia_perfil`; PRIMARY KEY físico: `id_materia_perfil`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Materias_Perfiles.php`.

Consumidores actuales (7): `app/Http/Controllers/DocentesController.php:14`, `app/Http/Controllers/DocentesController.php:300`, `app/Http/Controllers/Dual_Carga_Academica_Alumno.php:5`, `app/Http/Controllers/MateriasPerfilController.php:7`, `app/Http/Controllers/MateriasPerfilController.php:113`, `app/Http/Controllers/MateriasPerfilController.php:123`, `app/Http/Controllers/Serv_Esc_Dual_Carga_Academica_AlumnoController.php:5`.

Consumidores históricos (7): `app/Http/Controllers/DocentesController.php:14`, `app/Http/Controllers/DocentesController.php:300`, `app/Http/Controllers/Dual_Carga_Academica_Alumno.php:5`, `app/Http/Controllers/MateriasPerfilController.php:7`, `app/Http/Controllers/MateriasPerfilController.php:113`, `app/Http/Controllers/MateriasPerfilController.php:123`, `app/Http/Controllers/Serv_Esc_Dual_Carga_Academica_AlumnoController.php:5`.

### `App\Gnral_Perfiles`

Archivo: `app/Gnral_Perfiles.php`. Tabla: `gnral_perfiles` (existe). Clave configurada: `id_perfil`; PRIMARY KEY físico: `id_perfil`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Perfiles.php`.

Consumidores actuales (9): `app/Http/Controllers/DocentesAgController.php:13`, `app/Http/Controllers/DocentesAgController.php:196`, `app/Http/Controllers/DocentesController.php:12`, `app/Http/Controllers/PerfilController.php:9`, `app/Http/Controllers/PerfilController.php:42`, `app/Http/Controllers/PerfilController.php:57`, `app/Http/Controllers/PerfilController.php:72`, `app/Http/Controllers/PerfilController.php:79`.

Consumidores históricos (9): `app/Http/Controllers/DocentesAgController.php:13`, `app/Http/Controllers/DocentesAgController.php:196`, `app/Http/Controllers/DocentesController.php:12`, `app/Http/Controllers/PerfilController.php:9`, `app/Http/Controllers/PerfilController.php:42`, `app/Http/Controllers/PerfilController.php:57`, `app/Http/Controllers/PerfilController.php:72`, `app/Http/Controllers/PerfilController.php:79`.

### `App\Gnral_Personales`

Archivo: `app/Gnral_Personales.php`. Tabla: `gnral_personales` (existe). Clave configurada: `id_personal`; PRIMARY KEY físico: `id_personal`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `abreviaciones_prof` → `App\Abreviaciones_prof`: gnral_personales.id_personal [int(11)] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 1 coincidencias. Líneas: 25. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Gnral_Personales.php`.

Consumidores actuales (49): `app/AudInforme.php:17`, `app/AudInforme.php:24`, `app/AudInforme.php:30`, `app/AudInforme.php:37`, `app/AudLiderAcciones.php:18`, `app/AudResponsableAcciones.php:26`, `app/AudRevisorAcciones.php:18`, `app/AudValidarAgenda.php:18`.

Consumidores históricos (49): `app/AudInforme.php:17`, `app/AudInforme.php:24`, `app/AudInforme.php:30`, `app/AudInforme.php:37`, `app/AudLiderAcciones.php:18`, `app/AudResponsableAcciones.php:26`, `app/AudRevisorAcciones.php:18`, `app/AudValidarAgenda.php:18`.

### `App\Gnral_Reticulas`

Archivo: `app/Gnral_Reticulas.php`. Tabla: `gnral_reticulas` (existe). Clave configurada: `id_reticula`; PRIMARY KEY físico: `id_reticula`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Reticulas.php`.

Consumidores actuales (2): `app/Http/Controllers/ReticulaController.php:12`, `app/Http/Controllers/ReticulaController.php:44`.

Consumidores históricos (2): `app/Http/Controllers/ReticulaController.php:12`, `app/Http/Controllers/ReticulaController.php:44`.

### `App\Gnral_Tipos_Usuario`

Archivo: `app/Gnral_Tipos_Usuario.php`. Tabla: `gnral_tipos_usuario` (existe). Clave configurada: `id_tipo_usuario`; PRIMARY KEY físico: `id_tipo_usuario`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Gnral_Tipos_Usuario.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\gnral_unidad_administrativa`

Archivo: `app/gnral_unidad_administrativa.php`. Tabla: `gnral_unidad_administrativa` (existe). Clave configurada: `id_unidad_admin`; PRIMARY KEY físico: `id_unidad_admin`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(10)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `proceso_unidad` → `App\ri_proceso_unidad`: gnral_unidad_administrativa.id_unidad_admin [bigint(10)] ↔ ri_proceso_unidad.id_unidad_admin [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `jefeArea` → `App\GnralJefeUnidadAdministrativa`: gnral_unidad_administrativa.id_unidad_admin [bigint(10)] ↔ gnral_unidad_personal.id_unidad_admin [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/gnral_unidad_administrativa.php`.

Consumidores actuales (34): `app/Http/Controllers/API/RegRiesgoController.php:6`, `app/Http/Controllers/API/RegRiesgoController.php:24`, `app/Http/Controllers/AudAgendaController.php:25`, `app/Http/Controllers/AudAgendaController.php:253`, `app/Http/Controllers/AudAgendaController.php:732`, `app/Http/Controllers/AudAgendaEventoController.php:22`, `app/Http/Controllers/AudAgendaEventoController.php:103`, `app/Http/Controllers/AudAgendaEventoController.php:295`.

Consumidores históricos (34): `app/Http/Controllers/API/RegRiesgoController.php:6`, `app/Http/Controllers/API/RegRiesgoController.php:24`, `app/Http/Controllers/AudAgendaController.php:25`, `app/Http/Controllers/AudAgendaController.php:253`, `app/Http/Controllers/AudAgendaController.php:732`, `app/Http/Controllers/AudAgendaEventoController.php:22`, `app/Http/Controllers/AudAgendaEventoController.php:103`, `app/Http/Controllers/AudAgendaEventoController.php:295`.

### `App\Horarios`

Archivo: `app/Horarios.php`. Tabla: `gnral_horarios` (existe). Clave configurada: `id_horario_profesor`; PRIMARY KEY físico: `id_horario_profesor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Horarios.php`.

Consumidores actuales (12): `app/Http/Controllers/ArmarHorariosController.php:9`, `app/Http/Controllers/ArmarHorariosController.php:673`, `app/Http/Controllers/ArmarHorariosController.php:706`, `app/Http/Controllers/ArmarHorariosController.php:1061`, `app/Http/Controllers/ArmarHorariosController.php:1109`, `app/Http/Controllers/DocentesPlantillaController.php:9`, `app/Http/Controllers/DocentesPlantillaController.php:70`, `app/Http/Controllers/DocentesPlantillaController.php:106`.

Consumidores históricos (12): `app/Http/Controllers/ArmarHorariosController.php:9`, `app/Http/Controllers/ArmarHorariosController.php:673`, `app/Http/Controllers/ArmarHorariosController.php:706`, `app/Http/Controllers/ArmarHorariosController.php:1061`, `app/Http/Controllers/ArmarHorariosController.php:1109`, `app/Http/Controllers/DocentesPlantillaController.php:9`, `app/Http/Controllers/DocentesPlantillaController.php:70`, `app/Http/Controllers/DocentesPlantillaController.php:106`.

### `App\Hrs_Actividades_Extras`

Archivo: `app/Hrs_Actividades_Extras.php`. Tabla: `hrs_actividades_extras` (existe). Clave configurada: `id_hrs_actividad_extra`; PRIMARY KEY físico: `id_hrs_actividad_extra`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Actividades_Extras.php`.

Consumidores actuales (5): `app/Http/Controllers/ExtraClaseController.php:8`, `app/Http/Controllers/ExtraClaseController.php:34`, `app/Http/Controllers/ExtraClaseController.php:47`, `app/Http/Controllers/ExtraClaseController.php:61`, `app/Http/Controllers/ExtraClaseController.php:68`.

Consumidores históricos (5): `app/Http/Controllers/ExtraClaseController.php:8`, `app/Http/Controllers/ExtraClaseController.php:34`, `app/Http/Controllers/ExtraClaseController.php:47`, `app/Http/Controllers/ExtraClaseController.php:61`, `app/Http/Controllers/ExtraClaseController.php:68`.

### `App\Hrs_Act_Extra_Clases`

Archivo: `app/Hrs_Act_Extra_Clases.php`. Tabla: `hrs_act_extra_clases` (existe). Clave configurada: `id_act_extra_clase`; PRIMARY KEY físico: `id_act_extra_clase`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Act_Extra_Clases.php`.

Consumidores actuales (4): `app/Extensiones/consultas.php:16`, `app/Http/Controllers/ArmarHorariosController.php:15`, `app/Http/Controllers/ArmarHorariosController.php:391`, `app/Http/Controllers/ArmarHorariosController.php:737`.

Consumidores históricos (4): `app/Extensiones/consultas.php:16`, `app/Http/Controllers/ArmarHorariosController.php:15`, `app/Http/Controllers/ArmarHorariosController.php:391`, `app/Http/Controllers/ArmarHorariosController.php:737`.

### `App\Hrs_Aprobar_Plantilla_Edu`

Archivo: `app/Hrs_Aprobar_Plantilla_Edu.php`. Tabla: `hrs_aprobar_plantilla_edu` (existe). Clave configurada: `id_aprobar_plantilla_edu`; PRIMARY KEY físico: `id_aprobar_plantilla_edu`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Aprobar_Plantilla_Edu.php`.

Consumidores actuales (11): `app/Http/Controllers/ArmarHorariosController.php:16`, `app/Http/Controllers/ArmarHorariosController.php:666`, `app/Http/Controllers/ArmarHorariosController.php:675`, `app/Http/Controllers/ArmarHorariosController.php:708`, `app/Http/Controllers/ArmarHorariosController.php:721`, `app/Http/Controllers/ArmarHorariosController.php:1066`, `app/Http/Controllers/ArmarHorariosController.php:1126`, `app/Http/Controllers/ArmarHorariosController.php:1150`.

Consumidores históricos (11): `app/Http/Controllers/ArmarHorariosController.php:16`, `app/Http/Controllers/ArmarHorariosController.php:666`, `app/Http/Controllers/ArmarHorariosController.php:675`, `app/Http/Controllers/ArmarHorariosController.php:708`, `app/Http/Controllers/ArmarHorariosController.php:721`, `app/Http/Controllers/ArmarHorariosController.php:1066`, `app/Http/Controllers/ArmarHorariosController.php:1126`, `app/Http/Controllers/ArmarHorariosController.php:1150`.

### `App\Hrs_Aulas`

Archivo: `app/Hrs_Aulas.php`. Tabla: `hrs_aulas` (existe). Clave configurada: `id_aula`; PRIMARY KEY físico: `id_aula`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Aulas.php`.

Consumidores actuales (9): `app/Extensiones/consultas.php:12`, `app/Http/Controllers/ArmarHorariosController.php:11`, `app/Http/Controllers/AulaController.php:9`, `app/Http/Controllers/AulaController.php:90`, `app/Http/Controllers/AulaController.php:109`, `app/Http/Controllers/AulaController.php:130`, `app/Http/Controllers/AulaController.php:137`, `app/Http/Controllers/HrsAulasController.php:10`.

Consumidores históricos (9): `app/Extensiones/consultas.php:12`, `app/Http/Controllers/ArmarHorariosController.php:11`, `app/Http/Controllers/AulaController.php:9`, `app/Http/Controllers/AulaController.php:90`, `app/Http/Controllers/AulaController.php:109`, `app/Http/Controllers/AulaController.php:130`, `app/Http/Controllers/AulaController.php:137`, `app/Http/Controllers/HrsAulasController.php:10`.

### `App\Hrs_Cargos`

Archivo: `app/Hrs_Cargos.php`. Tabla: `gnral_cargos` (existe). Clave configurada: `id_cargo`; PRIMARY KEY físico: `id_cargo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Cargos.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Hrs_Distribucion_Horas`

Archivo: `app/Hrs_Distribucion_Horas.php`. Tabla: `hrs_distribucion_horas` (existe). Clave configurada: `id_distribucion_hora`; PRIMARY KEY físico: `id_distribucion_hora`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Distribucion_Horas.php`.

Consumidores actuales (2): `app/Http/Controllers/DistribucionController.php:13`, `app/Http/Controllers/DistribucionController.php:176`.

Consumidores históricos (2): `app/Http/Controllers/DistribucionController.php:13`, `app/Http/Controllers/DistribucionController.php:176`.

### `App\Hrs_Edificios`

Archivo: `app/Hrs_Edificios.php`. Tabla: `hrs_edificios` (existe). Clave configurada: `id_edificio`; PRIMARY KEY físico: `id_edificio`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Edificios.php`.

Consumidores actuales (7): `app/Http/Controllers/AulaController.php:10`, `app/Http/Controllers/EdificioController.php:9`, `app/Http/Controllers/EdificioController.php:19`, `app/Http/Controllers/EdificioController.php:38`, `app/Http/Controllers/EdificioController.php:53`, `app/Http/Controllers/EdificioController.php:67`, `app/Http/Controllers/EdificioController.php:74`.

Consumidores históricos (7): `app/Http/Controllers/AulaController.php:10`, `app/Http/Controllers/EdificioController.php:9`, `app/Http/Controllers/EdificioController.php:19`, `app/Http/Controllers/EdificioController.php:38`, `app/Http/Controllers/EdificioController.php:53`, `app/Http/Controllers/EdificioController.php:67`, `app/Http/Controllers/EdificioController.php:74`.

### `App\Hrs_Extra_Clase`

Archivo: `app/Hrs_Extra_Clase.php`. Tabla: `hrs_extra_clase` (existe). Clave configurada: `id_extra_clase`; PRIMARY KEY físico: `id_extra_clase`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Extra_Clase.php`.

Consumidores actuales (7): `app/Extensiones/consultas.php:17`, `app/Http/Controllers/ArmarHorariosController.php:17`, `app/Http/Controllers/ArmarHorariosController.php:748`, `app/Http/Controllers/ArmarHorariosController.php:820`, `app/Http/Controllers/ArmarHorariosController.php:850`, `app/Http/Controllers/ArmarHorariosController.php:926`, `app/Http/Controllers/ArmarHorariosController.php:1158`.

Consumidores históricos (7): `app/Extensiones/consultas.php:17`, `app/Http/Controllers/ArmarHorariosController.php:17`, `app/Http/Controllers/ArmarHorariosController.php:748`, `app/Http/Controllers/ArmarHorariosController.php:820`, `app/Http/Controllers/ArmarHorariosController.php:850`, `app/Http/Controllers/ArmarHorariosController.php:926`, `app/Http/Controllers/ArmarHorariosController.php:1158`.

### `App\Hrs_Horario_Extra_Clase`

Archivo: `app/Hrs_Horario_Extra_Clase.php`. Tabla: `hrs_horario_extra_clase` (existe). Clave configurada: `id_hr_extra`; PRIMARY KEY físico: `id_hr_extra`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Horario_Extra_Clase.php`.

Consumidores actuales (8): `app/Extensiones/consultas.php:18`, `app/Http/Controllers/ArmarHorariosController.php:18`, `app/Http/Controllers/ArmarHorariosController.php:759`, `app/Http/Controllers/ArmarHorariosController.php:832`, `app/Http/Controllers/ArmarHorariosController.php:862`, `app/Http/Controllers/ArmarHorariosController.php:938`, `app/Http/Controllers/ArmarHorariosController.php:1157`, `app/Http/Controllers/ArmarHorariosController.php:1163`.

Consumidores históricos (8): `app/Extensiones/consultas.php:18`, `app/Http/Controllers/ArmarHorariosController.php:18`, `app/Http/Controllers/ArmarHorariosController.php:759`, `app/Http/Controllers/ArmarHorariosController.php:832`, `app/Http/Controllers/ArmarHorariosController.php:862`, `app/Http/Controllers/ArmarHorariosController.php:938`, `app/Http/Controllers/ArmarHorariosController.php:1157`, `app/Http/Controllers/ArmarHorariosController.php:1163`.

### `App\Hrs_No_Horas_Docentes`

Archivo: `app/Hrs_No_Horas_Docentes.php`. Tabla: `hrs_no_horas_docentes` (ausente). Clave configurada: `id_horas_docente`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva hrs_no_horas_docentes no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_No_Horas_Docentes.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Hrs_Personal_Docentes`

Archivo: `app/Hrs_Personal_Docentes.php`. Tabla: `hrs_personal_docentes` (existe). Clave configurada: `id_personal_docente`; PRIMARY KEY físico: `id_personal_docente`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Personal_Docentes.php`.

Consumidores actuales (10): `app/Http/Controllers/Hrs_docentesClasesController.php:5`, `app/Http/Controllers/Hrs_docentesClasesController.php:83`, `app/Http/Controllers/Hrs_docentesClasesController.php:311`, `app/Http/Controllers/Hrs_docentesClasesController.php:569`, `app/Http/Controllers/Hrs_docentesClasesController.php:797`, `app/Http/Controllers/RelacionController.php:12`, `app/Http/Controllers/RelacionController.php:103`, `app/Http/Controllers/RelacionController.php:575`.

Consumidores históricos (10): `app/Http/Controllers/Hrs_docentesClasesController.php:5`, `app/Http/Controllers/Hrs_docentesClasesController.php:83`, `app/Http/Controllers/Hrs_docentesClasesController.php:311`, `app/Http/Controllers/Hrs_docentesClasesController.php:569`, `app/Http/Controllers/Hrs_docentesClasesController.php:797`, `app/Http/Controllers/RelacionController.php:12`, `app/Http/Controllers/RelacionController.php:103`, `app/Http/Controllers/RelacionController.php:575`.

### `App\Hrs_Rhps`

Archivo: `app/Hrs_Rhps.php`. Tabla: `hrs_rhps` (existe). Clave configurada: `id_rhps`; PRIMARY KEY físico: `id_rhps`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Rhps.php`.

Consumidores actuales (5): `app/Extensiones/consultas.php:14`, `app/Http/Controllers/ArmarHorariosController.php:13`, `app/Http/Controllers/ArmarHorariosController.php:1012`, `app/Http/Controllers/ArmarHorariosController.php:1080`, `app/Http/Controllers/ArmarHorariosController.php:1086`.

Consumidores históricos (5): `app/Extensiones/consultas.php:14`, `app/Http/Controllers/ArmarHorariosController.php:13`, `app/Http/Controllers/ArmarHorariosController.php:1012`, `app/Http/Controllers/ArmarHorariosController.php:1080`, `app/Http/Controllers/ArmarHorariosController.php:1086`.

### `App\Hrs_Situaciones`

Archivo: `app/Hrs_Situaciones.php`. Tabla: `hrs_situaciones` (existe). Clave configurada: `id_situacion`; PRIMARY KEY físico: `id_situacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Hrs_Situaciones.php`.

Consumidores actuales (9): `app/Http/Controllers/DocentesAgController.php:14`, `app/Http/Controllers/DocentesAgController.php:207`, `app/Http/Controllers/DocentesController.php:13`, `app/Http/Controllers/SEscolaresController.php:17`, `app/Http/Controllers/SituacionController.php:9`, `app/Http/Controllers/SituacionController.php:39`, `app/Http/Controllers/SituacionController.php:54`, `app/Http/Controllers/SituacionController.php:70`.

Consumidores históricos (9): `app/Http/Controllers/DocentesAgController.php:14`, `app/Http/Controllers/DocentesAgController.php:207`, `app/Http/Controllers/DocentesController.php:13`, `app/Http/Controllers/SEscolaresController.php:17`, `app/Http/Controllers/SituacionController.php:9`, `app/Http/Controllers/SituacionController.php:39`, `app/Http/Controllers/SituacionController.php:54`, `app/Http/Controllers/SituacionController.php:70`.

### `App\Incidencias`

Archivo: `app/Incidencias.php`. Tabla: `incidencias` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva incidencias no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Incidencias.php`.

Consumidores actuales (1): `app/Http/Controllers/IncidenciasController.php:6`.

Consumidores históricos (1): `app/Http/Controllers/IncidenciasController.php:6`.

### `App\Inc_solicitude`

Archivo: `app/Inc_solicitude.php`. Tabla: `inc_solicitudes` (existe). Clave configurada: `id_solicitud`; PRIMARY KEY físico: `id_solicitud`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `datetime` | NO | `null` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Inc_solicitude.php`.

Consumidores actuales (11): `app/Http/Controllers/IncidenciasController.php:12`, `app/Http/Controllers/IncidenciasController.php:781`, `app/Http/Controllers/IncidenciasController.php:807`, `app/Http/Controllers/IncidenciasController.php:832`, `app/Http/Controllers/IncidenciasController.php:857`, `app/Http/Controllers/IncidenciasController.php:882`, `app/Http/Controllers/IncidenciasController.php:909`, `app/Http/Controllers/IncidenciasController.php:936`.

Consumidores históricos (11): `app/Http/Controllers/IncidenciasController.php:12`, `app/Http/Controllers/IncidenciasController.php:781`, `app/Http/Controllers/IncidenciasController.php:807`, `app/Http/Controllers/IncidenciasController.php:832`, `app/Http/Controllers/IncidenciasController.php:857`, `app/Http/Controllers/IncidenciasController.php:882`, `app/Http/Controllers/IncidenciasController.php:909`, `app/Http/Controllers/IncidenciasController.php:936`.

### `App\in_nivel_ingles`

Archivo: `app/in_nivel_ingles.php`. Tabla: `in_nivel_ingles` (existe). Clave configurada: `id_nivel_ingles`; PRIMARY KEY físico: `id_nivel_ingles`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/in_nivel_ingles.php`.

Consumidores actuales (3): `app/Http/Controllers/In_registrar_profesoresController.php:8`, `app/Http/Controllers/In_registrar_profesoresController.php:24`, `app/Http/Controllers/In_registrar_profesoresController.php:78`.

Consumidores históricos (3): `app/Http/Controllers/In_registrar_profesoresController.php:8`, `app/Http/Controllers/In_registrar_profesoresController.php:24`, `app/Http/Controllers/In_registrar_profesoresController.php:78`.

### `App\in_profesores_ingles`

Archivo: `app/in_profesores_ingles.php`. Tabla: `in_profesores_ingles` (existe). Clave configurada: `id_profesores`; PRIMARY KEY físico: `id_profesores`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/in_profesores_ingles.php`.

Consumidores actuales (2): `app/Http/Controllers/In_registrar_profesoresController.php:9`, `app/Http/Controllers/In_registrar_profesoresController.php:58`.

Consumidores históricos (2): `app/Http/Controllers/In_registrar_profesoresController.php:9`, `app/Http/Controllers/In_registrar_profesoresController.php:58`.

### `App\in_sexo`

Archivo: `app/in_sexo.php`. Tabla: `in_sexo` (existe). Clave configurada: `id_sexo`; PRIMARY KEY físico: `id_sexo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/in_sexo.php`.

Consumidores actuales (3): `app/Http/Controllers/In_registrar_profesoresController.php:10`, `app/Http/Controllers/In_registrar_profesoresController.php:25`, `app/Http/Controllers/In_registrar_profesoresController.php:79`.

Consumidores históricos (3): `app/Http/Controllers/In_registrar_profesoresController.php:10`, `app/Http/Controllers/In_registrar_profesoresController.php:25`, `app/Http/Controllers/In_registrar_profesoresController.php:79`.

### `App\in_titulo`

Archivo: `app/in_titulo.php`. Tabla: `in_titulo` (existe). Clave configurada: `id_titulo`; PRIMARY KEY físico: `id_titulo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/in_titulo.php`.

Consumidores actuales (3): `app/Http/Controllers/In_registrar_profesoresController.php:11`, `app/Http/Controllers/In_registrar_profesoresController.php:26`, `app/Http/Controllers/In_registrar_profesoresController.php:80`.

Consumidores históricos (3): `app/Http/Controllers/In_registrar_profesoresController.php:11`, `app/Http/Controllers/In_registrar_profesoresController.php:26`, `app/Http/Controllers/In_registrar_profesoresController.php:80`.

### `App\In_voucher_pago`

Archivo: `app/In_voucher_pago.php`. Tabla: `in_voucher_pago` (existe). Clave configurada: `id_voucher`; PRIMARY KEY físico: `id_voucher`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/In_voucher_pago.php`.

Consumidores actuales (6): `app/Http/Controllers/In_voucher_pagoController.php:10`, `app/Http/Controllers/In_voucher_pagoController.php:110`, `app/Http/Controllers/In_voucher_validacionController.php:11`, `app/Http/Controllers/In_voucher_validacionController.php:99`, `app/Http/Controllers/In_voucher_validacionController.php:106`, `app/Http/Controllers/In_voucher_validacionController.php:114`.

Consumidores históricos (6): `app/Http/Controllers/In_voucher_pagoController.php:10`, `app/Http/Controllers/In_voucher_pagoController.php:110`, `app/Http/Controllers/In_voucher_validacionController.php:11`, `app/Http/Controllers/In_voucher_validacionController.php:99`, `app/Http/Controllers/In_voucher_validacionController.php:106`, `app/Http/Controllers/In_voucher_validacionController.php:114`.

### `App\Jefaturas`

Archivo: `app/Jefaturas.php`. Tabla: `actcomple_jefaturas` (existe). Clave configurada: `id_jefatura`; PRIMARY KEY físico: `id_jefatura`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Jefaturas.php`.

Consumidores actuales (3): `app/Http/Controllers/RegistrarActSubController.php:9`, `app/Http/Controllers/RegistrarActSubController.php:86`, `app/PMSolicitudMaterial.php:28`.

Consumidores históricos (3): `app/Http/Controllers/RegistrarActSubController.php:9`, `app/Http/Controllers/RegistrarActSubController.php:86`, `app/PMSolicitudMaterial.php:28`.

### `App\Models\User`

Archivo: `app/Models/User.php`. Tabla: `users` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(10) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: no existe en la referencia disponible.

Consumidores actuales (7): `app/ActivationService.php:53`, `app/Http/Controllers/Auth/RegisterController.php:35`, `app/Http/Controllers/datos_alumno.php:517`, `app/Http/Controllers/Personales.php:141`, `app/Http/Requests/ProfileUpdateRequest.php:5`, `app/Http/Requests/ProfileUpdateRequest.php:27`, `app/Imports/Registro_EstudiantesImport.php:46`.

Consumidores históricos (5): `app/ActivationService.php:53`, `app/Http/Controllers/Auth/RegisterController.php:35`, `app/Http/Controllers/datos_alumno.php:517`, `app/Http/Controllers/Personales.php:141`, `app/Imports/Registro_EstudiantesImport.php:46`.

### `App\Municipios`

Archivo: `app/Municipios.php`. Tabla: `gnral_municipios` (existe). Clave configurada: `id_municipio`; PRIMARY KEY físico: `id_municipio`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Municipios.php`.

Consumidores actuales (6): `app/Http/Controllers/datos_alumno.php:10`, `app/Http/Controllers/datos_alumno.php:30`, `app/Http/Controllers/OficiosComisionController.php:11`, `app/Http/Controllers/SolicitudAutoController.php:9`, `app/Http/Controllers/SolicitudAutoController.php:36`, `routes/web.php:393`.

Consumidores históricos (6): `app/Http/Controllers/datos_alumno.php:10`, `app/Http/Controllers/datos_alumno.php:30`, `app/Http/Controllers/OficiosComisionController.php:11`, `app/Http/Controllers/SolicitudAutoController.php:9`, `app/Http/Controllers/SolicitudAutoController.php:36`, `routes/web.php:393`.

### `App\oc_dependencias`

Archivo: `app/oc_dependencias.php`. Tabla: `oc_depend_domicilio` (existe). Clave configurada: `id_depend_domicilio`; PRIMARY KEY físico: `id_depend_domicilio`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `null`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** createdAt ajustado de "created_at" a null según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/oc_dependencias.php`.

Consumidores actuales (2): `app/Http/Controllers/OficiosComisionController.php:16`, `app/Http/Controllers/OficiosComisionController.php:724`.

Consumidores históricos (2): `app/Http/Controllers/OficiosComisionController.php:16`, `app/Http/Controllers/OficiosComisionController.php:724`.

### `App\Oc_lugar`

Archivo: `app/Oc_lugar.php`. Tabla: `oc_lugar` (existe). Clave configurada: `id_lugar`; PRIMARY KEY físico: `id_lugar`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Oc_lugar.php`.

Consumidores actuales (4): `app/Http/Controllers/OficiosComisionController.php:12`, `app/Http/Controllers/OficiosComisionController.php:27`, `app/Http/Controllers/OficiosComisionController.php:214`, `app/Http/Controllers/OficiosComisionController.php:239`.

Consumidores históricos (4): `app/Http/Controllers/OficiosComisionController.php:12`, `app/Http/Controllers/OficiosComisionController.php:27`, `app/Http/Controllers/OficiosComisionController.php:214`, `app/Http/Controllers/OficiosComisionController.php:239`.

### `App\oc_notificacion`

Archivo: `app/oc_notificacion.php`. Tabla: `oc_estado_oficio` (existe). Clave configurada: `id_notificacion`; PRIMARY KEY físico: `id_notificacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/oc_notificacion.php`.

Consumidores actuales (1): `app/oc_oficio_personal.php:21`.

Consumidores históricos (1): `app/oc_oficio_personal.php:20`.

### `App\oc_oficio`

Archivo: `app/oc_oficio.php`. Tabla: `oc_oficio` (existe). Clave configurada: `id_oficio`; PRIMARY KEY físico: `id_oficio`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `null`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | `varchar(100)` | NO | `null` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** updated_at tiene tipo varchar(100); revisar conversiones y datos existentes.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 5.

- `comisionados` → `App\oc_oficio_personal`: oc_oficio.id_oficio [int(11)] ↔ oc_oficio_personal.id_oficio [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `comisiones` → `App\oc_oficio_personal`: oc_oficio.id_oficio [int(11)] ↔ oc_oficio_personal.id_oficio [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `comisionadosprofesores` → `App\oc_oficio_personal`: oc_oficio.id_oficio [int(11)] ↔ oc_oficio_personal.id_oficio [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `usuario` → `App\Gnral_Personales`: oc_oficio.id_usuario [int(11)] ↔ gnral_personales.tipo_usuario [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `comisionesvalidadas` → `App\oc_oficio_personal`: oc_oficio.id_oficio [int(11)] ↔ oc_oficio_personal.id_oficio [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/oc_oficio.php`.

Consumidores actuales (15): `app/Http/Controllers/OcEvaluacionOficioController.php:4`, `app/Http/Controllers/OcEvaluacionOficioController.php:16`, `app/Http/Controllers/OcEvaluacionOficioController.php:26`, `app/Http/Controllers/OcEvaluacionOficioController.php:42`, `app/Http/Controllers/OcEvaluacionOficioController.php:53`, `app/Http/Controllers/OcRegOficioController.php:6`, `app/Http/Controllers/OcRegOficioController.php:19`, `app/Http/Controllers/OcRegOficioController.php:23`.

Consumidores históricos (15): `app/Http/Controllers/OcEvaluacionOficioController.php:4`, `app/Http/Controllers/OcEvaluacionOficioController.php:16`, `app/Http/Controllers/OcEvaluacionOficioController.php:26`, `app/Http/Controllers/OcEvaluacionOficioController.php:42`, `app/Http/Controllers/OcEvaluacionOficioController.php:53`, `app/Http/Controllers/OcRegOficioController.php:6`, `app/Http/Controllers/OcRegOficioController.php:19`, `app/Http/Controllers/OcRegOficioController.php:23`.

### `App\oc_oficio_personal`

Archivo: `app/oc_oficio_personal.php`. Tabla: `oc_oficio_personal` (existe). Clave configurada: `id_oficio_personal`; PRIMARY KEY físico: `id_oficio_personal`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **posible incompatibilidad — pendiente:** notificacion() usa clave local implícita id_oficio_personal y OR sin agrupar; existe igual en Laravel 5.6. Confirmar semántica y consumidores antes de cambiar resultados.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 3.

- `oficio` → `App\oc_oficio`: oc_oficio_personal.id_oficio [int(11)] ↔ oc_oficio.id_oficio [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `notificacion` → `App\oc_notificacion`: oc_oficio_personal.id_oficio_personal [int(11)] ↔ oc_estado_oficio.id_notificacion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `personal` → `App\Personal`: oc_oficio_personal.id_personal [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/oc_oficio_personal.php`.

Consumidores actuales (9): `app/Http/Controllers/OcRegOficioController.php:7`, `app/Http/Controllers/OficiosComisionController.php:14`, `app/Http/Controllers/OficiosComisionController.php:342`, `app/Http/Controllers/OficiosComisionController.php:351`, `app/Http/Controllers/OficiosComisionController.php:608`, `app/Http/Controllers/OficiosComisionController.php:617`, `app/Http/Controllers/OficiosComisionController.php:633`, `app/Http/Controllers/OficiosComisionController.php:637`.

Consumidores históricos (9): `app/Http/Controllers/OcRegOficioController.php:7`, `app/Http/Controllers/OficiosComisionController.php:14`, `app/Http/Controllers/OficiosComisionController.php:342`, `app/Http/Controllers/OficiosComisionController.php:351`, `app/Http/Controllers/OficiosComisionController.php:608`, `app/Http/Controllers/OficiosComisionController.php:617`, `app/Http/Controllers/OficiosComisionController.php:633`, `app/Http/Controllers/OficiosComisionController.php:637`.

### `App\oc_oficio_vehiculo`

Archivo: `app/oc_oficio_vehiculo.php`. Tabla: `oc_oficio_vehiculo` (existe). Clave configurada: `id_oficio_vehiculo`; PRIMARY KEY físico: `id_oficio_vehiculo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/oc_oficio_vehiculo.php`.

Consumidores actuales (3): `app/Http/Controllers/OcRegOficioController.php:8`, `app/Http/Controllers/OficiosComisionController.php:15`, `app/Http/Controllers/OficiosRegistrarcomisionadosController.php:8`.

Consumidores históricos (3): `app/Http/Controllers/OcRegOficioController.php:8`, `app/Http/Controllers/OficiosComisionController.php:15`, `app/Http/Controllers/OficiosRegistrarcomisionadosController.php:8`.

### `App\oc_vehiculo`

Archivo: `app/oc_vehiculo.php`. Tabla: `oc_vehiculo` (existe). Clave configurada: `id_vehiculo`; PRIMARY KEY físico: `id_vehiculo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/oc_vehiculo.php`.

Consumidores actuales (1): `app/Http/Controllers/SolicitudAutoController.php:6`.

Consumidores históricos (1): `app/Http/Controllers/SolicitudAutoController.php:6`.

### `App\Paa_Accion`

Archivo: `app/Paa_Accion.php`. Tabla: `pa_accion` (ausente). Clave configurada: `id_accion`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva pa_accion no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Paa_Accion.php`.

Consumidores actuales (3): `app/Http/Controllers/PaaAccionController.php:9`, `app/Http/Controllers/PaaAccionController.php:31`, `app/Http/Controllers/PaaAccionController.php:53`.

Consumidores históricos (3): `app/Http/Controllers/PaaAccionController.php:9`, `app/Http/Controllers/PaaAccionController.php:31`, `app/Http/Controllers/PaaAccionController.php:53`.

### `App\Paa_Programa`

Archivo: `app/Paa_Programa.php`. Tabla: `pa_programa` (ausente). Clave configurada: `id_programa`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva pa_programa no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Paa_Programa.php`.

Consumidores actuales (3): `app/Http/Controllers/PaaProgramaController.php:9`, `app/Http/Controllers/PaaProgramaController.php:30`, `app/Http/Controllers/PaaProgramaController.php:44`.

Consumidores históricos (3): `app/Http/Controllers/PaaProgramaController.php:9`, `app/Http/Controllers/PaaProgramaController.php:30`, `app/Http/Controllers/PaaProgramaController.php:44`.

### `App\Paa_Subprograma`

Archivo: `app/Paa_Subprograma.php`. Tabla: `pa_subprograma` (ausente). Clave configurada: `id_subprograma`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva pa_subprograma no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Paa_Subprograma.php`.

Consumidores actuales (3): `app/Http/Controllers/PaaSubprogramaController.php:9`, `app/Http/Controllers/PaaSubprogramaController.php:28`, `app/Http/Controllers/PaaSubprogramaController.php:40`.

Consumidores históricos (3): `app/Http/Controllers/PaaSubprogramaController.php:9`, `app/Http/Controllers/PaaSubprogramaController.php:28`, `app/Http/Controllers/PaaSubprogramaController.php:40`.

### `App\Paa_UnidadMedida`

Archivo: `app/Paa_UnidadMedida.php`. Tabla: `pa_unimed` (ausente). Clave configurada: `id_unimed`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva pa_unimed no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Paa_UnidadMedida.php`.

Consumidores actuales (3): `app/Http/Controllers/PaaUnidadMedidaController.php:9`, `app/Http/Controllers/PaaUnidadMedidaController.php:27`, `app/Http/Controllers/PaaUnidadMedidaController.php:39`.

Consumidores históricos (3): `app/Http/Controllers/PaaUnidadMedidaController.php:9`, `app/Http/Controllers/PaaUnidadMedidaController.php:27`, `app/Http/Controllers/PaaUnidadMedidaController.php:39`.

### `App\Periodos`

Archivo: `app/Periodos.php`. Tabla: `gnral_periodos` (existe). Clave configurada: `id_periodo`; PRIMARY KEY físico: `id_periodo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Periodos.php`.

Consumidores actuales (15): `app/Http/Controllers/checar_cargaController.php:10`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:9`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:11`, `app/Http/Controllers/evaluacion_alumnoController.php:18`, `app/Http/Controllers/PDFlistasController.php:11`, `app/Http/Controllers/PDFlistasController.php:76`, `app/Http/Controllers/PDFlistasController.php:149`, `app/Http/Controllers/PDFlistasController.php:228`.

Consumidores históricos (15): `app/Http/Controllers/checar_cargaController.php:10`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:9`, `app/Http/Controllers/Dual_PDF_Listas_Alumnos.php:11`, `app/Http/Controllers/evaluacion_alumnoController.php:18`, `app/Http/Controllers/PDFlistasController.php:11`, `app/Http/Controllers/PDFlistasController.php:76`, `app/Http/Controllers/PDFlistasController.php:149`, `app/Http/Controllers/PDFlistasController.php:228`.

### `App\PeriodosCarreras`

Archivo: `app/PeriodosCarreras.php`. Tabla: `gnral_periodo_carreras` (existe). Clave configurada: `id_periodo_carrera`; PRIMARY KEY físico: `id_periodo_carrera`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/PeriodosCarreras.php`.

Consumidores actuales (1): `app/Http/Controllers/evaluacion_alumnoController.php:16`.

Consumidores históricos (1): `app/Http/Controllers/evaluacion_alumnoController.php:16`.

### `App\Personal`

Archivo: `app/Personal.php`. Tabla: `gnral_personales` (existe). Clave configurada: `id_personal`; PRIMARY KEY físico: `id_personal`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 1 coincidencias. Líneas: 18. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Personal.php`.

Consumidores actuales (11): `app/Http/Controllers/ConsultaRegActividadesController.php:15`, `app/Http/Controllers/DocenteActividadJefeController.php:11`, `app/Http/Controllers/evaluacion_alumnoController.php:10`, `app/Http/Controllers/LiberaActividadJefeController.php:8`, `app/Http/Controllers/Personales.php:9`, `app/Http/Controllers/Personales.php:124`, `app/Http/Controllers/Personales.php:140`, `app/Http/Controllers/SolicitudAlumnosJefeController.php:9`.

Consumidores históricos (11): `app/Http/Controllers/ConsultaRegActividadesController.php:15`, `app/Http/Controllers/DocenteActividadJefeController.php:11`, `app/Http/Controllers/evaluacion_alumnoController.php:10`, `app/Http/Controllers/LiberaActividadJefeController.php:8`, `app/Http/Controllers/Personales.php:9`, `app/Http/Controllers/Personales.php:124`, `app/Http/Controllers/Personales.php:140`, `app/Http/Controllers/SolicitudAlumnosJefeController.php:9`.

### `App\PMCodigosMaterial`

Archivo: `app/PMCodigosMaterial.php`. Tabla: `pmcodigos_material` (existe). Clave configurada: `id_codigo`; PRIMARY KEY físico: `id_codigo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/PMCodigosMaterial.php`.

Consumidores actuales (11): `app/Http/Controllers/PMCodigosMaterialController.php:5`, `app/Http/Controllers/PMCodigosMaterialController.php:49`, `app/Http/Controllers/PMCodigosMaterialController.php:71`, `app/Http/Controllers/PMCodigosMaterialController.php:75`, `app/Http/Controllers/PMCodigosMaterialController.php:127`, `app/Http/Controllers/PMCodigosMaterialController.php:150`, `app/Http/Controllers/PMMaterial_PrestamosController.php:7`, `app/Http/Controllers/PMMaterial_PrestamosController.php:22`.

Consumidores históricos (11): `app/Http/Controllers/PMCodigosMaterialController.php:5`, `app/Http/Controllers/PMCodigosMaterialController.php:49`, `app/Http/Controllers/PMCodigosMaterialController.php:71`, `app/Http/Controllers/PMCodigosMaterialController.php:75`, `app/Http/Controllers/PMCodigosMaterialController.php:127`, `app/Http/Controllers/PMCodigosMaterialController.php:150`, `app/Http/Controllers/PMMaterial_PrestamosController.php:7`, `app/Http/Controllers/PMMaterial_PrestamosController.php:22`.

### `App\PMMaterial_Prestamos`

Archivo: `app/PMMaterial_Prestamos.php`. Tabla: `pmprestamos_materiales` (existe). Clave configurada: `id_material`; PRIMARY KEY físico: `id_material`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/PMMaterial_Prestamos.php`.

Consumidores actuales (12): `app/Http/Controllers/PMMaterial_PrestamosController.php:6`, `app/Http/Controllers/PMMaterial_PrestamosController.php:21`, `app/Http/Controllers/PMMaterial_PrestamosController.php:66`, `app/Http/Controllers/PMMaterial_PrestamosController.php:99`, `app/Http/Controllers/PMMaterial_PrestamosController.php:142`, `app/Http/Controllers/PMMaterial_PrestamosController.php:157`, `app/Http/Controllers/PMPrestamosController.php:5`, `app/Http/Controllers/PMPrestamosController.php:68`.

Consumidores históricos (12): `app/Http/Controllers/PMMaterial_PrestamosController.php:6`, `app/Http/Controllers/PMMaterial_PrestamosController.php:21`, `app/Http/Controllers/PMMaterial_PrestamosController.php:66`, `app/Http/Controllers/PMMaterial_PrestamosController.php:99`, `app/Http/Controllers/PMMaterial_PrestamosController.php:142`, `app/Http/Controllers/PMMaterial_PrestamosController.php:157`, `app/Http/Controllers/PMPrestamosController.php:5`, `app/Http/Controllers/PMPrestamosController.php:68`.

### `App\PMSolicitudMaterial`

Archivo: `app/PMSolicitudMaterial.php`. Tabla: `pmsolicitud_material` (existe). Clave configurada: `id_solicitud`; PRIMARY KEY físico: `id_solicitud`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `material` → `App\PMMaterial_Prestamos`: pmsolicitud_material.id_material [int(11)] ↔ pmprestamos_materiales.id_material [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `jefaturas` → `App\Jefaturas`: pmsolicitud_material.id_jefatura [int(11)] ↔ actcomple_jefaturas.id_jefatura [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/PMSolicitudMaterial.php`.

Consumidores actuales (7): `app/Http/Controllers/PMPrestamosController.php:6`, `app/Http/Controllers/PMPrestamosController.php:113`, `app/Http/Controllers/PMPrestamosController.php:157`, `app/Http/Controllers/PMSolicitudMaterialesController.php:6`, `app/Http/Controllers/PMSolicitudMaterialesController.php:341`, `app/Http/Controllers/PMSolicitudMaterialesController.php:360`, `app/Http/Controllers/PMSolicitudMaterialesController.php:386`.

Consumidores históricos (7): `app/Http/Controllers/PMPrestamosController.php:6`, `app/Http/Controllers/PMPrestamosController.php:113`, `app/Http/Controllers/PMPrestamosController.php:157`, `app/Http/Controllers/PMSolicitudMaterialesController.php:6`, `app/Http/Controllers/PMSolicitudMaterialesController.php:341`, `app/Http/Controllers/PMSolicitudMaterialesController.php:360`, `app/Http/Controllers/PMSolicitudMaterialesController.php:386`.

### `App\RegistroAlumnos`

Archivo: `app/RegistroAlumnos.php`. Tabla: `actcomple_registro_alumnos` (existe). Clave configurada: `id_registro_alumno`; PRIMARY KEY físico: `id_registro_alumno`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RegistroAlumnos.php`.

Consumidores actuales (15): `app/Http/Controllers/ActividadesGenralesController.php:7`, `app/Http/Controllers/ConsultaRegActividadesController.php:13`, `app/Http/Controllers/ConsultaRegActividadesController.php:215`, `app/Http/Controllers/ConsultaRegActividadesController.php:291`, `app/Http/Controllers/ConsultaRegActividadesController.php:369`, `app/Http/Controllers/ConsultaRegActividadesController.php:381`, `app/Http/Controllers/Consulta_modificar_ActividadController.php:5`, `app/Http/Controllers/Consulta_modificar_ActividadController.php:12`.

Consumidores históricos (15): `app/Http/Controllers/ActividadesGenralesController.php:7`, `app/Http/Controllers/ConsultaRegActividadesController.php:13`, `app/Http/Controllers/ConsultaRegActividadesController.php:215`, `app/Http/Controllers/ConsultaRegActividadesController.php:291`, `app/Http/Controllers/ConsultaRegActividadesController.php:369`, `app/Http/Controllers/ConsultaRegActividadesController.php:381`, `app/Http/Controllers/Consulta_modificar_ActividadController.php:5`, `app/Http/Controllers/Consulta_modificar_ActividadController.php:12`.

### `App\RegistroCoordinadores`

Archivo: `app/RegistroCoordinadores.php`. Tabla: `actcomple_registros_coordinadores` (existe). Clave configurada: `id_reg_coordinador`; PRIMARY KEY físico: `id_reg_coordinador`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RegistroCoordinadores.php`.

Consumidores actuales (10): `app/Http/Controllers/ConsultaRegActividadesController.php:14`, `app/Http/Controllers/LiberaPlaneacionJefeController.php:8`, `app/Http/Controllers/LiberaPlaneacionJefeController.php:105`, `app/Http/Controllers/LiberaPlaneacionJefeController.php:130`, `app/Http/Controllers/PlaneaActividadProfController.php:11`, `app/Http/Controllers/PlaneaActividadProfController.php:175`, `app/Http/Controllers/PlaneaActividadProfController.php:237`, `app/Http/Controllers/PlaneaActividadProfController.php:271`.

Consumidores históricos (10): `app/Http/Controllers/ConsultaRegActividadesController.php:14`, `app/Http/Controllers/LiberaPlaneacionJefeController.php:8`, `app/Http/Controllers/LiberaPlaneacionJefeController.php:105`, `app/Http/Controllers/LiberaPlaneacionJefeController.php:130`, `app/Http/Controllers/PlaneaActividadProfController.php:11`, `app/Http/Controllers/PlaneaActividadProfController.php:175`, `app/Http/Controllers/PlaneaActividadProfController.php:237`, `app/Http/Controllers/PlaneaActividadProfController.php:271`.

### `App\RegRiesgo`

Archivo: `app/RegRiesgo.php`. Tabla: `ri_registro_riesgo` (existe). Clave configurada: `id_reg_riesgo`; PRIMARY KEY físico: `id_reg_riesgo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 8.

- `riesgos` → `App\ri_riesgo`: ri_registro_riesgo.id_riesgo [int(11)] ↔ ri_riesgo.id_riesgo [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `unidadAdmin` → `App\gnral_unidad_administrativa`: ri_registro_riesgo.id_unidad_admin [int(11)] ↔ gnral_unidad_administrativa.id_unidad_admin [bigint(10)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `seleccion` → `App\riseleccion`: ri_registro_riesgo.id_seleccion [int(11)] ↔ ri_seleccion.id_seleccion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `nivelDecision` → `App\ri_nivel_decision`: ri_registro_riesgo.id_nivel_des [int(11)] ↔ ri_nivel_decision.id_nivel_de [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `clasificacionRiesgo` → `App\ri_clasif_r`: ri_registro_riesgo.id_cl_r [int(11)] ↔ ri_clasif_r.id_cl_r [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `valEfectos` → `App\ri_valoracion_efecto`: ri_registro_riesgo.id_reg_riesgo [int(11)] ↔ ri_valoracion_efectos.id_reg_riesgo [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `factorRiesgo` → `App\ri_factores`: ri_registro_riesgo.id_reg_riesgo [int(11)] ↔ ri_factores.id_reg_riesgo [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `estrategiaRiesgo` → `App\ri_estrategia_riesgo`: ri_registro_riesgo.id_reg_riesgo [int(11)] ↔ ri_estrategia_riesgo.id_reg_riesgo [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RegRiesgo.php`.

Consumidores actuales (11): `app/Http/Controllers/API/RegRiesgoController.php:7`, `app/Http/Controllers/API/RegRiesgoController.php:22`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:10`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:19`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:20`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:24`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:36`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:37`.

Consumidores históricos (11): `app/Http/Controllers/API/RegRiesgoController.php:7`, `app/Http/Controllers/API/RegRiesgoController.php:22`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:10`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:19`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:20`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:24`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:36`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:37`.

### `App\Resi_Periodo_eval_anteproyecto`

Archivo: `app/Resi_Periodo_eval_anteproyecto.php`. Tabla: `resi_periodo_eval_anteproyecto` (existe). Clave configurada: `id_periodo_eval_anteproyecto`; PRIMARY KEY físico: `id_periodo_eval_anteproyecto`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Resi_Periodo_eval_anteproyecto.php`.

Consumidores actuales (2): `app/Http/Controllers/Resi_Periodo_eval_anteproyectoController.php:7`, `app/Http/Controllers/Resi_Periodo_eval_anteproyectoController.php:39`.

Consumidores históricos (2): `app/Http/Controllers/Resi_Periodo_eval_anteproyectoController.php:7`, `app/Http/Controllers/Resi_Periodo_eval_anteproyectoController.php:39`.

### `App\riEstrategia`

Archivo: `app/riEstrategia.php`. Tabla: `ri_estrategia` (existe). Clave configurada: `id_estrategia`; PRIMARY KEY físico: `id_estrategia`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `true`; columna efectiva de borrado: `"deleted_at"`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/riEstrategia.php`.

Consumidores actuales (8): `app/Http/Controllers/RegRiesgoController.php:12`, `app/Http/Controllers/RegRiesgoController.php:53`, `app/Http/Controllers/RiEstrategiaController.php:7`, `app/Http/Controllers/RiEstrategiaController.php:18`, `app/Http/Controllers/RiEstrategiaController.php:53`, `app/Http/Controllers/RiEstrategiaController.php:78`, `app/Http/Controllers/RiEstrategiaController.php:103`, `app/Http/Controllers/RiEstrategiaController.php:116`.

Consumidores históricos (8): `app/Http/Controllers/RegRiesgoController.php:12`, `app/Http/Controllers/RegRiesgoController.php:53`, `app/Http/Controllers/RiEstrategiaController.php:7`, `app/Http/Controllers/RiEstrategiaController.php:18`, `app/Http/Controllers/RiEstrategiaController.php:53`, `app/Http/Controllers/RiEstrategiaController.php:78`, `app/Http/Controllers/RiEstrategiaController.php:103`, `app/Http/Controllers/RiEstrategiaController.php:116`.

### `App\riseleccion`

Archivo: `app/riseleccion.php`. Tabla: `ri_seleccion` (existe). Clave configurada: `id_seleccion`; PRIMARY KEY físico: `id_seleccion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/riseleccion.php`.

Consumidores actuales (9): `app/Http/Controllers/API/RegRiesgoController.php:8`, `app/Http/Controllers/API/RegRiesgoController.php:25`, `app/Http/Controllers/RegRiesgoController.php:13`, `app/Http/Controllers/RegRiesgoController.php:48`, `app/Http/Controllers/RiSeleccionController.php:7`, `app/Http/Controllers/RiSeleccionController.php:55`, `app/Http/Controllers/RiSeleccionController.php:80`, `app/Http/Controllers/RiSeleccionController.php:105`.

Consumidores históricos (9): `app/Http/Controllers/API/RegRiesgoController.php:8`, `app/Http/Controllers/API/RegRiesgoController.php:25`, `app/Http/Controllers/RegRiesgoController.php:13`, `app/Http/Controllers/RegRiesgoController.php:48`, `app/Http/Controllers/RiSeleccionController.php:7`, `app/Http/Controllers/RiSeleccionController.php:55`, `app/Http/Controllers/RiSeleccionController.php:80`, `app/Http/Controllers/RiSeleccionController.php:105`.

### `App\ritipo_f`

Archivo: `app/ritipo_f.php`. Tabla: `ri_tipo_f` (existe). Clave configurada: `id_tipo_f`; PRIMARY KEY físico: `id_tipo_f`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ritipo_f.php`.

Consumidores actuales (7): `app/Http/Controllers/RegRiesgoController.php:14`, `app/Http/Controllers/RegRiesgoController.php:49`, `app/Http/Controllers/RiTipoFController.php:8`, `app/Http/Controllers/RiTipoFController.php:58`, `app/Http/Controllers/RiTipoFController.php:82`, `app/Http/Controllers/RiTipoFController.php:107`, `app/Http/Controllers/RiTipoFController.php:121`.

Consumidores históricos (7): `app/Http/Controllers/RegRiesgoController.php:14`, `app/Http/Controllers/RegRiesgoController.php:49`, `app/Http/Controllers/RiTipoFController.php:8`, `app/Http/Controllers/RiTipoFController.php:58`, `app/Http/Controllers/RiTipoFController.php:82`, `app/Http/Controllers/RiTipoFController.php:107`, `app/Http/Controllers/RiTipoFController.php:121`.

### `App\ri_clasif_factor`

Archivo: `app/ri_clasif_factor.php`. Tabla: `ri_clasif_factor` (existe). Clave configurada: `id_cl_f`; PRIMARY KEY físico: `id_cl_f`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_clasif_factor.php`.

Consumidores actuales (7): `app/Http/Controllers/RegRiesgoController.php:7`, `app/Http/Controllers/RegRiesgoController.php:50`, `app/Http/Controllers/RiClasifFactorController.php:8`, `app/Http/Controllers/RiClasifFactorController.php:57`, `app/Http/Controllers/RiClasifFactorController.php:81`, `app/Http/Controllers/RiClasifFactorController.php:106`, `app/Http/Controllers/RiClasifFactorController.php:119`.

Consumidores históricos (7): `app/Http/Controllers/RegRiesgoController.php:7`, `app/Http/Controllers/RegRiesgoController.php:50`, `app/Http/Controllers/RiClasifFactorController.php:8`, `app/Http/Controllers/RiClasifFactorController.php:57`, `app/Http/Controllers/RiClasifFactorController.php:81`, `app/Http/Controllers/RiClasifFactorController.php:106`, `app/Http/Controllers/RiClasifFactorController.php:119`.

### `App\ri_clasif_r`

Archivo: `app/ri_clasif_r.php`. Tabla: `ri_clasif_r` (existe). Clave configurada: `id_cl_r`; PRIMARY KEY físico: `id_cl_r`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_clasif_r.php`.

Consumidores actuales (5): `app/Http/Controllers/RiClasifRController.php:7`, `app/Http/Controllers/RiClasifRController.php:55`, `app/Http/Controllers/RiClasifRController.php:80`, `app/Http/Controllers/RiClasifRController.php:105`, `app/Http/Controllers/RiClasifRController.php:118`.

Consumidores históricos (5): `app/Http/Controllers/RiClasifRController.php:7`, `app/Http/Controllers/RiClasifRController.php:55`, `app/Http/Controllers/RiClasifRController.php:80`, `app/Http/Controllers/RiClasifRController.php:105`, `app/Http/Controllers/RiClasifRController.php:118`.

### `App\ri_estrategia_accion`

Archivo: `app/ri_estrategia_accion.php`. Tabla: `ri_estrategia_accion` (existe). Clave configurada: `id_estrategia_a`; PRIMARY KEY físico: `id_estrategia_a`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getUnidadAdmin` → `App\gnral_unidad_administrativa`: ri_estrategia_accion.id_unidad_admin [int(11)] ↔ gnral_unidad_administrativa.id_unidad_admin [bigint(10)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_estrategia_accion.php`.

Consumidores actuales (12): `app/Http/Controllers/RegRiesgoController.php:8`, `app/Http/Controllers/RiEstrategiaAccionController.php:5`, `app/Http/Controllers/RiEstrategiaAccionController.php:59`, `app/Http/Controllers/RiEstrategiaAccionController.php:112`, `app/Http/Controllers/RiEstrategiaAccionController.php:125`, `app/Http/Controllers/RiRegOportunidadController.php:5`, `app/Http/Controllers/RiSeguimientoController.php:6`, `app/Http/Controllers/RiSeguimientoController.php:62`.

Consumidores históricos (12): `app/Http/Controllers/RegRiesgoController.php:8`, `app/Http/Controllers/RiEstrategiaAccionController.php:5`, `app/Http/Controllers/RiEstrategiaAccionController.php:59`, `app/Http/Controllers/RiEstrategiaAccionController.php:112`, `app/Http/Controllers/RiEstrategiaAccionController.php:125`, `app/Http/Controllers/RiRegOportunidadController.php:5`, `app/Http/Controllers/RiSeguimientoController.php:6`, `app/Http/Controllers/RiSeguimientoController.php:62`.

### `App\ri_estrategia_riesgo`

Archivo: `app/ri_estrategia_riesgo.php`. Tabla: `ri_estrategia_riesgo` (existe). Clave configurada: `id_estrategia_r`; PRIMARY KEY físico: `id_estrategia_r`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getEstrategia` → `App\riEstrategia`: ri_estrategia_riesgo.id_estrategia [int(11)] ↔ ri_estrategia.id_estrategia [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_estrategia_riesgo.php`.

Consumidores actuales (7): `app/Http/Controllers/RegRiesgoController.php:9`, `app/Http/Controllers/RiEstrategiaRiesgoController.php:5`, `app/Http/Controllers/RiEstrategiaRiesgoController.php:49`, `app/Http/Controllers/RiEstrategiaRiesgoController.php:96`, `app/Http/Controllers/RiValoracionEfectoController.php:5`, `app/Http/Controllers/RiValoracionEfectoController.php:99`, `app/Http/Controllers/RiValoracionEfectoController.php:102`.

Consumidores históricos (7): `app/Http/Controllers/RegRiesgoController.php:9`, `app/Http/Controllers/RiEstrategiaRiesgoController.php:5`, `app/Http/Controllers/RiEstrategiaRiesgoController.php:49`, `app/Http/Controllers/RiEstrategiaRiesgoController.php:96`, `app/Http/Controllers/RiValoracionEfectoController.php:5`, `app/Http/Controllers/RiValoracionEfectoController.php:99`, `app/Http/Controllers/RiValoracionEfectoController.php:102`.

### `App\ri_evaluacion_control`

Archivo: `app/ri_evaluacion_control.php`. Tabla: `ri_evaluacion_control` (existe). Clave configurada: `id_evaluacion`; PRIMARY KEY físico: `id_evaluacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `riEvaControl` → `App\ri_evaluacion_control`: ri_evaluacion_control.id_factor [int(11)] ↔ ri_evaluacion_control.id_factor [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `tipoEva` → `App\ri_tipo_eva`: ri_evaluacion_control.id_tipo_eva [int(11)] ↔ ri_tipo_eva.id_tipo_eva [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_evaluacion_control.php`.

Consumidores actuales (5): `app/Http/Controllers/RiEvaluacionControlController.php:5`, `app/Http/Controllers/RiEvaluacionControlController.php:58`, `app/Http/Controllers/RiEvaluacionControlController.php:70`, `app/Http/Controllers/RiEvaluacionControlController.php:132`, `app/Http/Controllers/RiEvaluacionControlController.php:146`.

Consumidores históricos (5): `app/Http/Controllers/RiEvaluacionControlController.php:5`, `app/Http/Controllers/RiEvaluacionControlController.php:58`, `app/Http/Controllers/RiEvaluacionControlController.php:70`, `app/Http/Controllers/RiEvaluacionControlController.php:132`, `app/Http/Controllers/RiEvaluacionControlController.php:146`.

### `App\ri_factores`

Archivo: `app/ri_factores.php`. Tabla: `ri_factores` (existe). Clave configurada: `id_factor`; PRIMARY KEY físico: `id_factor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 4.

- `ri_tipof` → `App\ritipo_f`: ri_factores.id_tipo_f [int(11)] ↔ ri_tipo_f.id_tipo_f [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_clasi_f` → `App\ri_clasif_factor`: ri_factores.id_cl_f [int(11)] ↔ ri_clasif_factor.id_cl_f [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `riEvaControl` → `App\ri_evaluacion_control`: ri_factores.id_factor [int(11)] ↔ ri_evaluacion_control.id_factor [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `riAcciones` → `App\ri_estrategia_accion`: ri_factores.id_factor [int(11)] ↔ ri_estrategia_accion.id_factor [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_factores.php`.

Consumidores actuales (5): `app/Http/Controllers/RiFactoresController.php:5`, `app/Http/Controllers/RiFactoresController.php:55`, `app/Http/Controllers/RiFactoresController.php:59`, `app/Http/Controllers/RiFactoresController.php:111`, `app/Http/Controllers/RiFactoresController.php:125`.

Consumidores históricos (5): `app/Http/Controllers/RiFactoresController.php:5`, `app/Http/Controllers/RiFactoresController.php:55`, `app/Http/Controllers/RiFactoresController.php:59`, `app/Http/Controllers/RiFactoresController.php:111`, `app/Http/Controllers/RiFactoresController.php:125`.

### `App\ri_nivel_decision`

Archivo: `app/ri_nivel_decision.php`. Tabla: `ri_nivel_decision` (existe). Clave configurada: `id_nivel_de`; PRIMARY KEY físico: `id_nivel_de`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_nivel_decision.php`.

Consumidores actuales (5): `app/Http/Controllers/RiNivelDecisionController.php:7`, `app/Http/Controllers/RiNivelDecisionController.php:55`, `app/Http/Controllers/RiNivelDecisionController.php:80`, `app/Http/Controllers/RiNivelDecisionController.php:105`, `app/Http/Controllers/RiNivelDecisionController.php:118`.

Consumidores históricos (5): `app/Http/Controllers/RiNivelDecisionController.php:7`, `app/Http/Controllers/RiNivelDecisionController.php:55`, `app/Http/Controllers/RiNivelDecisionController.php:80`, `app/Http/Controllers/RiNivelDecisionController.php:105`, `app/Http/Controllers/RiNivelDecisionController.php:118`.

### `App\ri_o_calificacion`

Archivo: `app/ri_o_calificacion.php`. Tabla: `ri_o_calificacion` (existe). Clave configurada: `id_calificacion`; PRIMARY KEY físico: `id_calificacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_calificacion.php`.

Consumidores actuales (7): `app/Http/Controllers/RiOCalificacionController.php:7`, `app/Http/Controllers/RiOCalificacionController.php:57`, `app/Http/Controllers/RiOCalificacionController.php:83`, `app/Http/Controllers/RiOCalificacionController.php:108`, `app/Http/Controllers/RiOCalificacionController.php:121`, `app/Http/Controllers/RiRegOportunidadController.php:6`, `app/Http/Controllers/RiRegOportunidadController.php:91`.

Consumidores históricos (7): `app/Http/Controllers/RiOCalificacionController.php:7`, `app/Http/Controllers/RiOCalificacionController.php:57`, `app/Http/Controllers/RiOCalificacionController.php:83`, `app/Http/Controllers/RiOCalificacionController.php:108`, `app/Http/Controllers/RiOCalificacionController.php:121`, `app/Http/Controllers/RiRegOportunidadController.php:6`, `app/Http/Controllers/RiRegOportunidadController.php:91`.

### `App\ri_o_mejoracliente`

Archivo: `app/ri_o_mejoracliente.php`. Tabla: `ri_o_mejoracliente` (existe). Clave configurada: `id_mejoracliente`; PRIMARY KEY físico: `id_mejoracliente`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_mejoracliente.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOMejoraclienteController.php:5`, `app/Http/Controllers/RiOMejoraclienteController.php:59`, `app/Http/Controllers/RiOMejoraclienteController.php:83`, `app/Http/Controllers/RiOMejoraclienteController.php:109`, `app/Http/Controllers/RiOMejoraclienteController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:7`, `app/Http/Controllers/RiRegOportunidadController.php:87`, `app/Http/Controllers/RiRegOportunidadController.php:151`.

Consumidores históricos (8): `app/Http/Controllers/RiOMejoraclienteController.php:5`, `app/Http/Controllers/RiOMejoraclienteController.php:59`, `app/Http/Controllers/RiOMejoraclienteController.php:83`, `app/Http/Controllers/RiOMejoraclienteController.php:109`, `app/Http/Controllers/RiOMejoraclienteController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:7`, `app/Http/Controllers/RiRegOportunidadController.php:87`, `app/Http/Controllers/RiRegOportunidadController.php:151`.

### `App\ri_o_mejorareputacion`

Archivo: `app/ri_o_mejorareputacion.php`. Tabla: `ri_o_mejorareputacion` (existe). Clave configurada: `id_mejorareputacion`; PRIMARY KEY físico: `id_mejorareputacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_mejorareputacion.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOMejorareputacionController.php:5`, `app/Http/Controllers/RiOMejorareputacionController.php:59`, `app/Http/Controllers/RiOMejorareputacionController.php:83`, `app/Http/Controllers/RiOMejorareputacionController.php:109`, `app/Http/Controllers/RiOMejorareputacionController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:8`, `app/Http/Controllers/RiRegOportunidadController.php:89`, `app/Http/Controllers/RiRegOportunidadController.php:153`.

Consumidores históricos (8): `app/Http/Controllers/RiOMejorareputacionController.php:5`, `app/Http/Controllers/RiOMejorareputacionController.php:59`, `app/Http/Controllers/RiOMejorareputacionController.php:83`, `app/Http/Controllers/RiOMejorareputacionController.php:109`, `app/Http/Controllers/RiOMejorareputacionController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:8`, `app/Http/Controllers/RiRegOportunidadController.php:89`, `app/Http/Controllers/RiRegOportunidadController.php:153`.

### `App\ri_o_mejorasgc`

Archivo: `app/ri_o_mejorasgc.php`. Tabla: `ri_o_mejorasgc` (existe). Clave configurada: `id_mejorasgc`; PRIMARY KEY físico: `id_mejorasgc`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_mejorasgc.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOMejorasgcController.php:5`, `app/Http/Controllers/RiOMejorasgcController.php:59`, `app/Http/Controllers/RiOMejorasgcController.php:83`, `app/Http/Controllers/RiOMejorasgcController.php:109`, `app/Http/Controllers/RiOMejorasgcController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:9`, `app/Http/Controllers/RiRegOportunidadController.php:88`, `app/Http/Controllers/RiRegOportunidadController.php:152`.

Consumidores históricos (8): `app/Http/Controllers/RiOMejorasgcController.php:5`, `app/Http/Controllers/RiOMejorasgcController.php:59`, `app/Http/Controllers/RiOMejorasgcController.php:83`, `app/Http/Controllers/RiOMejorasgcController.php:109`, `app/Http/Controllers/RiOMejorasgcController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:9`, `app/Http/Controllers/RiRegOportunidadController.php:88`, `app/Http/Controllers/RiRegOportunidadController.php:152`.

### `App\ri_o_ocurrenciasp`

Archivo: `app/ri_o_ocurrenciasp.php`. Tabla: `ri_o_ocurrenciasp` (existe). Clave configurada: `id_ocurrenciap`; PRIMARY KEY físico: `id_ocurrenciap`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_ocurrenciasp.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOOcurrenciaspController.php:5`, `app/Http/Controllers/RiOOcurrenciaspController.php:59`, `app/Http/Controllers/RiOOcurrenciaspController.php:83`, `app/Http/Controllers/RiOOcurrenciaspController.php:109`, `app/Http/Controllers/RiOOcurrenciaspController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:10`, `app/Http/Controllers/RiRegOportunidadController.php:84`, `app/Http/Controllers/RiRegOportunidadController.php:145`.

Consumidores históricos (8): `app/Http/Controllers/RiOOcurrenciaspController.php:5`, `app/Http/Controllers/RiOOcurrenciaspController.php:59`, `app/Http/Controllers/RiOOcurrenciaspController.php:83`, `app/Http/Controllers/RiOOcurrenciaspController.php:109`, `app/Http/Controllers/RiOOcurrenciaspController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:10`, `app/Http/Controllers/RiRegOportunidadController.php:84`, `app/Http/Controllers/RiRegOportunidadController.php:145`.

### `App\ri_o_planseguimiento`

Archivo: `app/ri_o_planseguimiento.php`. Tabla: `ri_o_planseguimiento` (existe). Clave configurada: `id_planseguimiento`; PRIMARY KEY físico: `id_planseguimiento`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_planseguimiento.php`.

Consumidores actuales (12): `app/Http/Controllers/RiOPlanseguimientoController.php:5`, `app/Http/Controllers/RiOPlanseguimientoController.php:55`, `app/Http/Controllers/RiOPlanseguimientoController.php:80`, `app/Http/Controllers/RiOPlanseguimientoController.php:105`, `app/Http/Controllers/RiOPlanseguimientoController.php:118`, `app/Http/Controllers/RiRegOportunidadController.php:11`, `app/Http/Controllers/RiSeguimientoController.php:7`, `app/Http/Controllers/RiSeguimientoController.php:70`.

Consumidores históricos (12): `app/Http/Controllers/RiOPlanseguimientoController.php:5`, `app/Http/Controllers/RiOPlanseguimientoController.php:55`, `app/Http/Controllers/RiOPlanseguimientoController.php:80`, `app/Http/Controllers/RiOPlanseguimientoController.php:105`, `app/Http/Controllers/RiOPlanseguimientoController.php:118`, `app/Http/Controllers/RiRegOportunidadController.php:11`, `app/Http/Controllers/RiSeguimientoController.php:7`, `app/Http/Controllers/RiSeguimientoController.php:70`.

### `App\ri_o_potencialapertura`

Archivo: `app/ri_o_potencialapertura.php`. Tabla: `ri_o_potencialapertura` (existe). Clave configurada: `id_potencialapertura`; PRIMARY KEY físico: `id_potencialapertura`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_potencialapertura.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOPotencialaperturaController.php:5`, `app/Http/Controllers/RiOPotencialaperturaController.php:59`, `app/Http/Controllers/RiOPotencialaperturaController.php:83`, `app/Http/Controllers/RiOPotencialaperturaController.php:109`, `app/Http/Controllers/RiOPotencialaperturaController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:12`, `app/Http/Controllers/RiRegOportunidadController.php:85`, `app/Http/Controllers/RiRegOportunidadController.php:146`.

Consumidores históricos (8): `app/Http/Controllers/RiOPotencialaperturaController.php:5`, `app/Http/Controllers/RiOPotencialaperturaController.php:59`, `app/Http/Controllers/RiOPotencialaperturaController.php:83`, `app/Http/Controllers/RiOPotencialaperturaController.php:109`, `app/Http/Controllers/RiOPotencialaperturaController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:12`, `app/Http/Controllers/RiRegOportunidadController.php:85`, `app/Http/Controllers/RiRegOportunidadController.php:146`.

### `App\ri_o_potencialcosto`

Archivo: `app/ri_o_potencialcosto.php`. Tabla: `ri_o_potencialcosto` (existe). Clave configurada: `id_potencialcosto`; PRIMARY KEY físico: `id_potencialcosto`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_potencialcosto.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOPotencialcostoController.php:6`, `app/Http/Controllers/RiOPotencialcostoController.php:60`, `app/Http/Controllers/RiOPotencialcostoController.php:84`, `app/Http/Controllers/RiOPotencialcostoController.php:109`, `app/Http/Controllers/RiOPotencialcostoController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:13`, `app/Http/Controllers/RiRegOportunidadController.php:90`, `app/Http/Controllers/RiRegOportunidadController.php:154`.

Consumidores históricos (8): `app/Http/Controllers/RiOPotencialcostoController.php:6`, `app/Http/Controllers/RiOPotencialcostoController.php:60`, `app/Http/Controllers/RiOPotencialcostoController.php:84`, `app/Http/Controllers/RiOPotencialcostoController.php:109`, `app/Http/Controllers/RiOPotencialcostoController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:13`, `app/Http/Controllers/RiRegOportunidadController.php:90`, `app/Http/Controllers/RiRegOportunidadController.php:154`.

### `App\ri_o_potencialcrecimiento`

Archivo: `app/ri_o_potencialcrecimiento.php`. Tabla: `ri_o_potencialcrecimiento` (existe). Clave configurada: `id_potencialcrecimiento`; PRIMARY KEY físico: `id_potencialcrecimiento`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_potencialcrecimiento.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOPotencialcrecimientoController.php:5`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:59`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:83`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:109`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:14`, `app/Http/Controllers/RiRegOportunidadController.php:86`, `app/Http/Controllers/RiRegOportunidadController.php:147`.

Consumidores históricos (8): `app/Http/Controllers/RiOPotencialcrecimientoController.php:5`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:59`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:83`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:109`, `app/Http/Controllers/RiOPotencialcrecimientoController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:14`, `app/Http/Controllers/RiRegOportunidadController.php:86`, `app/Http/Controllers/RiRegOportunidadController.php:147`.

### `App\ri_o_probabilidad`

Archivo: `app/ri_o_probabilidad.php`. Tabla: `ri_o_probabilidad` (existe). Clave configurada: `id_probabilidad`; PRIMARY KEY físico: `id_probabilidad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_o_probabilidad.php`.

Consumidores actuales (8): `app/Http/Controllers/RiOProbabilidadController.php:5`, `app/Http/Controllers/RiOProbabilidadController.php:59`, `app/Http/Controllers/RiOProbabilidadController.php:83`, `app/Http/Controllers/RiOProbabilidadController.php:109`, `app/Http/Controllers/RiOProbabilidadController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:15`, `app/Http/Controllers/RiRegOportunidadController.php:83`, `app/Http/Controllers/RiRegOportunidadController.php:144`.

Consumidores históricos (8): `app/Http/Controllers/RiOProbabilidadController.php:5`, `app/Http/Controllers/RiOProbabilidadController.php:59`, `app/Http/Controllers/RiOProbabilidadController.php:83`, `app/Http/Controllers/RiOProbabilidadController.php:109`, `app/Http/Controllers/RiOProbabilidadController.php:122`, `app/Http/Controllers/RiRegOportunidadController.php:15`, `app/Http/Controllers/RiRegOportunidadController.php:83`, `app/Http/Controllers/RiRegOportunidadController.php:144`.

### `App\ri_partes`

Archivo: `app/ri_partes.php`. Tabla: `ri_partes` (existe). Clave configurada: `id_parte`; PRIMARY KEY físico: `id_parte`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_partes.php`.

Consumidores actuales (5): `app/Http/Controllers/RiPartesController.php:7`, `app/Http/Controllers/RiPartesController.php:54`, `app/Http/Controllers/RiPartesController.php:80`, `app/Http/Controllers/RiPartesController.php:105`, `app/Http/Controllers/RiPartesController.php:118`.

Consumidores históricos (5): `app/Http/Controllers/RiPartesController.php:7`, `app/Http/Controllers/RiPartesController.php:54`, `app/Http/Controllers/RiPartesController.php:80`, `app/Http/Controllers/RiPartesController.php:105`, `app/Http/Controllers/RiPartesController.php:118`.

### `App\ri_proceso`

Archivo: `app/ri_proceso.php`. Tabla: `ri_proceso` (existe). Clave configurada: `id_proceso`; PRIMARY KEY físico: `id_proceso`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `datetime` | NO | `null` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `sistema` → `App\ri_sistema`: ri_proceso.id_sistema [int(11)] ↔ ri_sistema.id_sistema [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_proceso.php`.

Consumidores actuales (26): `app/AudPrint.php:17`, `app/Http/Controllers/AudActividadesController.php:6`, `app/Http/Controllers/AudAgendaEventoController.php:24`, `app/Http/Controllers/AudAgendaEventoController.php:318`, `app/Http/Controllers/AudAuditoriaProcesoController.php:8`, `app/Http/Controllers/AudAuditoriaProcesoController.php:58`, `app/Http/Controllers/AudPrintController.php:24`, `app/Http/Controllers/AudProcesosController.php:6`.

Consumidores históricos (26): `app/AudPrint.php:17`, `app/Http/Controllers/AudActividadesController.php:6`, `app/Http/Controllers/AudAgendaEventoController.php:24`, `app/Http/Controllers/AudAgendaEventoController.php:318`, `app/Http/Controllers/AudAuditoriaProcesoController.php:8`, `app/Http/Controllers/AudAuditoriaProcesoController.php:58`, `app/Http/Controllers/AudPrintController.php:24`, `app/Http/Controllers/AudProcesosController.php:6`.

### `App\ri_proceso_unidad`

Archivo: `app/ri_proceso_unidad.php`. Tabla: `ri_proceso_unidad` (existe). Clave configurada: `id_proceso_unidad`; PRIMARY KEY físico: `id_proceso_unidad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 3.

- `proceso` → `App\ri_proceso`: ri_proceso_unidad.id_proceso [int(11)] ↔ ri_proceso.id_proceso [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `unidadParte` → `App\ri_unidad_parte`: ri_proceso_unidad.id_unidad_admin [int(11)] ↔ ri_unidad_parte.id_unidad_admin [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `procesoParte` → `App\ri_unidad_parte`: ri_proceso_unidad.id_proceso [int(11)] ↔ ri_unidad_parte.id_proceso [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_proceso_unidad.php`.

Consumidores actuales (5): `app/Http/Controllers/AudAgendaController.php:26`, `app/Http/Controllers/AudAgendaController.php:237`, `app/Http/Controllers/AudProcesosController.php:7`, `app/Http/Controllers/AudProcesosController.php:71`, `app/Http/Controllers/AudProcesosController.php:145`.

Consumidores históricos (5): `app/Http/Controllers/AudAgendaController.php:26`, `app/Http/Controllers/AudAgendaController.php:237`, `app/Http/Controllers/AudProcesosController.php:7`, `app/Http/Controllers/AudProcesosController.php:71`, `app/Http/Controllers/AudProcesosController.php:145`.

### `App\ri_reg_oportunidad`

Archivo: `app/ri_reg_oportunidad.php`. Tabla: `ri__reg_oportunidad` (existe). Clave configurada: `id_oportunidad`; PRIMARY KEY físico: `id_oportunidad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 10.

- `ri_o_probabilidad` → `App\ri_o_probabilidad`: ri__reg_oportunidad.id_probabilidad [int(11)] ↔ ri_o_probabilidad.id_probabilidad [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_ocurrencia` → `App\ri_o_ocurrenciasp`: ri__reg_oportunidad.id_ocurrenciap [int(11)] ↔ ri_o_ocurrenciasp.id_ocurrenciap [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_potencialapertura` → `App\ri_o_potencialapertura`: ri__reg_oportunidad.id_potencialapertura [int(11)] ↔ ri_o_potencialapertura.id_potencialapertura [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_potencialcrecimiento` → `App\ri_o_potencialcrecimiento`: ri__reg_oportunidad.id_potencialcrecimiento [int(11)] ↔ ri_o_potencialcrecimiento.id_potencialcrecimiento [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_mejoracliente` → `App\ri_o_mejoracliente`: ri__reg_oportunidad.id_mejoracliente [int(11)] ↔ ri_o_mejoracliente.id_mejoracliente [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_mejorasgc` → `App\ri_o_mejorasgc`: ri__reg_oportunidad.id_mejorasgc [int(11)] ↔ ri_o_mejorasgc.id_mejorasgc [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_mejorareputacion` → `App\ri_o_mejorareputacion`: ri__reg_oportunidad.id_mejorareputacion [int(11)] ↔ ri_o_mejorareputacion.id_mejorareputacion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_potencialcosto` → `App\ri_o_potencialcosto`: ri__reg_oportunidad.id_potencialcosto [int(11)] ↔ ri_o_potencialcosto.id_potencialcosto [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_o_planseguimiento` → `App\ri_o_planseguimiento`: ri__reg_oportunidad.id_oportunidad [int(11)] ↔ ri_o_planseguimiento.id_oportunidad [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `ri_requisitos` → `App\ri_requisitos`: ri__reg_oportunidad.id_requisito [int(11)] ↔ ri_requisitos.id_requisito [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_reg_oportunidad.php`.

Consumidores actuales (6): `app/Http/Controllers/RegRiesgoController.php:10`, `app/Http/Controllers/RiRegOportunidadController.php:16`, `app/Http/Controllers/RiRegOportunidadController.php:71`, `app/Http/Controllers/RiRegOportunidadController.php:92`, `app/Http/Controllers/RiRegOportunidadController.php:174`, `app/Http/Controllers/RiRegOportunidadController.php:187`.

Consumidores históricos (6): `app/Http/Controllers/RegRiesgoController.php:10`, `app/Http/Controllers/RiRegOportunidadController.php:16`, `app/Http/Controllers/RiRegOportunidadController.php:71`, `app/Http/Controllers/RiRegOportunidadController.php:92`, `app/Http/Controllers/RiRegOportunidadController.php:174`, `app/Http/Controllers/RiRegOportunidadController.php:187`.

### `App\ri_requisitos`

Archivo: `app/ri_requisitos.php`. Tabla: `ri_requisitos` (existe). Clave configurada: `id_requisito`; PRIMARY KEY físico: `id_requisito`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 3.

- `riesgos` → `App\ri_riesgo`: ri_requisitos.id_requisito [int(11)] ↔ ri_riesgo.id_requisito [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `oportunidades` → `App\ri_reg_oportunidad`: ri_requisitos.id_requisito [int(11)] ↔ ri__reg_oportunidad.id_requisito [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `partes` → `App\ri_unidad_parte`: ri_requisitos.id_uni_p [int(11)] ↔ ri_unidad_parte.id_uni_p [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_requisitos.php`.

Consumidores actuales (5): `app/Http/Controllers/RiRequisitoController.php:5`, `app/Http/Controllers/RiRequisitoController.php:50`, `app/Http/Controllers/RiRequisitoController.php:51`, `app/Http/Controllers/RiRequisitoController.php:103`, `app/Http/Controllers/RiRequisitoController.php:116`.

Consumidores históricos (5): `app/Http/Controllers/RiRequisitoController.php:5`, `app/Http/Controllers/RiRequisitoController.php:50`, `app/Http/Controllers/RiRequisitoController.php:51`, `app/Http/Controllers/RiRequisitoController.php:103`, `app/Http/Controllers/RiRequisitoController.php:116`.

### `App\ri_riesgo`

Archivo: `app/ri_riesgo.php`. Tabla: `ri_riesgo` (existe). Clave configurada: `id_riesgo`; PRIMARY KEY físico: `id_riesgo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `getRequisito` → `App\ri_requisitos`: ri_riesgo.id_requisito [int(11)] ↔ ri_requisitos.id_requisito [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `registro_riesgo` → `App\RegRiesgo`: ri_riesgo.id_riesgo [int(11)] ↔ ri_registro_riesgo.id_riesgo [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_riesgo.php`.

Consumidores actuales (10): `app/Http/Controllers/API/RiRiesgoController.php:8`, `app/Http/Controllers/API/RiRiesgoController.php:21`, `app/Http/Controllers/RiRequisitoController.php:6`, `app/Http/Controllers/RiRequisitoController.php:54`, `app/Http/Controllers/RiRequisitoController.php:117`, `app/Http/Controllers/RiRiesgoController.php:7`, `app/Http/Controllers/RiRiesgoController.php:58`, `app/Http/Controllers/RiRiesgoController.php:83`.

Consumidores históricos (10): `app/Http/Controllers/API/RiRiesgoController.php:8`, `app/Http/Controllers/API/RiRiesgoController.php:21`, `app/Http/Controllers/RiRequisitoController.php:6`, `app/Http/Controllers/RiRequisitoController.php:54`, `app/Http/Controllers/RiRequisitoController.php:117`, `app/Http/Controllers/RiRiesgoController.php:7`, `app/Http/Controllers/RiRiesgoController.php:58`, `app/Http/Controllers/RiRiesgoController.php:83`.

### `App\ri_sistema`

Archivo: `app/ri_sistema.php`. Tabla: `ri_sistema` (existe). Clave configurada: `id_sistema`; PRIMARY KEY físico: `id_sistema`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_sistema.php`.

Consumidores actuales (10): `app/Http/Controllers/AudActividadesController.php:7`, `app/Http/Controllers/AudProcesosController.php:8`, `app/Http/Controllers/AudProcesosController.php:23`, `app/Http/Controllers/RiProcesoController.php:6`, `app/Http/Controllers/RiProcesoController.php:28`, `app/Http/Controllers/RiSistemaController.php:7`, `app/Http/Controllers/RiSistemaController.php:54`, `app/Http/Controllers/RiSistemaController.php:80`.

Consumidores históricos (10): `app/Http/Controllers/AudActividadesController.php:7`, `app/Http/Controllers/AudProcesosController.php:8`, `app/Http/Controllers/AudProcesosController.php:23`, `app/Http/Controllers/RiProcesoController.php:6`, `app/Http/Controllers/RiProcesoController.php:28`, `app/Http/Controllers/RiSistemaController.php:7`, `app/Http/Controllers/RiSistemaController.php:54`, `app/Http/Controllers/RiSistemaController.php:80`.

### `App\ri_tipo_eva`

Archivo: `app/ri_tipo_eva.php`. Tabla: `ri_tipo_eva` (existe). Clave configurada: `id_tipo_eva`; PRIMARY KEY físico: `id_tipo_eva`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_tipo_eva.php`.

Consumidores actuales (8): `app/Http/Controllers/RegRiesgoController.php:11`, `app/Http/Controllers/RegRiesgoController.php:52`, `app/Http/Controllers/RiTipoEvaController.php:5`, `app/Http/Controllers/RiTipoEvaController.php:59`, `app/Http/Controllers/RiTipoEvaController.php:83`, `app/Http/Controllers/RiTipoEvaController.php:109`, `app/Http/Controllers/RiTipoEvaController.php:123`, `app/Http/Controllers/RiTipoFController.php:5`.

Consumidores históricos (8): `app/Http/Controllers/RegRiesgoController.php:11`, `app/Http/Controllers/RegRiesgoController.php:52`, `app/Http/Controllers/RiTipoEvaController.php:5`, `app/Http/Controllers/RiTipoEvaController.php:59`, `app/Http/Controllers/RiTipoEvaController.php:83`, `app/Http/Controllers/RiTipoEvaController.php:109`, `app/Http/Controllers/RiTipoEvaController.php:123`, `app/Http/Controllers/RiTipoFController.php:5`.

### `App\ri_unidad_parte`

Archivo: `app/ri_unidad_parte.php`. Tabla: `ri_unidad_parte` (existe). Clave configurada: `id_uni_p`; PRIMARY KEY físico: `id_uni_p`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 3.

- `requisitos` → `App\ri_requisitos`: ri_unidad_parte.id_uni_p [int(11)] ↔ ri_requisitos.id_uni_p [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `parte` → `App\ri_partes`: ri_unidad_parte.id_parte [int(11)] ↔ ri_partes.id_parte [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `proceso` → `App\ri_proceso`: ri_unidad_parte.id_proceso [int(11)] ↔ ri_proceso.id_proceso [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_unidad_parte.php`.

Consumidores actuales (6): `app/Http/Controllers/RiAddPartesController.php:7`, `app/Http/Controllers/RiAddPartesController.php:35`, `app/Http/Controllers/RiAddPartesController.php:36`, `app/Http/Controllers/RiAddPartesController.php:79`, `app/Http/Controllers/RiAddPartesController.php:127`, `app/ri_proceso_unidad.php:21`.

Consumidores históricos (6): `app/Http/Controllers/RiAddPartesController.php:7`, `app/Http/Controllers/RiAddPartesController.php:35`, `app/Http/Controllers/RiAddPartesController.php:36`, `app/Http/Controllers/RiAddPartesController.php:79`, `app/Http/Controllers/RiAddPartesController.php:127`, `app/ri_proceso_unidad.php:21`.

### `App\ri_valoracion_efecto`

Archivo: `app/ri_valoracion_efecto.php`. Tabla: `ri_valoracion_efectos` (existe). Clave configurada: `id_val_efecto`; PRIMARY KEY físico: `id_val_efecto`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `updated_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ri_valoracion_efecto.php`.

Consumidores actuales (5): `app/Http/Controllers/Process/GetRegistroRiesgo.php:11`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:39`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:40`, `app/Http/Controllers/RiValoracionEfectoController.php:6`, `app/Http/Controllers/RiValoracionEfectoController.php:91`.

Consumidores históricos (5): `app/Http/Controllers/Process/GetRegistroRiesgo.php:11`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:39`, `app/Http/Controllers/Process/GetRegistroRiesgo.php:40`, `app/Http/Controllers/RiValoracionEfectoController.php:6`, `app/Http/Controllers/RiValoracionEfectoController.php:91`.

### `App\RmBienes`

Archivo: `app/RmBienes.php`. Tabla: `rm_bienes` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** Relación usa ahora id_tipoadqui, presente en MariaDB y en RmBienesController original y actual; se conserva cardinalidad. El fillable heredado de RmBienes aún contiene nombres antiguos: auditar asignación masiva aparte.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 9.

- `categorias` → `App\RmCategoria`: rm_bienes.id_categoria [bigint(20) unsigned] ↔ rm_categorias.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `provedores` → `App\RmProvedores`: rm_bienes.id_provedor [bigint(20) unsigned] ↔ rm_provedores.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `modelos` → `App\RmModelos`: rm_bienes.id_modelo [bigint(20) unsigned] ↔ rm_modelos.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `usos` → `App\RmEstadouso`: rm_bienes.id_estado [bigint(20) unsigned] ↔ rm_estadousos.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `marcas` → `App\RmMarcas`: rm_bienes.id_marca [bigint(20) unsigned] ↔ rm_marcas.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `bienest` → `App\RmTipobienes`: rm_bienes.id_tipob [bigint(20) unsigned] ↔ rm_tipobienes.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `colores` → `App\RmColores`: rm_bienes.id_color [bigint(20) unsigned] ↔ rm_colores.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `adquisiciones` → `App\RmTipoadqui`: rm_bienes.id_tipoadqui [bigint(20) unsigned] ↔ rm_tipoadqui.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `resguardos` → `App\RmResguardos`: rm_bienes.id [bigint(20) unsigned] ↔ rm_resguardos.id_bienres [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmBienes.php`.

Consumidores actuales (20): `app/Exports/Inv_reporteExport.php:4`, `app/Http/Controllers/RmBienesController.php:10`, `app/Http/Controllers/RmBienesController.php:38`, `app/Http/Controllers/RmBienesController.php:64`, `app/Http/Controllers/RmBienesController.php:113`, `app/Http/Controllers/RmBienesController.php:162`, `app/Http/Controllers/RmBienesController.php:185`, `app/Http/Controllers/RmBienesController.php:205`.

Consumidores históricos (20): `app/Exports/Inv_reporteExport.php:4`, `app/Http/Controllers/RmBienesController.php:10`, `app/Http/Controllers/RmBienesController.php:38`, `app/Http/Controllers/RmBienesController.php:64`, `app/Http/Controllers/RmBienesController.php:113`, `app/Http/Controllers/RmBienesController.php:162`, `app/Http/Controllers/RmBienesController.php:185`, `app/Http/Controllers/RmBienesController.php:205`.

### `App\RmCategoria`

Archivo: `app/RmCategoria.php`. Tabla: `rm_categorias` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_categorias.id [bigint(20) unsigned] ↔ rm_bienes.id_categoria [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmCategoria.php`.

Consumidores actuales (11): `app/Http/Controllers/RmBienesController.php:11`, `app/Http/Controllers/RmBienesController.php:40`, `app/Http/Controllers/RmBienesController.php:65`, `app/Http/Controllers/RmCategoriaController.php:5`, `app/Http/Controllers/RmCategoriaController.php:29`, `app/Http/Controllers/RmCategoriaController.php:51`, `app/Http/Controllers/RmCategoriaController.php:97`, `app/Http/Controllers/RmCategoriaController.php:114`.

Consumidores históricos (11): `app/Http/Controllers/RmBienesController.php:11`, `app/Http/Controllers/RmBienesController.php:40`, `app/Http/Controllers/RmBienesController.php:65`, `app/Http/Controllers/RmCategoriaController.php:5`, `app/Http/Controllers/RmCategoriaController.php:29`, `app/Http/Controllers/RmCategoriaController.php:51`, `app/Http/Controllers/RmCategoriaController.php:97`, `app/Http/Controllers/RmCategoriaController.php:114`.

### `App\RmColores`

Archivo: `app/RmColores.php`. Tabla: `rm_colores` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_colores.id [bigint(20) unsigned] ↔ rm_bienes.id_color [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmColores.php`.

Consumidores actuales (4): `app/Http/Controllers/RmBienesController.php:15`, `app/Http/Controllers/RmBienesController.php:50`, `app/Http/Controllers/RmBienesController.php:75`, `app/RmBienes.php:10`.

Consumidores históricos (4): `app/Http/Controllers/RmBienesController.php:15`, `app/Http/Controllers/RmBienesController.php:50`, `app/Http/Controllers/RmBienesController.php:75`, `app/RmBienes.php:10`.

### `App\RmEstadouso`

Archivo: `app/RmEstadouso.php`. Tabla: `rm_estadousos` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_estadousos.id [bigint(20) unsigned] ↔ rm_bienes.id_estado [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmEstadouso.php`.

Consumidores actuales (4): `app/Http/Controllers/RmBienesController.php:12`, `app/Http/Controllers/RmBienesController.php:48`, `app/Http/Controllers/RmBienesController.php:73`, `app/RmBienes.php:12`.

Consumidores históricos (4): `app/Http/Controllers/RmBienesController.php:12`, `app/Http/Controllers/RmBienesController.php:48`, `app/Http/Controllers/RmBienesController.php:73`, `app/RmBienes.php:12`.

### `App\RmMarcas`

Archivo: `app/RmMarcas.php`. Tabla: `rm_marcas` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_marcas.id [bigint(20) unsigned] ↔ rm_bienes.id_marca [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmMarcas.php`.

Consumidores actuales (12): `app/Http/Controllers/RmBienesController.php:13`, `app/Http/Controllers/RmBienesController.php:46`, `app/Http/Controllers/RmBienesController.php:71`, `app/Http/Controllers/RmMarcasController.php:5`, `app/Http/Controllers/RmMarcasController.php:22`, `app/Http/Controllers/RmMarcasController.php:33`, `app/Http/Controllers/RmMarcasController.php:53`, `app/Http/Controllers/RmMarcasController.php:81`.

Consumidores históricos (12): `app/Http/Controllers/RmBienesController.php:13`, `app/Http/Controllers/RmBienesController.php:46`, `app/Http/Controllers/RmBienesController.php:71`, `app/Http/Controllers/RmMarcasController.php:5`, `app/Http/Controllers/RmMarcasController.php:22`, `app/Http/Controllers/RmMarcasController.php:33`, `app/Http/Controllers/RmMarcasController.php:53`, `app/Http/Controllers/RmMarcasController.php:81`.

### `App\RmModelos`

Archivo: `app/RmModelos.php`. Tabla: `rm_modelos` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_modelos.id [bigint(20) unsigned] ↔ rm_bienes.id_modelo [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmModelos.php`.

Consumidores actuales (11): `app/Http/Controllers/RmBienesController.php:14`, `app/Http/Controllers/RmBienesController.php:44`, `app/Http/Controllers/RmBienesController.php:69`, `app/Http/Controllers/RmModelosController.php:5`, `app/Http/Controllers/RmModelosController.php:19`, `app/Http/Controllers/RmModelosController.php:32`, `app/Http/Controllers/RmModelosController.php:54`, `app/Http/Controllers/RmModelosController.php:95`.

Consumidores históricos (11): `app/Http/Controllers/RmBienesController.php:14`, `app/Http/Controllers/RmBienesController.php:44`, `app/Http/Controllers/RmBienesController.php:69`, `app/Http/Controllers/RmModelosController.php:5`, `app/Http/Controllers/RmModelosController.php:19`, `app/Http/Controllers/RmModelosController.php:32`, `app/Http/Controllers/RmModelosController.php:54`, `app/Http/Controllers/RmModelosController.php:95`.

### `App\RmProvedores`

Archivo: `app/RmProvedores.php`. Tabla: `rm_provedores` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_provedores.id [bigint(20) unsigned] ↔ rm_bienes.id_provedor [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmProvedores.php`.

Consumidores actuales (11): `app/Http/Controllers/RmBienesController.php:16`, `app/Http/Controllers/RmBienesController.php:42`, `app/Http/Controllers/RmBienesController.php:67`, `app/Http/Controllers/RmProvedoresController.php:5`, `app/Http/Controllers/RmProvedoresController.php:21`, `app/Http/Controllers/RmProvedoresController.php:34`, `app/Http/Controllers/RmProvedoresController.php:58`, `app/Http/Controllers/RmProvedoresController.php:102`.

Consumidores históricos (11): `app/Http/Controllers/RmBienesController.php:16`, `app/Http/Controllers/RmBienesController.php:42`, `app/Http/Controllers/RmBienesController.php:67`, `app/Http/Controllers/RmProvedoresController.php:5`, `app/Http/Controllers/RmProvedoresController.php:21`, `app/Http/Controllers/RmProvedoresController.php:34`, `app/Http/Controllers/RmProvedoresController.php:58`, `app/Http/Controllers/RmProvedoresController.php:102`.

### `App\RmResguardos`

Archivo: `app/RmResguardos.php`. Tabla: `rm_resguardos` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 5.

- `bienes` → `App\RmBienes`: rm_resguardos.id_bienres [bigint(20) unsigned] ↔ rm_bienes.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `sectores` → `App\RmSectorauxs`: rm_resguardos.id_sector [bigint(20) unsigned] ↔ rm_sectorauxs.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `sectorr` → `App\RmSectorauxs`: rm_resguardos.id_sector [bigint(20) unsigned] ↔ rm_sectorauxs.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `sectors` → `App\RmSectorauxs`: rm_resguardos.id_sector [bigint(20) unsigned] ↔ rm_sectorauxs.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `bien` → `App\RmBienes`: rm_resguardos.id_bienres [bigint(20) unsigned] ↔ rm_bienes.id [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmResguardos.php`.

Consumidores actuales (10): `app/Http/Controllers/RmResguardosController.php:8`, `app/Http/Controllers/RmResguardosController.php:25`, `app/Http/Controllers/RmResguardosController.php:41`, `app/Http/Controllers/RmResguardosController.php:68`, `app/Http/Controllers/RmResguardosController.php:95`, `app/Http/Controllers/RmResguardosController.php:103`, `app/Http/Controllers/RmResguardosController.php:141`, `app/Http/Controllers/RmResguardosController.php:157`.

Consumidores históricos (10): `app/Http/Controllers/RmResguardosController.php:8`, `app/Http/Controllers/RmResguardosController.php:25`, `app/Http/Controllers/RmResguardosController.php:41`, `app/Http/Controllers/RmResguardosController.php:68`, `app/Http/Controllers/RmResguardosController.php:95`, `app/Http/Controllers/RmResguardosController.php:103`, `app/Http/Controllers/RmResguardosController.php:141`, `app/Http/Controllers/RmResguardosController.php:157`.

### `App\RmSectorauxs`

Archivo: `app/RmSectorauxs.php`. Tabla: `rm_sectorauxs` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `departamentos` → `App\gnral_unidad_administrativa`: rm_sectorauxs.id_area [bigint(10)] ↔ gnral_unidad_administrativa.id_unidad_admin [bigint(10)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 1.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmSectorauxs.php`.

Consumidores actuales (15): `app/Http/Controllers/RmResguardosController.php:9`, `app/Http/Controllers/RmResguardosController.php:29`, `app/Http/Controllers/RmResguardosController.php:45`, `app/Http/Controllers/RmResguardosController.php:83`, `app/Http/Controllers/RmResguardosController.php:96`, `app/Http/Controllers/RmResguardosController.php:106`, `app/Http/Controllers/RmResguardosController.php:161`, `app/Http/Controllers/RmResguardosController.php:168`.

Consumidores históricos (15): `app/Http/Controllers/RmResguardosController.php:9`, `app/Http/Controllers/RmResguardosController.php:29`, `app/Http/Controllers/RmResguardosController.php:45`, `app/Http/Controllers/RmResguardosController.php:83`, `app/Http/Controllers/RmResguardosController.php:96`, `app/Http/Controllers/RmResguardosController.php:106`, `app/Http/Controllers/RmResguardosController.php:161`, `app/Http/Controllers/RmResguardosController.php:168`.

### `App\RmTipoadqui`

Archivo: `app/RmTipoadqui.php`. Tabla: `rm_tipoadqui` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** Relación usa ahora id_tipoadqui, presente en MariaDB y en RmBienesController original y actual; se conserva cardinalidad. El fillable heredado de RmBienes aún contiene nombres antiguos: auditar asignación masiva aparte.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_tipoadqui.id [bigint(20) unsigned] ↔ rm_bienes.id_tipoadqui [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmTipoadqui.php`.

Consumidores actuales (4): `app/Http/Controllers/RmBienesController.php:17`, `app/Http/Controllers/RmBienesController.php:51`, `app/Http/Controllers/RmBienesController.php:76`, `app/RmBienes.php:15`.

Consumidores históricos (4): `app/Http/Controllers/RmBienesController.php:17`, `app/Http/Controllers/RmBienesController.php:51`, `app/Http/Controllers/RmBienesController.php:76`, `app/RmBienes.php:15`.

### `App\RmTipobienes`

Archivo: `app/RmTipobienes.php`. Tabla: `rm_tipobienes` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `bigint(20) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bienes` → `App\RmBienes`: rm_tipobienes.id [bigint(20) unsigned] ↔ rm_bienes.id_tipob [bigint(20) unsigned]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/RmTipobienes.php`.

Consumidores actuales (4): `app/Http/Controllers/RmBienesController.php:18`, `app/Http/Controllers/RmBienesController.php:49`, `app/Http/Controllers/RmBienesController.php:74`, `app/RmBienes.php:16`.

Consumidores históricos (4): `app/Http/Controllers/RmBienesController.php:18`, `app/Http/Controllers/RmBienesController.php:49`, `app/Http/Controllers/RmBienesController.php:74`, `app/RmBienes.php:16`.

### `App\Semestres`

Archivo: `app/Semestres.php`. Tabla: `gnral_semestres` (existe). Clave configurada: `id_semestre`; PRIMARY KEY físico: `id_semestre`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Semestres.php`.

Consumidores actuales (13): `app/Http/Controllers/datos_alumno.php:11`, `app/Http/Controllers/datos_alumno.php:203`, `app/Http/Controllers/datos_alumno.php:223`, `app/Http/Controllers/datos_alumno.php:261`, `app/Http/Controllers/ReticulaController.php:11`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:11`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:26`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:93`.

Consumidores históricos (13): `app/Http/Controllers/datos_alumno.php:11`, `app/Http/Controllers/datos_alumno.php:203`, `app/Http/Controllers/datos_alumno.php:223`, `app/Http/Controllers/datos_alumno.php:261`, `app/Http/Controllers/ReticulaController.php:11`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:11`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:26`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:93`.

### `App\serv_datos_alumnos`

Archivo: `app/serv_datos_alumnos.php`. Tabla: `serv_datos_alumnos` (existe). Clave configurada: `id_datos_alumnos`; PRIMARY KEY físico: `id_datos_alumnos`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/serv_datos_alumnos.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\serv_doc_empresa_privada`

Archivo: `app/serv_doc_empresa_privada.php`. Tabla: `serv_doc_empresa_privada` (existe). Clave configurada: `id_empresa_privada`; PRIMARY KEY físico: `id_empresa_privada`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/serv_doc_empresa_privada.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\serv_doc_empresa_publica`

Archivo: `app/serv_doc_empresa_publica.php`. Tabla: `serv_doc_empresa_publica` (existe). Clave configurada: `id_empresa_publica`; PRIMARY KEY físico: `id_empresa_publica`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/serv_doc_empresa_publica.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\serv_estado_documentacion`

Archivo: `app/serv_estado_documentacion.php`. Tabla: `serv_estado_documentacion` (existe). Clave configurada: `id_estado_documentacion`; PRIMARY KEY físico: `id_estado_documentacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/serv_estado_documentacion.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\serv_tipo_empresa`

Archivo: `app/serv_tipo_empresa.php`. Tabla: `serv_tipo_empresa` (existe). Clave configurada: `id_tipo_empresa`; PRIMARY KEY físico: `id_tipo_empresa`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/serv_tipo_empresa.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\SgcAgenda`

Archivo: `app/SgcAgenda.php`. Tabla: `aud_agenda` (existe). Clave configurada: `id_agenda`; PRIMARY KEY físico: `id_agenda`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **error confirmado — pendiente:** Relación getAsign referencia aud_agenda.id_asigna_audi, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getNombre referencia aud_agenda.id_auditor, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getAbrPer referencia aud_agenda.id_auditor, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación area referencia aud_agenda.id_area, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 4.

- `getAsign` → `App\SgcAsignaAudi`: aud_agenda.id_asigna_audi [AUSENTE] ↔ aud_asigna_audi.id_asigna_audi [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getNombre` → `App\GnralPersonales`: aud_agenda.id_auditor [AUSENTE] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbrPer` → `App\Abreviaciones_prof`: aud_agenda.id_auditor [AUSENTE] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `area` → `App\gnral_unidad_administrativa`: aud_agenda.id_area [AUSENTE] ↔ gnral_unidad_administrativa.id_unidad_admin [bigint(10)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcAgenda.php`.

Consumidores actuales (9): `app/Http/Controllers/AudAgendaController.php:27`, `app/Http/Controllers/SgcAgendaController.php:6`, `app/Http/Controllers/SgcAgendaController.php:62`, `app/Http/Controllers/SgcAgendaController.php:78`, `app/Http/Controllers/SgcPdfHojaController.php:5`, `app/Http/Controllers/SgcPdfHojaController.php:102`, `app/Http/Controllers/SgcReportesController.php:5`, `app/Http/Controllers/SgcReportesController.php:63`.

Consumidores históricos (9): `app/Http/Controllers/AudAgendaController.php:27`, `app/Http/Controllers/SgcAgendaController.php:6`, `app/Http/Controllers/SgcAgendaController.php:62`, `app/Http/Controllers/SgcAgendaController.php:78`, `app/Http/Controllers/SgcPdfHojaController.php:5`, `app/Http/Controllers/SgcPdfHojaController.php:102`, `app/Http/Controllers/SgcReportesController.php:5`, `app/Http/Controllers/SgcReportesController.php:63`.

### `App\SgcAsignaAudi`

Archivo: `app/SgcAsignaAudi.php`. Tabla: `aud_asigna_audi` (existe). Clave configurada: `id_asigna_audi`; PRIMARY KEY físico: `id_asigna_audi`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **error confirmado — pendiente:** Relación getAgenda referencia aud_agenda.id_asigna_audi, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 5.

- `getNombre` → `App\GnralPersonales`: aud_asigna_audi.id_auditor [int(11)] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbrPer` → `App\Abreviaciones_prof`: aud_asigna_audi.id_auditor [int(11)] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAgenda` → `App\SgcAgenda`: aud_asigna_audi.id_asigna_audi [int(11)] ↔ aud_agenda.id_asigna_audi [AUSENTE]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAsign` → `App\SgcAsignaAudi`: aud_asigna_audi.id_asigna_audi [int(11)] ↔ aud_asigna_audi.id_asigna_audi [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAuditoria` → `App\SgcAuditorias`: aud_asigna_audi.id_auditoria [int(11)] ↔ aud_auditoria.id_auditoria [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcAsignaAudi.php`.

Consumidores actuales (24): `app/Http/Controllers/AudAgendaController.php:28`, `app/Http/Controllers/SgcAgendaController.php:7`, `app/Http/Controllers/SgcAgendaController.php:82`, `app/Http/Controllers/SgcAgendaController.php:94`, `app/Http/Controllers/SgcAsignaAudiController.php:5`, `app/Http/Controllers/SgcAsignaAudiController.php:51`, `app/Http/Controllers/SgcAsignaAudiController.php:58`, `app/Http/Controllers/SgcAsignaAudiController.php:66`.

Consumidores históricos (24): `app/Http/Controllers/AudAgendaController.php:28`, `app/Http/Controllers/SgcAgendaController.php:7`, `app/Http/Controllers/SgcAgendaController.php:82`, `app/Http/Controllers/SgcAgendaController.php:94`, `app/Http/Controllers/SgcAsignaAudiController.php:5`, `app/Http/Controllers/SgcAsignaAudiController.php:51`, `app/Http/Controllers/SgcAsignaAudiController.php:58`, `app/Http/Controllers/SgcAsignaAudiController.php:66`.

### `App\SgcAsignaEntrena`

Archivo: `app/SgcAsignaEntrena.php`. Tabla: `aud_asigna_audi` (existe). Clave configurada: `id_asigna_audi`; PRIMARY KEY físico: `id_asigna_audi`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcAsignaEntrena.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\SgcAsignaEquipo`

Archivo: `app/SgcAsignaEquipo.php`. Tabla: `aud_asigna_audi` (existe). Clave configurada: `id_asigna_audi`; PRIMARY KEY físico: `id_asigna_audi`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcAsignaEquipo.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\SgcAsignaLider`

Archivo: `app/SgcAsignaLider.php`. Tabla: `aud_asigna_audi` (existe). Clave configurada: `id_asigna_audi`; PRIMARY KEY físico: `id_asigna_audi`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcAsignaLider.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\SgcAuditorias`

Archivo: `app/SgcAuditorias.php`. Tabla: `aud_auditoria` (existe). Clave configurada: `id_auditoria`; PRIMARY KEY físico: `id_auditoria`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | YES | `"NULL"` |  |
| `updated_at` | `date` | YES | `"NULL"` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcAuditorias.php`.

Consumidores actuales (16): `app/Http/Controllers/AudAgendaController.php:29`, `app/Http/Controllers/SgcAgendaController.php:8`, `app/Http/Controllers/SgcAgendaController.php:77`, `app/Http/Controllers/SgcAuditoriasController.php:7`, `app/Http/Controllers/SgcAuditoriasController.php:22`, `app/Http/Controllers/SgcAuditoriasController.php:61`, `app/Http/Controllers/SgcAuditoriasController.php:74`, `app/Http/Controllers/SgcAuditoriasController.php:127`.

Consumidores históricos (16): `app/Http/Controllers/AudAgendaController.php:29`, `app/Http/Controllers/SgcAgendaController.php:8`, `app/Http/Controllers/SgcAgendaController.php:77`, `app/Http/Controllers/SgcAuditoriasController.php:7`, `app/Http/Controllers/SgcAuditoriasController.php:22`, `app/Http/Controllers/SgcAuditoriasController.php:61`, `app/Http/Controllers/SgcAuditoriasController.php:74`, `app/Http/Controllers/SgcAuditoriasController.php:127`.

### `App\SgcClasificacion`

Archivo: `app/SgcClasificacion.php`. Tabla: `aud_clasificacion` (existe). Clave configurada: `id_clasificacion`; PRIMARY KEY físico: `id_clasificacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcClasificacion.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\SgcDetallePlan`

Archivo: `app/SgcDetallePlan.php`. Tabla: `sgc_detalle_plans` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva sgc_detalle_plans no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcDetallePlan.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\SgcNormatividad`

Archivo: `app/SgcNormatividad.php`. Tabla: `aud_normatividad` (existe). Clave configurada: `id_normatividad`; PRIMARY KEY físico: `id_normatividad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | YES | `"NULL"` |  |
| `updated_at` | `date` | YES | `"NULL"` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcNormatividad.php`.

Consumidores actuales (7): `app/Http/Controllers/SgcDetallePlanController.php:8`, `app/Http/Controllers/SgcDetallePlanController.php:64`, `app/Http/Controllers/SgcNormatividadController.php:6`, `app/Http/Controllers/SgcNormatividadController.php:18`, `app/Http/Controllers/SgcNormatividadController.php:47`, `app/Http/Controllers/SgcNormatividadController.php:89`, `app/Http/Controllers/SgcNormatividadController.php:102`.

Consumidores históricos (7): `app/Http/Controllers/SgcDetallePlanController.php:8`, `app/Http/Controllers/SgcDetallePlanController.php:64`, `app/Http/Controllers/SgcNormatividadController.php:6`, `app/Http/Controllers/SgcNormatividadController.php:18`, `app/Http/Controllers/SgcNormatividadController.php:47`, `app/Http/Controllers/SgcNormatividadController.php:89`, `app/Http/Controllers/SgcNormatividadController.php:102`.

### `App\SgcNormAuditoria`

Archivo: `app/SgcNormAuditoria.php`. Tabla: `aud_normatividad_auditoria` (existe). Clave configurada: `id_normatividad_auditoria`; PRIMARY KEY físico: `id_normatividad_auditoria`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getCriterio` → `App\SgcNormatividad`: aud_normatividad_auditoria.id_normatividad [int(11)] ↔ aud_normatividad.id_normatividad [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcNormAuditoria.php`.

Consumidores actuales (6): `app/Http/Controllers/SgcDetallePlanController.php:9`, `app/Http/Controllers/SgcDetallePlanController.php:65`, `app/Http/Controllers/SgcDetallePlanController.php:66`, `app/Http/Controllers/SgcNormAuditoriaController.php:5`, `app/Http/Controllers/SgcNormAuditoriaController.php:47`, `app/Http/Controllers/SgcNormAuditoriaController.php:95`.

Consumidores históricos (6): `app/Http/Controllers/SgcDetallePlanController.php:9`, `app/Http/Controllers/SgcDetallePlanController.php:65`, `app/Http/Controllers/SgcDetallePlanController.php:66`, `app/Http/Controllers/SgcNormAuditoriaController.php:5`, `app/Http/Controllers/SgcNormAuditoriaController.php:47`, `app/Http/Controllers/SgcNormAuditoriaController.php:95`.

### `App\SgcNotas`

Archivo: `app/SgcNotas.php`. Tabla: `aud_notas` (existe). Clave configurada: `id_notas`; PRIMARY KEY físico: `id_notas`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getClasificacion` → `App\SgcClasificacion`: aud_notas.id_clasificacion [int(11)] ↔ aud_clasificacion.id_clasificacion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcNotas.php`.

Consumidores actuales (6): `app/Http/Controllers/SgcNotasController.php:5`, `app/Http/Controllers/SgcNotasController.php:59`, `app/Http/Controllers/SgcPdfHojaController.php:6`, `app/Http/Controllers/SgcPdfHojaController.php:111`, `app/Http/Controllers/SgcReportesController.php:6`, `app/Http/Controllers/SgcReportesController.php:73`.

Consumidores históricos (6): `app/Http/Controllers/SgcNotasController.php:5`, `app/Http/Controllers/SgcNotasController.php:59`, `app/Http/Controllers/SgcPdfHojaController.php:6`, `app/Http/Controllers/SgcPdfHojaController.php:111`, `app/Http/Controllers/SgcReportesController.php:6`, `app/Http/Controllers/SgcReportesController.php:73`.

### `App\SgcObjetivos`

Archivo: `app/SgcObjetivos.php`. Tabla: `aud_objetivo` (existe). Clave configurada: `id_objetivo`; PRIMARY KEY físico: `id_objetivo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcObjetivos.php`.

Consumidores actuales (2): `app/Http/Controllers/SgcProgramaController.php:7`, `app/Http/Controllers/SgcProgramaController.php:82`.

Consumidores históricos (2): `app/Http/Controllers/SgcProgramaController.php:7`, `app/Http/Controllers/SgcProgramaController.php:82`.

### `App\SgcPersonasAuditoria`

Archivo: `app/SgcPersonasAuditoria.php`. Tabla: `aud_personas_auditoria` (ausente). Clave configurada: `id_personas_auditoria`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva aud_personas_auditoria no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **error confirmado — pendiente:** Relación getName referencia aud_personas_auditoria.id_personal, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **error confirmado — pendiente:** Relación getAbr referencia aud_personas_auditoria.id_personal, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `getName` → `App\GnralPersonales`: aud_personas_auditoria.id_personal [AUSENTE] ↔ gnral_personales.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `getAbr` → `App\Abreviaciones_prof`: aud_personas_auditoria.id_personal [AUSENTE] ↔ abreviaciones_prof.id_personal [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcPersonasAuditoria.php`.

Consumidores actuales (8): `app/Http/Controllers/AudAuditorAuditoriaController.php:10`, `app/Http/Controllers/AudAuditoresController.php:9`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:7`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:22`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:23`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:24`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:59`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:111`.

Consumidores históricos (8): `app/Http/Controllers/AudAuditorAuditoriaController.php:10`, `app/Http/Controllers/AudAuditoresController.php:9`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:7`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:22`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:23`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:24`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:59`, `app/Http/Controllers/SgcPersonasAuditoriaController.php:111`.

### `App\SgcProcesoAgenda`

Archivo: `app/SgcProcesoAgenda.php`. Tabla: `aud_procesos_agenda` (ausente). Clave configurada: `id_aud_procesos_agenda`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva aud_procesos_agenda no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcProcesoAgenda.php`.

Consumidores actuales (3): `app/Http/Controllers/SgcProcesoAgendaController.php:5`, `app/Http/Controllers/SgcProcesoAgendaController.php:30`, `app/Http/Controllers/SgcProcesoAgendaController.php:39`.

Consumidores históricos (3): `app/Http/Controllers/SgcProcesoAgendaController.php:5`, `app/Http/Controllers/SgcProcesoAgendaController.php:30`, `app/Http/Controllers/SgcProcesoAgendaController.php:39`.

### `App\SgcPrograma`

Archivo: `app/SgcPrograma.php`. Tabla: `aud_programa` (existe). Clave configurada: `id_programa`; PRIMARY KEY físico: `id_programa`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcPrograma.php`.

Consumidores actuales (8): `app/Http/Controllers/SgcProgramaController.php:8`, `app/Http/Controllers/SgcProgramaController.php:24`, `app/Http/Controllers/SgcProgramaController.php:67`, `app/Http/Controllers/SgcProgramaController.php:81`, `app/Http/Controllers/SgcProgramaController.php:96`, `app/Http/Controllers/SgcProgramaController.php:125`, `app/Http/Controllers/SgcReporteAuditoriaController.php:6`, `app/Http/Controllers/SgcReporteAuditoriaController.php:144`.

Consumidores históricos (8): `app/Http/Controllers/SgcProgramaController.php:8`, `app/Http/Controllers/SgcProgramaController.php:24`, `app/Http/Controllers/SgcProgramaController.php:67`, `app/Http/Controllers/SgcProgramaController.php:81`, `app/Http/Controllers/SgcProgramaController.php:96`, `app/Http/Controllers/SgcProgramaController.php:125`, `app/Http/Controllers/SgcReporteAuditoriaController.php:6`, `app/Http/Controllers/SgcReporteAuditoriaController.php:144`.

### `App\SgcReporteAuditoria`

Archivo: `app/SgcReporteAuditoria.php`. Tabla: `aud_informe` (existe). Clave configurada: `id_informe`; PRIMARY KEY físico: `id_informe`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcReporteAuditoria.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\SgcReportes`

Archivo: `app/SgcReportes.php`. Tabla: `aud_reportes` (existe). Clave configurada: `id_reporte`; PRIMARY KEY físico: `id_reporte`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `date` | NO | `null` |  |
| `updated_at` | `date` | NO | `null` |  |
| `deleted_at` | `date` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** created_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** updated_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** deleted_at tiene precisión DATE, sin hora. No se infiere obligación de convertirlo a timestamp.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getAgenda` → `App\SgcAgenda`: aud_reportes.id_agenda [int(11)] ↔ aud_agenda.id_agenda [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcReportes.php`.

Consumidores actuales (5): `app/Http/Controllers/SgcPdfHojaController.php:7`, `app/Http/Controllers/SgcPdfHojaController.php:103`, `app/Http/Controllers/SgcReportesController.php:7`, `app/Http/Controllers/SgcReportesController.php:50`, `app/Http/Controllers/SgcReportesController.php:65`.

Consumidores históricos (5): `app/Http/Controllers/SgcPdfHojaController.php:7`, `app/Http/Controllers/SgcPdfHojaController.php:103`, `app/Http/Controllers/SgcReportesController.php:7`, `app/Http/Controllers/SgcReportesController.php:50`, `app/Http/Controllers/SgcReportesController.php:65`.

### `App\SgcValidaciones`

Archivo: `app/SgcValidaciones.php`. Tabla: `sgc_validaciones` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva sgc_validaciones no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/SgcValidaciones.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Tutor`

Archivo: `app/Tutor.php`. Tabla: `eva_tutor` (existe). Clave configurada: `id_tutor`; PRIMARY KEY físico: `id_tutor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutor.php`.

Consumidores actuales (5): `app/Http/Controllers/datos_alumno.php:12`, `app/Http/Controllers/datos_alumno.php:57`, `app/Http/Controllers/datos_alumno.php:97`, `app/Http/Controllers/datos_alumno.php:516`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:25`.

Consumidores históricos (5): `app/Http/Controllers/datos_alumno.php:12`, `app/Http/Controllers/datos_alumno.php:57`, `app/Http/Controllers/datos_alumno.php:97`, `app/Http/Controllers/datos_alumno.php:516`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:25`.

### `App\Tutorias_areas_canalizacion`

Archivo: `app/Tutorias_areas_canalizacion.php`. Tabla: `areas_canalizacion` (existe). Clave configurada: `id_area`; PRIMARY KEY físico: `id_area`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_areas_canalizacion.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_Canalizados_tutorController.php:7`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:8`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:88`, `app/Http/Controllers/Tutorias_PdfCitController.php:8`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:5`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:154`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_Canalizados_tutorController.php:7`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:8`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:88`, `app/Http/Controllers/Tutorias_PdfCitController.php:8`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:5`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:154`.

### `App\Tutorias_AsignaCoordinador`

Archivo: `app/Tutorias_AsignaCoordinador.php`. Tabla: `tutorias__asigna_coordinadors` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva tutorias__asigna_coordinadors no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 2 coincidencias. Líneas: 15, 24. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_AsignaCoordinador.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:7`, `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:23`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:7`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:23`, `app/Http/Controllers/Tutorias_JefeController.php:6`, `app/Http/Controllers/Tutorias_JefeController.php:19`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:7`, `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:23`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:7`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:23`, `app/Http/Controllers/Tutorias_JefeController.php:6`, `app/Http/Controllers/Tutorias_JefeController.php:19`.

### `App\Tutorias_AsignaExpediente`

Archivo: `app/Tutorias_AsignaExpediente.php`. Tabla: `tutorias__asigna_expedientes` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva tutorias__asigna_expedientes no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 19 coincidencias. Líneas: 16, 17, 18, 19, 20, 21, 33, 34, 35, 36, 37, 38, 44, 45, 46, 47, 48, 49, 52. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_AsignaExpediente.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Tutorias_AsignaGeneracion`

Archivo: `app/Tutorias_AsignaGeneracion.php`. Tabla: `tutorias__asigna_generacions` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva tutorias__asigna_generacions no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **posible incompatibilidad — pendiente:** Consulta usa base sistematutorias explícita, fuera de tesvb; existencia/privilegios no verificados.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 5 coincidencias. Líneas: 12, 22, 25, 35, 38. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_AsignaGeneracion.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Tutorias_AsignaTutor`

Archivo: `app/Tutorias_AsignaTutor.php`. Tabla: `tutorias__asigna_tutors` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva tutorias__asigna_tutors no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 1 coincidencias. Líneas: 14. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_AsignaTutor.php`.

Consumidores actuales (3): `app/Http/Controllers/Tutorias_Coordina_carrController.php:4`, `app/Http/Controllers/Tutorias_JefeController.php:7`, `app/Http/Controllers/Tutorias_JefeController.php:20`.

Consumidores históricos (3): `app/Http/Controllers/Tutorias_Coordina_carrController.php:4`, `app/Http/Controllers/Tutorias_JefeController.php:7`, `app/Http/Controllers/Tutorias_JefeController.php:20`.

### `App\Tutorias_asigna_tutor`

Archivo: `app/Tutorias_asigna_tutor.php`. Tabla: `asigna_tutor` (ausente). Clave configurada: `id_asigna_tutor`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** La tabla efectiva asigna_tutor no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 8 coincidencias. Líneas: 15, 22, 28, 35, 43, 50, 58, 65. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_asigna_tutor.php`.

Consumidores actuales (5): `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:7`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:26`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:27`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:28`, `app/Http/Controllers/Tutorias_PdfCitController.php:7`.

Consumidores históricos (5): `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:7`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:26`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:27`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:28`, `app/Http/Controllers/Tutorias_PdfCitController.php:7`.

### `App\Tutorias_Canalizacion`

Archivo: `app/Tutorias_Canalizacion.php`. Tabla: `canalizacion` (existe). Clave configurada: `id_canalizacion`; PRIMARY KEY físico: `id_canalizacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Canalizacion.php`.

Consumidores actuales (7): `app/Http/Controllers/Tutorias_Canalizados_tutorController.php:4`, `app/Http/Controllers/Tutorias_Canalizados_tutorController.php:37`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:5`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:74`, `app/Http/Controllers/Tutorias_PdfCitController.php:5`, `app/Http/Controllers/Tutorias_ProfesorController.php:3`, `app/Http/Controllers/Tutorias_ProfesorController.php:54`.

Consumidores históricos (7): `app/Http/Controllers/Tutorias_Canalizados_tutorController.php:4`, `app/Http/Controllers/Tutorias_Canalizados_tutorController.php:37`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:5`, `app/Http/Controllers/Tutorias_Canaliza_tutorController.php:74`, `app/Http/Controllers/Tutorias_PdfCitController.php:5`, `app/Http/Controllers/Tutorias_ProfesorController.php:3`, `app/Http/Controllers/Tutorias_ProfesorController.php:54`.

### `App\Tutorias_Desarrollo_asigna_coordinador_general`

Archivo: `app/Tutorias_Desarrollo_asigna_coordinador_general.php`. Tabla: `desarrollo_asigna_coordinador_general` (existe). Clave configurada: `id_asigna_coordinador_general`; PRIMARY KEY físico: `id_asigna_coordinador_general`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(10)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` | on update current_timestamp() |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 1 coincidencias. Líneas: 18. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_Desarrollo_asigna_coordinador_general.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_AsignaCoordinadorGeneralController.php:9`, `app/Http/Controllers/Tutorias_AsignaCoordinadorGeneralController.php:84`, `app/Http/Controllers/Tutorias_AsignaCoordinadorGeneralController.php:133`, `app/Http/Controllers/Tutorias_DesarrolloController.php:5`, `app/Http/Controllers/Tutorias_DesarrolloController.php:25`, `app/Http/Controllers/Tutorias_DesarrolloVistaController.php:10`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_AsignaCoordinadorGeneralController.php:9`, `app/Http/Controllers/Tutorias_AsignaCoordinadorGeneralController.php:84`, `app/Http/Controllers/Tutorias_AsignaCoordinadorGeneralController.php:133`, `app/Http/Controllers/Tutorias_DesarrolloController.php:5`, `app/Http/Controllers/Tutorias_DesarrolloController.php:25`, `app/Http/Controllers/Tutorias_DesarrolloVistaController.php:10`.

### `App\Tutorias_eventos`

Archivo: `app/Tutorias_eventos.php`. Tabla: `eventos` (existe). Clave configurada: `id_evento`; PRIMARY KEY físico: `id_evento`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_eventos.php`.

Consumidores actuales (5): `app/Http/Controllers/Tutorias_Eventos_tutorController.php:3`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:11`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:22`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:32`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:42`.

Consumidores históricos (5): `app/Http/Controllers/Tutorias_Eventos_tutorController.php:3`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:11`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:22`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:32`, `app/Http/Controllers/Tutorias_Eventos_tutorController.php:42`.

### `App\Tutorias_Exp_antecedentes_academico`

Archivo: `app/Tutorias_Exp_antecedentes_academico.php`. Tabla: `exp_antecedentes_academicos` (existe). Clave configurada: `id_exp_antecedentes_academicos`; PRIMARY KEY físico: `id_exp_antecedentes_academicos`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `bachillerato` → `App\Tutorias_Exp_bachillerato`: exp_antecedentes_academicos.id_bachillerato [int(11)] ↔ exp_bachillerato.id_bachillerato [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_antecedentes_academico.php`.

Consumidores actuales (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:5`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:84`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:136`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:164`, `app/Http/Controllers/Tutorias_PdfController.php:3`, `app/Http/Controllers/Tutorias_PdfController.php:124`, `app/Http/Controllers/Tutorias_PdfController.php:988`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:7`.

Consumidores históricos (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:5`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:84`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:136`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:164`, `app/Http/Controllers/Tutorias_PdfController.php:3`, `app/Http/Controllers/Tutorias_PdfController.php:124`, `app/Http/Controllers/Tutorias_PdfController.php:988`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:7`.

### `App\Tutorias_Exp_area_psicopedagogica`

Archivo: `app/Tutorias_Exp_area_psicopedagogica.php`. Tabla: `exp_area_psicopedagogica` (existe). Clave configurada: `id_exp_area_psicopedagogica`; PRIMARY KEY físico: `id_exp_area_psicopedagogica`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 14.

- `rendimientoescolar` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.rendimiento_escolar [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `dominioidioma` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.dominio_idioma [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `otroidioma` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.otro_idioma [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `conocimientocompu` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.conocimiento_compu [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `aptitudespecial` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.aptitud_especial [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `comprension1` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.comprension [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `preparacion1` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.preparacion [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `estrategiasaprendizaje` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.estrategias_aprendizaje [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `organizacionactividades` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.organizacion_actividades [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `concentracion1` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.concentracion [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `solucionproblemas` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.solucion_problemas [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `condicionesambientales` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.condiciones_ambientales [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `busquedabibliografica` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.busqueda_bibliografica [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `trabajoequipo` → `App\Tutorias_Exp_escalas`: exp_area_psicopedagogica.trabajo_equipo [int(11)] ↔ exp_escalas.id_escala [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_area_psicopedagogica.php`.

Consumidores actuales (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:6`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:88`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:140`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:168`, `app/Http/Controllers/Tutorias_PdfController.php:4`, `app/Http/Controllers/Tutorias_PdfController.php:144`, `app/Http/Controllers/Tutorias_PdfController.php:992`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:8`.

Consumidores históricos (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:6`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:88`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:140`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:168`, `app/Http/Controllers/Tutorias_PdfController.php:4`, `app/Http/Controllers/Tutorias_PdfController.php:144`, `app/Http/Controllers/Tutorias_PdfController.php:992`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:8`.

### `App\Tutorias_Exp_asigna_alumnos`

Archivo: `app/Tutorias_Exp_asigna_alumnos.php`. Tabla: `exp_asigna_alumnos` (existe). Clave configurada: `id_asigna_alumno`; PRIMARY KEY físico: `id_asigna_alumno`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_asigna_alumnos.php`.

Consumidores actuales (7): `app/Http/Controllers/Tutorias_AlumnosController.php:12`, `app/Http/Controllers/Tutorias_AlumnosController.php:193`, `app/Http/Controllers/Tutorias_AlumnosController.php:209`, `app/Http/Controllers/Tutorias_AlumnosController.php:218`, `app/Http/Controllers/Tutorias_AlumnosController.php:240`, `app/Http/Controllers/Tutorias_AlumnosController.php:312`, `app/Http/Controllers/Tutorias_AlumnosController.php:316`.

Consumidores históricos (7): `app/Http/Controllers/Tutorias_AlumnosController.php:12`, `app/Http/Controllers/Tutorias_AlumnosController.php:193`, `app/Http/Controllers/Tutorias_AlumnosController.php:209`, `app/Http/Controllers/Tutorias_AlumnosController.php:218`, `app/Http/Controllers/Tutorias_AlumnosController.php:240`, `app/Http/Controllers/Tutorias_AlumnosController.php:312`, `app/Http/Controllers/Tutorias_AlumnosController.php:316`.

### `App\Tutorias_Exp_asigna_coordinador`

Archivo: `app/Tutorias_Exp_asigna_coordinador.php`. Tabla: `exp_asigna_coordinador` (existe). Clave configurada: `id_asigna_coordinador`; PRIMARY KEY físico: `id_asigna_coordinador`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` | on update current_timestamp() |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_asigna_coordinador.php`.

Consumidores actuales (3): `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:8`, `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:63`, `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:112`.

Consumidores históricos (3): `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:8`, `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:63`, `app/Http/Controllers/Tutorias_AsignaCoordinadorController.php:112`.

### `App\Tutorias_Exp_asigna_generacion`

Archivo: `app/Tutorias_Exp_asigna_generacion.php`. Tabla: `exp_asigna_generacion` (existe). Clave configurada: `id_asigna_generacion`; PRIMARY KEY físico: `id_asigna_generacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"current_timestamp()"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **posible incompatibilidad — pendiente:** GROUP BY con orden y selección no agregada: revisar ONLY_FULL_GROUP_BY de la conexión Laravel; la sesión de metadatos no tiene ese modo. No asumir equivalencia con MySQL 8.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `getGeneracion` → `App\Tutorias_Exp_generacion`: exp_asigna_generacion.id_generacion [int(11)] ↔ exp_generacion.id_generacion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 7 coincidencias. Líneas: 24, 30, 35, 40, 45, 57, 71. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_Exp_asigna_generacion.php`.

Consumidores actuales (9): `app/Http/Controllers/Tutorias_AlumnosController.php:6`, `app/Http/Controllers/Tutorias_AlumnosController.php:114`, `app/Http/Controllers/Tutorias_AlumnosController.php:325`, `app/Http/Controllers/Tutorias_Dep_desarrolloController.php:3`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:9`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:15`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:16`, `app/Http/Controllers/Tutorias_ReporteGController.php:5`.

Consumidores históricos (9): `app/Http/Controllers/Tutorias_AlumnosController.php:6`, `app/Http/Controllers/Tutorias_AlumnosController.php:114`, `app/Http/Controllers/Tutorias_AlumnosController.php:325`, `app/Http/Controllers/Tutorias_Dep_desarrolloController.php:3`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:9`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:15`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:16`, `app/Http/Controllers/Tutorias_ReporteGController.php:5`.

### `App\Tutorias_Exp_asigna_tutor`

Archivo: `app/Tutorias_Exp_asigna_tutor.php`. Tabla: `exp_asigna_tutor` (existe). Clave configurada: `id_asigna_tutor`; PRIMARY KEY físico: `id_asigna_tutor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` | on update current_timestamp() |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_asigna_tutor.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_AlumnosController.php:13`, `app/Http/Controllers/Tutorias_AlumnosController.php:319`, `app/Http/Controllers/Tutorias_AlumnosController.php:322`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:5`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:63`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:113`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_AlumnosController.php:13`, `app/Http/Controllers/Tutorias_AlumnosController.php:319`, `app/Http/Controllers/Tutorias_AlumnosController.php:322`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:5`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:63`, `app/Http/Controllers/Tutorias_AsignaTutorController.php:113`.

### `App\Tutorias_Exp_bachillerato`

Archivo: `app/Tutorias_Exp_bachillerato.php`. Tabla: `exp_bachillerato` (existe). Clave configurada: `id_bachillerato`; PRIMARY KEY físico: `id_bachillerato`. Incrementing: `false`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / ``.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **error confirmado — corregido:** incrementing ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_bachillerato.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:7`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:96`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:146`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:176`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:10`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:126`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:7`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:96`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:146`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:176`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:10`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:126`.

### `App\Tutorias_Exp_bebidas`

Archivo: `app/Tutorias_Exp_bebidas.php`. Tabla: `exp_bebidas` (existe). Clave configurada: `id_expbebidas`; PRIMARY KEY físico: `id_expbebidas`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_bebidas.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:8`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:104`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:154`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:184`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:11`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:134`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:8`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:104`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:154`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:184`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:11`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:134`.

### `App\Tutorias_Exp_beca`

Archivo: `app/Tutorias_Exp_beca.php`. Tabla: `exp_beca` (existe). Clave configurada: `id_expbeca`; PRIMARY KEY físico: `id_expbeca`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_beca.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:9`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:105`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:155`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:185`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:12`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:135`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:9`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:105`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:155`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:185`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:12`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:135`.

### `App\Tutorias_Exp_civil_estado`

Archivo: `app/Tutorias_Exp_civil_estado.php`. Tabla: `exp_civil_estados` (existe). Clave configurada: `id_estado_civil`; PRIMARY KEY físico: `id_estado_civil`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_civil_estado.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:10`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:94`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:145`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:174`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:13`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:125`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:10`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:94`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:145`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:174`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:13`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:125`.

### `App\Tutorias_Exp_datos_familiare`

Archivo: `app/Tutorias_Exp_datos_familiare.php`. Tabla: `exp_datos_familiares` (existe). Clave configurada: `id_exp_datos_familiares`; PRIMARY KEY físico: `id_exp_datos_familiares`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 3.

- `vives` → `App\Tutorias_Exp_opc_vives`: exp_datos_familiares.id_opc_vives [int(11)] ↔ exp_opc_vives.id_opc_vives [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `union` → `App\Tutorias_Exp_familia_union`: exp_datos_familiares.id_familia_union [int(11)] ↔ exp_familia_union.id_familia_union [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `parentesco` → `App\Tutorias_Exp_parentesco`: exp_datos_familiares.id_parentesco [varchar(10)] ↔ exp_parentescos.id_parentesco [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_datos_familiare.php`.

Consumidores actuales (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:11`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:85`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:137`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:165`, `app/Http/Controllers/Tutorias_PdfController.php:5`, `app/Http/Controllers/Tutorias_PdfController.php:129`, `app/Http/Controllers/Tutorias_PdfController.php:989`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:14`.

Consumidores históricos (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:11`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:85`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:137`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:165`, `app/Http/Controllers/Tutorias_PdfController.php:5`, `app/Http/Controllers/Tutorias_PdfController.php:129`, `app/Http/Controllers/Tutorias_PdfController.php:989`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:14`.

### `App\Tutorias_Exp_escalas`

Archivo: `app/Tutorias_Exp_escalas.php`. Tabla: `exp_escalas` (existe). Clave configurada: `id_escala`; PRIMARY KEY físico: `id_escala`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_escalas.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:12`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:103`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:153`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:183`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:15`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:133`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:12`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:103`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:153`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:183`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:15`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:133`.

### `App\Tutorias_Exp_familia_union`

Archivo: `app/Tutorias_Exp_familia_union.php`. Tabla: `exp_familia_union` (existe). Clave configurada: `id_familia_union`; PRIMARY KEY físico: `id_familia_union`. Incrementing: `false`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / ``.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **error confirmado — corregido:** incrementing ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_familia_union.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:13`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:98`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:148`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:178`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:16`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:128`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:13`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:98`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:148`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:178`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:16`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:128`.

### `App\Tutorias_Exp_formacion_integral`

Archivo: `app/Tutorias_Exp_formacion_integral.php`. Tabla: `exp_formacion_integral` (existe). Clave configurada: `id_exp_formacion_integral`; PRIMARY KEY físico: `id_exp_formacion_integral`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `escala` → `App\Tutorias_Exp_bebidas`: exp_formacion_integral.id_expbebidas [int(11)] ↔ exp_bebidas.id_expbebidas [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_formacion_integral.php`.

Consumidores actuales (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:14`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:87`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:139`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:167`, `app/Http/Controllers/Tutorias_PdfController.php:6`, `app/Http/Controllers/Tutorias_PdfController.php:139`, `app/Http/Controllers/Tutorias_PdfController.php:991`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:17`.

Consumidores históricos (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:14`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:87`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:139`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:167`, `app/Http/Controllers/Tutorias_PdfController.php:6`, `app/Http/Controllers/Tutorias_PdfController.php:139`, `app/Http/Controllers/Tutorias_PdfController.php:991`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:17`.

### `App\Tutorias_Exp_generacion`

Archivo: `app/Tutorias_Exp_generacion.php`. Tabla: `exp_generacion` (existe). Clave configurada: `id_generacion`; PRIMARY KEY físico: `id_generacion`. Incrementing: `false`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / ``.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **error confirmado — corregido:** incrementing ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 1.

- `grupos` → `App\Tutorias_Exp_asigna_generacion`: exp_generacion.id_generacion [int(11)] ↔ exp_asigna_generacion.id_generacion [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_generacion.php`.

Consumidores actuales (4): `app/Http/Controllers/Tutorias_AlumnosController.php:5`, `app/Http/Controllers/Tutorias_AlumnosController.php:30`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:4`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:68`.

Consumidores históricos (4): `app/Http/Controllers/Tutorias_AlumnosController.php:5`, `app/Http/Controllers/Tutorias_AlumnosController.php:30`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:4`, `app/Http/Controllers/Tutorias_CoordinadorCarreraController.php:68`.

### `App\Tutorias_Exp_generale`

Archivo: `app/Tutorias_Exp_generale.php`. Tabla: `exp_generales` (existe). Clave configurada: `id_exp_general`; PRIMARY KEY físico: `id_exp_general`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 7.

- `carrera` → `App\Carreras`: exp_generales.id_carrera [int(11)] ↔ gnral_carreras.id_carrera [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `periodo` → `App\Periodos`: exp_generales.id_periodo [int(11)] ↔ gnral_periodos.id_periodo [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `grupo` → `App\Gnral_grupos`: exp_generales.id_grupo [int(11)] ↔ gnral_grupos.id_grupo [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `semestre` → `App\Semestres`: exp_generales.id_semestre [int(11)] ↔ gnral_semestres.id_semestre [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `civil` → `App\Tutorias_Exp_civil_estado`: exp_generales.id_estado_civil [int(11)] ↔ exp_civil_estados.id_estado_civil [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `turno1` → `App\Tutorias_Exp_turno`: exp_generales.turno [int(11)] ↔ exp_turno.id_turno [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `beca` → `App\Tutorias_Exp_beca`: exp_generales.id_expbeca [int(11)] ↔ exp_beca.id_expbeca [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_generale.php`.

Consumidores actuales (14): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:15`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:43`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:82`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:135`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:163`, `app/Http/Controllers/Tutorias_PdfController.php:7`, `app/Http/Controllers/Tutorias_PdfController.php:119`, `app/Http/Controllers/Tutorias_PdfController.php:987`.

Consumidores históricos (14): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:15`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:43`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:82`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:135`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:163`, `app/Http/Controllers/Tutorias_PdfController.php:7`, `app/Http/Controllers/Tutorias_PdfController.php:119`, `app/Http/Controllers/Tutorias_PdfController.php:987`.

### `App\Tutorias_Exp_habitos_estudio`

Archivo: `app/Tutorias_Exp_habitos_estudio.php`. Tabla: `exp_habitos_estudio` (existe). Clave configurada: `id_exp_habitos_estudio`; PRIMARY KEY físico: `id_exp_habitos_estudio`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — pendiente:** Relación tiempo referencia exp_habitos_estudio.tiempo_empelado_estudiar, ausente en el esquema leído. No se cambia destino o cardinalidad sin reconstruir intención original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 2.

- `intelectual` → `App\Tutorias_Exp_opc_intelectual`: exp_habitos_estudio.id_opc_intelectual [int(11)] ↔ exp_opc_intelectual.id_opc_intelectual [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.
- `tiempo` → `App\Tutorias_Exp_tiempoestudia`: exp_habitos_estudio.tiempo_empelado_estudiar [AUSENTE] ↔ exp_tiempoestudia.id_tiempoestudia [int(11)]. FKs declaradas sobre esas columnas (no prueba de coincidencia del destino): 0.

Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_habitos_estudio.php`.

Consumidores actuales (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:16`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:86`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:138`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:166`, `app/Http/Controllers/Tutorias_PdfController.php:8`, `app/Http/Controllers/Tutorias_PdfController.php:134`, `app/Http/Controllers/Tutorias_PdfController.php:990`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:20`.

Consumidores históricos (11): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:16`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:86`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:138`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:166`, `app/Http/Controllers/Tutorias_PdfController.php:8`, `app/Http/Controllers/Tutorias_PdfController.php:134`, `app/Http/Controllers/Tutorias_PdfController.php:990`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:20`.

### `App\Tutorias_Exp_opc_intelectual`

Archivo: `app/Tutorias_Exp_opc_intelectual.php`. Tabla: `exp_opc_intelectual` (existe). Clave configurada: `id_opc_intelectual`; PRIMARY KEY físico: `id_opc_intelectual`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_opc_intelectual.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:17`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:101`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:151`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:181`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:21`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:131`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:17`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:101`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:151`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:181`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:21`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:131`.

### `App\Tutorias_Exp_opc_nivel_socio`

Archivo: `app/Tutorias_Exp_opc_nivel_socio.php`. Tabla: `exp_opc_nivel_socio` (existe). Clave configurada: `id_nivel_economico`; PRIMARY KEY físico: `id_nivel_economico`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_opc_nivel_socio.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Tutorias_Exp_opc_tiempo`

Archivo: `app/Tutorias_Exp_opc_tiempo.php`. Tabla: `exp_opc_tiempo` (existe). Clave configurada: `id_opc_tiempo`; PRIMARY KEY físico: `id_opc_tiempo`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_opc_tiempo.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:18`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:100`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:150`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:180`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:22`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:130`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:18`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:100`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:150`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:180`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:22`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:130`.

### `App\Tutorias_Exp_opc_vives`

Archivo: `app/Tutorias_Exp_opc_vives.php`. Tabla: `exp_opc_vives` (existe). Clave configurada: `id_opc_vives`; PRIMARY KEY físico: `id_opc_vives`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_opc_vives.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:19`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:97`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:147`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:177`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:23`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:127`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:19`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:97`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:147`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:177`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:23`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:127`.

### `App\Tutorias_Exp_parentesco`

Archivo: `app/Tutorias_Exp_parentesco.php`. Tabla: `exp_parentescos` (existe). Clave configurada: `id_parentesco`; PRIMARY KEY físico: `id_parentesco`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_parentesco.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:20`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:102`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:152`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:182`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:24`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:132`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:20`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:102`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:152`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:182`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:24`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:132`.

### `App\Tutorias_Exp_tiempoestudia`

Archivo: `app/Tutorias_Exp_tiempoestudia.php`. Tabla: `exp_tiempoestudia` (existe). Clave configurada: `id_tiempoestudia`; PRIMARY KEY físico: `id_tiempoestudia`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_tiempoestudia.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Tutorias_Exp_turno`

Archivo: `app/Tutorias_Exp_turno.php`. Tabla: `exp_turno` (existe). Clave configurada: `id_turno`; PRIMARY KEY físico: `id_turno`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Exp_turno.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:21`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:99`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:149`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:179`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:26`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:129`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_PanelAlumnoController.php:21`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:99`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:149`, `app/Http/Controllers/Tutorias_PanelAlumnoController.php:179`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:26`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:129`.

### `App\Tutorias_Planeacion`

Archivo: `app/Tutorias_Planeacion.php`. Tabla: `planeacion` (existe). Clave configurada: `id_planeacion`; PRIMARY KEY físico: `id_planeacion`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Planeacion.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_Coordina_peticionesController.php:7`, `app/Http/Controllers/Tutorias_Coordina_peticionesController.php:73`, `app/Http/Controllers/Tutorias_Desarrollo_peticionesController.php:5`, `app/Http/Controllers/Tutorias_Desarrollo_peticionesController.php:77`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:8`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:24`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_Coordina_peticionesController.php:7`, `app/Http/Controllers/Tutorias_Coordina_peticionesController.php:73`, `app/Http/Controllers/Tutorias_Desarrollo_peticionesController.php:5`, `app/Http/Controllers/Tutorias_Desarrollo_peticionesController.php:77`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:8`, `app/Http/Controllers/Tutorias_Planea_tutorController.php:24`.

### `App\Tutorias_Plan_actividades`

Archivo: `app/Tutorias_Plan_actividades.php`. Tabla: `plan_actividades` (existe). Clave configurada: `id_plan_actividad`; PRIMARY KEY físico: `id_plan_actividad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"current_timestamp()"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Plan_actividades.php`.

Consumidores actuales (12): `app/Http/Controllers/Tutorias_actividades_alumnoController.php:4`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:26`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:5`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:50`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:82`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:121`, `app/Http/Controllers/Tutorias_calendario_eventosController.php:4`, `app/Http/Controllers/Tutorias_calendario_eventosController.php:17`.

Consumidores históricos (12): `app/Http/Controllers/Tutorias_actividades_alumnoController.php:4`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:26`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:5`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:50`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:82`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:121`, `app/Http/Controllers/Tutorias_calendario_eventosController.php:4`, `app/Http/Controllers/Tutorias_calendario_eventosController.php:17`.

### `App\Tutorias_Plan_asigna_evidencias`

Archivo: `app/Tutorias_Plan_asigna_evidencias.php`. Tabla: `plan_asigna_evidencias` (existe). Clave configurada: `id_evidencia`; PRIMARY KEY físico: `id_evidencia`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"current_timestamp()"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Plan_asigna_evidencias.php`.

Consumidores actuales (5): `app/Http/Controllers/Tutorias_actividades_alumnoController.php:5`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:56`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:81`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:88`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:117`.

Consumidores históricos (5): `app/Http/Controllers/Tutorias_actividades_alumnoController.php:5`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:56`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:81`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:88`, `app/Http/Controllers/Tutorias_actividades_alumnoController.php:117`.

### `App\Tutorias_Plan_asigna_planeacion_actividad`

Archivo: `app/Tutorias_Plan_asigna_planeacion_actividad.php`. Tabla: `plan_asigna_planeacion_actividad` (existe). Clave configurada: `id_asigna_planeacion_actividad`; PRIMARY KEY físico: `id_asigna_planeacion_actividad`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"current_timestamp()"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Plan_asigna_planeacion_actividad.php`.

Consumidores actuales (12): `app/Http/Controllers/Tutorias_Actividades_tutorController.php:6`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:55`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:61`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:96`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:104`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:111`, `app/Http/Controllers/Tutorias_AlumnosController.php:9`, `app/Http/Controllers/Tutorias_AlumnosController.php:137`.

Consumidores históricos (12): `app/Http/Controllers/Tutorias_Actividades_tutorController.php:6`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:55`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:61`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:96`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:104`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:111`, `app/Http/Controllers/Tutorias_AlumnosController.php:9`, `app/Http/Controllers/Tutorias_AlumnosController.php:137`.

### `App\Tutorias_Plan_asigna_planeacion_tutor`

Archivo: `app/Tutorias_Plan_asigna_planeacion_tutor.php`. Tabla: `plan_asigna_planeacion_tutor` (existe). Clave configurada: `id_asigna_planeacion_tutor`; PRIMARY KEY físico: `id_asigna_planeacion_tutor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"current_timestamp()"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 1 coincidencias. Líneas: 19. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_Plan_asigna_planeacion_tutor.php`.

Consumidores actuales (12): `app/Http/Controllers/Tutorias_Actividades_tutorController.php:7`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:66`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:71`, `app/Http/Controllers/Tutorias_AlumnosController.php:11`, `app/Http/Controllers/Tutorias_AlumnosController.php:149`, `app/Http/Controllers/Tutorias_AlumnosController.php:154`, `app/Http/Controllers/Tutorias_ProfesorController.php:5`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:28`.

Consumidores históricos (12): `app/Http/Controllers/Tutorias_Actividades_tutorController.php:7`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:66`, `app/Http/Controllers/Tutorias_Actividades_tutorController.php:71`, `app/Http/Controllers/Tutorias_AlumnosController.php:11`, `app/Http/Controllers/Tutorias_AlumnosController.php:149`, `app/Http/Controllers/Tutorias_AlumnosController.php:154`, `app/Http/Controllers/Tutorias_ProfesorController.php:5`, `app/Http/Controllers/Tutorias_ViewAlumnosController.php:28`.

### `App\Tutorias_Profesor`

Archivo: `app/Tutorias_Profesor.php`. Tabla: `tutorias__profesors` (ausente). Clave configurada: `id`; PRIMARY KEY físico: ``. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `no disponible` / `no disponible`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** La tabla efectiva tutorias__profesors no existe en tesvb. No se infiere un nombre sustituto; comprobar si la clase es auxiliar, obsoleta o requiere otra base. Las operaciones de persistencia contra esa tabla fallarían.
- **posible incompatibilidad — pendiente:** SQL manual revisado estáticamente; contiene dependencias de esquema/concatenación y no se ejecutó. Confirmar consultas y consumidores con fixtures funcionales antes de reescribirlas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 3 coincidencias. Líneas: 12, 13, 24. SQL revisado estáticamente; no se ejecutaron métodos de negocio.

Referencia histórica: `app/Tutorias_Profesor.php`.

Consumidores actuales (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

Consumidores históricos (0): sin coincidencias textuales directas; no equivale a ausencia de uso dinámico.

### `App\Tutorias_Reporte_tutor`

Archivo: `app/Tutorias_Reporte_tutor.php`. Tabla: `reporte_tutor` (existe). Clave configurada: `id_reporte_tutor`; PRIMARY KEY físico: `id_reporte_tutor`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_Reporte_tutor.php`.

Consumidores actuales (6): `app/Http/Controllers/Tutorias_ReportePDFController.php:6`, `app/Http/Controllers/Tutorias_ReporteSemestralCController.php:4`, `app/Http/Controllers/Tutorias_ReporteSemestralCController.php:298`, `app/Http/Controllers/Tutorias_ReporteSemestralCController.php:355`, `app/Http/Controllers/Tutorias_ReporteSemestralController.php:4`, `app/Http/Controllers/Tutorias_ReporteSemestralController.php:99`.

Consumidores históricos (6): `app/Http/Controllers/Tutorias_ReportePDFController.php:6`, `app/Http/Controllers/Tutorias_ReporteSemestralCController.php:4`, `app/Http/Controllers/Tutorias_ReporteSemestralCController.php:298`, `app/Http/Controllers/Tutorias_ReporteSemestralCController.php:355`, `app/Http/Controllers/Tutorias_ReporteSemestralController.php:4`, `app/Http/Controllers/Tutorias_ReporteSemestralController.php:99`.

### `App\Tutorias_subareas_canalizacion`

Archivo: `app/Tutorias_subareas_canalizacion.php`. Tabla: `subareas_canalizacion` (existe). Clave configurada: `id_subarea`; PRIMARY KEY físico: `id_subarea`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `false`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | Ausente | — | `null` | — |
| `updated_at` | Ausente | — | `null` | — |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **error confirmado — corregido:** timestamps ajustado de true a false según metadatos físicos y revisión del uso original.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/Tutorias_subareas_canalizacion.php`.

Consumidores actuales (1): `app/Http/Controllers/Tutorias_ViewAlumnosController.php:29`.

Consumidores históricos (1): `app/Http/Controllers/Tutorias_ViewAlumnosController.php:29`.

### `App\User`

Archivo: `app/User.php`. Tabla: `users` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(10) unsigned` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | YES | `"NULL"` |  |
| `updated_at` | `timestamp` | YES | `"NULL"` |  |
| `deleted_at` | `timestamp` | YES | `"NULL"` |  |

Hallazgos:

- **comportamiento heredado válido — conservado:** Existe deleted_at, pero el modelo no aplica SoftDeletes. La presencia de la columna no autoriza añadir un filtro global ni cambiar delete().
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/User.php`.

Consumidores actuales (20): `app/ActivationService.php:53`, `app/ActividadesComplementarias.php:6`, `app/Http/Controllers/Auth/RegisterController.php:5`, `app/Http/Controllers/Auth/RegisterController.php:35`, `app/Http/Controllers/Compu_reg_usuarioController.php:5`, `app/Http/Controllers/DatosGraficosHistoricos.php:12`, `app/Http/Controllers/datos_alumno.php:13`, `app/Http/Controllers/datos_alumno.php:517`.

Consumidores históricos (19): `app/ActivationService.php:53`, `app/ActividadesComplementarias.php:6`, `app/Http/Controllers/Auth/RegisterController.php:5`, `app/Http/Controllers/Auth/RegisterController.php:35`, `app/Http/Controllers/Compu_reg_usuarioController.php:5`, `app/Http/Controllers/DatosGraficosHistoricos.php:12`, `app/Http/Controllers/datos_alumno.php:13`, `app/Http/Controllers/datos_alumno.php:517`.

### `App\ValidacionCarga`

Archivo: `app/ValidacionCarga.php`. Tabla: `eva_validacion_de_cargas` (existe). Clave configurada: `id`; PRIMARY KEY físico: `id`. Incrementing: `true`; keyType: `int`. Tipo/EXTRA de clave: `int(11)` / `auto_increment`.

Timestamps: `true`; CREATED_AT: `"created_at"`; UPDATED_AT: `"updated_at"`; SoftDeletes: `false`; columna efectiva de borrado: `null`.

| Columna | Existencia / tipo | Nullable | Default (metadato) | EXTRA |
| --- | --- | --- | --- | --- |
| `created_at` | `timestamp` | NO | `"current_timestamp()"` | on update current_timestamp() |
| `updated_at` | `timestamp` | NO | `"'0000-00-00 00:00:00'"` |  |
| `deleted_at` | Ausente | — | `null` | — |

Hallazgos:

- **posible incompatibilidad — pendiente:** created_at cambia automáticamente en MariaDB por ON UPDATE; se conserva el esquema y debe confirmarse la intención histórica.
- **posible incompatibilidad — pendiente:** updated_at tiene default de fecha cero. Revisar datos y modos SQL de la conexión Laravel (strict=true); no se leyeron filas.
- **comportamiento heredado válido — conservado:** Carga PSR-4 y construcción de relaciones verificadas; claves explícitas, nombres heredados y cardinalidades se conservan salvo correcciones documentadas. Esto no certifica todos los resultados funcionales.

Relaciones: 0.


Consultas/helpers con revisión adicional: 0 coincidencias. No se detectaron llamadas DB manuales ni los patrones de compatibilidad buscados; métodos de relaciones verificados aparte.

Referencia histórica: `app/ValidacionCarga.php`.

Consumidores actuales (30): `app/Http/Controllers/AudAccionesController.php:13`, `app/Http/Controllers/checar_cargaController.php:11`, `app/Http/Controllers/checar_cargaController.php:385`, `app/Http/Controllers/checar_cargaController.php:398`, `app/Http/Controllers/checar_cargajefeController.php:5`, `app/Http/Controllers/Computo_calificarController.php:10`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:10`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:774`.

Consumidores históricos (30): `app/Http/Controllers/AudAccionesController.php:13`, `app/Http/Controllers/checar_cargaController.php:11`, `app/Http/Controllers/checar_cargaController.php:385`, `app/Http/Controllers/checar_cargaController.php:398`, `app/Http/Controllers/checar_cargajefeController.php:5`, `app/Http/Controllers/Computo_calificarController.php:10`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:10`, `app/Http/Controllers/Dual_Checar_Carga_Academica_Alumno.php:774`.
