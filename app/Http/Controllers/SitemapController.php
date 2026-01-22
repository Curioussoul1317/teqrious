<?php

namespace App\Http\Controllers;

use App\Models\FeaturedWork;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $projects = FeaturedWork::active()->ordered()->get();

        $content = view('sitemap', [
            'projects' => $projects,
        ])->render();

        return response($content)
            ->header('Content-Type', 'application/xml');
    }
}
