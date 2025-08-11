<?php

namespace App\Controllers;

use App\Libraries\TripayService;
use App\Models\OrderModel;
use App\Models\SettingModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class OrderController extends BaseController
{
    protected TripayService $tripay;
    protected OrderModel $orders;
    protected SettingModel $settings;

    public function __construct()
    {
        $this->tripay = new TripayService();
        $this->orders = new OrderModel();
        $this->settings = new SettingModel();
    }

    public function orderJodoh(): ResponseInterface
    {
        $validation = service('validation');
        $validation->setRules([
            'name' => 'required|min_length[2]|max_length[50]',
            'partner_name' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email'
        ]);
        if (! $validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(422)->setJSON(['errors' => $validation->getErrors()]);
        }

        $payload = [
            'service' => 'jodoh',
            'name' => $this->request->getPost('name'),
            'partner_name' => $this->request->getPost('partner_name'),
            'notes' => $this->request->getPost('notes'),
            'email' => $this->request->getPost('email'),
        ];

        return $this->createAndPay($payload);
    }

    public function orderTarot(): ResponseInterface
    {
        $validation = service('validation');
        $validation->setRules([
            'name' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email',
            'topic' => 'required|min_length[3]|max_length[200]',
            'depth' => 'permit_empty|in_list[umum,mendalam]'
        ]);
        if (! $validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(422)->setJSON(['errors' => $validation->getErrors()]);
        }

        $payload = [
            'service' => 'tarot',
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'topic' => $this->request->getPost('topic'),
            'depth' => $this->request->getPost('depth') ?: 'umum',
            'cards' => $this->request->getPost('cards') ?: ''
        ];

        return $this->createAndPay($payload);
    }

    public function orderKonsultasi(): ResponseInterface
    {
        $validation = service('validation');
        $validation->setRules([
            'name' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email',
            'question' => 'required|min_length[5]|max_length[500]'
        ]);
        if (! $validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(422)->setJSON(['errors' => $validation->getErrors()]);
        }

        $payload = [
            'service' => 'konsultasi',
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'question' => $this->request->getPost('question')
        ];

        return $this->createAndPay($payload);
    }

    protected function createAndPay(array $payload): ResponseInterface
    {
        $prices = [
            'jodoh' => (int) $this->settings->get('prices.jodoh', env('prices.jodoh', 5000)),
            'tarot' => (int) $this->settings->get('prices.tarot', env('prices.tarot', 5000)),
            'konsultasi' => (int) $this->settings->get('prices.konsultasi', env('prices.konsultasi', 5000)),
        ];
        $amount = $prices[$payload['service']] ?? 5000;

        $reference = 'MD' . Time::now()->format('ymdHis') . random_int(100, 999);

        $orderData = [
            'reference' => $reference,
            'service' => $payload['service'],
            'data' => json_encode($payload, JSON_THROW_ON_ERROR),
            'email' => $payload['email'],
            'amount' => $amount,
            'status' => 'UNPAID',
        ];
        $this->orders->insert($orderData);

        $tripay = $this->tripay->createTransaction([
            'method' => env('tripay.qrisChannel', 'QRIS'),
            'merchant_ref' => $reference,
            'amount' => $amount,
            'customer_name' => $payload['name'] ?? 'Pelanggan',
            'customer_email' => $payload['email'],
            'order_items' => [[
                'sku' => $payload['service'],
                'name' => 'Layanan ' . ucfirst($payload['service']),
                'price' => $amount,
                'quantity' => 1
            ]],
            'return_url' => env('tripay.returnURL'),
            'callback_url' => env('tripay.callbackURL'),
        ]);

        if (! $tripay['success']) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membuat transaksi.']);
        }

        $this->orders->updateByReference($reference, [
            'payment_url' => $tripay['data']['checkout_url'] ?? null,
            'payment_qr_string' => $tripay['data']['qr_string'] ?? null,
            'payment_qr_url' => $tripay['data']['qr_url'] ?? null,
            'tripay_ref' => $tripay['data']['reference'] ?? null,
        ]);

        return $this->response->setJSON([
            'reference' => $reference,
            'redirect' => url_to('App\\Controllers\\OrderController::pay', $reference)
        ]);
    }

    public function pay(string $reference)
    {
        $order = $this->orders->findByReference($reference);
        if (! $order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('order/pay', ['order' => $order, 'title' => 'Pembayaran']);
    }

    public function waiting(string $reference)
    {
        $order = $this->orders->findByReference($reference);
        if (! $order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('order/waiting', ['order' => $order, 'title' => 'Memproses Ramalan']);
    }

    public function status(string $reference)
    {
        $order = $this->orders->findByReference($reference);
        if (! $order) {
            return $this->response->setJSON(['status' => 'NOT_FOUND']);
        }
        return $this->response->setJSON(['status' => $order['status']]);
    }
}