<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subsidiary->name }} - TEQRIOUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --primary: #001348; --secondary: #aa134a; --third: #cb9430; }
        .navbar { background: var(--primary); }
        .navbar-brand { color: #fff !important; font-weight: 800; }
        .navbar-brand span { color: var(--third); }
        .nav-link { color: rgba(255,255,255,0.8) !important; }
        .hero { min-height: 50vh; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; display: flex; align-items: center; }
        .section { padding: 60px 0; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">TEQ<span>RIOUS</span></a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('home') }}">← Back</a>
            </div>
        </div>
    </nav>

    <section class="hero text-center">
        <div class="container">
            @if($subsidiary->logo)
            <img src="{{ asset('storage/' . $subsidiary->logo) }}" alt="{{ $subsidiary->name }}" style="height: 80px; margin-bottom: 20px;">
            @endif
            <h1>{{ $subsidiary->name }}</h1>
            @if($subsidiary->tagline)<p class="lead">{{ $subsidiary->tagline }}</p>@endif
        </div>
    </section>

    @if($subsidiary->description)
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <p class="lead">{{ $subsidiary->description }}</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($subsidiary->services->count() > 0)
    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Our Services</h2>
            <div class="row g-4">
                @foreach($subsidiary->services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom p-4 h-100">
                        <i class="{{ $service->icon ?? 'bi bi-star' }} fs-1 mb-3" style="color: var(--third);"></i>
                        <h5>{{ $service->title }}</h5>
                        @if($service->description)<p class="text-muted">{{ $service->description }}</p>@endif
                        @if($service->price)<p class="fw-bold" style="color: var(--secondary);">MVR {{ number_format($service->price, 2) }}</p>@endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">Request a Quote</h2>
            @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card card-custom p-4">
                        <form action="{{ route('subsidiary.quote', $subsidiary) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            @if($subsidiary->services->count() > 0)
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <select class="form-select" name="subsidiary_service_id">
                                    <option value="">Select a service</option>
                                    @foreach($subsidiary->services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Requirements</label>
                                <textarea class="form-control" name="requirements" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn w-100" style="background: var(--secondary); color: #fff;">Request Quote</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer style="background: var(--primary); color: #fff; padding: 30px 0; text-align: center;">
        <p class="mb-0">&copy; {{ date('Y') }} {{ $subsidiary->name }} - A TEQRIOUS Subsidiary</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
