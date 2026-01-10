<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $statuses = [
        'new' => 'New',
        'read' => 'Read',
        'replied' => 'Replied',
        'closed' => 'Closed',
    ];

    public function index(Request $request)
    {
        $query = Contact::with('service')->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('company', 'like', "%{$request->search}%");
            });
        }

        $contacts = $query->paginate(15);
        $statuses = $this->statuses;

        return view('admin.contacts.index', compact('contacts', 'statuses'));
    }

    public function show(Contact $contact)
    {
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,closed',
            'admin_notes' => 'nullable|string',
        ]);

        $contact->update($validated);

        return back()->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully.');
    }
}