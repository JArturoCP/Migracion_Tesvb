# Claves primarias verificadas — continuación de auditoría

12 de noviembre de 2026. Rama codex/auditoria-modelos-laravel12.
La verificación de MariaDB mediante information_schema.KEY_COLUMN_USAGE fue proporcionada por el usuario; no se repitió ni se ejecutaron consultas en esta continuación.

Se actualiza exclusivamente primaryKey en los ocho modelos solicitados:

| Modelo | Clave confirmada |
| --- | --- |
| alumno_materias | id_alumno_materia |
| Gnral_Reticulas | id_reticula |
| Gnral_Tipos_Usuario | id_tipo_usuario |
| Hrs_Cargos | id_cargo |
| Inc_solicitude | id_solicitud |
| Jefaturas | id_jefatura |
| PeriodosCarreras | id_periodo_carrera |
| Tutorias_Exp_bebidas | id_expbebidas |

Esto resuelve los ocho candidatos de claves del informe anterior. Su inventario y fixture describían el estado previo; la fixture de regresión ahora contiene las claves confirmadas. No se alteran otras propiedades ni relaciones.

Consumidores revisados: las altas de alumno_materias y Gnral_Reticulas no consumen un atributo id generado; el SQL existente utiliza id_alumno_materia e id_reticula. Las diez lecturas de $id_solicitud->id de IncidenciasController están comentadas (comprobado con tokenización PHP). Las vistas de actividades complementarias usan id_jefatura. PMSolicitudMaterial::jefaturas infiere ahora correctamente id_jefatura como owner key; se añadió una aserción específica sin modificar esa relación. Las vistas de tutorías y Tutorias_Exp_formacion_integral::escala usan id_expbebidas; también se verifica su foreign key. No se encontraron consumidores activos incompatibles en la revisión estática. Esto no sustituye pruebas funcionales sobre datos reales.

Validación: pruebas aisladas PHPUnit con PHP 8.4.27: tres casos, 2,835 aserciones; carga de 241 modelos y construcción de 153 relaciones sin conexión. Sintaxis de los ocho modelos y del test modificado comprobada con php -l. git diff --check sin errores.

Comando reproducible: php tests/run-eloquent-compatibility.php (PHP 8.4).

Los pendientes de timestamps y restantes relaciones del informe anterior continúan abiertos; la observación de PMSolicitudMaterial::jefaturas queda resuelta. No se ejecutaron migraciones, seeders ni pruebas Feature. No se modificaron controladores, tablas ni .env; sin merge ni push.
