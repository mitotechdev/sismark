<?php

namespace App\Http\Controllers;

use Exception;
use App\Imports\StockImport;
use Illuminate\Http\Request;
use App\Imports\PricelistImport;
use App\Helpers\AbbreviateNumber;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Inventory\StockMaster;
use App\Models\TaskManagement\Activity;
use App\Models\Transaction\Invoice;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function index()
    {

        $invoicesBySalesUser = Invoice::with('sales_user')->get()->groupBy('sales_user_id');

        // Menghitung total invoice per user sales
        $countsBySalesUser = $invoicesBySalesUser->map(function ($invoices, $salesUserId) {
            $salesUser = $invoices->first()->sales_user->user->name;
            return [
                'sales_user_id' => $salesUser,
                'total_invoices' => $invoices->count(),
            ];
        })->sortByDesc('total_invoices')->take(5);

        
        foreach ($countsBySalesUser as $key => $dataSet) {
            $salesName[] = $dataSet['sales_user_id'];
            $total_invoice[] = $dataSet['total_invoices'];
        }

        $sumAllInvoice = Invoice::sum('total_inv');

        $activityLatest = Activity::with('user')->latest()->take(5)->get();

        // Sum Product groupby category product
        $products = StockMaster::latest()->get()->groupBy('stock_category');


        $chart = (new LarapexChart)->lineChart()->setTitle('Penjualan Sales Marketing')
                    ->setSubtitle('PT Mito Energi Indonesia')
                    ->setHeight(345)
                    ->addData('Sales Marketing', [1000000, 2500000, 5000000, 6700000, 1520000])
                    ->setXAxis(['Jan', 'Feb', 'March', 'April', 'May', 'June']);
        
        $productChart = (new LarapexChart)->pieChart()
                        ->setTitle('Graph Product Sales')
                        ->setSubtitle('Season 2023')
                        ->setHeight(200)
                        ->addData([31, 4])
                        ->setLabels(['General Chemical', 'Specialty Chemical']);
        
        $salesMarketingChart = (new LarapexChart)->pieChart()
                        ->setTitle('Top 5 Sales Marketing')
                        ->setSubtitle('Season 2023')
                        ->setHeight(200)
                        ->addData($total_invoice ?? [1])
                        ->setLabels($salesName ?? ['Data masih kosong']);

        $marketSalesBranchChart = (new LarapexChart)->pieChart()
                        ->setTitle('Market Sales All Office')
                        ->setSubtitle('Season 2023')
                        ->setHeight(200)
                        ->addData([134, 47, 58])
                        ->setLabels(['HO PT MEI', 'Medan', 'Pontianak']);
        $testChart = (new LarapexChart)->horizontalBarChart()
                        ->setTitle('Los Angeles vs Miami.')
                        ->setSubtitle('Wins during season 2021.')
                        ->setColors(['#FFC107', '#D32F2F'])
                        ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
                        ->addData('Boston', [7, 3, 8, 2, 6, 4])
                        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

        $sumProduct = AbbreviateNumber::abbreviate(StockMaster::count());
        return view("components.app.dashboard", compact('sumProduct', 'chart', 'productChart', 'salesMarketingChart', 'marketSalesBranchChart', 'sumAllInvoice', 'activityLatest', 'testChart'));
    }

    public function importFileExcel(Request $request)
    {
        try {
            Excel::import(new PricelistImport, $request->file('file'));
            return redirect()->back()->with("success", "Yeay, impor file anda berhasil dilakukan");

        } catch (Exception $ex) {
            return redirect()->back()->with('error','💢 Oops, data anda tidak dapat diproses. Pastikan data excel dan sistem tidak sama.');
        }

    }

    public function importStock(Request $request)
    {
        try {
            Excel::import(new StockImport, $request->file('file'));
            return redirect()->back()->with("success", "Yeay, import file anda berhasil dilakukan 🚀");

        } catch (Exception $ex) {
            // return redirect()->back()->with('error','💢 Duplicate Entry, data anda tidak dapat diproses pastikan data excel dan sistem tidak sama.');
            return redirect()->back()->with('error', $ex->getMessage());
        }

    }


    public function test($cat)
    {
        switch ($cat) {
            case 'Mapping':
                return 'Prospect';
            case 'Introduction':
                return 'Prospect';
            case 'Penetration':
                return 'Prospect';
            case 'Jartest':
                return 'Prospect';
            case 'Quotation':
                return 'Prospect';
            case 'PO':
                return 'Hot Prospect';
            case 'Supply & Maintenance':
                return 'Hot Prospect';
            default:
                # code...
                echo 'data tidak di kenali';
                return 0;
        }
    }

}
