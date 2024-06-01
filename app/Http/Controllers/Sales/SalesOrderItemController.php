<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales\SalesOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;


class SalesOrderItemController extends Controller
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
        // dd($request->all());
        $validatedData = Validator::make($request->all(), [
            'product_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
        ],
        [
            'product_id.required' => 'Produk belum dipilih',
            'qty.required' => 'QTY item belum dimasukkan',
            'price.required' => 'Harga satuan belum dimasukkan',
            'discount.required' => 'Diskon belum dimasukkan',
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();

        } else {
            try {
                SalesOrderItem::create([
                    'sales_order_id' => $request->sales_order_id,
                    'product_id' => $request->product_id,
                    'qty' => $request->qty,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'total_amount' => $request->total_amount
                ]);
            } catch (QueryException $e) {
                return redirect()->back()->with('error', $this->getUserFriendlyErrorMessage($e));
            }
            

            return redirect()->back()->with('success', 'Item telah ditambahkan 🚀');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesOrderItem $salesOrderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesOrderItem $salesOrderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesOrderItem $salesOrderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesOrderItem $salesOrderItem)
    {
        $salesOrderItem->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus 🚀');
    }

    private function getUserFriendlyErrorMessage(QueryException $exception)
    {
        // Periksa kode kesalahan dan buat pesan yang lebih ramah pengguna
        switch ($exception->getCode()) {
            case '22003': // Numeric value out of range
                return 'The value provided is out of range for one of the fields. Contact your developer';
            // Tambahkan pengecekan kode kesalahan lainnya jika diperlukan
            default:
                return 'An error occurred while processing your request.';
        }
    }
}
