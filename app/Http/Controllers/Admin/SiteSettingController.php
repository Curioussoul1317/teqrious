<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::getAllGrouped();
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:100|unique:site_settings',
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,image',
            'group' => 'required|string|max:50',
        ]);

        SiteSetting::create($validated);

        return back()->with('success', 'Setting added successfully.');
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            $setting = SiteSetting::where('key', $key)->first();
            
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $value = $request->file("settings.{$key}")->store('settings', 'public');
                }
                
                $setting->update(['value' => $value]);
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function destroy(SiteSetting $setting)
    {
        if ($setting->type === 'image' && $setting->value) {
            Storage::disk('public')->delete($setting->value);
        }
        $setting->delete();

        return back()->with('success', 'Setting deleted successfully.');
    }
}