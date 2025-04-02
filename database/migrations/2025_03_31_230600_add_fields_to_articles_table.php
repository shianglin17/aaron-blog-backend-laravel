<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('summary')->after('title')->nullable();
            $table->enum('category', ['tech', 'life', 'book-review'])->after('summary')->nullable();
            $table->string('cover_image')->after('category')->nullable();
            
            // 新增索引
            $table->index('title');
            $table->index('published_at');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['summary', 'category', 'cover_image']);
            
            // 移除索引
            $table->dropIndex(['title']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['status']);
        });
    }
};
