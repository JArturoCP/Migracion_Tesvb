var graficoGenero = null;

$(document).ready(function() {

// ===== Estado global de navegación =====
    var currentNivelId = null;
    var currentNivelName = '';
    var currentCarreraId = null;
    var currentCarreraName = '';
    var currentGrupoNombre = null;



// ===== Función para mostrar secciones =====
    function showSection(nombre) {
        $('#seccion-niveles, #seccion-programas, #seccion-concentrado').hide();
        if (nombre === 'niveles') $('#seccion-niveles').show();
        if (nombre === 'programas') $('#seccion-programas').show();
        if (nombre === 'concentrado') $('#seccion-concentrado').show();
    }

// ===== Breadcrumb =====
    function setBreadcrumb(nivel = '', carrera = '', grupo = '') {
        let breadcrumb = 'Niveles';
        if (nivel) breadcrumb += ' > ' + nivel;
        if (carrera) breadcrumb += ' > ' + carrera;
        if (grupo) breadcrumb += ' > ' + grupo;

        let partes = breadcrumb.split(' > ');

        let html = partes.map((parte, idx) => {
            if (idx < partes.length - 1) {
                let id = '';
                if (parte === 'Niveles') id = 'btn-niveles';
                else if (idx === 1) id = 'btn-programas';
                else if (idx === 2) id = 'btn-concentrado';

                if (id)
                    return `<a href="#" id="${id}">${parte}</a> <span class="glyphicon glyphicon-chevron-right"></span>`;
                else return parte + ' <span class="glyphicon glyphicon-chevron-right"></span>';
            } else {
                return parte;
            }
        }).join(' ');

        $('#breadcrumb-programas').html(html);
    }

// ===== Navegación por breadcrumb =====
    $(document).on('click', '#btn-niveles', function (e) {
        e.preventDefault();
        currentNivelId = null;
        currentNivelName = '';
        currentCarreraId = null;
        currentCarreraName = '';
        currentGrupoNombre = null;

        showSection('niveles');
        setBreadcrumb();
    });

    $(document).on('click', '#btn-programas', function (e) {
        e.preventDefault();
        if (!currentNivelId) {
            showSection('niveles');
            return;
        }
        currentCarreraId = null;
        currentCarreraName = '';
        currentGrupoNombre = null;

        showSection('programas');
        setBreadcrumb(currentNivelName);
    });

    $(document).on('click', '#btn-concentrado', function (e) {
        e.preventDefault();
        if (currentCarreraId) {
            currentGrupoNombre = null;
            showSection('concentrado');
            setBreadcrumb(currentNivelName, currentCarreraName);
            $('#parte-inferior').show();
            $('#contenedor-grafico-genero').hide(); // Ocultar gráfica hasta que se dé clic al botón

        }
    });

// ===== Seleccionar nivel y mostrar carreras =====
    $(document).on('click', '.btn-mostrar-carreras', function () {
        currentNivelId = $(this).data('nivel');
        currentNivelName = $(this).data('nombre');

        setBreadcrumb(currentNivelName);
        $('#contenedor-detalle-carrera').empty();
        currentCarreraId = null;
        currentCarreraName = '';
        currentGrupoNombre = null;

        showSection('programas');
    });

// ===== Seleccionar carrera y renderizar concentrado =====
    $(document).on('click', '.btn-carrera', function () {
        currentCarreraId = $(this).data('id');
        currentCarreraName = $(this).data('nombre');
        setBreadcrumb(currentNivelName, currentCarreraName);

        // Aquí ponemos el encabezado completo (ajustar según datos reales)
        $('#titulo-concentrado').html(`
            <h4 class="text-center"><strong>Seguimiento de Resultados Académicos Institucionales</strong></h4>
            <h4 class="text-center"><strong>${currentCarreraName.toUpperCase()}</strong></h4>
            <h4 class="text-center">Nivel: <strong>${currentNivelName}</strong></h4>
            <h4 class="text-center">Grupo: <strong>Todos</strong></h4>
        `);

        // Renderizar grupos del nivel y carrera
        var grupos = (gruposPorNivelCarrera[currentNivelId] || {})[currentCarreraId] || [];
        var htmlGrupos = '';
        grupos.forEach(function (g) {
            htmlGrupos += `<div class="col-md-2">
                <div class="card card-grupo"
                    data-grupo-id="${g.id_grupo}"
                    data-grupo-nombre="${g.descripcion}"
                    style="cursor:pointer; padding:10px; border:1px solid #ccc; text-align:center; margin-bottom:5px;">
                    Grupo: ${g.descripcion}
                </div>
            </div>`;
        });
        $('#contenedor-grupos').html(htmlGrupos);

        // Mostrar tabla y botones
        $('#parte-inferior').hide();

        // Mostrar todos los alumnos de la carrera inicialmente
        //renderAlumnos(currentNivelId, currentCarreraId);
        $('#contenedor-grafico-genero').hide(); // Ocultar gráfica hasta que se dé clic al botón

        showSection('concentrado');
    });

// ===== Seleccionar grupo =====
    $(document).on('click', '.card-grupo', function () {
        var grupoId = $(this).data('grupo-id');
        var grupoNombre = $(this).data('grupo-nombre');
        currentGrupoNombre = grupoNombre;

        setBreadcrumb(currentNivelName, currentCarreraName, grupoNombre);

        // Actualizar título con grupo
        $('#titulo-concentrado').html(`
        <h4 class="text-center"><strong>Seguimiento de Resultados Académicos Institucionales</strong></h4>
        <h4 class="text-center"><strong>${currentCarreraName.toUpperCase()}</strong></h4>
        <h4 class="text-center">Nivel: <strong>${currentNivelName}</strong></h4>
        <h4 class="text-center">Grupo: <strong>${grupoNombre || 'Todos'}</strong></h4>
    `);

        // ✅ Mostrar alumnos SOLO cuando se da clic en grupo
        renderAlumnos(currentNivelId, currentCarreraId, grupoId);

        // Mostrar tabla y botones
        $('#parte-inferior').show();

        $('.card-grupo').removeClass('active'); // Quitar clase de otros
        $(this).addClass('active'); // Agregar clase a este

        var grupoId = $(this).data('grupo-id');
        var grupoNombre = $(this).data('grupo-nombre');
        currentGrupoNombre = grupoNombre;

        // ⚠️ Actualizar datosModal correctamente
        datosModal = {
            grupo: grupoId,
            carrera: currentCarreraId,
            nivel: currentNivelId,
            carreraNombre: currentCarreraName,
            nivelNombre: currentNivelName
        };

    });
//console.log("Alumnos cargados desde PHP:", alumnosPorNivelCarrera);

// ===== Renderizar alumnos =====
    function renderAlumnos(nivelId, carreraId, grupoId = null) {
        const alumnos = alumnosPorNivelCarrera.filter(a =>
            Number(a.id_nivel) === Number(nivelId) &&
            Number(a.id_carrera) === Number(carreraId) &&
            (grupoId === null || Number(a.id_grupo) === Number(grupoId))
        );
        console.log(alumnosPorNivelCarrera);
        console.log("Alumnos que llegaron a renderAlumnos:", alumnos);


        const tabla = $('#tabla-ingles').DataTable();
        tabla.clear();

        if (alumnos.length === 0) {
            tabla.row.add(['-', '-', 'No hay alumnos', '-', '-']).draw();
            $('#tabla-metricas').hide();
            $('#btn-ver-grafica-container').html('');  // Limpiar botón si no hay alumnos
            return;
        }

        // Añadir alumnos a la tabla
        alumnos.forEach((a, i) => {
            tabla.row.add([
                i + 1,
                a.cuenta,
                `${a.nombre} ${a.apaterno} ${a.amaterno}`,
                (a.promedio ? parseFloat(a.promedio).toFixed(2) : '-')
            ]);

        });
        tabla.draw();
        mostrarMetricas(alumnos);
    }


    function mostrarMetricas(alumnos) {
        if (alumnos.length === 0) {
            $('#tabla-metricas').hide();
            $('#indice-reprobacion').text('0.0%');
            $('#indice-desercion').text('0.0%');
            return;
        }

        const total = alumnos.length;
        const reprobados = alumnos.filter(a => parseFloat(a.promedio) < 70 && parseFloat(a.promedio) > 0).length;
        const desertores = alumnos.filter(a => parseFloat(a.promedio) === 0).length;

        const porcentajeReprobacion = (reprobados / total) * 100;
        const porcentajeDesercion = (desertores / total) * 100;

        $('#indice-reprobacion').text(porcentajeReprobacion.toFixed(1) + '%');
        $('#indice-desercion').text(porcentajeDesercion.toFixed(1) + '%');
        $('#tabla-metricas').show();
    }





// const alumnos = @json($datos_alum_in);  // Asegúrate de que los datos son correctos
    mostrarMetricas(alumnos);  // Llamada a la función

// Inicializar mostrando niveles
    showSection('niveles');
    setBreadcrumb();

    $(document).on('click', '#btn-exportar', function () {
        if (!datosModal || !datosModal.grupo || !datosModal.carrera || !datosModal.nivel) {
            return alert("No se puede exportar: faltan datos.");
        }

        const url = '/ingles/desempeno_academico/concentrado_ingles_desempeno/${datosModal.nivel}/${datosModal.grupo}/${datosModal.carrera}';
        window.open(url,'_blank');
    });
    /* let graficoGenero = null;

     $(document).on('click', '.btn-ver-grafica', function (e) {
         e.preventDefault();

         const grupoId = $(this).data('grupo');
         const carreraId = $(this).data('carrera');
         const nivelId = $(this).data('nivel');

         if (!grupoId || !carreraId || !nivelId) {
             return alert("Faltan datos del grupo, carrera o nivel.");
         }

         $('#contenedor-grafico-genero').show();

         $.ajax({
             url: '/api/ingles/grafico-genero',
             method: 'GET',
             data: { grupo: grupoId, carrera: carreraId, nivel: nivelId },
             success: function (response) {
                 const tieneDatos = response && (response.hombres > 0 || response.mujeres > 0);
                 if (!tieneDatos) {
                     $('#grafico_genero').html('<p class="text-center text-muted">No hay datos para este grupo.</p>');
                     return;
                 }

                 const nuevaData = [
                     { name: 'Hombres', y: response.hombres, color: '#031c66' },
                     { name: 'Mujeres', y: response.mujeres, color: '#ff009d' }
                 ];
                 const nuevoTitulo = `Distribución por género - Nivel ${response.nivel} > ${response.carrera} > Grupo ${response.grupo}`;

                 if (graficoGenero) {
                     graficoGenero.destroy();
                     graficoGenero = null;
                     console.log("Gráfico anterior destruido.");
                 }

                 graficoGenero = Highcharts.chart('grafico_genero', {
                     chart: { type: 'column' },
                     title: { text: nuevoTitulo },
                     xAxis: {
                         categories: ['Hombres', 'Mujeres'],
                         title: { text: 'Género' }
                     },
                     yAxis: {
                         min: 0,
                         title: { text: 'Cantidad de estudiantes' }
                     },
                     tooltip: {
                         pointFormat: '<b>{point.y}</b> estudiantes'
                     },
                     series: [{
                         name: 'Estudiantes',
                         data: nuevaData.slice()
                     }],
                     credits: { enabled: false }
                 });
                 console.log("Gráfico recreado con nueva configuración.");
             },
             error: function () {
                 $('#grafico_genero').html('<p class="text-danger text-center">Error al cargar datos del gráfico.</p>');
             }
         });
     }); */

    /*let graficoGenero = null;

    $(document).on('click', '.btn-ver-grafica', function (e) {
        e.preventDefault();

        console.log("click detectado en btn-ver-grafica");

        const grupoId = $(this).data('grupo');
        const carreraId = $(this).data('carrera');
        const nivelId = $(this).data('nivel');

        console.log("Datos capturados: ", { grupoId, carreraId, nivelId });

        if (!grupoId || !carreraId || !nivelId) {
            return alert("Faltan datos del grupo, carrera o nivel.");
        }

        console.log("Antes de enviar la solicitud AJAX");
        $('#contenedor-grafico-genero').show();

        $.ajax({
            url: '/api/ingles/grafico-genero',
            method: 'GET',
            data: { grupo: grupoId, carrera: carreraId, nivel: nivelId },
            success: function (response) {
                console.log("Respuesta recibida del servidor:", response);

                const tieneDatos = response && (response.hombres > 0 || response.mujeres > 0);

                if (!tieneDatos) {
                    $('#grafico_genero').html('<p class="text-center text-muted">No hay datos para este grupo.</p>');
                    return;
                }

                const nuevaData = [
                    { name: 'Hombres', y: response.hombres, color: '#031c66' },
                    { name: 'Mujeres', y: response.mujeres, color: '#ff009d' }
                ];

                const nuevoTitulo = `Distribución por género - Nivel ${response.nivel} > ${response.carrera} > Grupo ${response.grupo}`;

                console.log("Limpiando contenedor del gráfico...");
                if (graficoGenero) {
                    graficoGenero.destroy();
                    graficoGenero = null;
                    console.log("Gráfico anterior destruido.");
                }

                // Validar contenedor antes de crear gráfico
                const contenedorGrafico = document.getElementById('grafico_genero');
                if (!contenedorGrafico) {
                    console.error("No se encontró el contenedor del gráfico (id='grafico_genero').");
                    return;
                }
                console.log(`Contenedor gráfico tamaño: ${contenedorGrafico.offsetWidth}x${contenedorGrafico.offsetHeight}`);

                setTimeout(() => {
                    console.log("Creando gráfico nuevo...");
                    try {
                        graficoGenero = Highcharts.chart('grafico_genero', {
                            chart: { type: 'column' },
                            title: { text: nuevoTitulo },
                            xAxis: {
                                categories: ['Hombres', 'Mujeres'],
                                title: { text: 'Género' }
                            },
                            yAxis: {
                                min: 0,
                                title: { text: 'Cantidad de estudiantes' }
                            },
                            tooltip: {
                                pointFormat: '<b>{point.y}</b> estudiantes'
                            },
                            series: [{
                                name: 'Estudiantes',
                                data: nuevaData.slice()
                            }],
                            credits: { enabled: false }
                        });
                        console.log("Gráfico creado con éxito.");
                    } catch (error) {
                        console.error("Error al crear el gráfico:", error);
                    }
                }, 100);
            },
            error: function () {
                $('#grafico_genero').html('<p class="text-danger text-center">Error al cargar datos del gráfico.</p>');
                console.error("Error en la petición AJAX para el gráfico.");
            }
        });
    });*/

});
