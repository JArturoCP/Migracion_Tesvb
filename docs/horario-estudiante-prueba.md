# Prueba del horario del estudiante

El seeder `HorarioPruebaSistemasSeeder` crea una carrera de demostraci贸n de Sistemas,
ret铆cula, materia C谩lculo Diferencial, docente, edificio, aula, grupos, tres alumnos,
cargas acad茅micas y diez bloques de clase (lunes a viernes). Reutiliza el periodo
escolar vigente y crea uno si no existe. Tambi茅n agrega los cat谩logos m铆nimos y
un periodo de ingl茅s vigente si faltan, necesarios para entrar a `/home`.

Requiere la estructura TESVB ya importada. No crea ni modifica tablas y no requiere
ejecutar todos los seeders del proyecto. Solo permite `APP_ENV=local` o `testing`.
Los registros de demostraci贸n llevan el identificador DEMO HORARIO. Los registros
existentes se conservan; al repetirlo no se restablecen contrase帽as ni datos editados.

## Ejecutar

Comprueba que `DB_DATABASE` en tu `.env` apunta a tu base local de prueba y que
`APP_ENV=local`. Desde la carpeta del proyecto:

```shell
php artisan config:clear
php artisan db:seed --class=HorarioPruebaSistemasSeeder
php artisan serve
```

No necesitas ejecutar `migrate:fresh` ni borrar datos. Si aparece un error de
permisos de un trigger (`orivera`, por ejemplo), debe corregirse el permiso de su
DEFINER sobre esta base; cambiar a otro seeder no resuelve ese problema del servidor.

## Credenciales y resultados

La contrase帽a inicial para las cuentas nuevas es **`Horario.Prueba2026!`**.

| Usuario | Resultado en Mi horario |
| --- | --- |
| alumno1@horario.test | C谩lculo Diferencial, lunes a viernes de 08:00 a 09:00 |
| alumno2@horario.test | C谩lculo Diferencial, lunes a viernes de 09:00 a 10:00 |
| alumno3@horario.test | Sin clases programadas; muestra las tres materias pendientes |

Entra con cada alumno y selecciona **Mi horario** en su men煤. Tambi茅n puedes abrir
`/alumno/horario` despu茅s de iniciar sesi贸n. Cierra sesi贸n antes de cambiar de cuenta.
El grupo local de la carga es 1, 2 o 3; el grupo del alumno en el cat谩logo es 101,
102 o 103, siguiendo la convenci贸n del sistema.

Los bloques se crean pendientes de aprobaci贸n y la pantalla lo indica. Cada grupo
programado tiene diez horas semanales distribuidas entre tres materias: es una prueba funcional, no un semestre
completo. La consulta muestra las clases de la carga acad茅mica del alumno autenticado
en el periodo vigente; no incluye ingl茅s ni actividades extracurriculares.

Tambi茅n se crea `docente@horario.test` para vincular el docente a las clases. La prueba
cubre el acceso de estudiantes; no configura todos los m贸dulos del portal docente.

## Verificaci贸n automatizada

```shell
php vendor/bin/phpunit tests/Unit/HorarioEstudianteTest.php
```

Las pruebas usan SQLite en memoria, sin tocar MySQL. Verifican repetici贸n sin
duplicados, contrase帽a, separaci贸n entre grupos, alumno sin horario, rechazo a
usuarios de personal y exclusi贸n de periodos vencidos. No reemplazan la validaci贸n
manual de inicio de sesi贸n, presentaci贸n visual ni de los triggers de MariaDB.

## Materias adicionales

Repite el mismo comando del seeder para incorporar estos datos a una demo ya creada.
No borres los registros anteriores ni ejecutes migrate:fresh.

| Materia | D韆s | Alumno 1 | Alumno 2 | Docente |
| --- | --- | --- | --- | --- |
| C醠culo Diferencial | Lunes a viernes | 08:00-09:00 | 09:00-10:00 | DOCENTE DEMO HORARIO |
| Fundamentos de Programaci髇 | Lunes, mi閞coles y viernes | 10:00-11:00 | 12:00-13:00 | DOCENTE DEMO HORARIO 2 |
| Matem醫icas Discretas | Martes y jueves | 11:00-12:00 | 13:00-14:00 | DOCENTE DEMO HORARIO 3 |

La pantalla conserva los datos del estudiante y presenta la cuadr韈ula de 07:00 a
22:00, de lunes a s醔ado, con totales por franja y tabla de materias/docentes.
Se a馻den otros d韆s y franjas si tienen clases.
