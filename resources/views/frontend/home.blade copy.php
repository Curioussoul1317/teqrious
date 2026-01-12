<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $siteName = $settings['general']->firstWhere('key', 'site_name')->value ?? 'TEQRIOUS';
        $siteTagline = $settings['general']->firstWhere('key', 'site_tagline')->value ?? 'Building Digital Excellence';
        $metaDesc = $settings['seo']->firstWhere('key', 'meta_description')->value ?? 'TEQRIOUS - Professional IT solutions in Maldives.';
        $metaKeywords = $settings['seo']->firstWhere('key', 'meta_keywords')->value ?? 'IT solutions, web development, Maldives';
        $email = $settings['contact']->firstWhere('key', 'email')->value ?? '';
        $phone = $settings['contact']->firstWhere('key', 'phone')->value ?? '';
        $address = $settings['contact']->firstWhere('key', 'address')->value ?? '';
        $whatsapp = $settings['contact']->firstWhere('key', 'whatsapp')->value ?? null;
        $whatsappClean = $whatsapp ? preg_replace('/[^0-9]/', '', $whatsapp) : '';
    @endphp
    <title>{{ $siteName }} - {{ $siteTagline }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#001348">
    <link rel="canonical" href="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $siteName }} - {{ $siteTagline }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:image" content="{{ asset('img/og-image.png') }}">
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png" sizes="96x96">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
:root{--primary:#001348;--secondary:#aa134a;--third:#cb9430;--transition-normal:0.3s ease}
*{font-family:'Inter',sans-serif;box-sizing:border-box}body{overflow-x:hidden}
@keyframes fadeInUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
@keyframes fadeInDown{from{opacity:0;transform:translateY(-30px)}to{opacity:1;transform:translateY(0)}}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-20px)}}
@keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.05);opacity:0.8}}
@keyframes bounce{0%,20%,50%,80%,100%{transform:translateY(0)}40%{transform:translateY(-8px)}60%{transform:translateY(-4px)}}
@keyframes glow{0%,100%{box-shadow:0 0 20px rgba(203,148,48,0.3)}50%{box-shadow:0 0 40px rgba(203,148,48,0.6),0 0 60px rgba(170,19,74,0.3)}}
.reveal{opacity:0;transform:translateY(30px);transition:all 0.8s ease}.reveal.active{opacity:1;transform:translateY(0)}
.navbar{background:transparent;padding:1rem 0;transition:all var(--transition-normal);position:fixed;width:100%;z-index:1000}
.navbar.scrolled{background:var(--primary);box-shadow:0 2px 20px rgba(0,0,0,0.2);padding:0.5rem 0}
 
.nav-link{color:rgba(255,255,255,0.85)!important;font-weight:500;padding:0.5rem 1rem!important}.nav-link:hover{color:var(--third)!important}
.navbar-toggler{border:none}.navbar-toggler:focus{box-shadow:none}
.navbar-toggler-icon{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")}

/* HERO */
.hero{min-height:100vh;background:var(--primary);display:flex;align-items:center;color:#fff;position:relative;overflow:hidden;padding-top:80px}

/* --- TECH HERO BACKGROUND --- */
@keyframes techPan{0%{background-position:0 0,0 0,0 0}100%{background-position:600px 300px,-500px 250px,300px -600px}}
@keyframes circuitDrift{0%{transform:translate3d(0,0,0) rotate(0deg);opacity:.55}50%{transform:translate3d(-12px,10px,0) rotate(.2deg);opacity:.75}100%{transform:translate3d(0,0,0) rotate(0deg);opacity:.55}}
@keyframes streamScan{0%{transform:translateX(-30%) skewX(-12deg);opacity:0}10%{opacity:.55}50%{opacity:.35}100%{transform:translateX(130%) skewX(-12deg);opacity:0}}
@keyframes glowPulse{0%,100%{transform:translate(-50%,-50%) scale(1);opacity:.35}50%{transform:translate(-50%,-50%) scale(1.08);opacity:.55}}

.hero-tech{position:absolute;inset:0;pointer-events:none}
.hero-tech-base{
  background:
    radial-gradient(1200px 800px at 10% 20%, rgba(203,148,48,.18), transparent 55%),
    radial-gradient(900px 700px at 90% 30%, rgba(170,19,74,.22), transparent 55%),
    radial-gradient(1000px 900px at 50% 90%, rgba(0,255,255,.08), transparent 60%),
    linear-gradient(135deg, #001348 0%, #001a5c 45%, #0a1030 100%);
  opacity:1;
}
.hero-tech-circuit{
  opacity:.7;
  background:
    linear-gradient(rgba(203,148,48,.08) 1px, transparent 1px),
    linear-gradient(90deg, rgba(203,148,48,.08) 1px, transparent 1px),
    repeating-linear-gradient(90deg, rgba(255,255,255,.06) 0 1px, transparent 1px 80px),
    repeating-linear-gradient(0deg, rgba(255,255,255,.05) 0 1px, transparent 1px 90px),
    radial-gradient(circle at 20% 30%, rgba(203,148,48,.55) 0 2px, transparent 3px),
    radial-gradient(circle at 70% 20%, rgba(203,148,48,.45) 0 2px, transparent 3px),
    radial-gradient(circle at 55% 65%, rgba(170,19,74,.45) 0 2px, transparent 3px),
    radial-gradient(circle at 15% 80%, rgba(203,148,48,.35) 0 2px, transparent 3px),
    radial-gradient(circle at 85% 75%, rgba(0,255,255,.25) 0 2px, transparent 3px);
  background-size:
    60px 60px,
    60px 60px,
    160px 160px,
    180px 180px,
    auto, auto, auto, auto, auto;
  animation: techPan 22s linear infinite, circuitDrift 7s ease-in-out infinite;
  mix-blend-mode:screen;
}
.hero-tech-stream{
  opacity:.7;
  background:
    linear-gradient(90deg,
      transparent 0%,
      rgba(0,255,255,.00) 30%,
      rgba(0,255,255,.10) 45%,
      rgba(203,148,48,.22) 50%,
      rgba(170,19,74,.12) 55%,
      rgba(0,255,255,.00) 70%,
      transparent 100%);
  filter:blur(.2px);
  transform:translateX(-30%) skewX(-12deg);
  animation:streamScan 6.5s ease-in-out infinite;
}
.hero-tech-glow{
  opacity:.55;
  background:radial-gradient(circle at center,
    rgba(203,148,48,.22) 0%,
    rgba(0,255,255,.10) 22%,
    transparent 60%);
  width:120%;
  height:120%;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  animation:glowPulse 5s ease-in-out infinite;
  filter:blur(6px);
}
@media (prefers-reduced-motion: reduce){
  .hero-tech-circuit,.hero-tech-stream,.hero-tech-glow{animation:none!important}
}

.hero-content{position:relative;z-index:10;text-align:center;width:100%}
.hero h1{font-size:3rem;font-weight:800;line-height:1.2;margin-bottom:1rem;animation:fadeInDown 0.8s ease;text-shadow:0 4px 30px rgba(0,0,0,0.3)}
.hero .lead{font-size:1.15rem;margin-bottom:2rem;animation:fadeInUp 0.8s ease 0.2s forwards;opacity:0;max-width:600px;margin-left:auto;margin-right:auto}
.hero-image-wrapper{position:relative;margin:2rem auto;max-width:500px;animation:fadeInUp 0.8s ease 0.3s forwards;opacity:0}
.hero-image{max-width:100%;height:auto;max-height:350px;object-fit:contain;filter:drop-shadow(0 20px 40px rgba(0,0,0,0.4));animation:float 6s ease-in-out infinite}
.hero-image-glow{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:80%;height:80%;background:radial-gradient(ellipse,rgba(203,148,48,0.2) 0%,transparent 70%);filter:blur(40px);z-index:-1;animation:pulse 4s ease-in-out infinite}
.btn-cta{background:var(--third);color:#fff;padding:16px 40px;border-radius:50px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:10px;transition:all var(--transition-normal);border:2px solid var(--third);animation:fadeInUp 0.8s ease 0.5s forwards,glow 3s ease-in-out infinite;opacity:0}
.btn-cta:hover{background:transparent;color:#fff;transform:translateY(-3px);box-shadow:0 10px 30px rgba(203,148,48,0.4)}

.section{padding:100px 0}.section-title{font-size:2.5rem;font-weight:800;color:var(--primary);margin-bottom:1rem}
.section-title::after{content:'';display:block;width:60px;height:4px;background:linear-gradient(90deg,var(--third),var(--secondary));margin-top:15px;border-radius:2px}
.section-title.text-center::after{margin-left:auto;margin-right:auto}
.section-title.text-white::after{background:linear-gradient(90deg,var(--third),#fff)}
.section-subtitle{color:#666;font-size:1.1rem;margin-bottom:50px}
.card-custom{border:none;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.08);transition:all var(--transition-normal);overflow:hidden;background:#fff}
.card-custom:hover{transform:translateY(-10px);box-shadow:0 20px 50px rgba(0,0,0,0.15)}
.card-custom .card-icon{width:70px;height:70px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.75rem;margin-bottom:1.5rem}
.card-icon-primary{background:linear-gradient(135deg,rgba(0,19,72,0.1),rgba(0,19,72,0.05));color:var(--primary)}
.card-icon-secondary{background:linear-gradient(135deg,rgba(170,19,74,0.1),rgba(170,19,74,0.05));color:var(--secondary)}
.card-icon-third{background:linear-gradient(135deg,rgba(203,148,48,0.1),rgba(203,148,48,0.05));color:var(--third)}
.card-custom h5{font-weight:700;color:var(--primary)}.card-custom p{color:#666;line-height:1.7}

/* Service Tiles - Mini Grid */
.service-tile{background:#fff;border-radius:16px;padding:1.5rem;text-align:center;transition:all var(--transition-normal);border:2px solid #eee}
.service-tile:hover{border-color:var(--third);transform:translateY(-5px);box-shadow:0 15px 40px rgba(0,0,0,0.1)}
.service-tile i{font-size:2rem;color:var(--secondary);margin-bottom:1rem}
.service-tile h6{font-weight:700;color:var(--primary);margin:0}

/* Values Section */
.value-card{text-align:center;padding:2rem 1rem}
.value-card .value-icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--secondary));display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;color:#fff;font-size:1.75rem;transition:all var(--transition-normal)}
.value-card:hover .value-icon{transform:scale(1.1);box-shadow:0 10px 30px rgba(0,19,72,0.3)}
.value-card h5{font-weight:700;color:var(--primary);margin-bottom:0.5rem}
.value-card p{color:#666;font-size:0.9rem;margin:0}

/* Work Steps - Timeline */
.work-steps{position:relative;display:flex;justify-content:space-between;flex-wrap:wrap;padding:2rem 0}
.work-steps::before{content:'';position:absolute;top:40px;left:10%;right:10%;height:3px;background:linear-gradient(90deg,var(--primary),var(--secondary),var(--third));border-radius:2px}
.work-step{flex:1;min-width:150px;text-align:center;position:relative;padding:0 10px}
.work-step-number{width:50px;height:50px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;margin:0 auto 1rem;position:relative;z-index:1;transition:all var(--transition-normal)}
.work-step:hover .work-step-number{background:var(--third);transform:scale(1.1)}
.work-step h6{font-weight:700;color:var(--primary);margin-bottom:0.25rem}
.work-step p{font-size:0.85rem;color:#666;margin:0}

/* Expertise Cards */
.expertise-card{background:#fff;border-radius:20px;padding:2rem;height:100%;transition:all var(--transition-normal);border-left:4px solid var(--third)}
.expertise-card:hover{transform:translateX(10px);box-shadow:0 10px 40px rgba(0,0,0,0.1)}
.expertise-card h5{font-weight:700;color:var(--primary);margin-bottom:0.5rem}
.expertise-card p{color:#666;font-size:0.95rem;margin-bottom:1rem}
.expertise-card ul{list-style:none;padding:0;margin:0}
.expertise-card ul li{padding:0.25rem 0;color:#555;font-size:0.9rem}
.expertise-card ul li::before{content:'✓';color:var(--third);font-weight:700;margin-right:8px}

.project-card{border-radius:20px;overflow:hidden}.project-card img{transition:transform 0.5s ease}.project-card:hover img{transform:scale(1.1)}
.project-card .badge{background:linear-gradient(135deg,var(--primary),var(--secondary));padding:6px 12px;border-radius:20px}

.subsidiary-card{background:#fff;border-radius:20px;padding:2rem;text-align:center;transition:all var(--transition-normal)}
.subsidiary-card:hover{transform:translateY(-10px);box-shadow:0 20px 50px rgba(0,0,0,0.15)}
.subsidiary-card img{height:60px;object-fit:contain;margin-bottom:1rem}.subsidiary-card .btn{border-radius:50px;padding:8px 24px;font-weight:600}

.about-image{position:relative}.about-image img{border-radius:20px;box-shadow:0 20px 50px rgba(0,0,0,0.1)}
.about-image::before{content:'';position:absolute;top:-20px;left:-20px;right:20px;bottom:20px;border:3px solid var(--third);border-radius:20px;z-index:-1}

.subsidiaries-section{background:linear-gradient(135deg,var(--primary) 0%,#002266 100%);position:relative;overflow:hidden}
.expertise-section{background:linear-gradient(180deg,#f8f9fa 0%,#fff 100%)}

.contact-form{background:#fff;border-radius:20px;padding:3rem;box-shadow:0 20px 50px rgba(0,0,0,0.1)}
.contact-form .form-control{border:2px solid #eee;border-radius:12px;padding:14px 18px}.contact-form .form-control:focus{border-color:var(--primary);box-shadow:0 0 0 4px rgba(0,19,72,0.1)}
.contact-form .form-label{font-weight:600;color:var(--primary)}
.btn-submit{background:linear-gradient(135deg,var(--primary),var(--secondary));color:#fff;border:none;border-radius:50px;padding:16px 40px;font-weight:600;width:100%}
.btn-submit:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,19,72,0.3);color:#fff}

/* CTA Band */
.cta-band{background:linear-gradient(135deg,var(--third) 0%,#e0a830 100%);padding:60px 0;text-align:center}
.cta-band h3{color:#fff;font-weight:800;margin-bottom:1rem}
.cta-band p{color:rgba(255,255,255,0.9);margin-bottom:1.5rem}
.cta-band .btn{background:#fff;color:var(--primary);border:none;padding:14px 40px;border-radius:50px;font-weight:600;transition:all var(--transition-normal)}
.cta-band .btn:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,0.2)}

.footer{background:var(--primary);color:#fff;padding:80px 0 30px}.footer-brand{font-size:2rem;font-weight:800}.footer-brand span{color:var(--third)}
.footer-links a{color:rgba(255,255,255,0.7);text-decoration:none}.footer-links a:hover{color:var(--third)}
.social-links a{width:45px;height:45px;border-radius:12px;background:rgba(255,255,255,0.1);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;margin-right:10px;transition:all var(--transition-normal)}
.social-links a:hover{background:var(--third);transform:translateY(-5px)}

.chat-widget-button{position:fixed;bottom:30px;right:30px;width:65px;height:65px;border-radius:50%;background:linear-gradient(135deg,#25d366,#128c7e);border:none;color:#fff;font-size:1.75rem;cursor:pointer;box-shadow:0 8px 25px rgba(37,211,102,0.4);transition:all var(--transition-normal);z-index:1001;display:flex;align-items:center;justify-content:center}
.chat-widget-button:hover{transform:scale(1.1)}
.chat-notification-badge{position:absolute;top:-5px;right:-5px;width:24px;height:24px;background:var(--secondary);border-radius:50%;font-size:0.75rem;font-weight:700;display:flex;align-items:center;justify-content:center;animation:bounce 2s infinite}
.chat-window{position:fixed;bottom:110px;right:30px;width:380px;max-width:calc(100vw - 40px);height:520px;max-height:calc(100vh - 150px);background:#fff;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);z-index:1000;display:flex;flex-direction:column;overflow:hidden;opacity:0;visibility:hidden;transform:translateY(20px) scale(0.95);transition:all var(--transition-normal)}
.chat-window.show{opacity:1;visibility:visible;transform:translateY(0) scale(1)}
.chat-header{background:linear-gradient(135deg,var(--primary),#002266);color:#fff;padding:20px;display:flex;align-items:center;justify-content:space-between}
.chat-header-info{display:flex;align-items:center;gap:12px}
.chat-header-avatar{width:45px;height:45px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.chat-header-text h5{margin:0;font-size:1rem;font-weight:700}.chat-header-text p{margin:0;font-size:0.8rem;opacity:0.8}
.chat-close-btn{background:rgba(255,255,255,0.1);border:none;color:#fff;width:36px;height:36px;border-radius:10px;cursor:pointer}
.chat-body{flex:1;padding:20px;overflow-y:auto;background:#f8f9fa}
.chat-message{display:flex;gap:10px;margin-bottom:16px;animation:fadeInUp 0.3s ease}.chat-message.user{flex-direction:row-reverse}
.chat-message-avatar{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.chat-message.bot .chat-message-avatar{background:linear-gradient(135deg,var(--primary),var(--secondary));color:#fff}
.chat-message.user .chat-message-avatar{background:var(--third);color:#fff}
.chat-message-bubble{background:#fff;padding:14px 18px;border-radius:16px;max-width:75%;box-shadow:0 2px 10px rgba(0,0,0,0.05);line-height:1.5}
.chat-message.user .chat-message-bubble{background:linear-gradient(135deg,var(--primary),#002266);color:#fff;border-bottom-right-radius:4px}
.chat-message.bot .chat-message-bubble{border-bottom-left-radius:4px}
.contact-options{display:flex;flex-direction:column;gap:10px;margin-top:10px}
.contact-option-card{display:flex;align-items:center;gap:15px;padding:14px 18px;background:#fff;border-radius:14px;text-decoration:none;color:inherit;box-shadow:0 2px 10px rgba(0,0,0,0.05);transition:all 0.2s ease}
.contact-option-card:hover{transform:translateX(5px)}
.contact-option-icon{width:45px;height:45px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.contact-option-icon.whatsapp{background:rgba(37,211,102,0.15);color:#25d366}
.contact-option-icon.phone{background:rgba(0,19,72,0.1);color:var(--primary)}
.contact-option-icon.email{background:rgba(203,148,48,0.15);color:var(--third)}
.contact-option-text h6{margin:0;font-weight:600;color:var(--primary)}.contact-option-text p{margin:0;font-size:0.85rem;color:#666}
.chat-quick-options{padding:15px 20px;background:#fff;border-top:1px solid #eee;display:flex;flex-wrap:wrap;gap:8px}
.quick-option-btn{background:#f0f2f5;border:none;padding:10px 16px;border-radius:20px;font-size:0.85rem;font-weight:500;color:var(--primary);cursor:pointer}
.quick-option-btn:hover{background:var(--primary);color:#fff}
.chat-footer{padding:15px 20px;background:#fff;border-top:1px solid #eee}
.chat-input-wrapper{display:flex;gap:10px;align-items:center}
.chat-input{flex:1;border:2px solid #eee;border-radius:25px;padding:12px 20px;font-size:0.95rem;outline:none}.chat-input:focus{border-color:var(--primary)}
.chat-send-btn{width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--secondary));border:none;color:#fff;font-size:1.1rem;cursor:pointer;display:flex;align-items:center;justify-content:center}
.chat-send-btn:disabled{opacity:0.5;cursor:not-allowed}
.typing-indicator{display:flex;gap:4px;padding:14px 18px;background:#fff;border-radius:16px;border-bottom-left-radius:4px}
.typing-dot{width:8px;height:8px;background:#999;border-radius:50%;animation:typingBounce 1.4s infinite ease-in-out}
.typing-dot:nth-child(1){animation-delay:0s}.typing-dot:nth-child(2){animation-delay:0.2s}.typing-dot:nth-child(3){animation-delay:0.4s}
@keyframes typingBounce{0%,60%,100%{transform:translateY(0)}30%{transform:translateY(-6px)}}

@media(max-width:991.98px){
  .hero h1{font-size:2.5rem}
  .section{padding:60px 0}
  .section-title{font-size:2rem}
  .navbar-collapse{background:var(--primary);padding:20px;border-radius:15px;margin-top:15px}
  .about-image::before{display:none}
  .work-steps::before{display:none}
}
@media(max-width:767.98px){
  .hero{min-height:auto;padding:100px 0 60px}
  .hero h1{font-size:1.75rem}
  .hero .lead{font-size:0.95rem}
  .btn-cta{padding:14px 30px}
  .section{padding:50px 0}
  .section-title{font-size:1.75rem}
  .contact-form{padding:1.5rem}
  .chat-window{bottom:0;right:0;left:0;width:100%;max-width:100%;height:calc(100vh - 80px);border-radius:20px 20px 0 0}
  .chat-widget-button{bottom:20px;right:20px;width:60px;height:60px}
  .hero-image{max-height:250px}
  .work-step{min-width:100%;margin-bottom:1.5rem}
}
.text-third{color:var(--third)!important}

.navbar-brand{font-weight:800;font-size:1.75rem;text-decoration:none}
.navbar-brand .brand-te{color:#ffffff}
.navbar-brand .brand-q{color:#ac1d51}
.navbar-brand .brand-rious{color:#cb9430}

    </style>
</head>
<body>



    <nav class="navbar navbar-expand-lg" id="mainNavbar">
        <div class="container">
            <!-- <a class="navbar-brand" href="/">TE<img src="{{ asset('img/logo.jpg') }}" alt="Q" style="height: 35px; width: auto; vertical-align: middle;">RIOUS</a> -->
            <a class="navbar-brand" href="/"><span class="brand-te">TE</span><span class="brand-q">Q</span><span class="brand-rious">RIOUS</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#expertise">Expertise</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Work</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <!-- Tech animated background layers -->
        <div class="hero-tech hero-tech-base"></div>
        <div class="hero-tech hero-tech-circuit"></div>
        <div class="hero-tech hero-tech-stream"></div>
        <div class="hero-tech hero-tech-glow"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content">
                        @forelse($heroSlides as $index => $slide)
                            @if($index === 0)
                                <h1>{{ $slide->title }}</h1>
                                @if($slide->description)
                                    <p class="lead">{{ $slide->description }}</p>
                                @endif
                                @if($slide->background_image)
                                    <div class="hero-image-wrapper">
                                        <div class="hero-image-glow"></div>
                                        <img src="{{ asset('storage/' . $slide->background_image) }}" alt="{{ $slide->title }}" class="hero-image">
                                    </div>
                                @endif
                                @if($slide->button_text)
                                    <a href="{{ $slide->button_link ?? '#contact' }}" class="btn-cta">{{ $slide->button_text }} <i class="bi bi-arrow-right"></i></a>
                                @endif
                            @endif
                        @empty
                            <h1>Building Digital<br>Excellence</h1>
                            <p class="lead">Transform your business with cutting-edge IT solutions.</p>
                            <a href="#contact" class="btn-cta">Get Started <i class="bi bi-arrow-right"></i></a>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        @if($highlightCards->count() > 0)
        <section class="section bg-white">
            <div class="container"><div class="row g-4">
                @foreach($highlightCards as $index => $card)
                <div class="col-md-6 col-lg-4"><div class="card-custom p-4 h-100 reveal"><div class="card-icon card-icon-{{ ['primary','secondary','third'][$index % 3] }}"><i class="{{ $card->icon ?? 'bi bi-star' }}"></i></div><h5>{{ $card->title }}</h5><p class="mb-0">{{ $card->description }}</p></div></div>
                @endforeach
            </div></div>
        </section>
        @endif

        @if($serviceTiles->count() > 0)
        <section class="section" style="background:#f8f9fa">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    @foreach($serviceTiles as $tile)
                    <div class="col-6 col-md-4 col-lg reveal">
                        <div class="service-tile h-100">
                            <i class="{{ $tile->icon ?? 'bi bi-gear' }}"></i>
                            <h6>{{ $tile->title }}</h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <section id="about" class="section">
            <div class="container"><div class="row align-items-center g-5">
                <div class="col-lg-6 reveal"><h2 class="section-title">Who We Are</h2>@if($about)<div>{!! $about->content !!}</div>@else<p class="text-muted">We are passionate technologists delivering innovative IT solutions.</p>@endif</div>
                @if($about && $about->image)<div class="col-lg-6 reveal"><div class="about-image"><img src="{{ asset('storage/' . $about->image) }}" class="img-fluid" alt="About" loading="lazy"></div></div>@endif
            </div></div>
        </section>

        @if($values->count() > 0)
        <section class="section" style="background:#f8f9fa">
            <div class="container">
                <div class="text-center mb-5 reveal"><h2 class="section-title text-center">Our Values</h2><p class="section-subtitle">The principles that guide everything we do</p></div>
                <div class="row g-4">
                    @foreach($values as $value)
                    <div class="col-6 col-md-4 col-lg reveal">
                        <div class="value-card">
                            <div class="value-icon"><i class="{{ $value->icon ?? 'bi bi-star' }}"></i></div>
                            <h5>{{ $value->title }}</h5>
                            @if($value->description)<p>{{ $value->description }}</p>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        @if($workSteps->count() > 0)
        <section class="section bg-white">
            <div class="container">
                <div class="text-center mb-5 reveal"><h2 class="section-title text-center">How We Work</h2><p class="section-subtitle">Our proven process for delivering excellence</p></div>
                <div class="work-steps reveal">
                    @foreach($workSteps as $index => $step)
                    <div class="work-step">
                        <div class="work-step-number">{{ $index + 1 }}</div>
                        <h6>{{ $step->title }}</h6>
                        @if($step->description)<p>{{ $step->description }}</p>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        @if($expertise->count() > 0)
        <section id="expertise" class="section expertise-section">
            <div class="container">
                <div class="text-center mb-5 reveal"><h2 class="section-title text-center">Our Expertise</h2><p class="section-subtitle">What we're strong at</p></div>
                <div class="row g-4">
                    @foreach($expertise as $exp)
                    <div class="col-md-6 reveal">
                        <div class="expertise-card">
                            <h5><i class="{{ $exp->icon ?? 'bi bi-gear' }} me-2 text-third"></i>{{ $exp->title }}</h5>
                            @if($exp->description)<p>{{ $exp->description }}</p>@endif
                            @if($exp->outcomes)
<ul>
    @foreach(is_array($exp->outcomes) ? $exp->outcomes : explode("\n", $exp->outcomes) as $outcome)
        @if(is_string($outcome) && trim($outcome))<li>{{ trim($outcome) }}</li>@endif
    @endforeach
</ul>
@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        @if($services->count() > 0)
        <section id="services" class="section bg-white">
            <div class="container">
                <div class="text-center mb-5 reveal"><h2 class="section-title text-center">Our Services</h2><p class="section-subtitle">Comprehensive IT solutions tailored to your needs</p></div>
                <div class="row g-4">@foreach($services as $service)<div class="col-md-6 col-lg-4"><div class="card-custom p-4 h-100 reveal"><div class="card-icon card-icon-secondary"><i class="{{ $service->icon ?? 'bi bi-gear' }}"></i></div><h5>{{ $service->title }}</h5><p class="mb-0">{{ $service->description }}</p></div></div>@endforeach</div>
            </div>
        </section>
        @endif

        @if($projects->count() > 0)
        <section id="projects" class="section" style="background:#f8f9fa">
            <div class="container">
                <div class="text-center mb-5 reveal"><h2 class="section-title text-center">Our Work</h2><p class="section-subtitle">Featured projects showcasing our expertise</p></div>
                <div class="row g-4">@foreach($projects->take(6) as $project)<div class="col-md-6 col-lg-4"><div class="card-custom project-card h-100 reveal">@if($project->image)<div style="overflow:hidden"><img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" style="height:220px;object-fit:cover" alt="{{ $project->title }}" loading="lazy"></div>@endif<div class="card-body p-4">@if($project->client_type)<span class="badge mb-2">{{ ucfirst($project->client_type) }}</span>@endif<h5>{{ $project->title }}</h5>@if($project->outcome)<p class="text-muted small mb-0">{{ Str::limit($project->outcome, 100) }}</p>@endif</div></div></div>@endforeach</div>
            </div>
        </section>
        @endif

        <section class="cta-band reveal">
            <div class="container">
                <h3>Ready to Transform Your Business?</h3>
                <p>Let's discuss how we can help you achieve your digital goals</p>
                <a href="#contact" class="btn">Request a Quote <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </section>

        @if($subsidiaries->count() > 0)
        <section class="section subsidiaries-section">
            <div class="container position-relative">
                <div class="text-center mb-5 reveal"><h2 class="section-title text-center text-white">Our Subsidiaries</h2><p class="section-subtitle text-white-50">Specialized solutions through our subsidiary brands</p></div>
                <div class="row g-4">@foreach($subsidiaries as $subsidiary)<div class="col-md-6 col-lg-4"><div class="subsidiary-card reveal">@if($subsidiary->logo)<img src="{{ asset('storage/' . $subsidiary->logo) }}" alt="{{ $subsidiary->name }}" loading="lazy">@else<div class="mb-3"><i class="bi bi-building fs-1 text-primary"></i></div>@endif<h5 class="text-primary">{{ $subsidiary->name }}</h5>@if($subsidiary->tagline)<p class="text-muted small mb-3">{{ $subsidiary->tagline }}</p>@endif<a href="{{ route('subsidiary.show', $subsidiary->slug) }}" class="btn btn-outline-primary">Explore <i class="bi bi-arrow-right ms-1"></i></a></div></div>@endforeach</div>
            </div>
        </section>
        @endif

        <section id="contact" class="section" style="background:linear-gradient(180deg,#f8f9fa 0%,#fff 100%)">
            <div class="container"><div class="row justify-content-center"><div class="col-lg-8">
                <div class="text-center mb-5 reveal"><h2 class="section-title text-center">Get In Touch</h2><p class="section-subtitle">Ready to start your project? Contact us today!</p></div>
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                <div class="contact-form reveal"><form action="{{ route('contact.submit') }}" method="POST">@csrf<div class="row"><div class="col-md-6 mb-4"><label class="form-label">Full Name *</label><input type="text" class="form-control" name="name" required></div><div class="col-md-6 mb-4"><label class="form-label">Email *</label><input type="email" class="form-control" name="email" required></div><div class="col-md-6 mb-4"><label class="form-label">Phone</label><input type="tel" class="form-control" name="phone"></div><div class="col-md-6 mb-4"><label class="form-label">Company</label><input type="text" class="form-control" name="company"></div><div class="col-12 mb-4"><label class="form-label">Message *</label><textarea class="form-control" name="message" rows="5" required></textarea></div><div class="col-12"><button type="submit" class="btn-submit"><i class="bi bi-send me-2"></i>Send Message</button></div></div></form></div>
            </div></div></div>
        </section>
    </main>

    <footer class="footer">
        <div class="container"><div class="row g-5">
            <div class="col-lg-4"><div class="footer-brand">TEQ<span>RIOUS</span></div><p class="text-white-50 mb-4">{{ $siteTagline }}</p><div class="social-links">@if($fb = $settings['social']->firstWhere('key', 'facebook'))<a href="{{ $fb->value }}" target="_blank"><i class="bi bi-facebook"></i></a>@endif @if($ig = $settings['social']->firstWhere('key', 'instagram'))<a href="{{ $ig->value }}" target="_blank"><i class="bi bi-instagram"></i></a>@endif @if($li = $settings['social']->firstWhere('key', 'linkedin'))<a href="{{ $li->value }}" target="_blank"><i class="bi bi-linkedin"></i></a>@endif</div></div>
            <div class="col-lg-4"><h5 class="text-white mb-4">Quick Links</h5><div class="footer-links d-flex flex-column gap-2"><a href="#about">About Us</a><a href="#expertise">Expertise</a><a href="#services">Services</a><a href="#projects">Work</a><a href="#contact">Contact</a></div></div>
            <div class="col-lg-4"><h5 class="text-white mb-4">Contact Info</h5><div class="footer-links d-flex flex-column gap-3">@if($address)<div class="d-flex gap-3"><i class="bi bi-geo-alt text-third"></i><span class="text-white-50">{{ $address }}</span></div>@endif @if($email)<div class="d-flex gap-3"><i class="bi bi-envelope text-third"></i><a href="mailto:{{ $email }}">{{ $email }}</a></div>@endif @if($phone)<div class="d-flex gap-3"><i class="bi bi-telephone text-third"></i><a href="tel:{{ $phone }}">{{ $phone }}</a></div>@endif</div></div>
        </div><hr class="border-secondary my-5"><div class="text-center"><p class="text-white-50 mb-0">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p></div></div>
    </footer>

    <button class="chat-widget-button" id="chatWidgetBtn" aria-label="Open chat"><i class="bi bi-chat-dots-fill"></i><span class="chat-notification-badge" id="chatNotificationBadge" style="display: none;">1</span></button>
    <div class="chat-window" id="chatWindow">
        <div class="chat-header"><div class="chat-header-info"><div class="chat-header-avatar"><i class="bi bi-building"></i></div><div class="chat-header-text"><h5>{{ $siteName }} Support</h5><p>Typically replies instantly</p></div></div><button class="chat-close-btn" id="chatCloseBtn"><i class="bi bi-x-lg"></i></button></div>
        <div class="chat-body" id="chatBody"><div class="chat-message bot"><div class="chat-message-avatar"><i class="bi bi-building"></i></div><div><div class="chat-message-bubble">Hi! Welcome to {{ $siteName }}. How can we help you today?</div></div></div></div>
        <div class="chat-quick-options" id="quickOptions"><button class="quick-option-btn" data-message="I need IT consulting">IT Consulting</button><button class="quick-option-btn" data-message="Web development inquiry">Web Development</button><button class="quick-option-btn" data-message="Get a quote">Get Quote</button><button class="quick-option-btn" data-message="Contact support">Support</button></div>
        <div class="chat-footer"><div class="chat-input-wrapper"><input type="text" class="chat-input" id="chatInput" placeholder="Type your message..." autocomplete="off"><button class="chat-send-btn" id="chatSendBtn"><i class="bi bi-send-fill"></i></button></div></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
var navbar=document.getElementById('mainNavbar');window.addEventListener('scroll',function(){navbar.classList.toggle('scrolled',window.scrollY>50)});var revealElements=document.querySelectorAll('.reveal');function revealOnScroll(){revealElements.forEach(function(el){if(el.getBoundingClientRect().top<window.innerHeight-150){el.classList.add('active')}})}window.addEventListener('scroll',revealOnScroll);window.addEventListener('load',revealOnScroll);document.querySelectorAll('a[href^="#"]').forEach(function(anchor){anchor.addEventListener('click',function(e){e.preventDefault();var target=document.querySelector(this.getAttribute('href'));if(target){window.scrollTo({top:target.offsetTop-80,behavior:'smooth'});var nc=document.querySelector('.navbar-collapse');if(nc&&nc.classList.contains('show')){var b=bootstrap.Collapse.getInstance(nc);if(b)b.hide()}}})});var chatWidgetBtn=document.getElementById('chatWidgetBtn');var chatWindow=document.getElementById('chatWindow');var chatCloseBtn=document.getElementById('chatCloseBtn');var chatBody=document.getElementById('chatBody');var chatInput=document.getElementById('chatInput');var chatSendBtn=document.getElementById('chatSendBtn');var quickOptions=document.querySelectorAll('.quick-option-btn');var whatsappNumber='{{ $whatsappClean }}';var contactPhone='{{ $phone }}';var contactEmail='{{ $email }}';chatWidgetBtn.addEventListener('click',function(){chatWindow.classList.toggle('show');if(chatWindow.classList.contains('show')){chatInput.focus();document.getElementById('chatNotificationBadge').style.display='none'}});chatCloseBtn.addEventListener('click',function(){chatWindow.classList.remove('show')});function sendMessage(message){if(!message.trim())return;addMessage(message,'user');chatInput.value='';scrollToBottom();showTypingIndicator();setTimeout(function(){hideTypingIndicator();handleBotResponse(message)},1500)}function addMessage(text,sender){var messageDiv=document.createElement('div');messageDiv.className='chat-message '+sender;var avatar=document.createElement('div');avatar.className='chat-message-avatar';avatar.innerHTML=sender==='bot'?'<i class="bi bi-building"></i>':'<i class="bi bi-person-fill"></i>';var bubble=document.createElement('div');bubble.className='chat-message-bubble';bubble.textContent=text;if(sender==='bot')messageDiv.appendChild(avatar);messageDiv.appendChild(bubble);if(sender==='user')messageDiv.appendChild(avatar);chatBody.appendChild(messageDiv);scrollToBottom()}function handleBotResponse(userMessage){var lowerMessage=userMessage.toLowerCase();if(lowerMessage.indexOf('quote')!==-1||lowerMessage.indexOf('price')!==-1){addMessage("I'd be happy to help you get a quote! Contact us:",'bot');addContactOptions()}else if(lowerMessage.indexOf('service')!==-1||lowerMessage.indexOf('consulting')!==-1||lowerMessage.indexOf('development')!==-1){addMessage("We offer web development, mobile apps, and IT consulting. Contact us:",'bot');addContactOptions()}else if(lowerMessage.indexOf('contact')!==-1||lowerMessage.indexOf('support')!==-1){addMessage("Here are the best ways to reach us:",'bot');addContactOptions()}else{addMessage("Thanks for reaching out! Contact us for assistance:",'bot');addContactOptions()}}function addContactOptions(){var optionsDiv=document.createElement('div');optionsDiv.className='contact-options';var html='';if(whatsappNumber){html+='<a href="https://wa.me/'+whatsappNumber+'?text=Hello" target="_blank" class="contact-option-card"><div class="contact-option-icon whatsapp"><i class="bi bi-whatsapp"></i></div><div class="contact-option-text"><h6>WhatsApp</h6><p>Chat instantly</p></div></a>'}if(contactPhone){html+='<a href="tel:'+contactPhone+'" class="contact-option-card"><div class="contact-option-icon phone"><i class="bi bi-telephone-fill"></i></div><div class="contact-option-text"><h6>Call Us</h6><p>'+contactPhone+'</p></div></a>'}if(contactEmail){html+='<a href="mailto:'+contactEmail+'" class="contact-option-card"><div class="contact-option-icon email"><i class="bi bi-envelope-fill"></i></div><div class="contact-option-text"><h6>Email</h6><p>'+contactEmail+'</p></div></a>'}optionsDiv.innerHTML=html;chatBody.appendChild(optionsDiv);scrollToBottom()}function showTypingIndicator(){var indicator=document.createElement('div');indicator.className='chat-message bot';indicator.id='typingIndicator';indicator.innerHTML='<div class="chat-message-avatar"><i class="bi bi-building"></i></div><div class="typing-indicator"><div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div></div>';chatBody.appendChild(indicator);scrollToBottom()}function hideTypingIndicator(){var indicator=document.getElementById('typingIndicator');if(indicator)indicator.remove()}function scrollToBottom(){chatBody.scrollTop=chatBody.scrollHeight}chatSendBtn.addEventListener('click',function(){sendMessage(chatInput.value)});chatInput.addEventListener('keypress',function(e){if(e.key==='Enter')sendMessage(chatInput.value)});chatInput.addEventListener('input',function(){chatSendBtn.disabled=!this.value.trim()});quickOptions.forEach(function(option){option.addEventListener('click',function(){sendMessage(this.getAttribute('data-message'))})});setTimeout(function(){if(!chatWindow.classList.contains('show')){document.getElementById('chatNotificationBadge').style.display='flex'}},5000);
    </script>
</body>
</html>
