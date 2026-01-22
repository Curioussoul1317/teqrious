<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Models
use App\Models\SiteSetting;
use App\Models\HeroSlide;
use App\Models\AboutContent;
use App\Models\HighlightCard;
use App\Models\Expertise;
use App\Models\Service;
use App\Models\ServiceTile;
use App\Models\FeaturedWork;
use App\Models\WorkStep;

class WebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SITE SETTINGS (HIGH-END SEO + BRAND)
        |--------------------------------------------------------------------------
        */
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'TEQRIOUS', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Reliable Digital Systems. Built for Growth.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'group' => 'general'],
            ['key' => 'favicon', 'value' => null, 'type' => 'image', 'group' => 'general'],

            // Contact
            ['key' => 'email', 'value' => 'info@teqrious.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+960 9654994', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'whatsapp', 'value' => '+9609654994', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'Malé, Maldives', 'type' => 'textarea', 'group' => 'contact'],

            // Social
            ['key' => 'facebook', 'value' => 'https://facebook.com/teqrious', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/teqrious', 'type' => 'text', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/teqrious', 'type' => 'text', 'group' => 'social'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/teqrious', 'type' => 'text', 'group' => 'social'],

            // SEO (BROAD + TRUSTED)
            [
                'key' => 'meta_description',
                'value' => 'TEQRIOUS is a premium IT solutions company delivering reliable software development, web & mobile apps, cybersecurity, cloud & DevOps, networking, IT consulting, ERP/CRM integrations, managed services, and long-term support. We build secure, scalable, performance-driven digital systems for organizations across all industries.',
                'type' => 'textarea',
                'group' => 'seo'
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'TEQRIOUS, IT solutions, IT company, IT services, software development, custom software, web development, website development, ecommerce website, web application, mobile app development, Android app, iOS app, Flutter app, UI UX design, API development, system integration, ERP, CRM, Odoo, Odoo customization, LMS, school management system, HRMS, inventory system, POS system, hospital management system, pharmacy system, clinic system, cybersecurity, penetration testing, vulnerability assessment, server hardening, cloud services, AWS, Azure, DevOps, Docker, Linux server, managed hosting, IT consulting, IT support, networking, CCTV, Maldives, software development Maldives, IT solutions Maldives',
                'type' => 'text',
                'group' => 'seo'
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        /*
        |--------------------------------------------------------------------------
        | HERO SLIDES
        |--------------------------------------------------------------------------
        */
        $slides = [
            [
                'order' => 1,
                'title' => 'Enterprise-Grade IT Solutions You Can Trust',
                'description' => 'We design, build, and secure digital systems that scale with your business — structured, documented, and built to last.',
                'button_text' => 'Start a Conversation',
                'button_link' => '/contact',
                'background_image' => 'hero/hero-1.jpg',
                'is_active' => true,
            ],
            [
                'order' => 2,
                'title' => 'Technology That Works Today — And Tomorrow',
                'description' => 'From startups to enterprises, we deliver systems that remain stable through growth, upgrades, and change.',
                'button_text' => 'Our Services',
                'button_link' => '/services',
                'background_image' => 'hero/hero-2.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::updateOrCreate(['order' => $slide['order']], $slide);
        }

        /*
        |--------------------------------------------------------------------------
        | ABOUT CONTENT
        |--------------------------------------------------------------------------
        */
        $about = [
            [
                'title' => 'Your Long-Term Technology Partner',
                'content' => 'TEQRIOUS builds reliable, secure, and scalable digital systems for organizations across all industries. Our focus is not just delivery — but ownership, continuity, and long-term stability. We believe technology should empower your organization, not lock you into dependency.',
                'image' => 'about/about-1.jpg',
            ],
            [
                'title' => 'Built with Structure, Security, and Clarity',
                'content' => 'Every system we build follows a clear process: proper architecture, secure coding, documentation, and future-ready design. This ensures your platform remains maintainable even as teams, vendors, and technologies evolve.',
                'image' => 'about/about-2.jpg',
            ],
        ];

        foreach ($about as $item) {
            AboutContent::updateOrCreate(['title' => $item['title']], $item);
        }

        /*
        |--------------------------------------------------------------------------
        | HIGHLIGHT CARDS
        |--------------------------------------------------------------------------
        */
        $highlights = [
            ['order' => 1, 'title' => 'Trusted Architecture', 'description' => 'Systems designed for reliability, security, and scale.', 'icon' => 'shield', 'icon_type' => 'lucide', 'is_active' => true],
            ['order' => 2, 'title' => 'Security First', 'description' => 'Security is built-in, not added later.', 'icon' => 'lock', 'icon_type' => 'lucide', 'is_active' => true],
            ['order' => 3, 'title' => 'Clear Ownership', 'description' => 'Documented systems with full handover and transparency.', 'icon' => 'file-text', 'icon_type' => 'lucide', 'is_active' => true],
            ['order' => 4, 'title' => 'Professional Delivery', 'description' => 'Structured milestones, predictable outcomes.', 'icon' => 'briefcase', 'icon_type' => 'lucide', 'is_active' => true],
        ];

        foreach ($highlights as $item) {
            HighlightCard::updateOrCreate(['order' => $item['order']], $item);
        }

        /*
        |--------------------------------------------------------------------------
        | EXPERTISE
        |--------------------------------------------------------------------------
        */
        $expertise = [
            [
                'order' => 1,
                'title' => 'Custom Software & Platforms',
                'description' => 'Enterprise-grade systems built for real operational use.',
                'icon' => 'code',
                'icon_type' => 'lucide',
                'outcomes' => ['Scalable architecture', 'Secure access control', 'Clean codebase', 'Long-term maintainability'],
                'is_active' => true,
            ],
            [
                'order' => 2,
                'title' => 'Cybersecurity & Hardening',
                'description' => 'Protecting systems, data, and access.',
                'icon' => 'shield-check',
                'icon_type' => 'lucide',
                'outcomes' => ['Reduced risk', 'Better compliance', 'Stronger controls', 'Resilient systems'],
                'is_active' => true,
            ],
            [
                'order' => 3,
                'title' => 'IT Consulting & Strategy',
                'description' => 'Clear roadmaps and risk-aware decisions.',
                'icon' => 'compass',
                'icon_type' => 'lucide',
                'outcomes' => ['Lower risk', 'Better governance', 'Technology clarity', 'Cost efficiency'],
                'is_active' => true,
            ],
        ];

        foreach ($expertise as $item) {
            Expertise::updateOrCreate(['order' => $item['order']], $item);
        }

        /*
        |--------------------------------------------------------------------------
        | SERVICES
        |--------------------------------------------------------------------------
        */
        $services = [
            [
                'order' => 1,
                'title' => 'Custom Software Development',
                'description' => 'Secure, scalable systems tailored to your business.',
                'icon' => 'code',
                'icon_type' => 'lucide',
                'includes' => ['Planning', 'Development', 'Testing', 'Deployment'],
                'deliverables' => ['Production system', 'Documentation', 'Handover'],
                'is_active' => true,
            ],
            [
                'order' => 2,
                'title' => 'Cybersecurity & Compliance',
                'description' => 'Security audits, access control, and protection.',
                'icon' => 'lock',
                'icon_type' => 'lucide',
                'includes' => ['Security review', 'Hardening', 'Backup planning'],
                'deliverables' => ['Security report', 'Access controls', 'Recovery plan'],
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['order' => $service['order']], $service);
        }

        /*
        |--------------------------------------------------------------------------
        | SERVICE TILES
        |--------------------------------------------------------------------------
        */
        $tiles = [
            ['order' => 1, 'title' => 'Web & App Development', 'short_description' => 'High-performance digital platforms.', 'icon' => 'globe', 'icon_type' => 'lucide', 'is_active' => true],
            ['order' => 2, 'title' => 'IT Consulting', 'short_description' => 'Strategic guidance you can trust.', 'icon' => 'target', 'icon_type' => 'lucide', 'is_active' => true],
            ['order' => 3, 'title' => 'Cybersecurity', 'short_description' => 'Protecting systems and data.', 'icon' => 'shield', 'icon_type' => 'lucide', 'is_active' => true],
        ];

        foreach ($tiles as $tile) {
            ServiceTile::updateOrCreate(['order' => $tile['order']], $tile);
        }

        /*
        |--------------------------------------------------------------------------
        | FEATURED WORK
        |--------------------------------------------------------------------------
        */
        $works = [
            [
                'order' => 1,
                'title' => 'Enterprise Management Platform',
                'problem' => 'Fragmented systems and manual processes.',
                'solution' => 'Centralized, secure digital platform.',
                'outcome' => 'Operational clarity, scalability, and control.',
                'image' => 'work/work-1.jpg',
                'client_type' => 'Enterprise',
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($works as $work) {
            FeaturedWork::updateOrCreate(['order' => $work['order']], $work);
        }

        /*
        |--------------------------------------------------------------------------
        | WORK STEPS
        |--------------------------------------------------------------------------
        */
        $steps = [
            ['step_number' => 1, 'title' => 'Discovery', 'description' => 'Understanding goals, users, and risks.', 'icon' => 'search', 'is_active' => true],
            ['step_number' => 2, 'title' => 'Architecture', 'description' => 'Designing secure, scalable systems.', 'icon' => 'layers', 'is_active' => true],
            ['step_number' => 3, 'title' => 'Development', 'description' => 'Building with quality and structure.', 'icon' => 'code', 'is_active' => true],
            ['step_number' => 4, 'title' => 'Testing', 'description' => 'Ensuring performance and security.', 'icon' => 'shield-check', 'is_active' => true],
            ['step_number' => 5, 'title' => 'Deployment', 'description' => 'Stable go-live with best practices.', 'icon' => 'rocket', 'is_active' => true],
            ['step_number' => 6, 'title' => 'Support', 'description' => 'Long-term stability and growth.', 'icon' => 'headset', 'is_active' => true],
        ];

        foreach ($steps as $step) {
            WorkStep::updateOrCreate(['step_number' => $step['step_number']], $step);
        }
    }
}
