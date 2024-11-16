<?php

namespace Modules\ProductStock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\ProductStock\Entities\ProductStock;
use Modules\Upload\Entities\Upload;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\ProductStock\DataTables\ProductStockDataTable;
use Modules\ProductStock\Http\Requests\StoreProductStockRequest;
use Modules\ProductStock\Http\Requests\UpdateProductStockRequest;

class ProductStockController extends Controller
{

    public function index(ProductStockDataTable $dataTable)
    {
        abort_if(Gate::denies('access_product_stock'), 403);
        $productstock = ProductStock::get();
        return $dataTable->render('Productstock::productstocks.index', compact('productstock'));
    }


    public function create()
    {
        abort_if(Gate::denies('access_product_stock'), 403);
        return view('Productstock::productstocks.create');
    }


    public function store(StoreProductStockRequest $request)
    {
        abort_if(Gate::denies('access_product_stock'), 403);

        Productstock::create($request->validated());

        toast('Productstock Created Successfully!', 'success');

        return redirect()->route('productstocks.index');
    }


    public function show(ProductStock $Productstock)
    {
        return view('Productstock::productstocks.show', compact('Productstock'));
    }


    public function edit(ProductStock $Productstock)
    {

        return view('Productstock::productstocks.edit', compact('Productstock'));
    }


    public function update(UpdateProductStockRequest $request, ProductStock $productstock)
    {
        try {
            DB::beginTransaction();

            // Update productstock details
            $productstock->update($request->validated());


            DB::commit();

            toast('Productstock Updated Successfully!', 'success');
            return redirect()->route('productstocks.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toast('Failed to update productstock. ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }




    public function destroy(ProductStock $Productstock)
    {

        $Productstock->delete();

        toast('Productstock Deleted!', 'warning');

        return redirect()->route('productstocks.index');
    }
}
