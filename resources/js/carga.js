// Indicador de carga del sistema: avisa que la siguiente pantalla se está preparando.
//
// - Barra de progreso fina arriba de la página (color de la marca) en cuanto el usuario sale de la pantalla
//   (enlace, formulario, botón con window.location) y durante las peticiones AJAX de jQuery.
// - Si la espera pasa de ~0.5 s, una tarjeta centrada con el logo, el texto de lo que está pasando
//   ("Cargando pantalla…", "Guardando información…") y la indicación de no cerrar la página.
// - A los 12 s cambia el texto ("Está tardando más de lo normal…") y ofrece "Ocultar aviso".
//
// No se muestra en descargas ni en ventanas nuevas: enlaces con target, download, PDF/Excel/exportar,
// anclas (#), javascript:, data-toggle/data-dismiss (modales y pestañas), clics con Ctrl/Shift/rueda,
// eventos cancelados por la pantalla (validaciones) ni en elementos con data-sin-carga.
// Se oculta al volver con "Atrás" (pageshow) y expone window.TesvbCarga.{mostrar, ocultar}.
// Independiente de Tailwind y de Bootstrap: lo usan layouts/panel, layouts/marco (vía panel.js) y layouts/app.

const RETRASO_TARJETA = 500;
const AVISO_LENTO = 12000;
const DESCARGA = /\.(pdf|xlsx?|csv|docx?|pptx?|zip|rar|png|jpe?g|gif)(\?|#|$)|(pdf|excel|xlsx|exportar|descargar|download|imprimir|reporte_pdf)/i;

const ESTILOS = `
.tesvb-carga-barra{position:fixed;top:0;left:0;z-index:2147483646;height:3px;width:0;opacity:0;pointer-events:none;
  background:linear-gradient(90deg,rgba(70,95,255,.55),rgb(70,95,255) 60%,rgb(54,65,245));
  box-shadow:0 0 10px rgba(70,95,255,.6),0 0 4px rgba(70,95,255,.5);border-radius:0 3px 3px 0;
  transition:width .35s ease,opacity .3s ease}
.tesvb-carga-barra.activa{opacity:1}
.tesvb-carga-capa{position:fixed;inset:0;z-index:2147483645;display:flex;align-items:center;justify-content:center;padding:16px;
  background:rgba(16,24,40,.28);-webkit-backdrop-filter:blur(3px);backdrop-filter:blur(3px);
  opacity:0;visibility:hidden;transition:opacity .25s ease,visibility 0s linear .25s;
  font-family:var(--tesvb-font-family,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif)}
.tesvb-carga-capa.visible{opacity:1;visibility:visible;transition:opacity .25s ease}
.tesvb-carga-tarjeta{width:100%;max-width:360px;border-radius:16px;background:#fff;border:1px solid #e4e7ec;
  box-shadow:0 20px 24px -4px rgba(16,24,40,.10),0 8px 8px -4px rgba(16,24,40,.04);
  padding:28px 24px 24px;text-align:center;transform:translateY(8px) scale(.98);transition:transform .25s ease}
.tesvb-carga-capa.visible .tesvb-carga-tarjeta{transform:none}
.tesvb-carga-icono{position:relative;width:92px;height:92px;margin:0 auto 18px}
.tesvb-carga-aro{position:absolute;inset:0;border-radius:50%;border:3px solid #ecf3ff;border-top-color:rgb(70,95,255);
  border-right-color:rgba(70,95,255,.45);animation:tesvb-carga-gira .9s linear infinite}
.tesvb-carga-logo{position:absolute;inset:8px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;overflow:hidden}
.tesvb-carga-logo img{max-width:84%;max-height:84%;object-fit:contain}
.tesvb-carga-logo span{width:14px;height:14px;border-radius:50%;background:rgb(70,95,255);animation:tesvb-carga-late 1.2s ease-in-out infinite}
.tesvb-carga-titulo{margin:0 0 6px;font-size:16px;line-height:24px;font-weight:600;color:#1d2939}
.tesvb-carga-texto{margin:0;font-size:14px;line-height:20px;color:#667085}
.tesvb-carga-puntos{display:flex;justify-content:center;gap:6px;margin-top:16px}
.tesvb-carga-puntos i{width:6px;height:6px;border-radius:50%;background:rgb(70,95,255);opacity:.25;animation:tesvb-carga-punto 1.2s ease-in-out infinite}
.tesvb-carga-puntos i:nth-child(2){animation-delay:.15s}.tesvb-carga-puntos i:nth-child(3){animation-delay:.3s}
.tesvb-carga-ocultar{display:none;margin:18px auto 0;cursor:pointer;border:0;border-radius:8px;padding:8px 14px;font:inherit;font-size:14px;font-weight:500;
  color:#344054;background:#fff;box-shadow:inset 0 0 0 1px #d0d5dd,0 1px 2px rgba(16,24,40,.05)}
.tesvb-carga-ocultar:hover{background:#f9fafb}
.tesvb-carga-capa.lenta .tesvb-carga-ocultar{display:inline-flex}
.dark .tesvb-carga-capa{background:rgba(0,0,0,.45)}
.dark .tesvb-carga-tarjeta{background:#1a2231;border-color:#344054}
.dark .tesvb-carga-logo{background:#fff;box-shadow:0 0 0 1px rgba(255,255,255,.08)}
.dark .tesvb-carga-aro{border-color:rgba(70,95,255,.18);border-top-color:#7592ff;border-right-color:rgba(117,146,255,.45)}
.dark .tesvb-carga-titulo{color:rgba(255,255,255,.9)}
.dark .tesvb-carga-texto{color:#98a2b3}
.dark .tesvb-carga-ocultar{color:#d0d5dd;background:#1d2939;box-shadow:inset 0 0 0 1px #475467}
@keyframes tesvb-carga-gira{to{transform:rotate(360deg)}}
@keyframes tesvb-carga-late{0%,100%{transform:scale(.7);opacity:.6}50%{transform:scale(1);opacity:1}}
@keyframes tesvb-carga-punto{0%,100%{opacity:.25;transform:translateY(0)}40%{opacity:1;transform:translateY(-3px)}}
@media (prefers-reduced-motion:reduce){.tesvb-carga-aro,.tesvb-carga-logo span,.tesvb-carga-puntos i{animation-duration:2.4s}
  .tesvb-carga-barra,.tesvb-carga-capa,.tesvb-carga-tarjeta{transition:none}}
`;

let barra, capa, titulo, texto, tAnim, tTarjeta, tLento, ajaxActivas = 0, navegando = false;

function crear() {
    if (capa) return;
    const estilo = document.createElement('style');
    estilo.textContent = ESTILOS;
    document.head.appendChild(estilo);

    barra = document.createElement('div');
    barra.className = 'tesvb-carga-barra';
    barra.setAttribute('aria-hidden', 'true');

    const img = document.querySelector('img[alt="TESVB"]');
    const meta = document.querySelector('meta[name="tesvb-logo"]');
    const logo = img ? img.getAttribute('src') : (meta ? meta.getAttribute('content') : null);
    capa = document.createElement('div');
    capa.className = 'tesvb-carga-capa';
    capa.setAttribute('role', 'status');
    capa.setAttribute('aria-live', 'polite');
    capa.innerHTML =
        '<div class="tesvb-carga-tarjeta">' +
        '<div class="tesvb-carga-icono"><div class="tesvb-carga-aro"></div><div class="tesvb-carga-logo">' +
        (logo ? '<img alt="" src="' + logo.replace(/"/g, '&quot;') + '">' : '<span></span>') +
        '</div></div>' +
        '<p class="tesvb-carga-titulo"></p><p class="tesvb-carga-texto"></p>' +
        '<div class="tesvb-carga-puntos" aria-hidden="true"><i></i><i></i><i></i></div>' +
        '<button type="button" class="tesvb-carga-ocultar">Ocultar aviso</button>' +
        '</div>';
    titulo = capa.querySelector('.tesvb-carga-titulo');
    texto = capa.querySelector('.tesvb-carga-texto');
    capa.querySelector('.tesvb-carga-ocultar').addEventListener('click', () => ocultarTarjeta());
    document.body.appendChild(barra);
    document.body.appendChild(capa);
}

// Barra: avanza rápido al principio y cada vez más lento, sin llegar al final hasta que termina la carga.
function iniciarBarra() {
    crear();
    clearInterval(tAnim);
    let avance = parseFloat(barra.style.width) || 0;
    if (!barra.classList.contains('activa')) {
        avance = 0;
        barra.style.transition = 'none';
        barra.style.width = '0';
        void barra.offsetWidth;
        barra.style.transition = '';
        barra.classList.add('activa');
    }
    const paso = () => {
        avance += (90 - avance) * (avance < 40 ? 0.18 : 0.06);
        barra.style.width = avance + '%';
    };
    paso();
    tAnim = setInterval(paso, 300);
}

function terminarBarra() {
    if (!barra || !barra.classList.contains('activa')) return;
    clearInterval(tAnim);
    barra.style.width = '100%';
    setTimeout(() => {
        barra.classList.remove('activa');
        setTimeout(() => { if (!barra.classList.contains('activa')) barra.style.width = '0'; }, 300);
    }, 250);
}

function ocultarTarjeta() {
    clearTimeout(tTarjeta);
    clearTimeout(tLento);
    if (capa) capa.classList.remove('visible', 'lenta');
}

export function mostrar(mensaje = 'Cargando pantalla…', detalle = 'Estamos preparando la información. No cierres ni recargues la página.') {
    crear();
    navegando = true;
    iniciarBarra();
    clearTimeout(tTarjeta);
    clearTimeout(tLento);
    titulo.textContent = mensaje;
    texto.textContent = detalle;
    capa.classList.remove('lenta');
    tTarjeta = setTimeout(() => capa.classList.add('visible'), RETRASO_TARJETA);
    tLento = setTimeout(() => {
        texto.textContent = 'Está tardando más de lo normal. Puedes seguir esperando; la pantalla se abrirá en cuanto esté lista.';
        capa.classList.add('lenta');
    }, AVISO_LENTO);
}

export function ocultar() {
    navegando = false;
    ocultarTarjeta();
    if (ajaxActivas === 0) terminarBarra();
}

function esNavegable(url, destino) {
    if (!url) return false;
    if (destino && destino !== '_self' && destino !== '_top' && destino !== '_parent') return false;
    const crudo = url.trim();
    if (/^(#|javascript:|mailto:|tel:|data:|blob:)/i.test(crudo)) return false;
    let u;
    try { u = new URL(crudo, location.href); } catch (e) { return false; }
    if (u.origin !== location.origin) return false;
    if (u.pathname === location.pathname && u.search === location.search && u.hash) return false;
    return !DESCARGA.test(u.pathname + u.search);
}

function mensajeFormulario(form) {
    const accion = (form.getAttribute('action') || '').toLowerCase();
    if (/logout|salir|cerrar_sesion/.test(accion)) return ['Cerrando sesión…', 'Un momento, estamos cerrando tu sesión de forma segura.'];
    if ((form.getAttribute('method') || 'get').toLowerCase() === 'get') return ['Buscando información…', 'Estamos consultando los datos. No cierres ni recargues la página.'];
    return ['Guardando información…', 'Estamos registrando los datos. No cierres ni recargues la página ni vuelvas a enviar el formulario.'];
}

function alEnviar(form, submitter) {
    if (!form || form.hasAttribute('data-sin-carga')) return;
    if (submitter && submitter.hasAttribute && submitter.hasAttribute('data-sin-carga')) return;
    const destino = (submitter && submitter.getAttribute && submitter.getAttribute('formtarget')) || form.getAttribute('target');
    const accion = (submitter && submitter.getAttribute && submitter.getAttribute('formaction')) || form.getAttribute('action') || location.href;
    if (!esNavegable(accion, destino)) return;
    mostrar(...mensajeFormulario(form));
}

function iniciar() {
    // Enlaces y botones con window.location en onclick. Se revisa después de los manejadores de la pantalla
    // (setTimeout 0) para respetar preventDefault (validaciones, modales, confirmaciones).
    document.addEventListener('click', (e) => {
        if (e.button !== 0 || e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;
        const el = e.target.closest ? e.target.closest('a[href], [onclick]') : null;
        if (!el || el.closest('[data-sin-carga]') || el.hasAttribute('data-toggle') || el.hasAttribute('data-dismiss')) return;
        let url = null, destino = null;
        if (el.tagName === 'A' && el.hasAttribute('href')) {
            if (el.hasAttribute('download')) return;
            url = el.getAttribute('href');
            destino = el.getAttribute('target');
        } else {
            const m = (el.getAttribute('onclick') || '').match(/location(?:\.href)?\s*=\s*['"]([^'"]+)['"]/);
            if (!m || /window\.open/.test(el.getAttribute('onclick'))) return;
            url = m[1];
        }
        setTimeout(() => { if (!e.defaultPrevented && esNavegable(url, destino)) mostrar(); }, 0);
    });

    // Formularios enviados por el usuario (botón submit / Enter).
    document.addEventListener('submit', (e) => {
        const form = e.target;
        setTimeout(() => { if (!e.defaultPrevented) alEnviar(form, e.submitter); }, 0);
    });

    // Formularios enviados desde los scripts de las pantallas: $('#form').submit() / form.submit()
    // no disparan el evento submit, así que se avisa desde el propio método.
    const enviarNativo = HTMLFormElement.prototype.submit;
    HTMLFormElement.prototype.submit = function () {
        try { alEnviar(this, null); } catch (err) { /* el aviso nunca debe impedir el envío */ }
        return enviarNativo.apply(this, arguments);
    };

    // Al volver con "Atrás" la página sale del caché con el aviso visible: se oculta.
    window.addEventListener('pageshow', () => ocultar());

    // Peticiones AJAX de jQuery: solo la barra (no bloquea la pantalla).
    const $ = window.jQuery;
    if ($ && $(document).on) {
        $(document).on('ajaxSend', () => { ajaxActivas++; iniciarBarra(); });
        $(document).on('ajaxComplete', () => {
            ajaxActivas = Math.max(0, ajaxActivas - 1);
            if (ajaxActivas === 0 && !navegando) terminarBarra();
        });
    }

    window.TesvbCarga = { mostrar, ocultar };
}

if (!window.TesvbCarga) {
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', iniciar);
    else iniciar();
}
