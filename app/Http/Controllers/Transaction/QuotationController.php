<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Product;
use App\Models\Marketing\Project;
use App\Models\Sales\Pricelist;
use App\Models\TaskManagement\Activity;
use App\Models\Transaction\Quotation;
use App\Models\Transaction\QuotationItem;
use App\Models\User;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotations = Quotation::with('user', 'branch')->latest()->get();
        $activities = Activity::with('progress')->where('status_work', 'on-going')->get();
        $projects = Project::all();
        $users = User::where('title_id', 17)->get();
        return view('pages.transaction.quotation.quotation', compact('activities', 'quotations', 'projects', 'users'));
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
        $quotation = Quotation::latest()->first();

        if ( $quotation == null ) {
            $generateNo = "001";
        } else {
            $generateNo = substr($quotation->quo_code, 0, 3) + 1;
            $generateNo = str_pad($generateNo, 3, "0", STR_PAD_LEFT);
        }
        $quotationNo = $generateNo . '/' . 'SP-MEICHEM' . '/' . date('m') . '/' . date('Y');
        
        $data = Quotation::create([
            'quo_code' => $quotationNo,
            'project_id' => $request->project_id,
            'type_expedition' => $request->type_expedition,
            'validated_quo' => $request->validated_quo,
            'tax_type' => $request->tax_type,
            'desc_quo' => $request->desc_quo,
            'user_id' => $request->user_id,
            'payment_term' => $request->payment_term,
            'branch_id' => 1,
            'status' => 'Draf',
        ]);
        return redirect()->route('quotation.show', $data->id)->with('success','Data quotation berhasil diinput, tambahkan produk selanjutnya 🚀');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation)
    {
        $products = Product::latest()->get();
        $quotationItems = QuotationItem::where('quotation_id', $quotation->id)->latest()->with('product')->get();
        // $quotationItems = QuotationItem::where('quotation_id', $quotation->id)->with('quotation', 'pricelist')->get();
        return view('pages.transaction.quotation.item-quotation', compact('quotation', 'quotationItems', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        $projects = Project::latest()->get();
        $users = User::latest()->get();
        return view('pages.transaction.quotation.edit-quotation', compact('quotation', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        $quotation->update([
            'project_id' => $request->project_id,
            'type_expedition' => $request->type_expedition,
            'validated_quo' => $request->validated_quo,
            'tax_type' => $request->tax_type,
            'payment_term' => $request->payment_term,
            'desc_quo' => $request->desc_quo,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('quotation.index')->with('success', 'Data berhasil diperbaharui 🚀');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function quotationForm(Activity $activity)
    {
        return view('pages.transaction.quotation.add-quotation', compact('activity'));
    }

    public function getProduct($id)
    {
        $data = Pricelist::where('stock_master_id', $id)->get();
        return response()->json($data);
    }

    public function storeItemQuo(Request $request)
    {
        // dd($request->all());
        QuotationItem::create([
            'quotation_id' => $request->quotation_id,
            'pricelist_id' => $request->pricelist_id,
            'price' => $request->price
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }
    public function submitQuotation(Request $request, Quotation $quotation)
    {
        $quotation->update([
            'status_quo' => 'request'
        ]);
        return redirect()->route('quotation.index')->with('success', 'Penawaran berhasil dibuat, klik cetak untuk aksi selanjutnya 🚀');

    }

    public function getReferenceProject(Project $project)
    {
        return response()->json($project);
    }
}

