 
@props([
    'type' => 'Organization',
    'page' => 'home'
])

@php
    $siteName = $settings['general']->firstWhere('key', 'site_name')->value ?? 'TEQRIOUS';
    $siteDescription = $settings['general']->firstWhere('key', 'meta_description')->value ?? 'Building Digital Excellence';
    $email = $settings['contact']->firstWhere('key', 'email')->value ?? '';
    $phone = $settings['contact']->firstWhere('key', 'phone')->value ?? '';
    $address = $settings['contact']->firstWhere('key', 'address')->value ?? '';
    
    $socialLinks = [];
    if($fb = $settings['social']->firstWhere('key', 'facebook')) $socialLinks[] = $fb->value;
    if($ig = $settings['social']->firstWhere('key', 'instagram')) $socialLinks[] = $ig->value;
    if($li = $settings['social']->firstWhere('key', 'linkedin')) $socialLinks[] = $li->value;
    if($tw = $settings['social']->firstWhere('key', 'twitter')) $socialLinks[] = $tw->value;
@endphp

{{-- Organization Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "{{ $siteName }}",
    "description": "{{ $siteDescription }}",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('img/logo.png') }}",
    "image": "{{ asset('img/og-image.png') }}",
    "email": "{{ $email }}",
    "telephone": "{{ $phone }}",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Male",
        "addressCountry": "MV",
        "streetAddress": "{{ $address }}"
    },
    "sameAs": {!! json_encode(array_filter($socialLinks)) !!},
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ $phone }}",
        "contactType": "customer service",
        "email": "{{ $email }}",
        "availableLanguage": ["English", "Dhivehi"]
    }
}
</script>

{{-- Website Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "{{ $siteName }}",
    "url": "{{ url('/') }}",
    "description": "{{ $siteDescription }}",
    "publisher": {
        "@type": "Organization",
        "name": "{{ $siteName }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('img/logo.png') }}"
        }
    },
    "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ url('/') }}?search={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>

@if($page === 'home')
{{-- Local Business Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "name": "{{ $siteName }}",
    "description": "{{ $siteDescription }}",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('img/logo.png') }}",
    "image": "{{ asset('img/og-image.png') }}",
    "telephone": "{{ $phone }}",
    "email": "{{ $email }}",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Male",
        "addressRegion": "Kaafu Atoll",
        "addressCountry": "MV"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "4.1755",
        "longitude": "73.5093"
    },
    "priceRange": "$$",
    "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday"],
        "opens": "08:00",
        "closes": "17:00"
    },
    "serviceArea": {
        "@type": "Country",
        "name": "Maldives"
    },
    "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "IT Services",
        "itemListElement": [
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "Web Development"
                }
            },
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "Mobile App Development"
                }
            },
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "IT Consulting"
                }
            }
        ]
    }
}
</script>

{{-- BreadcrumbList for Home --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') }}"
    }]
}
</script>
@endif