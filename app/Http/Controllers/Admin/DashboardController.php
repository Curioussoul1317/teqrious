<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\Service;
use App\Models\FeaturedWork;
use App\Models\Subsidiary;
use App\Models\Contact;
use App\Models\SubsidiaryQuote; 
use App\Models\Bill;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function ourindex()
    // {
    //     $data = [
    //         'heroSlidesCount' => HeroSlide::count(),
    //         'servicesCount' => Service::count(),
    //         'projectsCount' => FeaturedWork::count(),
    //         'subsidiariesCount' => Subsidiary::count(),
    //         'newContactsCount' => Contact::new()->count(),
    //         'newQuotesCount' => SubsidiaryQuote::new()->count(),
    //         'totalContacts' => Contact::count(),
    //         'totalQuotes' => SubsidiaryQuote::count(),
    //         'recentContacts' => Contact::latest()->take(5)->get(),
    //         'recentQuotes' => SubsidiaryQuote::with('subsidiary')->latest()->take(5)->get(),
    //     ];
 
    //     return view('admin.dashboard', $data);
    // }

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

            $data = [
                'heroSlidesCount' => HeroSlide::count(),
                'servicesCount' => Service::count(),
                'projectsCount' => FeaturedWork::count(),
                'subsidiariesCount' => Subsidiary::count(),
                'newContactsCount' => Contact::new()->count(),
                'newQuotesCount' => SubsidiaryQuote::new()->count(),
                'totalContacts' => Contact::count(),
                'totalQuotes' => SubsidiaryQuote::count(),
                'recentContacts' => Contact::latest()->take(5)->get(),
                'recentQuotes' => SubsidiaryQuote::with('subsidiary')->latest()->take(5)->get(), 
            ];
        
        return view('admin.dashboard', compact(
            'data',
            'stats',
            'recentProjects',
            'recentBills',
            'projectsByStatus',
            'monthlyRevenue'
        ));
    }
}