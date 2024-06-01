<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Models\Marketing\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


class ReportController extends Controller
{
    public function tasks()
    {
        $taskCount = Task::join('projects', 'tasks.project_id', '=', 'projects.id')
                            ->join('customers', 'projects.customer_id', '=', 'customers.id')
                            ->where('customers.type_customer_id', 2)
                            ->where('customers.id', 1)
                            ->where('tasks.status_task', true)
                            ->count();
        
        $tasks = Task::with('project')->where('user_id', Auth::user()->id)
            ->whereHas('customer', function(Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })
            ->latest()->get();
        return view('pages.reports.tasks', [
            'tasks' => $tasks,
            'title' => 'Menu Tasks',
            'titleMenu' => 'menu-tasks',
        ]);
        
    }

    public function resultTask(Request $request)
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

        return view('pages.reports.task-result', [
            'tasks' => $tasks,
            'title' => 'Menu Tasks',
            'titleMenu' => 'menu-tasks',
        ]);
    }

    public function printResultTask(Request $request)
    {
        if($request->status_task == 0 || $request->status_task == 1) {
            $tasks = Task::with('project', 'customer')->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->where('status_task', $request->status_task)
                        ->whereHas('customer', function (Builder $query) {
                            $query->where('branch_id', Auth::user()->branch_id);
                        })
                        ->where('user_id', Auth::user()->id)
                        ->get();
        } else {
            $tasks = Task::with('project', 'customer')->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->where('user_id', Auth::user()->id)
                        ->whereHas('customer', function (Builder $query) {
                            $query->where('branch_id', Auth::user()->branch_id);
                        })
                        ->get();
        }

        
        $pdf = Pdf::loadView('report.report-result-task', [
            'tasks' => $tasks->groupBy('customer.name_customer'),
        ])->setOption(['dpi' => 150, 'defaultFont' => 'arial, sans-serif'])->setPaper('a4', 'portrait');
        return $pdf->stream('my_tasks.pdf');
    }

    public function worklists()
    {
        $tasks = Task::with('project', 'market_progress', 'user', 'customer')->latest()->get();
        return view('pages.reports.worklist', [
            'tasks' => $tasks,
            'title' => 'Menu Progress',
            'titleMenu' => 'menu-progress-tasks',
        ]);
    }

}
