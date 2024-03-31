<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('pages.marketing.project.project-add', compact('projects'));
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
                'project_name' => 'required',
                'assign_to' => 'required',
                'start_date' => 'required',
                'due_date' => 'required',
                'desc_project' => 'required'
            ],
            [
                'project_name.required' => 'Anda belum mengisi bagian Nama Customer/Aktivitas',
                'assign_to.required' => 'Anda belum memilih PIC yang di tugaskan',
                'start_date.required' => 'Anda belum meNmilih tanggal mulai aktivitas',
                'due_date.required' => 'Anda belum memilih proyeksi selesai aktivitas',
                'desc_project.required' => 'Field deskripsi belum di isi',
            ]);

            if($validateData->fails()) {
                return redirect()->back()->withErrors($validateData)->withInput();
            }

            $project = Project::create([
                            'project_code' => 'P-' . date('y') . date('d') . date('m') . random_int(1000, 9999),
                            'project_name' => $request->project_name,
                            'assign_to' => $request->assign_to,
                            'start_date' => $request->start_date,
                            'due_date' => $request->due_date,
                            'desc_project' => $request->desc_project,
                            'branch_id' => 1,
                        ]);

            return redirect()->route('task.project', $project->id)->with('success', 'Data baru telah ditambahkan 🚀');

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
        return view('pages.marketing.project.project-list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // dd($project);
        return view('pages.marketing.project.project-edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        try {
            $project->update([
                'project_name' => $request->project_name,
                'assign_to' => $request->assign_to,
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
}
