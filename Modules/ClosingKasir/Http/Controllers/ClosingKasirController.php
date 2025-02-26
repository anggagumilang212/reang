<?php

namespace Modules\ClosingKasir\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Sale\Entities\Sale;
use Modules\Branch\Entities\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Expense\Entities\Expense;
use Modules\ClosingKasir\Entities\ClosingKasir;
use Modules\ClosingKasir\DataTables\ClosingKasirDataTable;

class ClosingKasirController extends Controller
{
    public function index(ClosingKasirDataTable $dataTable)
    {
        $closings = ClosingKasir::orderBy('tanggal', 'desc')->get();
        return $dataTable->render('ClosingKasir::closingkasirs.index', compact('closings'));
    }


    public function create()
    {
        $branches = Branch::all();
        return view('ClosingKasir::closingkasirs.create', compact('branches'));
    }

    public function show($tanggal)
    {
        // Ambil data closing kasir berdasarkan tanggal
        $closing = ClosingKasir::where('tanggal', $tanggal)->firstOrFail();

        // Ambil daftar item penjualan pada tanggal tersebut dan sesuai branch
        $penjualan_items = Sale::whereDate('created_at', $tanggal)
            ->where('branch_id', $closing->branch_id) // Filter berdasarkan branch
            ->with('saleDetails') // Pastikan ada relasi dengan tabel detail penjualan
            ->get();

        // Ambil daftar pengeluaran pada tanggal tersebut dan sesuai branch
        $pengeluaran_items = Expense::whereDate('created_at', $tanggal)
            ->where('branch_id', $closing->branch_id) // Filter berdasarkan branch
            ->get();

        return view('ClosingKasir::closingkasirs.show', compact('closing', 'penjualan_items', 'pengeluaran_items'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'tanggal' => 'required',
        ]);

        // Ambil branch_id dari request
        $branch_id = $request->branch_id;

        // Hitung total penjualan hanya dari cabang tertentu
        $total_penjualan = Sale::with('saleDetails')
            ->whereDate('created_at', $request->tanggal)
            ->where('branch_id', $branch_id)
            ->get()
            ->sum(function ($sale) {
                return $sale->saleDetails->sum('sub_total');
            });

        // Hitung total pengeluaran hanya dari cabang tertentu
        $total_pengeluaran = Expense::whereDate('created_at', $request->tanggal)
            ->where('branch_id', $branch_id)
            ->sum('amount');

        // Hitung total setoran
        $total_setoran = ($total_penjualan - $total_pengeluaran) + $request->selisih_manual;

        // Simpan closing kasir
        ClosingKasir::create([
            'branch_id' => $branch_id,
            'tanggal' => $request->tanggal,
            'total_penjualan' => $total_penjualan,
            'total_pengeluaran' => $total_pengeluaran,
            'selisih_manual' => $request->selisih_manual ?? 0,
            'total_setoran' => $total_setoran,
        ]);

        toast('Closing kasir berhasil disimpan!', 'success');
        return redirect()->route('closingkasir.index');
    }

    public function destroy(ClosingKasir $closingkasir)
    {
        $closingkasir->delete();
        toast('Closing kasir berhasil dihapus!', 'warning');
        return redirect()->route('closingkasir.index');
    }
}
