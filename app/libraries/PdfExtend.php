<?php

namespace App\Libraries;

use Codedge\Fpdf\Fpdf\Fpdf;

class PdfExtend extends Fpdf
{
    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k  = $this->k;
        $hp = $this->h;

        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';

        $MyArc = 4/3 * (sqrt(2) - 1);

        $this->_out(sprintf('%.2F %.2F m', ($x+$r)*$k, ($hp-$y)*$k ));

        // Línea superior
        $this->_out(sprintf('%.2F %.2F l', ($x+$w-$r)*$k, ($hp-$y)*$k ));

        // Esquina superior derecha
        $this->_Arc(
            $x+$w-$r*(1-$MyArc), $y,
            $x+$w, $y+$r*(1-$MyArc),
            $x+$w, $y+$r
        );

        // Línea derecha
        $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k, ($hp-($y+$h-$r))*$k ));

        // Esquina inferior derecha
        $this->_Arc(
            $x+$w, $y+$h-$r*(1-$MyArc),
            $x+$w-$r*(1-$MyArc), $y+$h,
            $x+$w-$r, $y+$h
        );

        // Línea inferior
        $this->_out(sprintf('%.2F %.2F l', ($x+$r)*$k, ($hp-($y+$h))*$k ));

        // Esquina inferior izquierda
        $this->_Arc(
            $x+$r*(1-$MyArc), $y+$h,
            $x, $y+$h-$r*(1-$MyArc),
            $x, $y+$h-$r
        );

        // Línea izquierda
        $this->_out(sprintf('%.2F %.2F l', ($x)*$k, ($hp-($y+$r))*$k ));

        // Esquina superior izquierda
        $this->_Arc(
            $x, $y+$r*(1-$MyArc),
            $x+$r*(1-$MyArc), $y,
            $x+$r, $y
        );

        $this->_out('h');
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ',
            $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k,
            $x3*$this->k, ($h-$y3)*$this->k));
    }
}