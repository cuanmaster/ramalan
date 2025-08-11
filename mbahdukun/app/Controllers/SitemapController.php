<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\HTTP\ResponseInterface;

class SitemapController extends BaseController
{
    public function index(): ResponseInterface
    {
        $base = rtrim(site_url('/'), '/');
        $urls = [
            $base . '/',
            $base . '/faq',
            $base . '/tentang-kami',
            $base . '/privacy-policy',
            $base . '/blog',
        ];

        $articles = (new ArticleModel())->orderBy('published_at', 'DESC')->find();
        foreach ($articles as $a) {
            $urls[] = $base . '/blog/' . $a['slug'];
        }

        $xml = view('sitemap/xml', ['urls' => $urls]);
        return $this->response->setHeader('Content-Type', 'application/xml')->setBody($xml);
    }
}