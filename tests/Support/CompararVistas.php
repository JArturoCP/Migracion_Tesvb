<?php

namespace Tests\Support;

use DOMDocument;
use DOMElement;
use DOMXPath;

/**
 * Compara la versión anterior de una vista (tests/Fixtures/vistas_antes, namespace "antes::") con la
 * migrada al panel: formularios (action, method, _token y name de los campos), ids, clases que usan
 * los scripts y textos (datos) del área de contenido.
 */
class CompararVistas
{
    /** Área de contenido de una página renderizada. */
    public static function region(string $html, string $xpath): DOMElement
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8"?>' . $html);
        libxml_clear_errors();
        $nodo = (new DOMXPath($dom))->query($xpath)->item(0);
        if (! $nodo instanceof DOMElement) {
            throw new \RuntimeException("No se encontró la región $xpath");
        }

        return $nodo;
    }

    /**
     * Contenido de una página de layouts.app: <div class="tesvb-contenido"> y, si un </div> sobrante de la
     * vista lo cerró antes de tiempo, también lo que quedó después de él hasta el pie (<footer>).
     */
    public static function regionApp(string $html): DOMElement
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8"?>' . $html);
        libxml_clear_errors();
        $xp = new DOMXPath($dom);
        $inicio = $xp->query('//div[@class="tesvb-contenido"]')->item(0);
        if (! $inicio instanceof DOMElement) {
            throw new \RuntimeException('No se encontró div.tesvb-contenido');
        }
        $contenedor = $dom->createElement('div');
        $contenedor->setAttribute('data-region-app', '1');
        $nodos = [$inicio];
        for ($n = $inicio->nextSibling; $n; $n = $n->nextSibling) {
            if ($n instanceof DOMElement && ($n->nodeName === 'footer' || $xp->query('.//footer', $n)->length)) {
                break;
            }
            $nodos[] = $n;
        }
        $inicio->parentNode->insertBefore($contenedor, $inicio);
        foreach ($nodos as $n) {
            $contenedor->appendChild($n);
        }

        return $contenedor;
    }

    /**
     * Formularios como los arma el navegador (regla del "form element pointer" de HTML5), a partir del HTML
     * en el orden en que llega: un <form> dentro de otro se ignora, un </form> cierra el formulario abierto,
     * un </form> sin formulario abierto se ignora, y cada campo pertenece al formulario abierto cuando
     * aparece (aunque un </div> lo haya sacado del árbol). Así se comparan vistas con formularios mal
     * anidados igual que las ve el usuario. $desde / $hasta delimitan el contenido (texto que lo marca).
     */
    public static function formulariosNavegador(string $html, string $desde, string $hasta): array
    {
        $i = $desde === '' ? 0 : strpos($html, $desde);
        $f = $i === false ? false : ($hasta === '' ? strlen($html) : strpos($html, $hasta, $i));
        if ($i === false || $f === false) {
            throw new \RuntimeException("No se encontró la región entre $desde y $hasta");
        }
        $fragmento = preg_replace(['#<script\b.*?</script>#si', '#<!--.*?-->#s', '#<template\b.*?</template>#si'], '', substr($html, $i, $f - $i));
        preg_match_all('#<(/?)(form|input|select|textarea|button)\b((?:[^>"\']|"[^"]*"|\'[^\']*\')*)>#i', $fragmento, $m, PREG_SET_ORDER);
        $lista = [];
        $abierto = null;
        $atributo = function (string $attrs, string $nombre) {
            return preg_match('/\b' . $nombre . '\s*=\s*("([^"]*)"|\'([^\']*)\'|([^\s>]+))/i', $attrs, $a) ? ($a[2] !== '' ? $a[2] : ($a[3] ?? '') . ($a[4] ?? '')) : null;
        };
        foreach ($m as [$_, $cierre, $tag, $attrs]) {
            $tag = strtolower($tag);
            if ($tag === 'form') {
                if ($cierre) { $abierto = null; continue; }
                if ($abierto !== null) { continue; }
                $lista[] = ['id' => (string) $atributo($attrs, 'id'), 'action' => (string) $atributo($attrs, 'action'),
                    'method' => strtoupper($atributo($attrs, 'method') ?: 'GET'), 'campos' => []];
                $abierto = count($lista) - 1;
                continue;
            }
            if ($cierre || $abierto === null) { continue; }
            $nombre = $atributo($attrs, 'name');
            if ($nombre !== null && $nombre !== '') { $lista[$abierto]['campos'][] = $nombre; }
        }
        foreach ($lista as &$form) {
            $form['campos'] = array_values(array_unique($form['campos']));
            sort($form['campos']);
            $form['token'] = in_array('_token', $form['campos'], true);
        }

        return $lista;
    }

    /** name de todos los campos del contenido (dentro o fuera de formularios), leídos del HTML en orden; ver formulariosNavegador(). */
    public static function camposNavegador(string $html, string $desde, string $hasta): array
    {
        $i = $desde === '' ? 0 : strpos($html, $desde);
        $f = $i === false ? false : ($hasta === '' ? strlen($html) : strpos($html, $hasta, $i));
        if ($i === false || $f === false) {
            throw new \RuntimeException("No se encontró la región entre $desde y $hasta");
        }
        $fragmento = preg_replace(['#<script\b.*?</script>#si', '#<!--.*?-->#s'], '', substr($html, $i, $f - $i));
        preg_match_all('#<(?:input|select|textarea)\b(?:[^>"\x27]|"[^"]*"|\x27[^\x27]*\x27)*?\bname\s*=\s*"([^"]*)"#i', $fragmento, $m);
        $n = array_values(array_unique(array_filter($m[1], fn ($x) => $x !== '')));
        sort($n);

        return $n;
    }

    /** Formularios en orden: action, method, si lleva _token y los name de sus campos (ordenados, sin repetir). */
    public static function formularios(DOMElement $raiz): array
    {
        $xp = new DOMXPath($raiz->ownerDocument);
        $lista = [];
        foreach ($xp->query('.//form', $raiz) as $form) {
            $nombres = [];
            foreach ($xp->query('.//*[@name]', $form) as $campo) {
                if (in_array($campo->nodeName, ['input', 'select', 'textarea', 'button'], true)) {
                    $nombres[] = $campo->getAttribute('name');
                }
            }
            $nombres = array_values(array_unique($nombres));
            sort($nombres);
            $lista[] = [
                'id' => $form->getAttribute('id'),
                'action' => $form->getAttribute('action'),
                'method' => strtoupper($form->getAttribute('method') ?: 'GET'),
                'token' => in_array('_token', $nombres, true),
                'campos' => $nombres,
            ];
        }

        return $lista;
    }

    /** name de todos los campos del área (dentro y fuera de formularios, p. ej. los de Vue y jQuery). */
    public static function nombres(DOMElement $raiz): array
    {
        $xp = new DOMXPath($raiz->ownerDocument);
        $n = [];
        foreach ($xp->query('.//input[@name] | .//select[@name] | .//textarea[@name]', $raiz) as $c) {
            $n[] = $c->getAttribute('name');
        }
        $n = array_values(array_unique($n));
        sort($n);

        return $n;
    }

    public static function ids(DOMElement $raiz): array
    {
        $xp = new DOMXPath($raiz->ownerDocument);
        $ids = [];
        foreach ($xp->query('.//*[@id]', $raiz) as $e) {
            $ids[] = $e->getAttribute('id');
        }
        $ids = array_values(array_unique($ids));
        sort($ids);

        return $ids;
    }

    /** Clases de los elementos del área. */
    public static function clases(DOMElement $raiz): array
    {
        $xp = new DOMXPath($raiz->ownerDocument);
        $c = [];
        foreach ($xp->query('.//*[@class]', $raiz) as $e) {
            foreach (preg_split('/\s+/', trim($e->getAttribute('class'))) as $k) {
                $c[$k] = true;
            }
        }

        return array_keys($c);
    }

    /** Clases que los scripts del área usan como selector (".clase", no llamadas como .modal(…)) o con add/remove/toggle/hasClass. */
    public static function clasesDeScripts(DOMElement $raiz): array
    {
        $xp = new DOMXPath($raiz->ownerDocument);
        $c = [];
        foreach ($xp->query('.//script', $raiz) as $s) {
            $js = $s->textContent;
            preg_match_all('/[\'"][^\'"<]*?(?<![\w\/-])\.([a-zA-Z_][\w-]*+)(?!\s*\()/', $js, $m);   // .clase, no .metodo(
            preg_match_all('/(?:add|remove|toggle|has)Class\(\s*[\'"]([\w-]+)/', $js, $m2);
            foreach (array_merge($m[1], $m2[1]) as $k) {
                $c[$k] = true;
            }
        }

        return array_keys($c);
    }

    /** Textos visibles (sin <script> ni <style>), sin espacios repetidos; solo los que tienen letras o números. */
    public static function textos(DOMElement $raiz): array
    {
        $xp = new DOMXPath($raiz->ownerDocument);
        $t = [];
        foreach ($xp->query('.//text()[not(ancestor::script) and not(ancestor::style)]', $raiz) as $nodo) {
            $s = trim(preg_replace('/\s+/u', ' ', $nodo->nodeValue));
            if ($s !== '' && preg_match('/[\p{L}\p{N}]/u', $s)) {
                $t[] = $s;
            }
        }

        return $t;
    }

    public static function textoPlano(DOMElement $raiz): string
    {
        return implode(' ', self::textos($raiz));
    }

    /** Hojas de estilo y scripts que cargan la página. */
    public static function recursos(string $html): array
    {
        preg_match_all('/<link[^>]+href="([^"]+)"/i', $html, $l);
        preg_match_all('/<script[^>]+src="([^"]+)"/i', $html, $s);

        return array_merge($l[1], $s[1]);
    }
}
