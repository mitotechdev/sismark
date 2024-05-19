<?php

namespace App\Http\Controllers\Sales;

use App\Models\User;
use App\Models\Finance\Tax;
use Illuminate\Http\Request;
use App\Models\Finance\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sales\SalesOrder;
use App\Models\Customer\Customer;
use App\Models\Inventory\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['permission:create-sales-order'], ['only' => ['store']]);
        $this->middleware(['permission:read-sales-order'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:edit-sales-order'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-sales-order'], ['only' => ['destroy']]);
        $this->middleware(['permission:print-sales-order'], ['only' => ['document']]);
        $this->middleware(['permission:read-sales-order-item'], ['only' => ['item']]);
    }

    public function index()
    {
        
        $customers = Customer::latest()->where('branch_id', Auth::user()->branch_id)->get();
        $users = User::latest()->role('Sales & Marketing')->get();
        $taxes = Tax::latest()->get();
        $payments = Payment::latest()->get();
        $salesOrders = SalesOrder::latest()->with('sales_order_items', 'customer', 'sales', 'payment', 'approval', 'branch', 'tax')
            ->where('branch_id', Auth::user()->branch_id)
            ->get();        
        return view('pages.sales.order.sales-order-index', [
            'customers' => $customers,
            'salesOrders' => $salesOrders,
            'users' => $users,
            'taxes' => $taxes,
            'payments' => $payments,
            'title' => 'Menu Sales Order',
            'titleMenu' => 'menu-transaction',
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
            $validatedData = Validator::make($request->all(), [
                'so_number' => 'required',
                'customer_id' => 'required',
                'sales_id' => 'required',
                'order_date' => 'required',
                'payment_id' => 'required',
                'tax_id' => 'required',
                'delivery_to' => 'required',
                'desc' => 'required',
            ],
            [
                'so_number.required' => 'No Sales Order belum di isi',
                'customer_id.required' => 'Customer belum dipilih',
                'sales_id.required' => 'Sales person belum dipilih',
                'order_date.required' => 'Tanggal order masih kosong',
                'payment_id.required' => 'Term of Payment tidak boleh tanggal mundur!',
                'delivery_to.required' => 'Alamat pengantaran masih kosong',
                'desc.required' => 'Deskripsi tambahan masih kosong'
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }
   
            $salesOrder = SalesOrder::create([
                'so_number' => $request->so_number,
                'customer_id' => $request->customer_id,
                'sales_id' => $request->sales_id,
                'order_date' => $request->order_date,
                'payment_id' => $request->payment_id,
                'tax_id' => $request->tax_id,
                'delivery_to' => $request->delivery_to,
                'desc' => $request->desc,
                'created_by' => Auth::user()->nickname,
                'branch_id' => Auth::user()->branch_id,
                'approval_id' => 1
            ]);
            
            return redirect()->route('sales-order.item', $salesOrder->id)->with('success', 'Sales Order berhasil di input, silahkan isi item SO 🚀');
            

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesOrder $salesOrder)
    {
        return view('pages.sales.order.sales-order-detail', [
            'salesOrder' => $salesOrder,
            'title' => 'Menu Sales Order',
            'titleMenu' => 'menu-transaction',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesOrder $salesOrder)
    {
        $customers = Customer::latest()->get();
        $users = User::latest()->get();
        $taxes = Tax::latest()->get();
        $payments = Payment::latest()->get();
        return view('pages.sales.order.sales-order-edit', [
            'salesOrder' => $salesOrder,
            'customers' => $customers,
            'users' => $users,
            'taxes' => $taxes,
            'payments' => $payments,
            'title' => 'Menu Sales Order',
            'titleMenu' => 'menu-transaction',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'so_number' => 'required',
                'customer_id' => 'required',
                'sales_id' => 'required',
                'order_date' => 'required',
                'payment_id' => 'required',
                'tax_id' => 'required',
                'delivery_to' => 'required',
                'desc' => 'required',
            ],
            [
                'so_number.required' => 'No Sales Order masih kosong',
                'customer_id.required' => 'Customer belum dipilih',
                'sales_id.required' => 'Sales person belum dipilih',
                'order_date.required' => 'Tanggal order masih kosong',
                'payment_id.required' => 'Term of Payment masih kosong',
                'tax_id.required' => 'Tax belum dipilih',
                'delivery_to.required' => 'Alamat pengantaran masih kosong',
                'desc.required' => 'Deskripsi / Catatan masih kosong'
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            } 

            $salesOrder->update([
                'so_number' => $request->so_number,
                'customer_id' => $request->customer_id,
                'sales_id' => $request->sales_id,
                'payment_id' => $request->payment_id,
                'tax_id' => $request->tax_id,
                'order_date' => $request->order_date,
                'delivery_to' => $request->delivery_to,
                'desc' => $request->desc,
            ]);
            
            return redirect()->route('sales-order.index')->with('success', 'Data Sales Order berhasil diperbaharui 🚀');
            

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }

    public function item(SalesOrder $salesOrder)
    {
        $products = Product::latest()->get();
        return view('pages.sales.order.sales-order-item', [
            'salesOrder' => $salesOrder,
            'products' => $products,
            'title' => 'Menu Sales Order',
            'titleMenu' => 'menu-transaction',
        ]);
    }

    public function status(SalesOrder $salesOrder)
    {
        $salesOrder->update([
            'approval_id' => 2,
        ]);
        Customer::find($salesOrder->customer_id)->update(['type_customer_id' => 4]);

        return redirect()->route('sales-order.index')->with('success', 'SO telah berhasil disubmit 🚀');
    }

    public function document(SalesOrder $salesOrder)
    {
        $pdf = Pdf::loadView('report.sales.print-sales-order', [
            'salesOrder' => $salesOrder,
        ])->setOption(['dpi' => 150, 'defaultFont' => 'arial, sans-serif'])->setPaper('a4', 'portrait');
        return $pdf->stream('sales_order.pdf');
    }
    
    public function bill()
    {
        $bills = SalesOrder::with('customer', 'sales_order_items', 'tax')
            ->where('branch_id', Auth::user()->branch_id)
            ->latest()
            ->get();
        return view('pages.transaction.bill', [
            'bills' => $bills,
            'title' => 'Menu Bills',
            'titleMenu' => 'menu-transaction',
        ]);
    }

    public function paid(SalesOrder $salesOrder)
    {
        $salesOrder->paid();
        $salesOrder->update(['approval_id' => 3]);
        return redirect()->back()->with('success', 'PO has been paid.');
    }
}
