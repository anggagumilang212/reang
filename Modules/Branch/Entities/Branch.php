<?php

namespace Modules\Branch\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\ProductStock\Entities\ProductStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;

class Branch extends Model
{

    use HasFactory;

    protected $table = 'branch';
    protected $guarded = [];

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
}
