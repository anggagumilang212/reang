<?php

namespace App\Livewire\Barcode;

use Mpdf\Mpdf;
use Livewire\Component;
use Modules\Product\Entities\Product;
use Milon\Barcode\Facades\DNS1DFacade;

class ProductTable extends Component
{
    public $selectedProducts = [];
    public $barcodes = [];
    public $quantities = [];

    protected $listeners = ['productSelected'];

    public function mount()
    {
        $this->selectedProducts = [];
        $this->barcodes = [];
        $this->quantities = [];
    }

    public function render()
    {
        return view('livewire.barcode.product-table');
    }

    public function productSelected(Product $product)
    {
        if (!$this->isProductSelected($product->id)) {
            $this->selectedProducts[] = $product;
            $this->quantities[] = 1;
        }
    }

    public function removeProduct($index)
    {
        unset($this->selectedProducts[$index]);
        unset($this->quantities[$index]);
        $this->selectedProducts = array_values($this->selectedProducts);
        $this->quantities = array_values($this->quantities);
    }

    public function isProductSelected($productId)
    {
        return collect($this->selectedProducts)->contains('id', $productId);
    }

    // public function generateBarcodes()
    // {
    //     $this->barcodes = [];

    //     foreach ($this->selectedProducts as $index => $product) {
    //         $quantity = $this->quantities[$index];

    //         if ($quantity > 100) {
    //             session()->flash('message', "Max quantity is 100 per barcode generation for product {$product->product_name}!");
    //             continue;
    //         }

    //         if (!is_numeric($product->product_code)) {
    //             session()->flash('message', "Can not generate Barcode with this type of Product Code for product {$product->product_name}");
    //             continue;
    //         }

    //         $productBarcodes = [];
    //         for ($i = 1; $i <= $quantity; $i++) {
    //             $barcode = DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology, 2, 60, 'black', false);
    //             array_push($productBarcodes, $barcode);
    //         }

    //         $this->barcodes[$product->id] = $productBarcodes;
    //     }
    // }

    // public function getPdf() {
    //     $barcodeData = [];
    //     foreach ($this->selectedProducts as $index => $product) {
    //         if (isset($this->barcodes[$product->id])) {
    //             foreach ($this->barcodes[$product->id] as $barcode) {
    //                 $barcodeData[] = [
    //                     'name' => $product->product_name,
    //                     'price' => $product->product_price,
    //                     'barcode' => $barcode
    //                 ];
    //             }
    //         }
    //     }

    //     $pdf = \PDF::loadView('product::barcode.print', [
    //         'barcodeData' => $barcodeData,
    //     ]);
    //     return $pdf->stream('barcodes-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    // }


    public function generateBarcodes() {
        $this->barcodes = [];

        foreach ($this->selectedProducts as $index => $product) {
            $quantity = $this->quantities[$index];

            if ($quantity > 100) {
                session()->flash('message', "Max quantity is 100 per barcode generation for product {$product->product_name}!");
                continue;
            }

            if (!is_numeric($product->product_code)) {
                session()->flash('message', "Can not generate Barcode with this type of Product Code for product {$product->product_name}");
                continue;
            }

            $productBarcodes = [];
            for ($i = 1; $i <= $quantity; $i++) {
                $barcodeSVG = DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology, 2, 60, 'black', false);

                // Convert SVG to Base64
                $base64Barcode = 'data:image/svg+xml;base64,' . base64_encode($barcodeSVG);
                array_push($productBarcodes, $base64Barcode);
            }

            $this->barcodes[$product->id] = $productBarcodes;
        }
    }



    public function getPdf()
    {
        $barcodeData = [];
        foreach ($this->selectedProducts as $index => $product) {
            if (isset($this->barcodes[$product->id])) {
                foreach ($this->barcodes[$product->id] as $barcode) {
                    $barcodeData[] = [
                        'name' => $product->product_name,
                        'price' => $product->product_price,
                        'barcode' => $barcode
                    ];
                }
            }
        }

        // Render Blade view menjadi HTML
        $html = view('product::barcode.print', [
            'barcodeData' => $barcodeData,
        ])->render();

        // Inisialisasi mPDF dan tambahkan HTML
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Simpan PDF ke dalam buffer dan kirim sebagai respons untuk di-download
        return response()->streamDownload(function () use ($mpdf) {
            echo $mpdf->Output('', 'S'); // 'S' untuk menyimpan PDF dalam string buffer
        }, 'barcodes-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }


    public function updatedQuantities()
    {
        $this->barcodes = [];
    }
}
