# Manual de estilo editorial del TESVB

Referencia para desarrollo, revisión de contenido y agentes de IA. Aplica a interfaz, mensajes, correos y documentos generados en español de México.

## Normas ortográficas

- Aplica tildes y diéresis donde correspondan, incluidas las mayúsculas. Revisa concordancia, conjugación y el sentido de palabras de grafía similar en la oración completa.
- Abre y cierra las preguntas y exclamaciones directas. Evita espacios duplicados en prosa y espacios antes de coma, punto y signos de cierre.
- Respeta la grafía de nombres oficiales, siglas y claves. Usa «Tecnológico de Estudios Superiores de Valle de Bravo» y «Tecnológico Nacional de México» cuando corresponda desarrollar TESVB y TecNM. Confirma los nombres de asignaturas, programas, áreas, cargos oficiales y documentos contra su fuente institucional.

[Ortografía de la RAE y la ASALE](https://www.rae.es/diccionario-estudiante/docs/ortografia.pdf)

## Convenciones institucionales

- Usa estilo oración para títulos, subtítulos, menús, pestañas y etiquetas genéricas. Conserva las mayúsculas sostenidas cuando tengan una función justificada en una sección, sigla o formato institucional. Comprueba el resultado si CSS o JavaScript transforman la capitalización.
- Usa tuteo respetuoso en instrucciones. Prefiere expresiones impersonales en estados como «No hay citas programadas». En comunicaciones oficiales, aplica el tratamiento previsto en el formato institucional.
- Prefiere «estudiante», «docente», «contraseña», «iniciar sesión» y «volver». Conserva «alumno» o «profesor» cuando formen parte de una denominación oficial. Usa «clave» para códigos de otra naturaleza. Elige «eliminar», «quitar» o «dar de baja» según el efecto real.
- Escribe «periodo» por convención editorial. «Período» también es válido. Usa «ciclo escolar» solo si el calendario institucional identifica ese intervalo. Confirma si «programa educativo» y «carrera» representan la misma entidad en el flujo.
- Escribe fechas como «22 de noviembre de 2026» en prosa. Si se capturan numéricamente, muestra el formato esperado. Conserva ceros iniciales en identificadores y la precisión en cantidades. Escribe «85 %» con espacio inseparable si el formato lo permite. Desarrolla las siglas poco conocidas en su primera mención.

[DPD, período o periodo](https://www.rae.es/dpd/per%C3%ADodo)

## Textos de interfaz

| Elemento | Criterio | Ejemplo |
| --- | --- | --- |
| Título | Nombra la tarea o el destino | Mi horario |
| Botón | Usa infinitivo y especifica el objeto cuando ayude | Guardar cambios, Enviar solicitud, Volver |
| Formulario | Mantén una etiqueta visible. Indica formato, unidad o requisito cerca del campo | Correo electrónico |
| Ayuda | Añade un ejemplo en el placeholder cuando sea pertinente | nombre@ejemplo.mx |
| Error | Indica qué ocurrió y el siguiente paso comprobado | Selecciona un periodo escolar para consultar tu horario. |
| Confirmación | Nombra la acción y su efecto comprobado. Usa un verbo específico en el botón | ¿Enviar la solicitud a revisión? · Enviar solicitud |
| Notificación | Describe el resultado y quién continúa cuando se conozca | Solicitud enviada a Servicios Escolares. |
| Estado de carga o vacío | Distingue carga, ausencia de registros, resultado filtrado y error | Cargando calificaciones… |
| Accesibilidad | Nombra la función del control. Agrega el objeto cuando distinga varios controles | Cerrar, Descargar constancia (PDF) |
| Correo y PDF | Identifica el trámite y su estado. Comprueba interpolaciones, acentos y leyendas en la salida | Solicitud de beca recibida |

Usa alternativas que comuniquen la información de la imagen y un atributo alternativo vacío para imágenes decorativas. Comprueba teclado, foco y anuncio de estados y errores. Conserva el significado de las advertencias mientras se verifica el flujo.

## Revisión de cambios editoriales

1. Identifica el origen del texto. Puede estar en Blade, Vue, JS, un controlador, una traducción, una API, un catálogo o una biblioteca.
2. Revisa consumidores del literal antes de editar. Conserva claves, interpolaciones, marcadores, selectores, validaciones, estados y contratos. TNotify puede inferir la severidad por el texto. Un atributo aria-label puede ser el nombre accesible y también intervenir en pruebas.
3. Revisa el diff por módulo, ejecuta git diff --check, valida sintaxis y ejecuta pruebas con datos ficticios. Comprueba nombres accesibles, estados de control y desbordamientos.
4. Registra fuente y línea, cambio propuesto y motivo. Eleva las decisiones sobre nombres oficiales, catálogos, estados o reglas de negocio a la persona responsable del módulo.

## Revisión ortográfica automatizada propuesta

Evaluar Hunspell con el diccionario es_MX y un diccionario personal del TESVB versionado en UTF-8. Probarlo inicialmente en modo informativo sobre textos de interfaz extraídos con archivo y línea. Validar tildes, términos regionales y falsos positivos antes de usar el resultado en integración continua. Revisar gramática y adecuación en contexto.

Entradas iniciales para revisión institucional: TESVB, TecNM, EGEL, PIASE, CURP, CCT y reinscripción. Registrar para cada incorporación la grafía aprobada y su fuente. Evitar incorporar erratas, identificadores de código o frases completas como excepciones.

[Diccionario Hunspell es_MX](https://github.com/elastic/hunspell/blob/master/dicts/es_MX/README_es_MX.txt)
