> Actualización posterior: se recibieron resultados reales de diez tablas y se aplicaron ajustes documentados en [timestamps verificados](timestamps-verificados.md). Las referencias a resultados faltantes de este documento describen el estado anterior.

# Criterios y reclasificación de evidencias de modelos

12 de noviembre de 2026. Rama codex/auditoria-modelos-laravel12.

Los seeders generados con IA y datos ficticios no son fuente de verdad. Se corrigió el informe principal y la continuación de claves para retirar las listas de 43 timestamps y 17 relaciones sustentadas solo por esos archivos. No equivalen a defectos comprobados. Las ocho claves primarias verificadas en information_schema se conservan íntegramente.

| Estado | Evidencia | Decisión |
| --- | --- | --- |
| Confirmado y corregido | Ocho claves verificadas en MariaDB, comunicadas por el usuario | Conservar commit c23c384 y su fixture |
| Confirmado y corregido | Fallos de autoload/imports reproducidos con PHP y Composer | Conservar correcciones previas |
| Sin confirmación de columnas disponible en el chat | Timestamps por tabla | No afirmar presencia/ausencia ni modificarlos; solicitar resultados ya verificados |
| Indicio de comportamiento histórico | OR sin agrupar y clave local inferida en oc_oficio_personal::notificacion | No modificar; contrastar uso original y esquema real |
| Diferencia entre versiones | App\User y App\Models\User | Mantener contratos; revisar flujos antes de unificar |
| Evidencia descartada | Omisiones o nombres en registros de seeders ficticios | No usarlos para inferir estructura ni justificar cambios |

Comparación histórica realizada sin ejecutar el sistema antiguo: copia local de DorianReb/tesvb, commit 36da4037a7dd478d90a5e61e3cef48b8f7e505b1, que declara Laravel 5.6. Sobre los 241 modelos actuales, 219 coinciden al normalizar saltos de línea; 21 difieren únicamente en imports/primaryKey (comparación adicional omitiendo esas declaraciones y espacios). Se contempló el renombrado de Exp_asigna_expediente. App/Models/User es adicional. Esta referencia no fue confirmada como revisión exacta del despliegue original.

Se consultaron consumidores actuales: PMSolicitudMaterial::jefaturas infiere la clave confirmada id_jefatura; las vistas de actividades complementarias consumen id_jefatura. Los consumidores de bebidas usan id_expbebidas. En IncidenciasController las referencias antiguas al atributo id después de crear solicitudes están comentadas. Estas comprobaciones respaldan conservar las ocho correcciones y no justifican alterar otros comportamientos.

La prueba de compatibilidad existente sigue siendo una prueba de carga, configuración y generación de SQL sin conexión; su fixture no describe un esquema físico verificado por completo. Los resultados previos de 3 pruebas y 2,835 aserciones corresponden al commit de claves. No se repitieron pruebas de ejecución en esta revisión exclusivamente documental.

Validación de esta continuación: comparación estática del código histórico y consumidores, diff limitado a documentación y git diff --check. No se modificaron modelos, tests, configuración, controladores ni relaciones; no se ejecutaron consultas, migraciones, seeders ni escrituras en MariaDB. Sin merge ni push.
