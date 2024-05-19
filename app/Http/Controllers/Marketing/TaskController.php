<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use App\Models\Sales\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'project_id' => 'required',
                'name_task' => 'required',
                'start_date' => 'required',
                'due_date' => 'required',
                'market_progress' => 'required',
                'desc_task' => 'required',
            ],
            [
                'project_id.required' => 'Kesalahan pada field ID Project. Hubungi IT',
                'name_task.required' => 'Name todo masih kosong',
                'start_date.required' => 'Tanggal todo anda masih kosong',
                'due_date.required' => 'Due date anda masih kosong',
                'market_progress.required' => 'Anda belum memilih market progress',
                'desc_task.required' => 'Deskripsi todo masih kosong. Abaikan dengan strip jika mengabaikan bagian ini',
            ]);

            if($validateData->fails()) {
                return redirect()->back()->withErrors($validateData)->withInput();
            }
            // jika item task satu dari sekian banyak data belum di checked maka status tetap draf
            // jika item task salah satunya di checked maka ubah status Project jadi prospect

            Task::create([
                'project_id' => $request->project_id,
                'market_progress_id' => $request->market_progress,
                'name_task' => $request->name_task,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'desc_task' => $request->desc_task,
                'customer_id' => $request->customer_id,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->back()->with('success', 'Task baru berhasil ditambahkan 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {
            $task->update([
                'market_progress_id' => $request->market_progress,
                'name_task' => $request->name_task,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'desc_task' => $request->desc_task,
            ]);

            return redirect()->back()->with('success', 'Data berhasil diperbaharui 🚀');

        } catch (\Throwable $th) {

            throw $th;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return redirect()->back()->with('success', 'Data berhasil di hapus 🚀');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function checked(Project $project, Task $task)
    {
        $customer = Customer::findOrFail($project->customer_id);
        if ($customer->type_customer_id !== 3 && $customer->type_customer_id !== 4) {
            $customer->update(['type_customer_id' => 3]);
        }

        try {
            
            if( $task->market_progress->tag_status == "dea" || $task->market_progress->tag_status == "pur" || $task->market_progress->tag_status == "sup" ) :
                $project->update([ 'prospect_id' => 3 ]);
            elseif ( $task->market_progress->tag_status == "map" || $task->market_progress->tag_status == "int" || $task->market_progress->tag_status == "pen" || $task->market_progress->tag_status == "jar" || $task->market_progress->tag_status == "quo" || $task->market_progress->tag_status == "neg") :
                $project->update([ 'prospect_id' => 2 ]);
            else :
                $project->update([ 'prospect_id' => 6 ]);
            endif;
            
            $project->update([ 'market_progress_id' => $task->market_progress_id ]);

            $task->update([ 'status_task' => true ]);

            
        
        return redirect()->back()->with('success', 'Task berhasil diselesaikan');
        }
        catch(\Throwable $e) {
            throw $e;
        }
    }

    public function completed(Project $project)
    {
        $tasksCompleted = Task::where('project_id', $project->id)->where('status_task', true)->latest()->get();
        return view('pages.marketing.todo.task-completed', [
            'project' => $project,
            'tasksCompleted' => $tasksCompleted,
            'title' => 'Menu Activity',
            'titleMenu' => 'menu-worksheet',
        ]);
    }
}
