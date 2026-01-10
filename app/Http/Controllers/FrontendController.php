<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\HighlightCard;
use App\Models\ServiceTile;
use App\Models\FeaturedWork;
use App\Models\Subsidiary;
use App\Models\AboutContent;
use App\Models\Value;
use App\Models\WorkStep;
use App\Models\Expertise;
use App\Models\Service;
use App\Models\Contact;
use App\Models\SubsidiaryQuote;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = [
            'heroSlides' => HeroSlide::active()->ordered()->get(),
            'highlightCards' => HighlightCard::active()->ordered()->get(),
            'serviceTiles' => ServiceTile::active()->ordered()->get(),
            'featuredWorks' => FeaturedWork::active()->featured()->ordered()->take(3)->get(),
            'subsidiaries' => Subsidiary::active()->ordered()->get(),
            'about' => AboutContent::first(),
            'values' => Value::active()->ordered()->get(),
            'workSteps' => WorkStep::active()->ordered()->get(),
            'expertise' => Expertise::active()->ordered()->get(),
            'services' => Service::active()->ordered()->get(),
            'projects' => FeaturedWork::active()->ordered()->get(),
            'settings' => SiteSetting::getAllGrouped(),
        ];

        return view('frontend.home', $data);
    }

    public function subsidiary($slug)
    {
        $subsidiary = Subsidiary::where('slug', $slug)
            ->with(['services' => fn($q) => $q->active()->ordered(), 'gallery'])
            ->firstOrFail();

        return view('frontend.subsidiary', compact('subsidiary'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'contact_type' => 'nullable|string|max:50',
            'service_id' => 'nullable|exists:services,id',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('contact-attachments', 'public');
        }

        Contact::create($validated);

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function submitQuote(Request $request, Subsidiary $subsidiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'quantity' => 'nullable|integer|min:1',
            'subsidiary_service_id' => 'nullable|exists:subsidiary_services,id',
            'requirements' => 'nullable|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $validated['subsidiary_id'] = $subsidiary->id;

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('quote-attachments', 'public');
        }

        SubsidiaryQuote::create($validated);

        return back()->with('success', 'Thank you! We will prepare your quote and contact you soon.');
    }
}