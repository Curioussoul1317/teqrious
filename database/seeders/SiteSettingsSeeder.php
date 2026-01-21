<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'TEQRIOUS', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Building Digital Excellence', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'group' => 'general'],
            ['key' => 'favicon', 'value' => null, 'type' => 'image', 'group' => 'general'],
            
            // Contact
            ['key' => 'email', 'value' => 'info@teqrious.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+960 9654994', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'whatsapp', 'value' => '+9609654994', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'address', 'value' => "Male', Maldives", 'type' => 'textarea', 'group' => 'contact'],
            
            // Social
            ['key' => 'facebook', 'value' => 'https://facebook.com/teqrious', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/teqrious', 'type' => 'text', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/teqrious', 'type' => 'text', 'group' => 'social'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/teqrious', 'type' => 'text', 'group' => 'social'],
            
            // SEO
            ['key' => 'meta_description', 'value' => 'TEQRIOUS - Building Digital Excellence. We provide comprehensive IT solutions including software development, cybersecurity, IT consulting, and managed services.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'IT solutions, software development, cybersecurity, IT consulting, Maldives', 'type' => 'text', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}