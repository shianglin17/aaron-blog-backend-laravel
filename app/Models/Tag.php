<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    /**
     * 可批量賦值的屬性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * 取得有此標籤的文章
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_tags');
    }
}
