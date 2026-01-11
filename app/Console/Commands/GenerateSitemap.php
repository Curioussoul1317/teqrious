<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subsidiary;
use App\Models\FeaturedWork;
use App\Models\Service;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate XML sitemap';

    public function handle()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Homepage
        $sitemap .= $this->addUrl(url('/'), now(), 'daily', '1.0');

        // Subsidiary pages
        $subsidiaries = Subsidiary::active()->get();
        foreach ($subsidiaries as $subsidiary) {
            $sitemap .= $this->addUrl(
                route('subsidiary.show', $subsidiary->slug),
                $subsidiary->updated_at,
                'weekly',
                '0.8'
            );
        }

        $sitemap .= '</urlset>';

        // Save sitemap
        file_put_contents(public_path('sitemap.xml'), $sitemap);

        $this->info('Sitemap generated successfully!');
        return Command::SUCCESS;
    }

    private function addUrl($loc, $lastmod, $changefreq, $priority)
    {
        return "  <url>
    <loc>{$loc}</loc>
    <lastmod>{$lastmod->toDateString()}</lastmod>
    <changefreq>{$changefreq}</changefreq>
    <priority>{$priority}</priority>
  </url>" . PHP_EOL;
    }
}