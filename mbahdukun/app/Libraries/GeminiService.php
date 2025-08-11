<?php

namespace App\Libraries;

use App\Models\SettingModel;
use GuzzleHttp\Client;

class GeminiService
{
    protected Client $client;
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $settings = new SettingModel();
        $this->apiKey = $settings->get('gemini.apiKey', (string) env('gemini.apiKey'));
        $this->model = $settings->get('gemini.model', (string) env('gemini.model', 'gemini-2.0-flash-exp'));
        $this->client = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/',
            'timeout' => 30,
        ]);
    }

    public function generateReading(array $order): string
    {
        $service = $order['service'];
        $data = json_decode($order['data'] ?? '{}', true);

        $prompt = $this->buildPrompt($service, $data);

        try {
            $res = $this->client->post("v1beta/models/{$this->model}:generateContent", [
                'query' => ['key' => $this->apiKey],
                'json' => [
                    'contents' => [[
                        'parts' => [[ 'text' => $prompt ]]
                    ]]
                ]
            ]);
            $json = json_decode($res->getBody()->getContents(), true);
            $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
            return trim($text) ?: 'Hasil konsultasi sedang diproses.';
        } catch (\Throwable $e) {
            log_message('error', 'Gemini error: ' . $e->getMessage());
            return 'Hasil konsultasi sedang diproses.';
        }
    }

    protected function buildPrompt(string $service, array $data): string
    {
        $base = "Anda adalah Ahli Spiritual Profesional dengan pengalaman puluhan tahun dalam tradisi Nusantara. Berikan jawaban yang bermakna, empatik, menenangkan, dan bertanggung jawab. Gunakan bahasa Indonesia yang sopan. Jangan menyebutkan AI. Berikan struktur yang rapi dengan judul, poin-poin, dan rekomendasi praktis. Sertakan disclaimer bahwa hasil bersifat panduan dan keputusan tetap pada yang bersangkutan.";

        if ($service === 'jodoh') {
            $name = $data['name'] ?? '';
            $partner = $data['partner_name'] ?? '';
            $notes = $data['notes'] ?? '';
            return "$base\n\nLakukan analisis kecocokan jodoh berdasarkan perpaduan pendekatan horoskop Barat dan Primbon Jawa.\nNama: $name\nPasangan: $partner\nCatatan: $notes\n\nSusun hasil:\n1. Gambaran Umum Kecocokan\n2. Aspek Komunikasi, Emosi, dan Nilai Hidup\n3. Potensi Tantangan dan Cara Mengatasinya\n4. Saran Ritual/Ikhtiar yang Bijak (non-mistis, etis)\n5. Ringkasan dan Rekomendasi Tindak Lanjut";
        }

        if ($service === 'tarot') {
            $topic = $data['topic'] ?? '';
            $depth = $data['depth'] ?? 'umum';
            $cards = $data['cards'] ?? '';
            return "$base\n\nLakukan pembacaan tarot untuk topik: $topic. Kedalaman: $depth. Bila ada pilihan kartu: $cards.\n\nSusun hasil: \n1. Inti Permasalahan\n2. Arah Energi Saat Ini\n3. Peluang dan Tantangan\n4. Langkah Praktis yang Disarankan\n5. Penutup yang Menenangkan";
        }

        // konsultasi umum
        $question = $data['question'] ?? '';
        return "$base\n\nBerikan bimbingan spiritual profesional untuk pertanyaan berikut: $question.\nSusun dengan poin-poin yang mudah diterapkan.";
    }
}