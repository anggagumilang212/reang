<?php

namespace Modules\ClosingKasir\Entities;

use Modules\Branch\Entities\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;

class ClosingKasir extends Model
{

    use HasFactory;

    protected $table = 'closing_kasir';
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
