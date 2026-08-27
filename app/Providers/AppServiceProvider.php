<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

use App\Models\WorkingCompany;
use App\Models\Review;
use App\Models\Category;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS
        if (
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'
        ) {
            URL::forceScheme('https');
        }

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Review Slider
        View::composer('layouts.review', function ($view) {
            $reviews = Review::where('status', 1)
                ->select(
                    'id',
                    'name',
                    'slug',
                    'image',
                    'rating',
                    'review',
                    'review_date'
                )
                ->orderBy('id', 'desc')
                ->get();

            $view->with('reviews', $reviews);
        });

        // Company Slider
        View::composer('layouts.company', function ($view) {

            $companies = WorkingCompany::where('status', 1)
                ->select('id', 'name', 'image')
                ->get();

            $view->with('companies', $companies);
        });

        // Header Categories
        View::composer('layouts.header', function ($view) {

            $categories = Category::where('status', 1)
                ->select('id', 'name', 'slug')
                ->orderBy('id', 'desc')
                ->get();

            $view->with('categories', $categories);
        });

        // Header Settings
        View::composer('layouts.header', function ($view) {

            $settings = Setting::first();

            $view->with('settings', $settings);
        });

        // Footer Settings
        View::composer('layouts.footer', function ($view) {

            $settings = Setting::first();

            $view->with('settings', $settings);
        });

    }

}
