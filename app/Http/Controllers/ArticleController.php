<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleController\ArticleStoreRequest;
use App\Http\Requests\ArticleController\ArticleUpdateRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $articles = Article::with('user')->paginate(5);
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $article = Article::create([
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ArticleResource | JsonResponse
    {
        try{
            $article = Article::findOrFail($id);
            return new ArticleResource($article);
        }catch(ModelNotFoundException){
            return response()
                ->json([
                    'message' => 'Article not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $article = Article::findOrFail($id);

        $article->title = $request->input('title');
        $article->content = $request->input('content');

        $article->save();

        return response()
            ->json([
                'message' => 'Noticia atualizada com sucesso.',
                'data' => new ArticleResource($article)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
