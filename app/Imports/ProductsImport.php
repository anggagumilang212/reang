<?php

namespace App\Imports;


use Illuminate\Support\Str;
use Modules\Product\Entities\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'category_id' => $row['category_id'],
            'product_name' => $row['product_name'],
            'product_slug' => Str::slug($row['product_name'], '-'),
            'product_code' => $row['product_code'],
            'product_barcode_symbology' => $row['product_barcode_symbology'],
            'product_cost' => $row['product_cost'],
            'product_price' => $row['product_price'],
            'product_unit' => $row['product_unit'],
        ]);
    }
}
