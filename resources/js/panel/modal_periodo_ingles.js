// Modal "Modificar periodo" del perfil de inglés (copia de partials/menu_admin.blade.php L2557-2563).
// Original (jQuery): al hacer clic en .periodo_ingles pide /profesores_ingles/periodos/{id},
// pone la respuesta en #contenedor_modificar_periodo y abre #modal_modificar_periodo.
export default function registrarModalPeriodoIngles() {
    document.addEventListener('click', async (evento) => {
        const disparador = evento.target.closest('.periodo_ingles');
        if (!disparador) return;

        const respuesta = await fetch('/profesores_ingles/periodos/' + disparador.id, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        const contenedor = document.getElementById('contenedor_modificar_periodo');
        if (contenedor) contenedor.innerHTML = await respuesta.text();
        window.dispatchEvent(new CustomEvent('abrir-modal-periodo-ingles'));
    });
}
