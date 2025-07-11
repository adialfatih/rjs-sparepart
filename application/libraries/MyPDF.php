<?php
require_once(APPPATH . 'pdf/fpdf.php');

class MyPDF extends FPDF {
    protected $angle = 0;

    function Rotate($angle, $x = -1, $y = -1) {
        if ($x == -1) $x = $this->x;
        if ($y == -1) $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm',
                $c, $s, -$s, $c, $cx, $cy));
        }
    }

    function _endpage() {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    function RotatedText($x, $y, $txt, $angle) {
        // Rotasi dan tulis teks
        $this->Rotate($angle, $x, $y);
        //$this->Text($x, $y, $txt);
        $this->Cell($x, 5, $txt, 0, 0, 'L');
        $this->Rotate(0);
    }
}
