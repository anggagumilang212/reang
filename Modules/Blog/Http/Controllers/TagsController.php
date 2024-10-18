<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\DataTables\TagsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Tag;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(TagsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_tags'), 403);

        return $dataTable->render('blog::tags.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::tags.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('create_suppliers'), 403);

        $request->validate([
            'title' => 'required|string|max:25',
            'slug' => 'required|string|unique:tags,slug'
        ]);

        Tag::create([
            'title' => $request->title,
            'slug' => $request->slug,
        ]);

        toast('Tag Created!', 'success');

        return redirect()->route('tags.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function show($id)
    // {
    //     return view('blog::show');
    // }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Tag $tag)
    {
        abort_if(Gate::denies('edit_tags'), 403);

        return view('blog::tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Tag $tag)
    {
        abort_if(Gate::denies('edit_tags'), 403);

        $request->validate([
            'title' => 'required|string|max:25',
            'slug' => 'required|string|unique:tags,slug,' . $tag->id
        ]);

        $tag->update([
            'title' => $request->title,
            'slug' => $request->slug,
        ]);

        toast('Tag Updated!', 'info');

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Tag $tag)
    {
        abort_if(Gate::denies('delete_tags'), 403);

        $tag->delete();

        toast('Tag Deleted!', 'warning');

        return redirect()->route('tags.index');
    }
}
