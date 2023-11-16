<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Sales\Pricelist;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function allPricelist()
    {
        $pricelists = Pricelist::with('stock_master', 'city')->latest()->get();
        $data = [
            'title' => 'Welcome to Laravel PDF',
            'content' => 'This is a sample PDF generated using dompdf and Laravel.'
        ];
    
        $pdf = Pdf::loadView('report.all-pricelist', ['pricelist' => $pricelists])->setOption(['dpi' => 150, 'defaultFont' => 'arial, sans-serif'])->setPaper('a4', 'landscape');
    
        return $pdf->stream('document.pdf');
    }
}