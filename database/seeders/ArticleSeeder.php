<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * 執行資料填充
     */
    public function run(): void
    {
        Article::create([
            'title' => '第一篇測試文章',
            'content' => '這是第一篇測試文章的內容。這是用來測試文章功能的示範文章。',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Article::create([
            'title' => '第二篇草稿文章',
            'content' => '這是一篇尚未發布的草稿文章。這篇文章正在編輯中。',
            'status' => 'draft',
        ]);

        Article::create([
            'title' => '第三篇已歸檔文章',
            'content' => '這是一篇已經歸檔的文章。這篇文章已經不再活躍顯示。',
            'status' => 'archived',
            'published_at' => now()->subDays(30),
        ]);
    }
} 