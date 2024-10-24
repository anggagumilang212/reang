<?php

namespace Modules\Product\Entities;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\ProductStock\Entities\ProductStock;
use Modules\MediaReview\Entities\ProductMediaReview;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $with = ['media'];

    public function productStock()
    {
        return $this->hasOne(ProductStock::class);
    }


    public function stocks()
    {
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function mediaReviews()
    {
        return $this->hasMany(ProductMediaReview::class)->orderBy('order');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useFallbackUrl('/images/fallback_product_image.png');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50);
    }

    public function setProductCostAttribute($value)
    {
        $this->attributes['product_cost'] = ($value * 100);
    }

    public function getProductCostAttribute($value)
    {
        return ($value / 100);
    }

    public function setProductPriceAttribute($value)
    {
        $this->attributes['product_price'] = ($value * 100);
    }

    public function getProductPriceAttribute($value)
    {
        return ($value / 100);
    }

    public function scopeSearch($query, $product_name)
    {
        return $query->where('product_name', 'LIKE', "%{$product_name}%");
    }
}
