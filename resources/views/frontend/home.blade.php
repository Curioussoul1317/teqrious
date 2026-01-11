<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- SEO Meta Tags --}}
    @php
        $siteName = $settings['general']->firstWhere('key', 'site_name')->value ?? 'TEQRIOUS';
        $siteTagline = $settings['general']->firstWhere('key', 'site_tagline')->value ?? 'Building Digital Excellence';
        $metaDesc = $settings['seo']->firstWhere('key', 'meta_description')->value ?? 'TEQRIOUS - Professional IT solutions, web development, mobile apps, and digital transformation services in Maldives.';
        $metaKeywords = $settings['seo']->firstWhere('key', 'meta_keywords')->value ?? 'IT solutions, web development, mobile apps, software development, Maldives, Male';
        $email = $settings['contact']->firstWhere('key', 'email')->value ?? '';
        $phone = $settings['contact']->firstWhere('key', 'phone')->value ?? '';
        $address = $settings['contact']->firstWhere('key', 'address')->value ?? '';
        $whatsapp = $settings['contact']->firstWhere('key', 'whatsapp')->value ?? null;
    @endphp
    
    {{-- Primary Meta Tags --}}
    <title>{{ $siteName }} - {{ $siteTagline }}</title>
    <meta name="title" content="{{ $siteName }} - {{ $siteTagline }}">
    <meta name="description" content="{{ $metaDesc }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#001348">
    
    {{-- Canonical --}}
    <link rel="canonical" href="{{ url('/') }}">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $siteName }} - {{ $siteTagline }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:image" content="{{ asset('img/og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $siteName }}">
    
    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $siteName }} - {{ $siteTagline }}">
    <meta name="twitter:description" content="{{ $metaDesc }}">
    <meta name="twitter:image" content="{{ asset('img/og-image.png') }}">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="/img/favicon.svg">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    
    {{-- Preconnect --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #001348;
            --secondary: #aa134a;
            --third: #cb9430;
            --light-bg: #f8f9fa;
            --transition-fast: 0.2s ease;
            --transition-normal: 0.3s ease;
            --transition-slow: 0.5s ease;
        }
        
        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }
        
        body {
            overflow-x: hidden;
        }
        
        /* ==================== ANIMATIONS ==================== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-8px); }
            60% { transform: translateY(-4px); }
        }
        
        .animate-fadeInUp { animation: fadeInUp 0.6s ease forwards; }
        .animate-fadeInLeft { animation: fadeInLeft 0.6s ease forwards; }
        .animate-fadeInRight { animation: fadeInRight 0.6s ease forwards; }
        
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        
        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* ==================== NAVBAR ==================== */
        .navbar {
            background: transparent;
            padding: 1rem 0;
            transition: all var(--transition-normal);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        
        .navbar.scrolled {
            background: var(--primary);
            box-shadow: 0 2px 20px rgba(0,0,0,0.2);
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
            color: #fff !important;
            font-weight: 800;
            font-size: 1.75rem;
            transition: transform var(--transition-fast);
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .navbar-brand span {
            color: var(--third);
        }
        
        .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            position: relative;
            transition: color var(--transition-fast);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--third);
            transition: all var(--transition-normal);
            transform: translateX(-50%);
        }
        
        .nav-link:hover {
            color: var(--third) !important;
        }
        
        .nav-link:hover::after {
            width: 80%;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* ==================== HERO ==================== */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary) 0%, #002266 50%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            color: #fff;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease;
        }
        
        .hero .lead {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease 0.2s forwards;
            opacity: 0;
        }
        
        .btn-cta {
            background: var(--third);
            color: #fff;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all var(--transition-normal);
            border: 2px solid var(--third);
            animation: fadeInUp 0.8s ease 0.4s forwards;
            opacity: 0;
        }
        
        .btn-cta:hover {
            background: transparent;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(203, 148, 48, 0.3);
        }
        
        .btn-cta i {
            transition: transform var(--transition-fast);
        }
        
        .btn-cta:hover i {
            transform: translateX(5px);
        }
        
        .hero-shapes {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 50%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .hero-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }
        
        .hero-shape-1 {
            width: 400px;
            height: 400px;
            background: var(--third);
            top: 10%;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero-shape-2 {
            width: 200px;
            height: 200px;
            background: #fff;
            bottom: 20%;
            right: 20%;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        /* ==================== SECTIONS ==================== */
        .section {
            padding: 100px 0;
            position: relative;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 1rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--third), var(--secondary));
            margin-top: 15px;
            border-radius: 2px;
        }
        
        .section-title.text-center::after {
            margin-left: auto;
            margin-right: auto;
        }
        
        .section-subtitle {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 50px;
        }
        
        /* ==================== CARDS ==================== */
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all var(--transition-normal);
            overflow: hidden;
            background: #fff;
        }
        
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }
        
        .card-custom .card-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            transition: all var(--transition-normal);
        }
        
        .card-custom:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .card-icon-primary {
            background: linear-gradient(135deg, rgba(0,19,72,0.1), rgba(0,19,72,0.05));
            color: var(--primary);
        }
        
        .card-icon-secondary {
            background: linear-gradient(135deg, rgba(170,19,74,0.1), rgba(170,19,74,0.05));
            color: var(--secondary);
        }
        
        .card-icon-third {
            background: linear-gradient(135deg, rgba(203,148,48,0.1), rgba(203,148,48,0.05));
            color: var(--third);
        }
        
        .card-custom h5 {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }
        
        .card-custom p {
            color: #666;
            line-height: 1.7;
        }
        
        /* Project Cards */
        .project-card {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }
        
        .project-card img {
            transition: transform var(--transition-slow);
        }
        
        .project-card:hover img {
            transform: scale(1.1);
        }
        
        .project-card .card-body {
            position: relative;
            background: #fff;
        }
        
        .project-card .badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
        }
        
        /* Subsidiary Cards */
        .subsidiary-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all var(--transition-normal);
        }
        
        .subsidiary-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }
        
        .subsidiary-card img {
            height: 60px;
            object-fit: contain;
            margin-bottom: 1rem;
            transition: transform var(--transition-normal);
        }
        
        .subsidiary-card:hover img {
            transform: scale(1.1);
        }
        
        .subsidiary-card .btn {
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 600;
            transition: all var(--transition-normal);
        }
        
        /* ==================== ABOUT SECTION ==================== */
        .about-image {
            position: relative;
        }
        
        .about-image img {
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }
        
        .about-image::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: 20px;
            bottom: 20px;
            border: 3px solid var(--third);
            border-radius: 20px;
            z-index: -1;
        }
        
        /* ==================== SUBSIDIARIES SECTION ==================== */
        .subsidiaries-section {
            background: linear-gradient(135deg, var(--primary) 0%, #002266 100%);
            position: relative;
            overflow: hidden;
        }
        
        .subsidiaries-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        /* ==================== CONTACT SECTION ==================== */
        .contact-form {
            background: #fff;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }
        
        .contact-form .form-control {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1rem;
            transition: all var(--transition-fast);
        }
        
        .contact-form .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0,19,72,0.1);
        }
        
        .contact-form .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 16px 40px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all var(--transition-normal);
            width: 100%;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,19,72,0.3);
            color: #fff;
        }
        
        /* ==================== FOOTER ==================== */
        .footer {
            background: var(--primary);
            color: #fff;
            padding: 80px 0 30px;
            position: relative;
        }
        
        .footer-brand {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }
        
        .footer-brand span {
            color: var(--third);
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all var(--transition-fast);
            display: inline-block;
        }
        
        .footer-links a:hover {
            color: var(--third);
            transform: translateX(5px);
        }
        
        .social-links a {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
            margin-right: 10px;
            transition: all var(--transition-normal);
        }
        
        .social-links a:hover {
            background: var(--third);
            transform: translateY(-5px);
        }
        
        /* ==================== CHAT WIDGET ==================== */
        .chat-widget-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: linear-gradient(135deg, #25d366, #128c7e);
            border: none;
            color: #fff;
            font-size: 1.75rem;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(37,211,102,0.4);
            transition: all var(--transition-normal);
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chat-widget-button:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(37,211,102,0.5);
        }
        
        .chat-widget-button.active {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            box-shadow: 0 8px 25px rgba(170,19,74,0.4);
        }
        
        .chat-widget-button .chat-icon-open,
        .chat-widget-button .chat-icon-close {
            position: absolute;
            transition: all var(--transition-normal);
        }
        
        .chat-widget-button .chat-icon-close {
            opacity: 0;
            transform: rotate(-90deg) scale(0.5);
        }
        
        .chat-widget-button.active .chat-icon-open {
            opacity: 0;
            transform: rotate(90deg) scale(0.5);
        }
        
        .chat-widget-button.active .chat-icon-close {
            opacity: 1;
            transform: rotate(0) scale(1);
        }
        
        .chat-notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 24px;
            height: 24px;
            background: var(--secondary);
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounce 2s infinite;
        }
        
        /* Chat Window */
        .chat-window {
            position: fixed;
            bottom: 110px;
            right: 30px;
            width: 380px;
            max-width: calc(100vw - 40px);
            height: 520px;
            max-height: calc(100vh - 150px);
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.95);
            transition: all var(--transition-normal);
        }
        
        .chat-window.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }
        
        /* Chat Header */
        .chat-header {
            background: linear-gradient(135deg, var(--primary), #002266);
            color: #fff;
            padding: 20px;
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
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        
        .chat-header-text h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
        }
        
        .chat-header-text p {
            margin: 0;
            font-size: 0.8rem;
            opacity: 0.8;
        }
        
        .chat-header-text p::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #25d366;
            border-radius: 50%;
            margin-right: 6px;
            animation: pulse 2s infinite;
        }
        
        .chat-close-btn {
            background: rgba(255,255,255,0.1);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            cursor: pointer;
            transition: all var(--transition-fast);
        }
        
        .chat-close-btn:hover {
            background: rgba(255,255,255,0.2);
        }
        
        /* Chat Body */
        .chat-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f8f9fa;
        }
        
        .chat-message {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
            animation: fadeInUp 0.3s ease;
        }
        
        .chat-message.user {
            flex-direction: row-reverse;
        }
        
        .chat-message-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .chat-message.bot .chat-message-avatar {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
        }
        
        .chat-message.user .chat-message-avatar {
            background: var(--third);
            color: #fff;
        }
        
        .chat-message-bubble {
            background: #fff;
            padding: 14px 18px;
            border-radius: 16px;
            max-width: 75%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            line-height: 1.5;
        }
        
        .chat-message.user .chat-message-bubble {
            background: linear-gradient(135deg, var(--primary), #002266);
            color: #fff;
            border-bottom-right-radius: 4px;
        }
        
        .chat-message.bot .chat-message-bubble {
            border-bottom-left-radius: 4px;
        }
        
        /* Contact Options in Chat */
        .contact-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
            animation: fadeInUp 0.3s ease;
        }
        
        .contact-option-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            background: #fff;
            border-radius: 14px;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all var(--transition-fast);
        }
        
        .contact-option-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .contact-option-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        
        .contact-option-icon.whatsapp {
            background: rgba(37,211,102,0.15);
            color: #25d366;
        }
        
        .contact-option-icon.phone {
            background: rgba(0,19,72,0.1);
            color: var(--primary);
        }
        
        .contact-option-icon.email {
            background: rgba(203,148,48,0.15);
            color: var(--third);
        }
        
        .contact-option-text h6 {
            margin: 0;
            font-weight: 600;
            color: var(--primary);
        }
        
        .contact-option-text p {
            margin: 0;
            font-size: 0.85rem;
            color: #666;
        }
        
        /* Quick Options */
        .chat-quick-options {
            padding: 15px 20px;
            background: #fff;
            border-top: 1px solid #eee;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .quick-option-btn {
            background: #f0f2f5;
            border: none;
            padding: 10px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--primary);
            cursor: pointer;
            transition: all var(--transition-fast);
        }
        
        .quick-option-btn:hover {
            background: var(--primary);
            color: #fff;
        }
        
        /* Chat Footer */
        .chat-footer {
            padding: 15px 20px;
            background: #fff;
            border-top: 1px solid #eee;
        }
        
        .chat-input-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .chat-input {
            flex: 1;
            border: 2px solid #eee;
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 0.95rem;
            outline: none;
            transition: all var(--transition-fast);
        }
        
        .chat-input:focus {
            border-color: var(--primary);
        }
        
        .chat-send-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chat-send-btn:hover {
            transform: scale(1.1);
        }
        
        .chat-send-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        /* Typing Indicator */
        .typing-indicator {
            display: flex;
            gap: 4px;
            padding: 14px 18px;
            background: #fff;
            border-radius: 16px;
            border-bottom-left-radius: 4px;
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            background: #999;
            border-radius: 50%;
            animation: typingBounce 1.4s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(1) { animation-delay: 0s; }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes typingBounce {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-6px); }
        }
        
        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 991.98px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .section {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .navbar-collapse {
                background: var(--primary);
                padding: 20px;
                border-radius: 15px;
                margin-top: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            }
            
            .about-image::before {
                display: none;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero {
                min-height: auto;
                padding: 120px 0 80px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero .lead {
                font-size: 1rem;
            }
            
            .btn-cta {
                padding: 14px 30px;
                font-size: 0.95rem;
            }
            
            .section {
                padding: 50px 0;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
            
            .contact-form {
                padding: 1.5rem;
            }
            
            .chat-window {
                bottom: 0;
                right: 0;
                left: 0;
                width: 100%;
                max-width: 100%;
                height: calc(100vh - 80px);
                max-height: none;
                border-radius: 20px 20px 0 0;
            }
            
            .chat-widget-button {
                bottom: 20px;
                right: 20px;
                width: 60px;
                height: 60px;
            }
            
            .hero-shapes {
                display: none;
            }
        }
        
        @media (max-width: 575.98px) {
            .card-custom {
                border-radius: 15px;
            }
            
            .footer {
                padding: 50px 0 20px;
            }
        }
        
        /* ==================== UTILITIES ==================== */
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary), #002266);
        }
        
        .text-primary-custom { color: var(--primary) !important; }
        .text-secondary-custom { color: var(--secondary) !important; }
        .text-third { color: var(--third) !important; }
    </style>
    
    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ $siteName }}",
        "description": "{{ $metaDesc }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('img/logo.png') }}",
        "email": "{{ $email }}",
        "telephone": "{{ $phone }}",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Male",
            "addressCountry": "MV"
        }
    }
    </script>
</head>
<body>
    {{-- Navigation --}}
    <nav class="navbar navbar-expand-lg" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="/">TEQ<span>RIOUS</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

    {{-- Hero Section --}}
    <header class="hero">
        <div class="hero-shapes">
            <div class="hero-shape hero-shape-1"></div>
            <div class="hero-shape hero-shape-2"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-content">
                        @forelse($heroSlides as $index => $slide)
                            @if($index === 0)
                                <h1>{{ $slide->title }}</h1>
                                @if($slide->description)
                                    <p class="lead">{{ $slide->description }}</p>
                                @endif
                                @if($slide->button_text)
                                    <a href="{{ $slide->button_link ?? '#contact' }}" class="btn-cta">
                                        {{ $slide->button_text }}
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                @endif
                            @endif
                        @empty
                            <h1>Building Digital<br>Excellence</h1>
                            <p class="lead">Transform your business with cutting-edge IT solutions, innovative software development, and digital transformation services.</p>
                            <a href="#contact" class="btn-cta">
                                Get Started
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        {{-- Highlight Cards --}}
        @if($highlightCards->count() > 0)
        <section class="section bg-white">
            <div class="container">
                <div class="row g-4">
                    @foreach($highlightCards as $index => $card)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-custom p-4 h-100 reveal" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="card-icon card-icon-{{ ['primary', 'secondary', 'third'][$index % 3] }}">
                                <i class="{{ $card->icon ?? 'bi bi-star' }}"></i>
                            </div>
                            <h5>{{ $card->title }}</h5>
                            <p class="mb-0">{{ $card->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- About Section --}}
        <section id="about" class="section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 reveal">
                        <h2 class="section-title">Who We Are</h2>
                        @if($about)
                            <div class="content-text">{!! $about->content !!}</div>
                        @else
                            <p class="text-muted">We are a team of passionate technologists dedicated to delivering innovative IT solutions that drive business growth and digital transformation.</p>
                        @endif
                    </div>
                    @if($about && $about->image)
                    <div class="col-lg-6 reveal">
                        <div class="about-image">
                            <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid" alt="About {{ $siteName }}" loading="lazy">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- Services Section --}}
        @if($services->count() > 0)
        <section id="services" class="section" style="background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <h2 class="section-title text-center">Our Services</h2>
                    <p class="section-subtitle">Comprehensive IT solutions tailored to your needs</p>
                </div>
                <div class="row g-4">
                    @foreach($services as $index => $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-custom p-4 h-100 reveal" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="card-icon card-icon-secondary">
                                <i class="{{ $service->icon ?? 'bi bi-gear' }}"></i>
                            </div>
                            <h5>{{ $service->title }}</h5>
                            <p class="mb-0">{{ $service->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Projects Section --}}
        @if($projects->count() > 0)
        <section id="projects" class="section bg-white">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <h2 class="section-title text-center">Our Work</h2>
                    <p class="section-subtitle">Featured projects that showcase our expertise</p>
                </div>
                <div class="row g-4">
                    @foreach($projects->take(6) as $index => $project)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-custom project-card h-100 reveal" style="animation-delay: {{ $index * 0.1 }}s">
                            @if($project->image)
                            <div style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $project->title }}" loading="lazy">
                            </div>
                            @endif
                            <div class="card-body p-4">
                                @if($project->client_type)
                                    <span class="badge mb-2">{{ ucfirst($project->client_type) }}</span>
                                @endif
                                <h5>{{ $project->title }}</h5>
                                @if($project->outcome)
                                    <p class="text-muted small mb-0">{{ Str::limit($project->outcome, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Subsidiaries Section --}}
        @if($subsidiaries->count() > 0)
        <section class="section subsidiaries-section">
            <div class="container position-relative">
                <div class="text-center mb-5 reveal">
                    <h2 class="section-title text-center text-white">Our Subsidiaries</h2>
                    <p class="section-subtitle text-white-50">Specialized solutions through our subsidiary brands</p>
                </div>
                <div class="row g-4">
                    @foreach($subsidiaries as $index => $subsidiary)
                    <div class="col-md-6 col-lg-4">
                        <div class="subsidiary-card reveal" style="animation-delay: {{ $index * 0.1 }}s">
                            @if($subsidiary->logo)
                            <img src="{{ asset('storage/' . $subsidiary->logo) }}" alt="{{ $subsidiary->name }}" loading="lazy">
                            @else
                            <div class="mb-3">
                                <i class="bi bi-building fs-1 text-primary"></i>
                            </div>
                            @endif
                            <h5 class="text-primary">{{ $subsidiary->name }}</h5>
                            @if($subsidiary->tagline)
                                <p class="text-muted small mb-3">{{ $subsidiary->tagline }}</p>
                            @endif
                            <a href="{{ route('subsidiary.show', $subsidiary->slug) }}" class="btn btn-outline-primary">
                                Explore <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Contact Section --}}
        <section id="contact" class="section" style="background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5 reveal">
                            <h2 class="section-title text-center">Get In Touch</h2>
                            <p class="section-subtitle">Ready to start your project? Contact us today!</p>
                        </div>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        
                        <div class="contact-form reveal">
                            <form action="{{ route('contact.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" required placeholder="John Doe">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="john@example.com">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+960 XXXXXXX">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="company" name="company" placeholder="Your Company">
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Tell us about your project..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn-submit">
                                            <i class="bi bi-send me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-brand">TEQ<span>RIOUS</span></div>
                    <p class="text-white-50 mb-4">{{ $siteTagline }}</p>
                    <div class="social-links">
                        @if($fb = $settings['social']->firstWhere('key', 'facebook'))
                            <a href="{{ $fb->value }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if($ig = $settings['social']->firstWhere('key', 'instagram'))
                            <a href="{{ $ig->value }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if($li = $settings['social']->firstWhere('key', 'linkedin'))
                            <a href="{{ $li->value }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        @endif
                        @if($tw = $settings['social']->firstWhere('key', 'twitter'))
                            <a href="{{ $tw->value }}" target="_blank" rel="noopener" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <div class="footer-links d-flex flex-column gap-2">
                        <a href="#about"><i class="bi bi-chevron-right me-2"></i>About Us</a>
                        <a href="#services"><i class="bi bi-chevron-right me-2"></i>Services</a>
                        <a href="#projects"><i class="bi bi-chevron-right me-2"></i>Projects</a>
                        <a href="#contact"><i class="bi bi-chevron-right me-2"></i>Contact</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-4">Contact Info</h5>
                    <div class="footer-links d-flex flex-column gap-3">
                        @if($address)
                        <div class="d-flex gap-3">
                            <i class="bi bi-geo-alt text-third"></i>
                            <span class="text-white-50">{{ $address }}</span>
                        </div>
                        @endif
                        @if($email)
                        <div class="d-flex gap-3">
                            <i class="bi bi-envelope text-third"></i>
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </div>
                        @endif
                        @if($phone)
                        <div class="d-flex gap-3">
                            <i class="bi bi-telephone text-third"></i>
                            <a href="tel:{{ $phone }}">{{ $phone }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-5">
            <div class="text-center">
                <p class="text-white-50 mb-0">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Chat Widget Button --}}
    @if($whatsapp)
    <button class="chat-widget-button" id="chatWidgetBtn" aria-label="Open chat">
        <i class="bi bi-chat-dots-fill chat-icon-open"></i>
        <i class="bi bi-x-lg chat-icon-close"></i>
        <span class="chat-notification-badge" id="chatNotificationBadge" style="display: none;">1</span>
    </button>

    {{-- Chat Window --}}
    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-header-avatar">
                    <i class="bi bi-building"></i>
                </div>
                <div class="chat-header-text">
                    <h5>{{ $siteName }} Support</h5>
                    <p>Typically replies instantly</p>
                </div>
            </div>
            <button class="chat-close-btn" id="chatCloseBtn" aria-label="Close chat">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="chat-body" id="chatBody">
            {{-- Welcome Message --}}
            <div class="chat-message bot">
                <div class="chat-message-avatar">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <div class="chat-message-bubble">
                        Hi! 👋 Welcome to {{ $siteName }}. How can we help you today?
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Quick Options --}}
        <div class="chat-quick-options" id="quickOptions">
            <button class="quick-option-btn" data-message="I need IT consulting">
                💼 IT Consulting
            </button>
            <button class="quick-option-btn" data-message="Web development inquiry">
                🌐 Web Development
            </button>
            <button class="quick-option-btn" data-message="Get a quote">
                💰 Get a Quote
            </button>
            <button class="quick-option-btn" data-message="Contact support">
                📞 Contact Support
            </button>
        </div>
        
        <div class="chat-footer">
            <div class="chat-input-wrapper">
                <input type="text" class="chat-input" id="chatInput" placeholder="Type your message..." autocomplete="off">
                <button class="chat-send-btn" id="chatSendBtn" disabled aria-label="Send message">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Main Scripts --}}
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('mainNavbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Scroll reveal animation
        const revealElements = document.querySelectorAll('.reveal');
        const revealOnScroll = () => {
            const windowHeight = window.innerHeight;
            revealElements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const revealPoint = 150;
                if (elementTop < windowHeight - revealPoint) {
                    el.classList.add('active');
                }
            });
        };
        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        bootstrap.Collapse.getInstance(navbarCollapse).hide();
                    }
                }
            });
        });
    </script>
    
    {{-- Chat Widget Script - Only if WhatsApp is configured --}}
    @if($whatsapp)
    <script>
        // Chat Widget
        const chatWidgetBtn = document.getElementById('chatWidgetBtn');
        const chatWindow = document.getElementById('chatWindow');
        const chatCloseBtn = document.getElementById('chatCloseBtn');
        const chatBody = document.getElementById('chatBody');
        const chatInput = document.getElementById('chatInput');
        const chatSendBtn = document.getElementById('chatSendBtn');
        const quickOptions = document.querySelectorAll('.quick-option-btn');
        const notificationBadge = document.getElementById('chatNotificationBadge');
        
        // Contact info from PHP
        const contactInfo = {
            whatsapp: '{{ preg_replace("/[^0-9]/", "", $whatsapp) }}',
            phone: '{{ $phone ?? "" }}',
            email: '{{ $email ?? "" }}'
        };
        
        // Toggle chat window
        chatWidgetBtn.addEventListener('click', function() {
            chatWindow.classList.toggle('show');
            this.classList.toggle('active');
            if (chatWindow.classList.contains('show')) {
                chatInput.focus();
                notificationBadge.style.display = 'none';
            }
        });
        
        chatCloseBtn.addEventListener('click', function() {
            chatWindow.classList.remove('show');
            chatWidgetBtn.classList.remove('active');
        });
        
        // Send message
        function sendMessage(message) {
            if (!message.trim()) return;
            
            addMessage(message, 'user');
            chatInput.value = '';
            chatSendBtn.disabled = true;
            scrollToBottom();
            
            showTypingIndicator();
            
            setTimeout(() => {
                hideTypingIndicator();
                handleBotResponse(message);
            }, 1500);
        }
        
        // Add message to chat
        function addMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'chat-message ' + sender;
            
            const avatar = document.createElement('div');
            avatar.className = 'chat-message-avatar';
            avatar.innerHTML = sender === 'bot' ? '<i class="bi bi-building"></i>' : '<i class="bi bi-person-fill"></i>';
            
            const bubbleContainer = document.createElement('div');
            const bubble = document.createElement('div');
            bubble.className = 'chat-message-bubble';
            bubble.textContent = text;
            bubbleContainer.appendChild(bubble);
            
            if (sender === 'bot') {
                messageDiv.appendChild(avatar);
            }
            messageDiv.appendChild(bubbleContainer);
            if (sender === 'user') {
                messageDiv.appendChild(avatar);
            }
            
            chatBody.appendChild(messageDiv);
            scrollToBottom();
        }
        
        // Handle bot response
        function handleBotResponse(userMessage) {
            const lowerMessage = userMessage.toLowerCase();
            
            if (lowerMessage.includes('quote') || lowerMessage.includes('price') || lowerMessage.includes('cost')) {
                addMessage("I'd be happy to help you get a quote! Please reach out to us through one of these channels:", 'bot');
                addContactOptions();
            } else if (lowerMessage.includes('service') || lowerMessage.includes('consulting') || lowerMessage.includes('development')) {
                addMessage("We offer a range of IT services including web development, mobile apps, and IT consulting. Would you like to discuss your specific needs?", 'bot');
                addContactOptions();
            } else if (lowerMessage.includes('contact') || lowerMessage.includes('support') || lowerMessage.includes('help')) {
                addMessage("Here are the best ways to reach our team:", 'bot');
                addContactOptions();
            } else {
                addMessage("Thanks for reaching out! For the quickest response, please contact us through one of these channels:", 'bot');
                addContactOptions();
            }
        }
        
        // Add contact options
        function addContactOptions() {
            const optionsDiv = document.createElement('div');
            optionsDiv.className = 'contact-options';
            
            let contactHtml = '<a href="https://wa.me/' + contactInfo.whatsapp + '?text=Hello%2C%20I%20would%20like%20to%20inquire%20about%20your%20services" target="_blank" rel="noopener" class="contact-option-card">' +
                '<div class="contact-option-icon whatsapp"><i class="bi bi-whatsapp"></i></div>' +
                '<div class="contact-option-text">' +
                '<h6>WhatsApp</h6>' +
                '<p>Chat with us instantly</p>' +
                '</div></a>';
            
            if (contactInfo.phone) {
                contactHtml += '<a href="tel:' + contactInfo.phone + '" class="contact-option-card">' +
                    '<div class="contact-option-icon phone"><i class="bi bi-telephone-fill"></i></div>' +
                    '<div class="contact-option-text">' +
                    '<h6>Call Us</h6>' +
                    '<p>' + contactInfo.phone + '</p>' +
                    '</div></a>';
            }
            
            if (contactInfo.email) {
                contactHtml += '<a href="mailto:' + contactInfo.email + '" class="contact-option-card">' +
                    '<div class="contact-option-icon email"><i class="bi bi-envelope-fill"></i></div>' +
                    '<div class="contact-option-text">' +
                    '<h6>Email</h6>' +
                    '<p>' + contactInfo.email + '</p>' +
                    '</div></a>';
            }
            
            optionsDiv.innerHTML = contactHtml;
            chatBody.appendChild(optionsDiv);
            scrollToBottom();
        }
        
        // Typing indicator
        function showTypingIndicator() {
            const indicator = document.createElement('div');
            indicator.className = 'chat-message bot';
            indicator.id = 'typingIndicator';
            indicator.innerHTML = '<div class="chat-message-avatar"><i class="bi bi-building"></i></div>' +
                '<div class="typing-indicator">' +
                '<div class="typing-dot"></div>' +
                '<div class="typing-dot"></div>' +
                '<div class="typing-dot"></div>' +
                '</div>';
            chatBody.appendChild(indicator);
            scrollToBottom();
        }
        
        function hideTypingIndicator() {
            const indicator = document.getElementById('typingIndicator');
            if (indicator) indicator.remove();
        }
        
        function scrollToBottom() {
            chatBody.scrollTop = chatBody.scrollHeight;
        }
        
        // Event listeners
        chatSendBtn.addEventListener('click', function() { sendMessage(chatInput.value); });
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage(chatInput.value);
        });
        chatInput.addEventListener('input', function() {
            chatSendBtn.disabled = !this.value.trim();
        });
        
        quickOptions.forEach(function(btn) {
            btn.addEventListener('click', function() {
                sendMessage(this.getAttribute('data-message'));
            });
        });
        
        // Show notification after delay
        setTimeout(function() {
            if (!chatWindow.classList.contains('show')) {
                notificationBadge.style.display = 'flex';
            }
        }, 5000);
    </script>
    @endif
</body>
</html>