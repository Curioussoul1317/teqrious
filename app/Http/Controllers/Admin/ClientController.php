<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = User::clients()->with(['projects' => function($q) {
            $q->latest()->take(3);
        }]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $clients = $query->latest()->paginate(10)->withQueryString();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'password' => ['nullable', 'string', Password::defaults()],
            'send_credentials' => ['nullable', 'boolean'],
        ]);

        // Generate password if not provided
        $password = $validated['password'] ?? Str::random(12);

        $client = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company_name' => $validated['company_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'password' => Hash::make($password),
            'role' => 'client',
            'is_active' => true,
        ]);

        // TODO: Send welcome email with credentials if requested
        // if ($request->boolean('send_credentials')) {
        //     $client->notify(new WelcomeNotification($password));
        // }

        return redirect()->route('admin.clients.show', $client)
            ->with('success', 'Client created successfully.')
            ->with('generated_password', $request->filled('password') ? null : $password);
    }

    public function show(User $client)
    {
        abort_unless($client->isClient(), 404);

        $client->load([
            'projects' => fn($q) => $q->latest()->take(10),
            'bills' => fn($q) => $q->latest()->take(10),
        ]);

        $stats = [
            'total_projects' => $client->projects()->count(),
            'active_projects' => $client->projects()->active()->count(),
            'completed_projects' => $client->projects()->status('completed')->count(),
            'total_billed' => $client->bills()->sum('total'),
            'total_paid' => $client->bills()->status('paid')->sum('total'),
            'outstanding' => $client->bills()->unpaid()->sum('total'),
        ];

        return view('admin.clients.show', compact('client', 'stats'));
    }

    public function edit(User $client)
    {
        abort_unless($client->isClient(), 404);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, User $client)
    {
        abort_unless($client->isClient(), 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $client->id],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.show', $client)
            ->with('success', 'Client updated successfully.');
    }

    public function resetPassword(Request $request, User $client)
    {
        abort_unless($client->isClient(), 404);

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $client->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password reset successfully.');
    }

    public function toggleStatus(User $client)
    {
        abort_unless($client->isClient(), 404);

        $client->update(['is_active' => !$client->is_active]);

        $status = $client->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Client {$status} successfully.");
    }

    public function destroy(User $client)
    {
        abort_unless($client->isClient(), 404);

        // Soft delete
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}
