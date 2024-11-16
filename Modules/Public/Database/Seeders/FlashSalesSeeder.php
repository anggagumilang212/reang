<?php

namespace Modules\Public\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Public\Entities\FlashSale;

class FlashSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        FlashSale::create([
            'product_id' => 10,
            'start_time' => now()->setHour(11)->setMinute(30)->setSecond(0),
            'end_time' => now()->setHour(12)->setMinute(0)->setSecond(0),
            'flash_sale_price' => 0,
            'normal_price' => 3000,
            'stock' => 1,
            'status' => 'active'
        ]);
    }
}
