<?php

namespace Tests\Support;

/**
 * Verifica que un HTML tenga las etiquetas balanceadas: cada apertura con su cierre, en orden,
 * sin cierres de más. Ignora elementos vacíos (br, img, input…), comentarios, <script> y <style>.
 */
class BalanceHtml
{
    private const VACIOS = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr', 'circle', 'path', 'rect', 'line', 'polyline', 'polygon', 'ellipse', 'stop'];

    /**
     * Devuelve la lista de errores (vacía si está balanceado). Cada error indica la etiqueta y
     * la línea del HTML renderizado.
     */
    public static function errores(string $html): array
    {
        // Quitar comentarios, scripts, estilos y el contenido de atributos (pueden tener "<" o ">").
        $html = preg_replace_callback('/<!--.*?-->|<script\b.*?<\/script>|<style\b.*?<\/style>/si', fn ($m) => str_repeat("\n", substr_count($m[0], "\n")), $html);

        preg_match_all('/<(\/?)([a-zA-Z][a-zA-Z0-9-]*)((?:[^>"\']|"[^"]*"|\'[^\']*\')*?)(\/?)>/s', $html, $m, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);

        $pila = [];
        $errores = [];
        foreach ($m as $t) {
            $cierre = $t[1][0] === '/';
            $nombre = strtolower($t[2][0]);
            $autocerrada = $t[4][0] === '/';
            $linea = substr_count(substr($html, 0, $t[0][1]), "\n") + 1;

            if ($nombre === '!doctype' || in_array($nombre, self::VACIOS, true) || $autocerrada) {
                continue;
            }
            if (! $cierre) {
                $pila[] = [$nombre, $linea];
                continue;
            }
            if (empty($pila)) {
                $errores[] = "Cierre </$nombre> de más en la línea $linea";
                continue;
            }
            [$abierta, $lineaAbierta] = end($pila);
            if ($abierta === $nombre) {
                array_pop($pila);
                continue;
            }
            // ¿Cierra algo más abajo en la pila? Entonces lo intermedio quedó sin cerrar.
            $indice = null;
            for ($i = count($pila) - 1; $i >= 0; $i--) {
                if ($pila[$i][0] === $nombre) {
                    $indice = $i;
                    break;
                }
            }
            if ($indice === null) {
                $errores[] = "Cierre </$nombre> sin apertura en la línea $linea (abierto: <$abierta> de la línea $lineaAbierta)";
                continue;
            }
            for ($i = count($pila) - 1; $i > $indice; $i--) {
                $errores[] = "<{$pila[$i][0]}> de la línea {$pila[$i][1]} sin cerrar (lo cierra </$nombre> en la línea $linea)";
            }
            $pila = array_slice($pila, 0, $indice);
        }
        foreach ($pila as [$abierta, $lineaAbierta]) {
            $errores[] = "<$abierta> de la línea $lineaAbierta sin cerrar al final";
        }

        return $errores;
    }
}
