<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PostCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $with = ['media'];

    protected $fillable = ['title', 'slug', 'thumbnail', 'description', 'parent_id'];

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function turunan()
    {
        return $this->children()->with('turunan');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'category_post', 'category_id', 'post_id');
    }

    // protected static function newFactory()
    // {
    //     return \Modules\Blog\Database\factories\PostCategoryFactory::new();
    // }
}
