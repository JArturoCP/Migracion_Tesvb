# Inventario completo del menú principal (todos los roles)

Fuente: `resources/views/partials/menu_admin.blade.php` (2 643 líneas, rama `cacique`, sin cambios desde el commit `067d959`).
Fecha: 2026-11-17. Sustituye y amplía `docs/INVENTARIO_DIRECTIVO.md`: ese documento sigue siendo válido y sus números (#1-#166) aparecen aquí en la columna **#Dir**.

Este inventario es la **lista de control** de `app/Menus/MenuPrincipal.php`. Cada fila debe existir allí con la misma URL, el mismo método y la **misma condición, sin reinterpretarla**. La prueba de comparación de enlaces (Fase 4) se basa en esta tabla.

## Cómo se generó

Para no depender de una revisión a mano, el inventario se extrajo con tres scripts de solo lectura (guardados fuera del repositorio):

1. **Condiciones:** se quitan los comentarios Blade `{{-- --}}` y HTML `<!-- -->` y se recorre cada `@if / @elseif / @else / @endif`, incluidas las condiciones multilínea. A cada enlace se le asigna la **pila completa** de condiciones que lo envuelven (de afuera hacia adentro). `NOT (…)` indica la rama `@else`.
2. **Etiquetas:** se sigue la anidación de `<ul>` para obtener el texto del enlace y el de los menús desplegables que lo contienen (`Módulo › Submenú`).
3. **Validación:** cada URL se compara con `php artisan route:list --json` (2 915 rutas), incluidos los parámetros opcionales `{x?}`.

Se comprobó que las 326 filas tienen sección asignada, que la numeración M001-M326 es continua y que las 164 filas que corresponden al directivo coinciden una a una con #1-#166 (los 2 restantes, #1 y #62, son íconos de periodo y no enlaces).

**Corrección respecto de la Fase 1:** en la Fase 1 se contaron 335 `href`/`action` en todo el archivo. Esa cifra incluía **8 enlaces dentro de comentarios HTML** `<!-- -->`, que el usuario nunca ve (L865 "buscar_alumnos", L878-881 "Armar Horarios / Ver Horarios Grupos / Ver Horarios Aulas / Profesores Materias" de jefes, L935 y L941 "Indice Reprobación", L1182 "indices_repro_prof"), y **1 `action`** del formulario oculto de logout (L438, que forma parte de M002). 335 − 8 − 1 = **326 elementos**. Por lo mismo, de los "5 enlaces rotos" señalados en la Fase 1, L935 y L941 están comentados, L949 y L1114 sí tienen ruta (`{id_carrera}/docentes` y el parámetro opcional `bitacora_def_temp/{id_carrera?}`) y solo L1202 (M112, oculto) no la tiene. Ninguna de las 166 entradas del directivo cambia.

## Base de datos

**[No confirmado] — MySQL no responde.** El servicio escucha en el puerto 3306, pero rechaza las conexiones durante el handshake (`ERROR 2013 … reading initial communication packet`). En `mysql_error.log` la última línea es "Server socket created" (14:28:55), sin "ready for connections", y hay errores de tablespace en otra base (`microseed_control_test`). No se intervino el servidor. Consultas pendientes (solo lectura), listas para ejecutarse:

```sql
-- Unidades de los directivos
SELECT p.id_personal, p.tipo_usuario AS users_id, up.id_unidad_admin, ua.nom_departamento
FROM gnral_personales p
LEFT JOIN gnral_unidad_personal up ON up.id_personal = p.id_personal
LEFT JOIN gnral_unidad_administrativa ua ON ua.id_unidad_admin = up.id_unidad_admin
WHERE p.id_departamento = 1;

-- Personal por departamento y unidad (para elegir usuarios de prueba por rol y variante)
SELECT p.id_departamento, up.id_unidad_admin, COUNT(*) n
FROM gnral_personales p LEFT JOIN gnral_unidad_personal up ON up.id_personal = p.id_personal
GROUP BY p.id_departamento, up.id_unidad_admin ORDER BY 1, 2;

-- Catálogos reales
SELECT * FROM gnral_tipos_usuario;
SELECT id_departamento, nombre_departamento FROM gnral_departamentos ORDER BY 1;
SELECT id_unidad_admin, nom_departamento FROM gnral_unidad_administrativa ORDER BY 1;
SELECT tipo_usuario, COUNT(*) FROM users GROUP BY 1;
```

## Banderas de sesión y variables del menú

Todas salen de `HomeController@index` (sin cambios) o se calculan dentro de la vista del menú. `MenuPrincipal` las leerá a través de `ContextoMenu` **con la misma lógica**.

| Variable en `menu_admin` | Origen | Quién la tiene |
|---|---|---|
| `$palumno` | `session()->has('palumno')` | Alumno (`tipo_usuario = 1`, con ficha e `info_ok`) — `HomeController.php:121-283` |
| `$profesor_conact` | `has('profesor_conact')` | Personal depto 0 con actividad extra-clase en el periodo — `:411-503` |
| `$profesor_sinact` | `has('profesor_sinact')` | Personal depto 0 sin actividad — `:505-526` |
| `$directivo` | `has('directivo')` (se guarda como `directivo.`; la notación de punto hace que `has` dé `true`) | Depto 1 — `:533-541` |
| `$jefe_division` | `has('jefe_division')` | Depto 2 con registro en `gnral_jefes_periodos`; **también** Desarrollo académico — `:405-409, :543-607` |
| `$consultas` | `has('consultas')` | Depto 3 — `:589-597` |
| `$desa` | `has('desa')` | Depto 4, o depto 2 con correo `des.academico@vbravo.tecnm.mx` — `:405-409, :599-607` |
| `$escolar` | `has('escolar')` | Depto 5 — `:610-616` |
| `$jefe_personal` | `has('personal')` | Depto 6 (RH) — `:619-625` |
| `$jefe_computo` | `has('computo')` | Depto 7 — `:628-634` |
| `$jefe_residencia` | `has('residencia')` | Depto 8 — `:637-643` |
| `$departamento_titulacion` | `has('titulacion')` | Depto 9 — `:646-652` |
| `$direccion_finanzas` | `has('finanzas')` | Depto 10 — `:655-662` |
| `$profesor_ingles` | `has('profesor_ingles')` | `tipo_usuario = 3` con ficha — `:671-705` |
| `$personal_tesvb` | `Session::get('personal_tesvb')` (L2124) | Todo el personal con ficha (`tipo = 2`) — `:327` |
| `$tipo_p` | `Session::get('tipo_persona')` (L639, L1843) | 1 alumno, 2 personal, 3 inglés |
| `$id_unidad_admin` | `has('id_unidad_admin')` (**booleano**) | Personal con fila en `gnral_unidad_personal` — `:375-377` |
| `$unidad` | `Session::get('id_unidad_admin')` (**número**; L295 y L2410) | igual |
| `$id_per` | `Session::get('usuario_alumno')` = `users.id` (L1490, L1697) | todos |
| `$equipo_auditor` | `has('isAuditor')` | Auditor de una auditoría próxima o en curso — `:291-305` |
| `$revisor`, `$seguimiento_asesor`, `$personal_academia` | `has(...)` | Según `resi_revisores`, `resi_asesores`, `resi_academia` — `:345-372` |
| `$encargado_ambiental` | `Session::get('encargado_ambiental')` (L1510) | Según `amb_encargados` — `:380-387` |
| `$ver_eva`, `$ver_carga`, `$semestre`, `registrar_residencia`, `anteproyecto_aceptado`, `registro_empresa`, `estado_reg_anteproyecto`, `seguimiento_alumno`, `reg_alum_ti`, `ti_segunda_etapa`, `ti_tercera_parte`, `estado_cuenta` | sesión | Alumno — `:121-283` |
| `$cambio_c`, `$carreras` | `Session::get('cambio_carreras'/'carreras')` | Jefe de división con 2 carreras — `:557-572` |
| `$id_carrera` | `Session::get('id_carrera')`; **en el bloque del docente con actividad la vista lo recalcula y lo guarda en la sesión** (L447-462) | varios |
| `$es_tutor_reprobacion_menu` | consulta en la vista (L33-93): `exp_asigna_tutor` en el periodo vigente | cualquier usuario con registro en `gnral_personales` |
| `$es_responsable_area_atencion_menu` | consulta en la vista (L101-146): `ar_area_responsables_periodo` + `ar_areas_atencion` activos | igual |
| `$es_alumno_piase_menu` | consulta en la vista (L123-145): `ar_casos_estudiantes` + `ar_caso_canalizaciones` | alumno con canalización |
| `$es_auditor_lider_sgoe_menu`, `$es_auditor_responsable_sgoe_menu`, `$es_lider_acciones_sgoe_menu`, `$puede_ver_seguimiento_auditorias_menu` | consulta en la vista (L161-290): `aud_auditores`, `aud_lider_acciones`, `aud_seguimiento_auditorias`; resuelve el personal por `id_perso`, `tipo_usuario` **o correo** | cualquier usuario |
| `$docente` (`estado_docente_inv`) | consulta en la vista (L556-563): `gnral_personales` por `id_perso` | personal |
| `$carrera` (alumno) | consulta en la vista (L1896-1901): carrera del alumno | alumno |

## Matriz rol → secciones del inventario

"✓" = la sección aplica al rol; las filas siguen condicionadas por su columna "Condición". "var." = depende de datos (unidad, BD o ids fijos).

| Rol (cómo se detecta) | 1 Glob. | 2 Alum. | 3 Doc. c/act | 4 Doc. s/act | 5 Jefe div. | 6 Desa | 7 Dir/Cons | 8 Esc/Dir | 9 RH | 10 Cómp. | 11 Resi. | 12 Titul. | 13 Finanz. | 14 Inglés | 15 Personal | 16 Unidad | 17 BD/ids |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Alumno (`palumno`) | ✓ | ✓ | | | | | | | | | | | | | | | var. (PIASE alumno) |
| Docente con actividad (`profesor_conact`) | ✓ | | ✓ | | | | | | | | | | | | ✓ | var. | var. |
| Docente sin actividad (`profesor_sinact`) | ✓ | | | ✓ | | | | | | | | | | | ✓ | var. | var. |
| Jefe de división (`jefe_division`, sin `desa`) | ✓ | | | | ✓ | | | | | | | | | | ✓ | var. | var. |
| Desarrollo académico (`desa` + `jefe_division`) | ✓ | | | solo M014 | ✓ | ✓ | | | | | | | | | ✓ | var. | ✓ (PIASE) |
| Directivo (`directivo`) | ✓ | | | | | | ✓ | ✓ | | | | | | | ✓ | ✓ (M171-174 siempre) | var. |
| Planeación y Consultas (`consultas`) | ✓ | | | | | | ✓ | | | | | | | | ✓ | var. | var. |
| Servicios Escolares (`escolar`) | ✓ | | | | | | | ✓ | | | | | | | ✓ | ✓ (Adeudos siempre) | var. |
| Recursos Humanos (`personal`) | ✓ | | | | | | | | ✓ | | | | | | ✓ | var. | var. |
| Centro de Cómputo (`computo`) | ✓ | | | | | | | | | ✓ | | | | | ✓ | var. | var. |
| Residencias (`residencia`) | ✓ | | | | | | | | | | ✓ | | | | ✓ | var. | var. |
| Titulación (`titulacion`) | ✓ | | | | | | | | | | | ✓ | | | ✓ | var. | var. |
| Finanzas (`finanzas`) | ✓ | | | | | | | | | | | | ✓ | | ✓ | var. | var. |
| Profesor de inglés (`profesor_ingles`) | ✓ | | | | | | | | | | | | | ✓ | | | |

Notas:
- Las secciones 15-17 se **suman** al rol base. Por ejemplo, un docente con unidad 26 que además es auditor ve las secciones 3, 15, 16 y 17.
- Las consultas SGOE (sección 15) resuelven el personal también **por correo**, así que en teoría un usuario no personal cuyo correo coincida con un `gnral_personales.correo` también podría verlas. Se conserva igual.
- **Quién llega realmente a `/inicio`:** alumno con ficha, todo el personal con ficha y departamento 0-10. No llegan: `tipo_usuario = 0` (logout), alumno sin datos (→ `datos_alumno`), personal sin ficha (→ `/docentes/create`), personal depto 0 con `permiso = 6` (vista de mensajes), profesor de inglés (→ `/ingles`, layout propio) y personal con departamento > 10 o nulo (respuesta vacía o error, ver `docs/ANALISIS_SISTEMA.md` §9.2).

## Elementos que no son enlaces

| Elemento | Línea | Condición | Destino en el nuevo diseño |
|---|---|---|---|
| Insignia "nombre · nombre_carrera · periodo" | 348-354 | `jefe_division \|\| consultas` | Bienvenida y menú de usuario |
| Insignia "nombre_ingles · nombre_periodo_ingles" | 357-365 | `profesor_ingles` | Bienvenida y menú de usuario |
| Insignia "nombre · periodo" | 366-369 | resto | Bienvenida y menú de usuario |
| Ícono de periodo (abre `partials/periodos`) | 396-408 | `profesor_conact \|\| jefe_division \|\| directivo \|\| desa \|\| profesor_sinact \|\| departamento_titulacion` | Botón de periodo del header (misma condición) |
| Ícono de periodo | 1155-1166 | `escolar` (dentro de `escolar \|\| directivo`) | Mismo botón (se fusiona) |
| Ícono de periodo | 1590-1601 | (`U \|\| id 2630 \|\| id 2662 \|\| escolar`) y (u=14 o u=20) | Mismo botón (se fusiona) |
| Ícono de periodo | 1928-1937 | `palumno` y `!escolar` | Mismo botón (se fusiona) |
| Cambio de carrera (lista de `carreras`) | 410-427 | `cambio_carreras == 1` | Selector en el header (M001 enlaza a `/recarga_personal/{id}`) |
| Badges de oficios (`#solicitud`, `#oficios`, `#oficiospersonal`) | 299-336 | comentados | No se migran |
| JS `cargar()` / `cargarpersonal()` | 2540-2551 | nunca se llaman | No se migran (sin campana) |
| Modal `#modal_modificar_periodo` + `.periodo_ingles` | 2507-2575 | perfil de inglés | Fuera de alcance (layout de inglés) |

**Regla del botón de periodo:** se muestra si se cumple **cualquiera** de las 4 condiciones anteriores. En el original, cuando se cumplen dos, se crean dos `id="periodo"` duplicados; con el botón único eso desaparece.

## Contenido actual del panel (`home_recargado.blade.php`) por rol

| Contenido | Línea | Condición (misma lógica) | Roles |
|---|---|---|---|
| Aviso verde "ATENCION: … RETICULA y DOCENTE se cambio a Generales en el submenu ACADEMICO" | 130-134 | `jefe_division \|\| directivo` | Jefe de división, Desarrollo académico, Directivo |
| Mensaje global `{{$men}}` + "NOTA: La última fecha de liberación de Actividades Complementarias es el {{$fecha}}" | 134-138 | `profesor_men` | Docente con actividad |
| Mensaje global `{{$men}}` | 139-141 | resto (si `men` está en la sesión; **Desarrollo académico no lo tiene**: `HomeController.php:601-604` está comentado) | todos |
| Aviso "Canalización por reprobación" + botón a `/canalizacion-reprobacion-principal` | 145-171 | tutor en el periodo vigente con ≥ 1 estudiante con calificación < 70 (consulta L28-117) | cualquiera con registro en `gnral_personales` |
| Diagnóstico `?debug_tutor=1` | 173-191 | — | **No se migra** |
| Tarjeta "Encuestas de satisfacción al cliente" con hasta 4 botones (Inscripción, Reinscripción, Servicio Social, Residencia Profesional) | 194-235 | `palumno` y al menos una encuesta pendiente (`HomeController2.php:83-125`) | Alumno |
| Modal "Alerta" de adeudos por departamento (se abre al cargar) | 236-261, 264-273 | `palumno` y `adeudo == 1` (`HomeController2.php:24-77`) | Alumno |
| Pantalla intermedia "CARGANDO" (`home.blade.php`, 1 s) | — | todos | **Fuera de alcance** (no es `/inicio`); se sigue viendo con el diseño viejo durante 1 s |

## Inventario por sección

### 1. Elementos globales (todos los usuarios con sesión)

2 elementos (2 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M001 | Cambio de carrera (ícono) | {nombre de la carrera} | `/recarga_personal/{{ $carrera->id_carrera }}` | `($cambio_c==1)` | 421 |  |  |
| M002 | Salir | — | `/logout` | `siempre` | 433 | 2 | **POST** + CSRF |

### 2. Alumno (`palumno`)

32 elementos (27 visibles, 5 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M220 | Complementarias | Registrar | `/consulta_actividades/` | `($palumno==true)` | 1855 |  |  |
| M221 | Complementarias | Evidencias | `/evidencias_alumnos` | `($palumno==true)` | 1856 |  |  |
| M222 | Complementarias | Liberación | `/liberacion_alumno` | `($palumno==true)` | 1857 |  |  |
| M223 | Complementarias | Créditos | `/creditos` | `($palumno==true)` | 1858 |  |  |
| M224 | Datos Alumno(a) | Actualizar | `/datos_alumno` | `($palumno==true)` | 1870 |  |  |
| M225 | Datos Alumno(a) | Llenar Carga Académica | `/carga_academica` | `($palumno==true)  ⟫  ($ver_carga==false)` | 1872 |  |  |
| M226 | Datos Alumno(a) | Ver Carga Académica | `/checar_carga` | `($palumno==true)` | 1875 |  |  |
| M227 | Ingles | — | `/ingles/` | `($palumno==true)` | 1888 |  |  |
| M228 | Tutorias | — | `/tutorias/` | `($palumno==true)` | 1893 |  |  |
| M229 | Examen EGEL | — | `/examen_egel/dashboard` | `($palumno==true)  ⟫  (in_array($id_carrera, [6, 8]))` | 1906 |  |  |
| M230 | Evaluacion Docente | Iniciar Evaluación | `/evaluacion_alumno` | `($palumno==true)  ⟫  ($ver_eva==true)` | 1920 |  |  |
| M231 | Calificaciones | — | `/calificaciones` | `($palumno==true)` | 1927 |  |  |
| M232 | Solicitudes | Solicitud del Estimulo al D. E. | `/beca_estimulo/` | `($palumno==true)` | 1946 |  |  |
| M233 | Solicitudes | Solicitud de prorroga | `/solicitud/prorroga` | `($palumno==true)` | 1947 |  |  |
| M234 | Solicitudes | Solicitud de constancia de no adeudo | `/verificacion_adeudo_alumno/` | `($palumno==true)` | 1948 |  |  |
| M235 | Solicitudes | Solicitud de material | `/prestamo/Alumnos_Prestamos_material` | `($palumno==true)  ⟫  (!empty($carrera) && $carrera[0]->id_carrera == 2)` | 1956 |  |  |
| M236 | Datos Residencia Profesional | Registrar Anteproyecto | `/residencia/registrar_anteproyecto` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  ($registrar_residencia == true)` | 1981 |  |  |
| M237 | Datos Residencia Profesional | Correciones anteproyecto | `/residencia/correcciones_anteproyecto/` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  ($registrar_residencia == true)  ⟫  ($estado_reg_anteproyecto == true)` | 1987 |  |  |
| M238 | Datos Residencia Profesional | Agregar empresa | `/residencia/agregar_empresa` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  ($registrar_residencia == true)  ⟫  ($anteproyecto_aceptado == true)` | 1992 |  |  |
| M239 | Datos Residencia Profesional | Registrar datos de la solicitud de residencia | `/residencia/registrar_solicitud_residencia` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  ($registrar_residencia == true)  ⟫  ($registro_empresa == true)` | 2001 |  |  |
| M240 | Datos Residencia Profesional | Enviar documentos de alta de residencia | `/residencia/documentos_alta_residencia` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  ($registrar_residencia == true)  ⟫  ($registro_empresa == true)` | 2004 |  | **OCULTO** (`display:none`) |
| M241 | Datos Residencia Profesional | Correciones anteproyecto | `/residencia/correcciones_anteproyecto/` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  NOT ($registrar_residencia == true)  ⟫  ($estado_reg_anteproyecto == true)` | 2011 |  |  |
| M242 | Datos Residencia Profesional | Agregar empresa | `/residencia/agregar_empresa` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  NOT ($registrar_residencia == true)  ⟫  ($anteproyecto_aceptado == true)` | 2016 |  |  |
| M243 | Datos Residencia Profesional | Registrar datos de la solicitud de residencia | `/residencia/registrar_solicitud_residencia` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  NOT ($registrar_residencia == true)  ⟫  ($registro_empresa == true)` | 2024 |  |  |
| M244 | Datos Residencia Profesional | Enviar documentos de alta de residencia | `/residencia/documentos_alta_residencia` | `($palumno==true)  ⟫  ($semestre >= 8)  ⟫  NOT ($registrar_residencia == true)  ⟫  ($registro_empresa == true)` | 2028 |  | **OCULTO** (`display:none`) |
| M245 | Seguimiento Residencia | Mostrar Seguimiento de Residencia | `/residencia/seguimiento_residencia` | `($palumno==true)  ⟫  ($seguimiento_alumno == true)` | 2047 |  |  |
| M246 | Seguimiento Residencia | Enviar documentación de Liberación de Residencia | `/residencia/enviar_documentacion/alumno/` | `($palumno==true)  ⟫  ($seguimiento_alumno == true)` | 2050 |  | **OCULTO** (`display:none`) |
| M247 | Servicio Social | Documentación de la primera etapa S.S. | `/servicio_social/docuemtacion_priemra_etapa/` | `($palumno==true)  ⟫  ($semestre >= 5)` | 2066 |  | **OCULTO** (`display:none`) |
| M248 | Servicio Social | Envio de Carta de Presentación-Aceptación | `/servicio_social/enviocartapresentacionalumno/alumno/` | `($palumno==true)  ⟫  ($semestre >= 5)` | 2068 |  | **OCULTO** (`display:none`) |
| M249 | Titulación | Documentación de los requisitos de Titulación (1ra Etapa) | `/titulacion/documentacion_requisitos_titulacion/` | `($palumno==true)  ⟫  ($reg_alum_ti == true)` | 2088 |  |  |
| M250 | Titulación | Registro de Datos Personales (2da Etapa) | `/titulacion/reg_datos_personales/segunda_etapa/` | `($palumno==true)  ⟫  ($reg_alum_ti == true)  ⟫  ($ti_segunda_etapa == true)` | 2092 |  |  |
| M251 | Titulación | Registro de jurado (3ra etapa) | `/titulacion/registro_jurado/` | `($palumno==true)  ⟫  ($reg_alum_ti == true)  ⟫  ($ti_tercera_parte == true)` | 2096 |  |  |

### 3. Docente con actividad complementaria (`profesor_conact`)

9 elementos (9 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M003 | Complementarias | Planeación de Actividades | `/planeacion_actividad` | `($profesor_conact==true)` | 471 |  |  |
| M004 | Complementarias | Evaluación | `/consulta_general` | `($profesor_conact==true)` | 473 |  |  |
| M005 | Datos P. | — | `/docentes/modificar/` | `($profesor_conact==true)` | 478 |  |  |
| M006 | Duales | Calificar Alumnos Duales | `/duales/mentor_calificar` | `($profesor_conact==true)` | 486 |  |  |
| M007 | Solicitudes | Material | `{{route('materialDocente')}}` | `($profesor_conact==true)  ⟫  ($id_carrera == 2)` | 498 |  |  |
| M008 | Evaluacion Docente | Resultados de Evaluación | `/reportes2/{{$id_perso}}/{{1}}/{{0}}` | `($profesor_conact==true)  ⟫  ($id_unidad_admin != true)` | 511 |  |  |
| M009 | Calificaciones | — | `/docente/{{$id_perso}}/carreras` | `($profesor_conact==true)` | 518 |  |  |
| M010 | Residencia | Agregar asesores | `/residencia/agregar_anteproyecto_asesores` | `($profesor_conact==true)  ⟫  ($personal_academia==true)` | 527 |  |  |
| M011 | Residencia | Revisar proyecto de residencia | `/residencia/revisores_anteproyecto/` | `($profesor_conact==true)  ⟫  ($revisor==true)` | 531 |  |  |

### 4. Docente sin actividad (`profesor_sinact`) — y Desarrollo académico en el primer bloque

6 elementos (6 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M014 | Datos P. | Editar | `/docentes/modificar/` | `($profesor_sinact==true \|\|$desa==true)` | 589 |  |  |
| M015 | Evaluacion Docente | Resultados de Evaluación | `/reportes2/{{$id_perso}}/{{1}}/{{0}}` | `($profesor_sinact==true)  ⟫  ($id_unidad_admin != true)` | 602 |  |  |
| M016 | Calificaciones | — | `/docente/{{$id_perso}}/carreras` | `($profesor_sinact==true)  ⟫  ($id_unidad_admin != true)` | 610 |  |  |
| M017 | Residencia | Agregar asesores | `/residencia/agregar_anteproyecto_asesores` | `($profesor_sinact==true)  ⟫  ($id_unidad_admin != true)  ⟫  ($personal_academia==true)` | 621 |  |  |
| M018 | Residencia | Revisar proyecto de residencia | `/residencia/revisores_anteproyecto/` | `($profesor_sinact==true)  ⟫  ($id_unidad_admin != true)  ⟫  ($revisor==true)` | 625 |  |  |
| M019 | Seguimiento de Residencia | — | `/residencia/seguimiento_asesor` | `($profesor_sinact==true)  ⟫  ($seguimiento_asesor==true)` | 634 |  |  |

### 5. Jefe de división (`jefe_division`; también lo tiene Desarrollo académico)

27 elementos (27 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M047 | Datos P. | Editar | `/docentes/modificar/` | `($jefe_division==true)` | 829 |  |  |
| M048 | Complementarias | Asignar Docente a Actividad | `/docente_actividad` | `($jefe_division==true)` | 839 |  |  |
| M049 | Complementarias | Liberar Solicitud Alumnos | `/alumnos_actividades` | `($jefe_division==true)` | 840 |  |  |
| M050 | Complementarias | Liberar Planeación Docente | `/libera_planeacion` | `($jefe_division==true)` | 841 |  |  |
| M051 | Complementarias | Constancia Individual | `/constancias` | `($jefe_division==true)` | 842 |  |  |
| M052 | Complementarias | Constancia General | `/constancia_gen` | `($jefe_division==true)` | 843 |  |  |
| M053 | Evaluacion | Profesores | `/buscar_profesores_carrera` | `($jefe_division==true)` | 860 |  |  |
| M054 | Formatos | Distrib.de hrs. frente a grupo | `/formatos/distribucion` | `($jefe_division==true)` | 889 |  |  |
| M055 | Formatos | Relación de personal docente | `/formatos/relacion` | `($jefe_division==true)` | 891 |  |  |
| M056 | Plantilla | Agregar Docentes | `/plantilla/docentes` | `($jefe_division==true)` | 899 |  |  |
| M057 | Plantilla | Ver Plantilla | `/plantilla/ver` | `($jefe_division==true)` | 900 |  |  |
| M058 | Generales › Academico | Reticulas | `/reticulass` | `($jefe_division==true)` | 910 |  |  |
| M059 | Generales › Academico | Docentes | `/docente` | `($jefe_division==true)` | 911 |  |  |
| M060 | Generales | Situación Profesional | `/generales/situaciones` | `($jefe_division==true)` | 914 |  |  |
| M061 | Generales | Perfil | `/generales/perfiles` | `($jefe_division==true)` | 915 |  |  |
| M062 | Generales | Edificios | `/generales/edificios` | `($jefe_division==true)` | 916 |  |  |
| M063 | Generales | Aulas | `/generales/aulas` | `($jefe_division==true)` | 917 |  |  |
| M064 | Análisis de reprobación | — | `{{ route('j_carrera.analisis_reprobacion.index') }}` | `($jefe_division==true)` | 922 |  |  |
| M065 | Calificaciones | — | `{{ url($id_carrera.'/docentes') }}` | `($jefe_division==true)` | 949 |  |  |
| M066 | Residencia | Asignar Revisores | `/residencia/asignar_revisores` | `($jefe_division==true)` | 963 |  |  |
| M067 | Residencia | Asignar Academia | `/residencia/asignar_academia` | `($jefe_division==true)` | 969 |  |  |
| M068 | Residencia | Oficio de aceptación | `/residentes/carrera_oficio_aceptacion` | `($jefe_division==true)` | 975 |  |  |
| M069 | Residencia | Calificaciones de los residentes | `/residentes/carrera` | `($jefe_division==true)` | 981 |  |  |
| M320 | Duales | Agregar Alumnos Duales | `/duales/agregar_alumnos_dual` | `($jefe_division==true)` | 2462 |  |  |
| M321 | Duales | Llenar Cargas Academicas | `/duales/llenar_carga_academica_dual` | `($jefe_division==true)` | 2463 |  |  |
| M322 | Duales | Agregar Mentores Duales | `/duales/Agregar_docentes_duales` | `($jefe_division==true)` | 2465 |  |  |
| M323 | Seguimiento Ingles | Estudiantes | `/jefe_division/seguimiento_ingles` | `($jefe_division==true)` | 2475 |  |  |

### 6. Desarrollo académico (`desa`)

9 elementos (9 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M070 | Evaluacion Docente | Profesores | `/buscar_profesores` | `($desa==true )` | 1002 |  |  |
| M071 | Evaluacion Docente | Alumnos | `/buscar_alumnos` | `($desa==true )` | 1007 |  |  |
| M072 | Evaluacion Docente | Ver Comentarios | `/comentarios_docentes` | `($desa==true )` | 1012 |  |  |
| M073 | Horarios | Ver Horarios Grupos | `/horarios/hrs_grupos` | `($desa==true )` | 1024 |  |  |
| M074 | Horarios | Ver Horarios Aulas | `/horarios/hrs_aulas` | `($desa==true )` | 1025 |  |  |
| M075 | Horarios | Horas por carrera | `/hrs_carrera` | `($desa==true )` | 1026 |  |  |
| M076 | Evaluaciones | — | `/servicios_escolares/evaluaciones_academicas` | `($desa==true )` | 1030 |  |  |
| M077 | Administrar Examen EGEL | — | `{{ route('admin.dashboard') }}` | `($desa==true )` | 1035 |  |  |
| M078 | Administrar Examen Conocimientos Gral. | — | `{{ route('admin_examen_conocimientos') }}` | `($desa==true )` | 1041 |  |  |

### 7. Directivo y Planeación y Consultas (`directivo || consultas`)

31 elementos (31 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M140 | Datos P. | Editar | `/docentes/modificar/` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1346 | 20 |  |
| M141 | Complementarias | Registrar Nueva Actividad | `/nueva_actividad` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1357 | 21 |  |
| M142 | Complementarias | Solicitud Alumnos | `/solicitud_alumnos` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1358 | 22 |  |
| M143 | Complementarias | Datos Estadísticos | `/datos_estadisticos` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1359 | 23 |  |
| M144 | Complementarias | Datos Históricos | `/datos_historicos_graficos` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1360 | 24 |  |
| M145 | Calificaciones | — | `/docente/{{$id_perso}}/carreras` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1368 | 25 |  |
| M146 | Evaluacion Doc. | Profesores | `/buscar_profesores` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1380 | 26 |  |
| M147 | Evaluacion Doc. | Alumnos | `/buscar_alumnos` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1385 | 27 |  |
| M148 | Horarios | Ver Horarios Docentes | `/horarios/horarios_docentes` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1399 | 28 |  |
| M149 | Horarios | Ver Horarios Grupos | `/horarios/hrs_grupos` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1401 | 29 |  |
| M150 | Horarios | Ver Horarios Aulas | `/horarios/hrs_aulas` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1402 | 30 |  |
| M151 | Horarios | Horas por carrera | `/hrs_carrera` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1403 | 31 |  |
| M152 | Formatos | Concentrado Estructura Educ. | `/formatos/con_edu` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1410 | 32 |  |
| M153 | Formatos | Distrib.de hrs. frente a grupo | `/formatos/distribucion` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1411 | 33 |  |
| M154 | Formatos | Relación de personal docente | `/formatos/relacion` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1413 | 34 |  |
| M155 | Formatos | Horas por docentes | `/formatos/horas_docentes/` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1415 | 35 |  |
| M156 | Plantilla | Ver Plantilla | `/plantilla/ver` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1422 | 36 |  |
| M157 | Plantilla | Plantilla Educativa | `/plantilla/educativa` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1423 | 37 |  |
| M158 | Generales › Academico | Reticulas | `/reticulass` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1433 | 38 |  |
| M159 | Generales › Academico | Docentes | `/docente` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1434 | 39 |  |
| M160 | Generales | Edificios | `/generales/edificios` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1437 | 40 |  |
| M161 | Generales | Aulas | `/generales/aulas` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)` | 1438 | 41 |  |
| M162 | Generales | Situación Profesional | `/generales/situaciones` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1440 | 42 |  |
| M163 | Generales | Perfil | `/generales/perfiles` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1442 | 43 |  |
| M164 | Generales | Carreras | `/generales/carreras` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1443 | 44 |  |
| M165 | Generales | Extra Clase | `/generales/extra_clases` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1444 | 45 |  |
| M166 | Generales | Categoría Docente | `/generales/cargos` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1445 | 46 |  |
| M167 | Generales | Jefaturas de División | `/generales/jefaturas` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1446 | 47 |  |
| M168 | Generales | Asignación de Permisos | `/personales` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1447 | 48 |  |
| M169 | Generales | Unidades Administrativas | `/generales/unidad_administrativa` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1448 | 49 |  |
| M170 | Generales | Jefes Unidades Administrativas | `/generales/jefe_unidad_administrativa` | `($directivo==true \|\| $consultas==true \|\| $directivo==10)  ⟫  ($directivo==true)` | 1451 | 50 |  |

### 8. Servicios Escolares y Directivo (`escolar || directivo`)

31 elementos (30 visibles, 1 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M079 | Control Escolar | Revision de cargas | `/validacion_de_carga` | `($escolar==true \|\| $directivo==true)` | 1061 | 9 |  |
| M080 | Control Escolar | Gestión de Académica de Alumnos Duales | `/duales/gestion_academica` | `($escolar==true \|\| $directivo==true)  ⟫  ($directivo==true)` | 1067 | 10 |  |
| M081 | Control Escolar | Evaluaciones | `/servicios_escolares/carreras_calificaciones` | `($escolar==true \|\| $directivo==true)` | 1071 | 11 |  |
| M082 | Control Escolar | Estadísticas | `/servicios_escolares/estadisticas` | `($escolar==true \|\| $directivo==true)` | 1073 | 12 |  |
| M083 | Control Escolar | Modificaciones en periodos | `/servicios_escolares/bitacora_periodos` | `($escolar==true \|\| $directivo==true)` | 1074 | 13 |  |
| M084 | Control Escolar | Modificaciones en evaluaciones ordinarias | `/servicios_escolares/bitacora_evaluaciones` | `($escolar==true \|\| $directivo==true)` | 1076 | 14 |  |
| M085 | Control Escolar | Modificaciones en evaluaciones sumativas | `/servicios_escolares/bitacora_evaluaciones_sumativas` | `($escolar==true \|\| $directivo==true)` | 1078 | 15 |  |
| M086 | Control Escolar | Datos de los alumnos por carrera | `/servicios_escolares/alumnos/carrera` | `($escolar==true \|\| $directivo==true)` | 1081 | 16 |  |
| M087 | Control Escolar | Instituciones educativas | `/cct/registros/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1085 |  |  |
| M088 | Control Escolar | Promedios de los alumnos del periodo | `/servicios_escolares/promedio_semestre/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1090 |  |  |
| M089 | Control Escolar | Concentrado de Calificaciones | `/servicios_escolare/concentrados_calificaciones/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1094 |  |  |
| M090 | Control Escolar | Concentrado de Calificaciones de Alumnos Duales | `/duales/concentrado_calificaciones_duales/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1098 |  |  |
| M091 | Control Escolar | Historial Académico de los estudiantes | `/servicios_escolares/historial_academico/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1102 |  |  |
| M092 | Control Escolar | Bajas temporales de los estudiantes | `/servicios_escolares/bajas_temporales/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1106 |  |  |
| M093 | Control Escolar | Bajas definitivas de los estudiantes | `/servicios_escolares/bajas_definitivas/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1110 |  |  |
| M094 | Control Escolar | Bitácora de bajas temporales y definitivas | `/servicios_escolares/bitacora_def_temp/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1114 |  |  |
| M095 | Control Escolar | Agregar Plan de estudio | `/servicios_escolares/plan_estudio/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1118 |  |  |
| M096 | Control Escolar | Agregar Especialidad | `/servicios_escolares/especialidades/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1122 |  |  |
| M097 | Control Escolar | Ver historial de mod. cargas academicas | `/servicios_escolares/modificaciones_cargas_cademicas/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1126 |  |  |
| M098 | Control Escolar | Registrar semestre al estudiante nuevo registro | `/servicios_escolares/registrar_semestre_alumnos/carrera` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1130 |  |  |
| M099 | Control Escolar | Ver estudiantes inactivos | `/servicios_escolares/carrera_estudiantes_desactivados/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1134 |  | **OCULTO** (`display:none`) |
| M100 | Control Escolar | Ver periodos de actualizacion de semestre estudiantes | `/servicios_escolares/carrera_actualizar_semestre_periodo/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1138 |  |  |
| M101 | Control Escolar | Calificar estudiantes (Curso intersemestral) | `/computo/calificar` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1141 |  |  |
| M102 | Control Escolar | Encuestas de satisfacción al cliente (inscripción) | `/encuestas_satisfaccion/encuesta_incripcion_periodo/` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1143 |  |  |
| M103 | Control Escolar | Encuestas de satisfacción al cliente (reinscripción) | `/encuestas_satisfaccion/encuesta_reincripcion_periodo` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1145 |  |  |
| M104 | Control Escolar | Registrar Estudiantes (Historial Academico CON-REE) | `/servicios_escolares/duales/agregar_alumnos_dual` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1147 |  |  |
| M105 | Control Escolar | Llenar Cargas Academicas (Historial Academico CON-REE) | `servicios_escolares/duales/llenar_carga_academica_dual` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1149 |  |  |
| M106 | Solicitudes de Beca | — | `/beca_estimulo/escolares/autorizar` | `($escolar==true \|\| $directivo==true)  ⟫  ($escolar==true)` | 1157 |  |  |
| M107 | Reporte de profesores | Distribución de total de horas de los profesores | `/distribucion_horas_profesores/total/` | `($escolar==true \|\| $directivo==true)  ⟫  ($unidad == 5 \|\| $unidad == 26)` | 1176 | 17 |  |
| M108 | Reporte de profesores | Distribución de horas de todos los profesores | `/distribucion_horas_profesores/total_totales/` | `($escolar==true \|\| $directivo==true)  ⟫  ($unidad == 5 \|\| $unidad == 26)` | 1178 | 18 |  |
| M109 | Reporte de profesores | Distribución de horas de los profesores | `/distribucion_horas_profesores/` | `($escolar==true \|\| $directivo==true)  ⟫  ($unidad == 5 \|\| $unidad == 26)` | 1180 | 19 |  |

### 9. Recursos Humanos (`personal`)

6 elementos (6 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M041 | Datos P. | Editar | `/docentes/modificar/` | `($jefe_personal==true)` | 789 |  |  |
| M042 | Cargos del Personal | Personal del TESVB | `/docente` | `($jefe_personal==true)` | 799 |  |  |
| M043 | Cargos del Personal | Categoría Personal | `/generales/cargos` | `($jefe_personal==true)` | 800 |  |  |
| M044 | Validar Oficios | — | `/oficios/evaluacion` | `($jefe_personal==true)` | 806 |  |  |
| M045 | Plantilla Personal | Agregar Plantilla | `/departamento/plantilla` | `($jefe_personal==true)` | 814 |  |  |
| M046 | Plantilla Personal | Ver Plantilla | `/departamentoplantilla/ver` | `($jefe_personal==true)` | 815 |  |  |

### 10. Centro de Cómputo (`computo`)

14 elementos (14 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M027 | Datos P. | Editar | `/docentes/modificar/` | `($jefe_computo==true)` | 708 |  |  |
| M028 | Laboratorios | — | `/laboratorios/laboratorios/` | `($jefe_computo==true)` | 714 |  |  |
| M029 | Servicios Escolares | Calificar | `/computo/calificar` | `($jefe_computo==true)` | 726 |  |  |
| M030 | Servicios Escolares | Cambio de Periodo | `/servicios_escolares/evaluaciones_cc_academico` | `($jefe_computo==true)` | 727 |  |  |
| M031 | Servicios Escolares | Promedios >= 90 | `/computo/ver_cal/promedios` | `($jefe_computo==true)` | 729 |  |  |
| M032 | Envio Encuesta Sat. | Enviar Encuesta de Satisfacción de cliente interno | `/encuestas_satisfaccion/periodo_mantenimiento/` | `($jefe_computo==true)` | 739 |  |  |
| M033 | Envio Encuesta Sat. | Historial Encuesta de Satisfacción de cliente | `/encuestas_satisfaccion/menu_historial_mantenimiento/` | `($jefe_computo==true)` | 741 |  |  |
| M034 | Herramientas | Activar armar horarios | `/centro_computo/activar_armar_horarios/` | `($jefe_computo==true)` | 761 |  |  |
| M035 | Herramientas | Registro de usuarios en el sistema | `/centro_computo/registro_estudiantes_correo/` | `($jefe_computo==true)` | 763 |  |  |
| M036 | Herramientas | Permisos | `/centro_computo/usuario/` | `($jefe_computo==true)` | 765 |  |  |
| M037 | Herramientas | Usuarios Estudiantes | `/centro_computo/ver_usuario_estudiante/` | `($jefe_computo==true)` | 766 |  |  |
| M038 | Herramientas | Usuarios Personal TESVB | `/centro_computo/ver_usuario_personal_tesvb/` | `($jefe_computo==true)` | 768 |  |  |
| M039 | Herramientas | Usuarios Facilitadores | `/centro_computo/ver_usuario_facilitadores/` | `($jefe_computo==true)` | 770 |  |  |
| M040 | Herramientas | Modificar informe de titulacion | `/centro_computo/informes_titulacion/` | `($jefe_computo==true)` | 772 |  |  |

### 11. Residencias Profesionales (`residencia`)

14 elementos (11 visibles, 3 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M110 | Servicio social | Autorizacion de Documentacion 1ra Etapa | `/servicio_social/departamento_revision_primera_etapa/` | `($jefe_residencia == true)` | 1198 |  | **OCULTO** (`display:none`) |
| M111 | Servicio social | Carta de Presentación-Aceptación | `/servicio_social/ingresar_contancia/departamento/` | `($jefe_residencia == true)` | 1200 |  | **OCULTO** (`display:none`) |
| M112 | Servicio social | Asignar Tipo de Servicio a Alumno | `/servicio_social/asignar_tipo_servicio/` | `($jefe_residencia == true)` | 1202 |  | **OCULTO** (`display:none`); ⚠ ruta inexistente |
| M113 | Seg. Anteproyecto | Anteproyectos Autorizados por los Revisores | `/residencia/ver_anteproyectos_revisores` | `($jefe_residencia == true)` | 1214 |  |  |
| M114 | Seg. Anteproyecto | Autorizar Documentación de Alta de Residencia | `/residencia/autorizar_documentacion_anteproyecto` | `($jefe_residencia == true)` | 1217 |  |  |
| M115 | Seg. Anteproyecto | Periodos Revisión | `/residencia/evalucion_anteproyecto` | `($jefe_residencia == true)` | 1220 |  |  |
| M116 | Seg. Anteproyecto | Empresa | `/residencia/empresa` | `($jefe_residencia == true)` | 1222 |  |  |
| M117 | Seg. Residencia | Proyectos | `/residencia/departamento_residencia` | `($jefe_residencia == true)` | 1232 |  |  |
| M118 | Seg. Residencia | Estadisticas | `/residencia/estadisticas_residencia` | `($jefe_residencia == true)` | 1233 |  |  |
| M119 | Seg. Residencia | Autorizar impresión de acta de residencia | `/residencia/autorizar_imprimir_acta` | `($jefe_residencia == true)` | 1234 |  |  |
| M120 | Seg. Servicio Social | Calificar Servicio Social | `/servicio_social/departamento_carreras` | `($jefe_residencia == true)` | 1246 |  |  |
| M121 | Envio Encuestas Sat. | Encuestas de Satisfaccion del Cliente (Servicio Social) | `/encuestas_satisfaccion/agregar_periodo_year/` | `($jefe_residencia == true)` | 1258 |  |  |
| M122 | Envio Encuestas Sat. | Historial Encuestas de Satisfaccion del Cliente (Servicio Social) | `/encuestas_satisfaccion/historial_periodo_year/` | `($jefe_residencia == true)` | 1260 |  |  |
| M123 | Envio Encuestas Sat. | Encuestas de Satisfaccion del Cliente (Residencia Profesional) | `/encuestas_satisfaccion/agregar_periodo_year_residencia/` | `($jefe_residencia == true)` | 1262 |  |  |

### 12. Titulación (`titulacion`)

16 elementos (16 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M124 | Datos P. | Editar | `/docentes/modificar/` | `($departamento_titulacion==true)` | 1280 |  |  |
| M125 | Titulación | Registrar alumnos para Titulación | `/titulacion/registro_alumnos_titulacion/` | `($departamento_titulacion==true)` | 1290 |  |  |
| M126 | Titulación | Autorizar documentación de requisitos de Titulación | `/titulacion/autorizar_doc_requisitos/` | `($departamento_titulacion==true)` | 1292 |  |  |
| M127 | Titulación | Autorizar datos personales de los estudiantes de Titulación | `/titulacion/autorizar_datos_personales/` | `($departamento_titulacion==true)` | 1294 |  |  |
| M128 | Titulación | Validación para agregar jurado | `/titulacion/validacion_agregar_jurado/carreras/` | `($departamento_titulacion==true)` | 1296 |  |  |
| M129 | Titulación | Autorizar jurado de los estudiantes de Titulación | `/titulacion/autorizar_jurado_estudiantes/` | `($departamento_titulacion==true)` | 1298 |  |  |
| M130 | Titulación | Consultar Titulaciones por día | `/titulacion/calendario_estudiantes_autorizado/` | `($departamento_titulacion==true)` | 1300 |  |  |
| M131 | Titulación | Autorizar titulaciones | `/titulacion/formulario_datos_titulado/inicio/carrera/` | `($departamento_titulacion==true)` | 1302 |  |  |
| M132 | Titulación | Relación de documentos | `/titulacion/relacion de documentos/inicio/` | `($departamento_titulacion==true)` | 1304 |  |  |
| M133 | Titulación | Ver alumnos titulados liberados | `/titulacion/liberacion_titulado_carrera/` | `($departamento_titulacion==true)` | 1306 |  |  |
| M134 | Titulación | Encuestas de satisfacción al cliente | `/encuestas_satisfaccion/enviar_encuesta_estudiante_titulacion/` | `($departamento_titulacion==true)` | 1309 |  |  |
| M135 | Titulación | Historial de Encuestas de satisfacción al cliente | `/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion/` | `($departamento_titulacion==true)` | 1312 |  |  |
| M136 | Titulación | Ver estado del certificado de ingles del estudiante | `/titulacion/ver_certificado_ingles_carrera/` | `($departamento_titulacion==true)` | 1314 |  |  |
| M137 | Titulación | Modificar informe de titulacion | `/centro_computo/informes_titulacion/` | `($departamento_titulacion==true)` | 1316 |  |  |
| M138 | Catalogos Titulacion | Registrar Tomos de titulos | `/titulacion/reg_catalogo_tomos_titulo/` | `($departamento_titulacion==true)` | 1328 |  |  |
| M139 | Catalogos Titulacion | Registrar escuelas preparatorias | `/titulacion/agregar_escuelas_preparatorias/` | `($departamento_titulacion==true)` | 1330 |  |  |

### 13. Finanzas y unidades presupuestales (`finanzas` o unidad 1, 2, 24, 25)

14 elementos (14 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M182 | Req. Anteproyecto | Techo presupuestal | `/presupuesto_anteproyecto/techo_presupuestal/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1612 | 63 |  |
| M183 | Req. Anteproyecto | Periodos de anteproyectos | `/presupuesto_anteproyecto/periodos_anteproyecto/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1614 | 64 |  |
| M184 | Req. Anteproyecto | Revisión de requisiciones | `/presupuesto_anteproyecto/revicion_requisiciones_anteproyecto/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1616 | 65 |  |
| M185 | Req. Anteproyecto | Requisiciones autorizadas de los proyectos | `/presupuesto_anteproyecto/requisiciones_autorizadas_proyecto/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1618 | 66 |  |
| M186 | Req. Anteproyecto | Historiales de los anteproyectos del los presupuestos | `/presupuesto_anteproyecto/inicio_historial_anteproyecto/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1620 | 67 |  |
| M187 | Catalogo de Requisiciones | Partidas presupuestales | `/presupuesto_anteproyecto/partida_presupuestal/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 )` | 1635 | 68 |  |
| M188 | Catalogo de Requisiciones | Proyectos presupuestales | `/presupuesto_anteproyecto/proyectos_presupuestales/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )` | 1638 | 69 |  |
| M189 | Catalogo de Requisiciones | Metas de los proyectos presupuestales | `/presupuesto_anteproyecto/proyectos_metas/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )` | 1640 | 70 |  |
| M190 | Presupuesto autorizado | Agregar presupuesto autorizado | `/presupuesto_autorizado/agregar_presupesto_partida/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1652 | 71 |  |
| M191 | Presupuesto autorizado | Presupuesto autorizado para modificar | `/presupuesto_autorizado/presupesto_partida_copia/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1654 | 72 |  |
| M192 | Presupuesto autorizado | Departamentos con presupuesto autorizado | `/presupuesto_autorizado/departamentos_presupesto_partida/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1656 | 73 |  |
| M193 | Presupuesto autorizado | Revisión de solicitudes | `/presupuesto_autorizado/revisar_solicitudes/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1658 | 74 |  |
| M194 | Presupuesto autorizado | Solicitudes autorizadas liberadas | `/presupuesto_autorizado/solicitudes_autorizadas_departamentos` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1660 | 75 |  |
| M195 | Presupuesto autorizado | Historial de presupuesto autorizado | `/presupuesto_autorizado/inicio_presupuesto_autorizado_historial/` | `($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25 \|\| $unidad == 1 \|\| $unidad == 2 )  ⟫  ($direccion_finanzas == true \|\| $unidad == 24 \|\| $unidad == 25)` | 1663 | 76 |  |

### 14. Profesor de inglés (`profesor_ingles`)

1 elementos (1 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M252 | Ingles | — | `/ingles/` | `($profesor_ingles==true)` | 2121 |  |  |

### 15. Todo el personal TESVB (`tipo_persona = 2` / `personal_tesvb`): Tutorías, Incidencias y SGOE

58 elementos (58 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M020 | Tutorias | — | `tutorias/` | `($tipo_p== 2)  ⟫  ($id_unidad_admin != true)` | 643 | 5 |  |
| M021 | Tutorias | — | `tutorias/` | `($tipo_p== 2)  ⟫  NOT ($id_unidad_admin != true)  ⟫  ($desa==true \|\| $jefe_division == true )` | 648 |  |  |
| M253 | Incidencias de Asistencia | Validar oficios de los departamentos | `/incidencias/validar_oficios_departamentos` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($unidad == 3)` | 2141 | 101 |  |
| M254 | Incidencias de Asistencia | Validar oficios de los departamentos | `/incidencias/validar_oficios_dep_acad_finanzas` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  NOT ($unidad == 3) & ($unidad == 5 \|\| $unidad == 22)` | 2145 | 102 |  |
| M255 | Incidencias de Asistencia | Validar oficios del departamento | `/incidencias/validar_oficios` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($jefe_division==true \|\| $directivo==true \|\| $direccion_finanzas==true \|\| $jefe_personal==true \|\|$id_unidad_admin==true )` | 2150 | 103 |  |
| M256 | Incidencias de Asistencia | Historial de oficios autorizados del departamento | `/incidencias/historial_oficios_autorizados` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($jefe_division==true \|\| $directivo==true \|\| $direccion_finanzas==true \|\| $jefe_personal==true \|\|$id_unidad_admin==true )` | 2152 | 104 |  |
| M257 | Incidencias de Asistencia | Historial de evidencias de conocimiento del departamento | `/incidencias/historial_evid_personal` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($jefe_division==true \|\| $directivo==true \|\| $direccion_finanzas==true \|\| $jefe_personal==true \|\|$id_unidad_admin==true )` | 2154 | 105 |  |
| M258 | Incidencias de Asistencia | Solicitar oficio | `/incidencias/solicitar_oficio` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ( !$id_unidad_admin)` | 2164 | 106 |  |
| M259 | Incidencias de Asistencia | Subir evidencia de conocimiento | `/incidencias/cargar_otra_evidencia` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ( !$id_unidad_admin)` | 2165 | 107 |  |
| M260 | Incidencias de Asistencia | Historial oficios autorizados | `/incidencias/historial_docentesSo` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ( !$id_unidad_admin)` | 2169 | 108 |  |
| M261 | Incidencias de Asistencia | Historial evidencias de conocimiento | `/incidencias/historial_docentesEv` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ( !$id_unidad_admin)` | 2171 | 109 |  |
| M262 | Incidencias de Asistencia | Validar evidencia de conocimiento de los departamentos | `/incidencias/validar_evidencia_departamentos` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($jefe_personal==true)` | 2175 |  |  |
| M263 | Incidencias de Asistencia | Historial de oficios de los departamentos | `/incidencias/historial_oficios` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($jefe_personal==true)` | 2177 |  |  |
| M264 | Incidencias de Asistencia | Historial de evidencias de conocimiento de los departamentos | `/incidencias/historial_evidencias` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($jefe_personal==true)` | 2179 |  |  |
| M265 | Incidencias de Asistencia | Reportes | `/incidencias/reportes_incidencias` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)  ⟫  ($jefe_personal==true)` | 2181 |  |  |
| M266 | SGOE | SGOE | `/sgoe/inicio` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )` | 2210 | 110 |  |
| M267 | SGOE › Riesgos y Oportuni. | Registro Procesos | `/riesgos/proceso` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2218 | 111 |  |
| M268 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Riesgos | `/riesgos/riesgo` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2224 | 112 |  |
| M269 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Selecciones | `/riesgos/seleccion` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2225 | 113 |  |
| M270 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Tipo Evaluación | `/riesgos/tipoeva` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2226 | 114 |  |
| M271 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Factor | `/riesgos/factor` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2227 | 115 |  |
| M272 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Tipo Factor | `/riesgos/tipof` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2228 | 116 |  |
| M273 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Estrategias | `/riesgos/estrategia` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2229 | 117 |  |
| M274 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Nivel Decisión | `/riesgos/decision` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2230 | 118 |  |
| M275 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Clasificación Riesgo | `/riesgos/clasifica` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2231 | 119 |  |
| M276 | SGOE › Riesgos y Oportuni. › Registro Catálogos Riesgos | Categoria del Proceso | `/riesgos/sistema` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2233 | 120 |  |
| M277 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Mejoras del Cliente | `/riesgos/mejoracliente` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2241 | 121 |  |
| M278 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Reputación Institucional | `/riesgos/mejorareputacion` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2243 | 122 |  |
| M279 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Mejora SGC | `/riesgos/mejorasgc` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2245 | 123 |  |
| M280 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Potencial Apertura Nuevos Programas de Estudio | `/riesgos/potencialapertura` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2246 | 124 |  |
| M281 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Potencial Costo de Implementación | `/riesgos/potencialcosto` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2248 | 125 |  |
| M282 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Potencial de Crecimiento de la Matrícula Actual | `/riesgos/potencialcrecimiento` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2250 | 126 |  |
| M283 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Registra Probabilidad | `/riesgos/probabilidad` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2252 | 127 |  |
| M284 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Registra Ocurrencias Previas | `/riesgos/ocurrenciasp` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2254 | 128 |  |
| M285 | SGOE › Riesgos y Oportuni. › Registro Catálogos Oportunidades | Registra Calificación Máxima | `/riesgos/calificacion` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2256 | 129 |  |
| M286 | SGOE › Riesgos y Oportuni. | Partes Interesadas | `/riesgos/partes` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))` | 2261 | 130 |  |
| M287 | SGOE › Riesgos y Oportuni. | Seguimiento | `/riesgos/seguimiento` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))  ⟫  ($directivo \|\| $unidad==10)` | 2264 | 131 |  |
| M288 | SGOE › Riesgos y Oportuni. | Cronograma | `riesgos/seguimiento/tabla` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($id_unidad_admin\|\|$directivo))  ⟫  ($directivo \|\| $unidad==10)` | 2265 | 132 |  |
| M289 | SGOE › Auditorías | Actividades para la agenda | `/auditorias/actividades` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_auditor_lider_sgoe_menu \|\| $es_auditor_responsable_sgoe_menu)  ⟫  ($es_auditor_lider_sgoe_menu)` | 2278 | 133 |  |
| M290 | SGOE › Auditorías | Auditores | `/auditorias/auditores` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_auditor_lider_sgoe_menu \|\| $es_auditor_responsable_sgoe_menu)  ⟫  ($es_auditor_lider_sgoe_menu)` | 2280 | 134 |  |
| M291 | SGOE › Auditorías | Catálogo Generales | `/auditorias/generales` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_auditor_lider_sgoe_menu \|\| $es_auditor_responsable_sgoe_menu)  ⟫  ($es_auditor_lider_sgoe_menu)` | 2281 | 135 |  |
| M292 | SGOE › Auditorías | Procesos | `/auditorias/procesos` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_auditor_lider_sgoe_menu \|\| $es_auditor_responsable_sgoe_menu)  ⟫  ($es_auditor_lider_sgoe_menu)` | 2282 | 136 |  |
| M293 | SGOE › Auditorías | Seguimiento | `/auditorias/responsables` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_auditor_lider_sgoe_menu \|\| $es_auditor_responsable_sgoe_menu)  ⟫  ($es_auditor_lider_sgoe_menu)` | 2283 | 137 |  |
| M294 | SGOE › Auditorías | Programa de auditorías | `/auditorias/programas` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_auditor_lider_sgoe_menu \|\| $es_auditor_responsable_sgoe_menu)` | 2285 | 138 |  |
| M295 | SGOE › No conformidades | Acciones Correctivas | `/auditorias/notas_auditorias` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)` | 2297 | 139 |  |
| M296 | SGOE › Encuestas Satisfacción | Inscripción | `/encuestas_satisfaccion/encuesta_incripcion_periodo` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($unidad == 2 \|\| $unidad == 5))` | 2312 | 140 |  |
| M297 | SGOE › Encuestas Satisfacción | Reinscripción | `/encuestas_satisfaccion/encuesta_reincripcion_periodo/` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($unidad == 2 \|\| $unidad == 5))` | 2315 | 141 |  |
| M298 | SGOE › Encuestas Satisfacción | Centro de cómputo | `/encuestas_satisfaccion/menu_historial_mantenimiento/` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($unidad == 2 \|\| $unidad == 5))` | 2317 | 142 |  |
| M299 | SGOE › Encuestas Satisfacción | Servicio social | `/encuestas_satisfaccion/historial_periodo_year/` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($unidad == 2 \|\| $unidad == 5))` | 2319 | 143 |  |
| M300 | SGOE › Encuestas Satisfacción | Residencia Profesional | `/encuestas_satisfaccion/agregar_periodo_year_residencia/` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($unidad == 2 \|\| $unidad == 5))` | 2322 | 144 |  |
| M301 | SGOE › Encuestas Satisfacción | Titulación | `/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && ($unidad == 2 \|\| $unidad == 5))` | 2325 | 145 |  |
| M302 | SGOE › Encuestas | Encuesta de satisfacción al cliente Centro de Cómputo | `/encuestas_satisfaccion/registro_enc_mante_usuario/` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)` | 2337 | 146 |  |
| M303 | SGOE › Seguimiento OM/NC/AC | Ejecutar | `/auditorias/responsables_implementar` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)` | 2349 | 147 |  |
| M304 | SGOE › Seguimiento OM/NC/AC | Revisar | `/auditorias/responsables_revisar` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true)` | 2351 | 148 |  |
| M305 | SGOE | Seguimiento Auditorías Anteriores | `/auditorias/notas_auditor` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($personal_tesvb == true && $equipo_auditor)` | 2360 | 149 |  |
| M306 | SGOE | Asignar Líder | `{{ route('auditorias.asignar_lider') }}` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_auditor_lider_sgoe_menu)` | 2367 | 150 |  |
| M307 | SGOE | Ver Acciones | `{{ route('auditorias.lider_acciones') }}` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($es_lider_acciones_sgoe_menu)` | 2374 | 151 |  |
| M308 | SGOE | Seguimiento de auditorías | `{{ route('auditorias.seguimiento_auditorias.index') }}` | `( $personal_tesvb == true \|\| $es_auditor_lider_sgoe_menu \|\| $es_lider_acciones_sgoe_menu \|\| $puede_ver_seguimiento_auditorias_menu )  ⟫  ($puede_ver_seguimiento_auditorias_menu)` | 2381 | 152 |  |

### 16. Por unidad administrativa (`id_unidad_admin`)

46 elementos (38 visibles, 8 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M026 | Ingles | — | `/ingles/` | `($id_unidad_admin ==true)  ⟫  ($unidad==19)` | 692 | 8 |  |
| M171 | Oficios Com. | Validar Oficios | `/oficios/evaluacionsubdirecion` | `($id_unidad_admin\|\|$directivo)  ⟫  ($unidad==26)` | 1467 | 51 |  |
| M172 | Oficios Com. | Solicitud Oficio | `/oficios/solicitud` | `($id_unidad_admin\|\|$directivo)` | 1470 | 52 |  |
| M173 | Oficios Com. | Ver Oficios | `/oficios/registrosoficio` | `($id_unidad_admin\|\|$directivo)` | 1471 | 53 |  |
| M174 | Seg. de Oficios | Editar | `/docentes/modificar/` | `($id_unidad_admin\|\|$directivo)` | 1483 | 54 |  |
| M179 | Adeudos de Estudiantes | Registrar alumnos con adeudo | `/solicitud_adeudo/` | `($id_unidad_admin == true \|\| $id_per ===2630 \|\| $id_per ===2662 \|\| $escolar == true)` | 1580 | 59 |  |
| M180 | Adeudos de Estudiantes | Constancias de no adeudo | `/constancia_adeudo/` | `($id_unidad_admin == true \|\| $id_per ===2630 \|\| $id_per ===2662 \|\| $escolar == true)  ⟫  ($unidad == 16 \|\| $unidad == 28 \|\| $escolar == true)` | 1582 | 60 |  |
| M181 | Adeudos de Estudiantes | Adeudo de Encuestas | `/ver_carrera_encuestas_adeudo//` | `($id_unidad_admin == true \|\| $id_per ===2630 \|\| $id_per ===2662 \|\| $escolar == true)  ⟫  ($id_per ===2662)` | 1585 | 61 |  |
| M196 | Ipomex | — | `/ipomex/mostrar_fracciones/contralor_ver_ipomex/` | `($id_unidad_admin)  ⟫  ($unidad == 40 \|\| $unidad == 1)  ⟫  ($unidad == 40 )` | 1676 | 77 |  |
| M197 | Ipomex | Ver jefes con fracciones | `/ipomex/mostrar_fracciones/contralor_ver_ipomex/` | `($id_unidad_admin)  ⟫  ($unidad == 40 \|\| $unidad == 1)  ⟫  NOT ($unidad == 40 )` | 1684 | 78 |  |
| M198 | Ipomex | Ver mis fracciones | `/ipomex/mostrar_fracciones` | `($id_unidad_admin)  ⟫  ($unidad == 40 \|\| $unidad == 1)  ⟫  NOT ($unidad == 40 )` | 1686 | 79 |  |
| M199 | Ipomex | — | `/ipomex/mostrar_fracciones` | `($id_unidad_admin)  ⟫  NOT ($unidad == 40 \|\| $unidad == 1)` | 1694 | 80 |  |
| M200 | Solicitudes de beca | — | `/beca_estimulo/academico/autorizar` | `($id_unidad_admin)  ⟫  ($unidad == 5 )` | 1701 | 81 |  |
| M201 | Solicitudes | Solicitudes de beca | `/beca_estimulo/academico/autorizar` | `($id_unidad_admin)  ⟫  ($unidad == 26)` | 1713 | 82 |  |
| M202 | Solicitudes | Solicitud de prorroga | `/solicitud/prorroga_autorizar` | `($id_unidad_admin)  ⟫  ($unidad == 26)` | 1714 | 83 |  |
| M203 | Residencia | — | `/residencia/carreras_proyectos` | `($id_unidad_admin)  ⟫  ($unidad == 26)` | 1717 | 84 |  |
| M204 | Evidencias Inf. Doc. | Procedimientos | `/ambiental/ver_procedimientos/` | `($id_unidad_admin)  ⟫  ($unidad == 17)` | 1731 | 85 |  |
| M205 | Evidencias Inf. Doc. | Encargados de los Procedimientos | `/ambiental/ver_encargados/` | `($id_unidad_admin)  ⟫  ($unidad == 17)` | 1732 | 86 |  |
| M206 | Evidencias Inf. Doc. | Periodos de Envió de Documentación | `/ambiental/ver_periodos/` | `($id_unidad_admin)  ⟫  ($unidad == 17)` | 1734 | 87 |  |
| M207 | Evidencias Inf. Doc. | Autorizar Documentación | `/ambiental/ver_documentacion_ambiental/` | `($id_unidad_admin)  ⟫  ($unidad == 17)` | 1736 | 88 |  |
| M208 | Evidencias Inf. Doc. | Historial Documentación Ambiental | `/ambiental/historial_ambiental_departamento/` | `($id_unidad_admin)  ⟫  ($unidad == 17)` | 1738 | 89 |  |
| M209 | P.A.AC › Catálogo | Programa | `/paa/programa_paa` | `($id_unidad_admin)  ⟫  ($unidad == 1)` | 1785 | 90 | **OCULTO** (`display:none`) |
| M210 | P.A.AC › Catálogo | Subprograma | `/paa/subprograma_paa` | `($id_unidad_admin)  ⟫  ($unidad == 1)` | 1786 | 91 | **OCULTO** (`display:none`) |
| M211 | P.A.AC › Catálogo | Acción | `/paa/acciones_paa` | `($id_unidad_admin)  ⟫  ($unidad == 1)` | 1787 | 92 | **OCULTO** (`display:none`) |
| M212 | P.A.AC › Catálogo | Unidad de medida | `/paa/unidad_medida_paa` | `($id_unidad_admin)  ⟫  ($unidad == 1)` | 1788 | 93 | **OCULTO** (`display:none`) |
| M213 | P.A.AC › OPCIONES DE P.A.AC | Generar | `/paa/generarpaa` | `($id_unidad_admin)` | 1798 | 94 | **OCULTO** (`display:none`) |
| M214 | P.A.AC › OPCIONES DE P.A.AC | Modificar P.A.A | `/paa/subprograma_paa` | `($id_unidad_admin)` | 1799 | 95 | **OCULTO** (`display:none`) |
| M215 | P.A.AC › OPCIONES DE P.A.AC | Cargar evidencia | `/paa/acciones_paa` | `($id_unidad_admin)` | 1800 | 96 | **OCULTO** (`display:none`) |
| M216 | P.A.AC › OPCIONES DE P.A.AC | Modificar | `/paa/unidad_medida_paa` | `($id_unidad_admin)` | 1801 | 97 | **OCULTO** (`display:none`) |
| M217 | Req. de Mat. Anteproyecto | Registrar requisición de materiales del anteproyecto | `/presupuesto_anteproyecto/registrar_requerimientos_anteproyecto/` | `($id_unidad_admin)` | 1813 | 98 |  |
| M218 | Solicitudes de req. del presupuesto autorizado | Registrar requisiciones a las solicitudes autorizadas | `/presupuesto_autorizado/agregar_req_solicitud_autorizadas/` | `($id_unidad_admin)` | 1825 | 99 |  |
| M219 | Solicitudes de req. del presupuesto autorizado | Ver solicitudes autorizadas liberadas | `/presupuesto_autorizado/solicitudes_aut_departamento/` | `($id_unidad_admin)` | 1829 | 100 |  |
| M309 | Inventario TESVB | Sector Auxiliar | `/SectorAux` | `($unidad == 25)` | 2419 | 153 |  |
| M310 | Inventario TESVB › Bienes › Gestionar atributos del Bien | Marcas | `/Marcas` | `($unidad == 25)` | 2425 | 154 |  |
| M311 | Inventario TESVB › Bienes › Gestionar atributos del Bien | Proveedores | `/Provedores` | `($unidad == 25)` | 2426 | 155 |  |
| M312 | Inventario TESVB › Bienes › Gestionar atributos del Bien | Modelos | `/Modelos` | `($unidad == 25)` | 2427 | 156 |  |
| M313 | Inventario TESVB › Bienes | Registro, Gestión y consulta de Bienes | `/Bienes` | `($unidad == 25)` | 2430 | 157 |  |
| M314 | Inventario TESVB | Categorías | `/Categorias` | `($unidad == 25)` | 2433 | 158 |  |
| M315 | Inventario TESVB › Resguardos | Asignacion y Consulta de Resguardos | `/Resguardos` | `($unidad == 25)` | 2436 | 159 |  |
| M316 | Inventario TESVB › Resguardos | Tarjetas de Resguardo | `/Resguardos-Consulta` | `($unidad == 25)` | 2437 | 160 |  |
| M317 | Inventario TESVB › Padrón de Bienes | Padron del TESVB | `/Resguardos-Padron` | `($unidad == 25)` | 2442 | 161 |  |
| M318 | Inventario TESVB | Historial Departamentos | `/Areas` | `($unidad == 25)` | 2445 | 162 |  |
| M319 | Inventario TESVB › Reportes | Reportes en Excel | `/Reportes` | `($unidad == 25)` | 2448 | 163 |  |
| M324 | Validar Cargas | — | `/revicion_carga_jefe/` | `($unidad == 8)` | 2484 | 164 |  |
| M325 | Materiales y solicitudes | Ver solicitudes | `/prestamo/Jefe_prestamos_materiales/` | `($unidad == 6)` | 2494 | 165 |  |
| M326 | Materiales y solicitudes | Ver materiales | `/prestamo/materials` | `($unidad == 6)` | 2495 | 166 |  |

### 17. Por relación en BD o id fijo (asesor, docente investigador, PIASE, ambiental, usuario 2630)

10 elementos (10 visibles, 0 ocultos).

| ID | Módulo (original) | Submódulo (original) | URL | Condición completa (Blade, de afuera hacia adentro) | Línea | #Dir | Nota |
|---|---|---|---|---|---|---|---|
| M012 | Seguimiento de Residencia | — | `/residencia/seguimiento_asesor` | `($seguimiento_asesor==true)` | 542 | 3 |  |
| M013 | Examen Conocimientos Gral. | — | `{{ route('examen_conocimientos') }}` | `($docente && $docente->estado_docente_inv == 1)` | 569 | 4 |  |
| M022 | PIASE | Canalizar por reprobación | `/canalizacion-reprobacion-principal` | `($es_tutor_reprobacion_menu == true \|\| $desa == true \|\| $es_responsable_area_atencion_menu == true \|\| $es_alumno_piase_menu == true)  ⟫  ($es_tutor_reprobacion_menu == true)` | 664 | 6 |  |
| M023 | PIASE | Atención y seguimiento | `{{ route('areas_atencion.mis_casos.index') }}` | `($es_tutor_reprobacion_menu == true \|\| $desa == true \|\| $es_responsable_area_atencion_menu == true \|\| $es_alumno_piase_menu == true)  ⟫  ($es_responsable_area_atencion_menu == true)` | 670 | 7 |  |
| M024 | PIASE | Mis citas y actividades | `{{ route('piase.estudiante.index') }}` | `($es_tutor_reprobacion_menu == true \|\| $desa == true \|\| $es_responsable_area_atencion_menu == true \|\| $es_alumno_piase_menu == true)  ⟫  ($es_alumno_piase_menu == true)` | 675 |  |  |
| M025 | PIASE | Configurar áreas y horarios | `{{ route('desarrollo_academico.areas_atencion.index') }}` | `($es_tutor_reprobacion_menu == true \|\| $desa == true \|\| $es_responsable_area_atencion_menu == true \|\| $es_alumno_piase_menu == true)  ⟫  ($desa==true)` | 680 |  |  |
| M175 | Titulación | Autorizar entrega de PDF | `/titulacion/autorizacion_entrega_cd` | `( $id_per == 2630 )` | 1501 | 55 |  |
| M176 | Titulación | Documento de Titulacion autorizado de los estudiantes | `/titulacion/documento_titulacion_autorizado/` | `( $id_per == 2630 )` | 1503 | 56 |  |
| M177 | Procedimiento Amb. | Enviar evidencias del procedimiento | `/ambiental/enviar_documentacion/` | `($encargado_ambiental == true)` | 1520 | 57 |  |
| M178 | Procedimiento Amb. | Historial de las evidencias procedimiento | `/ambiental/historial_documentacion/` | `($encargado_ambiental == true)` | 1522 | 58 |  |

## Totales

| Sección | Elementos | Visibles | Ocultos |
|---|---|---|---|
| 1. Elementos globales | 2 | 2 | 0 |
| 2. Alumno | 32 | 27 | 5 |
| 3. Docente con actividad | 9 | 9 | 0 |
| 4. Docente sin actividad | 6 | 6 | 0 |
| 5. Jefe de división | 27 | 27 | 0 |
| 6. Desarrollo académico | 9 | 9 | 0 |
| 7. Directivo / Consultas | 31 | 31 | 0 |
| 8. Servicios Escolares / Directivo | 31 | 30 | 1 |
| 9. Recursos Humanos | 6 | 6 | 0 |
| 10. Centro de Cómputo | 14 | 14 | 0 |
| 11. Residencias | 14 | 11 | 3 |
| 12. Titulación | 16 | 16 | 0 |
| 13. Finanzas y unidades presupuestales | 14 | 14 | 0 |
| 14. Profesor de inglés | 1 | 1 | 0 |
| 15. Todo el personal TESVB | 58 | 58 | 0 |
| 16. Por unidad administrativa | 46 | 38 | 8 |
| 17. Por relación en BD o id fijo | 10 | 10 | 0 |
| **Total** | **326** | **309** | **17** |

Además: 4 íconos de periodo (que se fusionan en un solo botón) y el selector de cambio de carrera (M001), descritos en "Elementos que no son enlaces".

## Elementos ocultos (`display:none`)

Se conservan en `MenuPrincipal` marcados `->oculto()` con un comentario, y **no se muestran**.

| IDs | Qué es | Línea del `style="display:none"` |
|---|---|---|
| M099 | Servicios Escolares › Ver estudiantes inactivos | 1133 |
| M110-M112 | Residencias › Servicio social (3 enlaces) | 1191 |
| M209-M216 | P.A.AC (8 enlaces; #90-97 del directivo) | 1776 |
| M240, M244, M246 | Alumno › Residencia › Enviar documentos de alta (×2) y Enviar documentación de Liberación | 2003, 2027, 2049 |
| M247, M248 | Alumno › Servicio Social › Documentación primera etapa y Carta de Presentación | 2059 |


## Validación de rutas

- **325 de 326** URLs existen en `route:list` (GET), y `/logout` existe como POST.
- **M112** (`/servicio_social/asignar_tipo_servicio/`, L1202) **no tiene ruta**. Está **oculto**, así que hoy nadie lo ve. Se conserva igual (oculto).

## Enlaces dudosos (se conservan sin cambios)

| ID | #Dir | Problema | Acción |
|---|---|---|---|
| M174 | 54 | "Seg. de Oficios › Editar" lleva a `/docentes/modificar/` (el mismo destino que "Datos P. › Editar") | Pendiente en `docs/panel.md`, para un commit aparte |
| M214-M216 | 95-97 | Las etiquetas no corresponden a su URL; además están ocultos | Pendiente en `docs/panel.md` |
| M181 | 61 | Doble barra final `//` | Se conserva |
| M112 | — | Ruta inexistente (oculto) | Se conserva oculto |
| Íconos de periodo | 1, 62 | `id="periodo"` duplicado cuando se cumplen dos condiciones | Botón único en el header |

## Etiquetas

Las etiquetas se copian aquí **tal como están**. En el sidebar **solo se corrigen acentos** (por ejemplo "Evaluacion" → "Evaluación", "Tutorias" → "Tutorías", "Ingles" → "Inglés", "Reticulas" → "Retículas", "Academico" → "Académico", "Envio" → "Envío", "Categoria" → "Categoría"). No se cambian palabras, abreviaturas ni mayúsculas.
