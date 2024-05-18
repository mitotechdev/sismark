<?php

namespace App\Charts;

use App\Models\Sales\SalesOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyRevenueChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        
        $monthlyRevenue = SalesOrder::with('customer', 'sales_order_items', 'tax')
            ->where('branch_id', Auth::user()->branch_id)
            ->whereYear('order_date', date('Y'))
            ->latest()
            ->get()
            ->groupBy(function ($bill) {
                return date('M', strtotime($bill->order_date));
            });
    
        $revenueByMonth = [];
    
        foreach ($monthlyRevenue as $month => $bills) {
            $revenueByMonth[$month] = $bills->reduce(function ($carry, $bill) {
                $total = $bill->sales_order_items->sum('total_amount');
                $ppn = $total * ($bill->tax->tax_value);
                return $carry + $total + $ppn;
            }, 0);
        }
    
        $monthsOrder = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
    
        $sortedRevenueByMonth = [];
        foreach ($monthsOrder as $month) {
            $sortedRevenueByMonth[$month] = $revenueByMonth[$month] ?? 0;
        }
        
        $monthNames = array_keys($sortedRevenueByMonth);
        $revenueValues = array_values($sortedRevenueByMonth);
    
        return $this->chart->areaChart()
            ->setTitle('Monthly Revenue of Year ' . date('Y'))
            ->addData('Revenue', $revenueValues)
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
            ->setXAxis($monthNames)
            // ->setSparkline()
            ->setHeight(300);
        }
}
