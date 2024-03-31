<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use Illuminate\Http\Request;
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
                'time_task' => 'required',
                'market_progress' => 'required',
                'desc_task' => 'required',
            ],
            [
                'project_id.required' => 'Kesalahan pada field ID Project. Hubungi IT',
                'name_task.required' => 'Name todo masih kosong',
                'start_date.required' => 'Tanggal todo anda masih kosong',
                'time_task.required' => 'Waktu todo anda masih kosong',
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
                'time_task' => $request->time_task,
                'desc_task' => $request->desc_task,
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
                'time_task' => $request->time_task,
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
}
