<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct()
    {
        $this->middleware(['permission:view-team'], ['only' => ['__invoke']]);
    }

    public function __invoke(Request $request)
    {
        $personils = User::with('projects')
                    ->where('status', 'active')
                    ->whereDoesntHave('roles', function ($query) {
                        $query->where('name', 'Super Admin');
                    })
                    ->get();
        $grouped_personils = $personils->groupBy(function ($user) {
            return $user->roles->first()->name ?? 'No Role Yet';
        });
        
        return view('pages.user-management.team', [
            'personils' => $personils,
            'grouped_personils' => $grouped_personils,
            'title' => 'Menu Teams',
            'titleMenu' => 'menu-teams',
        ]);
    }
}
