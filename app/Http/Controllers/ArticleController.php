<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * 顯示文章列表
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $articles = Article::query()
            ->when($request->status, fn($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate($request->per_page ?? 15);

        return ArticleResource::collection($articles);
    }

    /**
     * 儲存新文章
     */
    public function store(ArticleRequest $request): ArticleResource
    {
        $article = Article::create($request->validated());

        return new ArticleResource($article);
    }

    /**
     * 顯示指定文章
     */
    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    /**
     * 更新指定文章
     */
    public function update(ArticleRequest $request, Article $article): ArticleResource
    {
        $article->update($request->validated());

        return new ArticleResource($article);
    }

    /**
     * 刪除指定文章
     */
    public function destroy(Article $article): Response
    {
        $article->delete();

        return response()->noContent();
    }
} 