<?php

namespace App\Http\Controllers\Print;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintQuotationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        // Convert EN date to ID date (indonesia)
        $quotation_items = Quotation::where('id', $id)->with('quotation_items', 'project')->get();
        // $quotation = Quotation::first()->find($id)->quo
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

        // dd($quotation_items);

        $pdf = Pdf::loadView('report.transaction.print-quotation', [
            'quotation' => $quotation_items,
            // 'quotation_items' => $quotation_items, 
            'currentTime' => $dateNow
            ])->setOption(['dpi' => 150, 'defaultFont' => 'arial, sans-serif'])->setPaper('a4', 'portrait');
        return $pdf->stream('quotation.pdf');
    }
}
