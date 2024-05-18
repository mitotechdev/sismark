<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['role:Super Admin'], ['only' => ['index', 'store', 'update']]);
    }

    public function index()
    {
        $branches = Branch::all();
        return view('pages.branch.branch-index', [
            'branches' => $branches,
            'title' => 'Menu Branches',
            'titleMenu' => 'menu-branches'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'code' => 'required|unique:branches',
                'name' => 'required',
                'npwp' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'pic' => 'required',
            ]);
            if ($validateData->fails()) {
                return redirect()->back()->withErrors($validateData)->withInput();
            }
            Branch::create($request->all());
            return redirect()->back()->with('success', 'Data branch baru berhasil ditambahkan 🚀');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $branch->update($request->all());
        return redirect()->back()->with('success', 'Data branch baru berhasil diperbaharui 🚀');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
