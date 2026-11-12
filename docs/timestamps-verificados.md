# Timestamps confirmados en MariaDB

Fuente: resultados de information_schema.COLUMNS en MariaDB 10.4.32, base local tesvb, proporcionados por el usuario. No se consultaron ni ejecutaron seeders ni se realizaron operaciones contra la base de datos en esta continuación.

Se identificaron todos los modelos de las diez tablas en el inventario completo de 241 modelos de app/ y app/Models/. Existe un modelo por tabla:

| Tabla | Modelo | Corrección |
| --- | --- | --- |
| actcomple_jefaturas | App\Jefaturas | public $timestamps = false |
| amb_periodo_amb | App\amb_periodo_amb | public $timestamps = false |
| exp_bebidas | App\Tutorias_Exp_bebidas | public $timestamps = false |
| gnral_estados | App\Estados | public $timestamps = false |
| gnral_grupos | App\Gnral_grupos | public $timestamps = false |
| gnral_municipios | App\Municipios | public $timestamps = false |
| gnral_periodos | App\Periodos | public $timestamps = false |
| gnral_semestres | App\Semestres | public $timestamps = false |
| gnral_tipos_usuario | App\Gnral_Tipos_Usuario | public $timestamps = false |
| oc_oficio | App\oc_oficio | const CREATED_AT = null; timestamps permanece habilitado |

Las primeras nueve tablas no tienen created_at ni updated_at. Deshabilitar la generación automática evita que Eloquent intente escribir columnas inexistentes. Las lecturas de catálogos en datos_alumno, PDFlistasController y los controladores de tutorías conservan consultas y resultados. No se modifican atributos de negocio, claves, relaciones o filtros.

En la referencia Laravel 5.6 disponible (DorianReb/tesvb, commit 36da4037a7dd478d90a5e61e3cef48b8f7e505b1), los modelos compartidos mantenían timestamps habilitados por defecto. Esta referencia conserva la salvedad de procedencia documentada en criterios-evidencia-modelos.md. OficiosComisionController utiliza find y save al modificar oficios, tanto en esa referencia como en la migración. Por ello deshabilitar todos los timestamps en oc_oficio eliminaría una actualización automática válida. Se conserva updated_at y se deshabilita exclusivamente created_at mediante la constante que Laravel 12 comprueba antes de generar el atributo. Las consultas manuales mediante DB no cambian de comportamiento.

Pruebas: fixture actualizada únicamente para los nueve indicadores timestamps. Se mantienen las ocho claves primarias verificadas. Se añadieron aserciones para comprobar que oc_oficio conserva timestamps, no tiene columna de creación y genera updated_at para modelos nuevos y existentes; también se comprueba que respeta un updated_at asignado explícitamente. Son pruebas en memoria con conexión bloqueada, sin save ni escrituras reales. Resultado PHP 8.4.27: 3 pruebas, 2,844 aserciones, 241 modelos y 153 relaciones. Sintaxis de los diez modelos y el test modificado sin errores; git diff --check correcto.

Solo estas diez tablas tienen timestamps confirmados por los resultados comunicados. Las demás siguen pendientes de verificación real, sin inferencias basadas en seeders. No se modificaron controladores, tablas, otras claves ni relaciones; sin migraciones, seeders, merge ni push.
