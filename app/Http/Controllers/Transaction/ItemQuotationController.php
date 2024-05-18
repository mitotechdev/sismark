<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\QuotationItem;
use Illuminate\Http\Request;

class ItemQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['permission:create-quotation-item'], ['only' => ['store']]);
        $this->middleware(['permission:read-quotation-item'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:edit-quotation-item'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-quotation-item'], ['only' => ['destroy']]);
    }
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
            QuotationItem::create([
                'quotation_id' => $request->quotation_id,
                'product_id' => $request->product_id,
                'price' => $request->price_product
            ]);
            return redirect()->back()->with('success', 'Item penawaran berhasil ditambahkan 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationItem $quotationItem)
    {
        try {
            $quotationItem->update([
                'product_id' => $request->product_id,
                'price' => $request->price_product,
            ]);

            return redirect()->back()->with('success', 'Data berhasil diperbaharui 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationItem $quotationItem)
    {
        $quotationItem->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus 🚀');
    }
}
