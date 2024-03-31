<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use Illuminate\Http\Request;

class UpdateTaskProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd($request->all());

        $project = Project::find($request->project_id);
        $task = Task::find($request->task_id);
        // dd($task);
        try {

            $tasks = Task::where('project_id', $request->project_id)->where('status_task', true)->get();

            if ( $tasks->isEmpty() ) {
                $project->update([
                    'prospect_id' => 2,
                    'market_progress_id' => $task->market_progress_id
                ]);

            } else {
                if( $task->market_progress->tag_status == "dea" || $task->market_progress->tag_status == "pur" || $task->market_progress->tag_status == "sup" ) :
                    $project->update([ 
                        'prospect_id' => 3,
                    ]);
                else :
                    $project->update([ 
                        'prospect_id' => 2,
                    ]);
                endif;
                
                $project->update([
                    'market_progress_id' => $task->market_progress_id
                ]);
            }

            $task->update([ 'status_task' => true ]);
        
        return redirect()->back()->with('success', 'Task berhasil diselesaikan');
        }
        catch(\Throwable $e) {
            throw $e;
        }
    }
}
