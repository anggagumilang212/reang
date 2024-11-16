<?php

namespace Modules\Branch\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Branch\Entities\Branch;
use Modules\Upload\Entities\Upload;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Branch\DataTables\BranchDataTable;
use Modules\Branch\Http\Requests\StoreBranchRequest;
use Modules\Branch\Http\Requests\UpdateBranchRequest;

class BranchController extends Controller
{

    public function selector()
    {
        $branches = Branch::all();
        return view('Branch::branchs.selector', compact('branches'));
    }

    public function setBranch(Request $request)
    {
        session(['selected_branch' => $request->branch_id]);
        return redirect()->route('app.pos.index');
    }

    public function index(BranchDataTable $dataTable)
    {
        abort_if(Gate::denies('access_branch_management'), 403);

        $branch = Branch::get();
        return $dataTable->render('Branch::branchs.index', compact('branch'));
    }


    public function create()
    {
        abort_if(Gate::denies('create_branchs'), 403);

        return view('Branch::branchs.create');
    }


    public function store(StoreBranchRequest $request)
    {
     Branch::create($request->validated());

        toast('Branch Created Successfully!', 'success');

        return redirect()->route('branchs.index');
    }


    public function show(Branch $Branch)
    {
        abort_if(Gate::denies('show_branchs'), 403);

        return view('Branch::branchs.show', compact('Branch'));
    }


    public function edit(Branch $Branch)
    {
        abort_if(Gate::denies('edit_branchs'), 403);

        return view('Branch::branchs.edit', compact('Branch'));
    }


    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        try {
            DB::beginTransaction();

            // Update branch details
            $branch->update($request->validated());


            DB::commit();

            toast('Branch Updated Successfully!', 'success');
            return redirect()->route('branchs.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toast('Failed to update branch. ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }




    public function destroy(Branch $Branch)
    {
        abort_if(Gate::denies('delete_branchs'), 403);

        $Branch->delete();

        toast('Branch Deleted!', 'warning');

        return redirect()->route('branchs.index');
    }
}
