<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\DataTables\PostsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Tag;
use Modules\Blog\Entities\Post;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Blog\Entities\PostCategory;
use Modules\Blog\Http\Requests\StorePostsRequest;
use Modules\Blog\Http\Requests\UpdatePostsRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PostsDataTable $dataTable, Request $request)
    {
        abort_if(Gate::denies('access_posts'), 403);

        $statusSelected = in_array($request->get('status'), ['publish', 'draft']) ? $request->get('status') : "publish";
        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();

        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }

        $posts = $posts->get();

        $statuses = $this->statuses();

        return $dataTable->with([
            'posts' => $posts,
            'statuses' => $statuses,
            'statusSelected' => $statusSelected
        ])->render('blog::posts.index', compact('statuses', 'statusSelected'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('create_posts'), 403);

        $tags = [];
        if ($request->has('q')) {
            $tags = Tag::select('id', 'title')->search($request->q)->get();
        } else {
            $tags = Tag::select('id', 'title')->limit(5)->get();
        }

        $statuses = $this->statuses();

        $categories = PostCategory::with('turunan')->onlyParent()->get();

        return view('blog::posts.create', compact('tags', 'categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StorePostsRequest $request)
    {
        if ($request->has('tags')) {
            $tagIds = Tag::whereIn('id', $request->tags)->pluck('id');
            $request['tags'] = $tagIds;
        }

        $user = Auth::user();
        $postData = $request->except('document', 'tags');
        $postData['user_id'] = $user->id;
        $postData['tags'] = $request['tags'];

        $post = Post::create($postData);

        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                try {
                    // Tambahkan media tanpa membaca Exif
                    $post->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                } catch (\Exception $e) {
                    // Skip jika error Exif muncul, log error jika perlu
                    \Log::error('Error adding media: ' . $e->getMessage());
                    continue;
                }
            }
        }

        if ($post && $request->has('tags')) {
            $post->tags()->attach($request['tags']);
        }

        if ($request->has('category')) {
            $post->categories()->attach($request->category);
        }

        toast('Post Created!', 'success');

        return redirect()->route('posts.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Post $post)
    {
        abort_if(Gate::denies('show_posts'), 403);

        $categories = $post->categories;
        $tags = $post->tags;

        return view('blog::posts.show', compact('post', 'tags', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Post $post)
    {
        abort_if(Gate::denies('edit_posts'), 403);

        $tags = [];
        if ($request->has('q')) {
            $tags = Tag::select('id', 'title')->search($request->q)->get();
        } else {
            $tags = Tag::select('id', 'title')->limit(5)->get();
        }

        $statuses = $this->statuses();

        $categories = PostCategory::with('turunan')->onlyParent()->get();

        return view('blog::posts.edit', compact('post', 'tags', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        if ($request->has('tags')) {
            $tagIds = Tag::whereIn('id', $request->tags)->pluck('id');
            $postData['tags'] = $tagIds;
        }

        $user = Auth::user();
        $postData = $request->except('document', 'tags');
        $postData['user_id'] = $user->id;
        $postData['tags'] = $request['tags'];

        $post->update($postData);

        if ($request->has('document')) {
            if (count($post->getMedia('images')) > 0) {
                foreach ($post->getMedia('images') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $post->getMedia('images')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    try {
                        // Tambahkan media tanpa membaca Exif
                        $post->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                    } catch (\Exception $e) {
                        // Skip jika error Exif muncul, log error jika perlu
                        \Log::error('Error adding media: ' . $e->getMessage());
                        continue;
                    }
                }
            }
        }

        if ($post && $request->has('tags')) {
            $post->tags()->sync($request['tags']);
        }

        if ($request->has('category')) {
            $post->categories()->sync($request->category);
        }

        toast('Post Updated!', 'info');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Post $post)
    {
        abort_if(Gate::denies('delete_posts'), 403);

        $post->delete();

        toast('Post Deleted!', 'warning');

        return redirect()->route('posts.index');
    }

    public function statuses()
    {
        return [
            'publish' => trans('Publish'),
            'draft' => trans('Draft'),
        ];
    }
}
