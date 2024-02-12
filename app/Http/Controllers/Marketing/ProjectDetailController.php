<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    
   
    public function __invoke(Project $project)
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

        return view('pages.marketing.project.project-detail-view', compact('progressChart', 'project'));
    }
}
