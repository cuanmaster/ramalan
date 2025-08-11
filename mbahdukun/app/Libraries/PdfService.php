<?php

namespace App\Libraries;

use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\ResponseInterface;

class PdfService
{
    public function stream(string $html, string $filename = 'document.pdf'): ResponseInterface
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();

        $response = service('response');
        $response->setHeader('Content-Type', 'application/pdf');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->setBody($dompdf->output());
        return $response;
    }
}