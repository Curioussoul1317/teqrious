@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-center p-3">
            <i class="bi bi-images fs-1 text-primary"></i>
            <h3 class="mt-2 mb-0">{{ $heroSlidesCount }}</h3>
            <small class="text-muted">Hero Slides</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <i class="bi bi-gear fs-1 text-success"></i>
            <h3 class="mt-2 mb-0">{{ $servicesCount }}</h3>
            <small class="text-muted">Services</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <i class="bi bi-briefcase fs-1 text-info"></i>
            <h3 class="mt-2 mb-0">{{ $projectsCount }}</h3>
            <small class="text-muted">Projects</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <i class="bi bi-building fs-1 text-warning"></i>
            <h3 class="mt-2 mb-0">{{ $subsidiariesCount }}</h3>
            <small class="text-muted">Subsidiaries</small>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-center p-3 bg-danger text-white">
            <h3 class="mb-0">{{ $newContactsCount }}</h3>
            <small>New Contacts</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3 bg-warning text-dark">
            <h3 class="mb-0">{{ $newQuotesCount }}</h3>
            <small>New Quotes</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <h3 class="mb-0">{{ $totalContacts }}</h3>
            <small class="text-muted">Total Contacts</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <h3 class="mb-0">{{ $totalQuotes }}</h3>
            <small class="text-muted">Total Quotes</small>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Recent Contacts</span>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <tbody>
                        @forelse($recentContacts as $contact)
                            <tr>
                                <td>
                                    <strong>{{ $contact->name }}</strong><br>
                                    <small class="text-muted">{{ $contact->email }}</small>
                                </td>
                                <td class="text-end">
                                    <span class="badge status-{{ $contact->status }}">{{ ucfirst($contact->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="text-center text-muted py-4">No contacts yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Recent Quote Requests</span>
                <a href="{{ route('admin.subsidiary-quotes.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <tbody>
                        @forelse($recentQuotes as $quote)
                            <tr>
                                <td>
                                    <strong>{{ $quote->name }}</strong><br>
                                    <small class="text-muted">{{ $quote->subsidiary->name ?? 'N/A' }}</small>
                                </td>
                                <td class="text-end">
                                    <span class="badge status-{{ $quote->status }}">{{ ucfirst($quote->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="text-center text-muted py-4">No quotes yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
