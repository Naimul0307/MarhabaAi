<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Category;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = HeroSlide::where('status', 1)
            ->whereNotNull('image')
            ->select('id', 'name', 'image')
            ->orderBy('id', 'desc')
            ->get();

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

            $reviews = Review::where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('home', [
            'heroSlides' => $heroSlides,

            'categories' => $categories,

            'reviews' => $reviews,

            'showHero' => true,

            'isCategoryPage' => false,

            'isSubCategoryPage' => false,

            'meta_title' => 'HOME | Marhaba Ai',

            'meta_description' =>
                'Award-Winning Photo Booth & Game Rentals in Dubai. A trusted name in the UAE, we offer over 80+ premium photo booths and interactive games, providing the most comprehensive range of services in the GCC.',

            'meta_keywords' =>
                'MIRROR BOOTH, PHOTO BOOTH, VIDEOS BOOTH, MAGAZIN BOOTH, EVENT SERVICES, MIRROR BOOTH EVENT SERVICES L.L.C, DUBAI, UAE',
        ]);
    }
}
