<?php

Route::get('/', function () {
    //return view('welcome');
    return redirect('/home');
});
Auth::routes();
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');
Route::get('/home', 'HomeController@index');
Route::get('/n', 'HomeController@n');

//////////////RUTAS ACTIVIDADES COMPLEMENTARIAS////////////////////
//Rutas Alumnos
/*Route::get('/actividad_prueba',function(){
    $id_personal=Input::get($id_personal);

    $docentes=\App\DocentesActividad::where ('id_personal','=',$id_personal )->get();
    return Response::json($docentes);
});*/
Route::middleware('auth')->group(function () {
    Route::resource('/inicio', 'HomeController2');
    /*
    |--------------------------------------------------------------------------
    | Canalización por reprobación desde pantalla principal
    |--------------------------------------------------------------------------
    */
    Route::get('/canalizacion-reprobacion-principal', 'CanalizacionReprobacionPrincipalController@index')
        ->name('canalizacion_reprobacion_principal.index');
    Route::post('/canalizacion-reprobacion-principal/guardar', 'CanalizacionReprobacionPrincipalController@guardarCanalizacion')
        ->name('canalizacion_reprobacion_principal.guardar');


    /*
    |--------------------------------------------------------------------------
    | Desarrollo Académico - áreas de atención y horarios
    |--------------------------------------------------------------------------
    */
    Route::get('/desarrollo-academico/areas-atencion', 'DesarrolloAcademicoAreasAtencionController@index')
        ->name('desarrollo_academico.areas_atencion.index');
    Route::get('/desarrollo-academico/areas-atencion/buscar-personal', 'DesarrolloAcademicoAreasAtencionController@buscarPersonal')
        ->name('desarrollo_academico.areas_atencion.personal.buscar');
    Route::post('/desarrollo-academico/areas-atencion/area', 'DesarrolloAcademicoAreasAtencionController@guardarArea')
        ->name('desarrollo_academico.areas_atencion.area.guardar');
    Route::post('/desarrollo-academico/areas-atencion/area/{id}/desactivar', 'DesarrolloAcademicoAreasAtencionController@desactivarArea')
        ->name('desarrollo_academico.areas_atencion.area.desactivar');
    Route::post('/desarrollo-academico/areas-atencion/responsable', 'DesarrolloAcademicoAreasAtencionController@guardarResponsable')
        ->name('desarrollo_academico.areas_atencion.responsable.guardar');
    Route::post('/desarrollo-academico/areas-atencion/horario', 'DesarrolloAcademicoAreasAtencionController@guardarHorario')
        ->name('desarrollo_academico.areas_atencion.horario.guardar');
    Route::post('/desarrollo-academico/areas-atencion/horario/{id}/desactivar', 'DesarrolloAcademicoAreasAtencionController@desactivarHorario')
        ->name('desarrollo_academico.areas_atencion.horario.desactivar');
    Route::post('/desarrollo-academico/areas-atencion/responsable/{id}/desactivar', 'DesarrolloAcademicoAreasAtencionController@desactivarResponsable')
        ->name('desarrollo_academico.areas_atencion.responsable.desactivar');


    /*
    |--------------------------------------------------------------------------
    | PIASE - Atención y seguimiento de responsables de área
    |--------------------------------------------------------------------------
    | IMPORTANTE:
    | No se usan URLs /piase/... para responsables porque existe la carpeta
    | física public/piase/evidencias. Esa carpeta puede provocar conflicto
    | antes de que la petición llegue a Laravel.
    |
    | Se conservan dos familias de nombres:
    | - areas_atencion.mis_casos.*  => rutas principales del módulo
    | - piase.*                     => alias seguros que usa la vista actual
    |
    | Ambos apuntan al mismo controlador, pero con URLs distintas para evitar
    | que Laravel sobrescriba nombres de ruta por usar el mismo método y URI.
    */

    /* Rutas principales del módulo de responsables */
    Route::get('/areas-atencion/mis-casos', 'ResponsablesAreasAtencionController@index')
        ->name('areas_atencion.mis_casos.index');
    Route::get('/areas-atencion/mis-casos/buscar-estudiantes', 'ResponsablesAreasAtencionController@buscarEstudiantesAjax')
        ->name('areas_atencion.mis_casos.estudiantes.buscar');
    Route::post('/areas-atencion/mis-casos/agregar-canalizacion', 'ResponsablesAreasAtencionController@agregarCanalizacionEstudiante')
        ->name('areas_atencion.mis_casos.agregar_canalizacion');
    Route::post('/areas-atencion/mis-casos/canalizar', 'ResponsablesAreasAtencionController@canalizarArea')
        ->name('areas_atencion.mis_casos.canalizar');
    Route::post('/areas-atencion/mis-casos/sesion', 'ResponsablesAreasAtencionController@agregarSesion')
        ->name('areas_atencion.mis_casos.sesion');
    Route::post('/areas-atencion/mis-casos/sesion/editar', 'ResponsablesAreasAtencionController@editarSesion')
        ->name('areas_atencion.mis_casos.sesion.editar');
    Route::post('/areas-atencion/mis-casos/sesion/cancelar', 'ResponsablesAreasAtencionController@cancelarSesion')
        ->name('areas_atencion.mis_casos.sesion.cancelar');
    Route::post('/areas-atencion/mis-casos/actividad/guardar', 'ResponsablesAreasAtencionController@guardarActividad')
        ->name('areas_atencion.mis_casos.actividad.guardar');
    Route::post('/areas-atencion/mis-casos/actividad/actualizar', 'ResponsablesAreasAtencionController@actualizarActividad')
        ->name('areas_atencion.mis_casos.actividad.actualizar');
    Route::post('/areas-atencion/mis-casos/actividad/cancelar', 'ResponsablesAreasAtencionController@cancelarActividad')
        ->name('areas_atencion.mis_casos.actividad.cancelar');
    Route::post('/areas-atencion/mis-casos/evidencia/revisar', 'ResponsablesAreasAtencionController@revisarEvidencia')
        ->name('areas_atencion.mis_casos.evidencia.revisar');
    Route::post('/areas-atencion/mis-casos/cerrar-caso', 'ResponsablesAreasAtencionController@cerrarCaso')
        ->name('areas_atencion.mis_casos.cerrar');

    /* Alias seguros para vistas que aún usan route('piase.*') */
    Route::get('/areas-atencion/mis-casos/piase', 'ResponsablesAreasAtencionController@index')
        ->name('piase.index');
    Route::get('/areas-atencion/mis-casos/piase/buscar-estudiantes', 'ResponsablesAreasAtencionController@buscarEstudiantesAjax')
        ->name('piase.estudiantes.buscar');
    Route::post('/areas-atencion/mis-casos/piase/agregar-canalizacion', 'ResponsablesAreasAtencionController@agregarCanalizacionEstudiante')
        ->name('piase.agregar_canalizacion');
    Route::post('/areas-atencion/mis-casos/piase/canalizar', 'ResponsablesAreasAtencionController@canalizarArea')
        ->name('piase.canalizar');
    Route::post('/areas-atencion/mis-casos/piase/sesion', 'ResponsablesAreasAtencionController@agregarSesion')
        ->name('piase.sesion');
    Route::post('/areas-atencion/mis-casos/piase/sesion/editar', 'ResponsablesAreasAtencionController@editarSesion')
        ->name('piase.sesion.editar');
    Route::post('/areas-atencion/mis-casos/piase/sesion/cancelar', 'ResponsablesAreasAtencionController@cancelarSesion')
        ->name('piase.sesion.cancelar');
    Route::post('/areas-atencion/mis-casos/piase/actividad/guardar', 'ResponsablesAreasAtencionController@guardarActividad')
        ->name('piase.actividad.guardar');
    Route::post('/areas-atencion/mis-casos/piase/actividad/actualizar', 'ResponsablesAreasAtencionController@actualizarActividad')
        ->name('piase.actividad.actualizar');
    Route::post('/areas-atencion/mis-casos/piase/actividad/cancelar', 'ResponsablesAreasAtencionController@cancelarActividad')
        ->name('piase.actividad.cancelar');
    Route::post('/areas-atencion/mis-casos/piase/evidencia/revisar', 'ResponsablesAreasAtencionController@revisarEvidencia')
        ->name('piase.evidencia.revisar');
    Route::post('/areas-atencion/mis-casos/piase/cerrar-caso', 'ResponsablesAreasAtencionController@cerrarCaso')
        ->name('piase.cerrar');

    /*
    |--------------------------------------------------------------------------
    | PIASE - Vista del estudiante
    |--------------------------------------------------------------------------
    | Se mantiene /piase-estudiante porque no choca con public/piase.
    */
    Route::get('/piase-estudiante', 'PiaseEstudianteController@index')
        ->name('piase.estudiante.index');
    Route::post('/piase-estudiante/evidencia', 'PiaseEstudianteController@subirEvidencia')
        ->name('piase.estudiante.evidencia.subir');

    Route::resource('/consulta_actividades/', 'ConsultaRegActividadesController');
    Route::delete('/consulta_actividades_elimina/{id_registro_alumno}', 'Consulta_modificar_ActividadController@eliminar_registro');

    Route::resource('/evidencias_alumnos', 'EvidenciasAlumnosController');
    Route::get('/carga_evidencia/{arreglo}', 'EvidenciasAlumnosController@cargar_evidencias');

    Route::resource('/auditorias/responsables_implementar', 'AudSeguimientoController');
    Route::post('/auditorias/upload/{id}', 'AudSeguimientoController@upload')->name('aud_seguimiento.upload');
    Route::get('/auditorias/evidencia/descargar/{id}', 'AudSeguimientoController@downloadEvidencia')->name('aud_seguimiento.descargar');
    Route::get('/auditorias/responsables_revisar', 'AudSeguimientoController@revisar');
    Route::post('/auditorias/revisar/evaluar/{id}', 'AudSeguimientoController@evaluar')->name('aud_revisar.evaluar');
    Route::put('auditorias/responsables-multiples/{id}', 'AudResponsableAccionesController@updateMultiple');
    //Route::put('auditorias/editar-fecha/{id}', 'AudResponsableAccionesController@editarFechaDias');
    Route::get('/auditorias/notas_auditor', 'AudAuditorNotaController@index');
    //Route::post('/acciones/evaluar',  'AudAuditorNotaController@evaluar')->name('acciones.evaluar');
    Route::get('/auditorias/asignar_acciones', 'AudRevisorAccionesController@create')->name('auditorias.asignar_acciones');
    Route::post('/auditorias/asignar_acciones', 'AudRevisorAccionesController@store')->name('auditorias.guardar_accion');
    Route::delete('/auditorias/eliminar-asignacion/{id}', 'AudRevisorAccionesController@destroy')->name('auditorias.eliminar_asignacion');
    Route::get('/auditorias/revisar_acciones', 'AudRevisorAccionesController@revisarAcciones')->name('auditorias.revisar_acciones');
    Route::post('/auditorias/evaluar-accion/{id}', 'AudRevisorAccionesController@evaluarAccion')->name('auditorias.evaluar_accion');
    Route::get('/auditorias/asignar_lider', 'AudLiderAccionesController@create')->name('auditorias.asignar_lider');
    Route::post('/auditorias/asignar_lider', 'AudLiderAccionesController@store')->name('auditorias.asignar_lider.store');
    Route::delete('/auditorias/asignar_lider/{id}', 'AudLiderAccionesController@destroy')->name('auditorias.asignar_lider.destroy');
    Route::get('/auditorias/lider_acciones', 'AudLiderAccionesController@verAcciones')->name('auditorias.lider_acciones');
    Route::put('/auditorias/evaluar/{id}', 'AudLiderAccionesController@evaluar')->name('auditorias.evaluar');
    Route::post('/auditorias/lider_acciones/quitar_validacion/{id_responsable}', 'AudLiderAccionesController@quitarValidacion')
        ->name('auditorias.lider_acciones.quitar_validacion');
    Route::post('/auditorias/lider_acciones/cerrar_acciones_correctivas', 'AudLiderAccionesController@cerrarModuloAccionesCorrectivas')
        ->name('auditorias.lider_acciones.cerrar_acciones_correctivas');
    Route::post('/auditorias/lider_acciones/reactivar_acciones_correctivas', 'AudLiderAccionesController@reactivarModuloAccionesCorrectivas')
        ->name('auditorias.lider_acciones.reactivar_acciones_correctivas');
    Route::post('/auditorias/actualizar_responsable', 'AudAuditorNotaController@actualizarResponsable')->name('auditorias.actualizar_responsable');
//RUTA PARA GENERAR NO Y OP
    Route::get('/auditorias/lider_acciones/reporte_nc/{id_responsable}', 'AudLiderAccionesController@reporteNc')
        ->name('auditorias.lider_acciones.reporte_nc');
    Route::post('/auditorias/lider_acciones/reporte_nc/{id_responsable}/folio', 'AudLiderAccionesController@actualizarFolioF28')
        ->name('auditorias.lider_acciones.actualizar_folio_f28');
    Route::post('/auditorias/lider_acciones/reporte_nc/{id_responsable}/cerrar', 'AudLiderAccionesController@cerrarReporteF28')
        ->name('auditorias.lider_acciones.cerrar_reporte_f28');
    Route::get('/auditorias/lider_acciones/reporte_om/{id_responsable}', 'AudLiderAccionesController@reporteOm')
        ->name('auditorias.lider_acciones.reporte_om');
    Route::post('/auditorias/lider_acciones/reporte_om/{id_responsable}/cerrar', 'AudLiderAccionesController@cerrarReporteOm')
        ->name('auditorias.lider_acciones.cerrar_reporte_om');

    /*
    |--------------------------------------------------------------------------
    | SGOE - Seguimiento de auditorías
    |--------------------------------------------------------------------------
    | El líder puede ver todas las notas, planes, responsables y semáforos.
    | La persona asignada para seguimiento puede revisar acciones, registrar
    | notas y calificar cumplimiento.
    */
    Route::get('/auditorias/seguimiento_auditorias', 'AudSeguimientoAuditoriasController@index')
        ->name('auditorias.seguimiento_auditorias.index');

    Route::post('/auditorias/seguimiento_auditorias/asignar/{id_responsable}', 'AudSeguimientoAuditoriasController@asignarSeguimiento')
        ->name('auditorias.seguimiento_auditorias.asignar');

    Route::post('/auditorias/seguimiento_auditorias/accion/{id_plan_acciones}/nota', 'AudSeguimientoAuditoriasController@guardarNotaAccion')
        ->name('auditorias.seguimiento_auditorias.guardar_nota');

    Route::post('/auditorias/seguimiento_auditorias/accion/{id_plan_acciones}/integrar-informe', 'AudSeguimientoAuditoriasController@actualizarIntegracionInforme')
        ->name('auditorias.seguimiento_auditorias.integrar_informe');

    Route::post('/auditorias/seguimiento_auditorias/nota/{id_responsable}/integrar-informe', 'AudSeguimientoAuditoriasController@actualizarIntegracionInformeNota')
        ->name('auditorias.seguimiento_auditorias.integrar_informe_nota');

//RUTA PARA ABRIR ARCHIVOS ALUMNOS
    Route::get('archivo_alumno/{id_file}', function ($id_file) {
        $mensaje = 'El documento no se encuentra disponible. Contacte al líder o al administrador del sistema.';

        $nombreArchivo = basename($id_file);
        $filename = 'ArchivosAlumnos/' . $nombreArchivo;

        $posiblesRutas = [
            base_path($filename),
            public_path($filename),
            storage_path('app/' . $filename),
        ];

        $rutaFinal = null;

        foreach ($posiblesRutas as $ruta) {
            if ($ruta && file_exists($ruta) && is_file($ruta) && is_readable($ruta)) {
                $rutaFinal = $ruta;
                break;
            }
        }

        if (!$rutaFinal) {
            return redirect()->back()
                ->with('error', $mensaje)
                ->with('flash_notification.message', $mensaje)
                ->with('flash_notification.level', 'warning');
        }

        $mime = function_exists('mime_content_type') ? mime_content_type($rutaFinal) : 'application/octet-stream';

        return Response::make(file_get_contents($rutaFinal), 200, [
            'Content-Type' => $mime ?: 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . $nombreArchivo . '"'
        ]);
    });
    Route::resource('/liberacion_alumno', 'LiberacionAlumnosActividadesController');
    Route::resource('/creditos', 'CreditosSemestresController');
//Rutas Subrireccion
    Route::resource('nueva_actividad', 'RegistrarActSubController');
    Route::post('nueva_categoria', 'RegistrarActSubController@categoria');
    Route::resource('/solicitud_alumnos', 'SolicitudAlumnosSubController');
    Route::get('/edita_sub_aceptar/{arreglo}', 'SolicitudAlumnosSubController@modifica_jefe');
    Route::get('/ed_sub/{arreglo}', 'SolicitudAlumnosSubController@modifica_jefe_no');
    Route::resource('/datos_estadisticos', 'DatosEstadisticosSubController');
    Route::resource('/datos_historicos_graficos', 'DatosGraficosHistoricos');
    Route::get('/generar_excel', 'DatosGraficosHistoricos@excelAlumnosActividades');
//Rutas Jefe de Division
    Route::resource('/docente_actividad', 'DocenteActividadJefeController');
    Route::get('/docente_nueva_actividad', function () {
        $id_actividad = Input::get('id_actividad');
        $categoriass = \App\ActividadesComplementarias::where('id_categoria', '=', $id_actividad)->get();
        return Response::json($categoriass);
    });
    //rutas para analisis de reprobacion jefes
    Route::get('/analisis-reprobacion', 'AnalisisReprobacionController@index')
        ->name('j_carrera.analisis_reprobacion.index');

    Route::get('/analisis-reprobacion/grafica/{idMateria}', 'AnalisisReprobacionController@grafica')
        ->name('j_carrera.analisis_reprobacion.grafica');

    Route::post('/analisis-reprobacion/estrategia', 'AnalisisReprobacionController@guardarEstrategia')
        ->name('j_carrera.analisis_reprobacion.estrategia');

    Route::post('/analisis-reprobacion/corte', 'AnalisisReprobacionController@generarCorte')
        ->name('j_carrera.analisis_reprobacion.corte');

    Route::get('/analisis-reprobacion/exportar-reprobados', 'AnalisisReprobacionController@exportarReprobadosExcel')
        ->name('j_carrera.analisis_reprobacion.exportar_reprobados');
    Route::get('/analisis-reprobacion/grafica-unidades/{idMateria}/{grupo}', 'AnalisisReprobacionController@graficaUnidades')
        ->name('j_carrera.analisis_reprobacion.grafica_unidades');
    //hasta aqui rutas de reprobacion
    Route::resource('/alumnos_actividades', 'SolicitudAlumnosJefeController');
    Route::resource('/libera_planeacion', 'LiberaPlaneacionJefeController');
    Route::get('/edita_planeacion/{arreglo}', 'LiberaPlaneacionJefeController@planeacion_jefe');
//Route::get('/planeacion_si/{arreglo}','LiberaPlaneacionJefeController@planeacion_jefe_si');
    Route::resource('/constancias', 'LiberaActividadJefeController');
    Route::resource('/constancia_gen', 'ActividadesGenralesController');
    Route::get('/constancias_todas', 'TodasConstancias@constancias');
//////RUTAS PARA CONTANCIAS EN PDF/////
    Route::resource('Constancia', 'ConstanciaIndividual');
    Route::resource('ConstanciaGeneral', 'ConstanciaGeneral');
//////////////////////////////////////////////
/////////////RUTA PARA CAMBIAR PERIODO///////
    Route::get('/periodo/{id_periodo}', 'HomeController@recargaperiodo');
//////////////////////////////////////777
    Route::get('/constancias_si/{arreglo}', 'LiberaActividadJefeController@constancias_si');
//Route::get('/constancias_no/{arreglo}','LiberaActividadJefeController@constancias_no');
    Route::resource('/datos_historicos', 'DatosHistoricosJefeController');
    Route::get('/edita_jefe_aceptar/{arreglo}', 'SolicitudAlumnosJefeController@modifica_jefe');
//Route::get('/ed/{arreglo}','SolicitudAlumnosJefeController@modifica_jefe_no');
//Rutas de Profesor
    Route::resource('/planeacion_actividad', 'PlaneaActividadProfController');
    Route::resource('/consulta_general', 'ConsultaGenralProfController');
    Route::get('/insercion_datos/{arreglo}', 'ConsultaGenralProfController@datos');
///RUTA PARA ABRIR ARCHIVOS EN NAVEGADOR DEL PROFESOR/////
    Route::get('archivo_docente/{id_file}', function ($id_file) {
        $mensaje = 'El documento no se encuentra disponible. Contacte al líder o al administrador del sistema.';

        $nombreArchivo = basename($id_file);
        $filename = 'ArchivosDocentes/' . $nombreArchivo;

        $posiblesRutas = [
            base_path($filename),
            public_path($filename),
            storage_path('app/' . $filename),
        ];

        $rutaFinal = null;

        foreach ($posiblesRutas as $ruta) {
            if ($ruta && file_exists($ruta) && is_file($ruta) && is_readable($ruta)) {
                $rutaFinal = $ruta;
                break;
            }
        }

        if (!$rutaFinal) {
            return redirect()->back()
                ->with('error', $mensaje)
                ->with('flash_notification.message', $mensaje)
                ->with('flash_notification.level', 'warning');
        }

        $mime = function_exists('mime_content_type') ? mime_content_type($rutaFinal) : 'application/pdf';

        return Response::make(file_get_contents($rutaFinal), 200, [
            'Content-Type' => $mime ?: 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $nombreArchivo . '"'
        ]);
    });

////////////////////////RUTAS EVALUACION DOCENTE////////////////
//Route::post('/desactivar/periodo_modificacion_carga/{id}','validacion_de_cargaController@desactivar_periodo_remplazo');
    Route::post('/activar/periodo_modificacion_carga/{id}', 'validacion_de_cargaController@activar_periodo_remplazo');
    Route::post('/modificar/estado_carga/', 'validacion_de_cargaController@estado_carga');
    Route::post('/baja/alumno_baja/', 'validacion_de_cargaController@alumno_baja');
    Route::get('/calificar_estudiante/{id_carga}', 'validacion_de_cargaController@calificar_estudiante');
    Route::get('/calificar_estudiante_duales_actuales/{id_carga}', 'validacion_de_cargaController@calificar_estudiante_duales_actuales');
    Route::post('/terminar_calificar/duales_actuales/{id_alumno}/{id_periodo}', 'validacion_de_cargaController@terminar_calificar_duales_actuales');
    Route::post('/modificar_mentor/{id_alumno}/{id_periodo}', 'validacion_de_cargaController@modificar_mentor');
    Route::get('/acta_dual_actual/{id_alumno}/{id_periodo}', 'Cal_pdf_acta_dualController@acta_dual_actual');
    Route::get('/acta_materias/{id_alumno}/{turno}/{semestre}/{grupo}', 'Cal_pdf_acta_alumnoController@acta_materias');

    Route::resource('/desactivar', 'validacion_de_cargaController@desactivar');
    Route::get('/activar', 'Buscar_alumnos@activar');
    Route::get('/cuenta_alumno/{cuenta}', 'datos_alumno@buscarcuenta');
    Route::get('/periodo/{id_periodo}', 'HomeController@recargaperiodo');
    Route::resource('/datos_alumno', 'datos_alumno');
    Route::post('/datos_alumnos/registrar_cct/{id_alumno}', 'datos_alumno@guardar_cct');
    Route::get('/datos_alumnos/modificar_cct/{id_alumno}', 'datos_alumno@modificar_cct');
    Route::post('/datos_alumnos/guardar_mod_cct/{id_alumno}', 'datos_alumno@guardar_mod_cct');


    Route::get('/agregar_escuelas_procedencia/', 'datos_alumno@agregar_escuelas');
    Route::post('/registrar/escuela_procedencia/', 'datos_alumno@registrar_escuela');
    Route::get('/escuela_procedencia/modificar/{id_escuela}', 'datos_alumno@modificar_escuela');
    Route::post('/modificacion/escuela_procedencia/', 'datos_alumno@modificacion_escuela');

    Route::get('/cct/registros/', 'datos_alumno@registros_cct');
    Route::get('/cct/registros_modificar/{id_institucion}', 'datos_alumno@registros_modificar');
    Route::post('/cct/guardar_modificacion/', 'datos_alumno@guardar_modificacion_cct');
    Route::post('/cct/guardar_institucion_educativa/', 'datos_alumno@guardar_institucion_educativa');

    Route::resource('/validacion_de_carga', 'validacion_de_cargaController');
    Route::resource('/carga_academica', 'carga_academicaController');
//////////////////RUTA PARA IMPRIMIR CARGA ACADEMICA/////////////////
    Route::resource('/imprime_carga', 'pdf_carga_academica');
    Route::get('/imprime_control/{id_alumno}', 'pdf_carga_academica_control@index');

    Route::post('/imprime_grafica', 'pdf_reporte_grafica@index');
///alumno revisa su carga academica
    Route::resource('/checar_carga', 'checar_cargaController');
    Route::resource('/checar_cargau', 'checar_cargaController');
    Route::resource('/checar', 'checar_cargaController');
    Route::get('/enviar_carga/{id}', 'checar_cargaController@enviarcarga');
    Route::get('/enviar_carga_jefe_division/{id}', 'checar_cargaController@enviarcargajefe');
    Route::get('/revicion_control_escolar/{id}', 'checar_cargaController@revicion');

    /////////////////////////
    Route::get('/revicion_carga_jefe/', 'checar_cargajefeController@index');
    Route::get('/revicion_carga_estudiante/{id_alumno}/{id_semestre}', 'checar_cargajefeController@revicion_carga_estudiante');
    Route::put('/validacion_de_jefe_estudiante/{id}', 'checar_cargajefeController@validacion_de_jefe_estudiante');
    /* RUTA PARA AUTORIZAR LA CARGA ESTUDIANTE DUAL*/
    Route::put('/autorizar_carga_dual/{id}','checar_cargaController@autorizarCargaDual');

    /// ///////
    Route::get('/ajax-subcat', function () {

        $id_estado = Input::get('id_estado');
        $municipios = \App\Municipios::where('id_estado', '=', $id_estado)->get();
        return Response::json($municipios);
    });
    Route::get('/ajax/{arreglo}', 'checar_cargaController@insertarvarios');//{

    Route::get('pdf', function () {

        $pdf = PDF::loadView('vista');
        return $pdf->stream();
        return $pdf->stream();
    });

    Route::get('/reticulas/{reti}', 'carga_academicaController@consultas');
//////////////////////Evaluacion por parte del alumno////////////////
    Route::resource('/evaluacion_alumno', 'evaluacion_alumnoController');
//insercion de preguntas
    Route::get('/insertar/{arreglo}', 'evaluacion_alumnoController@insertar');
    Route::get('/insertaralumno_materia/{arreglo}', 'evaluacion_alumnoController@insertaralumno_materia');
    //////////////////////////EVALUA/tutorias/reportecoordinador/tutorias_reportesemestralinstitucionalCION DOCENTE GUARDAR COMENTARIOS//////////////////////////////
    Route::post('/evaluacion_alumno/guardar_comentario','evaluacion_alumnoController@guardar_comentario');
    Route::resource('/comentarios_docentes', 'Eva_docentes_comentario');
    Route::get('/reporte_comentario_docente/{id_docente}', 'Reporte_Docentes_ComentariosController@index');
    Route::get('/ver_comentario_docente/{id_docente}/{id_grupo}/{grupo}/{id_materia}', 'Reporte_Docentes_ComentariosController@ver_grupos');
//buscar
    Route::resource('/buscar_profesores', 'Buscar_profesores');
    Route::resource('/buscar_profesores_carrera', 'Profesores_por_carrera');
    Route::resource('/buscar_alumnos', 'Buscar_alumnos');
    Route::get('/reportes/{id_profesor}', 'reportes_controller@index');
    Route::get('/porcarrera/{id_carreras}', 'reportes_controller@consulta_carreras');
    Route::get('/promedio/{id_profesor}', 'reportes_controller@suma_evaluacion');
    Route::get('/promedio_carrera/{id_profesor}', 'reportes_controller@suma_evaluacion_por_carrera');
    Route::resource('/imprecion', 'reportes_controller@imprecion');

    Route::resource('/Migrar', 'Migrar');

    Route::get('/reportes2/{id_profesor}/{condi}/{carre}', 'reportes_controller2@index');


//////////////////////RUTAS HORARIOS///////
    Route::resource('/docentes/create', 'DocentesAgController');

    Route::resource('/generales/situaciones', 'SituacionController');
    Route::resource('/generales/personales', 'TipoPersonalController');
    Route::resource('/generales/perfiles', 'PerfilController');
    Route::resource('/generales/edificios', 'EdificioController');
    Route::resource('/generales/carreras', 'CarreraController');
    Route::resource('/generales/cargos', 'CargoController');
    Route::resource('/generales/extra_clases', 'ExtraClaseController');
    Route::resource('/generales/aulas', 'AulaController');
    Route::resource('/generales/jefaturas', 'JefaturaController');
    Route::get('/aulas/estados/{id}', 'AulaController@estado');
    Route::resource('/reticulass', 'ReticulaController');
    Route::get('/reticulass_elimina/{id}', 'ReticulaController@destroy');
    Route::post('/agregar_materias/', 'ReticulaController@store');
    Route::get('reticulasmo/{id}/edit', 'ReticulaController@edit');
    Route::get('ver/reticulas/{id}', 'ReticulaController@mostrar_reticulas');
    Route::get('ver/materias/directivo/{idc}/{idr}', 'ReticulaController@mostrar_reticulas_direc');
    Route::get('ver/reticulas/directivo/{id}', 'ReticulaController@mostrar_reticulasd');
    Route::get('agrega/reticulas/{name}', 'ReticulaController@agrega_reticulas');
    Route::resource('/docente', 'DocentesController');
    Route::get('/docentes/modificar/', 'DocentesController@modificar_docentes');
    Route::resource('/docentes/create', 'DocentesAgController');
    Route::delete('/docente/eliminar/{id}', 'DocentesController@eliminar');
    Route::get('/docentes/perfiles/{perfil}', 'DocentesAgController@perfiles');
    Route::get('/docentes/cargos/{cargo}/{abre}', 'DocentesAgController@cargos');
    Route::get('/docentes/abreviaciones/{abrevia}', 'DocentesAgController@abreviaciones');
    Route::get('/docentes/situaciones/{situacion}/{abre}', 'DocentesAgController@situaciones');
    Route::get('/docentes/materias/{idprof}', 'MateriasPerfilController@index');
    Route::post('/agrega/materias_perfil', 'MateriasPerfilController@agrega_materias');
    Route::resource('/horarios/armar_horarios', 'ArmarHorariosController');
    Route::resource('/armar_horarios', 'ArmarHorariosController@armar_horarios');
    Route::post('/agrega_horario', 'ArmarHorariosController@store');
    Route::post('/elimina_horario', 'ArmarHorariosController@destroy');
    Route::get('/ver/profesores/{id}', 'ArmarHorariosController@mostrar_profesores');
    Route::get('/crear_pdf/{prof}/{init_periodo}/{tiempo}/{fin_periodo}', 'PdfHorariosController@index');
    Route::get('/pdf_aulas/{id_carrera}/{id_aula}', 'PdfHorariosController@aulas');
    Route::get('/pdf_grupos/{sem}/{grupo}/{carr}', 'PdfHorariosController@gruposs');
    Route::get('/ver/doc_aulas/{aula}', 'ArmarHorariosController@doc_aulas');
    Route::post('/crear_horarios', 'ArmarHorariosController@redireccionar');
    Route::get('/agrega/act/{tipo}/{id}/{n}', 'ArmarHorariosController@agrega_actividad');
    Route::resource('/plantilla/docentes', 'DocentesPlantillaController');
    Route::resource('/plantilla/ver', 'DocentesPlantillaVerController');
    Route::get('/plantilla/datos/{id_carrera}/{id_cargo}', 'DocentesPlantillaVerController@show');
    Route::get('/plantilla/horario/{id}', 'DocentesPlantillaVerController@plantilla_horarios');
    Route::get('/graficas/{idp}/{idc}', 'DocentesPlantillaVerController@graficas');
    Route::get('/graficas_admin/{idp}/{idc}', 'DocentesPlantillaEduController@graficas');
    Route::resource('/plantilla/educativa', 'DocentesPlantillaEduController');
    Route::get('/aprobar_act/{hr}/{act}', 'DocentesPlantillaEduController@aprobar');
    Route::get('/p_educativa/datos/{carrera}/{cargo}', 'DocentesPlantillaEduController@show');
//jefaturas
    Route::resource('/horarios/hrs_grupos/jefes', 'HrsGruposJController');
    Route::get('/horarios_grupos/jefes/{semestre}/{grupo}', 'HrsGruposJController@horarios_grupos');
    Route::resource('/horarios/hrs_aulas/jefes', 'HrsAulasJController');
    Route::get('/horarios_aulas/jefes/{aula}', 'HrsAulasJController@horarios_aulas');
    Route::get('/hrs_carrera', 'ProfMatController@hrs_carrera');
    Route::get('/hrs_carrera/categoria/{categoria}', 'ProfMatController@categorias');
//directivo
    Route::resource('/horarios/horarios_docentes', 'HrsDocentesController');
    Route::get('/horarios_docentes/{docente}', 'HrsDocentesController@horarios_docentes');
    Route::resource('/horarios/hrs_grupos', 'HrsGruposController');
    Route::get('/horarios_grupos/{semestre}/{grupo}/{carrera}', 'HrsGruposController@horarios_grupos');
    Route::resource('/horarios/hrs_aulas', 'HrsAulasController');
    Route::get('/horarios_aulas/{carrera}/{aula}', 'HrsAulasController@horarios_aulas');
    Route::resource('/profesores/materias', 'ProfMatController');
    Route::get('/excel/prof-mat', 'ProfMatController@excel');
    Route::resource('/formatos/con_edu', 'ConcentradoEduController');
    //Route::resource('/formatos/concentrado_aca', 'ConcentradoAcaController');
    Route::resource('/formatos/distribucion', 'DistribucionController');
    Route::get('/distribucion/{carrera}', 'DistribucionController@show');
    Route::resource('/formatos/relacion', 'RelacionController');
    Route::resource('/relacion/ver', 'RelacionController');
    Route::get('/excel_concentrado', 'ConcentradoEduController@excel');
    Route::get('/excel_distribucion', 'DistribucionController@excel');
    Route::get('/excel_relacion', 'RelacionController@excel');
    //  Route::get('/excel_plantilla/{carrera}/{cargo}', 'DocentesPlantillaVerController@excel');
    Route::get('/excel_plantilla/{carrera}/{cargo}', 'DocentesPlantillaVerController@excel1');

    Route::get('/pdf_estructura', 'PdfHorariosController@estructura');
    Route::get('/pdf_plantilla/{cargo}', 'PdfHorariosController@plantilla');
    Route::post('/comprueba/creditos', 'ArmarHorariosController@comprobar_creditos');
    Route::get('/recarga_personal/{idcarrera}', 'HomeController@recargapersonal');
    Route::get('/agregando/cantidad/{iddis}/{cant}', 'DistribucionController@agregar_cantidad');
    Route::get('/cambiar/caso/{idh}/{caso}', 'RelacionController@agregar_caso');
    Route::get('/cambiar/causa/{idh}/{causa}', 'RelacionController@agregar_causa');
    Route::resource('/personales', 'Personales');
    Route::resource('/persona', 'Personales');
    Route::resource('/personalesu', 'Personales');
    Route::get('/datos_academicos/{id}', 'DocentesController@editar');
    Route::get('/modifica_datos/{c}/{hm}/{hmi}', 'DocentesController@actualizar');

    Route::resource('/formatos/horas_docentes/', 'Hrs_docentesClasesController');
    Route::get('/formatos/excel_horas_docentes/', 'Hrs_docentesClasesController@excel_horas_docentes');

/////// HS777   ///////
///  Docente
    Route::get('/docente/regperiodos/{id_unidad}/{id_materia}/{id_grupo}', 'DocentesAgController@registro_periodo');
    Route::get('/docente/{id_docente}/carreras', 'DocentesAgController@carreras');
    Route::get('/docente/acciones/periodo/{id_docente}/{id_materia}/{id_grupo}', 'DocentesAgController@periodos_materia');
    Route::get('/docente/acciones/calificacion/{id_docente}/{id_materia}/{id_grupo}', 'DocentesAgController@calificarunidad');
    Route::get('/docente/{id_docente}/{id_materia}/{id_semestre}/{id_grupo}/{nom_carrera}/sumativas', 'DocentesAgController@evaluacionSumativa');
    Route::post('/docente/acciones/crear_periodos', 'DocentesAgController@generaPeriodo');
    Route::get('/docente/acciones/modificar_periodo/{id_unidad}/{id_materia}/{id_grupo}/{id_docente}', 'DocentesAgController@modificacionPeriodo');
    Route::post('/docente/acciones/modificar_periodo', 'DocentesAgController@modificaPeriodo');
    Route::post('/docente/acciones/{id_docente}/{id_materia}/{id_grupo}/{id_unidad}/insert_calificacion', 'DocentesAgController@inserta');
    Route::post('/docente/acciones/{id_docente}/{id_materia}/{id_grupo}/sumativas', 'DocentesAgController@Sumativas');
    Route::get('/generar_pdf', 'PDFCalificacionesController@generaCalificaciones');
    Route::get('/generar_pdf_sumativas', 'PDFCalificacionesController@generaCalSumativas');
    Route::get('genera_listas/{id_docente}/{id_materia}/{id_grupo}/{unidades}', 'PDFlistasController@generaListas');

    Route::post('/docente/guardar_sin_alumnos_ensumativa/{id_docente}/{id_materia}/{id_grupo}', 'DocentesAgController@guardar_sin_alumnos_ensumativa');


    ///reportes tutorias
    /// reporte/reporte_docente
    Route::get('reportes/reporte_docente/{id_docente}/{id_materia}/{id_grupo}/', 'PDFlistasController@reporteDocente');
    Route::get('reportes/reporte_canalizacion/{id_docente}/{id_materia}/{id_grupo}/', 'PDFlistasController@reporteCanalizacion');
    Route::get('reportes/reporte_tutor/{id_docente}/{id_materia}/{id_grupo}/', 'PDFlistasController@reporteTutor');

/////// Servicios escolares
    Route::get('/servicios_escolares', 'SEscolaresController@index');
    Route::get('/servicios_escolares/carreras_calificaciones', 'SEscolaresController@carreras_calificaciones');
    Route::get('/servicios_escolares/evaluaciones/{id_carrera}', 'SEscolaresController@evaluaciones');
    Route::get('/servicios_escolares/evaluaciones_academicas', 'SEscolaresController@evaluaciones_academicas');
    Route::get('/servicios_escolares/acciones_academico/{id_docente}/{id_materia}/{id_grupo}', 'SEscolaresController@acciones_academico');
    Route::get('/servicios_escolares/acciones/periodos/{id_docente}/{id_materia}/{id_grupo}/{id_carrera}', 'SEscolaresController@periodos_profesores');
    Route::get('/servicios_escolares/acciones/{id_docente}/{id_materia}/{id_grupo}/{id_carrera}', 'SEscolaresController@acciones');
    Route::get('/servicios_escolares/acciones_sumativa/{id_docente}/{id_materia}/{id_grupo}/{id_carrera}', 'SEscolaresController@acciones_sumativas');
    Route::get('/servicios_escolares/estadisticas', 'SEscolaresController@estadisticas');
    Route::get('/servicios_escolares/estadisticas/genero', 'SEscolaresController@estadisticas_genero');
    Route::get('/servicios_escolares/estadisticas/edad', 'SEscolaresController@estadisticas_edad');
    Route::get('/servicios_escolares/estadisticas/municipios', 'SEscolaresController@estadisticas_municipios');
    Route::get('/servicios_escolares/estadisticas/carreras_indice_reprobacion', 'SEscolaresController@carreras_indice_reprobacion');
    Route::get('/servicios_escolares/estadisticas/indice_reprobacion/{id_carrera}', 'SEscolaresController@estadisticas_indice_reprobacion');
    Route::get('/servicios_escolares/estadisticas/indice_reprobacion_semestre_materia/{id_carrera}/{id_semestre}', 'SEscolaresController@estadisticas_indice_reprobacion_sem');

    Route::get('/servicios_escolares/estadisticas/indice_reprobacion_semestre/{id_carrera}/{id_semestre}', 'SEscolaresController@estadisticas_indice_reprobacion_sem');
    Route::get('/servicios_escolares/acciones/{id_docente}/{id_materia}/generar_periodo', 'SEscolaresController@generaPeriodo');
    Route::get('/servicios_escolares/acciones/{id_docente}/{id_materia}/modificar_periodo', 'SEscolaresController@modificaPeriodo');
    Route::get('/servicios_escolares/actualizaCalificacion', 'SEscolaresController@modificaCalificacion');
    Route::get('/servicios_escolares/modificaCalificacionSumativa', 'SEscolaresController@modificaCalificacionSumativa');
    Route::get('/generar_excel/acta_constitutiva/{id_profesor}/{id_materia}/{id_grupo}', 'Cali_actaController@acta_constituitiva');
    Route::get('/generar_excel/acta_constitutiva_sumativa/{id_profesor}/{id_materia}/{id_grupo}', 'Cali_actaController@acta_constituitiva_sumativa');
    //  Route::get('/generar_excel/acta_sumativa/{id_profesor}/{id_materia}/{id_grupo}', 'Cali_actaController@acta_sumativa');
    // Route::get('/generar_excel/alumnos', 'ExcelController@exportAlumnos');
    // Route::get('/generar_excel/municipios', 'ExcelController@exportMunicipios');
    //Route::get('/generar_excel/edades', 'ExcelController@exportEdades');
    Route::get('/generar_excel/indrep', 'ExcelController@exportIndRep');
    Route::get('/generar_excel/datos_generales/', 'ExcelController@exportDatosGeneralesAlumnos');
    Route::get('/servicios_escolares/bitacora_periodos', 'SEscolaresController@bitacoraPeriodos');
    Route::get('/servicios_escolares/bitacora_evaluaciones', 'SEscolaresController@bitacoraEvaluaciones');
    Route::get('/servicios_escolares/bitacora_evaluaciones_sumativas', 'SEscolaresController@bitacoraEvaluaciones_sumativas');
    Route::get('/servicios_escolares/genperiodoSumativas', 'SEscolaresController@genperiodoSumativas');
    Route::get('/servicios_escolares/periodoSumativas/{id_periodo_sum}/modifica', 'SEscolaresController@modperiodoSumativas');

    Route::get('/servicios_escolares/excel_datos', 'Datos_Generales_al_excelController@export');
    Route::get('/generar_excel/alumnos', 'Datos_Generales_al_excelController@exportAlumnos');
    Route::get('/generar_excel/municipios', 'Datos_Generales_al_excelController@exportMunicipios');
    Route::get('/generar_excel/edades', 'Datos_Generales_al_excelController@exportEdades');

    Route::resource('/servicios_escolares/alumnos/carrera', 'Datos_GeneralesalumnosController');
    Route::get('/servicios_escolares/alumnos/generales/{id}', 'Datos_GeneralesalumnosController@datosgeneralesal');
    Route::get('/servicios_escolares/alumnos/mostrar/{id}', 'Datos_GeneralesalumnosController@mostrar');
    Route::get('/servicios_escolares/alumnos/mostrar_calificaciones/{id_alumno}', 'Datos_GeneralesalumnosController@mostrar_calificaciones');
    Route::resource('/servicios_escolare/concentrados_calificaciones/', 'Cal_concentrado_calificacionesController');
    Route::get('/servicios_escolares/modificaciones_cargas_cademicas/', 'Cal_concentrado_calificacionesController@modificaciones_cargas_cademicas');

    Route::get('/servicios_escolares/concentrado_calificaciones/semestres/{id_semestre}', 'Cal_concentrado_calificacionesController@concentrado_calificaciones');
    Route::get('/servicios_escolares/concentrado_calificaciones/materias/{id_carrera}/{id_semestre}/{id_grupo}', 'Cal_concentrado_calificacionesController@concentrado_materias');
    Route::get('/servicios_escolares/concentrado_calificaciones_excel/{id_carrera}/{id_semestre}/{grupo}', 'ExcelController@concentrado_calificaciones');
    Route::resource('/servicios_escolares/historial_academico/', 'Cal_historial_academicoController');
    Route::get('/servicios_escolares/historial_academico/carrera/{id_carrera}', 'Cal_historial_academicoController@historial_academico');
    Route::get('/servicios_escolares/historial_academico/alumno/{id_alumno}/{calificada}/', 'Cal_historial_academicoController@historial_alumno');
    Route::post('/servicios_escolares/historial_academico/alumno/residencia/{id_alumno}', 'Cal_historial_academicoController@calificar_residencia');
    Route::post('/servicios_escolares/historial_academico/alumno/servicio_social/{id_alumno}', 'Cal_historial_academicoController@calificar_servicio_social');
    Route::post('/servicios_escolares/historial_academico/alumno/servicio_social/editar/{id_alumno}', 'Cal_historial_academicoController@editar_calificar_servicio_social');
    Route::delete('/servicios_escolares/historial_academico/alumno/servicio_social/eliminar/{id_alumno}','Cal_historial_academicoController@eliminar_calificar_servicio_social');
    Route::post('/servicios_escolares/historial_academico/alumno/actividades/{id_alumno}', 'Cal_historial_academicoController@calificar_actividades');
    Route::get('/servicios_escolares/historial_academico/pdf_historial_academico/{id_alumno}/{plan}/{especialidad}/{calificada}', 'Cal_pdf_historial_academicoController@pdf_academico');
    Route::get('/servicios_escolares/historial_academico/excel_historial_academico/{id_alumno}/{id_plan}/{id_especialidad}/{calificada}', 'Cal_historial_academicoController@excel_academico');
    Route::get('/servicios_escolares/bajas_temporales/', 'Cal_historial_academicoController@bajas_temporales');
    Route::get('/servicios_escolares/bajas_definitivas/', 'Cal_historial_academicoController@bajas_definitivas');
    Route::get('/servicios_escolares/bajas_temporales/ver/{id_carrera}', 'Cal_historial_academicoController@ver_bajas_temporales');
    Route::get('/servicios_escolares/bajas_definitivas/ver/{id_carrera}', 'Cal_historial_academicoController@ver_bajas_definitivas');
    Route::post('/guardar-baja-temporal', 'Cal_historial_academicoController@guardarBajaTemporal');
    Route::post('/guardar-baja-definitiva', 'Cal_historial_academicoController@guardarBajaDefinitiva');
    Route::get('/servicios_escolares/bitacora_def_temp/{id_carrera?}', 'Cal_historial_academicoController@bitacora_def_temp');
    Route::get('/alumno/academico/cal', 'Cal_historial_academicoController@al_cal_academico');
    Route::resource('/servicios_escolares/promedio_semestre/', 'Cal_promedio_semestreController');
    Route::get('/servicios_escolares/promedio_alumnos_periodo/semestres/{id_carrera}', 'Cal_promedio_semestreController@promedio_alumnos_periodo');
    Route::get('/servicios_escolares/promedio_alumno_grupo/{id_carrera}/{id_semestre}', 'Cal_promedio_semestreController@promedio_alumno_grupo');
    Route::get('/servicios_escolares/promedio_alumnos_semestres_excel/{id_carrera}/{id_semestre}/', 'ExcelController@promedio_alumnos_semestres_excel');
    Route::post('/servicios_escolares/historial_academico/alumno/eliminar/', 'Cal_historial_academicoController@eliminar_materia');
    Route::post('/servicios_escolares/historial_academico/alumno/agregar_nuevamente/', 'Cal_historial_academicoController@agregar_nuevamente');
    Route::get('/servicios_escolares/plan_estudio/', 'Cal_historial_academicoController@planes_estudio');
    Route::get('/servicios_escolares/plan_estudio/carreras/{id_carrera}', 'Cal_historial_academicoController@planes_estudio_carrera');
    Route::get('/servicios_escolares/especialidades/', 'Cal_historial_academicoController@especialidades');
    Route::get('/servicios_escolares/especialidades/carreras/{id_carrera}', 'Cal_historial_academicoController@especialidades_carrera');
    Route::get('/especialidades/modificar/{id_especialidad}', 'Cal_historial_academicoController@modificar_especialidad');
    Route::get('/especialidades/modificacion_especialidad/{id_especialidad}/{especialidad}', 'Cal_historial_academicoController@modificacion_especialidad');
    Route::post('/registrar/especialidad/{id_carrera}', 'Cal_historial_academicoController@registrar_especialidad');
    Route::get('/plan/modificar/{id_plan}', 'Cal_historial_academicoController@modificar_plan');
    Route::get('/plan/modificacion_plan/{id_plan}/{plan}', 'Cal_historial_academicoController@modificacion_plan');
    Route::post('/plan/registrar_plan/{id_carrera}', 'Cal_historial_academicoController@registrar_plan');
    Route::get('/servicios_escolares/registrar_semestre_alumnos/carrera', 'Cal_semestre_regController@reg_semestre_alumno_carrera');
    Route::get('/servicios_escolares/registrar_semestre_al/{id_carrera}', 'Cal_semestre_regController@registrar_semestre_al');
    Route::get('/servicios_escolares/agregar_semestre_al/{id_alumno}', 'Cal_semestre_regController@agregar_semestre_al');
    Route::post('/servicios_escolares/guardar_semestre_al/{id_alumno}/{id_estado}', 'Cal_semestre_regController@guardar_semestre_al');
    Route::get('/servicios_escolares/eliminar_semestre_al/{id_semestre_al}', 'Cal_semestre_regController@eliminar_semestre_al');
    Route::post('/servicios_escolares/guardar_eliminar_semestre_al/{id_semestres_al}', 'Cal_semestre_regController@guardar_eliminar_semestre_al');
    Route::get('/servicios_escolares/desactivar_al/{id_alumno}', 'Cal_semestre_regController@desactivar_al');
    Route::post('/servicios_escolares/guardar_desactivar_estudiante/{id_alumno}', 'Cal_semestre_regController@guardar_desactivar_estudiante');
    Route::get('/servicios_escolares/carrera_estudiantes_desactivados/', 'Cal_semestre_regController@carrera_estudiantes_desactivados');
    Route::get('/servicios_escolares/estudiantes_inactivos/{id_carrera}', 'Cal_semestre_regController@estudiantes_inactivos');
    Route::get('/servicios_escolares/activacion_estudiante_seme/{id_alumno}', 'Cal_semestre_regController@activacion_estudiante_seme');
    Route::post('/servicios_escolares/guardar_activar_estudiante/{id_alumno}', 'Cal_semestre_regController@guardar_activar_estudiante');
    Route::get('/servicios_escolares/carrera_actualizar_semestre_periodo/', 'Cal_semestre_regController@carrera_actualizar_semestre_periodo');
    Route::post('/servicios_escolares/reg_periodo_act_sem', 'Cal_semestre_regController@reg_periodo_act_sem');
    Route::get('/servicios_escolares/activar_periodo_act_sem/{id_periodos_sem_act}', 'Cal_semestre_regController@activar_periodo_act_sem');
    Route::post('/servicios_escolares/guardar_activar_periodo/{id_periodos_sem_act}', 'Cal_semestre_regController@guardar_activar_periodo');
    Route::post('/servicios_escolares/guardar_finalizacion_periodo/', 'Cal_semestre_regController@guardar_finalizacion_periodo');
    Route::get('/servicios_escolares/carreras_act_sem/', 'Cal_semestre_regController@carreras_act_sem');
    Route::get('/servicios_escolares/carrera_estudiantes_act_sem/{id_carrera}', 'Cal_semestre_regController@carrera_estudiantes_act_sem');
    Route::post('/servicios_escolares/guardar_act_sem_al/{id_periodo}/{id_carrera}', 'Cal_semestre_regController@guardar_act_sem_al');
    Route::get('/servicios_escolares/actualizar_semestre_al/{id_semestres_al}', 'Cal_semestre_regController@actualizar_semestre_al');
    Route::post('/servicios_escolares/guardar_mod_semestre_al/{id_semestres_al}', 'Cal_semestre_regController@guardar_mod_semestre_al');
    Route::get('/servicios_escolares/autorizar_semestre_al/{id_semestres_al}', 'Cal_semestre_regController@autorizar_semestre_al');
    Route::post('/servicios_escolares/guardar_autorizar_semestre_al/{id_semestres_al}', 'Cal_semestre_regController@guardar_autorizar_semestre_al');
    /////// Jefe de carrera
    Route::get('/{id_carrera}/docentes', 'jcarreraController@docentes');
    Route::get('/j_carrera/periodos/{id_docente}/{id_materia}/{id_grupo}', 'jcarreraController@reg_periodo');
    Route::get('/j_carrera/acciones/calificaciones/{id_docente}/{id_materia}/{id_grupo}/', 'jcarreraController@acciones');
    Route::get('/j_carrera/{id_docente}/{id_materia}/{id_semestre}/{id_grupo}/{nom_carrera}/sumativas', 'jcarreraController@evaluacionSumativa');
    Route::get('/generar_pdf/jc', 'PDFCalificacionesController@generaCalificacionesjc');
    Route::get('/generar_pdf_sumativas/jc', 'PDFCalificacionesController@generaCalSumativasjc');
    Route::get('/calificar_duales/{id_carga_academica}', 'jcarreraController@calificar_duales');
    Route::post('/registrar_cal_duales/', 'jcarreraController@registrar_cal_duales');
    Route::post('/termino/evaluacion/dual/{id_materia}/{id_grupo}', 'jcarreraController@termino_evaluacion');

    /*
    {{-- ==================================================================================== --}}
    {{-- ===========MENÚ JEFE DIVISION SEGUIMIENTO DE ESTUDIANTES DE INGLES ======================== --}}
    {{-- ==================================================================================== --}}
    */
    Route::resource('/jefe_division/seguimiento_ingles','In_Seg_Jefe_DivisionController');

    ///////Alumno
    Route::get('/calificaciones', 'calalumnosController@index');
//Route::get('/riesgos','RiesgoController@riesgos')->name('riesgos');
//Route::get('/riesgos/detalles','RiesgoController@detalles')->name('detalle_riesgo');
    /************Riesgos ************ */
    Route::resource('generales/jefe_unidad_administrativa', 'GnralJefeUnidadAdministrativaController');
    Route::resource('generales/unidad_administrativa', 'GnralUnidadAdministrativaController');
    Route::resource('riesgos/riesgo', 'RiRiesgoController');
    Route::resource('riesgos/registroriesgos/{id_regriesgo}/', 'RegRiesgoController', ['except' => ['update', 'show']]);
    Route::put('riesgos/registroriesgos/{id_regriesgo}/', 'RegRiesgoController@update');///aun no funciona
    Route::get('riesgos/registroriesgos/collapse/{id_regriesgo}/', 'RegRiesgoController@show');///aun no funciona
    Route::resource('riesgos/seleccion', 'RiSeleccionController');
    Route::resource('riesgos/tipoeva', 'RiTipoEvaController');
    Route::resource('riesgos/tipof', 'RiTipoFController');
    Route::resource('riesgos/factor', 'RiClasifFactorController');
    Route::resource('riesgos/estrategia', 'RiEstrategiaController');
    Route::resource('riesgos/decision', 'RiNivelDecisionController');
    Route::resource('riesgos/clasifica', 'RiClasifRController');
    Route::resource('riesgos/partes', 'RiPartesController');
    Route::resource('riesgos/add_partes/{id_proceso}/', 'RiAddPartesController', ['except' => ['destroy', 'show']]);//aqui
    Route::delete('riesgos/add_partes/{id_proceso}/', 'RiAddPartesController@destroy');
    Route::get('riesgos/add_partes/collapse/{id_colapse}/', 'RiAddPartesController@show');
    Route::resource('riesgos/requisitos', 'RiRequisitoController');
    Route::resource('riesgos/valoracion_efectos', 'RiValoracionEfectoController');
    Route::resource('riesgos/mejoracliente', 'RiOMejoraclienteController');
    Route::resource('riesgos/mejorareputacion', 'RiOMejorareputacionController');
    Route::resource('riesgos/mejorasgc', 'RiOMejorasgcController');
    Route::resource('riesgos/ocurrenciasp', 'RiOOcurrenciaspController');
    Route::resource('riesgos/planseguimiento', 'RiOPlanseguimientoController');
    Route::resource('riesgos/potencialapertura', 'RiOPotencialaperturaController');
    Route::resource('riesgos/potencialcosto', 'RiOPotencialcostoController');
    Route::resource('riesgos/potencialcrecimiento', 'RiOPotencialcrecimientoController');
    Route::resource('riesgos/probabilidad', 'RiOProbabilidadController');
    Route::resource('riesgos/proceso', 'RiProcesoController');
    Route::resource('riesgos/regoportunidad', 'RiRegOportunidadController');
    Route::resource('riesgos/reg_factor', 'RiFactoresController');
    //  Route::resource('riesgos/reg_factor', 'RiFactoresController');
    Route::resource('riesgos/calificacion', 'RiOCalificacionController');
    Route::resource('riesgos/rievaluacioncontrol', 'RiEvaluacionControlController');
    Route::resource('riesgos/riestrategiaccion', 'RiEstrategiaAccionController');
    Route::resource('riesgos/sistema', 'RiSistemaController');
    Route::resource('riesgos/riest_riesgo', 'RiEstrategiaRiesgoController');
//Route::resource('riesgos/regoportunidad/{id_oportunidad}','RiRegOportunidadController'); ///aqui
    Route::resource('riesgos/riest_riesgo', 'RiEstrategiaRiesgoController');
    Route::put("riesgos/seguimiento/file_riesgo/{id}", 'RiEstrategiaAccionController@addFile');
    Route::put("riesgos/seguimiento/file_oportunidad/{id}", 'RiRegOportunidadController@addFile');
    Route::resource('riesgos/seguimiento', 'RiSeguimientoController', ['except' => ['update', 'show']]);
    Route::get('riesgos/seguimiento/tabla', 'RiSeguimientoController@show');
    Route::put('riesgos/seguimiento/tabla/{id}', 'RiSeguimientoController@update');
    Route::put('riesgos/seguimiento/tabla_update/{id}', 'RiSeguimientoController@updateFile');
    Route::put("riesgos/seguimiento/date_riesgo/{id}", 'RiSeguimientoController@updateDateRiesgo');
    Route::put("riesgos/seguimiento/date_oportunidad/{id}", 'RiSeguimientoController@updateDateOportunidad');
//oficios de comision
    Route::get('/notificaciones/redireccionar/validar', 'OficiosRegistrarcomisionadosController@rediccionamiento');
    Route::get('/notificaciones/oficios', 'OcEvaluacionOficioController@notificaciones');
    Route::get('/mostrar_validacion', 'OcEvaluacionOficioController@mostrarvalidados');
    Route::get('/mostrar_validacion_personal', 'OcEvaluacionOficioController@mostrarvalidadospersonal');
    Route::get('/oficios/evaluacion', 'OcEvaluacionOficioController@index');
    Route::get('/oficios/evaluacionsubdirecion', 'OcEvaluacionOficioController@subdireccion');
    Route::get('/oficios/evaluacion/historialrecibidos', 'OcEvaluacionOficioController@historialrecibidos');
    Route::post('/oficios/evaluacion/historialrecibidos/modificar', 'OcEvaluacionOficioController@liberarcomisionado');
    Route::get('/oficios/evaluacion/historialprofesores', 'OcEvaluacionOficioController@historialprofesores');
    Route::get('/oficios/evaluacion/historial_mostrar/{id_anos}', 'OcEvaluacionOficioController@historial_mostrar');
    Route::get('/oficios/evaluacion/historial_mostrar_profesores/{id_anos}', 'OcEvaluacionOficioController@historial_mostrar_profesores');
    Route::get('/oficios/vercomision/{id_oficio}', 'OcEvaluacionOficioController@mostrar');
    Route::get('/mostrar_estados/{id_estados}', 'OcEvaluacionOficioController@estado_dependencia');
    Route::post('/oficios/comisionadosenviados/editar/{id_oficio}', 'OcEvaluacionOficioController@permisoeditar');
    Route::post('/oficios/comisionadosenviados/editarsubdirecion/{id_oficio}', 'OcEvaluacionOficioController@editarsudireccion');
    Route::get('/automovil/{id_personal}/{id_oficio}', 'OficiosComisionController@auto');
    Route::get('/viaticos/{id_personal}/{id_oficio}', 'OficiosComisionController@viatico');
    Route::get('/oficios/solicitud', 'OficiosComisionController@index');
    Route::post('/oficios/solicitud/creada', 'OficiosComisionController@store');
    Route::get('/oficio/dependencia/modificar/{id_dependencia}', 'OficiosComisionController@dependencia');
    Route::post('/oficio/dependencia/crear/', 'OficiosComisionController@insertar_dependencia');
    Route::post('/oficio/dependencia/con_comisionado/', 'OficiosComisionController@insertar_dependencia_comisionado');
    Route::post('/oficios/dependencia/editar', 'OficiosComisionController@editar_dependencia');
    Route::get('/oficios/solicitud_oficio/{id_oficio}', 'OficiosComisionController@editar');
    Route::get('/oficios/oficio_comision/{id_oficio}', 'OficiosComisionController@editar_oficio');
    Route::get('/oficios/solicitud_comisionado/{id_comisionado}', 'OficiosComisionController@editar_comisionado');
    Route::post('/oficios/solicitud/modificar_comisionado', 'OficiosComisionController@modificar_comisionado');
    Route::post('/oficios/solicitud/modificar', 'OficiosComisionController@modificar');
    Route::post('/oficios/solicitud_oficio_comisionado/modificar', 'OficiosComisionController@modificar_oficio_comisionado');
    Route::delete('/oficios/eliminar/', 'OficiosComisionController@destroy');
    Route::delete('/oficios/eliminado/{id_oficio}', 'OficiosComisionController@comisionadoeliminado');
    Route::delete('/oficios/eliminar_dependencia/', 'OficiosComisionController@eliminar_dependencia');
    Route::get('/oficios/modificar/{id_oficio}', 'OficiosComisionController@modificaregistrados');
    Route::get('/oficios/modificar/oficio_aceptado/{id_oficio}', 'OficiosComisionController@modificaroficio_aceptado');
    Route::post('/oficios/solicitud/comisionado/modificado', 'OficiosComisionController@modificado');
    Route::get('/oficios/comisionados/{id}', ['as' => 'personalcomisionado', 'uses' => 'OficiosComisionController@registrados']);
    Route::get('/oficios/solicitudenviar/{id_oficio}', 'OcRegOficioController@envio');
    Route::get('/oficios/modificar_oficio/comisionado/{id_oficio_comisionado}', 'OcRegOficioController@aceptar_modificacion');
    Route::get('/oficios/registrosoficio', 'OcRegOficioController@index');
    Route::get('/oficios/historialoficios', 'OcRegOficioController@historialoficios');
    Route::get('/oficios/mostrar/{id_oficio}', 'OcRegOficioController@mostrar');
    Route::post('/oficios/comisionado/agregarcomisionados', 'OficiosRegistrarcomisionadosController@store');
    Route::get('/oficios/mostraroficio', 'OcRegOficioController@oficioscomisionados');
    Route::get('/oficios/aceptadosubdireccion/{id_oficio}', 'OcRegOficioController@aceptadosubdireccion');
    Route::get('/oficios/rechazadosubdireccion/{id_oficio}', 'OcRegOficioController@rechazadosubdireccion');
    Route::get('/oficios/aceptado/{id_oficio}', 'OcRegOficioController@aceptado');
    Route::get('/oficios/rechazado/{id_oficio}', 'OcRegOficioController@rechazado');
    Route::get('pdfregistro/{id_oficio}', [
        'as' => 'pdfregistro',
        'uses' => 'PdfOficioController@index',
    ]);
    Route::get('pdfregistroviaticos/{id_oficio}', [
        'as' => 'pdfregistroviaticos',
        'uses' => 'PdfoficioComisionViaticos@index',
    ]);
    Route::get('pdfregistroautos/{id_oficio}', [
        'as' => 'pdfregistroautos',
        'uses' => 'PdfoficioComisionAuto@index',
    ]);
    Route::get('pdfregistroautosviaticos/{id_oficio}', [
        'as' => 'pdfregistroautosviaticos',
        'uses' => 'PdfoficioComisionAutosViaticos@index',
    ]);
    Route::resource('/departamento/plantilla', 'PersonalPlantillaController');
    Route::get('/departamentoplantilla/ver', 'PersonalPlantillaVerController@index');
    Route::delete('/departamentoplantilla/elimina/{id}', 'PersonalPlantillaController@eliminar');
    Route::post('/departamentoplantilla/mostrar', 'PersonalPlantillaVerController@store');
    Route::get('/departamento/plantillas/{id}', ['as' => 'personaldepartamento', 'uses' => 'PersonalPlantillaController@personaldepartamento']);
//******************************************************************************
    /* Laboratorios*/
    Route::resource('/laboratorios/laboratorios/', 'Lb_laboratoriosController');
    Route::get('/laboratorios/mostrar/{laboratorio}/{fecha_inicial}/{fecha_final}', 'Lb_laboratoriosController@laboratorios');
    Route::post('/laboratorios/registrar', 'Lb_laboratoriosController@apartarlab');
    Route::post('/laboratorios/registrar/profesor/materia', 'Lb_laboratoriosController@materiaprofesor');
    Route::delete('/laboratorios/eliminar/{id}', 'Lb_laboratoriosController@eliminar');
    Route::delete('/laboratorios/eliminar/profesores/{id}', 'Lb_laboratoriosController@eliminar_profesor');
    Route::get('/ingles_horarios/imprimir_horarios/{fecha_inicial}/{id_laboratorio}', 'Lb_laboratoriosController@imprimir_horarios');
    Route::get('/laboratorios/verificacion_dia_lab/{id_semana_profesor}/{id_laboratorio}', 'Lb_laboratoriosController@verificacion_dia_lab');
    Route::get('/laboratorios/reg_lab_fecha/{id_semana}/{id_laboratorio}/{fecha_registro}', 'Lb_laboratoriosController@reg_lab_fecha');
    Route::get('pdf-lab-horarios/{laboratorio}/{fecha_inicial}/{fecha_final}', 'PDF_Lab_HorariosController@index');
///-------------------------------------------------------------------------------------------------------------------
/// **********************************************++ activar el modulo de amar  horarios*************+
    Route::resource('/centro_computo/activar_armar_horarios/', 'C_C_Controller');
///
    Route::resource('sgc/programa', 'SgcProgramaController');///
    Route::resource('sgc/procesoAgenda', 'SgcProcesoAgendaController');
    Route::resource('sgc/auditorias', 'SgcAuditoriasController');///
    Route::resource('sgc/asignaAudi', 'SgcAsignaAudiController');
    Route::resource('sgc/guarda_evento', 'SgcAgendaController');
    Route::get('sgc/agenda/{id}', 'SgcAgendaController@show');
    Route::resource('sgc/validate', 'SgcValidacionesController');
    Route::resource('sgc/auditores', 'SgcPersonasAuditoriaController');///
    Route::resource('sgc/normatividad', 'SgcNormatividadController');
    Route::get('sgc/ver_plan_auditoria/{id}', 'SgcDetallePlanController@show');
    Route::resource('sgc/add_criterio', 'SgcNormAuditoriaController');
    Route::resource('sgc/delete_criterio', 'SgcNormAuditoriaController');
    Route::get('sgc/auditor/{id}', 'SgcAsignaAudiController@show');
    Route::get('sgc/setFecha/{id}', 'SgcAgendaController@edit');
    Route::resource('sgc/hoja_trabajo', 'SgcReportesController');
    Route::resource('sgc/notas', 'SgcNotasController');
    Route::resource('sgc/print_page_job', 'SgcPdfHojaController');///
    Route::resource('sgc/reporte_programa', 'SgcReporteAuditoriaController');
    Route::get('sgc/print_reporte/{data}', 'SgcReporteAuditoriaController@show');///
//Recursos Auditorias********************************************************************
    Route::resource('auditorias/auditores', 'AudAuditoresController');
    Route::resource('auditorias/programas', 'AudProgramasController');
    Route::resource('auditorias/print_page_job', 'AudPdfHojaController');
    Route::resource('auditorias/planes', 'AudAuditoriasController');
    Route::resource('auditorias/procesos_plan', 'AudAuditoriaProcesoController');
    Route::resource('auditorias/auditores_asignados', 'AudAuditorAuditoriaController');
    Route::resource('auditorias/agenda', 'AudAgendaController');
    Route::resource('auditorias/informe', 'AudInformeController');
    Route::get('auditorias/printinforme/{id}/{aprueba}', 'AudPrintController@printInforme');
    Route::resource('auditorias/responsables', 'AudResponsableAccionesController');
    Route::resource('auditorias/acciones', 'AudAccionesController');


    Route::post("auditorias/validar_programa/{id}", "AudProgramasController@statePrograma");
//Route::resource('auditorias/validar','AudValidarAgendaController');
    Route::resource('auditorias/evento', 'AudAgendaEventoController');
    Route::resource('auditorias/procesos', 'AudProcesosController');
    Route::post("auditorias/procesos_unidad", 'AudProcesosController@addUnidad');
    Route::delete("auditorias/procesos_unidad/{id}", 'AudProcesosController@deleteUnidad');

    Route::resource('auditorias/actividades', 'AudActividadesController');
    Route::resource('auditorias/hoja_trabajo', 'AudReporteController');
    Route::resource('auditorias/ver_hoja', 'AudHojaController');
    Route::resource('auditorias/generales', 'AudGeneralesController');
//Rutas parciales Auditorias*************************************************************
    Route::get('auditorias/print_reporte/{data}', 'SgcReporteAuditoriaController@show');
    Route::get('auditorias/agenda/{id}/{fecha}/edit', 'AudAgendaController@edit2');
    Route::get('auditorias/setItem/{id}/set', 'AudValidarAgendaController@setItem');
    Route::get('auditorias/validarEvento/{id}', 'AudAgendaEventoController@valida');
    Route::post('auditorias/actualizaEvento/{id}', 'AudAgendaEventoController@updateEvent');
    Route::get('auditorias/printPrograma/{id}/{aprueba}', 'AudPrintController@printPrograma');
    Route::get('auditorias/printPlan/{id}/{aprueba}', 'AudPrintController@printPlan');
    Route::get('auditorias/printExcel/{id}/{aprueba}', 'AudPrintController@printProgramaExcel');
    Route::post('auditorias/add_observacion/{id}', 'AudAuditoriaProcesoController@addObs');
    Route::post('auditorias/edit_observacion/{id}', 'AudAuditoriaProcesoController@editObs');
    Route::get('auditorias/delete_observacion/{id}', 'AudAuditoriaProcesoController@delObs');
    Route::get('auditorias/ver_disponibilidad/{id}', 'AudValidarAgendaController@disponibilidad');
    Route::get('auditorias/validar_hora/{id}', 'AudValidarAgendaController@hora');
    Route::get('auditorias/get_responsable_area/{id}', 'AudReporteController@getRespons');
    Route::get('auditorias/editar_evento/{id}/{type}', 'AudAgendaEventoController@editar_evt');


    Route::get('auditorias/constancia/{id}', 'AudPrintController@constancia');
//****************************************************************************************
//*******************************PAA***********************************************
    Route::resource('/paa/programa_paa', 'PaaProgramaController');
    Route::get('/paa/programa_paa/modificar/{id_programa}', 'PaaProgramaController@editar');
    Route::put('/paa/programa_paa/modificacion/{id_programa}', 'PaaProgramaController@modificar');
    Route::resource('/paa/subprograma_paa', 'PaaSubprogramaController');
    Route::get('/paa/subprograma_paa/modificar/{id_subprograma}', 'PaaSubProgramaController@editar');
    Route::put('/paa/subprograma_paa/modificacion/{id_subprograma}', 'PaaSubProgramaController@modificar');
    Route::resource('/paa/acciones_paa', 'PaaAccionController');
    Route::get('/paa/acciones_paa/modificar/{id_accion}', 'PaaAccionController@editar');
    Route::post('/paa/acciones_paa/modificar_accion', 'PaaAccionController@modificar');
    Route::resource('/paa/unidad_medida_paa', 'PaaUnidadMedidaController');
    Route::get('/paa/unidad_medida/modificar/{id_unidad}', 'PaaUnidadMedidaController@editar');
    Route::put('/paa/unida_medida/modificacion/{id_unidad}', 'PaaUnidadMedidaController@modificar');
    Route::resource('/paa/generarpaa', 'PaaGenerarPaaController');
//******************************MODULO DE RESIDENCIA PROFESIONAL************************************//
//*****************************************************************************************************//
    Route::resource('/residencia/registrar_solicitud_residencia', 'Resi_Solicitud_ResiController');
    Route::post('/residencia/guardar_solicitud_residencia/{id_anteproyecto}', 'Resi_Solicitud_ResiController@guardar_solicitud_residencia');
    Route::get('/residencia/pdf_solicitud_residencia/{id_anteproyecto}', 'Resi_Solicitud_pdfController@index');
    Route::post('/residencia/guardar_mod_solicitud_residencia/{id_anteproyecto}', 'Resi_Solicitud_ResiController@guardar_mod_solicitud_residencia');

    Route::resource('/residencia/evalucion_anteproyecto', 'Resi_Periodo_eval_anteproyectoController');
    Route::delete('/residencia/evalucion_anteproyecto/eliminar/{id_periodo_anteproyecto}', 'Resi_Periodo_eval_anteproyectoController@eliminar');
    Route::post('/residencia/activar_periodo_anteproyecto/', 'Resi_Periodo_eval_anteproyectoController@activar_periodo_anteproyecto');
    Route::post('/residencia/desactivar_periodo_anteproyecto/', 'Resi_Periodo_eval_anteproyectoController@desactivar_periodo_anteproyecto');
    //** RUTA PARA MODIFICAR LAS FECHAS DEL PERIODO DE EVALUACION DE ANTEPROYECTOS**/
    Route::put('/residencia/evalucion_anteproyecto/editar/{id}','Resi_Periodo_eval_anteproyectoController@editar');

    Route::resource('/residencia/registrar_anteproyecto', 'Resi_Registrar_anteproyectoController');
    Route::resource('/residencia/anteproyecto/portada', 'Resi_Registrar_portadaController');
    Route::resource('/residencia/anteproyecto/objetivos', 'Resi_Registrar_objetivosController');
    Route::resource('/residencia/anteproyecto/alcances', 'Resi_Registrar_alcancesController');
    Route::resource('/residencia/anteproyecto/justificacion', 'Resi_Registrar_justificacionController');
    Route::resource('/residencia/anteproyecto/marco_teorico', 'Resi_Registrar_marcoteoricoController');
    Route::resource('/residencia/anteproyecto/cronograma', 'Resi_Registrar_cronogramaController');
    Route::get('/residencia/anteproyecto/cronograma/agregar_actividad/{id_actividad}', 'Resi_Registrar_cronogramaController@agregar_actividad');
    Route::post('/residencia/anteproyecto/cronograma/registrar_actividad/', 'Resi_Registrar_cronogramaController@registrar_actividad');
    Route::get('/residencia/anteproyecto/cronograma/modificar_actividad/{id_cronograma}', 'Resi_Registrar_cronogramaController@moficar_actividad');
    Route::post('/residencia/anteproyecto/cronograma/modificacion_actividad/', 'Resi_Registrar_cronogramaController@moficacion_actividad');
    Route::post('/residencia/anteproyecto/enviar/', 'Resi_Registrar_anteproyectoController@enviar');
    Route::resource('/residencia/asignar_revisores', 'Resi_Jefes_residenciaController');
    Route::get('/residencia/agregar_revisores/{id_asesor}', 'Resi_Jefes_residenciaController@agregar_revisores');
    Route::post('/residencia/periodo_asesor', 'Resi_Jefes_residenciaController@periodo_asesor');
    Route::delete('/residencia/eliminar_revisor', 'Resi_Jefes_residenciaController@eliminar_revisor');
    Route::get('/residencia/asignar_academia', 'Resi_Jefes_residenciaController@academia');
    Route::post('/residencia/agregar_academia', 'Resi_Jefes_residenciaController@agregar_academia');
    Route::get('/residencia/modificar_academia/{id_academia}', 'Resi_Jefes_residenciaController@modificar_academia');
    Route::post('/residencia/modificacion_academia/', 'Resi_Jefes_residenciaController@modificacion_academia');

    Route::get('/residentes/carrera', 'Resi_Jefes_residenciaController@residentes_carrera');
    Route::get('/residentes/carrera_oficio_aceptacion', 'Resi_Jefes_residenciaController@carrera_oficio_aceptacion');
    Route::get('/residencia/agregar_no_oficio_aceptacion/{id_asesor}', 'Resi_Jefes_residenciaController@agregar_no_oficio_aceptacion');
    Route::post('/residencia/guardar_no_oficio/{id_asesor}', 'Resi_Jefes_residenciaController@guardar_no_oficio');
    Route::get('/residencia/modificar_no_oficio_aceptacion/{id_asesor}', 'Resi_Jefes_residenciaController@modificar_no_oficio_aceptacion');
    Route::post('/residencia/guardar_mod_no_oficio/{id_asesor}', 'Resi_Jefes_residenciaController@guardar_mod_no_oficio');
    Route::get('/residentes/oficio_aceptacion_proyecto/{id_asesores}', 'Resi_pdf_oficio_aceptacion_proController@index');
    Route::get('/residentes/alumno/{id_anteproyecto}', 'Resi_Jefes_residenciaController@residentes_alumno');
    Route::post('/residencia/actualizar_calificacion/{id}','Resi_Jefes_residenciaController@actualizar_calificacion')->name('actualizar_calificacion');
    Route::get('/residencia/lista_documentacion/alta_residencia', 'Resi_correcciones_anteproyectoControllorer@documentacion_alta_residencia');
    Route::post('/residencia/guardar_documentacion_alta', 'Resi_correcciones_anteproyectoControllorer@guardar_documentacion_alta');

    Route::resource('/residencia/revisores_anteproyecto', 'Resi_revisar_anteproyectoController');
    Route::get('/residencia/carrera_anteproyecto/{id_revisores}', 'Resi_revisar_anteproyectoController@carrrera_revisor');
    Route::get('/residencia/revisar_anteproyecto/{id_anteproyecto}/{id_profesor}', 'Resi_revisar_anteproyectoController@revisar_anteproyecto');
    Route::post('/residencia/revisar_portada/', 'Resi_revisar_anteproyectoController@revisar_portada');
    Route::get('/residencia/revisar_objetivos/{id_anteproyecto}/{id_profesor}', 'Resi_revisar_anteproyectoController@revisar_objetivos');
    Route::get('/residencia/revisar_alcances/{id_anteproyecto}/{id_profesor}', 'Resi_revisar_anteproyectoController@revisar_alcances');
    Route::get('/residencia/revisar_justificacion/{id_anteproyecto}/{id_profesor}', 'Resi_revisar_anteproyectoController@revisar_justificacion');
    Route::get('/residencia/revisar_marcoteorico/{id_anteproyecto}/{id_profesor}', 'Resi_revisar_anteproyectoController@revisar_marcoteorico');
    Route::get('/residencia/revisar_cronograma/{id_anteproyecto}/{id_profesor}', 'Resi_revisar_anteproyectoController@revisar_cronograma');
    Route::post('/residencia/guardar_comentarios_objetivos/', 'Resi_revisar_anteproyectoController@guardar_comentarios_objetivos');
    Route::post('/residencia/guardar_comentarios_alcances/', 'Resi_revisar_anteproyectoController@guardar_comentarios_alcances');
    Route::post('/residencia/guardar_comentarios_justificacion/', 'Resi_revisar_anteproyectoController@guardar_comentarios_justificacion');
    Route::post('/residencia/guardar_comentarios_marcoteorico/', 'Resi_revisar_anteproyectoController@guardar_comentarios_marcoteorico');
    Route::post('/residencia/guardar_comentarios_cronograma/', 'Resi_revisar_anteproyectoController@guardar_comentarios_cronograma');
    Route::get('/residencia/enviar_anteproyecto_alumno/{id_anteproyecto}/{id_profesor}', 'Resi_revisar_anteproyectoController@enviar_anteproyecto_alumno');
    Route::resource('/residencia/correcciones_anteproyecto/', 'Resi_correcciones_anteproyectoControllorer');
    Route::get('/residencia/anteproyecto/corregir_portada', 'Resi_correcciones_anteproyectoControllorer@corregir_portada');
    Route::get('/residencia/anteproyecto/corregir_objetivos', 'Resi_correcciones_anteproyectoControllorer@corregir_objetivos');
    Route::get('/residencia/anteproyecto/corregir_alcances', 'Resi_correcciones_anteproyectoControllorer@corregir_alcances');
    Route::get('/residencia/anteproyecto/corregir_justificacion', 'Resi_correcciones_anteproyectoControllorer@corregir_justificacion');
    Route::get('/residencia/anteproyecto/corregir_marco_teorico', 'Resi_correcciones_anteproyectoControllorer@corregir_marco_teorico');
    Route::get('/residencia/anteproyecto/corregir_cronograma', 'Resi_correcciones_anteproyectoControllorer@corregir_cronograma');
    Route::get('/residencia/anteproyecto/corregir_enviar_anteproyecto', 'Resi_correcciones_anteproyectoControllorer@enviar_anteproyecto');
    Route::post('/residencia/guardar_correciones_portada/', 'Resi_correcciones_anteproyectoControllorer@guardar_correciones_portada');
    Route::post('/residencia/guardar_correciones_objetivos/', 'Resi_correcciones_anteproyectoControllorer@guardar_correciones_objetivos');
    Route::post('/residencia/guardar_correciones_alcances/', 'Resi_correcciones_anteproyectoControllorer@guardar_correciones_alcances');
    Route::post('/residencia/guardar_correciones_justificacion/', 'Resi_correcciones_anteproyectoControllorer@guardar_correciones_justificacion');
    Route::post('/residencia/guardar_correciones_marco_teorico/', 'Resi_correcciones_anteproyectoControllorer@guardar_correciones_marco_teorico');
    Route::post('/residencia/guardar_correciones_cronograma/', 'Resi_correcciones_anteproyectoControllorer@guardar_correciones_cronograma');
    Route::post('/residencia/enviar_anteproyecto_corregido/', 'Resi_correcciones_anteproyectoControllorer@enviar_anteproyecto_corregido');
    Route::resource('/residencia/empresa', 'Resi_agregar_empresaController');
    Route::get('/residencia/modificar_empresa/{id_empresa}', 'Resi_agregar_empresaController@modificar_empresa');
    Route::post('/residencia/modificacion_empresa/', 'Resi_agregar_empresaController@modificacion_empresa');
    Route::post('/residencia/insertar_empresa/', 'Resi_agregar_empresaController@insertar_empresa');
    Route::get('/residencia/agregar_empresa', 'Resi_agregar_empresaController@agregar_empresa');
    Route::get('/residencia/datos_empresa/{id_empresa}', 'Resi_agregar_empresaController@datos_empresa');
    Route::post('/residencia/registrar_empresa_asesor/', 'Resi_agregar_empresaController@registrar_empresa_asesor');
    Route::post('/residencia/modificar_empresa_asesor/', 'Resi_agregar_empresaController@modificar_empresa_asesor');
    Route::get('/residencia/notificacion_anteproyecto/', 'Resi_agregar_empresaController@notificacion_anteproyecto');
    Route::resource('/residencia/dictamen_anteproyecto', 'Resi_pdf_dictamen_anteproyectoController');
    Route::get('/residencia/mostrar_comentario_portada/{id_evaluacion}/{id_anteproyecto}', 'Resi_mostrarcomentariosController@comentarios_portada');
    Route::get('/residencia/mostrar_comentario_objetivos/{id_evaluacion}/{id_anteproyecto}', 'Resi_mostrarcomentariosController@comentarios_objetivos');
    Route::get('/residencia/mostrar_comentario_alcances/{id_evaluacion}/{id_anteproyecto}', 'Resi_mostrarcomentariosController@comentarios_alcances');
    Route::get('/residencia/mostrar_comentario_justificacion/{id_evaluacion}/{id_anteproyecto}', 'Resi_mostrarcomentariosController@comentarios_justificacion');
    Route::get('/residencia/mostrar_comentario_marco_teorico/{id_evaluacion}/{id_anteproyecto}', 'Resi_mostrarcomentariosController@comentarios_marco_teorico');
    Route::get('/residencia/mostrar_comentario_cronograma/{id_evaluacion}/{id_anteproyecto}', 'Resi_mostrarcomentariosController@comentarios_cronograma');
    Route::get('/residencia/mostrar_alumno_residencia/{id}', ['as' => 'alumno_residencia', 'uses' => 'Resi_revisar_anteproyectoController@ver_alumno_residencia']);
    Route::resource('/residencia/agregar_anteproyecto_asesores', 'Resi_agregar_revisores_anteproyectosController');
    Route::get('/residencia/mostrar_asesores_anteproyecto/{id_anteproyecto}', 'Resi_agregar_revisores_anteproyectosController@mostrar_asesores_anteproyecto');
    Route::post('/residencia/guardar_asesores_anteproyecto/', 'Resi_agregar_revisores_anteproyectosController@guardar_asesores_anteproyecto');
    Route::get('/residencia/modificar_asesores_anteproyecto/{id_anteproyecto}', 'Resi_agregar_revisores_anteproyectosController@modificar_asesores_anteproyecto');
    Route::post('/residencia/modificacion_asesores_anteproyecto/', 'Resi_agregar_revisores_anteproyectosController@modificacion_asesores_anteproyecto');
    Route::resource('/residencia/seguimiento_residencia', 'Resi_seguimientoController');
    Route::get('/residencia/seguimiento_asesor', 'Resi_seguimientoController@seguimiento_asesor');
    Route::get('/residencia/seguimiento_alumno/{id_anteproyecto}', 'Resi_seguimientoController@seguimiento_alumno');
    Route::get('/residencia/formato_evaluacion_residencia/{id_anteproyecto}', 'Resi_seguimientoController@formato_evaluacion_residencia');
    Route::get('/residencia/seguimiento_alumno_residencia/{id}', ['as' => 'calificar_alumno', 'uses' => 'Resi_seguimientoController@seguimiento_alumno_residencia']);
    Route::get('/residencia/calificar_anteproyecto/{id_cronograma}', 'Resi_seguimientoController@calificar_anteproyecto');
    Route::get('/residencia/autorizar_imprimir_acta', 'Resi_seguimientoController@autorizar_imprimir_acta');
    Route::get('/residencia/autorizacion_acta_alumno/{id_promedio_general}', 'Resi_seguimientoController@autorizacion_acta_alumno');
    Route::post('/residencia/registrar_estado_acta/', 'Resi_seguimientoController@registrar_estado_acta');


    Route::post('/residencia/guardar_calificacion_anteproyecto/', 'Resi_seguimientoController@guardar_calificacion_anteproyecto');
    Route::get('/residencia/seguimiento_cronograma_alumno/{id}', ['as' => 'cronograma_alumno', 'uses' => 'Resi_seguimientoController@seguimiento_cronograma_alumno']);
    Route::get('/residencia/seguimiento_residencia/{id_anteproyecto}/{id_numero}', 'Resi_pdf_reportes_residenciaController@index');
    Route::get('/residencia/ultimo_reporte_residencia/{id_anteproyecto}/{id_numero}', 'Resi_pdf_ultimo_reporteController@index');
    Route::get('/residencia/formato_evaluacion/{id_anteproyecto}', 'Resi_pdf_formato_evaluacionController@index');
    Route::get('/residencia/pdf_formato_evaluacion/{id_anteproyecto}', 'Resi_pdf_formato_evaluacionController@pdf_formato_externo');
    Route::post('/residencia/guardar_calificacion__residencia/', 'Resi_seguimientoController@guardar_calificacion__residencia');
    Route::post('/residencia/evaluacion_final_residencia/', 'Resi_seguimientoController@evaluacion_final_residencia');
    Route::get('/residencia/seguimiento/oficio_informe_final/{id_anteproyecto}', 'Resi_oficios_pdfController@index');
    Route::get('/residencia/seguimiento/oficio_aceptacion_externo/{id_anteproyecto}', 'Resioficio_aceptacion_externoController@oficioaceptacionexterno');
    Route::get('/residencia/seguimiento/oficio_revisor/{id_anteproyecto}', 'Resi_oficio_aceptacion_revisorController@index');
    Route::get('/residencia/seguimiento/portada/{id_anteproyecto}', 'Resi_portadaController@index');
    Route::get('/residencia/seguimiento/pdf_encuesta/{id_anteproyecto}', 'Resi_pdf_encuestaController@index');
    Route::resource('/residencia/departamento_residencia', 'Resi_departamento_residenciaController');
    Route::get('/residencia/institucional_proyectos', 'Resi_departamento_residenciaController@institucional_proyectos');
    Route::get('/residencia/exportar_datos_alumnos_residencia', 'Resi_departamento_residenciaController@exportar_datos_alumnos_residencia');
    Route::get('/residencia/carreras_proyectos', 'Resi_departamento_residenciaController@carreras_proyectos');
    Route::get('/residencia/departamento_carreras/{id_carrera}', 'Resi_departamento_residenciaController@carreras_departamento_mostrar');
    Route::get('/residencia/estadisticas_residencia', 'Resi_departamento_residenciaController@estadisticas_residencia');
    Route::get('/residencia/institucional_estadisticas', 'Resi_departamento_residenciaController@institucional_estadisticas');
    Route::get('/residencia/carreras_estadisticas', 'Resi_departamento_residenciaController@carreras_estadisticas');
    Route::get('/residencia/giro_estadisticas', 'Resi_departamento_residenciaController@giro_estadisticas');
    Route::get('/residencia/sector_estadisticas', 'Resi_departamento_residenciaController@sector_estadisticas');
    Route::get('/residencia/carrera_giro_estadisticas/{id_carrera}', 'Resi_departamento_residenciaController@carrera_giro_estadisticas');
    Route::get('/residencia/carrera_sector_estadisticas/', 'Resi_departamento_residenciaController@carreras_sector_estadisticas');
    Route::get('/residencia/carrera_sector/{id_carrera}', 'Resi_departamento_residenciaController@carrera_sector');
    Route::get('/residencia/carrera_empresa/', 'Resi_departamento_residenciaController@carrera_empresa');
    Route::get('/residencia/carrera_empresa_mostrar/{id_carrera}', 'Resi_departamento_residenciaController@carrera_empresa_mostrar');
    Route::get('/residencia/empresa_institucional/', 'Resi_departamento_residenciaController@empresa_institucional');

    Route::resource('/residencia/autorizar_anteproyecto', 'Resi_departamento_autorizar_anteproyectoController');
    Route::get('/residencia/autorizar_anteproyecto/anteproyecto_autorizar/{id_carrera}', 'Resi_departamento_autorizar_anteproyectoController@anteproyecto_autorizar_departamento');
    Route::get('/residencia/autorizacion_documentacion/{id_anteproyecto}', 'Resi_departamento_autorizar_anteproyectoController@autorizacion_documentacion');
    Route::get('/residencia/autorizacion_documentacion_modificada/{id_anteproyecto}', 'Resi_departamento_autorizar_anteproyectoController@autorizacion_documentacion_modificada');

    Route::post('/residencia/enviar_alumno_documentacion_sin_convenio/{id_alumno}/{periodo}/{id_convenio}', 'Resi_departamento_autorizar_anteproyectoController@enviar_alumno_documentacion_sin_convenio');

    Route::get('/residencia/autorizar_anteproyecto/anteproyecto_proceso_modificacion/{id_carrera}', 'Resi_departamento_autorizar_anteproyectoController@anteproyecto_proceso_modificacion');
    Route::get('/residencia/autorizar_anteproyecto/anteproyecto_autorizar_alumno/{id_anteproyecto}', 'Resi_departamento_autorizar_anteproyectoController@anteproyecto_autorizar_alumno');
    Route::post('/residencia/autorizacion_anteproyecto/', 'Resi_departamento_autorizar_anteproyectoController@anteproyecto_autorizacion_alumno');
    Route::get('/residencia/anteproyectos_autorizados/', 'Resi_departamento_autorizar_anteproyectoController@anteproyectos_autorizados');
    Route::get('/residencia/anteproyectos_autorizados_carrera/{id_carrera}', 'Resi_departamento_autorizar_anteproyectoController@anteproyectos_autorizados_carrera');
    Route::get('/residencia/ver_doc_aceptada_alta/{id_anteproyecto}', 'Resi_departamento_autorizar_anteproyectoController@ver_doc_aceptada_alta');
    Route::get('/residencia/autorizar_documentacion_anteproyecto', 'Resi_departamento_autorizar_anteproyectoController@autorizar_documentacion_anteproyecto');
    Route::get('/residencia/autorizar_doc_anteproyecto_alum/{id_carrera}', 'Resi_departamento_autorizar_anteproyectoController@autorizar_doc_anteproyecto_alum');
    Route::get('/residencia/ver_datos_anteproyecto_alum/{id_anteproyecto}', 'Resi_departamento_autorizar_anteproyectoController@ver_datos_anteproyecto_alum');
    Route::post('/residencia/guardar_autorizacion_documentacion_alumn/', 'Resi_departamento_autorizar_anteproyectoController@guardar_autorizacion_documentacion_alumn');


    Route::get('/residencia/acta_calificaciones_residencia/{id_anteproyecto}', 'Resi_acta_calificacionesController@index');
    Route::get('/residencia/documentos_alta_residencia', 'Resi_departamento_autorizar_anteproyectoController@registro_datos_envio_documentos');
    Route::post('/residencia/registrar_correo_documentacion', 'Resi_departamento_autorizar_anteproyectoController@registrar_correo_documentacion');
    Route::post('/residencia/modificar_correo_documentacion', 'Resi_departamento_autorizar_anteproyectoController@modificar_correo_documentacion');
    Route::post('/residencia/registrar_solicitud_residencia/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_solicitud_residencia');
    Route::post('/residencia/registrar_constancia_avance_academico/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_constancia_avance_academico');
    Route::post('/residencia/registrar_comprobante_seguro/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_comprobante_seguro');
    Route::post('/residencia/registrar_oficio_asignacion_jefatura/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_oficio_asignacion_jefatura');
    Route::post('/residencia/registrar_oficio_aceptacion_empresa/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_oficio_aceptacion_empresa');
    Route::post('/residencia/registrar_oficio_presentacion_tecnologico/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_oficio_presentacion_tecnologico');
    Route::post('/residencia/registrar_anteproyectos/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_anteproyecto');

    Route::post('/residencia/registrar_carta_compromiso/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_carta_compromiso');
    Route::post('/residencia/registrar_convenio_empresa/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@registrar_convenio_empresa');
    Route::post('/residencia/envio_documento_residencia/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@envio_documento_residencia');
    Route::post('/residencia/envio_documento_residencia/modificada/{id_alta_residencia}', 'Resi_departamento_autorizar_anteproyectoController@envio_documento_residencia_modificada');

    Route::resource('/residencia/enviar_documentacion/alumno/', 'Resi_documentacionfinal_alController');
    Route::post('/residencia/modificar_correo_documentacionfinal/alumno', 'Resi_documentacionfinal_alController@modificar_correo_documentacionfinal');
    Route::post('/residencia/acta_calificacion/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@acta_calificacion_documentacionfinal');
    Route::post('/residencia/portada/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@portada_documentacionfinal');
    Route::post('/residencia/evaluacion_final_residencia/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@evaluacion_final_residencia_documentacionfinal');
    Route::post('/residencia/oficio_aceptacion_informe_interno/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@oficio_aceptacion_informe_interno_documentacionfinal');
    Route::post('/residencia/formato_evaluacion/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@formato_evaluacion_documentacionfinal');
    Route::post('/residencia/oficio_aceptacion_informe_revisor/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@oficio_aceptacion_informe_revisor_documentacionfinal');
    Route::post('/residencia/oficio_aceptacion_informe_externo/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@oficio_aceptacion_informe_externo_documentacionfinal');
    Route::post('/residencia/formato_hora/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@formato_hora_documentacionfinal');
    Route::post('/residencia/seguimiento_interno/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@seguimiento_interno_documentacionfinal');
    Route::post('/residencia/seguimiento_externo/documentacionfinal/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@seguimiento_externo_documentacionfinal');
    Route::post('/residencia/envio_documento_residencia_final/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@envio_documento_residencia_final');

    Route::resource('/residencia/revision_documentos_finales', 'Resi_documentacionfinal_depController');
    Route::get('/residencia/revision_doc_finales/{id_carrera}', 'Resi_documentacionfinal_depController@revisar_doc_finales');
    Route::get('/residencia/proceso_mod_doc_finales/{id_carrera}', 'Resi_documentacionfinal_depController@mod_doc_finales');
    Route::get('/residencia/alumno_liberacion_final_mod/doc/{id_liberacion_documentos}', 'Resi_documentacionfinal_depController@alumno_liberacion_final_mod');
    Route::get('/residencia/alumno_liberacion_final/doc/{id_liberacion_documentos}', 'Resi_documentacionfinal_depController@alumno_liberacion_final');
    Route::post('/residencia/enviar_doc_final_dep/{id_liberacion_documentos}', 'Resi_documentacionfinal_depController@enviar_doc_final_dep');
    Route::post('/residencia/envio_doc_mod_residencia_final/{id_liberacion_documentos}', 'Resi_documentacionfinal_alController@enviar_doc_mod_final_dep');
    Route::get('/residencia/doc_autorizada_finales/{id_liberacion_documentos}', 'Resi_documentacionfinal_depController@doc_autorizada_finales');
    Route::get('/residencia/ver_doc_finales_aut/doc/{id_liberacion_documentos}', 'Resi_documentacionfinal_depController@ver_doc_finales_aut');
    Route::get('/residencia/ver_anteproyectos_revisores/', 'Resi_documentacionfinal_depController@ver_anteproyectos_revisores');
    Route::get('/residencia/ver_estados_alumnos/{id_carrera}', 'Resi_documentacionfinal_depController@ver_estados_alumnos');
    Route::get('/residencia/proceso_mod_anteproyecto/{id_carrera}', 'Resi_documentacionfinal_depController@proceso_mod_anteproyecto');
    Route::get('/residencia/proceso_revision_anteproyecto/{id_carrera}', 'Resi_documentacionfinal_depController@proceso_revision_anteproyecto');
    Route::get('/pdf_documento_presentacion_residencia/{id_anteproyecto}', 'Resi_oficio_presentacionController@index');

    /**PERMISO PARA MODIFICAR ANTEPROYECTO**/
    Route::post('/residencia/permiso_modificacion_anteproyecto','Resi_documentacionfinal_depController@permiso_modificacion_anteproyecto');


    ///**********************************Horarios de ingles***********************************
/// **************************************************************************************
    Route::resource('/profesores_ingles/create', 'In_registrar_profesoresController');
    Route::get('/profesores_ingles/periodos/{id_periodo}', 'In_registrar_profesoresController@periodo');
    Route::get('/recargar/periodos_ingles/{id_periodo}', 'In_registrar_profesoresController@recargar_periodo');
    Route::get('/profesores_ingles/modificar/{id_usuario}', 'In_registrar_profesoresController@modificar_profesor');
    Route::post('/profesores_ingles/modificacion/profesor', 'In_registrar_profesoresController@modificacion_profesor');

    Route::get('/armar_plantilla/profesore_ingles', 'In_armar_plantillaController@index');
    Route::get('/ingles/mostrar_profesore_ingles/', 'In_armar_plantillaController@mostrar_profesore_ingles');
    Route::get('/armar_plantilla/profesor/{id_profesor}', 'In_armar_plantillaController@agregar_profesor');
    Route::post('/armar_plantilla/profesor/agregar_horas_profesor/{id_profesores}/{horas_maximas}', 'In_armar_plantillaController@agregar_horas_profesor');
    Route::get('/agregar_profesor/ingles_periodo/', 'In_armar_plantillaController@plantilla_profesor');
    Route::get('/agregar_profesor/ingles_plantilla/{id_profesor}', 'In_armar_plantillaController@ingles_plantilla');
    Route::post('/agregar_profesor/agregar_ingles_plantilla/', 'In_armar_plantillaController@agregar_ingles_plantilla');
    Route::delete('/profesor_ingles/eliminar/', 'In_armar_plantillaController@eliminar_profesor_plantilla');
    Route::resource('/ingles_horarios/agregar', 'In_armar_horarioinglesController');
    Route::get('/ingles_horarios/horarios_ingles/{id_profesor}', 'In_armar_horarioinglesController@horario_ingles');
    Route::get('/ingles_horarios/horarios_ingles_niveles/{id_profesor}/{id_niveles}', 'In_armar_horarioinglesController@horario_ingles_niveles');
    Route::get('/ingles_horarios/ingles_niveles/', 'In_armar_horarioinglesController@ingles_niveles');
    Route::get('/ingles_horarios/profesor_horarios/{id_profesor}/{id_niveles}/{id_grupo}', 'In_armar_horarioinglesController@profesor_horarios');
    Route::get('/ingles_horarios/agregar_horario_semana/{id_semana}/{id_grupo}/{id_profesor}/{id_niveles}', 'In_armar_horarioinglesController@agregar_horas');
    Route::get('/ingles_horarios/eliminar_horario_semana/{id_registro_horario}/{id_grupo}/{id_profesor}/{id_niveles}', 'In_armar_horarioinglesController@eliminar_horario_semana');
    Route::get('/ingles_horarios/pdf_profesor_horarios/{id_profesor}', 'In_pdf_horarioinglesController@index');

    Route::get('/ingles_horarios/llenar_carga_academica/', 'In_carga_academicaController@index');
    Route::get('/ingles_horarios/iniciar_carga_academica/', 'In_carga_academicaController@iniciar_carga_academica');
    /*Route::get('/ingles_estadistica/estadisticas_genero/', 'In_carga_academicaController@estadisticas_genero');
    Route::get('/ingles_estadistica/excelestadisticas_genero/', 'In_carga_academicaController@excelestadisticas_genero');*/
    Route::post('/ingles_horarios/guardar_iniciar_carga_academica/', 'In_carga_academicaController@guardar_iniciar_carga_academica');
    Route::get('/ingles_horarios/enviar_carga_academica_ingles/{id_nivel}/{id_grupo}/{id_tipo_curso}', 'In_carga_academicaController@enviar_carga_academica_ingles');
    Route::get('/ingles_horarios/revision_carga_academica/', 'In_carga_academicaController@revision_carga_academica');
    Route::get('/ingles_horarios/carga_academica_niveles/{id_niveles}', 'In_carga_academicaController@carga_academica_niveles');
    Route::get('/ingles_horarios/carga_academica_grupo/{id_hrs_niveles_grupo}', 'In_carga_academicaController@carga_academica_grupo');
    Route::get('/ingles_horarios/seleccionar_grupo_carga/{id_hrs_niveles_grupo}/{numero}', 'In_carga_academicaController@seleccionar_grupo_carga');

    /*
    {{-- ========================================================= --}}
    {{-- =========== CARGAS NUEVO INGRESO ======================== --}}
    {{-- ========================================================= --}}
    */

    Route::get('ingles/control-escolar','In_carga_academicaController@nuevo_ingreso_exam_ubic');
    Route::post('/ingles/guardar-ubicacion','In_carga_academicaController@guardarUbicacion')->name('ingles.guardar_ubicacion');
    Route::get('/ingles/grupos-por-nivel', 'In_carga_academicaController@gruposPorNivel');
    Route::post( '/ingles/eliminar-ubicacion', 'In_carga_academicaController@eliminar_ubicacion')->name('ingles.eliminar_ubicacion');
    /*
    {{-- ========================================================== --}}
    {{-- ============CONSTANCIAS INGLES FINALES==================== --}}
    {{-- ========================================================== --}}
    */

    Route::get('/ingles/historial/generar_constancias_alumnos_carrera/{id_carrera}', 'In_historial_alumController@generar_constancias_alumnos_ingles');
    Route::get('ingles/constancia/{id_alumno}', 'In_pdf_generar_constancias_alumController@generar_pdf_alumno')
        ->name('ingles.constancia');

    Route::resource('/ingles/mostrar_horarios_profesores', 'In_mostrar_horariosController');
    Route::get('/ingles/pdf_carga_academica_ingles/{id_grupo}/{id_nivel}', 'In_pdf_carga_inglesController@index');
    Route::get('/ingles/mostrar_horario_profesor/{id_profesor}', 'In_mostrar_horariosController@mostrar_horario_profesor');
    Route::get('/ingles/mostrar_horario_profesor_grupo/', 'In_mostrar_horariosController@mostrar_horario_profesor_grupo');
    Route::get('/ingles/grupos_niveles/{id_grupos}/{id_nivel}', 'In_mostrar_horariosController@mostrar_grupo_nivel');
    Route::get('/ingles_horarios/pdf_grupo_horarios/{id_grupos}/{id_nivel}', 'In_pdf_grupoController@index');
    Route::resource('/ingles_horarios/mostrar_grupo', 'In_gruposController');
    Route::get('/ingles/autorizacion_cargas/', 'In_gruposController@autorizacion_cargas');
    Route::get('/ingles/cargas_aut_excel/', 'In_gruposController@cargas_aut_excel');
    Route::get('/ingles/ver_carga_academica_ingles/{id_validar_carga}', 'In_gruposController@ver_carga_academica_ingles');
    Route::get('/ingles/modificar_carga_academica_ingles/{id_validar_carga}', 'In_gruposController@modificar_carga_academica_ingles');
    Route::post('/ingles/modificacion_carga_academica_ingles/', 'In_gruposController@modificacion_carga_academica_ingles');
    Route::resource('/ingles/mostrar_niveles', 'In_nivelesController');
    Route::get('/ingles/mostrar_periodos', 'In_nivelesController@periodos');
    Route::resource('/ingles/', 'In_inicioController');
    Route::get('/ingles/Calificaciones', 'In_inicioController@inicio_calificaciones');
    Route::get('/ingles/Calificaciones/mostrar_alumnos/{id_nivel}/{id_grupo}', 'In_inicioController@mostrar_alumnos');
    Route::get('/ingles/Calificaciones/periodos_ingles/{id_nivel}/{id_grupo}', 'In_inicioController@periodos_ingles');
    Route::get('/ingles/registro_periodo_ingles/{id_unidad}/{id_nivel}/{id_grupo}', 'In_inicioController@registro_periodo_ingles');
    Route::post('/ingles/calificaciones/crear_periodos', 'In_inicioController@crear_periodo_cal_ingles');
    Route::post('/ingles/agregar_calificaciones_unidad/{id_nivel}/{id_grupo}/{id_unidad}/insert_calificacion', 'In_inicioController@agregar_calificacion');
    Route::get('/ingles/profesores/calificaciones', 'In_nivelesController@calificaciones_profesor');
    Route::get('/ingles/profesores/calificacion_profesor/{id_profesor}', 'In_nivelesController@calificacion_profesor');
    Route::get('/ingles/modificar_per/{id_unidad}/{id_nivel}/{id_grupo}', 'In_nivelesController@modificar_per');
    Route::post('/ingles/modificacion_per/', 'In_nivelesController@modificacion_per');
    Route::get('/ingles/modificar_cal/ingles/{id_carga_academica}/{id_unidad}', 'In_nivelesController@modificar_cal');
    Route::post('/ingles/guardar_modificacion/calificacion', 'In_nivelesController@guardar_modificacion_calif');
    Route::get('/ingles/acta_ordinaria/{id_nivel}/{id_grupo}', 'In_acta_ordinariaController@index');
    Route::get('/ingles/acta_ordinaria_act/{id_nivel}/{id_grupo}', 'In_acta_ordinariaController@acta_ingles_actualizada');
    Route::get('/ingles/lista_asistencia/{id_nivel}/{id_grupo}', 'In_acta_ordinariaController@lista_asistencia_ingles');
    Route::resource('/ingles/historial_academico_alumno/', 'In_historial_alumController');
    Route::get('/ingles/historial/ver_alumnos_carrera/{id_carrera}', 'In_historial_alumController@ver_alumnos_carrera');
    Route::get('/ingles/historial_calificaciones_excel/{id_carrera}', 'In_historial_alumController@historial_calificaciones_excel');
    ///////////////////////boucher de ingles///////////////////////////////////////////////////////////////////////////////
    Route::resource('/ingles_horarios/cargar_voucher_pago/', 'In_voucher_pagoController');
    ////****** depto. culturales
    Route::resource('/ingles/vouchers_validacion', 'In_voucher_validacionController');
    Route::post('/aceptar_voucher/{id_voucher}', 'In_voucher_validacionController@aceptar_voucher')
        ->name('alumno.aceptar_voucher');
    Route::get('/ingles/mostrar_excell_voucher', 'excell_voucherController@index');
    Route::post('/ingles/guardar_aceptacion_excel_voucher', 'In_voucher_validacionController@guardar_aceptacion_excel_voucher');
    Route::get('/ingles/ver_registro_voucher/{id_voucher}', 'In_voucher_validacionController@ver_registro_voucher');
    Route::post('/ingles/guardar_reg_alumno_excel_voucher/{id_voucher}', 'In_voucher_validacionController@guardar_reg_alumno_excel_voucher');
    Route::post('/ingles/guardar_agregar_pendi_excel', 'In_voucher_validacionController@guardar_agregar_pendi_excel');
    Route::get('/ingles/exportar_excell_voucher_aceptado/', 'excell_voucherController@exportar_excell_voucher_aceptado');


    Route::get('/ingles/vouchers_aceptados', 'In_voucher_validacionController@vouchers_aceptados');
    Route::get('/ingles/modificar_voucher_ingles/{id_voucher}', 'In_voucher_validacionController@modificar_voucher_ingles');
    Route::post('/ingles_horarios/cargar_voucher_modificar/{id_voucher}', 'In_voucher_pagoController@cargar_voucher_modificar');
    Route::post('/ingles/guardar_comentario_voucher_rechazado/{id_voucher}', 'In_voucher_validacionController@rechazar_voucher');
    Route::get('/ingles/vouchers_rechazados', 'In_voucher_validacionController@vouchers_rechazados');
    Route::get('/ingles/ver_cal_coordinador_ingles/', 'In_voucher_pagoController@ver_calificacion_ingles_coordinador');
    Route::get('/ingles/maximo_grupo_alumnos', 'In_voucher_validacionController@maximo_grupo_alumnos');
    Route::post('/ingles/guardar_maximo_grupo_alumnos', 'In_voucher_validacionController@guardar_maximo_grupo_alumnos');
    Route::post('/ingles/guardar_editar_boton', 'In_voucher_validacionController@guardar_editar_boton');
    Route::get('/ingles/departamento/mostrar_calificacion_ingles_coordinador/{id_carrera}', 'In_voucher_pagoController@mostrar_calificaciones_coordinador');
    Route::get('/ingles/imprimir_calificacion_ingles_alumno/{id_alumno}', 'In_pdf_boletaController@index');
    Route::get('/ingles/ver_cal_alumno_ingles/', 'In_voucher_pagoController@ver_calificacion_ingles_alumno');

    Route::get('/ingles/desactivar_grupos/', 'In_validar_gruposController@index');
    Route::get('/ingles/profesores/desactivar_grupos_profesor/{id_profesores}', 'In_validar_gruposController@desactivar_grupos_profesor');
    Route::get('/ingles/profesores/desactivar_grupo_prof/{id_nivel}/{id_grupo}', 'In_validar_gruposController@desactivar_grupo_prof');
    Route::get('/ingles/profesores/activar_grupo_prof/{id_nivel}/{id_grupo}', 'In_validar_gruposController@activar_grupo_prof');
    Route::get('/ingles/profesores/agregar_usuarios_grupo_prof/{id_nivel}/{id_grupo}', 'In_validar_gruposController@agregar_usuarios_grupo_prof');
    Route::get('/ingles/consultar_usuarios_grupo_prof/{id_nivel}/{id_grupo}/{id_carrera}/{id_semestre}/{id_grupos_carrera}', 'In_validar_gruposController@consultar_usuarios_grupo_prof');
    Route::get('/ingles/profesores/datos_usuario_ingles/{id_alumno}/{id_nivel}/{id_grupo}', 'In_validar_gruposController@datos_usuario_ingles');
    Route::post('/ingles/profesores/reg_datos_usuario_ingles/{id_nivel}/{id_grupo}', 'In_validar_gruposController@reg_datos_usuario_ingles');

///////////////////============================================================================/////////////////////////////////////////////////////////////////////
    ///////////////////=========DESEMPEÑO ACADEMICO DE INGLES (INDICES)============================//////////////////////////////////////////////////////////////////////
    ///////////////////============================================================================//////////////////////////////////////////////////////////////////////
    Route::get('/ingles/desempeno_academico/niveles', 'In_desempeno_academico_inglesController@index');
    //Route::get('/exportar-concentrado-ingles', [In_Excel_Desem_Aca::class, 'in_concentrado_cal_ingles']);
    Route::get('/ingles/desempeno_academico/concentrado_ingles_desempeno/{id_nivel}/{id_grupo}/{id_carrera}', 'In_Excel_Desem_Aca@in_concentrado_cal_ingles');
    Route::get('/ingles/estadisticas/estadisticas_atencion_demanda', 'In_desempeno_academico_inglesController@ver_estadistica_alta_demanda');
    Route::get('/ingles/estadisticas/estadisticas_eficiencia_terminal', 'In_desempeno_academico_inglesController@ver_estadistica_eficiencia_terminal');
    Route::get('/ingles/estadisticas/grafica_genero', 'In_desempeno_academico_inglesController@estadisticas_genero');
    Route::get('/ingles_estadistica/estadisticas_genero/', 'In_desempeno_academico_inglesController@ver_estadisticas_genero');
    Route::get('/ingles_estadistica/excelestadisticas_genero/', 'In_desempeno_academico_inglesController@excelestadisticas_genero');
    Route::get('/ingles/desempeno_academico/estadisticas_generales', 'In_desempeno_academico_inglesController@ver_estadisticas_generales');
    //Route::get('/api/ingles/grafico-genero', 'InglesGeneroController@obtenerDatosGenero');
    Route::get('/ingles/exportar-estadisticas-generales','In_Excel_Estadisticas_GeneralesController@exportar_estadisticas_generales')
        ->name('ingles.exportar_estadisticas_generales');



    ///////////////////*****************************************//////////////////////////////////////////////////
/// ///////////////////Ipomex********////
    Route::get('/ipomex/mostrar_fracciones', 'Ipomex_agregar_fracionesController@index');
    Route::get('/ipomex/mostrar_fracciones/contralor_ver_ipomex/', 'Ipomex_agregar_fracionesController@contralor_ver_ipomex');
    ///////////////////*****************************************//////////////////////////////////////////////////
/// ///////////////////Beca de estimulo********////
    Route::resource('/beca_estimulo/', 'Beca_SolicitudController');
    Route::get('/beca_estimulo/enviar_solicitud/{id_alumno}/{descuento_estimulo}/{promedio}/{id_semestre}', 'Beca_SolicitudController@enviar_estimulo');
    Route::get('/beca_estimulo/escolares/autorizar', 'Beca_SolicitudController@escolares_autorizar');
    Route::get('/beca_estimulo/escolares/verificar_beca/{id_autorizar}/{autorizacion}', 'Beca_SolicitudController@verificar_beca');
    Route::get('/beca_estimulo/escolares/verificar_beca_profesionales/{id_autorizar}/{autorizacion}', 'Beca_SolicitudController@verificar_beca_profesionales');
    Route::get('/beca_estimulo/academico/autorizar', 'Beca_SolicitudController@autorizar_academico');
    Route::get('/beca_estimulo/academico_solicitud/{id_autorizar}', 'Beca_pdf_SolicitudBecaController@index');
    Route::post('/beca_estimulo/vulnerabilidad_registrar', 'Beca_vulnerabilidadController@index');
    Route::get('/beca_estimulo/escolares/auto_verificar', 'Beca_SolicitudController@auto_verificar_beca');
///////////////////////******computo***//////////
    Route::resource('/computo/calificar', 'Computo_calificarController');
    Route::get('/computo/calificacion_al/{id_carga}', 'Computo_calificarController@calificacion_al');
    Route::get('/computo/ver_cal/promedios', 'Computo_calificarController@promedios_al_carrera');
    Route::get('/computo/ver_carrera_alumno/{id_carrera}', 'Computo_calificarController@ver_carrera_alumno');
    Route::get('/computo/registrar_imagen/', 'Computo_calificarController@registrar_imagen');
    Route::post('/computo/modificar_imagen/{id_alumno}', 'Computo_calificarController@modificar_imagen');
    Route::get('/servicios_escolares/evaluaciones_cc_academico', 'SEscolaresController@evaluaciones_cc_academicas');
    Route::get('/servicios_escolares/acciones_cc_academico/{id_docente}/{id_materia}/{id_grupo}', 'SEscolaresController@acciones_cc_academico');
    Route::get('/docente/acciones/modificar_cc_periodo/{id_unidad}/{id_materia}/{id_grupo}/{id_docente}', 'DocentesAgController@modificacion_cc_Periodo');
    Route::post('/docente/acciones/modificar_cc_periodo', 'DocentesAgController@modifica_cc_Periodo');
    Route::post('/docente/acciones/guardar_observacion_modificacion_periodo_cc', 'DocentesAgController@guardar_observacion_modificacion_periodo_cc');
    Route::get('/centro_computo/usuario/', 'Computo_calificarController@usarioo');
    Route::post('/centro_computo/verificar_usuario', 'Computo_calificarController@verificar_usuario');
    Route::get('/centro_computo/agregar_usuario_per', 'Computo_calificarController@agregar_usuario_per');
    Route::get('/centro_computo/ver_usuario_per/{id}', 'Computo_calificarController@ver_usuario_per');
    Route::post('/centro_computo/modificar_usuario_per/', 'Computo_calificarController@modificar_usuario_per');
    Route::get('/centro_computo/ver_usuario_estudiante/', 'Computo_calificarController@ver_usuario_estudiante');
    Route::get('/centro_computo/ver_usuario_personal_tesvb/', 'Computo_calificarController@ver_usuario_personal_tesvb');
    Route::get('/centro_computo/ver_usuario_facilitadores/', 'Computo_calificarController@ver_usuario_facilitadores');
    Route::get('/centro_computo/eliminar_user_sin_reg/{id}', 'Computo_calificarController@eliminar_user_sin_reg');
    Route::post('/centro_computo/eliminacion_user_sin_reg', 'Computo_calificarController@eliminacion_user_sin_reg');
    Route::post('/centro_computo/eliminacion_usuarios_sin_reg', 'Computo_calificarController@eliminacion_usuarios_sin_reg');
    Route::post('/centro_computo/eliminacion_user_per_sin_reg', 'Computo_calificarController@eliminacion_user_per_sin_reg');
    Route::post('/centro_computo/eliminacion_user_facilitadores_sin_reg', 'Computo_calificarController@eliminacion_user_facilitadores_sin_reg');

    Route::get('/centro_computo/informes_titulacion/', 'Computo_calificarController@ver_informes_titulacion');

    //////////////////////////////////////////////////////////////////////////////////*************************/////
    /// **************Solicitud Prorroga****************//////////////////////////////////////
    Route::resource('/solicitud/prorroga', 'Prorroga_SolicitudController');
    Route::post('/solicitud/enviar_solicitud_prorroga/{id_alumno}', 'Prorroga_SolicitudController@registrar_solicitud');
    Route::get('/solicitud/prorroga_autorizar', 'Prorroga_SolicitudController@autorizar_prorroga');
    Route::get('/solicitud/exportar_solicitudes_prorroga', 'Prorroga_SolicitudController@exportar_solicitudes_prorroga');
    Route::get('/solicitud/exportar_beca_cincuenta', 'Prorroga_SolicitudController@exportar_beca_cincuenta');
    Route::get('/solicitud/exportar_beca_cien', 'Prorroga_SolicitudController@exportar_beca_cien');
    Route::get('/solicitud/pdf_prorroga/{id_alumno}', 'Prorroga_pdf_solicitudController@index');
//////////////////////////////////////////////////////////////////////////////////
/// ////////////////////////////////////////////////////////////////////////////*****************************
/// **********solicitud de adeudo
    Route::resource('/solicitud_adeudo/', 'Solicitud_adeudoController');
    Route::get('/solicitud_alumno_adeudo/{id_carrera}', 'Solicitud_adeudoController@ver_alumnos_reg');
    Route::get('/registrar_alumno_adeudo/{id_carrera}/{id_alumno}/{comentario}', 'Solicitud_adeudoController@registrar_alumno_adeudo');
    Route::post('/eliminar_alumno_adeudo/{id_carrera}/', 'Solicitud_adeudoController@eliminar_alumno_adeudo');
    Route::get('/constancia_adeudo/', 'Solicitud_adeudoController@carrera_costancia');
    Route::get('/constancia_alumno_editar/{id_adeudo_departamento}', 'Solicitud_adeudoController@constancia_alumno_editar');
    Route::post('/constancia_alumno_editado/{id_adeudo_departamento}', 'Solicitud_adeudoController@editado_alumno_deudor');
    Route::get('/constancia_carrera/{id_carrera}', 'Solicitud_adeudoController@ver_carrera_constancia');
    Route::get('/ver_estado_alumno/{id_alumno}', 'Solicitud_adeudoController@ver_estado_alumno');
    Route::get('/verificacion_adeudo_alumno/', 'Solicitud_adeudoController@verificacion_adeudo_alumno');
    Route::get('/constancia_certificado_credencial_no_adeudo/{id_alumno}/{id_tipo}', 'Solicitud_adeudo_certi_credencialController@index');
    Route::get('/constancia_titulacion_noadeudo/{id_alumno}', 'Solicitud_adeudo_titulacionController@index');
    Route::get('/ver_carrera_encuestas_adeudo/', 'Solicitud_adeudoController@ver_carrera_encuestas_adeudo');
    Route::get('/encuestas_adeudo/ver_alumnos_encuestas_adeudo/{id_carrera}', 'Solicitud_adeudoController@ver_alumnos_encuestas_adeudo');
    Route::get('/encuestas_adeudo/enviar_datos_encuesta/{id_carrera}/{id_alumno}', 'Solicitud_adeudoController@enviar_datos_encuesta');
    Route::post('/encuestas_adeudo/eliminar_datos_encuesta/{id_carrera}/', 'Solicitud_adeudoController@eliminar_datos_encuesta');
    Route::get('/servicios_escolares/baja/verificar-adeudo/{id_alumno}', 'Solicitud_Baja_Pdf_Controller@verificarAdeudo');
    Route::get('/servicios_escolares/baja/imprimir/{id_alumno}/{id}/{tipo}', 'Solicitud_Baja_Pdf_Controller@imprimir');

    ////tutorias ///
    Route::resource('/tutorias/', 'Tutorias_inicioController');
    ///VISTA DE QUIEN ES EL COORDINADOR INSTITUCIONAL
    Route::Resource('/tutorias/desarrollovista', 'Tutorias_DesarrolloVistaController');
    ///ASIGNAR COORDINDOR INSTITUCIONAL
    Route::Resource('/tutorias/asignacorgenvista', 'Tutorias_AsignaCorGenController');

    ///LISTA DE PROFESORES EN ASIGNA COORDINADOR INSTITUCIONAL
    Route::Resource('/tutorias/asignacoordinadorgeneral', 'Tutorias_AsignaCoordinadorGeneralController');
    Route::delete('/tutorias/eliminarcoordinadorgeneral/{id_coordinador}', 'Tutorias_AsignaCoordinadorGeneralController@destroy');
    Route::get('/tutorias/check', 'Tutorias_AsignaCoordinadorGeneralController@check');
    ///CONSULTA MUESTRA COORDINADOR INSTITUCIONAL EN DESARROLLO ACADEMICO
    Route::Resource('/tutorias/desarrollo', 'Tutorias_DesarrolloController');
    ///PLANEACION DESARROLLO ACADEMICO
    Route::Resource('/tutorias/planeaciondesarrollo', 'Tutorias_Dep_desarrolloController');
    Route::put('/tutorias/modificar_planeaciondesarrollo/{id_plan_actividad}', 'Tutorias_Dep_desarrolloController@update');

    ///Route::Resource('/tutorias/planeaciondesarrollo/dos', 'Tutorias_Dep_desarrollo_sController');
    ///Route::put('/tutorias/modificar_dos/{id_plan_actividad}', 'Tutorias_Dep_desarrollo_sController@update');

    ///REVISION DE PLANEACION DESARROLLO ACADEMICO
    Route::get('/tutorias/revisiondesarrollo', function () {
        return view('tutorias.dep_desarrollo.revisiondesarrollo');
    });
    ///LISTA DE CARRERAS EN REVISION DE DE PLANEACION EN DESARROLLO ACADEMICO
    Route::get('/tutorias/carrerasinst', 'Tutorias_Coordina_instController@carreras1');

    Route::post('/tutorias/generacionca', 'Tutorias_CoordinadorCarreraController@generaciones');
    Route::get('/tutorias/generacion', 'Tutorias_Dep_desarrolloController@generacion');

    ///ALUMNOS
    Route::Resource('/tutorias/alumnos', 'Tutorias_AlumnosController');
    Route::get('/tutorias/generaciones', 'Tutorias_AlumnosController@generaciones');
    Route::post('/tutorias/alumnosgeneracion', 'Tutorias_AlumnosController@alumnosgeneracion');
    Route::post('/tutorias/alumnosgrupo', 'Tutorias_AlumnosController@alumnosgrupo');
    Route::post('/tutorias/creargrupo', 'Tutorias_AlumnosController@creargrupo');
    Route::post('/tutorias/buscaalumnos', 'Tutorias_AlumnosController@BuscarAlumnosGrupo');
    Route::post('/tutorias/asignaralumnos', 'Tutorias_AlumnosController@AsignarAlumnos');
    Route::post('/tutorias/eliminaralumno', 'Tutorias_AlumnosController@EliminaAlumnoGrupo');
    Route::post('/tutorias/eliminaralumnouno', 'Tutorias_AlumnosController@EliminaAlumnoGrupoUno');
    Route::post('/tutorias/revalida', 'Tutorias_AlumnosController@revalidacionSI');
    Route::post('/tutorias/revalidano', 'Tutorias_AlumnosController@revalidacionNO');

    ///LISTA DE PLANEACION EN REVISION DE DESARROLLO ACADEMICO
    Route::post('/tutorias/planeacioninst', 'Tutorias_AlumnosController@planeacion');
    ///VER SUGERENCIA TUTOR
    Route::post('/tutorias/versuge', 'Tutorias_ViewAlumnosController@versugerencia');


    ///GRAFICAS TUTOR

    Route::post('/tutorias/graphics/genero', 'Tutorias_GraficasController@genero');
    Route::post('/tutorias/graphics/academico', 'Tutorias_GraficasController@academico');
    Route::post('/tutorias/graphics/generales', 'Tutorias_GraficasController@generales');
    Route::post('/tutorias/graphics/familiares', 'Tutorias_GraficasController@familiares');
    Route::post('/tutorias/graphics/habitos', 'Tutorias_GraficasController@habitos');
    Route::post('/tutorias/graphics/salud', 'Tutorias_GraficasController@salud');
    Route::post('/tutorias/graphics/area', 'Tutorias_GraficasController@area');


    ///GRAFICAS CARRERA

    Route::post('/tutorias/grafcarrera/genero', 'Tutorias_GraficasCarreraController@genero');
    Route::post('/tutorias/grafcarrera/academico', 'Tutorias_GraficasCarreraController@academico');
    Route::post('/tutorias/grafcarrera/generales', 'Tutorias_GraficasCarreraController@generales');
    Route::post('/tutorias/grafcarrera/familiares', 'Tutorias_GraficasCarreraController@familiares');
    Route::post('/tutorias/grafcarrera/habitos', 'Tutorias_GraficasCarreraController@habitos');
    Route::post('/tutorias/grafcarrera/salud', 'Tutorias_GraficasCarreraController@salud');
    Route::post('/tutorias/grafcarrera/area', 'Tutorias_GraficasCarreraController@area');

    ///GRAFICAS GENERACION
    Route::post('/tutorias/grafgeneracion/genero', 'Tutorias_GraficasGeneracionController@genero');
    Route::post('/tutorias/grafgeneracion/academico', 'Tutorias_GraficasGeneracionController@academico');
    Route::post('/tutorias/grafgeneracion/generales', 'Tutorias_GraficasGeneracionController@generales');
    Route::post('/tutorias/grafgeneracion/familiares', 'Tutorias_GraficasGeneracionController@familiares');
    Route::post('/tutorias/grafgeneracion/habitos', 'Tutorias_GraficasGeneracionController@habitos');
    Route::post('/tutorias/grafgeneracion/salud', 'Tutorias_GraficasGeneracionController@salud');
    Route::post('/tutorias/grafgeneracion/area', 'Tutorias_GraficasGeneracionController@area');

    ///GRAFICAS INSTITUCIONALES
    Route::get('/tutorias/grafinstitut/genero', 'Tutorias_GraficasInstitucionController@genero');
    Route::get('/tutorias/grafinstitut/academico', 'Tutorias_GraficasInstitucionController@academico');
    Route::get('/tutorias/grafinstitut/generales', 'Tutorias_GraficasInstitucionController@generales');
    Route::get('/tutorias/grafinstitut/familiares', 'Tutorias_GraficasInstitucionController@familiares');
    Route::get('/tutorias/grafinstitut/habitos', 'Tutorias_GraficasInstitucionController@habitos');
    Route::get('/tutorias/grafinstitut/salud', 'Tutorias_GraficasInstitucionController@salud');
    Route::get('/tutorias/grafinstitut/area', 'Tutorias_GraficasInstitucionController@area');
    ///REPORTE GRAFICAS
    Route::post("/tutorias/pdf/reporte", "Tutorias_ReporteGController@pdf_reporte");
    ///COORDINADOR INSTITUCIONAL
    Route::get('/tutorias/tes/carreras', 'Tutorias_Coordina_instController@carreras');
    Route::get('/tutorias/estadisticas/carreras', function () {
        return view('tutorias.coordina_inst.carreras');
    });
    ///PLANEACION DE COORDINADOR INSTITUCIONAL
    ///CONSULTA DE ACTIVIDADES DE PLANEACION COORDINADOR INSTITUCIONAL
    Route::post('/tutorias/actividadescoor', 'Tutorias_Coordina_instController@actividades');
    Route::post('/tutorias/enviaplan', 'Tutorias_Coordina_instController@agregar');
    Route::post('/tutorias/modalver', 'Tutorias_Coordina_instController@veractividades');
    Route::post('/tutorias/modalelim', 'Tutorias_Coordina_instController@vereliminar');
    Route::post('/tutorias/aceptborrar', 'Tutorias_Coordina_instController@del');
    Route::post('/tutorias/modalveract', 'Tutorias_Coordina_instController@verupdate');
    Route::post('/tutorias/enviact', 'Tutorias_Coordina_instController@enviaupd');
    Route::post('/tutorias/sugerenciades', 'Tutorias_Coordina_instController@sugdesa');

    Route::Resource('/tutorias/planeacioncoorgen', 'Tutorias_Coordina_instController');
    Route::post('/tutorias/actividades', 'Tutorias_Dep_desarrolloController@actividades');
    ///REVISION DE PLANEACION COORDINADOR INSTITUCIOANL
    Route::get('/tutorias/revision', function () {
        return view('tutorias/coordina_inst.revision');
    });
    ///VER ESTRATEGIA TUTOR
    // Route::post('/tutorias/verestra','Tutorias_ViewAlumnosController@verestrategia');
    ///INSERTE Y ACTUALIZA SUGERENCIA TUTOR
    Route::post('/tutorias/actualizasuge', 'Tutorias_ViewAlumnosController@actualizasugerencia');

    ///TUTORES
    Route::Resource('/tutorias/asignatuvista', 'Tutorias_AsignaTuController');
    Route::Resource('/tutorias/asignatutores', 'Tutorias_AsignaTutorController');
    Route::get('/tutorias/asignatutores/{id}/destroy', [
        'uses' => 'Tutorias_AsignaTutorController@destroy',
        'as' => 'asignatutores.destroy'
    ]);
    ///RUTAS JEFE DE DIV
    Route::Resource('/tutorias/jefe', 'Tutorias_JefeController');
    Route::Resource('/tutorias/jefevista', 'Tutorias_JefeVistaController');

    ///COORDINADOR
    Route::Resource('/tutorias/asignacoordinador/', 'Tutorias_AsignaCoordinadorController');
    Route::delete('/tutorias/asignacoordinador/eliminar/{id}', 'Tutorias_AsignaCoordinadorController@destroy');
    Route::Resource('/tutorias/asignacovista', 'Tutorias_AsignaCoController');

    ///TUTOR
    Route::post('/tutorias/apc', 'Tutorias_Dep_desarrolloController@corraprob');
    Route::post('/tutorias/vercorrecion', 'Tutorias_Dep_desarrolloController@verco');
    Route::post('/tutorias/enviasug2', 'Tutorias_Dep_desarrolloController@sugesend2');
    Route::post('/tutorias/enviasug', 'Tutorias_Dep_desarrolloController@sugesend');
    Route::post('/tutorias/apruebadesarrollo', 'Tutorias_Dep_desarrolloController@aprueba');
    Route::post('/tutorias/desver', 'Tutorias_Dep_desarrolloController@ver');
    Route::Resource('/tutorias/tutorvista', 'Tutorias_TutorVistaController');
    Route::post('/tutorias/profesor', 'Tutorias_ProfesorController@alumnos');
    Route::post('/tutorias/profe', 'Tutorias_ProfesorController@ev');
    Route::post('/tutorias/cambio', 'Tutorias_ProfesorController@cambio');
    Route::post('/tutorias/ver', 'Tutorias_ViewAlumnosController@veralumno');
    Route::post('/tutorias/verevidencia', 'Tutorias_SeguimientoPlanController@archivos');
    Route::post("/tutorias/pdf/alumno", "Tutorias_PdfController@pdf_alumno")->name("pdf_alumno");
    Route::post("/tutorias/pdf/lista", "Tutorias_PdfController@pdf_lista")->name("pdf_lista");
    Route::get('/tutorias/grupos', 'Tutorias_ProfesorController@grupos');
    Route::get('/tutorias/semestres_tesvb', 'Tutorias_ProfesorController@semestres_tesvb');
    Route::post('/tutorias/registrar_semestre_grupo', 'Tutorias_ProfesorController@registrar_semestre_grupo');
    Route::post('/tutorias/modificar_semestre_grupo', 'Tutorias_ProfesorController@modificar_semestre_grupo');
    Route::Resource('/tutorias/desercion', 'Tutorias_DesercionController');
    Route::post('/tutorias/probabilidad', 'Tutorias_ProbabilidadController@alumnos');
    Route::Resource('/tutorias/seguimiento', 'Tutorias_SeguimientoController');
    Route::post('/tutorias/seguimientoplan', 'Tutorias_SeguimientoPlanController@alumnos');

    ///VISTA PLANEACION TUTOR
    Route::post('/tutorias/semestre', 'Tutorias_ProfesorController@planeacion');
    Route::post('/tutorias/eleccion', 'Tutorias_ProfesorController@selecciona');
    Route::post('/tutorias/versend', 'Tutorias_ProfesorController@enviados');
    Route::post('/tutorias/nuevodato', 'Tutorias_ProfesorController@nuevoregistro');
    Route::post('/tutorias/verestra', 'Tutorias_ProfesorController@verestrategia');
    Route::post('/tutorias/envsel', 'Tutorias_ProfesorController@actividad');
    Route::post('/tutorias/updatestra', 'Tutorias_ProfesorController@upest');

    ///ALUMNO
    Route::get('/tutorias/inicioalu', 'Tutorias_PanelAlumnoController@principal');
    Route::Resource('tutorias/panel', 'Tutorias_PanelAlumnoController');
    Route::get('/tutorias/AlumActualizar', 'Tutorias_ViewAlumnosController@actualizar');
    Route::get('/tutorias/getDatos', 'Tutorias_PanelAlumnoController@datosAlu');
    Route::post('/tutorias/actualiza', 'Tutorias_ViewAlumnosController@actualiza');
    Route::get("/tutorias/pdf/all", "Tutorias_PdfController@pdf_all")->name("pdf_all");
    Route::get('/tutorias/Alum', 'Tutorias_ViewAlumnosController@llenar');
    Route::get('/tutorias/getAlumno', 'Tutorias_PanelAlumnoController@datosPrincipales');
    Route::post('/tutorias/guardar', 'Tutorias_ViewAlumnosController@store');
    Route::post('/tutorias/imagen', 'Tutorias_ViewAlumnosController@guardarImagen');

    Route::post('/tutorias/registrar_inicio_expediente', 'Tutorias_PanelAlumnoController@registrar_inicio_expediente');
    // Route::post('/tutorias/guardar_registreo_expendiente','Tutorias_PanelAlumnoController@guardar_registreo_expendiente');


    ///INSERTE Y ACTUALIZA ESTRATEGIA TUTOR
    Route::post('/tutorias/actualizaestra', 'Tutorias_ViewAlumnosController@actualizaestrategia');
    ///Ruta planeacion pdf tutor
    Route::post("/tutorias/pdf/planeacion", "Tutorias_PlaneacionPDFController@pdf_planeacion")->name("pdf_planeacion");
    ///VER CANALIZACION TUTOR
    Route::post('/tutorias/vercanaliza', 'Tutorias_ViewAlumnosController@veralumno1');/////////////////////////////////si se utiliza
    Route::post('/tutorias/modalact', 'Tutorias_Canalizados_tutorController@canactualiza');
    Route::Resource('/tutorias/actividad', 'Tutorias_actividades_alumnoController');
    Route::post("/tutorias/pdf/citacan", "Tutorias_PdfCitController@pdf_cita")->name("pdf_cita");
    Route::Resource('/tutorias/calendario', 'Tutorias_calendario_eventosController');
    Route::post('/tutorias/actualizadatos', 'Tutorias_Canalizados_tutorController@datosact');
    Route::post('/tutorias/pcan', 'Tutorias_Canalizados_tutorController@store');
    Route::get('/tutorias/carreras', function () {
        return view('tutorias.coordinadorc.index');
    });
    Route::get('/tutorias/carrera', 'Tutorias_CoordinadorCarreraController@carreras');
    Route::post('/tutorias/generacionca', 'Tutorias_CoordinadorCarreraController@generaciones');
    Route::post('/tutorias/pcan', 'Tutorias_Canalizados_tutorController@store');
    Route::post('//tutorias/modalact', 'Tutorias_Canalizados_tutorController@canactualiza');

    //////// Reporte Semestral
    Route::Resource('/tutorias/repsemestral', 'Tutorias_ReporteSemestralController');
    Route::post('/tutorias/reportealum', 'Tutorias_ReporteSemestralController@alum');
    Route::post('/tutorias/verepo', 'Tutorias_ReporteSemestralController@verpararepo');
    Route::post('/tutorias/sendreporte', 'Tutorias_ReporteSemestralController@enviareporte');
    Route::post('/tutorias/updatereporte', 'Tutorias_ReporteSemestralController@veractualiza');
    Route::post('/tutorias/envirepactu', 'Tutorias_ReporteSemestralController@envreporteact');

    Route::post('/tutorias/pdf/pdfreportegen', 'Tutorias_PdfReporteSemestralController@pdf_reportesem')->name('pdf_reportesem');

    Route::resource('/tutorias/listas_asistencia_semestre/', 'TutoriasListasController');
    Route::get('/tutorias/agregar_semestre_grupo/{id_asigna_tutor}', 'TutoriasListasController@agregar_semestre_grupo');
    Route::post('/tutorias/guardar_registro_semestre/', 'TutoriasListasController@guardar_registro_semestre');
    Route::get('/tutorias/ver_estudiantes_grupo/{id_asigna_tutor}', 'TutoriasListasController@ver_estudiantes_grupo');
    Route::get('/tutorias/modificar_semestre_grupo/{id_asigna_tutor}', 'TutoriasListasController@modificar_semestre_grupo');
    Route::post('/tutorias/guardar_modificacion_semestre/', 'TutoriasListasController@guardar_modificacion_semestre');
    Route::get('/tutorias/descargar_lista_asistenacia/{id_asigna_tutor}', 'TutoriasListasPDFController@index');
    //*************************************************************************
    //********************************Reportes de coordinador *****************
    //////// Reporte semestral carrera
    Route::get('/tutorias/reportecoordinador/inicio_reporte_coordinador/{id_asigna_coordinador}', 'Tutorias_ReporteSemestralCController@inicio_reporte_coordinador');
    Route::post('/tutorias/reportecoordinador/guardar_observacion', 'Tutorias_ReporteSemestralCController@guardar_observacion');
    Route::Resource('/tutorias/reportecoordinador/repsemestralcarrera', 'Tutorias_ReporteSemestralCController');
    Route::get('/tutorias/reportecoordinador/tutorias_reportesemestralcarrera/{id_asigna_coordinador}', 'Tutorias_PdfReporteSemetralCController@pdf_reportesemcarrera');
    Route::get('/tutorias/reportecoordinador/editar_observacion_tutor/{id_asigna_generacion}', 'Tutorias_ReporteSemestralCController@editar_observacion_tutor');
    Route::post('/tutorias/reportecoordinador/guardar_mod_observacion/{id_repcarrera}', 'Tutorias_ReporteSemestralCController@guardar_mod_observacion');

    //////Reporte Semestral Institucional
    Route::Resource('/tutorias/reporteinstitucional/repsemestral_ins', 'Tutorias_ReporteSemestralInsController');
    Route::post('/tutorias/reporteinstitucional/guardar_observacion', 'Tutorias_ReporteSemestralInsController@guardar_observacion_inst');
    Route::get('/tutorias/reporteinstitucional/editar_observacion_carrera/{id_carrera}', 'Tutorias_ReporteSemestralInsController@editar_observacion_carrera');
    Route::post('/tutorias/reporteinstitucional/guardar_mod_observacion/{id_institucional}', 'Tutorias_ReporteSemestralInsController@guardar_mod_observacion_inst');
    Route::get('/tutorias/reportecoordinador/tutorias_reportesemestralinstitucional', 'Tutorias_PdfReporteSemetraliController@pdf_reporteseminstitucional');
///////////////////////////////////////////////////////////////////
/// //////////////************SERVICIO SOCIAL*************/////////
/// //////////////////////////////////////////////////////////////
    Route::Resource('/servicio_social/docuemtacion_priemra_etapa/', 'Serv_documentacion_primeraController');
    Route::post('/servicio_social/registrar_carta_aceptacion/{id_alumno}/{tipo_empresa}', 'Serv_documentacion_primeraController@registrar_carta_aceptacion');
    Route::post('/servicio_social/registrar_anexo_tecnico/{id_alumno}/{tipo_empresa}', 'Serv_documentacion_primeraController@registrar_anexo_tecnico');
    Route::post('/servicio_social/registrar_curp/{id_alumno}/{tipo_empresa}', 'Serv_documentacion_primeraController@registrar_curp');
    Route::post('/servicio_social/registrar_carnet/{id_alumno}/{tipo_empresa}', 'Serv_documentacion_primeraController@registrar_carnet');
    Route::post('/servicio_social/registrar_costancia_creditos/{id_alumno}/{tipo_empresa}', 'Serv_documentacion_primeraController@registrar_costancia_creditos');
    Route::post('/servicio_social/registrar_solicitud_registro/{id_alumno}/{tipo_empresa}', 'Serv_documentacion_primeraController@registrar_solicitud_registro');


    Route::post('/servicio_social/registro_tipo_empresa/', 'Serv_documentacion_primeraController@registro_tipo_empresa');
    Route::get('/servicio_social/modificar_tipo_empresa/{id_datos_alumnos}', 'Serv_documentacion_primeraController@modificar_tipo_empresa');
    Route::post('/servicio_social/modificacion_tipo_empresa/', 'Serv_documentacion_primeraController@modificacion_tipo_empresa');
    Route::post('/servicio_social/registro_tipo_empresa_alumno/{id_datos_alumnos}', 'Serv_documentacion_primeraController@registro_tipo_empresa_alumno');
    Route::post('/servicio_social/modificar_pdf_empresaprivada/{id_empresa_privada}', 'Serv_documentacion_primeraController@modificar_pdf_empresaprivada');
    Route::delete('/servicio_social/eliminar_registro_servicio/{id_datos_alumnos}', 'Serv_documentacion_primeraController@eliminar_registro_servicio');
    Route::post('/servicio_social/enviar_registro_servicio/{id_datos_alumnos}', 'Serv_documentacion_primeraController@enviar_registro_servicio');
    Route::post('/servicio_social/registro_tipo_empresa_publica/{id_datos_alumnos}', 'Serv_documentacion_primeraController@registro_tipo_empresa_publica');
    Route::post('/servicio_social/modificar_pdf_empresapublica/{id_empresa_privada}', 'Serv_documentacion_primeraController@modificar_pdf_empresapublica');
    Route::Resource('/servicio_social/departamento_revision_primera_etapa/', 'Serv_departamento_servicio_socialController');
    Route::get('/servicio_social/autorizacion_documentacion/{id_datos_alumnos}', 'Serv_departamento_servicio_socialController@autorizacion_documentacion');
    Route::post('/servicio_social/enviar_primeraetapa/{id_datos_alumnos}', 'Serv_departamento_servicio_socialController@enviar_primeraetapa');
    Route::get('/servicio_social/autorizacion_documentacion_modifcaciones/{id_datos_alumnos}', 'Serv_departamento_servicio_socialController@autorizacion_documentacion_modifcaciones');
    Route::get('/servicio_social/autorizada_documentacion_serv/{id_datos_alumnos}', 'Serv_departamento_servicio_socialController@autorizada_documentacion_serv');


    Route::Resource('/servicio_social/ingresar_contancia/departamento/', 'Serv_alta_alumnosController');
    Route::get('/servicio_social/registrar_constancia/departamento/{id_datos_alumnos}', 'Serv_alta_alumnosController@registrar_constancia');
    Route::post('/servicio_social/guardar_carta_presentacion/', 'Serv_alta_alumnosController@guardar_presentacion');
    Route::get('/servicio_social/modificar_carta_presentacion/{id_datos_alumnos}', 'Serv_alta_alumnosController@modificar_carta_presentacion');
    Route::post('/servicio_social/modificacion_carta_presentacion/', 'Serv_alta_alumnosController@modificacion_carta_presentacion');
    Route::get('/servicio_social/ver_carta_presentacion/{id_datos_alumnos}', 'Serv_alta_alumnosController@ver_carta_presentacion');
    Route::post('/servicio_social/enviar_carta_presentacion/', 'Serv_alta_alumnosController@enviar_carta_presentacion');
    Route::get('/servicio_social/proceso_modificacion_cartapresentacion/departamento/', 'Serv_alta_alumnosController@proceso_modificacion_cartapresentacion');
    Route::get('/servicio_social/proceso_revicion_cartapresentacion/departamento/', 'Serv_alta_alumnosController@proceso_revicion_cartapresentacion');
    Route::get('/servicio_social/proceso_autorizadas_cartapresentacion/departamento/', 'Serv_alta_alumnosController@proceso_autorizadas_cartapresentacion');
    Route::get('/servicio_social/enviocartapresentacionalumno/alumno/', 'Serv_alta_alumnosController@enviocartapresentacionalumno');
    Route::post('/servicio_social/guardarcartapresentacionalumno/alumno/', 'Serv_alta_alumnosController@guardarcartapresentacionalumno');
    Route::post('/servicio_social/modificar_cartapresentacionalumno/alumno/', 'Serv_alta_alumnosController@modificar_cartapresentacionalumno');
    Route::post('/servicio_social/enviar_cartapresentacionalumno/alumno/{id_datos_alumnos}', 'Serv_alta_alumnosController@enviar_cartapresentacionalumno');
    Route::post('/servicio_social/autorizar_cartapresentacionalumno/alumno/', 'Serv_alta_alumnosController@autorizar_cartapresentacionalumno');
    Route::get('/servicio_social/rechazar_cartapresentacionalumno/{id_datos_alumnos}', 'Serv_alta_alumnosController@rechazar_cartapresentacionalumno');
    Route::post('/servicio_social/envio_rechazar_cartapresentacion/', 'Serv_alta_alumnosController@envio_rechazar_cartapresentacion');
    Route::get('/servicio_social/agregar_tipo_servicio/alumno/{id_registro_alumno}', 'Serv_alta_alumnosController@agregar_tipo_servicio_alumno');
    Route::post('/servicio_social/registrar_tipo_servicio/alumno/', 'Serv_alta_alumnosController@registrar_tipo_servicio_alumno');
    Route::post('/servicio_social/exportar_datos_servicio_social', 'ExcelController@exportar_social_servicio');
    //Route::post('/servicio_social/departamento_carreras', 'Resi_departamento_residenciaController@');
    Route::get('/servicio_social/departamento_carreras', 'Resi_departamento_residenciaController@inicio_carreras_servicio_social');
    ///servicio_social/departamento_carreras/1
    Route::get('/servicio_social/departamento_carreras/{id_carrera}', 'Resi_departamento_residenciaController@carreras_departamento_mostrar_servicio_social');
    ///servicio_social/calificar
    Route::post('/servicio_social/calificar','Resi_departamento_residenciaController@calificar_servicio_social')->name('servicio_social.calificar');

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// ...............................................Modulo de informacion documentada de los procdimientos de ambiental
    /// .................................................................................................................

    Route::get('/ambiental/ver_encargados/', 'Amb_encargadosController@index');
    Route::get('/ambiental/ver_encargados/tabla', 'Amb_encargadosController@ver_encargados');
    Route::post('/ambiental/guardar_encargado/{id_procedimiento}', 'Amb_encargadosController@guardar_encargado');
    Route::post('/ambiental/modificar_encargado/{id_procedimiento}', 'Amb_encargadosController@modificar_encargado');
    Route::get('/ambiental/ver_procedimientos/', 'Amb_encargadosController@ver_procedimientos');
    Route::get('/ambiental/ver_procedimientos/tabla', 'Amb_encargadosController@procedimientos');
    Route::get('/ambiental/ver_procedimiento_periodo/{id_periodo}', 'Amb_encargadosController@ver_procedimiento_periodo');
    Route::delete('/ambiental/eliminar_procedimientos/{id_procedimiento}', 'Amb_encargadosController@eliminar_procedimiento');
    Route::post('/ambiental/registrar_procedimientos/', 'Amb_encargadosController@registrar_procedimiento');
    Route::put('/ambiental/modificar_procedimientos/{id_procedimiento}', 'Amb_encargadosController@modificar_procedimiento');
    Route::get('/ambiental/personal_tecnologico/', 'Amb_encargadosController@personal_tecnologico');
    Route::get('/ambiental/ver_periodos/', 'Amb_encargadosController@ver_periodos');
    Route::get('/ambiental/ver_periodos/tabla', 'Amb_encargadosController@periodos_registrados');
    Route::get('/ambiental/periodo_activado', 'Amb_encargadosController@periodo_activado');
    Route::post('/ambiental/guardar_periodo_activo/{id_periodo}', 'Amb_encargadosController@guardar_periodo_activo');
    Route::post('/ambiental/guardar_periodo_desactivo/{id_periodo}', 'Amb_encargadosController@guardar_periodo_desactivo');
    Route::get('/ambiental/enviar_documentacion/', 'Amb_encargadosController@enviar_documentacion_amb');
    Route::get('/ambiental/historial_documentacion/', 'Amb_encargadosController@historial_documentacion_amb');
    Route::get('/ambiental/estado_documentacion/{id_encargado}', 'Amb_encargadosController@estado_documentacion_amb');
    Route::get('/ambiental/ver_estado_documentacion/{id_encargado}', 'Amb_encargadosController@ver_estado_documentacion_amb');
    Route::get('/ambiental/estado_documentacion_encargado/{id_encargado}', 'Amb_encargadosController@estado_documentacion_encargado');
    Route::post('/ambiental/registrar_doc_1/{id_encargado}', 'Amb_encargadosController@registrar_doc_1');
    Route::post('/ambiental/modificar_doc_1/{id_encargado}', 'Amb_encargadosController@modificar_doc_1');
    Route::get('/ambiental/ver_documentacion_encargado/{id_encargado}', 'Amb_encargadosController@ver_documentacion_encargado');
    Route::get('/ambiental/respuestas/', 'Amb_encargadosController@respuestas');
    Route::post('/ambiental/modificar_doc_2_condoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_2condoc');
    Route::post('/ambiental/modificar_doc_2_sindoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_2sindoc');
    Route::post('/ambiental/modificar_doc_3_condoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_3condoc');
    Route::post('/ambiental/modificar_doc_3_sindoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_3sindoc');
    Route::post('/ambiental/modificar_doc_4/{id_encargado}', 'Amb_encargadosController@modificar_doc_4');
    Route::post('/ambiental/modificar_doc_5/{id_encargado}', 'Amb_encargadosController@modificar_doc_5');
    Route::post('/ambiental/modificar_doc_6/{id_encargado}', 'Amb_encargadosController@modificar_doc_6');
    Route::post('/ambiental/modificar_doc_7/{id_encargado}', 'Amb_encargadosController@modificar_doc_7');
    Route::post('/ambiental/modificar_doc_8/{id_encargado}', 'Amb_encargadosController@modificar_doc_8');
    Route::post('/ambiental/modificar_doc_9/{id_encargado}', 'Amb_encargadosController@modificar_doc_9');
    Route::post('/ambiental/modificar_doc_10/{id_encargado}', 'Amb_encargadosController@modificar_doc_10');
    Route::post('/ambiental/modificar_doc_11/{id_encargado}', 'Amb_encargadosController@modificar_doc_11');
    Route::post('/ambiental/modificar_doc_12_condoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_12condoc');
    Route::post('/ambiental/modificar_doc_12_sindoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_12sindoc');
    Route::post('/ambiental/modificar_doc_13/{id_encargado}', 'Amb_encargadosController@modificar_doc_13');
    Route::post('/ambiental/modificar_doc_14_condoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_14condoc');
    Route::post('/ambiental/modificar_doc_14_sindoc/{id_encargado}', 'Amb_encargadosController@modificar_doc_14sindoc');
    Route::post('/ambiental/enviar_documentacion/{id_documentacion_encar}', 'Amb_encargadosController@enviar_documentacion');
    Route::post('/ambiental/enviar_documentacion_mod/{id_documentacion_encar}', 'Amb_encargadosController@enviar_documentacion_mod');
    Route::get('/ambiental/ver_documentacion_ambiental/', 'Amb_jefe_ambientalController@index');
    Route::get('/ambiental/estado_periodo/', 'Amb_jefe_ambientalController@estado_periodo');
    Route::get('/ambiental/proceso_de_modificacion/', 'Amb_jefe_ambientalController@proceso_de_modificacion');
    Route::get('/ambiental/documentacion_autorizada/', 'Amb_jefe_ambientalController@documentacion_autorizada');
    Route::get('/ambiental/ver_documentacion_encargado/', 'Amb_jefe_ambientalController@ver_documentacion_encargado');
    Route::get('/ambiental/documentacion_encar/{id_documentacion_encar}', 'Amb_jefe_ambientalController@documentacion_encar');
    Route::get('/ambiental/documentacion_encar_mod/{id_documentacion_encar}', 'Amb_jefe_ambientalController@documentacion_encar_mod');
    Route::get('/ambiental/ver_doc_encargado_proc/{id_documentacion_encar}', 'Amb_jefe_ambientalController@ver_doc_encargado_proc');
    Route::get('/ambiental/ver_documentacion_autorizada/', 'Amb_jefe_ambientalController@ver_documentacion_autorizada');
    Route::get('/ambiental/ver_doc_autorizada_departamento/{id_documentacion_encar}', 'Amb_jefe_ambientalController@ver_doc_autorizada_departamento');
    Route::get('/ambiental/historial_ambiental_departamento/', 'Amb_jefe_ambientalController@historial_ambiental_departamento');
    Route::get('/ambiental/ver_doc_encargado_aut/{id_documentacion_encar}', 'Amb_jefe_ambientalController@ver_doc_encargado_aut');
    Route::get('/ambiental/ver_procedimiento_encargado/{id_periodo}', 'Amb_encargadosController@ver_procedimiento_encargado');
    Route::get('/ambiental/ver_doc_encargado_dep_aut/{id_documentacion_encar}', 'Amb_jefe_ambientalController@ver_doc_encargado_dep_aut');

    Route::post('/ambiental/guardar_validacion_doc1/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc1');
    Route::post('/ambiental/guardar_validacion_doc2/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc2');
    Route::post('/ambiental/guardar_validacion_doc3/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc3');
    Route::post('/ambiental/guardar_validacion_doc4/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc4');
    Route::post('/ambiental/guardar_validacion_doc5/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc5');
    Route::post('/ambiental/guardar_validacion_doc6/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc6');
    Route::post('/ambiental/guardar_validacion_doc7/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc7');
    Route::post('/ambiental/guardar_validacion_doc8/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc8');
    Route::post('/ambiental/guardar_validacion_doc9/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc9');
    Route::post('/ambiental/guardar_validacion_doc10/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc10');
    Route::post('/ambiental/guardar_validacion_doc11/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc11');
    Route::post('/ambiental/guardar_validacion_doc12/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc12');
    Route::post('/ambiental/guardar_validacion_doc13/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc13');
    Route::post('/ambiental/guardar_validacion_doc14/{id_documentacion_encar}', 'Amb_jefe_ambientalController@guardar_validacion_doc14');
    Route::get('/ambiental/enviar_correciones_documentacion/{id_documentacion_encar}', 'Amb_jefe_ambientalController@enviar_correciones_documentacion');
    Route::get('/ambiental/enviar_aceptacion_documentacion/{id_documentacion_encar}', 'Amb_jefe_ambientalController@enviar_aceptacion_documentacion');
    Route::get('/ambiental/ver_proc_ambiental/{id_periodo}', 'Amb_jefe_ambientalController@ver_proc_ambiental');
    Route::get('/ambiental/datos_periodo/{id_periodo}', 'Amb_jefe_ambientalController@datos_periodos');
    Route::get('/ambiental/buscar_encargados_procedimientos/{id_periodo}', 'Amb_jefe_ambientalController@buscar_encargados_procedimientos');
    Route::get('/ambiental/ver_proc_encargado_doc/{id_periodo}/{id_encargado}', 'Amb_jefe_ambientalController@ver_proc_encargado_doc');
    Route::post('/ambiental/guardar_dat_doc/{id_periodo}/{id_encargado}', 'Amb_jefe_ambientalController@guardar_dat_doc');
    Route::post('/ambiental/modificar_guardar_dat_doc/{id_periodo}/{id_encargado}', 'Amb_jefe_ambientalController@modificar_guardar_dat_doc');
    Route::get('/ambiental/estado_registro_encargado/{id_periodo}/{id_encargado}', 'Amb_encargadosController@estado_registro_encargado');
    Route::get('/ambiental/estado_doc_validar/{id_documentacion_encar}', 'Amb_jefe_ambientalController@estado_doc_validar');
////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// ...............................................Modulo de Titulacion
    /// .................................................................................................................
    Route::get('/titulacion/registro_alumnos_titulacion/', 'Ti_registro_alumnosController@index');
    Route::get('/titulacion/registro_alumnos_carrera/{id_carrera}', 'Ti_registro_alumnosController@registro_alumnos_carrera');
    Route::get('/titulacion/mostrar_datos_alumno/{id_alumno}', 'Ti_registro_alumnosController@mostrar_datos_alumno');
    Route::post('/titulacion/guardar_datos_alumno/', 'Ti_registro_alumnosController@guardar_datos_alumno');
    Route::get('/titulacion/ver_datos_alumno/{id_descuento_alum}', 'Ti_registro_alumnosController@ver_datos_alumno_descuento');
    Route::get('/titulacion/editar_datos_alumno/{id_descuento_alum}', 'Ti_registro_alumnosController@editar_datos_alumno');
    Route::get('/titulacion/eliminar_datos_alumno/{id_descuento_alum}', 'Ti_registro_alumnosController@eliminar_datos_alumno');
    Route::post('/titulacion/eliminacion_edicion_datos_alumno/', 'Ti_registro_alumnosController@eliminacion_edicion_datos_alumno');

    Route::post('/titulacion/guardar_edicion_datos_alumno/', 'Ti_registro_alumnosController@guardar_edicion_datos_alumno');
    Route::get('/titulacion/documentacion_requisitos_titulacion/', 'Ti_registro_alumnosController@documentacion_requisitos_titulacion');
    Route::get('/titulacion/ingles_carreras/', 'Ti_dep_inglesController@ingles_carreras');
    Route::get('/titulacion/ingles_alumnos_carrera/{id_carrera}', 'Ti_dep_inglesController@ingles_alumnos_carrera');
    Route::get('/titulacion/certificado_alumno/{id_alumno}', 'Ti_dep_inglesController@certificado_alumno');
    Route::get('/titulacion/agregar_certificado/{id_alumno}', 'Ti_dep_inglesController@agregar_certificado');
    Route::post('/titulacion/guardar_certificado_alumno/', 'Ti_dep_inglesController@guardar_certificado_alumno');
    Route::get('/titulacion/editar_certificado/{id_certificado_acreditacion}', 'Ti_dep_inglesController@editar_certificado');
    Route::post('/titulacion/modificar_edicion_datos_alumno/', 'Ti_dep_inglesController@modificar_edicion_datos_alumno');
    Route::get('/titulacion/eliminar_certificado/{id_certificado_acreditacion}', 'Ti_dep_inglesController@eliminar_certificado');
    Route::post('/titulacion/eliminacion_certificado/', 'Ti_dep_inglesController@eliminacion_certificado');
    Route::get('/titulacion/enviar_certificado/{id_certificado_acreditacion}', 'Ti_dep_inglesController@enviar_certificado');
    Route::post('/titulacion/aceptar_envio_certificado/', 'Ti_dep_inglesController@aceptar_envio_certificado');
    Route::post('/titulacion/registrar_pago_concepto_autenticacion/{id_requisitos}', 'Ti_registro_alumnosController@registrar_pago_concepto_autenticacion');


    Route::get('/titulacion/estado_actual_fecha/{id_alumno}', 'Ti_registro_alumnosController@estado_actual_fecha');
    Route::get('/titulacion/est_actual_doc_al/{id_alumno}', 'Ti_registro_alumnosController@est_actual_doc_al');
    Route::post('/titulacion/registrar_acta_nacimiento/{id_requisitos}', 'Ti_registro_alumnosController@registrar_acta_nacimiento');
    Route::get('/titulacion/veri_constancia_ingles/{id_alumno}', 'Ti_registro_alumnosController@veri_constancia_ingles');
    Route::get('/titulacion/veri_egel_al/{id_alumno}', 'Ti_registro_alumnosController@veri_egel_al');
    Route::get('/titulacion/veri_ante_2010/{id_alumno}', 'Ti_registro_alumnosController@veri_ante_2010');

    Route::post('/titulacion/reg_correo_alumno/{id_alumno}/{correo_electronico}', 'Ti_registro_alumnosController@registrar_correo_electronico');
    Route::get('/titulacion/documentacion_alumno/{id_alumno}', 'Ti_registro_alumnosController@documentacion_alumno_titulacion');
    Route::post('/titulacion/registrar_curp/{id_requisitos}', 'Ti_registro_alumnosController@registrar_curp_titulacion');
    Route::post('/titulacion/registrar_certificado_prepa/{id_requisitos}', 'Ti_registro_alumnosController@registrar_cert_prepa_titulacion');
    Route::post('/titulacion/registrar_certificado_tec/{id_requisitos}', 'Ti_registro_alumnosController@registrar_certificado_tec_titulacion');
    Route::post('/titulacion/registrar_constancia_ss/{id_requisitos}', 'Ti_registro_alumnosController@registrar_constancia_ss_titulacion');
    Route::post('/titulacion/registrar_certificado_ingles/{id_requisitos}', 'Ti_registro_alumnosController@registrar_certificado_ingles');
    Route::post('/titulacion/registrar_constancia_adeudo/{id_requisitos}', 'Ti_registro_alumnosController@registrar_constancia_adeudo');
    Route::post('/titulacion/registrar_reporte_result_egel/{id_requisitos}', 'Ti_registro_alumnosController@registrar_reporte_result_egel');
    Route::post('/titulacion/registrar_pago_titulo/{id_requisitos}', 'Ti_registro_alumnosController@registrar_pago_titulo');
    Route::post('/titulacion/registrar_pago_constancia/{id_requisitos}', 'Ti_registro_alumnosController@registrar_pago_constancia');
    Route::post('/titulacion/registrar_pago_derecho_ti/{id_requisitos}', 'Ti_registro_alumnosController@registrar_pago_derecho_ti');
    Route::post('/titulacion/registrar_pago_integrante_jurado/{id_requisitos}', 'Ti_registro_alumnosController@registrar_pago_integrante_jurado');
    Route::post('/titulacion/registrar_acta_residencia/{id_requisitos}', 'Ti_registro_alumnosController@registrar_acta_residencia');


    Route::get('/titulacion/status_certi_ingles/{id_alumno}', 'Ti_registro_alumnosController@status_certi_ingles');
    Route::get('/titulacion/opciones_titulacion/{id_alumno}', 'Ti_registro_alumnosController@opciones_titulacion');
    Route::post('/titulacion/registrar_opcion_titulacion/{id_requisito}/{id_opcion_titulacion}', 'Ti_registro_alumnosController@registrar_opcion_titulacion');
    Route::post('/titulacion/reg_opc_ti_sin_doc/{id_requisito}/{id_opcion_titulacion}', 'Ti_registro_alumnosController@reg_opc_ti_sin_doc');
    Route::post('/titulacion/guardar_enviar_doc_titulacion/{id_requisito}/', 'Ti_registro_alumnosController@guardar_enviar_doc_titulacion');

    Route::get('/titulacion/autorizar_doc_requisitos/', 'Ti_autorizar_doc_departamentoController@carrera_doc_requisitos');
    Route::get('/titulacion/autorizar_alumnos_doc_requisitos/{id_carrera}', 'Ti_autorizar_doc_departamentoController@index');
    Route::get('/titulacion/carrera_alum_doc/{id_carrera}', 'Ti_autorizar_doc_departamentoController@carrera_alum_doc');
    Route::get('/titulacion/proceso_modificacion_doc_requisitos/{id_carrera}', 'Ti_autorizar_doc_departamentoController@proceso_modificacion_doc_requisitos');
    Route::get('/titulacion/autorizados_doc_requisitos/{id_carrera}', 'Ti_autorizar_doc_departamentoController@autorizar_alumno_doc_requisitos');
    Route::get('/titulacion/revisar_doc_requisitos/{id_alumno}', 'Ti_autorizar_doc_departamentoController@revisar_doc_requisitos');
    Route::post('/titulacion/guardar_validar_1/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_1');
    Route::post('/titulacion/guardar_validar_2/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_2');
    Route::post('/titulacion/guardar_validar_3/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_3');
    Route::post('/titulacion/guardar_validar_4/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_4');
    Route::post('/titulacion/guardar_validar_5/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_5');
    Route::post('/titulacion/guardar_validar_6/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_6');
    Route::post('/titulacion/guardar_validar_7/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_7');
    Route::post('/titulacion/guardar_validar_8/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_8');
    Route::post('/titulacion/guardar_validar_9/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_9');
    Route::post('/titulacion/guardar_validar_10/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_10');
    Route::post('/titulacion/guardar_validar_11/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_11');
    Route::post('/titulacion/guardar_validar_12/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_12');
    Route::post('/titulacion/guardar_validar_13/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_13');
    Route::post('/titulacion/guardar_validar_14/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@guardar_validar_14');

    Route::get('/requisitos/enviar_correcciones_alumno/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@enviar_correcciones_alumno');
    Route::post('/titulacion/enviar_doc_correcciones/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@enviar_doc_correcciones');
    Route::get('/requisitos/enviar_autorizacion_documentacion/{id_requisitos}', 'Ti_autorizar_doc_departamentoController@enviar_autorizacion_documentacion');
    Route::post('/titulacion/modificar_correo_alumno/{id_requisitos}/{correo_electronico}', 'Ti_autorizar_doc_departamentoController@modificar_correo_alumno');
    Route::get('/titulacion/ver_documentacion_autorizada/{id_alumno}', 'Ti_autorizar_doc_departamentoController@ver_documentacion_autorizada');
    Route::get('/titulacion/ver_documentacion_autorizada_alumno/{id_alumno}/', 'Ti_registro_alumnosController@ver_documentacion_autorizada_alumno');
    Route::get('/titulacion/pdf_requisitos_tramite_titulacion/{id_alumno}', 'Ti_requisitos_pdfController@index');

    Route::get('/titulacion/reg_datos_personales/segunda_etapa/', 'Ti_reg_datos_alumnosController@reg_datos_personales');
    Route::get('/titulacion/estado_reg_personales/{id_alumno}', 'Ti_reg_datos_alumnosController@estado_reg_personales');
    Route::get('/titulacion/datos_personales/{id_alumno}', 'Ti_reg_datos_alumnosController@datos_personales');
    Route::get('/titulacion/careras_tesvb/', 'Ti_reg_datos_alumnosController@careras_tesvb');
    Route::get('/titulacion/nacionalidades/', 'Ti_reg_datos_alumnosController@nacionalidades');
    Route::get('/titulacion/planes_estudio_tesvb/', 'Ti_reg_datos_alumnosController@planes_estudio_tesvb');
    Route::get('/titulacion/respuestas_tesvb/', 'Ti_reg_datos_alumnosController@respuestas_tesvb');
    Route::get('/titulacion/numeros_semestres_tesvb/', 'Ti_reg_datos_alumnosController@numeros_semestres_tesvb');
    Route::get('/titulacion/opciones_titulacion_tesvb/', 'Ti_reg_datos_alumnosController@opciones_titulacion_tesvb');
    Route::get('/titulacion/entidades_federativas/', 'Ti_reg_datos_alumnosController@entidades_federativas');
    Route::get('/titulacion/municipios/{id_estado}', 'Ti_reg_datos_alumnosController@municipios');
    Route::get('/titulacion/tipo_donaciones/{id_tipo_descuento}', 'Ti_reg_datos_alumnosController@tipo_donaciones');
    Route::get('/titulacion/antecedentes_estudios/', 'Ti_reg_datos_alumnosController@antecedentes_estudios');
    Route::post('/titulacion/registrar_datos_alumno/', 'Ti_reg_datos_alumnosController@registrar_datos_alumno');
    Route::get('/titulacion/ver_datos_alumno_registrados/{id_alumno}', 'Ti_reg_datos_alumnosController@ver_datos_alumno_registrados');
    Route::post('/titulacion/modificar_datos_alumno/', 'Ti_reg_datos_alumnosController@modificar_datos_alumno');
    Route::post('/titulacion/registrar_libro/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@registrar_libro');
    Route::post('/titulacion/registrar_computo/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@registrar_computo');
    Route::get('/titulacion/ver_libros/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@ver_libros');
    Route::post('/titulacion/modificacion_libro/', 'Ti_reg_datos_alumnosController@modificacion_libro');
    Route::post('/titulacion/eliminacion_libro/', 'Ti_reg_datos_alumnosController@eliminacion_libro');
    Route::get('/titulacion/ver_material_computo/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@ver_material_computo');
    Route::post('/titulacion/modificar_computo/', 'Ti_reg_datos_alumnosController@modificar_computo');
    Route::post('/titulacion/eliminacion_computo/', 'Ti_reg_datos_alumnosController@eliminacion_computo');
    Route::get('/titulacion/contar_libros/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@contar_libros');
    Route::get('/titulacion/contar_computo/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@contar_computo');
    Route::post('/titulacion/enviar_datos_alumno/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@enviar_datos_alumno');
    Route::post('/titulacion/enviar_datos_alumno_mod/{id_reg_dato_alum}', 'Ti_reg_datos_alumnosController@enviar_datos_alumno_mod');
    Route::get('/titulacion/tipos_estudiantes/', 'Ti_reg_datos_alumnosController@tipos_estudiantes');
    Route::get('/titulacion/tipos_redes_sociales/', 'Ti_reg_datos_alumnosController@tipos_redes_sociales');

    Route::get('/titulacion/autorizar_datos_personales/', 'Ti_autorizar_dat_personalesController@index');
    Route::get('/titulacion/carrera_alum_reg_datos/{id_carrera}', 'Ti_autorizar_dat_personalesController@carrera_alum_reg_datos');
    Route::get('/titulacion/revisar_datos_generales/{id_alumno}', 'Ti_autorizar_dat_personalesController@revisar_datos_generales');
    Route::get('/titulacion/enviar_modificaciones/{id_reg_dato_alum}/{comentario_modificacion}', 'Ti_autorizar_dat_personalesController@enviar_modificaciones');
    Route::get('/titulacion/enviar_autorizacion/{id_reg_dato_alum}', 'Ti_autorizar_dat_personalesController@enviar_autorizacion');
    Route::get('/titulacion/documento_titulacion_autorizado/', 'Ti_autorizar_dat_personalesController@documento_titulacion_autorizado');
    Route::get('/titulacion/documento_titulacion_autorizado/', 'Ti_autorizar_dat_personalesController@documento_titulacion_autorizado');


    Route::get('/titulacion/autorizacion_entrega_cd', 'Ti_autorizar_dat_personalesController@autorizacion_entrega_cd');
    Route::get('/titulacion/mostrar_datos_alumno_informacion/{id_reg_dato_alum}', 'Ti_autorizar_dat_personalesController@mostrar_datos_alumno_informacion');
    Route::post('/titulacion/autorizar_estudiante/', 'Ti_autorizar_dat_personalesController@autorizar_estudiante');
    Route::get('/titulacion/proceso_modificacion_datos_alumno/{id_carrera}', 'Ti_autorizar_dat_personalesController@proceso_modificacion_datos_alumno');
    Route::get('/titulacion/faltante_datos_alumno/{id_carrera}', 'Ti_autorizar_dat_personalesController@faltante_datos_alumno');
    Route::get('/titulacion/autorizados_datos_alumno/{id_carrera}', 'Ti_autorizar_dat_personalesController@autorizados_datos_alumno');
    Route::get('/titulacion/ver_datos_personales_alumno_ti/{id_alumno}/{id_carrera}', 'Ti_autorizar_dat_personalesController@ver_datos_personales_alumno_ti');
    Route::get('/titulacion/carrera_informacion/{id_carrera}', 'Ti_autorizar_dat_personalesController@carrera_informacion');
    Route::get('/titulacion/ver_datos_per_ti_aut/{id_alumno}/{id_carrera}', 'Ti_autorizar_dat_personalesController@ver_datos_per_ti_aut');


    Route::get('/titulacion/pdf_proyecto_titulacion/{id_alumno}', 'Ti_proyecto_titulacionController@index');
    Route::get('/titulacion/pdf_solicitud_opcion_titulacion/{id_alumno}', 'Ti_solicitud_opcion_titulacionController@index');
    Route::get('/titulacion/pdf_constancia_no_incoveniencia/{id_alumno}', 'Ti_constancia_no_incovenienciaController@index');
    Route::get('/titulacion/pdf_constancia_liberación/{id_alumno}', 'Ti_constancia_liberacionController@index');

    /// titulacion tercera_etapa
    Route::get('/titulacion/registro_jurado/', 'Ti_registro_juradoController@index');
    Route::get('/titulacion/estado_reg_jurado/{id_alumno}', 'Ti_registro_juradoController@estado_reg_jurado');
    Route::post('/titulacion/registrar_fecha_jurado/{id_alumno}', 'Ti_registro_juradoController@registrar_fecha_jurado');
    Route::post('/titulacion/eliminar_fecha_titulacion/{id_alumno}', 'Ti_registro_juradoController@eliminar_fecha_titulacion');
    Route::post('/titulacion/elim_fe_titulacion/{id_alumno}', 'Ti_registro_juradoController@elim_fe_titulacion');
    Route::get('/titulacion/modificar_fecha_titulacion/{id_alumno}', 'Ti_registro_juradoController@modificar_fecha_titulacion');
    Route::post('/titulacion/editar_fecha_jurado/', 'Ti_registro_juradoController@editar_fecha_jurado');
    Route::get('/titulacion/agregar_presidente/{id_alumno}', 'Ti_registro_juradoController@agregar_presidente');
    Route::post('/titulacion/guardar_presidente/', 'Ti_registro_juradoController@guardar_presidente');
    Route::get('/titulacion/modificar_presidente/{id_alumno}', 'Ti_registro_juradoController@modificar_presidente');
    Route::post('/titulacion/guardar_modificacion_presidente/', 'Ti_registro_juradoController@guardar_modificacion_presidente');
    Route::get('/titulacion/agregar_secretario/{id_alumno}', 'Ti_registro_juradoController@agregar_secretario');
    Route::post('/titulacion/guardar_secretario/', 'Ti_registro_juradoController@guardar_secretario');
    Route::get('/titulacion/modificar_secretario/{id_alumno}', 'Ti_registro_juradoController@modificar_secretario');
    Route::post('/titulacion/guardar_modificacion_secretario/', 'Ti_registro_juradoController@guardar_modificacion_secretario');
    Route::get('/titulacion/agregar_vocal/{id_alumno}', 'Ti_registro_juradoController@agregar_vocal');
    Route::post('/titulacion/guardar_vocal/', 'Ti_registro_juradoController@guardar_vocal');
    Route::get('/titulacion/modificar_vocal/{id_alumno}', 'Ti_registro_juradoController@modificar_vocal');
    Route::post('/titulacion/guardar_modificacion_vocal/', 'Ti_registro_juradoController@guardar_modificacion_vocal');
    Route::get('/titulacion/agregar_suplente/{id_alumno}', 'Ti_registro_juradoController@agregar_suplente');
    Route::post('/titulacion/guardar_suplente/', 'Ti_registro_juradoController@guardar_suplente');
    Route::get('/titulacion/modificar_suplente/{id_alumno}', 'Ti_registro_juradoController@modificar_suplente');
    Route::post('/titulacion/guardar_modificacion_suplente/', 'Ti_registro_juradoController@guardar_modificacion_suplente');
    Route::post('/titulacion/enviar_jurado/{id_alumno}', 'Ti_registro_juradoController@enviar_jurado');

    Route::get('/titulacion/autorizar_jurado_estudiantes/', 'Ti_autorizar_juradoController@carrera_jurado');
    Route::get('/titulacion/autorizar_jurado_estudiantes_carrera/{id_carrera}', 'Ti_autorizar_juradoController@index');
    Route::get('/titulacion/revisar_jurado_estudiante/{id_alumno}', 'Ti_autorizar_juradoController@revisar_jurado_estudiante');
    Route::get('/titulacion/dia_titulacion/{fecha_titulacion}/{id_alumno}/{id_sala}', 'Ti_autorizar_juradoController@dia_titulacion');
    Route::get('/titulacion/enviar_modificaciones_jurado/{id_alumno}', 'Ti_autorizar_juradoController@enviar_modificaciones_jurado');
    Route::post('/titulacion/guardar_modificaciones_jurado/{id_alumno}', 'Ti_autorizar_juradoController@guardar_modificaciones_jurado');
    Route::get('/titulacion/proceso_modificacion_jurado/{id_carrera}', 'Ti_autorizar_juradoController@proceso_modificacion_jurado');
    Route::get('/titulacion/autorizados_jurado/{id_carrera}', 'Ti_autorizar_juradoController@autorizados_jurado');
    Route::post('/titulacion/enviar_jurado_mod/{id_alumno}', 'Ti_autorizar_juradoController@enviar_jurado_mod');
    Route::post('/titulacion/guardar_autorizacion_jurado/{id_alumno}', 'Ti_autorizar_juradoController@guardar_autorizacion_jurado');
    Route::get('/titulacion/ver_jurado_estudiante_autorizado/{id_alumno}', 'Ti_autorizar_juradoController@ver_jurado_estudiante_autorizado');
    Route::post('/titulacion/guardar_datos_oficio_notificacion_jefe/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@oficio_notificacion_jurado');
    Route::post('/titulacion/guardar_editar_datos_oficio_notificacion_jefe/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@guardar_editar_datos_oficio_notificacion_jefe');
    Route::post('/titulacion/autorizar_datos_oficio_notificacion_jefe/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@autorizar_datos_oficio_notificacion_jefe');
    Route::get('/titulacion/pdf_oficio_notificacion_jefe/{id_fecha_jurado_alumn}', 'Ti_oficio_noti_jurado_jefeController@index');

    Route::post('/titulacion/guardar_datos_oficio_notificacion_estudiante/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@guardar_datos_oficio_notificacion_estudiante');
    Route::post('/titulacion/guardar_editar_datos_oficio_notificacion_estudiante/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@guardar_editar_datos_oficio_notificacion_estudiante');
    Route::post('/titulacion/autorizar_datos_oficio_notificacion_estudiante/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@autorizar_datos_oficio_notificacion_estudiante');
    Route::get('/titulacion/editar_reporte_titulacion/{id_alumno}', 'Ti_autorizar_dat_personalesController@editar_reporte_titulacion');
    Route::get('/titulacion/editar_reporte_titulacion_centro/{id_alumno}', 'Ti_autorizar_dat_personalesController@editar_reporte_titulacion_centro');
    Route::post('/titulacion/modificar_datos_estudiante/', 'Ti_autorizar_dat_personalesController@modificar_datos_estudiante');
    Route::post('/titulacion/modificar_datos_estudiante_computo/', 'Ti_autorizar_dat_personalesController@modificar_datos_estudiante_computo');
    Route::get('/titulacion/enviar_reporte_titulacion/{id_alumno}', 'Ti_autorizar_dat_personalesController@enviar_reporte_titulacion');
    Route::post('/titulacion/guardar_enviar_datos_estudiante_informacion/', 'Ti_autorizar_dat_personalesController@guardar_enviar_datos_estudiante_informacion');

    Route::get('/titulacion/pdf_oficio_notificacion_estudiante/{id_fecha_jurado_alumn}', 'Ti_oficio_noti_jurado_estController@pdf_oficio_notificacion_estudiante');
    Route::get('/titulacion/pdf_carta_compromiso/{id_fecha_jurado_alumn}', 'Ti_carta_compromisoController@index');
    Route::post('/titulacion/guardar_datos_mencion_honorifica/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@guardar_datos_mencion_honorifica');
    Route::post('/titulacion/guardar_editar_datos_oficio_mencion_honorifica/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@guardar_editar_datos_oficio_mencion_honorifica');
    Route::post('/titulacion/autorizar_oficio_mencion_honorifica/{id_fecha_jurado_alumn}', 'Ti_autorizar_juradoController@autorizar_oficio_mencion_honorifica');
    Route::get('/titulacion/pdf_mencion_honorifica/{id_fecha_jurado_alumn}', 'Ti_oficio_mencion_honorificaController@index');

    Route::get('/titulacion/editar_titulo_cedula/', 'Ti_calendario_estudianteController@editar_titulo_cedula');
    Route::post('/titulo/agregar_titulo/', 'Ti_calendario_estudianteController@guardar_agregar_titulo');
    Route::get('/titulacion/editar_titulo_profesor/{id_abreviacion_prof}', 'Ti_calendario_estudianteController@editar_titulo_profesor');
    Route::post('/titulacion/guardar_editar_titulo_profesor/', 'Ti_calendario_estudianteController@guardar_editar_titulo_profesor');
    Route::get('/titulacion/edita_cedula/{id_personal}', 'Ti_calendario_estudianteController@edita_cedula');
    Route::post('/titulacion/guardar_editar_cedula_profesor/', 'Ti_calendario_estudianteController@guardar_editar_cedula_profesor');

    /*Route::get('/titulacion/calendario_estudiantes_autorizado/', 'Ti_calendario_estudianteController@calendario_estudiantes_autorizado');
    Route::get('/titulacion/consultar_fecha_dia_titulacion_autorizadas/{fecha_dia}', 'Ti_calendario_estudianteController@calendario_estudiantes_autorizado_dia');
    Route::get('/titulacion/consultar_fechas_titulacion/{fecha_inicial}/{fecha_final}', 'Ti_registro_juradoController@consultar_fechas_titulacion');*/

    Route::get('/titulacion/calendario_estudiantes_autorizado/', 'Ti_calendario_estudianteController@calendario_estudiantes_autorizado');
    Route::get('/titulacion/consultar_fecha_dia_titulacion_autorizadas/{fecha_dia}', 'Ti_calendario_estudianteController@calendario_estudiantes_autorizado_dia')->name('calendario_estudiantes_autorizado_dia');
    Route::get('/titulacion/consultar_fechas_titulacion/{fecha_inicial}/{fecha_final}', 'Ti_registro_juradoController@consultar_fechas_titulacion');
    Route::post('/actualizar-registro-calendario', 'Ti_calendario_estudianteController@guardar_editar_registro_calendario')->name('guardar_editar_registro_calendario');


    Route::get('/titulacion/validacion_agregar_jurado/carreras/', 'Ti_registro_juradoController@validacion_agregar_jurado_carreras');
    Route::get('/titulacion/validacion_agregar_jurado/alumnos/{id_carrera}', 'Ti_registro_juradoController@validacion_agregar_jurado_alumnos');
    Route::get('/titulacion/autorizacion_jurado_alumno/{id_fecha_jurado_alumn}', 'Ti_registro_juradoController@autorizacion_jurado_alumno');
    Route::post('/titulacion/guardar_autorizar_agregar_jurado/', 'Ti_registro_juradoController@guardar_autorizar_agregar_jurado');
    Route::get('/titulacion/fecha_titulacion_alumnos/{fecha_titulacion}/{sala_titulacion}', 'Ti_registro_juradoController@fecha_titulacion_alumnos');


    Route::get('/titulacion/formulario_datos_titulado/inicio/carrera/', 'Ti_formulario_datostituladoController@formulario_datos_titulado_carrera');
    Route::get('/titulacion/autorizar_titulacion_alumnos/{id_carrera}', 'Ti_formulario_datostituladoController@autorizar_titulacion_alumnos');
    Route::get('/titulacion/formulario_datos_titulado/dato_alumno/{id_alumno}', 'Ti_formulario_datostituladoController@formulario_datos_titulado_dato_alumno');
    Route::post('/titulacion/guardar_autorizacion_titulacion/', 'Ti_formulario_datostituladoController@guardar_autorizacion_titulacion');
    Route::get('/titulacion/alumnos_registrar_datos_dep/{id_carrera}', 'Ti_formulario_datostituladoController@alumnos_registrar_datos_dep');
    Route::get('/titulacion/formulario_registrar_datos_al_ti/{id_alumno}', 'Ti_formulario_datostituladoController@formulario_registrar_datos_al_ti');

    Route::post('/titulacion/registrar_formulario_datos/dato_alumno/{id_alumno}', 'Ti_formulario_datostituladoController@registrar_formulario_datos');
    Route::post('/titulacion/registrar_oficio_recursos/{id_alumno}', 'Ti_formulario_datostituladoController@registrar_oficio_recursos');
    Route::get('/titulacion/modificar_oficio_recursos/{id_alumno}', 'Ti_formulario_datostituladoController@modificar_oficio_recursos');
    Route::post('/titulacion/guardar_modificacion_oficio_recursos/{id_alumno}', 'Ti_formulario_datostituladoController@guardar_modificacion_oficio_recursos');
    Route::post('/titulacion/registrar_datos_acta_titulacion/{id_alumno}', 'Ti_formulario_datostituladoController@registrar_datos_acta_titulacion');
    Route::get('/titulacion/modificar_datos_acta_titulacion/{id_alumno}', 'Ti_formulario_datostituladoController@modificar_datos_acta_titulacion');
    Route::post('/titulacion/guardar_modificacion_acta_titulacion/{id_alumno}', 'Ti_formulario_datostituladoController@guardar_modificacion_acta_titulacion');
    Route::get('/titulacion/modificar_datos_estudiante_dep/{id_alumno}', 'Ti_formulario_datostituladoController@modificar_datos_estudiante_dep');
    Route::post('/titulacion/guardar_modificacion_dat_estudiante/{id_alumno}', 'Ti_formulario_datostituladoController@guardar_modificacion_dat_estudiante');
    Route::post('/titulacion/guardar_autorizaciondatos_registrados/{id_alumno}', 'Ti_formulario_datostituladoController@guardar_autorizaciondatos_registrados');
    Route::get('/titulacion/alumnos_autorizados_carrera/{id_carrera}', 'Ti_formulario_datostituladoController@alumnos_autorizados_carrera');
    Route::get('/titulacion/liberacion_alumno/{id_alumno}', 'Ti_formulario_datostituladoController@liberacion_alumno');
    Route::post('/titulacion/guardar_liberacion_alumno/', 'Ti_formulario_datostituladoController@guardar_liberacion_alumno');
    Route::get('/titulacion/formulario_datos_titulado_autorizado/dato_alumno/{id_alumno}', 'Ti_formulario_datostituladoController@formulario_datos_titulado_autorizado');
    Route::post('/titulacion/registrar_datos_mencion/{id_alumno}', 'Ti_formulario_datostituladoController@registrar_datos_mencion');
    Route::post('/titulacion/guardar_modificacion_mencion_honorifica/{id_alumno}', 'Ti_formulario_datostituladoController@guardar_modificacion_mencion_honorifica');

    Route::get('/titulacion/descargar_acta_mencion_honoriica/{id_alumno}', 'Ti_pdf_acta_mencionController@index');


    Route::get('/titulacion/reg_catalogo_tomos_titulo/', 'Ti_reg_catalogosController@reg_catalogo_tomos_titulo');
    Route::post('/titulacion/guardar_domo_titulacion/', 'Ti_reg_catalogosController@guardar_domo_titulacion');
    Route::post('/titulos/agregar_numeros_titulos_domo/', 'Ti_reg_catalogosController@agregar_numeros_titulos_domo');
    Route::get('/titulacion/consultar_domos_numeros_titulos/{id_reg_domo}', 'Ti_reg_catalogosController@consultar_domos_numeros_titulos');
    Route::get('/titulacion/agregar_escuelas_preparatorias/', 'Ti_reg_catalogosController@agregar_escuelas_preparatorias');
    Route::post('/titulacion/guardar_nueva_preparatoria/', 'Ti_reg_catalogosController@guardar_nueva_preparatoria');
    Route::get('/titulacion/modificar_preparatoria/{id_preparatoria}', 'Ti_reg_catalogosController@modificar_preparatoria');
    Route::post('/titulacion/guardar_modificacion_preparatoria/', 'Ti_reg_catalogosController@guardar_modificacion_preparatoria');
    Route::get('/titulacion/descargar_acta_titulacion/{id_alumno}', 'Ti_pdf_acta_titulacion1Controller@index');
    Route::get('/titulacion/descargar_acta_extención_examen/{id_alumno}', 'Ti_pdf_acta_titulacion1Controller@acta_extención_examen');
    Route::get('/titulacion/descargar_oficio_recursos/{id_alumno}', 'Ti_pdf_oficio_recursosController@index');
    Route::get('/titulacion/descargar_certificado_antecedentes/{id_alumno}', 'Ti_pdf_cert_antecedentesController@index');
    Route::get('/titulacion/descargar_certificado/{id_alumno}', 'Ti_pdf_cert_antecedentes1Controller@index');
    Route::get('/titulacion/editar_folio_titulo_editar/{id_numero_titulo}', 'Ti_reg_catalogosController@editar_folio_titulo');
    Route::post('/titulo/guardar_modificacion_folio_titulo/', 'Ti_reg_catalogosController@guardar_modificacion_folio_titulo');
    Route::post('/titulos/activar_folios_titulos/', 'Ti_reg_catalogosController@activar_folios_titulos');
    Route::post('/titulos/finalizar_folios_titulos/', 'Ti_reg_catalogosController@finalizar_folios_titulos');


    Route::get('/titulacion/relacion de documentos/inicio/', 'Ti_relacion_documentosController@index');
    Route::get('/titulacion/consultar_fecha_dia_relacion_doc/{fecha_dia}', 'Ti_relacion_documentosController@consultar_fecha_relacion_doc');
    Route::get('/titulacion/relacion_actas_titulos/{fecha}', 'Ti_relacion_documentosController@relacion_actas_titulacion');
    Route::post('/titulacion/registrar_num_relac_acta_titulacion/', 'Ti_relacion_documentosController@registrar_num_relac_acta_titulacion');
    Route::post('/titulacion/editar_num_relac_acta_titulacion/', 'Ti_relacion_documentosController@editar_num_relac_acta_titulacion');
    Route::post('/titulacion/autorizar_num_relac_acta_titulacion/{id_relacion_acta_titulacion}', 'Ti_relacion_documentosController@autorizar_num_relac_acta_titulacion');
    Route::get('/titulacion/pdf_relacion_actas/{id_relacion_acta_titulacion}', 'Ti_pdf_relacion_actasController@index');
    Route::get('/titulacion/relacion_titulos/{fecha}', 'Ti_relacion_documentosController@relacion_titulos');
    Route::post('/titulacion/registrar_num_relac_titulo/', 'Ti_relacion_documentosController@registrar_num_relac_titulo');
    Route::post('/titulacion/editar_num_relac_titulos/', 'Ti_relacion_documentosController@editar_num_relac_titulos');
    Route::post('/titulacion/autorizar_num_relac_titulos/{id_relacion_titulo}', 'Ti_relacion_documentosController@autorizar_num_relac_titulos');
    Route::get('/titulacion/pdf_relacion_titulos/{id_relacion_titulo}', 'Ti_pdf_relacion_actasController@pdf_relacion_titulos');

    Route::get('/titulacion/estado_folio_titulo_editar/{id_numero_titulo}', 'Ti_reg_catalogosController@estado_folio_titulo_editar');
    Route::post('/titulo/guardar_modificacion_estado_titulo/', 'Ti_reg_catalogosController@guardar_modificacion_estado_titulo');
    Route::get('/titulacion/agregar_estudiante_folio_titulacion/{id_numero_titulo}', 'Ti_reg_catalogosController@agregar_estudiante_folio_titulacion');
    Route::post('/titulo/guardar_agregar_folio_titulo/', 'Ti_reg_catalogosController@guardar_agregar_folio_titulo');

    Route::get('/titulacion/relacion_mencion_honorifica/{fecha}', 'Ti_relacion_documentosController@relacion_mencion_honorifica');
    Route::post('/titulacion/registrar_num_relac_mencion/', 'Ti_relacion_documentosController@registrar_num_relac_mencion');
    Route::post('/titulacion/editar_num_relac_mencion_honorifica/', 'Ti_relacion_documentosController@editar_num_relac_mencion_honorifica');
    Route::post('/titulacion/autorizar_num_relac_mencion_honorifica/{id_relacion_mencion_honorifica}', 'Ti_relacion_documentosController@autorizar_num_relac_mencion_honorifica');
    Route::get('/titulacion/relacion_pdf_mencion_honorifica/{id_relacion_mencion_honorifica}', 'Ti_pdf_relacion_actasController@relacion_pdf_mencion_honorifica');

    Route::get('/titulacion/liberacion_titulado_carrera/', 'Ti_liberacion_tituladoController@index');
    Route::get('/titulacion/registro_titulados_carrera/{id_carrera}', 'Ti_liberacion_tituladoController@registro_titulados_carrera');
    Route::get('/titulacion/ver_datos_titulado/{id_alumno}', 'Ti_liberacion_tituladoController@ver_datos_titulado');
    Route::get('/titulacion/exportar_alumnos_liberados/', 'Ti_liberacion_tituladoController@exportar_alumnos_liberados');

    Route::get('/titulacion/ver_certificado_ingles_carrera/','Ti_liberacion_tituladoController@ver_certificado_ingles_carrera');
    Route::get('/titulacion/ingles_alumnos_carrera_ver/{id_carrrera}','Ti_liberacion_tituladoController@ingles_alumnos_carrera_ver');

    Route::get('/titulacion/seleccionar_year/','Ti_liberacion_tituladoController@titulacion_seleccionar_year');
    Route::get('/titulacion/exportar_excel_yeartitulados/{id_year}','Ti_liberacion_tituladoController@exportar_excel_yeartitulados');

    //Route::get('/titulacion/modificar_mencion_honorifica/{id_alumno}', 'Ti_formulario_datostituladoController@modificar_datos_mencion_honorifica');


    ////////////////////////////Evaluacion de tutorias/////////////////

    /////////////////////Evaluacion por parte de los alumnos

    Route::get('/tutoras_evaluacion/evaluacion_al_tutor/', 'Tu_Eva_AlumnosController@index');

    //Route::get('/tutorias_evaluacion/evaluacion_al_tutor/','Tu_Eva_AlumnosController@index_uno');
    //Route::get('/tutorias_evaluacion/evaluacion_al_tutor/dos/','Tu_Eva_AlumnosController@index_dos');

    Route::get('/tutoras_evaluacion/evaluacion_al_tutor/dos/', 'Tu_Eva_AlumnosController@index_dos');
    Route::get('/tutoras_evaluacion/evaluacion_al_tutor/tres/', 'Tu_Eva_AlumnosController@index_tres');
    //Route::get('/tutorias_evaluacion/evaluacion_al_tutor/tres/','Tu_Eva_AlumnosController@index_tres');

    ///Route::post('/tutoras_evaluacion/guardar_evaluacion','Tu_Eva_AlumnosController@inserta_valor');
    Route::post('/tutoras_evaluacion/guardar_evaluacion', 'Tu_Eva_AlumnosController@inserta_valor_uno');
    Route::post('/tutoras_evaluacion/guardar_evaluacion/dos/', 'Tu_Eva_AlumnosController@inserta_valor_dos');
    Route::post('/tutoras_evaluacion/guardar_evaluacion/tres/', 'Tu_Eva_AlumnosController@inserta_valor_tres');

    ///////////Evaluacion por parte del tutor

    Route::get('/tutoras_evaluacion/resultado_tutorias/', 'Tu_Eva_TutorController@index');
    Route::get('/tutoras_evaluacion/resultado_grafica/{id_grupo_semestre}/', 'Tu_Eva_TutorController@grafica');

    /////////Evaluacion por parte cordinador

    Route::get('/tutoras_evaluacion/resultado_tutorias_cordinador/', 'Tu_Eva_CordinadorInstitucionalController@index');

    Route::get('/tutoras_evaluacion/resultado_tutorias_cordinador/evaluacion_tutor/{id_grupo_semestre}/{grupo}/{carrera}/', 'Tu_Eva_CordinadorInstitucionalController@resultados');
    Route::get('/tutoras_evaluacion/resultado_tutorias_cordinador/registro_alumnos/{id_asigna_generacion}/{id_carrera}', 'Tu_Eva_CordinadorInstitucionalController@registro');
    Route::get('/tutoras_evaluacion/resultado_tutorias_cordinador/carrera/{id_carrera}/', 'Tu_Eva_CordinadorInstitucionalController@carreras');

    Route::get('/tutorias/evaluacion_tutor/estado/', 'Tu_Eva_CordinadorInstitucionalController@estado');

    Route::get('/tutorias/evaluacion_tutor/estado/activa/', 'Tu_Eva_CordinadorInstitucionalController@activa');
    Route::get('/tutorias/evaluacion_tutor/estado/desactiva/', 'Tu_Eva_CordinadorInstitucionalController@desactiva');
    /////////Evaluacion por parte del jefe

    Route::get('/tutoras_evaluacion/resultado_tutorias_jefe/carreras','Tu_Eva_JefeController@carreras_eva');
    Route::get('/tutoras_evaluacion/resultado_tutorias_jefe/{id_asigna_coordinador}','Tu_Eva_JefeController@index');
    //Route::get('/tutoras_evaluacion/resultado_tutorias_jefe/','Tu_Eva_JefeController@index');


    //////Evaluacion..... Modulos de pdf y exel

    Route::post('/tutorias/evaluacion_tutor/imprime_grafica', 'Tu_Eva_pdf_graficaController@index');
    // Route::get('/tutorias/evaluacion_tutor/exportar_exel_carrera_tutorias/{id_carrera}/','Tu_eva_exportar_exel_carreraController@index');


    /////Auto evaluacion del tutor

    Route::get('/tutoras_evaluacion/auto_eveluacion/', 'Tu_Eva_TutorController@auto_evaluacion');
    Route::get('/tutoras_evaluacion/auto_eveluacion/dos/', 'Tu_Eva_TutorController@auto_evaluacion2');

    Route::post('/tutoras_evaluacion/auto_eveluacion/comentario/', 'Tu_Eva_TutorController@comentario');

    Route::post('/tutoras_evaluacion/auto_eveluacion/guardar_evaluacion', 'Tu_Eva_TutorController@inserta_valor_uno');
    Route::post('/tutoras_evaluacion/auto_eveluacion/guardar_evaluacion/dos', 'Tu_Eva_TutorController@inserta_valor_dos');

    Route::get('/tutorias_evaluacion/auto_eveluacion/grafica/{id_grupo_semestre}/{grupo}/{carrera}/', 'Tu_Eva_CordinadorInstitucionalController@resultados_cuestionario');
    Route::get('/tutorias/evaluacion_tutor/exportar_exel_carrera_tutores/', 'Tu_eva_exportar_exel_turoresController@index');

    Route::get('/tutorias/tutores_sin_registro', 'Tu_Eva_CordinadorInstitucionalController@tutores_sin_registro');
    Route::get('/tutorias/cuestionario_tutor/imprime_grafica', 'Tu_Eva_pdf_autoevaController@index');
    Route::get('/tutorias/evaluacion_tutor/exportar_exel_carrera_tutorias/{id_carrera}/', 'Tutorias_excelController@excel_carrera');


    /////............................SISTEMA DE REQUISICIONES DE MATERIALES ANTEPROYECTO DPTO. FINANZAS (ANTEPROYECTO)............-----
    Route::get('/presupuesto_anteproyecto/periodos_anteproyecto/', 'Pres_periodo_antController@index');
    Route::post('/presupuesto_anteproyecto/guardar_periodos_anteproyecto/', 'Pres_periodo_antController@guardar_periodos_anteproyecto');
    Route::get('/presupuesto_anteproyecto/modificar_periodos_anteproyecto/{id_periodo}', 'Pres_periodo_antController@modificar_periodos_anteproyecto');
    Route::post('/presupuesto_anteproyecto/guardar_modificacion_periodos_anteproyecto/{id_periodo}', 'Pres_periodo_antController@guardar_modificacion_periodos_anteproyecto');
    Route::get('/presupuesto_anteproyecto/activar_periodo_anteproyecto/{id_periodo}', 'Pres_periodo_antController@activar_periodo_anteproyecto');
    Route::post('/presupuesto_anteproyecto/guardar_activacion_periodo_anteproyecto/{id_periodo}', 'Pres_periodo_antController@guardar_activacion_periodo_anteproyecto');
    Route::post('/presupuesto_anteproyecto/guardar_finalizacion_periodos_anteproyecto/{id_periodo}', 'Pres_periodo_antController@guardar_finalizacion_periodos_anteproyecto');

    Route::get('/presupuesto_anteproyecto/partida_presupuestal/', 'Pres_periodo_antController@partida_presupuestal');
    Route::post('/presupuesto_anteproyecto/guardar_partida_presupuestal/', 'Pres_periodo_antController@guardar_partida_presupuestal');
    Route::get('/presupuesto_anteproyecto/modificar_partida_presupuestal/{id_partida}', 'Pres_periodo_antController@modificar_partida_presupuestal');
    Route::post('/presupuesto_anteproyecto/guardar_modificacion_partida/{id_partida}', 'Pres_periodo_antController@guardar_modificacion_partida');

    Route::get('/presupuesto_anteproyecto/proyectos_presupuestales/', 'Pres_periodo_antController@proyectos_presupuestales');
    Route::post('/presupuesto_anteproyecto/guardar_proyecto/', 'Pres_periodo_antController@guardar_proyecto');
    Route::get('/presupuesto_anteproyecto/modificar_proyecto/{id_proyecto}', 'Pres_periodo_antController@modificar_proyecto');
    Route::post('/presupuesto_anteproyecto/guardar_modificacion_proyecto/{id_proyecto}', 'Pres_periodo_antController@guardar_modificacion_proyecto');
    Route::get('/presupuesto_anteproyecto/activar_proyecto/{id_proyecto}', 'Pres_periodo_antController@activar_proyecto');
    Route::post('/presupuesto_anteproyecto/guardar_activacion_proyecto/{id_proyecto}', 'Pres_periodo_antController@guardar_activacion_proyecto');
    Route::get('/presupuesto_anteproyecto/desactivar_proyecto/{id_proyecto}', 'Pres_periodo_antController@desactivar_proyecto');
    Route::post('/presupuesto_anteproyecto/guardar_desactivacion_proyecto/{id_proyecto}', 'Pres_periodo_antController@guardar_desactivacion_proyecto');


    Route::get('/presupuesto_anteproyecto/proyectos_metas/', 'Pres_periodo_antController@proyectos_metas');
    Route::get('/presupuesto_anteproyecto/metas_presupuestales/{id_proyecto}', 'Pres_periodo_antController@metas_presupuestales');
    Route::post('/presupuesto_anteproyecto/guardar_meta/{id_proyecto}', 'Pres_periodo_antController@guardar_meta');
    Route::get('/presupuesto_anteproyecto/modificar_meta/{id_meta}', 'Pres_periodo_antController@modificar_meta');
    Route::post('/presupuesto_anteproyecto/guardar_modificacion_meta/{id_meta}', 'Pres_periodo_antController@guardar_modificacion_meta');
    //   Route::post('/presupuesto_anteproyecto/guardar_modificacion_meta/{id_meta}','Pres_periodo_antController@guardar_modificacion_meta');

    Route::get('/presupuesto_anteproyecto/registrar_requerimientos_anteproyecto/', 'Pres_reg_req_mat_antController@index');
    Route::post('/presupuesto_anteproyecto/registrar_inicio_req_ant/', 'Pres_reg_req_mat_antController@inicio_re_ant');
    Route::get('/presupuesto_anteproyecto/registro_inicio_req_ant/{id_req_mat_ante}', 'Pres_reg_req_mat_antController@registro_inicio_req_ant');
    Route::post('/presupuesto_anteproyecto/registrar_nueva_requisicion_mat/{id_req_mat_ante}', 'Pres_reg_req_mat_antController@registrar_nueva_requisicion_mat');
    Route::get('/presupuesto_anteproyecto/ver_meta/{id_anteproyecto}', 'Pres_reg_req_mat_antController@ver_meta');
    Route::post('/presupuesto_anteproyecto/guardar_requisicion_materiales/{id_req_mat_ante}', 'Pres_reg_req_mat_antController@guardar_requisicion_materiales');
    Route::get('/presupuesto_anteproyecto/modificar_requisicion_material/{id_actividades_req_ante}/{year_requisicion}', 'Pres_reg_req_mat_antController@modificar_requisicion_material');
    Route::post('/presupuesto_anteproyecto/guardar_modificacion_requisicion_materiales/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_modificacion_requisicion_materiales');
    Route::get('/presupuesto_anteproyecto/eliminar_requisicion_material/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@eliminar_requisicion_material');
    Route::post('/presupuesto_anteproyecto/guardar_eliminacion_requisicion_materiales/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_eliminacion_requisicion_materiales');
    Route::get('/presupuesto_anteproyecto/agregar_requisicion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@agregar_requisicion_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_requisicion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_requisicion_pdf');
    Route::get('/presupuesto_anteproyecto/agregar_anexo1_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@agregar_anexo1_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_anexo1_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_anexo1_pdf');
    Route::get('/presupuesto_anteproyecto/agregar_suficiencia_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@agregar_suficiencia_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_suficiencia_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_suficiencia_pdf');
    Route::get('/presupuesto_anteproyecto/agregar_justificacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@agregar_justificacion_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_justificacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_justificacion_pdf');
    Route::get('/presupuesto_anteproyecto/modificar_req_mat_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@modificar_req_mat_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_mod_requisicion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_mod_requisicion_pdf');
    Route::get('/presupuesto_anteproyecto/mod_anexo1_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@mod_anexo1_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_mod_anexo1_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_mod_anexo1_pdf');
    Route::get('/presupuesto_anteproyecto/mod_suficiencia_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@mod_suficiencia_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_mod_suficiencia_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_mod_suficiencia_pdf');
    Route::get('/presupuesto_anteproyecto/mod_justificacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@mod_justificacion_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_mod_justificacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_mod_justificacion_pdf');
    Route::get('/presupuesto_anteproyecto/agregar_cotizacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@agregar_cotizacion_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_cotizacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_cotizacion_pdf');
    Route::get('/presupuesto_anteproyecto/modificar_cotizacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@modificar_cotizacion_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_mod_cotizacion_pdf/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_mod_cotizacion_pdf');
    Route::post('/presupuesto_anteproyecto/guardar_bien/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@guardar_bien');
    Route::get('/presupuesto_anteproyecto/modificar_servicio/{id_reg_material_ant}', 'Pres_reg_req_mat_antController@modificar_servicio');
    Route::post('/presupuesto_anteproyecto/guardar_mod_bien/{id_reg_material_ant}', 'Pres_reg_req_mat_antController@guardar_mod_bien');
    Route::get('/presupuesto_anteproyecto/eliminar_servicio/{id_reg_material_ant}', 'Pres_reg_req_mat_antController@eliminar_servicio');
    Route::post('/presupuesto_anteproyecto/guardar_eliminar_bien/{id_reg_material_ant}', 'Pres_reg_req_mat_antController@guardar_eliminar_bien');

    Route::resource('/presupuesto_anteproyecto/techo_presupuestal/', 'Pres_techo_presupuestalController');
    Route::post('/presupuesto_anteproyecto/techo_presupuestal/agregar_proyecto/', 'Pres_techo_presupuestalController@agregar_proyecto_techo_presupuestal_ante');
    Route::get('/presupuesto_anteproyecto/techo_presupuestal/agregar_fuentes_financiamiento/{id_presupuesto}', 'Pres_techo_presupuestalController@agregar_fuentes_financiamiento_ante');
    Route::post('/presupuesto_anteproyecto/techo_presupuestal/guardar_fuentes_financiamiento/{id_presupuesto}', 'Pres_techo_presupuestalController@guardar_fuentes_financiamiento_ante');
    Route::get('/presupuesto_anteproyecto/techo_presupuestal/mod_fuentes_financiamiento/{id_fuente_financiamiento}', 'Pres_techo_presupuestalController@mod_fuentes_financiamiento');
    Route::post('/presupuesto_anteproyecto/techo_presupuestal/guardar_mod_capitulo/{id_fuente_financiamiento}', 'Pres_techo_presupuestalController@guardar_mod_capitulo');

    Route::get('/presupuesto_anteproyecto/techo_presupuestal/agregar_fuentes_f_ante/{id_proyecto}', 'Pres_techo_presupuestalController@agregar_fuentes_f_ante');
    Route::get('/presupuesto_anteproyecto/agregar_bienes_servicios_anteproyecto/{id_actividades_req_ante}', 'Pres_techo_presupuestalController@agregar_bienes_servicios_anteproyecto');
    Route::post('/presupuesto_anteproyecto/enviar_requisiciones/', 'Pres_reg_req_mat_antController@enviar_requisiciones');

    Route::resource('/presupuesto_anteproyecto/revicion_requisiciones_anteproyecto/', 'Pres_revision_req_anteController');
    Route::get('/presupuesto_anteproyecto/revicion_req_proy_anteproyecto/{id_proyecto}', 'Pres_revision_req_anteController@revicion_req_proy_anteproyecto');
    Route::get('/presupuesto_anteproyecto/revicion_req_departamento/{id_req_mat_ante}', 'Pres_revision_req_anteController@revicion_req_departamento');
    Route::get('/presupuesto_anteproyecto/revisicion_bienes_servicios_departamento/{id_actividades_req_ante}/{id_req_mat_ante}', 'Pres_revision_req_anteController@revisicion_bienes_servicios_departamento');
    Route::post('/presupuesto_anteproyecto/guardar_modificaciones/', 'Pres_revision_req_anteController@guardar_modificaciones');
    Route::post('/presupuesto_anteproyecto/guardar_autorizacion_requisicion/', 'Pres_revision_req_anteController@guardar_autorizacion_requisicion');
    Route::post('/presupuesto_anteproyecto/guardar_rechazo_requisicion/', 'Pres_revision_req_anteController@guardar_rechazo_requisicion');
    Route::post('/presupuesto_anteproyecto/enviar_modificaciones_depart/', 'Pres_revision_req_anteController@enviar_modificaciones_depart');
    Route::get('/presupuesto_anteproyecto/permiso_mod_jefe_depart/', 'Pres_revision_req_anteController@permiso_mod_jefe_depart');
    Route::get('/presupuesto_anteproyecto/autorizados_mod_jefe_depart/', 'Pres_revision_req_anteController@autorizados_mod_jefe_depart');
    Route::get('/presupuesto_anteproyecto/modificar_requisicones/{id_req_mat_ante}', 'Pres_reg_req_mat_antController@modificar_requisicones');

    Route::get('/presupuesto_anteproyecto/modificar_bienes_servicios_anteproyecto/{id_actividades_req_ante}', 'Pres_reg_req_mat_antController@modificar_bienes_servicios_anteproyecto');
    Route::post('/presupuesto_anteproyecto/enviar_modificaciones_requisiciones/', 'Pres_reg_req_mat_antController@enviar_modificaciones_requisiciones');
    Route::get('/presupuesto_anteproyecto/revicion_mod_req_departamento/{id_req_mat_ante}', 'Pres_revision_req_anteController@revicion_mod_req_departamento');
    Route::post('/presupuesto_anteproyecto/enviar_autorizacion_depart/', 'Pres_revision_req_anteController@enviar_autorizacion_depart');
    Route::get('/presupuesto_anteproyecto/ver_partida_presupuestal/{id_proyecto}', 'Pres_reg_req_mat_antController@ver_partida_presupuestal');
    Route::get('/presupuesto_anteproyecto/ver_autorizacion_bienes_servicios_departamento/{id_actividades_req_ante}/{id_req_mat_ante}', 'Pres_revision_req_anteController@ver_autorizacion_bienes_servicios_departamento');
    Route::get('/presupuesto_anteproyecto/autorizados_req_departamento/{id_req_mat_ante}', 'Pres_revision_req_anteController@autorizados_req_departamento');

    Route::resource('/presupuesto_anteproyecto/requisiciones_autorizadas_proyecto/', 'Pres_autorizadas_req_proController');
    Route::get('/presupuesto_anteproyecto/presupuesto_total_anteproyecto/{id_presupuesto}', 'Pres_autorizadas_req_proController@presupuesto_total_anteproyecto');
    Route::get('/presupuesto_anteproyecto/presupuesto_total_anteproyecto_inc/{id_presupuesto}', 'Pres_autorizadas_req_proController@presupuesto_total_anteproyecto_inc');

    Route::get('/presupuesto_anteproyecto/proyecto_inicio_anteproyecto/{id_presupuesto}', 'Pres_autorizadas_req_proController@proyecto_inicio_anteproyecto');
    Route::get('/presupuesto_anteproyecto/proyecto_capitulo_anteproyecto/{id_presupuesto}', 'Pres_autorizadas_req_proController@proyecto_capitulo_anteproyecto');
    Route::get('/presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_inc/{id_presupuesto}', 'Pres_autorizadas_req_proController@proyecto_capitulo_anteproyecto_inc');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto/{id_fuente_financiamiento}', 'Pres_autorizadas_req_proController@ver_proyecto_capitulo_anteproyecto');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto_inc/{id_fuente_financiamiento}', 'Pres_autorizadas_req_proController@ver_proyecto_capitulo_anteproyecto_inc');
    Route::get('/presupuesto_anteproyecto/proyecto_meses_anteproyecto/{id_presupuesto}', 'Pres_autorizadas_req_proController@proyecto_meses_anteproyecto');
    Route::get('/presupuesto_anteproyecto/proyecto_meses_anteproyecto_inc/{id_presupuesto}', 'Pres_autorizadas_req_proController@proyecto_meses_anteproyecto_inc');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_mes_anteproyecto/{id_mes}/{id_presupuesto}', 'Pres_autorizadas_req_proController@ver_proyecto_mes_anteproyecto');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_mes_anteproyecto_inc/{id_mes}/{id_presupuesto}', 'Pres_autorizadas_req_proController@ver_proyecto_mes_anteproyecto_inc');
    Route::get('/presupuesto_anteproyecto/proyecto_meta_anteproyecto/{id_presupuesto}', 'Pres_autorizadas_req_proController@proyecto_meta_anteproyecto');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_meta_anteproyecto/{id_meta}/{id_presupuesto}', 'Pres_autorizadas_req_proController@ver_proyecto_meta_anteproyecto');
    Route::get('/presupuesto_anteproyecto/proyecto_metas_anteproyecto_inc/{id_presupuesto}', 'Pres_autorizadas_req_proController@proyecto_metas_anteproyecto_inc');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_meta_ante_inc/{id_meta}/{id_presupuesto}', 'Pres_autorizadas_req_proController@ver_proyecto_meta_ante_inc');


    Route::get('/presupuesto_anteproyecto/ver_requisiciones_autorizadas/{id_req_mat_ante}', 'Pres_autorizadas_req_proController@ver_requisiciones_autorizadas');
    Route::get('/finanzas/requisiciones/imprimir_requisicion/{id_actividades_req_ante}', 'Pres_requisicionpdfControlller@index');
    // Route::get('/presupuesto_anteproyecto/presupuesto_total_ant_excel/{id_presupuesto}','Pre_excel_anteController@index');
    //  Route::get('/presupuesto_anteproyecto/presupuesto_capitulo_ant_excel/{id_fuente_financiamiento}','Pre_excel_anteController@presupuesto_capitulo_ant_excel');
    //  Route::get('/presupuesto_anteproyecto/presupuesto_mes_ant_excel/{id_presupuesto}/{id_mes}','Pre_excel_anteController@presupuesto_mes_ant_excel');
    //  Route::get('/presupuesto_anteproyecto/presupuesto_ant_excel_incompleto/{id_presupuesto}','Pre_excel_ante_incController@presupuesto_ant_excel_incompleto');
    // Route::get('/presupuesto_anteproyecto/pres_capitulo_ant_excel_inc/{id_fuente_financiamiento}','Pre_excel_ante_incController@pres_capitulo_ant_excel_inc');
    //  Route::get('/presupuesto_anteproyecto/pre_mes_ant_excel_inc/{id_presupuesto}/{id_mes}','Pre_excel_ante_incController@pre_mes_ant_excel_inc');
    //  Route::get('/presupuesto_anteproyecto/presupuesto_metas_ant_excel/{id_presupuesto}/{id_meta}','Pre_excel_anteController@presupuesto_metas_ant_excel');
    //Route::get('/presupuesto_anteproyecto/presupuesto_metas_ant_excel_inc/{id_presupuesto}/{id_meta}','Pre_excel_ante_incController@presupuesto_metas_ant_excel_inc');


    Route::get('/presupuesto_anteproyecto/agregar_requisiciones_admin/{id_presupuesto}', 'Pre_reg_req_adminController@index');
    Route::post('/presupuesto_anteproyecto/registrar_inicio_req_ant_admin/{id_presupuesto}', 'Pre_reg_req_adminController@registrar_inicio_req_ant_admin');
    Route::post('/presupuesto_anteproyecto/guardar_req_mat_admin/{id_req_mat_ante}', 'Pre_reg_req_adminController@guardar_req_mat_admin');
    Route::get('/presupuesto_anteproyecto/mod_requisicion_mat_admin/{id_actividades_req_ante}/{id_presupuesto}', 'Pre_reg_req_adminController@mod_requisicion_mat_admin');
    Route::post('/presupuesto_anteproyecto/guardar_mod_req_mat_admin/{id_actividades_req_ante}', 'Pre_reg_req_adminController@guardar_mod_req_mat_admin');
    Route::get('/presupuesto_anteproyecto/agregar_bienes_servicios_ant_admin/{id_actividades_req_ante}', 'Pre_reg_req_adminController@agregar_bienes_servicios_ant_admin');
    Route::post('/presupuesto_anteproyecto/guardar_autorizacion_req_admin/', 'Pre_reg_req_adminController@guardar_autorizacion_req_admin');

    Route::get('/presupuesto_anteproyecto/inicio_historial_anteproyecto/', 'Pres_historial_anteproyectosController@index');
    Route::get('/presupuesto_anteproyecto/inicio_historial_anteproyecto_year/{id_year}', 'Pres_historial_anteproyectosController@inicio_historial_anteproyecto_year');
    Route::get('/presupuesto_anteproyecto/historial_anteproyecto_techo/{id_year}', 'Pres_historial_anteproyectosController@historial_anteproyecto_techo');
    Route::get('/presupuesto_anteproyecto/historial_anteproyecto_proyectos/{id_year}', 'Pres_historial_anteproyectosController@historial_anteproyecto_proyectos');
    Route::get('/presupuesto_anteproyecto/proyecto_inicio_anteproyecto_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@proyecto_inicio_anteproyecto_historial');
    Route::get('/presupuesto_anteproyecto/presupuesto_total_anteproyecto_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@presupuesto_total_anteproyecto_historial');
    Route::get('/presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@proyecto_capitulo_anteproyecto_historial');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto_historial/{id_fuente_financiamiento}', 'Pres_historial_anteproyectosController@ver_proyecto_capitulo_anteproyecto_historial');
    Route::get('/presupuesto_anteproyecto/proyecto_meses_anteproyecto_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@proyecto_meses_anteproyecto_historial');
    Route::get('/presupuesto_anteproyecto/proyecto_meta_anteproyecto_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@proyecto_meta_anteproyecto_historial');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_meta_anteproyecto_historial/{id_meta}/{id_presupuesto}', 'Pres_historial_anteproyectosController@ver_proyecto_meta_anteproyecto_historial');
    Route::get('/presupuesto_anteproyecto/presupuesto_total_anteproyecto_inc_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@presupuesto_total_anteproyecto_inc_historial');
    Route::get('/presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_inc_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@proyecto_capitulo_anteproyecto_inc_historial');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto_inc_historial/{id_fuente_financiamiento}', 'Pres_historial_anteproyectosController@ver_proyecto_capitulo_anteproyecto_inc_historial');
    Route::get('/presupuesto_anteproyecto/proyecto_meses_anteproyecto_inc_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@proyecto_meses_anteproyecto_inc_historial');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_mes_anteproyecto_inc_historial/{id_mes}/{id_presupuesto}', 'Pres_historial_anteproyectosController@ver_proyecto_mes_anteproyecto_inc_historial');
    Route::get('/presupuesto_anteproyecto/proyecto_metas_anteproyecto_inc_historial/{id_presupuesto}', 'Pres_historial_anteproyectosController@proyecto_metas_anteproyecto_inc_historial');
    Route::get('/presupuesto_anteproyecto/ver_proyecto_meta_ante_inc_historial/{id_meta}/{id_presupuesto}', 'Pres_historial_anteproyectosController@ver_proyecto_meta_ante_inc_historial');

    Route::get('/presupuesto_anteproyecto/presupuesto_total_ant_excel/{id_presupuesto}', 'Pre_excel_ante_autController@index');
    Route::get('/presupuesto_anteproyecto/presupuesto_capitulo_ant_excel/{id_fuente_financiamiento}', 'Pre_excel_ante_autController@presupuesto_capitulo_ant_excel');
    Route::get('/presupuesto_anteproyecto/presupuesto_mes_ant_excel/{id_presupuesto}/{id_mes}', 'Pre_excel_ante_autController@presupuesto_mes_ant_excel');
    Route::get('/presupuesto_anteproyecto/presupuesto_metas_ant_excel/{id_presupuesto}/{id_meta}', 'Pre_excel_ante_autController@presupuesto_metas_ant_excel');
    Route::get('/presupuesto_anteproyecto/presupuesto_ant_excel_incompleto/{id_presupuesto}', 'Pre_excel_ante_autController@presupuesto_ant_excel_incompleto');
    Route::get('/presupuesto_anteproyecto/pres_capitulo_ant_excel_inc/{id_fuente_financiamiento}', 'Pre_excel_ante_autController@pres_capitulo_ant_excel_inc');
    Route::get('/presupuesto_anteproyecto/pre_mes_ant_excel_inc/{id_presupuesto}/{id_mes}', 'Pre_excel_ante_autController@pre_mes_ant_excel_inc');
    Route::get('/presupuesto_anteproyecto/presupuesto_metas_ant_excel_inc/{id_presupuesto}/{id_meta}', 'Pre_excel_ante_autController@presupuesto_metas_ant_excel_inc');


///////////////////////Seguimiento al Desempeño
    Route::get('/seguimiento_tutorias/formulario/{id_grupo_semestre}/{grupo}/{carrera}/', 'Tu_Eva_CordinadorInstitucionalController@periodos');

    Route::get('/seguimiento_tutorias/formulario/{per}/{id_grupo_semestre}/', 'Tu_Eva_CordinadorInstitucionalController@seguimiento');
    Route::post('/seguimiento_tutorias/formulario/guardar/', 'Tu_Eva_CordinadorInstitucionalController@seguimiento_guarda');
    Route::post('/seguimiento_tutorias/formulario/comentario/', 'Tu_Eva_CordinadorInstitucionalController@com');
    Route::get('/seguimiento_tutorias/{per}/{id_grupo_semestre}/', 'Tu_Eva_pdf_fo17Controller@imprime');

    //////////////////////Cuestionario para docentes de tutorias
    // Route::get('/tutorias/formulario/','Tu_Eva_TutorController@for_docente');
    /// Route::get('/tutorias/buscador/{id_grupo_semestre}/','Tu_eva_buscadorController@grupo');
    //////////////////////Cuestionario para docentes de tutorias
    Route::get('/tutorias/formulario/', 'Tu_eva_buscadorController@index_cor_car');
    Route::get('/tutorias/buscador/{id_grupo_semestre}/', 'Tu_eva_buscadorController@grupo');

    //////////////////////////Buscador por filtros
    Route::get('/tutorias/buscador/', 'Tu_Eva_TutorController@for_docente');
    Route::get('/tutorias/buscador/carrera/{id_carrera}', 'Tu_eva_buscadorController@grupo_a');
    Route::get('/tutorias/buscador/grupo/{id_grupo_semestre}', 'Tu_eva_buscadorController@busca_grupo');
    Route::get('/tutorias/buscador/tutor/', 'Tu_eva_buscadorController@grupos_tutor');
    Route::post('/tutorias/borrarestrategia/{id_asigna_planeacion_tutor1}', 'Tu_eva_buscadorController@borrar');


    ///// FO 40
    Route::get('/tutorias/FO-40/', 'Tu_Eva_CordinadorInstitucionalController@fo40');
    Route::get('/tutorias/FO_40/', 'Tu_Eva_CordinadorInstitucionalController@fo_40');

    Route::post('/tutorias/FO-40/guarda/', 'Tu_Eva_CordinadorInstitucionalController@fo_40_guarda');
    Route::get('/tutorias/FO-40/pdf/{periodo}/', 'Tu_Eva_pdf_fo40Controller@imprime');
    Route::get('/tutorias/FO-40/pdf/1/{periodo}/', 'Tu_Eva_pdf_fo40Controller@p1');

    //////////////////////////////////////Analisis de tutorias //////////////
    Route::get('/tutorias/analisis/', 'Tu_Eva_analisisController@areas');
    Route::get('/tutorias/analisis/categorias', 'Tu_Eva_analisisController@index');
    Route::get('/tutorias/analisis/estadistico', 'Tu_Eva_analisisController@analisis');


    /////............................SISTEMA DE REQUISICIONES DE MATERIALES ANTEPROYECTO DPTO. FINANZAS (pRESUPUESTO AUTORIZADO)............-----
    Route::get('/presupuesto_autorizado/agregar_presupesto_partida/', 'Pres_aut_agregar_presuController@index');
    Route::post('/presupuesto_autorizado/guardar_presupesto_partida/', 'Pres_aut_agregar_presuController@guardar_presupesto_partida');
    Route::get('/presupuesto_autorizado/modificar_presupesto_partida/{id_presupuesto_aut}', 'Pres_aut_agregar_presuController@modificar_presupesto_partida');
    Route::post('/presupuesto_autorizado/guardar_mod_presupesto_partida/{id_presupuesto_aut}', 'Pres_aut_agregar_presuController@guardar_mod_presupesto_partida');
    Route::get('/presupuesto_autorizado/eliminar_presupesto_partida/{id_presupuesto_aut}', 'Pres_aut_agregar_presuController@eliminar_presupesto_partida');
    Route::post('/presupuesto_autorizado/guardar_eliminar_presupesto_partida/{id_presupuesto_aut}', 'Pres_aut_agregar_presuController@guardar_eliminar_presupesto_partida');
    Route::post('/presupuesto_autorizado/guardar_terminar_presupuesto/{year}', 'Pres_aut_agregar_presuController@guardar_terminar_presupuesto');
    Route::get('/presupuesto_autorizado/departamentos_presupesto_partida/', 'Pres_aut_agregar_presuController@departamentos_presupesto_partida');
    Route::get('/presupuesto_autorizado/departamentos_agregar_presupuesto/{id_unidad_admin}', 'Pres_aut_agregar_presuController@departamentos_agregar_presupuesto');
    Route::get('/presupuesto_autorizado/departamento_ver_pres_autorizar/{id_actividades_req_ante}', 'Pres_aut_agregar_presuController@departamento_ver_pres_autorizar');
    Route::post('/presupuesto_autorizado/guardar_aut_requisicion/{id_actividades_req_ante}', 'Pres_aut_agregar_presuController@guardar_aut_requisicion');
    Route::get('/presupuesto_autorizado/presupesto_partida_copia/', 'Pres_aut_agregar_presuController@presupesto_partida_copia');
    Route::post('/presupuesto_autorizado/guardar_nueva_solicitud/{year}/{id_unidad_admin}', 'Pres_aut_agregar_presuController@guardar_nueva_solicitud');
    Route::get('/presupuesto_autorizado/agregar_partida_solicitud/{id_solicitud}', 'Pres_aut_agregar_presuController@agregar_partida_solicitud');
    Route::get('/presupuesto_autorizado/ver_presupuesto_partida/{id_presupuesto}/{id_mes}', 'Pres_aut_agregar_presuController@ver_presupuesto_partida');
    Route::post('/presupuesto_autorizado/guardar_partida_solicitud/', 'Pres_aut_agregar_presuController@guardar_partida_solicitud');
    Route::get('/presupuesto_autorizado/enviar_solicitud_departamento/{id_solicitud}', 'Pres_aut_agregar_presuController@enviar_solicitud_departamento');
    Route::post('/presupuesto_autorizado/guardar_enviar_solicitud/{id_solicitud}', 'Pres_aut_agregar_presuController@guardar_enviar_solicitud');
    Route::get('/presupuesto_autorizado/editar_presupuesto_partida_dep/{id_solicitud_partida}', 'Pres_aut_agregar_presuController@editar_presupuesto_partida_dep');
    Route::post('/presupuesto_autorizado/guardar_presupuesto_dado/{id_solicitud_partida}', 'Pres_aut_agregar_presuController@guardar_presupuesto_dado');
    Route::get('/presupuesto_autorizado/eliminacion_partida_solicitud/{id_solicitud_partida}', 'Pres_aut_agregar_presuController@eliminacion_partida_solicitud');
    Route::post('/presupuesto_autorizado/guardar_eliminacion_partida/{id_solicitud_partida}', 'Pres_aut_agregar_presuController@guardar_eliminacion_partida');
    Route::get('/presupuesto_autorizado/eliminacion_solicitud/{id_solicitud}', 'Pres_aut_agregar_presuController@eliminacion_solicitud');
    Route::post('/presupuesto_autorizado/guardar_eliminacion_solicitud/{id_solicitud}', 'Pres_aut_agregar_presuController@guardar_eliminacion_solicitud');

    Route::resource('/presupuesto_autorizado/agregar_req_solicitud_autorizadas/', 'Pres_aut_req_solicitudes_autController');
    Route::get('/presupuesto_autorizado/registrar_documentacion_solicitud/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@registrar_documentacion_solicitud');
    Route::get('/presupuesto_autorizado/registrar_requisicion/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@registrar_requisicion');
    Route::post('/presupuesto_autorizado/guardar_requisicion/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@guardar_requisicion');
    Route::get('/presupuesto_autorizado/registrar_agregar_anexo1/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@registrar_agregar_anexo1');
    Route::post('/presupuesto_autorizado/guardar_anexo1/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@guardar_anexo1');
    Route::get('/presupuesto_autorizado/registrar_oficio_suficiencia/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@registrar_oficio_suficiencia');
    Route::post('/presupuesto_autorizado/guardar_suficiencia/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@guardar_suficiencia');
    Route::get('/presupuesto_autorizado/registrar_justificacion/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@registrar_justificacion');
    Route::post('/presupuesto_autorizado/guardar_justificacion/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@guardar_justificacion');
    Route::get('/presupuesto_autorizado/registrar_cotizacion/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@registrar_cotizacion');
    Route::post('/presupuesto_autorizado/guardar_cotizacion/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@guardar_cotizacion');
    Route::get('/presupuesto_autorizado/modificar_requisicion/{id_solicitud_documento}', 'Pres_aut_req_solicitudes_autController@modificar_requisicion');
    Route::get('/presupuesto_autorizado/modificar_anexo1/{id_solicitud_documento}', 'Pres_aut_req_solicitudes_autController@modificar_anexo1');
    Route::get('/presupuesto_autorizado/modificar_oficio_suficiencia/{id_solicitud_documento}', 'Pres_aut_req_solicitudes_autController@modificar_oficio_suficiencia');
    Route::get('/presupuesto_autorizado/modificar_justificacion/{id_solicitud_documento}', 'Pres_aut_req_solicitudes_autController@modificar_justificacion');
    Route::get('/presupuesto_autorizado/modificar_cotizacion_pdf/{id_solicitud_documento}', 'Pres_aut_req_solicitudes_autController@modificar_cotizacion_pdf');
    Route::get('/presupuesto_autorizado/agregar_material_partida_solicitud/{id_solicitud_documento}', 'Pres_aut_req_solicitudes_autController@agregar_material_partida_solicitud');
    Route::post('/presupuesto_autorizado/guardar_material_partida_solicitud/{id_solicitud_documento}', 'Pres_aut_req_solicitudes_autController@guardar_material_partida_solicitud');
    Route::post('/presupuesto_autorizado/enviar_solicitud/{id_solicitud}', 'Pres_aut_req_solicitudes_autController@enviar_solicitud');
    Route::get('/presupuesto_autorizado/revisar_solicitudes/', 'Pres_aut_revisionController@revisar_solicitudes');
    Route::get('/presupuesto_autorizado/revisar_documentacion_solicitud/{id_solicitud}', 'Pres_aut_revisionController@revisar_documentacion_solicitud');
    Route::post('/presupuesto_autorizado/enviar_modificaciones_departamento/{id_solicitud}', 'Pres_aut_revisionController@enviar_modificaciones_departamento');

    Route::get('/presupuesto_autorizado/proceso_mod_solicitudes/', 'Pres_aut_revisionController@proceso_mod_solicitudes');
    Route::get('/presupuesto_autorizado/solicitudes_autorizadas_departamentos/', 'Pres_aut_revisionController@solicitudes_autorizadas_departamentos');
    Route::get('/presupuesto_autorizado/solicitudes_ver_departamento/{id_unidad_admin}', 'Pres_aut_revisionController@solicitudes_ver_departamento');
    Route::get('/presupuesto_autorizado/modificar_servicio_solicitud/{id_material_partida}', 'Pres_aut_revisionController@modificar_servicio_solicitud');
    Route::post('/presupuesto_autorizado/guardar_mod_material_solicitud/{id_material_partida}', 'Pres_aut_revisionController@guardar_mod_material_solicitud');
    Route::post('/presupuesto_autorizado/eliminar_material_solicitud/', 'Pres_aut_revisionController@eliminar_material_solicitud');
    Route::post('/presupuesto_autorizado/enviar_autorizacion_departamento/{id_solicitud}', 'Pres_aut_revisionController@enviar_autorizacion_departamento');
    Route::get('/presupuesto_autorizado/mostrar_documentacion_solicitud/{id_solicitud}', 'Pres_aut_revisionController@mostrar_documentacion_solicitud');
    Route::get('/presupuesto_autorizado/agregar_contrato_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@agregar_contrato_solicitud');
    Route::post('/presupuesto_autorizado/guardar_contrato/{id_solicitud_documento}', 'Pres_aut_revisionController@guardar_contrato');
    Route::get('/presupuesto_autorizado/modificar_contrato_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@modificar_contrato_solicitud');
    Route::get('/presupuesto_autorizado/agregar_factura_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@agregar_factura_solicitud');
    Route::post('/presupuesto_autorizado/guardar_factura/{id_solicitud_documento}', 'Pres_aut_revisionController@guardar_factura');
    Route::get('/presupuesto_autorizado/modificar_factura_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@modificar_factura_solicitud');
    Route::get('/presupuesto_autorizado/agregar_pago_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@agregar_pago_solicitud');
    Route::post('/presupuesto_autorizado/guardar_pago/{id_solicitud_documento}', 'Pres_aut_revisionController@guardar_pago');
    Route::get('/presupuesto_autorizado/modificar_pago_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@modificar_pago_solicitud');
    Route::get('/presupuesto_autorizado/agregar_oficio_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@agregar_oficio_solicitud');
    Route::post('/presupuesto_autorizado/guardar_oficio/{id_solicitud_documento}', 'Pres_aut_revisionController@guardar_oficio');
    Route::get('/presupuesto_autorizado/modificar_oficio_solicitud/{id_solicitud_documento}', 'Pres_aut_revisionController@modificar_oficio_solicitud');
    Route::get('/presupuesto_autorizado/solicitudes_aut_departamento/', 'Pres_aut_revisionController@solicitudes_aut_departamento');
    Route::get('/presupuesto_autorizado/ver_docu_solicitud_aut_departamento/{id_solicitud}', 'Pres_aut_revisionController@ver_docu_solicitud_aut_departamento');
    Route::get('/presupuesto_autorizado/agregar_solicitud_pago/{id_solicitud_documento}', 'Pres_aut_revisionController@agregar_solicitud_pago');
    Route::post('/presupuesto_autorizado/guardar_solicitud_pago/{id_solicitud_documento}', 'Pres_aut_revisionController@guardar_solicitud_pago');
    Route::get('/presupuesto_autorizado/modificar_solicitud_pago/{id_solicitud_documento}', 'Pres_aut_revisionController@modificar_solicitud_pago');
    Route::get('/presupuesto_autorizado/modificar_mes_requisicion/{id_presupuesto_aut_copia}/{id_mes}', 'Pres_aut_revisionController@modificar_mes_requisicion');
    Route::post('/presupuesto_autorizado/guardar_mod_partida_mes_presupuesto/{id_presupuesto_aut_copia}/{id_mes}', 'Pres_aut_revisionController@guardar_mod_partida_mes_presupuesto');

    Route::get('/presupuesto_autorizado/inicio_presupuesto_autorizado_historial/', 'Pres_historial_proyecto_autorizadoController@index');
    Route::get('/presupuesto_autorizado/menu_presupuesto_autorizado_historial/{id_year}', 'Pres_historial_proyecto_autorizadoController@menu_presupuesto_autorizado_historial');
    Route::get('/presupuesto_autorizado/presupesto_partida_historial/{id_year}', 'Pres_historial_proyecto_autorizadoController@presupesto_partida_historial');
    Route::get('/presupuesto_autorizado/presupesto_partida_copia_historial/{id_year}', 'Pres_historial_proyecto_autorizadoController@presupesto_partida_copia_historial');
    Route::get('/presupuesto_autorizado/solicitudes_autorizadas_departamentos_historial/{id_year}', 'Pres_historial_proyecto_autorizadoController@solicitudes_autorizadas_departamentos_historial');
    Route::get('/presupuesto_autorizado/solicitudes_ver_departamento_historial/{id_unidad_admin}/{id_year}', 'Pres_historial_proyecto_autorizadoController@solicitudes_ver_departamento_historial');
    Route::get('/presupuesto_autorizado/mostrar_doc_solicitud_historial/{id_solicitud}/{id_unidad_admin}', 'Pres_historial_proyecto_autorizadoController@mostrar_doc_solicitud_historial');


    ///////************************************Incidencias de personal*************************************************************//////
    /// ***************************************************************************************************************************/////
    Route::get('/incidencias/solicitar_oficio', 'IncidenciasController@vista');
    Route::post('/incidencias/guardar_incidencia_solicitada', 'IncidenciasController@guardar_incidencia_solicitada');
    Route::get('/incidencias/editar_evidencia/{id_evid}', 'IncidenciasController@editar_evidencia');
    route::get('/incidencias/editar_evidencia2/{id_evid}', 'IncidenciasController@editar_evidencia2');
    Route::get('/incidencias/historial_oficios', 'IncidenciasController@vista3');
    Route::get('/incidencias/historial_evidencias', 'IncidenciasController@vistaevidencias');
    Route::get('/incidencias/reportes_incidencias', 'IncidenciasController@vista4');
    Route::get('/incidencias/reportes_incidencias_ver/{id_articulo}/{fecha_inicial}/{fecha_final}/{estado}', 'IncidenciasController@reportes_incidencias_ver');
    Route::get('/incidencias/excel_reportes_inc/{id_articulo}/{fecha_inicial}/{fecha_final}/{estado}', 'IncidenciasController@reporte_excel_inc');
    Route::get('/incidencias/validar_oficios', 'IncidenciasController@vista5');
    Route::get('/incidencias/validar_oficios/historial', 'IncidenciasController@validacion_historial');
    Route::get('/incidencias/validar_oficios_departamentos/historial', 'IncidenciasController@validacion_departamentos_historial');
    Route::get('/incidencias/historial_oficios_autorizados', 'IncidenciasController@historial_oficios_autorizados');
    Route::get('/incidencias/modificar_evidencia/{id_evid}', 'IncidenciasController@modificar_evidencia');
    Route::get('/incidencias/modificar_evidencia2/{id_evid}', 'IncidenciasController@modificar_evidencia2');
    Route::post('/incidencias/guardar_mod_evidencia/{id_evid}', 'IncidenciasController@guardar_mod_evidencia');
    Route::post('/incidencias/guardar_mod_evidencia2/{id_evid}/{id_tipo_evid}', 'IncidenciasController@guardar_mod_evidencia2');
    Route::get('/incidencias/historial_docentesSo', 'IncidenciasController@vista6');
    Route::get('/incidencias/historial_docentesEv', 'IncidenciasController@vista7');
    Route::get('/incidencias/articulos_evidencia', 'IncidenciasController@vista8');
    Route::get('pdfregistroincidencia/{id_solicitud}', ['as' => 'pdfregistroincidencia', 'uses' => 'PdfSolicitudIncidenciaContratoController@index1',]);
    Route::get('pdfregistroincidencia1/{id_solicitud}', ['as' => 'pdfregistroincidencia1', 'uses' => 'PdfSolicitudIncidenciaContratoController@index2',]);
    Route::get('pdfregistroincidencia_acade_finan/{id_solicitud}', ['as' => 'pdfregistroincidencia_acade_finan', 'uses' => 'PdfSolicitudIncidenciaContratoController@index3',]);
    Route::get('pdfregistroincidencia4/{id_solicitud}', ['as' => 'pdfregistroincidencia4', 'uses' => 'PdfSolicitudIncidenciaContratoController@index4',]);
    Route::get('pdfreportes/', ['as' => 'pdfreportes', 'uses' => 'reporte_quincenalController@index',]);
    Route::get('/incidencias/historial_docentesSo/oficio/aceptado/{id_solicitud}', 'IncidenciasController@aceptadojefe');
    Route::get('/incidencias/validacion_acad_finanzas/aceptado/{id_solicitud}', 'IncidenciasController@aceptado_acad_finanzas');
    Route::get('/incidencias/historial_director/aceptado/{id_solicitud}', 'IncidenciasController@aceptadodirector');
    Route::get('/incidencias/historial_docentesSo/oficio/rechazado/{id_solicitud}', 'IncidenciasController@rechazadojefe');
    Route::get('/incidencias/validacion_acad_finanzas/rechazado/{id_solicitud}', 'IncidenciasController@rechazado_acad_finanzas');
    Route::get('/incidencias/historial_docentesSo/oficio/enviar/{id_solicitud}', 'IncidenciasController@enviadojefe');
    Route::get('/oficios/ver/{id_oficio}', 'IncidenciasController@ver');
    Route::get('/incidencias/cargar_oficio/{id_oficio}', 'IncidenciasController@vista2oficio');
    Route::get('/incidencias/cargar_evidencia/{id_evid}', 'IncidenciasController@vista2');

    Route::get('/incidencias/cargar_otra_evid_estado/{id_periodo}', 'IncidenciasController@vista2_1');
    Route::get('/incidencias/cargar_otra_evidencia', 'IncidenciasController@fecha_periodo_incidencia');
    Route::get('/incidencias/cargar_evidencia_tipo_fecha/{id_tipo_evid}/{tipo_fecha}', 'IncidenciasController@cargar_evidencia_tipo_fecha');
    Route::post('/incidencias/guardar_evidencia_fecha_solicita/{id_tipo_evid}/{tipo_fecha}', 'IncidenciasController@guardar_evidencia_fecha_solicita');
    Route::post('/incidencias/guardar_evid_fecha_solicita2/{id_tipo_evid}/{tipo_fecha}', 'IncidenciasController@guardar_evid_fecha_solicita2');
    Route::get('/incidencias/enviar_evidencia_fecha/{id__evid}', 'IncidenciasController@enviar_evidencia_fecha');
    Route::post('/incidencias/eliminar_evidencia/{id__evid}', 'IncidenciasController@eliminar_evidencia');
    route::get('/incidencias/editar_evidencia2/{id_evid}', 'IncidenciasController@editar_evidencia2');

    Route::post('/incidencias/guardar_oficio/{id_oficio}', 'IncidenciasController@guardar_oficio');
    Route::post('/incidencias/guardar_evidencia/{id_evid}', 'IncidenciasController@guardar_evidencia');
    Route::post('/incidencias/guardar_otra_evidencia', 'IncidenciasController@guardar_otra_evidencia');
    Route::get('/incidencias/solicitud/validar/{id_articulo}', 'IncidenciasController@validar_articulos');
    Route::get('/notificaciones/oficios_incidencias', 'IncidenciasController@notificaciones');
    Route::get('/notificaciones/oficios_aceptados', 'IncidenciasController@notificacionesacep');
    Route::get('/incidencias/ver_datos_oficio_evidencia/{id_evid}', 'IncidenciasController@ver_datos_oficio_evidencia');
    Route::post('/incidencias/cargando_evidencia_oficio', 'IncidenciasController@cargando_evidencia_oficio');
    Route::get('/incidencias/editar_evidencia_oficio/{id_evid}', 'IncidenciasController@editar_evidencia_oficio');
    Route::get('/incidencias/imprimir_aviso_justificacion/{id_solicitud}', 'Inc_pdfAvisoController@index');

    Route::get('/incidencias/ver_solicitud_incidencia/{id_solicitud}', 'IncidenciasController@ver_solicitud_incidencia');
    Route::get('/incidencias/historial_evidencias_conocimient/{id_personal}', 'IncidenciasController@historial_evidencias_conocimiento');
    Route::get('/incidencias/validar_oficios_departamentos', 'IncidenciasController@validar_oficios_departamentos');
    Route::get('/incidencias/validar_evidencia_departamentos', 'IncidenciasController@validar_evidencia_departamentos');
    Route::get('/incidencias/validar_oficios_dep_acad_finanzas', 'IncidenciasController@validar_oficios_dep_acad_finanzas');
    Route::get('/incidencias/validar_oficios_direct_historial', 'IncidenciasController@validar_oficios_direct_historial');
    Route::get('/incidencias/agregar_oficio_firmado/{id_solicitud}', 'IncidenciasController@agregar_oficio_firmado');
    Route::get('/incidencias/editar_oficio_firmado/{id_solicitud}', 'IncidenciasController@editar_oficio_firmado');

    Route::get('/incidencias/historial_evid_personal', 'IncidenciasController@historial_evid_personal');

    Route::get('/incidencias/validar_evid_autorizar/{id_evid}', 'IncidenciasController@validar_evid_autorizar');
    Route::get('/incidencias/validar_evid_rechazar/{id_evid}', 'IncidenciasController@validar_evid_rechazar');
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///---------------------SISTEMA DE INVENTARIO PARA EL DEPARTAMENTO DE RECURSOS MATERIALES----------------------
    //***********************************************************************************************************//
    //Categorias
    Route::get('/Categorias', 'RmCategoriaController@create');
    Route::post('/Categorias', 'RmCategoriaController@store')->name('guardarcat');
    Route::put('/Editar-Categoria/{id}', 'RmCategoriaController@update')->name('editarcat');
    Route::put('/Activar-Categoría/{id}', 'RmCategoriaController@activar')->name('activarcat');
    Route::put('/Desactivar-Categoria{id}', 'RmCategoriaController@desactivar')->name('desactivarcat');
    Route::get('/Areas', 'GnralJefeUnidadAdministrativaController@mostrar');//muestra los datos
    ////////General Marcas,Modelos,Provedores
    //Marcas
    Route::get('/Marcas', 'RmMarcasController@create');
    Route::post('/Marcas', 'RmMarcasController@store')->name('guardarmarca');
    Route::put('/Editar-Marca/{id}', 'RmMarcasController@update')->name('editarmarca');
    Route::put('/Activar-Marca/{id}', 'RmMarcasController@activar')->name('activarmar');
    Route::put('/Desactivar-Marca/{id}', 'RmMarcasController@desactivar')->name('desactivarmar');
    Route::get('/Buscar-Marca', 'RmMarcasController@index')->name('buscarmar');
    //Route::delete('/Eliminar-Marca/{id}','RmMarcasController@destroy')->name('eliminarm');
    //Modelos
    Route::get('/Modelos', 'RmModelosController@create');
    Route::post('/Modelos', 'RmModelosController@store')->name('guardarmodelo');
    Route::put('/Editar-Modelo/{id}', 'RmModelosController@update')->name('editarmod');
    Route::put('/Activar-Modelo/{id}', 'RmModelosController@activar')->name('activarmod');
    Route::put('/Desactivar-Modelo/{id}', 'RmModelosController@desactivar')->name('desactivarmod');
    Route::get('/Buscar-Modelo', 'RmModelosController@index')->name('buscarmod');
    //Provedores
    Route::get('/Provedores', 'RmProvedoresController@create');
    Route::post('/Provedores', 'RmProvedoresController@store')->name('guardarprov');
    Route::put('/Editar-Provedor/{id}', 'RmProvedoresController@update')->name('editarprov');
    Route::put('/Activar-Provedor/{id}', 'RmProvedoresController@activar')->name('activarprov');
    Route::get('/Buscar-Provedor', 'RmProvedoresController@index')->name('buscarprov');
    Route::put('/Desactivar-Provedor{id}', 'RmProvedoresController@desactivar')->name('desactivarprov');
    //Resguardos
    Route::get('/Resguardos', 'RmResguardosController@index');
    Route::get('/Resguardos', 'RmResguardosController@create');
    Route::post('/Resguardos', 'RmResguardosController@store')->name('agregares');
    Route::put('/Editar-Resguardo/{id}', 'RmResguardosController@update')->name('editarres');
    Route::get('/Resguardos-Consulta', 'RmResguardosController@consult');
    Route::get('/Buscar-Resguardo', 'RmResguardosController@index')->name('buscarres');
    Route::get('/Pdf-Resguardot/{id}', 'RmResguardosController@PDFtarjetas')->name('pdfrest');
    Route::get('/Resguardos-Padron', 'RmResguardosController@consultp');
    Route::get('/Pdf-Padron', 'RmResguardosController@PDFpadron')->name('pdfp');
    //Sector Aux
    Route::get('/SectorAux', 'RmSectorauxsController@create');
    Route::post('/SectorAux', 'RmSectorauxsController@store')->name('asignarsec');
    Route::get('/SectorAux', 'RmSectorauxsController@index')->name('buscar');
    Route::put('/Editar-Sectores/{id}', 'RmSectorauxsController@update')->name('editarsec');
    Route::put('/Desactivar-Sector{id}', 'RmSectorauxsController@desactivar')->name('desactivarsec');

    //Bienes
    Route::get('/Bienes', 'RmBienesController@create');
    Route::post('/Bienes', 'RmBienesController@store')->name('altabien');
    Route::put('/Editar-Bienes/{id}', 'RmBienesController@update')->name('editarbien');
    Route::put('/Activar-Bien/{id}', 'RmBienesController@activar')->name('activarbien');
    Route::put('/Desactivar-Bien{id}', 'RmBienesController@desactivar')->name('desactivarbien');
    Route::get('/Buscar-Bien', 'RmBienesController@index')->name('buscarbien');
    Route::get('/Reportes', 'RmBienesController@vistaexcel');
    Route::get('exportar/{type}', 'RmBienesController@downloadExcel');
//****************************************************************************************************
    //************************************************************************************************
    //**********************************ENCUESTA DE SATISFACCIÓN AL CLIENTE***********************-****
    Route::resource('/encuestas_satisfaccion/registro_encuesta_incripcion/', 'Enc_incripcionController');
    Route::get('/encuestas_satisfaccion/encuesta_incripcion/', 'Enc_incripcionController@encuesta_incripcion');
    Route::post('/encuestas_satisfaccion/enviar_encuesta_incripcion/', 'Enc_incripcionController@enviar_encuesta_incripcion');
    Route::get('/encuestas_satisfaccion/encuesta_incripcion_periodo/', 'Enc_incripcionController@encuesta_incripcion_periodo');
    Route::post('/encuestas_satisfaccion/envio_periodo_terminado/', 'Enc_incripcionController@envio_periodo_terminado');
    Route::get('/encuestas_satisfaccion/ver_resultados_enc_incripcion', 'Enc_incripcionController@ver_resultados_enc_incripcion');

    Route::get('/encuestas_satisfaccion/carrera_enc_incripcion', 'Enc_incripcionController@carrera_enc_incripcion');
    Route::get('/encuestas_satisfaccion/alumnos_enc_incripcion/{id_carrera}', 'Enc_incripcionController@alumnos_enc_incripcion');
    Route::get('/encuestas_satisfaccion/enc_est_inscripcion/{id_incripcion}', 'Enc_incripcionController@enc_est_inscripcion');

    Route::get('/encuestas_satisfaccion/carrera_enc_reincripcion', 'Enc_incripcionController@carrera_enc_reincripcion');
    Route::get('/encuestas_satisfaccion/alumnos_enc_reincripcion/{id_carrera}', 'Enc_incripcionController@alumnos_enc_reincripcion');
    Route::get('/encuestas_satisfaccion/enc_est_reinscripcion/{id_reinscripcion}', 'Enc_incripcionController@enc_est_reinscripcion');

    Route::get('/encuestas_satisfaccion/encuesta_reincripcion_periodo/', 'Enc_incripcionController@encuesta_reincripcion_periodo');
    Route::post('/encuestas_satisfaccion/envio_periodo_terminado_reins/', 'Enc_incripcionController@envio_periodo_ter_reins');
    Route::get('/encuestas_satisfaccion/ver_resultados_enc_reincripcion', 'Enc_incripcionController@ver_resultados_enc_reincripcion');
    Route::get('/encuestas_satisfaccion/encuesta_reincripcion/', 'Enc_incripcionController@encuesta_reincripcion');
    Route::post('/encuestas_satisfaccion/enviar_encuesta_reinscripcion/', 'Enc_incripcionController@enviar_encuesta_reinscripcion');
    Route::get('/encuestas_satisfaccion/enviar_encuesta_estudiante_titulacion/', 'Enc_incripcionController@enviar_encuesta_estudiante_titulacion');
    Route::post('/encuestas_satisfaccion/registrar_periodo_year_titulacion/', 'Enc_incripcionController@registrar_periodo_year_titulacion');
    Route::get('/encuestas_satisfaccion/enviar_enc_carreras_ti/{mes}/{year}', 'Enc_incripcionController@enviar_enc_carreras_ti');
    Route::get('/encuestas_satisfaccion/termino_encuesta_titulacion/{id_periodo_titulacion}', 'Enc_incripcionController@termino_encuesta_titulacion');
    Route::post('/encuestas_satisfaccion/guardar_termino_encuesta_titulacion', 'Enc_incripcionController@guardar_termino_encuesta_titulacion');
    Route::get('/encuestas_satisfaccion/enc_contestadas_carreras_ti/{mes}/{year}', 'Enc_incripcionController@enc_contestadas_carreras_ti');
    Route::get('/encuestas_satisfaccion/enc_est_ti_carrera_termino/{id_carrera}/{mes}/{year}', 'Enc_incripcionController@enc_est_ti_carrera_termino');
    Route::get('/encuestas_satisfaccion/enc_est_ti_alumno_termino/{id_titulacion}', 'Enc_incripcionController@enc_est_ti_alumno_termino');
    Route::get('/encuestas_satisfaccion/ver_resultados_enc_ti/{mes}/{year}', 'Enc_incripcionController@ver_resultados_enc_ti');
    Route::get('/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion/', 'Enc_incripcionController@historial_encuesta_estudiante_titulacion');
    Route::get('/encuestas_satisfaccion/menu_historial_titulacion_year/{year}', 'Enc_incripcionController@menu_historial_titulacion_year');

    Route::get('/encuestas_satisfaccion/encuesta_estudiante_titulacion_carrera/{id_carrera}/{year}/{mes}', 'Enc_incripcionController@encuesta_estudiante_titulacion_carrera');
    Route::get('/encuestas_satisfaccion/enviar_encuesta_titulacion/{id_alumno}', 'Enc_incripcionController@enviar_encuesta_titulacion');
    Route::post('/encuestas_satisfaccion/envio_encuesta_estudiante_titulacion/', 'Enc_incripcionController@envio_encuesta_estudiante_titulacion');
    Route::get('/encuestas_satisfaccion/contestar_encuesta_alumno/', 'Enc_incripcionController@contestar_encuesta_alumno');
    Route::post('/encuestas_satisfaccion/guardar_encuesta_titulacion/{id_alumno}', 'Enc_incripcionController@guardar_encuesta_titulacion');

    Route::get('/encuestas_satisfaccion/agregar_periodo_year/', 'Enc_servicioController@agregar_periodo_year');
    Route::post('/encuestas_satisfaccion/registrar_periodo_year/', 'Enc_servicioController@registrar_periodo_year');
    Route::get('/encuestas_satisfaccion/ver_carreras_encuesta_servicio/{mes}/{year}', 'Enc_servicioController@index');
    Route::get('/encuestas_satisfaccion/termino_encuesta_servicio/{id_periodo_serv}', 'Enc_servicioController@termino_encuesta_servicio');
    Route::post('/encuestas_satisfaccion/guardar_termino_encuesta_servicio', 'Enc_servicioController@guardar_termino_encuesta_servicio');
    Route::get('/encuestas_satisfaccion/ver_enc_serv_alum_terminado/{id_carrera}/{mes}/{year}', 'Enc_servicioController@ver_enc_serv_alum_terminado');
    Route::get('/encuestas_satisfaccion/ver_enc_terminada/{id_servicio}', 'Enc_servicioController@ver_enc_terminada');
    Route::get('/encuestas_satisfaccion/ver_enc_resultados/{mes}/{year}', 'Enc_servicioController@ver_enc_resultados');

    Route::get('/encuestas_satisfaccion/historial_periodo_year/', 'Enc_servicioController@historial_periodo_year');
    Route::get('/encuestas_satisfaccion/menu_historial_servicio_s_year/{year}', 'Enc_servicioController@menu_historial_servicio_s_year');
    Route::get('/encuestas_satisfaccion/historial_periodo_year_residencia/', 'Enc_servicioController@historial_periodo_year_residencia');


    Route::get('/encuestas_satisfaccion/agregar_periodo_year_residencia/', 'Enc_servicioController@agregar_periodo_year_residencia');
    Route::post('/encuestas_satisfaccion/guardar_periodo_year_residencia/', 'Enc_servicioController@guardar_periodo_year_residencia');
    Route::get('/encuestas_satisfaccion/guardar_periodo_year_residencia/', 'Enc_servicioController@guardar_periodo_year_residencia');
    Route::get('/encuestas_satisfaccion/termino_encuesta_residencia/{id_periodo_residencia}', 'Enc_servicioController@termino_encuesta_residencia');
    Route::post('/encuestas_satisfaccion/guardar_termino_encuesta_residencia', 'Enc_servicioController@guardar_termino_encuesta_residencia');
    Route::get('/encuestas_satisfaccion/termino_encuesta_residencia/{id_periodo_residencia}', 'Enc_servicioController@termino_encuesta_residencia');
    Route::get('/encuestas_satisfaccion/ver_enc_contestadas_residencia/{id_periodo_residencia}', 'Enc_servicioController@ver_enc_contestadas_residencia');
    Route::get('/encuestas_satisfaccion/ver_enc_carreras_res_residencia/{id_periodo_residencia}', 'Enc_servicioController@ver_enc_carreras_res_residencia');
    Route::get('/encuestas_satisfaccion/ver_enc_contestadas_resi_alum/{id_carrera}/{id_periodo_residencia}', 'Enc_servicioController@ver_enc_contestadas_resi_alum');
    Route::get('/encuestas_satisfaccion/ver_enc_alumno_contestada/{id_residencia_profesional}', 'Enc_servicioController@ver_enc_alumno_contestada');


    Route::get('/encuestas_satisfaccion/ver_encuesta_servicio_alumno/{id_carrera}/{mes}/{year}', 'Enc_servicioController@ver_encuesta_servicio_alumno');
    Route::get('/encuestas_satisfaccion/enc_servicio_datos_alumn/{id_alumno}', 'Enc_servicioController@enc_servicio_datos_alumn');
    Route::post('/encuestas_satisfaccion/envio_encuesta_estudiante_servicio/{mes}/{year}', 'Enc_servicioController@envio_encuesta_estudiante_servicio');
    Route::get('/encuestas_satisfaccion/ver_carreras_encuesta_residencia/{id_periodo}', 'Enc_servicioController@ver_carreras_encuesta_residencia');
    Route::get('/encuestas_satisfaccion/ver_encuesta_residencia_alumno/{id_carrera}', 'Enc_servicioController@ver_encuesta_residencia_alumno');
    Route::get('/encuestas_satisfaccion/enc_residencia_datos_alumn/{id_alumno}', 'Enc_servicioController@enc_residencia_datos_alumn');
    Route::post('/encuestas_satisfaccion/envio_encuesta_estudiante_residencia/', 'Enc_servicioController@envio_encuesta_estudiante_residencia');
    Route::get('/encuestas_satisfaccion/encuesta_servicio_social/', 'Enc_servicioController@encuesta_servicio_social');
    Route::post('/encuestas_satisfaccion/guardar_encuesta_servicio/{id_alumno}', 'Enc_servicioController@guardar_encuesta_servicio');
    Route::get('/encuestas_satisfaccion/encuesta_residencia/', 'Enc_servicioController@encuesta_residencia');
    Route::post('/encuestas_satisfaccion/guardar_encuesta_residencia/{id_alumno}', 'Enc_servicioController@guardar_encuesta_residencia');
    Route::get('/encuestas_satisfaccion/ingresar_encuesta_mantenimiento/', 'Enc_servicioController@ingresar_encuesta_mantenimiento');
    Route::post('/encuestas_satisfaccion/guardar_registro_mantemiento_computo/{mes}/{year}', 'Enc_servicioController@guardar_registro_mantemiento_computo');
    //  Route::get('/encuestas_satisfaccion/ingresar_encuesta_mantenimiento/','Enc_servicioController@ingresar_encuesta_mantenimiento');
    Route::get('/encuestas_satisfaccion/notificacion_enviar_enc_mantenimiento/{id_servicio_mantenimiento}', 'Enc_servicioController@notificacion_enviar_enc_mantenimiento');
    Route::post('/encuestas_satisfaccion/guardar_envio_enc_mante/', 'Enc_servicioController@guardar_envio_enc_mante');
    Route::get('/encuestas_satisfaccion/registro_enc_mante_usuario/', 'Enc_servicio_ccController@registro_enc_mante_usuario');
    Route::get('/encuestas_satisfaccion/contestar_encuesta_mantenimiento/{id_servicio_mantenimieento}', 'Enc_servicio_ccController@contestar_encuesta');
    Route::post('/encuestas_satisfaccion/enviar_encuesta_mantenimiento/{id_servicio_mantenimiento}', 'Enc_servicio_ccController@enviar_encuesta_mantenimiento');
    Route::get('/encuestas_satisfaccion/periodo_mantenimiento/', 'Enc_mantenimientoController@index');
    Route::post('/encuestas_satisfaccion/registrar_periodo_mantenimiento_year/', 'Enc_mantenimientoController@registrar_periodo_mantenimiento_year');
    Route::get('/encuestas_satisfaccion/ver_encuestas_mant/{mes}/{year}', 'Enc_mantenimientoController@ver_encuestas_mant');
    Route::get('/encuestas_satisfaccion/ver_enc_mantenimiento/{id_servicio_mantenimiento}', 'Enc_mantenimientoController@ver_enc_mantenimiento');
    Route::get('/encuestas_satisfaccion/eliminar_enc_mantenimiento/{id_servicio_mantenimiento}', 'Enc_mantenimientoController@eliminar_enc_mantenimiento');
    Route::post('/encuestas_satisfaccion/guardar_eliminacion_enc_mante/', 'Enc_mantenimientoController@guardar_eliminacion_enc_mante');
    Route::get('/encuestas_satisfaccion/termino_encuesta_mantenimiento/{id_periodo_mantenimiento}', 'Enc_mantenimientoController@datos_terminar_periodo');
    Route::post('/encuestas_satisfaccion/guardar_termino_encuesta_mantenimiento', 'Enc_mantenimientoController@guardar_termino_encuesta_mantenimiento');

    Route::get('/encuestas_satisfaccion/ver_resultado_mantenimiento/{mes}/{year}', 'Enc_mantenimientoController@ver_resultado_mantenimiento');
    Route::get('/encuestas_satisfaccion/menu_historial_mantenimiento/', 'Enc_mantenimientoController@menu_historial_mantenimiento');
    Route::get('/encuestas_satisfaccion/menu_historial_mantenimiento_year/{year}', 'Enc_mantenimientoController@menu_historial_mantenimiento_year');


    //**************************************************************************************************
    //*************************************************************************************************
    //*******************************HERRAMIENTAS COMPUTO ********************************************
    Route::resource('/centro_computo/registro_estudiantes_correo/', 'Compu_reg_usuarioController');
    Route::post('/centro_computo/registro_datos_estudiante_excel/', 'Compu_reg_usuarioController@registro_datos_estudiante_excel');
    Route::get('/centro_computo/notificacion_datos_reg/', 'Compu_reg_usuarioController@notificacion_datos_reg');
    Route::get('/centro_computo/configuracion_dat/', 'Compu_reg_usuarioController@configuracion_datos');

    //*****************************************************************************************************
    //*****************************************************************************************************
    //***************************************SGOE**********************************************************

    Route::resource('/sgoe/inicio','Sgoe_inicioController');
    Route::get('/sgoe/documentacion','Sgoe_inicioController@documentacion');



    //********************************************************************************************************
//****************************** MODULO DE DUALES ******************************************************//
//********************************************************************************************************


    Route::resource(
        '/duales/agregar_alumnos_dual',
        'Dual_AlumnoController'
    );


    Route::post(
        '/duales/guardar_alumno_dual',
        'Dual_AlumnoController@guardar_alumno_dual'
    );


    Route::delete(
        '/duales/Eliminar_dual/{id_duales_actuales}',
        'Dual_AlumnoController@eliminar_alumno_dual'
    );


    Route::delete(
        '/duales/eliminacion_dual/{id_duales_actuales}',
        'Dual_AlumnoController@eliminacion_dual'
    );
//********************************************************************************************************
//****************************** CARGAS ACADÉMICAS *****************************************************//
    Route::resource(
        '/duales/llenar_carga_academica_dual',
        'Dual_Carga_Academica_Alumno'
    );
    Route::get('/duales/alumnos/materias/{id_duales_actuales}','Dual_Alumnos_MateriasController@index');
    Route::post('/duales/agrega/materias_alumnos','Dual_Alumnos_MateriasController@agrega_materias');
    Route::delete('/duales/eliminar_carga_academica/{id_carga_academica}','Dual_Alumnos_MateriasController@eliminar_carga_academica');



//********************************************************************************************************
//****************************** CHECAR CARGA ************************************************************//
//********************************************************************************************************
    Route::resource('/duales/checar_carga_academica','Dual_Checar_Carga_Academica_Alumno');
    Route::get('/duales/revision_control_escolar/{id_alumno}','Dual_Checar_Carga_Academica_Alumno@revision_carga');
//********************************************************************************************************
//****************************** VALIDAR CARGA ***********************************************************//
//********************************************************************************************************
    Route::resource('/duales/validacion_de_carga','Dual_Validar_Carga_Academica_Alumno');
//********************************************************************************************************
//****************************** ENVIAR CARGA ************************************************************//
//********************************************************************************************************
    Route::get('/duales/enviar_carga/{id}','Dual_Checar_Carga_Academica_Alumno@enviarcarga');
//********************************************************************************************************
//****************************** IMPRIMIR ****************************************************************//
//********************************************************************************************************
    Route::resource('/duales/imprime_carga','Dual_PDF_Carga_Academica');
    Route::get('/duales/imprime_control/{id_alumno}','Dual_PDF_Carga_Academica_Control@index');
    //******************************ASIGNAR MENTORES DUALES**************************************************//
    Route::resource('/duales/Agregar_docentes_duales', 'Dual_Mentor');
    Route::post('/duales/guardar_mentor_dual', 'Dual_Mentor@guardar_mentor_dual');
    //********************CALIFICACIONES DE LOS ALUMNOS DUALES********************//
    Route::resource('/duales/mentor_calificar', 'Dual_Mentor_Calificaciones');
    Route::get('/duales/calificar_estudiante/{id_carga}', 'Dual_Validar_Carga_Academica_Alumno@calificar_estudiante');
    Route::get('/acta_dual_actual/{id_alumno}/{id_periodo}', 'Cal_pdf_acta_dualController@acta_dual_actual');
    //********************EXPORTAR LISTAS DE LOS ALUMNOS DUALES********************//
    Route::get('/duales/generar_listas_duales', 'Dual_PDF_Listas_Alumnos@generar_listas');
    //********************CONCENTRADO DE CALIFICACIONES DE LOS ALUMNOS DUALES********************//
    Route::get('/duales/concentrado_calificaciones_duales', 'Dual_Concentrado_Calificaciones@index');
    Route::get('/duales/concentrado_calificaciones_duales/semestres/{id_carrera}', 'Dual_Concentrado_Calificaciones@concentrado_calificaciones');
    Route::get('/duales/concentrado_calificaciones_duales/materias/{id_carrera}/{id_semestre}/{id_grupo}', 'Dual_Concentrado_Calificaciones@concentrado_materias');
    Route::get('/duales/concentrado_calificaciones_duales/concentrado_alumnos_materias/{id_materia}', 'Dual_Concentrado_Alumnos_Materias@index');
    Route::get('/duales/concentrado_calificaciones_duales/concentrado_excel/{id_materia}', 'Dual_Excel@concentrado_calificaciones_materias');
    //********************GESTIÓN ACADÉMICA DUALES************************************************************//
    Route::get('/duales/gestion_academica', 'Dual_Gestion_Direccion_Academica@index');
    Route::get('/duales/gestion_academica/docentes/{id_carrera}', 'Dual_Gestion_Direccion_Academica@ver_docentes_duales');
    Route::get('/duales/gestion_academica/alumnos/{id_personal}', 'Dual_Gestion_Direccion_Academica@ver_alumnos_duales');
    Route::get('/duales/gestion_academica/mostrar_calificaciones_duales/{id_carga}', 'Dual_Gestion_Direccion_Academica@ver_calificaciones_alumnos_duales');



    // ===== MENÚ SERVICIOS ESCOLARES MODULO DUALES===== //
    Route::resource('/servicios_escolares/duales/agregar_alumnos_dual','Serv_Esc_Dual_AlumnoController');
    Route::post('/servicios_escolares/duales/guardar_alumno_dual','Serv_Esc_Dual_AlumnoController@guardar_alumno_dual');
    Route::delete('/servicios_escolares/duales/Eliminar_dual/{id_duales_actuales}','Serv_Esc_Dual_AlumnoController@eliminar_alumno_dual');
    Route::delete('/servicios_escolares/duales/eliminacion_dual/{id_duales_actuales}','Serv_Esc_Dual_AlumnoController@eliminacion_dual');
    Route::resource('/servicios_escolares/duales/llenar_carga_academica_dual', 'Serv_Esc_Dual_Carga_Academica_AlumnoController');
    Route::get('/servicios_escolares/duales/alumnos/materias/{id_duales_actuales}', 'Serv_Esc_Dual_Alumnos_MateriasController@index');
    Route::post('/servicios_escolares/duales/agrega/materias_alumnos', 'Serv_Esc_Dual_Alumnos_MateriasController@agrega_materias');
    Route::delete('/servicios_escolares/duales/eliminar_carga_academica/{id_carga_academica}', 'Serv_Esc_Dual_Alumnos_MateriasController@eliminar_carga_academica');
    Route::resource('/servicios_escolares/duales/checar_carga_academica', 'Serv_Esc_Dual_Checar_Carga_Academica_AlumnoController');
    Route::get('/servicios_escolares/duales/revision_control_escolar/{id_alumno}', 'Serv_Esc_Dual_Checar_Carga_Academica_AlumnoController@revision_carga');
    Route::resource('/servicios_escolares/duales/validacion_de_carga', 'Serv_Esc_Dual_Validar_Carga_Academica_AlumnoController');
    Route::get('/servicios_escolares/duales/enviar_carga/{id}', 'Serv_Esc_Dual_Checar_Carga_Academica_AlumnoController@enviarcarga');

    //***********REPORTE EVIDENCIAS**************************************//
    Route::resource('auditorias/reporteevidencias', 'AudReporteEvidenciaController');

    //**************NO CONFORMIDAD Y ACCIONES CORRECTIVAS*************************//
    Route::resource('auditorias/conformidadesyacciones', 'AudAccionesController');

    //********************CONFORMIDADES****************************************//
    Route::resource('auditorias/notas_auditorias', 'AudAccionesController');

    //*********************EVIDENCIAS ACCIONES********************************//
    Route::resource('auditorias/evidencias', 'AudEvidenciasAccionesController');

    //************************INFORME DEL ESTADO****************************//
    Route::resource('auditorias/informe_estado' , 'AudInformeEstadoController');


    ///////////////////////////////////////////////////////////////////////////////////////////////
    /// /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// ***************************reportes de profesores*******************************/////////////

    Route::resource('/distribucion_horas_profesores/' , 'HrsDistribucionHorasDocController');
    Route::get('/distribucion_horas_profesores/profesores_categoria/{id_categoria}' , 'HrsDistribucionHorasDocController@distribucion_profesores_categoria');
    Route::get('/distribucion_horas_profesores/materias/{id_personal}' , 'HrsDistribucionHorasDocController@distribucion_horas_prof_mat');
    Route::get('/distribucion_horas_profesores/total/' , 'HrsDistribucionHorasDocController@distribucion_horas_prof_total');
    Route::get('/distribucion_horas_profesores/totales_profesor/{id_categoria}' , 'HrsDistribucionHorasDocController@distribucion_totales_prof');
    Route::get('/distribucion_horas_profesores/excel_totales_profesor/{id_categoria}' , 'HrsDistribucionHorasDocController@distribucion_excel_totales_profesor');
    Route::get('/distribucion_horas_profesores/total_totales/' , 'HrsDistribucionHorasDocController@distribucion_horas_prof_totales');
    Route::get('/distribucion_horas_profesores/profesores_categorias/{id_categoria}' , 'HrsDistribucionHorasDocController@distribucion_profesores_categorias');
    Route::get('/distribucion_horas_profesores/excel_profesores_categorias/{id_categoria}' , 'HrsDistribucionHorasDocController@distribucion_profesores_cat_excel');

    Route::resource('/indices_repro_prof/' , 'HrsIndicesRep_ProfController');
    Route::get('/indices_repro_prof/carrera_categoria/{id_carrera}' , 'HrsIndicesRep_ProfController@indice_repro_carrera_categoria');
    Route::get('/indices_repro_prof/carrera_cat_docente/{id_carrera}/{id_categoria}' , 'HrsIndicesRep_ProfController@indice_repro_carrera_cat_docente');
    Route::get('/indices_repro_prof/excel_indice_rep_prof/{id_carrera}/{id_categoria}' , 'HrsIndicesRep_ProfController@excel_indice_rep_prof');
    Route::get('/indices_repro_prof/carrera_categoria_jefe/{id_carrera}' , 'HrsIndicesRep_ProfController@carrera_categoria_jefe');


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///
    //********************SISTEMA DE PRESTAMOS ACTUALIZADO************************************************************//

    Route::post('/guardar-material', 'PMMaterial_PrestamosController@store')->name('guardar_material');
    Route::post('/materiales/update', 'PMMaterial_PrestamosController@update')->name('materiales.update');
    Route::delete('/materiales/{id}', 'PMMaterial_PrestamosController@destroy')->name('materiales.destroy');
    Route::resource('/prestamo/materials', 'PMMaterial_PrestamosController');
    Route::get('/materiales-docentes', 'PMMaterial_PrestamosController@materialDocente')->name('materialDocente');
    Route::post('/verificar-existencia','PMMaterial_PrestamosController@getExistencia')->name('verificar_existencia');


    Route::delete('/solicitudes/{id}', 'PMSolicitudMaterialesController@destroy')->name('solicitudes.destroy');
    Route::put  ('/solicitudes/updateDocente/{id}', 'PMSolicitudMaterialesController@updateDocente')->name('solicitudes.updateDocente');
    Route::resource('/prestamo/Jefe_prestamos_materiales', 'PMSolicitudMaterialesController');
    //Route::put('/Jefe_prestamos_materiales/{id}', [PMSolicitudMaterialesController::class, 'update'])->name('Jefe_prestamos_materiales.update');
    Route::put('/Jefe_prestamos_materiales/{id}', 'PMSolicitudMaterialesController@update')->name('Jefe_prestamos_materiales.update');


    Route::put('/solicitud/{id}', [\App\Http\Controllers\PMSolicitudMaterialesController::class, 'update'])->name('solicitud.update');

    Route::post('/solicitar_material/store', 'PMPrestamosController@store')->name('solicitar_material.store');
    Route::post('/solicitar_material2/store2', 'PMPrestamosController@store2')->name('solicitar_material2.store2');

    Route::post('/liberar_adeudo/{id}', 'Solicitud_adeudoController@liberar_adeudo')->name('liberar_adeudo');

    Route::resource('codigos', PMCodigosMaterialController::class);


    Route::delete  ('/solicitudes/eliminarDocente/{id}', 'PMSolicitudMaterialesController@eliminarDocente')->name('solicitudes.eliminarDocente');
    Route::post  ('/solicitudes/editarDocente/{id}', 'PMSolicitudMaterialesController@editarDocente')->name('solicitudes.editarDocente');

    Route::resource('/prestamo/Alumnos_Prestamos_material' , 'PMPrestamosController');
    ///////////////////////////////////////////////////////////
    /// ////////////////////////////////////////////////////////////////////////////

    /*
    |--------------------------------------------------------------------------
    | Módulo Examen EGEL Turismo - Forestal                                   |
    |--------------------------------------------------------------------------
    */

    Route::get('/examen_egel/dashboard', 'Egel_InicioController@alumno')->name('egel.dashboard');
    Route::get('/examen_egel/admin/dashboard', 'Egel_InicioController@admin')->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | SECCIÓNES                                                              |
    |--------------------------------------------------------------------------
    */
    Route::get('/egel/seccion/{id_seccion}', 'EgelSeccionUnoController@index')->name('egel.seccion');
    //Route::get('/egel/seccion1', 'EgelSeccionUnoController@index')->name('egel.seccion1');
    Route::get('/egel/seccion/{id_seccion}/pregunta', 'EgelSeccionUnoController@pregunta')->name('egel.seccion.pregunta');
    Route::post('/egel/seccion/{id_seccion}/responder', 'EgelSeccionUnoController@responder')->name('egel.seccion.responder');
    Route::get('/egel/seccion/{id_seccion}/finalizada', 'EgelSeccionUnoController@finalizada')->name('egel.seccion.finalizada');

    /*
    |--------------------------------------------------------------------------
    | RESULTADOS DEL ALUMNO                                                   |
    |--------------------------------------------------------------------------
    */

    Route::get('/egel/resultados', 'EgelResultadoController@dashboard')->name('egel.resultados.dashboard');
    Route::get('/egel/reporte-final', 'EgelResultadoController@reporte')->name('egel.resultados.reporte');
    Route::get('/egel/pdf-oficial','Egel_ReportepdfController@generar')->name('egel.pdf.oficial');

    /*
    |--------------------------------------------------------------------------
    | ADMIN EGEL                                                              |
    |--------------------------------------------------------------------------
    */

    // Lista de resultados de todos los alumnos
    Route::get('/admin/egel/resultados','AdminEgelController@index')->name('admin.egel.resultados');

    // Ver detalle de alumno
    Route::get('/admin/egel/alumno','AdminEgelController@verAlumno')->name('admin.egel.alumno');

    // Descargar PDF de alumno
    Route::get('/admin/egel/pdf','Egel_ReportepdfController@generar')->name('admin.egel.pdf');

    // ADMIN EXAMENES
    Route::get('/admin/examenes','Egel_ExamenController@index')->name('admin.examenes.index');
    Route::get('/admin/examen/create','Egel_ExamenController@create')->name('admin.examen.create');
    Route::post('/admin/examen/store','Egel_ExamenController@store')->name('admin.examen.store');
    Route::get('/admin/examen/edit/{id_examen_egel}','Egel_ExamenController@edit')->name('admin.examen.edit');
    Route::post('/admin/examen/update/{id_examen_egel}','Egel_ExamenController@update')->name('admin.examen.update');
    Route::get('/admin/examen/delete/{id_examen_egel}','Egel_ExamenController@destroy')->name('admin.examen.delete');
    Route::get('/admin/examen/rapido/{id_examen_egel}','Egel_ExamenController@formRapido')->name('admin.examen.rapido');
    // GUARDAR MASIVO
    Route::post('/admin/examen/rapido','Egel_ExamenController@guardarRapido')->name('admin.examen.guardarRapido');
    Route::get('/examen/{id_examen_egel}/preguntas', 'Egel_ExamenController@preguntas')->name('admin.examen.preguntas');

    // Rutas para Preguntas
    Route::get('/admin/pregunta/edit/{id_pregunta}', 'Egel_ExamenController@editPregunta')->name('admin.pregunta.edit');
    Route::post('/admin/pregunta/update/{id_pregunta}', 'Egel_ExamenController@updatePregunta')->name('admin.pregunta.update');
    Route::get('/admin/pregunta/delete/{id_pregunta}', 'Egel_ExamenController@deletePregunta')->name('admin.pregunta.delete');

    // Rutas para Respuestas
    Route::get('/admin/respuesta/edit/{id_respuesta}', 'Egel_ExamenController@editRespuesta')->name('admin.respuesta.edit');
    Route::post('/admin/respuesta/update/{id_respuesta}', 'Egel_ExamenController@updateRespuesta')->name('admin.respuesta.update');
    Route::get('/admin/respuesta/delete/{id_respuesta}/{id_examen_egel}', 'Egel_ExamenController@deleteRespuesta')->name('admin.respuesta.delete');

    // Periodos EGEL
    Route::get('/admin/periodos', 'Egel_periodosController@index')->name('admin.periodos.index');
    Route::post('/admin/periodos', 'Egel_periodosController@guardar')->name('admin.periodos.guardar');
    Route::get('/admin/periodos/editar/{id_periodo_examen}', 'Egel_periodosController@edit')->name('admin.periodos.edit');
    Route::put('/admin/periodos/actualizar/{id_periodo_examen}', 'Egel_periodosController@update')->name('admin.periodos.update');
    Route::delete('/admin/periodos/eliminar/{id_periodo_examen}', 'Egel_periodosController@destroy')->name('admin.periodos.destroy');

    /*
    |-------------------------------------------------------------------------|
    | Módulo Examen De Conocimientos Generales                                |
    |-------------------------------------------------------------------------|
    */


    /*
    |-------------------------------------------------------------------------|
    | VISTA PARA DOCENTES.                                                    |
    |-------------------------------------------------------------------------|
    */
    Route::get('/examen_conocimientos', 'Inicio_Examen_CGController@docente')->name('examen_conocimientos');
    /*
    |-------------------------------------------------------------------------|
    | VISTA PARA EL ADMINISTRADOR.                                            |
    |-------------------------------------------------------------------------|
    */
    Route::get('/admin_examen_conocimientos', 'Inicio_Examen_CGController@admin')->name('admin_examen_conocimientos');

    /*
    |--------------------------------------------------------------------------
    | SECCIÓN EXAMEN
    |--------------------------------------------------------------------------
    */
    Route::get('/examen_general/seccion/{id_seccion}', 'Examen_GnralC_FormController@index')->name('examen_general.seccion');
    //Route::get('/egel/seccion1', 'EgelSeccionUnoController@index')->name('egel.seccion1');
    Route::get('/examen_general/seccion/{id_seccion}/pregunta', 'Examen_GnralC_FormController@pregunta')->name('examen_general.seccion.pregunta');
    Route::post('/examen_general/seccion/{id_seccion}/responder', 'Examen_GnralC_FormController@responder')->name('examen_general.seccion.responder');
    Route::get('/examen_general/seccion/{id_seccion}/finalizada', 'Examen_GnralC_FormController@finalizada')->name('examen_general.seccion.finalizada');


    /*
    |--------------------------------------------------------------------------
    | ADMINISTRAR EXAMENES                                                    |
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/examenes_generales','Examen_GnralCController@index')->name('admin.examenes_generales.index');
    Route::get('/admin/examen_general/create','Examen_GnralCController@create')->name('admin.examen_general.create');
    Route::post('/admin/examen_general/store','Examen_GnralCController@store')->name('admin.examen_general.store');
    Route::get('/admin/examen_general/edit/{id_examen_egel}','Examen_GnralCController@edit')->name('admin.examen_general.edit');
    Route::post('/admin/examen_general/update/{id_examen_egel}','Examen_GnralCController@update')->name('admin.examen_general.update');
    Route::get('/admin/examen_general/delete/{id_examen_egel}','Examen_GnralCController@destroy')->name('admin.examen_general.delete');
    Route::get('/admin/examen_general/rapido/{id_examen_egel}','Examen_GnralCController@formRapido')->name('admin.examen_general.rapido');

    /*
    |--------------------------------------------------------------------------
    | GUARDAR  MASIVO EXAMENES                                                 |
    |--------------------------------------------------------------------------
    */

    Route::post('/admin/examen_general/rapido','Examen_GnralCController@guardarRapido')->name('admin.examen_general.guardarRapido');
    Route::get('/examen_general/{id_examen_egel}/preguntas', 'Examen_GnralCController@preguntas')->name('admin.examen_general.preguntas');

    // Rutas para Preguntas
    Route::get('/admin/examen_general/pregunta/edit/{id_pregunta}', 'Examen_GnralCController@editPregunta')->name('admin.examen_general.pregunta.edit');
    Route::post('/admin/examen_general/pregunta/update/{id_pregunta}', 'Examen_GnralCController@updatePregunta')->name('admin.examen_general.pregunta.update');
    Route::get('/admin/examen_general/pregunta/delete/{id_pregunta}', 'Examen_GnralCController@deletePregunta')->name('admin.examen_general.pregunta.delete');

    // Rutas para Respuestas
    Route::get('/admin/examen_general/respuesta/edit/{id_respuesta}', 'Examen_GnralCController@editRespuesta')->name('admin.examen_general.respuesta.edit');
    Route::post('/admin/examen_general/respuesta/update/{id_respuesta}', 'Examen_GnralCController@updateRespuesta')->name('admin.examen_general.respuesta.update');
    Route::get('/admin/examen_general/respuesta/delete/{id_respuesta}/{id_examen_egel}', 'Examen_GnralCController@deleteRespuesta')->name('admin.examen_general.respuesta.delete');

    /*
    |--------------------------------------------------------------------------
    | RESULTADOS DEL DOCENTE
    |--------------------------------------------------------------------------
    */

    Route::get('/examen_general/resultados', 'Examen_GnralC_ResultadosController@dashboard')->name('examen_general.resultados.dashboard');
    Route::get('/examen_general/reporte-final', 'Examen_GnralC_ResultadosController@reporte')->name('examen_general.resultados.reporte');
    Route::get('/examen_general/pdf-oficial','Examen_Gnral_CReporteController@generar')->name('examen_general.pdf.oficial');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AGREGAR DOCENTES A PLANTILLA DE EXAMEN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/examen_general/resultados','Admin_Exam_GnralController@index')->name('admin.examen_general.resultados');
    Route::post('/examen_gnral_con/guardar_docente_investigacion','Admin_Exam_GnralController@guardar_docente_investigacion');
    Route::post('/examen_gnral_con/eliminar_docente_investigacion','Admin_Exam_GnralController@eliminar_docente_investigacion');
    Route::get('/admin/examen_general/ver_resultados_docentes','Admin_Exam_GnralController@ver_resultados_docentes')->name('admin.examen_general.ver_resultados_docentes');
    Route::post('/admin/examen_general/guardar_docentes','Admin_Exam_GnralController@guardar_docentes_nuevos')->name('admin.examen_general.guardar_docentes_nuevos');
    Route::get('/admin/examen_general/nuevos_docentes','Admin_Exam_GnralController@vista_docentes_nuevos')->name('admin.examen_general.nuevos_docentes');
    /*
    |--------------------------------------------------------------------------
    | ADMIN VER DETALLES DE LOS DOCENTES                                       |
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/examen_general/docente','Admin_Exam_GnralController@verDocente')->name('admin.examen_general.docente');

    /*
    |--------------------------------------------------------------------------
    | DESCARGAR PDF DEL DOCENTE EVALUADO
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/examen_general/pdf/{id_docente}', 'Examen_Gnral_CReporte_AdminController@generar')->name('admin.examen_general.pdf');
    Route::get('/admin/examen_general/excel','Examen_Gnral_CReporte_AdminController@exportarExcel')->name('admin.examen_general.excel');


    /*
    |--------------------------------------------------------------------------
    | GENERAR PERIODOS PARA EL EXAMEN GENERAL DE CONOCIMIENTOS.                |
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/examen_general/periodos', 'Examen_GnralC_PeriodoController@index')->name('admin.examen_general.periodos.index');
    Route::post('/admin/examen_general/periodos', 'Examen_GnralC_PeriodoController@guardar')->name('admin.examen_general.periodos.guardar');
    Route::get('/admin/examen_general/periodos/editar/{id_periodo_examen}', 'Examen_GnralC_PeriodoController@edit')->name('admin.examen_general.periodos.edit');
    Route::put('/admin/examen_general/periodos/actualizar/{id_periodo_examen}', 'Examen_GnralC_PeriodoController@update')->name('admin.examen_general.periodos.update');
    Route::delete('/admin/examen_general/periodos/eliminar/{id_periodo_examen}', 'Examen_GnralC_PeriodoController@destroy')->name('admin.examen_general.periodos.destroy');

});
