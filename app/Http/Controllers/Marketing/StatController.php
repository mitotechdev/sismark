<?php

namespace App\Http\Controllers\Marketing;

use App\Models\User;
use App\Models\Marketing\Project;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Marketing\Task;
use App\Models\Sales\SalesOrder;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        if (auth()->id() !== $user->id && !auth()->user()->can('view', $user)) {
            abort(403);
        }
        $totalRevenue = 0;
        $salesOrders = SalesOrder::latest()
            ->with('sales_order_items', 'customer', 'branch', 'tax')
            ->where('sales_id', Auth::user()->id)
            ->where('paid', 1)
            ->get();

        $totalRevenue = $salesOrders->reduce(function ($carry, $so) {
            $total = $so->sales_order_items->sum('total_amount');
            $ppn = $total * $so->tax->tax_value;
            return $carry + $total + $ppn;
        }, 0);

        $total_po = SalesOrder::where('sales_id', Auth::user()->id)->count();

        // dd($total_po);
        $projects = Project::with('market_progress', 'prospect')->where('user_id', Auth::user()->id)->where('branch_id', Auth::user()->branch_id)->latest()->take(6)->get();
        $tasks = Task::with('project')->where('user_id', Auth::user()->id)->where('status_task', false)->latest()->take(4)->get();
        $task_done = Task::with('project', 'market_progress')->where('user_id', Auth::user()->id)->where('status_task', true)->latest()->take(4)->get();
        $customers = Customer::with('branch')
                                ->where('user_id', Auth::user()->id)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->latest()
                                ->take(3)
                                ->get();
        $projectGroupStatus = Project::with('prospect')
                ->where('user_id', Auth::user()->id)
                ->whereHas('prospect')
                ->get()
                ->groupBy(function ($project) {
                    return $project->prospect->tag_status;
                })
                ->transform(function ($items) {
                    return $items->count();
                });

        $prospecting = $projectGroupStatus->get('prospect', 0);
        $hot_prospect = $projectGroupStatus->get('hot', 0);
        $loss_prospect = $projectGroupStatus->get('loss', 0);

        return view('pages.stats.stats', [
            'user' => $user,
            'projects' => $projects,
            'tasks' => $tasks,
            'task_done' => $task_done,
            'prospecting' => $prospecting,
            'hot_prospect' => $hot_prospect,
            'loss_prospect' => $loss_prospect,
            'customers' => $customers,
            'total_po' => $total_po,
            'totalRevenue' => $totalRevenue,
            'title' => 'Menu Stats',
            'titleMenu' => 'menu-stats'
        ]);
    }
}
