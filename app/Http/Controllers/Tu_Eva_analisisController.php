<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eva_Tutor;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Storage;
use Session;

class Tu_Eva_analisisController extends Controller
{
    public function areas()
    {
        $per= Session::get('periodo_actual');
        return view('tutorias.eva_analisis.areas');
    }
    protected function analisis()
    {
        $per= Session::get('periodo_actual');


        $media = DB::selectOne('select  ROUND(avg(gestion),2) gestion,ROUND(avg(actitud),2) actitud, ROUND(avg(disponibilidad_confianza),2) disponibilidad_confianza, ROUND(avg(servicios_del_programa_de_tutoria),2) servicios_del_programa_de_tutoria, ROUND(avg(tus_logros_y_avances),2) tus_logros_y_avances from tu_eva_analisis_tutores');
        //dd($media);
        $moda = DB::selectOne('select gestion.gestion, actitud.actitud, disponibilidad_confianza.disponibilidad_confianza, servicios_del_programa_de_tutoria.servicios_del_programa_de_tutoria, tus_logros_y_avances.tus_logros_y_avances
                                    from (
                                        select gestion
                                        from tu_eva_analisis_tutores
                                        group by gestion
                                        having count(gestion) = (
                                            select max(frecuencia)
                                            from (select gestion, count(gestion) frecuencia
                                                 from tu_eva_analisis_tutores
                                                 group by gestion) as subconsulta)
                                        limit 1
                                    ) as gestion, (
                                        select actitud from tu_eva_analisis_tutores
                                        group by actitud
                                        having count(actitud) = (
                                            select  max(frecuencia)
                                            from (
                                                select actitud, count(actitud) frecuencia
                                                from tu_eva_analisis_tutores
                                                group by actitud
                                                 ) as subconsulta
                                        ) limit 1
                                    ) as actitud, (
                                        select disponibilidad_confianza from tu_eva_analisis_tutores
                                        group by disponibilidad_confianza
                                        having count(disponibilidad_confianza) = (
                                            select  max(frecuencia)
                                            from (
                                                select disponibilidad_confianza, count(disponibilidad_confianza) frecuencia
                                                from tu_eva_analisis_tutores
                                                group by disponibilidad_confianza
                                                 ) as subconsulta
                                        ) limit 1
                                    ) as disponibilidad_confianza, (
                                        select servicios_del_programa_de_tutoria from tu_eva_analisis_tutores
                                        group by servicios_del_programa_de_tutoria
                                        having count(servicios_del_programa_de_tutoria) = (
                                            select  max(frecuencia)
                                            from (
                                                select servicios_del_programa_de_tutoria, count(servicios_del_programa_de_tutoria) frecuencia
                                                from tu_eva_analisis_tutores
                                                group by servicios_del_programa_de_tutoria
                                                 ) as subconsulta
                                        ) limit 1
                                    ) as servicios_del_programa_de_tutoria, (
                                        select tus_logros_y_avances  from tu_eva_analisis_tutores
                                        group by tus_logros_y_avances
                                        having count(tus_logros_y_avances) = (
                                            select  max(frecuencia)
                                            from (
                                                select tus_logros_y_avances, count(tus_logros_y_avances) frecuencia
                                                from tu_eva_analisis_tutores
                                                group by tus_logros_y_avances
                                                 ) as subconsulta
                                        ) limit 1
                                    ) as tus_logros_y_avances');
        //dd($moda);

        $mediana = DB::selectOne('SELECT
                                        (SELECT gestion FROM
                                            (SELECT gestion, (@rownum1:=@rownum1+1) AS `row_number`, @total_rows
                                            FROM tu_eva_analisis_tutores, (SELECT @rownum1:=0) r, (SELECT @total_rows:=COUNT(*) FROM tu_eva_analisis_tutores) t
                                            ORDER BY gestion) AS subconsulta
                                            WHERE `row_number` IN (FLOOR((@total_rows + 1) / 2), FLOOR((@total_rows + 2) / 2))
                                            LIMIT 1
                                        ) AS gestion,
                                        (SELECT actitud FROM
                                            (SELECT actitud, (@rownum2:=@rownum2+1) AS `row_number`, @total_rows
                                            FROM tu_eva_analisis_tutores, (SELECT @rownum2:=0) r, (SELECT @total_rows:=COUNT(*) FROM tu_eva_analisis_tutores) t
                                            ORDER BY actitud) AS subconsulta
                                            WHERE `row_number` IN (FLOOR((@total_rows + 1) / 2), FLOOR((@total_rows + 2) / 2))
                                            LIMIT 1
                                        ) AS actitud,
                                        (SELECT disponibilidad_confianza FROM
                                            (SELECT disponibilidad_confianza, (@rownum3:=@rownum3+1) AS `row_number`, @total_rows
                                            FROM tu_eva_analisis_tutores, (SELECT @rownum3:=0) r, (SELECT @total_rows:=COUNT(*) FROM tu_eva_analisis_tutores) t
                                            ORDER BY disponibilidad_confianza) AS subconsulta
                                            WHERE `row_number` IN (FLOOR((@total_rows + 1) / 2), FLOOR((@total_rows + 2) / 2))
                                            LIMIT 1
                                        ) AS disponibilidad_confianza,
                                        (SELECT servicios_del_programa_de_tutoria FROM
                                            (SELECT servicios_del_programa_de_tutoria, (@rownum4:=@rownum4+1) AS `row_number`, @total_rows
                                            FROM tu_eva_analisis_tutores, (SELECT @rownum4:=0) r, (SELECT @total_rows:=COUNT(*) FROM tu_eva_analisis_tutores) t
                                            ORDER BY servicios_del_programa_de_tutoria) AS subconsulta
                                            WHERE `row_number` IN (FLOOR((@total_rows + 1) / 2), FLOOR((@total_rows + 2) / 2))
                                            LIMIT 1
                                        ) AS servicios_del_programa_de_tutoria,
                                        (SELECT tus_logros_y_avances FROM
                                            (SELECT tus_logros_y_avances, (@rownum5:=@rownum5+1) AS `row_number`, @total_rows
                                            FROM tu_eva_analisis_tutores, (SELECT @rownum5:=0) r, (SELECT @total_rows:=COUNT(*) FROM tu_eva_analisis_tutores) t
                                            ORDER BY tus_logros_y_avances) AS subconsulta
                                            WHERE `row_number` IN (FLOOR((@total_rows + 1) / 2), FLOOR((@total_rows + 2) / 2))
                                            LIMIT 1
                                        ) AS tus_logros_y_avances;
                                    ');

        return view('tutorias.eva_analisis.analisis',compact('media','moda','mediana'));
    }
    public function index()
    {
        $per= Session::get('periodo_actual');
        //dd($periodo);

        $query = ' SELECT per.nombre,per.sexo,gp.descripcion, str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\') fecha, year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\'))  as antiguiedad, per.escolaridad,
                           ROUND(((sum(gestion)*4)/(count(per.nombre)*16)),2) gestion,
                           round(((sum(actitud)*4)/(count(per.nombre)*28)),2) actitud,
                           round(((sum(disponibilidad_confianza)*4)/(count(per.nombre)*20)),2) disponibilidad_confianza ,
                           round(((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24)),2) servicios_del_programa_de_tutoria,
                           round(((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)),2) tus_logros_y_avances,
                           round(( (((sum(gestion)*4)/(count(per.nombre)*16))+((sum(actitud)*4)/(count(per.nombre)*28))+((sum(disponibilidad_confianza)*4)/(count(per.nombre)*20))+((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24))+((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)) )/5),2) as promedio,
                           round(((tea.satisfacion+tea.factores+tea.necesidades)/3),2) as promedio_autoEva
                    FROM
                        tu_eva_resultados_formulario fo
                    INNER JOIN exp_asigna_tutor tutor ON tutor.id_asigna_tutor = fo.id_asigna_tutor
                    inner join gnral_jefes_periodos gjp on tutor.id_jefe_periodo = gjp.id_jefe_periodo
                    INNER JOIN gnral_personales per ON per.id_personal = tutor.id_personal
                    inner join gnral_perfiles gp on per.id_perfil = gp.id_perfil
                    inner join tu_eva_autoevaluacion tea on fo.id_asigna_tutor = tea.id_asigna_tutor
                    WHERE year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\')) < 80 and gjp.id_periodo = ?
                    Group BY per.nombre
                    order by ( ((sum(gestion)*4)/(count(per.nombre)*16))+((sum(actitud)*4)/(count(per.nombre)*28))+((sum(disponibilidad_confianza)*4)/(count(per.nombre)*20))+((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24))+((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)) )/5 desc
                    limit 10;';
        //dd($query);

        $top_tutores = DB::select($query, [$per]);

        $menos_tutores = DB::select(' SELECT per.nombre,per.sexo,gp.descripcion, str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\') fecha, year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\'))  as antiguiedad, per.escolaridad,
                                                ROUND(((sum(gestion)*4)/(count(per.nombre)*16)),2) gestion,
                                               round(((sum(actitud)*4)/(count(per.nombre)*28)),2) actitud,
                                               round(((sum(disponibilidad_confianza)*4)/(count(per.nombre)*20)),2) disponibilidad_confianza ,
                                               round(((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24)),2) servicios_del_programa_de_tutoria,
                                               round(((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)),2) tus_logros_y_avances,
                                               round(( (((sum(gestion)*4)/(count(per.nombre)*16))+((sum(actitud)*4)/(count(per.nombre)*28))+((sum(disponibilidad_confianza)*4)/(count(per.nombre)*20))+((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24))+((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)) )/5),2) as promedio,
                                               round(((tea.satisfacion+tea.factores+tea.necesidades)/3),2) as promedio_autoEva
                                        FROM
                                            tu_eva_resultados_formulario fo
                                        INNER JOIN exp_asigna_tutor tutor ON tutor.id_asigna_tutor = fo.id_asigna_tutor
                                        inner join gnral_jefes_periodos gjp on tutor.id_jefe_periodo = gjp.id_jefe_periodo
                                        INNER JOIN gnral_personales per ON per.id_personal = tutor.id_personal
                                        inner join gnral_perfiles gp on per.id_perfil = gp.id_perfil
                                        inner join tu_eva_autoevaluacion tea on fo.id_asigna_tutor = tea.id_asigna_tutor
                                        WHERE year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\')) < 80
                                        and gjp.id_periodo = ?
                                        Group BY per.nombre
                                        order by ( ((sum(gestion)*4)/(count(per.nombre)*16))+((sum(actitud)*4)/(count(per.nombre)*28))+((sum(disponibilidad_confianza)*4)/(count(per.nombre)*20))+((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24))+((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)) )/5 asc
                                        limit 10', [$per]);

        $gestion = DB::select(' SELECT per.nombre,per.sexo,gp.descripcion, str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\') fecha, year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\'))  as antiguiedad, per.escolaridad,
                                    round((sum(gestion)*4)/(count(per.nombre)*16),2) gestion
                                    FROM
                                        tu_eva_resultados_formulario fo
                                    INNER JOIN exp_asigna_tutor tutor ON tutor.id_asigna_tutor = fo.id_asigna_tutor
                                    inner join gnral_jefes_periodos gjp on tutor.id_jefe_periodo = gjp.id_jefe_periodo
                                    INNER JOIN gnral_personales per ON per.id_personal = tutor.id_personal
                                    inner join gnral_perfiles gp on per.id_perfil = gp.id_perfil
                                    inner join tu_eva_autoevaluacion tea on fo.id_asigna_tutor = tea.id_asigna_tutor
                                    WHERE year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\')) < 80
                                    and gjp.id_periodo = ?
                                    Group BY per.nombre
                                    order by  ((sum(gestion)*4)/(count(per.nombre)*16)) asc
                                    limit 15 ', [$per]);


        $actitud = DB::select(' SELECT per.nombre,per.sexo,gp.descripcion, str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\') fecha, year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\'))  as antiguiedad, per.escolaridad,
                                               round(((sum(actitud)*4)/(count(per.nombre)*28)),2) actitud
                                    FROM
                                        tu_eva_resultados_formulario fo
                                    INNER JOIN exp_asigna_tutor tutor ON tutor.id_asigna_tutor = fo.id_asigna_tutor
                                    inner join gnral_jefes_periodos gjp on tutor.id_jefe_periodo = gjp.id_jefe_periodo
                                    INNER JOIN gnral_personales per ON per.id_personal = tutor.id_personal
                                    inner join gnral_perfiles gp on per.id_perfil = gp.id_perfil
                                    inner join tu_eva_autoevaluacion tea on fo.id_asigna_tutor = tea.id_asigna_tutor
                                    WHERE year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\')) < 80
                                    and gjp.id_periodo = ?
                                    Group BY per.nombre
                                    order by  ((sum(gestion)*4)/(count(per.nombre)*16)) asc
                                    limit 15; ', [$per]);

        $disponivilidad = DB::select(' SELECT per.nombre,per.sexo,gp.descripcion, str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\') fecha, year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\'))  as antiguiedad, per.escolaridad,
                                               round(((sum(disponibilidad_confianza)*4)/(count(per.nombre)*20)),2) disponibilidad_confianza
                                            FROM
                                                tu_eva_resultados_formulario fo
                                            INNER JOIN exp_asigna_tutor tutor ON tutor.id_asigna_tutor = fo.id_asigna_tutor
                                            inner join gnral_jefes_periodos gjp on tutor.id_jefe_periodo = gjp.id_jefe_periodo
                                            INNER JOIN gnral_personales per ON per.id_personal = tutor.id_personal
                                            inner join gnral_perfiles gp on per.id_perfil = gp.id_perfil
                                            inner join tu_eva_autoevaluacion tea on fo.id_asigna_tutor = tea.id_asigna_tutor
                                            WHERE year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\')) < 80
                                            and gjp.id_periodo = ?
                                            Group BY per.nombre
                                            order by  ((sum(gestion)*4)/(count(per.nombre)*16)) asc
                                            limit 15; ', [$per]);

        $servicios_del_programa_de_tutoria = DB::select(' SELECT per.nombre,per.sexo,gp.descripcion, str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\') fecha, year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\'))  as antiguiedad, per.escolaridad,
                                                                    round(((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24)),2) servicios_del_programa_de_tutoria
                                                                FROM
                                                                    tu_eva_resultados_formulario fo
                                                                INNER JOIN exp_asigna_tutor tutor ON tutor.id_asigna_tutor = fo.id_asigna_tutor
                                                                inner join gnral_jefes_periodos gjp on tutor.id_jefe_periodo = gjp.id_jefe_periodo
                                                                INNER JOIN gnral_personales per ON per.id_personal = tutor.id_personal
                                                                inner join gnral_perfiles gp on per.id_perfil = gp.id_perfil
                                                                inner join tu_eva_autoevaluacion tea on fo.id_asigna_tutor = tea.id_asigna_tutor
                                                                WHERE year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\')) < 80
                                                                and gjp.id_periodo = ?
                                                                Group BY per.nombre
                                                                order by ((sum(servicios_del_programa_de_tutoria)*4)/(count(per.nombre)*24)) asc
                                                                limit 15; ', [$per]);

        $logros = DB::select(' SELECT per.nombre,per.sexo,gp.descripcion, str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\') fecha, year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\'))  as antiguiedad, per.escolaridad,
                                         round(((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)),2) tus_logros_y_avances
                                    FROM
                                        tu_eva_resultados_formulario fo
                                    INNER JOIN exp_asigna_tutor tutor ON tutor.id_asigna_tutor = fo.id_asigna_tutor
                                    inner join gnral_jefes_periodos gjp on tutor.id_jefe_periodo = gjp.id_jefe_periodo
                                    INNER JOIN gnral_personales per ON per.id_personal = tutor.id_personal
                                    inner join gnral_perfiles gp on per.id_perfil = gp.id_perfil
                                    inner join tu_eva_autoevaluacion tea on fo.id_asigna_tutor = tea.id_asigna_tutor
                                    WHERE year(now())-year(str_to_date(per.fch_ingreso_tesvb,\'%Y/%m/%d\')) < 80
                                    and gjp.id_periodo = ?
                                    Group BY per.nombre
                                    order by ((sum(tus_logros_y_avances)*4)/(count(per.nombre)*36)) asc
                                    limit 15; ', [$per]);
        //$docentes = DB::select("  ");



        return view('tutorias.eva_analisis.index',compact('top_tutores', 'gestion','menos_tutores','actitud','disponivilidad','servicios_del_programa_de_tutoria','logros'));
    }
}
