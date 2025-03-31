<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Base URL: http://localhost:8000/api
|
| 所有需要認證的 API 都需要在 Header 中加入 Bearer Token：
| Authorization: Bearer <token>
|
*/

// 文章相關 API
Route::prefix('articles')->group(function () {
    // 取得文章列表
    // GET /api/articles
    Route::get('/', [ArticleController::class, 'index'])
        ->name('api.articles.index');

    // 取得單一文章
    // GET /api/articles/{id}
    Route::get('/{article}', [ArticleController::class, 'show'])
        ->name('api.articles.show');

    // 創建文章
    // POST /api/articles
    Route::post('/', [ArticleController::class, 'store'])
        ->name('api.articles.store');

    // 更新文章
    // PUT /api/articles/{id}
    Route::put('/{article}', [ArticleController::class, 'update'])
        ->name('api.articles.update');

    // 刪除文章
    // DELETE /api/articles/{id}
    Route::delete('/{article}', [ArticleController::class, 'destroy'])
        ->name('api.articles.destroy');
});
