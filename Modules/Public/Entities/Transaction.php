<?php

namespace Modules\Public\Entities;

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
  
    protected $fillable = [
        'transaction_code',
        'user_id',
        'product_id',
        'branch_id',
        'amount',
        'payment_method',
        'customer_name',
        'customer_phone',
        'payment_status',
        'snap_token',
        'midtrans_transaction_id',
        'midtrans_payment_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
