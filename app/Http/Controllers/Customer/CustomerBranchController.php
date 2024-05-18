<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.partner.customer.branch.branch-customer');
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
                'customer_id' => 'required',
                'name_branch' => 'required',
                'type_branch' => 'required',
                'pic_branch' => 'required',
                'address_branch' => 'required',
                'desc_branch' => 'required',
            ],
            [
                'customer_id.required' => 'Customer ID masih kosong',
                'name_branch.required' => 'Nama Branch masih kosong',
                'type_branch.required' => 'Tipe branch customer masih kosong',
                'pic_branch.required' => 'PIC dari branch customer masih kosong',
                'address_branch.required' => 'Alamat branch customer masih kosong',
                'desc_branch.required' => 'Deskripsi tambahan masih kosong'
            ]);

            if ( $validateData->fails() )
            {
                return redirect()->back()->withErrors($validateData)->withInput();    
            }

            CustomerBranch::create($request->all());
            return redirect()->back()->with('success', 'Data branch / pabrik customer berhasil ditambahkan 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerBranch $customerBranch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerBranch $customerBranch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerBranch $customerBranch)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'customer_id' => 'required',
                'name_branch' => 'required',
                'type_branch' => 'required',
                'pic_branch' => 'required',
                'address_branch' => 'required',
                'desc_branch' => 'required',
            ],
            [
                'customer_id.required' => 'Customer ID masih kosong',
                'name_branch.required' => 'Nama Branch masih kosong',
                'type_branch.required' => 'Tipe branch customer masih kosong',
                'pic_branch.required' => 'PIC dari branch customer masih kosong',
                'address_branch.required' => 'Alamat branch customer masih kosong',
                'desc_branch.required' => 'Deskripsi tambahan masih kosong'
            ]);

            if ( $validateData->fails() )
            {
                return redirect()->back()->withErrors($validateData)->withInput();    
            }

            $customerBranch->update($request->all());
            return redirect()->back()->with('success', 'Data branch / pabrik customer berhasil diperbaharui 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerBranch $customerBranch)
    {
        $customerBranch->delete();
        return redirect()->back()->with('success', 'Data branch / pabrik customer berhasil dhapus 🚀');
    }
}
