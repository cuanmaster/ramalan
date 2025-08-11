<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class PricesController extends BaseController
{
    public function index()
    {
        $this->ensureAuth();
        $settings = new SettingModel();

        if ($this->request->getMethod() === 'post') {
            $settings->set('prices.jodoh', (string) $this->request->getPost('jodoh'));
            $settings->set('prices.tarot', (string) $this->request->getPost('tarot'));
            $settings->set('prices.konsultasi', (string) $this->request->getPost('konsultasi'));
            session()->setFlashdata('success', 'Harga disimpan');
        }

        return view('admin/prices', [
            'title' => 'Harga Layanan',
            'prices' => [
                'jodoh' => $settings->get('prices.jodoh', env('prices.jodoh', 5000)),
                'tarot' => $settings->get('prices.tarot', env('prices.tarot', 5000)),
                'konsultasi' => $settings->get('prices.konsultasi', env('prices.konsultasi', 5000)),
            ]
        ]);
    }

    protected function ensureAuth(): void
    {
        if (! session('admin_logged_in')) {
            redirect()->to('/admin/login')->send();
            exit;
        }
    }
}