<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales\SalesOrder;
use Illuminate\Http\Request;

class SalesOrderUpdateStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, SalesOrder $salesOrder)
    {
        if($request->level == 2)
        {
            $salesOrder->update([
                'status' => 'request'
            ]);
        }

        return redirect()->route('sales-order.index')->with('success', 'SO telah berhasil disubmit 🚀');
    }
}
