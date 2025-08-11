<?php

namespace App\Controllers;

use App\Libraries\PdfService;
use App\Models\OrderModel;
use App\Models\ResultModel;

class ResultController extends BaseController
{
    public function show(string $reference)
    {
        $orders = new OrderModel();
        $results = new ResultModel();
        $order = $orders->findByReference($reference);
        $result = $results->findByReference($reference);
        if (! $order || ! $result) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getMethod() === 'post') {
            $email = service('email');
            $email->setTo($order['email']);
            $email->setSubject('Hasil Ramalan Anda - Mbah Dukun');
            $email->setMessage(view('emails/result', ['content' => nl2br(esc($result['content']))]));
            @$email->send();
            return redirect()->back()->with('success', 'Hasil telah dikirim ke email Anda.');
        }

        return view('order/result', [
            'order' => $order,
            'result' => $result,
            'title' => 'Hasil Ramalan'
        ]);
    }

    public function downloadPdf(string $reference)
    {
        $orders = new OrderModel();
        $results = new ResultModel();
        $order = $orders->findByReference($reference);
        $result = $results->findByReference($reference);
        if (! $order || ! $result) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $html = view('order/result_pdf', [
            'order' => $order,
            'result' => $result,
        ]);

        $pdf = new PdfService();
        return $pdf->stream($html, 'hasil-ramalan-' . $reference . '.pdf');
    }
}