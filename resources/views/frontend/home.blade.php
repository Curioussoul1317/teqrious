<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['general']->firstWhere('key', 'site_name')->value ?? 'TEQRIOUS' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #001348; --secondary: #aa134a; --third: #cb9430; }
        * { font-family: 'Inter', sans-serif; }
        .navbar { background: var(--primary); padding: 1rem 0; }
        .navbar-brand { color: #fff !important; font-weight: 800; font-size: 1.75rem; }
        .navbar-brand span { color: var(--third); }
        .nav-link { color: rgba(255,255,255,0.8) !important; }
        .nav-link:hover { color: var(--third) !important; }
        .hero { min-height: 80vh; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; color: #fff; position: relative; }
        .hero-slide { display: none; }
        .hero-slide.active { display: block; }
        .hero h1 { font-size: 3.5rem; font-weight: 800; }
        .btn-cta { background: var(--third); color: #fff; padding: 15px 40px; border-radius: 50px; font-weight: 600; }
        .btn-cta:hover { background: #fff; color: var(--primary); }
        .section { padding: 80px 0; }
        .section-title { font-size: 2.5rem; font-weight: 800; color: var(--primary); margin-bottom: 50px; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s; }
        .card-custom:hover { transform: translateY(-10px); }
        .footer { background: var(--primary); color: #fff; padding: 60px 0 30px; }
        .whatsapp-float { position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; background: #25d366; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2rem; z-index: 1000; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">TEQ<span>RIOUS</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            @forelse($heroSlides as $index => $slide)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                <h1>{{ $slide->title }}</h1>
                @if($slide->description)<p class="lead">{{ $slide->description }}</p>@endif
                @if($slide->button_text)<a href="{{ $slide->button_link ?? '#contact' }}" class="btn btn-cta mt-3">{{ $slide->button_text }}</a>@endif
            </div>
            @empty
            <div class="hero-slide active">
                <h1>Building Digital Excellence</h1>
                <p class="lead">Professional IT solutions for your business</p>
                <a href="#contact" class="btn btn-cta mt-3">Get Started</a>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Highlight Cards -->
    @if($highlightCards->count() > 0)
    <section class="section bg-light">
        <div class="container">
            <div class="row g-4">
                @foreach($highlightCards as $card)
                <div class="col-md-4">
                    <div class="card card-custom p-4 text-center h-100">
                        <i class="{{ $card->icon ?? 'bi bi-star' }} fs-1 mb-3" style="color: var(--third);"></i>
                        <h4>{{ $card->title }}</h4>
                        <p class="text-muted">{{ $card->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title text-center">Who We Are</h2>
            @if($about)
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="pe-lg-5">{!! $about->content !!}</div>
                </div>
                @if($about->image)
                <div class="col-lg-6">
                    <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid rounded" alt="About Us">
                </div>
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- Services Section -->
    @if($services->count() > 0)
    <section id="services" class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Our Services</h2>
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom p-4 h-100">
                        <i class="{{ $service->icon ?? 'bi bi-gear' }} fs-1 mb-3" style="color: var(--secondary);"></i>
                        <h5>{{ $service->title }}</h5>
                        <p class="text-muted">{{ $service->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Projects Section -->
    @if($projects->count() > 0)
    <section id="projects" class="section">
        <div class="container">
            <h2 class="section-title text-center">Our Work</h2>
            <div class="row g-4">
                @foreach($projects->take(6) as $project)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100">
                        @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5>{{ $project->title }}</h5>
                            @if($project->outcome)<p class="text-muted small">{{ Str::limit($project->outcome, 100) }}</p>@endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Subsidiaries Section -->
    @if($subsidiaries->count() > 0)
    <section class="section" style="background: var(--primary); color: #fff;">
        <div class="container">
            <h2 class="section-title text-center text-white">Our Subsidiaries</h2>
            <div class="row g-4">
                @foreach($subsidiaries as $subsidiary)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom p-4 h-100 text-center">
                        @if($subsidiary->logo)
                        <img src="{{ asset('storage/' . $subsidiary->logo) }}" alt="{{ $subsidiary->name }}" style="height: 60px; object-fit: contain; margin-bottom: 15px;">
                        @endif
                        <h5>{{ $subsidiary->name }}</h5>
                        @if($subsidiary->tagline)<p class="text-muted small">{{ $subsidiary->tagline }}</p>@endif
                        <a href="{{ route('subsidiary.show', $subsidiary->slug) }}" class="btn btn-outline-primary btn-sm mt-auto">Explore</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card card-custom p-4">
                        <form action="{{ route('contact.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" name="company">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Message *</label>
                                    <textarea class="form-control" name="message" rows="4" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-cta w-100">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <h4 class="mb-3">TEQ<span style="color: var(--third);">RIOUS</span></h4>
            <p class="mb-4">{{ $settings['contact']->firstWhere('key', 'address')->value ?? '' }}</p>
            <p class="small opacity-75">&copy; {{ date('Y') }} TEQRIOUS. All rights reserved.</p>
        </div>
    </footer>

    <!-- WhatsApp Float -->
    @php $whatsapp = $settings['contact']->firstWhere('key', 'whatsapp')->value ?? null; @endphp
    @if($whatsapp)
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" class="whatsapp-float" target="_blank">
        <i class="bi bi-whatsapp"></i>
    </a>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
