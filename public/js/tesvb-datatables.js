/*
 * TESVB DataTables: configuración común de todas las tablas del sistema.
 * Cargar después de jquery.dataTables(.min).js. Funciona con DataTables 1.10 y 1.13.
 *
 * - Textos en español (cada tabla puede sobrescribir solo los que necesite con su propio `language`).
 * - Menú de registros por página con opción "Todos".
 * - Las tablas anchas se desplazan horizontalmente dentro de su contenedor en lugar de desbordar la página.
 * - Las tablas comunes (table.table que no son DataTables) se colocan dentro de .table-responsive,
 *   también las que llegan después por AJAX.
 */
(function ($) {
    'use strict';

    if (!$ || !$.fn) { return; }

    /* ---------- Tablas comunes: scroll horizontal propio ---------- */
    function esDataTable(tabla) {
        return !!($.fn.dataTable && $.fn.dataTable.isDataTable && $.fn.dataTable.isDataTable(tabla));
    }

    function envolverTablas(raiz) {
        $(raiz || document).find('table.table').each(function () {
            var $t = $(this);
            if (esDataTable(this) || $t.closest('.table-responsive, .dataTables_wrapper, .tesvb-dt-scroll, .tesvb-tabla-scroll').length) { return; }
            $t.wrap('<div class="table-responsive tesvb-envuelta"></div>');
        });
    }

    // Después de los $(document).ready de las vistas, para no envolver tablas que se volverán DataTables.
    $(window).on('load', function () {
        envolverTablas(document);
        if (window.MutationObserver) {
            var pendiente = null;
            new MutationObserver(function () {
                clearTimeout(pendiente);
                pendiente = setTimeout(function () { envolverTablas(document); }, 300);
            }).observe(document.body, { childList: true, subtree: true });
        }
    });

    if (!$.fn.dataTable) { return; }

    var ESPANOL = {
        decimal: '',
        emptyTable: 'No hay datos disponibles en la tabla',
        info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
        infoEmpty: 'Mostrando 0 a 0 de 0 registros',
        infoFiltered: '(filtrado de _MAX_ registros en total)',
        infoPostFix: '',
        thousands: ',',
        lengthMenu: 'Mostrar _MENU_ registros',
        loadingRecords: 'Cargando...',
        processing: 'Procesando...',
        search: 'Buscar:',
        searchPlaceholder: 'Escribe para filtrar',
        zeroRecords: 'No se encontraron registros que coincidan con la búsqueda',
        paginate: {
            first: 'Primero',
            last: 'Último',
            next: 'Siguiente',
            previous: 'Anterior'
        },
        aria: {
            sortAscending: ': activar para ordenar la columna de forma ascendente',
            sortDescending: ': activar para ordenar la columna de forma descendente'
        }
    };

    $.extend(true, $.fn.dataTable.defaults, {
        language: ESPANOL,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos']]
    });

    // Al terminar de inicializar cada tabla: estilo común y desplazamiento horizontal propio.
    $(document).on('init.dt', function (e, settings) {
        if (!settings || !settings.nTable || e.namespace !== 'dt') { return; }
        var $tabla = $(settings.nTable);
        // Si la tabla ya estaba envuelta como tabla común, los controles de DataTables no deben desplazarse con ella.
        var $envoltura = $(settings.nTableWrapper).parent('.table-responsive.tesvb-envuelta');
        if ($envoltura.length) { $(settings.nTableWrapper).unwrap(); }
        $(settings.nTableWrapper).addClass('tesvb-dt');
        $tabla.addClass('tesvb-dt-tabla');
        var usaScrollPropio = settings.oScroll && (settings.oScroll.sX || settings.oScroll.sY);
        if (!usaScrollPropio && !$tabla.parent().hasClass('tesvb-dt-scroll')) {
            $tabla.wrap('<div class="tesvb-dt-scroll"></div>');
        }
    });
})(window.jQuery);
