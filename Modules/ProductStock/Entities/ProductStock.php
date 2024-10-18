<?php

namespace Modules\ProductStock\Entities;

use Modules\Branch\Entities\Branch;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;


class ProductStock extends Model
{

    use HasFactory;

    protected $table = 'productstock';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
