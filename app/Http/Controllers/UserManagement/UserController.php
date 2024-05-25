<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Backend\Branch;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(['role:Super Admin'], ['only' => ['index']]);
        $this->middleware(['role:Super Admin'], ['only' => ['store']]);
        $this->middleware(['role:Super Admin'], ['only' => ['edit']]);
        $this->middleware(['role_or_permission:Super Admin|edit-user'], ['only' => ['update']]);
        $this->middleware(['role:Super Admin'], ['only' => ['deactivate']]);
        $this->middleware(['role:Super Admin'], ['only' => ['activate']]);
    }

    public function index()
    {
        $users = User::latest()->get();
        $branches = Branch::all();
        $roles = Role::all();
        return view('pages.user-management.master-user.user', [
            'users' => $users,
            'branches' => $branches,
            'roles' => $roles,
            'title' => 'Menu Users',
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
        
        try {
            $validateData = Validator::make($request->all(), [
                'full_name' => 'required',
                'nickname' => 'required',
                'gender' => 'required',
                'employee_id' => 'required',
                'title' => 'required',
                'phone_number' => 'required',
                'email' => 'required',
                'username' => 'required',
                'password' => 'required',
                'branch_id' => 'required',
            ],
            [
                'full_name.required' => 'Nama anda masih kosong',
                'nickname.required' => 'Nickname anda masih kosong',
                'gender.required' => 'Jenis kelamin masih kosong',
                'employee_id.required' => 'NIK karyawan masih kosong',
                'title.required' => 'Jabatan masih kosong',
                'phone_number.required' => 'Nomor telepon masih kosong',
                'email.required' => 'Email masih kosong',
                'username.required' => 'Username masih kosong',
                'password.required' => 'Password masih kosong',
                'branch_id.required' => 'Branch bermasalah. Hubungi IT',
            ]);

            if( $validateData->fails() ) {
                return redirect()->back()->withErrors($validateData)->withInput();
            }


            $user = User::create([
                'full_name' => $request->full_name,
                'nickname' => $request->nickname,
                'gender' => $request->gender,
                'employee_id' => $request->employee_id,
                'title' => $request->title,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'branch_id' => $request->branch_id,
            ]);
            $user->syncRoles($request->role);

            return redirect()->back()->with('success', 'Data user berhasil ditambahkan 🚀');
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan pada saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $branches = Branch::all();
        $roles = Role::all();
        return view('pages.user-management.master-user.edit-user', [
            'user' => $user,
            'branches' => $branches,
            'roles' => $roles,
            'title' => 'Menu Users',
            'titleMenu' => 'menu-user-management',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $validateData = Validator::make($request->all(), [
            'employee_id' => 'required',
            'full_name' => 'required',
            'nickname' => 'required',
            'gender' => 'required',
            'title' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'image' => 'nullable|file|mimes:jpeg,jpg,png|max:1024',
        ],
        [
            'employee_id.required' => 'Employee ID is need required',
            'full_name.required' => 'Full name user is need required',
            'nickname.required' => 'Nickname user is need required',
            'gender.required' => 'Gender user is need required',
            'title.required' => 'Title of user is need required',
            'phone.required' => 'Phone number is need required',
            'email.required' => 'Email is need required',
            'image.max' => 'Gambar upload harus 1 Mb.',
        ]);

        if($validateData->fails())
        {
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        $updateData = [
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
        ];

        if($request->has('branch')) {
            $updateData['branch_id'] = $request->branch;
        } 

        if($request->file('image')) {

            if($user->image !== null) Storage::delete($user->image);

            $updateData['image'] = $request->file('image')->storeAs('images/employees', $request->file('image')->getClientOriginalName());
        }
        
        if ($request->password !== null) {
            $updateData['password'] = Hash::make($request->password);
        }
        
        $user->update($updateData);
        $user->syncRoles($request->role);
        
        return redirect()->back()->with('success', 'Data berhasil diupdate 🚀');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


    public function profile(User $user)
    {
        if (auth()->id() !== $user->id && !auth()->user()->can('view', $user)) {
            abort(403);
        }
        $roles = Role::all();
        $branches = Branch::all();
        return view('pages.user-management.user.detail', [
            'user' => $user,
            'roles' => $roles,
            'branches' => $branches,
            'title' => 'Menu Profile',
            'titleMenu' => 'menu-profile',
        ]);
    }

    public function image(User $user)
    {
        
        if ($user->image) {
            Storage::delete($user->image);
            $user->image = null;
            $user->save();
        }
        return redirect()->back()->with('success', 'Foto profile berhasil dihapus 🚀');

    }

    public function deactivate(User $user)
    {
        $user->deactivate();
        return redirect()->back()->with('success', 'User account has been deactivated .');
    }

    public function activate(User $user)
    {
        $user->activate();
        return redirect()->back()->with('success', 'User account has been activated .');
    }
}
