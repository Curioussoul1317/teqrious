<?php

namespace App\Http\Controllers;

use App\Models\Subsidiary;
use App\Models\FeaturedWork;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $subsidiaries = Subsidiary::active()->ordered()->get();
        $projects = FeaturedWork::active()->ordered()->get();

        $content = view('sitemap', [
            'subsidiaries' => $subsidiaries,
            'projects' => $projects,
        ])->render();

        return response($content)
            ->header('Content-Type', 'application/xml');
    }
}