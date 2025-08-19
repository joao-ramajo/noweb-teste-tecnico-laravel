<?php

namespace App\Services;

use App\Models\Article;
use Exception;
use InvalidArgumentException;

class ArticleService
{
    public function getAll()
    {
        $articles = Article::with('user')->paginate(15);
        throw new InvalidArgumentException('erro');
        return $articles;
    }
}