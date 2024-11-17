<?php

namespace Modules\MediaReview\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Facades\FFMpeg;

class MediaReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('access_media_reviews'), 403);

        $mediaReviews = Product::with('mediaReviews')->get();
        return view('mediareview::index', compact('mediaReviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('MediaReview::mediareviews/create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'media' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi',
    //         'type' => 'required|in:image,video',
    //     ]);

    //     $product = Product::findOrFail($request->product_id);

    //     // Upload media
    //     $media = $request->file('media');
    //     $mediaPath = $media->store('product-reviews', 'public');

    //     // Create thumbnail if video
    //     $thumbnailPath = null;
    //     if ($request->type === 'video') {
    //         $thumbnailPath = 'product-reviews/thumbnails/' . time() . '.jpg';

    //         FFMpeg::fromDisk('public')
    //             ->open($mediaPath)
    //             ->getFrameFromSeconds(1)
    //             ->export()
    //             ->toDisk('public')
    //             ->save($thumbnailPath);
    //     }

    //     // Save to media reviews
    //     $product->mediaReviews()->create([
    //         'type' => $request->type,
    //         'media_path' => $mediaPath,
    //         'thumbnail_path' => $thumbnailPath,
    //         'order' => $product->mediaReviews()->count() + 1
    //     ]);

    //     return redirect()
    //         ->route('mediareview.index')
    //         ->with('success', 'Media review successfully created');
    // }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
             'media' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:102400',
            'type' => 'required|in:image,video',
        ]);

        $product = Product::findOrFail($request->product_id);

        try {
            // Upload media
            $media = $request->file('media');
            $extension = $media->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;

            // Tentukan folder berdasarkan tipe file
            $folder = $request->type === 'video' ? 'videos' : 'images';
            $mediaPath = $media->storeAs("product-reviews/{$folder}", $fileName, 'public');

            // Jika tipe video, generate thumbnail menggunakan GD Library
            $thumbnailPath = null;
            if ($request->type === 'video') {
                // Simpan thumbnail dengan nama yang sama tapi dalam folder thumbnail
                $thumbnailFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.jpg';
                $thumbnailPath = "product-reviews/thumbnails/{$thumbnailFileName}";

                // Gunakan default thumbnail atau biarkan null
                // Atau bisa gunakan gambar placeholder
                Storage::disk('public')->put($thumbnailPath, file_get_contents(public_path('images/video-placeholder.jpg')));
            }

            // Jika tipe gambar, buat thumbnail
            if ($request->type === 'image') {
                $image = Image::make($media);

                // Resize gambar jika terlalu besar
                if ($image->width() > 1200) {
                    $image->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // Compress gambar
                $image->save(storage_path("app/public/{$mediaPath}"), 80);

                // Buat thumbnail
                $thumbnailFileName = pathinfo($fileName, PATHINFO_FILENAME) . '_thumb.jpg';
                $thumbnailPath = "product-reviews/thumbnails/{$thumbnailFileName}";

                $thumbnail = Image::make($media);
                $thumbnail->fit(300, 300, function ($constraint) {
                    $constraint->upsize();
                });
                $thumbnail->save(storage_path("app/public/{$thumbnailPath}"), 80);
            }

            // Save to media reviews
            $product->mediaReviews()->create([
                'type' => $request->type,
                'media_path' => $mediaPath,
                'thumbnail_path' => $thumbnailPath,
                'order' => $product->mediaReviews()->count() + 1
            ]);

            return redirect()
                ->route('mediareview.index')
                ->with('success', 'Media review successfully created');
        } catch (\Exception $e) {
            // Hapus file yang sudah terupload jika ada error
            if (isset($mediaPath)) {
                Storage::disk('public')->delete($mediaPath);
            }
            if (isset($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to upload media: ' . $e->getMessage());
        }
    }

    // ... rest of your controller methods ...
}
