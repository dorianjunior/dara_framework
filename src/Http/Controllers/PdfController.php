<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\View;
use Utilities\PdfGenerator;

class PdfController {
    public function generatePdf(Request $request) {
        $html = "<h1>Relatório</h1><p>Conteúdo do relatório...</p>";
        $pdfGenerator = new PdfGenerator();
        $pdfContent = $pdfGenerator->generate($html);
        header('Content-Type: application/pdf');
        echo $pdfContent;
    }
}
