<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'E-Commerce Platform',
                'description' => 'Complete online shopping solution with payment integration, inventory management, and customer portal. Built with modern technologies for scalability and performance.',
                'category' => 'Web Development',
                'price' => 5000.00,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Cross-platform mobile applications for iOS and Android. Native performance with seamless user experience and cloud integration.',
                'category' => 'Mobile Development',
                'price' => 8000.00,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Business Management System',
                'description' => 'Custom ERP solution tailored to your business needs. Includes CRM, inventory, accounting, and reporting modules.',
                'category' => 'Enterprise Software',
                'price' => 15000.00,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Digital Marketing Suite',
                'description' => 'Comprehensive digital marketing platform with SEO tools, social media management, analytics, and campaign tracking.',
                'category' => 'Marketing',
                'price' => 3500.00,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Cloud Infrastructure Setup',
                'description' => 'Professional cloud infrastructure deployment and management. Includes AWS/Azure setup, security configuration, and monitoring.',
                'category' => 'Cloud Services',
                'price' => 4500.00,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'API Development & Integration',
                'description' => 'RESTful API development and third-party service integration. Secure, scalable, and well-documented APIs for your applications.',
                'category' => 'Backend Development',
                'price' => 3000.00,
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'UI/UX Design Services',
                'description' => 'Professional user interface and experience design. Includes wireframes, prototypes, and final design assets.',
                'category' => 'Design',
                'price' => 2500.00,
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Data Analytics Platform',
                'description' => 'Advanced data analytics and business intelligence solution. Real-time dashboards, custom reports, and predictive analytics.',
                'category' => 'Data Science',
                'price' => 6500.00,
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
