<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction\Quotation;

class ApprovementController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function quotation()
    {
        $quotations = Quotation::with('approval', 'project')
                        ->where('branch_id', Auth::user()->branch_id)
                        ->whereHas('approval', function($e) {
                            $e->where('tag_status', 'req');
                        })
                        ->latest()->get();
        return view('pages.approvement.quotation', [
            'quotations' => $quotations,
            'title' => 'Menu Approvement',
            'titleMenu' => 'menu-approvement',
        ]);
    }

    public function approved(Request $request, Quotation $quotation)
    {
        $quotation->update([
            'approval_id' => 3
        ]);
        return redirect()->back()->with('success', 'Quotation has been approved 🚀');
    }

    public function reject(Request $request, Quotation $quotation)
    {
        $quotation->update([
            'approval_id' => 4
        ]);
        return redirect()->back()->with('success', 'Quotation has been reject 🚀');
    }
}
