<?php

namespace App\Controllers;

use App\Libraries\GeminiService;
use App\Models\OrderModel;
use App\Models\ResultModel;
use CodeIgniter\HTTP\ResponseInterface;

class PaymentController extends BaseController
{
    public function callback(): ResponseInterface
    {
        $json = $this->request->getBody();
        $signature = $this->request->getHeaderLine('X-Callback-Signature');
        $event = $this->request->getHeaderLine('X-Callback-Event');

        if ($event !== 'payment_status') {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid event']);
        }

        $privateKey = env('tripay.privateKey');
        $hmac = hash_hmac('sha256', $json, $privateKey);
        if (! hash_equals($hmac, $signature)) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Invalid signature']);
        }

        $payload = json_decode($json, true);
        if (! $payload || ($payload['status'] ?? '') !== 'PAID') {
            return $this->response->setJSON(['ok' => true]);
        }

        $reference = $payload['merchant_ref'] ?? '';
        $orders = new OrderModel();
        $order = $orders->findByReference($reference);
        if (! $order) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Order not found']);
        }

        if ($order['status'] !== 'PAID') {
            $orders->updateByReference($reference, ['status' => 'PAID']);
        }

        // Generate result if not exists
        $results = new ResultModel();
        $existing = $results->findByReference($reference);
        if (! $existing) {
            $gemini = new GeminiService();
            $text = $gemini->generateReading($order);
            $results->insert([
                'reference' => $reference,
                'content' => $text,
            ]);

            // Send email
            helper('email');
            $email = service('email');
            $email->setTo($order['email']);
            $email->setSubject('Hasil Ramalan Anda - Mbah Dukun');
            $email->setMessage(view('emails/result', ['content' => nl2br(esc($text))]));
            @$email->send();
        }

        return $this->response->setJSON(['ok' => true]);
    }
}