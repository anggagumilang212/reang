<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Transaction\Entities\Transaction;
use Modules\Upload\Entities\Upload;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Transaction\DataTables\TransactionDataTable;
use Modules\Transaction\Http\Requests\StoreTransactionRequest;
use Modules\Transaction\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{

    public function index(TransactionDataTable $dataTable)
    {
        abort_if(Gate::denies('access_transactions'), 403);

        $transaction = Transaction::get();
        return $dataTable->render('Transaction::transactions.index', compact('transaction'));
    }


    public function create()
    {
        abort_if(Gate::denies('create_transactions'), 403);

        return view('Transaction::transactions.create');
    }


    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());

        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                $tempPath = Storage::path('temp/dropzone/' . $file);
                if (file_exists($tempPath)) {
                    try {
                        // Tambahkan media ke koleksi tanpa menghentikan proses jika ada error Exif
                        $transaction->addMedia($tempPath)
                                  ->toMediaCollection('transaction');
                    } catch (\Exception $e) {
                        // Skip error Exif, dan log jika perlu
                        \Log::error('Error adding media for transaction: ' . $e->getMessage());
                        continue;
                    }
                }
            }
        }

        // Cleanup temporary files
        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                Storage::delete('temp/dropzone/' . $file);
            }
        }

        toast('Transaction Created Successfully!', 'success');

        return redirect()->route('transactions.index');
    }


    public function show(Transaction $Transaction)
    {
        abort_if(Gate::denies('show_transactions'), 403);

        return view('Transaction::transactions.show', compact('Transaction'));
    }


    public function edit(Transaction $Transaction)
    {
        abort_if(Gate::denies('edit_transactions'), 403);

        return view('Transaction::transactions.edit', compact('Transaction'));
    }


    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        try {
            DB::beginTransaction();

            // Update transaction details
            $transaction->update($request->validated());

            // Handle media updates
            if ($request->has('document')) {
                $this->updateTransactionMedia($transaction, $request->input('document', []));
            }

            DB::commit();

            toast('Transaction Updated Successfully!', 'success');
            return redirect()->route('transactions.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toast('Failed to update transaction. ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    private function updateTransactionMedia(Transaction $transaction, array $newDocuments)
    {
        // Get existing media filenames
        $existingMedia = $transaction->getMedia('transaction')->pluck('file_name')->toArray();

        // Remove media not in the new documents list
        foreach ($transaction->getMedia('transaction') as $media) {
            if (!in_array($media->file_name, $newDocuments)) {
                $media->delete();
            }
        }

        // Add new media
        foreach ($newDocuments as $document) {
            if (!in_array($document, $existingMedia)) {
                $tempPath = Storage::path('temp/dropzone/' . $document);
                if (file_exists($tempPath)) {
                    try {
                        // Tambahkan media ke koleksi tanpa menghentikan proses jika ada error Exif
                        $transaction->addMedia($tempPath)
                                  ->toMediaCollection('transaction');
                    } catch (\Exception $e) {
                        // Skip error Exif, dan log jika perlu
                        \Log::error('Error adding media for transaction: ' . $e->getMessage());
                        continue;
                    }
                    // Cleanup temp file
                    Storage::delete('temp/dropzone/' . $document);
                }
            }
        }
    }


    public function destroy(Transaction $Transaction)
    {
        abort_if(Gate::denies('delete_transactions'), 403);

        $Transaction->delete();

        toast('Transaction Deleted!', 'warning');

        return redirect()->route('transactions.index');
    }
}
