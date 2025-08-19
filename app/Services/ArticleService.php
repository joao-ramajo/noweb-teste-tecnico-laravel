<?php

namespace App\Services;

use App\Http\Requests\ArticleController\ArticleStoreRequest;
use App\Http\Requests\ArticleController\ArticleUpdateRequest;
use App\Models\Article;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class ArticleService
{
    public function getAll()
    {
        $articles = Article::with('user')->paginate(15);
        throw new InvalidArgumentException('erro');
        return $articles;
    }

    public function save(ArticleStoreRequest $request): Article
    {
        $article = Article::create([
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return $article;
    }

    public function findById(string $id): Article
    {
        $article = Article::findOrFail($id);

        return $article;
    }

    public function update(Article $article, ArticleUpdateRequest $request): Article
    {
        $article->title = $request->input('title');
        $article->content = $request->input('content');

        $article->save();

        return $article;
    }


}