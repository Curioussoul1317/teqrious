<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubsidiaryQuote;
use App\Models\Subsidiary;
use Illuminate\Http\Request;

class SubsidiaryQuoteController extends Controller
{
    protected $statuses = [
        'new' => 'New',
        'reviewed' => 'Reviewed',
        'quoted' => 'Quoted',
        'accepted' => 'Accepted',
        'rejected' => 'Rejected',
    ];

    public function index(Request $request)
    {
        $query = SubsidiaryQuote::with(['subsidiary', 'service'])->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->subsidiary_id) {
            $query->where('subsidiary_id', $request->subsidiary_id);
        }
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $quotes = $query->paginate(15);
        $statuses = $this->statuses;
        $subsidiaries = Subsidiary::ordered()->get();

        return view('admin.subsidiary-quotes.index', compact('quotes', 'statuses', 'subsidiaries'));
    }

    public function show(SubsidiaryQuote $subsidiaryQuote)
    {
        if ($subsidiaryQuote->status === 'new') {
            $subsidiaryQuote->update(['status' => 'reviewed']);
        }
        $statuses = $this->statuses;
        return view('admin.subsidiary-quotes.show', compact('subsidiaryQuote', 'statuses'));
    }

    public function update(Request $request, SubsidiaryQuote $subsidiaryQuote)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,reviewed,quoted,accepted,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $subsidiaryQuote->update($validated);

        return back()->with('success', 'Quote updated successfully.');
    }

    public function destroy(SubsidiaryQuote $subsidiaryQuote)
    {
        $subsidiaryQuote->delete();
        return redirect()->route('admin.subsidiary-quotes.index')->with('success', 'Quote deleted successfully.');
    }
}