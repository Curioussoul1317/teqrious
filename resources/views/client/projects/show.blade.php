@extends('layouts.app')

@section('title', $project->title)
@section('page-title', 'Project Details')

@section('content')
<div class="d-flex flex-column gap-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('client.projects.index') }}" class="text-secondary">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">{{ $project->title }}</h1>
            <p class="text-muted mb-0">Project Details</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="d-flex flex-column gap-4">
                <!-- Status Cards -->
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center py-3">
                                <span class="badge rounded-pill {{ $project->status_badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                                <p class="text-muted small mt-2 mb-0">Status</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center py-3">
                                <span class="badge rounded-pill {{ $project->priority_badge }}">
                                    {{ ucfirst($project->priority) }}
                                </span>
                                <p class="text-muted small mt-2 mb-0">Priority</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center py-3">
                                <p class="h4 fw-bold text-dark mb-0">{{ $project->progress }}%</p>
                                <p class="text-muted small mb-0">Progress</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center py-3">
                                @if($project->days_remaining !== null)
                                    <p class="h4 fw-bold mb-0 {{ $project->is_overdue ? 'text-danger' : 'text-dark' }}">
                                        {{ $project->is_overdue ? 'Overdue' : $project->days_remaining }}
                                    </p>
                                    <p class="text-muted small mb-0">{{ $project->is_overdue ? '' : 'Days Left' }}</p>
                                @else
                                    <p class="text-muted mb-0">-</p>
                                    <p class="text-muted small mb-0">Days Left</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Progress</h5>
                        <div class="progress mb-2" style="height: 16px;">
                            <div class="progress-bar {{ $project->progress_color }}" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted small mb-0">{{ $project->progress }}% Complete</p>
                    </div>
                </div>

                @if($project->description)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-3">Description</h5>
                            <p class="text-muted mb-0" style="white-space: pre-wrap;">{{ $project->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Updates Timeline -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Updates</h5>
                        <div class="d-flex flex-column gap-3">
                            @forelse($project->updates as $update)
                                <div class="d-flex gap-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                        <i class="bi bi-clipboard-check text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <p class="fw-medium mb-0">{{ $update->title }}</p>
                                                <p class="text-muted small mb-0">{{ $update->created_at->diffForHumans() }}</p>
                                            </div>
                                            @if($update->progress_change)
                                                <span class="badge {{ str_starts_with($update->progress_change, '+') ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                                    {{ $update->progress_change }}
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-muted mt-2 mb-0">{{ $update->content }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center py-3 mb-0">No updates yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Comments -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-semibold mb-0">Discussion</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comments.store', $project) }}" method="POST" class="mb-4">
                            @csrf
                            <textarea name="content" rows="3" placeholder="Add a comment..." required
                                      class="form-control mb-2"></textarea>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                        <div class="d-flex flex-column gap-3">
                            @forelse($project->comments as $comment)
                                <div class="p-3 bg-light rounded">
                                    <div class="d-flex gap-3">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white small flex-shrink-0" style="width: 32px; height: 32px;">
                                            {{ $comment->user->initials }}
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-medium">{{ $comment->user->name }}</span>
                                                <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-muted mt-1 mb-0">{{ $comment->content }}</p>
                                            @foreach($comment->replies as $reply)
                                                <div class="mt-3 ps-3 border-start border-2 d-flex gap-2">
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 24px; height: 24px; font-size: 0.7rem;">
                                                        {{ $reply->user->initials }}
                                                    </div>
                                                    <div>
                                                        <span class="small fw-medium">{{ $reply->user->name }}</span>
                                                        <span class="text-muted small ms-2">{{ $reply->created_at->diffForHumans() }}</span>
                                                        <p class="text-muted small mb-0">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <form action="{{ route('comments.store', $project) }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <div class="d-flex gap-2">
                                                    <input type="text" name="content" placeholder="Reply..." class="form-control form-control-sm">
                                                    <button type="submit" class="btn btn-secondary btn-sm">Reply</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center py-3 mb-0">No comments yet. Start the discussion!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="d-flex flex-column gap-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Project Details</h6>
                        <dl class="row small mb-0">
                            <dt class="col-6 text-muted fw-normal">Start Date</dt>
                            <dd class="col-6 text-end fw-medium">{{ $project->start_date?->format('M d, Y') ?? '-' }}</dd>
                            
                            <dt class="col-6 text-muted fw-normal">End Date</dt>
                            <dd class="col-6 text-end fw-medium {{ $project->is_overdue ? 'text-danger' : '' }}">
                                {{ $project->end_date?->format('M d, Y') ?? '-' }}
                            </dd>
                            
                            <dt class="col-6 text-muted fw-normal mb-0">Duration</dt>
                            <dd class="col-6 text-end fw-medium mb-0">{{ $project->duration ?? '-' }}</dd>
                        </dl>
                    </div>
                </div>

                <!-- Documents -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h6 class="fw-semibold mb-0">Documents</h6>
                        <span class="text-muted small">{{ $project->documents->count() }}</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('documents.store', $project) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                            @csrf
                            <div class="mb-2">
                                <input type="text" name="title" placeholder="Document title" required class="form-control form-control-sm">
                            </div>
                            <div class="mb-2">
                                <input type="file" name="file" required class="form-control form-control-sm">
                            </div>
                            <button type="submit" class="btn btn-dark btn-sm w-100">
                                <i class="bi bi-upload me-2"></i> Upload
                            </button>
                        </form>
                        <div class="d-flex flex-column gap-2" style="max-height: 192px; overflow-y: auto;">
                            @forelse($project->documents as $doc)
                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded small">
                                    <span class="text-truncate me-2">{{ $doc->title }}</span>
                                    <a href="{{ route('documents.download', $doc) }}" class="text-primary">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            @empty
                                <p class="text-muted small text-center mb-0">No documents</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Bills -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-semibold mb-0">Bills</h6>
                    </div>
                    <div class="card-body p-0">
                        @forelse($project->bills->where('status', '!=', 'draft') as $bill)
                            <a href="{{ route('client.bills.show', $bill) }}" class="d-block p-3 text-decoration-none border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                                <div class="d-flex justify-content-between align-items-center small">
                                    <span class="fw-medium text-dark">{{ $bill->bill_number }}</span>
                                    <span class="badge rounded-pill {{ $bill->status_badge }}">{{ ucfirst($bill->status) }}</span>
                                </div>
                                <p class="text-muted small mb-0">${{ number_format($bill->total, 2) }}</p>
                            </a>
                        @empty
                            <p class="p-3 text-muted small text-center mb-0">No bills</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection