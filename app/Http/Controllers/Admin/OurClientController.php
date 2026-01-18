<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurClientController extends Controller
{
    public function index()
    {
        $clients = OurClient::ordered()->paginate(20);
        return view('admin.our-clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.our-clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        OurClient::create($validated);
        return redirect()->route('admin.our-clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(OurClient $client)
    {
        return view('admin.our-clients.edit', compact('client'));
    }

    public function update(Request $request, OurClient $ourclient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('logo')) {
            if ($client->logo) {
                Storage::disk('public')->delete($client->logo);
            }
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $client->update($validated);
        return redirect()->route('admin.our-clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(OurClient $ourclient)
    {
        if ($client->logo) {
            Storage::disk('public')->delete($client->logo);
        }
        $client->delete();
        return redirect()->route('admin.our-clients.index')->with('success', 'Client deleted successfully.');
    }
}
