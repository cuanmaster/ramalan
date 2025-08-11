<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use CodeIgniter\I18n\Time;
use Config\Services;

class ArticlesController extends BaseController
{
    public function index()
    {
        $this->ensureAuth();
        $articles = (new ArticleModel())->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin/articles/index', [
            'title' => 'Artikel',
            'articles' => $articles,
            'pager' => (new ArticleModel())->pager,
        ]);
    }

    public function create()
    {
        $this->ensureAuth();
        $model = new ArticleModel();
        if ($this->request->getMethod() === 'post') {
            helper('text');
            $title = $this->request->getPost('title');
            $slug = strtolower(url_title($title));
            $model->insert([
                'title' => $title,
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'meta_description' => $this->request->getPost('meta_description'),
                'published_at' => Time::now()->toDateTimeString(),
            ]);
            return redirect()->to('/admin/articles')->with('success', 'Artikel dibuat');
        }
        return view('admin/articles/create', ['title' => 'Buat Artikel']);
    }

    public function edit(int $id)
    {
        $this->ensureAuth();
        $model = new ArticleModel();
        $article = $model->find($id);
        if (! $article) {
            return redirect()->to('/admin/articles');
        }
        if ($this->request->getMethod() === 'post') {
            helper('text');
            $title = $this->request->getPost('title');
            $slug = strtolower(url_title($title));
            $model->update($id, [
                'title' => $title,
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'meta_description' => $this->request->getPost('meta_description'),
            ]);
            return redirect()->to('/admin/articles')->with('success', 'Artikel diperbarui');
        }
        return view('admin/articles/edit', ['title' => 'Edit Artikel', 'article' => $article]);
    }

    public function delete(int $id)
    {
        $this->ensureAuth();
        (new ArticleModel())->delete($id);
        return redirect()->to('/admin/articles')->with('success', 'Artikel dihapus');
    }

    protected function ensureAuth(): void
    {
        if (! session('admin_logged_in')) {
            redirect()->to('/admin/login')->send();
            exit;
        }
    }
}