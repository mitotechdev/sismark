<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Models\Marketing\Task;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class ExportsController extends Controller
{
    public function export(Request $request)
    {
        if($request->status_task == 0 || $request->status_task == 1) {
            $tasks = Task::with('project')->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->where('status_task', $request->status_task)
                        ->whereHas('customer', function (Builder $query) {
                            $query->where('branch_id', Auth::user()->branch_id);
                        })
                        ->where('user_id', Auth::user()->id)
                        ->get();
        } else {
            $tasks = Task::with('project')->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->where('user_id', Auth::user()->id)
                        ->whereHas('customer', function (Builder $query) {
                            $query->where('branch_id', Auth::user()->branch_id);
                        })
                        ->get();
        }
        
        return Excel::download(new TasksExport($tasks), 'report-tasks.xlsx');
    }
}
