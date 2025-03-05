<?php

namespace App\Utilities;

use Dompdf\Dompdf;

class PdfGenerator {
    public function generate($html) {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }
}
