<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleController\ArticleStoreRequest;
use App\Http\Requests\ArticleController\ArticleUpdateRequest;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
use App\Services\LogService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{
    public function __construct(
        private ArticleService $articleService,
        private LogService $logger
    ){}

    public function index(): AnonymousResourceCollection | JsonResponse
    {
        try{
            $articles = $this->articleService->getAll();
            return ArticleResource::collection($articles);
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
            return response()
                ->json([
                    'message' => 'Houve um erro interno no servidor, tente novamente mais tarde'
                ], 500);
        }
    }

    public function store(ArticleStoreRequest $request): ArticleResource | JsonResponse
    {
        try{
            $article = $this->articleService->save($request);

            return (new ArticleResource($article))
                ->additional([
                    'message' => 'Notícia criada com sucesso.'
                ]);
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
            return response()
                ->json([
                    'message' => 'Houve um erro interno no servidor, tente novamente mais tarde'
                ], 500);
        }
    }

    public function show(string $id): ArticleResource | JsonResponse
    {
        try{
            $article = $this->articleService->findById($id);
            return new ArticleResource($article);
        }catch(ModelNotFoundException){
            return response()
                ->json([
                    'message' => 'Nenhum registro encontrado.'
            ], 404);
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
            return response()
                ->json([
                    'message' => 'Houve um erro interno no servidor, tente novamente mais tarde'
                ], 500);
        }
    }

    public function update(ArticleUpdateRequest $request, string $id): JsonResponse
    {
        try{
            $article = $this->articleService->findById($id);

            Gate::authorize('update', $article);

            $updated = $this->articleService->update($article, $request);

            return response()
                ->json([
                    'message' => 'Noticia atualizada com sucesso.',
                    'data' => new ArticleResource($updated)
            ], 200);
        }catch(ModelNotFoundException){
            return response()
                ->json([
                    'message' => 'Nenhum registro encontrado'
                ], 404);
        }catch(AuthorizationException $e){
            return response()
                ->json([
                    'message' => 'Sem autorização para esta ação'
                ], 403);
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
            return response()
                ->json([
                    'message' => 'Houve um erro interno no servidor, tente novamente mais tarde'
                ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try{
            $article = $this->articleService->findById($id);
            Gate::authorize('delete', $article);

            $article->delete();

            return response()
                ->json([
                    'message' => 'Noticia apagada com sucesso.',
            ], 200);
        }catch(ModelNotFoundException){
            return response()
                ->json([
                    'message' => 'Nenhuma notícia encontrada'
                ], 404);
        }catch(AuthorizationException){
            return response()
                ->json([
                    'message' => 'Sem autorização para esta ação'
                ], 403);
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
            return response()
                ->json([
                    'message' => 'Houve um erro interno no servidor, tente novamente mais tarde'
                ], 500);
        }
    }
}
