<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class Blog extends BaseController
{
    public function index()
    {
        $articles = (new ArticleModel())->orderBy('published_at', 'DESC')->paginate(10);
        return view('blog/index', [
            'articles' => $articles,
            'pager' => (new ArticleModel())->pager,
            'title' => 'Artikel - Mbah Dukun'
        ]);
    }

    public function show(string $slug)
    {
        $article = (new ArticleModel())->where('slug', $slug)->first();
        if (! $article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('blog/show', [
            'article' => $article,
            'title' => $article['title']
        ]);
    }
}