<?php

namespace App\Http\Controllers\Marketing;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Marketing\Task;
use App\Models\Marketing\Project;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Status\MarketProgress;
use Illuminate\Support\Facades\Validator;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['permission:create-project'], ['only' => ['store']]);
        $this->middleware(['permission:read-project'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:edit-project'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-project'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $customers = Customer::where('branch_id', Auth::user()->branch_id)->latest()->get();
        $userWithRole = User::with('roles')
                        ->whereHas('roles', function($query) {
                            $query->where('name', 'Sales & Marketing')
                                ->orWhere('name', 'Director');
                        })
                        ->get();
        if(auth()->user()->can('view-branch')) {
            $projects = Project::with('prospect')
            ->whereHas('prospect', function($query) {
                $query->where('tag_status', 'draf')
                    ->orWhere('tag_status', 'prospect')
                    ->orWhere('tag_status', 'hot');
            })
            ->where('branch_id', Auth::user()->branch_id)
            ->latest()->get();
        } else {
            $projects = Project::with('prospect')
            ->whereHas('prospect', function($query) {
                $query->where('tag_status', 'draf')
                    ->orWhere('tag_status', 'prospect')
                    ->orWhere('tag_status', 'hot');
            })
            ->where('user_id', Auth::user()->user_id)
            ->where('branch_id', Auth::user()->branch_id)
            ->latest()->get();
        }
        return view('pages.marketing.project.project-add', [
            'customers' => $customers,
            'projects' => $projects,
            'userWithRole' => $userWithRole,
            'title' => 'Menu Activity',
            'titleMenu' => 'menu-worksheet',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'customer_id' => 'required',
                'start_date' => 'required',
                'due_date' => 'required',
                'desc_project' => 'required'
            ],
            [
                'customer_id.required' => 'Anda belum memilih customer',
                'start_date.required' => 'Anda belum memilih tanggal mulai aktivitas',
                'due_date.required' => 'Anda belum memilih proyeksi selesai aktivitas',
                'desc_project.required' => 'Field deskripsi belum di isi',
            ]);

            if($validateData->fails()) {
                return redirect()->back()->withErrors($validateData)->withInput();
            }

            $dataCustomerProjects = Project::where('customer_id', $request->customer_id)->latest()->get();
            if ($dataCustomerProjects->isEmpty()) {
                Customer::find($request->customer_id)->update(['type_customer_id' => 2]);
            }

            $project = Project::create([
                            'project_code' => 'P-' . date('y') . date('d') . date('m') . random_int(1000, 9999),
                            'customer_id' => $request->customer_id,
                            'user_id' => Auth::user()->id,
                            'created_by' => Auth::user()->nickname,
                            'start_date' => $request->start_date,
                            'due_date' => $request->due_date,
                            'desc_project' => $request->desc_project,
                            'branch_id' => Auth::user()->branch->id,
                        ]);

            return redirect()->route('project.task', $project->id)->with('success', 'Data baru telah ditambahkan 🚀');

        } catch (\Throwable $th) {
            // abort(404);
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $taskCompleted = Task::where('project_id', $project->id)->where('status_task', true)->count();
        $taskProgress = Task::where('project_id', $project->id)->where('status_task', false)->count();
        $project = Project::where('id', $project->id)->with('tasks')->first();
        $progressChart = (new LarapexChart)->donutChart()
                        ->setTitle("Task Progress")
                        ->setSubtitle("Season 2023")
                        ->setHeight(400)
                        ->addData([$taskProgress, $taskCompleted])
                        ->setColors(["#FFC107", "#193d8a"])
                        ->setFontColor("#757575")
                        ->setLabels(["Progress", "Completed"]);

        return view('pages.marketing.project.project-detail-view', [
            'progressChart' => $progressChart,
            'project' => $project,
            'title' => 'Menu Activity',
            'titleMenu' => 'menu-worksheet',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        
        $customers = Customer::latest()->get();
        return view('pages.marketing.project.project-edit', [
            'project' => $project,
            'customers' => $customers,
            'title' => 'Menu Activity',
            'titleMenu' => 'menu-worksheet',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        try {
            $project->update([
                'customer_id' => $request->customer_id,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'desc_project' => $request->desc_project
            ]);
    
            return redirect()->route('project.index')->with('success', 'Data berhasil diperbaharui 🚀');
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function task(Project $project)
    {
        $tasks = Task::where('project_id', $project->id)->where('status_task', false)->latest()->get();
        $marketProgresses = MarketProgress::all();

        $countTasks = Task::where('project_id', $project->id)->where('status_task', true)->count();

        return view('pages.marketing.todo.task-add', [
            'project' => $project,
            'tasks' => $tasks,
            'countTasks' => $countTasks,
            'marketProgresses' => $marketProgresses,
            'title' => 'Menu Activity',
            'titleMenu' => 'menu-worksheet',
        ]);
    }

    public function card(Request $request)
    {
        $projects = Project::latest()->where('branch_id', Auth::user()->branch_id)->get();
        return view('pages.marketing.project.project-card-view', [
            'projects' => $projects,
            'title' => 'Menu Cards',
            'titleMenu' => 'menu-cards',
        ]);
    }

    public function lossProject()
    {
        $projects = Project::with('prospect', 'customer', 'market_progress')->where('branch_id', Auth::user()->branch_id)->latest()->get();
        return view('pages.marketing.project.project-loss', [
            'projects' => $projects,
            'title' => 'Menu Loss Prospect',
            'titleMenu' => 'menu-loss-project',
        ]);
    }

    public function submitLossProject(Request $request)
    {
        Project::find($request->project_id)
            ->update([
                'prospect_id' => 4,
                'desc_prospect' => $request->desc
            ]);
        return redirect()->back()->with('success', 'Loss prospect berhasil ditambahkan 🚀');
    }
}
