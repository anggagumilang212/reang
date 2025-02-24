<?php

namespace Modules\MediaReview\Entities;

use Modules\Branch\Entities\Branch;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;


class ProductMediaReview extends Model
{

    use HasFactory;

    protected $table = 'product_media_reviews';
    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
