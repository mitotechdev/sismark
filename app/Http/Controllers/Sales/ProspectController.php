<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Marketing\Project;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    //
    public function hotProspectIndex() 
    {
        $prospectHots = Project::where('prospect_status', "1")->get();
        return view('pages.sales.prospect.prospect-hot', compact('prospectHots'));
    } 
}
