<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $query = Bill::with(['client', 'project']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('bill_number', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhereHas('client', fn($c) => $c->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $bills = $query->latest()->paginate(10)->withQueryString();
        $clients = User::clients()->active()->orderBy('name')->get();

        // Summary stats
        $stats = [
            'total' => Bill::sum('total'),
            'paid' => Bill::status('paid')->sum('total'),
            'pending' => Bill::unpaid()->sum('total'),
            'overdue' => Bill::overdue()->sum('total'),
        ];

        return view('admin.bills.index', compact('bills', 'clients', 'stats'));
    }

    public function create(Request $request)
    {
        $clients = User::clients()->active()->orderBy('name')->get();
        $projects = Project::when($request->client_id, fn($q) => $q->where('client_id', $request->client_id))
            ->orderBy('title')
            ->get();

        return view('admin.bills.create', compact('clients', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:issue_date'],
            'tax_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.description' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,sent'],
        ]);

        $project = Project::findOrFail($validated['project_id']);

        DB::transaction(function() use ($validated, $project) {
            $bill = Bill::create([
                'project_id' => $project->id,
                'client_id' => $project->client_id,
                'created_by' => auth()->id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'issue_date' => $validated['issue_date'],
                'due_date' => $validated['due_date'],
                'tax_rate' => $validated['tax_rate'] ?? 0,
                'discount' => $validated['discount'] ?? 0,
                'status' => $validated['status'],
                'notes' => $validated['notes'],
                'subtotal' => 0,
                'tax_amount' => 0,
                'total' => 0,
            ]);

            // Create items
            foreach ($validated['items'] as $item) {
                $bill->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['quantity'] * $item['unit_price'],
                ]);
            }

            // Calculate totals
            $bill->calculateTotals();
            $bill->save();
        });

        return redirect()->route('admin.bills.index')
            ->with('success', 'Bill created successfully.');
    }

    public function show(Bill $bill)
    {
        $bill->load(['client', 'project', 'creator', 'items']);
        return view('admin.bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        $bill->load('items');
        $clients = User::clients()->active()->orderBy('name')->get();
        $projects = Project::where('client_id', $bill->client_id)->orderBy('title')->get();

        return view('admin.bills.edit', compact('bill', 'clients', 'projects'));
    }

    public function update(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:issue_date'],
            'tax_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.description' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function() use ($validated, $bill) {
            $bill->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'issue_date' => $validated['issue_date'],
                'due_date' => $validated['due_date'],
                'tax_rate' => $validated['tax_rate'] ?? 0,
                'discount' => $validated['discount'] ?? 0,
                'notes' => $validated['notes'],
            ]);

            // Delete old items and create new ones
            $bill->items()->delete();
            
            foreach ($validated['items'] as $item) {
                $bill->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['quantity'] * $item['unit_price'],
                ]);
            }

            $bill->calculateTotals();
            $bill->save();
        });

        return redirect()->route('admin.bills.show', $bill)
            ->with('success', 'Bill updated successfully.');
    }

    public function updateStatus(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:draft,sent,paid,overdue,cancelled'],
            'paid_date' => ['nullable', 'date', 'required_if:status,paid'],
        ]);

        $bill->update([
            'status' => $validated['status'],
            'paid_date' => $validated['status'] === 'paid' ? ($validated['paid_date'] ?? now()) : null,
        ]);

        return back()->with('success', 'Bill status updated successfully.');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();

        return redirect()->route('admin.bills.index')
            ->with('success', 'Bill deleted successfully.');
    }

    // AJAX endpoint to get projects by client
    public function getProjectsByClient(User $client)
    {
        $projects = Project::where('client_id', $client->id)
            ->orderBy('title')
            ->get(['id', 'title']);

        return response()->json($projects);
    }
}
