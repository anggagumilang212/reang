<?php

namespace Modules\Public\Entities;

use App\Models\User;
use Modules\Branch\Entities\Branch;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;


class FlashSale extends Model
{

    use HasFactory;

    protected $table = 'flash_sales';

    protected $fillable = [
        'product_id',
        'start_time',
        'end_time',
        'flash_sale_price',
        'normal_price',
        'stock',
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
