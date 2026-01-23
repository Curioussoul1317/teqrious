<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Professional websites and web applications built with modern technologies. From simple landing pages to complex enterprise platforms.',
                'icon' => 'bi bi-globe',
                'icon_type' => 'bootstrap',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Native and cross-platform mobile applications for iOS and Android. Seamless user experience with powerful functionality.',
                'icon' => 'bi bi-phone',
                'icon_type' => 'bootstrap',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Cloud Solutions',
                'description' => 'Scalable cloud infrastructure and migration services. AWS, Azure, and Google Cloud deployment and management.',
                'icon' => 'bi bi-cloud',
                'icon_type' => 'bootstrap',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX Design',
                'description' => 'Beautiful, intuitive user interfaces that delight users. User-centered design process from wireframes to final designs.',
                'icon' => 'bi bi-palette',
                'icon_type' => 'bootstrap',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'IT Consulting',
                'description' => 'Strategic technology guidance for your business. Digital transformation, architecture review, and technology roadmapping.',
                'icon' => 'bi bi-lightbulb',
                'icon_type' => 'bootstrap',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Cybersecurity',
                'description' => 'Protect your digital assets with comprehensive security solutions. Penetration testing, security audits, and compliance.',
                'icon' => 'bi bi-shield-check',
                'icon_type' => 'bootstrap',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'API Development',
                'description' => 'RESTful and GraphQL APIs for seamless system integration. Secure, scalable, and well-documented endpoints.',
                'icon' => 'bi bi-link-45deg',
                'icon_type' => 'bootstrap',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'DevOps & Automation',
                'description' => 'Streamline development and deployment with CI/CD pipelines. Infrastructure as code and automated testing.',
                'icon' => 'bi bi-gear',
                'icon_type' => 'bootstrap',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Database Management',
                'description' => 'Design, optimize, and maintain your databases. MySQL, PostgreSQL, MongoDB, and more.',
                'icon' => 'bi bi-database',
                'icon_type' => 'bootstrap',
                'order' => 9,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
