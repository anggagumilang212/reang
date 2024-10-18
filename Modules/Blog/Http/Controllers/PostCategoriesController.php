<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\DataTables\PostCategoriesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Blog\Entities\PostCategory;
use Illuminate\Support\Facades\Storage;
use Modules\Blog\Http\Requests\StorePostCategoriesRequest;
use Modules\Blog\Http\Requests\UpdatePostCategoriesRequest;

class PostCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PostCategoriesDataTable $dataTable)
    {
        abort_if(Gate::denies('access_tags'), 403);

        return $dataTable->render('blog::categories.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('create_post_categories'), 403);

        $post_categories = [];
        if ($request->has('q')) {
            $search = $request->q;
            $post_categories = PostCategory::select('id', 'title')->where('title', 'LIKE', "%$search%")->limit(6)->get();
        } else {
            $post_categories = PostCategory::select('id', 'title')->onlyParent()->limit(6)->get();
        }

        return view('blog::categories.create', compact('post_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StorePostCategoriesRequest $request)
    {
        if ($request->has('parent_category')) {
            $parentCategory = PostCategory::select('id', 'title')->find($request->parent_category);
            $request['parent_id'] = optional($parentCategory)->id;
        }

        $postCategoryData = $request->except('document', 'parent_category');

        $post_category = PostCategory::create($postCategoryData);

        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                $post_category->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
            }
        }

        toast('Post Category Created!', 'success');

        return redirect()->route('post-categories.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(PostCategory $post_category)
    {
        abort_if(Gate::denies('show_post_categories'), 403);

        return view('blog::categories.show', compact('post_category'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, PostCategory $post_category)
    {
        abort_if(Gate::denies('edit_post_categories'), 403);

        $post_categories = [];
        if ($request->has('q')) {
            $search = $request->q;
            $post_categories = PostCategory::select('id', 'title')->where('title', 'LIKE', "%$search%")->limit(6)->get();
        } else {
            $post_categories = PostCategory::select('id', 'title')->onlyParent()->limit(6)->get();
        }

        return view('blog::categories.edit', compact('post_category', 'post_categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdatePostCategoriesRequest $request, PostCategory $post_category)
    {
        if ($request->has('parent_category')) {
            $parentCategory = PostCategory::select('id', 'title')->find($request->parent_category);
            $request['parent_id'] = optional($parentCategory)->id;
        }

        $postCategoryData = $request->except('document', 'parent_category');

        $post_category->update($postCategoryData);

        if ($request->has('document')) {
            if (count($post_category->getMedia('images')) > 0) {
                foreach ($post_category->getMedia('images') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $post_category->getMedia('images')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $post_category->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                }
            }
        }

        toast('Post Category Updated!', 'info');

        return redirect()->route('post-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(PostCategory $post_category)
    {
        abort_if(Gate::denies('delete_post_categories'), 403);

        $post_category->delete();

        toast('Post Category Deleted!', 'warning');

        return redirect()->route('post-categories.index');
    }
}
