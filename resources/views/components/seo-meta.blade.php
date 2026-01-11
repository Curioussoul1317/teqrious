 
@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'type' => 'website',
    'article' => null
])

@php
    $siteName = $settings['general']->firstWhere('key', 'site_name')->value ?? 'TEQRIOUS';
    $siteDescription = $settings['general']->firstWhere('key', 'meta_description')->value ?? 'Building Digital Excellence';
    $siteKeywords = $settings['seo']->firstWhere('key', 'meta_keywords')->value ?? 'IT solutions, software development';
    
    $metaTitle = $title ? $title . ' | ' . $siteName : $siteName . ' - Building Digital Excellence';
    $metaDescription = $description ?? $siteDescription;
    $metaKeywords = $keywords ?? $siteKeywords;
    $metaImage = $image ?? asset('img/og-image.png');
    $metaUrl = url()->current();
@endphp

{{-- Primary Meta Tags --}}
<title>{{ $metaTitle }}</title>
<meta name="title" content="{{ $metaTitle }}">
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="author" content="{{ $siteName }}">
<meta name="robots" content="index, follow">
<meta name="language" content="English">
<meta name="revisit-after" content="7 days">

{{-- Canonical URL --}}
<link rel="canonical" href="{{ $metaUrl }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $metaUrl }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="en_US">

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $metaUrl }}">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $metaImage }}">

{{-- Article specific (for blog posts) --}}
@if($type === 'article' && $article)
<meta property="article:published_time" content="{{ $article->created_at->toIso8601String() }}">
<meta property="article:modified_time" content="{{ $article->updated_at->toIso8601String() }}">
<meta property="article:author" content="{{ $siteName }}">
@endif

{{-- Additional SEO --}}
<meta name="format-detection" content="telephone=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">