<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $this->middleware(['role:Super Admin'], ['only' => ['permission']]);
    }

    public function index()
    {
        $roles = Role::latest()->get();
        return view('pages.backend.role.role-index', [
            'roles' => $roles,
            'title' => 'Menu Roles',
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
    public function store(Request $request, Role $role)
    {
        try {
            $request->validate([
                'name' => 'required'
            ]);

            Role::create([
                'name' => $request->name,
            ]);

            return redirect()->back()->with('success', 'Role baru berhasi ditambahkan 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::all()->groupBy('for');
        return view('pages.backend.role.role-give-permission', [
            'role' => $role,
            'permissions' => $permissions,
            'title' => 'Menu Roles',
            'titleMenu' => 'menu-user-management',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return redirect()->back()->with('success', 'Role berhasil diperbaharui 🚀');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', 'Role berhasil dihapus 🚀');
    }

    public function permission(Request $request, Role $role)
    {
        try {
            $role->syncPermissions($request->permission);
            return redirect()->back()->with('success', 'Permission telah ditambahkan 🚀');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
