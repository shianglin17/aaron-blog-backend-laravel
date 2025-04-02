<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleAndTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 建立標籤
        $tags = Tag::factory(10)->create();

        // 建立文章
        Article::factory(20)->create()->each(function ($article) use ($tags) {
            // 每篇文章隨機配置 1-3 個標籤
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // 建立一些草稿文章
        Article::factory(5)->draft()->create()->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // 建立一些已發布文章
        Article::factory(5)->published()->create()->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
