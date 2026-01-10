<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\Service;
use App\Models\FeaturedWork;
use App\Models\Subsidiary;
use App\Models\Contact;
use App\Models\SubsidiaryQuote;

class DashboardController extends Controller
{
    public function index()
    {
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

        return view('admin.dashboard', $data);
    }
}