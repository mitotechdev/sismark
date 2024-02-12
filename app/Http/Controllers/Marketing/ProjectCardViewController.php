<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use Illuminate\Http\Request;

class ProjectCardViewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $projects = Project::latest()->get();
        return view('pages.marketing.project.project-card-view', compact('projects'));
    }
}
