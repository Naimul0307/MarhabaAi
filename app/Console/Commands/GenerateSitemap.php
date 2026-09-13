<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Service;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap.xml';

    public function handle()
    {
        $urls = [];

        /*
        |--------------------------------------------------------------------------
        | Locales
        |--------------------------------------------------------------------------
        */

        $locales = ['en', 'ar'];

        /*
        |--------------------------------------------------------------------------
        | Static Pages
        |--------------------------------------------------------------------------
        */

        foreach ($locales as $locale) {

            $urls[] = [
                'loc' => url("/{$locale}"),
                'priority' => '1.0',
                'changefreq' => 'daily',
            ];

            $urls[] = [
                'loc' => url("/{$locale}/categories"),
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ];

            $urls[] = [
                'loc' => url("/{$locale}/contact"),
                'priority' => '0.6',
                'changefreq' => 'monthly',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Category::where('status', 1)
            ->get()
            ->each(function ($category) use (&$urls, $locales) {

                foreach ($locales as $locale) {

                    $urls[] = [
                        'loc' => url(
                            "/{$locale}/category/{$category->slug}"
                        ),
                        'priority' => '0.8',
                        'changefreq' => 'weekly',
                        'lastmod' => optional(
                            $category->updated_at
                        )->toAtomString(),
                    ];
                }
            });

        /*
        |--------------------------------------------------------------------------
        | Sub Categories
        |--------------------------------------------------------------------------
        */

        SubCategory::where('status', 1)
            ->get()
            ->each(function ($subcategory) use (&$urls, $locales) {

                foreach ($locales as $locale) {

                    $urls[] = [
                        'loc' => url(
                            "/{$locale}/subcategory/{$subcategory->slug}"
                        ),
                        'priority' => '0.7',
                        'changefreq' => 'weekly',
                        'lastmod' => optional(
                            $subcategory->updated_at
                        )->toAtomString(),
                    ];
                }
            });

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        Service::where('status', 1)
            ->get()
            ->each(function ($service) use (&$urls, $locales) {

                foreach ($locales as $locale) {

                    $urls[] = [
                        'loc' => url(
                            "/{$locale}/service/{$service->slug}"
                        ),
                        'priority' => '0.9',
                        'changefreq' => 'weekly',
                        'lastmod' => optional(
                            $service->updated_at
                        )->toAtomString(),
                    ];
                }
            });

        /*
        |--------------------------------------------------------------------------
        | Generate XML
        |--------------------------------------------------------------------------
        */

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $item) {

            $xml .= "    <url>" . PHP_EOL;

            $xml .= "        <loc>" .
                htmlspecialchars(
                    $item['loc'],
                    ENT_XML1,
                    'UTF-8'
                ) .
                "</loc>" . PHP_EOL;

            if (!empty($item['lastmod'])) {

                $xml .= "        <lastmod>" .
                    $item['lastmod'] .
                    "</lastmod>" . PHP_EOL;
            }

            $xml .= "        <changefreq>" .
                $item['changefreq'] .
                "</changefreq>" . PHP_EOL;

            $xml .= "        <priority>" .
                $item['priority'] .
                "</priority>" . PHP_EOL;

            $xml .= "    </url>" . PHP_EOL;
        }

        $xml .= '</urlset>';

        /*
        |--------------------------------------------------------------------------
        | Save Sitemap
        |--------------------------------------------------------------------------
        */

        file_put_contents(
            public_path('sitemap.xml'),
            $xml
        );

        $this->info('Sitemap generated successfully!');
        $this->info(
            'Location: ' . public_path('sitemap.xml')
        );

        $this->info(
            'URL: ' . url('sitemap.xml')
        );

        $this->info(
            'Total URLs: ' . count($urls)
        );

        return Command::SUCCESS;
    }
}
