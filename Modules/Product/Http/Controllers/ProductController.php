<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Illuminate\Routing\Controller;
use Modules\Upload\Entities\Upload;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\DataTables\ProductDataTable;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public function index(ProductDataTable $dataTable)
    {
        abort_if(Gate::denies('access_products'), 403);

        return $dataTable->render('product::products.index');
    }


    public function create()
    {
        abort_if(Gate::denies('create_products'), 403);

        return view('product::products.create');
    }


    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->except('document', 'barcode_image'));

        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                try {
                    // Coba menambahkan media tanpa membaca Exif
                    $product->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                } catch (\Exception $e) {
                    // Skip jika terjadi error terkait Exif
                    // Kamu bisa juga menambahkan log error jika diperlukan
                    \Log::error('Error adding media: ' . $e->getMessage());
                    continue;
                }
            }
        }
        // Upload gambar barcode
        if ($request->hasFile('barcode_image')) {
            $product->addMedia($request->file('barcode_image'))->toMediaCollection('barcode');
        }

        toast('Product Created!', 'success');

        return redirect()->route('products.index');
    }


    public function show(Product $product)
    {
        abort_if(Gate::denies('show_products'), 403,);
        return view('product::products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        abort_if(Gate::denies('edit_products'), 403);

        return view('product::products.edit', compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->except('document'));

        if ($request->has('document')) {
            if (count($product->getMedia('images')) > 0) {
                foreach ($product->getMedia('images') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $product->getMedia('images')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    try {
                        // Coba menambahkan media tanpa membaca Exif
                        $product->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                    } catch (\Exception $e) {
                        // Skip jika terjadi error terkait Exif
                        // Kamu bisa juga menambahkan log error jika diperlukan
                        \Log::error('Error adding media: ' . $e->getMessage());
                        continue;
                    }
                }
            }
        }

        toast('Product Updated!', 'info');

        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {
        abort_if(Gate::denies('delete_products'), 403);

        $product->delete();

        toast('Product Deleted!', 'warning');

        return redirect()->route('products.index');
    }

    public function importForm()
    {
        return view('Product::products.import');
    }

    public function import(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'file' => 'required|mimes:xls,xlsx',
            'products_product_slug' => 'unique:products,product_slug',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        toast('Products Imported!', 'success');
        return redirect()->route('products.index');
    }
}
