> Actualización: los ocho candidatos de claves primarias quedaron resueltos; consultar [continuación verificada](claves-primarias-verificadas.md). El inventario siguiente conserva el estado de la auditoría inicial.

# Auditoría de modelos Eloquent TESVB

Fecha: 12 de noviembre de 2026.

## Alcance y resultado

Repositorio local: `C:\xampp\htdocs\laravel\Migracion_Tesvb`, remoto `JArturoCP/Migracion_Tesvb`.
Rama de revisión: `codex/auditoria-modelos-laravel12`, creada desde `fix/modelos-laravel12`, commit base `ccc9acb`.
Se revisaron 241 modelos: 240 en `app/` y uno en `app/Models/`. También se inspeccionaron todas las declaraciones de herencia en `app/`: 239 modelos directos y dos clases Authenticatable, sin otras subclases Eloquent fuera del inventario.

Se comprobaron namespaces, correspondencia PSR-4 entre clase y archivo, imports, referencias estáticas, tabla, clave primaria, timestamps, incremento, tipo de clave y construcción de relaciones. Las correcciones afectan 14 modelos y mantienen exactamente sus tablas, claves, columnas, timestamps, tipos de clave, cardinalidades, filtros y SQL de negocio. No se movieron los modelos heredados a `App\Models`: `App` sigue siendo un namespace válido y sus consumidores existentes se conservan.

Se añadieron tres pruebas de regresión sin aplicación ni base de datos. La fixture conserva la configuración previa; **no certifica que esa configuración coincida con el esquema físico**. La revisión del esquema queda pendiente donde se indica más adelante.

## Correcciones y justificación

| Commit / grupo | Archivos | Cambio comprobado |
| --- | --- | --- |
| `a228762` | `app/Alumnos.php`, `app/Tutorias_asigna_tutor.php`, `app/Tutorias_AsignaGeneracion.php`, `app/Tutorias_Plan_asigna_planeacion_tutor.php` | Import explícito de `Illuminate\Support\Facades\DB`. Los primeros tres dependían del alias global `DB`; el último resolvía incorrectamente `App\DB` al no tener import. |
| `84cc50a` | `app/ri_requisitos.php`, `app/ri_unidad_parte.php`, `app/Tutorias_AsignaCoordinador.php`, `app/Tutorias_AsignaExpediente.php`, `app/Tutorias_AsignaTutor.php`, `app/Tutorias_Desarrollo_asigna_coordinador_general.php`, `app/Tutorias_Exp_asigna_generacion.php`, `app/Tutorias_Reporte_tutor.php` | Imports explícitos de las facades Session y, en Reporte_tutor, DB y Auth. Se conserva la intención incluso en imports actualmente sin uso. |
| `ca6d457` | `app/Tutorias_Exp_asigna_expediente.php` → `app/Exp_asigna_expediente.php` | Solo se renombró el archivo, sin cambiar su contenido ni la clase pública `App\Exp_asigna_expediente`. Composer no podía cargarla desde el nombre anterior. `Tutorias_ViewAlumnosController` ya importa esa clase; no se modificó el controlador. |
| `ca6d457` | `app/Tutorias_Plan_actividades.php` | Eliminación de `use App\Exp_generacion`, clase inexistente y no utilizada. No se añadió una relación ni se sustituyó por otro modelo por conjetura. |

La configuración actual `config/app.php` no define `aliases`. El bootstrap instalado `Illuminate\Foundation\Bootstrap\RegisterFacades` registra los alias de esa configuración y de los paquetes; no incorpora automáticamente `Facade::defaultAliases()`. Por ello los imports globales no eran fiables en esta instalación. Las facades explícitas conservan las llamadas, argumentos y consultas existentes.

## Archivos de pruebas y documentación

- `tests/Unit/EloquentCompatibilityTest.php`: inventario/autoload, mapeo persistente, imports/referencias estáticas y construcción de relaciones.
- `tests/Fixtures/eloquent-metadata.json`: configuración previa de los 241 modelos (tabla, primaryKey, timestamps, incrementing, keyType).
- `tests/run-eloquent-compatibility.php`: ejecución directa de esas tres pruebas PHPUnit, sin cargar la aplicación ni la suite Feature.
- `docs/auditoria-modelos-laravel12.md`: este informe y el inventario completo.

## Validación ejecutada

Se utilizó PHP **8.4.27** CLI, descargado del servicio oficial de PHP para Windows y ejecutado desde una carpeta temporal del espacio de trabajo. Se comprobó SHA-256 del ZIP contra el publicado en `releases.json`: `dbae154a0a89791f36c3d48e68bae797878333e7d6cb5721e74617de59b63ab7`. No se sustituyó PHP de XAMPP ni se modificó su configuración. El PHP de XAMPP disponible era 8.5.12.

- `php -l` con PHP 8.4 sobre los 241 modelos y los dos archivos PHP de pruebas nuevos: **243 archivos sin errores**.
- Tres pruebas PHPUnit ejecutadas directamente: **3 aprobadas, 2,833 aserciones** (1,447 + 685 + 701).
- Se cargan las 241 clases por Composer desde el archivo esperado, sin require manual de modelos ni alias globales.
- Se construyen **153 relaciones sin argumentos obligatorios** y su SQL. Se usa un proveedor PDO que lanza una excepción si se intenta conectar; la sesión de prueba vive en memoria. No se ejecutan consultas.
- Los métodos `ri_requisitos::riesgosunidad($unidad)` y `oportunidadesunidad($unidad)` son ayudantes que llaman `get()`, no relaciones sin argumentos; se revisaron estáticamente y no se invocaron.
- `git diff --check`: sin errores.
- Se intentó ejecutar la suite Unit existente con Pest, tanto con el lanzador como con el binario del paquete y un bootstrap absoluto. El entorno devuelve `is_readable(vendor/autoload.php) = false` aunque `require` puede cargarlo; Pest termina con `Cannot open bootstrap script`. Por ello **no se declara aprobada la suite existente**. La ejecución directa de los nuevos casos PHPUnit sí pasó y evita esa comprobación del lanzador.
- Las pruebas Feature usan `RefreshDatabase` en `tests/Pest.php`; se omitieron porque ejecutan migraciones, incluso usando SQLite en memoria.
- Se intentó una consulta preparada de solo metadatos a `information_schema.COLUMNS`; la conexión falló con PDO 2002. No se leyó información de filas ni se modificaron datos. Las credenciales no se registraron en el informe.

Para repetir las pruebas aisladas usando PHP 8.4 y las dependencias instaladas:

```powershell
php tests/run-eloquent-compatibility.php
```

Cuando el entorno permita el lanzador estándar, ejecutar solo Unit:

```powershell
php vendor/bin/pest --testsuite=Unit --no-coverage
```

No ejecutar la suite Feature ni `composer test` completo mientras siga vigente la prohibición de migraciones. La construcción de SQL y la carga de modelos no validan resultados de consultas ni columnas físicas.

## Evidencias confirmadas y pendientes (criterio corregido)

Los seeders actuales son datos ficticios generados recientemente con IA y no pertenecen al sistema Laravel 5.6 original. No constituyen evidencia del esquema, de columnas ausentes, de claves ni del comportamiento esperado. Se retiran las listas anteriores de 43 candidatos de timestamps y 17 referencias de columnas en relaciones, pues su fundamento era exclusivamente la comparación con esos seeders. Sus conteos no representan errores confirmados ni una lista validada de correcciones pendientes.

**Confirmado y corregido:** las ocho claves primarias comunicadas por el usuario como verificadas directamente en MariaDB mediante `information_schema.KEY_COLUMN_USAGE`. Se conservan sin cambios; véase [claves verificadas](claves-primarias-verificadas.md). La fuente de estas correcciones es MariaDB, no los seeders. También permanecen los fallos de imports y PSR-4 reproducidos con PHP y Composer.

**Timestamps:** diez tablas confirmadas por el usuario con information_schema.COLUMNS en MariaDB 10.4.32 (tesvb): nueve sin ambas columnas y oc_oficio con updated_at solamente. Se aplicaron los ajustes descritos en [timestamps verificados](timestamps-verificados.md). Las demás tablas siguen pendientes. El inventario histórico inferior no sustituye esos resultados ni la fixture actualizada.

**Código histórico:** se compararon los modelos con la referencia Laravel 5.6 disponible, `DorianReb/tesvb`, commit `36da4037a7dd478d90a5e61e3cef48b8f7e505b1`. Hay 219 archivos idénticos al normalizar saltos de línea y 21 con diferencias limitadas a imports y primaryKey (además del nombre de archivo corregido de expediente). `App/Models/User.php` no existe en esa referencia. No se observaron cambios de relaciones ni timestamps entre los modelos compartidos. Esta copia es una referencia histórica disponible, no una certificación de que sea la revisión exacta desplegada del sistema original; debe confirmarse esa procedencia antes de atribuir diferencias funcionales a la migración.

**Posibles problemas pendientes respaldados por código:** la relación `oc_oficio_personal::notificacion` infiere la clave local del modelo y contiene un OR sin agrupar; ese código ya existe en la referencia Laravel 5.6. Se conserva hasta contrastar esquema y uso funcional original. Las dos clases User y los ayudantes con SQL manual requieren analizar sus consumidores antes de unificar contratos o cambiar consultas. Construir SQL correctamente no confirma la existencia física de las columnas.

Prioridad para futuras decisiones: metadatos/DDL reales de MariaDB; revisión exacta del sistema Laravel 5.6 original; controladores y vistas que consumen cada modelo. Antes de cambiar comportamiento, documentar la consulta/operación original, sus claves y tipo de resultado, la evidencia real del error y el efecto esperado en sus consumidores. Los seeders ficticios quedan excluidos de esta cadena de evidencia.

Véase [reclasificación de evidencias](criterios-evidencia-modelos.md).
Además:

- `oc_oficio_personal::notificacion` usa hasMany sin clave local explícita y un `orWhere` sin agrupar. Confirmar si debe relacionar `id_notificacion` y si el OR debe quedar dentro del filtro; cambiarlo afectaría resultados y no es un ajuste automático de compatibilidad.
- Existen relaciones con nombres singulares y hasMany, así como hasOne sobre claves de catálogo. Se conserva su cardinalidad: cambiarla modificaría el tipo de resultado que reciben vistas y controladores.
- Conviven `App\User` y `App\Models\User`, ambos sobre `users`, con fillable/casts distintos. `config/auth.php` usa por defecto `App\Models\User`; el legado usa `App\User`. Se mantienen ambos contratos. La unificación necesita una revisión del flujo de autenticación y los consumidores; no corresponde cambiarla silenciosamente.
- Varias clases heredadas de Model son auxiliares o están vacías y conservan tabla inferida. El inventario señala todas las tablas inferidas; no se inventaron mapeos. Las referencias a nombres SQL antiguos o a `sistematutorias` en ayudantes requieren validar la intención funcional antes de cambiarlas.
- Algunas consultas manuales concatenan parámetros; se conservaron en este alcance. La auditoría no valida ni corrige toda la lógica SQL de los ayudantes, ni ejecuta sus lecturas/escrituras.
- `composer.json` fija `config.platform.php` a 8.3.0, aunque la validación aquí se ejecutó con 8.4.27. No se cambiaron dependencias ni plataforma; conviene alinear esa decisión de resolución de paquetes con el despliegue durante la migración general.
- Los casos de regresión cubren todos los modelos actuales y sus relaciones directas sin argumentos. Al añadir modelos, revisar la fixture y el conteo de relaciones deliberadamente.

## Límites respetados

No se ejecutaron migraciones, seeders, comandos de borrado ni escrituras en la base de datos. No se modificaron `.env`, controladores, rutas, configuración, dependencias ni migraciones. No hubo push, creación remota de PR ni integración en `main`. La rama contiene commits locales revisables y parte del estado de migración proporcionado por el usuario, no del repositorio Laravel 5.6 encontrado inicialmente en GitHub.

La documentación de Laravel 12 admite tablas y claves personalizadas, así como claves explícitas en relaciones; conservar esos mapeos y contratos evita introducir cambios funcionales durante esta corrección: [relaciones Eloquent de Laravel 12](https://laravel.com/framework/docs/12.x/eloquent-relationships).

## Inventario completo

Valores efectivos bajo Laravel 12 antes y después de las correcciones. “Inferida” se refiere a la configuración del modelo, no a la existencia comprobada de la tabla. Se indican los archivos finales; la clase de expediente conserva su nombre público. Todos mantienen `incrementing = true` y `keyType = int`.

| Archivo | Clase | Tabla efectiva | Origen tabla | Clave | Timestamps |
| --- | --- | --- | --- | --- | --- |
| `app/Abreviaciones.php` | `App\Abreviaciones` | `abreviaciones` | Explícita | `id_abreviacion` | Sí |
| `app/Abreviaciones_prof.php` | `App\Abreviaciones_prof` | `abreviaciones_prof` | Explícita | `id_abreviacion_prof` | Sí |
| `app/Activa_evaluacion.php` | `App\Activa_evaluacion` | `eva_activa_evaluacion` | Explícita | `id` | Sí |
| `app/Actividades.php` | `App\Actividades` | `actividades` | Inferida | `id` | Sí |
| `app/ActividadesComplementarias.php` | `App\ActividadesComplementarias` | `actividades_complementarias` | Explícita | `id_actividad_comple` | Sí |
| `app/Alumnos.php` | `App\Alumnos` | `gnral_alumnos` | Explícita | `id_alumno` | Sí |
| `app/AudAcciones.php` | `App\AudAcciones` | `aud_acciones` | Explícita | `id_acciones` | Sí |
| `app/AudActividades.php` | `App\AudActividades` | `aud_actividad` | Explícita | `id_actividad` | Sí |
| `app/AudAgenda.php` | `App\AudAgenda` | `aud_agenda` | Explícita | `id_agenda` | Sí |
| `app/AudAgendaActividad.php` | `App\AudAgendaActividad` | `aud_agenda_actividad` | Explícita | `id_agenda_actividad` | Sí |
| `app/AudAgendaActividadArea.php` | `App\AudAgendaActividadArea` | `aud_agenda_actividad_area` | Explícita | `id_agenda_actividad_area` | Sí |
| `app/AudAgendaActividadPersona.php` | `App\AudAgendaActividadPersona` | `aud_agenda_actividad_persona` | Explícita | `id_agenda_actividad_persona` | Sí |
| `app/AudAgendaArea.php` | `App\AudAgendaArea` | `aud_agenda_area` | Explícita | `id_agenda_area` | Sí |
| `app/AudAgendaAuditor.php` | `App\AudAgendaAuditor` | `aud_agenda_auditor` | Explícita | `id_agenda_auditor` | Sí |
| `app/AudAgendaEvento.php` | `App\AudAgendaEvento` | `aud_agenda_evento` | Explícita | `id_agenda_evento` | Sí |
| `app/AudAgendaProceso.php` | `App\AudAgendaProceso` | `aud_agenda_proceso` | Explícita | `id_agenda_proceso` | Sí |
| `app/AudAnalisisDatos.php` | `App\AudAnalisisDatos` | `aud_analisis_datos` | Inferida | `id` | Sí |
| `app/AudAreaGeneral.php` | `App\AudAreaGeneral` | `aud_area_general` | Explícita | `id_area_general` | Sí |
| `app/AudAreaGeneralUnidad.php` | `App\AudAreaGeneralUnidad` | `aud_area_general_unidad` | Explícita | `id_area_general_unidad` | Sí |
| `app/AudAsignaAuditoria.php` | `App\AudAsignaAuditoria` | `aud_asigna_audi` | Explícita | `id_asigna_audi` | Sí |
| `app/AudAuditorAuditoria.php` | `App\AudAuditorAuditoria` | `aud_auditor_auditoria` | Explícita | `id_auditor_auditoria` | Sí |
| `app/AudAuditores.php` | `App\AudAuditores` | `aud_auditores` | Explícita | `id_auditores` | Sí |
| `app/AudAuditoriaProceso.php` | `App\AudAuditoriaProceso` | `aud_auditoria_proceso` | Explícita | `id_auditoria_proceso` | Sí |
| `app/AudAuditorias.php` | `App\AudAuditorias` | `aud_auditoria` | Explícita | `id_auditoria` | Sí |
| `app/AudCategoria.php` | `App\AudCategoria` | `aud_categoria` | Explícita | `id_categoria` | Sí |
| `app/AudClasificacion.php` | `App\AudClasificacion` | `aud_clasificacion` | Explícita | `id_clasificacion` | Sí |
| `app/AudEvidencia.php` | `App\AudEvidencia` | `aud_evidencias` | Explícita | `id_evidencia` | Sí |
| `app/AudEvidenciasAcciones.php` | `App\AudEvidenciasAcciones` | `aud_evidencias_acciones` | Inferida | `id` | Sí |
| `app/AudFortaleza.php` | `App\AudFortaleza` | `aud_fortalezas` | Explícita | `id_fortaleza` | Sí |
| `app/AudHoja.php` | `App\AudHoja` | `aud_hojas` | Inferida | `id` | Sí |
| `app/AudInforme.php` | `App\AudInforme` | `aud_informe` | Explícita | `id_informe` | Sí |
| `app/AudInformeEstado.php` | `App\AudInformeEstado` | `aud_informe_estados` | Inferida | `id` | Sí |
| `app/AudLiderAcciones.php` | `App\AudLiderAcciones` | `aud_lider_acciones` | Explícita | `id_lider` | Sí |
| `app/AudNormatividad.php` | `App\AudNormatividad` | `aud_normatividad` | Explícita | `id_normatividad` | Sí |
| `app/AudNormatividadAuditoria.php` | `App\AudNormatividadAuditoria` | `aud_normatividad_auditoria` | Explícita | `id_normatividad_auditoria` | Sí |
| `app/AudNota.php` | `App\AudNota` | `aud_notas` | Explícita | `id_notas` | Sí |
| `app/AudObjetivo.php` | `App\AudObjetivo` | `aud_objetivo` | Explícita | `id_objetivo` | Sí |
| `app/AudPdfHoja.php` | `App\AudPdfHoja` | `aud_pdf_hojas` | Inferida | `id` | Sí |
| `app/AudPersonalGeneral.php` | `App\AudPersonalGeneral` | `aud_personal_general` | Explícita | `id_personal_general` | Sí |
| `app/AudPersonalGeneralAuditor.php` | `App\AudPersonalGeneralAuditor` | `aud_personal_general_auditor` | Explícita | `id_personal_general_auditor` | Sí |
| `app/AudPersonalGeneralPersonal.php` | `App\AudPersonalGeneralPersonal` | `aud_personal_general_persona` | Explícita | `id_personal_general_persona` | Sí |
| `app/AudPlanAccion.php` | `App\AudPlanAccion` | `aud_plan_acciones` | Explícita | `id_plan_acciones` | Sí |
| `app/AudPrint.php` | `App\AudPrint` | `aud_prints` | Inferida | `id` | Sí |
| `app/AudProgramas.php` | `App\AudProgramas` | `aud_programa` | Explícita | `id_programa` | Sí |
| `app/AudReporte.php` | `App\AudReporte` | `aud_reportes` | Explícita | `id_reporte` | Sí |
| `app/AudReporteEvidencia.php` | `App\AudReporteEvidencia` | `aud_reporte_evidencias` | Inferida | `id` | Sí |
| `app/AudResponsableAcciones.php` | `App\AudResponsableAcciones` | `audresponsable_acciones` | Explícita | `id_responsable` | Sí |
| `app/AudRevisorAcciones.php` | `App\AudRevisorAcciones` | `aud_revisor_acciones` | Explícita | `id_revisor` | Sí |
| `app/AudValidarAgenda.php` | `App\AudValidarAgenda` | `aud_validar_agendas` | Inferida | `id` | Sí |
| `app/CalBitacoraEvaluacionesSumativas.php` | `App\CalBitacoraEvaluacionesSumativas` | `cal_bitacoras_sumativas` | Explícita | `id_bitacora_sumativas` | Sí |
| `app/CalCanalizacion.php` | `App\CalCanalizacion` | `cal_canalizacion` | Explícita | `id` | Sí |
| `app/CargaAcademica.php` | `App\CargaAcademica` | `eva_carga_academica` | Explícita | `id_carga_academica` | Sí |
| `app/Carreras.php` | `App\Carreras` | `gnral_carreras` | Explícita | `id_carrera` | Sí |
| `app/CategoriaAct.php` | `App\CategoriaAct` | `actcomple_categorias` | Explícita | `id_categoria` | Sí |
| `app/DocenteActividad.php` | `App\DocenteActividad` | `actcomple_docente_actividad` | Explícita | `id_docente_actividad` | Sí |
| `app/Estados.php` | `App\Estados` | `gnral_estados` | Explícita | `id_estado` | Sí |
| `app/Eva_calificaciones_pre.php` | `App\Eva_calificaciones_pre` | `eva_calificaciones_pre` | Explícita | `id` | Sí |
| `app/Eva_docente_comentarios.php` | `App\Eva_docente_comentarios` | `eva_docente_comentarios` | Explícita | `id_comentario` | Sí |
| `app/EvaluacionEvidencias.php` | `App\EvaluacionEvidencias` | `actcomple_evaluaciones` | Explícita | `id_evaluacion` | Sí |
| `app/EvidenciaAlumno.php` | `App\EvidenciaAlumno` | `actcomple_evidencias_alumno` | Explícita | `id_evidencia_alumno` | Sí |
| `app/GnralJefeUnidadAdministrativa.php` | `App\GnralJefeUnidadAdministrativa` | `gnral_unidad_personal` | Explícita | `id_unidad_persona` | Sí |
| `app/GnralPersonales.php` | `App\GnralPersonales` | `gnral_personales` | Explícita | `id_personal` | Sí |
| `app/Gnral_Cargos.php` | `App\Gnral_Cargos` | `gnral_cargos` | Explícita | `id_cargo` | Sí |
| `app/Gnral_Horas_Profesores.php` | `App\Gnral_Horas_Profesores` | `gnral_horas_profesores` | Explícita | `id_hrs_profesor` | Sí |
| `app/Gnral_Jefes_Periodos.php` | `App\Gnral_Jefes_Periodos` | `gnral_jefes_periodos` | Explícita | `id_jefe_periodo` | Sí |
| `app/Gnral_Materias.php` | `App\Gnral_Materias` | `gnral_materias` | Explícita | `id_materia` | Sí |
| `app/Gnral_Materias_Perfiles.php` | `App\Gnral_Materias_Perfiles` | `gnral_materias_perfiles` | Explícita | `id_materia_perfil` | Sí |
| `app/Gnral_Perfiles.php` | `App\Gnral_Perfiles` | `gnral_perfiles` | Explícita | `id_perfil` | Sí |
| `app/Gnral_Personales.php` | `App\Gnral_Personales` | `gnral_personales` | Explícita | `id_personal` | Sí |
| `app/Gnral_Reticulas.php` | `App\Gnral_Reticulas` | `gnral_reticulas` | Explícita | `id` | Sí |
| `app/Gnral_Tipos_Usuario.php` | `App\Gnral_Tipos_Usuario` | `gnral_tipos_usuario` | Explícita | `id` | Sí |
| `app/Gnral_escuela_procedencia.php` | `App\Gnral_escuela_procedencia` | `gnral_escuela_procedencia` | Explícita | `id_escuela_procedencia` | Sí |
| `app/Gnral_grupos.php` | `App\Gnral_grupos` | `gnral_grupos` | Explícita | `id_grupo` | Sí |
| `app/Horarios.php` | `App\Horarios` | `gnral_horarios` | Explícita | `id_horario_profesor` | Sí |
| `app/Hrs_Act_Extra_Clases.php` | `App\Hrs_Act_Extra_Clases` | `hrs_act_extra_clases` | Explícita | `id_act_extra_clase` | Sí |
| `app/Hrs_Actividades_Extras.php` | `App\Hrs_Actividades_Extras` | `hrs_actividades_extras` | Explícita | `id_hrs_actividad_extra` | Sí |
| `app/Hrs_Aprobar_Plantilla_Edu.php` | `App\Hrs_Aprobar_Plantilla_Edu` | `hrs_aprobar_plantilla_edu` | Explícita | `id_aprobar_plantilla_edu` | Sí |
| `app/Hrs_Aulas.php` | `App\Hrs_Aulas` | `hrs_aulas` | Explícita | `id_aula` | Sí |
| `app/Hrs_Cargos.php` | `App\Hrs_Cargos` | `gnral_cargos` | Explícita | `id` | Sí |
| `app/Hrs_Distribucion_Horas.php` | `App\Hrs_Distribucion_Horas` | `hrs_distribucion_horas` | Explícita | `id_distribucion_hora` | Sí |
| `app/Hrs_Edificios.php` | `App\Hrs_Edificios` | `hrs_edificios` | Explícita | `id_edificio` | Sí |
| `app/Hrs_Extra_Clase.php` | `App\Hrs_Extra_Clase` | `hrs_extra_clase` | Explícita | `id_extra_clase` | Sí |
| `app/Hrs_Horario_Extra_Clase.php` | `App\Hrs_Horario_Extra_Clase` | `hrs_horario_extra_clase` | Explícita | `id_hr_extra` | Sí |
| `app/Hrs_No_Horas_Docentes.php` | `App\Hrs_No_Horas_Docentes` | `hrs_no_horas_docentes` | Explícita | `id_horas_docente` | Sí |
| `app/Hrs_Personal_Docentes.php` | `App\Hrs_Personal_Docentes` | `hrs_personal_docentes` | Explícita | `id_personal_docente` | Sí |
| `app/Hrs_Rhps.php` | `App\Hrs_Rhps` | `hrs_rhps` | Explícita | `id_rhps` | Sí |
| `app/Hrs_Situaciones.php` | `App\Hrs_Situaciones` | `hrs_situaciones` | Explícita | `id_situacion` | Sí |
| `app/In_voucher_pago.php` | `App\In_voucher_pago` | `in_voucher_pago` | Explícita | `id_voucher` | Sí |
| `app/Inc_solicitude.php` | `App\Inc_solicitude` | `inc_solicitudes` | Inferida | `id` | Sí |
| `app/Incidencias.php` | `App\Incidencias` | `incidencias` | Inferida | `id` | Sí |
| `app/Jefaturas.php` | `App\Jefaturas` | `actcomple_jefaturas` | Explícita | `id` | Sí |
| `app/Models/User.php` | `App\Models\User` | `users` | Inferida | `id` | Sí |
| `app/Municipios.php` | `App\Municipios` | `gnral_municipios` | Explícita | `id_municipio` | Sí |
| `app/Oc_lugar.php` | `App\Oc_lugar` | `oc_lugar` | Explícita | `id_lugar` | Sí |
| `app/PMCodigosMaterial.php` | `App\PMCodigosMaterial` | `pmcodigos_material` | Explícita | `id_codigo` | Sí |
| `app/PMMaterial_Prestamos.php` | `App\PMMaterial_Prestamos` | `pmprestamos_materiales` | Explícita | `id_material` | Sí |
| `app/PMSolicitudMaterial.php` | `App\PMSolicitudMaterial` | `pmsolicitud_material` | Explícita | `id_solicitud` | Sí |
| `app/Paa_Accion.php` | `App\Paa_Accion` | `pa_accion` | Explícita | `id_accion` | Sí |
| `app/Paa_Programa.php` | `App\Paa_Programa` | `pa_programa` | Explícita | `id_programa` | Sí |
| `app/Paa_Subprograma.php` | `App\Paa_Subprograma` | `pa_subprograma` | Explícita | `id_subprograma` | Sí |
| `app/Paa_UnidadMedida.php` | `App\Paa_UnidadMedida` | `pa_unimed` | Explícita | `id_unimed` | Sí |
| `app/Periodos.php` | `App\Periodos` | `gnral_periodos` | Explícita | `id_periodo` | Sí |
| `app/PeriodosCarreras.php` | `App\PeriodosCarreras` | `gnral_periodo_carreras` | Explícita | `id` | Sí |
| `app/Personal.php` | `App\Personal` | `gnral_personales` | Explícita | `id_personal` | Sí |
| `app/RegRiesgo.php` | `App\RegRiesgo` | `ri_registro_riesgo` | Explícita | `id_reg_riesgo` | Sí |
| `app/RegistroAlumnos.php` | `App\RegistroAlumnos` | `actcomple_registro_alumnos` | Explícita | `id_registro_alumno` | Sí |
| `app/RegistroCoordinadores.php` | `App\RegistroCoordinadores` | `actcomple_registros_coordinadores` | Explícita | `id_reg_coordinador` | Sí |
| `app/Resi_Periodo_eval_anteproyecto.php` | `App\Resi_Periodo_eval_anteproyecto` | `resi_periodo_eval_anteproyecto` | Explícita | `id_periodo_eval_anteproyecto` | Sí |
| `app/RmBienes.php` | `App\RmBienes` | `rm_bienes` | Explícita | `id` | Sí |
| `app/RmCategoria.php` | `App\RmCategoria` | `rm_categorias` | Explícita | `id` | Sí |
| `app/RmColores.php` | `App\RmColores` | `rm_colores` | Explícita | `id` | Sí |
| `app/RmEstadouso.php` | `App\RmEstadouso` | `rm_estadousos` | Explícita | `id` | Sí |
| `app/RmMarcas.php` | `App\RmMarcas` | `rm_marcas` | Explícita | `id` | Sí |
| `app/RmModelos.php` | `App\RmModelos` | `rm_modelos` | Explícita | `id` | Sí |
| `app/RmProvedores.php` | `App\RmProvedores` | `rm_provedores` | Explícita | `id` | Sí |
| `app/RmResguardos.php` | `App\RmResguardos` | `rm_resguardos` | Explícita | `id` | Sí |
| `app/RmSectorauxs.php` | `App\RmSectorauxs` | `rm_sectorauxs` | Explícita | `id` | Sí |
| `app/RmTipoadqui.php` | `App\RmTipoadqui` | `rm_tipoadqui` | Explícita | `id` | Sí |
| `app/RmTipobienes.php` | `App\RmTipobienes` | `rm_tipobienes` | Explícita | `id` | Sí |
| `app/Semestres.php` | `App\Semestres` | `gnral_semestres` | Explícita | `id_semestre` | Sí |
| `app/SgcAgenda.php` | `App\SgcAgenda` | `aud_agenda` | Explícita | `id_agenda` | Sí |
| `app/SgcAsignaAudi.php` | `App\SgcAsignaAudi` | `aud_asigna_audi` | Explícita | `id_asigna_audi` | Sí |
| `app/SgcAsignaEntrena.php` | `App\SgcAsignaEntrena` | `aud_asigna_audi` | Explícita | `id_asigna_audi` | Sí |
| `app/SgcAsignaEquipo.php` | `App\SgcAsignaEquipo` | `aud_asigna_audi` | Explícita | `id_asigna_audi` | Sí |
| `app/SgcAsignaLider.php` | `App\SgcAsignaLider` | `aud_asigna_audi` | Explícita | `id_asigna_audi` | Sí |
| `app/SgcAuditorias.php` | `App\SgcAuditorias` | `aud_auditoria` | Explícita | `id_auditoria` | Sí |
| `app/SgcClasificacion.php` | `App\SgcClasificacion` | `aud_clasificacion` | Explícita | `id_clasificacion` | Sí |
| `app/SgcDetallePlan.php` | `App\SgcDetallePlan` | `sgc_detalle_plans` | Inferida | `id` | Sí |
| `app/SgcNormAuditoria.php` | `App\SgcNormAuditoria` | `aud_normatividad_auditoria` | Explícita | `id_normatividad_auditoria` | Sí |
| `app/SgcNormatividad.php` | `App\SgcNormatividad` | `aud_normatividad` | Explícita | `id_normatividad` | Sí |
| `app/SgcNotas.php` | `App\SgcNotas` | `aud_notas` | Explícita | `id_notas` | Sí |
| `app/SgcObjetivos.php` | `App\SgcObjetivos` | `aud_objetivo` | Explícita | `id_objetivo` | Sí |
| `app/SgcPersonasAuditoria.php` | `App\SgcPersonasAuditoria` | `aud_personas_auditoria` | Explícita | `id_personas_auditoria` | Sí |
| `app/SgcProcesoAgenda.php` | `App\SgcProcesoAgenda` | `aud_procesos_agenda` | Explícita | `id_aud_procesos_agenda` | Sí |
| `app/SgcPrograma.php` | `App\SgcPrograma` | `aud_programa` | Explícita | `id_programa` | Sí |
| `app/SgcReporteAuditoria.php` | `App\SgcReporteAuditoria` | `aud_informe` | Explícita | `id_informe` | Sí |
| `app/SgcReportes.php` | `App\SgcReportes` | `aud_reportes` | Explícita | `id_reporte` | Sí |
| `app/SgcValidaciones.php` | `App\SgcValidaciones` | `sgc_validaciones` | Inferida | `id` | Sí |
| `app/Tutor.php` | `App\Tutor` | `eva_tutor` | Explícita | `id_tutor` | Sí |
| `app/Tutorias_AsignaCoordinador.php` | `App\Tutorias_AsignaCoordinador` | `tutorias__asigna_coordinadors` | Inferida | `id` | Sí |
| `app/Tutorias_AsignaExpediente.php` | `App\Tutorias_AsignaExpediente` | `tutorias__asigna_expedientes` | Inferida | `id` | Sí |
| `app/Tutorias_AsignaGeneracion.php` | `App\Tutorias_AsignaGeneracion` | `tutorias__asigna_generacions` | Inferida | `id` | Sí |
| `app/Tutorias_AsignaTutor.php` | `App\Tutorias_AsignaTutor` | `tutorias__asigna_tutors` | Inferida | `id` | Sí |
| `app/Tutorias_Canalizacion.php` | `App\Tutorias_Canalizacion` | `canalizacion` | Explícita | `id_canalizacion` | Sí |
| `app/Tutorias_Desarrollo_asigna_coordinador_general.php` | `App\Tutorias_Desarrollo_asigna_coordinador_general` | `desarrollo_asigna_coordinador_general` | Explícita | `id_asigna_coordinador_general` | Sí |
| `app/Tutorias_Exp_antecedentes_academico.php` | `App\Tutorias_Exp_antecedentes_academico` | `exp_antecedentes_academicos` | Explícita | `id_exp_antecedentes_academicos` | Sí |
| `app/Tutorias_Exp_area_psicopedagogica.php` | `App\Tutorias_Exp_area_psicopedagogica` | `exp_area_psicopedagogica` | Explícita | `id_exp_area_psicopedagogica` | Sí |
| `app/Tutorias_Exp_asigna_alumnos.php` | `App\Tutorias_Exp_asigna_alumnos` | `exp_asigna_alumnos` | Explícita | `id_asigna_alumno` | Sí |
| `app/Tutorias_Exp_asigna_coordinador.php` | `App\Tutorias_Exp_asigna_coordinador` | `exp_asigna_coordinador` | Explícita | `id_asigna_coordinador` | Sí |
| `app/Exp_asigna_expediente.php` | `App\Exp_asigna_expediente` | `exp_asigna_expediente` | Explícita | `id_asigna_expediente` | No |
| `app/Tutorias_Exp_asigna_generacion.php` | `App\Tutorias_Exp_asigna_generacion` | `exp_asigna_generacion` | Explícita | `id_asigna_generacion` | Sí |
| `app/Tutorias_Exp_asigna_tutor.php` | `App\Tutorias_Exp_asigna_tutor` | `exp_asigna_tutor` | Explícita | `id_asigna_tutor` | Sí |
| `app/Tutorias_Exp_bachillerato.php` | `App\Tutorias_Exp_bachillerato` | `exp_bachillerato` | Explícita | `id_bachillerato` | Sí |
| `app/Tutorias_Exp_bebidas.php` | `App\Tutorias_Exp_bebidas` | `exp_bebidas` | Explícita | `id_expbebida` | Sí |
| `app/Tutorias_Exp_beca.php` | `App\Tutorias_Exp_beca` | `exp_beca` | Explícita | `id_expbeca` | Sí |
| `app/Tutorias_Exp_civil_estado.php` | `App\Tutorias_Exp_civil_estado` | `exp_civil_estados` | Explícita | `id_estado_civil` | Sí |
| `app/Tutorias_Exp_datos_familiare.php` | `App\Tutorias_Exp_datos_familiare` | `exp_datos_familiares` | Explícita | `id_exp_datos_familiares` | Sí |
| `app/Tutorias_Exp_escalas.php` | `App\Tutorias_Exp_escalas` | `exp_escalas` | Explícita | `id_escala` | No |
| `app/Tutorias_Exp_familia_union.php` | `App\Tutorias_Exp_familia_union` | `exp_familia_union` | Explícita | `id_familia_union` | Sí |
| `app/Tutorias_Exp_formacion_integral.php` | `App\Tutorias_Exp_formacion_integral` | `exp_formacion_integral` | Explícita | `id_exp_formacion_integral` | Sí |
| `app/Tutorias_Exp_generacion.php` | `App\Tutorias_Exp_generacion` | `exp_generacion` | Explícita | `id_generacion` | Sí |
| `app/Tutorias_Exp_generale.php` | `App\Tutorias_Exp_generale` | `exp_generales` | Explícita | `id_exp_general` | Sí |
| `app/Tutorias_Exp_habitos_estudio.php` | `App\Tutorias_Exp_habitos_estudio` | `exp_habitos_estudio` | Explícita | `id_exp_habitos_estudio` | Sí |
| `app/Tutorias_Exp_opc_intelectual.php` | `App\Tutorias_Exp_opc_intelectual` | `exp_opc_intelectual` | Explícita | `id_opc_intelectual` | Sí |
| `app/Tutorias_Exp_opc_nivel_socio.php` | `App\Tutorias_Exp_opc_nivel_socio` | `exp_opc_nivel_socio` | Explícita | `id_nivel_economico` | Sí |
| `app/Tutorias_Exp_opc_tiempo.php` | `App\Tutorias_Exp_opc_tiempo` | `exp_opc_tiempo` | Explícita | `id_opc_tiempo` | Sí |
| `app/Tutorias_Exp_opc_vives.php` | `App\Tutorias_Exp_opc_vives` | `exp_opc_vives` | Explícita | `id_opc_vives` | Sí |
| `app/Tutorias_Exp_parentesco.php` | `App\Tutorias_Exp_parentesco` | `exp_parentescos` | Explícita | `id_parentesco` | No |
| `app/Tutorias_Exp_tiempoestudia.php` | `App\Tutorias_Exp_tiempoestudia` | `exp_tiempoestudia` | Explícita | `id_tiempoestudia` | Sí |
| `app/Tutorias_Exp_turno.php` | `App\Tutorias_Exp_turno` | `exp_turno` | Explícita | `id_turno` | Sí |
| `app/Tutorias_Plan_actividades.php` | `App\Tutorias_Plan_actividades` | `plan_actividades` | Explícita | `id_plan_actividad` | Sí |
| `app/Tutorias_Plan_asigna_evidencias.php` | `App\Tutorias_Plan_asigna_evidencias` | `plan_asigna_evidencias` | Explícita | `id_evidencia` | No |
| `app/Tutorias_Plan_asigna_planeacion_actividad.php` | `App\Tutorias_Plan_asigna_planeacion_actividad` | `plan_asigna_planeacion_actividad` | Explícita | `id_asigna_planeacion_actividad` | Sí |
| `app/Tutorias_Plan_asigna_planeacion_tutor.php` | `App\Tutorias_Plan_asigna_planeacion_tutor` | `plan_asigna_planeacion_tutor` | Explícita | `id_asigna_planeacion_tutor` | Sí |
| `app/Tutorias_Planeacion.php` | `App\Tutorias_Planeacion` | `planeacion` | Explícita | `id_planeacion` | No |
| `app/Tutorias_Profesor.php` | `App\Tutorias_Profesor` | `tutorias__profesors` | Inferida | `id` | Sí |
| `app/Tutorias_Reporte_tutor.php` | `App\Tutorias_Reporte_tutor` | `reporte_tutor` | Explícita | `id_reporte_tutor` | No |
| `app/Tutorias_areas_canalizacion.php` | `App\Tutorias_areas_canalizacion` | `areas_canalizacion` | Explícita | `id_area` | Sí |
| `app/Tutorias_asigna_tutor.php` | `App\Tutorias_asigna_tutor` | `asigna_tutor` | Explícita | `id_asigna_tutor` | Sí |
| `app/Tutorias_eventos.php` | `App\Tutorias_eventos` | `eventos` | Explícita | `id_evento` | No |
| `app/Tutorias_subareas_canalizacion.php` | `App\Tutorias_subareas_canalizacion` | `subareas_canalizacion` | Explícita | `id_subarea` | Sí |
| `app/User.php` | `App\User` | `users` | Explícita | `id` | Sí |
| `app/ValidacionCarga.php` | `App\ValidacionCarga` | `eva_validacion_de_cargas` | Explícita | `id` | Sí |
| `app/adscripcion_personal.php` | `App\adscripcion_personal` | `adscripcion_personal` | Explícita | `id_adscripcion` | Sí |
| `app/alumno_materias.php` | `App\alumno_materias` | `eva_alumno_materias` | Explícita | `id` | Sí |
| `app/amb_encargados.php` | `App\amb_encargados` | `amb_encargados` | Explícita | `id_encargado` | Sí |
| `app/amb_periodo_amb.php` | `App\amb_periodo_amb` | `amb_periodo_amb` | Explícita | `id_periodo_amb` | Sí |
| `app/amb_procedimientos.php` | `App\amb_procedimientos` | `amb_procedimientos` | Explícita | `id_procedimiento` | Sí |
| `app/audParseCase.php` | `App\audParseCase` | `aud_parse_cases` | Inferida | `id` | Sí |
| `app/audreportes.php` | `App\audreportes` | `audreportes` | Inferida | `id` | Sí |
| `app/calBitacoraEvaluaciones.php` | `App\calBitacoraEvaluaciones` | `cal_bitacora_evaluaciones` | Explícita | `id_bitacora_eval` | Sí |
| `app/calBitacoraPeriodos.php` | `App\calBitacoraPeriodos` | `cal_bitacora_periodos` | Explícita | `id_bitacora_periodo` | Sí |
| `app/calEvaluaciones.php` | `App\calEvaluaciones` | `cal_evaluaciones` | Explícita | `id_evaluacion` | Sí |
| `app/calPeriodos.php` | `App\calPeriodos` | `cal_periodos_califica` | Explícita | `id_periodo_cal` | Sí |
| `app/calperiodosSumativas.php` | `App\calperiodosSumativas` | `cal_periodos_sumativas` | Explícita | `id_periodo_sum` | Sí |
| `app/gnral_unidad_administrativa.php` | `App\gnral_unidad_administrativa` | `gnral_unidad_administrativa` | Explícita | `id_unidad_admin` | Sí |
| `app/in_nivel_ingles.php` | `App\in_nivel_ingles` | `in_nivel_ingles` | Explícita | `id_nivel_ingles` | Sí |
| `app/in_profesores_ingles.php` | `App\in_profesores_ingles` | `in_profesores_ingles` | Explícita | `id_profesores` | Sí |
| `app/in_sexo.php` | `App\in_sexo` | `in_sexo` | Explícita | `id_sexo` | Sí |
| `app/in_titulo.php` | `App\in_titulo` | `in_titulo` | Explícita | `id_titulo` | Sí |
| `app/oc_dependencias.php` | `App\oc_dependencias` | `oc_depend_domicilio` | Explícita | `id_depend_domicilio` | Sí |
| `app/oc_notificacion.php` | `App\oc_notificacion` | `oc_estado_oficio` | Explícita | `id_notificacion` | Sí |
| `app/oc_oficio.php` | `App\oc_oficio` | `oc_oficio` | Explícita | `id_oficio` | Sí |
| `app/oc_oficio_personal.php` | `App\oc_oficio_personal` | `oc_oficio_personal` | Explícita | `id_oficio_personal` | Sí |
| `app/oc_oficio_vehiculo.php` | `App\oc_oficio_vehiculo` | `oc_oficio_vehiculo` | Explícita | `id_oficio_vehiculo` | Sí |
| `app/oc_vehiculo.php` | `App\oc_vehiculo` | `oc_vehiculo` | Explícita | `id_vehiculo` | Sí |
| `app/riEstrategia.php` | `App\riEstrategia` | `ri_estrategia` | Explícita | `id_estrategia` | Sí |
| `app/ri_clasif_factor.php` | `App\ri_clasif_factor` | `ri_clasif_factor` | Explícita | `id_cl_f` | Sí |
| `app/ri_clasif_r.php` | `App\ri_clasif_r` | `ri_clasif_r` | Explícita | `id_cl_r` | Sí |
| `app/ri_estrategia_accion.php` | `App\ri_estrategia_accion` | `ri_estrategia_accion` | Explícita | `id_estrategia_a` | Sí |
| `app/ri_estrategia_riesgo.php` | `App\ri_estrategia_riesgo` | `ri_estrategia_riesgo` | Explícita | `id_estrategia_r` | Sí |
| `app/ri_evaluacion_control.php` | `App\ri_evaluacion_control` | `ri_evaluacion_control` | Explícita | `id_evaluacion` | Sí |
| `app/ri_factores.php` | `App\ri_factores` | `ri_factores` | Explícita | `id_factor` | Sí |
| `app/ri_nivel_decision.php` | `App\ri_nivel_decision` | `ri_nivel_decision` | Explícita | `id_nivel_de` | Sí |
| `app/ri_o_calificacion.php` | `App\ri_o_calificacion` | `ri_o_calificacion` | Explícita | `id_calificacion` | Sí |
| `app/ri_o_mejoracliente.php` | `App\ri_o_mejoracliente` | `ri_o_mejoracliente` | Explícita | `id_mejoracliente` | Sí |
| `app/ri_o_mejorareputacion.php` | `App\ri_o_mejorareputacion` | `ri_o_mejorareputacion` | Explícita | `id_mejorareputacion` | Sí |
| `app/ri_o_mejorasgc.php` | `App\ri_o_mejorasgc` | `ri_o_mejorasgc` | Explícita | `id_mejorasgc` | Sí |
| `app/ri_o_ocurrenciasp.php` | `App\ri_o_ocurrenciasp` | `ri_o_ocurrenciasp` | Explícita | `id_ocurrenciap` | Sí |
| `app/ri_o_planseguimiento.php` | `App\ri_o_planseguimiento` | `ri_o_planseguimiento` | Explícita | `id_planseguimiento` | Sí |
| `app/ri_o_potencialapertura.php` | `App\ri_o_potencialapertura` | `ri_o_potencialapertura` | Explícita | `id_potencialapertura` | Sí |
| `app/ri_o_potencialcosto.php` | `App\ri_o_potencialcosto` | `ri_o_potencialcosto` | Explícita | `id_potencialcosto` | Sí |
| `app/ri_o_potencialcrecimiento.php` | `App\ri_o_potencialcrecimiento` | `ri_o_potencialcrecimiento` | Explícita | `id_potencialcrecimiento` | Sí |
| `app/ri_o_probabilidad.php` | `App\ri_o_probabilidad` | `ri_o_probabilidad` | Explícita | `id_probabilidad` | Sí |
| `app/ri_partes.php` | `App\ri_partes` | `ri_partes` | Explícita | `id_parte` | Sí |
| `app/ri_proceso.php` | `App\ri_proceso` | `ri_proceso` | Explícita | `id_proceso` | Sí |
| `app/ri_proceso_unidad.php` | `App\ri_proceso_unidad` | `ri_proceso_unidad` | Explícita | `id_proceso_unidad` | Sí |
| `app/ri_reg_oportunidad.php` | `App\ri_reg_oportunidad` | `ri__reg_oportunidad` | Explícita | `id_oportunidad` | Sí |
| `app/ri_requisitos.php` | `App\ri_requisitos` | `ri_requisitos` | Explícita | `id_requisito` | Sí |
| `app/ri_riesgo.php` | `App\ri_riesgo` | `ri_riesgo` | Explícita | `id_riesgo` | Sí |
| `app/ri_sistema.php` | `App\ri_sistema` | `ri_sistema` | Explícita | `id_sistema` | Sí |
| `app/ri_tipo_eva.php` | `App\ri_tipo_eva` | `ri_tipo_eva` | Explícita | `id_tipo_eva` | Sí |
| `app/ri_unidad_parte.php` | `App\ri_unidad_parte` | `ri_unidad_parte` | Explícita | `id_uni_p` | Sí |
| `app/ri_valoracion_efecto.php` | `App\ri_valoracion_efecto` | `ri_valoracion_efectos` | Explícita | `id_val_efecto` | Sí |
| `app/riseleccion.php` | `App\riseleccion` | `ri_seleccion` | Explícita | `id_seleccion` | Sí |
| `app/ritipo_f.php` | `App\ritipo_f` | `ri_tipo_f` | Explícita | `id_tipo_f` | Sí |
| `app/serv_datos_alumnos.php` | `App\serv_datos_alumnos` | `serv_datos_alumnos` | Explícita | `id_datos_alumnos` | Sí |
| `app/serv_doc_empresa_privada.php` | `App\serv_doc_empresa_privada` | `serv_doc_empresa_privada` | Explícita | `id_empresa_privada` | Sí |
| `app/serv_doc_empresa_publica.php` | `App\serv_doc_empresa_publica` | `serv_doc_empresa_publica` | Explícita | `id_empresa_publica` | Sí |
| `app/serv_estado_documentacion.php` | `App\serv_estado_documentacion` | `serv_estado_documentacion` | Explícita | `id_estado_documentacion` | Sí |
| `app/serv_tipo_empresa.php` | `App\serv_tipo_empresa` | `serv_tipo_empresa` | Explícita | `id_tipo_empresa` | Sí |
