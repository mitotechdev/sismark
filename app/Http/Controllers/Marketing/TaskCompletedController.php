<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use Illuminate\Http\Request;

class TaskCompletedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Project $project)
    {

        $tasksCompleted = Task::where('project_id', $project->id)->where('status_task', true)->latest()->get();
        // dd($tasksCompleted);
        return view('pages.marketing.todo.task-completed', compact('project', 'tasksCompleted'));
    }
}
