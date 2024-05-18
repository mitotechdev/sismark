<?php

use App\Models\Inventory\Product;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use App\Models\Sales\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Products
Route::get('product/{product}', function (Product $product) {
    return response()->json($product);
});

// API Project
Route::get('project/{project}', function (Project $project) {
    return response()->json($project->load('customer'));
});

Route::get('tasks', function (Request $request) {
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $status_task = $request->input('status_task');

    $tasks = Task::whereBetween('start_date', [$start_date, $end_date])
                    ->where('status_task', $status_task)
                    ->get();

    return response()->json($tasks);
});



Route::get('bill', function() {
    $bills = SalesOrder::where('sales_id', 5)->count();

    return response()->json($bills);
});