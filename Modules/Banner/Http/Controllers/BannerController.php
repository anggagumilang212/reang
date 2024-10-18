<?php

namespace Modules\Banner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Banner\Entities\Banner;
use Modules\Upload\Entities\Upload;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Banner\DataTables\BannerDataTable;
use Modules\Banner\Http\Requests\StoreBannerRequest;
use Modules\Banner\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{

    public function index(BannerDataTable $dataTable)
    {
        abort_if(Gate::denies('access_banners'), 403);

        $banner = Banner::get();
        return $dataTable->render('Banner::banners.index', compact('banner'));
    }


    public function create()
    {
        abort_if(Gate::denies('create_banners'), 403);

        return view('Banner::banners.create');
    }


    public function store(StoreBannerRequest $request)
    {
        // Create new banner record
        $banner = Banner::create($request->validated());

        // Handle document (media files)
        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                $tempPath = Storage::path('temp/dropzone/' . $file);
                if (file_exists($tempPath)) {
                    try {
                        // Tambahkan media ke koleksi tanpa menghentikan proses jika ada error Exif
                        $banner->addMedia($tempPath)
                               ->toMediaCollection('banner');
                    } catch (\Exception $e) {
                        // Skip error Exif, dan log jika perlu
                        \Log::error('Error adding media for banner: ' . $e->getMessage());
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

        // Show success notification
        toast('Banner Created Successfully!', 'success');

        // Redirect to banners index
        return redirect()->route('banners.index');
    }



    public function show(Banner $Banner)
    {
        abort_if(Gate::denies('show_banners'), 403);

        return view('Banner::banners.show', compact('Banner'));
    }


    public function edit(Banner $Banner)
    {
        abort_if(Gate::denies('edit_banners'), 403);

        return view('Banner::banners.edit', compact('Banner'));
    }


    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        try {
            DB::beginTransaction();

            // Update banner details
            $banner->update($request->validated());

            // Handle media updates
            if ($request->has('document')) {
                $this->updateBannerMedia($banner, $request->input('document', []));
            }

            DB::commit();

            toast('Banner Updated Successfully!', 'success');
            return redirect()->route('banners.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toast('Failed to update banner. ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    private function updateBannerMedia(Banner $banner, array $newDocuments)
    {
        // Get existing media filenames
        $existingMedia = $banner->getMedia('banner')->pluck('file_name')->toArray();

        // Remove media not in the new documents list
        foreach ($banner->getMedia('banner') as $media) {
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
                            $banner->addMedia($tempPath)
                           ->toMediaCollection('banner');
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


    public function destroy(Banner $Banner)
    {
        abort_if(Gate::denies('delete_banners'), 403);

        $Banner->delete();

        toast('Banner Deleted!', 'warning');

        return redirect()->route('banners.index');
    }
}
