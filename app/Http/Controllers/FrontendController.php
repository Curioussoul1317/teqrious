<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\FeaturedWork;
use App\Models\AboutContent;
use App\Models\Value;
use App\Models\WorkStep;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\OurClient;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OurClientImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function index()
    {
        $data = [
            'hero' => HeroSlide::active()->first(),
            'about' => AboutContent::first(),
            'values' => Value::active()->ordered()->get(),
            'workSteps' => WorkStep::active()->ordered()->get(),
            'services' => Service::active()->ordered()->get(),
            'projects' => FeaturedWork::active()->ordered()->get(),
            'products' => Product::active()->ordered()->get(),
            'clients' => OurClient::active()->ordered()->get(),
            'clientImages' => OurClientImage::active()->ordered()->get(),
            'settings' => SiteSetting::getAllGrouped(),
        ];

       
        return view('frontend.home', $data);
    }

    private function sendMailjet($to, $toName, $subject, $textContent, $replyTo = null, $replyToName = null)
    {
        $message = [
            'From' => [
                'Email' => config('mail.from.address'),
                'Name' => config('mail.from.name'),
            ],
            'To' => [
                [
                    'Email' => $to,
                    'Name' => $toName,
                ],
            ],
            'Subject' => $subject,
            'TextPart' => $textContent,
        ];

        if ($replyTo) {
            $message['ReplyTo'] = [
                'Email' => $replyTo,
                'Name' => $replyToName ?? $replyTo,
            ];
        }

        $response = Http::withBasicAuth(
            env('MAILJET_APIKEY'),
            env('MAILJET_APISECRET')
        )->post('https://api.mailjet.com/v3.1/send', [
            'Messages' => [$message],
        ]);

        if ($response->failed()) {
            Log::error('Mailjet error: ' . $response->body());
            return false;
        }

        return true;
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

        $emailContent = "New Contact Form Submission\n\n" .
            "Name: {$validated['name']}\n" .
            "Email: {$validated['email']}\n" .
            "Phone: " . ($validated['phone'] ?? 'N/A') . "\n" .
            "Company: " . ($validated['company'] ?? 'N/A') . "\n" .
            "Type: " . ($validated['contact_type'] ?? 'N/A') . "\n\n" .
            "Message:\n{$validated['message']}";

        $this->sendMailjet(
            'info@teqrious.com',
            'TEQRIOUS',
            'New Contact: ' . $validated['name'],
            $emailContent,
            $validated['email'],
            $validated['name']
        );

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
