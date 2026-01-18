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
use App\Models\SiteSetting;
use App\Models\OurClient;
use App\Models\Contact;
use App\Models\SubsidiaryQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'subsidiary' => Subsidiary::active()->ordered()->first(), // Single subsidiary for nav
            'about' => AboutContent::first(),
            'values' => Value::active()->ordered()->get(),
            'workSteps' => WorkStep::active()->ordered()->get(),
            'expertise' => Expertise::active()->ordered()->get(),
            'services' => Service::active()->ordered()->get(),
            'projects' => FeaturedWork::active()->ordered()->get(),
            'clients' => OurClient::active()->ordered()->get(), // Add clients
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
     
        Mail::raw(
            "New Contact Form Submission\n\n" .
            "Name: {$validated['name']}\n" .
            "Email: {$validated['email']}\n" .
            "Phone: " . ($validated['phone'] ?? 'N/A') . "\n" .
            "Company: " . ($validated['company'] ?? 'N/A') . "\n" .
            "Type: " . ($validated['contact_type'] ?? 'N/A') . "\n\n" .
            "Message:\n{$validated['message']}",
            function($msg) use ($validated) {
                $msg->to('info@teqrious.com')
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject('New Contact: ' . $validated['name']);
            }
        );
    
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
    
        // Get service name if selected
        $serviceName = 'N/A';
        if (!empty($validated['subsidiary_service_id'])) {
            $service = \App\Models\SubsidiaryService::find($validated['subsidiary_service_id']);
            $serviceName = $service ? $service->name : 'N/A';
        }
    
        // Send email notification
        Mail::raw(
            "New Quote Request\n\n" .
            "Subsidiary: {$subsidiary->name}\n" .
            "Name: {$validated['name']}\n" .
            "Email: {$validated['email']}\n" .
            "Phone: " . ($validated['phone'] ?? 'N/A') . "\n" .
            "Quantity: " . ($validated['quantity'] ?? 'N/A') . "\n" .
            "Service: {$serviceName}\n\n" .
            "Requirements:\n" . ($validated['requirements'] ?? 'N/A'),
            function($msg) use ($validated, $subsidiary) {
                $msg->to('info@teqrious.com')
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject("Quote Request: {$subsidiary->name} - {$validated['name']}");
            }
        );
    
        return back()->with('success', 'Thank you! We will prepare your quote and contact you soon.');
    }
}