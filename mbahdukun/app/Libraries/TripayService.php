<?php

namespace App\Libraries;

use App\Models\SettingModel;
use GuzzleHttp\Client;

class TripayService
{
    protected Client $client;
    protected string $apiKey;
    protected string $merchantCode;
    protected string $privateKey;

    public function __construct()
    {
        $settings = new SettingModel();
        $this->apiKey = $settings->get('tripay.apiKey', (string) env('tripay.apiKey'));
        $this->merchantCode = $settings->get('tripay.merchantCode', (string) env('tripay.merchantCode'));
        $this->privateKey = $settings->get('tripay.privateKey', (string) env('tripay.privateKey'));
        $this->client = new Client([
            'base_uri' => 'https://tripay.co.id/api/transaction/',
            'timeout' => 15,
        ]);
    }

    public function createTransaction(array $data): array
    {
        try {
            $payload = [
                'method' => $data['method'],
                'merchant_ref' => $data['merchant_ref'],
                'amount' => $data['amount'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'order_items' => $data['order_items'],
                'return_url' => $data['return_url'],
                'callback_url' => $data['callback_url'],
                'expired_time' => time() + 24 * 60 * 60,
                'signature' => hash_hmac('sha256', $this->merchantCode . $data['merchant_ref'] . $data['amount'], $this->privateKey),
            ];

            $res = $this->client->post('create', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json'
                ],
                'json' => $payload,
            ]);

            $json = json_decode($res->getBody()->getContents(), true);
            return [
                'success' => (bool) ($json['success'] ?? false),
                'data' => $json['data'] ?? $json,
            ];
        } catch (\Throwable $e) {
            log_message('error', 'Tripay error: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}