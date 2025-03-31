<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

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
    // 公開路由
    // 取得文章列表
    Route::get('/', [ArticleController::class, 'index'])
        ->name('api.articles.index');

    // 取得單一文章
    Route::get('/{article}', [ArticleController::class, 'show'])
        ->name('api.articles.show');

    // 需要管理員權限的路由
    Route::middleware(['auth:api', AdminMiddleware::class])->group(function () {
        // 創建文章
        Route::post('/', [ArticleController::class, 'store'])
            ->name('api.articles.store');

        // 更新文章
        Route::put('/{article}', [ArticleController::class, 'update'])
            ->name('api.articles.update');

        // 刪除文章
        Route::delete('/{article}', [ArticleController::class, 'destroy'])
            ->name('api.articles.destroy');
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

// 用戶管理相關 API
Route::middleware(['auth:api', AdminMiddleware::class])->group(function () {
    Route::put('users/{user}/admin-status', [UserController::class, 'updateAdminStatus'])
        ->name('api.users.update-admin-status');
});
