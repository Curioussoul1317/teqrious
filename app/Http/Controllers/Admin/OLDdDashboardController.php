<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_clients' => User::clients()->count(),
            'active_clients' => User::clients()->active()->count(),
            'total_projects' => Project::count(),
            'active_projects' => Project::active()->count(),
            'completed_projects' => Project::status('completed')->count(),
            'overdue_projects' => Project::overdue()->count(),
            'total_revenue' => Bill::status('paid')->sum('total'),
            'pending_bills' => Bill::unpaid()->sum('total'),
            'overdue_bills' => Bill::overdue()->count(),
        ];

        $recentProjects = Project::with('client')
            ->latest()
            ->take(5)
            ->get();

        $recentBills = Bill::with(['client', 'project'])
            ->latest()
            ->take(5)
            ->get();

        // Projects by status for chart
        $projectsByStatus = Project::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Monthly revenue for chart (last 6 months)
        $monthlyRevenue = Bill::status('paid')
            ->where('paid_date', '>=', Carbon::now()->subMonths(6))
            ->selectRaw('MONTH(paid_date) as month, YEAR(paid_date) as year, SUM(total) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentProjects',
            'recentBills',
            'projectsByStatus',
            'monthlyRevenue'
        ));
    }
}
