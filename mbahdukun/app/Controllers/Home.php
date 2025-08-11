<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\TestimonialModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        $articleModel = new ArticleModel();
        $testimonialModel = new TestimonialModel();

        $articles = $articleModel->orderBy('published_at', 'DESC')->limit(5)->find();
        $testimonials = $testimonialModel->orderBy('id', 'DESC')->limit(6)->find();

        return view('home/index', [
            'articles' => $articles,
            'testimonials' => $testimonials,
            'title' => 'Mbah Dukun - Ramalan & Konsultasi Spiritual Profesional',
            'meta_description' => 'Konsultasi dan ramalan oleh Ahli Spiritual Profesional. Ramalan jodoh, tarot, dan konsultasi dengan pembayaran QRIS. Hasil dapat diunduh PDF atau dikirim via email.'
        ]);
    }

    public function faq()
    {
        return view('pages/faq', [
            'title' => 'FAQ - Mbah Dukun',
            'meta_description' => 'Pertanyaan yang sering diajukan tentang layanan Mbah Dukun.'
        ]);
    }

    public function about()
    {
        return view('pages/about', [
            'title' => 'Tentang Kami - Mbah Dukun',
            'meta_description' => 'Profil dan visi misi Mbah Dukun.'
        ]);
    }

    public function privacy()
    {
        return view('pages/privacy', [
            'title' => 'Kebijakan Privasi - Mbah Dukun',
            'meta_description' => 'Kebijakan privasi dan pengelolaan data pengguna.'
        ]);
    }
}