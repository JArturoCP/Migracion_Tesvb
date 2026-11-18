// Gráficas del dashboard de /inicio (ApexCharts).
// Las opciones vienen de TailAdmin Free 2.5.1 (MIT): src/js/components/ecommerce/monthly-sales-chart.js,
// monthly-target-chart.js y statistics-chart.js. Solo cambian los datos, que llegan desde Blade en el
// atributo data-datos (JSON generado en el servidor; nunca se inventan valores).
// ApexCharts se carga solo si la página tiene gráficas.

const esOscuro = () => document.documentElement.classList.contains('dark') || document.body.classList.contains('dark');
const fuente = 'Outfit Variable, Outfit, sans-serif';

const opcionesBarras = ({ serie, categorias, valores }) => ({
    colors: ['#465FFF'],
    chart: { fontFamily: fuente, type: 'bar', height: 200, toolbar: { show: false } },
    plotOptions: {
        bar: { horizontal: false, columnWidth: '38%', borderRadius: 8, borderRadiusApplication: 'around', dataLabels: { position: 'top' } },
    },
    dataLabels: {
        enabled: true,
        formatter: (val) => Number(val).toLocaleString('es-MX'),
        offsetY: -20,
        style: { fontSize: '12px', fontFamily: fuente, fontWeight: 400, colors: [esOscuro() ? '#D1D5DB' : '#364153'] },
        dropShadow: { enabled: false },
    },
    stroke: { show: false },
    series: [{ name: serie, data: valores }],
    xaxis: {
        categories: categorias,
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: { style: { colors: esOscuro() ? '#9CA3AF' : '#364153', fontFamily: fuente } },
    },
    legend: { show: false },
    yaxis: { min: 0, max: Math.max(...valores) * 1.15 || 1, tickAmount: 4, labels: { show: false } },
    grid: {
        borderColor: esOscuro() ? '#1E2640' : '#F3F4F6',
        strokeDashArray: 0,
        padding: { left: -10, right: 0 },
        yaxis: { lines: { show: true } },
        xaxis: { lines: { show: false } },
    },
    fill: {
        type: 'gradient',
        gradient: {
            type: 'vertical', shadeIntensity: 1, opacityFrom: 1, opacityTo: 1, stops: [0, 100],
            colorStops: [{ offset: 0, color: '#7592FF', opacity: 1 }, { offset: 100, color: '#465FFF', opacity: 1 }],
        },
    },
    tooltip: { x: { show: true }, y: { formatter: (val) => Number(val).toLocaleString('es-MX') } },
});

const opcionesRadial = ({ valor, etiqueta }) => ({
    series: [valor],
    colors: ['#9CB9FF'],
    chart: { fontFamily: fuente, type: 'radialBar', height: 330, sparkline: { enabled: true } },
    plotOptions: {
        radialBar: {
            startAngle: -90,
            endAngle: 90,
            hollow: { size: '80%' },
            track: { background: esOscuro() ? '#1C243D' : '#E8EAEE', strokeWidth: '100%', margin: 5 },
            dataLabels: {
                name: { show: false },
                value: {
                    fontSize: '36px', fontWeight: '600', offsetY: -40,
                    color: esOscuro() ? '#FFFFFF' : '#1D2939',
                    formatter: (val) => `${Number(val).toLocaleString('es-MX', { maximumFractionDigits: 2 })}%`,
                },
            },
        },
    },
    fill: {
        type: 'gradient',
        gradient: {
            shade: 'light', type: 'horizontal', shadeIntensity: 0.5, gradientToColors: ['#465FFF'],
            inverseColors: false, opacityFrom: 1, opacityTo: 1, stops: [0, 100],
            colorStops: [{ offset: 0, color: '#9CB9FF', opacity: 1 }, { offset: 100, color: '#465FFF', opacity: 1 }],
        },
    },
    stroke: { lineCap: 'round' },
    labels: [etiqueta],
});

const coloresLinea = ['#465FFF', '#9CB9FF'];

const seriesLinea = (datos, pestana) => {
    const series = pestana === 'general' ? datos.series : datos.series.filter((s) => s.clave === pestana);
    return {
        series: series.map((s) => ({ name: s.nombre, data: s.valores })),
        colors: series.map((s) => coloresLinea[datos.series.indexOf(s)] ?? '#465FFF'),
    };
};

const opcionesLinea = (datos, pestana = 'general') => {
    const { series, colors } = seriesLinea(datos, pestana);
    return {
        series,
        colors,
        legend: { show: false },
        chart: { fontFamily: fuente, height: 310, type: 'area', toolbar: { show: false } },
        fill: { type: 'gradient', gradient: { opacityFrom: 0.55, opacityTo: 0 } },
        stroke: { curve: 'straight', width: series.map(() => 2) },
        markers: { size: 0, strokeColors: '#fff', strokeWidth: 2, hover: { size: 6 } },
        grid: {
            borderColor: esOscuro() ? '#1E2640' : '#F3F4F6',
            strokeDashArray: 0,
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } },
        },
        dataLabels: { enabled: false },
        tooltip: {
            enabled: true,
            shared: true,
            intersect: false,
            custom({ series: valores, dataPointIndex, w }) {
                const categoria = w.config.xaxis?.categories?.[dataPointIndex] ?? '';
                const filas = w.config.series
                    .map((s, i) => {
                        const v = valores[i]?.[dataPointIndex];
                        if (v === undefined || v === null) return '';
                        return `<div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-1.5">
                                <span class="size-1.5 rounded-full shrink-0" style="background-color: ${w.config.colors[i] || '#465FFF'}"></span>
                                <span class="text-xs text-gray-800 dark:text-white/90">${s.name}</span>
                                <span class="text-xs font-medium text-gray-400 dark:text-gray-500">:</span>
                            </div>
                            <span class="text-xs font-medium text-gray-800 dark:text-white/90">${Number(v).toLocaleString('es-MX')}</span>
                        </div>`;
                    })
                    .join('');
                return `<div class="min-w-32.5 p-2 bg-white dark:bg-gray-900 rounded-lg shadow-theme-md border border-gray-200 dark:border-gray-800 space-y-1">
                    <p class="mb-1 text-[10px] leading-4 text-gray-500 dark:text-gray-400">${categoria}</p>${filas}</div>`;
            },
        },
        xaxis: {
            type: 'category',
            categories: datos.categorias,
            axisBorder: { show: false },
            axisTicks: { show: false },
            tooltip: { enabled: false },
            labels: { style: { colors: esOscuro() ? '#9CA3AF' : '#364153', fontFamily: fuente } },
        },
        yaxis: {
            min: 0,
            labels: {
                style: { fontSize: '12px', colors: [esOscuro() ? '#9CA3AF' : '#6B7280'] },
                formatter: (val) => Math.round(val).toLocaleString('es-MX'),
            },
        },
    };
};

const constructores = { barras: opcionesBarras, radial: opcionesRadial, linea: (d) => opcionesLinea(d) };

export default async function iniciarGraficas() {
    const contenedores = document.querySelectorAll('[data-grafica]');
    if (!contenedores.length) return;

    const { default: ApexCharts } = await import('apexcharts');
    const graficas = [];

    contenedores.forEach((el) => {
        const tipo = el.dataset.grafica;
        const construir = constructores[tipo];
        if (!construir) return;
        let datos;
        try {
            datos = JSON.parse(el.dataset.datos);
        } catch (e) {
            return;
        }
        const grafica = new ApexCharts(el, construir(datos));
        grafica.render();
        graficas.push({ tipo, datos, grafica, pestana: 'general' });
    });

    // Pestañas de la gráfica de línea (partials: panel/dashboard/linea.blade.php).
    window.addEventListener('grafica-pestana', (evento) => {
        graficas
            .filter((g) => g.tipo === evento.detail.grafica)
            .forEach((g) => {
                g.pestana = evento.detail.pestana;
                g.grafica.updateOptions(opcionesLinea(g.datos, g.pestana));
            });
    });

    // Modo oscuro: actualizar colores como en la plantilla.
    const observador = new MutationObserver(() => {
        graficas.forEach((g) => {
            const opciones = g.tipo === 'linea' ? opcionesLinea(g.datos, g.pestana) : constructores[g.tipo](g.datos);
            g.grafica.updateOptions(opciones);
        });
    });
    observador.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
    observador.observe(document.body, { attributes: true, attributeFilter: ['class'] });
}
