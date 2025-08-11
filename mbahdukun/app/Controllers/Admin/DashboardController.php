<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->ensureAuth();
        $orders = (new OrderModel())
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->find();
        return view('admin/dashboard', [
            'title' => 'Dashboard',
            'orders' => $orders,
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