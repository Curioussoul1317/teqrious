<?php
// This file contains multiple controllers - split them into separate files

// ========== AboutContentController.php ==========
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutContentController extends Controller
{
    public function edit()
    {
        $about = AboutContent::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
        ]);

        $about = AboutContent::first();

        if ($request->hasFile('image')) {
            if ($about && $about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $validated['image'] = $request->file('image')->store('about', 'public');
        }

        if ($about) {
            $about->update($validated);
        } else {
            AboutContent::create($validated);
        }

        return back()->with('success', 'About content updated successfully.');
    }
}