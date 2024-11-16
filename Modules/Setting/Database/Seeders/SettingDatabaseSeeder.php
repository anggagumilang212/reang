<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'company_name' => 'ReangNET Corporation',
            'company_email' => 'info@reang.net',
            'company_phone' => '087828496000',
            'notification_email' => 'notification@reang.net',
            'default_currency_id' => 1,
            'default_currency_position' => 'prefix',
            'footer_text' => 'ReangNET © 2025 || Developed with by <i class="bi bi-heart"></i>',
            'company_address' => 'Indramayu, Indonesia'
        ]);
    }
}
