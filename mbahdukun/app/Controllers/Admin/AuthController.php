<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        return view('admin/login', ['title' => 'Admin Login']);
    }

    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($email === env('admin.email') && password_verify($password, (string) env('admin.passwordHash'))) {
            session()->set('admin_logged_in', true);
            return redirect()->to('/admin');
        }
        return redirect()->back()->with('error', 'Kredensial tidak valid');
    }

    public function logout()
    {
        session()->remove('admin_logged_in');
        return redirect()->to('/admin/login');
    }
}