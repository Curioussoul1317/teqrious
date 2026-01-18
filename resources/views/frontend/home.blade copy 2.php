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
/* ============================================
   TEQRIOUS - Modern Professional Stylesheet
   Colors: Primary #001348 | Secondary #aa134a | Third #cb9430
   ============================================ */

/* ---------- CSS Variables & Root ---------- */
:root {
    --primary: #001348;
    --primary-light: #0a2463;
    --primary-dark: #000b2e;
    --secondary: #aa134a;
    --secondary-light: #d41f5f;
    --secondary-dark: #8a0f3c;
    --third: #cb9430;
    --third-light: #e5aa42;
    --third-dark: #a67825;
    
    --white: #ffffff;
    --off-white: #f8f9fc;
    --gray-100: #f1f3f7;
    --gray-200: #e2e6ee;
    --gray-300: #c8cfdc;
    --gray-400: #9aa3b8;
    --gray-500: #6b7794;
    --gray-600: #4a5568;
    --gray-700: #2d3748;
    --gray-800: #1a202c;
    --gray-900: #0d1117;
    
    --font-display: 'Outfit', sans-serif;
    --font-body: 'Plus Jakarta Sans', sans-serif;
    
    --shadow-sm: 0 2px 8px rgba(0, 19, 72, 0.06);
    --shadow-md: 0 8px 24px rgba(0, 19, 72, 0.1);
    --shadow-lg: 0 16px 48px rgba(0, 19, 72, 0.15);
    --shadow-xl: 0 24px 64px rgba(0, 19, 72, 0.2);
    --shadow-glow: 0 0 60px rgba(170, 19, 74, 0.3);
    --shadow-gold: 0 8px 32px rgba(203, 148, 48, 0.25);
    
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 20px;
    --radius-xl: 32px;
    --radius-full: 9999px;
    
    --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    --transition-smooth: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    --transition-bounce: 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* ---------- Font Imports ---------- */
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

/* ---------- Reset & Base ---------- */
*, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    scroll-padding-top: 80px;
}

body {
    font-family: var(--font-body);
    font-size: 16px;
    line-height: 1.7;
    color: var(--gray-700);
    background: var(--white);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* ---------- Splash Screen ---------- */
.splash-screen {
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    overflow: hidden;
}

.splash-screen::before {
    content: '';
    position: absolute;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(ellipse at 30% 20%, rgba(170, 19, 74, 0.15) 0%, transparent 50%),
        radial-gradient(ellipse at 70% 80%, rgba(203, 148, 48, 0.1) 0%, transparent 50%);
    animation: splashBgFloat 4s ease-in-out infinite;
}

@keyframes splashBgFloat {
    0%, 100% { transform: translate(-10%, -10%) rotate(0deg); }
    50% { transform: translate(0%, 0%) rotate(3deg); }
}

.splash-logo {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 0;
    font-family: var(--font-display);
    font-size: clamp(3rem, 10vw, 6rem);
    font-weight: 800;
    letter-spacing: -0.02em;
}

.splash-logo .te {
    color: var(--white);
    opacity: 0;
    transform: translateX(-30px);
    animation: splashLetterIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards;
}

.splash-logo .q {
    color: var(--secondary);
    opacity: 0;
    transform: scale(0) rotate(-180deg);
    animation: splashQIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.5s forwards;
    text-shadow: 0 0 40px rgba(170, 19, 74, 0.6);
}

.splash-logo .rious {
    color: var(--third);
    opacity: 0;
    transform: translateX(30px);
    animation: splashLetterIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.7s forwards;
    text-shadow: 0 0 30px rgba(203, 148, 48, 0.4);
}

@keyframes splashLetterIn {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes splashQIn {
    to {
        opacity: 1;
        transform: scale(1) rotate(0deg);
    }
}

.splash-tagline {
    position: relative;
    z-index: 2;
    color: var(--gray-400);
    font-size: 1.1rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    margin-top: 1.5rem;
    opacity: 0;
    transform: translateY(20px);
    animation: splashTaglineIn 0.6s ease 1s forwards;
}

@keyframes splashTaglineIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.splash-loader {
    position: relative;
    z-index: 2;
    width: 200px;
    height: 3px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--radius-full);
    margin-top: 3rem;
    overflow: hidden;
    opacity: 0;
    animation: splashLoaderIn 0.4s ease 1.2s forwards;
}

@keyframes splashLoaderIn {
    to { opacity: 1; }
}

.splash-loader::after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    background: linear-gradient(90deg, var(--secondary), var(--third));
    border-radius: inherit;
    animation: splashLoaderFill 1.5s cubic-bezier(0.4, 0, 0.2, 1) 1.4s forwards;
}

@keyframes splashLoaderFill {
    to { width: 100%; }
}

.splash-particles {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

.splash-particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: var(--third);
    border-radius: 50%;
    opacity: 0;
}

.splash-particle:nth-child(1) { left: 20%; top: 30%; animation: particleFloat 3s ease-in-out 0.5s infinite; }
.splash-particle:nth-child(2) { left: 80%; top: 20%; animation: particleFloat 3.5s ease-in-out 0.8s infinite; }
.splash-particle:nth-child(3) { left: 60%; top: 70%; animation: particleFloat 2.8s ease-in-out 1s infinite; }
.splash-particle:nth-child(4) { left: 10%; top: 60%; animation: particleFloat 3.2s ease-in-out 0.3s infinite; }
.splash-particle:nth-child(5) { left: 90%; top: 50%; animation: particleFloat 3.8s ease-in-out 0.6s infinite; }
.splash-particle:nth-child(6) { left: 40%; top: 85%; animation: particleFloat 2.5s ease-in-out 1.2s infinite; }

@keyframes particleFloat {
    0%, 100% {
        opacity: 0;
        transform: translateY(0) scale(0);
    }
    20% {
        opacity: 0.8;
        transform: translateY(-20px) scale(1);
    }
    80% {
        opacity: 0.6;
        transform: translateY(-80px) scale(0.8);
    }
}

/* Splash Exit Animation */
.splash-screen.exit {
    animation: splashExit 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.splash-screen.exit .splash-logo,
.splash-screen.exit .splash-tagline,
.splash-screen.exit .splash-loader {
    animation: splashContentExit 0.4s ease forwards;
}

@keyframes splashContentExit {
    to {
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
    }
}

@keyframes splashExit {
    0% {
        clip-path: circle(150% at 50% 50%);
    }
    100% {
        clip-path: circle(0% at 50% 50%);
    }
}

/* ---------- Selection Styles ---------- */
::selection {
    background: var(--secondary);
    color: var(--white);
}

/* ---------- Custom Scrollbar ---------- */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: var(--gray-100);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--primary), var(--primary-light));
    border-radius: var(--radius-full);
    border: 2px solid var(--gray-100);
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, var(--secondary), var(--secondary-light));
}

/* ---------- Typography ---------- */
h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-display);
    font-weight: 700;
    color: var(--primary);
    line-height: 1.2;
}

h1 { font-size: clamp(2.5rem, 6vw, 4rem); }
h2 { font-size: clamp(2rem, 4vw, 3rem); }
h3 { font-size: clamp(1.5rem, 3vw, 2rem); }
h4 { font-size: 1.5rem; }
h5 { font-size: 1.25rem; }
h6 { font-size: 1rem; }

p {
    margin-bottom: 1rem;
}

a {
    color: var(--secondary);
    text-decoration: none;
    transition: var(--transition-fast);
}

a:hover {
    color: var(--third);
}

/* ---------- Container ---------- */
.container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
}

/* ---------- Navigation ---------- */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    padding: 20px 0;
    transition: var(--transition-smooth);
    background: transparent;
}

.navbar.scrolled {
    padding: 12px 0;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: var(--shadow-md);
}

.navbar .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.navbar-brand {
    font-family: var(--font-display);
    font-size: 1.75rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    display: flex;
    align-items: center;
}

.brand-te {
    color: var(--white);
    transition: var(--transition-fast);
}

.brand-q {
    color: var(--secondary);
    display: inline-block;
    transition: var(--transition-bounce);
}

.brand-rious {
    color: var(--third);
    transition: var(--transition-fast);
}

.navbar.scrolled .brand-te {
    color: var(--primary);
}

.navbar-brand:hover .brand-q {
    transform: rotate(-10deg) scale(1.1);
}

.navbar-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;
}

.nav-link {
    position: relative;
    padding: 10px 20px;
    font-weight: 500;
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.85);
    border-radius: var(--radius-full);
    transition: var(--transition-fast);
    overflow: hidden;
}

.navbar.scrolled .nav-link {
    color: var(--gray-600);
}

.nav-link::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--secondary), var(--third));
    opacity: 0;
    transform: scale(0.8);
    border-radius: inherit;
    transition: var(--transition-smooth);
    z-index: -1;
}

.nav-link:hover {
    color: var(--white);
}

.nav-link:hover::before {
    opacity: 1;
    transform: scale(1);
}

/* Mobile Navigation */
.navbar-toggler {
    display: none;
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: var(--transition-fast);
}

.navbar.scrolled .navbar-toggler {
    background: var(--gray-100);
}

.navbar-toggler:hover {
    background: var(--secondary);
}

.navbar-toggler-icon {
    display: block;
    width: 22px;
    height: 2px;
    background: var(--white);
    position: relative;
    margin: 0 auto;
    transition: var(--transition-fast);
}

.navbar.scrolled .navbar-toggler-icon {
    background: var(--primary);
}

.navbar-toggler-icon::before,
.navbar-toggler-icon::after {
    content: '';
    position: absolute;
    left: 0;
    width: 100%;
    height: 2px;
    background: inherit;
    transition: var(--transition-fast);
}

.navbar-toggler-icon::before { top: -7px; }
.navbar-toggler-icon::after { bottom: -7px; }

@media (max-width: 991px) {
    .navbar-toggler {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 16px;
        right: 16px;
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-xl);
        padding: 16px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: var(--transition-smooth);
    }
    
    .navbar-collapse.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .navbar-nav {
        flex-direction: column;
        gap: 4px;
    }
    
    .nav-link {
        color: var(--gray-700);
        padding: 14px 20px;
        width: 100%;
        text-align: center;
    }
}

/* ---------- Hero Section ---------- */
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    overflow: hidden;
    padding: 120px 0 80px;
}

/* Animated Tech Background */
.hero-tech {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.hero-tech-base {
    background: 
        radial-gradient(circle at 20% 80%, rgba(170, 19, 74, 0.15) 0%, transparent 40%),
        radial-gradient(circle at 80% 20%, rgba(203, 148, 48, 0.1) 0%, transparent 40%),
        radial-gradient(circle at 50% 50%, rgba(0, 19, 72, 0.5) 0%, transparent 70%);
}

.hero-tech-circuit {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0v20M30 40v20M0 30h20M40 30h20' stroke='%23aa134a' stroke-width='0.5' opacity='0.15'/%3E%3Ccircle cx='30' cy='30' r='3' fill='%23cb9430' opacity='0.2'/%3E%3C/svg%3E");
    background-size: 60px 60px;
    animation: circuitMove 30s linear infinite;
    opacity: 0.5;
}

@keyframes circuitMove {
    0% { background-position: 0 0; }
    100% { background-position: 60px 60px; }
}

.hero-tech-stream {
    background: linear-gradient(
        135deg,
        transparent 0%,
        transparent 40%,
        rgba(170, 19, 74, 0.05) 40.5%,
        rgba(170, 19, 74, 0.05) 41%,
        transparent 41.5%,
        transparent 100%
    );
    background-size: 200% 200%;
    animation: streamFlow 8s ease-in-out infinite;
}

@keyframes streamFlow {
    0%, 100% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
}

.hero-tech-glow {
    background: radial-gradient(ellipse at 50% 0%, rgba(203, 148, 48, 0.2) 0%, transparent 50%);
    animation: glowPulse 4s ease-in-out infinite;
}

@keyframes glowPulse {
    0%, 100% { opacity: 0.5; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.1); }
}

.hero-content {
    position: relative;
    z-index: 10;
    text-align: center;
}

.hero-content h1 {
    color: var(--white);
    font-weight: 800;
    margin-bottom: 1.5rem;
    opacity: 0;
    transform: translateY(40px);
    animation: heroTextIn 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
}

.hero-content h1 br {
    display: block;
}

@keyframes heroTextIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-content .lead {
    font-size: clamp(1.1rem, 2.5vw, 1.4rem);
    color: var(--gray-300);
    max-width: 600px;
    margin: 0 auto 2.5rem;
    opacity: 0;
    transform: translateY(30px);
    animation: heroTextIn 1s cubic-bezier(0.16, 1, 0.3, 1) 0.4s forwards;
}

/* Hero Image */
.hero-image-wrapper {
    position: relative;
    max-width: 700px;
    margin: 3rem auto;
    opacity: 0;
    transform: translateY(50px) scale(0.95);
    animation: heroImageIn 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.6s forwards;
}

@keyframes heroImageIn {
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.hero-image-glow {
    position: absolute;
    inset: -20%;
    background: radial-gradient(ellipse at center, rgba(170, 19, 74, 0.4) 0%, transparent 70%);
    filter: blur(40px);
    animation: imageGlow 4s ease-in-out infinite;
}

@keyframes imageGlow {
    0%, 100% { opacity: 0.6; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.05); }
}

.hero-image {
    position: relative;
    width: 100%;
    height: auto;
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-xl);
    transition: var(--transition-smooth);
}

.hero-image:hover {
    transform: translateY(-10px) rotateX(5deg);
    box-shadow: 0 40px 80px rgba(0, 19, 72, 0.4);
}

/* CTA Button */
.btn-cta {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 18px 40px;
    background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
    color: var(--white);
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 1.1rem;
    border: none;
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: var(--transition-smooth);
    box-shadow: var(--shadow-glow);
    opacity: 0;
    transform: translateY(30px);
    animation: heroTextIn 1s cubic-bezier(0.16, 1, 0.3, 1) 0.8s forwards;
    position: relative;
    overflow: hidden;
}

.btn-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--third), var(--third-light));
    opacity: 0;
    transition: var(--transition-smooth);
}

.btn-cta:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 0 80px rgba(170, 19, 74, 0.5);
    color: var(--white);
}

.btn-cta:hover::before {
    opacity: 1;
}

.btn-cta span,
.btn-cta i {
    position: relative;
    z-index: 1;
}

.btn-cta i {
    transition: var(--transition-fast);
}

.btn-cta:hover i {
    transform: translateX(5px);
}

/* ---------- Sections ---------- */
.section {
    padding: 100px 0;
    position: relative;
}

.section-title {
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 1rem;
    position: relative;
}

.section-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary), var(--third));
    margin-top: 1rem;
    border-radius: var(--radius-full);
}

.section-title.text-center::after {
    margin: 1rem auto 0;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--gray-500);
    max-width: 600px;
}

.text-center .section-subtitle {
    margin: 0 auto;
}

/* ---------- Reveal Animations ---------- */
.reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), 
                transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

.reveal:nth-child(2) { transition-delay: 0.1s; }
.reveal:nth-child(3) { transition-delay: 0.2s; }
.reveal:nth-child(4) { transition-delay: 0.3s; }
.reveal:nth-child(5) { transition-delay: 0.4s; }
.reveal:nth-child(6) { transition-delay: 0.5s; }

/* ---------- Cards ---------- */
.card-custom {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    transition: var(--transition-smooth);
    position: relative;
    overflow: hidden;
}

.card-custom::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary), var(--third));
    transform: scaleX(0);
    transform-origin: left;
    transition: var(--transition-smooth);
}

.card-custom:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: transparent;
}

.card-custom:hover::before {
    transform: scaleX(1);
}

.card-icon {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    margin-bottom: 1.25rem;
    transition: var(--transition-smooth);
}

.card-icon-primary {
    background: linear-gradient(135deg, rgba(0, 19, 72, 0.1), rgba(0, 19, 72, 0.05));
    color: var(--primary);
}

.card-icon-secondary {
    background: linear-gradient(135deg, rgba(170, 19, 74, 0.1), rgba(170, 19, 74, 0.05));
    color: var(--secondary);
}

.card-icon-third {
    background: linear-gradient(135deg, rgba(203, 148, 48, 0.1), rgba(203, 148, 48, 0.05));
    color: var(--third);
}

.card-custom:hover .card-icon {
    transform: scale(1.1) rotate(-5deg);
}

.card-custom h5 {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.card-custom p {
    color: var(--gray-500);
    font-size: 0.95rem;
    line-height: 1.7;
}

/* ---------- Service Tiles ---------- */
.service-tile {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem 1.5rem;
    text-align: center;
    border: 1px solid var(--gray-200);
    transition: var(--transition-smooth);
    cursor: pointer;
}

.service-tile i {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: 1rem;
    display: block;
    transition: var(--transition-bounce);
}

.service-tile h6 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-700);
    margin: 0;
    transition: var(--transition-fast);
}

.service-tile:hover {
    background: var(--primary);
    border-color: var(--primary);
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.service-tile:hover i {
    color: var(--third);
    transform: scale(1.2) translateY(-5px);
}

.service-tile:hover h6 {
    color: var(--white);
}

/* ---------- About Section ---------- */
.about-image {
    position: relative;
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.about-image::before {
    content: '';
    position: absolute;
    inset: -50%;
    background: conic-gradient(from 0deg, var(--secondary), var(--third), var(--primary), var(--secondary));
    animation: rotateBorder 6s linear infinite;
    z-index: -1;
}

@keyframes rotateBorder {
    100% { transform: rotate(360deg); }
}

.about-image img {
    border-radius: var(--radius-xl);
    width: 100%;
    height: auto;
    display: block;
    position: relative;
    border: 4px solid var(--white);
}

/* ---------- Values Section ---------- */
.value-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    border: 1px solid var(--gray-200);
    transition: var(--transition-smooth);
    height: 100%;
}

.value-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    font-size: 1.75rem;
    color: var(--white);
    transition: var(--transition-bounce);
}

.value-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: transparent;
}

.value-card:hover .value-icon {
    transform: scale(1.1);
    background: linear-gradient(135deg, var(--secondary), var(--third));
}

.value-card h5 {
    font-size: 1.15rem;
    margin-bottom: 0.75rem;
}

.value-card p {
    color: var(--gray-500);
    font-size: 0.9rem;
    margin: 0;
}

/* ---------- Work Steps ---------- */
.work-steps {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
    position: relative;
}

.work-steps::before {
    content: '';
    position: absolute;
    top: 35px;
    left: 15%;
    right: 15%;
    height: 3px;
    background: linear-gradient(90deg, var(--secondary), var(--third));
    z-index: 0;
}

.work-step {
    text-align: center;
    flex: 1;
    min-width: 180px;
    max-width: 220px;
    position: relative;
    z-index: 1;
}

.work-step-number {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: var(--white);
    font-family: var(--font-display);
    font-size: 1.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    box-shadow: var(--shadow-md);
    transition: var(--transition-bounce);
    border: 4px solid var(--white);
}

.work-step:hover .work-step-number {
    transform: scale(1.15);
    background: linear-gradient(135deg, var(--secondary), var(--third));
}

.work-step h6 {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.work-step p {
    color: var(--gray-500);
    font-size: 0.9rem;
    margin: 0;
}

@media (max-width: 768px) {
    .work-steps::before {
        display: none;
    }
}

/* ---------- Expertise Section ---------- */
.expertise-section {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
}

.expertise-section .section-title,
.expertise-section .section-subtitle {
    color: var(--white);
}

.expertise-section .section-title::after {
    background: var(--third);
}

.expertise-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius-lg);
    padding: 2rem;
    height: 100%;
    transition: var(--transition-smooth);
}

.expertise-card:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-5px);
    border-color: var(--third);
}

.expertise-card h5 {
    color: var(--white);
    font-size: 1.25rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.expertise-card p {
    color: var(--gray-300);
    margin-bottom: 1.25rem;
}

.expertise-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.expertise-card ul li {
    position: relative;
    padding-left: 1.5rem;
    color: var(--gray-400);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.expertise-card ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.6em;
    width: 8px;
    height: 8px;
    background: var(--third);
    border-radius: 50%;
}

.text-third {
    color: var(--third) !important;
}

/* ---------- Project Cards ---------- */
.project-card {
    overflow: hidden;
}

.project-card .card-img-top {
    transition: var(--transition-smooth);
}

.project-card:hover .card-img-top {
    transform: scale(1.08);
}

.project-card .card-body {
    position: relative;
}

.project-card .badge {
    background: linear-gradient(135deg, var(--secondary), var(--third));
    color: var(--white);
    font-weight: 500;
    font-size: 0.75rem;
    padding: 0.35em 0.75em;
    border-radius: var(--radius-full);
}

/* ---------- CTA Band ---------- */
.cta-band {
    background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cta-band::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h40v40H0z' fill='none'/%3E%3Ccircle cx='20' cy='20' r='1' fill='%23ffffff' opacity='0.1'/%3E%3C/svg%3E");
    background-size: 40px 40px;
}

.cta-band h3 {
    color: var(--white);
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    margin-bottom: 1rem;
    position: relative;
}

.cta-band p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.15rem;
    margin-bottom: 2rem;
    position: relative;
}

.cta-band .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 16px 36px;
    background: var(--white);
    color: var(--secondary);
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 1rem;
    border: none;
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: var(--transition-smooth);
    position: relative;
}

.cta-band .btn:hover {
    background: var(--third);
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: var(--shadow-gold);
}

/* ---------- Subsidiaries Section ---------- */
.subsidiaries-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    position: relative;
    overflow: hidden;
}

.subsidiaries-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(170, 19, 74, 0.1) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(203, 148, 48, 0.08) 0%, transparent 40%);
}

.subsidiary-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2.5rem 2rem;
    text-align: center;
    height: 100%;
    transition: var(--transition-smooth);
}

.subsidiary-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.subsidiary-card img {
    max-height: 60px;
    width: auto;
    margin-bottom: 1.25rem;
}

.subsidiary-card h5 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.subsidiary-card .btn-outline-primary {
    padding: 10px 24px;
    border: 2px solid var(--primary);
    background: transparent;
    color: var(--primary);
    font-weight: 600;
    border-radius: var(--radius-full);
    transition: var(--transition-fast);
}

.subsidiary-card .btn-outline-primary:hover {
    background: var(--primary);
    color: var(--white);
}

/* ---------- Contact Section ---------- */
.contact-form {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 3rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
}

.form-label {
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
}

.form-control {
    padding: 14px 18px;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-size: 1rem;
    transition: var(--transition-fast);
    background: var(--gray-100);
}

.form-control:focus {
    outline: none;
    border-color: var(--secondary);
    background: var(--white);
    box-shadow: 0 0 0 4px rgba(170, 19, 74, 0.1);
}

.form-control::placeholder {
    color: var(--gray-400);
}

textarea.form-control {
    resize: vertical;
    min-height: 140px;
}

.btn-submit {
    width: 100%;
    padding: 16px 32px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: var(--white);
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 1.1rem;
    border: none;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: var(--transition-smooth);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-submit:hover {
    background: linear-gradient(135deg, var(--secondary), var(--third));
    transform: translateY(-2px);
    box-shadow: var(--shadow-glow);
}

.alert-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: var(--white);
    padding: 1rem 1.5rem;
    border-radius: var(--radius-md);
    margin-bottom: 1.5rem;
    font-weight: 500;
}

/* ---------- Footer ---------- */
.footer {
    background: var(--primary-dark);
    padding: 80px 0 40px;
}

.footer-brand {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 800;
    color: var(--white);
}

.footer-brand span {
    color: var(--third);
}

.social-links {
    display: flex;
    gap: 12px;
}

.social-links a {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 1.1rem;
    transition: var(--transition-fast);
}

.social-links a:hover {
    background: var(--secondary);
    transform: translateY(-3px);
}

.footer h5 {
    color: var(--white);
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

.footer-links {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.footer-links a {
    color: var(--gray-400);
    font-size: 0.95rem;
    transition: var(--transition-fast);
}

.footer-links a:hover {
    color: var(--third);
    padding-left: 5px;
}

.footer hr {
    border-color: rgba(255, 255, 255, 0.1);
}

/* ---------- Chat Widget ---------- */
.chat-widget-button {
    position: fixed;
    bottom: 24px;
    right: 24px;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--secondary), var(--third));
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--white);
    box-shadow: var(--shadow-glow);
    transition: var(--transition-smooth);
    z-index: 1000;
    animation: chatPulse 2s ease-in-out infinite;
}

@keyframes chatPulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(170, 19, 74, 0.4), var(--shadow-glow); }
    50% { box-shadow: 0 0 0 15px rgba(170, 19, 74, 0), var(--shadow-glow); }
}

.chat-widget-button:hover {
    transform: scale(1.1);
    animation: none;
}

.chat-notification-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--third);
    color: var(--primary);
    font-size: 0.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid var(--white);
}

.chat-window {
    position: fixed;
    bottom: 100px;
    right: 24px;
    width: 380px;
    max-width: calc(100vw - 48px);
    height: 520px;
    max-height: calc(100vh - 150px);
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-xl);
    display: flex;
    flex-direction: column;
    z-index: 1001;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px) scale(0.95);
    transition: var(--transition-smooth);
    overflow: hidden;
}

.chat-window.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.chat-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    padding: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-header-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.chat-header-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 1.25rem;
}

.chat-header-text h5 {
    color: var(--white);
    font-size: 1rem;
    margin: 0;
}

.chat-header-text p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.8rem;
    margin: 0;
}

.chat-close-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: var(--white);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition-fast);
}

.chat-close-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.chat-body {
    flex: 1;
    padding: 1.25rem;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.chat-message {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    max-width: 85%;
    animation: messageIn 0.3s ease;
}

@keyframes messageIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chat-message.user {
    align-self: flex-end;
    flex-direction: row-reverse;
}

.chat-message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    color: var(--gray-500);
    flex-shrink: 0;
}

.chat-message.bot .chat-message-avatar {
    background: var(--primary);
    color: var(--white);
}

.chat-message-bubble {
    background: var(--gray-100);
    padding: 0.875rem 1rem;
    border-radius: var(--radius-lg);
    font-size: 0.9rem;
    line-height: 1.5;
}

.chat-message.user .chat-message-bubble {
    background: var(--primary);
    color: var(--white);
}

.typing-indicator {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 1rem;
    background: var(--gray-100);
    border-radius: var(--radius-lg);
}

.typing-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--gray-400);
    animation: typingBounce 1.4s ease-in-out infinite;
}

.typing-dot:nth-child(2) { animation-delay: 0.2s; }
.typing-dot:nth-child(3) { animation-delay: 0.4s; }

@keyframes typingBounce {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-8px); }
}

.chat-quick-options {
    padding: 0.75rem 1.25rem;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    border-top: 1px solid var(--gray-200);
}

.quick-option-btn {
    padding: 8px 16px;
    background: var(--gray-100);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--gray-600);
    cursor: pointer;
    transition: var(--transition-fast);
}

.quick-option-btn:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: var(--white);
}

.chat-footer {
    padding: 1rem 1.25rem;
    border-top: 1px solid var(--gray-200);
}

.chat-input-wrapper {
    display: flex;
    gap: 8px;
    align-items: center;
}

.chat-input {
    flex: 1;
    padding: 12px 16px;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-full);
    font-size: 0.9rem;
    transition: var(--transition-fast);
}

.chat-input:focus {
    outline: none;
    border-color: var(--secondary);
}

.chat-send-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--secondary), var(--third));
    border: none;
    color: var(--white);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition-fast);
}

.chat-send-btn:hover {
    transform: scale(1.1);
}

.chat-send-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.contact-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 8px;
    animation: messageIn 0.3s ease;
}

.contact-option-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    transition: var(--transition-fast);
    text-decoration: none;
}

.contact-option-card:hover {
    border-color: var(--secondary);
    transform: translateX(4px);
}

.contact-option-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: var(--white);
}

.contact-option-icon.whatsapp { background: #25d366; }
.contact-option-icon.phone { background: var(--primary); }
.contact-option-icon.email { background: var(--secondary); }

.contact-option-text h6 {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--gray-700);
    margin: 0;
}

.contact-option-text p {
    font-size: 0.8rem;
    color: var(--gray-500);
    margin: 0;
}

/* ---------- Utilities ---------- */
.text-muted { color: var(--gray-500); }
.text-white { color: var(--white); }
.text-white-50 { color: rgba(255, 255, 255, 0.5); }
.text-center { text-align: center; }
.text-primary { color: var(--primary); }

.bg-white { background: var(--white); }

.mb-0 { margin-bottom: 0; }
.mb-2 { margin-bottom: 0.5rem; }
.mb-3 { margin-bottom: 0.75rem; }
.mb-4 { margin-bottom: 1rem; }
.mb-5 { margin-bottom: 1.5rem; }

.mt-0 { margin-top: 0; }
.mt-2 { margin-top: 0.5rem; }
.mt-3 { margin-top: 0.75rem; }
.mt-4 { margin-top: 1rem; }
.mt-5 { margin-top: 1.5rem; }

.me-1 { margin-right: 0.25rem; }
.me-2 { margin-right: 0.5rem; }
.ms-1 { margin-left: 0.25rem; }
.ms-2 { margin-left: 0.5rem; }

.p-4 { padding: 1.5rem; }

.gap-2 { gap: 0.5rem; }
.gap-3 { gap: 0.75rem; }
.gap-4 { gap: 1rem; }
.gap-5 { gap: 1.5rem; }

.d-flex { display: flex; }
.flex-column { flex-direction: column; }
.align-items-center { align-items: center; }
.justify-content-center { justify-content: center; }

.h-100 { height: 100%; }

.img-fluid {
    max-width: 100%;
    height: auto;
}

.position-relative { position: relative; }

.small { font-size: 0.875rem; }

/* ---------- Grid System ---------- */
.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -12px;
}

.row > * {
    padding: 0 12px;
}

.g-3 { margin: -8px; }
.g-3 > * { padding: 8px; }

.g-4 { margin: -12px; }
.g-4 > * { padding: 12px; }

.g-5 { margin: -16px; }
.g-5 > * { padding: 16px; }

.col { flex: 1 0 0%; }
.col-6 { width: 50%; }
.col-12 { width: 100%; }

@media (min-width: 576px) {
    .col-sm-6 { width: 50%; }
}

@media (min-width: 768px) {
    .col-md-4 { width: 33.333333%; }
    .col-md-6 { width: 50%; }
}

@media (min-width: 992px) {
    .col-lg { flex: 1 0 0%; }
    .col-lg-4 { width: 33.333333%; }
    .col-lg-6 { width: 50%; }
    .col-lg-8 { width: 66.666666%; }
    .col-lg-10 { width: 83.333333%; }
}

.justify-content-center {
    justify-content: center;
}

/* ---------- Responsive ---------- */
@media (max-width: 768px) {
    .section {
        padding: 70px 0;
    }
    
    .hero {
        padding: 100px 0 60px;
    }
    
    .contact-form {
        padding: 2rem;
    }
    
    .footer {
        padding: 60px 0 30px;
    }
    
    .chat-window {
        bottom: 90px;
        right: 12px;
        left: 12px;
        width: auto;
        max-width: none;
    }
}

/* ---------- Print Styles ---------- */
@media print {
    .navbar,
    .chat-widget-button,
    .chat-window,
    .splash-screen {
        display: none !important;
    }
    
    .hero {
        min-height: auto;
        padding: 40px 0;
    }
    
    .section {
        padding: 40px 0;
    }
}
</style>
 
</head>
<body>
{{-- Add this right after opening <body> tag --}}

<!-- Splash Screen -->
<div class="splash-screen" id="splashScreen">
    <div class="splash-particles">
        <div class="splash-particle"></div>
        <div class="splash-particle"></div>
        <div class="splash-particle"></div>
        <div class="splash-particle"></div>
        <div class="splash-particle"></div>
        <div class="splash-particle"></div>
    </div>
    <div class="splash-logo">
        <span class="te">TE</span>
        <span class="q">Q</span>
        <span class="rious">RIOUS</span>
    </div>
    <p class="splash-tagline">Building Digital Excellence</p>
    <div class="splash-loader"></div>
</div>

{{-- Add this JavaScript at the end of your existing script section --}}
<script>
// Splash Screen Handler
document.addEventListener('DOMContentLoaded', function() {
    const splashScreen = document.getElementById('splashScreen');
    
    // Wait for page to fully load plus animation time
    setTimeout(function() {
        splashScreen.classList.add('exit');
        
        // Remove from DOM after animation
        setTimeout(function() {
            splashScreen.style.display = 'none';
        }, 800);
    }, 3000); // Show splash for 3 seconds
});

// Fallback: Hide splash if it somehow persists
window.addEventListener('load', function() {
    setTimeout(function() {
        const splashScreen = document.getElementById('splashScreen');
        if (splashScreen && !splashScreen.classList.contains('exit')) {
            splashScreen.classList.add('exit');
            setTimeout(function() {
                splashScreen.style.display = 'none';
            }, 800);
        }
    }, 4000);
});
</script>


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
