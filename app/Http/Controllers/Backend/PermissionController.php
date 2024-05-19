<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['role:Super Admin'], ['only' => ['index']]);
        $this->middleware(['role:Super Admin'], ['only' => ['store']]);
        $this->middleware(['role:Super Admin'], ['only' => ['show']]);
        $this->middleware(['role:Super Admin'], ['only' => ['update']]);
        $this->middleware(['role:Super Admin'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('pages.backend.permission.permission-index', [
            'permissions' => $permissions,
            'title' => 'Menu Permissions',
            'titleMenu' => 'menu-user-management',
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
