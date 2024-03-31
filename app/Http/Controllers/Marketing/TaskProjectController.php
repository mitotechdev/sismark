<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use App\Models\Status\MarketProgress;
use Illuminate\Http\Request;

class TaskProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Project $project)
    {
        // dd($project);

        $tasks = Task::where('project_id', $project->id)->where('status_task', false)->latest()->get();
        $marketProgresses = MarketProgress::all();

        $countTasks = Task::where('project_id', $project->id)->where('status_task', true)->count();

        return view('pages.marketing.todo.task-add', compact('project', 'tasks', 'countTasks', 'marketProgresses'));
    }
}
