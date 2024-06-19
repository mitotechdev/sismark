<?php

namespace App\Http\Controllers;

use App\Models\Marketing\Task;
use App\Models\Sales\SalesOrder;
use App\Charts\MonthlyRevenueChart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    

    public function index()
    {

    }
    public function dashboard(MonthlyRevenueChart $monthlyRevenueChart)
    {

        $tasks = Task::with('project', 'market_progress', 'user', 'customer')
            ->whereHas('project', function(Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })
            ->latest()->take(5)->get();

        // dd(SalesOrder::calculateTotalRevenueByStatus(false));

        return view('components.app.home', [
            'monthlyRevenueChart' => $monthlyRevenueChart->build(),
            'salesOrders' => SalesOrder::totalRevenueByStatusSalesOrder(true)->get(),
            'totalRevenue' => SalesOrder::calculateTotalRevenueByStatus(true),
            'totalOutstanding' => SalesOrder::calculateTotalRevenueByStatus(false),
            'tasks' => $tasks,
            'title' => 'Dashboard',
            'titleMenu' => '',
        ]);
    }

}
