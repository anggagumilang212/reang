<?php

namespace Modules\Public\Http\Controllers;

use Midtrans\Snap;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Tag;
use Modules\Blog\Entities\Post;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;
use Modules\Blog\Entities\PostCategory;
use Modules\Testimoni\Entities\Testimoni;
use Illuminate\Contracts\Support\Renderable;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function home()
    {
        $posts = Post::latest()->where('status', 'publish')->take(3)->get();
        $products = Product::latest()->paginate(4);
        $testimoni = Testimoni::all();
        return view('public::beranda', compact('posts', 'products', 'testimoni'));
    }

    public function token(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $snapToken = Snap::getSnapToken($product->product_price);
        return view('public::token', compact('snapToken'));
    }

    public function detailProduct(Product $product)
    {
        $mediaReviews = $product->mediaReviews()
        ->where('is_active', true)
        ->get()
        ->map(function($media) {
            return [
                'type' => $media->type,
                'src' => asset('storage/' . $media->media_path),
               'thumbnail' => $media->thumbnail_path ? asset('storage/' . $media->thumbnail_path) : null,
            ];
        });
        return view('public::productDetail', compact('product', 'mediaReviews'));
    }
    public function BlogDetail($slug)
    {
        $blog = Post::where('slug', $slug)->first();
        $lainnya = Post::where('status', 'publish')->where('id', '!=', $blog->id)->take(5)->get();
        // increment views_count
        $blog->increment('views_count');
        return view('public::blogDetail', compact('blog', 'lainnya'));
    }

    public function blog(Request $request)
    {
        $popularPosts = Post::orderBy('views_count', 'desc')->take(2)->get();

        // Mengambil kategori
        $post_categories = PostCategory::all();

        // Memulai query builder untuk post
        $posts = Post::query();

        // Filter berdasarkan kategori jika kategori dipilih
        $categorySelected = $request->get('category');
        if ($categorySelected) {
            $posts->whereExists(function ($query) use ($categorySelected) {
                $query->select(DB::raw(1))
                    ->from('post_categories') // Berikan alias pada tabel post_categories
                    ->join('category_post', 'post_categories.id', '=', 'category_post.category_id')
                    ->whereRaw('posts.id = category_post.post_id')
                    ->where('post_categories.slug', $categorySelected);
            });
        }

        // Filter berdasarkan kata kunci jika ada
        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }

        // Menambahkan klausa orderBy untuk mengurutkan berdasarkan waktu (created_at atau updated_at)
        $posts->orderBy('created_at', 'desc');

        // Ambil data untuk dropdown kategori
        return view('public::blog', [
            'posts'           => $posts->where('status', 'publish')->paginate(5)->withQueryString(),
            'post_categories' => $post_categories,
            'categorySelected' => $categorySelected,
            'popularPosts' => $popularPosts->where('status', 'publish')
        ]);
    }

    // product page
public function ProductPage()
{
    $products = Product::latest()->get();
    $categories = Category::all();
    return view('public::product', compact('products', 'categories'));
}

public function search(Request $request)
{
    $query = $request->input('query');
    $categories = $request->input('categories', []);

    $products = Product::query()
        ->when($query, function($q) use ($query) {
            return $q->where('product_name', 'like', "%{$query}%")
                    ->orWhere('product_note', 'like', "%{$query}%");
        })
        ->when($categories, function($q) use ($categories) {
            return $q->whereIn('category_id', $categories);
        })
        ->latest()
        ->get();

    return response()->json([
        'products' => $products->map(function($product) {
            return [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'product_price' => $product->product_price,
                'product_note' => $product->product_note,
                'image' => $product->getFirstMediaUrl('images')
            ];
        })
    ]);
}

    public function detailBlog(Post $post)
    {
        $popularPosts = Post::orderBy('views_count', 'desc')->take(2)->get();

        // Tambahkan satu ke views_count
        $post->increment('views_count');

        // Pastikan perubahan disimpan ke dalam database
        $post->save();

        $post_categories = PostCategory::with('turunan')->paginate(10);
        $categories = $post->categories;
        $tags = $post->tags;

        return view('public::detail-blog', compact('post', 'categories', 'tags', 'post_categories', 'popularPosts'));
    }

    public function store(Request $request)
    {
        $sortOptions = ['newest', 'price_low', 'price_high'];
        $sort = in_array($request->input('sort'), $sortOptions) ? $request->input('sort') : 'all';

        $products = Product::query();

        if ($request->get('keyword')) {
            $products->search($request->get('keyword'));
        }

        switch ($sort) {
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            case 'price_low':
                $products->orderBy('product_price', 'asc');
                break;
            case 'price_high':
                $products->orderBy('product_price', 'desc');
                break;
            default:
        }

        return view('public::store', ['products' => $products->paginate(20)->withQueryString()]);
    }

    public function detailStore(Product $product)
    {
        $categories = $product->category;

        return view('public::detail-product', ['product' => $product, 'categories' => $categories]);
    }

    public function about()
    {
        return view('public::about');
    }
}
