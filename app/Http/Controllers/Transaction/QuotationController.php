<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Finance\Payment;
use App\Models\Finance\Tax;
use App\Models\Inventory\Product;
use App\Models\Marketing\Project;
use App\Models\Transaction\Quotation;
use App\Models\Transaction\QuotationItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['permission:create-quotation'], ['only' => ['store']]);
        $this->middleware(['permission:read-quotation'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:edit-quotation'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-quotation'], ['only' => ['destroy']]);
    }
    public function index()
    {
        $quotations = Quotation::with('user', 'branch', 'tax', 'payment', 'approval', 'project')
                                ->whereHas('branch', function($query) {
                                    $query->where('id', Auth::user()->branch_id);
                                })
                                ->latest()->get();
        $projects = Project::latest()->get();
        $taxs = Tax::all();
        $payments = Payment::all();
        return view('pages.transaction.quotation.quotation', [
            'projects' => $projects,
            'taxs' => $taxs,
            'payments' => $payments,
            'quotations' => $quotations,
            'title' => 'Menu Quotation',
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
            $validateData = Validator::make($request->all(), [
                'project_id' => 'required',
                'tax_id' => 'required',
                'payment_id' => 'required',
                'expedition' => 'required',
                'validated' => 'required',
                'subject' => 'required',
                'desc_quo' => 'required',
            ],
            [
                'project_id.required' => 'Data aktivitas belum dipilih/kaitkan',
                'tax_id.required' => 'Pajak belum dipilih',
                'subject.required' => 'Subject penawaran belum di isi',
                'payment_id.required' => 'Term of Payment (TOP) belum dipilih',
                'expedition.required' => 'Ekspedisi masih kosong',
                'validated.required' => 'Masa berlaku penawaran belum di pilih',
                'desc_quo.required' => 'Deskripsi atau catatan penawaran belum di isi',
            ]);

            if($validateData->fails()) {

                return redirect()->back()->withErrors($validateData)->withInput();

            } else {

                Quotation::create([
                    'code' => null,
                    'project_id' => $request->project_id,
                    'tax_id' => $request->tax_id,
                    'payment_id' => $request->payment_id,
                    'subject' => $request->subject,
                    'user_id' => Auth::user()->id,
                    'approval_id' => 1,
                    'branch_id' => Auth::user()->branch_id,
                    'expedition' => $request->expedition,
                    'validated' => $request->validated,
                    'desc_quo' => $request->desc_quo,
                    'created_by' => Auth::user()->nickname
                ]);

                return redirect()->back()->with('success', 'Data berhasil ditambahkan 🚀');
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation)
    {
        $products = Product::latest()->get();
        $quotationItems = QuotationItem::where('quotation_id', $quotation->id)->latest()->with('product')->get();
        
        return view('pages.transaction.quotation.item-quotation', [
            'quotation' => $quotation,
            'quotationItems' => $quotationItems,
            'products' => $products,
            'title' => 'Menu Quotation',
            'titleMenu' => 'menu-transaction',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        $projects = Project::latest()->get();
        $users = User::latest()->get();
        $taxes = Tax::latest()->get();
        $payments = Payment::latest()->get();
        return view('pages.transaction.quotation.edit-quotation', [
            'quotation' => $quotation,
            'projects' => $projects,
            'users' => $users,
            'taxes' => $taxes,
            'payments' => $payments,
            'title' => 'Menu Quotation',
            'titleMenu' => 'menu-transaction',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'subject' => 'required',
                'project_id' => 'required',
                'expedition' => 'required',
                'validated' => 'required',
                'tax_id' => 'required',
                'payment_id' => 'required',
                'desc_quo' => 'required',
            ],
            [
                'project_id.required' => 'Kode belum dipilih',
                'expedition.required' => 'Bagian ekspedisi belum diisi',
                'validated.required' => 'Masa berlaku penawaran belum dipilih',
                'tax_id.required' => 'Tax belum dipilih',
                'payment_id.required' => 'Term of Payment belum dipilih',
                'desc_quo.required' => 'Deskripsi atau catatan belum diisi',
            ]);

            if( $validateData->fails() ) {
                return redirect()->back()->withErrors($validateData)->withInput();
            }

            $quotation->update([
                'subject' => $request->subject,
                'project_id' => $request->project_id,
                'expedition' => $request->expedition,
                'validated' => $request->validated,
                'tax_id' => $request->tax_id,
                'payment_id' => $request->payment_id,
                'desc_quo' => $request->desc_quo,
            ]);

            return redirect()->route('quotation.index')->with('success', 'Data berhasil diperbaharui');

        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('quotation.index')->with('success', 'Data berhasil diperbaharui 🚀');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function document(Quotation $quotation)
    {
        $month = array (1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $split 	  = explode('-', date('Y-m-d'));
        $dateNow = $split[2] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0];


        $pdf = Pdf::loadView('report.transaction.quotation-document', [
            'quotation' => $quotation, 
            'currentTime' => $dateNow
            ])->setOption(['dpi' => 150, 'defaultFont' => 'arial, sans-serif'])->setPaper('a4', 'portrait');
        return $pdf->stream('quotation.pdf');
    }

    public function status(Quotation $quotation)
    {
        $quotation->update([
            'approval_id' => 2
        ]);

        return redirect()->route('quotation.index')->with('success', 'Berhasil open request, selanjutnya Approval atasan 🚀');
    }
}

