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
