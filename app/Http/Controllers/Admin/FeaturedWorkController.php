<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeaturedWorkController extends Controller
{
    protected $clientTypes = [
        'government' => 'Government',
        'corporate' => 'Corporate',
        'education' => 'Education',
        'healthcare' => 'Healthcare',
        'other' => 'Other',
    ];

    public function index()
    {
        $works = FeaturedWork::ordered()->paginate(15);
        $clientTypes = $this->clientTypes;
        return view('admin.featured-works.index', compact('works', 'clientTypes'));
    }

    public function create()
    {
        $clientTypes = $this->clientTypes;
        return view('admin.featured-works.create', compact('clientTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'problem' => 'nullable|string',
            'solution' => 'nullable|string',
            'outcome' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'client_type' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('featured-works', 'public');
        }

        FeaturedWork::create($validated);

        return redirect()->route('admin.featured-works.index')->with('success', 'Project created successfully.');
    }

    public function edit(FeaturedWork $featuredWork)
    {
        $clientTypes = $this->clientTypes;
        return view('admin.featured-works.edit', compact('featuredWork', 'clientTypes'));
    }

    public function update(Request $request, FeaturedWork $featuredWork)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'problem' => 'nullable|string',
            'solution' => 'nullable|string',
            'outcome' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'client_type' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($featuredWork->image) {
                Storage::disk('public')->delete($featuredWork->image);
            }
            $validated['image'] = $request->file('image')->store('featured-works', 'public');
        }

        $featuredWork->update($validated);

        return redirect()->route('admin.featured-works.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(FeaturedWork $featuredWork)
    {
        if ($featuredWork->image) {
            Storage::disk('public')->delete($featuredWork->image);
        }
        $featuredWork->delete();

        return redirect()->route('admin.featured-works.index')->with('success', 'Project deleted successfully.');
    }
}