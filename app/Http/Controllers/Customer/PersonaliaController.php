<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Personalia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonaliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'role' => 'required',
                'phone' => 'required',
            ]);

            if ( $validateData->fails() ) {
                return redirect()->back()->withErrors($validateData)->withInput();
            }

            Personalia::create([
                'customer_id' => $request->customer_id,
                'name' => $request->name,
                'role' => $request->role,
                'phone' => $request->phone
            ]);

            return redirect()->back()->with('success', 'Data personalia berhasil ditambahkan 🚀');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Personalia $personalia)
    {
        return view('pages.partner.customer.personalia.personalia-customer-edit', compact('personalia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personalia $personalia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personalia $personalia)
    {
        try {
            $personalia->update($request->all());
            return redirect()->route('customer.personalia', $personalia->customer_id)->with('success', 'Data personalia berhasil di perbaharui');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personalia $personalia)
    {
        $personalia->delete();
        return redirect()->back()->with('success', 'Data personalia berhasil dihapus 🚀');
    }
}
