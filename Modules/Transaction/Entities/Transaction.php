<?php

namespace Modules\Transaction\Entities;

use App\Models\User;
use Modules\Branch\Entities\Branch;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;

class Transaction extends Model
{

    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(Product::class,);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


}
