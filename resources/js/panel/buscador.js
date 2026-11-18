// Buscador del header: filtra en el navegador los enlaces del sidebar (partials/panel/sidebar.blade.php).
// No hace peticiones: solo muestra u oculta los <li> que ya están en la página.
// Los elementos ocultos en el menú original (style="display: none") siguen ocultos: el filtro solo
// agrega o quita la clase "hidden" y nunca toca el estilo en línea.

const normalizar = (texto) =>
    (texto || '')
        .normalize('NFD')
        .replace(/[̀-ͯ]/g, '')
        .replace(/\s+/g, ' ')
        .toLowerCase()
        .trim();

// Texto propio de un <li>: el de su enlace o encabezado directo (no el de sus hijos).
const textoPropio = (li) => {
    const propio = li.querySelector(':scope > a, :scope > form, :scope > [data-panel-periodo]');
    return normalizar(propio ? propio.textContent : '');
};

// Devuelve true si el <li> (o algún descendiente) coincide; oculta los que no.
const filtrarLi = (li, consulta, ancestroCoincide) => {
    const coincidePropio = textoPropio(li).includes(consulta);
    const hijos = li.querySelectorAll(':scope > div > ul > li, :scope > ul > li, :scope > li');
    let algunHijo = false;
    hijos.forEach((hijo) => {
        if (filtrarLi(hijo, consulta, ancestroCoincide || coincidePropio)) algunHijo = true;
    });
    const visible = coincidePropio || algunHijo || ancestroCoincide;
    li.classList.toggle('hidden', !visible);
    return coincidePropio || algunHijo;
};

export function filtrarMenu(texto) {
    const menu = document.querySelector('[data-panel-menu]');
    if (!menu) return;

    const consulta = normalizar(texto);
    menu.querySelectorAll('li.hidden').forEach((li) => li.classList.remove('hidden'));
    if (consulta === '') return;

    menu.querySelectorAll(':scope > li').forEach((li) => filtrarLi(li, consulta, false));
}

export default function registrarBuscador(Alpine) {
    Alpine.store('buscador', {
        texto: '',
        get activo() {
            return normalizar(this.texto) !== '';
        },
        limpiar() {
            this.texto = '';
        },
    });

    Alpine.effect(() => filtrarMenu(Alpine.store('buscador').texto));
}
