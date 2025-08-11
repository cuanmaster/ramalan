<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TestimonialModel;

class TestimonialController extends BaseController
{
    public function index()
    {
        $this->ensureAuth();
        $items = (new TestimonialModel())->orderBy('created_at', 'DESC')->find();
        return view('admin/testimonials/index', [
            'title' => 'Testimonial',
            'items' => $items,
        ]);
    }

    public function create()
    {
        $this->ensureAuth();
        if ($this->request->getMethod() === 'post') {
            (new TestimonialModel())->insert([
                'name' => $this->request->getPost('name'),
                'message' => $this->request->getPost('message'),
            ]);
            return redirect()->to('/admin/testimonials')->with('success', 'Testimonial ditambahkan');
        }
        return view('admin/testimonials/create', [ 'title' => 'Tambah Testimonial' ]);
    }

    public function delete(int $id)
    {
        $this->ensureAuth();
        (new TestimonialModel())->delete($id);
        return redirect()->to('/admin/testimonials')->with('success', 'Testimonial dihapus');
    }

    protected function ensureAuth(): void
    {
        if (! session('admin_logged_in')) {
            redirect()->to('/admin/login')->send();
            exit;
        }
    }
}