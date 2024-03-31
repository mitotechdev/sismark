<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Partner\Customer;
use App\Models\Sales\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        $salesOrders = SalesOrder::latest()->with('sales_order_items')->get();
        return view('pages.sales.order.sales-order-index', compact('customers', 'salesOrders'));
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
        // dd($request->all());
        try {
            $validatedData = Validator::make($request->all(), [
                'customer_id' => 'required',
                'sales_id' => 'required',
                'order_date' => 'required',
                'term' => 'required|date|after:now',
                'ship_to' => 'required',
                'desc' => 'required',
                'po_number' => 'required',
            ],
            [
                'customer_id.required' => 'Customer belum dipilih',
                'sales_id.required' => 'Sales person belum dipilih',
                'order_date.required' => 'Tanggal order masih kosong',
                'term.after' => 'Term of Payment tidak boleh tanggal mundur!',
                'ship_to.required' => 'Alamat pengantaran masih kosong',
                'po_number.required' => 'PO customer belum di isi'
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            } else {

                $soData = [
                    'so_number' => $request->po_number,
                    'customer_id' => $request->customer_id,
                    'order_date' => $request->order_date,
                    'term' => $request->term,
                    'ship_to' => $request->ship_to,
                    'created_by' => 'Gea',
                    'desc' => $request->desc,
                    'sales_person' => $request->sales_id,
                    'branch_id' => 1
                ];
                
                if ($request->taxable == "on") {
                    $soData['taxable'] = true;
                }
                
                $newData = SalesOrder::create($soData);
                
                return redirect()->route('order.item', $newData->id)->with('success', 'Sales Order berhasil di input, silahkan isi item SO 🚀');
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesOrder $salesOrder)
    {
        return view('pages.sales.order.sales-order-detail', compact('salesOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesOrder $salesOrder)
    {
        $customers = Customer::latest()->get();
        return view('pages.sales.order.sales-order-edit', compact('salesOrder', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'customer_id' => 'required',
                'sales_id' => 'required',
                'order_date' => 'required',
                'term' => 'required|date|after:now',
                'ship_to' => 'required',
                'desc' => 'required',
                'po_number' => 'required',
            ],
            [
                'customer_id.required' => 'Customer belum dipilih',
                'sales_id.required' => 'Sales person belum dipilih',
                'order_date.required' => 'Tanggal order masih kosong',
                'term.after' => 'Term of Payment tidak boleh tanggal mundur!',
                'ship_to.required' => 'Alamat pengantaran masih kosong',
                'po_number.required' => 'PO customer masih kosong'
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            } else {

                $soData = [
                    'so_number' => $request->po_number,
                    'customer_id' => $request->customer_id,
                    'order_date' => $request->order_date,
                    'term' => $request->term,
                    'ship_to' => $request->ship_to,
                    'created_by' => 'Gea',
                    'desc' => $request->desc,
                    'sales_person' => $request->sales_id,
                    'branch_id' => 1
                ];
                
                if ($request->taxable == "on") {
                    $soData['taxable'] = true;
                } else {
                    $soData['taxable'] = false;
                }
                
                $salesOrder->update($soData);
                
                return redirect()->route('sales-order.index')->with('success', 'Data Sales Order berhasil diperbaharui 🚀');
            }

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
}
