<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class SettingsController extends BaseController
{
    public function index()
    {
        $this->ensureAuth();
        $model = new SettingModel();

        if ($this->request->getMethod() === 'post') {
            $model->set('gemini.apiKey', (string) $this->request->getPost('gemini_api_key'));
            $model->set('gemini.model', (string) $this->request->getPost('gemini_model'));
            $model->set('tripay.apiKey', (string) $this->request->getPost('tripay_api_key'));
            $model->set('tripay.merchantCode', (string) $this->request->getPost('tripay_merchant_code'));
            $model->set('tripay.privateKey', (string) $this->request->getPost('tripay_private_key'));
            $model->set('email.SMTPUser', (string) $this->request->getPost('smtp_user'));
            $model->set('email.SMTPPass', (string) $this->request->getPost('smtp_pass'));
            session()->setFlashdata('success', 'Pengaturan disimpan');
        }

        return view('admin/settings', [
            'title' => 'Pengaturan',
            'settings' => [
                'gemini_api_key' => $model->get('gemini.apiKey'),
                'gemini_model' => $model->get('gemini.model', 'gemini-2.0-flash-exp'),
                'tripay_api_key' => $model->get('tripay.apiKey'),
                'tripay_merchant_code' => $model->get('tripay.merchantCode'),
                'tripay_private_key' => $model->get('tripay.privateKey'),
                'smtp_user' => $model->get('email.SMTPUser'),
                'smtp_pass' => $model->get('email.SMTPPass'),
            ],
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