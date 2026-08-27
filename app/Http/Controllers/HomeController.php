<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Hero Slides
        |--------------------------------------------------------------------------
        */

        $heroSlides = HeroSlide::where('status', 1)
            ->whereNotNull('image')
            ->select(
                'id',
                'name',
                'image'
            )
            ->orderBy('id', 'desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('status', 1)
            ->with([
                'subCategories' => function ($query) {

                    $query->where('status', 1)
                        ->with([
                            'services' => function ($query) {

                                $query->where('status', 1);

                            }
                        ]);

                }
            ])
            ->select(
                'id',
                'name',
                'slug',
                'description',
                'image'
            )
            ->orderBy('id', 'desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Home Page
        |--------------------------------------------------------------------------
        */

        return view('home', [

            'heroSlides' => $heroSlides,

            'categories' => $categories,


            /*
            |--------------------------------------------------------------------------
            | Page Controls
            |--------------------------------------------------------------------------
            */

            'showHero' => true,

            'showHomeSliders' => true,

            'isCategoriesPage' => false,

            'isCategoryPage' => false,

            'isSubCategoryPage' => false,


            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta_title' =>
                'HOME | Marhaba Ai',

            'meta_description' =>
                'Award-Winning Photo Booth & Game Rentals in Dubai. A trusted name in the UAE, we offer over 80+ premium photo booths and interactive games, providing the most comprehensive range of services in the GCC.',

            'meta_keywords' =>
                'MIRROR BOOTH, PHOTO BOOTH, VIDEOS BOOTH, MAGAZIN BOOTH, EVENT SERVICES, MIRROR BOOTH EVENT SERVICES L.L.C, DUBAI, UAE',

        ]);
    }
}
