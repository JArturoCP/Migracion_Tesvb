// Modal de cambio de periodo (partials/panel/periodos.blade.php).
// Reproduce partials/periodos.blade.php: al abrir muestra el periodo anterior, el actual y el siguiente;
// las flechas desplazan esa ventana de 3 periodos; al cerrar vuelve al periodo actual.
export default (periodoActual) => ({
    abierto: false,
    centro: periodoActual,

    abrir() {
        this.centro = periodoActual;
        this.abierto = true;
    },

    cerrar() {
        this.abierto = false;
        this.centro = periodoActual;
    },

    arriba() {
        this.centro -= 1;
    },

    abajo() {
        this.centro += 1;
    },

    visible(idPeriodo) {
        return Math.abs(idPeriodo - this.centro) <= 1;
    },
});
