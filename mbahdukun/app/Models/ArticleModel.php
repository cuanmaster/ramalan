<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'content', 'published_at', 'meta_description'];
    protected $useTimestamps = true;
}