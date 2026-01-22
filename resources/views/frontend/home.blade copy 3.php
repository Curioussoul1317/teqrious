<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png" sizes="96x96">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
:root{--primary:#001348;--primary-light:#0a2463;--secondary:#aa134a;--secondary-light:#d41a5c;--third:#cb9430;--third-light:#e5a93d;--white:#fff;--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-300:#cbd5e1;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;--shadow-sm:0 1px 2px rgba(0,0,0,0.05);--shadow:0 1px 3px rgba(0,0,0,0.1),0 1px 2px rgba(0,0,0,0.06);--shadow-md:0 4px 6px -1px rgba(0,0,0,0.1),0 2px 4px -1px rgba(0,0,0,0.06);--shadow-lg:0 10px 15px -3px rgba(0,0,0,0.1),0 4px 6px -2px rgba(0,0,0,0.05);--shadow-xl:0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04);--shadow-glow:0 0 40px rgba(170,19,74,0.3);--radius:12px;--radius-lg:20px;--radius-xl:28px}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
body{font-family:'Plus Jakarta Sans',system-ui,-apple-system,sans-serif;font-size:16px;line-height:1.7;color:var(--gray-700);background:var(--white);overflow-x:hidden;-webkit-font-smoothing:antialiased}
h1,h2,h3,h4,h5,h6{font-family:'Space Grotesk',sans-serif;font-weight:700;color:var(--primary);line-height:1.2;letter-spacing:-0.02em}
a{color:inherit;text-decoration:none}
img{max-width:100%;height:auto}
.container{width:100%;max-width:1200px;margin:0 auto;padding:0 20px}
@media(max-width:640px){.container{padding:0 16px}}

/* ===== SPLASH SCREEN ===== */
.splash{position:fixed;inset:0;background:var(--primary);z-index:9999;display:flex;align-items:center;justify-content:center;flex-direction:column;overflow:hidden}
.splash::before{content:'';position:absolute;width:200%;height:200%;background:radial-gradient(circle at 30% 20%,rgba(170,19,74,0.15) 0%,transparent 40%),radial-gradient(circle at 70% 80%,rgba(203,148,48,0.1) 0%,transparent 40%);animation:splashBg 8s ease-in-out infinite}
@keyframes splashBg{0%,100%{transform:translate(-10%,-10%) rotate(0deg)}50%{transform:translate(0%,0%) rotate(5deg)}}
.splash-particles{position:absolute;inset:0;overflow:hidden}
.splash-particle{position:absolute;width:6px;height:6px;background:var(--third);border-radius:50%;opacity:0}
.splash-particle:nth-child(1){left:10%;top:20%;animation:particleFly 4s ease-in-out 0.2s infinite}
.splash-particle:nth-child(2){left:85%;top:15%;animation:particleFly 5s ease-in-out 0.5s infinite}
.splash-particle:nth-child(3){left:70%;top:70%;animation:particleFly 4.5s ease-in-out 0.8s infinite}
.splash-particle:nth-child(4){left:20%;top:75%;animation:particleFly 5.5s ease-in-out 0.3s infinite}
.splash-particle:nth-child(5){left:50%;top:10%;animation:particleFly 4s ease-in-out 1s infinite}
.splash-particle:nth-child(6){left:90%;top:50%;animation:particleFly 6s ease-in-out 0.6s infinite}
.splash-particle:nth-child(7){left:5%;top:50%;animation:particleFly 5s ease-in-out 0.9s infinite}
.splash-particle:nth-child(8){left:40%;top:85%;animation:particleFly 4.5s ease-in-out 0.4s infinite}
@keyframes particleFly{0%{opacity:0;transform:translateY(0) scale(0)}20%{opacity:1;transform:translateY(-30px) scale(1)}80%{opacity:0.5;transform:translateY(-100px) scale(0.5)}100%{opacity:0;transform:translateY(-150px) scale(0)}}
.splash-rings{position:absolute;width:300px;height:300px}
.splash-ring{position:absolute;inset:0;border:2px solid rgba(203,148,48,0.2);border-radius:50%;animation:ringPulse 3s ease-out infinite}
.splash-ring:nth-child(2){animation-delay:0.5s}
.splash-ring:nth-child(3){animation-delay:1s}
@keyframes ringPulse{0%{transform:scale(0.5);opacity:1}100%{transform:scale(2);opacity:0}}
.splash-logo{position:relative;z-index:2;display:flex;align-items:center;font-family:'Space Grotesk',sans-serif;font-size:clamp(3rem,10vw,5rem);font-weight:700;letter-spacing:-0.03em}
.splash-logo .te{color:var(--white);opacity:0;transform:translateX(-50px) rotateY(-90deg);animation:letterSlide 0.8s cubic-bezier(0.34,1.56,0.64,1) 0.3s forwards}
.splash-logo .q{color:var(--secondary);opacity:0;transform:scale(0) rotate(-180deg);animation:letterPop 1s cubic-bezier(0.34,1.56,0.64,1) 0.6s forwards;text-shadow:0 0 60px rgba(170,19,74,0.8)}
.splash-logo .rious{color:var(--third);opacity:0;transform:translateX(50px) rotateY(90deg);animation:letterSlide 0.8s cubic-bezier(0.34,1.56,0.64,1) 0.9s forwards;text-shadow:0 0 40px rgba(203,148,48,0.5)}
@keyframes letterSlide{to{opacity:1;transform:translateX(0) rotateY(0)}}
@keyframes letterPop{to{opacity:1;transform:scale(1) rotate(0deg)}}
.splash-tagline{position:relative;z-index:2;color:var(--gray-400);font-size:1rem;letter-spacing:0.3em;text-transform:uppercase;margin-top:1.5rem;opacity:0;transform:translateY(20px);animation:fadeUp 0.6s ease 1.2s forwards}
.splash-loader{position:relative;z-index:2;width:180px;height:4px;background:rgba(255,255,255,0.1);border-radius:4px;margin-top:2.5rem;overflow:hidden;opacity:0;animation:fadeUp 0.4s ease 1.4s forwards}
.splash-loader::after{content:'';position:absolute;left:0;top:0;height:100%;width:0;background:linear-gradient(90deg,var(--secondary),var(--third));border-radius:inherit;animation:loaderFill 1.8s cubic-bezier(0.4,0,0.2,1) 1.6s forwards}
@keyframes loaderFill{to{width:100%}}
.splash-code{position:absolute;font-family:monospace;font-size:0.7rem;color:rgba(203,148,48,0.3);white-space:nowrap;animation:codeScroll 20s linear infinite}
.splash-code:nth-child(1){top:10%;left:5%;animation-duration:25s}
.splash-code:nth-child(2){top:30%;right:5%;animation-duration:22s;animation-direction:reverse}
.splash-code:nth-child(3){bottom:20%;left:10%;animation-duration:28s}
@keyframes codeScroll{0%{transform:translateX(-100%)}100%{transform:translateX(100vw)}}
.splash.exit{animation:splashExit 1s cubic-bezier(0.4,0,0.2,1) forwards}
.splash.exit .splash-logo,.splash.exit .splash-tagline,.splash.exit .splash-loader{animation:contentExit 0.5s ease forwards}
@keyframes contentExit{to{opacity:0;transform:scale(0.8) translateY(-30px)}}
@keyframes splashExit{0%{clip-path:circle(150% at 50% 50%)}100%{clip-path:circle(0% at 50% 50%)}}

/* ===== NAVBAR ===== */
.navbar{position:fixed;top:0;left:0;right:0;z-index:1000;padding:16px 0;background:transparent;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)}
.navbar.scrolled{background:rgba(255,255,255,0.95);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 4px 30px rgba(0,0,0,0.1);padding:10px 0}
.navbar .container{display:flex;align-items:center;justify-content:space-between;gap:16px}
.navbar-brand{font-family:'Space Grotesk',sans-serif;font-size:1.6rem;font-weight:700;display:flex;align-items:center;letter-spacing:-0.03em}
.brand-te{color:var(--white);transition:all 0.3s ease}
.brand-q{color:var(--secondary);display:inline-block;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1)}
.brand-rious{color:var(--third);transition:all 0.3s ease}
.navbar.scrolled .brand-te{color:var(--primary)}
.navbar-brand:hover .brand-q{transform:rotate(-12deg) scale(1.15)}
.navbar-nav{display:flex;align-items:center;gap:6px;list-style:none}
.nav-link{position:relative;padding:10px 18px;font-size:0.9rem;font-weight:500;color:rgba(255,255,255,0.9);border-radius:10px;transition:all 0.3s ease;overflow:hidden}
.navbar.scrolled .nav-link{color:var(--gray-600)}
.nav-link::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,var(--secondary),var(--third));opacity:0;transform:scale(0.8);border-radius:inherit;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);z-index:-1}
.nav-link:hover{color:var(--white)}
.nav-link:hover::before{opacity:1;transform:scale(1)}
.nav-subsidiary{display:flex;align-items:center;gap:8px;padding:10px 16px;background:rgba(203,148,48,0.15);border-radius:10px;color:var(--third);font-weight:600;font-size:0.85rem;transition:all 0.3s ease}
.nav-subsidiary:hover{background:var(--third);color:var(--white)}
.navbar.scrolled .nav-subsidiary{background:rgba(203,148,48,0.1)}
.nav-subsidiary svg{width:18px;height:18px}
.btn-login{display:flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,var(--secondary),var(--secondary-light));color:var(--white);font-size:0.85rem;font-weight:600;border-radius:10px;transition:all 0.3s ease;box-shadow:0 4px 15px rgba(170,19,74,0.3)}
.btn-login:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(170,19,74,0.4)}
.btn-login i{font-size:1.1rem}
.navbar-toggle{display:none;width:44px;height:44px;background:rgba(255,255,255,0.1);border:none;border-radius:10px;cursor:pointer;flex-direction:column;align-items:center;justify-content:center;gap:5px;transition:all 0.3s ease}
.navbar.scrolled .navbar-toggle{background:var(--gray-100)}
.navbar-toggle:hover{background:var(--secondary)}
.navbar-toggle span{display:block;width:22px;height:2px;background:var(--white);transition:all 0.3s ease}
.navbar.scrolled .navbar-toggle span{background:var(--primary)}
.navbar-toggle:hover span{background:var(--white)}
@media(max-width:991px){
.navbar-toggle{display:flex}
.navbar-nav{position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,19,72,0.98);backdrop-filter:blur(20px);flex-direction:column;justify-content:center;align-items:center;gap:12px;opacity:0;visibility:hidden;transition:all 0.4s ease}
.navbar-nav.show{opacity:1;visibility:visible}
.navbar-nav .nav-link{color:var(--white);font-size:1.2rem;padding:14px 28px}
.navbar-nav .nav-subsidiary{font-size:1rem;padding:14px 24px}
.navbar-nav .btn-login{font-size:1rem;padding:14px 28px}
.nav-close{position:absolute;top:20px;right:20px;width:44px;height:44px;background:rgba(255,255,255,0.1);border:none;border-radius:10px;font-size:1.5rem;color:var(--white);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.3s ease}
.nav-close:hover{background:var(--secondary)}
}

/* ===== HERO ===== */
.hero{min-height:100vh;display:flex;align-items:center;background:var(--primary);position:relative;overflow:hidden;padding:120px 0 80px}
.hero-bg{position:absolute;inset:0}
.hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(170,19,74,0.07) 1px,transparent 1px),linear-gradient(90deg,rgba(170,19,74,0.07) 1px,transparent 1px);background-size:60px 60px;animation:gridFloat 30s linear infinite}
@keyframes gridFloat{to{background-position:60px 60px}}
.hero-gradient{position:absolute;inset:0;background:radial-gradient(ellipse at 30% 20%,rgba(170,19,74,0.2) 0%,transparent 50%),radial-gradient(ellipse at 70% 80%,rgba(203,148,48,0.15) 0%,transparent 50%),radial-gradient(ellipse at 50% 50%,transparent 0%,var(--primary) 70%)}
.hero-glow{position:absolute;top:20%;left:50%;transform:translateX(-50%);width:600px;height:600px;background:radial-gradient(circle,rgba(170,19,74,0.3) 0%,transparent 60%);filter:blur(80px);animation:glowPulse 6s ease-in-out infinite}
@keyframes glowPulse{0%,100%{opacity:0.5;transform:translateX(-50%) scale(1)}50%{opacity:0.8;transform:translateX(-50%) scale(1.2)}}
.hero-lines{position:absolute;inset:0;overflow:hidden}
.hero-line{position:absolute;height:1px;background:linear-gradient(90deg,transparent,var(--third),transparent);opacity:0.3;animation:lineScan 8s ease-in-out infinite}
.hero-line:nth-child(1){top:20%;width:100%;animation-delay:0s}
.hero-line:nth-child(2){top:40%;width:80%;left:10%;animation-delay:2s}
.hero-line:nth-child(3){top:60%;width:90%;left:5%;animation-delay:4s}
.hero-line:nth-child(4){top:80%;width:70%;left:15%;animation-delay:6s}
@keyframes lineScan{0%,100%{transform:translateX(-100%);opacity:0}50%{transform:translateX(100%);opacity:0.5}}
.hero-dots{position:absolute;inset:0}
.hero-dot{position:absolute;width:4px;height:4px;background:var(--third);border-radius:50%;opacity:0.4;animation:dotPulse 4s ease-in-out infinite}
.hero-dot:nth-child(1){top:15%;left:10%;animation-delay:0s}
.hero-dot:nth-child(2){top:25%;right:15%;animation-delay:0.5s}
.hero-dot:nth-child(3){top:45%;left:20%;animation-delay:1s}
.hero-dot:nth-child(4){top:65%;right:25%;animation-delay:1.5s}
.hero-dot:nth-child(5){top:75%;left:30%;animation-delay:2s}
.hero-dot:nth-child(6){top:35%;right:10%;animation-delay:2.5s}
@keyframes dotPulse{0%,100%{transform:scale(1);opacity:0.4}50%{transform:scale(2);opacity:0.8}}
.hero-content{position:relative;z-index:2;text-align:center;max-width:750px;margin:0 auto}
.hero h1{font-size:clamp(2.2rem,7vw,4rem);color:var(--white);margin-bottom:1.25rem;opacity:0;transform:translateY(40px);animation:heroIn 1s cubic-bezier(0.16,1,0.3,1) 0.2s forwards}
.hero .lead{font-size:clamp(1rem,2.5vw,1.25rem);color:rgba(255,255,255,0.75);margin-bottom:2.5rem;opacity:0;transform:translateY(30px);animation:heroIn 1s cubic-bezier(0.16,1,0.3,1) 0.4s forwards}
@keyframes heroIn{to{opacity:1;transform:translateY(0)}}
.hero-image-wrapper{position:relative;max-width:500px;margin:2.5rem auto;opacity:0;transform:translateY(50px) scale(0.95);animation:heroImageIn 1.2s cubic-bezier(0.16,1,0.3,1) 0.6s forwards}
@keyframes heroImageIn{to{opacity:1;transform:translateY(0) scale(1)}}
.hero-image-glow{position:absolute;inset:-30%;background:radial-gradient(ellipse,rgba(203,148,48,0.3) 0%,transparent 60%);filter:blur(50px);animation:imgGlow 5s ease-in-out infinite}
@keyframes imgGlow{0%,100%{opacity:0.6;transform:scale(1)}50%{opacity:1;transform:scale(1.1)}}
.hero-image{position:relative;width:100%;border-radius:var(--radius-xl);box-shadow:0 30px 60px rgba(0,0,0,0.4);animation:imgFloat 5s ease-in-out infinite}
@keyframes imgFloat{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(-15px) rotate(1deg)}}
.btn-cta{display:inline-flex;align-items:center;gap:10px;padding:16px 36px;background:linear-gradient(135deg,var(--third),var(--third-light));color:var(--white);font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:1.05rem;border-radius:50px;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);box-shadow:0 8px 30px rgba(203,148,48,0.4);opacity:0;transform:translateY(30px);animation:heroIn 1s cubic-bezier(0.16,1,0.3,1) 0.8s forwards}
.btn-cta:hover{transform:translateY(-4px) scale(1.02);box-shadow:0 12px 40px rgba(203,148,48,0.5)}
.btn-cta i{transition:transform 0.3s ease}
.btn-cta:hover i{transform:translateX(4px)}

/* ===== SECTIONS ===== */
.section{padding:100px 0;position:relative}
@media(max-width:768px){.section{padding:70px 0}}
.section-header{text-align:center;max-width:600px;margin:0 auto 3.5rem}
.section-title{font-size:clamp(1.8rem,5vw,2.5rem);margin-bottom:1rem}
.section-title::after{content:'';display:block;width:60px;height:4px;background:linear-gradient(90deg,var(--secondary),var(--third));margin:16px auto 0;border-radius:2px}
.section-subtitle{color:var(--gray-500);font-size:1.05rem}
.bg-gray{background:var(--gray-50)}
.bg-dark{background:var(--primary)}

/* ===== REVEAL ANIMATIONS ===== */
.reveal{opacity:0;transform:translateY(50px);transition:all 0.8s cubic-bezier(0.16,1,0.3,1)}
.reveal.active{opacity:1;transform:translateY(0)}
.reveal-left{opacity:0;transform:translateX(-50px);transition:all 0.8s cubic-bezier(0.16,1,0.3,1)}
.reveal-left.active{opacity:1;transform:translateX(0)}
.reveal-right{opacity:0;transform:translateX(50px);transition:all 0.8s cubic-bezier(0.16,1,0.3,1)}
.reveal-right.active{opacity:1;transform:translateX(0)}
.reveal-scale{opacity:0;transform:scale(0.8);transition:all 0.8s cubic-bezier(0.16,1,0.3,1)}
.reveal-scale.active{opacity:1;transform:scale(1)}
.stagger-1{transition-delay:0.1s}
.stagger-2{transition-delay:0.2s}
.stagger-3{transition-delay:0.3s}
.stagger-4{transition-delay:0.4s}
.stagger-5{transition-delay:0.5s}
.stagger-6{transition-delay:0.6s}

/* ===== CARDS ===== */
.card{background:var(--white);border-radius:var(--radius-lg);box-shadow:var(--shadow);border:1px solid var(--gray-200);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);overflow:hidden;position:relative}
.card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--secondary),var(--third));transform:scaleX(0);transform-origin:left;transition:transform 0.4s ease}
.card:hover{transform:translateY(-8px);box-shadow:var(--shadow-xl);border-color:transparent}
.card:hover::before{transform:scaleX(1)}
.card-body{padding:1.75rem}
.card-icon{width:60px;height:60px;border-radius:var(--radius);display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin-bottom:1.25rem;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1)}
.card-icon-primary{background:linear-gradient(135deg,rgba(0,19,72,0.1),rgba(0,19,72,0.05));color:var(--primary)}
.card-icon-secondary{background:linear-gradient(135deg,rgba(170,19,74,0.1),rgba(170,19,74,0.05));color:var(--secondary)}
.card-icon-third{background:linear-gradient(135deg,rgba(203,148,48,0.1),rgba(203,148,48,0.05));color:var(--third)}
.card:hover .card-icon{transform:scale(1.1) rotate(-5deg)}
.card h5{font-size:1.15rem;margin-bottom:0.6rem}
.card p{color:var(--gray-500);font-size:0.95rem;margin:0;line-height:1.7}

/* ===== GRID ===== */
.grid{display:grid;gap:1.5rem}
.grid-2{grid-template-columns:repeat(2,1fr)}
.grid-3{grid-template-columns:repeat(3,1fr)}
.grid-4{grid-template-columns:repeat(4,1fr)}
.grid-5{grid-template-columns:repeat(5,1fr)}
@media(max-width:991px){.grid-3,.grid-4,.grid-5{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){.grid-2,.grid-3,.grid-4,.grid-5{grid-template-columns:1fr}}

/* ===== ABOUT ===== */
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center}
@media(max-width:768px){.about-grid{grid-template-columns:1fr;gap:2.5rem;text-align:center}}
.about-content .section-title{text-align:left}
.about-content .section-title::after{margin:16px 0 0}
@media(max-width:768px){.about-content .section-title{text-align:center}.about-content .section-title::after{margin:16px auto 0}}
.about-content p{color:var(--gray-600);margin-bottom:1.25rem;font-size:1.05rem}
.about-image{position:relative}
.about-image img{border-radius:var(--radius-xl);box-shadow:var(--shadow-xl)}
.about-image::before{content:'';position:absolute;top:-16px;left:-16px;right:16px;bottom:16px;border:3px solid var(--third);border-radius:var(--radius-xl);z-index:-1;transition:all 0.4s ease}
.about-image:hover::before{top:-20px;left:-20px}
@media(max-width:768px){.about-image::before{display:none}}

/* ===== VALUES ===== */
.value-card{background:var(--white);border-radius:var(--radius-lg);padding:2rem 1.5rem;text-align:center;border:1px solid var(--gray-200);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1)}
.value-card:hover{border-color:var(--secondary);transform:translateY(-8px);box-shadow:var(--shadow-lg)}
.value-icon{width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--primary-light));display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;color:var(--white);font-size:1.6rem;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);box-shadow:0 8px 25px rgba(0,19,72,0.3)}
.value-card:hover .value-icon{transform:scale(1.15) rotate(-5deg);background:linear-gradient(135deg,var(--secondary),var(--third))}
.value-card h5{font-size:1.05rem;margin-bottom:0.4rem}
.value-card p{font-size:0.9rem;color:var(--gray-500);margin:0}

/* ===== WORK STEPS ===== */
.steps-container{display:flex;justify-content:center;gap:1.5rem;flex-wrap:wrap;position:relative}
.steps-container::before{content:'';position:absolute;top:35px;left:15%;right:15%;height:3px;background:linear-gradient(90deg,var(--secondary),var(--third));z-index:0;border-radius:2px}
@media(max-width:768px){.steps-container::before{display:none}}
.step{flex:1;min-width:150px;max-width:200px;text-align:center;position:relative;z-index:1}
.step-number{width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--primary-light));color:var(--white);font-family:'Space Grotesk',sans-serif;font-size:1.5rem;font-weight:700;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;box-shadow:0 8px 25px rgba(0,19,72,0.3);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);border:4px solid var(--white)}
.step:hover .step-number{transform:scale(1.15);background:linear-gradient(135deg,var(--secondary),var(--third))}
.step h6{font-size:1rem;margin-bottom:0.4rem}
.step p{font-size:0.85rem;color:var(--gray-500);margin:0}

/* ===== SERVICES ===== */
.service-card{background:var(--white);border-radius:var(--radius-lg);padding:2rem;border:1px solid var(--gray-200);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);position:relative;overflow:hidden}
.service-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--secondary),var(--third));transform:scaleX(0);transition:transform 0.4s ease}
.service-card:hover{border-color:var(--secondary);box-shadow:var(--shadow-lg);transform:translateY(-5px)}
.service-card:hover::after{transform:scaleX(1)}
.service-card i{font-size:2.25rem;color:var(--secondary);margin-bottom:1rem;display:block;transition:all 0.4s ease}
.service-card:hover i{transform:scale(1.1);color:var(--third)}
.service-card h5{font-size:1.1rem;margin-bottom:0.6rem}
.service-card p{font-size:0.9rem;color:var(--gray-500);margin:0}

/* ===== PROJECTS ===== */
.project-card{overflow:hidden}
.project-card img{width:100%;height:220px;object-fit:cover;transition:all 0.5s ease}
.project-card:hover img{transform:scale(1.08)}
.project-card .card-body{padding:1.5rem}
.project-card .badge{display:inline-block;padding:5px 12px;background:linear-gradient(135deg,var(--primary),var(--secondary));color:var(--white);font-size:0.75rem;font-weight:600;border-radius:50px;margin-bottom:0.6rem}
.project-card h5{font-size:1.05rem;margin-bottom:0.4rem}

/* ===== CLIENTS ===== */
.clients-section{padding:70px 0;background:var(--white);overflow:hidden}
.clients-header{text-align:center;margin-bottom:2.5rem}
.clients-header h6{font-family:'Space Grotesk',sans-serif;font-size:0.9rem;text-transform:uppercase;letter-spacing:3px;color:var(--gray-400);font-weight:600}
.clients-track{display:flex;animation:scroll 30s linear infinite;width:max-content}
.clients-track:hover{animation-play-state:paused}
.client-item{flex-shrink:0;padding:0 3rem}
.client-logo{height:45px;width:auto;max-width:140px;object-fit:contain;filter:grayscale(100%);opacity:0.5;transition:all 0.4s ease}
.client-logo:hover{filter:grayscale(0%);opacity:1;transform:scale(1.1)}
@keyframes scroll{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
@media(max-width:640px){.client-logo{height:35px;max-width:100px}.client-item{padding:0 2rem}}

/* ===== CTA BAND ===== */
.cta-band{background:linear-gradient(135deg,var(--secondary),var(--primary));padding:80px 0;text-align:center;position:relative;overflow:hidden}
.cta-band::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='1.5' fill='%23ffffff' opacity='0.1'/%3E%3C/svg%3E");background-size:60px 60px}
.cta-band h3{color:var(--white);font-size:clamp(1.6rem,5vw,2.25rem);margin-bottom:1rem;position:relative}
.cta-band p{color:rgba(255,255,255,0.8);font-size:1.1rem;margin-bottom:2rem;position:relative}
.cta-band .btn{display:inline-flex;align-items:center;gap:10px;padding:16px 36px;background:var(--white);color:var(--primary);font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:1.05rem;border-radius:50px;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);position:relative}
.cta-band .btn:hover{background:var(--third);color:var(--white);transform:translateY(-4px);box-shadow:0 12px 35px rgba(0,0,0,0.2)}

/* ===== CONTACT ===== */
.contact-form{background:var(--white);border-radius:var(--radius-xl);padding:2.5rem;box-shadow:var(--shadow-xl);max-width:650px;margin:0 auto;border:1px solid var(--gray-200)}
@media(max-width:640px){.contact-form{padding:1.75rem}}
.form-group{margin-bottom:1.25rem}
.form-label{display:block;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;font-weight:600;color:var(--gray-700);margin-bottom:0.5rem}
.form-control{width:100%;padding:14px 18px;border:2px solid var(--gray-200);border-radius:var(--radius);font-size:1rem;transition:all 0.3s ease;background:var(--gray-50)}
.form-control:focus{outline:none;border-color:var(--secondary);background:var(--white);box-shadow:0 0 0 4px rgba(170,19,74,0.1)}
textarea.form-control{min-height:130px;resize:vertical}
.btn-submit{width:100%;padding:16px;background:linear-gradient(135deg,var(--primary),var(--secondary));color:var(--white);font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:1.05rem;border:none;border-radius:var(--radius);cursor:pointer;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);display:flex;align-items:center;justify-content:center;gap:10px}
.btn-submit:hover{transform:translateY(-3px);box-shadow:var(--shadow-glow)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem}
@media(max-width:640px){.form-row{grid-template-columns:1fr}}
.alert-success{background:linear-gradient(135deg,#10b981,#059669);color:var(--white);padding:1.25rem;border-radius:var(--radius);margin-bottom:1.5rem;font-weight:500}

/* ===== FOOTER ===== */
.footer{background:linear-gradient(135deg,var(--primary),var(--primary-light));color:var(--white);padding:80px 0 40px}
.footer-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr;gap:3rem}
@media(max-width:768px){.footer-grid{grid-template-columns:1fr;text-align:center}}
.footer-brand{font-family:'Space Grotesk',sans-serif;font-size:2rem;font-weight:700;margin-bottom:1rem;letter-spacing:-0.03em}
.footer-brand span{color:var(--third)}
.footer p{color:rgba(255,255,255,0.6);font-size:0.95rem}
.social-links{display:flex;gap:12px;margin-top:1.25rem}
@media(max-width:768px){.social-links{justify-content:center}}
.social-links a{width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;color:var(--white);font-size:1.1rem;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1)}
.social-links a:hover{background:var(--secondary);transform:translateY(-4px) rotate(-5deg)}
.footer h6{font-family:'Space Grotesk',sans-serif;font-size:1.1rem;color:var(--white);margin-bottom:1.25rem}
.footer-links{display:flex;flex-direction:column;gap:0.75rem}
.footer-links a{color:rgba(255,255,255,0.6);font-size:0.95rem;transition:all 0.3s ease;display:inline-flex;align-items:center;gap:8px}
.footer-links a:hover{color:var(--third);transform:translateX(5px)}
.footer-links a i{font-size:0.85rem}
.footer-bottom{border-top:1px solid rgba(255,255,255,0.1);margin-top:3rem;padding-top:2rem;text-align:center}
.footer-bottom p{color:rgba(255,255,255,0.5);font-size:0.9rem;margin:0}

/* ===== CHAT WIDGET ===== */
.chat-btn{position:fixed;bottom:24px;right:24px;width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg, #aa134a, #aa134a);border:none;color:var(--white);font-size:1.5rem;cursor:pointer; box-shadow: 0 8px 25px rgb(6 30 89 / 68%);;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);z-index:1000;display:flex;align-items:center;justify-content:center}
.chat-btn:hover{transform:scale(1.1) rotate(-5deg)}
.chat-badge{position:absolute;top:-4px;right:-4px;width:22px;height:22px;background:var(--secondary);border-radius:50%;font-size:0.75rem;font-weight:700;display:flex;align-items:center;justify-content:center;border:2px solid var(--white);animation:badgePulse 2s ease infinite}
@keyframes badgePulse{0%,100%{transform:scale(1)}50%{transform:scale(1.1)}}
.chat-window{position:fixed;bottom:100px;right:24px;width:370px;max-width:calc(100vw - 48px);height:480px;max-height:calc(100vh - 130px);background:var(--white);border-radius:var(--radius-xl);box-shadow:var(--shadow-xl);z-index:1001;display:flex;flex-direction:column;opacity:0;visibility:hidden;transform:translateY(20px) scale(0.95);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1)}
.chat-window.show{opacity:1;visibility:visible;transform:translateY(0) scale(1)}
.chat-header{background:linear-gradient(135deg,var(--primary),var(--primary-light));color:var(--white);padding:1.25rem;border-radius:var(--radius-xl) var(--radius-xl) 0 0;display:flex;align-items:center;justify-content:space-between}
.chat-header-info{display:flex;align-items:center;gap:12px}
.chat-avatar{width:44px;height:44px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.chat-header h6{font-family:'Space Grotesk',sans-serif;font-size:1rem;color:var(--white);margin:0}
.chat-header p{font-size:0.8rem;color:rgba(255,255,255,0.7);margin:0}
.chat-close{width:36px;height:36px;background:rgba(255,255,255,0.1);border:none;border-radius:50%;color:var(--white);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.3s ease}
.chat-close:hover{background:var(--secondary)}
.chat-body{flex:1;padding:1.25rem;overflow-y:auto;display:flex;flex-direction:column;gap:12px}
.chat-message{display:flex;gap:10px;max-width:85%;animation:msgIn 0.3s ease}
@keyframes msgIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.chat-message.user{flex-direction:row-reverse;align-self:flex-end}
.chat-bubble{background:var(--gray-100);padding:12px 16px;border-radius:var(--radius);font-size:0.9rem;line-height:1.6}
.chat-message.user .chat-bubble{background:linear-gradient(135deg,var(--primary),var(--primary-light));color:var(--white)}
.chat-quick{padding:12px;border-top:1px solid var(--gray-200);display:flex;flex-wrap:wrap;gap:8px}
.quick-btn{padding:8px 14px;background:var(--gray-100);border:1px solid var(--gray-200);border-radius:50px;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.3s ease}
.quick-btn:hover{background:var(--primary);border-color:var(--primary);color:var(--white)}
.chat-footer{padding:12px;border-top:1px solid var(--gray-200);display:flex;gap:10px}
.chat-input{flex:1;padding:12px 18px;border:2px solid var(--gray-200);border-radius:50px;font-size:0.9rem;transition:all 0.3s ease}
.chat-input:focus{outline:none;border-color:var(--secondary)}
.chat-send{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--secondary),var(--third));border:none;color:var(--white);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.3s ease}
.chat-send:hover{transform:scale(1.1)}
    </style>
</head>
<body>
    <!-- Splash Screen -->
    <div class="splash" id="splash">
        <div class="splash-particles">
            <div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div>
            <div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div>
        </div>
        <div class="splash-rings"><div class="splash-ring"></div><div class="splash-ring"></div><div class="splash-ring"></div></div>
        <div class="splash-code">&lt;code&gt; Building Digital Excellence &lt;/code&gt; // Innovation • Technology • Solutions</div>
        <div class="splash-code">function createFuture() { return innovation + technology; }</div>
        <div class="splash-code">const success = await transform(yourBusiness);</div>
        <div class="splash-logo"><span class="te">TE</span><span class="q">Q</span><span class="rious">RIOUS</span></div>
        <p class="splash-tagline">Building Digital Excellence</p>
        <div class="splash-loader"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="/" class="navbar-brand"><span class="brand-te">TE</span><span class="brand-q">Q</span><span class="brand-rious">RIOUS</span></a>
            <ul class="navbar-nav" id="navMenu">
                <button class="nav-close" onclick="closeNav()"><i class="bi bi-x-lg"></i></button>
                <li><a href="#about" class="nav-link" onclick="closeNav()">About</a></li>
                <li><a href="#services" class="nav-link" onclick="closeNav()">Services</a></li>
                <li><a href="#projects" class="nav-link" onclick="closeNav()">Work</a></li>
                <li><a href="#contact" class="nav-link" onclick="closeNav()">Contact</a></li>
                @if($subsidiary)
                <li><a href="{{ route('subsidiary.show', $subsidiary->slug) }}" class="nav-subsidiary"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>{{ $subsidiary->name }}</a></li>
                @endif
                <li><a href="/login" class="btn-login"><i class="bi bi-person-circle"></i> Login</a></li>
            </ul>
            <button class="navbar-toggle" onclick="toggleNav()"><span></span><span></span><span></span></button>
        </div>
    </nav>

    <!-- Hero -->
    <header class="hero">
        <div class="hero-bg">
            <div class="hero-grid"></div>
            <div class="hero-gradient"></div>
            <div class="hero-glow"></div>
            <div class="hero-lines"><div class="hero-line"></div><div class="hero-line"></div><div class="hero-line"></div><div class="hero-line"></div></div>
            <div class="hero-dots"><div class="hero-dot"></div><div class="hero-dot"></div><div class="hero-dot"></div><div class="hero-dot"></div><div class="hero-dot"></div><div class="hero-dot"></div></div>
        </div>
        <div class="container">
            <div class="hero-content">
                @forelse($heroSlides as $index => $slide)
                    @if($index === 0)
                        <h1>{{ $slide->title }}</h1>
                        @if($slide->description)<p class="lead">{{ $slide->description }}</p>@endif
                        @if($slide->background_image)
                        <div class="hero-image-wrapper"><div class="hero-image-glow"></div><img src="{{ asset('storage/' . $slide->background_image) }}" alt="{{ $slide->title }}" class="hero-image"></div>
                        @endif
                        @if($slide->button_text)<a href="{{ $slide->button_link ?? '#contact' }}" class="btn-cta"><span>{{ $slide->button_text }}</span> <i class="bi bi-arrow-right"></i></a>@endif
                    @endif
                @empty
                    <h1>Building Digital Excellence</h1>
                    <p class="lead">Transform your business with cutting-edge IT solutions and innovative technology</p>
                    <a href="#contact" class="btn-cta"><span>Get Started</span> <i class="bi bi-arrow-right"></i></a>
                @endforelse
            </div>
        </div>
    </header>

    <main>
        <!-- Clients -->
        @if($clients->count() > 0)
        <section class="clients-section">
            <div class="container">
                <div class="clients-header"><h6>Trusted By Leading Organizations</h6></div>
            </div>
            <div class="clients-track">
                @foreach($clients as $client)<div class="client-item"><img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="client-logo" title="{{ $client->name }}"></div>@endforeach
                @foreach($clients as $client)<div class="client-item"><img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="client-logo" title="{{ $client->name }}"></div>@endforeach
            </div>
        </section>
        @endif

        <!-- About -->
        <section id="about" class="section">
            <div class="container">
                <div class="about-grid">
                    <div class="about-content reveal-left">
                        <h2 class="section-title">Who We Are</h2>
                        @if($about)<div>{!! $about->content !!}</div>@else<p>We are passionate technologists delivering innovative IT solutions to businesses across Maldives. Our team combines expertise with creativity to transform your digital presence.</p>@endif
                    </div>
                    @if($about && $about->image)
                    <div class="about-image reveal-right"><img src="{{ asset('storage/' . $about->image) }}" alt="About Us"></div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Values -->
        @if($values->count() > 0)
        <section class="section bg-gray">
            <div class="container">
                <div class="section-header reveal"><h2 class="section-title">Our Values</h2><p class="section-subtitle">The principles that guide everything we do</p></div>
                <div class="grid grid-5">
                    @foreach($values as $i => $value)
                    <div class="value-card reveal stagger-{{ ($i % 5) + 1 }}">
                        <div class="value-icon"><i class="{{ $value->icon ?? 'bi bi-star' }}"></i></div>
                        <h5>{{ $value->title }}</h5>
                        @if($value->description)<p>{{ $value->description }}</p>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Services -->
        @if($services->count() > 0)
        <section id="services" class="section">
            <div class="container">
                <div class="section-header reveal"><h2 class="section-title">Our Services</h2><p class="section-subtitle">Comprehensive IT solutions tailored to your needs</p></div>
                <div class="grid grid-3">
                    @foreach($services as $i => $service)
                    <div class="service-card reveal stagger-{{ ($i % 3) + 1 }}">
                        <i class="{{ $service->icon ?? 'bi bi-gear' }}"></i>
                        <h5>{{ $service->title }}</h5>
                        <p>{{ $service->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Work Steps -->
        @if($workSteps->count() > 0)
        <section class="section bg-gray">
            <div class="container">
                <div class="section-header reveal"><h2 class="section-title">How We Work</h2><p class="section-subtitle">Our proven process for delivering excellence</p></div>
                <div class="steps-container">
                    @foreach($workSteps as $i => $step)
                    <div class="step reveal stagger-{{ $i + 1 }}">
                        <div class="step-number">{{ $i + 1 }}</div>
                        <h6>{{ $step->title }}</h6>
                        @if($step->description)<p>{{ $step->description }}</p>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Projects -->
        @if($projects->count() > 0)
        <section id="projects" class="section">
            <div class="container">
                <div class="section-header reveal"><h2 class="section-title">Our Work</h2><p class="section-subtitle">Featured projects showcasing our expertise</p></div>
                <div class="grid grid-3">
                    @foreach($projects->take(6) as $i => $project)
                    <div class="card project-card reveal stagger-{{ ($i % 3) + 1 }}">
                        @if($project->image)<img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">@endif
                        <div class="card-body">
                            @if($project->client_type)<span class="badge">{{ ucfirst($project->client_type) }}</span>@endif
                            <h5>{{ $project->title }}</h5>
                            @if($project->outcome)<p>{{ Str::limit($project->outcome, 80) }}</p>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- CTA -->
        <section class="cta-band">
            <div class="container reveal-scale">
                <h3>Ready to Transform Your Business?</h3>
                <p>Let's discuss how we can help you achieve your digital goals</p>
                <a href="#contact" class="btn">Request a Quote <i class="bi bi-arrow-right"></i></a>
            </div>
        </section>

        <!-- Contact -->
        <section id="contact" class="section bg-gray">
            <div class="container">
                <div class="section-header reveal"><h2 class="section-title">Get In Touch</h2><p class="section-subtitle">Ready to start your project? Contact us today!</p></div>
                @if(session('success'))<div class="alert-success reveal">{{ session('success') }}</div>@endif
                <div class="contact-form reveal">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group"><label class="form-label">Full Name *</label><input type="text" class="form-control" name="name" required></div>
                            <div class="form-group"><label class="form-label">Email *</label><input type="email" class="form-control" name="email" required></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label class="form-label">Phone</label><input type="tel" class="form-control" name="phone"></div>
                            <div class="form-group"><label class="form-label">Company</label><input type="text" class="form-control" name="company"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Message *</label><textarea class="form-control" name="message" required></textarea></div>
                        <button type="submit" class="btn-submit"><i class="bi bi-send"></i> Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="reveal">
                    <div class="footer-brand">TEQ<span>RIOUS</span></div>
                    <p>{{ $siteTagline }}</p>
                    <div class="social-links">
                        @if($fb = $settings['social']->firstWhere('key', 'facebook'))<a href="{{ $fb->value }}" target="_blank"><i class="bi bi-facebook"></i></a>@endif
                        @if($ig = $settings['social']->firstWhere('key', 'instagram'))<a href="{{ $ig->value }}" target="_blank"><i class="bi bi-instagram"></i></a>@endif
                        @if($li = $settings['social']->firstWhere('key', 'linkedin'))<a href="{{ $li->value }}" target="_blank"><i class="bi bi-linkedin"></i></a>@endif
                    </div>
                </div>
                <div class="reveal stagger-1">
                    <h6>Quick Links</h6>
                    <div class="footer-links">
                        <a href="#about"><i class="bi bi-chevron-right"></i> About Us</a>
                        <a href="#services"><i class="bi bi-chevron-right"></i> Services</a>
                        <a href="#projects"><i class="bi bi-chevron-right"></i> Work</a>
                        <a href="#contact"><i class="bi bi-chevron-right"></i> Contact</a>
                    </div>
                </div>
                <div class="reveal stagger-2">
                    <h6>Contact</h6>
                    <div class="footer-links">
                        @if($address)<a href="#"><i class="bi bi-geo-alt"></i> {{ $address }}</a>@endif
                        @if($email)<a href="mailto:{{ $email }}"><i class="bi bi-envelope"></i> {{ $email }}</a>@endif
                        @if($phone)<a href="tel:{{ $phone }}"><i class="bi bi-telephone"></i> {{ $phone }}</a>@endif
                    </div>
                </div>
            </div>
            <div class="footer-bottom"><p>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p></div>
        </div>
    </footer>

    <!-- Chat Widget -->
    <button class="chat-btn" id="chatBtn"><i class="bi bi-chat-dots-fill"></i><span class="chat-badge" id="chatBadge" style="display:none">1</span></button>
    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            <div class="chat-header-info"><div class="chat-avatar"><i class="bi bi-building"></i></div><div><h6>{{ $siteName }}</h6><p>Online • Replies instantly</p></div></div>
            <button class="chat-close" id="chatClose"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="chat-body" id="chatBody"><div class="chat-message"><div class="chat-bubble">Hi!   How can we help you today?</div></div></div>
        <div class="chat-quick"><button class="quick-btn" data-msg="I need IT consulting">IT Consulting</button><button class="quick-btn" data-msg="Web development inquiry">Web Dev</button><button class="quick-btn" data-msg="Get a quote">Get Quote</button></div>
        <div class="chat-footer"><input type="text" class="chat-input" id="chatInput" placeholder="Type a message..."><button class="chat-send" id="chatSend"><i class="bi bi-send-fill"></i></button></div>
    </div>

    <script>
    // Splash Screen
    window.addEventListener('load',function(){setTimeout(function(){var s=document.getElementById('splash');s.classList.add('exit');setTimeout(function(){s.style.display='none'},1000)},3500)});
    // Navbar scroll
    window.addEventListener('scroll',function(){document.getElementById('navbar').classList.toggle('scrolled',window.scrollY>50)});
    // Mobile nav
    function toggleNav(){document.getElementById('navMenu').classList.toggle('show')}
    function closeNav(){document.getElementById('navMenu').classList.remove('show')}
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(function(a){a.addEventListener('click',function(e){e.preventDefault();var t=document.querySelector(this.getAttribute('href'));if(t)window.scrollTo({top:t.offsetTop-80,behavior:'smooth'})})});
    // Reveal animations
    function checkReveal(){document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale').forEach(function(el){if(el.getBoundingClientRect().top<window.innerHeight-80)el.classList.add('active')})}
    window.addEventListener('scroll',checkReveal);window.addEventListener('load',checkReveal);
    // Chat
    var chatBtn=document.getElementById('chatBtn'),chatWindow=document.getElementById('chatWindow'),chatClose=document.getElementById('chatClose'),chatBody=document.getElementById('chatBody'),chatInput=document.getElementById('chatInput'),chatSend=document.getElementById('chatSend'),chatBadge=document.getElementById('chatBadge');
    var wa='{{ $whatsappClean }}',ph='{{ $phone }}',em='{{ $email }}';
    chatBtn.onclick=function(){chatWindow.classList.toggle('show');chatBadge.style.display='none'};
    chatClose.onclick=function(){chatWindow.classList.remove('show')};
    function addMsg(t,u){var d=document.createElement('div');d.className='chat-message'+(u?' user':'');d.innerHTML='<div class="chat-bubble">'+t+'</div>';chatBody.appendChild(d);chatBody.scrollTop=chatBody.scrollHeight}
    function reply(){var h='<div style="margin-top:10px">';if(wa)h+='<a href="https://wa.me/'+wa+'" target="_blank" style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:#25d366;color:#fff;border-radius:10px;margin-bottom:8px;font-size:0.9rem;font-weight:500"><i class="bi bi-whatsapp"></i>WhatsApp</a>';if(ph)h+='<a href="tel:'+ph+'" style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--primary);color:#fff;border-radius:10px;margin-bottom:8px;font-size:0.9rem;font-weight:500"><i class="bi bi-telephone"></i>'+ph+'</a>';if(em)h+='<a href="mailto:'+em+'" style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--secondary);color:#fff;border-radius:10px;font-size:0.9rem;font-weight:500"><i class="bi bi-envelope"></i>'+em+'</a>';h+='</div>';addMsg("Thanks for reaching out! Here's how to contact us:"+h,false)}
    chatSend.onclick=function(){var v=chatInput.value.trim();if(v){addMsg(v,true);chatInput.value='';setTimeout(reply,800)}};
    chatInput.onkeypress=function(e){if(e.key==='Enter')chatSend.onclick()};
    document.querySelectorAll('.quick-btn').forEach(function(b){b.onclick=function(){addMsg(this.dataset.msg,true);setTimeout(reply,800)}});
    setTimeout(function(){if(!chatWindow.classList.contains('show'))chatBadge.style.display='flex'},5000);
    </script>
</body>
</html>