<?php

namespace Modules\Testimoni\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Testimoni\Entities\Testimoni;
use Modules\Upload\Entities\Upload;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Testimoni\DataTables\TestimoniDataTable;
use Modules\Testimoni\Http\Requests\StoreTestimoniRequest;
use Modules\Testimoni\Http\Requests\UpdateTestimoniRequest;

class TestimoniController extends Controller
{

    public function index(TestimoniDataTable $dataTable)
    {
        abort_if(Gate::denies('access_testimonis'), 403);

        $testimoni = Testimoni::get();
        return $dataTable->render('Testimoni::testimonis.index', compact('testimoni'));
    }


    public function create()
    {
        abort_if(Gate::denies('create_testimonis'), 403);

        return view('Testimoni::testimonis.create');
    }


    public function store(StoreTestimoniRequest $request)
    {
        $testimoni = Testimoni::create($request->validated());

        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                $tempPath = Storage::path('temp/dropzone/' . $file);
                if (file_exists($tempPath)) {
                    try {
                        // Tambahkan media ke koleksi tanpa menghentikan proses jika ada error Exif
                        $testimoni->addMedia($tempPath)
                                  ->toMediaCollection('testimoni');
                    } catch (\Exception $e) {
                        // Skip error Exif, dan log jika perlu
                        \Log::error('Error adding media for testimoni: ' . $e->getMessage());
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

        toast('Testimoni Created Successfully!', 'success');

        return redirect()->route('testimonis.index');
    }


    public function show(Testimoni $Testimoni)
    {
        abort_if(Gate::denies('show_testimonis'), 403);

        return view('Testimoni::testimonis.show', compact('Testimoni'));
    }


    public function edit(Testimoni $Testimoni)
    {
        abort_if(Gate::denies('edit_testimonis'), 403);

        return view('Testimoni::testimonis.edit', compact('Testimoni'));
    }


    public function update(UpdateTestimoniRequest $request, Testimoni $testimoni)
    {
        try {
            DB::beginTransaction();

            // Update testimoni details
            $testimoni->update($request->validated());

            // Handle media updates
            if ($request->has('document')) {
                $this->updateTestimoniMedia($testimoni, $request->input('document', []));
            }

            DB::commit();

            toast('Testimoni Updated Successfully!', 'success');
            return redirect()->route('testimonis.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toast('Failed to update testimoni. ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    private function updateTestimoniMedia(Testimoni $testimoni, array $newDocuments)
    {
        // Get existing media filenames
        $existingMedia = $testimoni->getMedia('testimoni')->pluck('file_name')->toArray();

        // Remove media not in the new documents list
        foreach ($testimoni->getMedia('testimoni') as $media) {
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
                        $testimoni->addMedia($tempPath)
                                  ->toMediaCollection('testimoni');
                    } catch (\Exception $e) {
                        // Skip error Exif, dan log jika perlu
                        \Log::error('Error adding media for testimoni: ' . $e->getMessage());
                        continue;
                    }
                    // Cleanup temp file
                    Storage::delete('temp/dropzone/' . $document);
                }
            }
        }
    }


    public function destroy(Testimoni $Testimoni)
    {
        abort_if(Gate::denies('delete_testimonis'), 403);

        $Testimoni->delete();

        toast('Testimoni Deleted!', 'warning');

        return redirect()->route('testimonis.index');
    }
}
