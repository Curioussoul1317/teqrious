<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = $user->bills()->with('project');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bills = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total_billed' => $user->bills()->sum('total'),
            'total_paid' => $user->bills()->status('paid')->sum('total'),
            'outstanding' => $user->bills()->unpaid()->sum('total'),
        ];

        return view('client.bills.index', compact('bills', 'stats'));
    }

    public function show(Bill $bill)
    {
        // Ensure client can only view their own bills
        if ($bill->client_id !== auth()->id()) {
            abort(403);
        }

        // Don't show draft bills to clients
        if ($bill->status === 'draft') {
            abort(404);
        }

        $bill->load(['project', 'items']);

        return view('client.bills.show', compact('bill'));
    }
}
