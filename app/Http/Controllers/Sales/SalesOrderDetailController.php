<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Product;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderItem;
use Illuminate\Http\Request;

class SalesOrderDetailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SalesOrder $salesOrder)
    {
        $products = Product::latest()->get();
        $salesOrderItems = SalesOrderItem::where('sales_order_id', $salesOrder->id)->latest()->with('product')->get();
        return view('pages.sales.order.item-order', compact('salesOrder', 'products', 'salesOrderItems'));
    }
}
