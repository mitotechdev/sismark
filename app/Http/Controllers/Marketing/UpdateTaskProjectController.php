<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Task;
use Illuminate\Http\Request;

class UpdateTaskProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {

        Task::where('project_id', $request->project_id)->where('id', $request->task_id)->update(['status_task' => true]);
        return redirect()->back()->with('success', 'Task berhasil diselesaikan');
        }
        catch(\Throwable $e) {
            throw $e;
        }
    }
}
