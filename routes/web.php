<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Inventory\StockMasterController;
use App\Http\Controllers\Marketing\ProjectCardViewController;
use App\Http\Controllers\Marketing\ProjectController;
use App\Http\Controllers\Marketing\ProjectDetailController;
use App\Http\Controllers\Marketing\TaskCompletedController;
use App\Http\Controllers\Marketing\TaskController;
use App\Http\Controllers\Marketing\TaskProjectController;
use App\Http\Controllers\Marketing\UpdateTaskProjectController;
use App\Http\Controllers\Partner\CustomerController;
use App\Http\Controllers\Partner\CustomerPersonaliaController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Sales\PricelistController;
use App\Http\Controllers\TaskManagement\ProgressController;
use App\Http\Controllers\TaskManagement\ActivityController;
use App\Http\Controllers\Transaction\InvoiceController;
use App\Http\Controllers\Transaction\InvoiceToSppbController;
use App\Http\Controllers\Transaction\PoInternalController;
use App\Http\Controllers\Transaction\PoInternalItemController;
use App\Http\Controllers\Transaction\QuotationController;
use App\Http\Controllers\Transaction\SppbController;
use App\Http\Controllers\Transaction\SppbItemController;
use App\Http\Controllers\UserManagement\SalesUserController;
use App\Http\Controllers\UserManagement\UserController;
use App\Models\Transaction\Sppb;
use Illuminate\Support\Facades\Route;



Route::get('/', [Controller::class, 'index'])->name('index');

Route::resource("stock-master", StockMasterController::class);
Route::post('/stock-import', [Controller::class, 'importStock'])->name('importStock');
Route::get('/all-product', [ReportController::class, 'allProducts'])->name('allProducts');

Route::resource('user', UserController::class);
Route::resource('sales-user', SalesUserController::class);
Route::resource('customer', CustomerController::class);
Route::get('/customer/detail/{customer}', [CustomerController::class, 'detailCustomer'])->name('detailCustomer');
Route::get('/personalia/{customer}', [CustomerPersonaliaController::class, 'personaliaIndex'])->name('personaliaIndex');
Route::resource('customer-personalia', CustomerPersonaliaController::class, [
    'parameters' => [
        'customer-personalia' => 'customer-personalia'
    ]
]);
Route::view('/branch-customer', 'pages.partner.customer.branch.branch-customer');

Route::resource('user', UserController::class);
Route::resource('project', ProjectController::class);
Route::get('task-project/{project}', TaskProjectController::class)->name('task.project');
Route::resource('task', TaskController::class);
Route::put('/task-checked', UpdateTaskProjectController::class)->name('task.checked');
Route::get('/task-completed/{project}', TaskCompletedController::class)->name('task.completed');
Route::get('/project-detail/{project}', ProjectDetailController::class)->name('project.detail');
Route::get('/project-card-view', ProjectCardViewController::class)->name('project.card.view');

Route::view('/test','pages.marketing.project.project-list');

Route::view('/project-todo-view', 'pages.marketing.todo.task-add');






Route::resource('activities', ActivityController::class);
Route::get('/work-progress/{activity}', [ProgressController::class, 'createProgress'])->name('createProgress');
Route::resource('progress', ProgressController::class);

Route::resource('quotation', QuotationController::class);
Route::post('/quotation/item', [QuotationController::class, 'storeItemQuo'])->name('storeItemQuo');
Route::post('quotation/{quotation}/product', [QuotationController::class, 'submitQuotation'])->name('submitQuotation');
Route::get('/quotation-print/{quotation}', [ReportController::class, 'quotationPrint'])->name('quotationPrint');

Route::get('/product-pricelist/{id}', [QuotationController::class, 'getProduct'])->name('getProduct');
Route::get('/quotation-form/{activity}', [QuotationController::class, 'quotationForm'])->name('quotationForm');

Route::resource('pricelist', PricelistController::class);
Route::post('/pricelist-excel', [Controller::class, 'importFileExcel'])->name('importFileExcel');

Route::get('/all-pricelist', [ReportController::class, 'allPricelist'])->name('allPricelist');

Route::resource('po-internal', PoInternalController::class);
Route::put('po-internal-item/{id}/submit', [PoInternalController::class, 'poInternalSubmit'])->name('poInternalSubmit');
Route::get('po-internal-print/{id}', [ReportController::class, 'printPoInternal'])->name('printPoInternal');

Route::resource('po-internal-item', PoInternalItemController::class);


Route::resource('sppb', SppbController::class);
Route::get('/sppb/{sppb}/detail', [SppbController::class, 'sppbDetail'])->name('sppbDetail');
Route::put('/sppb/{sppb}/detail', [SppbController::class, 'sppbDetailSubmit'])->name('sppbDetailSubmit');
Route::get('/sppb/{sppb}/print', [ReportController::class, 'sppbPrint'])->name('sppbPrint');
Route::resource('sppb-item', SppbItemController::class);

Route::resource('invoice', InvoiceController::class);
Route::resource('invoice-to-sppb', InvoiceToSppbController::class);
Route::get('/invoice-to-sppb/{sppbItem}/price/{invoice}', [InvoiceToSppbController::class, 'editSppbItemPrice'])->name('editSppbItemPrice');
Route::put('/invoice-top-sppb/{sppbItem}/price', [InvoiceToSppbController::class, 'updateSppbItemPrice'])->name('updateSppbItemPrice');
Route::get('invoice-print/{invoice}', [ReportController::class, 'invoicePrint'])->name('invoicePrint');

// Route::view('/invoice/item', 'pages.invoice.invoice-item');
Route::get('/testing', function() {
    $data = Sppb::where('customer_id', 1)->with('sppb_item')->get();
    // $dataSppb = $data->sppb;
    $sumQty = null;
    foreach ($data as $item) {
        foreach ($item->sppb_item as $value) {
            // $sumQty += $value->qty;
            echo($value->stock_master->name_stock);
        }
        
    }

    // dd($sumQty);


});