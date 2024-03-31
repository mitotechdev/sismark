<?php

namespace App\Http\Controllers\Print;

use App\Http\Controllers\Controller;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintSalesOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $salesOrderItems = SalesOrderItem::where('sales_order_id', $id)->with('product')->get();
        $salesOrder = SalesOrder::find($id)->with('customer')->get();
        $pdf = Pdf::loadView('report.sales.print-sales-order', [
            'salesOrderItems' => $salesOrderItems,
            'salesOrder' => $salesOrder,
        ])->setOption(['dpi' => 150, 'defaultFont' => 'arial, sans-serif'])->setPaper('a4', 'portrait');
        return $pdf->stream('sales_order.pdf');
    }
}
