<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * 可批量賦值的屬性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'summary',
        'content',
        'category',
        'cover_image',
        'status',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 屬性的預設值
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'draft',
    ];

    /**
     * 取得文章的標籤
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
} 