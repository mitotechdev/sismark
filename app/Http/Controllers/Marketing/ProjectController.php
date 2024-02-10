<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
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

            Project::create([
                'project_code' => 'A-9224',
                'project_name' => $request->project_name,
                'assign_to' => $request->assign_to,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'status' => 'Ongoing',
                'desc_project' => $request->desc_project,
            ]);
            return redirect()->back()->with('success', 'Data baru telah ditambahkan 🚀');

        } catch (\Throwable $th) {
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
                'status' => $request->status,
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
