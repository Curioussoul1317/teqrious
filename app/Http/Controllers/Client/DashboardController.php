<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_projects' => $user->projects()->count(),
            'active_projects' => $user->projects()->active()->count(),
            'completed_projects' => $user->projects()->status('completed')->count(),
            'total_billed' => $user->bills()->sum('total'),
            'total_paid' => $user->bills()->status('paid')->sum('total'),
            'outstanding' => $user->bills()->unpaid()->sum('total'),
            'overdue_bills' => $user->bills()->overdue()->count(),
        ];

        $recentProjects = $user->projects()
            ->with('updates')
            ->latest()
            ->take(5)
            ->get();

        $recentBills = $user->bills()
            ->with('project')
            ->latest()
            ->take(5)
            ->get();

        $recentUpdates = $user->projects()
            ->with(['updates' => fn($q) => $q->with('user')->latest()->take(5)])
            ->get()
            ->pluck('updates')
            ->flatten()
            ->sortByDesc('created_at')
            ->take(10);

        return view('client.dashboard', compact('stats', 'recentProjects', 'recentBills', 'recentUpdates'));
    }
}
