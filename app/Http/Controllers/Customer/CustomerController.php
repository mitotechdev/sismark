<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\UserManagement\SalesUser;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerBranch;
use App\Models\Customer\Personalia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware(['permission:read-customer'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create-customer'], ['only' => ['store']]);
        $this->middleware(['permission:edit-customer'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-customer'], ['only' => ['destroy']]);
    }

    public function index()
    {
        
        $users = User::latest()->get();
        $customers = Customer::with('branch', 'user', 'customer_branch', 'personalia')
            ->where('branch_id', Auth::user()->branch_id)
            ->latest()->get();

        return view('pages.partner.customer.customer', [
            'customers' => $customers,
            'users' => $users,
            'title' => 'Menu Databases',
            'titleMenu' => 'menu-worksheet',
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

            if ($request->has('user_id')) {
                $salesperson = $request->user_id;
            } else {
                $salesperson = Auth::user()->id;
            }

            $customer = Customer::create([
                'branch_id' => Auth::user()->branch_id,
                'name_customer' => $request->name_customer,
                'type_customer_id' => 1,
                'type_business' => $request->type_business,
                'foundation_date' => $request->foundation_date,
                'npwp' => $request->npwp,
                'owner' => $request->owner,
                'total_employee' => $request->total_employee,
                'address_customer' => $request->address_customer,
                'city' => $request->city,
                'country' => $request->country,
                'phone_a' => $request->phone_a,
                'phone_b' => $request->phone_b,
                'email_a' => $request->email_a,
                'email_b' => $request->email_b,
                'desc_technical' => $request->desc_technical,
                'desc_clasification' => $request->desc_clasification,
                'add_information' => $request->add_information,
                'user_id' => $salesperson,
            ]);

            for ($i=0; $i < count($request->name_pic); $i++) { 
                Personalia::create([
                    'customer_id' => $customer->id,
                    'name' => $request->name_pic[$i],
                    'role' => $request->position[$i],
                    'phone' => $request->phone_number[$i]
                ]);
            }
            
            for ($indexBranch=0; $indexBranch < count($request->name_branch); $indexBranch++) { 
                CustomerBranch::create([
                    'customer_id' => $customer->id,
                    'name_branch' => $request->name_branch[$indexBranch],
                    'type_branch' => $request->type_branch[$indexBranch],
                    'pic_branch' => $request->pic_branch[$indexBranch],
                    'address_branch' => $request->address_branch[$indexBranch],
                    'desc_branch' => $request->desc_branch[$indexBranch]
                ]);
            }

            return redirect()->back()->with('success', 'Data customer berhasil ditambahkan 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $users = User::latest()->get();
        return view('pages.partner.customer.edit-customer', [
            'customer' => $customer,
            'users' => $users,
            'title' => 'Menu Databases',
            'titleMenu' => 'menu-worksheet',
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $customer->update($request->all());
            if ($request->has('user_id')) {
                $salesperson = $request->user_id;
            } else {
                $salesperson = Auth::user()->id;
            }

            $customer->update([
                'branch_id' => Auth::user()->branch_id,
                'name_customer' => $request->name_customer,
                'type_business' => $request->type_business,
                'foundation_date' => $request->foundation_date,
                'npwp' => $request->npwp,
                'owner' => $request->owner,
                'total_employee' => $request->total_employee,
                'address_customer' => $request->address_customer,
                'city' => $request->city,
                'country' => $request->country,
                'phone_a' => $request->phone_a,
                'phone_b' => $request->phone_b,
                'email_a' => $request->email_a,
                'email_b' => $request->email_b,
                'desc_technical' => $request->desc_technical,
                'desc_clasification' => $request->desc_clasification,
                'add_information' => $request->add_information,
                'user_id' => $salesperson,
            ]);
            return redirect()->route('customer.index')->with('success', 'Data customer berhasil diperbaharui 🚀');
        } catch (\Exception $m) {
            return redirect()->back()->with('error', $m->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with('success', 'Data customer berhasil di hapus');
    }

    public function detail(Customer $customer)
    {
        return view('pages.partner.customer.detail-customer', [
            'customer' => $customer,
            'title' => 'Menu Databases',
            'titleMenu' => 'menu-worksheet',
        ]);
    }

    public function personalia(Customer $customer)
    {
        return view('pages.partner.customer.personalia.personalia-customer', [
            'customer' => $customer,
            'title' => 'Menu Databases',
            'titleMenu' => 'menu-worksheet',
        ]);
    }

    public function branch(Customer $customer)
    {
        return view('pages.partner.customer.branch.branch-customer', [
            'customer' => $customer,
            'title' => 'Menu Databases',
            'titleMenu' => 'menu-worksheet',
        ]);
    }

    public function customerList()
    {
        $customers = Customer::with('type_customer', 'user', 'personalia', 'branch')->where('branch_id', Auth::user()->branch_id)->latest()->get();
        return view('pages.partner.customer.customer-list', [
            'customers' => $customers,
            'title' => 'Customers',
            'titleMenu' => 'menu-customer',
        ]);
    }
}
