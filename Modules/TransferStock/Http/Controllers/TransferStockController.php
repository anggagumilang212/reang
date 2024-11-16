<?php

namespace Modules\TransferStock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Branch\Entities\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Modules\Product\Entities\Product;

use Modules\ProductStock\Entities\ProductStock;
use Modules\TransferStock\Entities\TransferStock;
use Modules\TransferStock\DataTables\TransferstockDataTable;

class TransferStockController extends Controller
{
    public function index(TransferstockDataTable $dataTable)
    {
        abort_if(Gate::denies('access_transfer_stock'), 403);
        $transfers = TransferStock::with(['fromBranch', 'toBranch', 'product'])
            ->latest()
            ->paginate(10);
        return $dataTable->render('transferstock::transfers.index', compact('transfers'));
    }


    public function create()
    {
        $branches = Branch::all();
        $products = Product::all();

        return view('transferstock::transfers.create', compact('branches', 'products'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'from_branch_id' => 'required|exists:branch,id',
            'to_branch_id' => 'required|exists:branch,id|different:from_branch_id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::transaction(function() use ($request) {
                $fromStock = ProductStock::where([
                    'branch_id' => $request->from_branch_id,
                    'product_id' => $request->product_id
                ])->first();

                if (!$fromStock || $fromStock->quantity < $request->quantity) {
                    throw new \Exception('Insufficient stock');
                }

                // Reduce stock from source branch
                $fromStock->decrement('quantity', $request->quantity);

                // Add stock to destination branch
                ProductStock::updateOrCreate(
                    [
                        'branch_id' => $request->to_branch_id,
                        'product_id' => $request->product_id
                    ],
                    [
                        'quantity' => DB::raw("quantity + {$request->quantity}")
                    ]
                );

                // Create transfer record
                TransferStock::create([
                    'reference' => 'TRF-' . date('YmdHis'),
                    'from_branch_id' => $request->from_branch_id,
                    'to_branch_id' => $request->to_branch_id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'notes' => $request->notes,
                    'status' => 'Completed'
                ]);
            });

            return redirect()
                ->route('transfer.index')
                ->with('success', 'Stock transfer completed successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function show(TransferStock $transfer)
    {
        $transfer->load(['fromBranch', 'toBranch', 'product']);
        return view('transferstock::transfers.show', compact('transfer'));
    }

    public function checkStock($productId, $branchId)
    {
        $stock = ProductStock::where([
            'product_id' => $productId,
            'branch_id' => $branchId
        ])->first();

        return response()->json([
            'stock_quantity' => $stock ? $stock->quantity : 0
        ]);
    }
}
