<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class DomPdfService
{
    private $dompdf;

    private $options;

    function __construct()
    {
        $this->dompdf = new Dompdf();
        $this->configPdf();
    }

    private function configPdf()
    {
        $this->options = new Options();
        // $this->options->set('defaultFont', 'sans-serif');
        $this->options->set('isHtml5ParserEnabled', true);
        // $this->options->set('isPhpEnabled', true);
        $this->options->set('isRemoteEnabled', true);
        // $this->options->set('isFontSubsettingEnabled', true);

        // Activar la división de filas
        // $this->options->set('split_rows', true);

        $this->dompdf->setPaper('A4', 'portrait');
    }

    public function generatePdf($html) {
        $this->dompdf->loadHtml($html, 'UTF-8');
        $this->dompdf->setOptions($this->options);
        // Renderizar el PDF
        $this->dompdf->render();
        $this->dompdf->stream();
        // $this->dompdf->output();
    }
}
