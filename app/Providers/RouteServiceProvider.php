<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * API 控制器的命名空間
     */
    protected $apiNamespace = 'App\\Http\\Controllers';

    /**
     * 定義你的路由模型綁定、模式過濾器等。
     */
    public function boot(): void
    {
        // API 請求速率限制：每分鐘 60 次
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // API 路由
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Web 路由
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
} 