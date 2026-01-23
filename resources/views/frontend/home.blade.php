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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
:root{--primary:#00113f;--primary-light:#001a5c;--secondary:#8f0840;--secondary-light:#b01050;--third:#cda50d;--third-light:#e5bd1a;--white:#ffffff;--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-300:#cbd5e1;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;--shadow-sm:0 1px 2px rgba(0,0,0,0.05);--shadow:0 1px 3px rgba(0,0,0,0.1),0 1px 2px rgba(0,0,0,0.06);--shadow-md:0 4px 6px -1px rgba(0,0,0,0.1),0 2px 4px -1px rgba(0,0,0,0.06);--shadow-lg:0 10px 15px -3px rgba(0,0,0,0.1),0 4px 6px -2px rgba(0,0,0,0.05);--shadow-xl:0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04);--shadow-glow:0 0 40px rgba(143,8,64,0.3);--radius:12px;--radius-lg:20px;--radius-xl:28px}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
body{font-family:'Arial',sans-serif;font-size:16px;line-height:1.7;color:#ffffff;background:#00113f;overflow-x:hidden;font-weight:normal;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
h1,h2,h3,h4,h5,h6{font-family:'Arial',sans-serif;font-weight:700;color:#fff;line-height:1.2;letter-spacing:-0.02em}
a{color:inherit;text-decoration:none}
img{max-width:100%;height:auto}
.container{width:100%;max-width:1200px;margin:0 auto;padding:0 20px}
@media(max-width:640px){.container{padding:0 16px}}

/* ===== SPLASH SCREEN ===== */
.splash{position:fixed;inset:0;background:var(--primary);z-index:9999999;display:flex;align-items:center;justify-content:center;flex-direction:column;overflow:hidden}
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
.splash-logo .q{color:var(--secondary);opacity:0;transform:scale(0) rotate(-180deg);animation:letterPop 1s cubic-bezier(0.34,1.56,0.64,1) 0.6s forwards}
.splash-logo .rious{color:var(--third);opacity:0;transform:translateX(50px) rotateY(90deg);animation:letterSlide 0.8s cubic-bezier(0.34,1.56,0.64,1) 0.9s forwards}
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
.navbar{position:fixed;top:0;left:0;right:0;z-index:1000;padding:16px 0;
/* background:rgba(0,17,63,0.95); */
 backdrop-filter:blur(7px);
-webkit-backdrop-filter:blur(20px);  
/* box-shadow:0 4px 30px rgba(0,0,0,0.3); */
transition:all 0.4s cubic-bezier(0.4,0,0.2,1)}
.navbar.scrolled{
    /* background:rgba(0,17,63,0.98); */
/* box-shadow:0 4px 30px rgba(0,0,0,0.4); */
padding:10px 0}
.navbar .container{display:flex;align-items:center;justify-content:space-between;gap:16px}
.navbar-brand{display:flex;align-items:center}
.navbar-brand img{height:50px;width:auto;transition:all 0.3s ease}
.navbar-brand:hover img{transform:scale(1.05)}
.navbar-nav{display:flex;align-items:center;gap:6px;list-style:none}
.nav-link{position:relative;padding:10px 18px;font-size:0.9rem;font-weight:500;color:rgba(255,255,255,0.9);border-radius:10px;transition:all 0.3s ease;overflow:hidden}
.navbar.scrolled .nav-link{color:var(--white)}
.nav-link::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,var(--secondary),var(--third));opacity:0;transform:scale(0.8);border-radius:inherit;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);z-index:-1}
.nav-link:hover{color:var(--white)}
.nav-link:hover::before{opacity:1;transform:scale(1)}
.nav-subsidiary{display:flex;align-items:center;gap:8px;padding:10px 16px;background:rgba(203,148,48,0.15);border-radius:10px;color:var(--third);font-weight:600;font-size:0.85rem;transition:all 0.3s ease}
.nav-subsidiary:hover{background:var(--third);color:var(--white)}
.navbar.scrolled .nav-subsidiary{background:rgba(203,148,48,0.1)}
.nav-subsidiary svg{width:18px;height:18px}
.btn-login{display:flex;align-items:center;gap:8px;padding:10px 20px;
background:linear-gradient(135deg,var(--secondary),var(--secondary-light));
color:var(--white);font-size:0.85rem;font-weight:600;border-radius:0px;transition:all 0.3s ease;box-shadow:0 4px 15px rgba(170,19,74,0.3)}
.btn-login:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(170,19,74,0.4)}
.btn-login i{font-size:1.1rem}
.navbar-toggle{display:none;width:44px;height:44px;
background:rgb(170 19 74);
border:none;border-radius:0;cursor:pointer;flex-direction:column;align-items:center;justify-content:center;gap:5px;transition:all 0.3s ease}
.navbar.scrolled .navbar-toggle{background:rgb(170 19 74)}
.navbar-toggle:hover{background:var(--secondary)}
.navbar-toggle span{display:block;width:22px;height:2px;background:var(--white);transition:all 0.3s ease}
.navbar.scrolled .navbar-toggle span{background:var(--white)}
.navbar-toggle:hover span{background:var(--white)}
@media(max-width:991px){
.navbar-toggle{display:flex}
.navbar-nav{position:fixed;top:0;right:-400px;width:400px;max-width:85vw;height:100vh;
 background:rgba(0,17,63,0.98);  
flex-direction:column;justify-content:flex-start;align-items:stretch;gap:0;opacity:1;visibility:visible;
transition:right 0.4s cubic-bezier(0.4,0,0.2,1);z-index:99999;overflow-y:auto;-webkit-overflow-scrolling:touch;
padding:100px 0 40px;
/* box-shadow:-10px 0 50px rgba(0,0,0,0.5); */
border-left:1px solid rgba(205,165,13,0.2)}
.navbar-nav.show{right:0}
.nav-menu-item{border-bottom:1px solid rgba(255,255,255,0.05);transition:all 0.3s ease;position:relative;z-index:100001}
.nav-menu-item:hover{background:rgba(205,165,13,0.05)}
.navbar-nav .nav-link{color:var(--white);font-size:1rem;padding:24px 32px;border-radius:0;background:transparent;width:100%;max-width:none;text-align:left;display:flex;flex-direction:column;gap:4px;-webkit-tap-highlight-color:transparent;position:relative;z-index:100001;cursor:pointer}
.nav-link-title{font-size:0.75rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:1.5px;font-weight:600}
.nav-link-text{font-size:1.15rem;color:var(--white);font-weight:600;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
.navbar-nav .nav-link:hover .nav-link-text{color:var(--third);transform:translateX(8px);transition:all 0.3s ease}
.navbar-nav .btn-login{font-size:1rem;padding:16px 32px;
width:calc(100% - 64px);max-width:none;justify-content:center;margin:20px 32px;border-radius:0px}
.nav-close{position:fixed;top:24px;right:24px;width:48px;height:48px;background:rgba(255,255,255,0.1);border:none;border-radius:50%;font-size:1.8rem;color:var(--white);cursor:pointer;display:none;align-items:center;justify-content:center;transition:all 0.3s ease;z-index:100000}
.navbar-nav.show .nav-close{display:flex}
.nav-close:hover{background:var(--secondary);transform:rotate(90deg)}
.nav-overlay{position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.7);opacity:0;visibility:hidden;transition:all 0.4s ease;z-index:99998;backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px)}
.nav-overlay.show{visibility:visible}
body.modal-open{overflow:hidden}
}

/* ===== HERO ===== */
.hero{min-height:100vh;display:flex;align-items:center;background:var(--primary);position:relative;overflow:hidden;padding:120px 0 80px}
#particle-canvas{position:absolute;top:0;left:0;width:100%;height:100%;z-index:1}
.hero-bg{position:absolute;inset:0;z-index:0}
.hero-gradient{position:absolute;inset:0;background:transparent}
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
.section-header{text-align:center;max-width:600px;margin:0 auto -0.5rem}
.section-title{font-size:clamp(1.8rem,5vw,2.5rem);margin-bottom:1rem}
.section-subtitle{color:rgba(255,255,255,0.6);font-size:1.05rem}
.bg-gray{background:rgba(255,255,255,0.03);padding:80px 0}
.bg-dark{background:transparent}

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
.card{background:rgba(255,255,255,0.05);border-radius:0;box-shadow:var(--shadow);border:1px solid rgba(255,255,255,0.1);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);overflow:hidden;position:relative}
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
.value-card{background:rgba(255,255,255,0.05);border-radius:var(--radius-lg);padding:2rem 1.5rem;text-align:center;border:1px solid rgba(255,255,255,0.1);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1)}
.value-card:hover{border-color:var(--secondary);transform:translateY(-8px);box-shadow:var(--shadow-lg)}
.value-icon{width:70px;height:70px;border-radius:0;background:linear-gradient(135deg,var(--primary),var(--primary-light));display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;color:var(--white);font-size:1.6rem;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);box-shadow:0 8px 25px rgba(0,19,72,0.3)}
.value-card:hover .value-icon{transform:scale(1.15) rotate(-5deg);background:linear-gradient(135deg,var(--secondary),var(--third))}
.value-card h5{font-size:1.05rem;margin-bottom:0.4rem;color:#fff}
.value-card p{font-size:0.9rem;color:rgba(255,255,255,0.6);margin:0}

/* ===== WORK STEPS ===== */
.steps-container{display:flex;justify-content:center;gap:1.5rem;flex-wrap:wrap;position:relative}
.steps-container::before{content:'';position:absolute;top:35px;left:15%;right:15%;height:3px;background:linear-gradient(90deg,var(--secondary),var(--third));z-index:0;border-radius:2px}
@media(max-width:768px){.steps-container::before{display:none}}
.step{flex:1;min-width:150px;max-width:200px;text-align:center;position:relative;z-index:1}
.step-number{width:70px;height:70px;border-radius:0;background:linear-gradient(135deg,var(--primary),var(--primary-light));color:var(--white);font-family:'Space Grotesk',sans-serif;font-size:1.5rem;font-weight:700;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;box-shadow:0 8px 25px rgba(0,19,72,0.3);transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);border:2px solid var(--white)}
.step:hover .step-number{transform:scale(1.15);background:linear-gradient(135deg,var(--secondary),var(--third))}
.step h6{font-size:1rem;margin-bottom:0.4rem;color:#fff}
.step p{font-size:0.85rem;color:rgba(255,255,255,0.6);margin:0}

/* ===== CAROUSEL ===== */
.carousel-container{position:relative;padding:0px 0;overflow:hidden}
.carousel-track{display:flex;gap:1.5rem;transition:transform 0.5s cubic-bezier(0.4,0,0.2,1);padding:0px 0px 85px 5px}
.carousel-track .service-card{min-width:320px;max-width:350px;flex-shrink:0}
.carousel-btn{position:absolute;top:50%;transform:translateY(-50%);width:50px;height:50px;
background:linear-gradient(135deg,var(--secondary),var(--third));color:var(--white);border:none;
border-radius:50%;font-size:1.5rem;cursor:pointer;z-index:10;transition:all 0.3s ease;display:flex;align-items:center;justify-content:center;
/* box-shadow:0 4px 15px rgba(203,148,48,0.4) */
}
.carousel-btn:hover{transform:translateY(-50%) scale(1.1);
/* box-shadow:0 6px 25px rgba(203,148,48,0.6) */
}
.carousel-prev{left:10px}
.carousel-next{right:10px}
.carousel-dots{display:flex;justify-content:center;gap:10px;margin-top:20px}
.carousel-dot{width:12px;height:12px;border-radius:50%;background:rgba(255,255,255,0.3);cursor:pointer;transition:all 0.3s ease;border:2px solid transparent}
.carousel-dot.active{background:var(--third);transform:scale(1.3);border-color:var(--third);
/* box-shadow:0 0 10px var(--third) */
}
.carousel-dot:hover{background:var(--third);transform:scale(1.1)}
@media(max-width:768px){.carousel-btn{width:40px;height:40px;font-size:1.2rem}.carousel-prev{left:5px}.carousel-next{right:5px}}

/* ===== SERVICES ===== */
.service-card{min-width:320px;max-width:350px;flex-shrink:0;border-radius:var(--radius-lg);padding:2rem;
/* border:2px solid rgba(203,148,48,0.3); */
transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);position:relative;overflow:hidden;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px)}
.service-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--secondary),var(--third));transform:scaleX(0);transition:transform 0.4s ease}
.service-card:hover{border-color:var(--third);
/* box-shadow:0 10px 40px rgba(203,148,48,0.4); */
transform:translateY(-5px);background:rgba(255,255,255,0.2)}
.service-card:hover::after{transform:scaleX(1)}
.service-card i{font-size:2.25rem;color:var(--third);margin-bottom:1rem;display:block;transition:all 0.4s ease}
.service-card:hover i{transform:scale(1.1);color:var(--third);filter:brightness(1.3)}
.service-card h5{font-size:1.15rem;margin-bottom:0.6rem;color:#fff;font-weight:700}
.service-card p{font-size:0.95rem;color:rgba(255,255,255,0.85);margin:0;line-height:1.6}

/* ===== PROJECTS SLIDER ===== */
.projects-slider-container{position:relative;padding:20px 0}
.projects-slider{display:flex;gap:1.5rem;overflow-x:auto;scroll-behavior:smooth;scrollbar-width:none;-ms-overflow-style:none;padding:10px 0;min-height:200px}
.projects-slider::-webkit-scrollbar{display:none}
.project-card{flex:0 0 350px;overflow:hidden;background:rgba(255,255,255,0.2);border:3px solid rgba(203,148,48,0.5);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border-radius:var(--radius-lg);transition:all 0.4s ease}
.project-card:hover{transform:translateY(-5px);border-color:var(--third);box-shadow:0 10px 40px rgba(203,148,48,0.4)}
.project-card img{display:none}
.project-card .card-body{padding:1.5rem}
.project-card .badge{display:inline-block;padding:6px 14px;background:linear-gradient(135deg,var(--third),var(--third-light));color:var(--primary);font-size:0.8rem;font-weight:700;border-radius:50px;margin-bottom:0.8rem;box-shadow:0 4px 15px rgba(203,148,48,0.3)}
.project-card h5{font-size:1.15rem;margin-bottom:0.6rem;color:#fff;font-weight:700}
.project-card p{color:rgba(255,255,255,0.85)}
.project-card strong{color:var(--third)}
.slider-btn{display:none}
@media(max-width:768px){.project-card{flex:0 0 280px}}

/* ===== CLIENTS ===== */
.clients-section{padding:70px 0;background:transparent;overflow:hidden}
.clients-header{text-align:center;margin-bottom:2.5rem}
.clients-header h6{font-family:'Space Grotesk',sans-serif;font-size:0.9rem;text-transform:uppercase;letter-spacing:3px;color:rgba(255,255,255,0.5);font-weight:600}
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
.footer{background:var(--primary);color:var(--white);padding:80px 0 40px}
.footer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:3rem;align-items:start}
@media(max-width:768px){.footer-grid{grid-template-columns:1fr;text-align:center;gap:2rem}}
.footer-brand{font-family:'Space Grotesk',sans-serif;font-size:2rem;font-weight:700;margin-bottom:1rem;letter-spacing:-0.03em}
.footer-brand span{color:var(--third)}
.footer p{color:rgba(255,255,255,0.6);font-size:0.95rem}
.social-links{display:flex;gap:12px;margin-top:1.25rem}
@media(max-width:768px){.social-links{justify-content:center}}
.social-links a{width:44px;height:44px;border-radius:0;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;color:var(--white);font-size:1.1rem;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1)}
.social-links a:hover{background:var(--secondary);transform:translateY(-4px) rotate(-5deg)}
.footer h6{font-family:'Space Grotesk',sans-serif;font-size:1.1rem;color:var(--white);margin-bottom:1.25rem}
.footer-links{display:flex;flex-direction:column;gap:0.75rem}
.footer-links a{color:rgba(255,255,255,0.6);font-size:0.95rem;transition:all 0.3s ease;display:inline-flex;align-items:center;gap:8px}
.footer-links a:hover{color:var(--third);transform:translateX(5px)}
.footer-links a i{font-size:0.85rem}
.footer-bottom{border-top:1px solid rgba(255,255,255,0.1);margin-top:3rem;padding-top:2rem;text-align:center}
.footer-bottom p{color:rgba(255,255,255,0.5);font-size:0.9rem;margin:0}

/* ===== WHATSAPP BUTTON ===== */
.whatsapp-btn{position:fixed;bottom:24px;right:24px;width:44px;height:44px;border-radius:0;background:#8f0840;border:none;color:var(--white);font-size:1.5rem;cursor:pointer;
/* box-shadow:0 8px 25px rgba(143,8,64,0.5); */
transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);z-index:1000;display:flex;align-items:center;justify-content:center}
.whatsapp-btn:hover{transform:scale(1.1) rotate(-5deg);
/* box-shadow:0 12px 35px rgba(143,8,64,0.6) */
}

/* ===== SCROLL TIMELINE ===== */
.scroll-progress{position:fixed;top:0;left:0;width:100%;height:4px;background:rgba(255,255,255,0.1);z-index:10000;pointer-events:none}
.scroll-progress-bar{height:100%;background:linear-gradient(90deg,var(--secondary),var(--third));width:0%;transition:width 0.1s ease-out;box-shadow:0 0 15px var(--third)}
.scroll-timeline{position:fixed;right:30px;top:50%;transform:translateY(-50%);z-index:999;display:none;flex-direction:column;gap:20px;opacity:0;transition:opacity 0.3s ease}
.scroll-timeline.active{opacity:1}
.timeline-dot{width:12px;height:12px;border-radius:50%;background:rgba(255,255,255,0.3);border:2px solid transparent;cursor:pointer;transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);position:relative}
.timeline-dot:hover{background:var(--third);border-color:var(--third);transform:scale(1.3)}
.timeline-dot.active{background:var(--secondary);border-color:var(--secondary);transform:scale(1.4);box-shadow:0 0 15px var(--secondary)}
.timeline-dot::before{content:attr(data-section);position:absolute;right:25px;top:50%;transform:translateY(-50%);background:rgba(0,17,63,0.95);color:var(--white);padding:6px 12px;border-radius:6px;font-size:0.75rem;font-weight:600;white-space:nowrap;opacity:0;pointer-events:none;transition:all 0.3s ease;border:1px solid rgba(255,255,255,0.1)}
.timeline-dot:hover::before{opacity:1;right:30px}
@media(max-width:768px){.scroll-timeline{display:none}}

/* ===== SECTION ANIMATIONS ===== */
.scroll-section{opacity:1;transform:translateY(0);transition:none}
.scroll-section.animate-in{opacity:0;transform:translateY(80px)}
.parallax-bg{transition:transform 0.1s ease-out}
    </style>
</head>
<body>
    <!-- Scroll Progress Bar -->
    <div class="scroll-progress">
        <div class="scroll-progress-bar" id="scrollProgressBar"></div>
    </div>

    <!-- Scroll Timeline Dots -->
    <div class="scroll-timeline" id="scrollTimeline">
        <div class="timeline-dot" data-section="Home" data-target="hero"></div>
        <div class="timeline-dot" data-section="About" data-target="about"></div>
        <div class="timeline-dot" data-section="Services" data-target="services"></div>
        <div class="timeline-dot" data-section="Projects" data-target="projects"></div>
        <div class="timeline-dot" data-section="Contact" data-target="contact"></div>
    </div>

    <!-- Splash Screen -->
    <div class="splash" id="splash">
        <div class="splash-particles">
            <div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div>
            <div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div><div class="splash-particle"></div>
        </div>
        <div class="splash-rings"><div class="splash-ring"></div><div class="splash-ring"></div><div class="splash-ring"></div></div>
        <!-- <div class="splash-code">&lt;code&gt; Building Digital Excellence &lt;/code&gt; // Innovation • Technology • Solutions</div>
        <div class="splash-code">function createFuture() { return innovation + technology; }</div>
        <div class="splash-code">const success = await transform(yourBusiness);</div> -->
        <div class="splash-logo"><span class="te">TE</span><span class="q">Q</span><span class="rious">RIOUS</span></div>
        <!-- <p class="splash-tagline">Building Digital Excellence</p> -->
        <div class="splash-loader"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="/" class="navbar-brand"><img src="{{ asset('img/logo.png') }}" alt="{{ $siteName }}"></a>
            <ul class="navbar-nav" id="navMenu">
                <!-- <button class="nav-close" onclick="closeNav()"><i class="bi bi-x-lg"></i></button> -->
                <li class="nav-menu-item"><a href="#about" class="nav-link" onclick="closeNav()"><span class="nav-link-title">
                    <!-- Discover -->
                </span><span class="nav-link-text">About Us</span></a></li>
                <li class="nav-menu-item"><a href="#services" class="nav-link" onclick="closeNav()"><span class="nav-link-title">
                    <!-- What We Offer -->
                </span><span class="nav-link-text">Our Services</span></a></li>
                <li class="nav-menu-item"><a href="#work-steps" class="nav-link" onclick="closeNav()"><span class="nav-link-title">
                    <!-- Our Process -->
                </span><span class="nav-link-text">How We Work</span></a></li>
                <li class="nav-menu-item"><a href="#projects" class="nav-link" onclick="closeNav()"><span class="nav-link-title">
                    <!-- Portfolio -->
                </span><span class="nav-link-text">Our Work</span></a></li>
                <li><a href="/login" class="btn-login"><i class="bi bi-person-circle"></i> Login</a></li>
            </ul>
            <button class="navbar-toggle" onclick="toggleNav()"><span></span><span></span><span></span></button>
            
        </div>
    </nav>
    
    <!-- Mobile Nav Overlay -->
    <!-- <div class="nav-overlay" id="navOverlay" onclick="closeNav()"></div> -->

    <!-- Full-Page 3D Particle Sphere (Fixed Position) -->
    <canvas id="particle-canvas" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none;mix-blend-mode:screen;"></canvas>

    <!-- Hero -->
    <header class="hero" id="hero">
        <!-- Simplified Background (subtle gradient overlay) -->
        <div class="hero-bg">
            <div class="hero-gradient"></div>
        </div>
        
        <div class="container">
            <div class="hero-content">
                @if($hero)
                    <h1>{{ $hero->title }}</h1>
                    @if($hero->description)<p class="lead">{{ $hero->description }}</p>@endif
                @else
                    <h1>Building Digital Excellence</h1>
                    <p class="lead">Transform your business with cutting-edge IT solutions and innovative technology</p> 
                @endif
            </div>
        </div>
    </header>

    <main>
        <!-- Clients -->
        @if($clients->count() > 0)
        <section class="clients-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Our Clients</h2>
                    <p class="section-subtitle">Trusted by leading organizations</p>
                </div>
            </div>
            <div class="clients-track">
                @foreach($clients as $client)<div class="client-item"><img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="client-logo" title="{{ $client->name }}"></div>@endforeach
                @foreach($clients as $client)<div class="client-item"><img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="client-logo" title="{{ $client->name }}"></div>@endforeach
            </div>
        </section>
        @endif

        <!-- About -->
        <section id="about" class="section scroll-section">
            <div class="container">
                <div class="section-header" style="padding-bottom: 40px;">
                    <h2 class="section-title">About Us</h2>
                    <p class="section-subtitle">Discover who we are and what drives us</p>
                </div>
                <div class="about-content reveal" style="max-width:900px;margin:0 auto;text-align:center;">
                    @if($about)<div>{!! $about->content !!}</div>@else<p>We are passionate technologists delivering innovative IT solutions to businesses across Maldives. Our team combines expertise with creativity to transform your digital presence.</p>@endif
                </div>
            </div>
        </section>

        <!-- Values -->
        @if($values->count() > 0)
        <section class="section bg-gray scroll-section" id="values">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Our Values</h2>
                    <p class="section-subtitle">The principles that guide everything we do</p>
                </div>
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
        <section id="services" class="section  scroll-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Our Services</h2>
                    <p class="section-subtitle">Comprehensive IT solutions tailored to your needs</p>
                </div>
                <div class="carousel-container">
                    <!-- <button class="carousel-btn carousel-prev" onclick="slideCarousel('services-carousel', -1)">
                        <i class="bi bi-chevron-left"></i>
                    </button> -->
                    <div class="carousel-track" id="services-carousel">
                        @foreach($services as $i => $service)
                        <div class="service-card bg-gray" style="opacity: 1.0429;">
                            <i class="{{ $service->icon ?? 'bi bi-gear' }}"></i>
                            <h5>{{ $service->title }}</h5>
                            <p>{{ $service->description }}</p>
                        </div>
                        @endforeach
                    </div>
                    <!-- <button class="carousel-btn carousel-next" onclick="slideCarousel('services-carousel', 1)">
                        <i class="bi bi-chevron-right"></i>
                    </button> -->
                </div>
                <div class="carousel-dots" id="services-dots"></div>
            </div>
        </section>
        @endif

        <!-- Work Steps -->
        @if($workSteps->count() > 0)
        <section class="section  scroll-section" id="work-steps">
            <div class="container">
                <div class="section-header" style="padding-bottom: 40px;">
                    <h2 class="section-title">How We Work</h2>
                    <p class="section-subtitle">Our proven process for delivering excellence</p>
                </div>
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

        <!-- Products -->
        @if($products->count() > 0)
        <section id="projects" class="section   scroll-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Our Products</h2>
                    <p class="section-subtitle">Professional solutions designed for your success</p>
                </div>
                <div class="carousel-container">
                    <!-- <button class="carousel-btn carousel-prev" onclick="slideCarousel('products-carousel', -1)">
                        <i class="bi bi-chevron-left"></i>
                    </button> -->
                    <div class="carousel-track" id="products-carousel">
                        @foreach($products as $i => $product)
                        <div class="service-card" style="opacity: 1.0429;">
                            @if($product->category)<span class="badge" style="display:inline-block;padding:6px 14px;background:linear-gradient(135deg,var(--third),var(--third-light));color:var(--primary);font-size:0.8rem;font-weight:700;border-radius:50px;margin-bottom:0.8rem;">{{ $product->category }}</span>@endif
                            <h5>{{ $product->name }}</h5>
                            @if($product->description)<p>{{ $product->description }}</p>@endif
                            @if($product->price)<p style="margin-top:1rem;"> </p>@endif
                        </div>
                        @endforeach
                    </div>
                    <!-- <button class="carousel-btn carousel-next" onclick="slideCarousel('products-carousel', 1)">
                        <i class="bi bi-chevron-right"></i>
                    </button> -->
                </div>
                <div class="carousel-dots" id="products-dots"></div>
            </div>
        </section>
        @endif

        <!-- Client Images -->
        @if($clientImages->count() > 0)
        <section class="section scroll-section" style="padding:60px 0;">
            <div class="container">
                <div class="section-header" style="padding-bottom: 40px;">
                    <h2 class="section-title">Our Clients</h2>
                    <p class="section-subtitle">Our valued clients</p>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;align-items:center;">
                    @foreach($clientImages as $image)
                    <div style="flex:0 0 auto;">
                        <img src="{{ asset('storage/' . $image->image) }}" 
                             alt="{{ $image->name }}" 
                             title="{{ $image->name }}"
                             style="max-width:100px;height:auto;  filter: brightness(0) invert(1);
                             "
                             
                             >
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="reveal">
                    <p>{{ $siteTagline }}</p>
                    <div class="social-links">
                        @if($fb = $settings['social']->firstWhere('key', 'facebook'))<a href="{{ $fb->value }}" target="_blank"><i class="bi bi-facebook"></i></a>@endif
                        @if($ig = $settings['social']->firstWhere('key', 'instagram'))<a href="{{ $ig->value }}" target="_blank"><i class="bi bi-instagram"></i></a>@endif
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

    <!-- WhatsApp Button -->
    @if($whatsappClean)
    <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="whatsapp-btn" title="Chat with us on WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
    @endif

    <!-- Three.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <!-- GSAP & ScrollTrigger for advanced scroll animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- 3D Particle Sphere Animation with Scroll Morphing -->
    <script>
// ============================================
// PART 1: 3D Simplex Noise Implementation
// ============================================
// Lightweight simplex noise for coherent particle deformation
// Based on Stefan Gustavson's implementation
class SimplexNoise {
    constructor() {
        this.grad3 = [
            [1,1,0],[-1,1,0],[1,-1,0],[-1,-1,0],
            [1,0,1],[-1,0,1],[1,0,-1],[-1,0,-1],
            [0,1,1],[0,-1,1],[0,1,-1],[0,-1,-1]
        ];
        
        this.p = [];
        for(let i = 0; i < 256; i++) {
            this.p[i] = Math.floor(Math.random() * 256);
        }
        
        this.perm = [];
        for(let i = 0; i < 512; i++) {
            this.perm[i] = this.p[i & 255];
        }
    }
    
    dot(g, x, y, z) {
        return g[0] * x + g[1] * y + g[2] * z;
    }
    
    noise(xin, yin, zin) {
        const F3 = 1.0 / 3.0;
        const G3 = 1.0 / 6.0;
        
        const s = (xin + yin + zin) * F3;
        const i = Math.floor(xin + s);
        const j = Math.floor(yin + s);
        const k = Math.floor(zin + s);
        
        const t = (i + j + k) * G3;
        const X0 = i - t;
        const Y0 = j - t;
        const Z0 = k - t;
        const x0 = xin - X0;
        const y0 = yin - Y0;
        const z0 = zin - Z0;
        
        let i1, j1, k1;
        let i2, j2, k2;
        
        if(x0 >= y0) {
            if(y0 >= z0) { i1=1; j1=0; k1=0; i2=1; j2=1; k2=0; }
            else if(x0 >= z0) { i1=1; j1=0; k1=0; i2=1; j2=0; k2=1; }
            else { i1=0; j1=0; k1=1; i2=1; j2=0; k2=1; }
        } else {
            if(y0 < z0) { i1=0; j1=0; k1=1; i2=0; j2=1; k2=1; }
            else if(x0 < z0) { i1=0; j1=1; k1=0; i2=0; j2=1; k2=1; }
            else { i1=0; j1=1; k1=0; i2=1; j2=1; k2=0; }
        }
        
        const x1 = x0 - i1 + G3;
        const y1 = y0 - j1 + G3;
        const z1 = z0 - k1 + G3;
        const x2 = x0 - i2 + 2.0 * G3;
        const y2 = y0 - j2 + 2.0 * G3;
        const z2 = z0 - k2 + 2.0 * G3;
        const x3 = x0 - 1.0 + 3.0 * G3;
        const y3 = y0 - 1.0 + 3.0 * G3;
        const z3 = z0 - 1.0 + 3.0 * G3;
        
        const ii = i & 255;
        const jj = j & 255;
        const kk = k & 255;
        
        const gi0 = this.perm[ii + this.perm[jj + this.perm[kk]]] % 12;
        const gi1 = this.perm[ii + i1 + this.perm[jj + j1 + this.perm[kk + k1]]] % 12;
        const gi2 = this.perm[ii + i2 + this.perm[jj + j2 + this.perm[kk + k2]]] % 12;
        const gi3 = this.perm[ii + 1 + this.perm[jj + 1 + this.perm[kk + 1]]] % 12;
        
        let t0 = 0.6 - x0*x0 - y0*y0 - z0*z0;
        let n0 = t0 < 0 ? 0.0 : Math.pow(t0, 4) * this.dot(this.grad3[gi0], x0, y0, z0);
        
        let t1 = 0.6 - x1*x1 - y1*y1 - z1*z1;
        let n1 = t1 < 0 ? 0.0 : Math.pow(t1, 4) * this.dot(this.grad3[gi1], x1, y1, z1);
        
        let t2 = 0.6 - x2*x2 - y2*y2 - z2*z2;
        let n2 = t2 < 0 ? 0.0 : Math.pow(t2, 4) * this.dot(this.grad3[gi2], x2, y2, z2);
        
        let t3 = 0.6 - x3*x3 - y3*y3 - z3*z3;
        let n3 = t3 < 0 ? 0.0 : Math.pow(t3, 4) * this.dot(this.grad3[gi3], x3, y3, z3);
        
        return 32.0 * (n0 + n1 + n2 + n3);
    }
}

// ============================================
// PART 2: Enhanced Particle Sphere with Noise
// ============================================
class ParticleSphere {
    constructor() {
        this.canvas = document.getElementById('particle-canvas');
        if (!this.canvas) return;
        
        this.scene = new THREE.Scene();
        this.clock = new THREE.Clock();
        this.scrollProgress = 0;
        
        this.initCamera();
        this.initRenderer();
        this.createParticles();
        this.addEventListeners();
        this.animate();
    }

    initCamera() {
        this.camera = new THREE.PerspectiveCamera(
            75,
            window.innerWidth / window.innerHeight,
            0.1,
            1000
        );
        this.camera.position.z = 12;
    }

    initRenderer() {
        this.renderer = new THREE.WebGLRenderer({
            canvas: this.canvas,
            antialias: true,
            alpha: true
        });
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        this.renderer.setClearColor(0x001348, 0);
    }

    createParticles() {
        const radius = 5;
        const latitudeLines = 60;
        const longitudePoints = 100;
        
        const positions = [];
        const originalPositions = [];
        const randomTargets = [];
        const sizes = [];

        for (let lat = 0; lat < latitudeLines; lat++) {
            const phi = (Math.PI * lat) / (latitudeLines - 1);
            const ringRadius = Math.sin(phi) * radius;
            const y = Math.cos(phi) * radius;
            
            const pointsInRing = Math.max(8, Math.floor(longitudePoints * Math.sin(phi)));
            
            for (let lon = 0; lon < pointsInRing; lon++) {
                const theta = (2 * Math.PI * lon) / pointsInRing;
                
                const x = ringRadius * Math.cos(theta);
                const z = ringRadius * Math.sin(theta);
                
                positions.push(x, y, z);
                originalPositions.push(x, y, z);
                
                // Random dispersed positions for scroll effect
                randomTargets.push(
                    (Math.random() - 0.5) * 25,
                    (Math.random() - 0.5) * 25,
                    (Math.random() - 0.5) * 20
                );
                
                // Smaller particle size
                sizes.push(0.25 + Math.random() * 0.2);
            }
        }

        this.geometry = new THREE.BufferGeometry();
        this.geometry.setAttribute('position', new THREE.Float32BufferAttribute(positions, 3));
        this.geometry.setAttribute('size', new THREE.Float32BufferAttribute(sizes, 1));
        
        this.originalPositions = new Float32Array(originalPositions);
        this.randomTargets = new Float32Array(randomTargets);

        // Enhanced vertex shader with depth-based sizing (no glow)
        const vertexShader = `
            attribute float size;
            varying float vAlpha;
            varying float vDepth;
            void main() {
                vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
                float depth = -mvPosition.z;
                vDepth = depth;
                
                // Moderate depth-based sizing
                float depthScale = 80.0 / max(depth, 1.0);
                gl_PointSize = size * depthScale;
                
                gl_Position = projectionMatrix * mvPosition;
                
                // Consistent brightness with slight depth fade
                vAlpha = 0.6 + 0.4 * (1.0 - smoothstep(5.0, 20.0, depth));
            }
        `;

        const fragmentShader = `
            varying float vAlpha;
            varying float vDepth;
            void main() {
                vec2 center = gl_PointCoord - vec2(0.5);
                float dist = length(center);
                if (dist > 0.5) discard;
                
                // Crisp, solid particles without glow
                float alpha = 1.0 - smoothstep(0.4, 0.5, dist);
                
                // Solid golden color
                vec3 color = vec3(0.9, 0.75, 0.4);
                
                gl_FragColor = vec4(color, alpha * vAlpha);
            }
        `;

        this.material = new THREE.ShaderMaterial({
            vertexShader: vertexShader,
            fragmentShader: fragmentShader,
            transparent: true,
            depthWrite: false,
            depthTest: true,
            blending: THREE.NormalBlending
        });

        this.particles = new THREE.Points(this.geometry, this.material);
        this.scene.add(this.particles);

        this.mouse = new THREE.Vector2(0, 0);
        this.targetRotation = new THREE.Vector2(0, 0);
        this.targetCameraZ = 12;
    }

    addEventListeners() {
        window.addEventListener('resize', () => this.onResize());
        window.addEventListener('mousemove', (e) => this.onMouseMove(e));
        window.addEventListener('touchmove', (e) => this.onTouchMove(e));
        window.addEventListener('scroll', () => this.onScroll());
    }

    onScroll() {
        // Calculate scroll progress based on entire page height
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const rawProgress = scrollTop / docHeight; // 0 to 1 from top to bottom
        
        // Create a parabolic curve: expands in middle, shrinks at bottom
        // Using sine wave: starts at 0, peaks at 0.5 (middle), returns to 0 at end
        this.scrollProgress = Math.sin(rawProgress * Math.PI);
    }

    onResize() {
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(window.innerWidth, window.innerHeight);
    }

    onMouseMove(event) {
        this.mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        this.mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    }

    onTouchMove(event) {
        if (event.touches.length > 0) {
            this.mouse.x = (event.touches[0].clientX / window.innerWidth) * 2 - 1;
            this.mouse.y = -(event.touches[0].clientY / window.innerHeight) * 2 + 1;
        }
    }

    animate() {
        requestAnimationFrame(() => this.animate());

        const time = this.clock.getElapsedTime();
        const positions = this.geometry.attributes.position.array;

        // Ease functions
        const easeInOutCubic = (t) => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
        const easeOutQuart = (t) => 1 - Math.pow(1 - t, 4);
        
        // Calculate which shape we're morphing into based on scroll
        const totalShapes = 5;
        const shapeIndex = this.scrollProgress * totalShapes;
        const currentShape = Math.floor(shapeIndex);
        const nextShape = Math.min(currentShape + 1, totalShapes);
        const shapeBlend = shapeIndex - currentShape; // 0 to 1 between shapes
        const smoothBlend = easeInOutCubic(shapeBlend);
        
        // DRAMATIC EXPANSION EFFECT - zoom into particles as we scroll
        const expansionScale = 1 + this.scrollProgress * 2.5; // Grows to 3.5x
        const tunnelEffect = this.scrollProgress * 1.8; // Pull camera closer for "going inside" feel
        this.targetCameraZ = 12 - tunnelEffect * 7; // Move camera from z=12 to z=5
        this.camera.position.z += (this.targetCameraZ - this.camera.position.z) * 0.05;
        
        // Pulsing expansion for dramatic effect
        const breathePulse = 1 + Math.sin(time * 0.6) * 0.15 * this.scrollProgress;
        
        for (let i = 0; i < positions.length / 3; i++) {
            const ox = this.originalPositions[i * 3];
            const oy = this.originalPositions[i * 3 + 1];
            const oz = this.originalPositions[i * 3 + 2];

            const r = Math.sqrt(ox * ox + oy * oy + oz * oz);
            const nx = ox / r;
            const ny = oy / r;
            const nz = oz / r;
            
            // Calculate different shape targets
            let shapes = [];
            
            // Shape 0: Expanding Sphere with waves
            const wave = Math.sin(oy * 2 + time) * 0.4 + Math.cos(ox * 2 + time * 0.8) * 0.3;
            shapes[0] = {
                x: nx * r * (1.2 + wave * 0.3) * expansionScale * breathePulse,
                y: ny * r * (1.2 + wave * 0.3) * expansionScale * breathePulse,
                z: nz * r * (1.2 + wave * 0.3) * expansionScale * breathePulse
            };
            
            // Shape 1: Cube - particles snap to cube edges
            const cubeSize = 6 * expansionScale;
            const cubeX = Math.sign(nx) * cubeSize * Math.pow(Math.abs(nx), 0.3);
            const cubeY = Math.sign(ny) * cubeSize * Math.pow(Math.abs(ny), 0.3);
            const cubeZ = Math.sign(nz) * cubeSize * Math.pow(Math.abs(nz), 0.3);
            shapes[1] = {
                x: cubeX * breathePulse,
                y: cubeY * breathePulse,
                z: cubeZ * breathePulse
            };
            
            // Shape 2: Octahedron - 8 triangular faces
            const octSize = 5 * expansionScale;
            const octTheta = Math.atan2(oz, ox);
            const octPhi = Math.acos(ny);
            
            // Map particles to octahedron surface
            const topPyramid = octPhi < Math.PI / 2;
            const signY = topPyramid ? 1 : -1;
            
            // Calculate position on octahedron surface
            const octRadius = Math.abs(Math.cos(octPhi) * 2);
            const octX = octSize * octRadius * Math.cos(octTheta) * Math.abs(Math.sin(octPhi));
            const octY = octSize * signY * (1 - octRadius * 0.5);
            const octZ = octSize * octRadius * Math.sin(octTheta) * Math.abs(Math.sin(octPhi));
            
            shapes[2] = {
                x: octX * breathePulse,
                y: octY * breathePulse,
                z: octZ * breathePulse
            };
            
            // Shape 3: Spiral Galaxy
            const spiralAngle = Math.atan2(oz, ox);
            const spiralRadius = r * 1.2 * expansionScale;
            const spiralHeight = oy + Math.sin(spiralAngle * 3 + time) * 2;
            const spiralSpin = spiralAngle + spiralRadius * 0.3 + time * 0.5;
            shapes[3] = {
                x: spiralRadius * Math.cos(spiralSpin) * breathePulse,
                y: spiralHeight * breathePulse,
                z: spiralRadius * Math.sin(spiralSpin) * breathePulse
            };
            
            // Shape 4: Wave Field - particles form wave pattern
            const waveX = ox * 1.5 * expansionScale;
            const waveZ = oz * 1.5 * expansionScale;
            const waveY = Math.sin(waveX * 0.5 + time) * 3 + Math.cos(waveZ * 0.5 + time * 0.7) * 3;
            shapes[4] = {
                x: waveX * breathePulse,
                y: waveY * breathePulse,
                z: waveZ * breathePulse
            };
            
            // Interpolate between current and next shape
            let targetX, targetY, targetZ;
            if (currentShape < totalShapes) {
                const current = shapes[currentShape];
                const next = shapes[nextShape] || shapes[totalShapes - 1];
                
                targetX = current.x + (next.x - current.x) * smoothBlend;
                targetY = current.y + (next.y - current.y) * smoothBlend;
                targetZ = current.z + (next.z - current.z) * smoothBlend;
            } else {
                const final = shapes[totalShapes - 1];
                targetX = final.x;
                targetY = final.y;
                targetZ = final.z;
            }
            
            // Apply positions with some organic movement
            const organicWave = Math.sin(time * 2 + i * 0.01) * 0.1 * this.scrollProgress;
            positions[i * 3] = targetX + organicWave;
            positions[i * 3 + 1] = targetY + organicWave;
            positions[i * 3 + 2] = targetZ + organicWave;
        }

        this.geometry.attributes.position.needsUpdate = true;

        // Dramatic rotation changes per shape
        const rotationFactor = 1 - this.scrollProgress * 0.5;
        let autoRotationSpeed = 0.003;
        
        if (currentShape === 1) autoRotationSpeed = 0.006; // Cube spins faster
        if (currentShape === 2) autoRotationSpeed = 0.004; // Torus moderate
        if (currentShape === 3) autoRotationSpeed = 0.008; // Galaxy spins fastest
        if (currentShape === 4) autoRotationSpeed = 0.002; // Wave slower
        
        this.targetRotation.x = this.mouse.y * 0.5 * rotationFactor;
        this.targetRotation.y = this.mouse.x * 0.5 * rotationFactor;

        this.particles.rotation.x += (this.targetRotation.x - this.particles.rotation.x) * 0.05;
        this.particles.rotation.y += (this.targetRotation.y - this.particles.rotation.y) * 0.05;
        this.particles.rotation.y += autoRotationSpeed;
        
        // Add depth wobble
        this.particles.rotation.z = Math.sin(time * 0.4) * 0.08 * rotationFactor;
        
        // Particle scale pulse effect
        this.particles.scale.setScalar(1 + Math.sin(time * 1.5) * 0.02);

        this.renderer.render(this.scene, this.camera);
    }
}

// Initialize after splash screen
window.addEventListener('load', function() {
    setTimeout(function() {
        new ParticleSphere();
    }, 100);
});
    </script>
    
    <script>
    // ============================================
    // SCROLL TIMELINE SYSTEM
    // ============================================
    
    // Initialize scroll timeline after page loads
    window.addEventListener('load', function() {
        setTimeout(initScrollTimeline, 3600);
    });
    
    function initScrollTimeline() {
        const progressBar = document.getElementById('scrollProgressBar');
        const timeline = document.getElementById('scrollTimeline');
        const timelineDots = document.querySelectorAll('.timeline-dot');
        const sections = document.querySelectorAll('.scroll-section');
        
        // Update scroll progress bar
        function updateScrollProgress() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            progressBar.style.width = scrollPercent + '%';
            
            // Show timeline after scrolling past hero
            if (scrollTop > 300) {
                timeline.classList.add('active');
            } else {
                timeline.classList.remove('active');
            }
        }
        
        // Update active timeline dot based on scroll position
        function updateActiveSection() {
            let currentSection = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 200;
                const sectionHeight = section.offsetHeight;
                const scrollPos = window.scrollY;
                
                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    currentSection = section.id;
                }
            });
            
            // Check if at hero
            if (window.scrollY < 300) {
                currentSection = 'hero';
            }
            
            timelineDots.forEach(dot => {
                dot.classList.remove('active');
                if (dot.getAttribute('data-target') === currentSection) {
                    dot.classList.add('active');
                }
            });
        }
        
        // Click handler for timeline dots
        timelineDots.forEach(dot => {
            dot.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    const offsetTop = targetId === 'hero' ? 0 : targetElement.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Scroll event listener
        window.addEventListener('scroll', function() {
            updateScrollProgress();
            updateActiveSection();
        });
        
        // Initial update
        updateScrollProgress();
        updateActiveSection();
        
        // ============================================
        // GSAP SCROLL TRIGGER ANIMATIONS
        // ============================================
        gsap.registerPlugin(ScrollTrigger);
        
        // Add animate-in class to sections initially
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            // Only add animation class if section is below viewport
            if (rect.top > window.innerHeight) {
                section.classList.add('animate-in');
            }
        });
        
        // Animate sections on scroll
        sections.forEach((section, index) => {
            if (section.classList.contains('animate-in')) {
                gsap.to(section, {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: section,
                        start: "top 80%",
                        end: "top 20%",
                        toggleActions: "play none none reverse",
                        onEnter: () => section.classList.remove('animate-in')
                    }
                });
            }
        });
        
        // Animate cards with stagger effect
        const cardSelectors = ['.card', '.service-card', '.value-card', '.project-card'];
        cardSelectors.forEach(selector => {
            const cards = document.querySelectorAll(selector);
            if (cards.length > 0) {
                gsap.from(cards, {
                    y: 80,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: cards[0].closest('.section'),
                        start: "top 70%",
                        toggleActions: "play none none reverse"
                    }
                });
            }
        });
        
        // Animate section headers
        const sectionHeaders = document.querySelectorAll('.section-header');
        sectionHeaders.forEach(header => {
            gsap.from(header, {
                y: 50,
                opacity: 0,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: header,
                    start: "top 80%",
                    toggleActions: "play none none reverse"
                }
            });
        });
        
        // Parallax effect for hero background
        gsap.to('.hero-bg', {
            y: () => window.innerHeight * 0.5,
            ease: "none",
            scrollTrigger: {
                trigger: '.hero',
                start: "top top",
                end: "bottom top",
                scrub: 1
            }
        });
        
        // Scale and fade particle canvas as you scroll
        gsap.to('#particle-canvas', {
            opacity: 0.3,
            scale: 1.2,
            ease: "none",
            scrollTrigger: {
                trigger: 'body',
                start: "top top",
                end: "2000px top",
                scrub: 1
            }
        });
        
        // Animate timeline dots appearance
        gsap.from('.timeline-dot', {
            x: 50,
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: "back.out(1.7)",
            delay: 0.5
        });
    }
    
    // Splash Screen
    window.addEventListener('load',function(){setTimeout(function(){var s=document.getElementById('splash');s.classList.add('exit');setTimeout(function(){s.style.display='none'},1000)},3500)});
    // Navbar scroll
    window.addEventListener('scroll',function(){document.getElementById('navbar').classList.toggle('scrolled',window.scrollY>50)});
    // Mobile nav - Side drawer style
    function toggleNav(){
        const navMenu = document.getElementById('navMenu');
        const navOverlay = document.getElementById('navOverlay');
        const body = document.body;
        if(navMenu.classList.contains('show')) {
            navMenu.classList.remove('show');
            navOverlay.classList.remove('show');
            body.classList.remove('modal-open');
        } else {
            navMenu.classList.add('show');
            navOverlay.classList.add('show');
            body.classList.add('modal-open');
        }
    }
    function closeNav(){
        document.getElementById('navMenu').classList.remove('show');
        document.getElementById('navOverlay').classList.remove('show');
        document.body.classList.remove('modal-open');
    }
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(function(a){a.addEventListener('click',function(e){e.preventDefault();var t=document.querySelector(this.getAttribute('href'));if(t)window.scrollTo({top:t.offsetTop-80,behavior:'smooth'})})});
    // Reveal animations
    function checkReveal(){document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale').forEach(function(el){if(el.getBoundingClientRect().top<window.innerHeight-80)el.classList.add('active')})}
    window.addEventListener('scroll',checkReveal);window.addEventListener('load',checkReveal);
    
    // ============================================
    // CAROUSEL FUNCTIONALITY
    // ============================================
    const carousels = {};
    
    function initCarousel(carouselId, dotsId) {
        const track = document.getElementById(carouselId);
        if (!track) return;
        
        const cards = track.querySelectorAll('.service-card');
        const dotsContainer = document.getElementById(dotsId);
        
        if (cards.length === 0) return;
        
        carousels[carouselId] = {
            track: track,
            cards: cards,
            currentIndex: 0,
            cardWidth: cards[0].offsetWidth + 24, // card width + gap
            totalCards: cards.length,
            isPlaying: true,
            touchStartX: 0,
            touchEndX: 0
        };
        
        // Create dots
        if (dotsContainer) {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < cards.length; i++) {
                const dot = document.createElement('div');
                dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
                dot.onclick = () => goToSlide(carouselId, i);
                dotsContainer.appendChild(dot);
            }
        }
        
        // Touch events for swipe
        track.addEventListener('touchstart', (e) => {
            carousels[carouselId].touchStartX = e.touches[0].clientX;
        });
        
        track.addEventListener('touchend', (e) => {
            carousels[carouselId].touchEndX = e.changedTouches[0].clientX;
            handleSwipe(carouselId);
        });
        
        // Mouse events for drag (optional)
        let isDragging = false;
        let startX = 0;
        
        track.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.clientX;
            track.style.cursor = 'grabbing';
        });
        
        track.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
        });
        
        track.addEventListener('mouseup', (e) => {
            if (!isDragging) return;
            isDragging = false;
            track.style.cursor = 'grab';
            const endX = e.clientX;
            const diff = startX - endX;
            if (Math.abs(diff) > 50) {
                slideCarousel(carouselId, diff > 0 ? 1 : -1);
            }
        });
        
        track.addEventListener('mouseleave', () => {
            if (isDragging) {
                isDragging = false;
                track.style.cursor = 'grab';
            }
        });
        
        // Pause on hover
        track.addEventListener('mouseenter', () => {
            carousels[carouselId].isPlaying = false;
        });
        
        track.addEventListener('mouseleave', () => {
            carousels[carouselId].isPlaying = true;
        });
    }
    
    function handleSwipe(carouselId) {
        const carousel = carousels[carouselId];
        const diff = carousel.touchStartX - carousel.touchEndX;
        
        if (Math.abs(diff) > 50) {
            slideCarousel(carouselId, diff > 0 ? 1 : -1);
        }
    }
    
    function slideCarousel(carouselId, direction) {
        const carousel = carousels[carouselId];
        if (!carousel) return;
        
        carousel.currentIndex += direction;
        
        // Loop around
        if (carousel.currentIndex < 0) {
            carousel.currentIndex = carousel.totalCards - 1;
        } else if (carousel.currentIndex >= carousel.totalCards) {
            carousel.currentIndex = 0;
        }
        
        updateCarousel(carouselId);
    }
    
    function goToSlide(carouselId, index) {
        const carousel = carousels[carouselId];
        if (!carousel) return;
        
        carousel.currentIndex = index;
        updateCarousel(carouselId);
    }
    
    function updateCarousel(carouselId) {
        const carousel = carousels[carouselId];
        if (!carousel) return;
        
        const offset = -carousel.currentIndex * carousel.cardWidth;
        carousel.track.style.transform = `translateX(${offset}px)`;
        
        // Update dots
        const dotsId = carouselId.replace('-carousel', '-dots');
        const dotsContainer = document.getElementById(dotsId);
        if (dotsContainer) {
            const dots = dotsContainer.querySelectorAll('.carousel-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === carousel.currentIndex);
            });
        }
    }
    
    function autoPlayCarousels() {
        Object.keys(carousels).forEach(carouselId => {
            const carousel = carousels[carouselId];
            if (carousel.isPlaying) {
                slideCarousel(carouselId, 1);
            }
        });
    }
    
    // Initialize carousels after page load
    window.addEventListener('load', function() {
        setTimeout(function() {
            initCarousel('services-carousel', 'services-dots');
            initCarousel('products-carousel', 'products-dots');
            
            // Auto-play every 4 seconds
            setInterval(autoPlayCarousels, 4000);
        }, 100);
    });
    </script>
</body>
</html>
