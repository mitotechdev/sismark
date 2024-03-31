<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Quotation;
use Illuminate\Http\Request;

class UpdateQuotationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Quotation $quotation)
    {
        $quotation->update([
            'status' => 'Request'
        ]);

        return redirect()->route('quotation.index')->with('success', 'Berhasil open request, selanjutnya Approval atasan 🚀');
    }
}
